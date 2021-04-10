<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="{{ public_path('/css/bootstrap.min.css') }}">
        <title>Presupuesto</title>
    </head>

    <body>
        <div class="container-fluid">
            <h2>Presupuesto {{date('d-m-Y')}}</h2>
            <h4>Telecon Erickson</h4>

            <table class="table table-hover table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <th>{{$producto->producto_id}}</th>
                            <th>{{$producto->descripcion}}</th>
                            <th>{{$producto->precio}}</th>
                        </tr>

                        @if($loop->last)
                            <tr>
                                <th></th>
                                <th>Monto total</th>
                                <th>{{$total}}</th>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
