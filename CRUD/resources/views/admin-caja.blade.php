<x-app-layout>
    <x-slot name='layoutTitle'>
        Caja y Cobranza
    </x-slot>

    
    <x-slot name='slot'>
        <div class="min-h-screen bg-gray-50 pb-12">
            
            
            <div class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-20">
                <div class="container mx-auto px-4 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        
                        <a href="{{ route('admin.dashboard') }}" class="p-2 rounded-full hover:bg-orange-100 hover:text-orange-600 text-gray-500 transition-colors" title="Volver al Dashboard">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Terminal de Caja</h1>
                            <p class="text-xs text-gray-500">Gestión de pagos y entregas</p>
                        </div>
                    </div>
                    
                    <div class="hidden md:flex items-center gap-6 text-sm">
                        <div class="text-right">
                            <span class="block text-gray-500 text-xs uppercase font-bold">Por cobrar</span>
                            <span class="block font-bold text-orange-600 text-lg">{{ $pedidos->where('estado_pago', '!=', 'pagado')->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container mx-auto mt-8 px-4">
                @if($pedidos->isEmpty())
                    
                    <div class="flex flex-col items-center justify-center py-20 text-center opacity-60">
                        <div class="bg-white p-6 rounded-full shadow-sm mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-400">Sin movimientos en caja</h2>
                        <p class="text-gray-400">No hay pedidos pendientes de cobro o entrega.</p>
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($pedidos as $pedido)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                                <div class="flex flex-col lg:flex-row">
                                    
                                    
                                    <div class="lg:w-1/3 p-6 border-b lg:border-b-0 lg:border-r border-gray-100 bg-gray-50">
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Folio</span>
                                                <h3 class="text-xl font-black text-gray-800">#{{ substr($pedido->order_referencia, -4) }}</h3>
                                            </div>
                                            
                                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $pedido->estado_produccion === 'entregado' ? 'bg-orange-100 text-orange-700' : 'bg-gray-100 text-gray-600' }}">
                                                {{ ucfirst($pedido->estado_produccion) }}
                                            </span>
                                        </div>

                                        <div class="space-y-2 mb-6">
                                            <div class="flex items-center text-sm text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                <span class="font-semibold mr-1">Cliente:</span> {{ $pedido->nombre_cliente }}
                                            </div>
                                            @if($pedido->telefono_cliente)
                                                <div class="flex items-center text-sm text-gray-600 ml-6">
                                                    {{ $pedido->telefono_cliente }}
                                                </div>
                                            @endif
                                            <div class="flex items-center text-sm text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                                <span class="truncate">{{ $pedido->direccion_cliente_escrita ?? 'Sin dirección' }}</span>
                                            </div>
                                        </div>

                                        <div class="pt-4 border-t border-gray-200">
                                            <div class="flex justify-between items-end">
                                                <span class="text-sm text-gray-500">Total a Pagar</span>
                                                
                                                <span class="text-2xl font-bold text-orange-600">${{ number_format($pedido->totalAmount(), 2) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="lg:w-1/3 p-6 border-b lg:border-b-0 lg:border-r border-gray-100">
                                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Detalle de Consumo</h4>
                                        <ul class="space-y-3">
                                            @foreach($pedido->productos as $producto)
                                                <li class="flex justify-between text-sm group">
                                                    <div class="flex items-start">
                                                        
                                                        <span class="font-bold text-gray-800 w-6 group-hover:text-orange-500 transition-colors">{{ $producto->pivot->cantidad }}x</span>
                                                        <span class="text-gray-600 group-hover:text-gray-900">{{ $producto->nombre ?? $producto->name }}</span>
                                                    </div>
                                                    <span class="text-gray-400">${{ number_format($producto->pivot->cantidad * $producto->pivot->precio_unitario, 2) }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
   
                                    <div class="lg:w-1/3 p-6 flex flex-col justify-center bg-white">
                                        
                                        @if($pedido->estado_produccion === 'preparado')
                                            
                                            <div class="text-center space-y-4">
                                                <div class="inline-flex items-center justify-center p-3 bg-orange-100 text-orange-600 rounded-full mb-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                </div>
                                                <h3 class="text-lg font-bold text-gray-800">Pedido Listo en Cocina</h3>
                                                <p class="text-sm text-gray-500">¿Deseas marcarlo como enviado?</p>
                                                <form method="POST" action="{{ route('admin-pedidos.updateStatus', ['id' => $pedido->id]) }}">
                                                    @csrf
                                                    <input type="hidden" name="estado_produccion" value="enviado" />
                                                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-xl shadow-md transition-transform active:scale-95">
                                                        Marcar Enviado
                                                    </button>
                                                </form>
                                            </div>

                                        @elseif($pedido->estado_produccion === 'enviado')
                                            
                                            <div class="text-center space-y-4">
                                                <div class="inline-flex items-center justify-center p-3 bg-orange-50 text-orange-600 rounded-full mb-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                                </div>
                                                <h3 class="text-lg font-bold text-gray-800">En Ruta de Entrega</h3>
                                                <p class="text-sm text-gray-500">Confirma cuando el cliente reciba el pedido.</p>
                                                <form method="POST" action="{{ route('admin-pedidos.updateStatus', ['id' => $pedido->id]) }}">
                                                    @csrf
                                                    <input type="hidden" name="estado_produccion" value="entregado" />
                                                    <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-4 rounded-xl shadow-md transition-transform active:scale-95">
                                                        Confirmar Entrega
                                                    </button>
                                                </form>
                                            </div>

                                        @elseif($pedido->estado_produccion === 'entregado')
                                            
                                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                                <h3 class="font-bold text-gray-800 mb-3 flex items-center">
                                                    
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                                    Registrar Cobro
                                                </h3>

                                                <form method="POST" action="{{ route('admin-caja.subtotalize', ['id' => $pedido->id]) }}" class="mb-4">
                                                    @csrf
                                                        <label class="block text-xs font-bold text-gray-500 mb-1">Efectivo Recibido:</label>
                                                                <div class="flex gap-2 items-center"> 
                                                                    <div class="relative flex-grow">
                                                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                                            <span class="text-gray-500 font-bold">$</span>
                                                                        </div>
                                                                        <input type="number" step="0.01" 
                                                                            name="efectivo_recibido" 
                                                                            class="pl-7 w-full h-10 border-gray-300 rounded-lg focus:ring-orange-500 focus:border-orange-500 text-sm" 
                                                                            placeholder="0.00" 
                                                                            required>
                                                                    </div>
                                                                    <button type="submit" class="h-10 bg-gray-800 hover:bg-gray-900 text-white px-4 rounded-lg text-sm font-bold shadow-sm whitespace-nowrap transition-colors">
                                                                        Calcular
                                                                    </button>
                                                                </div>
                                                </form>

                                                @php $subtotalized = session('subtotalized_'.$pedido->id); @endphp
                                                
                                                @if($subtotalized)
                                                    <div class="mt-4 pt-4 border-t border-gray-200">
                                                        <div class="flex justify-between items-center mb-2 text-sm">
                                                            <span class="text-gray-600">Recibido:</span>
                                                            <span class="font-bold">${{ number_format($subtotalized['efectivo'], 2) }}</span>
                                                        </div>
                                                        
                                                        @if(isset($subtotalized['enough']) && $subtotalized['enough'])
                                                            
                                                            <div class="flex justify-between items-center mb-4 text-lg text-orange-800 bg-orange-100 p-2 rounded-lg border border-orange-200">
                                                                <span class="font-bold">Cambio:</span>
                                                                <span class="font-black">${{ number_format($subtotalized['change'], 2) }}</span>
                                                            </div>
                                                            
                                                            <form method="POST" action="{{ route('admin-caja.processPayment', ['id' => $pedido->id]) }}">
                                                                @csrf
                                                                <input type="hidden" name="efectivo_recibido" value="{{ $subtotalized['efectivo'] }}" />
                                                                
                                                                <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition-transform active:scale-95 flex items-center justify-center">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                                    Finalizar Venta
                                                                </button>
                                                            </form>
                                                        @else
                                                            
                                                            <div class="text-center p-2 bg-red-50 text-red-600 rounded-lg text-sm font-bold border border-red-100 mb-2">
                                                                Faltan: ${{ number_format($subtotalized['short'] ?? 0, 2) }}
                                                            </div>
                                                            <button disabled class="w-full bg-gray-300 text-white font-bold py-2 px-4 rounded-lg cursor-not-allowed text-sm">
                                                                Monto insuficiente
                                                            </button>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="p-4 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                                        <span class="text-xs text-gray-400">Ingresa el monto para calcular cambio</span>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <div class="h-full flex flex-col items-center justify-center text-gray-400 opacity-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                <span class="text-sm font-medium">En espera de actualización</span>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </x-slot>
</x-app-layout>






























