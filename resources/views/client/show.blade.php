<div class="modal fade" id="subclienteShowModal-{{$client->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Subclientes</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-3"><b>Nombre</b></div>
                    <div class="col-3"><b>Telefono</b></div>
                    <div class="col-3"><b>Correo</b></div>
                    <div class="col-3"><b>RFC</b></div>

                    @foreach ($subclientes as $subcliente)
                        @if ($subcliente->id_cliente == $client->id)
                            <div class="col-3">{{$subcliente->nombre}}</div>
                            <div class="col-3">{{$subcliente->telefono}}</div>
                            <div class="col-3">{{$subcliente->correo}}</div>
                            <div class="col-3">{{$subcliente->rfc}}</div>
                        @endif
                    @endforeach

                </div>
            </div>

      </div>
    </div>
  </div>
