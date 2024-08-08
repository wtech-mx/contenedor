
@extends('layouts.app')

@section('template_title')
    Buscador
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                        <div class="card-body">
                            <a href="{{ route('dashboard') }}" class="btn" style="background: {{$configuracion->color_boton_close}}; color: #ffff; margin-right: 3rem;">
                                Regresar
                            </a>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <form action="{{ route('advance_documentos.buscador') }}" method="GET" >

                                                <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                                    <h5>Filtro</h5>
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="user_id">Buscar cliente:</label>
                                                                <select class="form-control cliente" name="id_client" id="id_client">
                                                                    <option selected value="">seleccionar cliente</option>
                                                                    @foreach($clientes as $client)
                                                                        <option value="{{ $client->id }}">{{ $client->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-3 mb-5">
                                                                <label for="user_id">Buscar subcliente:</label>
                                                                <select class="form-control subcliente" name="id_subcliente" id="id_subcliente">
                                                                    <option selected value="">seleccionar cliente</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3 mb-5">
                                                                <br>
                                                                <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <form id="exportForm" action="{{ route('export_documentos.export') }}" method="POST">
                                    @csrf
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="thead">
                                            <tr>
                                                <th></th>
                                                <th><img src="{{ asset('img/icon/contenedor.png') }}" alt="" width="25px"># Contenedor</th>
                                                <th><img src="{{ asset('img/icon/calendario.webp') }}" alt="" width="25px">CCP</th>
                                                <th><img src="{{ asset('img/icon/9.webp') }}" alt="" width="25px">Boleta liberacion</th>
                                                <th><img src="{{ asset('img/icon/documento.png') }}" alt="" width="25px">Doda</th>
                                                <th><img src="{{ asset('img/icon/boleto.png') }}" alt="" width="25px">Carta porte</th>
                                                <th><img src="{{ asset('img/icon/calendario.webp') }}" alt="" width="25px">Boleta vacio</th>
                                                <th><img src="{{ asset('img/icon/boleto.png') }}" alt="" width="25px">EIR</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(Route::currentRouteName() != 'index_documentos.reporteria')
                                                @foreach ($cotizaciones as $cotizacion)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="cotizacion_ids[]" value="{{ $cotizacion->id }}" class="select-box" data-row-id="{{ $cotizacion->id }}">
                                                        </td>
                                                        <td>{{$cotizacion->num_contenedor}}</td>
                                                        <td>
                                                            <div class="form-check">
                                                                @if ($cotizacion->doc_ccp == NULL)
                                                                    <input class="form-check-input" type="checkbox" disabled>
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" checked disabled>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                @if ($cotizacion->boleta_liberacion == NULL)
                                                                    <input class="form-check-input" type="checkbox" disabled>
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" checked disabled>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                @if ($cotizacion->doda == NULL)
                                                                    <input class="form-check-input" type="checkbox" disabled>
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" checked disabled>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                @if ($cotizacion->carta_porte == NULL)
                                                                    <input class="form-check-input" type="checkbox" disabled>
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" checked disabled>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                @if ($cotizacion->boleta_vacio == NULL)
                                                                    <input class="form-check-input" type="checkbox" disabled>
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" checked disabled>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                @if ($cotizacion->doc_eir == NULL)
                                                                    <input class="form-check-input" type="checkbox" disabled>
                                                                @else
                                                                    <input class="form-check-input" type="checkbox" checked disabled>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a type="button" class="btn btn-xs" href="{{ route('edit.cotizaciones', $cotizacion->id) }}">
                                                                <img src="{{ asset('img/icon/quotes.webp') }}" alt="" width="25px">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <button type="submit" id="exportButton" class="btn btn-primary">Exportar a PDF</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('datatable')
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.cliente').select2();
            $('.contenedor').select2();
        });

        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
        });

        $(document).ready(function() {
            $('#id_client').on('change', function() {
                var clientId = $(this).val();
                if(clientId) {
                    $.ajax({
                        url: '/subclientes/' + clientId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#id_subcliente').empty();
                            $('#id_subcliente').append('<option selected value="">Seleccionar subcliente</option>');
                            $.each(data, function(key, subcliente) {
                                $('#id_subcliente').append('<option value="'+ subcliente.id +'">'+ subcliente.nombre +'</option>');
                            });
                        }
                    });
                } else {
                    $('#id_subcliente').empty();
                    $('#id_subcliente').append('<option selected value="">Seleccionar subcliente</option>');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const exportButton = document.getElementById('exportButton');
            const selectedRows = new Set();

            const table = $('#datatable-search').DataTable();

            // Manejar el evento de cambio en el checkbox "select all"
            selectAllCheckbox.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.select-box');
                const allChecked = selectAllCheckbox.checked;

                checkboxes.forEach(checkbox => {
                    checkbox.checked = allChecked;
                    const rowId = checkbox.value;
                    if (allChecked) {
                        selectedRows.add(rowId);
                    } else {
                        selectedRows.delete(rowId);
                    }
                });
                toggleExportButton();
            });

            // Manejar el evento de cambio en cada checkbox individual
            $('#datatable-search tbody').on('change', '.select-box', function() {
                const rowId = this.value;
                if (this.checked) {
                    selectedRows.add(rowId);
                } else {
                    selectedRows.delete(rowId);
                }
                toggleExportButton();
            });

            function toggleExportButton() {
                exportButton.disabled = selectedRows.size === 0;
            }

            // Exportar los datos seleccionados a PDF
            exportButton.addEventListener('click', function(event) {
                const selectedData = Array.from(selectedRows);
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_ids';
                input.value = JSON.stringify(selectedData);
                document.getElementById('exportForm').appendChild(input);
            });
        });

    </script>
@endsection
