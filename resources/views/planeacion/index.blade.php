@extends('layouts.app')

@section('template_title')
    Cotizaciones Aprovadas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Cotizaciones Aprovadas
                            </span>

                             <div class="float-right">
                                <a type="button" class="btn btn-primary" href="{{ route('create.cotizaciones') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Cliente</th>
                                        <th>Precio Viaje</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                    <tbody>
                                        @foreach ($cotizaciones as $cotizacion)
                                            <tr>
                                                <td>{{$cotizacion->id}}</td>
                                                <td>{{$cotizacion->Cliente->nombre}}</td>
                                                <td>${{$cotizacion->precio_viaje}}</td>
                                                <td>
                                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#planeacionModal{{$cotizacion->id}}">
                                                        <img src="{{ asset('img/icon/editar.webp') }}" alt="" width="25px">
                                                    </button>
                                                </td>
                                            </tr>
                                            @include('planeacion.edit')
                                        @endforeach
                                    </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
    <script type="text/javascript">
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
        });

    </script>
@endsection
