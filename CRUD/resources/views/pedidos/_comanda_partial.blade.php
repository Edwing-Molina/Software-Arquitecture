<div class="comanda bg-white rounded-xl shadow-md border border-gray-200 h-full flex flex-col overflow-hidden relative group">
    

    <div class="bg-gray-50 p-3 border-b border-gray-200 flex justify-between items-center border-l-4 {{ $pedido->estado_produccion === 'preparacion' ? 'border-orange-500' : 'border-green-500' }}">
        <div>
            <span class="text-xs text-gray-500 uppercase tracking-wider font-bold">Folio</span>
            <h3 class="text-xl font-black text-gray-800 leading-none">#{{ substr($pedido->order_referencia, -4) }}</h3> {{-- Mostramos solo los ultimos 4 digitos para leer rapido --}}
        </div>
        <div class="text-right">
            <div class="flex items-center text-gray-600 font-mono font-bold bg-white px-2 py-1 rounded border border-gray-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                {{ $pedido->created_at->format('H:i') }}
            </div>
        </div>
    </div>


    <div class="bg-blue-50 px-3 py-2 border-b border-blue-100 flex items-center justify-between">
        <div class="flex items-center overflow-hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400 mr-1 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
            <span class="text-xs font-bold text-blue-800 truncate">{{ $pedido->nombre_cliente }}</span>
        </div>
    </div>


    <div class="flex-grow p-4 overflow-y-auto space-y-3 custom-scrollbar">
        @foreach($pedido->productos as $producto)
            <div class="flex items-start group/item">
              
                <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-black text-lg mr-3 border border-orange-200">
                    {{ $producto->pivot->cantidad }}
                </div>
                

                <div class="flex-grow pt-0.5">
                    <p class="text-gray-800 font-bold leading-tight text-sm">
                        {{ $producto->nombre ?? $producto->name ?? 'Producto Desconocido' }}
                    </p>

                </div>
            </div>
            
            
            @if(!$loop->last) <hr class="border-gray-100 border-dashed"> @endif
        @endforeach
    </div>

 
    <div class="p-3 bg-white border-t border-gray-100 mt-auto">
        @if($pedido->estado_produccion === 'preparacion')
            <form method="POST" action="{{ route('admin-pedidos.updateStatus', ['id' => $pedido->id]) }}">
                @csrf
                <input type="hidden" name="estado_produccion" value="preparado" />
                <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-xl shadow-md transition-all transform active:scale-95 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    MARCAR LISTO
                </button>
            </form>
        @else
            <div class="flex gap-2">
                <div class="flex-grow bg-gray-100 text-gray-600 text-center py-2 rounded-lg font-bold text-sm border border-gray-200 flex items-center justify-center">
                    <span class="w-2 h-2 bg-gray-400 rounded-full mr-2"></span>
                    {{ ucfirst($pedido->estado_produccion) }}
                </div>
                
                <a target="_blank" href="{{ route('admin-pedidos.comanda', ['id' => $pedido->id]) }}" class="bg-blue-100 text-blue-600 hover:bg-blue-200 p-2 rounded-lg flex items-center justify-center transition-colors" title="Imprimir Ticket">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                </a>
            </div>
        @endif
    </div>
</div>
