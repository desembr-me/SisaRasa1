<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RecipeMatcherService
{
    /**
     * How many candidate meals (found via per-ingredient search) to fetch full
     * details for and score. Keeps the number of TheMealDB requests bounded.
     */
    private const MAX_CANDIDATES = 6;

    private const DEFAULT_COOK_TIME_MINUTES = 25;

    private const DEFAULT_KG_SAVED = 0.4;

    public function __construct(private readonly TranslatorService $translator) {}

    /**
     * Find the recipe (fetched live from TheMealDB) whose ingredient list best
     * overlaps with what the user has on hand.
     *
     * @param  array<int, string>  $userIngredients
     * @return array{title: string, description: string, image: ?string, cook_time_minutes: int, estimated_kg_saved: float, ingredients_used: array<int, string>, steps: array<int, string>}|null
     */
    public function findBestMatch(array $userIngredients): ?array
    {
        $normalized = collect($userIngredients)
            ->map(fn ($item) => Str::lower(trim($item)))
            ->filter()
            ->unique()
            ->values();

        if ($normalized->isEmpty()) {
            return null;
        }

        $translated = $normalized
            ->map(fn ($item) => Str::lower(IngredientTranslator::toEnglish($item)))
            ->unique()
            ->values();

        $candidateIds = $this->searchCandidates($translated);

        if ($candidateIds->isEmpty()) {
            return null;
        }

        $best = null;
        $bestScore = 0;
        $bestRatio = 0.0;

        foreach ($candidateIds as $mealId) {
            $meal = $this->lookupMeal($mealId);

            if (! $meal) {
                continue;
            }

            $recipeIngredients = $this->extractIngredients($meal)->map(fn ($item) => Str::lower($item));

            $score = $recipeIngredients->filter(
                fn ($ri) => $translated->contains(fn ($ui) => Str::contains($ri, $ui) || Str::contains($ui, $ri))
            )->count();

            if ($score === 0) {
                continue;
            }

            $ratio = $score / max(1, $recipeIngredients->count());

            if ($score > $bestScore || ($score === $bestScore && $ratio > $bestRatio)) {
                $best = $meal;
                $bestScore = $score;
                $bestRatio = $ratio;
            }
        }

        if (! $best) {
            return null;
        }

        $steps = $this->extractSteps((string) ($best['strInstructions'] ?? ''));
        $ingredientsUsed = $this->extractIngredients($best)->values()->all();
        $title = (string) ($best['strMeal'] ?? 'Resep');

        $stepCount = count($steps);
        $ingredientCount = count($ingredientsUsed);

        $translated = $this->translator->translateManyToIndonesian(
            array_merge([$title], $ingredientsUsed, $steps)
        );

        $title = $translated[0] ?? $title;
        $ingredientsUsed = array_values(array_slice($translated, 1, $ingredientCount));
        $steps = array_values(array_slice($translated, 1 + $ingredientCount, $stepCount));

        return [
            'title' => $title,
            'description' => Str::limit(collect($steps)->implode(' '), 160),
            'image' => $best['strMealThumb'] ?? null,
            'cook_time_minutes' => self::DEFAULT_COOK_TIME_MINUTES,
            'estimated_kg_saved' => self::DEFAULT_KG_SAVED,
            'ingredients_used' => $ingredientsUsed,
            'steps' => $steps,
        ];
    }

    /**
     * Search TheMealDB once per translated ingredient and tally how often each
     * meal shows up, so meals matching more of the user's ingredients rank first.
     *
     * @param  \Illuminate\Support\Collection<int, string>  $translatedIngredients
     * @return \Illuminate\Support\Collection<int, string> meal ids, best matches first
     */
    private function searchCandidates($translatedIngredients)
    {
        $tally = [];

        foreach ($translatedIngredients as $ingredient) {
            $meals = $this->request('filter.php', ['i' => $ingredient])['meals'] ?? [];

            foreach ((array) $meals as $meal) {
                $id = $meal['idMeal'] ?? null;

                if (! $id) {
                    continue;
                }

                $tally[$id] = ($tally[$id] ?? 0) + 1;
            }
        }

        arsort($tally);

        return collect(array_keys($tally))->take(self::MAX_CANDIDATES);
    }

    /**
     * @return array<string, mixed>|null
     */
    private function lookupMeal(string $mealId): ?array
    {
        return $this->request('lookup.php', ['i' => $mealId])['meals'][0] ?? null;
    }

    /**
     * @param  array<string, string>  $query
     * @return array<string, mixed>
     */
    private function request(string $endpoint, array $query): array
    {
        $baseUrl = config('services.themealdb.base_url');

        try {
            $response = Http::timeout(5)->get("{$baseUrl}/{$endpoint}", $query);

            if (! $response->ok()) {
                return [];
            }

            return (array) $response->json();
        } catch (\Throwable $e) {
            Log::warning('TheMealDB request failed', ['endpoint' => $endpoint, 'message' => $e->getMessage()]);

            return [];
        }
    }

    /**
     * @param  array<string, mixed>  $meal
     * @return \Illuminate\Support\Collection<int, string>
     */
    private function extractIngredients(array $meal)
    {
        return collect(range(1, 20))
            ->map(fn ($n) => trim((string) ($meal["strIngredient{$n}"] ?? '')))
            ->filter()
            ->values();
    }

    /**
     * @return array<int, string>
     */
    private function extractSteps(string $instructions): array
    {
        return collect(preg_split('/\r\n|\n|\r/', trim($instructions)) ?: [])
            ->map(fn ($step) => trim($step, " \t\n\r\0\x0B-"))
            // drop lines that are only step numbering (e.g. "1." on its own line)
            ->reject(fn ($step) => $step === '' || preg_match('/^\d+[.)]?$/', $step))
            // strip leading numbering from the remaining lines (e.g. "1. Boil the rice" -> "Boil the rice")
            ->map(fn ($step) => trim((string) preg_replace('/^\d+[.)]\s*/', '', $step)))
            ->filter()
            ->values()
            ->all();
    }
}
