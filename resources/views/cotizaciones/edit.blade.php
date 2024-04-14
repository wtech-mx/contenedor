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
                                    <div class="col-6">
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/pausa.png') }}" alt="" width="25px"> <b>Cliente: </b>
                                            <select class="form-select cliente d-inline-block"  data-toggle="select" id="id_cliente" name="id_cliente" value="{{ old('id_cliente') }}">
                                                <option value="{{$cotizacion->id_cliente}}">{{$cotizacion->Cliente->nombre}} / {{$cotizacion->Cliente->telefono}}</option>
                                                @foreach ($clientes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nombre }} / {{ $item->telefono }}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/gps.webp') }}" alt="" width="25px"> <b>Origen: </b><input name="cot_origen" id="cot_origen" type="text" class="form-control" value="{{$cotizacion->origen}}"></p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/origen.png') }}" alt="" width="25px"> <b>Destino: </b><input name="cot_destino" id="cot_destino" type="text" class="form-control" value="{{$cotizacion->destino}}"></p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/burro.png') }}" alt="" width="25px"> <b>Burreo: </b><input name="cot_burreo" id="cot_burreo" type="text" class="form-control" value="{{$cotizacion->burreo}}"></p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/servidor-en-la-nube.png') }}" alt="" width="25px"> <b>Estadia: </b><input name="cot_estadia" id="cot_estadia" type="text" class="form-control" value="{{$cotizacion->estadia}}"></p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px"> <b>Fecha Modulación: </b>
                                            <input name="cot_fecha_modulacion" id="cot_fecha_modulacion" type="date" class="form-control" value="{{$cotizacion->fecha_modulacion}}">
                                        </p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px"> <b>Fecha Entrega: </b>
                                            <input name="cot_fecha_entrega" id="cot_fecha_entrega" type="date" class="form-control" value="{{$cotizacion->fecha_entrega}}">
                                        </p>
                                    </div>

                                    <div class="col-6">
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/escala.png') }}" alt="" width="25px"> <b>Tamaño Contenedor: </b><input name="cot_tamano" id="cot_tamano" type="text" class="form-control" value="{{$cotizacion->tamano}}"></p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/peso.png') }}" alt="" width="25px"> <b>Peso Contenedor: </b><input name="cot_peso_contenedor" id="cot_peso_contenedor" type="text" class="form-control" value="{{$cotizacion->peso_contenedor}}"></p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/logistica.png') }}" alt="" width="25px"> <b>Maniobra: </b><input name="cot_maniobra" id="cot_maniobra" type="text" class="form-control" value="{{$cotizacion->maniobra}}"></p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/inventario.png.webp') }}" alt="" width="25px"> <b>Otro: </b><input name="cot_otro" id="cot_otro" type="text" class="form-control" value="{{$cotizacion->otro}}"></p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="" width="25px"> <b>Precio Viaje: </b><input name="cot_precio_viaje" id="cot_precio_viaje" type="text" class="form-control" value="{{$cotizacion->precio_viaje}}"></p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/impuesto.png') }}" alt="" width="25px"> <b>IVA: </b><input name="cot_iva" id="cot_iva" type="text" class="form-control" value="{{$cotizacion->iva}}"></p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/pausa.png') }}" alt="" width="25px"> <b>Retencion: </b><input name="cot_retencion" id="cot_retencion" type="text" class="form-control" value="{{$cotizacion->retencion}}"></p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/pausa.png') }}" alt="" width="25px"> <b>Total: </b><input type="text" class="form-control" value="{{$cotizacion->total}}" readonly></p>
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
    </script>
@endsection
