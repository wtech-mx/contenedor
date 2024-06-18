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
        @foreach ($cotizaciones as $cotizacion)
            @php
                $total_oficial = ($cotizacion->base_factura + $cotizacion->iva) - $cotizacion->retencion;
                $base_taref = ($cotizacion->burreo + $cotizacion->maniobra + $cotizacion->sobrepeso + $cotizacion->otro + $cotizacion->precio_viaje) - $cotizacion->base_factura;
                $importe_vta = $base_taref + $total_oficial;

                $totalOficialSum += $total_oficial;
                $totalnoofi += $base_taref;
                $importeVtaSum += $importe_vta;
            @endphp
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
                        <tr>
                            <td>{{ $cotizacion->DocCotizacion->num_contenedor }}</td>
                            <td style="color: #020202; background: yellow;">
                                @if ($cotizacion->id_subcliente != NULL)
                                {{ $cotizacion->Subcliente->nombre }}
                                @else
                                {{ $cotizacion->Cliente->nombre }}
                                @endif
                            </td>
                            <td style="color: #ffffff; background: #2778c4;">{{$cotizacion->destino}}</td>
                            <td>{{$cotizacion->peso_contenedor}}</td>
                            <td>{{$cotizacion->tamano}}</td>
                            <td>$ {{ number_format($cotizacion->burreo, 1, '.', ',')}}</td>
                            <td>$ {{ number_format($cotizacion->maniobra, 1, '.', ',')}}</td>
                            <td>$ {{ number_format($cotizacion->sobrepeso, 1, '.', ',')}}</td>
                            <td>$ {{ number_format($cotizacion->otro, 1, '.', ',')}}</td>
                            <td>$ {{ number_format($cotizacion->precio_viaje, 1, '.', ',')}}</td>

                            <td>$ {{ number_format($cotizacion->base_factura, 1, '.', ',')}}</td>
                            <td>$ {{ number_format($cotizacion->iva, 1, '.', ',')}}</td>
                            <td>$ {{ number_format($cotizacion->retencion, 1, '.', ',')}}</td>
                            <td>$ {{ number_format($cotizacion->base_taref, 1, '.', ',')}}</td>
                            <td>
                                @php
                                    $total_oficial = ($cotizacion->base_factura + $cotizacion->iva) - $cotizacion->retencion;
                                @endphp
                                $ {{ number_format($total_oficial, 1, '.', ',')}}
                            </td>
                            <td>
                                @php
                                    $total_no_ofi = ($cotizacion->burreo + $cotizacion->maniobra + $cotizacion->sobrepeso + $cotizacion->otro + $cotizacion->precio_viaje) - $cotizacion->base_factura;
                                @endphp
                                $ {{ number_format($total_no_ofi, 1, '.', ',')}}</td>
                            <td>
                                @php
                                    $importe_vta = $cotizacion->base_taref + $total_oficial;
                                @endphp
                                $ {{ number_format($importe_vta, 1, '.', ',')}}
                            </td>
                        </tr>
                    </tbody>
                </table>
        @endforeach
        <h2 style="page-break-before: always; text-align: center;"></h2>
        <div class="totales">
            <h3 style="color: #000000; background: rgb(0, 174, 255);">Totales</h3>
            <p>Total oficial: <b> ${{ number_format($totalOficialSum, 1, '.', ',') }} </b></p>
            <p>Total no oficial: <b> ${{ number_format($totalnoofi, 1, '.', ',') }} </b></p>
            <p>Importe vta: <b> ${{ number_format($importeVtaSum, 1, '.', ',') }} </b></p>
        </div>
        <div class="totales">
            <h3 style="color: #000000; background: yellow;">Oficial</h3>
            @foreach ($bancos_oficiales as $banco_oficial)
                <p>Nombre: <b> {{$banco_oficial->nombre_beneficiario}} </b></p>
                <p>Banco: <b> {{$banco_oficial->nombre_banco}} </b></p>
                <p>No. CLABE: <b> {{$banco_oficial->clabe}} </b></p>
                <p>No. CTA : <b> {{$banco_oficial->cuenta_bancaria}} </b></p>
            @endforeach
        </div>
        <div class="totales">
            <h3 style="color: #000000; background: rgb(255, 145, 0);">No oficial</h3>
            @foreach ($bancos_no_oficiales as $banco_oficial)
                <p>Nombre: <b> {{$banco_oficial->nombre_beneficiario}} </b></p>
                <p>Banco: <b> {{$banco_oficial->nombre_banco}} </b></p>
                <p>No. CLABE: <b> {{$banco_oficial->clabe}} </b></p>
                <p>No. CTA : <b> {{$banco_oficial->cuenta_bancaria}} </b></p>
            @endforeach
        </div>
    </body>
</html>
