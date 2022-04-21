@extends('emails.master')

@section('content')
<p>Hola: <strong>{{ $name }}</strong></p>
<p>Esta es la nueva contraseña para tu cuenta en nuestra plataforma.</p>
<p><h2>{{ $password}} </h2></p>
<p>Para continuar haga clic en el siguiente botón:</p>
<p><a href="{{ url('/login') }}" style="display: inline-block; background-color: #2F2FA2; color: #fff; padding: 12px; border-radius: 4px; text-decoration: none;" > Iniciar sesión</a></p>
<p>Si el bontón anterior no le funciona, copie y pegue la siguiente url en su navegador:</p>
<p>{{ url('/login') }} </p>
@stop
