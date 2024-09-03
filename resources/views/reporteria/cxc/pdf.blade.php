<!DOCTYPE html>
<html>
    <style>
        .registro-contenedor {
            border: 2px solid #000; /* Cambia el color y grosor del borde según tus necesidades */
            margin-bottom: 20px; /* Espacio entre cada registro */
            padding: 15px; /* Espacio interno alrededor de las tablas */
            border-radius: 5px; /* Bordes redondeados, opcional */
        }

        .registro-contenedor table {
            margin-bottom: 10px; /* Espacio entre tablas dentro del mismo contenedor */
        }

        .totales {
            margin-top: 20px;
        }

        .totales h3 {
            font-weight: bold;
        }

        .totales p {
            font-size: 1.2em;
            color: #000;
        }

        .margin_cero{
            padding: 0;
            margin: 0;
            font-size: 15px;
        }
    </style>
    <head>
        <title>Cotizaciones Seleccionadas</title>
    </head>

    <body>
        @php
            $totalOficialSum = 0;
            $totalnoofi = 0;
            $importeVtaSum = 0;
            $total_no_ofi = 0;
        @endphp

                <div class="contianer" style="position: relative">
                    <h4 class="margin_cero">Empresa: {{ $user->Empresa->nombre }}</h4>
                    <h4 class="margin_cero">Estado de cuenta</h4>
                    <h4 class="margin_cero">Cliente: {{ $cotizacion->Cliente->nombre }}</h4>
                </div>
                <div class="contianer" style="position: relative">
                    <h5 style="position: absolute;left:88%;">Generado el : {{ date("d-m-Y") }}</h5><br>
                </div>

                <table class="table text-white tabla-completa"  style="color: #000;width: 100%;padding: 30px; margin: 6px; font-size: 12px">
                    <thead>
                        <tr>
                            <th>Contratista</th>
                            <th>Contenedor</th>
                            <th>Facturado a</th>
                            <th>Destino</th>
                            <th>Peso</th>
                            <th>Tamaño contenedor</th>
                            <th>Burreo</th>
                            <th>Estadia</th>
                            <th>Sobre peso</th>
                            <th>Otro</th>
                            <th>Precio venta</th>

                            <th style="color: #000000; border-radius:3px; background: #56d1f7;">Base factura</th>
                            <th style="color: #000000; border-radius:3px; background: #56d1f7;">IVA</th>
                            <th style="color: #000000; border-radius:3px; background: #56d1f7;">Retención</th>
                            <th style="color: #000000; border-radius:3px; background: #2dce89;">Base taref</th>
                            <th style="color: #000000; border-radius:3px; background: yellow;">Total oficial</th>
                            <th style="color: #000000; border-radius:3px; background: #fb6340;">Total no oficial</th>
                            <th>Importe VTA</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;font-size: 100%;">
                        @foreach ($cotizaciones as $cotizacion)
                            @php
                                $total_oficial = ($cotizacion->DocCotizacion->Asignaciones->base1_proveedor + $cotizacion->DocCotizacion->Asignaciones->iva) - $cotizacion->DocCotizacion->Asignaciones->retencion;
                                $base_taref = $cotizacion->DocCotizacion->Asignaciones->total_proveedor - $cotizacion->DocCotizacion->Asignaciones->base1_proveedor - $cotizacion->DocCotizacion->Asignaciones->iva + $cotizacion->DocCotizacion->Asignaciones->retencion;

                                $importe_vta = $base_taref + $total_oficial;

                                $totalOficialSum += $total_oficial;
                                $totalnoofi += $base_taref;
                                $importeVtaSum += $importe_vta;
                            @endphp
                            <tr>
                                @if ($cotizacion->DocCotizacion->Asignaciones->id_proveedor == NULL)
                                    <td>-</td>
                                @else
                                    <td>{{ $cotizacion->DocCotizacion->Asignaciones->Proveedor->nombre }}</td>
                                @endif
                                <td>{{ $cotizacion->DocCotizacion->num_contenedor }}</td>
                                <td style="color: #020202; background: yellow;">
                                    @if ($cotizacion->id_subcliente != NULL)
                                    {{ $cotizacion->Subcliente->nombre }}
                                    @else

                                    @endif
                                </td>
                                <td style="color: #ffffff; background: #2778c4;">{{$cotizacion->destino}}</td>
                                <td>{{$cotizacion->peso_contenedor}}</td>
                                <td>{{$cotizacion->tamano}}</td>
                                <td>$ {{ number_format($cotizacion->DocCotizacion->Asignaciones->burreo, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->DocCotizacion->Asignaciones->maniobra, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->DocCotizacion->Asignaciones->sobrepeso_proveedor, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->DocCotizacion->Asignaciones->otro, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->DocCotizacion->Asignaciones->precio, 2, '.', ',')}}</td>

                                <td>$ {{ number_format($cotizacion->DocCotizacion->Asignaciones->base1_proveedor, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->DocCotizacion->Asignaciones->iva, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->DocCotizacion->Asignaciones->retencion, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->DocCotizacion->Asignaciones->base2_proveedor, 2, '.', ',')}}</td>
                                <td>
                                    @php
                                        $total_oficial = ($cotizacion->DocCotizacion->Asignaciones->base1_proveedor + $cotizacion->DocCotizacion->Asignaciones->iva) - $cotizacion->DocCotizacion->Asignaciones->retencion;
                                    @endphp
                                    $ {{ number_format($total_oficial, 2, '.', ',')}}
                                </td>
                                <td>
                                    @php
                                        $total_no_ofi = $cotizacion->DocCotizacion->Asignaciones->total_proveedor - $cotizacion->DocCotizacion->Asignaciones->base1_proveedor - $cotizacion->DocCotizacion->Asignaciones->iva + $cotizacion->DocCotizacion->Asignaciones->retencion;
                                    @endphp
                                    $ {{ number_format($total_no_ofi, 2, '.', ',')}}</td>
                                <td>
                                    @php
                                        $importe_vta2 = $total_oficial + $total_no_ofi;
                                    @endphp
                                    $ {{ number_format($importe_vta2, 2, '.', ',')}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @php
                    // Recopila los IDs de los proveedores únicos de las cotizaciones, excluyendo NULL
                    $proveedoresIds = $cotizaciones->pluck('DocCotizacion.Asignaciones.id_proveedor')->filter()->unique();
                    // Carga los proveedores con sus cuentas bancarias usando los IDs recopilados
                    $proveedoresConCuentas = App\Models\Proveedor::whereIn('id', $proveedoresIds)
                                            ->with('CuentasBancarias')
                                            ->get();

                    $cotizacionesPorProveedor = $cotizaciones->groupBy('DocCotizacion.Asignaciones.id_proveedor');
                @endphp

                @foreach ($proveedoresConCuentas as $proveedor)
                    <h3>Proveedor: {{ $proveedor->nombre }}</h3>
                    @if ($proveedor->CuentasBancarias->isEmpty())
                        <p>No hay cuentas bancarias registradas para este proveedor.</p>
                    @else
                        <table class="table text-white tabla-completa sin_margem" style="color: #000;width: 100%;padding: 30px; font-size: 12px">
                            <tbody style="text-align: center;font-size: 100%;">
                                @php
                                    $contador = 1;

                                    $totalCuenta1 = 0;
                                    $totalCuenta2 = 0;

                                    // Revisa si hay cotizaciones para este proveedor
                                    if (isset($cotizacionesPorProveedor[$proveedor->id])) {
                                        $cotizacionesProveedor = $cotizacionesPorProveedor[$proveedor->id];

                                        // Calcula los totales por proveedor
                                        foreach ($cotizacionesProveedor as $cotizacion) {
                                            $cuenta_1 = $cotizacion->DocCotizacion->Asignaciones->base1_proveedor + $cotizacion->DocCotizacion->Asignaciones->iva - $cotizacion->DocCotizacion->Asignaciones->retencion;
                                            $cuenta_2 = $cotizacion->DocCotizacion->Asignaciones->total_proveedor - $cotizacion->DocCotizacion->Asignaciones->base1_proveedor - $cotizacion->DocCotizacion->Asignaciones->iva + $cotizacion->DocCotizacion->Asignaciones->retencion;

                                            $totalCuenta1 += $cuenta_1;
                                            $totalCuenta2 += $cuenta_2;
                                        }
                                    }
                                @endphp
                                <tr>
                                    @foreach ($proveedor->CuentasBancarias as $cuenta)
                                        <td>
                                            <p>Cuenta #{{ $contador }}</p>
                                            <p>Beneficiario: <b>{{ $cuenta->nombre_beneficiario }}</b></p>
                                            <p>Banco: <b>{{ $cuenta->nombre_banco }}</b></p>
                                            <p>Cuenta: <b>{{ $cuenta->cuenta_bancaria }}</b></p>
                                            <p>Clave: <b>{{ $cuenta->cuenta_clabe }}</b></p>
                                            @if ($contador == 1)
                                                <p class="sin_espacios2">A pagar:<b>${{ number_format($totalCuenta1, 2, '.', ',') }}</b></p>
                                            @endif
                                            @if ($contador == 2)
                                                <p class="sin_espacios2">A pagar:<b>${{ number_format($totalCuenta2, 2, '.', ',') }}</b></p>
                                            @endif
                                        </td>
                                        @php
                                            $contador++;
                                        @endphp
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    @endif
                @endforeach

        <div class="totales">
            <h3 class="margin_cero" style="color: #000000; background: rgb(0, 174, 255);">Totales</h3>
            <p class="margin_cero">Total oficial: <b class="margin_cero"> ${{ number_format($totalOficialSum, 2, '.', ',') }} </b></p>
            <p class="margin_cero">Total no oficial: <b class="margin_cero"> ${{ number_format($totalnoofi, 2, '.', ',') }} </b></p>
            <p class="margin_cero">Importe vta: <b class="margin_cero"> ${{ number_format($importeVtaSum, 2, '.', ',') }} </b></p>
        </div>
    </body>
</html>
