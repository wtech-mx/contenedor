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
                                Regresar
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-hover table_id" id="datatable-search">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th># Contenedor</th>
                                    <th>Total a pagar</th>
                                    <th>Tipo de viaje</th>
                                    <th>Restante</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cotizacionesPorPagar as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->DocCotizacion->num_contenedor }}</td>
                                        <td>{{ number_format($item->total, 2, '.', ',') }}</td>
                                        <td>{{ $item->tipo_viaje }}</td>
                                        <td>{{ number_format($item->restante, 2, '.', ',') }}</td>
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


