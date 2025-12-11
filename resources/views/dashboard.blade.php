<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- TÍTULO --}}
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
                Panel de Administración
            </h1>

            {{-- GRID DE TARJETAS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- PRODUCTOS --}}
                <div class="p-6 rounded-xl shadow-lg flex justify-between items-center 
                    bg-[#0F4C75] text-white hover:scale-[1.03] transition-all duration-200 cursor-pointer">
                    <div>
                        <h2 class="text-xl font-semibold">Productos</h2>
                        <p class="text-sm opacity-80">Gestionar inventario</p>
                    </div>
                    <i class="fa-solid fa-box text-5xl opacity-70"></i>
                </div>

                {{-- CATEGORÍAS --}}
                <div class="p-6 rounded-xl shadow-lg flex justify-between items-center 
                    bg-[#3282B8] text-white hover:scale-[1.03] transition-all duration-200 cursor-pointer">
                    <div>
                        <h2 class="text-xl font-semibold">Categorías</h2>
                        <p class="text-sm opacity-80">Organizar productos</p>
                    </div>
                    <i class="fa-solid fa-tags text-5xl opacity-70"></i>
                </div>

                {{-- VENTAS --}}
                <div class="p-6 rounded-xl shadow-lg flex justify-between items-center 
                    bg-[#BBE1FA] text-[#0F4C75] hover:scale-[1.03] transition-all duration-200 cursor-pointer">
                    <div>
                        <h2 class="text-xl font-semibold">Ventas</h2>
                        <p class="text-sm opacity-80">Historial de ventas</p>
                    </div>
                    <i class="fa-solid fa-cart-shopping text-5xl opacity-70"></i>
                </div>

                {{-- USUARIOS --}}
                <div class="p-6 rounded-xl shadow-lg flex justify-between items-center 
                    bg-[#1B262C] text-white hover:scale-[1.03] transition-all duration-200 cursor-pointer">
                    <div>
                        <h2 class="text-xl font-semibold">Usuarios</h2>
                        <p class="text-sm opacity-80">Administrar usuarios</p>
                    </div>
                    <i class="fa-solid fa-users text-5xl opacity-70"></i>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
