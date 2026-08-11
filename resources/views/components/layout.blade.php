@props([
    'title' => 'Mohamed M’Kirchel — Automatisation et intégration API',
    'description' => 'Automatisation de processus, intégration de systèmes et fiabilisation des données pour les entreprises.',
    'canonical' => route('home'),
    'structuredData' => null,
])

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Mohamed M’Kirchel">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <title>{{ $title }}</title>
    @if ($structuredData)
        <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a href="#contenu" class="sr-only z-50 rounded-md bg-white px-4 py-3 font-semibold text-sky-800 focus:not-sr-only focus:fixed focus:left-4 focus:top-4">
        Aller au contenu
    </a>

    <x-header />

    <main id="contenu">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>
