@extends('layouts.app')

@section('template_title')
    Bancos
@endsection

@section('content')
<div class="row">

    @php
        $total = 0;

        foreach ($cotizaciones as $item){
            if ($item->id_banco1 == $banco->id){
                $total += $item->monto1;
            }elseif ($item->id_banco2 == $banco->id){
                $total += $item->monto2;
            }
        }
    @endphp

    <div class="col-lg-4 col-md-6 col-12 mt-4 mt-md-0">
        <div class="card overflow-hidden shadow-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports2.jpg'); background-size: cover;">
            <span class="mask bg-gradient-dark"></span>
            <div class="card-body p-3 position-relative">
                <div class="row">
                    <div class="col-8 text-start">
                        <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                            <img class="w-60 mt-2" src="{{ asset('img/icon/efectivo.webp') }}" alt="logo">
                        </div>
                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                            $ {{ number_format($total, 0, '.', ',') }}
                        </h5>
                        <span class="text-white text-sm">Cargo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mt-4 mt-md-0">
        <div class="card overflow-hidden shadow-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports3.jpg'); background-size: cover;">
            <span class="mask bg-gradient-dark"></span>
            <div class="card-body p-3 position-relative">
                <div class="row">
                    <div class="col-8 text-start">
                        <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                            <img class="w-60 mt-2" src="{{ asset('img/icon/gastos.png.webp') }}" alt="logo">
                        </div>
                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                        $357
                        </h5>
                        <span class="text-white text-sm">Abono</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mt-4 mt-md-0">
        <div class="card overflow-hidden shadow-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports1.jpg'); background-size: cover;">
            <span class="mask bg-gradient-dark"></span>
            <div class="card-body p-3 position-relative">
                <div class="row">
                    <div class="col-8 text-start">
                        <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                            <img class="w-60 mt-2" src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="logo">
                        </div>
                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                        $357
                        </h5>
                        <span class="text-white text-sm">Saldo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container-fluid py-4">
        <div class="row mt-3">
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Cobros</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-4"><b>Contenedor</b></div>
                            <div class="col-4"><b>Cliente</b></div>
                            <div class="col-4"><b>Cargo</b></div>

                            @foreach ($cotizaciones as $item)
                                <div class="col-4">
                                    <a class="btn btn-sm btn-success" href="{{ route('edit.cotizaciones', $item->id) }}">
                                        {{ $item->DocCotizacion->num_contenedor }}
                                    </a>
                                </div>
                                <div class="col-4">{{ $item->Cliente->nombre }}</div>
                                <div class="col-4">
                                    @if ($item->id_banco1  == $banco->id)
                                        $ {{ number_format($item->monto1, 0, '.', ',') }}
                                    @else
                                        $ {{ number_format($item->monto2, 0, '.', ',') }}
                                    @endif

                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Pagos</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-4"><b>Contenedor</b></div>
                            <div class="col-4"><b>Cliente</b></div>
                            <div class="col-4"><b>Cargo</b></div>

                            @foreach ($proveedores as $item)
                                <div class="col-4">
                                    <a class="btn btn-sm btn-info" href="{{ route('edit.cotizaciones', $item->Contenedor->Cotizacion->id) }}">
                                        {{ $item->Contenedor->num_contenedor }}
                                    </a>
                                </div>
                                <div class="col-4">{{ $item->Contenedor->Cotizacion->Cliente->nombre }}</div>
                                <div class="col-4">
                                        $ {{ number_format($item->precio, 0, '.', ',') }}
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-4 mt-xl-0 mt-4">
                <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Conversations</h6>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                        <img src="../../../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Sophie B.</h6>
                        <p class="mb-0 text-xs">Hi! I need more information..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                        <img src="../../../assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Anne Marie</h6>
                        <p class="mb-0 text-xs">Awesome work, can you..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                        <img src="../../../assets/img/ivana-square.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Ivanna</h6>
                        <p class="mb-0 text-xs">About files I can..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="avatar me-3">
                        <img src="../../../assets/img/team-4.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Peterson</h6>
                        <p class="mb-0 text-xs">Have a great afternoon..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0">
                        <div class="avatar me-3">
                        <img src="../../../assets/img/team-3.jpg" alt="kal" class="border-radius-lg shadow">
                        </div>
                        <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Nick Daniel</h6>
                        <p class="mb-0 text-xs">Hi! I need more information..</p>
                        </div>
                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
