<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="https://paradisus.mx/favicon/639893ee3d1ff63891f2fbd91b277248048_670190130923536_7018383830884135385_n__1_-removebg-preview.png">
  <title>
    SGT
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js')}}" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />
</head>

<body class="">

  <main class="main-content main-content-bg mt-0">
    <div class="page-header min-vh-100" style="background-image: url('{{ asset('img/contenedores.jpg') }}');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-8">
            <div class="card border-0 mb-0">
              <div class="card-header bg-transparent">

                <h5 class="text-dark text-center mt-2 mb-3">¡Bienvenido!</h5>

                <h4 class="text-dark text-center mt-2 mb-3">
                    Sistema de Gestion de Transporte
                </h4>

              </div>
              <div class="card-body px-lg-5 pt-0">
                <div class="text-center text-muted mb-4">
                  <small></small>
                </div>

                <form method="POST" action="{{ route('edit.cooredenadas', $coordenadas->id) }}">
                    @csrf

                    <div class="col-12">
                        <h5 class="text-left">1) Registro en Puerto ?</h5>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="registro_puerto" id="registro_puerto_no" value="No" checked>
                            <label class="form-check-label" for="registro_puerto_no">
                                No
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="registro_puerto" id="registro_puerto_si" value="Si">
                            <label class="form-check-label" for="registro_puerto_si">
                                Si
                            </label>
                        </div>

                    </div>

                    <input type="hidden" id="latitud_longitud" name="latitud_longitud">

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100 my-4 mb-2"> Actualizar</button>
                    </div>

                </form>



              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-2">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Power By <script>
              document.write(new Date().getFullYear())
            </script> WebTech
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
  {{-- <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <!-- Kanban scripts -->
  <script src="{{ asset('assets/js/plugins/dragula/dragula.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/jkanban/jkanban.js')}}"></script> --}}

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var radioSi = document.getElementById('registro_puerto_si');
        var latitudLongitudInput = document.getElementById('latitud_longitud');

        radioSi.addEventListener('change', function () {
            if (this.checked) {
                obtenerCoordenadas();
            }
        });

        function obtenerCoordenadas() {
            // Verificar si el navegador es compatible con la geolocalización
            if (navigator.geolocation) {
                // Obtener las coordenadas actuales
                navigator.geolocation.getCurrentPosition(function (position) {
                    var latitud = position.coords.latitude;
                    var longitud = position.coords.longitude;
                    var latitudLongitud = latitud + ',' + longitud;
                    console.log(latitudLongitud);
                    latitudLongitudInput.value = latitudLongitud;
                });
            }
        }
    });
</script>



  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4')}}"></script>
</body>

</html>
