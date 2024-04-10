@extends('layouts.app')

@section('template_title')
   Crear
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Crear Cotizacion</h3>

                            <a class="btn"  href="{{ route('index.cotizaciones') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                Regresar
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('store.cotizaciones') }}" id="" enctype="multipart/form-data" role="form">
                            @csrf

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="precio">Nuevo cliente</label><br>
                                                <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                    Agregar <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                                                </button>
                                            </div>
                                            <div class="col-9">

                                                <div class="form-group">
                                                    <label for="name">Cliente *</label>
                                                    <select class="form-select cliente d-inline-block"  data-toggle="select" id="id_cliente" name="id_cliente" value="{{ old('id_cliente') }}">
                                                        <option>Seleccionar cliente</option>
                                                        @foreach ($clientes as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nombre }} / {{ $item->telefono }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-12">
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                <div class="row">


                                                    <div class="col-4">
                                                        <label for="name">Nombre completo *</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="29px">
                                                            </span>
                                                            <input  id="nombre_cliente" name="nombre_cliente" type="text" class="form-control" placeholder="Nombre(s) y Apellidos">
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <label for="name">Telefono *</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/phone.png') }}" alt="" width="29px">
                                                            </span>
                                                            <input  id="telefono_cliente" name="telefono_cliente" class="form-control" type="tel" minlength="10" maxlength="10" placeholder="555555555">
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <label for="name">Correo</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/correo-electronico.png') }}" alt="" width="29px">
                                                            </span>
                                                            <input  id="correo_cliente" name="correo_cliente" type="email" class="form-control" placeholder="correo@correo.com">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Origen</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/gps.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="origen" id="origen" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Destino</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/origen.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="destino" id="destino" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-3 form-group">
                                        <label for="name">Tamaño Contenedor</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/escala.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="tamano" id="tamano" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-3 form-group">
                                        <label for="name">Peso Reglamentario</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/perdida-de-peso.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="peso_reglamentario" id="peso_reglamentario" type="number" class="form-control" value="22">
                                        </div>
                                    </div>

                                    <div class="col-3 form-group">
                                        <label for="name">Peso Contenedor</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/peso.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="peso_contenedor" id="peso_contenedor" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-3 form-group">
                                        <label for="name">Sobrepeso</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/pesa-rusa.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="sobrepeso" id="sobrepeso" type="text" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-3 form-group">
                                        <label for="name">Precio Viaje</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="precio_viaje" id="precio_viaje" type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()">
                                        </div>
                                    </div>

                                    <div class="col-3 form-group">
                                        <label for="name">Burreo</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/burro.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="burreo" id="burreo" type="float" class="form-control"onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()">
                                        </div>
                                    </div>

                                    <div class="col-3 form-group">
                                        <label for="name">Maniobra</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/logistica.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="maniobra" id="maniobra" type="float" class="form-control"onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()">
                                        </div>
                                    </div>

                                    <div class="col-3 form-group">
                                        <label for="name">Estadia</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/servidor-en-la-nube.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="estadia" id="estadia" type="float" class="form-control"onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()">
                                        </div>
                                    </div>

                                    <div class="col-4 form-group">
                                        <label for="name">Otros</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/inventario.png.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="otro" id="otro" type="float" class="form-control"onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()">
                                        </div>
                                    </div>

                                    <div class="col-4 form-group">
                                        <label for="name">IVA</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/impuesto.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="iva" id="iva" type="number" class="form-control"onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()">
                                        </div>
                                    </div>

                                    <div class="col-4 form-group">
                                        <label for="name">Retención</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/monedas.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="retencion" id="retencion" type="float" class="form-control"onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 46" oninput="calcularTotal()">
                                        </div>
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="name">Total</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/monedas.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="total" id="total" type="float" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-4 form-group">
                                        <label for="name">Fecha modulación</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="fecha_modulacion" id="fecha_modulacion" type="date" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-4 form-group">
                                        <label for="name">Fecha entrega</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="fecha_entrega" id="fecha_entrega" type="date" class="form-control">
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

        function calcularTotal() {
            const precio_viaje = parseFloat(document.getElementById('precio_viaje').value.replace(/,/g, '')) || 0;
            const burreo = parseFloat(document.getElementById('burreo').value.replace(/,/g, '')) || 0;
            const retencion = parseFloat(document.getElementById('retencion').value.replace(/,/g, '')) || 0;
            const iva = parseFloat(document.getElementById('iva').value.replace(/,/g, '')) || 0;
            const otro = parseFloat(document.getElementById('otro').value.replace(/,/g, '')) || 0;
            const estadia = parseFloat(document.getElementById('estadia').value.replace(/,/g, '')) || 0;
            const maniobra = parseFloat(document.getElementById('maniobra').value.replace(/,/g, '')) || 0;

            // Otros campos de entrada
            const total = precio_viaje + burreo + retencion + iva + otro + estadia + maniobra ; // Suma de todos los campos

            // Formatear el total con comas
            const totalFormateado = total.toLocaleString('en-US');

            document.getElementById('total').value = totalFormateado;
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Obtener elementos del DOM
            var pesoReglamentarioInput = document.getElementById('peso_reglamentario');
            var pesoContenedorInput = document.getElementById('peso_contenedor');
            var sobrepesoInput = document.getElementById('sobrepeso');

            // Agregar evento de cambio a los inputs
            pesoReglamentarioInput.addEventListener('input', calcularSobrepeso);
            pesoContenedorInput.addEventListener('input', calcularSobrepeso);

            // Función para calcular el sobrepeso
            function calcularSobrepeso() {
                var pesoReglamentario = parseInt(pesoReglamentarioInput.value) || 0;
                var pesoContenedor = parseInt(pesoContenedorInput.value) || 0;

                // Calcular sobrepeso
                var sobrepeso = Math.max(pesoContenedor - pesoReglamentario, 0);

                // Mostrar sobrepeso en el input correspondiente
                sobrepesoInput.value = sobrepeso;
            }

            // Calcular sobrepeso inicialmente al cargar la página
            calcularSobrepeso();
        });
    </script>

@endsection
