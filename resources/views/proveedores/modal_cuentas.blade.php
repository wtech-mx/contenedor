<div class="modal fade" id="cuentasModal{{$proveedor->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Cuenta(s) Bancaria(s)</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-3">Nombre</div>
                    <div class="col-3">Cuenta</div>
                    <div class="col-3">Clabe</div>
                    <div class="col-3">Borrar</div>

                    @foreach ($cuentas as $cuentas)
                        @if ($cuentas->id_proveedores == $proveedor->id)
                            <div class="col-3">{{$cuentas->nombre_banco}}</div>
                            <div class="col-3">{{$cuentas->cuenta_bancaria}}</div>
                            <div class="col-3">{{$cuentas->cuenta_clabe}}</div>
                            <div class="col-3"></div>
                        @endif
                    @endforeach

                </div>
            </div>

      </div>
    </div>
  </div>
