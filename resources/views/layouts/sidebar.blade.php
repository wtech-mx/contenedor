  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
          <img src="{{asset('logo/'.$configuracion->logo) }}" class="navbar-brand-img" alt="...">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link {{ (Request::is('clients*') ? 'active' : '') }}" href="{{ route('clients.index') }}">
                    <i class="ni ni-circle-08" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                    <span class="nav-link-text">Clientes</span>
                </a>

              <a class="nav-link {{ (Request::is('especialists*') ? 'active' : '') }}" href="{{ route('index.proveedores') }}">
                <i class="fa fa-user-md" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                <span class="nav-link-text">Proveedores</span>
              </a>

              <a class="nav-link {{ (Request::is('especialists*') ? 'active' : '') }}" href="{{ route('index.equipos') }}">
                <i class="fa fa-user-md" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                <span class="nav-link-text">Equipos</span>
              </a>

              <a class="nav-link {{ (Request::is('especialists*') ? 'active' : '') }}" href="{{ route('index.operadores') }}">
                <i class="fa fa-user-md" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                <span class="nav-link-text">Operadores</span>
              </a>

            </li>

            <li class="nav-item">
              <a href="#navbar-maps" class="nav-link {{ (Request::is('users*') ? 'active' : '') }}{{ (Request::is('roles*') ? 'active' : '') }}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-maps">
                <i class="ni ni-settings text-primary"></i>
                <span class="nav-link-text">Roles y Permisos</span>
              </a>
              <div class="collapse{{ (Request::is('users*') ? 'show' : '') }}{{ (Request::is('roles*') ? 'show' : '') }}" id="navbar-maps">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ (Request::is('users*') ? 'show' : '') }}">Users</a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ (Request::is('roles*') ? 'show' : '') }}">Role</a>
                  </li>

                </ul>
              </div>
            </li>

{{--            <li class="nav-item">--}}
{{--              <a class="nav-link" href="../../pages/widgets.html">--}}
{{--                <i class="ni ni-archive-2 text-green"></i>--}}
{{--                <span class="nav-link-text">Widgets</span>--}}
{{--              </a>--}}
{{--            </li>--}}

          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">Confuración</h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('index.configuracion') }}">
                    <i class="ni ni-settings-gear-65"></i>
                  <span class="nav-link-text">Sistema</span>
                </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html" target="_blank">
                <i class="ni ni-spaceship"></i>
                <span class="nav-link-text">Getting started</span>
              </a>
            </li>

          </ul>

        </div>
      </div>
    </div>
  </nav>
