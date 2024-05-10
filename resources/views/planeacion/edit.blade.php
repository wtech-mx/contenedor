<div class="modal fade" id="planeacionModal{{$cotizacion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Planeacion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <form method="POST" action="{{ route('asignacion.planeaciones') }}" id="miFormulario" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="row">


                        <input name="num_contenedor" value="{{$cotizacion->DocCotizacion->id}}" type="hidden">
                        <input name="cotizacion" value="{{$cotizacion->DocCotizacion->id_cotizacion}}" type="hidden">

                        <div class="col-6 form-group">
                            <label for="name">Num. Contenedor</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('img/icon/contenedor.png') }}" alt="" width="25px">
                                </span>
                                <input id="num_contenedor" value="{{$cotizacion->DocCotizacion->num_contenedor}}" type="text" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Num. autorización</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('img/icon/persona-clave.png') }}" alt="" width="25px">
                                </span>
                                <input id="num_contenedor" value="{{$cotizacion->DocCotizacion->num_autorizacion}}" type="text" class="form-control" readonly>
                            </div>
                        </div>

                        @if ($cotizacion->id_subcliente != NULL)
                            <div class="col-12 form-group">
                                <label for="name">Subcliente *</label>
                                <input id="num_contenedor" value="{{$cotizacion->Subcliente->nombre}} / {{$cotizacion->Subcliente->telefono}}" type="text" class="form-control" readonly>
                            </div>
                        @endif

                        <div class="col-12 form-group">
                            <label for="name">Selecione Unidad</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('img/icon/camion.png') }}" alt="" width="25px">
                                </span>
                                <select class="form-select d-inline-block" id="viaje{{$cotizacion->id}}" name="viaje" value="{{ old('viaje') }}" onchange="mostrarDiv('{{$cotizacion->id}}')">
                                    <option>Seleccionar tipo</option>
                                    <option value="Camion Propio">Camion Propio</option>
                                    <option value="Camion Subcontratado">Camion Subcontratado</option>
                                </select>
                            </div>
                        </div>

                        <div id="camionPropioDiv{{$cotizacion->id}}" style="display: none;">
                            <div class="row">

                                <div class="col-12 form-group">
                                    <label for="name">Selecione el tipo de Unidad</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('img/icon/camion.webp') }}" alt="" width="25px">
                                        </span>
                                        <select class="form-select d-inline-block" id="tipo{{$cotizacion->id}}" name="tipo"  value="{{ old('tipo') }}" onchange="mostrarDiv('{{$cotizacion->id}}')">
                                            <option>Seleccionar Opcion</option>
                                            <option  value="Sencillo">Sencillo</option>
                                            <option  value="Full">Full</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 form-group">
                                    <label for="name">Fecha inicio</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px">
                                        </span>
                                        <input name="fecha_inicio" id="fecha_inicio_{{$cotizacion->id}}" type="date" class="form-control" value="{{ date('Y-m-d')}}">
                                    </div>
                                </div>


                                <div class="col-12 form-group">
                                    <label for="name">Fecha fin</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px">
                                        </span>
                                        <input name="fecha_fin" id="fecha_fin_{{$cotizacion->id}}" type="date" class="form-control" value="{{ date('Y-m-d')}}">
                                    </div>
                                </div>

                                <div class="col-12 form-group">
                                    <label for="name">.</label>
                                    <div class="input-group mb-3">
                                        <button class="btn" type="button" id="btn_clientes_search{{$cotizacion->id}}" data-cotizacion-id="{{$cotizacion->id}}" style="">
                                            Buscar Disponibilidad
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12 col-sm-4 col-md-4 col-lg-3 col-xl-3 px-4 w-100">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status" id="loadingSpinner" style="display:none">
                                     <span class="visually-hidden">Loading...</span>
                                 </div>
                             </div>
                         </div>

                            <div id="resultado_equipos{{ $cotizacion->id }}" class="row"></div>


                        <div id="camionSubcontratadoDiv{{$cotizacion->id}}" style="display: none;">
                            <div class="col-12 form-group">
                                <label for="name">Fecha inicio</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px">
                                    </span>
                                    <input name="fecha_inicio_proveedor" type="date" class="form-control" value="{{ date('Y-m-d')}}">
                                </div>
                            </div>


                            <div class="col-12 form-group">
                                <label for="name">Fecha fin</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px">
                                    </span>
                                    <input name="fecha_fin_proveedor" type="date" class="form-control" value="{{ date('Y-m-d')}}">
                                </div>
                            </div>

                            <div class="col-12 form-group">
                                <label for="name">Proveedor</label>
                                <select class="form-select d-inline-block" id="id_proveedor" name="id_proveedor" value="{{ old('id_proveedor') }}" >
                                    <option  value="">Seleccionar Proveedor</option>
                                    @foreach ($proveedores as $item)
                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-3 form-group">
                                    <label for="name">Costo viaje</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('img/icon/metodo-de-pago.webp') }}" alt="" width="25px">
                                        </span>
                                        <input name="precio" id="precio" type="number" class="form-control" value="0">
                                    </div>
                                </div>

                                <div class="col-3 form-group">
                                    <label for="name">Burreo</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('img/icon/burro.png') }}" alt="" width="25px">
                                        </span>
                                        <input name="cot_burreo" id="cot_burreo" type="float" class="form-control">
                                    </div>
                                </div>

                                <div class="col-3 form-group">
                                    <label for="name">Maniobra</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('img/icon/logistica.png') }}" alt="" width="25px">
                                        </span>
                                        <input name="cot_maniobra" id="cot_maniobra" type="float" class="form-control">
                                    </div>
                                </div>

                                <div class="col-3 form-group">
                                    <label for="name">Estadia</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('img/icon/servidor-en-la-nube.png') }}" alt="" width="25px">
                                        </span>
                                        <input name="cot_estadia" id="cot_estadia" type="float" class="form-control">
                                    </div>
                                </div>

                                <div class="col-4 form-group">
                                    <label for="name">Otros</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('img/icon/inventario.png.webp') }}" alt="" width="25px">
                                        </span>
                                        <input name="cot_otro" id="cot_otro" type="float" class="form-control">
                                    </div>
                                </div>

                                <div class="col-4 form-group">
                                    <label for="name">IVA</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('img/icon/impuesto.png') }}" alt="" width="25px">
                                        </span>
                                        <input name="cot_iva" id="cot_iva" type="number" class="form-control">
                                    </div>
                                </div>

                                <div class="col-4 form-group">
                                    <label for="name">Retención</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('img/icon/monedas.webp') }}" alt="" width="25px">
                                        </span>
                                        <input name="cot_retencion" id="cot_retencion" type="float" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>

      </div>
    </div>
</div>
@section('alerta')
    <script>
        $(document).ready(function() {
            $("#miFormulario").on("submit", function (event) {
                event.preventDefault();
                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) { // Agrega "async" aquí
                        // El formulario se ha enviado correctamente, ahora realiza la impresión
                        console.log('OK');
                        Swal.fire({
                            title: "Planeacion Guardada <strong>¡Exitosamente!</strong>",
                            icon: "success",
                            showCloseButton: true,
                            showCancelButton: true,
                            focusConfirm: false,
                            cancelButtonText: `<a  class="btn_swalater_cancel" style="text-decoration: none;color: #fff;" href="{{ route('index.planeaciones') }}" >Cerrar</a>`,
                        });
                        location.reload();

                    },
                    error: function (xhr, status, error) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = '';

                            // Itera a través de los errores y agrega cada mensaje de error al mensaje final
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    var errorMessages = errors[key].join('<br>'); // Usamos <br> para separar los mensajes
                                    errorMessage += '<strong>' + key + ':</strong><br>' + errorMessages + '<br>';
                                }
                            }
                            console.log(errorMessage);
                            // Muestra el mensaje de error en una SweetAlert
                            Swal.fire({
                                icon: 'error',
                                title: 'Faltan Campos',
                                html: errorMessage, // Usa "html" para mostrar el mensaje con formato HTML
                            });
                    }
                });
            });
        });
    </script>
@endsection
