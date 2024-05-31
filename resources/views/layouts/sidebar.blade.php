<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route('dashboard') }}" target="">
        <img src="{{asset('logo/'.$configuracion->logo) }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold"></span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link {{ (Request::is('dashboard*') ? 'active' : '') }}" href="{{ route('dashboard') }}" target="">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
             <i class="ni ni-calendar-grid-58 text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Inicio</span>
          </a>
        </li>


        <li class="nav-item">
            <a class="nav-link {{ (Request::is('clients*') ? 'active' : '') }}" href="{{ route('clients.index') }}" target="">
              <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                  <img src="{{ asset('img/icon/empleados.webp') }}" alt="" width="20px">
              </div>
              <span class="nav-link-text ms-1"><b>I</b> Clientes</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ (Request::is('proveedores*') ? 'active' : '') }}" href="{{ route('index.proveedores') }}" target="">
              <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/icon/edificios_ciudad.webp') }}" alt="" width="20px">
              </div>
              <span class="nav-link-text ms-1"><b>II</b> Proveedores</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ (Request::is('equipos*') ? 'active' : '') }}" href="{{ route('index.equipos') }}" target="">
              <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/icon/referencia.webp') }}" alt="" width="20px">
              </div>
              <span class="nav-link-text ms-1"><b>III</b> Equipos</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ (Request::is('operadores*') ? 'active' : '') }}" href="{{ route('index.operadores') }}" target="">
              <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/icon/camion.png') }}" alt="" width="20px">
              </div>
              <span class="nav-link-text ms-1"><b>IV</b> Operadores</span>
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link {{ (Request::is('cotizaciones*') ? 'active' : '') }}" href="{{ route('index.cotizaciones') }}" target="">
              <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/icon/factura.png.webp') }}" alt="" width="20px">
              </div>
              <span class="nav-link-text ms-1"><b>V</b> Cotizaciones</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ (Request::is('planeaciones*') ? 'active' : '') }}" href="{{ route('index.planeaciones') }}" target="">
              <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/icon/inventario.png.webp') }}" alt="" width="20px">
              </div>
              <span class="nav-link-text ms-1"><b>VI</b> Planeación</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ (Request::is('bancos*') ? 'active' : '') }}" href="{{ route('index.bancos') }}" target="">
              <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/icon/banco.png') }}" alt="" width="20px">
              </div>
              <span class="nav-link-text ms-1"><b>VII</b> Bancos</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ (Request::is('cuentas/cobrar*') ? 'active' : '') }}" href="{{ route('index.cobrar') }}" target="">
              <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/icon/bolsa-de-dinero.webp') }}" alt="" width="20px">
              </div>
              <span class="nav-link-text ms-1"><b>VIII</b> Cuentas por cobrar</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ (Request::is('cuentas/pagar*') ? 'active' : '') }}" href="{{ route('index.pagar') }}" target="">
              <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/icon/gastos.png.webp') }}" alt="" width="20px">
              </div>
              <span class="nav-link-text ms-1"><b>IX</b> Cuentas por pagar</span>
            </a>
          </li>

          <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link {{ (Request::is('users*') ? 'active' : '') }}{{ (Request::is('roles*') ? 'active' : '') }}" aria-controls="pagesExamples" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="ni ni-settings text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Roles y Permisos</span>
          </a>
          <div class="collapse " id="pagesExamples">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('users*') ? 'show' : '') }}" href="{{ route('users.index') }}">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal">Usuarios</span>
                </a>

                <a class="nav-link {{ (Request::is('roles*') ? 'show' : '') }}" href="{{ route('roles.index') }}">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal">Roles</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Configuraciones</h6>
        </li>

        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sistem" class="nav-link {{ (Request::is('users*') ? 'active' : '') }}{{ (Request::is('roles*') ? 'active' : '') }}" aria-controls="sistem" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="ni ni-settings-gear-65 text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Configuraciones</span>
          </a>
          <div class="collapse " id="sistem">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('tenants*') ? 'show' : '') }}" href="{{ route('index.tenants') }}">
                  <span class="sidenav-mini-icon">T</span>
                  <span class="sidenav-normal">Tenants</span>
                </a>
              </li>
            </ul>
          </div>
          <div class="collapse " id="sistem">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('configuracion*') ? 'show' : '') }}" href="{{ route('index.configuracion') }}">
                  <span class="sidenav-mini-icon">U</span>
                  <span class="sidenav-normal">Pagina</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

      </ul>

    </div>

  </aside>
