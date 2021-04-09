@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Editar usuario</h4>

    <form method="POST" action="{{route('usuarios.data.editar', $usuario->usuario_id)}}">
        @csrf

        <div class="form-group row">
            <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>

            <div class="col-md-6">
                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $usuario->nombre }}" required autocomplete="nombre">

                @error('nombre')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="apellido" class="col-md-4 col-form-label text-md-right">Apellido</label>

            <div class="col-md-6">
                <input id="apellido" type="text" class="form-control" name="apellido" value="{{ $usuario->apellido }}" required autocomplete="apellido">

                @error('apellido')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="cedula" class="col-md-4 col-form-label text-md-right">Cedula</label>

            <div class="col-md-6">
                <input id="cedula" type="text" readonly class="form-control" name="cedula" value="{{ $usuario->cedula }}" required autocomplete="cedula">
            </div>
        </div>

        <div class="form-group row">
            <label for="correo" class="col-md-4 col-form-label text-md-right">Correo</label>

            <div class="col-md-6">
                <input id="correo" type="email" class="form-control" name="correo" value="{{ $usuario->correo }}" required autocomplete="correo">

                @error('correo')
                <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="contrasena" class="col-md-4 col-form-label text-md-right">Contraseña</label>

            <div class="col-md-6">
                <input id="contrasena" type="password" minlength="8" class="form-control" name="contrasena" autocomplete="contrasena">

                @error('contrasena')
                <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Editar
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
