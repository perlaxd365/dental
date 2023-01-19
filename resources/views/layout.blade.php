<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    @include('plantilla.link')
    
</head>

<body>
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            @include('plantilla.header')
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar NAVEGACION-->
                <nav class="sidebar-nav">
                    @include('plantilla.nav')
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <!-- TITULO -->

                <div class="row">
                    <div class="col-7 align-self-center">
                        <div class="row"><i data-feather="@yield('icon')" class="feather-icon"></i>
                            &nbsp;&nbsp;
                            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
                                @yield('title')
                            </h3>
                            &nbsp;|&nbsp;
                            <a href="{{ URL::route(Route::current()->getName()) }}">@yield('view')</a>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select
                                class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>@yield('date')</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- CONTENIDO -->
                @yield('content')
                @livewireStyles
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted">
                @yield('plantilla.footer')
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
            <script>
                window.addEventListener('alert', event => {
                    toastr.options.positionClass = 'toast-bottom-right';
                    toastr[event.detail.type](event.detail.message,
                        event.detail.title)
                })
            </script>
        </div>
    </div>

    @include('plantilla.script')
</body>

</html>
