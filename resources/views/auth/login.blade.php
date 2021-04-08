@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Acceso al sistema</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('autenticar') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="correo" class="col-md-4 col-form-label text-md-right">Correo</label>

                            <div class="col-md-6">
                                <input id="correo" type="correo" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required autocomplete="correo" autofocus>

                                @error('correo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contrasena" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="contrasena" type="password" class="form-control @error('contrasena') is-invalid @enderror" name="contrasena" required autocomplete="contrasena">

                                @error('contrasena')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Iniciar sesión
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
