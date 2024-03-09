@extends('layouts.app')

@section('template_title')
    Operadores
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Operadores
                            </span>

                             <div class="float-right">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#operadoresModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
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
                                        <th>Nombre</th>
                                        <th>Telefono</th>
                                        <th>Tipo Sangre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                    <tbody>
                                        @foreach ($operadores as $operador)
                                            <tr>
                                                <td>{{$operador->id}}</td>
                                                <td>{{$operador->nombre}}</td>
                                                <td>{{$operador->telefono}}</td>
                                                <td>{{$operador->tipo_sangre}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarModal{{$operador->id}}">
                                                        <img src="{{ asset('img/icon/t credito.png.webp') }}" alt="" width="25px">
                                                    </button>
                                                </td>
                                            </tr>
                                            @include('operadores.modal_edit')
                                        @endforeach
                                    </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('operadores.modal_create')

@endsection
