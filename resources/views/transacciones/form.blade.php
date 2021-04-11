@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Crear transaccion {{$tipo}}</h4>

        <form method="POST" action="{{route('transacciones.data.crear')}}" id="formOculto">
            @csrf
            <input type="hidden" name="tipo" value="{{$tipo}}">
            @error('tipo')
            <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror

            <div class="form-group row">
                <label for="cliente_id" class="col-md-4 col-form-label text-md-right">Cliente</label>

                <div class="col-md-6">
                    <select name="cliente_id" id="cliente_id" class="form-control">
                        @foreach($clientes as $cliente)
                            <option value="{{$cliente->cliente_id}}">{{$cliente->nombre}}</option>
                        @endforeach
                    </select>

                    @error('cliente_id')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <button class="my-3 btn btn-primary" id="btnCrear" disabled="disabled" type="submit">Crear transaccion</button>
                </div>
            </div>
        </form>

        <div class="form-group row">
            <label for="select-productos" class="col-md-4 col-form-label text-md-right">Productos</label>

            <div class="col-md-6">
                <select class="form-control" id="select-productos"></select>
            </div>
        </div>

        <div class="form-group row">
            <label for="cantidad" class="col-md-4 col-form-label text-md-right">Cantidad</label>

            <div class="col-md-6">
                <input id="cantidad" type="number" min="0" class="form-control" name="cantidad" required>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button class="my-3 btn btn-primary" id="btnAddItem">Añadir</button>
            </div>
        </div>

        <table id="productos" class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Subtotal</th>
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
                const cantidad = $('#cantidad');
                const tipo = '{{$tipo}}';
                let stock = 0;

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
                        targets: 5,
                        orderable: false,
                        searchable: false
                    }]
                });

                select.on('select2:select', function (e) {
                    stock = $(this).select2('data')[0].stock;
                });

                $('#btnAddItem').on('click', function () {
                    let id = select.val();
                    let cantidadVal = parseInt(cantidad.val());

                    if (id == null) {
                        return alert('Debes seleccionar al menos un producto');
                    }

                    if (isNaN(cantidadVal) || parseInt(cantidadVal) < 1) {
                        return alert('Debes especificar la cantidad, mayora a 0');
                    }

                    const existe = listaProductos.find(producto => {
                        return producto === id;
                    });

                    if (existe != null) {
                        alert('Este producto ya lo añadiste');
                    } else {
                        let datos = select.select2('data')[0];

                        let descripcion = datos.descripcion;
                        let precio = datos.precio;
                        let stock = datos.stock;

                        if (tipo == 'VENTA' && parseInt(stock) < cantidadVal) {
                            return alert('No hay stock suficiente');
                        }

                        dataTable.row.add([
                            id,
                            descripcion,
                            cantidadVal,
                            precio,
                            cantidadVal * parseFloat(precio),
                            `<button class="btn btn-xs btn-danger del-button" data-id="${id}">Eliminar</button>`
                        ]).draw();

                        listaProductos.push(id);

                        select.val('').trigger('change');
                        $('#btnCrear').prop('disabled', false);
                        cantidad.val('');

                        $('#formOculto').append(`<input type="hidden" name="productos[]" data-id="${id}" value="${id}|||${cantidadVal}" />`);
                    }
                });

                tabla.on('click', '.del-button', function () {
                    const id = $(this).attr('data-id');

                    delete listaProductos.splice(listaProductos.indexOf(id), 1);

                    if (listaProductos.length === 0) {
                        $('#btnCrear').prop('disabled', true);
                    }

                    dataTable.row($(this).parents("tr")).remove().draw();
                    $(`#formOculto input[data-id="${id}"]`).remove();
                });
            });
        </script>
    @endpush
@endsection
