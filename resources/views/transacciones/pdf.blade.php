<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Transaccion</title>

        <style>
            @font-face {
                font-family: 'Consolas';
                src: url({{ storage_path('fonts/consolas.ttf') }}) format("truetype");
                font-weight: 400;
                font-style: normal;
            }

            body {
                font-family: "Consolas" !important;
            }

            table {
                width: 100%;
            }

            .logo {
                width: 100px;
                height: 100px;
                margin-left: 20em;
            }
        </style>
    </head>

    <body>
        <div>
            <span>
                <h1 style="display: inline;">Telecon Erickson</h1>

                <img class="logo" src="{{ public_path() . '/images/logo.png'}}" alt="Logo">
            </span>

            <p>
                <strong><u>Transaccion</u></strong>: {{$transaccion->tipo}}

                <span style="margin-left: 5em;">
                    <strong><u>Cliente</u></strong>: {{$transaccion->cliente->nombre}}
                </span>

                <span style="margin-left: 4em;">
                    <strong><u>Transaccion #</u></strong>: {{$transaccion->transaccion_id}}
                </span>
            </p>

            <table border="1">
                <thead>
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
                                <th><strong>Monto total</strong></th>
                                <th><strong>{{number_format($transaccion->monto_total, 3, '.', ',')}}</strong></th>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <center>
                <span>
                    <strong><u>Fecha</u>: </strong> {{$transaccion->created_at}}

                    <span style="margin-left: 5em;">
                        <strong><u>Empleado</u>: </strong> {{$transaccion->usuario->nombre}} {{$transaccion->usuario->apellido}}
                    </span>
                </span>
            </center>
        </div>
    </body>
</html>
