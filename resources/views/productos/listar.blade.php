@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Productos</h4>

        <table id="productos" class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Stock</th>
                <th scope="col">Precio</th>
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

                $('#productos').DataTable({
                    ajax: '{{route('productos.data.listar')}}',
                    serverSide: true,
                    processing: true,
                    columns: [
                        {data: 'producto_id', name: 'producto_id', orderable: true},
                        {data: 'descripcion', name: 'descripcion'},
                        {data: 'stock', name: 'stock'},
                        {data: 'precio', name: 'precio'},
                        {data: 'accion', name: 'accion', orderable: false, searchable: false}
                    ],
                    columnDefs: [
                        { "width": "15%", "targets": 4 }
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
                    window.location.href = "/productos/eliminar/"+id;
                }
            }
        </script>
    @endpush
@endsection
