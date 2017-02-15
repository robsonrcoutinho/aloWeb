@extends('main')
    @section('content')


        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col col-xs-6">
                                    <h3 class="panel-title">Editar Estoque</h3>
                                </div>
                            </div>
                        </div>
                        <div class="form-horizontal">
                            {!! Form::open(['route'=>['estoques.alterar', $estoque->id], 'method'=>'put']) !!}
                            {{ csrf_field() }}
                            @if(isset($errors) && count($errors)>0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group">
                                {!! Form::hidden ('id', $estoque->id, ['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label ('produto', 'Produto ',[ 'class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {{Form::text('produto',$estoque->produto->nome_produto, ['id','class'=>'form-control', 'disabled'])}}
                                    {{Form::hidden('fk_id_produto', $estoque->produto->id)}}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('quantidade', 'Quantidade ',['class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {!! Form::number('quantidade', $estoque->quantidade, ['class'=>'form-control','placeholder'=>'Quantidade']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-10">
                                    {{ Form::submit ('Gravar', ['class'=>'btn btn-primary']) }}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div></div></div>
    @endsection

