<x-app-layout>
    <x-slot name='layoutTitle'>Carrito</x-slot>

    <x-slot name='slot'>

        
        <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-30">
            <div class="container mx-auto py-4 px-4 flex items-center">
                <a href="{{ route('menu') }}" class="text-gray-400 hover:text-orange-500 transition-colors mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Tu Carrito de Compras</h1>
            </div>
        </header>

        <div class="container mx-auto mt-8 px-4 pb-12">

            
            @if(session('status'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex items-center animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                    {{ session('status') }}
                </div>
            @endif

            @if(empty($cart) || count($cart) === 0)
                
                <div class="flex flex-col items-center justify-center bg-white p-12 rounded-2xl shadow-sm border border-gray-100 text-center">
                    <div class="bg-orange-50 p-6 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Tu carrito está vacío</h2>
                    <p class="text-gray-500 mb-8 max-w-sm">Parece que aún no has añadido nada delicioso a tu pedido. ¡Explora nuestro menú!</p>
                    <a href="{{ route('menu') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        Ir al Menú
                    </a>
                </div>
            @else
                @php $subtotal = 0; @endphp
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                  
                    <div class="lg:col-span-2 space-y-4">
                        @foreach($cart as $pid => $qty)
                            @php $p = $products->get($pid); @endphp
                            @if($p)
                                @php $line = $p->precio * $qty; $subtotal += $line; @endphp
                                
                                
                                <div class="group bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex flex-col sm:flex-row items-center transition-all hover:shadow-md">
                                    
                                    
                                    <div class="w-full sm:w-32 h-32 flex-shrink-0 bg-gray-50 rounded-lg overflow-hidden relative">
                                        <img src="{{ $p->imagen ? (Str::startsWith($p->imagen, 'http') ? $p->imagen : asset('storage/' . $p->imagen)) : asset('storage/productos/imagenDefault.jpg') }}" 
                                             alt="{{ $p->nombre }}" 
                                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    </div>

                                    
                                    <div class="mt-4 sm:mt-0 sm:ml-6 flex-grow text-center sm:text-left">
                                        <h3 class="text-lg font-bold text-gray-800">{{ $p->nombre }}</h3>
                                        <p class="text-sm text-gray-500 line-clamp-1">{{ $p->descripcion }}</p>
                                        
                                        <div class="mt-2 flex items-center justify-center sm:justify-start space-x-2 text-sm text-gray-600">
                                            <span class="bg-gray-100 px-2 py-1 rounded text-xs font-semibold">Precio unitario: ${{ number_format($p->precio,2) }}</span>
                                        </div>
                                    </div>

                                    
                                    <div class="mt-4 sm:mt-0 flex flex-col items-center sm:items-end space-y-3 sm:ml-4 min-w-[120px]">
                                        
                                        
                                        <span class="text-xl font-bold text-orange-600">${{ number_format($line,2) }}</span>
                                        
                                        
                                        <div class="flex items-center text-sm font-medium text-gray-700 bg-gray-50 px-3 py-1 rounded-full border border-gray-200">
                                            <span>Cant: {{ $qty }}</span>
                                        </div>

                                        
                                        <form method="POST" action="{{ route('cart.remove') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $p->id }}">
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors duration-200 flex items-center text-xs group/btn" title="Eliminar del carrito">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 group-hover/btn:animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span class="underline decoration-transparent hover:decoration-red-500 transition-all">Eliminar</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 sticky top-24">
                            <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-2">Resumen del pedido</h3>
                            
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($subtotal,2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Envío estimado</span>
                                    <span class="text-green-600 font-semibold">Gratis</span>
                                </div>
                            </div>

                            <div class="border-t border-dashed border-gray-300 my-4 pt-4">
                                <div class="flex justify-between items-end">
                                    <span class="text-gray-800 font-bold">Total</span>
                                    <span class="text-3xl font-bold text-gray-900">${{ number_format($subtotal ,2) }}</span>
                                </div>
                                <p class="text-xs text-gray-400 text-right mt-1">Impuestos incluidos</p>
                            </div>

                            <div class="mt-6 space-y-3">
                                <a href="{{ route('checkout.form') }}" class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 active:scale-95">
                                    Proceder al Pago
                                </a>
                                
                                <a href="{{ route('menu') }}" class="block w-full text-center text-gray-500 hover:text-orange-500 font-medium text-sm py-2 hover:underline transition-colors">
                                    ← Seguir comprando
                                </a>
                            </div>

                            
                            <div class="mt-6 flex items-center justify-center space-x-2 text-xs text-gray-400 opacity-70">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                <span>Pago seguro SSL</span>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </x-slot>
</x-app-layout>































































