@extends('layouts.app')

@section('template_title')
Cuentas Cobrar
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h2 id="card_title">
                                Cuentas Cobrar
                            </h2>

                             <div class="float-right">

                              </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table_id" id="datatable-search">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th>Nombre</th>
										<th>Telefono</th>
										<th>Viajes por cobrar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cotizacionesPorCliente as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>

											<td>{{ $item->Cliente->nombre }}</td>
											<td>{{ $item->Cliente->telefono }}</td>
											<td>{{ $item->total_cotizaciones }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-success" href="{{ route('show.cobrar', $item->id_cliente) }}">
                                                    <i class="fa fa-fw fa-edit"></i> Ver
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('client.modal_create')
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
