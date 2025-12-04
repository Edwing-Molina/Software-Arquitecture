<x-app-layout>
    <x-slot name='layoutTitle'>
        Monitor de Cocina
    </x-slot>


    <x-slot name='slot'>
       
    
        <style>

            .horizontal-scroll::-webkit-scrollbar {
                height: 12px;
            }
            .horizontal-scroll::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }
            .horizontal-scroll::-webkit-scrollbar-thumb {
                background: #cbd5e1; 
                border-radius: 10px;
                border: 2px solid #f1f1f1;
            }
            .horizontal-scroll::-webkit-scrollbar-thumb:hover {
                background: #f97316; 
            }
        </style>


        <div class="min-h-screen bg-gray-100 p-4 flex flex-col">
            
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-4 flex flex-col md:flex-row md:items-center justify-between gap-4 flex-shrink-0">
                <div>
                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-500 transition-colors inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
                            Panel
                        </a>
                        <span>/</span>
                        <span class="font-medium text-gray-800">Línea de Producción</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Cola de Pedidos
                        </h1>
                        <div class="flex items-center space-x-1 bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full animate-pulse">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            <span>En vivo</span>
                        </div>
                    </div>
                </div>

                
                <div class="bg-gray-100 p-1 rounded-lg inline-flex">
                    @php $current = $filter ?? 'pending'; @endphp
                    <a href="{{ route('admin-pedidos.index', ['filter' => 'pending']) }}" class="px-4 py-2 rounded-md text-sm font-medium transition-all {{ $current=='pending' ? 'bg-white text-orange-600 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">Pendientes ({{ $pedidos->count() }})</a>
                    <a href="{{ route('admin-pedidos.index', ['filter' => 'all']) }}" class="px-4 py-2 rounded-md text-sm font-medium transition-all {{ $current=='all' ? 'bg-white text-orange-600 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">Historial</a>
                </div>
                <div class="text-right hidden md:block">
                    <div id="kitchen-clock" class="text-xl font-mono font-bold text-gray-700">00:00:00</div>
                    <div class="text-xs text-gray-400 uppercase">{{ date('l, d M') }}</div>
                </div>
            </div>


            <div class="flex-grow horizontal-scroll flex overflow-x-auto gap-6 pb-6 pt-2 px-2 snap-x snap-mandatory items-start">
                
                @forelse($pedidos as $pedido)
                   
                    <div class="flex-shrink-0 w-80 snap-start transform transition-transform duration-300 hover:scale-[1.01]">
                       
                        @if($loop->first && $current == 'pending')
                            <div class="bg-red-500 text-white text-xs font-bold text-center py-1 rounded-t-lg">
                                ¡PRIORIDAD ALTA!
                            </div>
                        @endif

                        <div class="h-full">
                            @include('pedidos._comanda_partial', ['pedido' => $pedido])
                        </div>
                    </div>
                @empty

                    <div class="w-full flex flex-col items-center justify-center pt-20 text-center opacity-60">
                        <div class="bg-white p-6 rounded-full shadow-sm mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-400">Sin pedidos en cola</h2>
                        <p class="text-gray-400">La línea de producción está libre.</p>
                    </div>
                @endforelse


                <div class="w-4 flex-shrink-0"></div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                
                setInterval(() => {
                    document.getElementById('kitchen-clock').innerText = new Date().toLocaleTimeString('es-MX', { hour12: false });
                }, 1000);

                
                @if($current == 'pending')
                    setTimeout(() => window.location.reload(), 30000);
                @endif
            });
        </script>
    </x-slot>
</x-app-layout>






























