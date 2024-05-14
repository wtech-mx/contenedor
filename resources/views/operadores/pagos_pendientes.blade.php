@extends('layouts.app')

@section('template_title')
    Operador
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
                                Pagos Pendientes
                            </span>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <h3 class="text-center">{{$operador->nombre}}</h3>
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
                                    @foreach ($pagos_pendientes as $item)

                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('datatable')
    <script type="text/javascript">
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
        });

    </script>
@endsection
