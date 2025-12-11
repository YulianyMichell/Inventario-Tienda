<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tipografía elegante -->
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        @keyframes fadeInPage {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-page {
            animation: fadeInPage .8s ease forwards;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center animate-page"
    style="background: linear-gradient(135deg, #0A1A3F 0%, #142859 55%, #1E3A8A 100%);">

    <div class="w-full sm:max-w-4xl px-4">
        {{ $slot }}
    </div>

</body>
</html>
