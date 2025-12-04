<x-app-layout>
    <x-slot name="layoutTitle">Configuración General</x-slot>

    <x-slot name="slot">
        <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                
                <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-500 transition-colors inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
                                Dashboard
                            </a>
                            <span>/</span>
                            <span class="font-medium text-gray-800">Ajustes</span>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900">Configuración de Sucursal</h1>
                    </div>
                </div>

                @if(session('status'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded shadow-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        {{ session('status') }}
                    </div>
                @endif

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center">
                        <div class="p-2 bg-orange-100 text-orange-600 rounded-lg mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Parámetros Generales</h2>
                            <p class="text-sm text-gray-500">Define la disponibilidad de tu negocio.</p>
                        </div>
                    </div>

                    
                    <form method="POST" action="{{ route('admin.settings.update') }}" class="p-6 space-y-6">
                        @csrf
                        
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Horario de Atención</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                
                                <div class="relative">
                                    <label class="text-xs text-gray-500 mb-1 block">Apertura</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                        </div>
                                        <input type="time" name="opening_time" 
                                            class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500" 
                                            
                                            value="{{ old('opening_time', \Carbon\Carbon::parse($settings->opening_time ?? '09:00')->format('H:i')) }}" 
                                            required>
                                    </div>
                                    @error('opening_time') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>

                                
                                <div class="relative">
                                    <label class="text-xs text-gray-500 mb-1 block">Cierre</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                                        </div>
                                        <input type="time" name="closing_time" 
                                            class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500" 
                                            
                                            value="{{ old('closing_time', \Carbon\Carbon::parse($settings->closing_time ?? '21:00')->format('H:i')) }}" 
                                            required>
                                    </div>
                                    @error('closing_time') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        
                        <div class="flex items-center justify-between bg-orange-50 p-4 rounded-lg border border-orange-100">
                            <div>
                                <h3 class="text-sm font-bold text-gray-800">Estado de la Tienda</h3>
                                <p class="text-xs text-gray-600">Desactiva esto para detener nuevos pedidos temporalmente.</p>
                            </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="is_store_open" value="0">
                                    <input 
                                        type="checkbox" 
                                        name="is_store_open" 
                                        value="1" 
                                        class="sr-only peer"
                                        {{ old('is_store_open', $settings->is_store_open) == 1 ? 'checked' : '' }}
                                    >
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    
                                    <span class="ml-3 text-sm font-medium text-gray-900">
                                        @if($settings->is_store_open) 
                                            <span class="text-green-600 font-bold">Abierto</span>
                                        @else
                                            <span class="text-red-500 font-bold">Cerrado</span>
                                        @endif
                                    </span>
                                </label>
                        </div>
                        @error('is_store_open') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                        <div class="pt-4 flex items-center justify-end space-x-3">
                            <button type="button" onclick="window.location='{{ route('admin.dashboard') }}'" class="bg-white text-gray-700 hover:bg-gray-50 border border-gray-300 font-medium py-2 px-4 rounded-lg transition-colors">
                                Cancelar
                            </button>
                            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition-transform active:scale-95 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>






















