@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Clientes</h4>

        <table id="clientes" class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo documento</th>
                <th scope="col">Documento</th>
                <th scope="col">Telefono</th>
                <th scope="col">Correo</th>
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
                    ajax: '{{route('clientes.data.listar')}}',
                    serverSide: true,
                    processing: true,
                    columns: [
                        {data: 'cliente_id', name: 'cliente_id', orderable: true},
                        {data: 'nombre', name: 'nombre'},
                        {data: 'tipo_documento', name: 'tipo_documento'},
                        {data: 'documento', name: 'documento'},
                        {data: 'telefono', name: 'telefono'},
                        {data: 'correo', name: 'correo'},
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
                    window.location.href = "/clientes/eliminar/"+id;
                }
            }
        </script>
    @endpush
@endsection
