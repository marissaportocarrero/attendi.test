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
                            <p class="text-muted">Ingrese el código de recuperación</p>
                        </div>

                        @include('admin.layouts.alert')
                        {!! Form::open  (['url' => '/reset', 'class' => 'card-body pt-3', 'autocomplete' =>'off']) !!}
                            <div class="form-group">
                                {!! Form::email ('email', $email, ['class'=> 'form-control', 'readonly'])  !!}
                            </div>
                            <div class="form-group">
                                <label class="form-label">Código de recuperación</label>
                                {!! Form::number ('code', null, ['class'=> 'form-control', 'placeholder'=>'Código de recuperación', 'autofocus', 'required'])  !!}
                            </div>
                            <div class="submit">
                                {!!Form::submit('Enviar contraseña',['class' => 'btn btn-primary btn-block']) !!}
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
