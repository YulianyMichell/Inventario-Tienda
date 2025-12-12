<div class="w-64 flex-shrink-0 bg-azul-muy-oscuro text-white shadow-2xl h-full flex flex-col p-5 fixed top-0 left-0">
    
    <div class="mb-8 text-xl font-bold border-b border-gray-700/50 pb-4 uppercase tracking-wider">
        INVENTARIO
    </div>

    <nav class="flex-grow space-y-1.5">
        
        <x-menu-item title="Dashboard" route="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
             <i class="bi bi-house-door"></i>
        </x-menu-item>

        <x-menu-item title="Clientes" route="{{ route('clientes.index') }}" :active="request()->routeIs('clientes.index')">
             <i class="bi bi-people"></i>
        </x-menu-item>

        <x-menu-item title="Proveedores" route="{{ route('proveedores.index') }}" :active="request()->routeIs('proveedores.index')">
            <i class="bi bi-truck"></i>
        </x-menu-item>

        <x-menu-item title="Productos" route="{{ route('productos.index') }}" :active="request()->routeIs('productos.index')">
            <i class="bi bi-box-seam"></i>
        </x-menu-item>

        <x-menu-item title="Inventario" route="{{ route('inventario.index') }}" :active="request()->routeIs('inventario.index')">
            <i class="bi bi-clipboard-data"></i>
        </x-menu-item>

        <x-menu-item title="Ventas" route="{{ route('ventas.index') }}" :active="request()->routeIs('ventas.index')">
            <i class="bi bi-cash-stack"></i>
        </x-menu-item>
        <x-menu-item title="Facturas" route="factura.index" :active="request()->routeIs('factura.index')">
    <i class="bi bi-receipt-cutoff"></i>
</x-menu-item>


        
    </nav>

    <div class="mt-auto pt-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-2.5 px-4 rounded-lg text-white font-semibold btn-logout">
                Cerrar sesión
            </button>
        </form>
    </div>
</div>
