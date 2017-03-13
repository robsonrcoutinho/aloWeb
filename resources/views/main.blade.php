<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{!! asset('images/icon_tab.png') !!}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    {!! Html::style('css/app.css') !!}
    {!! Html::style('css/style.css') !!}
    <title>S. C. Atacado</title>

</head>

<body>

<div class="navbar-wrapper">
    <div class="container-fluid">
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img class="navbar-brand" src="{!! asset('images/icon_tab.png') !!}">
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{route('main')}}" class="">Home</a></li>
                        @can('visualizar', App\Pedido::class)
                        <li><a href="{{route('pedidos')}}">Pedidos</a></li>
                        @endcan
                        @can('visualizar', App\Produto::class)
                        <li><a href="{{route('produtos')}}">Produtos</a></li>
                        @endcan
                        @can('visualizar', App\Marca::class)
                        <li><a href="{{route('marcas')}}">Marcas</a></li>
                        @endcan
                        @can('visualizar', App\Categoria::class)
                        <li><a href="{{route('categorias')}}">Categorias</a></li>
                        @endcan
                        @can('visualizar', App\Estoque::class)
                        <li><a href="{{route('estoques')}}">Estoque</a></li>
                        @endcan
                        @can('visualizar', App\Promocao::class)
                        <li><a href="{{route('promocaos')}}">Promoções</a></li>
                        @endcan

                        @can('visualizar', App\User::class)
                        <li><a href="{{route('users')}}">Gerenciar Usuários</a></li>
                        @endcan
                    </ul>

                    <ul class="nav navbar-nav pull-right">
                        @if(Auth::check())
                            <li><a href="{{route('chats')}}">Chat</a></li>
                            <li class=""><a class="nome-user-menu" href="">{{Auth::user()->name}}</a></li>
                        @endif
                        <li class="sair"><a class="red-btn-sair" href="{{ route('logout') }}">
                                <span class="glyphicon glyphicon-log-out"></span>Sair</a></li>
                        {{ csrf_field() }}
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<br />
<br />
<br />

@yield('content')


</body>

</html>