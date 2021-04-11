<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use PDF;

class PresupuestoController extends Controller
{
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
