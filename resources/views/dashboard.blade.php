@extends('layouts.app')

@section('breadcrumb')
<div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
          <div class="card  mb-4">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Citas</p>
                    <h5 class="font-weight-bolder">
                     # {{$t_citas_contador}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">+55%</span>
                      since yesterday
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="card  mb-4">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Proximas Citas</p>
                    <h5 class="font-weight-bolder">
                       # {{$p_citas_contador}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">+3%</span>
                      since last week
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="card  mb-4">
            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#coloresModal" style="">
                <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Servicios</p>
                        <h5 class="font-weight-bolder">
                        # {{$servicios_contador}}
                        </h5>
                    </div>
                    </div>
                    <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                        <i class="fa fa-area-chart text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                    </div>
                </div>
                </div>
            </a>

          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="card  mb-4">
            <a type="button" class="" data-bs-toggle="modal" data-bs-target="#estatusModal" style="">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Estatus</p>
                    <h5 class="font-weight-bolder">
                      # {{$estatus_contador}}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="fa fa-cogs text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('layouts.estatus')
  @include('layouts.colores')

@endsection


@section('content')
    {{--calednarioi--}}
    @include('alerts.calendar');
    {{--calednarioi--}}
@endsection
