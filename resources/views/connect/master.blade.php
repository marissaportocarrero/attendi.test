<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- META DATA -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="routeName" content="{{ Route::currentRouteName() }}">

		<!-- Title -->
		<title>Atendi - @yield('title')</title>

        <!--Favicon -->
		<link rel="icon" href="{{URL::asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="{{URL::asset('assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />

		<!-- Style css -->
		<link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('assets/css/dark.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

		<!-- Animate css -->
		<link href="{{URL::asset('assets/plugins/animated/animated.css')}}" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{URL::asset('assets/plugins/icons/icons.css')}}" rel="stylesheet" />

		<!-- Select2 css -->
		<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />

		<!-- P-scroll bar css-->
		<link href="{{URL::asset('assets/plugins/p-scrollbar/p-scrollbar.css')}}" rel="stylesheet" />
	</head>

	<body>

        @yield('content')

        <!-- Jquery js-->
		<script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>

		<!-- Bootstrap4 js-->
		<script src="{{URL::asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

        @yield('scripts')

		<!-- Select2 js -->
		<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>

		<!-- P-scroll js-->
		<script src="{{URL::asset('assets/plugins/p-scrollbar/p-scrollbar.js')}}"></script>

		<!-- Custom js-->
		<script src="{{URL::asset('assets/js/custom.js')}}"></script>

        <script>
            $('.alert').slideDown();
            setTimeout(function(){ $('.alert').slideUp(); }, 3000)
        </script>
	</body>
</html>
