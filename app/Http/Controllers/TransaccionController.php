<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\CV_Producto;
use App\Models\Producto;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class TransaccionController extends Controller
{
    public function listar(Request $request)
    {
        if ($request->has('tipo')) {
            $tipo = $request->get('tipo');

            if ($tipo == 'VENTA' || $tipo == 'COMPRA') {
                $data = Transaccion::where('tipo', '=', $tipo)->get();
            } else {
                $data = Transaccion::all();
            }
        } else {
            return redirect()->route('transacciones.listar', ['tipo' => 'todo']);
        }

        return view('transacciones.listar', compact('data', 'tipo'));
    }

    public function formulario(Request $request)
    {
        $tipo = $request->get('tipo', 'COMPRA');
        $tipo = $tipo == 'VENTA' ? 'VENTA' : 'COMPRA';
        $clientes = Cliente::all();

        return view('transacciones.form', compact('tipo', 'clientes'));
    }

    public function crear(Request $request)
    {
        $tipo = $request->get('tipo');
        $cliente_id = $request->get('cliente_id');
        $productos_request = $request->get('productos');
        $productos = array();
        $monto_total = 0;
        $cantidad_productos = 0;

        foreach ($productos_request as $producto)
        {
            $exploded = explode("|||", $producto);
            $id = $exploded[0];
            $cantidad = $exploded[1];
            $cantidad_productos++;

            $producto_model = Producto::find($id);

            $monto_total += $producto_model->precio * $cantidad;

            array_push($productos, ['producto_id' => $id, 'cantidad' => $cantidad, 'precio' => $producto_model->precio]);
        }

        $transaccion = Transaccion::create([
            'cliente_id' => $cliente_id,
            'cantidad_productos' => $cantidad_productos,
            'monto_total' => $monto_total,
            'tipo' => $tipo,
            'creado_por' => Auth::id()
        ]);

        foreach ($productos as $producto) {
            CV_Producto::create([
                'transaccion_id' => $transaccion->transaccion_id,
                'producto_id' => $producto['producto_id'],
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio']
            ]);
        }

        return redirect()->route('transacciones.listar', ['tipo' => $tipo]);
    }

    function data_listar(Request $request)
    {
        $tipo = $request->get('tipo') ?? '';

        $data = Transaccion::with(['cliente' => function ($q) {
            $q->select('cliente_id', 'nombre');
        }]);

        if ($tipo == 'VENTA' || $tipo == 'COMPRA') {
            $data = $data->where('tipo', '=', $tipo);
        }

        $data = $data->get(['transaccion_id', 'tipo', 'cliente_id', 'cantidad_productos', 'monto_total', 'created_at']);

        return datatables()->of($data)
            ->addColumn('accion', function (Transaccion $transaccion) {
                return '<a class="btn btn-xs btn-primary p-1" href="'. route('transacciones.generar', ['transaccion_id' => $transaccion->transaccion_id]) .'">Ver detalle</a> ';
            })->rawColumns(['accion'])->toJson();
    }

    public function generar(Request $request)
    {
        if ($request->has('transaccion_id')) {
            $transaccion = Transaccion::with(['cv_productos', 'usuario'])->findOrFail($request->get('transaccion_id'));

            $cv_productos = CV_Producto::with('producto')->where('transaccion_id', '=', $transaccion->transaccion_id)->get();

            $pdf = PDF::loadView('transacciones.pdf', compact('transaccion', 'cv_productos'));

            return $pdf->download("Transaccion ".$transaccion->tipo. " ".$transaccion->created_at.".pdf");
        }
    }
}
