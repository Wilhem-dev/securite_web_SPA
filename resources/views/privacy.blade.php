<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Politique de confidentialité</title>
    @vite(['resources/js/app.ts'])
</head>
<body class="antialiased font-sans p-6">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Politique de confidentialité</h1>

        <p>Cette application collecte et traite uniquement les données nécessaires au fonctionnement du service (nom, email, mot de passe haché, consentements cookies si présents).</p>

        <h2 class="mt-4 font-semibold">Finalités</h2>
        <ul class="list-disc ml-6">
            <li>Authentification et gestion du compte</li>
            <li>Conservation des consentements</li>
        </ul>

        <h2 class="mt-4 font-semibold">Vos droits</h2>
        <p>Vous pouvez demander l'export et la suppression de vos données via les endpoints prévus à cet effet (si implémentés).</p>

        <div class="mt-6">
            <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 bg-gray-200 rounded">Retour</a>
        </div>
    </div>
</body>
</html>
