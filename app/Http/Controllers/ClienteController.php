<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    function data_listar()
    {
        return datatables()->of(Cliente::get(['cliente_id', 'nombre', 'tipo_documento', 'documento', 'telefono', 'correo']))
            ->addColumn('accion', function (Cliente $cliente) {
                $html = '<a class="btn btn-xs btn-primary p-1" href="'. route('clientes.formulario', ['id' => $cliente->cliente_id]) .'">Editar</a> ';
                $html .= '<a class="btn btn-xs btn-danger p-1" href="javascript:confirmarBorrar('. $cliente->cliente_id .')">Eliminar</a>';

                return $html;
            })->rawColumns(['accion'])->toJson();
    }

    function formulario(Request $request)
    {
        $cliente = new Cliente();
        $url_form = route('clientes.data.crear');

        if ($request->has('id')) {
            try {
                $cliente = Cliente::findOrFail($request->get('id'));
                $accion = 'Editar';
                $url_form = route('clientes.data.editar', $request->get('id'));
            } catch (ModelNotFoundException $e) {
                return redirect()->back();
            }
        } else {
            $accion = 'Crear';
        }

        return view('clientes.form', compact('cliente', 'accion', 'url_form'));
    }

    function crear(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3',
            'tipo_documento' => 'required|in:CEDULA,RIF',
            'documento' => 'required|integer|gt:0|unique:clientes,documento',
            'telefono' => 'nullable|min:3',
            'correo' => 'nullable|email',
            'descripcion' => 'nullable|min:3'
        ]);

        Cliente::create(array_merge($request->all(), ['creado_por' => Auth::id()]));

        return redirect()->route('clientes.listar');
    }

    function editar(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|min:3',
            'tipo_documento' => 'required|in:CEDULA,RIF',
//            'documento' => 'required|integer|gt:0|unique:clientes,documento',
            'documento' => ['required', 'integer', 'gt:0', Rule::unique('clientes')->ignore($id, 'cliente_id')],
            'telefono' => 'nullable|min:3',
            'correo' => 'nullable|email',
            'descripcion' => 'nullable|min:3'
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect()->route('clientes.listar');
    }

    function eliminar($id)
    {
        Cliente::findOrFail($id)->delete();

        return redirect()->back();
    }
}
