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

                            <div class="col-12 col-md-12 col-lg-4">
                                <h4>Faltantes de Planeación</h4>
                                <div class="row">
                                    @foreach ($cotizaciones as $cotizacion)
                                        <div class="col-{{$numCotizaciones <= 15 ? '12' : '6'}}">
                                            <button type="button" class="btn btn-xs btn-primary w-100" data-bs-toggle="modal" data-bs-target="#planeacionModal{{$cotizacion->id}}">
                                                Cliente: {{$cotizacion->Cliente->nombre}}
                                            </button>
                                        </div>
                                        @include('planeacion.edit')
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-12 col-md-12 col-lg-8">
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
                    document.getElementById('urlId').setAttribute('href', 'cotizaciones/edit/' + info.event.extendedProps.urlId);

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

@section('datatable')
    <script type="text/javascript">

        function mostrarDiv(cotizacionId) {
            var viajeSelect = document.getElementById("viaje" + cotizacionId);
            var camionSubcontratadoDiv = document.getElementById("camionSubcontratadoDiv" + cotizacionId);

            if (viajeSelect.value === "Camion Subcontratado") {
                camionSubcontratadoDiv.style.display = "block";
            }
        }

        $(document).ready(function() {
            $('[id^="btn_clientes_search"]').click(function() {
                var cotizacionId = $(this).data('cotizacion-id'); // Obtener el ID de la cotización del atributo data
                buscar_clientes(cotizacionId);
            });

            function buscar_clientes(cotizacionId) {
                $('#loadingSpinner').show();

                var fecha_inicio = $('#fecha_inicio_' + cotizacionId).val();
                console.log('fecha_inicio:', fecha_inicio);
                var fecha_fin = $('#fecha_fin_' + cotizacionId).val();
                console.log('fecha_fin_:', fecha_fin);

                $.ajax({
                    url: '{{ route('equipos.planeaciones') }}',
                    type: 'get',
                    data: {
                        'fecha_inicio': fecha_inicio,
                        'fecha_fin': fecha_fin,
                        '_token': token // Agregar el token CSRF a los datos enviados
                    },
                    success: function(data) {
                        $('#resultado_equipos' + cotizacionId).html(data); // Actualiza la sección con los datos del servicio
                    },
                    error: function(error) {
                        console.log(error);
                    },
                    complete: function() {
                        // Ocultar el spinner cuando la búsqueda esté completa
                        $('#loadingSpinner').hide();

                    }

                });

            }



        });

    </script>
@endsection
