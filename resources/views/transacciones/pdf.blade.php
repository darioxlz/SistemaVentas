<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{ public_path('/css/bootstrap.min.css') }}">
    <title>Transaccion</title>
</head>

<body>
<div class="container-fluid">
    <h2>Transaccion: {{$transaccion->tipo}}</h2>
    <h4>Telecon Erickson</h4>
    <h5>Cliente: {{$transaccion->cliente->nombre}}</h5>
    <h5>Creado por: {{$transaccion->usuario->nombre}} {{$transaccion->usuario->apellido}}</h5>
    <h6>Fecha: {{$transaccion->created_at}}</h6>

    <table class="table table-sm table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Producto ID</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio</th>
            <th scope="col">Subtotal</th>
        </tr>
        </thead>

        <tbody>
        @foreach($cv_productos as $producto)
            <tr>
                <th>{{$producto->producto_id}}</th>
                <th>{{$producto->producto->descripcion}}</th>
                <th>{{$producto->cantidad}}</th>
                <th>{{number_format($producto->precio, 3, '.', ',')}}</th>
                <th>{{number_format($producto->precio * $producto->cantidad, 3, '.', ',')}}</th>
            </tr>

            @if($loop->last)
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Monto total</th>
                    <th>{{number_format($transaccion->monto_total, 3, '.', ',')}}</th>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
