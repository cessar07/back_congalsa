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
    <title>Congalsa - Login</title>
    
    <!-- page css -->
    <link href="{{ asset('/theme/eliteadmin/dist/css/pages/login-register-lock.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('/theme/eliteadmin/dist/css/style.min.css') }}" rel="stylesheet">
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
    body{
        background: white !important;
        padding-top: 0px !important
    }
</style>
</head>

<body class="skin-default card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Congalsa Back</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <img src="{{ asset('/files/pez.gif') }}" width="250">
                    <div style="height: 10px"></div>
                </div>
            </div>
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" action="{{ url('/admin/login') }}" method="POST">
                    	{{ csrf_field() }}
                        <h3 class="text-center m-b-20">Ingresar</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input type="email" name="email" class="form-control" type="text" placeholder="Email"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" name="password" type="password" placeholder="Contraseña"> 
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Ingresar</button>
                            </div>
                        </div>
                        @if($errors->any())
                        	<div class="form-group">
                        		<div class="col-xs-12 p-b-20">
                        			<div class="alert alert-danger text-center">
                        				{{ $errors->first() }}
                        			</div>
                        		</div>
                        	</div>
                        @endif
                        @if(session()->has('error'))
                        	<div class="form-group">
                        		<div class="col-xs-12 p-b-20">
                        			<div class="alert alert-danger text-center">
                        				{{ session()->get('error') }}
                        			</div>
                        		</div>
                        	</div>
                        @endif
                    </form>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-12 text-center">
                    <img src="{{ asset('/files/pez.gif') }}" width="400">
                    <div style="height: 10px"></div>
                </div>
            </div> --}}
        </div>
    </section>
    
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('/theme/assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('/theme/assets/node_modules/popper/popper.min.js') }}"></script>
    <script src="{{ asset('/theme/assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
    
</body>

</html>