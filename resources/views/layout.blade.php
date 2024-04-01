<!DOCTYPE html>
<html dir="ltr" lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">


<head>
    @include('plantilla.link')

</head>
@if (auth()->user()->estado)

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
@else
    <style>
        body {
            height: 100vh;
            background-image: radial-gradient(closest-side, #2EA3F2, #2874B8);
            text-align: center;
            color: #fff;
            font-family: "Helvetica Neue";
            font-size: 16px;
            line-height: 1.5;
        }

        .logo {
            margin: 40px auto;
            display: block;
        }

        h1 {
            font-size: 24px;
            line-height: 40px;
            margin: 0 auto 16px;
            padding: 0 20px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            letter-spacing: 0.5px;
            font-weight: 600;
            max-width: 600px;
        }

        p {
            color: #D6DCE0;
            font-weight: 300;
            max-width: 600px;
            margin: 0 auto 24px;
            text-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
            letter-spacing: 0.5px;
            padding: 0 20px;

            a {
                color: inherit;

                &:hover {
                    color: #fff;
                }
            }
        }

        .button {
            color: #2EA3F2;
            background: #fff;
            border-radius: 3px;
            display: inline-block;
            padding: 12px 48px;
            text-decoration: none;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease-out;

            &:hover {
                margin-top: -2px;
                box-shadow: 0 6px 24px rgba(0, 0, 0, 0.4);
            }
        }

        .browser {
            width: 400px;
            min-width: 200px;
            min-height: 264px;
            background: #FFFFFF;
            box-shadow: 0 40px 80px 0 rgba(0, 0, 0, 0.25);
            border-radius: 3px;
            animation: bobble 1.8s ease-in-out infinite;
            position: relative;
            left: 50%;
            margin-left: -200px;

            .controls {
                width: 100%;
                height: 32px;
                background: #E8ECEF;
                border-radius: 3px 3px 0 0;
                box-sizing: border-box;
                padding: 10px 12px;

                i {
                    height: 12px;
                    width: 12px;
                    border-radius: 100%;
                    display: block;
                    float: left;
                    background: #D6DCE0;
                    margin-right: 8px;
                }
            }
        }

        .eye {
            position: absolute;
            left: 34%;
            top: 80px;
            width: 32px;
            height: 32px;
            opacity: 1;

            +.eye {
                right: 34%;
                left: auto;
            }

            &:before,
            &:after {
                position: absolute;
                left: 15px;
                content: ' ';
                height: 40px;
                width: 3px;
                border-radius: 2px;
                background-color: #FF5E5B;
            }

            &:before {
                transform: rotate(45deg);
            }

            &:after {
                transform: rotate(-45deg);
            }
        }

        .mouth {
            position: absolute;
            width: 250px;
            top: 178px;
            left: 50%;
            margin-left: -125px;
            height: 40px;

            .lips {
                position: absolute;
                left: 15px;
                content: ' ';
                height: 40px;
                width: 3px;
                border-radius: 2px;
                background-color: #FF5E5B;
                transform: rotate(-54deg);

                &:nth-child(odd) {
                    transform: rotate(54deg);
                }

            }
        }

        @keyframes bobble {

            0%,
            100% {
                margin-top: 40px;
                margin-bottom: 48px;
                box-shadow: 0 40px 80px rgba(0, 0, 0, 0.24);
            }

            50% {
                margin-top: 54px;
                margin-bottom: 34px;
                box-shadow: 0 24px 64px rgba(0, 0, 0, 0.40);
            }
        }

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            .browser {
                width: 280px;
                margin-left: -140px;

                .eye {
                    left: 30%;

                    +.eye {
                        left: auto;
                        right: 30%;
                    }
                }
            }
        }
    </style>
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/612187/mc-logo-white.svg" class="logo" width="192">

    <div class="browser">
        <div class="controls">
            <i></i>
            <i></i>
            <i></i>
        </div>

        <div class="eye"></div>
        <div class="eye"></div>
        
    </div>

    <h1>Fuiste dado de baja :(</h1>
    <p>Sentimos mucho no seguir contando contigo dentro de nuestro equipo, extrañamos que seas parte de nosotros.
        Nunca es tarde para volver... 
        <br>
        <a href="http://mcause.us/supportticket"><u>Contactar con equipo de soporte</u></a>.</p>
    <a href="{{ route('logout') }}" class="btn btn-outline btn-light text-dark">
        <i data-feather="power" class="fa fa-close"></i>Volver a iniciar sesión</a>
    <!-- 404 text -->
    <!--
<h1>Unfortunately, this page does not exist.</h1>
<p>The link you clicked may be broken or the page may have been removed.</p>
-->
@endif


</html>
