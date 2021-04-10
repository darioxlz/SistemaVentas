<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use PDF;

class PresupuestoController extends Controller
{
    function obtener_productos(Request $request)
    {
        $term = $request->get('term') ?? '';

        $productos = Producto::where('descripcion', 'like', '%'.$term.'%')->get(['producto_id', 'descripcion', 'precio'])->toArray();

        $productos_validos = [];

        foreach ($productos as $producto) {
            array_push($productos_validos, ['id' => $producto['producto_id'], 'text' => $producto['descripcion'] . "  | " . $producto['precio']]);
        }

        return response()->json($productos_validos);
    }

    function generar(Request $request)
    {
        if ($request->has('producto_id')) {
            $productos = Producto::whereIn('producto_id', $request->get('producto_id'))->get((['producto_id', 'descripcion', 'precio']));
            $total = 0;

            foreach ($productos as $producto) {
                $total += $producto->precio;
                $producto->precio = number_format($producto->precio, 3, '.', ',');
            }

            $total = number_format($total, 3, '.', ',');

            $pdf = PDF::loadView('presupuestos.pdf', compact('productos', 'total'));

            return $pdf->download("Presupuesto ".date('d-m-Y').".pdf");
        }
    }
}
