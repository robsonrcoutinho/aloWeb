<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{!! asset('images/icon_tab.png') !!}"/>

    {!! Html::style('css/app.css') !!}

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
                        <li class="active"><a href="#" class="">Home</a></li>
                        <li><a href="#">Pedidos</a></li>
                        <li><a href="#">Produtos</a></li>
                        <li><a href="#">Estoque</a></li>
                        <li><a href="#">Promoções</a></li>
                    </ul>


                    <ul class="nav navbar-nav pull-right">
                        <li class=""><a href="#">Mudar Senha</a></li>
                        <li class=""><a href="#">Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>




</body>

</html>