<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- <link rel="stylesheet" href="{{ public_path('/css/bootstrap.min.css') }}"> -->
        <title>Presupuesto</title>

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

            <h4><u>Presupuesto</u> <u style="margin-left: 5em;">Fecha</u>: {{date('d-m-Y')}}</h4>

            <table border="1">
                <thead>
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
