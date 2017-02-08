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
                </br>

                <div class="form-horizontal">
                    {!! Form::open(['route'=>'produtos.salvar']) !!}
                    <div class="form-group">
                        <label for="inputNome" class="control-label col-xs-2">Nome Produto</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" id="inputNome" name="nome_produto" placeholder="Nome do Produto">
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label ('fk_id_categoria', 'Categoria ',[ 'class'=>'control-label col-xs-2']) !!}
                        <div class="col-xs-5">
                            {{Form::select('fk_id_categoria',$categorias,null, ['id','class'=>'form-control',
                             'placeholder'=>''])}}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label ('fk_id_marca', 'Marca ',[ 'class'=>'control-label col-xs-2']) !!}
                        <div class="col-xs-5">
                            {{Form::select('fk_id_marca',$marcas,null, ['id','class'=>'form-control',
                            'placeholder'=>''])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputValor" class="control-label col-xs-2">Valor R$</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" name="valor" id="inputValor" placeholder="Valor">
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

        </div></div></div>

    @endsection