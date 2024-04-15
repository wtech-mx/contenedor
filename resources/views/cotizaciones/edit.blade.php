@extends('layouts.app')

@section('template_title')
   Editar Cotizacion
@endsection

@section('content')

    <div class="contaboleta_liberacionr-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a class="btn"  href="{{ route('index.cotizaciones') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                Regresar
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update.cotizaciones', $cotizacion->id) }}" id="" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-body">
                                <h3 class="mb-5">Datos de cotizacion</h3>
                                <div class="row">
                                        <div class="form-group">
                                            <label for="name">Cliente *</label>
                                            <select class="form-select cliente d-inline-block"  data-toggle="select" id="id_cliente" name="id_cliente" value="{{ old('id_cliente') }}">
                                                <option value="{{$cotizacion->id_cliente}}">{{$cotizacion->Cliente->nombre}} / {{$cotizacion->Cliente->telefono}}</option>
                                                @foreach ($clientes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nombre }} / {{ $item->telefono }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6 form-group">
                                            <label for="name">Origen</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/gps.webp') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_origen" id="cot_origen" type="text" class="form-control" value="{{$cotizacion->origen}}">
                                            </div>
                                        </div>

                                        <div class="col-6 form-group">
                                            <label for="name">Destino</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/origen.png') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_destino" id="cot_destino" type="text" class="form-control" value="{{$cotizacion->destino}}">
                                            </div>
                                        </div>

                                        <div class="col-6 form-group">
                                            <label for="name">Fecha modulación</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_fecha_modulacion" id="cot_fecha_modulacion" type="date" class="form-control" value="{{$cotizacion->fecha_modulacion}}">
                                            </div>
                                        </div>

                                        <div class="col-6 form-group">
                                            <label for="name">Fecha entrega</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_fecha_entrega" id="cot_fecha_entrega" type="date" class="form-control" value="{{$cotizacion->fecha_entrega}}">
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="name">Tamaño Contenedor</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/escala.png') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_tamano" id="cot_tamano" type="text" class="form-control"  value="{{$cotizacion->tamano}}">
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="name">Peso Reglamentario</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/perdida-de-peso.png') }}" alt="" width="25px">
                                                </span>
                                                <input name="peso_reglamentario" id="peso_reglamentario" type="number" class="form-control"  value="{{$cotizacion->peso_reglamentario}}">
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="name">Peso Contenedor</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/peso.png') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_peso_contenedor" id="cot_peso_contenedor" type="text" class="form-control" value="{{$cotizacion->peso_contenedor}}">
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="name">Sobrepeso</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/pesa-rusa.png') }}" alt="" width="25px">
                                                </span>
                                                <input name="sobrepeso" id="sobrepeso" type="text" class="form-control" readonly value="{{$cotizacion->sobrepeso}}">
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="name">Precio Sobre Peso</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/tonelada.png') }}" alt="" width="25px">
                                                </span>
                                                <input name="precio_sobre_peso" id="precio_sobre_peso" type="text" class="form-control" value="{{$cotizacion->precio_sobre_peso}}">
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="name">Precio Tonelada</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/tonelada.png') }}" alt="" width="25px">
                                                </span>
                                                <input name="precio_tonelada" id="precio_tonelada" type="text" class="form-control" value="{{$cotizacion->precio_tonelada}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6"></div>

                                        <div class="col-3 form-group">
                                            <label for="name">Precio Viaje</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_precio_viaje" id="cot_precio_viaje" type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()" value="{{$cotizacion->precio_viaje}}">
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="name">Burreo</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/burro.png') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_burreo" id="cot_burreo" type="float" class="form-control"onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()" value="{{$cotizacion->burreo}}">
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="name">Maniobra</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/logistica.png') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_maniobra" id="cot_maniobra" type="float" class="form-control"onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()" value="{{$cotizacion->maniobra}}">
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="name">Estadia</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/servidor-en-la-nube.png') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_estadia" id="cot_estadia" type="float" class="form-control"onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()" value="{{$cotizacion->estadia}}">
                                            </div>
                                        </div>

                                        <div class="col-4 form-group">
                                            <label for="name">Otros</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/inventario.png.webp') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_otro" id="cot_otro" type="float" class="form-control"onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()"  value="{{$cotizacion->otro}}">
                                            </div>
                                        </div>

                                        <div class="col-4 form-group">
                                            <label for="name">IVA</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/impuesto.png') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_iva" id="cot_iva" type="number" class="form-control"onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()" value="{{$cotizacion->iva}}">
                                            </div>
                                        </div>

                                        <div class="col-4 form-group">
                                            <label for="name">Retención</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/monedas.webp') }}" alt="" width="25px">
                                                </span>
                                                <input name="cot_retencion" id="cot_retencion" type="float" class="form-control"onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()" value="{{$cotizacion->retencion}}">
                                            </div>
                                        </div>

                                        <div class="col-4 form-group">
                                            <label for="name">Total Cotización</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('img/icon/monedas.webp') }}" alt="" width="25px">
                                                </span>
                                                <input name="total" id="total" type="float" class="form-control" readonly>
                                            </div>
                                        </div>
                                </div>

                                <div class="row">
                                    <h3 class="mb-5 mt-3">Bloque de Entrada</h3>

                                    <div class="col-4 form-group">
                                        <label for="name">Block</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/contenedores.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="bloque" id="bloque" type="text" class="form-control" value="{{$cotizacion->bloque}}">
                                        </div>
                                    </div>

                                    <div class="col-4 form-group">
                                        <label for="name">Horario Inicio</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/calendario.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="bloque_hora_i" id="bloque_hora_i" type="time" class="form-control" value="{{$cotizacion->bloque_hora_i}}">
                                        </div>
                                    </div>

                                    <div class="col-4 form-group">
                                        <label for="name">Horario Fin</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/calendario.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="bloque_hora_f" id="bloque_hora_f" type="time" class="form-control" value="{{$cotizacion->bloque_hora_f}}">
                                        </div>
                                    </div>

                                    <h3 class="mb-5 mt-3    ">Registrar Documentación</h3>

                                    <div class="col-6 form-group">
                                        <label for="name">Num. Contenedor</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/contenedor.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="num_contenedor" id="num_contenedor" type="text" class="form-control" value="{{$documentacion->num_contenedor}}">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Terminal(Nombre)</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/terminal.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="terminal" id="terminal" type="text" class="form-control" value="{{$documentacion->terminal}}">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Num. Autorización</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/persona-clave.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="num_autorizacion" id="num_autorizacion" type="text" class="form-control" value="{{$documentacion->num_autorizacion}}">
                                        </div>
                                    </div>

                                    <h3 class="mt-3 mb-5">Documentación</h3>

                                    <div class="col-6 form-group">
                                        <label for="name">Boleta de Liberación</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/boleto.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="boleta_liberacion" id="boleta_liberacion" type="file" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Doda</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/documento.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="doda" id="doda" type="file" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        @if (pathinfo($documentacion->boleta_liberacion, PATHINFO_EXTENSION) == 'pdf')
                                        <p class="text-center ">
                                            <iframe class="mt-2" src="{{asset('cotizaciones/cotizacion'. $cotizacion->id . '/' .$documentacion->boleta_liberacion)}}" style="width: 80%; height: 250px;"></iframe>
                                        </p>
                                                <a class="btn btn-sm text-dark" href="{{asset('cotizaciones/cotizacion'. $cotizacion->id . '/' .$documentacion->boleta_liberacion) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                        @elseif (pathinfo($documentacion->boleta_liberacion, PATHINFO_EXTENSION) == 'doc')
                                        <p class="text-center ">
                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 150px; height: 150px;"/>
                                        </p>
                                                <a class="btn btn-sm text-dark" href="{{asset('cotizaciones/cotizacion'. $cotizacion->id . '/' .$documentacion->boleta_liberacion) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                        @elseif (pathinfo($documentacion->boleta_liberacion, PATHINFO_EXTENSION) == 'docx')
                                        <p class="text-center ">
                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 150px; height: 150px;"/>
                                        </p>
                                                <a class="btn btn-sm text-dark" href="{{asset('cotizaciones/cotizacion'. $cotizacion->id . '/' .$documentacion->boleta_liberacion) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cotizaciones/cotizacion'. $cotizacion->id . '/' .$documentacion->boleta_liberacion) }}" alt="Imagen" style="width: 150px;height: 150%;"/><br>
                                            </p>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cotizaciones/cotizacion'. $cotizacion->id . '/' .$documentacion->boleta_liberacion) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                        @endif
                                    </div>

                                    <div class="col-6">
                                        @if (pathinfo($documentacion->doda, PATHINFO_EXTENSION) == 'pdf')
                                        <p class="text-center ">
                                            <iframe class="mt-2" src="{{asset('cotizaciones/cotizacion'. $cotizacion->id . '/' .$documentacion->doda)}}" style="width: 80%; height: 250px;"></iframe>
                                        </p>
                                                <a class="btn btn-sm text-dark" href="{{asset('cotizaciones/cotizacion'. $cotizacion->id . '/' .$documentacion->doda) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                        @elseif (pathinfo($documentacion->doda, PATHINFO_EXTENSION) == 'doc')
                                        <p class="text-center ">
                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 150px; height: 150px;"/>
                                        </p>
                                                <a class="btn btn-sm text-dark" href="{{asset('cotizaciones/cotizacion'. $cotizacion->id . '/' .$documentacion->doda) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                        @elseif (pathinfo($documentacion->doda, PATHINFO_EXTENSION) == 'docx')
                                        <p class="text-center ">
                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 150px; height: 150px;"/>
                                        </p>
                                                <a class="btn btn-sm text-dark" href="{{asset('cotizaciones/cotizacion'. $cotizacion->id . '/' .$documentacion->doda) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cotizaciones/cotizacion'. $cotizacion->id . '/' .$documentacion->doda) }}" alt="Imagen" style="width: 150px;height: 150%;"/><br>
                                            </p>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cotizaciones/cotizacion'. $cotizacion->id . '/' .$documentacion->doda) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                        @endif
                                    </div>

                                    <h3 class="mt-3 mb-5">Gastos Extras</h3>
                                    @foreach ($gastos_extras as $gasto_extra)
                                        <input type="hidden" name="ticket_id[]" value="{{ $gasto_extra->id }}">
                                        <div class="col-6 form-group">
                                            <p for="name" class="mb-4"> <img src="{{ asset('img/icon/inventario.png.webp') }}" alt="" width="25px"> <b>
                                                Descripción: </b><input name="gasto_descripcion[]" id="gasto_descripcion[]" type="text" class="form-control" value="{{$gasto_extra->descripcion}}">
                                            </p>
                                        </div>

                                        <div class="col-6 form-group">
                                            <p for="name" class="mb-4"> <img src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="" width="25px"> <b>
                                                Monto: </b><input name="gasto_monto[]" id="gasto_monto[]" type="text" class="form-control" value="{{$gasto_extra->monto}}">
                                            </p>
                                        </div>
                                    @endforeach
                                    <div id="formulario" class="mt-4">
                                        <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>
                                        <div class="clonars">
                                            <div class="row">
                                                <div class="col-6 form-group">
                                                    <p for="name" class="mb-4"> <img src="{{ asset('img/icon/inventario.png.webp') }}" alt="" width="25px"> <b>
                                                        Descripción: </b><input name="gasto_descripcion[]" id="gasto_descripcion[]" type="text" class="form-control">
                                                    </p>
                                                </div>

                                                <div class="col-6 form-group">
                                                    <p for="name" class="mb-4"> <img src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="" width="25px"> <b>
                                                        Monto: </b><input name="gasto_monto[]" id="gasto_monto[]" type="text" class="form-control">
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4 form-group">
                                        <label for="name">Total con gastos</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/monedas.webp') }}" alt="" width="25px">
                                            </span>
                                            <input type="float" class="form-control" value="{{$cotizacion->total}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('select2')
    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

    <script type="text/javascript">
    $(document).ready(function() {
    $('.cliente').select2();
    });
    </script>

    <script type="text/javascript">
        // ============= Agregar mas inputs dinamicamente =============
        $('.clonar').click(function() {
        // Clona el .input-group
        var $clone = $('#formulario .clonars').last().clone();

        // Borra los valores de los inputs clonados
        $clone.find(':input').each(function () {
            if ($(this).is('select')) {
            this.selectedIndex = 0;
            } else {
            this.value = '';
            }
        });

        // Agrega lo clonado al final del #formulario
        $clone.appendTo('#formulario');
        });

        function calcularTotal() {
            const precio_viaje = parseFloat(document.getElementById('cot_precio_viaje').value.replace(/,/g, '')) || 0;
            const burreo = parseFloat(document.getElementById('cot_burreo').value.replace(/,/g, '')) || 0;
            const retencion = parseFloat(document.getElementById('cot_retencion').value.replace(/,/g, '')) || 0;
            const iva = parseFloat(document.getElementById('cot_iva').value.replace(/,/g, '')) || 0;
            const otro = parseFloat(document.getElementById('cot_otro').value.replace(/,/g, '')) || 0;
            const estadia = parseFloat(document.getElementById('cot_estadia').value.replace(/,/g, '')) || 0;
            const maniobra = parseFloat(document.getElementById('cot_maniobra').value.replace(/,/g, '')) || 0;

            // Restar el valor de Retención del total
            const totalSinRetencion = precio_viaje + burreo + iva + otro + estadia + maniobra;
            const totalConRetencion = totalSinRetencion - retencion;

            // Obtener el valor de Precio Tonelada
            const precioTonelada = parseFloat(document.getElementById('precio_tonelada').value.replace(/,/g, '')) || 0;

            // Sumar el valor de Precio Tonelada al total
            const totalFinal = totalConRetencion + precioTonelada;

            // Formatear el total con comas
            const totalFormateado = totalFinal.toLocaleString('en-US');

            document.getElementById('total').value = totalFormateado;
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Obtener elementos del DOM
            var pesoReglamentarioInput = document.getElementById('peso_reglamentario');
            var pesoContenedorInput = document.getElementById('cot_peso_contenedor');
            var sobrepesoInput = document.getElementById('sobrepeso');
            var precioSobrePesoInput = document.getElementById('precio_sobre_peso');
            var precioToneladaInput = document.getElementById('precio_tonelada');

            // Agregar evento de cambio a los inputs
            pesoReglamentarioInput.addEventListener('input', calcularSobrepeso);
            pesoContenedorInput.addEventListener('input', calcularSobrepeso);

            // Función para calcular el sobrepeso
            function calcularSobrepeso() {
                var pesoReglamentario = parseFloat(pesoReglamentarioInput.value) || 0;
                var pesoContenedor = parseFloat(pesoContenedorInput.value) || 0;

                // Calcular sobrepeso
                var sobrepeso = Math.max(pesoContenedor - pesoReglamentario, 0);

                // Mostrar sobrepeso en el input correspondiente con dos decimales
                sobrepesoInput.value = sobrepeso.toFixed(2);

                // Obtener el valor de Precio Sobre Peso
                var precioSobrePeso = parseFloat(precioSobrePesoInput.value.replace(/,/g, '')) || 0;

                // Calcular el resultado de la multiplicación
                var resultado = sobrepeso * precioSobrePeso;

                // Mostrar el resultado en el campo "Precio Tonelada"
                precioToneladaInput.value = resultado.toLocaleString('en-US');

                // Calcular el total
                calcularTotal();
            }

            // Agregar evento de entrada al campo "Precio Sobre Peso"
            precioSobrePesoInput.addEventListener('input', function () {
                // Obtener el valor de Precio Sobre Peso
                var precioSobrePeso = parseFloat(precioSobrePesoInput.value.replace(/,/g, '')) || 0;

                // Calcular el resultado de la multiplicación
                var resultado = parseFloat(sobrepesoInput.value) * precioSobrePeso;

                // Mostrar el resultado en el campo "Precio Tonelada"
                precioToneladaInput.value = resultado.toLocaleString('en-US');

                // Calcular el total
                calcularTotal();
            });

            // Calcular sobrepeso inicialmente al cargar la página
            calcularSobrepeso();
        });
    </script>
@endsection
