<div class="modal fade" id="planeacionModal{{$cotizacion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Planeacion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <form method="POST" action="{{ route('asignacion.planeaciones') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input name="num_contenedor" value="{{$cotizacion->DocCotizacion->id}}" type="text" style="display: none">
                        <input name="cotizacion" value="{{$cotizacion->DocCotizacion->id_cotizacion}}" type="text" style="display: none">
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
                                <button class="btn" type="button" id="btn_clientes_search{{$cotizacion->id}}" data-cotizacion-id="{{$cotizacion->id}}" style="">
                                    Buscar Disponibilidad
                                </button>

                            </div>
                        </div>

                            <div id="resultado_equipos" class="row"></div>


                        <div id="camionSubcontratadoDiv{{$cotizacion->id}}" style="display: none;">
                            <div class="col-12 form-group">
                                <label for="name">Proveedor</label>
                                <select class="form-select d-inline-block" id="id_proveedor" name="id_proveedor" value="{{ old('id_proveedor') }}" >
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
                                    <input name="precio" id="precio" type="number" class="form-control" value="0">
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
