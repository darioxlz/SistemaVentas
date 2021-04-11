<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Cuenta
 *
 * @property int $cuenta_id
 * @property int $cliente_id
 * @property string $tipo
 * @property string $descripcion
 * @property string $monto
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $creado_por
 * @method static \Database\Factories\CuentaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta whereClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta whereCreadoPor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta whereCuentaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta whereMonto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cuenta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cuenta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'cuenta_id';
    protected $table = 'cuentas';

    protected $fillable = [
        'cliente_id',
        'tipo',
        'descripcion',
        'monto',
        'estado',
        'creado_por'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'creado_por', 'usuario_id')->withTrashed();
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'cliente_id')->withTrashed();
    }

    public function getCreatedAtAttribute($date)
    {
        return date("d-m-Y", strtotime($date));
    }
}
