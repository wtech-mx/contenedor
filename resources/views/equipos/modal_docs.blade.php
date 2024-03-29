<div class="modal fade" id="documenotsdigitales-{{$equipo->id}}" tabindex="-1" aria-labelledby="equipoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Equipo #{{$equipo->id}} </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="POST" action="{{ route('update.equipos', $equipo->id) }}" id="" enctype="multipart/form-data" role="form">
            <input type="hidden" name="_method" value="PATCH">

            @csrf

            <div class="modal-body">
                <div class="row">

                    <div class="col-12 mb-3 mt-3">
                        <h4 class="text-center">Documentos Digitales</h4>
                    </div>

                    <div class="col-6 text-center">
                        <h5>Tarjeta de Circulacion</h5>
                        @if($equipo->tarjeta_circulacion == NULL)

                        <label for="name">Tarjeta de Circulacion *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('img/icon/business-card-design.webp') }}" alt="" width="25px">
                            </span>
                            <input name="tarjeta_circulacion" id="tarjeta_circulacion" type="file" class="form-control" value="{{$equipo->acceso}}">
                        </div>

                        @else

                        <p class="text-center">
                            <img src="{{ asset('equipos/'.$equipo->tarjeta_circulacion) }}" alt="" width="100%">
                        </p>

                        @endif
                    </div>

                    <div class="col-6 text-center">
                        <h5>Poliza de Seguro</h5>

                        @if($equipo->poliza_seguro == NULL)
                        <label for="name">Poliza de Seguro *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('img/icon/factura.png.webp') }}" alt="" width="25px">
                            </span>
                            <input name="poliza_seguro" id="poliza_seguro" type="file" class="form-control">
                        </div>
                        @else

                        <p class="text-center">
                            <img src="{{ asset('equipos/'.$equipo->poliza_seguro) }}" alt="" width="100%">
                        </p>

                        @endif
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
