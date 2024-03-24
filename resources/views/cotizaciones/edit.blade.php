@extends('layouts.app')

@section('template_title')
   Crear
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
                                <h3 class="mb-3">Datos de cotizacion</h3>
                                <div class="row">
                                    <div class="col-6">
                                        <p for="name">ID: <b>{{$cotizacion->id}}</b></p>
                                        <p for="name">Origen: <b>{{$cotizacion->origen}}</b></p>
                                        <p for="name">Tamaño Contenedor: <b>{{$cotizacion->tamano}}</b></p>
                                        <p for="name">Burreo: <b>{{$cotizacion->burreo}}</b></p>
                                        <p for="name">Estadia: <b>{{$cotizacion->estadia}}</b></p>
                                        <p for="name">Retencion: <b>{{$cotizacion->retencion}}</b></p>
                                        <p for="name">Fecha Modulación: <b>{{$cotizacion->fecha_modulacion}}</b></p>
                                        <p for="name">Precio Viaje: <b>{{$cotizacion->precio_viaje}}</b></p>
                                    </div>
                                    <div class="col-6">
                                        <p for="name">Cliente: <b>{{$cotizacion->Cliente->nombre}}</b></p>
                                        <p for="name">Destino: <b>{{$cotizacion->destino}}</b></p>
                                        <p for="name">Peso Contenedor: <b>{{$cotizacion->peso_contenedor}}</b></p>
                                        <p for="name">Maniobra: <b>{{$cotizacion->maniobra}}</b></p>
                                        <p for="name">Otro: <b>{{$cotizacion->otro}}</b></p>
                                        <p>.</p>
                                        <p for="name">Fecha Entrega: <b>{{$cotizacion->fecha_entrega}}</b></p>
                                        <p for="name">IVA: <b>{{$cotizacion->iva}}</b></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <h3>Registrar Documentación</h3>

                                    <div class="col-6 form-group">
                                        <label for="name">Num. Contenedor</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/metodo-de-pago.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="num_contenedor" id="num_contenedor" type="text" class="form-control" value="{{$documentacion->num_contenedor}}">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Terminal(Nombre)</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/metodo-de-pago.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="terminal" id="terminal" type="text" class="form-control" value="{{$documentacion->terminal}}">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Num. Autorización</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/metodo-de-pago.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="num_autorizacion" id="num_autorizacion" type="text" class="form-control" value="{{$documentacion->num_autorizacion}}">
                                        </div>
                                    </div>

                                    <h3>documentacion</h3>

                                    <div class="col-6 form-group">
                                        <label for="name">Boleta de Liberación</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/metodo-de-pago.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="boleta_liberacion" id="boleta_liberacion" type="file" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Doda</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/metodo-de-pago.webp') }}" alt="" width="25px">
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
