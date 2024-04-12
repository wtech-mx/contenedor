@extends('layouts.app')

@section('template_title')
    Planeacion
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
                                                 Contenedor #{{ $cotizacion->DocCotizacion->num_contenedor }} / {{$cotizacion->Cliente->nombre}}
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

    <script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            events: @json($events),
            height: 'auto',
            initialDate: '{{ date('Y-m-d')}}',
            initialView: 'dayGridMonth',
            navLinks: false,
            editable: true,
            dayMaxEvents: 3,


            headerToolbar:{
                left:'prev,next today',
                center:'title',
                right: 'listMonth,dayGridMonth'
                },

                views: {
                dayGridMonth: {
                    buttonText: 'MES'
                },
                listMonth: {
                    buttonText: 'LISTA'
                }
            },
            eventClick: function(info) {
                // Colocar los detalles del evento en el modal
                document.getElementById('eventoTitulo').innerText = info.event.title;
                document.getElementById('eventoDescripcion').innerText = info.event.extendedProps.description;

                // Formatear las fechas para los inputs y ajustarlas
                var fechaInicio = formatDate(info.event.start);
                var fechaFin = formatDate(info.event.end);
                var urlId = info.event.extendedProps.urlId;

                // Establecer los valores en los inputs del formulario
                document.getElementById('eventoFechaStart').value = fechaInicio;
                document.getElementById('eventoFechaEnd').value = fechaFin;
                document.getElementById('idCotizacion').setAttribute('href', 'cotizaciones/edit/' + info.event.extendedProps.idCotizacion);
                document.getElementById('urlId').value = urlId;

                // Mostrar el modal
                var eventoModal = new bootstrap.Modal(document.getElementById('eventoModal'));
                eventoModal.show();

                // Escuchar el clic en el botón de "Actualizar fecha"
                document.getElementById('actualizarFechaBtn').addEventListener('click', function () {
                    // Obtener los nuevos valores de las fechas
                    var nuevaFechaInicio = document.getElementById('eventoFechaStart').value;
                    var nuevaFechaFin = document.getElementById('eventoFechaEnd').value;
                    var urlId = document.getElementById('urlId').value;

                    $.ajax({
                        url: '{{ route('asignacion.edit_fecha') }}',
                        type: 'get',
                        data: {
                            'nuevaFechaInicio': nuevaFechaInicio,
                            'nuevaFechaFin': nuevaFechaFin,
                            'urlId': urlId,
                            '_token': token // Agregar el token CSRF a los datos enviados
                        },
                        success: function(data) {
                            // Realizar alguna acción si la solicitud es exitosa
                        },
                        error: function(error) {
                            console.log(error);
                        },
                        complete: function() {
                            // Ocultar el spinner cuando la búsqueda esté completa
                            alert('Cambio realizado');
                        }
                    });
                });
            }
        });
        calendar.render();
    });

    function formatDate(date) {
        // Obtener la fecha y hora local en la zona horaria de la Ciudad de México
        var mexicoCityTime = date.toLocaleString('en-US', { timeZone: 'America/Mexico_City' });
        var mexicoCityDate = new Date(mexicoCityTime);

        // Obtener el año, mes y día de la fecha ajustada
        var year = mexicoCityDate.getFullYear();
        var month = pad(mexicoCityDate.getMonth() + 1);
        var day = pad(mexicoCityDate.getDate());

        // Construir la fecha en el formato YYYY-MM-DD
        return year + '-' + month + '-' + day;
    }

    // Función para agregar un cero delante de números menores a 10
    function pad(number) {
        if (number < 10) {
            return '0' + number;
        }
        return number;
    }

    </script>

@endsection

@section('datatable')
    <script type="text/javascript">

        $(document).ready(function() {
            // Cambia el selector de jQuery para que coincida con el ID dinámico generado en el HTML
            $('[id^="tipo"]').change(function() {
                // Obtén el valor seleccionado del elemento actual
                var tipo = $(this).val();
                // Obtén el número de ID eliminando 'tipo' del ID del elemento actual
                var idNum = $(this).attr('id').replace('tipo', '');
                // Construye los selectores de los grupos de elementos adicionales utilizando el número de ID
                var chasisAdicional1Group = $('#chasisAdicional1Group');
                var nuevoCampoDolyGroup = $('#nuevoCampoDolyGroup');

                if (tipo === 'Sencillo') {
                    chasisAdicional1Group.hide();
                    nuevoCampoDolyGroup.hide();
                } else if (tipo === 'Full') {
                    chasisAdicional1Group.show();
                    nuevoCampoDolyGroup.show();
                }
            });
        });

        function mostrarDiv(cotizacionId) {
            var viajeSelect = document.getElementById("viaje" + cotizacionId);
            var camionSubcontratadoDiv = document.getElementById("camionSubcontratadoDiv" + cotizacionId);
            var camionPropioDiv = document.getElementById("camionPropioDiv" + cotizacionId);

            if (viajeSelect.value === "Camion Subcontratado") {
                camionSubcontratadoDiv.style.display = "block";
                camionPropioDiv.style.display = "none";
            }else if(viajeSelect.value === "Camion Propio"){
                camionPropioDiv.style.display = "block";
                camionSubcontratadoDiv.style.display = "none";
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
                var fecha_fin = $('#fecha_fin_' + cotizacionId).val();

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
