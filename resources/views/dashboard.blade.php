@extends('layouts.app')

@section('breadcrumb')
<div class="row">

    <div class="col-4">
        <a href="{{ route('clients.index') }}">
            <div class="card p-3 mb-4">
                <div class="row">
                    <div class="col-2">
                        <img src="{{ asset('img/icon/empleados.webp') }}" alt="" width="35px">
                    </div>

                    <div class="col-10">
                        <h5>I - Clients</h5>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-4">
        <a href="{{ route('index.proveedores') }}">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('img/icon/edificios_ciudad.webp') }}" alt="" width="35px">
                </div>

                <div class="col-10">
                    <h5>II - Proveedores</h5>
                </div>
            </div>
        </div>
        </a>
    </div>

    <div class="col-4">
        <a href="{{ route('index.equipos') }}">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('img/icon/referencia.webp') }}" alt="" width="35px">
                </div>

                <div class="col-10">
                    <h5>III - Equipos</h5>
                </div>
            </div>
        </div>
         </a>
    </div>

    <div class="col-4">
        <a href="{{ route('index.operadores') }}">
        <div class="card p-3 mb-4">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('img/icon/camion.png') }}" alt="" width="35px">
                </div>

                <div class="col-10">
                    <h5>IV - Operadores</h5>
                </div>
            </div>
        </div>
         </a>
    </div>


</div>

@endsection
