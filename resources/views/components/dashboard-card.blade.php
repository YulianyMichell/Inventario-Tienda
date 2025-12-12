@props(['title', 'value', 'color', 'icon'])

@php
$colors = [
    'blue' => 'bg-indigo-600',
    'yellow' => 'bg-yellow-500',
    'green' => 'bg-green-500',
    'red' => 'bg-red-500'
];
@endphp

<div class="{{ $colors[$color] }} text-white p-6 rounded-xl shadow-lg transform hover:scale-[1.02] transition">
    <div class="text-center text-5xl mb-2">{{ $icon }}</div>
    <h3 class="text-xl font-bold text-center">{{ $title }}</h3>
    <p class="text-4xl font-extrabold text-center mt-1">{{ $value }}</p>
</div>
