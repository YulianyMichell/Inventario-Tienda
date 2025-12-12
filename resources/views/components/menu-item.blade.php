@props(['title', 'route', 'active' => false])

@php
    // Colores de la paleta
    $celesteSuave = '#8BB3FF';
    $azulProfundo = '#132A54';
    
    // Clase base para todos los enlaces
    $baseClass = "flex items-center p-3 rounded-lg text-sm font-medium transition duration-200 w-full";
    
    // Estilos condicionales para el estado ACTIVO
    if ($active) {
        // ACTIVO: Fondo Celeste suave, texto Azul profundo
        $linkClasses = "{$baseClass} shadow-md";
        $linkStyle = "background-color: {$celesteSuave}; color: {$azulProfundo};";
        $iconColor = $azulProfundo;
        
    } else {
        // INACTIVO: Fondo transparente, texto blanco, con efecto hover
        $linkClasses = "{$baseClass} text-white hover:bg-white/20"; // Usamos 'white/20' para el hover translúcido
        $linkStyle = "";
        $iconColor = 'white';
    }
@endphp

<a href="{{ $route }}" class="{{ $linkClasses }}" style="{{ $linkStyle }}">
    
    <span class="mr-3 w-5 h-5 flex items-center justify-center" style="color: {{ $iconColor }};">
        {{ $slot }} 
    </span>

    <span class="font-semibold">
        {{ $title }}
    </span>
</a>