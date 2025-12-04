<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//modelo de ordenes

/**
 * Class Order
 *
 * Modelo que representa un pedido realizado por un cliente.
 * Contiene la lógica de negocio para calcular totales, gestionar pagos
 * y mantener la relación con los productos del pedido.
 *
 * @package App\Models
 *
 * @property int $id Identificador único del pedido
 * @property string $nombre_cliente Nombre del cliente que realiza el pedido
 * @property string|null $telefono_cliente Teléfono de contacto del cliente
 * @property string|null $direccion_cliente_escrita Dirección escrita del cliente
 * @property array|null $direccion_cliente_ubicacion Coordenadas de ubicación del cliente
 * @property string|null $order_referencia Referencia única del pedido
 * @property float|null $total Monto total del pedido
 * @property float|null $shipping Costo de envío
 * @property float|null $efectivo_recibido Monto en efectivo recibido del cliente
 * @property float|null $cambio_entregado Cambio devuelto al cliente
 * @property string|null $estado_pago Estado del pago (pendiente, pagado, etc.)
 * @property string|null $estado_produccion Estado de producción del pedido
 * @property \Illuminate\Support\Carbon|null $created_at Fecha de creación del pedido
 * @property \Illuminate\Support\Carbon|null $updated_at Fecha de última actualización
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $productos Productos incluidos en el pedido
 */
class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'pedidos';

    /**
     * @var string[]
     */
    protected $fillable = [
        'nombre_cliente',
        'telefono_cliente',
        'direccion_cliente_escrita',
        'direccion_cliente_ubicacion',
        'order_referencia',
        'total',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'estado_pago',
        'estado_produccion',
    ];

    /**
     * Obtiene la relación muchos a muchos con los productos del pedido.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productos()
    {
        return $this->belongsToMany(Product::class, 'pedido_producto')
                    ->withPivot('cantidad', 'precio_unitario');
    }

    /**
     * Calcula el total del pedido sumando el precio de todos los productos.
     *
     * @return float Total calculado del pedido
     */
    public function calcularTotal(): float{
        return $this->productos->sum(function ($producto) {
            return $producto->pivot->cantidad * $producto->pivot->precio_unitario;
        });
    }

    /**
     * Obtiene el subtotal del pedido (alias de calcularTotal).
     *
     * @return float Subtotal del pedido
     */
    public function subtotal(): float
    {
        return $this->calcularTotal();
    }

    /**
     * Obtiene el costo de envío del pedido.
     *
     * @return float Costo de envío, 0.0 si no está definido
     */
    public function shipping(): float
    {
        return (float) ($this->shipping ?? 0.0);
    }

    /**
     * Calcula el monto total del pedido incluyendo envío.
     * Si existe un total preestablecido, lo retorna; de lo contrario,
     * suma el subtotal y el costo de envío.
     *
     * @return float Monto total del pedido
     */
    public function totalAmount(): float
    {
        if ($this->total !== null) {
            return (float) $this->total;
        }

        return $this->subtotal() + $this->shipping();
    }

    /**
     * Calcula el cambio a devolver al cliente.
     *
     * @param float $efectivoRecibido Monto en efectivo recibido del cliente
     * @return float Cambio a devolver (0.0 si el efectivo es insuficiente)
     */
    public function computeChange(float $efectivoRecibido): float
    {
        $change = $efectivoRecibido - $this->totalAmount();
        return $change >= 0 ? round($change, 2) : 0.0;
    }

    /**
     * Registra el pago del pedido actualizando los campos relacionados.
     * Calcula automáticamente el cambio y actualiza el estado del pago.
     *
     * @param float $efectivoRecibido Monto en efectivo recibido del cliente
     * @return void
     */
    public function recordPayment(float $efectivoRecibido): void
    {
        $change = $this->computeChange($efectivoRecibido);

        $this->efectivo_recibido = $efectivoRecibido;
        $this->cambio_entregado = $change;
        $this->estado_pago = 'pagado';
        $this->save();
    }

    /**
     * Define los casteos de atributos del modelo.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'update_at' => 'datetime'
        ];
    }
}
