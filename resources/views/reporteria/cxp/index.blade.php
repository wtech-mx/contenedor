
@extends('layouts.app')

@section('template_title')
    CXP
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
                                            <form action="{{ route('advance_search_cxp.buscador') }}" method="GET" >
                                                <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label for="user_id">Buscar proveedor:</label>
                                                            <select class="form-control cliente" name="id_proveedor" id="id_proveedor">
                                                                <option selected value="">seleccionar proveedor</option>
                                                                @foreach($proveedores as $proveedor)
                                                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }} {{ $proveedor->telefono }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
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
                                <form id="exportForm" action="{{ route('cotizaciones_cxp.export') }}" method="POST">
                                    @csrf
                                    <h3> {{$proveedor->nombre}} </h3>
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="thead">
                                            <tr>
                                                <th><input type="checkbox" id="select-all"></th>
                                                <th><img src="{{ asset('img/icon/gps.webp') }}" alt="" width="25px">Origen</th>
                                                <th><img src="{{ asset('img/icon/origen.png') }}" alt="" width="25px">Destino</th>
                                                <th><img src="{{ asset('img/icon/contenedor.png') }}" alt="" width="25px"># Contenedor</th>
                                                <th><img src="{{ asset('img/icon/semaforos.webp') }}" alt="" width="25px">Estatus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(Route::currentRouteName() != 'index_cxp.reporteria')
                                                @foreach ($cotizaciones as $cotizacion)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="cotizacion_ids[]" value="{{ $cotizacion->id }}" class="select-box">
                                                        </td>
                                                        <td>{{$cotizacion->origen}}</td>
                                                        <td>{{$cotizacion->destino}}</td>
                                                        <td>{{$cotizacion->num_contenedor}}</td>

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
                                            @endif
                                        </tbody>
                                    </table>
                                    <button type="submit" id="exportButton" class="btn btn-primary" disabled>Exportar a PDF</button>
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
            const checkboxes = document.querySelectorAll('.select-box');
            const exportButton = document.getElementById('exportButton');

            selectAllCheckbox.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
                toggleExportButton();
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', toggleExportButton);
            });

            function toggleExportButton() {
                const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                exportButton.disabled = !anyChecked;
            }
        });
    </script>
@endsection