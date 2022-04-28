<!--aside open-->
<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{url('index')}} ">
            <img src="{{URL::asset('assets/images/brand/logo.png')}}" class="header-brand-img desktop-lgo" alt="">
            <img src="{{URL::asset('assets/images/brand/logo-white.png')}}" class="header-brand-img dark-logo" alt="">
            <img src="{{URL::asset('assets/images/brand/favicon.png')}}" class="header-brand-img mobile-logo" alt="">
            <img src="{{URL::asset('assets/images/brand/favicon1.png')}}" class="header-brand-img darkmobile-logo"
                alt="">
        </a>
    </div>
    <div class="app-sidebar3">
        <ul class="side-menu">
            <li class="slide ">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="feather feather-file sidemenu_icon"></i>
                    <span class="side-menu__label">Reportes</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li class="sub-slide">
                        <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span
                                class="sub-side-menu__label">Empleados</span><i
                                class="sub-angle fa fa-angle-right"></i></a>
                        <ul class="sub-slide-menu">
                            <li><a class="sub-slide-item" href="#">Total Empleados</a></li>
                        </ul>

                        <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span
                                class="sub-side-menu__label">Asistencia</span><i
                                class="sub-angle fa fa-angle-right"></i></a>
                        <ul class="sub-slide-menu">
                            <li><a class="sub-slide-item" href="{{ route('attendance.index') }}">Por Fecha</a></li>
                        </ul>
                        <a class="sub-side-menu__item" data-toggle="sub-slide" href="#"><span
                                class="sub-side-menu__label">Asistencia</span><i
                                class="sub-angle fa fa-angle-right"></i></a>
                        <ul class="sub-slide-menu">
                            <li><a class="sub-slide-item" href="{{ route('general.index') }}">Reporte general</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
<!--aside closed-->
