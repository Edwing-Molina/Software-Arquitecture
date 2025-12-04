<x-app-layout>
    <x-slot name="layoutTitle">Historial de Pedidos</x-slot>

    <x-slot name="slot">
        <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                
                
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                    <div>
                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-500 transition-colors inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
                                Dashboard
                            </a>
                            <span>/</span>
                            <span class="font-medium text-gray-800">Historial</span>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900">Registro de Ventas</h1>
                    </div>
                        <form method="GET" action="{{ route('admin-pedidos.search') }}">  
                            <div class="relative w-full md:w-64">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </span>
                                
                                <input 
                                    type="text" 
                                    name="search" 
                                    value="{{ request('search') }}" 
                                    placeholder="Buscar por folio o cliente..." 
                                    class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500 text-sm"
                                >
                            </div>
                        </form>
                </div>

                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Folio</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Cliente</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Estado Pago</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($pedidos as $pedido)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-mono text-sm font-bold text-gray-700">
                                                #{{ substr($pedido->order_referencia ?? $pedido->id, -6) }}
                                            </span>
                                        </td>

                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $pedido->nombre_cliente }}</div>
                                            @if($pedido->telefono_cliente)
                                                <div class="text-xs text-gray-500">{{ $pedido->telefono_cliente }}</div>
                                            @endif
                                        </td>

                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $pedido->created_at->format('d M, Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $pedido->created_at->format('H:i A') }}</div>
                                        </td>

                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusClasses = match(strtolower($pedido->estado_pago)) {
                                                    'pagado' => 'bg-green-100 text-green-800 border-green-200',
                                                    'pendiente' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                    'cancelado' => 'bg-red-100 text-red-800 border-red-200',
                                                    default => 'bg-gray-100 text-gray-800 border-gray-200'
                                                };
                                            @endphp
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border {{ $statusClasses }}">
                                                {{ ucfirst($pedido->estado_pago) }}
                                            </span>
                                        </td>

                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="text-sm font-bold text-orange-600">
                                                ${{ number_format($pedido->total, 2) }}
                                            </div>
                                        </td>

                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">   
                                            <a href="{{ route('admin-pedidos.comanda', ['id' => $pedido->id]) }}" class="inline-flex items-center justify-center p-2 text-gray-600 hover:text-orange-600 hover:bg-orange-50 rounded-full transition-colors" title="Imprimir Ticket">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="bg-gray-100 p-4 rounded-full mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                    </svg>
                                                </div>
                                                <p class="text-gray-500 font-medium">No hay pedidos registrados aún.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    
                    @if(method_exists($pedidos, 'links'))
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $pedidos->links() }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </x-slot>
</x-app-layout>





























