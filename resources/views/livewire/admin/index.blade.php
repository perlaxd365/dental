<div>
    <!-- *************************************************************** -->
    <!-- Start First Cards -->
    <!-- *************************************************************** -->

    <style>
        #rssBlock {
            left: 0px;
            height: 80px;
            background: #FFFFFF;
            position: absolute;
            width: 1070px;
            overflow: hidden;
        }

        /*remove p*/
        .cnnContents {
            width: 100%;
            padding-top: 20px;
            margin: 0 auto;
            font-size: 30px;
            white-space: nowrap;
            text-transform: uppercase;
            font-weight: 300;
        }

        .marqueeStyle {
            display: inline-block;
            /* Apply animation to this element */
            -webkit-animation: scrolling-left1 20s linear infinite;
            animation: scrolling-left1 20s linear infinite;
        }

        .marqueeStyle2 {
            display: inline-block;
            /* Apply animation to this element */
            -webkit-animation: scrolling-left2 20s linear infinite;
            animation: scrolling-left2 20s linear infinite;
            animation-delay: 10s;
        }

        /* scrolling-left is continuous/repeatly text */
        @keyframes scrolling-left1 {
            0% {
                transform: translateX(100%);
                -webkit-transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
                -webkit-transform: translateX(-100%);
            }
        }

        @keyframes scrolling-left2 {
            0% {
                transform: translateX(0%);
                -webkit-transform: translateX(0%);
            }

            100% {
                transform: translateX(-200%);
                -webkit-transform: translateX(-200%);
            }
        }

        @-webkit-keyframes scrolling-left1 {
            0% {
                -webkit-transform: translateX(100%);
            }

            100% {
                -webkit-transform: translateX(-100%);
            }
        }

        @-webkit-keyframes scrolling-left2 {
            0% {
                -webkit-transform: translateX(0%);
            }

            100% {
                -webkit-transform: translateX(-200%);
            }
        }
    </style>
    <div class="card-group row">
        <div class="card border-right col-md-4">
            <a href="{{ URL::route('contrato') }}">
                <div class="card-body">
                    <div class="d-flex d-lg-flex d-md-block align-items-center">
                        <div class="col-md-10" id='rssBlock'>
                            <div class="d-inline-flex align-items-center cnnContents">
                                <h2 class="text-dark mb-1 font-weight-medium">Activo <i
                                        class="fa fa-circle text-success font-12" data-toggle="tooltip"
                                        data-placement="top" title="In Testing"></i></h2>
                                <span
                                    class="badge bg-secondary font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">Cuotas
                                    ({{ ReporteUtil::totalCuotas(auth()->user()->id_empresa) }})</span>
                           
                                </div>
                            @if (ReporteUtil::totalContratos(auth()->user()->id_empresa))
                                <h6 class="text-muted font-weight-normal text-truncate marqueeStyle">
                                    Contrato
                                    ({{ ReporteUtil::totalContratos(auth()->user()->id_empresa) }}) |
                                    Próxima cuota :
                                    &nbsp;<b class="text-info">({{ DateUtil::getFechaSimple(ReporteUtil::getCuotaActual(auth()->user()->id_empresa)->fecha_fin_detalle) }})</b>
                                </h6>
                            @endif

                        </div>
                        <div class="ml-auto mt-lg-0">
                            <span class="opacity-7 text-muted"><i data-feather="file-text"></i></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
    <div class="card-group row">
        <div class="card border-right col-md-4">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-dark mb-1 font-weight-medium">
                                {{ ReporteUtil::totalPacientes(auth()->user()->id_empresa) }}</h2>
                            <span
                                class="badge bg-info font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">+{{ ReporteUtil::pacientesMesPasado(auth()->user()->id_empresa) }}%</span>
                        </div>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Nuevos Clientes de este mes
                        </h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right col-md-4">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                class="set-doller">S/</sup>{{ ReporteUtil::totalVentas(auth()->user()->id_empresa) }}
                        </h2>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Ventas de este mes
                        </h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted">
                            <h3>S/</h3>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-md-4">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-dark mb-1 font-weight-medium">
                            {{ ReporteUtil::totalCitas(auth()->user()->id_empresa) }}</h2>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Citas de este mes</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-md-4">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-dark mb-1 font-weight-medium">
                            {{ ReporteUtil::totalRecetas(auth()->user()->id_empresa) }}</h2>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Recetas de este mes</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- *************************************************************** -->
    <!-- End First Cards -->
    <!-- *************************************************************** -->
    <!-- *************************************************************** -->
    <!-- Start Sales Charts Section -->
    <!-- *************************************************************** -->
    <div class="row">
        <link href='http://fonts.googleapis.com/css?family=Oxygen:300' rel='stylesheet' type='text/css'>
        <meta charset="utf-8">
        <title>Chartist.js - Simple line chart</title>

        </head>

        <body>
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body table-responsive" id="line-chart">
                        <h4 class="card-title text-muted text-dark">Reporte de ventas</h4>
                        <div class="reporte-anual mt-4 position-relative" style="height:294px;"></div>
                        <ul class="list-inline text-center mt-5 mb-2">
                            <li class="list-inline-item text-muted font-italic">Ventas de todos los meses</li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            $datos = ReporteUtil::getVentasAnuales(auth()->user()->id_empresa);
            ?>
            <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
            <script>
                var datos = <?php echo json_encode($datos); ?>;
                var meses = [];
                Object.keys(datos).forEach(function(key) {
                    meses.push(datos[key].Mes);
                })
                console.log(meses)
                var totales = [];
                Object.keys(datos).forEach(function(key) {
                    totales.push(datos[key].Total);
                })

                // THIS IS WHERE THE ERROR OCCURS
                new Chartist.Bar('.reporte-anual', {
                    labels: meses,
                    series: [
                        totales,
                    ]
                }, {
                    width: 400,
                    height: 300,

                    axisY: {
                        labelInterpolationFnc: function(value) {
                            return "S/" + (value);
                        }
                    },
                });
            </script>
    </div>
</div>
