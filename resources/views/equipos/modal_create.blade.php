<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Crear Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('store.proveedores') }}" id="" enctype="multipart/form-data" role="form">
            @csrf

            <div class="modal-body">
                <div class="row">

                    <div class="col-12">



                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                Tractos / Camiones
                            </button>
                            </li>

                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                Chasis Plataforma
                            </button>
                            </li>
                          </ul>

                          <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show  active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="row">

                                    <div class="col-12">
                                        <h6>Datos del Vehiculo</h6>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Fecha de alta *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="fecha" id="fecha" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6"></div>

                                    <div class="col-6 form-group">
                                        <label for="name">Marca *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/marca.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="marca" id="marca" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Modelo *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/coche.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="modelo" id="modelo" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Año *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/calendario.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="year" id="year" type="number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="name">Numero de Serie *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/sku.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="num_serie" id="num_serie" type="number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Acceso *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/iniciar-sesion.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="year" id="year" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Tarjeta de Circulacion *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/business-card-design.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="tarjeta_circulacion" id="tarjeta_circulacion" type="file" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Poliza de Seguro *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/factura.png.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="poliza_seguro" id="poliza_seguro" type="file" class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                <div class="row">

                                    <div class="col-12">
                                        <h6>Datos del Vehiculo</h6>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Fecha de alta *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/calendar-dar.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="fecha" id="fecha" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6"></div>

                                    <div class="col-6 form-group">
                                        <label for="name">Marca *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/marca.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="marca" id="marca" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Modelo *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/coche.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="modelo" id="modelo" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Año *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/calendario.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="year" id="year" type="number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Acceso *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/iniciar-sesion.png') }}" alt="" width="25px">
                                            </span>
                                            <input name="year" id="year" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Tarjeta de Circulacion *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/business-card-design.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="tarjeta_circulacion" id="tarjeta_circulacion" type="file" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="name">Poliza de Seguro *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('img/icon/factura.png.webp') }}" alt="" width="25px">
                                            </span>
                                            <input name="poliza_seguro" id="poliza_seguro" type="file" class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>

                          </div>

                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
              </div>
        </form>
      </div>
    </div>
  </div>
