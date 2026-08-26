<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TranslatorService
{
    /**
     * MyMemory's free/anonymous tier rejects long queries, so paragraphs get
     * split into sentence-sized chunks below this length before translating.
     */
    private const MAX_CHUNK_LENGTH = 480;

    private const QUOTA_WARNING_MARKER = 'MYMEMORY WARNING';

    private const CACHE_TTL_DAYS = 60;

    /**
     * Translate a list of English strings to Indonesian, preserving order and
     * array keys. Any entry that fails to translate (network error, empty
     * result, quota exceeded, etc.) falls back to its original English text.
     *
     * @param  array<int, string>  $texts
     * @return array<int, string>
     */
    public function translateManyToIndonesian(array $texts): array
    {
        $chunkIndexesByText = [];
        $allChunks = [];

        foreach ($texts as $key => $text) {
            $chunks = $this->chunk((string) $text);
            $chunkIndexesByText[$key] = [];

            foreach ($chunks as $chunk) {
                $chunkIndexesByText[$key][] = count($allChunks);
                $allChunks[] = $chunk;
            }
        }

        $translatedChunks = $this->translateChunks($allChunks);

        $result = [];

        foreach ($texts as $key => $original) {
            $indexes = $chunkIndexesByText[$key];

            if (empty($indexes)) {
                $result[$key] = $original;
                continue;
            }

            $pieces = array_map(fn ($i) => $translatedChunks[$i] ?? $allChunks[$i], $indexes);
            $result[$key] = trim(implode(' ', $pieces)) ?: $original;
        }

        return $result;
    }

    /**
     * @param  array<int, string>  $chunks
     * @return array<int, string>
     */
    private function translateChunks(array $chunks): array
    {
        $result = [];
        $toFetch = [];

        foreach ($chunks as $i => $chunk) {
            $cached = Cache::get($this->cacheKey($chunk));

            if (is_string($cached)) {
                $result[$i] = $cached;
            } else {
                $toFetch[$i] = $chunk;
            }
        }

        if (empty($toFetch)) {
            return $result;
        }

        try {
            $responses = Http::pool(function ($pool) use ($toFetch) {
                foreach ($toFetch as $i => $chunk) {
                    $pool->as((string) $i)->timeout(6)->get('https://api.mymemory.translated.net/get', [
                        'q' => $chunk,
                        'langpair' => 'en|id',
                    ]);
                }
            });
        } catch (\Throwable $e) {
            Log::warning('Translation pool request failed', ['message' => $e->getMessage()]);
            $responses = [];
        }

        foreach ($toFetch as $i => $chunk) {
            $response = $responses[(string) $i] ?? null;

            $text = ($response instanceof Response && $response->ok())
                ? $response->json('responseData.translatedText')
                : null;

            $translated = (is_string($text) && $text !== '' && ! Str::contains($text, self::QUOTA_WARNING_MARKER))
                ? $text
                : $chunk;

            $result[$i] = $translated;

            if ($translated !== $chunk) {
                Cache::put($this->cacheKey($chunk), $translated, now()->addDays(self::CACHE_TTL_DAYS));
            }
        }

        ksort($result);

        return $result;
    }

    /**
     * @return array<int, string>
     */
    private function chunk(string $text): array
    {
        $text = trim($text);

        if ($text === '') {
            return [];
        }

        if (mb_strlen($text) <= self::MAX_CHUNK_LENGTH) {
            return [$text];
        }

        $sentences = preg_split('/(?<=[.!?])\s+/', $text) ?: [$text];
        $chunks = [];
        $current = '';

        foreach ($sentences as $sentence) {
            if ($current !== '' && mb_strlen($current) + mb_strlen($sentence) + 1 > self::MAX_CHUNK_LENGTH) {
                $chunks[] = $current;
                $current = '';
            }

            $current = $current === '' ? $sentence : "{$current} {$sentence}";
        }

        if ($current !== '') {
            $chunks[] = $current;
        }

        return $chunks;
    }

    private function cacheKey(string $text): string
    {
        return 'translate:en-id:'.md5(Str::lower(trim($text)));
    }
}
