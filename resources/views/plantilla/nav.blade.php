<ul id="sidebarnav">
    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ URL::route('index') }}" aria-expanded="false">
            <i data-feather="home" class="feather-icon"></i>
            <span class="hide-menu">Inicio</span>
        </a></li>
    <li class="list-divider"></li>
    <li class="nav-small-cap"><span class="hide-menu">Aplicaciones</span></li>

    <li class="sidebar-item"> <a class="sidebar-link" href="{{ URL::route('empresa') }}" aria-expanded="false"><i
                data-feather="users" class="feather-icon"></i><span class="hide-menu">Empresas
            </span></a>
    </li>
    <li class="sidebar-item"> <a class="sidebar-link" href="{{ URL::route('user') }}" aria-expanded="false"><i
                data-feather="user" class="feather-icon"></i><span class="hide-menu">Usuarios
            </span></a>
    </li>
    <li class="sidebar-item"> <a class="sidebar-link" href="{{ URL::route('cita') }}" aria-expanded="false"><i
                data-feather="calendar" class="feather-icon"></i><span class="hide-menu">Citas
            </span></a>
    </li>
</ul>
