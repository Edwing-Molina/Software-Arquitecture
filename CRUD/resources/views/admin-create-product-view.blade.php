<x-app-layout>
    <x-slot name="layoutTitle">Crear Producto</x-slot>

    <x-slot name='slot'>
        <div class="container mx-auto mt-8 px-4 max-w-4xl mb-12">
            
            
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin-view.index') }}" class="flex items-center text-gray-500 hover:text-orange-600 transition-colors font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
                        Regresar
                    </a>
                    <h1 class="text-2xl font-bold text-gray-800 border-l pl-4 border-gray-300">Nuevo Producto</h1>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-700">Información del Producto</h2>
                    <p class="text-sm text-gray-500">Rellena los detalles para añadir al menú.</p>
                </div>

                <form action="{{ route('admin.store') }}" method="POST" class="p-6 space-y-6" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nombre del Producto <span class="text-red-500">*</span></label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Ej. Sushi de Salmón" class="w-full border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500 transition-colors" required>
                        @error('nombre') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Descripción <span class="text-gray-400 font-normal">(Ingredientes, detalles...)</span></label>
                        <textarea name="descripcion" rows="3" placeholder="Ej. Arroz, salmón fresco, alga nori..." class="w-full border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500 transition-colors" required>{{ old('descripcion') }}</textarea>
                        @error('descripcion') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Precio (MXN) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-bold">$</span>
                                </div>
                                <input type="number" step="0.01" name="precio" value="{{ old('precio') }}" placeholder="Ej. 150.00" class="pl-7 w-full border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500 transition-colors" required>
                            </div>
                            @error('precio') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Categoría <span class="text-red-500">*</span></label>
                            <input type="text" name="categoria" value="{{ old('categoria') }}" placeholder="Ej. Sushi, Entradas..." class="w-full border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500 transition-colors" required>
                            @error('categoria') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="bg-orange-50 rounded-xl p-5 border border-orange-100">
                        <label class="block text-orange-800 font-bold mb-4 text-lg">Imagen del Producto</label>
                        <p class="text-xs text-orange-600 mb-4">Elige una de las dos opciones (Subir archivo o pegar enlace).</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                            <div>
                                <span class="block text-sm font-bold text-gray-700 mb-2">Opción A: Subir archivo</span>
                                <input type="file" name="imagen" accept="image/*" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-orange-600 file:text-white
                                    hover:file:bg-orange-700
                                    cursor-pointer bg-white rounded border border-gray-200 shadow-sm
                                ">
                                @error('imagen') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-gray-700 mb-2">Opción B: URL de imagen</span>
                                <div class="flex shadow-sm rounded-md">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        http://
                                    </span>
                                    <input type="text" name="imagen_url" value="{{ old('imagen_url') }}" placeholder="Ej. ejemplo.com/sushi.jpg" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border border-gray-300 text-gray-900 focus:outline-none focus:ring-1 focus:ring-orange-500 focus:border-orange-500 sm:text-sm bg-white">
                                </div>
                                @error('imagen_url') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="flex items-center justify-end pt-4 space-x-3">
                        <a href="{{ route('admin-view.index') }}" class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 font-medium transition-colors">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transform transition-all active:scale-95 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                            Guardar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-app-layout>








































