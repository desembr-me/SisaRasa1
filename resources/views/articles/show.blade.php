<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $article->title }} — {{ config('app.name', 'SisaRasa') }}</title>
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
@vite(['resources/css/landing.css'])
<style>
  .article-body{ max-width:680px; margin:0 auto; }
  .article-body h1{ font-size:clamp(28px,4vw,40px); margin-bottom:8px; }
  .article-body .meta{ font-family:'JetBrains Mono', monospace; font-size:12px; color:var(--ink-faint); margin-bottom:32px; }
  .article-body .prose{ color:var(--ink-soft); font-size:16px; line-height:1.75; }
  .article-body .prose strong{ color:var(--ink); }
  .article-body .prose p{ margin:0 0 20px; }
  .article-body .prose ul, .article-body .prose ol{ margin:0 0 20px; padding-left:22px; }
  .article-body .prose li{ margin-bottom:8px; }
  .article-body .prose h2{ font-size:22px; margin:32px 0 12px; color:var(--ink); }
  .back-link{ display:inline-block; margin-bottom:32px; font-size:14px; color:var(--ink-soft); text-decoration:none; }
  .back-link:hover{ color:var(--mango); }
</style>
</head>
<body>
<main class="wrap" style="padding:clamp(48px,8vw,80px) 0;">
  <div class="article-body">
    <a href="{{ url('/#cerita') }}" class="back-link">&larr; Kembali ke Cerita</a>
    <h1>{{ $article->title }}</h1>
    <div class="meta">{{ $article->published_at->translatedFormat('d F Y') }} · Tim SisaRasa</div>
    <div class="prose">
      {!! Str::markdown($article->body) !!}
    </div>
  </div>
</main>
</body>
</html>
