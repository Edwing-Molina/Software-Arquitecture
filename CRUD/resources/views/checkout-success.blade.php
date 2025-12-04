<x-app-layout>
    <x-slot name='layoutTitle'>Pedido confirmado</x-slot>

    <x-slot name='slot'>
        <div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
            
            <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all hover:scale-[1.01]">
                
                <div class="bg-green-100 p-8 text-center border-b border-green-200">
                    <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-200 mb-4 animate-bounce">
                        <svg class="h-10 w-10 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-extrabold text-green-800">¡Gracias por tu compra!</h2>
                    <p class="text-green-600 mt-2 font-medium">Tu pedido ha sido recibido correctamente.</p>
                </div>

                <div class="p-8">
                    
                    <div class="text-center mb-8">
                        <p class="text-sm text-gray-500 uppercase tracking-wide font-semibold mb-2">Guarda tu folio de seguimiento</p>
                        <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg p-4 relative group cursor-pointer" title="Tu folio de pedido">
                            <span class="text-3xl font-mono font-bold text-gray-800 tracking-wider select-all">
                                {{ $order->order_referencia }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Puedes usar este código para consultar el estado.</p>
                    </div>

                    
                    <div class="bg-blue-50 rounded-lg p-4 flex items-start space-x-3 border border-blue-100 mb-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-blue-900">¿Tienes dudas o cambios?</h4>
                            <p class="text-sm text-blue-700 mt-1">Llámanos o escríbenos por WhatsApp mencionando tu folio.</p>
                            <a href="tel:9993656551" class="inline-flex items-center mt-2 text-blue-600 font-bold hover:text-blue-800 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                999-365-6551
                            </a>
                        </div>
                    </div>

                    
                    <a href="{{ route('menu') }}" class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-lg shadow-md transition-all transform hover:-translate-y-0.5 active:scale-95">
                        Volver al Menú
                    </a>
                </div>
            </div>
            
            
            <p class="text-center text-gray-400 text-xs mt-8">
                &copy; {{ date('Y') }} Comida japonesa. Gracias por tu preferencia.
            </p>
        </div>
    </x-slot>
</x-app-layout>

































































