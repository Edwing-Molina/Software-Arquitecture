<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedido #{{ $pedido->order_referencia }}</title>
    <style>
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #333;
        }

        
        .actions-panel {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            width: 100%;
            max-width: 320px;
            display: flex;
            flex-col: column;
            gap: 10px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            border: none;
            box-sizing: border-box;
        }

        .btn-back { background-color: #e5e7eb; color: #374151; }
        .btn-back:hover { background-color: #d1d5db; }

        .btn-print { background-color: #3b82f6; color: white; margin-top: 5px; }
        .btn-print:hover { background-color: #2563eb; }

        .btn-update { background-color: #10b981; color: white; margin-top: 5px; }
        .btn-update:hover { background-color: #059669; }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border-radius: 4px;
            border: 1px solid #d1d5db;
        }

        label { font-size: 12px; color: #6b7280; font-weight: bold; }

        
        .ticket {
            width: 300px; 
            background: #fff;
            padding: 15px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            font-family: 'Courier New', Courier, monospace; 
            font-size: 12px;
            line-height: 1.4;
        }

        .ticket-header { text-align: center; margin-bottom: 15px; }
        .ticket-header h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .ticket-header p { margin: 2px 0; color: #555; }

        .divider { border-top: 1px dashed #000; margin: 10px 0; }
        .divider-solid { border-top: 2px solid #000; margin: 10px 0; }

        .info-group { margin-bottom: 8px; }
        .label { font-weight: bold; display: inline-block; width: 60px; }

        .items-table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        .items-table th { text-align: left; border-bottom: 1px solid #000; padding-bottom: 4px; }
        .items-table td { padding: 4px 0; vertical-align: top; }
        .qty { width: 30px; text-align: center; font-weight: bold; }
        .desc { padding-left: 5px; }
        .price { text-align: right; white-space: nowrap; }

        .totals { margin-top: 10px; text-align: right; font-size: 14px; }
        .total-row { font-weight: bold; font-size: 16px; margin-top: 5px; }

        .footer { text-align: center; margin-top: 20px; font-size: 10px; color: #777; }

        @media print {
            body { 
                background: none; 
                padding: 0; 
                display: block; 
            }
            .no-print, .actions-panel { 
                display: none !important; 
            }
            .ticket {
                box-shadow: none;
                width: 100%;
                margin: 0;
                padding: 0;
                border: none;
            }
        }
    </style>
</head>
<body>

    <div class="actions-panel no-print">
        <a href="{{ route('admin-pedidos.index') }}" onclick="if(history.length > 1){ history.back(); return false; }" class="btn btn-back">← Volver al Panel</a>
        
        <hr style="border:0; border-top:1px solid #eee; margin:10px 0;">

        <form method="POST" action="{{ url("/admin/pedidos/{$pedido->id}/status") }}">
            @csrf
            <label for="estado">Actualizar Estado:</label>
            <select id="estado" name="estado_produccion">
                <option value="preparacion" {{ $pedido->estado_produccion=='preparacion'?'selected':'' }}>Preparación</option>
                <option value="preparado" {{ $pedido->estado_produccion=='preparado'?'selected':'' }}>Preparado</option>
                <option value="enviado" {{ $pedido->estado_produccion=='enviado'?'selected':'' }}>Enviado</option>
                <option value="entregado" {{ $pedido->estado_produccion=='entregado'?'selected':'' }}>Entregado</option>
                <option value="cancelado" {{ $pedido->estado_produccion=='cancelado'?'selected':'' }}>Cancelado</option>
            </select>
            <button type="submit" class="btn btn-update">Guardar Cambio</button>
        </form>

        <button onclick="window.print()" class="btn btn-print">🖨️ Imprimir Ticket</button>
    </div>

    <div class="ticket">
        
        <div class="ticket-header">
            <h2>TU NEGOCIO</h2>
            <p>Ticket de Venta</p>
            <p>{{ date('d/m/Y H:i') }}</p>
        </div>

        <div class="divider"></div>

        <div class="info-group">
            <div><strong>FOLIO: #{{ $pedido->order_referencia }}</strong></div>
        </div>

        <div class="info-group">
            <div style="font-weight:bold; margin-bottom:2px">CLIENTE:</div>
            <div>{{ $pedido->nombre_cliente }}</div>
            <div>{{ $pedido->telefono_cliente }}</div>
            @if($pedido->direccion_cliente_escrita)
            <div style="margin-top:2px; font-size:11px">Dir: {{ $pedido->direccion_cliente_escrita }}</div>
            @endif
        </div>

        <div class="divider-solid"></div>

        <table class="items-table">
            <thead>
                <tr>
                    <th class="qty">Cant</th>
                    <th class="desc">Producto</th>
                    <th class="price">Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->productos as $producto)
                <tr>
                    <td class="qty">{{ $producto->pivot->cantidad }}</td>
                    <td class="desc">
                        {{ $producto->nombre ?? $producto->name ?? 'Producto' }}
                        <div style="font-size:10px; color:#666">@ ${{ number_format($producto->pivot->precio_unitario, 2) }}</div>
                    </td>
                    <td class="price">${{ number_format($producto->pivot->cantidad * $producto->pivot->precio_unitario, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="divider"></div>

        <div class="totals">
            <div>Subtotal: ${{ number_format($pedido->calcularTotal(), 2) }}</div>
            <div class="total-row">TOTAL: ${{ number_format($pedido->calcularTotal(), 2) }}</div>
        </div>

        <div class="divider"></div>

        <div class="footer">
            <p>¡GRACIAS POR SU COMPRA!</p>
            <p>www.Haiku.com</p>
        </div>

    </div>

</body>
</html>
