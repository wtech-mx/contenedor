<div class="modal fade" id="planeacionModal{{$cotizacion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Planeacion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <form method="POST" action="#" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="row">
                        <input name="num_contenedor" value="{{$cotizacion->DocCotizacion->id}}" type="text" style="display: none">
                        <div class="form-group">
                            <label for="name">Num. Contenedor</label>
                            <input id="num_contenedor" value="{{$cotizacion->DocCotizacion->num_contenedor}}" type="text" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Num. autorización</label>
                            <input id="num_contenedor" value="{{$cotizacion->DocCotizacion->num_autorizacion}}" type="text" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Viaje</label>
                            <select class="form-select d-inline-block" id="viaje{{$cotizacion->id}}" name="viaje" value="{{ old('viaje') }}" onchange="mostrarDiv('{{$cotizacion->id}}')">
                                <option>Seleccionar tipo</option>
                                <option value="Camion Propio">Camion Propio</option>
                                <option value="Camion Subcontratado">Camion Subcontratado</option>
                            </select>
                        </div>


                        <div class="col-4 form-group">
                            <label for="name">Fecha inicio</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px">
                                </span>
                                <input name="fecha_inicio" id="fecha_inicio_{{$cotizacion->id}}" type="date" class="form-control">
                            </div>
                        </div>


                        <div class="col-4 form-group">
                            <label for="name">Fecha fin</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px">
                                </span>
                                <input name="fecha_fin" id="fecha_fin_{{$cotizacion->id}}" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="col-4 form-group">
                            <label for="name">.</label>
                            <div class="input-group mb-3">
                                <button class="btn" type="button" id="btn_clientes_search{{$cotizacion->id}}" style="">
                                    Buscar Disponibilidad
                                </button>
                            </div>
                        </div>

                            <div id="resultado_equipos{{$cotizacion->id}}" class="row"></div>


                        <div id="camionSubcontratadoDiv{{$cotizacion->id}}" style="display: none;">
                            <div class="col-12 form-group">
                                <label for="name">Proveedor</label>
                                <select class="form-select d-inline-block" id="proveedor" name="proveedor" value="{{ old('proveedor') }}" >
                                    <option>Seleccionar Proveedor</option>
                                    @foreach ($proveedores as $item)
                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 form-group">
                                <label for="name">Costo viaje</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('img/icon/metodo-de-pago.webp') }}" alt="" width="25px">
                                    </span>
                                    <input name="num_autorizacion" id="num_autorizacion" type="number" class="form-control">
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

@section('datatable')
    <script type="text/javascript">
        function mostrarDiv(cotizacionId) {
            var viajeSelect = document.getElementById("viaje" + cotizacionId);
            var camionSubcontratadoDiv = document.getElementById("camionSubcontratadoDiv" + cotizacionId);

            if (viajeSelect.value === "Camion Subcontratado") {
                camionSubcontratadoDiv.style.display = "block";
            }
        }

        $(document).ready(function() {

            $('[id^="btn_clientes_search"]').click(function() {
                var cotizacionId = $(this).data('cotizacion-id');
                buscar_clientes(cotizacionId);
            });

            function buscar_clientes(cotizacionId) {
                var fecha_inicio = $('#fecha_inicio_' + cotizacionId).val();
                console.log('fecha_inicio:', fecha_inicio);
                var fecha_fin = $('#fecha_fin_' + cotizacionId).val();

                $.ajax({
                    url: '{{ route('equipos.planeaciones') }}',
                    type: 'get',
                    data: {
                        'fecha_inicio': fecha_inicio,
                        'fecha_fin': fecha_fin,
                        '_token': token // Agregar el token CSRF a los datos enviados
                    },
                    success: function(data) {
                        console.log('fecha_inicio:', fecha_inicio);
                        $('#resultado_equipos' + cotizacionId).html(data); // Actualiza la sección con los datos del servicio
                    },
                    error: function(error) {
                        console.log(error);
                    },
                    complete: function() {
                        // Ocultar el spinner cuando la búsqueda esté completa
                        console.log(`clear = ${result}`);
                    }

                });

            }

        });

    </script>
@endsection
