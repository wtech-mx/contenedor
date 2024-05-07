<div class="modal fade" id="operadoresModal_bitacora{{$operador->id}}" tabindex="-1" aria-labelledby="operadoresModal_bitacora{{$operador->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Bitacora de Viajes</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="POST" action="" id="" enctype="multipart/form-data" role="form">
            <input type="hidden" name="_method" value="PATCH">
            @csrf

            <div class="modal-body row estilos_equipo">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <h5 class="titulos_bitacora mb-2">#<strong>ID Cotizacion</strong></h5>
                        </div>

                        <div class="col-6 mb-3">
                            <h5 class="titulos_bitacora mb-2"><img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px"><strong> Fecha modulación y Fecha entrega</strong></h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                          <h5 class="titulos_bitacora mb-4"><img src="{{ asset('img/icon/origen.png') }}" alt="" width="25px"><strong>Viaje</strong></h5>
                        </div>

                        <div class="col-4">
                          <h5 class="titulos_bitacora mb-4"><img src="{{ asset('img/icon/chofer.png') }}" alt="" width="25px"><strong>Operador</strong></h5>
                        </div>

                        <div class="col-4">
                          <h5 class="titulos_bitacora mb-4"><img src="{{ asset('img/icon/depositar.png') }}" alt="" width="25px"><strong>Sueldo</strong></h5>
                        </div>

                        <div class="col-4">
                          <h5 class="titulos_bitacora mb-4"><img src="{{ asset('img/icon/billetera.png') }}" alt="" width="25px"><strong>Dinero del viaje</strong></h5>
                        </div>

                        <div class="col-8">

                        </div>

                        <div class="col-12">
                          <h5 class="titulos_bitacora mb-4"><img src="{{ asset('img/icon/user_predeterminado.webp') }}" alt="" width="25px"><strong> Comprobantes de Pago</strong></h5>
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
