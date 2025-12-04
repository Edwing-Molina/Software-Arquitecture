<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//modelo de ordenes
class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'pedidos';

    protected $fillable = [
        'nombre_cliente',
        'telefono_cliente',
        'direccion_cliente_escrita',
        'direccion_cliente_ubicacion',
        'order_referencia',
        'total',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'estado_pago',
        'estado_produccion',
    ];

    public function productos()
    {
        return $this->belongsToMany(Product::class, 'pedido_producto')
                    ->withPivot('cantidad', 'precio_unitario');
    }

    public function calcularTotal(): float{
        return $this->productos->sum(function ($producto) {
            return $producto->pivot->cantidad * $producto->pivot->precio_unitario;
        });
    }

    public function subtotal(): float
    {
        return $this->calcularTotal();
    }

    public function shipping(): float
    {
        return (float) ($this->shipping ?? 0.0);
    }

    public function totalAmount(): float
    {
        if ($this->total !== null) {
            return (float) $this->total;
        }

        return $this->subtotal() + $this->shipping();
    }

    public function computeChange(float $efectivoRecibido): float
    {
        $change = $efectivoRecibido - $this->totalAmount();
        return $change >= 0 ? round($change, 2) : 0.0;
    }

    public function recordPayment(float $efectivoRecibido): void
    {
        $change = $this->computeChange($efectivoRecibido);

        $this->efectivo_recibido = $efectivoRecibido;
        $this->cambio_entregado = $change;
        $this->estado_pago = 'pagado';
        $this->save();
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'update_at' => 'datetime'
        ];
    }
}
