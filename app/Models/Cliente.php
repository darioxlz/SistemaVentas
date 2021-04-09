<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Cliente
 *
 * @property int $cliente_id
 * @property string $nombre
 * @property string $tipo_documento
 * @property string $documento
 * @property string|null $telefono
 * @property string|null $correo
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $creado_por
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cuenta[] $cuentas
 * @property-read int|null $cuentas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaccion[] $transacciones
 * @property-read int|null $transacciones_count
 * @property-read \App\Models\Usuario $usuario
 * @method static \Database\Factories\ClienteFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCorreo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCreadoPor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereTipoDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'cliente_id';
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'tipo_documento',
        'documento',
        'telefono',
        'correo',
        'descripcion',
        'creado_por'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'creado_por', 'usuario_id');
    }

    public function cuentas()
    {
        return $this->hasMany(Cuenta::class, 'cliente_id', 'cliente_id');
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'cliente_id', 'cliente_id');
    }

}
