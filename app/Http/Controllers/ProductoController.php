<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    function data_listar()
    {
        return datatables()->of(Producto::get(['producto_id', 'descripcion', 'stock', 'precio']))
            ->addColumn('accion', function (Producto $producto) {
                $html = '<a class="btn btn-xs btn-primary p-1" href="'. route('productos.formulario', ['id' => $producto->producto_id]) .'">Editar</a> ';
                $html .= '<a class="btn btn-xs btn-danger p-1" href="javascript:confirmarBorrar('. $producto->producto_id .')">Eliminar</a>';

                return $html;
            })->rawColumns(['accion'])->toJson();
    }

    function obtener_productos_select2(Request $request)
    {
        $term = $request->get('term') ?? '';

        $productos = Producto::where('descripcion', 'ilike', '%'.$term.'%')->get(['producto_id', 'descripcion', 'precio'])->toArray();

        $productos_validos = [];

        foreach ($productos as $producto) {
            array_push($productos_validos, ['id' => $producto['producto_id'], 'text' => $producto['descripcion'] . "  | " . $producto['precio']]);
        }

        return response()->json($productos_validos);
    }

    function formulario(Request $request)
    {
        $producto = new Producto();
        $url_form = route('productos.data.crear');

        if ($request->has('id')) {
            try {
                $producto = Producto::findOrFail($request->get('id'));
                $accion = 'Editar';
                $url_form = route('productos.data.editar', $request->get('id'));
            } catch (ModelNotFoundException $e) {
                return redirect()->back();
            }
        } else {
            $accion = 'Crear';
        }

        return view('productos.form', compact('producto', 'accion', 'url_form'));
    }

    function crear(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|min:3',
            'precio' => 'required|numeric|gt:0',
        ]);

        Producto::create(array_merge($request->all(), ['stock' => '0', 'creado_por' => Auth::id()]));

        return redirect()->route('productos.listar');
    }

    function editar(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|min:3',
            'precio' => 'required|numeric|gt:0',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.listar');
    }

    function eliminar($id)
    {
        Producto::findOrFail($id)->delete();

        return redirect()->back();
    }
}
