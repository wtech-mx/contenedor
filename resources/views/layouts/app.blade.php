<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/'. $configuracion->favicon) }}">
  <link rel="icon" type="image/png" href="{{ asset('favicon/'. $configuracion->favicon) }}">
  <title>
    @yield('template_title') - {{$configuracion->nombre_sistema}}
  </title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  @yield('css')
   <!-- Select2  -->
   <link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css')}}">

  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/css/preloader.css')}}">


   {{-- <link src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link src="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
--}}


  <style>
        input:before {
            content: attr(data-date);
            display: inline-block;
            color: black;
        }
    </style>

</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300  position-absolute w-100" style="background-color: {{$configuracion->color_principal}}!important;"></div>
  <div id="page-loader"><span class="preloader-interior"></span></div>

   <!-- Sidenav -->
    @include('layouts.sidebar')

  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- End Navbar -->

    <div class="container-fluid">

        {{-- @include('layouts.header') --}}
        @include('layouts.simple_alert')
        @yield('breadcrumb')
        @yield('content')

        @include('client.modal_create')
        @include('operadores.modal_create')
        @include('proveedores.modal_create')
        @include('equipos.modal_create')


       <!-- Modal lateral Congif -->
        @include('layouts.footer')
      <!-- End Modal lateral Congif -->

    </div>
  </main>

  @yield('js_custom')

   <!-- Modal lateral Congif -->
    {{-- @include('layouts.modal_config') --}}
  <!-- End Modal lateral Congif -->



  <!--   Core JS Files   -->
  {{-- <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script> --}}

  <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>

  <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>

  <script src="{{ asset('assets/js/plugins/datatables.js')}}"></script>

  {{-- <script src="{{ asset('assets/js/plugins/fullcalendar.min.js')}}"></script> --}}
  <!-- Kanban scripts -->

  <script src="{{ asset('assets/js/plugins/dragula/dragula.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/jkanban/jkanban.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/chartjs.min.js')}}"></script>
  <script src="{{ asset('assets/js/argon-dashboard.min.js')}}"></script>
  <script src="{{ asset('assets/js/ConectorJavaScript.js')}}"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="{{ asset('assets/js/preloader.js')}}"></script>

    <script>
        const formContainer = document.getElementById('form-container');
        const openFormButton = document.getElementById('open-form');

        openFormButton.addEventListener('click', () => {
            formContainer.style.display = 'block';
        });

        formContainer.addEventListener('click', (event) => {
            if (event.target === formContainer) {
                formContainer.style.display = 'none';
            }
        });
    </script>
    
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
    </script>
  @yield('datatable')

  @yield('fullcalendar')

  <!-- Github buttons -->
  {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}

  @yield('select2')

</body>

</html>
