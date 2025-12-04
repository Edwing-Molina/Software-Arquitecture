<x-app-layout>
    <x-slot name='layoutTitle'>
        MENU
    </x-slot>

    <x-slot name='slot'>

        
            @php
                $settings = \App\Models\Settings::first();
                
                $isOpen = true; 
                $message = '';
                $timezone = 'America/Mexico_City';

                if ($settings) {
                    if ($settings->is_store_open == 0) {
                        $isOpen = false;
                        $message = 'Cerrado temporalmente por administración.';
                    } else {

                        $now = \Carbon\Carbon::now($timezone);
                        
                        
                        try {
                            
                            $start = \Carbon\Carbon::createFromFormat('H:i', substr($settings->opening_time, 0, 5), $timezone);
                            $end   = \Carbon\Carbon::createFromFormat('H:i', substr($settings->closing_time, 0, 5), $timezone);
                        } catch (\Exception $e) {
                            
                            $start = \Carbon\Carbon::parse($settings->opening_time, $timezone);
                            $end   = \Carbon\Carbon::parse($settings->closing_time, $timezone);
                        }

                        
                        if ($end->lessThan($start)) {
                            if ($now->greaterThanOrEqualTo($start)) {
                                $end->addDay();
                            } else {
                                $start->subDay();
                            }
                        }

                       
                        if (!$now->between($start, $end)) {
                            $isOpen = false;
                            $message = 'Horario: ' . $start->format('g:i A') . ' a ' . $end->format('g:i A');
                        }
                    }
                }
                
                $cart = session('cart', []);
                $cartCount = is_array($cart) ? array_sum($cart) : 0;
            @endphp

        
        <header class="bg-orange-500 text-white py-4 shadow-md sticky top-0 z-50">
            <div class="container mx-auto flex items-center justify-between px-4">
                <h1 class="text-3xl font-bold">Menú</h1>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('cart.view') }}" class="hidden md:flex bg-white text-orange-600 px-4 py-2 rounded shadow hover:shadow-md hover:bg-orange-50 transition-all duration-200 items-center font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1" />
                            <circle cx="20" cy="21" r="1" />
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                        </svg>
                        Ver carrito
                        <span id="cart-count" class="ml-2 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full animate-pulse {{ $cartCount > 0 ? '' : 'hidden' }}">
                            {{ $cartCount }}
                        </span>
                    </a>
                </div>
            </div>
        </header>

        
        @if(!$isOpen)
            <div class="fixed top-24 left-0 right-0 z-40 flex justify-center pointer-events-none">
                <div class="bg-red-600 text-white px-6 py-3 rounded-full shadow-2xl flex items-center animate-bounce pointer-events-auto border-2 border-white/20 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-bold text-sm md:text-base drop-shadow-md">
                        Cerrado. {{ $message }}
                    </span>
                </div>
            </div>
        @endif

        <div class="container mx-auto mt-12 px-4 mb-20"> 
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($productos as $producto)
                    <div class="scroll-reveal opacity-0 translate-y-8 group bg-white rounded-xl shadow-md overflow-hidden transition-all duration-700 ease-out hover:-translate-y-2 hover:shadow-xl border border-transparent hover:border-orange-300 flex flex-col h-full">
                        <div class="p-5 flex-grow">
                            <div class="h-48 bg-gray-100 rounded-lg mb-4 overflow-hidden flex items-center justify-center relative">
                                
                                @if(file_exists(public_path('storage/productos/' . $producto->nombre . '.jpg')))
                                    <img src="{{ asset('storage/productos/' . $producto->nombre . '.jpg') }}" 
                                         alt="{{ $producto->nombre }}" 
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 {{ !$isOpen ? 'grayscale opacity-70' : '' }}">
                                @else
                                    <img src="{{ asset('storage/productos/imagenDefault.jpg') }}" 
                                         alt="Imagen por defecto" 
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 {{ !$isOpen ? 'grayscale opacity-70' : '' }}">
                                @endif
                                
                                
                                @if(!$isOpen)
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/10">
                                        <div class="bg-gray-900/80 text-white text-xs px-2 py-1 rounded backdrop-blur-sm">
                                            No disponible
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <h2 class="text-xl font-bold text-gray-800 leading-tight mb-2">{{ $producto->nombre }}</h2>
                            <p class="text-green-700 font-bold text-lg">$ {{ number_format($producto->precio, 2) }}</p>
                            <p class="text-gray-600 mt-2 text-sm line-clamp-2">{{ $producto->descripcion }}</p>
                        </div>

                        <div class="p-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                            @if($isOpen)
                                <form method="POST" action="{{ route('cart.add') }}" class="ajax-cart-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $producto->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded-lg shadow-sm transition-all duration-200 active:scale-95 flex items-center">
                                        Añadir
                                    </button>
                                </form>
                            @else
                                <button disabled class="bg-gray-200 text-gray-400 text-sm font-bold py-2 px-4 rounded-lg cursor-not-allowed">
                                    Cerrado
                                </button>
                            @endif

                            <a href="{{ route('menu.show', ['id' => $producto->id]) }}" class="text-sm font-medium text-gray-500 hover:text-orange-500 transition-colors duration-200">
                                Ver detalles →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <a href="{{ route('cart.view') }}" class="fixed bottom-6 right-6 bg-orange-500 text-white rounded-full shadow-lg p-4 flex items-center space-x-2 md:hidden hover:bg-orange-600 transition-all duration-200 active:scale-95 z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1" />
                <circle cx="20" cy="21" r="1" />
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
            </svg>
            <span class="font-bold">({{ $cartCount }})</span>
        </a>
        
        <script src="{{ asset('js/scroll-reveal.js') }}"></script>
        <script src="{{ asset('js/cart.js') }}"></script>
    </x-slot>
</x-app-layout>



















































