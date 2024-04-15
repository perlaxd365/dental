<div>
    <!-- *************************************************************** -->
    <!-- Start First Cards -->
    <!-- *************************************************************** -->

    <div class="card-group row">
        <div class="card border-right col-md-4">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-dark mb-1 font-weight-medium">Activo <i
                                    class="fa fa-circle text-success font-12" data-toggle="tooltip" data-placement="top"
                                    title="In Testing"></i></h2>
                            <span
                                class="badge bg-secondary font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">Cuotas
                                ({{ ReporteUtil::totalCuotas(auth()->user()->id_empresa) }})</span>
                        </div>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Contrato
                            ({{ ReporteUtil::totalContratos(auth()->user()->id_empresa) }}) |
                            Próxima cuota :
                            &nbsp;({{ ReporteUtil::getCuotaActual(auth()->user()->id_empresa)->fecha_fin_detalle }})
                        </h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="file-text"></i></span>
                    </div>
                </div>
            </div>
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
        <link href="https//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Oxygen:300' rel='stylesheet' type='text/css'>
        <meta charset="utf-8">
        <title>Chartist.js - Simple line chart</title>

        </head>

        <body>
            <div class="col-lg-12 col-md-12">
                <div class="card" id="line-container">
                    <div class="card-body table-responsive" >
                        <h4 class="card-title">Net Income</h4>
                        <div class="reporte-anual mt-4 position-relative" id="line-chart" style="height:294px;"></div>
                        <ul class="list-inline text-center mt-5 mb-2">
                            <li class="list-inline-item text-muted font-italic">Sales for this month</li>
                        </ul>
                    </div>
                </div>
            </div>
<style>
    #line-chart{
    background-color: rgb(55, 71, 79);
    width: 800px;
    height: 350px;
    font-family: Lato, Helvetica-Neue, monospace;
}
.ct-series-a .ct-line{
  stroke: #00a79d;
}
.ct-series-b .ct-line{
  stroke: #1c75bc;
}
.ct-series-c .ct-line{
  stroke: #92278f;
}
.ct-series-a .ct-point {
  stroke: #00a79d;
}
.ct-series-b .ct-point {
  stroke: #1c75bc;
}
.ct-series-c .ct-point {
  stroke: #92278f;
}
.ct-label{
  color: white;
}
</style>
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
                    width: 500,
                    height: 300,

                    axisY: {
                        labelInterpolationFnc: function(value) {
                            return "S/" + (value);
                        }
                    },
                });
                
            </script>
    </div>
    <!-- *************************************************************** -->
    <!-- End Sales Charts Section -->
    <!-- *************************************************************** -->
    <!-- *************************************************************** -->
    <!-- Start Location and Earnings Charts Section -->
    <!-- *************************************************************** -->
    <div class="row">
        <div class="col-md-6 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <h4 class="card-title mb-0">Earning Statistics</h4>
                        <div class="ml-auto">
                            <div class="dropdown sub-dropdown">
                                <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                    <a class="dropdown-item" href="#">Insert</a>
                                    <a class="dropdown-item" href="#">Update</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-4 mb-5">
                        <div class="stats ct-charts position-relative" style="height: 315px;"></div>
                    </div>
                    <ul class="list-inline text-center mt-4 mb-0">
                        <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Activity</h4>
                    <div class="mt-4 activity">
                        <div class="d-flex align-items-start border-left-line pb-3">
                            <div>
                                <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                    <i data-feather="shopping-cart"></i>
                                </a>
                            </div>
                            <div class="ml-3 mt-2">
                                <h5 class="text-dark font-weight-medium mb-2">New Product Sold!</h5>
                                <p class="font-14 mb-2 text-muted">John Musa just purchased <br> Cannon 5M
                                    Camera.
                                </p>
                                <span class="font-weight-light font-14 text-muted">10 Minutes Ago</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-start border-left-line pb-3">
                            <div>
                                <a href="javascript:void(0)" class="btn btn-danger btn-circle mb-2 btn-item">
                                    <i data-feather="message-square"></i>
                                </a>
                            </div>
                            <div class="ml-3 mt-2">
                                <h5 class="text-dark font-weight-medium mb-2">New Support Ticket</h5>
                                <p class="font-14 mb-2 text-muted">Richardson just create support <br>
                                    ticket</p>
                                <span class="font-weight-light font-14 text-muted">25 Minutes Ago</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-start border-left-line">
                            <div>
                                <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                    <i data-feather="bell"></i>
                                </a>
                            </div>
                            <div class="ml-3 mt-2">
                                <h5 class="text-dark font-weight-medium mb-2">Notification Pending Order!
                                </h5>
                                <p class="font-14 mb-2 text-muted">One Pending order from Ryne <br> Doe</p>
                                <span class="font-weight-light font-14 mb-1 d-block text-muted">2 Hours
                                    Ago</span>
                                <a href="javascript:void(0)" class="font-14 border-bottom pb-1 border-info">Load
                                    More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- *************************************************************** -->
    <!-- End Location and Earnings Charts Section -->
    <!-- *************************************************************** -->
    <!-- *************************************************************** -->
    <!-- Start Top Leader Table -->
    <!-- *************************************************************** -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title">Top Leaders</h4>
                        <div class="ml-auto">
                            <div class="dropdown sub-dropdown">
                                <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                    <a class="dropdown-item" href="#">Insert</a>
                                    <a class="dropdown-item" href="#">Update</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0 font-14 font-weight-medium text-muted">Team Lead
                                    </th>
                                    <th class="border-0 font-14 font-weight-medium text-muted px-2">Project
                                    </th>
                                    <th class="border-0 font-14 font-weight-medium text-muted">Team</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                        Status
                                    </th>
                                    <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                        Weeks
                                    </th>
                                    <th class="border-0 font-14 font-weight-medium text-muted">Budget</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-top-0 px-2 py-4">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="mr-3"><img src="assets/images/users/widget-table-pic1.jpg"
                                                    alt="user" class="rounded-circle" width="45"
                                                    height="45" /></div>
                                            <div class="">
                                                <h5 class="text-dark mb-0 font-16 font-weight-medium">Hanna
                                                    Gover</h5>
                                                <span class="text-muted font-14">hgover@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-top-0 text-muted px-2 py-4 font-14">Elite Admin</td>
                                    <td class="border-top-0 px-2 py-4">
                                        <div class="popover-icon">
                                            <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                href="javascript:void(0)">DS</a>
                                            <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                                href="javascript:void(0)">SS</a>
                                            <a class="btn btn-cyan rounded-circle btn-circle font-12 popover-item"
                                                href="javascript:void(0)">RP</a>
                                            <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                                href="javascript:void(0)">+</a>
                                        </div>
                                    </td>
                                    <td class="border-top-0 text-center px-2 py-4"><i
                                            class="fa fa-circle text-primary font-12" data-toggle="tooltip"
                                            data-placement="top" title="In Testing"></i></td>
                                    <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                        35
                                    </td>
                                    <td class="font-weight-medium text-dark border-top-0 px-2 py-4">$96K
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-4">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="mr-3"><img src="assets/images/users/widget-table-pic2.jpg"
                                                    alt="user" class="rounded-circle" width="45"
                                                    height="45" /></div>
                                            <div class="">
                                                <h5 class="text-dark mb-0 font-16 font-weight-medium">Daniel
                                                    Kristeen
                                                </h5>
                                                <span class="text-muted font-14">Kristeen@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-muted px-2 py-4 font-14">Real Homes WP Theme</td>
                                    <td class="px-2 py-4">
                                        <div class="popover-icon">
                                            <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                href="javascript:void(0)">DS</a>
                                            <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                                href="javascript:void(0)">SS</a>
                                            <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                                href="javascript:void(0)">+</a>
                                        </div>
                                    </td>
                                    <td class="text-center px-2 py-4"><i class="fa fa-circle text-success font-12"
                                            data-toggle="tooltip" data-placement="top" title="Done"></i>
                                    </td>
                                    <td class="text-center text-muted font-weight-medium px-2 py-4">32</td>
                                    <td class="font-weight-medium text-dark px-2 py-4">$85K</td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-4">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="mr-3"><img src="assets/images/users/widget-table-pic3.jpg"
                                                    alt="user" class="rounded-circle" width="45"
                                                    height="45" /></div>
                                            <div class="">
                                                <h5 class="text-dark mb-0 font-16 font-weight-medium">Julian
                                                    Josephs
                                                </h5>
                                                <span class="text-muted font-14">Josephs@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-muted px-2 py-4 font-14">MedicalPro WP Theme</td>
                                    <td class="px-2 py-4">
                                        <div class="popover-icon">
                                            <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                href="javascript:void(0)">DS</a>
                                            <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                                href="javascript:void(0)">SS</a>
                                            <a class="btn btn-cyan rounded-circle btn-circle font-12 popover-item"
                                                href="javascript:void(0)">RP</a>
                                            <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                                href="javascript:void(0)">+</a>
                                        </div>
                                    </td>
                                    <td class="text-center px-2 py-4"><i class="fa fa-circle text-primary font-12"
                                            data-toggle="tooltip" data-placement="top" title="Done"></i>
                                    </td>
                                    <td class="text-center text-muted font-weight-medium px-2 py-4">29</td>
                                    <td class="font-weight-medium text-dark px-2 py-4">$81K</td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-4">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="mr-3"><img src="assets/images/users/widget-table-pic4.jpg"
                                                    alt="user" class="rounded-circle" width="45"
                                                    height="45" /></div>
                                            <div class="">
                                                <h5 class="text-dark mb-0 font-16 font-weight-medium">Jan
                                                    Petrovic
                                                </h5>
                                                <span class="text-muted font-14">hgover@gmail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-muted px-2 py-4 font-14">Hosting Press HTML</td>
                                    <td class="px-2 py-4">
                                        <div class="popover-icon">
                                            <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                href="javascript:void(0)">DS</a>
                                            <a class="btn btn-success text-white font-20 rounded-circle btn-circle"
                                                href="javascript:void(0)">+</a>
                                        </div>
                                    </td>
                                    <td class="text-center px-2 py-4"><i class="fa fa-circle text-danger font-12"
                                            data-toggle="tooltip" data-placement="top" title="In Progress"></i></td>
                                    <td class="text-center text-muted font-weight-medium px-2 py-4">23</td>
                                    <td class="font-weight-medium text-dark px-2 py-4">$80K</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
