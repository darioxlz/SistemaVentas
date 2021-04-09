<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{

    function data_listar()
    {
        return datatables()->of(Usuario::get(['usuario_id', 'nombre', 'apellido', 'cedula', 'correo']))
        ->addColumn('accion', function (Usuario $usuario) {
            $html = '<a class="btn btn-xs btn-primary p-1" href="'. route('usuarios.formulario', ['id' => $usuario->usuario_id]) .'">Editar</a> ';
            $html .= '<a class="btn btn-xs btn-danger p-1" href="javascript:confirmarBorrar('. $usuario->usuario_id .')">Eliminar</a>';

            return $html;
        })->rawColumns(['accion'])->toJson();
    }

    function formulario(Request $request)
    {
        $usuario = new Usuario();
        $url_form = route('usuarios.data.crear');

        if ($request->has('id')) {
            try {
                $usuario = Usuario::findOrFail($request->get('id'));
                $accion = 'Editar';
                $url_form = route('usuarios.data.editar', $request->get('id'));
            } catch (ModelNotFoundException $e) {
                return redirect()->back();
            }
        } else {
            $accion = 'Crear';
        }

        return view('usuarios.form', compact('usuario', 'accion', 'url_form'));
    }

    function crear(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3',
            'apellido' => 'required|min:3',
            'correo' => 'required|email|unique:usuarios,correo',
            'cedula' => 'required|integer|gt:0|unique:usuarios,cedula',
            'contrasena' => 'required|min:8'
        ]);

        Usuario::create($request->all());

        return redirect()->route('usuarios.listar');
    }

    function editar(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|min:3',
            'apellido' => 'required|min:3',
            'correo' => ['required', 'email', Rule::unique('usuarios')->ignore($id, 'usuario_id')],
            'contrasena' => 'nullable|min:8'
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());

        return redirect()->route('usuarios.listar');
    }

    function eliminar($id)
    {
        Usuario::findOrFail($id)->delete();

        return redirect()->back();
    }
}
