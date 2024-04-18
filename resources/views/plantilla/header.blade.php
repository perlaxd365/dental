<nav class="navbar top-navbar navbar-expand-md">
    <div class="navbar-header" data-logobg="skin6">
        <!-- This is for the sidebar toggle which is visible on mobile only -->
        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                class="ti-menu ti-close"></i></a>
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-brand">
            <!-- Logo icon -->
            <a href="{{ URL::route('index') }}">
                <b class="logo-icon">
                    <!-- Dark Logo icon -->
                    <img src="assets/images/logo-icon.png" width="50" height="60" alt="homepage"
                        class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="assets/images/logo-icon.png" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                    <!-- dark Logo text -->
                    <img src="assets/images/logo-text.png" width="120" height="75" alt="homepage"
                        class="dark-logo" />
                    <!-- Light Logo text -->
                    <img src="assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                </span>
            </a>
        </div>

        <style>
            .scroll {
                height: 400px;
                overflow: scroll;
            }
        </style>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Toggle which is visible on mobile only -->
        <!-- ============================================================== -->
        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
            data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
    </div>
    <!-- ============================================================== -->
    <!-- End Logo -->
    <!-- ============================================================== -->
    <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <!-- ============================================================== -->
        <!-- toggle and nav items -->

        @php
            $pagos = DB::select(
                'select *, dp.updated_at as pago_actualizado from detalle_pagos  dp
                        inner join pagos on pagos.id_pago = dp.id_pago
                        inner join contratos on contratos.id_pago = pagos.id_pago
                        where contratos.id_empresa = ' .
                    auth()->user()->id_empresa .
                    ' 
                        and contratos.estado_contrato = ' .
                    config('constants.ESTADO_CONTRATO_ACTIVO'),
            );

        @endphp
        <!-- ============================================================== -->
        <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
            <!-- Notification -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)" id="bell"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span><i data-feather="dollar-sign" class="svg-icon"></i></span>

                    <span class="badge badge-primary notify-no rounded-circle">{{ count($pagos) }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown scroll">
                    <div class="card">
                        <div class="card-header">
                            Contrato activo
                        </div>
                        <div class="card-body">
                            <ul class="list-style-none">
                                <li>
                                    <div class="message-center notifications position-relative">
                                        @foreach ($pagos as $pago)
                                            <!-- Message -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <div
                                                    class="btn btn-{{ $pago->estado_detalle == config('constants.ESTADO_DETALLE_PAGO_COMPLETADO') ? 'success' : 'warning' }} rounded-circle btn-circle">
                                                    <i data-feather="{{ $pago->estado_detalle == config('constants.ESTADO_DETALLE_PAGO_COMPLETADO') ? 'check-circle' : 'info' }}"
                                                        class="text-white"></i>
                                                </div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Cuota de pago
                                                        ({{ $pago->numero_cuota_detalle }})
                                                    </h6>
                                                    <span class="font-12 text-nowrap d-block text-muted">
                                                        {{ $pago->estado_detalle == config('constants.ESTADO_DETALLE_PAGO_COMPLETADO') ? 'Realizado el ' . DateUtil::getFechaSimple($pago->pago_actualizado) : 'A la espera de pago que vence el ' . DateUtil::getFechaSimple($pago->fecha_fin_detalle) }}
                                                    </span>
                                                    <span
                                                        class="font-12 text-nowrap d-block text-muted"><b>{{ $pago->estado_detalle == config('constants.ESTADO_DETALLE_PAGO_COMPLETADO') ? 'Pago completado' : 'Espera de pago' }}</b>
                                                    </span>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link pt-3 text-center text-dark" href="{{ URL::route('contrato') }}">
                                        <strong>Ver todos los contratos</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <!-- End Notification -->
            <!-- ============================================================== -->
            <!-- create new -->
            <!-- ============================================================== -->
            @php
                $mes_actual = date('m');
                $citas = DB::select(
                    'select * from citas ci
                    inner join pacientes pa on pa.id_paciente = ci.id_paciente
                    where ci.id_empresa = ' .
                        auth()->user()->id_empresa .
                        ' 
                    and MONTH(ci.fecha_inicio_cita) >= ' .
                        $mes_actual .
                        '
                    order by ci.fecha_inicio_cita asc',
                );

            @endphp

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-expanded="false">
                    <i data-feather="bell" class="svg-icon"></i>
                    <span class="badge badge-primary notify-no rounded-circle">{{ count($citas) }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown scroll">
                    <div class="card">
                        <div class="card-header">
                            Citas del mes ({{ date('F') }})
                        </div>
                        <div class="card-body">
                            <ul class="list-style-none">
                                <li>
                                    <div class="message-center notifications position-relative">
                                        @foreach ($citas as $cita)
                                            <!-- Message -->
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-1">
                                                <div
                                                    class="btn btn-<?php
                                                    if (DateUtil::getFechaSimple($cita->fecha_inicio_cita) == DateUtil::getFechaSimple(now())) {
                                                        # code...
                                                        echo 'warning';
                                                    } else {
                                                        echo 'primary';
                                                    }
                                                    ?>
                                                rounded-circle btn-circle">
                                                    <i data-feather="calendar" class="text-white"></i>
                                                </div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Cita con
                                                        <b>{{ $cita->nombres_paciente }}</b>
                                                    </h6>
                                                    <span class="font-12 text-nowrap d-block text-muted">
                                                        Programada para el
                                                        {{ DateUtil::getFechaSimple($cita->fecha_inicio_cita) }} a las
                                                        {{ DateUtil::getHora($cita->fecha_inicio_cita) }}
                                                    </span>
                                                    <span class="font-12 text-nowrap d-block "><b
                                                            class="bold">"{{ $cita->descripcion_cita }}"</b></span>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link pt-4 text-center text-dark" href="{{ URL::route('cita') }}">
                                        <strong>Ver todas las citas</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item d-none d-md-block">
                <a class="nav-link" href="javascript:void(0)">
                    <div class="customize-input">
                        <select class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                            <option selected>ES</option>
                        </select>
                    </div>
                </a>
            </li>
        </ul>
        <!-- ============================================================== -->
        <!-- Right side toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav float-right">
            <!-- ============================================================== -->
            <!-- Search -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">

                @php
                    $empresas = DB::select('select * from empresas where id_empresa = ' . auth()->user()->id_empresa);

                @endphp
                @foreach ($empresas as $empresa)
                    <div class="border-top-0 px-2 py-4">
                        <div class="d-flex no-block align-items-center">
                            <div class="mr-3">
                                <img src="{{ $empresa->logo_empresa }}" alt="user" class="rounded-circle"
                                    width="45" height="50" />
                            </div>
                            <div class="nav-item d-none d-md-block">
                                <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                    {{ $empresa->nombre_comercial_empresa }}
                                </h5>
                                <span class="text-muted font-14">
                                    {{ $empresa->razon_social_empresa }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown row pr-2">
                <a class="nav-link dropdown-toggle" id="perfil" href="javascript:void(0)" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ auth()->user()->profile_photo_path }}"  class="rounded-circle" width="40" height="40">
                    </a>

                </a>
                <span class="d-none d-md-block nav-link dropdown-toggle" style="cursor: pointer;"
                    data-toggle="dropdown">
                    <span>Hello,</span>
                    <span class="text-dark">
                        {{ auth()->user()->name }}
                    </span> <i data-feather="chevron-down" class="svg-icon"></i>
                </span>
                <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                    <a class="dropdown-item" href="{{ url('/user/profile') }}"><i data-feather="smile"
                            class="svg-icon mr-2 ml-1"></i>
                        Perfil de Usuario</a>
                    <a class="dropdown-item" href="{{ route('perfil') }}"><i data-feather="user"
                            class="svg-icon mr-2 ml-1"></i>
                        Perfil de Empresa</a>
                    <a class="dropdown-item" href="{{ route('contrato') }}"><i data-feather="credit-card"
                            class="svg-icon mr-2 ml-1"></i>
                        Mis contratos</a>
                    <div class="dropdown-divider"></div>
                    <div class="pl-4 p-3"><a href="{{ route('logout') }}" class="btn btn-sm btn-info">
                            <i data-feather="power" class="svg-icon mr-2 pb-1"></i>Cerrar Sesión</a></div>
                </div>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
        </ul>
    </div>
</nav>
