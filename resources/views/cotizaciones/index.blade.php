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

                    <nav class="mx-auto">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                            <img src="{{ asset('img/icon/pausa.png') }}" alt="" width="40px">  En espera
                          </button>

                          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                            <img src="{{ asset('img/icon/cheque.png') }}" alt="" width="40px">  Aprobada
                          </button>

                          <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                            <img src="{{ asset('img/icon/cerrar.png') }}" alt="" width="40px">  Canceladas
                          </button>
                        </div>
                      </nav>


                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                            <div class="table-responsive">
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th><img src="{{ asset('img/icon/user_predeterminado.webp') }}" alt="" width="25px">Cliente</th>
                                                <th><img src="{{ asset('img/icon/gps.webp') }}" alt="" width="25px">Origen</th>
                                                <th><img src="{{ asset('img/icon/origen.png') }}" alt="" width="25px">Destino</th>
                                                <th><img src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="" width="25px">Precio Viaje</th>
                                                <th><img src="{{ asset('img/icon/semaforos.webp') }}" alt="" width="25px">Estatus</th>
                                                <th><img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px">Acciones</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                @foreach ($cotizaciones as $cotizacion)
                                                    <tr>
                                                        <td>{{$cotizacion->id}}</td>
                                                        <td>{{$cotizacion->Cliente->nombre}}</td>
                                                        <td>{{$cotizacion->origen}}</td>
                                                        <td>{{$cotizacion->destino}}</td>
                                                        <td> ${{ number_format($cotizacion->precio_viaje, 2, '.', ','); }} </td>
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

                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable_aprovadas">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th><img src="{{ asset('img/icon/user_predeterminado.webp') }}" alt="" width="25px">Cliente</th>
                                            <th><img src="{{ asset('img/icon/contenedor.png') }}" alt="" width="25px">Contenedor</th>
                                            <th><img src="{{ asset('img/icon/gps.webp') }}" alt="" width="25px">Origen</th>
                                            <th><img src="{{ asset('img/icon/origen.png') }}" alt="" width="25px">Destino</th>
                                            <th><img src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="" width="25px">Precio Viaje</th>
                                            <th><img src="{{ asset('img/icon/semaforos.webp') }}" alt="" width="25px">Estatus</th>
                                            <th><img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px">Acciones</th>
                                        </tr>
                                    </thead>

                                        <tbody>
                                            @foreach ($cotizaciones_aprovadas as $cotizacion)
                                                <tr>
                                                    <td>{{$cotizacion->id}}</td>
                                                    <td>{{$cotizacion->Cliente->nombre}}</td>
                                                    <td>#{{$cotizacion->DocCotizacion->num_contenedor}}</td>

                                                    <td>{{$cotizacion->origen}}</td>
                                                    <td>{{$cotizacion->destino}}</td>
                                                    <td> ${{ number_format($cotizacion->precio_viaje, 2, '.', ','); }} </td>
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

                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable_canceladas">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th><img src="{{ asset('img/icon/user_predeterminado.webp') }}" alt="" width="25px">Cliente</th>
                                            <th><img src="{{ asset('img/icon/gps.webp') }}" alt="" width="25px">Origen</th>
                                            <th><img src="{{ asset('img/icon/origen.png') }}" alt="" width="25px">Destino</th>
                                            <th><img src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="" width="25px">Precio Viaje</th>
                                            <th><img src="{{ asset('img/icon/semaforos.webp') }}" alt="" width="25px">Estatus</th>
                                            <th><img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px">Acciones</th>
                                        </tr>
                                    </thead>

                                        <tbody>
                                            @foreach ($cotizaciones_canceladas as $cotizacion)
                                                <tr>
                                                    <td>{{$cotizacion->id}}</td>
                                                    <td>{{$cotizacion->Cliente->nombre}}</td>
                                                    <td>{{$cotizacion->origen}}</td>
                                                    <td>{{$cotizacion->destino}}</td>
                                                    <td> ${{ number_format($cotizacion->precio_viaje, 2, '.', ','); }} </td>
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
    </div>
@endsection

@section('datatable')
    <script type="text/javascript">
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
        });

        const dataTableSearch2 = new simpleDatatables.DataTable("#datatable_aprovadas", {
        searchable: true,
        fixedHeight: false
        });

        const dataTableSearch3 = new simpleDatatables.DataTable("#datatable_canceladas", {
        searchable: true,
        fixedHeight: false
        });

    </script>
@endsection
