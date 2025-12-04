<x-app-layout>
    <x-slot name='layoutTitle'>
        Gestión de Productos
    </x-slot>

    <x-slot name='slot'>
        <div class="container mx-auto mt-8 px-4 mb-20">
            
            
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center text-gray-500 hover:text-orange-600 transition-colors font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
                            Regresar</a>
                        </div>
                    <h1 class="text-3xl font-bold text-gray-800">Inventario de Productos</h1>
                </div>

                <div class="flex flex-wrap items-center gap-3">

                    @if(auth()->user() && auth()->user()->isAdmin())
                        <a href="{{ route('admin-create-view.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg shadow-sm flex items-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                            Nuevo Producto
                        </a>
                    @endif
                </div>
            </div>

            
            @if(session('status'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded shadow-sm flex items-center justify-between">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        {{ session('status') }}
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-800">&times;</button>
                </div>
            @endif

            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($productos as $producto)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300 group flex flex-col h-full">
                        
                        
                        <div class="h-48 bg-gray-100 overflow-hidden relative">
                            @if(file_exists(public_path('storage/productos/' . $producto->nombre . '.jpg')))
                                <img src="{{ asset('storage/productos/' . $producto->nombre . '.jpg') }}" 
                                     alt="{{ $producto->nombre }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <img src="{{ asset('storage/productos/imagenDefault.jpg') }}" 
                                     alt="Imagen por defecto" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @endif

                            @if($producto->categoria)
                                <span class="absolute top-2 right-2 bg-black/60 backdrop-blur-sm text-white text-xs px-2 py-1 rounded">
                                    {{ $producto->categoria }}
                                </span>
                            @endif
                        </div>

                        
                        <div class="p-4 flex-grow flex flex-col">
                            <div class="flex justify-between items-start mb-2">
                                <h2 class="text-lg font-bold text-gray-800 leading-tight">{{ $producto->nombre }}</h2>
                                <span class="text-green-600 font-bold bg-green-50 px-2 py-1 rounded text-sm whitespace-nowrap">
                                    ${{ number_format($producto->precio, 2) }}
                                </span>
                            </div>
                            
                            <p class="text-sm text-gray-500 line-clamp-2 mb-4 flex-grow" title="{{ $producto->descripcion }}">
                                {{ $producto->descripcion }}
                            </p>

                            
                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-xs text-gray-400">ID: {{ $producto->id }}</span>
                                
                                <div class="flex items-center space-x-2">
                                    
                                    <a href="{{ route('admin-view.show', ['id' => $producto->id]) }}" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>

                                    
                                    <form action="{{ route('admin.destroy', ['id' => $producto->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto? Esta acción no se puede deshacer.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 flex flex-col items-center justify-center text-center bg-white rounded-xl border border-dashed border-gray-300">
                        <div class="p-4 bg-gray-50 rounded-full mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">No hay productos registrados</h3>
                        <p class="text-gray-500 mt-1 max-w-sm">Comienza agregando platillos o bebidas a tu inventario.</p>
                        @if(auth()->user() && auth()->user()->isAdmin())
                            <a href="{{ route('admin-create-view.create') }}" class="mt-4 text-orange-600 hover:text-orange-700 font-semibold hover:underline">
                                + Crear primer producto
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </x-slot>
</x-app-layout>



























































