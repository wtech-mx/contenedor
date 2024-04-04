<!-- Modal -->
<div class="modal fade" id="eventoModal" tabindex="-1" aria-labelledby="eventoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventoModalLabel">Detalles Planeación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="eventoTitulo"></p>
          <p id="eventoDescripcion"></p>
          <p id="eventoFechaStart"></p>
          <p id="eventoFechaEnd"></p>
        </div>
        <div class="modal-footer">
            <a type="button" class="btn" id="btnCotizaciones">
                <img src="{{ asset('img/icon/quotes.webp') }}" alt="" width="25px">
            </a>

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
