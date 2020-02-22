<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/theme/assets/images/favicon.png') }}">
    <title>@yield('title')</title>
    <!-- This page CSS -->
    <!-- This page CSS -->
    <link href="{{ asset('/theme/assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('/theme/eliteadmin/dist/css/style.min.css') }}" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{ asset('/theme/eliteadmin/dist/css/pages/dashboard4.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="{{ asset('/theme/assets/node_modules/html5-editor/bootstrap-wysihtml5.css') }}" />
    <link href="{{ asset('/theme/assets/node_modules/datatables/media/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/eliteadmin/dist/css/pages/icon-page.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="{{ asset('/theme/assets/node_modules/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/assets/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/theme/assets/node_modules/dropify/dist/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/theme/assets/node_modules/html5-editor/bootstrap-wysihtml5.css') }}" />
    <link href="{{ asset('/theme/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/theme/assets/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('/theme/assets/node_modules/dropzone-master/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/theme/assets/node_modules/clockpicker/dist/jquery-clockpicker.min.css') }}" rel="stylesheet">
</head>

<body class="skin-blue fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Congalsa - Back</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/admin/index') }}">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('/files/logo_blanco.png') }}" width="90%" />
                            <!-- Light Logo icon -->
                            {{-- <img src="{{ asset('/files/logo_blanco.png') }}" alt="homepage" class="light-logo" /> --}}
                        </b> 
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('/theme/assets/images/users/1.jpg') }}" alt="user" class=""> 
                                <span class="hidden-md-down">
                                    {{ Auth::user()->name }} &nbsp;
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <div class="dropdown-divider"></div>
                                <a href="{{ url('/admin/logout') }}" class="dropdown-item">
                                    <i class="fa fa-power-off"></i> Salir
                                </a>
                                <!-- text-->
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End User Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="user-pro"> 
                            <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <img src="{{ asset('/theme/assets/images/users/1.jpg') }}" alt="user-img" class="img-circle">
                                <span class="hide-menu">
                                    {{ Auth::user()->name }}
                                </span>
                            </a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="{{ url('/admin/index') }}" aria-expanded="false">
                                <i class="icon-speedometer"></i>
                                <span class="hide-menu">
                                    Dashboard
                                </span>
                            </a>
                        </li>
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="ti-layout-grid2"></i>
                                <span class="hide-menu">Usuarios</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="{{ url('/admin/users') }}">
                                        Lista de usuarios
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/users/create') }}">
                                        Agregar usuario
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="ti-layout-grid2"></i>
                                <span class="hide-menu">Noticias</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="{{ url('/admin/news/categories') }}">
                                        Categorías
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/news') }}">
                                        Lista de noticias
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/news/create') }}">
                                        Agregar noticia
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="ti-layout-grid2"></i>
                                <span class="hide-menu">Eventos</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="{{ url('/admin/events') }}">
                                        Lista de eventos
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/events/create') }}">
                                        Agregar evento
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="ti-layout-grid2"></i>
                                <span class="hide-menu">Pruebas de desarrollo</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="{{ url('/admin/test') }}">
                                        Lista de productos
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/test/create') }}">
                                        Agregar producto
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="ti-layout-grid2"></i>
                                <span class="hide-menu">Productos Canjeables</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="{{ url('/admin/products') }}">
                                        Lista de productos
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/products/create') }}">
                                        Agregar producto
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="ti-layout-grid2"></i>
                                <span class="hide-menu">Canal cocina</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="{{ url('/admin/recipes/categories') }}">
                                        Categorías
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/recipes') }}">
                                        Lista de recetas
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/recipes/create') }}">
                                        Agregar receta
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="ti-layout-grid2"></i>
                                <span class="hide-menu">Preguntas</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="{{ url('/admin/videos-question') }}">
                                        Videos
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/questions') }}">
                                        Lista de preguntas
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/questions/create') }}">
                                        Agregar pregunta
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="ti-layout-grid2"></i>
                                <span class="hide-menu">Mejoras sociales</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="{{ url('/admin/socials') }}">
                                        Lista de mejoras
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/socials/create') }}">
                                        Agregar mejora
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="{{ url('/admin/bonus') }}" aria-expanded="false">
                                <i class="far fa-circle text-success"></i>
                                <span class="hide-menu">
                                    Bonus
                                </span>
                            </a>
                        </li>
                        <li> 
                            <a class="waves-effect waves-dark" href="{{ url('/admin/logout') }}" aria-expanded="false">
                                <i class="far fa-circle text-success"></i>
                                <span class="hide-menu">
                                    Salir
                                </span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-12 col-lg-12 align-self-center">
                        <h4 class="text-themecolor">@yield('title_page')</h4>
                    </div>
                </div>
                @yield('body')
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Tema del Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>Con tema claro</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>Con tema oscuro</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme ">7</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © {{ date('Y') }} {{-- Desarrollado por <a href="https://ceroideas.es" target="_blank">Ceroideas</a> --}}
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('/theme/assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="{{ asset('/theme/assets/node_modules/popper/popper.min.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('/theme/eliteadmin/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('/theme/eliteadmin/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('/theme/eliteadmin/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('/theme/eliteadmin/dist/js/custom.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--Sky Icons JavaScript -->
    <script src="{{ asset('/theme/assets/node_modules/skycons/skycons.js') }}"></script>
    <!--morris JavaScript -->
    <script src="{{ asset('/theme/assets/node_modules/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('/theme/eliteadmin/dist/js/dashboard4.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="{{ asset('/theme/assets/node_modules/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/dropify/dist/js/dropify.min.js') }}"></script>
    {{-- <link rel="stylesheet" href="{{ asset('/js/dropzone.css') }}">
    <script src="{{ asset('/js/dropzone.js') }}"></script> --}}
    <script src="{{ asset('/theme/assets/node_modules/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/theme/assets/node_modules/moment/moment.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/dropzone-master/dist/dropzone.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
    @yield('scripts')
</body>

</html>