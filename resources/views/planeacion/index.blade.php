@extends('layouts.app')

@section('template_title')
    Cotizaciones Aprobadas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                             <div class="float-right">
                                <a type="button" class="btn btn-primary" href="{{ route('create.cotizaciones') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <h3>Faltantes de Planeación</h3>
                                @foreach ($cotizaciones as $cotizacion)
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#planeacionModal{{$cotizacion->id}}">
                                        <img src="{{ asset('img/icon/camion.png') }}" alt="" width="25px">
                                    </button>

                                    @include('planeacion.edit')
                                @endforeach
                            </div>

                            <div class="col-8">
                                <h3>Calendario</h3>
                                <div id="calendar"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('planeacion.modal')
@endsection

@section('fullcalendar')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script type="text/javascript">
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
        });

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events),
                dayMaxEventRows: true,
                views: {
                    timeGrid: {
                    dayMaxEventRows: 3 // adjust to 6 only for timeGridWeek/timeGridDay
                    }
                },

                eventClick: function(info) {
                    // Colocar los detalles del evento en el modal
                    document.getElementById('eventoTitulo').innerText = info.event.title;
                    document.getElementById('eventoDescripcion').innerText = info.event.extendedProps.description;
                    document.getElementById('eventoFechaStart').innerText = 'Fecha inicio: ' + formatDate(info.event.start);
                    document.getElementById('eventoFechaEnd').innerText = 'Fecha fin: ' + formatDate(info.event.end);

                    // Agregar el botón de cotizaciones al modal
                    var btnCotizaciones = document.createElement('a');
                    btnCotizaciones.setAttribute('type', 'button');
                    btnCotizaciones.setAttribute('class', 'btn');
                    btnCotizaciones.setAttribute('href', '{{ $urlCotizaciones }}'); // Usar la variable PHP
                    btnCotizaciones.innerHTML = '<img src="{{ asset('img/icon/quotes.webp') }}" alt="" width="25px"> Cotizaciones';
                    document.querySelector('#eventoModal .modal-body').appendChild(btnCotizaciones);

                    // Mostrar el modal
                    var eventoModal = new bootstrap.Modal(document.getElementById('eventoModal'));
                    eventoModal.show();
                }
            });
            calendar.render();
        });

        function formatDate(date) {
            // Obtener el día, mes y año
            var day = date.getDate();
            var month = date.toLocaleString('default', { month: 'long' });
            var year = date.getFullYear();

            // Construir la fecha en el formato deseado
            return day + ' ' + month + ' ' + year;
        }
    </script>
@endsection
