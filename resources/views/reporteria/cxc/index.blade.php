
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

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <form action="{{ route('advance_search.buscador') }}" method="GET" >

                                                <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                                    <h5>Filtro</h5>
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="user_id">Buscar cliente:</label>
                                                                <select class="form-control cliente" name="id_client" id="id_client">
                                                                    <option selected value="">seleccionar cliente</option>
                                                                    @foreach($clientes as $client)
                                                                        <option value="{{ $client->id }}">{{ $client->nombre }} {{ $client->telefono }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            {{-- <div class="col-3">
                                                                <label for="user_id">Buscar subcliente:</label>
                                                                <select class="form-control phone" name="phone" id="phone">
                                                                    <option selected value="">seleccionar Telefono</option>
                                                                    @foreach($subclientes as $client)
                                                                        <option value="{{ $client->id }}">{{ $client->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div> --}}
                                                            <div class="col-3">
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
                                <form id="exportForm" action="{{ route('cotizaciones.export') }}" method="POST">
                                    @csrf
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="thead">
                                            <tr>
                                                <th></th>
                                                <th><img src="{{ asset('img/icon/user_predeterminado.webp') }}" alt="" width="25px">Cliente</th>
                                                <th><img src="{{ asset('img/icon/user_predeterminado.webp') }}" alt="" width="25px">Subcliente</th>
                                                <th><img src="{{ asset('img/icon/gps.webp') }}" alt="" width="25px">Origen</th>
                                                <th><img src="{{ asset('img/icon/origen.png') }}" alt="" width="25px">Destino</th>
                                                <th><img src="{{ asset('img/icon/contenedor.png') }}" alt="" width="25px"># Contenedor</th>
                                                <th><img src="{{ asset('img/icon/semaforos.webp') }}" alt="" width="25px">Estatus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cotizaciones as $cotizacion)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="cotizacion_ids[]" value="{{ $cotizacion->id }}" class="select-box" data-row-id="{{ $cotizacion->id }}">
                                                    </td>
                                                    <td>{{$cotizacion->Cliente->nombre}}</td>
                                                    <td>
                                                        @if ($cotizacion->id_subcliente != NULL)
                                                            {{$cotizacion->Subcliente->nombre}} / {{$cotizacion->Subcliente->telefono}}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{$cotizacion->origen}}</td>
                                                    <td>{{$cotizacion->destino}}</td>
                                                    <td>{{$cotizacion->DocCotizacion->num_contenedor}}</td>
                                                    <td>
                                                        @can('cotizaciones-estatus')
                                                            @if ($cotizacion->estatus == 'Aprobada')
                                                                <button type="button" class="btn btn-outline-info btn-xs">
                                                            @else
                                                                <button type="button" class="btn btn-outline-success btn-xs">
                                                            @endif
                                                                {{$cotizacion->estatus}}
                                                            </button>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
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
        });

        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
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
