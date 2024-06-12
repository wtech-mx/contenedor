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
        <title>Cuentas por pagar</title>
    </head>

    <body>
        @php
            $importeCT = 0;
            $pagar1 = 0;
            $pagar2 = 0;
        @endphp
        @foreach ($cotizaciones as $cotizacion)
            @php
                $total_oficial = ($cotizacion->burreo + $cotizacion->estadia + $cotizacion->Contenedor->Cotizacion->sobrepeso + $cotizacion->otro + $cotizacion->iva + $cotizacion->precio) - $cotizacion->retencion;
                $base_factura = ($cotizacion->Contenedor->Cotizacion->base_factura + $cotizacion->iva) - $cotizacion->retencion;
                $importe_vta = $total_oficial - $base_factura;

                $importeCT += $total_oficial;
                $pagar1 += $base_factura;
                $pagar2 += $importe_vta;
            @endphp
            <div class="registro-contenedor">
                <table class="table text-white tabla-completa" style="color: #000;width: 100%;padding: 30px;">
                    <thead>
                        <tr>
                            <th>Contenedor</th>
                            <th>Importe CT</th>
                            <th>A pagar 1</th>
                            <th>A pagar 2</th>
                            <th>Retención</th>
                            <th>IVA</th>
                            <th>Base factura</th>
                            <th>Precio viaje</th>
                            <th>Otro</th>
                            <th>Sobre peso</th>
                            <th>Estadia</th>
                            <th>Burreo</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;font-size: 100%;">
                        <tr>
                            <td>{{ $cotizacion->Contenedor->num_contenedor }}</td>
                            <td>${{ number_format($total_oficial, 1, '.', ',') }}</td>
                            <td>${{ number_format($base_factura, 1, '.', ',') }}</td>
                            <td>${{ number_format($importe_vta, 1, '.', ',') }}</td>
                            <td>${{ number_format($cotizacion->retencion, 1, '.', ',') }}</td>
                            <td>${{ number_format($cotizacion->iva, 1, '.', ',') }}</td>
                            <td>${{ number_format($cotizacion->Contenedor->Cotizacion->base_factura, 1, '.', ',') }}</td>
                            <td>${{ number_format($cotizacion->precio, 1, '.', ',') }}</td>
                            <td>${{ number_format($cotizacion->otro, 1, '.', ',') }}</td>
                            <td>${{ number_format($cotizacion->Contenedor->Cotizacion->sobrepeso, 1, '.', ',') }}</td>
                            <td>${{ number_format($cotizacion->estadia, 1, '.', ',') }}</td>
                            <td>${{ number_format($cotizacion->burreo, 1, '.', ',') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
        <div class="totales">
            <h3 style="color: #000000; background: rgb(0, 174, 255);">Totales</h3>
            <p>A pagar oficial: <b> ${{ number_format($pagar1, 1, '.', ',') }} </b></p>
            <p>A pagar no oficial: <b> ${{ number_format($pagar2, 1, '.', ',') }} </b></p>
            <p>Importe CT: <b> ${{ number_format($importeCT, 1, '.', ',') }} </b></p>
        </div>
    </body>
</html>
