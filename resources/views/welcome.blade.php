<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans text-gray-900 antialiased">

<x-guest-layout>

    <div>
        <div style="text-align: center">
            <h1>MINGLEPARENT</h1><br>

            <p>Ce projet vise la création d'un site web dédié aux parents solos en Belgique dans le but de
               cultiver
               la communauté, de partager des conseils pragmatiques, de coordonner des évènements locaux, de
               mettre à
               disposition des services de gardes d'enfants, et de faciliter l'établissement de connexions
               locales.</p>
        </div>
    </div>
</x-guest-layout>
</body>
</html>
