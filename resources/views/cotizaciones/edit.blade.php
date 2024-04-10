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
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/pausa.png') }}" alt="" width="25px"> <b>Cliente: </b>{{$cotizacion->Cliente->nombre}}</p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/gps.webp') }}" alt="" width="25px"> <b>Origen: </b>{{$cotizacion->origen}}</p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/origen.png') }}" alt="" width="25px"> <b>Destino: </b>{{$cotizacion->destino}}</p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/burro.png') }}" alt="" width="25px"> <b>Burreo: </b>{{$cotizacion->burreo}}</p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/servidor-en-la-nube.png') }}" alt="" width="25px"> <b>Estadia: </b>{{$cotizacion->estadia}}</p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px"> <b>Fecha Modulación: </b>
                                            {{ \Carbon\Carbon::parse($cotizacion->fecha_modulacion)->isoFormat('D MMMM YYYY') }}
                                        </p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px"> <b>Fecha Entrega: </b>
                                            {{ \Carbon\Carbon::parse($cotizacion->fecha_entrega)->isoFormat('D MMMM YYYY') }}
                                        </p>
                                    </div>

                                    <div class="col-6">
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/escala.png') }}" alt="" width="25px"> <b>Tamaño Contenedor: </b>{{$cotizacion->tamano}}</p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/peso.png') }}" alt="" width="25px"> <b>Peso Contenedor: </b>{{$cotizacion->peso_contenedor}}</p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/logistica.png') }}" alt="" width="25px"> <b>Maniobra: </b>{{$cotizacion->maniobra}}</p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/inventario.png.webp') }}" alt="" width="25px"> <b>Otro: </b>{{$cotizacion->otro}}</p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="" width="25px"> <b>Precio Viaje: </b>$ {{ number_format($cotizacion->precio_viaje, 2, '.', ','); }} </p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/impuesto.png') }}" alt="" width="25px"> <b>IVA: </b>$ {{ number_format($cotizacion->iva, 2, '.', ','); }}</p>
                                        <p for="name" class="mb-4"> <img src="{{ asset('img/icon/pausa.png') }}" alt="" width="25px"> <b>Retencion: </b>{{$cotizacion->retencion}}</p>
                                    </div>
                                </div>

                                <div class="row">
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

                                    <h3 class="mt-3 mb-5">Documentacion</h3>

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
@endsection
