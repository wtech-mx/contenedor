@extends('layouts.app')

@section('template_title')
Clientes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a href="{{ route('dashboard') }}" class="btn" style="background: {{$configuracion->color_boton_close}}; color: #ffff; margin-right: 3rem;">
                                Regresar
                            </a>

                            <h2 id="card_title">
                               Clientes
                            </h2>

                             <div class="float-right">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-plus"></i>  Crear
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

										<th>Nombre</th>
										<th>Telefono</th>
										<th>Correo</th>
                                        <th>Subclientes</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client->id }}</td>

											<td>{{ $client->nombre }}</td>
											<td>{{ $client->telefono }}</td>
											<td>{{ $client->correo }}</td>
                                            <td>
                                                <a type="btn" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#subclienteShowModal-{{$client->id}}">
                                                    <i class="fa fa-fw fa-eye"></i> Ver
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal-{{ $client->id }}">
                                                    <i class="fa fa-fw fa-edit"></i> Editar</a>
                                                <a type="btn" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#subclienteModal-{{$client->id}}">
                                                    Subclientes
                                                </a>
                                            </td>
                                        </tr>
                                        @include('client.edit')
                                        @include('client.modal_subclientes')
                                        @include('client.show')
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
