@extends('layouts.app')

@section('template_title')
Crear Cliente
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-3">Crear Cliente</h3>
               <a class="btn" href="{{ route('clients.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff"> Back</a>
                    @includeif('partials.errors')
            </div>

            <div class="card-body mb-5">

                <form method="POST" action="{{ route('clients.store') }}"  role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @include('client.form')
                    </div>
                </form>

            </div>

          </div>
        </div>
      </div>
</div>


@endsection
