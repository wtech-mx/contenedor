<!DOCTYPE html>
<html>
    @php
        use Carbon\Carbon;
    @endphp
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
        <title>Utilidades</title>
    </head>

    <body>

            <div class="contianer" style="position: relative">
                <h4>Empresa: {{ $user->Empresa->nombre }}</h4>
                <h4>Utilidades</h4>
            </div>
            <div class="contianer" style="position: relative">
                <h5 style="position: absolute;left:75%;">Utilidades: {{ date("d-m-Y") }}</h5><br>
            </div>

            <table class="table text-white tabla-completa" style="color: #000;width: 100%;padding: 30px; font-size: 12px">
                <thead>
                    <tr>
                        <th>Contenedor</th>
                        <th>Cliente</th>
                        <th>Subcliente</th>
                        <th>Origen</th>
                        <th>Destino</th>
                        <th>Utilidad</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;font-size: 100%;">
                    @foreach ($cotizaciones as $cotizacion)
                        <tr>
                            <td>{{$cotizacion->Contenedor->num_contenedor}}</td>
                            <td>{{$cotizacion->Contenedor->Cotizacion->Cliente->nombre}}</td>
                            <td>
                                @if ($cotizacion->Contenedor->Cotizacion->id_subcliente != NULL)
                                    {{$cotizacion->Contenedor->Cotizacion->Subcliente->nombre}} / {{$cotizacion->Contenedor->Cotizacion->Subcliente->telefono}}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{$cotizacion->Contenedor->Cotizacion->origen}}</td>
                            <td>{{$cotizacion->Contenedor->Cotizacion->destino}}</td>
                            <td>{{$cotizacion->Contenedor->Cotizacion->estatus}}</td>
                            <td>
                                @php
                                    if($cotizacion->total_proveedor == NULL){
                                        $utilidad = $cotizacion->Contenedor->Cotizacion->total - $cotizacion->pago_operador;
                                    }elseif($cotizacion->total_proveedor != NULL){
                                        $utilidad = $cotizacion->Contenedor->Cotizacion->total - $cotizacion->total_proveedor;
                                    }else{
                                        $utilidad = 0;
                                    }
                                @endphp
                            <b> ${{ number_format($utilidad, 2, '.', ',') }}</b>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </body>
</html>
