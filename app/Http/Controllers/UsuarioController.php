<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    function data_listar()
    {
        return datatables()->of(Usuario::get(['usuario_id', 'nombre', 'apellido', 'cedula', 'correo']))
        ->addColumn('accion', function (Usuario $usuario) {
            $html = '<a href="'.$usuario->usuario_id.'" class="btn btn-xs btn-primary p-1">Editar</a> ';
            $html .= '<a href="'.$usuario->usuario_id.'" class="btn btn-xs btn-danger p-1">Eliminar</a>';

            return $html;
        })->rawColumns(['accion'])->toJson();
    }
}
