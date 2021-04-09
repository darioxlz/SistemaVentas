<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{

    function data_listar()
    {
        return datatables()->of(Usuario::get(['usuario_id', 'nombre', 'apellido', 'cedula', 'correo']))
        ->addColumn('accion', function (Usuario $usuario) {
            $html = '<a class="btn btn-xs btn-primary p-1" href="'. route('usuarios.editar', $usuario->usuario_id) .'">Editar</a> ';
            $html .= '<a class="btn btn-xs btn-danger p-1" href="#">Eliminar</a>';

            return $html;
        })->rawColumns(['accion'])->toJson();
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

    function form_editar($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.editar', compact('usuario'));
    }
}
