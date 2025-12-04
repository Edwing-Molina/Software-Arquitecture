<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Settings
 *
 * Modelo para la configuración global del sistema.
 * Almacena parámetros como horarios de apertura/cierre y estado de la tienda.
 *
 * @package App\Models
 *
 * @property int $id Identificador único de la configuración
 * @property string|null $opening_time Hora de apertura de la tienda
 * @property string|null $closing_time Hora de cierre de la tienda
 * @property bool $is_store_open Indica si la tienda está abierta o cerrada
 * @property \Illuminate\Support\Carbon|null $created_at Fecha de creación del registro
 * @property \Illuminate\Support\Carbon|null $updated_at Fecha de última actualización
 */
class Settings extends Model
{
    /**
     * @var string
     */
    protected $table = 'settings';

    /**
     * @var string[]
     */
    protected $fillable = [
        'opening_time',
        'closing_time',
        'is_store_open',
    ];


}

