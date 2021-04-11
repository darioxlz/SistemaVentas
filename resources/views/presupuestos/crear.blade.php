@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Crear presupuesto</h4>

        <div class="form-group row">
            <label for="select-productos">Productos</label>

            <div class="col-md-6">
                <select class="form-control" id="select-productos"></select>

                <button class="my-3 btn btn-primary" id="btnAddItem">Añadir</button>

                <form action="{{route('presupuestos.generar')}}" method="POST" id="formOculto">
                    @csrf

                    <button class="my-3 btn btn-primary" id="btnCrear" disabled="disabled" type="submit">Crear presupuesto</button>
                </form>
            </div>
        </div>

        <table id="productos" class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Precio</th>
                <th scope="col">Accion</th>
            </tr>
            </thead>

            <tbody>

            </tbody>
        </table>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $.noConflict();
                $ = jQuery;
                const select = $('#select-productos');
                let listaProductos = [];
                const tabla = $('#productos');

                select.select2({
                    ajax: {
                        url: '{{route('productos.data.select2')}}',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                term: params.term
                            }
                        },
                        processResults: function (data, page) {
                            return {
                                results: data
                            };
                        },
                    }
                });

                const dataTable = tabla.DataTable({
                    aaSorting: [[0, 'desc']],
                    language: {
                        url: '{!!url('/js/Spanish.json')!!}'
                    },
                    lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "Todos"]],
                    columnDefs: [{
                        targets: 3,
                        orderable: false,
                        searchable: false
                    }]
                });

                $('#btnAddItem').on('click', function () {
                    let id = select.val();

                    if (id == null) {
                        return alert('Debes seleccionar al menos un producto');
                    }

                    const existe = listaProductos.find(producto => {
                        return producto === id;
                    });

                    if (existe != null) {
                        alert('Este producto ya lo añadiste al presupuesto');
                    } else {
                        let data = select.select2('data')[0];

                        let descripcion = data.descripcion;
                        let precio = data.precio;

                        dataTable.row.add([
                            id,
                            descripcion,
                            precio,
                            `<button class="btn btn-xs btn-danger del-button" data-id="${id}">Eliminar</button>`
                        ]).draw();

                        listaProductos.push(id);
                        select.val('').trigger('change');
                        $('#btnCrear').prop('disabled', false);

                        $('#formOculto').append(`<input type="hidden" name="producto_id[]" value="${id}" />`);
                    }
                });

                tabla.on('click', '.del-button', function () {
                    const id = $(this).attr('data-id');

                    delete listaProductos.splice(listaProductos.indexOf(id), 1);

                    if (listaProductos.length === 0) {
                        $('#btnCrear').prop('disabled', true);
                    }

                    dataTable.row($(this).parents("tr")).remove().draw();
                    $(`#formOculto input[value="${id}"]`).remove();
                });
            });
        </script>
    @endpush
@endsection
