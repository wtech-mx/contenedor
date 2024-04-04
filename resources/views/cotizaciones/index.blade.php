@extends('layouts.app')

@section('template_title')
    Cotizaciones
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Cotizaciones
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
                                        <th>Estatus</th>
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
                                                    @if ($cotizacion->estatus == 'Pendiente')
                                                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#estatusModal{{$cotizacion->id}}">
                                                            {{$cotizacion->estatus}}
                                                        </button>
                                                    @elseif ($cotizacion->estatus == 'Cancelada')
                                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#estatusModal{{$cotizacion->id}}">
                                                            {{$cotizacion->estatus}}
                                                        </button>
                                                    @elseif ($cotizacion->estatus == 'Aprobada')
                                                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$cotizacion->id}}">
                                                            {{$cotizacion->estatus}}
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cotizacion->estatus == 'Aprobada')
                                                        <a type="button" class="btn" href="{{ route('edit.cotizaciones', $cotizacion->id) }}">
                                                            <img src="{{ asset('img/icon/quotes.webp') }}" alt="" width="25px">
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @include('cotizaciones.modal_estatus')
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
