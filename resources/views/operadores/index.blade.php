@extends('layouts.app')

@section('template_title')
    Operadores
@endsection

@section('content')

<style>
    .estilos_equipo{
        background: #f5f5f5;
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

                                                    <a type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#operadoresModal_bitacora{{$operador->id}}">
                                                        <img src="{{ asset('img/icon/depositar.png') }}" alt="" width="25px"> Pagar
                                                    </a>

                                                    <a type="button" class="btn btn-sm btn-outline-info" href="{{ route('show.operadores', $operador->id) }}">
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
    <script>
        // Escuchar eventos de entrada en los campos de gasolina, casetas y otros
        document.addEventListener('input', function (event) {
            if (event.target.matches('[id^="gasolina_"], [id^="casetas_"], [id^="otros_"]')) {
                // Obtener el ID del elemento
                var itemId = event.target.id.split('_')[1];

                // Obtener los valores de los campos
                var gasolina = parseFloat(document.getElementById('gasolina_' + itemId).value) || 0;
                var casetas = parseFloat(document.getElementById('casetas_' + itemId).value) || 0;
                var otros = parseFloat(document.getElementById('otros_' + itemId).value) || 0;

                // Obtener el valor original de dinero_viaje y sueldo_viaje desde los campos ocultos
                var dinero_viaje = parseFloat(document.getElementById('dinero_viaje_' + itemId).value);
                var sueldo_viaje = parseFloat(document.getElementById('sueldo_viaje_' + itemId).value);

                // Calcular la resta y actualizar el campo de resta
                var resta = dinero_viaje - sueldo_viaje - gasolina - casetas - otros;
                document.getElementById('resta_' + itemId).value = resta.toFixed(2);
            }
        });
    </script>
@endsection
