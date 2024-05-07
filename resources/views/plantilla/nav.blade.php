<ul id="sidebarnav">
    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ URL::route('index') }}" aria-expanded="false">
            <i data-feather="home" class="feather-icon"></i>
            <span class="hide-menu">Inicio</span>
        </a>
    </li>

    <li class="sidebar-item"> <a class="sidebar-link" href="{{ URL::route('contrato') }}" aria-expanded="false"><i
                data-feather="file-text" class="feather-icon"></i><span class="hide-menu">Contratos
            </span></a>
    </li>
    @if (Contratoutil::getContrato(auth()->user()->id_empresa))
    <li class="list-divider"></li>
    <li class="nav-small-cap"><span class="hide-menu">Aplicaciones</span></li>

    @can('admin.users.index')
        <li class="sidebar-item"> <a class="sidebar-link" href="{{ URL::route('empresa') }}" aria-expanded="false"><i
                    data-feather="briefcase" class="feather-icon"></i><span class="hide-menu">Empresas
                </span></a>
        </li>
    @endcan

    <li class="sidebar-item"> <a class="sidebar-link" href="{{ URL::route('user') }}" aria-expanded="false"><i
                data-feather="user" class="feather-icon"></i><span class="hide-menu">Usuarios
            </span></a>
    </li>
    <li class="sidebar-item"> <a class="sidebar-link" href="{{ URL::route('paciente') }}" aria-expanded="false"><i
                data-feather="users" class="feather-icon"></i><span class="hide-menu">Pacientes
            </span></a>
    </li>
    <li class="sidebar-item"> <a class="sidebar-link" href="{{ URL::route('cita') }}" aria-expanded="false"><i
                data-feather="calendar" class="feather-icon"></i><span class="hide-menu">Citas
            </span></a>
    </li>
    <li class="sidebar-item"> <a class="sidebar-link" href="{{ URL::route('receta') }}" aria-expanded="false"><i
                data-feather="edit" class="feather-icon"></i><span class="hide-menu">Recetas
            </span></a>
    </li>
    <li class="sidebar-item"> <a class="sidebar-link" href="{{ URL::route('historia') }}" aria-expanded="false"><i
                data-feather="book" class="feather-icon"></i><span class="hide-menu">Historia
            </span></a>
    </li>
    <li class="sidebar-item"> <a class="sidebar-link" href="{{ URL::route('venta') }}" aria-expanded="false"><i
                data-feather="shopping-cart" class="feather-icon"></i><span class="hide-menu">Ventas
            </span></a>
    </li>
    <li class="sidebar-item"> <a class="sidebar-link" href="{{ URL::route('saldo') }}" aria-expanded="false"><i
                data-feather="watch" class="feather-icon"></i><span class="hide-menu">Saldos
            </span></a>
    </li>
    @endif
   
</ul>
