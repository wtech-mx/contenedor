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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"  style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                  </button>
                              </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('proveedores.modal_create')

@endsection
