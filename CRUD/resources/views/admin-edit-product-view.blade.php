<x-app-layout>
    <x-slot name="layoutTitle">Editar Producto</x-slot>

    <x-slot name='slot'>
        <div class="container mx-auto mt-6 max-w-2xl">
            <div class="bg-white shadow-md rounded px-6 py-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Editar producto</h2>
                    <a href="{{ route('admin-view.index') }}" class="text-sm text-gray-600 hover:underline">← Volver a productos</a>
                </div>

                @if($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-100 p-3 rounded">
                        <ul class="text-sm text-red-700 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.update', ['id' => $producto->id]) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nombre_input" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input id="nombre_input" type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>

                    <div>
                        <label for="descripcion_input" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <input id="descripcion_input" type="text" name="descripcion" value="{{ old('descripcion', $producto->descripcion) }}" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                    </div>

                    <div>
                        <label for="precio_input" class="block text-sm font-medium text-gray-700">Precio (MXN)</label>
                        <input id="precio_input" type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" class="mt-1 block w-48 border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>

                    <div>
                        <label for="categoria_input" class="block text-sm font-medium text-gray-700">Categoría</label>
                        <input id="categoria_input" type="text" name="categoria" value="{{ old('categoria', $producto->categoria) }}" class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>

                    <hr class="border-gray-200 my-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Imagen del Producto</label>
                        
                        @if($producto->imagen)
                            <div class="mb-4 p-2 border rounded bg-gray-50 inline-block">
                                <p class="text-xs text-gray-500 mb-1">Imagen Actual:</p>
                                @if(Str::startsWith($producto->imagen, 'http'))
                                    <img src="{{ $producto->imagen }}" alt="Actual" class="h-32 w-auto object-cover rounded">
                                @else
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Actual" class="h-32 w-auto object-cover rounded">
                                @endif
                            </div>
                        @else
                            <div class="mb-4 p-2 bg-gray-100 rounded inline-block text-sm text-gray-500">Sin imagen asignada</div>
                        @endif

                        <div class="grid grid-cols-1 gap-4">
                            <div class="bg-blue-50 p-3 rounded border border-blue-100">
                                <label class="block text-xs font-bold text-gray-700 mb-1">Cambiar imagen (Subir archivo):</label>
                                <input type="file" name="imagen" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600">
                            </div>

                            <div class="text-center text-gray-400 text-xs font-bold">- O -</div>

                            <div class="bg-gray-50 p-3 rounded border border-gray-200">
                                <label class="block text-xs font-bold text-gray-700 mb-1">Cambiar imagen (Pegar URL):</label>
                                <input type="text" name="imagen_url" 
                                    value="{{ old('imagen_url', Str::startsWith($producto->imagen, 'http') ? $producto->imagen : '') }}" 
                                    placeholder="https://..." 
                                    class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 mt-6 pt-4 border-t">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Actualizar producto</button>
                        <a href="{{ route('admin-view.index') }}" class="text-sm text-gray-600 hover:underline">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-app-layout>







































