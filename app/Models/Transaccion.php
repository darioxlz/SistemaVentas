<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Transaccion
 *
 * @property int $transaccion_id
 * @property int $cliente_id
 * @property int $cantidad_productos
 * @property string $monto_total
 * @property string $tipo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $creado_por
 * @property-read \App\Models\Cliente $cliente
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CV_Producto[] $cv_productos
 * @property-read int|null $cv_productos_count
 * @property-read \App\Models\Usuario $usuario
 * @method static \Database\Factories\TransaccionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaccion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaccion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaccion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaccion whereCantidadProductos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaccion whereClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaccion whereCreadoPor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaccion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaccion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaccion whereMontoTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaccion whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaccion whereTransaccionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaccion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Transaccion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'transaccion_id';
    protected $table = 'transacciones';

    protected $fillable = [
        'cliente_id',
        'cantidad_productos',
        'monto_total',
        'tipo',
        'creado_por'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'cliente_id')->withTrashed();
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'creado_por', 'usuario_id')->withTrashed();
    }

    public function cv_productos()
    {
        return $this->hasMany(CV_Producto::class, 'transaccion_id', 'transaccion_id');
    }

    public function getCreatedAtAttribute($date)
    {
        return date("d-m-Y", strtotime($date));
    }
}
