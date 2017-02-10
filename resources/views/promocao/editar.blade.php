@extends('main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <ol class="breadcrumb panel-heading">
                        <li><a href="{{ route('promocaos') }}">Promoção</a></li>
                        <li class="active">Editar</li>
                    </ol>

                    <div class="form-horizontal">
                        {!! Form::open(['route'=>['promocaos.alterar', $produto->id], 'method'=>'put']) !!}
                        {{ csrf_field() }}
                        @if($errors->any())
                            <ul class="alert alert-warning">
                                @foreach(collect($errors->all())->unique() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="form-group">
                            {!! Form::hidden ('id', $promocao->id, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label ('titulo', 'Título: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                            {!! Form::text('titulo', $promocao->titulo, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label ('valor', 'Valor: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('valor', $promocao->valor, ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                {!! Form::submit ('Gravar', ['class'=>'btn btn-primary']) !!}

                            </div>
                        </div>

                    </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection