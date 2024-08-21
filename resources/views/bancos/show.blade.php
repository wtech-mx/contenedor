@extends('layouts.app')

@section('template_title')
    Bancos Edit
@endsection

@section('content')
<div class="row">

    @php
        $banco_entrada = 0;
        $banco_salida = 0;

        foreach ($banco_dinero_entrada as $item){
            if ($item->id_banco1 == $banco->id){
                $banco_entrada += $item->monto1;
            }
            if ($item->id_banco2 == $banco->id){
                $banco_entrada += $item->monto2;
            }
        }

        foreach ($banco_dinero_salida as $item){
            if ($item->id_banco1 == $banco->id){
                $banco_salida += $item->monto1;
            }
            if ($item->id_banco2 == $banco->id){
                $banco_salida += $item->monto2;
            }
        }

        $total = 0;

        foreach ($cotizaciones as $item){
            if ($item->id_banco1 == $banco->id){
                $total += $item->monto1;
            }
            if ($item->id_banco2 == $banco->id){
                $total += $item->monto2;
            }
        }

        $pagos = 0;
        $pagos_salida = 0;

        foreach ($proveedores as $item){
            if ($item->id_prove_banco1 == $banco->id){
                $pagos += $item->prove_monto1;
            }
            if ($item->id_prove_banco2 == $banco->id){
                $pagos += $item->prove_monto2;
            }
        }

        foreach ($banco_dinero_salida_ope as $item){
            if ($item->id_banco1 == $banco->id){
                $pagos_salida += $item->monto1;
            }
            if ($item->id_banco2 == $banco->id){
                $pagos_salida += $item->monto2;
            }
        }

        $gastos_extras = 0;
        foreach ($gastos_generales as $item){
           $gastos_extras += $item->monto1;
        }

        $total_pagos = 0;
        $total_pagos = $pagos + $pagos_salida + $banco_salida + $gastos_extras;
        $saldo = 0;
        $saldo = ($banco->saldo_inicial + $total + $banco_entrada) - $total_pagos;
        $cargo = $banco->saldo_inicial + $total + $banco_entrada;
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
                            $ {{ number_format($cargo, 0, '.', ',') }}
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
                            $ {{ number_format($total_pagos, 0, '.', ',') }}
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
                            $ {{ number_format($saldo, 0, '.', ',') }}
                        </h5>
                        <span class="text-white text-sm">Saldo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid my-5 py-2">
    <div class="row">
      <div class="col-md-8 col-sm-10 mx-auto">
        <form class="" action="index.html" method="post">
          <div class="card my-sm-5 my-lg-0">
            <div class="card-header text-center">
              <div class="row justify-content-between">
                <div class="col-md-4 text-start">
                    @if ($configuracion->logo == NULL)
                        <img class="mb-2 w-25 p-2" src="{{asset('img/logo.jpg') }}" alt="Logo">
                    @else
                        <img class="mb-2 w-25 p-2" src="{{asset('logo/'.$configuracion->logo) }}" alt="Logo">
                    @endif

                  <h6>
                    Reporte de Banco
                  </h6>
                  <p class="d-block text-secondary">{{$banco->nombre_banco}}</p>
                    <a href="{{ route('pdf.print_banco', $banco->id) }}" class="btn" style="background: {{$configuracion->color_boton_close}}; color: #ffff; margin-right: 3rem;">
                        Reporte
                    </a>
                </div>
                <div class="col-lg-3 col-md-7 text-md-end text-start mt-5">
                  <h6 class="d-block mt-2 mb-0">Nombre Beneficiario:</h6>
                  <p class="text-secondary">{{$banco->nombre_beneficiario}} <br> {{$banco->cuenta_bancaria}}</p>
                </div>
              </div>
              <br>
              <div class="row justify-content-md-between">
                <div class="col-md-4 mt-auto">
                  <h6 class="mb-0 text-start text-secondary">
                    Saldo
                  </h6>
                  <h5 class="text-start mb-0">
                   ${{ number_format($saldo, 0, '.', ',') }}
                  </h5>
                </div>
                <div class="col-lg-5 col-md-7 mt-auto">
                  <div class="row mt-md-5 mt-4 text-md-end text-start">
                    <div class="col-md-6">
                      <h6 class="text-secondary mb-0">Inicio de Semana:</h6>
                    </div>
                    <div class="col-md-6">
                      <h6 class="text-dark mb-0">{{ \Carbon\Carbon::parse($startOfWeek)->translatedFormat('j \d\e F') }}</h6>
                    </div>
                  </div>
                  <div class="row text-md-end text-start">
                    <div class="col-md-6">
                      <h6 class="text-secondary mb-0">Dia actual:</h6>
                    </div>
                    <div class="col-md-6">
                      <h6 class="text-dark mb-0">{{ \Carbon\Carbon::parse($fecha)->translatedFormat('j \d\e F') }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive border-radius-lg">
                    <table class="table text-right">
                      <thead class="bg-default">
                        <tr>
                          <th scope="col" class="pe-2 text-start ps-2 text-white">Fecha</th>
                          <th scope="col" class="pe-2 text-white">Contenedor</th>
                          <th scope="col" class="pe-2 text-white" colspan="2">Cobros</th>
                          <th scope="col" class="pe-2 text-white">Pagos</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($combined as $item)
                            @if(isset($item->fecha_pago))
                                <tr>
                                    <td class="ps-4">{{ \Carbon\Carbon::parse($item->fecha_pago)->translatedFormat('j \d\e F') }}</td>
                                    <td class="text-start">
                                        @if(!isset($item->id_operador))
                                            @if(isset($item->DocCotizacion))
                                                <a href="{{ route('edit.cotizaciones', $item->id) }}">
                                                    {{ $item->DocCotizacion->num_contenedor }} <br>
                                                    <b style="color: #c22237">{{ $item->Cliente->nombre }}</b>
                                                </a>
                                            @elseif(isset($item->Cliente))
                                                <a data-bs-toggle="collapse" href="#pagesEntrada{{ $item->id }}" aria-controls="pagesEntrada" role="button" aria-expanded="false">
                                                    Varios <br> <b>{{ $item->Cliente->nombre }}</b>
                                                </a>
                                                @if ($item->contenedores != null)
                                                    <div class="collapse " id="pagesEntrada{{ $item->id }}">
                                                        Contenedores y Abonos
                                                        <ul>
                                                            @php
                                                                $contenedoresAbonos = json_decode($item->contenedores, true);
                                                            @endphp
                                                            @foreach ($contenedoresAbonos as $contenedorAbono)
                                                                <li>{{ $contenedorAbono['num_contenedor'] }} - ${{ number_format($contenedorAbono['abono'], 2, '.', ',') }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            @endif
                                        @else
                                            @if(isset($item->contenedores))
                                                <a data-bs-toggle="collapse" href="#pagesOperadores{{ $item->id }}" aria-controls="pagesOperadores" role="button" aria-expanded="false">
                                                    Liquidación Varios <br> <b style="color: #226dc2">{{ $item->Operador->nombre }}</b>
                                                </a>
                                                <div class="collapse " id="pagesOperadores{{ $item->id }}">
                                                    Contenedores y Abonos
                                                    <ul>
                                                        @php
                                                            $contenedoresAbonos = json_decode($item->contenedores, true);
                                                        @endphp
                                                        @foreach ($contenedoresAbonos as $contenedorAbono)
                                                            <li>{{ $contenedorAbono['num_contenedor'] }} - ${{ number_format($contenedorAbono['abono'], 2, '.', ',') }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @elseif(isset($item->id_cotizacion))
                                                <a  href="{{ route('edit.cotizaciones', $item->id_cotizacion) }}">
                                                    {{ $item->Asignacion->Contenedor->num_contenedor }}
                                                    <br> <b style="color: #226dc2">{{ $item->Operador->nombre }}</b>
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="ps-4 penultima-columna" colspan="2">
                                        @if(!isset($item->id_operador))
                                            @if (isset($item->id_banco1) && $item->id_banco1 == $banco->id)
                                                $ {{ number_format($item->monto1, 0, '.', ',') }}
                                            @else
                                                $ {{ number_format($item->monto2, 0, '.', ',') }}
                                            @endif
                                        @endif
                                    </td>
                                    <td class="ps-4 ultima-columna">
                                        @if(isset($item->id_operador))
                                            @if (isset($item->id_banco1) && $item->id_banco1 == $banco->id)
                                                $ {{ number_format($item->monto1, 0, '.', ',') }}
                                            @else
                                                $ {{ number_format($item->monto2, 0, '.', ',') }}
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @elseif(isset($item->fecha_pago_proveedor))
                                <tr>
                                    <td class="ps-4">{{ \Carbon\Carbon::parse($item->fecha_pago_proveedor)->translatedFormat('j \d\e F') }}</td>
                                    <td class="text-start">
                                        <a href="{{ route('edit.cotizaciones', $item->id) }}">
                                            {{ $item->DocCotizacion->num_contenedor }} <br>
                                            <b style="color: #22c2ba">{{ $item->DocCotizacion->Asignaciones->Proveedor->nombre }}</b>
                                        </a>
                                    </td>
                                    <td class="ps-4" colspan="2"></td>
                                    <td class="ps-4 ultima-columna">
                                        @if (isset($item->id_prove_banco1) && $item->id_prove_banco1 == $banco->id)
                                            $ {{ number_format($item->prove_monto1, 0, '.', ',') }}
                                        @else
                                            $ {{ number_format($item->prove_monto2, 0, '.', ',') }}
                                        @endif
                                    </td>
                                </tr>
                            @elseif(isset($item->fecha))
                                <tr>
                                    <td class="ps-4">{{ \Carbon\Carbon::parse($item->fecha)->translatedFormat('j \d\e F') }}</td>
                                    <td class="text-start"><b style="color: #c24f22">{{ $item->motivo }}</b></td>
                                    <td class="ps-4" colspan="2"></td>
                                    <td class="ps-4 ultima-columna"> $ {{ number_format($item->monto1, 0, '.', ',') }}</td>
                                </tr>
                            @endif
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th></th>
                          <th class="h5 ps-4" colspan="2">SubTotal</th>
                          <td id="totalPenultimaColumna" colspan="1" class="text-right h5 ps-4"></td>
                          <td id="totalUltimaColumna" colspan="1" class="text-right h5 ps-4"></td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="h5 ps-4" colspan="2">Total</th>
                            <td id="diferenciaColumna" colspan="1" class="text-right h5 ps-4"></td>
                          </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection
@section('datatable')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Calcular el total de la penúltima columna
        let totalPenultima = 0;
        document.querySelectorAll('.penultima-columna').forEach(function(cell) {
            let text = cell.textContent.trim().replace('$', '').replace(/,/g, '');
            totalPenultima += parseFloat(text) || 0;
        });
        document.getElementById('totalPenultimaColumna').textContent = `$ ${totalPenultima.toLocaleString('en-US')}`;

        // Calcular el total de la última columna
        let totalUltima = 0;
        document.querySelectorAll('.ultima-columna').forEach(function(cell) {
            let text = cell.textContent.trim().replace('$', '').replace(/,/g, '');
            totalUltima += parseFloat(text) || 0;
        });
        document.getElementById('totalUltimaColumna').textContent = `$ ${totalUltima.toLocaleString('en-US')}`;

        // Calcular la diferencia y mostrarla
        let diferencia = totalPenultima - totalUltima;
        document.getElementById('diferenciaColumna').textContent = `$ ${diferencia.toLocaleString('en-US')}`;
    });
</script>

@endsection
