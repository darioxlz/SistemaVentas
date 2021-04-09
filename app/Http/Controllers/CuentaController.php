<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cuenta;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuentaController extends Controller
{
    function listar(Request $request)
    {
        if ($request->has('tipo')) {
            $tipo = $request->get('tipo');

            if ($tipo == 'CPC' || $tipo == 'CPP') {
                $data = Cuenta::where('tipo', '=', $tipo)->get();
            } else {
                $data = Cuenta::all();
            }
        } else {
            return redirect()->route('cuentas.listar', ['tipo' => 'todo']);
        }

        return view('cuentas.listar', compact('data', 'tipo'));
    }

    function data_listar(Request $request)
    {
        $tipo = $request->get('tipo') ?? '';

        $data = Cuenta::with(['cliente' => function ($q) {
            $q->select('cliente_id', 'nombre');
        }]);

        if ($tipo == 'CPP' || $tipo == 'CPC') {
            $data = $data->where('tipo', '=', $tipo);
        }

        $data = $data->get(['cuenta_id', 'tipo', 'cliente_id', 'descripcion', 'monto', 'estado', 'created_at']);

        return datatables()->of($data)
            ->addColumn('accion', function (Cuenta $cuenta) {
                $html = '<a class="btn btn-xs btn-primary p-1" href="'. route('cuentas.formulario', ['id' => $cuenta->cuenta_id]) .'">Editar</a> ';
                $html .= '<a class="btn btn-xs btn-danger p-1" href="javascript:confirmarBorrar('. $cuenta->cuenta_id .')">Eliminar</a>';

                return $html;
            })->rawColumns(['accion'])->toJson();
    }

    function formulario(Request $request)
    {
        $cuenta = new Cuenta();
        $url_form = route('cuentas.data.crear');

        if ($request->has('id')) {
            try {
                $cuenta = Cuenta::findOrFail($request->get('id'));
                $accion = 'Editar';
                $tipo = $cuenta->tipo == 'CPC' ? 'por cobrar' : 'por pagar';

                $url_form = route('cuentas.data.editar', $request->get('id'));
            } catch (ModelNotFoundException $e) {
                return redirect()->back();
            }
        } else {
            $accion = 'Crear';
            $cuenta->tipo = $request->get('tipo', 'CPC');
            $tipo = $request->get('tipo', 'CPC') == 'CPC' ? 'por cobrar' : 'por pagar';
        }

        $clientes = Cliente::all();

        return view('cuentas.form', compact('cuenta', 'accion', 'url_form', 'tipo', 'clientes'));
    }

    function crear(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|integer|exists:clientes,cliente_id',
            'tipo' => 'required|in:CPC,CPP',
            'descripcion' => 'required|min:3',
            'monto' => 'required|numeric|gt:0',
            'estado' => 'required|in:PENDIENTE,PAGADO',
        ]);

        Cuenta::create(array_merge($request->all(), ['creado_por' => Auth::id()]));

        return redirect()->route('cuentas.listar', ['tipo' => $request->get('tipo')]);
    }

    function editar(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|integer|exists:clientes,cliente_id',
            'tipo' => 'required|in:CPC,CPP',
            'descripcion' => 'required|min:3',
            'monto' => 'required|numeric|gt:0',
            'estado' => 'required|in:PENDIENTE,PAGADO',
        ]);

        $cuenta = Cuenta::findOrFail($id);
        $cuenta->update($request->all());

        return redirect()->route('cuentas.listar', ['tipo' => $request->get('tipo')]);
    }

    function eliminar($id)
    {
        Cuenta::findOrFail($id)->delete();

        return redirect()->back();
    }
}
