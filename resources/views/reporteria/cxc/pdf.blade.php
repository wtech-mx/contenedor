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
                    <h4>Empresa: {{ $user->Empresa->nombre }}</h4>
                    <h4>Estado de cuenta</h4>
                    <h4>Cliente: {{ $cotizacion->Cliente->nombre }}</h4>
                </div>
                <div class="contianer" style="position: relative">
                    <h5 style="position: absolute;left:88%;">Generado el : {{ date("d-m-Y") }}</h5><br>
                </div>

                <table class="table text-white tabla-completa"  style="color: #000;width: 100%;padding: 30px; margin: 6px; font-size: 12px">
                    <thead>
                        <tr>
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
                                $total_oficial = ($cotizacion->base_factura + $cotizacion->iva) - $cotizacion->retencion;
                                $base_taref = ($cotizacion->burreo + $cotizacion->maniobra + $cotizacion->precio_tonelada + $cotizacion->otro + $cotizacion->precio_viaje) - $cotizacion->base_factura;
                                $importe_vta = $base_taref + $total_oficial;

                                $totalOficialSum += $total_oficial;
                                $totalnoofi += $base_taref;
                                $importeVtaSum += $importe_vta;
                            @endphp
                            <tr>
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
                                <td>$ {{ number_format($cotizacion->burreo, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->maniobra, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->precio_tonelada, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->otro, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->precio_viaje, 2, '.', ',')}}</td>

                                <td>$ {{ number_format($cotizacion->base_factura, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->iva, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->retencion, 2, '.', ',')}}</td>
                                <td>$ {{ number_format($cotizacion->base_taref, 2, '.', ',')}}</td>
                                <td>
                                    @php
                                        $total_oficial = ($cotizacion->base_factura + $cotizacion->iva) - $cotizacion->retencion;
                                    @endphp
                                    $ {{ number_format($total_oficial, 2, '.', ',')}}
                                </td>
                                <td>
                                    @php
                                        $total_no_ofi = ($cotizacion->burreo + $cotizacion->maniobra + $cotizacion->sobrepeso + $cotizacion->otro + $cotizacion->precio_viaje) - $cotizacion->base_factura;
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

        <div class="totales">
            <h3 style="color: #000000; background: rgb(0, 174, 255);">Totales</h3>
            <p>Total oficial: <b> ${{ number_format($totalOficialSum, 2, '.', ',') }} </b></p>
            <p>Total no oficial: <b> ${{ number_format($totalnoofi, 2, '.', ',') }} </b></p>
            <p>Importe vta: <b> ${{ number_format($importeVtaSum, 2, '.', ',') }} </b></p>
        </div>
    </body>
</html>
