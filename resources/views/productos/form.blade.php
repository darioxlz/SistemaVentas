@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>{{$accion}} producto</h4>

        <form method="POST" action="{{$url_form}}">
            @csrf

            <div class="form-group row">
                <label for="descripcion" class="col-md-4 col-form-label text-md-right">Nombre</label>

                <div class="col-md-6">
                    <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ $producto->descripcion }}" required autocomplete="descripcion">

                    @error('descripcion')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="precio" class="col-md-4 col-form-label text-md-right">Precio</label>

                <div class="col-md-6">
                    <input id="precio" type="number" min="0" step=".01" class="form-control" name="precio" value="{{ $producto->precio }}" required autocomplete="precio">

                    @error('precio')
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
