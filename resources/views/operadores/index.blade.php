@extends('layouts.app')

@section('template_title')
    Operadores
@endsection

@section('content')

<style>
    .estilos_equipo{
        background: #ccc;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);
    }

    .titulos_bitacora{
        font-size: 12px;
    }
</style>
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
                                        <th>No</th>
                                        <th>Nombre <img src="{{ asset('img/icon/user_predeterminado.webp') }}" alt="" width="25px"></th>
                                        <th>Telefono <img src="{{ asset('img/icon/fuente.webp') }}" alt="" width="25px"></th>
                                        <th>Tipo Sangre <img src="{{ asset('img/icon/sangre.png') }}" alt="" width="25px"></th>
                                        <th>Acciones <img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px"></th>
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
                                                    <a type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#operadoresModal_Edit{{$operador->id}}">
                                                        <img src="{{ asset('img/icon/editar.webp') }}" alt="" width="25px">
                                                    </a>

                                                    <a type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#operadoresModal_bitacora{{$operador->id}}">
                                                        <img src="{{ asset('img/icon/logistica.png') }}" alt="" width="25px"> Bitacora
                                                    </a>
                                                </td>
                                            </tr>
                                            @include('operadores.modal_bitacora')

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
