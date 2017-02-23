<!DOCTYPE html>
<html lang="en">
<head>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="{!! asset('images/icon_tab.png') !!}"/>

        {!! Html::style('css/loginstyle.css') !!}
        {!! Html::style('css/app.css') !!}

    <title>S.C Atacado</title>

</head>
<body>
<div class="wrapper dark-header">
<header class="main-header">
    <div class="logo">S.C. Atacado</div>
    <div class="navbar navbar-static-top">
        <div class="btn-grps pull-right">

        </div>
    </div>
</header>

        @yield('content')
</div>
</body>
</html>
