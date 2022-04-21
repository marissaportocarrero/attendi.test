@extends('connect.master')
@section('title','Iniciar sesión')

@section('content')

<div class="page login-bg1">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col-md-5 p-md-0">
                    <div class="card p-5">
                        <div class="pl-4 pt-4 pb-2">
                            <a class="header-brand" href="{{url('index')}}">
                                <img src="{{URL::asset('assets/images/brand/logo.png')}}" class="header-brand-img custom-logo" alt="Dayonelogo">
                                <img src="{{URL::asset('assets/images/brand/logo-white.png')}}" class="header-brand-img custom-logo-dark" alt="Dayonelogo">
                            </a>
                        </div>
                        <div class="p-5 pt-0">
                            <h1 class="mb-2">Login</h1>
                            <p class="text-muted">Inicia sesión con tu cuenta</p>
                        </div>
                        {!! Form::open(['url' => '/login', 'class' => 'card-body pt-3 needs-validation', 'novalidate', 'name' => 'login']) !!}
                            <div class="form-group">
                                <label class="form-label">Correo electrónico</label>
                                {!! Form::email('email', null, ['class' => 'form-control', 'Placeholder' => 'Correo electrónico', 'autocomplete' =>'off', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label class="form-label">Contraseña</label>
                                {!! Form::password ('password', ['class'=> 'form-control', 'Placeholder' => 'Contraseña', 'autocomplete' =>'off'])  !!}
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1">
                                    <span class="custom-control-label">Recordar</span>
                                </label>
                            </div>
                            <div class="submit">
                                {!!Form::submit('Iniciar sesión',['class' => 'btn btn-primary btn-block']) !!}
                            </div>
                            <div class="text-center mt-3">
                                <p class="text-dark mb-0"><a href="{{ url('/recover')}}">¿Olvidaste tu contraseña?</a></p>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
