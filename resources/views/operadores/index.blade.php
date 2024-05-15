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
                                    <i class="fa fa-fw fa-plus"></i> Crear
                                  </button>
                              </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nombre <img src="{{ asset('img/icon/user_predeterminado.webp') }}" alt="" width="25px"></th>
                                        <th class="text-center">Telefono <img src="{{ asset('img/icon/fuente.webp') }}" alt="" width="25px"></th>
                                        <th class="text-center">Seldos Pendientes <img src="{{ asset('img/icon/billetera.png') }}" alt="" width="25px"></th>
                                        <th class="text-center">Acciones <img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px"></th>
                                    </tr>
                                </thead>

                                    <tbody class="text-center">
                                        @foreach ($operadores as $operador)
                                            <?php
                                                $registrosPendientes = $pagos_pendientes->where('id_operador', $operador->id)->count();
                                            ?>
                                            <tr>
                                                <td>{{$operador->id}}</td>
                                                <td>{{$operador->nombre}}</td>
                                                <td>{{$operador->telefono}}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger">{{$registrosPendientes}}</button>
                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#operadoresModal_Edit{{$operador->id}}">
                                                        <img src="{{ asset('img/icon/editar.webp') }}" alt="" width="25px">
                                                    </a>

                                                    <a type="button" class="btn btn-sm btn-outline-success" href="{{ route('show_pagos.operadores', $operador->id) }}">
                                                        <img src="{{ asset('img/icon/depositar.png') }}" alt="" width="25px"> Pagos P.
                                                    </a>

                                                    <a type="button" class="btn btn-sm btn-outline-info" href="{{ route('show.operadores', $operador->id) }}">
                                                        <img src="{{ asset('img/icon/logistica.png') }}" alt="" width="25px"> Pagos S.
                                                    </a>
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

@section('datatable')
    <script type="text/javascript">
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
        });

    </script>
@endsection
