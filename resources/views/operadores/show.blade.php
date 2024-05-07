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
                    </div>

                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

