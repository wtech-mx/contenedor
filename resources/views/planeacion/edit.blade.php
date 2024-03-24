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
                        <div class="form-group">
                            <label for="name">Viaje</label>
                            <select class="form-select d-inline-block" id="viaje" name="viaje" value="{{ old('viaje') }}" onchange="mostrarDiv()">
                                <option>Seleccionar Estatus</option>
                                <option value="Camion Propio">Camion Propio</option>
                                <option value="Camion Subcontratado">Camion Subcontratado</option>
                            </select>
                        </div>

                        <div id="camionPropioDiv" style="display: none;">
                            <div class="col-12 form-group">
                                <label for="name">Chasis</label>
                                <select class="form-select d-inline-block" id="viaje" name="viaje" value="{{ old('viaje') }}" onchange="mostrarDiv()">
                                    <option>Seleccionar Chasis</option>
                                    @foreach ($equipo_chasis as $item)
                                        <option value="{{$item->id}}">{{$item->marca}} / {{$item->modelo}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 form-group">
                                <label for="name">Camion</label>
                                <select class="form-select d-inline-block" id="viaje" name="viaje" value="{{ old('viaje') }}" onchange="mostrarDiv()">
                                    <option>Seleccionar Camion</option>
                                    @foreach ($equipo_camion as $item)
                                        <option value="{{$item->id}}">{{$item->marca}} / {{$item->modelo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="camionSubcontratadoDiv" style="display: none;">
                            <div class="col-12 form-group">
                                <label for="name">Proveedor</label>
                                <select class="form-select d-inline-block" id="viaje" name="viaje" value="{{ old('viaje') }}" onchange="mostrarDiv()">
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
    function mostrarDiv() {
        var viajeSelect = document.getElementById("viaje");
        var camionPropioDiv = document.getElementById("camionPropioDiv");
        var camionSubcontratadoDiv = document.getElementById("camionSubcontratadoDiv");

        if (viajeSelect.value === "Camion Propio") {
            camionPropioDiv.style.display = "block";
            camionSubcontratadoDiv.style.display = "none";
        } else if (viajeSelect.value === "Camion Subcontratado") {
            camionPropioDiv.style.display = "none";
            camionSubcontratadoDiv.style.display = "block";
        } else {
            camionPropioDiv.style.display = "none";
            camionSubcontratadoDiv.style.display = "none";
        }
    }
  </script>
@endsection
