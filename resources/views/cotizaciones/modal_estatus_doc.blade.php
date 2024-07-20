
<div class="modal fade" id="esatusDoc{{ $cotizacion->DocCotizacion->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Estatus Documentos  #{{$cotizacion->DocCotizacion->num_contenedor}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-check">
                            @if ($cotizacion->DocCotizacion->num_contenedor == NULL)
                                <input class="form-check-input" type="checkbox">
                            @else
                                <input class="form-check-input" type="checkbox" checked>
                            @endif
                            <label for="input">Num contenedor</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-check">
                            @if ($cotizacion->DocCotizacion->doc_ccp == NULL)
                                <input class="form-check-input" type="checkbox">
                            @else
                                <input class="form-check-input" type="checkbox" checked>
                            @endif
                            <label for="input">Documento CCP</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-check">
                            @if ($cotizacion->DocCotizacion->boleta_liberacion == NULL)
                                <input class="form-check-input" type="checkbox">
                            @else
                                <input class="form-check-input" type="checkbox" checked>
                            @endif
                            <label for="input">Boleta de Liberación</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-check">
                            @if ($cotizacion->DocCotizacion->doda == NULL)
                                <input class="form-check-input" type="checkbox">
                            @else
                                <input class="form-check-input" type="checkbox" checked>
                            @endif
                            <label for="input">Doda</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-check">
                            @if ($cotizacion->DocCotizacion->carta_porte == NULL)
                                <input class="form-check-input" type="checkbox">
                            @else
                                <input class="form-check-input" type="checkbox" checked>
                            @endif
                            <label for="input">Carta Porte</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-check">
                            @if ($cotizacion->DocCotizacion->img_boleta == NULL)
                                <input class="form-check-input" type="checkbox">
                            @else
                                <input class="form-check-input" type="checkbox" checked>
                            @endif
                            <label for="input">Boleta Vacio</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-check">
                            @if ($cotizacion->DocCotizacion->eir == NULL)
                                <input class="form-check-input" type="checkbox">
                            @else
                                <input class="form-check-input" type="checkbox" checked>
                            @endif
                            <label for="input">EIR</label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
