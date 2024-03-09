@extends('layouts.app')

@section('template_title')
    Equipos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Equipos
                            </span>

                             <div class="float-right">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#equipoModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                  </button>
                              </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Tipo</th>
                                        <th>Fecha Alta</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                    <tbody>
                                        @foreach ($equipos as $equipo)
                                            <tr>
                                                <td>{{$equipo->id}}</td>
                                                <td>{{$equipo->tipo}}</td>
                                                <td>{{$equipo->fecha}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarModal{{$equipo->id}}">
                                                        <img src="{{ asset('img/icon/t credito.png.webp') }}" alt="" width="25px">
                                                    </button>
                                                </td>
                                            </tr>
                                            @include('equipos.modal_edit')
                                        @endforeach
                                    </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('equipos.modal_create')

@endsection
