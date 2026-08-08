@props([
    'title' => 'Mohamed M’Kirchel — Automatisation et intégration API',
    'description' => 'Automatisation de processus, intégration de systèmes et fiabilisation des données pour les entreprises.',
])

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description }}">
    <title>{{ $title }}</title>
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
