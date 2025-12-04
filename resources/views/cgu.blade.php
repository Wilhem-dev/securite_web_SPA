<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conditions générales d'utilisation (CGU)</title>
    @vite(['resources/js/app.ts'])
</head>
<body class="antialiased font-sans p-6">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Conditions générales d'utilisation (CGU)</h1>

        <p>CGU minimalistes pour usage pédagogique : en utilisant ce service, vous acceptez les conditions d'utilisation et la gestion de vos données telle que décrite dans la politique de confidentialité.</p>

        <div class="mt-6">
            <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 bg-gray-200 rounded">Retour</a>
        </div>
    </div>
</body>
</html>
