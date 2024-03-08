@extends('layouts.app')

@section('template_title')
    {{ $client->name ?? 'Show Client' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Client</span>
                        </div>
                        <div class="float-right">
                            <a class="btn" href="{{ route('clients.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $client->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Apellido:</strong>
                            {{ $client->apellido }}
                        </div>
                        <div class="form-group">
                            <strong>Edad:</strong>
                            {{ $client->edad }}
                        </div>
                        <div class="form-group">
                            <strong>Sanguineo:</strong>
                            {{ $client->sanguineo }}
                        </div>
                        <div class="form-group">
                            <strong>Ocupacion:</strong>
                            {{ $client->ocupacion }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $client->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Nacimiento:</strong>
                            {{ $client->fecha_nacimiento }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $client->email }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
