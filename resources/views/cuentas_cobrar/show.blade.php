@extends('layouts.app')

@section('template_title')
   Ver cuentas
@endsection

@section('content')

    <div class="contaboleta_liberacionr-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a class="btn"  href="{{ route('index.cobrar') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                <img src="{{ asset('img/icon/izquierda_white.png') }}" alt="" width="25px"> Regresar
                            </a>
                        </div>
                        <h3 class="text-center">{{$cliente->nombre}}</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-hover table_id" id="datatable-search">
                            <thead class="thead">
                                <tr>
                                    <th><img src="{{ asset('img/icon/contenedor.png') }}" alt="" width="25px"># Contenedor</th>
                                    <th><img src="{{ asset('img/icon/user_predeterminado.webp') }}" alt="" width="25px">Subcliente</th>
                                    <th><img src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="" width="25px">Total a pagar</th>
                                    <th><img src="{{ asset('img/icon/gps.webp') }}" alt="" width="25px">Tipo de viaje</th>
                                    <th><img src="{{ asset('img/icon/gastos.png.webp') }}" alt="" width="25px">Restante</th>
                                    <th><img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cotizacionesPorPagar as $item)
                                    <tr>
                                        <td>{{ $item->DocCotizacion->num_contenedor }}</td>
                                        <td>
                                            @if ($item->id_subcliente != NULL)
                                                {{$item->Subcliente->nombre}} / {{$item->Subcliente->telefono}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>$ {{ number_format($item->total, 2, '.', ',') }}</td>
                                        <td>{{ $item->tipo_viaje }}</td>
                                        <td>$ {{ number_format($item->restante, 2, '.', ',') }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#cobrarModal{{ $item->id }}">
                                                <i class="fa fa-fw fa-edit"></i> Ver
                                            </a>
                                        </td>
                                    </tr>
                                    @include('cuentas_cobrar.pago')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
