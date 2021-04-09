@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Cuentas @if($tipo == 'CPC') por cobrar @elseif($tipo == 'CPP') por pagar @endif</h4>

        <table id="clientes" class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tipo</th>
                <th scope="col">Cliente</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Monto</th>
                <th scope="col">Estado</th>
                <th scope="col">Fecha</th>
                <th scope="col">Accion</th>
            </tr>
            </thead>
        </table>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $.noConflict();
                $ = jQuery;

                $('#clientes').DataTable({
                    ajax: '{{route('cuentas.data.listar', ['tipo' => $tipo] )}}',
                    serverSide: true,
                    processing: true,
                    columns: [
                        {data: 'cuenta_id', name: 'cuenta_id', orderable: true},
                        {data: 'tipo', name: 'tipo'},
                        {data: 'cliente.nombre', name: 'cliente'},
                        {data: 'descripcion', name: 'descripcion'},
                        {data: 'monto', name: 'monto'},
                        {data: 'estado', name: 'estado'},
                        {data: 'created_at', name: 'fecha'},
                        {data: 'accion', name: 'accion', orderable: false, searchable: false}
                    ],
                    aaSorting: [[0, 'desc']],
                    language: {
                        url: '{!!url('/js/Spanish.json')!!}'
                    },
                    "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "Todos"]]
                });
            });

            function confirmarBorrar(id) {
                if (confirm('¿Estás seguro que deseas borrar este registro?')) {
                    window.location.href = "/cuentas/eliminar/"+id;
                }
            }
        </script>
    @endpush
@endsection
