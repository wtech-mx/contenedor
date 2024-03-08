@extends('layouts.app')

@section('template_title')
     Roles
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-3">Role Management</h3>

                @can('role-create')
                     <a class="btn" href="{{ route('roles.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">Create New Role</a>
                @endcan
            </div>

            <div class="table-responsive py-4" style="">
              <table class="table table-flush table_id" id="datatable-basic" >
                  <thead class="thead-light">
                      <tr>
                       <th>No</th>
                       <th>Name</th>
                       <th width="280px">Action</th>
                     </tr>
                  </thead>

                 @foreach ($roles as $key => $role)
                      <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->name }}</td>

                        <td class="text-right">
                          <div class="dropdown ">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                              <a class="dropdown-item" href="{{ route('roles.show',$role->id) }}">
                                  Show
                              </a>
                              <a class="dropdown-item" href="{{ route('roles.edit',$role->id) }}">
                                Edit
                              </a>
                            {!! Form::open(['method' => 'DELETE','route' => ['permisos.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'dropdown-item']) !!}
                            {!! Form::close() !!}

                            </div>
                          </div>
                        </td>

                      </tr>
                 @endforeach

              </table>
            </div>

          </div>
        </div>
      </div>
</div>


@endsection
