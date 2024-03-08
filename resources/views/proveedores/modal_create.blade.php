<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear Proveedor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('store.proveedores') }}" id="miFormulario" enctype="multipart/form-data" role="form">
            @csrf

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="name">Nombre Completo*</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px">
                            </span>
                            <input name="nombre" id="nombre" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">correo *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px">
                            </span>
                            <input name="correo" id="correo" type="email" class="form-control">
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Telefono *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px">
                            </span>
                            <input name="telefono" id="telefono" type="number" class="form-control">
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Regimen *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px">
                            </span>
                            <input name="regimen" id="regimen" type="file" class="form-control">
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Cuenta Bancaria *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px">
                            </span>
                            <input name="cuenta_bancaria" id="cuenta_bancaria" type="number" class="form-control">
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Nombre del Banco *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px">
                            </span>
                            <input name="nombre_banco" id="nombre_banco" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Clabe *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('img/icon/edit.png') }}" alt="" width="25px">
                            </span>
                            <input name="cuenta_clabe" id="cuenta_clabe" type="number" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                <button type="submit" class="btn close-modal">Guardar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
