<x-app-layout>
    <x-slot name="layoutTitle">Admin Dashboard</x-slot>

    <x-slot name="slot">
        <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                
                
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Panel de Administración</h1>
                        <p class="text-gray-500 mt-1">Bienvenido de nuevo, <span class="text-orange-600 font-semibold">{{ auth()->user()->name ?? 'Usuario' }}</span></p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Sistema Activo
                        </span>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

                    
                    @if(auth()->user() && auth()->user()->isAdmin())
                        <a href="{{ route('admin-view.index') }}" class="group bg-white overflow-hidden rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                            <div class="p-6 flex items-center">
                                <div class="p-3 rounded-lg bg-orange-100 text-orange-600 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-orange-600 transition-colors">Productos</h3>
                                    <p class="text-sm text-gray-500">Inventario y precios</p>
                                </div>
                            </div>
                        </a>
                    @endif

                    
                    <a href="{{ route('admin-pedidos.index') }}" class="group bg-white overflow-hidden rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                        <div class="p-6 flex items-center">
                            <div class="p-3 rounded-lg bg-blue-100 text-blue-600 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Cocina</h3>
                                <p class="text-sm text-gray-500">Gestión de comandas</p>
                            </div>
                        </div>
                    </a>

                    
                    <a href="{{ route('admin-caja.index') }}" class="group bg-white overflow-hidden rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                        <div class="p-6 flex items-center">
                            <div class="p-3 rounded-lg bg-green-100 text-green-600 group-hover:bg-green-500 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-green-600 transition-colors">Caja</h3>
                                <p class="text-sm text-gray-500">Cobros y cierre de pedidos</p>
                            </div>
                        </div>
                    </a>

                    
                    @if(auth()->user() && (auth()->user()->isAdmin() || auth()->user()->role === 'trabajador'))
                        <a href="{{ route('admin.report') }}" class="group bg-white overflow-hidden rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                            <div class="p-6 flex items-center">
                                <div class="p-3 rounded-lg bg-purple-100 text-purple-600 group-hover:bg-purple-500 group-hover:text-white transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-purple-600 transition-colors">Reportes</h3>
                                    <p class="text-sm text-gray-500">Métricas y exportación</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin-pedidos.history') }}" class="group bg-white overflow-hidden rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                            <div class="p-6 flex items-center">
                                <div class="p-3 rounded-lg bg-indigo-100 text-indigo-600 group-hover:bg-indigo-500 group-hover:text-white transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">Historial</h3>
                                    <p class="text-sm text-gray-500">Pedidos anteriores</p>
                                </div>
                            </div>
                        </a>
                    @endif

                    
                    @if(auth()->user() && auth()->user()->isAdmin())
                        <a href="{{ route('admin.settings') }}" class="group bg-white overflow-hidden rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                            <div class="p-6 flex items-center">
                                <div class="p-3 rounded-lg bg-gray-100 text-gray-600 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-gray-600 transition-colors">Ajustes</h3>
                                    <p class="text-sm text-gray-500">Horarios y sistema</p>
                                </div>
                            </div>
                        </a>
                    @endif

                </div>

                
                <div class="border-t border-gray-200 pt-6 mt-auto">
                    <form method="POST" action="{{ route('logout') }}" class="flex justify-end">
                        @csrf
                        <button type="submit" class="flex items-center space-x-2 text-gray-500 hover:text-red-600 transition-colors font-medium px-4 py-2 rounded-lg hover:bg-red-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Cerrar sesión segura</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </x-slot>
</x-app-layout>





















