@extends('layouts.app')

@section('template_title')
Bancos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h2 id="card_title">
                                Bancos
                            </h2>

                             <div class="float-right">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bancoModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-plus"></i> Crear
                                  </button>
                              </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table_id" id="datatable-search">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th><img src="{{ asset('img/icon/t credito.png.webp') }}" alt="" width="25px">Nombre Banco</th>
										<th><img src="{{ asset('img/icon/t debito.webp') }}" alt="" width="25px"> Clabe</th>
                                        <th><img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px"> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bancos as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>

											<td>{{ $item->nombre_banco }}</td>
											<td>{{ $item->clabe }}</td>
                                            <td>
                                                <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#editarModal{{$item->id}}">
                                                    <img src="{{ asset('img/icon/t credito.png.webp') }}" alt="" width="20px">
                                                </button>
                                            </td>
                                        </tr>
                                        @include('bancos.edit')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('bancos.modal_create')
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
