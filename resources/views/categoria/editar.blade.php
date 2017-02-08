@extends('main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <ol class="breadcrumb panel-heading">
                        <li><a href="{{ route('marcas') }}">Categoria</a></li>
                        <li class="active">Editar</li>
                    </ol>

                    <div class="panel-body">
                        {!! Form::open(['route'=>['categorias.alterar', $categoria->id], 'method'=>'put']) !!}
                        {{ csrf_field() }}
                        @if($errors->any())
                            <ul class="alert alert-warning">
                                @foreach(collect($errors->all())->unique() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="form-group">
                            {!! Form::hidden ('id', $categoria->id, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label ('nome_categoria', 'Nome Categoria: ') !!}
                            {!! Form::text ('nome_categoria', $categoria->nome_categoria, ['class'=>'form-control']) !!}
                        </div>
                        {!! Form::submit ('Gravar', ['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection