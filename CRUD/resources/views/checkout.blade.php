<x-app-layout>
    <x-slot name='layoutTitle'>Finalizar Compra</x-slot>

    <x-slot name='slot'>
        
        
        <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-30">
            <div class="container mx-auto py-4 px-4 flex items-center">
                <a href="{{ route('cart.view') }}" class="text-gray-400 hover:text-orange-500 transition-colors mr-4 flex items-center text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Volver al carrito
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Finalizar Compra</h1>
            </div>
        </header>

        <div class="container mx-auto mt-8 px-4 pb-12">
            <form method="POST" action="{{ route('checkout.confirm') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @csrf

                
                <div class="lg:col-span-2 space-y-6">
                    
                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center">
                            <div class="bg-orange-100 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <h2 class="text-lg font-bold text-gray-800">Información de Contacto y Envío</h2>
                        </div>

                        <div class="p-6 space-y-5">
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </div>
                                    <input type="text" name="nombre_cliente" value="{{ old('nombre_cliente') }}" class="pl-10 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="Ej. Juan Pérez" required>
                                </div>
                                @error('nombre_cliente') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono de contacto</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                    </div>
                                    <input type="tel" name="telefono_cliente" value="{{ old('telefono_cliente') }}" class="pl-10 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="Ej. 999 123 4567" required>
                                </div>
                                @error('telefono_cliente') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Dirección de entrega <span class="text-gray-400 font-normal"></span></label>
                                <div class="relative">
                                    <div class="absolute top-3 left-3 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    </div>
                                    <textarea name="direccion_cliente_escrita" rows="3" class="pl-10 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="Calle, número, cruzamientos y referencias...">{{ old('direccion_cliente_escrita') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="block lg:hidden">
                        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition-all transform active:scale-95 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                            Confirmar Pedido
                        </button>
                    </div>

                </div>

                
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Resumen de tu pedido</h3>
                        
                        <div class="max-h-80 overflow-y-auto pr-2 space-y-4 mb-6 custom-scrollbar">
                            @php $subtotal = 0; @endphp
                            @foreach($cart as $pid => $qty)
                                @php $p = $products->get($pid); @endphp
                                @if($p)
                                    @php $line = $p->precio * $qty; $subtotal += $line; @endphp
                                    <div class="flex items-start space-x-3">
                                        
                                        <div class="h-12 w-12 flex-shrink-0 bg-gray-50 rounded overflow-hidden border border-gray-200">
                                            <img src="{{ $p->imagen ? (Str::startsWith($p->imagen, 'http') ? $p->imagen : asset('storage/' . $p->imagen)) : asset('storage/productos/imagenDefault.jpg') }}" alt="" class="w-full h-full object-cover">
                                        </div>
                                        
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-800 truncate">{{ $p->nombre }}</p>
                                            <p class="text-xs text-gray-500">Cant: {{ $qty }} x ${{ number_format($p->precio, 0) }}</p>
                                        </div>
                                        <div class="font-semibold text-sm text-gray-700">
                                            ${{ number_format($line, 2) }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        
                        <div class="border-t border-dashed border-gray-200 pt-4 space-y-2">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Subtotal</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Envío</span>
                                <span class="text-green-600 font-semibold">Gratis</span>
                            </div>
                            <div class="flex justify-between items-center pt-2 text-xl font-bold text-gray-900">
                                <span>Total a pagar</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                        </div>

                        
                        <div class="hidden lg:block mt-6">
                            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                                Confirmar Pedido
                            </button>
                            <p class="text-xs text-center text-gray-400 mt-3 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                Tus datos están protegidos
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-slot>
</x-app-layout>

























































