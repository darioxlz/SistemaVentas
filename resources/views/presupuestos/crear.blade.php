@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Crear presupuesto</h4>

        <label for="select-productos">Productos</label>
        <select class="form-control" id="select-productos"></select>

        <button class="my-3 btn btn-primary" id="btnAddItem">Añadir</button>
        {{-- se puede hacer un form con un array de inputs hidden y enviarlo por post al controlador, chequear como borrar el input hidden --}}

        <form action="{{route('presupuestos.generar')}}" method="POST" id="formOculto">
            @csrf

            <button class="my-3 btn btn-primary" id="btnCrear" disabled="disabled" type="submit">Crear presupuesto</button>
        </form>

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
                        url: '{{route('presupuestos.obtener.productos')}}',
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
                        let texto = $('#select-productos :selected').text().split(' | ');

                        let descripcion = texto[0];
                        let precio = texto[1];

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
