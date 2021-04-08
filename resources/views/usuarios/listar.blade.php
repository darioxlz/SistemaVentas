@extends('layouts.app')

@section('content')
    <div class="container">
        <table id="usuarios" class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Cedula</th>
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

                $('#usuarios').DataTable({
                    ajax: '{{route('usuarios.data.listar')}}',
                    serverSide: true,
                    processing: true,
                    columns: [
                        {data: 'usuario_id', name: 'usuario_id', orderable: true},
                        {data: 'nombre', name: 'nombre'},
                        {data: 'apellido', name: 'apellido'},
                        {data: 'cedula', name: 'cedula'},
                        {data: 'correo', name: 'correo'},
                        {data: 'accion', name: 'accion', orderable: false, searchable: false}
                    ],
                    aaSorting: [[0, 'desc']],
                    language: {
                        url: '{!!url('/js/Spanish.json')!!}'
                    },
                    "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "Todos"]]
                });
            })
        </script>
    @endpush
@endsection
