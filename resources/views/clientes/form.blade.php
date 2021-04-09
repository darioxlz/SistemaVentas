@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>{{$accion}} cliente</h4>

        <form method="POST" action="{{$url_form}}">
            @csrf

            <div class="form-group row">
                <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>

                <div class="col-md-6">
                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $cliente->nombre }}" required autocomplete="nombre">

                    @error('nombre')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="tipo_documento" class="col-md-4 col-form-label text-md-right">Tipo de documento</label>

                <div class="col-md-6">
                    <select name="tipo_documento" id="tipo_documento" class="form-control">
                        <option value="RIF" @if($cliente->tipo_documento == 'RIF') selected @endif>RIF</option>
                        <option value="CEDULA" @if($cliente->tipo_documento == 'CEDULA') selected @endif>CEDULA</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="documento" class="col-md-4 col-form-label text-md-right">Documento</label>

                <div class="col-md-6">
                    <input id="documento" type="text" @if($accion == 'Editar') readonly @endif class="form-control" name="documento" value="{{ $cliente->documento }}" required autocomplete="documento">

                    @error('documento')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="telefono" class="col-md-4 col-form-label text-md-right">Telefono</label>

                <div class="col-md-6">
                    <input id="telefono" type="text" class="form-control" name="telefono" value="{{ $cliente->telefono }}" autocomplete="telefono">

                    @error('telefono')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="correo" class="col-md-4 col-form-label text-md-right">Correo</label>

                <div class="col-md-6">
                    <input id="correo" type="email" class="form-control" name="correo" value="{{ $cliente->correo }}" autocomplete="correo">

                    @error('correo')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripcion</label>

                <div class="col-md-6">
                    <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control">{{$cliente->descripcion}}</textarea>

                    @error('descripcion')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{$accion}}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
