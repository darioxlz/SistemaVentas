<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Producto
 *
 * @property int $producto_id
 * @property string $descripcion
 * @property int $stock
 * @property float $precio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $creado_por
 * @property-read \App\Models\CV_Producto|null $cv_producto
 * @property-read \App\Models\Usuario $usuario
 * @method static \Database\Factories\ProductoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Producto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Producto query()
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereCreadoPor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereProductoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'producto_id';
    protected $table = 'productos';

    protected $fillable = [
        'descripcion',
        'stock',
        'precio',
        'creado_por'
    ];

    public function cv_producto()
    {
        return $this->hasOne(CV_Producto::class, 'producto_id', 'producto_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'creado_por', 'usuario_id');
    }
}
