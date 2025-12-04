<!DOCTYPE html>
<html>
<head>
    <title>Reporte</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .total-row { text-align: center; font-weight: bold; background-color: #f9f9f9; }
    </style>
</head>
<body>

    <div class="header">
        <h1>{{ $titulo }}</h1>
        <p>Fecha de emisión: {{ $fecha }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Estado del Pago</th>
                <th>Servicio</th>
                <th>Venta</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $index)
                <tr>
                    <td>{{ $index->nombre_cliente }}</td>
                    <td>{{ $index->estado_pago }}</td>
                    <td>Domicilio</td>
                    <td>{{ $index->total }}</td>
                    </tr>
            @endforeach
            
            <tr>
                <td colspan="3" class="total-row">Total de las ventas:</td>
                <td class="total-row">{{ $ventas->sum('total') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>































