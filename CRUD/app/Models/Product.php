<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * Modelo que representa un producto en el catálogo del sistema.
 * Maneja la información básica de los productos disponibles para la venta.
 *
 * @package App\Models
 *
 * @property int $id Identificador único del producto
 * @property string $nombre Nombre del producto
 * @property string|null $descripcion Descripción detallada del producto
 * @property float $precio Precio unitario del producto
 * @property string|null $imagen Ruta de la imagen del producto
 * @property string|null $categoria Categoría a la que pertenece el producto
 * @property \Illuminate\Support\Carbon|null $created_at Fecha de creación del registro
 * @property \Illuminate\Support\Carbon|null $updated_at Fecha de última actualización
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Order[] $pedidos Pedidos asociados al producto
 */
class Product extends Model
{

    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'productos';


    /**
     * @var string[]
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'categoria',
    ];


    /**
     * Obtiene la relación muchos a muchos con los pedidos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pedidos()
    {
        return $this->belongsToMany(Order::class, 'pedido_producto')
                    ->withPivot('cantidad', 'precio_unitario');
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

