@extends('connect.master')
@section('title','Recuperar contraseña')

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
                            <h1 class="mb-2">Recuperar Contraseña</h1>
                            <p class="text-muted">Ingrese el correo electrónico registrado en tu cuenta</p>
                        </div>

                        @include('admin.layouts.alert')

                        {!! Form::open(['url' => '/recover', 'class' => 'card-body pt-3', 'autocomplete' =>'off']) !!}
                            <div class="form-group">
                                <label class="form-label">Correo electónico</label>
                                {!! Form::email('email', null, ['class' => 'form-control', 'Placeholder' => 'Ingresa tu correo electrónico', 'autofocus']) !!}
                            </div>
                            <div class="submit">
                                {!!Form::submit('Recuperar contraseña',['class' => 'btn btn-primary btn-block']) !!}
                            </div>
                            <div class="text-center mt-4">
                                <p class="text-dark mb-0"><a  href="{{ url('/login')}}" class="text-primary ml-1" href="#">Ingresar a mi cuenta</a></p>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
