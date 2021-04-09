<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * App\Models\Usuario
 *
 * @property int $usuario_id
 * @property string $nombre
 * @property string $apellido
 * @property int $cedula
 * @property string $correo
 * @property string $contrasena
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cliente[] $clientes
 * @property-read int|null $clientes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cuenta[] $cuentas
 * @property-read int|null $cuentas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Producto[] $productos
 * @property-read int|null $productos_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaccion[] $transacciones
 * @property-read int|null $transacciones_count
 * @method static \Database\Factories\UsuarioFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario query()
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereCedula($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereContrasena($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usuario whereUsuarioId($value)
 * @mixin \Eloquent
 */
class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'usuario_id';
    protected $table = 'usuarios';

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'correo',
        'contrasena'
    ];

    protected $hidden = [
        'contrasena'
    ];

    public function setContrasenaAttribute($contrasena)
    {
        $this->attributes['contrasena'] = Hash::make($contrasena);
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'creado_por', 'usuario_id');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'creado_por', 'usuario_id');
    }

    public function cuentas()
    {
        return $this->hasMany(Cuenta::class, 'creado_por', 'usuario_id');
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'creado_por', 'usuario_id');
    }
}
