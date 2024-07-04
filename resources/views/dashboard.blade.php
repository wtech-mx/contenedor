@extends('layouts.app')

@section('breadcrumb')
<div class="row">
    @can('clientes-list')
    <div class="col-4">
            <div class="card p-3 mb-4">
                <div class="row">
                    <div class="col-2 my-auto">
                        <a href="{{ route('clients.index') }}">
                            <img src="{{ asset('img/icon/empleados.webp') }}" alt="" width="35px">
                        </a>
                    </div>

                    <div class="col-8">
                        <a href="{{ route('clients.index') }}">
                            <p style="margin: 0">Consulta</p>
                            <h5>I - Clients</h5>
                        </a>
                    </div>

                    <div class="col-2 my-auto">
                        <a type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <img src="{{ asset('img/icon/anadir.webp') }}" alt="" width="35px">
                        </a>
                    </div>
                </div>
            </div>
    </div>
    @endcan
    @can('proovedores-list')
    <div class="col-4">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2  my-auto">
                    <a href="{{ route('index.proveedores') }}">
                        <img src="{{ asset('img/icon/edificios_ciudad.webp') }}" alt="" width="35px">
                    </a>
                </div>

                <div class="col-8">
                    <a href="{{ route('index.proveedores') }}">
                        <p style="margin: 0">Consulta</p>
                        <h5>II - Proveedores</h5>
                    </a>
                </div>

                <div class="col-2 my-auto">
                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#proveedores">
                        <img src="{{ asset('img/icon/anadir.webp') }}" alt="" width="35px">
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('equipos-list')
    <div class="col-4">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2 my-auto">
                    <a href="{{ route('index.equipos') }}">
                        <img src="{{ asset('img/icon/referencia.webp') }}" alt="" width="35px">
                    </a>
                </div>

                <div class="col-8">
                    <a href="{{ route('index.equipos') }}">
                        <p style="margin: 0">Consulta</p>
                        <h5>III - Equipos</h5>
                    </a>
                </div>

                <div class="col-2 my-auto">
                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#equipoModal">
                        <img src="{{ asset('img/icon/anadir.webp') }}" alt="" width="35px">
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('operadores-list')
    <div class="col-4">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2 my-auto">
                    <a href="{{ route('index.operadores') }}">
                        <img src="{{ asset('img/icon/camion.png') }}" alt="" width="35px">
                    </a>
                </div>

                <div class="col-8">
                    <a href="{{ route('index.operadores') }}">
                        <p style="margin: 0">Consulta</p>
                        <h5>IV - Operadores</h5>
                    </a>
                </div>

                <div class="col-2 my-auto">
                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#operadoresModal">
                        <img src="{{ asset('img/icon/anadir.webp') }}" alt="" width="35px">
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('cotizaciones-list')
    <div class="col-4">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2 my-auto">
                    <a href="{{ route('index.cotizaciones') }}">
                        <img src="{{ asset('img/icon/factura.png.webp') }}" alt="" width="35px">
                    </a>
                </div>

                <div class="col-8">
                    <a href="{{ route('index.cotizaciones') }}">
                        <p style="margin: 0">Consulta</p>
                        <h5>V - Cotizaciones</h5>
                    </a>
                </div>

                <div class="col-2 my-auto">
                    <a href="{{ route('create.cotizaciones') }}">
                        <img src="{{ asset('img/icon/anadir.webp') }}" alt="" width="35px">
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('planeacion-list')
    <div class="col-4">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2 my-auto">
                    <a href="{{ route('index.planeaciones') }}">
                        <img src="{{ asset('img/icon/inventario.png.webp') }}" alt="" width="35px">
                    </a>
                </div>

                <div class="col-8">
                    <a href="{{ route('index.planeaciones') }}">
                        <p style="margin: 0">Consulta</p>
                        <h5>VI Planeación</h5>
                    </a>
                </div>

                <div class="col-2 my-auto">

                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('bancos-list')
    <div class="col-4">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2 my-auto">
                    <a href="{{ route('index.bancos') }}">
                        <img src="{{ asset('img/icon/banco.png') }}" alt="" width="35px">
                    </a>
                </div>

                <div class="col-8">
                    <a href="{{ route('index.bancos') }}">
                        <p style="margin: 0">Consulta</p>
                        <h5>VII Bancos</h5>
                    </a>
                </div>

                <div class="col-2 my-auto">
                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#bancoModal">
                        <img src="{{ asset('img/icon/anadir.webp') }}" alt="" width="35px">

                    </a>
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('cuentas-cobrar')
    <div class="col-4">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2 my-auto">
                    <a href="{{ route('index.cobrar') }}">
                        <img src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="" width="35px">
                    </a>
                </div>

                <div class="col-8">
                    <a href="{{ route('index.cobrar') }}">
                        <p style="margin: 0">Consulta</p>
                        <h5>VIII Cuentas por cobrar</h5>
                    </a>
                </div>

                <div class="col-2 my-auto">
                </div>
            </div>
        </div>
    </div>
    @endcan
    @can('cuentas-pagar')
    <div class="col-4">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2 my-auto">
                    <a href="{{ route('index.pagar') }}">
                        <img src="{{ asset('img/icon/gastos.png.webp') }}" alt="" width="35px">
                    </a>
                </div>

                <div class="col-8">
                    <a href="{{ route('index.pagar') }}">
                        <p style="margin: 0">Consulta</p>
                        <h5>IX Cuentas por pagar</h5>
                    </a>
                </div>

                <div class="col-2 my-auto">
                </div>
            </div>
        </div>
    </div>
    @endcan

</div>

@endsection

@section('content')


@include('planeacion.vista_calendar')
@endsection
