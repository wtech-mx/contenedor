<div class="modal fade" id="eventoModal" tabindex="-1" aria-labelledby="eventoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventoModalLabel">Detalles Planeación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p id="cliiente"></p>
                <p id="eventoTitulo"></p>
                <p id="eventoDescripcion"></p>
                <!-- Cambiar los inputs a tipo date -->
                <input type="date" id="eventoFechaStart" class="form-control mb-3">
                <input type="date" id="eventoFechaEnd" class="form-control">
                <input type="hidden" id="urlId" class="form-control">
                <a id="idCotizacion" class="btn btn-sm btn-primary mt-2" target="_blank">Ver Cotizacion</a>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="actualizarFechaBtn">Actualizar Fecha</button>
            </div>
        </div>
    </div>
</div>
