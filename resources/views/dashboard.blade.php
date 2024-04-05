@extends('layouts.app')

@section('breadcrumb')
<div class="row">

    <div class="col-4">
            <div class="card p-3 mb-4">
                <div class="row">
                    <div class="col-2 my-auto">
                        <a href="{{ route('clients.index') }}">
                            <img src="{{ asset('img/icon/empleados.webp') }}" alt="" width="35px">
                        </a>
                    </div>

                    <div class="col-8">
                        <p style="margin: 0">Consulta</p>
                        <h5>I - Clients</h5>
                    </div>

                    <div class="col-2 my-auto">
                        <a type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <img src="{{ asset('img/icon/anadir.webp') }}" alt="" width="35px">
                        </a>
                    </div>
                </div>
            </div>

    </div>

    <div class="col-4">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2  my-auto">
                    <a href="{{ route('index.proveedores') }}">
                        <img src="{{ asset('img/icon/edificios_ciudad.webp') }}" alt="" width="35px">
                    </a>
                </div>

                <div class="col-8">
                    <p style="margin: 0">Consulta</p>
                    <h5>II - Proveedores</h5>
                </div>

                <div class="col-2 my-auto">
                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#proveedores">
                        <img src="{{ asset('img/icon/anadir.webp') }}" alt="" width="35px">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2 my-auto">
                    <a href="{{ route('index.equipos') }}">
                        <img src="{{ asset('img/icon/referencia.webp') }}" alt="" width="35px">
                    </a>
                </div>

                <div class="col-8">
                    <p style="margin: 0">Consulta</p>
                    <h5>III - Equipos</h5>
                </div>

                <div class="col-2 my-auto">
                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#equipoModal">
                        <img src="{{ asset('img/icon/anadir.webp') }}" alt="" width="35px">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2 my-auto">
                    <a href="{{ route('index.operadores') }}">
                        <img src="{{ asset('img/icon/camion.png') }}" alt="" width="35px">
                    </a>
                </div>

                <div class="col-8">
                    <p style="margin: 0">Consulta</p>
                    <h5>IV - Operadores</h5>
                </div>

                <div class="col-2 my-auto">
                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#operadoresModal">
                        <img src="{{ asset('img/icon/anadir.webp') }}" alt="" width="35px">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2 my-auto">
                    <a href="{{ route('create.cotizaciones') }}">
                        <img src="{{ asset('img/icon/factura.png.webp') }}" alt="" width="35px">
                    </a>
                </div>

                <div class="col-8">
                    <p style="margin: 0">Consulta</p>
                    <h5>V - Cotizaciones</h5>
                </div>

                <div class="col-2 my-auto">
                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#operadoresModal">
                        <img src="{{ asset('img/icon/anadir.webp') }}" alt="" width="35px">
                    </a>
                </div>
            </div>
        </div>

    </div>


</div>

@endsection

@section('content')


@include('planeacion.vista_calendar')
@endsection
