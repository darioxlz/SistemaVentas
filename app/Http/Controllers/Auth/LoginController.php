<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function username(){ return 'correo';}

    public function mostrar()
    {
        return view('auth.login');
    }

    public function autenticar(Request $request)
    {
        $validator = $request->validate([
            'correo' => 'required|email|exists:usuarios,correo',
            'contrasena' => 'required|min:8'
        ]);

        $usuario = Usuario::firstWhere('correo', '=', $validator['correo']);

        if (Auth::attempt(array('correo' => $validator['correo'], 'password' => $validator['contrasena']))) {
            session(['usuario' => $usuario->toArray()]);

            return redirect()->route('inicio');
        } else {
            return back()->withErrors([
                'contrasena' => 'Contraseña invalida'
            ]);
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return back();
    }
}
