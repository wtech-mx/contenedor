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

            <div class="contianer" style="position: relative">
                <h4>Empresa: {{ $user->Empresa->nombre }}</h4>
                <h4>Estado de cuenta</h4>
                <h4>Proveedor: {{ $cotizacion->Proveedor->nombre }}</h4>
            </div>
            <div class="contianer" style="position: relative">
                <h5 style="position: absolute;left:75%;">Estado de cuenta por pagar : {{ date("d-m-Y") }}</h5><br>
            </div>

            <table class="table text-white tabla-completa" style="color: #000;width: 100%;padding: 30px; font-size: 12px">
                <thead>
                    <tr>
                        <th>Contratista</th>
                        <th>Contenedor</th>
                        <th>Importe CT</th>
                        <th>A pagar 1</th>
                        <th>A pagar 2</th>
                        <th>Retención</th>
                        <th>IVA</th>
                        <th>Base factura</th>
                        <th>Precio viaje</th>
                        <th>Otro</th>
                        {{-- <th>Sobre peso</th> --}}
                        <th>Estadia</th>
                        <th>Burreo</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;font-size: 100%;">
                        @php
                            $totalBaseFactura = 0;
                            $totalImporteVTA = 0;
                        @endphp
                    @foreach ($cotizaciones as $item)
                        @php
                            $total_oficial = ($item->burreo + $item->estadia + $item->otro + $item->iva + $item->precio) - $item->retencion;
                            $base_factura = ($item->Contenedor->Cotizacion->base_factura + $item->iva) - $item->retencion;
                            $importe_vta = $total_oficial - $base_factura;

                            $importeCT += $total_oficial;
                            $pagar1 += $base_factura;
                            $pagar2 += $importe_vta;

                            $totalBaseFactura += $base_factura;
                            $totalImporteVTA += $importe_vta;
                        @endphp
                        <tr>
                            <td>{{ $cotizacion->Proveedor->nombre }}</td>
                            <td>{{ $item->Contenedor->num_contenedor }}</td>
                            <td>${{ number_format($total_oficial, 2, '.', ',') }}</td>
                            <td>${{ number_format($base_factura, 2, '.', ',') }}</td>
                            <td>${{ number_format($importe_vta, 2, '.', ',') }}</td>
                            <td>${{ number_format($item->retencion, 2, '.', ',') }}</td>
                            <td>${{ number_format($item->iva, 2, '.', ',') }}</td>
                            <td>${{ number_format($item->Contenedor->Cotizacion->base_factura, 2, '.', ',') }}</td>
                            <td>${{ number_format($item->precio, 2, '.', ',') }}</td>
                            <td>${{ number_format($item->otro, 2, '.', ',') }}</td>
                            {{-- <td>${{ number_format($item->Contenedor->item->precio_tonelada, 2, '.', ',') }}</td> --}}
                            <td>${{ number_format($item->estadia, 2, '.', ',') }}</td>
                            <td>${{ number_format($item->burreo, 2, '.', ',') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        <div class="totales">
            <h3 style="color: #000000; background: rgb(24, 192, 141);">Contratista</h3>
            <h4>A pagar 1: ${{ number_format($totalBaseFactura, 2, '.', ',') }}<b></b></h4>
            <h4>A pagar 2: ${{ number_format($totalImporteVTA, 2, '.', ',') }}<b></b></h4>
            @php
                $contador = 1;
            @endphp
            @foreach ($cotizacion->Proveedor->CuentasBancarias as $cuentas)
                <p>Cuenta #{{ $contador }}</p>
                <p>Beneficiario: <b> {{ $cuentas->nombre_beneficiario }} </b></p>
                <p>Banco: <b> {{ $cuentas->nombre_banco }} </b></p>
                <p>Cuenta: <b> {{ $cuentas->cuenta_bancaria }}</b></p>
                <p>Clave: <b> {{ $cuentas->cuenta_clabe }}</b></p>
                @php
                    $contador++;
                @endphp
            @endforeach
        </div>

        <div class="totales">
            <h3 style="color: #000000; background: rgb(0, 174, 255);">Totales</h3>
            <p>A pagar oficial: <b> ${{ number_format($pagar1, 2, '.', ',') }} </b></p>
            <p>A pagar no oficial: <b> ${{ number_format($pagar2, 2, '.', ',') }} </b></p>
            <p>Importe CT: <b> ${{ number_format($importeCT, 2, '.', ',') }} </b></p>
        </div>
    </body>
</html>
