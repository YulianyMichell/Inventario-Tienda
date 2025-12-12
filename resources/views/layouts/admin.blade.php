<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario | @yield('title', 'Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* Definición de colores de la paleta extraídos del Login */
        
        /* 1. Fondo Base (Azul muy oscuro) */
        .bg-azul-muy-oscuro { background-color: #0A1326; } 
        
        /* 2. Fondo Intermedio (Azul profundo) */
        .text-azul-profundo { color: #132A54; } 
        
        /* 3. Color de Acento (Celeste Suave) */
        .bg-celeste-suave { background-color: #8BB3FF; } 
        
        /* 4. Fondo Claro (Blanco muy claro) */
        .bg-fondo-claro { background-color: #F3F6FF; } /* Usando #F3F6FF del login */
        
        /* Efecto Hover para enlaces de Sidebar (Blanco Transparente 0.2) */
        .hover-blanco-translucido { background-color: rgba(255, 255, 255, 0.2); }
        
        /* Color del botón de Cerrar Sesión (Usaremos Púrpura #A855F7 o el Rojo que tenías) */
        /* Opción 1: Púrpura del Login */
        .btn-logout { background-color: #A855F7; transition: background-color 0.2s; } 
        .btn-logout:hover { background-color: #923de7; }
        /* Opción 2: Rojo para énfasis (Manteniendo el estándar de "salir")
        .btn-logout { background-color: #dc3545; transition: background-color 0.2s; } 
        .btn-logout:hover { background-color: #b91c1c; }
        */
    </style>
</head>

<body class="flex min-h-screen">

    <aside class="w-64 flex-shrink-0 bg-azul-muy-oscuro text-white shadow-2xl">
        @include('layouts.sidebar-menu')
    </aside>

    <div class="flex-grow flex flex-col bg-fondo-claro ml-64"> 
        
        <header class="h-16 bg-white shadow-sm flex justify-end items-center px-6 flex-shrink-0">
            <div class="relative text-gray-700 font-semibold">
                Administrador
            </div>
        </header>

        <main class="p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

</body>
</html>