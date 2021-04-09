@extends('layouts.app')

@section('content')
<div class="container">
{{--  Primera hilera de botones  --}}
    <div class="row justify-content-center mb-3">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header font-weight-bold text-center h4">Usuarios</div>

                <div class="card-body">
                    <a class="btn btn-primary btn-block" href="{{route('usuarios.listar')}}" role="button">Listar</a>
                    <a class="btn btn-primary btn-block" href="{{route('usuarios.formulario')}}" role="button">Crear</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header font-weight-bold text-center h4">Clientes</div>

                <div class="card-body">
                    <a class="btn btn-primary btn-block" href="{{route('clientes.listar')}}" role="button">Listar</a>
                    <a class="btn btn-primary btn-block" href="{{route('clientes.formulario')}}" role="button">Crear</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header font-weight-bold text-center h4">Productos</div>

                <div class="card-body">
                    <button class="btn btn-primary btn-block mb-2" type="button">Inventario</button>

                    {{--   Dropdown compras  --}}
                    <div class="dropdown mb-2">
                        <a class="btn btn-primary btn-block dropdown-toggle" href="#" role="button" id="dropdownComprasLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Compras
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownComprasLink">
                            <a class="dropdown-item" href="#">Listar</a>
                            <a class="dropdown-item" href="#">Crear</a>
                        </div>
                    </div>

                    {{--   Dropdown ventas  --}}
                    <div class="dropdown mb-2">
                        <a class="btn btn-primary btn-block dropdown-toggle" href="#" role="button" id="dropdownVentasLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ventas
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownVentasLink">
                            <a class="dropdown-item" href="#">Listar</a>
                            <a class="dropdown-item" href="#">Crear</a>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-block" type="button">Presupuesto</button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header font-weight-bold text-center h4">Cuentas</div>

                <div class="card-body">
                    {{--   Dropdown cuentas por cobrar  --}}
                    <div class="dropdown mb-2">
                        <a class="btn btn-primary btn-block dropdown-toggle" href="#" role="button" id="dropdownCPCLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Por cobrar
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownCPCLink">
                            <a class="dropdown-item" href="#">Listar</a>
                            <a class="dropdown-item" href="#">Crear</a>
                        </div>
                    </div>


                    {{--   Dropdown cuentas por pagar  --}}
                    <div class="dropdown mb-2">
                        <a class="btn btn-primary btn-block dropdown-toggle" href="#" role="button" id="dropdownCPPLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Por pagar
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownCPPLink">
                            <a class="dropdown-item" href="#">Listar</a>
                            <a class="dropdown-item" href="#">Crear</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--  Fin primera hilera de botones  --}}
</div>
@endsection
