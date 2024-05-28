<!DOCTYPE html>
    <html>
        <style type="text/css" media="screen">
            body{

            }
            .img-log{
                padding: 20px;
                width:50%;
            }

            .cotizacion{
                position: absolute;
                right: 3%;
                top: 0%;
                padding: 30px;
                font-size: 80px;
            }
            .fecha{
                position: absolute;
                right: 3%;
                padding: 30px;
                font-size: 30px;
            }
            .mensaje{
                padding: 20px 0px 0px 0px;
            }
            .from{
                font-size: 40px;
            }
            .para{
                font-size: 20px;
            }
            .tabla-completa{
                width: 100%;
                padding: 30px;
            }
            .tabla-azul{
                padding: 100px;
            }
            .tr{
                background-color: #47A0CD;
                height: 40px;
            }
            td{
                height: 40px;
            }
            tbody{
                text-align: center;
                font-size: 120%;
            }
            .costos{
                position: absolute;
                right: 5%;
                padding: 30px;
                font-size: 20px;
            }
            .totalsub{
                padding: 30px;
            }
            .sub{
                padding: 30px;
            }
            .tota{
                padding: 30px;
            }
            .datos-contacto{
                font-size: 20px;
                text-decoration: none;
            }
            .gracias{
                position: absolute;
                right: 5%;
                padding: 30px;
                font-size: 30px;
            }
            .footer{

            }
            .pag{
                position: absolute;
                text-decoration: none;
                color: #fff;
                left: 40%;
                display:block;
            }
            .container{
                z-index: 1000;
            }
            .padre {
                padding: 0 1rem;
            }
            .hijo_uno {
            /* IMPORTANTE */
            width: 200px;
            margin-left: auto;
            margin-right: auto;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <body style="background-color: #fff ;">
            <div class="container">
                <div class="row" style="padding: 20px 0px 0px 0px;">
                    <div style="width: 50%; float:left">
                        <img alt="Bootstrap Image Preview" src="{{ asset('img/logo.jpg') }}" style="width:80%; right: 5%;">
                    </div>

                </div>

                <div class="padre">
                    <div class="hijo_uno">
                        <h3 style="color: #47A0CD;font-size: 40px;">Recibo</h3>
                    </div>
                </div>

                <div class="row" >
                    <div style="width: 50%; float:left">
                        <blockquote class="blockquote">
                            <p class="display-4 from" style="color: #47A0CD;font-size: 25px;">
                                <strong>Datos Generales </strong>
                            </p>
                            <p class="text-right  text-white" style="color: #000;font-size: 18px;">
                                Nombre:
                            </p>
                            <p class="text-right  text-white" style="color: #000;font-size: 18px;">
                                Empresa:
                            </p>
                            <p class="text-right  text-white" style="color: #000;font-size: 18px;">
                                Telefono:
                            </p>
                        </blockquote>
                    </div>

                    <div style="width: 50%; float:right">
                        <blockquote class="blockquote">
                            <p class="display-4 from" style="color: #47A0CD;font-size: 25px;">
                                <strong>Datos del cliente </strong>
                            </p>

                                <p class="blockquote-footer text-white para" style="color: #000;font-size: 18px;">
                                    Nombre: {{ $cotizacion->Cliente->nombre }}
                                </p>

                                <p class="blockquote-footer text-white para" style="color: #000;font-size: 18px;">
                                    Telefono: {{ $cotizacion->Cliente->telefono }}
                                </p>

                                <p class="blockquote-footer text-white para" style="color: #000;font-size: 18px;">
                                    Correo: {{ $cotizacion->Cliente->correo }}
                                </p>

                                <p class="blockquote-footer text-white para" style="color: #000;font-size: 18px;">
                                    Facturado A:
                                </p>
                        </blockquote>
                    </div>
                </div>

                <div class="row mt-5" style="position: relative;">
                    <div class="col-md-12">
                        <h5>Datos del Contenedor</h5>
                        <table id="ejemplo" class="table text-white tabla-completa" style="color: #000;width: 100%;padding: 30px;">
                            <thead class="tabla-azul" style="padding: 100px;">
                                <tr class="tr" style="background-color: #47A0CD;height: 40px; color: #ffffff;">
                                    <th >
                                        Contenedor
                                    </th>

                                    <th >
                                        Destino
                                    </th>

                                    <th >
                                        Peso
                                    </th>

                                    <th>
                                        Tamaño Contenedor
                                    </th>
                                </tr>
                            </thead>

                            <tbody style="text-align: center;font-size: 120%;">
                                <th>
                                    {{$documentacion->num_contenedor}}
                                </th>

                                <th>
                                    {{$cotizacion->destino}}
                                </th>

                                <th>
                                    {{$cotizacion->peso_contenedor}}
                                </th>

                                <th>
                                    {{$cotizacion->tamano}}
                                </th>
                            </tbody>
                        </table>

                        <h5>Costos de Contenedor</h5>

                        <table id="ejemplo" class="table text-white tabla-completa" style="color: #000;width: 100%;padding: 30px;">
                            <thead class="tabla-azul" style="padding: 100px;">
                                <tr class="tr" style="background-color: #47A0CD;height: 40px; color: #ffffff;">
                                    <th >
                                        Burreo
                                    </th>

                                    <th >
                                        Estadia
                                    </th>

                                    <th >
                                        Peso
                                    </th>

                                    <th>
                                        sobre Peso
                                    </th>

                                    <th>
                                        Otro
                                    </th>
                                </tr>
                            </thead>

                            <tbody style="text-align: center;font-size: 120%;">
                                <th>
                                    $ {{$documentacion->burreo}} .0
                                </th>

                                <th>
                                    $ {{$cotizacion->estadia}} .0
                                </th>

                                <th>
                                    $ {{$cotizacion->cot_peso_contenedor}} .0
                                </th>

                                <th>
                                    $ {{$cotizacion->sobrepeso}} .0
                                </th>

                                <th>
                                    $ {{$cotizacion->cot_otro}} .0
                                </th>
                            </tbody>

                        </table>


                            <h5>Costos de Contenedor</h5>

                            <table id="ejemplo" class="table text-white tabla-completa" style="color: #000;width: 100%;padding: 30px;">
                                <thead class="tabla-azul" style="padding: 100px;">
                                    <tr class="tr" style="background-color: #47A0CD;height: 40px; color: #ffffff;">
                                        <th >
                                            Precio de Venta
                                        </th>

                                        <th >
                                            Base Factura
                                        </th>

                                        <th >
                                            IVA
                                        </th>

                                        <th>
                                            Retencion
                                        </th>

                                        <th>
                                            Base Taref
                                        </th>

                                        <th>
                                            total oficial
                                        </th>

                                        <th>
                                            total no oficial
                                        </th>

                                        <th>
                                            Importe VTA
                                        </th>
                                    </tr>
                                </thead>

                            <tbody style="text-align: center;font-size: 120%;">

                                <th>
                                    $ {{$cotizacion->precio_viaje}} .0
                                </th>

                                <th>

                                </th>

                                <th>
                                    {{$cotizacion->IVA}}
                                </th>

                                <th>

                                </th>

                                <th>

                                </th>

                                <th>

                                </th>

                                <th>

                                </th>

                                <th>

                                </th>

                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-6">
                        <address class="text-white datos-contacto" style="color: #000;font-size: 20px;text-decoration: none;">
                            <p>
                            <ul style="color: #000"><p><strong>Nota: Estos son los numeros de cuenta</strong></p>
                                <li>Nombre: JOSE HEMSANI ZAPAN</li>
                                <li>Banco: Azteca</li>
                                <li>No. CLABE: 1271 8001 3811 684971</li>
                                <li>No. CTA : 4442 1381 1684 97</li>
                            </ul>
                            </p><br>
                            <p>
                                <ul style="color: #000"><p><strong>JAVIER GONZALEZ ALANIS</strong></p>
                                    <li>Nombre: JOSE HEMSANI ZAPAN</li>
                                    <li>Banco : BANORTE</li>
                                    <li>No. CLABE: 1271 8001 3811 684971</li>
                                    <li>No. CTA : 4442 1381 1684 97</li>
                                </ul>
                                </p><br>
                        </address>
                    </div>
                </div>
                <div class="contenedor-azul"style="background-color:#47A0CD;position: absolute;width: 60%;height:1%;left: 20%;right: 20%;">
                </div>

                <div class="row footer">
                    <div class="col-md-12">
                        <h3 class="text-center text-white " style="color: #000">
                            <a  class="text-center text-white pag" href="https://checkn-go.com.mx" target="blank" title="pagina eago" style="position: absolute;text-decoration: none;color: #fff;left: 40%;display:block;">checkn-go.com.mx
                            </a>
                        </h3>
                    </div>
                </div>
            </div>
        </body>
    </html>
