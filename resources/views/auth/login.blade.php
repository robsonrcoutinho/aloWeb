<!DOCTYPE html>

<html lang="{{ config('app.locale') }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{!! asset('images/icon_tab.png') !!}"/>

    {!! Html::style('css/loginstyle.css') !!}
    {!! Html::style('css/app.css') !!}

    <style>

    </style>

    <title>Login S.C. Atacado</title>


</head>

<body>
<div class="wrapper dark-header">
    <header class="main-header">
        <div class="logo">S.C. Atacado</div>
        <div class="navbar navbar-static-top">
            <div class="btn-grps pull-right">
                <a href="{{route('register')}}" class="pink-btn">Registrar</a>
            </div>
        </div>
    </header>
    <section class="login-inner">
        <div class="login-middle">
            <div class="login-details">
                <form class="form-horizontal" role="form" method="POST" action="auth">
                    {!! csrf_field() !!}
                    <ul class="alert alert-warning">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        @elseif(Session::has('erro_autenticacao'))
                            <li>Email e/ou senha inválidos</li>
                        @endif
                    </ul>

                    <h2>Login</h2>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label>
                        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}"/>
                    </label>
                    <label>
                        <input type="password" name="password" placeholder="senha"/>
                    </label>
                    <div class="btn-sub">
                        <button class="pink-btn">Entrar</button>
            <span>
              <a href="#">Esqueceu sua senha?</a>
            </span>
                    </div>

                </form>
            </div>
        </div>
    </section>

</div>
</body>
</html>