@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>{{$accion}} cuenta {{$tipo}}</h4>

        <form method="POST" action="{{$url_form}}">
            @csrf

            <div class="form-group row">
                <label for="cliente_id" class="col-md-4 col-form-label text-md-right">Cliente</label>

                <div class="col-md-6">
                    <select name="cliente_id" id="cliente_id" class="form-control">
                        @foreach($clientes as $cliente)
                            <option value="{{$cliente->cliente_id}}" @if($cuenta->cliente_id == $cliente->cliente_id) selected @endif >{{$cliente->nombre}}</option>
                        @endforeach
                    </select>

                    @error('cliente_id')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="tipo" class="col-md-4 col-form-label text-md-right">Tipo de cuenta</label>

                <div class="col-md-6">
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="CPP" @if($cuenta->tipo == 'CPP') selected @endif>Por pagar</option>
                        <option value="CPC" @if($cuenta->tipo == 'CPC') selected @endif>Por cobrar</option>
                    </select>

                    @error('tipo')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripcion</label>

                <div class="col-md-6">
                    <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control">{{$cuenta->descripcion}}</textarea>

                    @error('descripcion')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="monto" class="col-md-4 col-form-label text-md-right">Monto</label>

                <div class="col-md-6">
                    <input id="monto" type="number" min="0" step=".001" class="form-control" name="monto" value="{{ $cuenta->monto }}" required autocomplete="monto">

                    @error('monto')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="estado" class="col-md-4 col-form-label text-md-right">Estado</label>

                <div class="col-md-6">
                    <select name="estado" id="estado" class="form-control">
                        <option value="PENDIENTE" @if($cuenta->estado == 'PENDIENTE') selected @endif>Pendiente</option>
                        <option value="PAGADO" @if($cuenta->estado == 'PAGADO') selected @endif>Pagado</option>
                    </select>
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
