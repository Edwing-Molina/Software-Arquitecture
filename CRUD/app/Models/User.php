<?php


namespace App\Models;


//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * Modelo de usuario autenticable del sistema.
 * Maneja la autenticación, autorización y roles de usuario.
 *
 * @package App\Models
 *
 * @property int $id Identificador único del usuario
 * @property string $name Nombre completo del usuario
 * @property string $email Correo electrónico del usuario
 * @property string $password Contraseña hasheada del usuario
 * @property string|null $role Rol del usuario (admin, caja, etc.)
 * @property string|null $remember_token Token para recordar sesión
 * @property \Illuminate\Support\Carbon|null $email_verified_at Fecha de verificación del email
 * @property \Illuminate\Support\Carbon|null $created_at Fecha de creación del usuario
 * @property \Illuminate\Support\Carbon|null $updated_at Fecha de última actualización
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * Verifica si el usuario tiene rol de administrador.
     *
     * @return bool True si el usuario es admin, false en caso contrario
     */
    public function isAdmin(): bool
    {
        return ($this->role ?? '') === 'admin';
    }

    /**
     * Verifica si el usuario tiene rol de cajero.
     *
     * @return bool True si el usuario es cajero, false en caso contrario
     */
    public function isCaja(): bool
    {
        return ($this->role ?? '') === 'caja';
    }
}

