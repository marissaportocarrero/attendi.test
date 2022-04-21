@extends('connect.master')
@section('title','Login')

@section('content')

<div class="container-login100">
    <div class="wrap-login100 p-0">
        <div class="card-body">
            <div class="col col-login mx-auto mt-2 mb-4">
                <div class="text-center">
                    <img src="{{url('assets/images/brand/catadi.png')}}" class="header-brand-img" alt="" style="height: 40px;">
                </div>
                <span class="login100-form-title mt-3"> Registro </span>
            </div>
            @if(Session::has('message'))
            <div class="alert alert-{{ Session::get('typealert') }} alert-dismissible fade show" role="alert">
                <span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
                <span class="alert-inner--text"><strong>{{ Session::get('message') }}</strong>
                    @if ($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error}}</li>
                        @endforeach
                    </ul>
                    @endif
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif
            {!! Form::open(['url' => '/register', 'class' => 'login100-form validate-form']) !!}
                <div class="wrap-input100 validate-input" data-bs-validate = "">
                    {!! Form::text('name', null, ['class' => 'input100', 'Placeholder' => 'Nombre', 'autocomplete' =>'off']) !!}
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="zmdi zmdi-account" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-bs-validate = "">
                    {!! Form::text('lastname', null, ['class' => 'input100', 'Placeholder' => 'Apellido', 'autocomplete' =>'off']) !!}
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="zmdi zmdi-account" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-bs-validate = "">
                    {!! Form::email('email', null, ['class' => 'input100', 'Placeholder' => 'Correo electrónico', 'autocomplete' =>'off']) !!}
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="zmdi zmdi-email" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-bs-validate = "">
                    {!! Form::password ('password', ['class'=> 'input100', 'Placeholder' => 'Contraseña', 'autocomplete' =>'off'])  !!}
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-bs-validate = "">
                    {!! Form::password ('cpassword', ['class'=> 'input100', 'Placeholder' => 'Confirmar Contraseña', 'autocomplete' =>'off'])  !!}
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="container-login100-form-btn">
                    {!!Form::submit('Registrarse',['class' => 'login100-form-btn btn-primary']) !!}
                </div>
                <div class="text-center pt-3">
                    <p class="text-dark mb-0">Ya tienes una cuenta<a href="{{ url('/login')}}" class="text-primary ms-1">Ingresa aquí</a></p>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-center my-3">
                <a href="#" class="social-login  text-center me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="social-login  text-center me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-login  text-center">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@stop
