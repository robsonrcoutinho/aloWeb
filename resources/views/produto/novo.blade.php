@extends('main')
    @section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                            <h3 class="panel-title">Cadastrar Produtos</h3>
                        </div>
                    </div>
                </div>
                </BR>

                <form class="form-horizontal">
                    {!! Form::open(['route'=>'produtos.salvar']) !!}
                    <div class="form-group">
                        <label for="inputNome" class="control-label col-xs-2">Nome Produto</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" id="inputNome" placeholder="Nome do Produto">
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label ('id', 'Categoria ',[ 'class'=>'control-label col-xs-2']) !!}
                        <div class="col-xs-5">
                            {{Form::select('categoria',$categorias,null, ['id','class'=>'form-control',
                             'placeholder'=>''])}}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label ('marca', 'Marca ',[ 'class'=>'control-label col-xs-2']) !!}
                        <div class="col-xs-5">
                            {{Form::select('marca',$marcas,null, ['id','class'=>'form-control',
                            'placeholder'=>''])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputValor" class="control-label col-xs-2">Valor R$</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" id="inputValor" placeholder="Valor">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            {!! Form::submit ('Gravar', ['class'=>'btn btn-primary']) !!}

                        </div>
                    </div>
                </form>
                {!! Form::close() !!}
            </div>

        </div></div></div>

    @endsection