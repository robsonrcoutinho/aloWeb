@extends('main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <ol class="breadcrumb panel-heading">
                        <li><a href="{{ route('produtos') }}">Produtos</a></li>
                        <li class="active">Editar</li>
                    </ol>
                    <div class="form-horizontal">
                        {!! Form::open(['route'=>['produtos.alterar', $produto->id], 'method'=>'put']) !!}
                        {{ csrf_field() }}
                        @if($errors->any())
                            <ul class="alert alert-warning">
                                @foreach(collect($errors->all())->unique() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="form-group">
                            {!! Form::hidden ('id', $produto->id, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label ('nome_produto', 'Nome Produto: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('nome_produto', $produto->nome_produto, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label ('fk_id_categoria', 'Categoria ',[ 'class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {{Form::select('fk_id_categoria',$categorias,$produto->fk_id_categoria, ['id','class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label ('fk_id_marca', 'Marca ',[ 'class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {{Form::select('fk_id_marca',$marcas,$produto->fk_id_marca, ['id','class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('valor', 'Valor R$', ['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('valor', $produto->valor, ['class'=>'form-control']) !!}
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

@endsection