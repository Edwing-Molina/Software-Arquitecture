<?php

namespace App\Http\Controllers;

use App\Http\Resources\PedidoResource;
use App\Http\Resources\ProductoResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPedidosController extends Controller
{
    // Mostrar pedidos pendientes o todos los pedidos según el filtro
    public function index(Request $request){
        $filter = $request->input('filter', 'pending');

        $query = Order::with('productos')->orderBy('created_at', 'asc');

        if ($filter === 'pending') {
            $query->where('estado_produccion', 'preparacion');
        }

        $pedidos = $query->get();

        return view('admin-cocina', ['pedidos' => $pedidos, 'filter' => $filter]);
    }

    // Buscar pedidos por folio (order_referencia) o nombre del cliente
    public function search(Request $request){
        $textoBusqueda = $request->input('search');

        $pedidos = Order::with('productos')
            ->where(function($query) use ($textoBusqueda) {
                if ($textoBusqueda) {
                    $query->where('order_referencia', 'like', "%{$textoBusqueda}%")
                        ->orWhere('nombre_cliente', 'like', "%{$textoBusqueda}%");
                }
            })
            ->orderBy('created_at', 'desc')
            ->get(); 

        return view('admin.pedidos-history', [
            'pedidos' => $pedidos, 
            'search' => $textoBusqueda 
        ]);
    }

    // Mostrar un pedido como comanda (ticket)
    public function comanda($id)
    {
        $pedido = Order::with('productos')->findOrFail($id);

        return view('pedidos.comanda', ['pedido' => $pedido]);
    }

    // Actualizar el estado de producción de un pedido
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'estado_produccion' => 'required|string|in:preparacion,preparado,enviado,entregado,cancelado,finalizado',
        ]);

        $pedido = Order::findOrFail($id);
        $pedido->estado_produccion = $request->input('estado_produccion');
        $pedido->save();

        return redirect()->back()->with('status', 'Estado de producción actualizado');
    }

    // Actualizar el estado de pago de un pedido
    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'estado_pago' => 'required|string|in:por pagar,pagado',
        ]);

        $pedido = Order::findOrFail($id);
        $pedido->estado_pago = $request->input('estado_pago');
        $pedido->save();

        return redirect()->back()->with('status', 'Estado de pago actualizado');
    }

    // Actualizar las cantidades recibidas de los productos en un pedido (tabla pivote)
    public function updateReceived(Request $request, $id)
    {
        $pedido = Order::with('productos')->findOrFail($id);

        $data = $request->input('received', []); 

        DB::transaction(function () use ($pedido, $data) {
            foreach ($data as $productId => $cantidadRecibida) {
                $cantidadRecibida = (int) $cantidadRecibida;
                
                $pedido->productos()->updateExistingPivot($productId, ['cantidad_recibida' => $cantidadRecibida]);
            }
        });

        return redirect()->back()->with('status', 'Cantidades recibidas actualizadas');
    }

    // Mostrar el historial de pedidos
    public function history()
    {
        $pedidos = Order::orderBy('created_at', 'desc')->get();

        return view('admin.pedidos-history', ['pedidos' => $pedidos]);
    }
}