{{-- Este contenido debe ir dentro del <aside> en layouts/admin.blade.php --}}
<div class="w-64 flex-shrink-0 bg-azul-muy-oscuro text-white shadow-2xl h-screen flex flex-col px-4 py-6 fixed top-0 left-0">
    
    <div class="mb-8 text-2xl font-extrabold border-b border-gray-700/50 pb-4 uppercase tracking-wider">
        INVENTARIO
    </div>

    <nav class="flex-grow space-y-2"> 
        
        <x-menu-item title="Dashboard" route="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
             <i class="bi bi-house-door text-lg"></i> {{-- Icono más grande --}}
        </x-menu-item>
        
        <x-menu-item title="Categorías" route="{{ route('categorias.index') }}" :active="request()->routeIs('categorias.index')">
             <i class="bi bi-tags text-lg"></i> {{-- Icono para Categorías --}}
        </x-menu-item>

        <x-menu-item title="Clientes" route="{{ route('clientes.index') }}" :active="request()->routeIs('clientes.index')">
             <i class="bi bi-people text-lg"></i>
        </x-menu-item>

        <x-menu-item title="Proveedores" route="{{ route('proveedores.index') }}" :active="request()->routeIs('proveedores.index')">
            <i class="bi bi-truck text-lg"></i>
        </x-menu-item>

        <x-menu-item title="Productos" route="{{ route('productos.index') }}" :active="request()->routeIs('productos.index')">
            <i class="bi bi-box-seam text-lg"></i>
        </x-menu-item>

        <x-menu-item title="Presentaciones" route="{{ route('presentaciones.index') }}" :active="request()->routeIs('presentaciones.index')">
            <i class="bi bi-boxes text-lg"></i> {{-- Ícono para Presentaciones/Cajas --}}
        </x-menu-item>
        <x-menu-item title="Inventario" route="{{ route('inventario.index') }}" :active="request()->routeIs('inventario.index')">
            <i class="bi bi-clipboard-data text-lg"></i>
        </x-menu-item>

        <x-menu-item title="Ventas" route="{{ route('ventas.index') }}" :active="request()->routeIs('ventas.index')">
            <i class="bi bi-cash-stack text-lg"></i>
        </x-menu-item>
        <x-menu-item title="Facturas" route="factura.index" :active="request()->routeIs('factura.index')">
    <i class="bi bi-receipt-cutoff"></i>
</x-menu-item>


        
    </nav>

    <div class="mt-auto pt-8">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-3 px-4 rounded-lg text-white font-bold btn-logout text-base">
                Cerrar sesión
            </button>
        </form>
    </div>
</div>
