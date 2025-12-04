<x-app-layout>
    <x-slot name='layoutTitle'>
        Pedidos
    </x-slot>

    <x-slot name='slot'>
        <div class="container mx-auto mt-5">
            <h1 class="text-2xl font-bold mb-4">Pedidos</h1>

            <div class="mb-4 flex items-center space-x-2">
                @php $current = $filter ?? 'pending'; @endphp
                <a href="{{ route('admin-pedidos.index', ['filter' => 'pending']) }}" class="px-3 py-1 rounded {{ $current=='pending' ? 'bg-orange-500 text-white' : 'bg-gray-100' }}">Pendientes</a>
                <a href="{{ route('admin-pedidos.index', ['filter' => 'all']) }}" class="px-3 py-1 rounded {{ $current=='all' ? 'bg-orange-500 text-white' : 'bg-gray-100' }}">Todos</a>
            </div>

            <div class="flex space-x-4 overflow-x-auto py-2">
                @foreach($pedidos as $pedido)
                    <div class="flex-shrink-0 w-80">
                        @include('pedidos._comanda_partial', ['pedido' => $pedido])
                    </div>
                @endforeach
            </div>
        </div>
    </x-slot>
</x-app-layout>



















































