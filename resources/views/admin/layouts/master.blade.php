<!DOCTYPE html>
<html lang="es">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <!-- TITLE -->
    <title> @yield('title')</title>

    @include('admin.layouts.styles')

    @yield('cssdatable')

</head>

<body class="app sidebar-mini" id="index1">

    <!---Global-loader-->
    <div id="global-loader">
        <img src="{{URL::asset('assets/images/svgs/loader.svg')}}" alt="loader">
    </div>

    <div class="page">
        <div class="page-main">

            @include('admin.layouts.sidebar')

            <div class="app-content main-content">
                <div class="side-app">

                    @include('admin.layouts.header')

                    @yield('content')

                </div>
            </div><!-- end app-content-->
        </div>

        @include('admin.layouts.footer')

        @yield('modals')

    </div>

    @include('admin.layouts.scripts')
    @yield('jsdatatable')
    @yield('ajax')
    @yield('apimaps')
</body>

</html>
