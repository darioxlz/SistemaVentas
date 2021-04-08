<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CV_Producto
 *
 * @property int $cv_producto_id
 * @property int $transaccion_id
 * @property int $producto_id
 * @property int $cantidad
 * @property string $precio
 * @property-read \App\Models\Producto $producto
 * @property-read \App\Models\Transaccion $transaccion
 * @method static \Database\Factories\CV_ProductoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CV_Producto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CV_Producto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CV_Producto query()
 * @method static \Illuminate\Database\Eloquent\Builder|CV_Producto whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CV_Producto whereCvProductoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CV_Producto wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CV_Producto whereProductoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CV_Producto whereTransaccionId($value)
 * @mixin \Eloquent
 */
class CV_Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'cv_producto_id';
    protected $table = 'cv_productos';
    public $timestamps = false;

    protected $fillable = [
        'transaccion_id',
        'producto_id',
        'cantidad',
        'precio'
    ];

    public function transaccion()
    {
        return $this->belongsTo(Transaccion::class, 'transaccion_id', 'transaccion_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'producto_id');
    }
}
