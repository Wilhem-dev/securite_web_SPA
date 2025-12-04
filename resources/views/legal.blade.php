<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mentions légales</title>
    @vite(['resources/js/app.ts'])
</head>
<body class="antialiased font-sans p-6">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Mentions légales</h1>

        <p>Ce projet est réalisé dans le cadre d'un projet scolaire. Responsable du site : <strong>Nom du responsable</strong> (à remplacer).</p>

        <h2 class="mt-4 font-semibold">Données personnelles</h2>
        <p>Nous collectons uniquement les informations nécessaires au fonctionnement du service : nom, email, mot de passe (haché). Nous ne collectons pas d'informations sensibles (numéro de sécurité sociale, adresse complète, date de naissance) sans justification.</p>

        <p>Pour toute question, contactez l'administrateur du site.</p>

        <div class="mt-6">
            <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 bg-gray-200 rounded">Retour</a>
        </div>
    </div>
</body>
</html>
