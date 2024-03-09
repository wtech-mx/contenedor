@extends('layouts.app')

@section('template_title')
    Client
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Proveedores
                            </span>

                             <div class="float-right">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
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
                                        <th>RFC</th>
                                        <th>Cuentas Bancarias</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                    <tbody>
                                        @foreach ($proveedores as $proveedor)
                                            <tr>
                                                <td>{{$proveedor->id}}</td>
                                                <td>{{$proveedor->nombre}}</td>
                                                <td>{{$proveedor->telefono}}</td>
                                                <td>{{$proveedor->rfc}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#cuentasModal{{$proveedor->id}}">
                                                        Ver cuentas registradas
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarModal{{$proveedor->id}}">
                                                        <img src="{{ asset('img/icon/t credito.png.webp') }}" alt="" width="25px">
                                                    </button>
                                                </td>
                                            </tr>
                                            @include('proveedores.modal_edit')
                                            @include('proveedores.modal_cuentas')
                                        @endforeach
                                    </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('proveedores.modal_create')

@endsection

@section('datatable')
    <script type="text/javascript">
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
        });

    </script>
@endsection
