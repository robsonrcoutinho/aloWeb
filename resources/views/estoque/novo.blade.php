@extends('main')
    @section('content')

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col col-xs-6">
                                    <h3 class="panel-title">Cadastrar Estoque</h3>
                                </div>
                            </div>
                        </div>

                        @if(isset($errors) && count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <p>{{$error}}</p>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-horizontal">
                            {!! Form::open(['route'=>'estoques.salvar']) !!}
                            <div class="form-group">
                                {!! Form::label ('fk_id_produto', 'Produto ',[ 'class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {{Form::select('fk_id_produto',$produtos,null, ['id','class'=>'form-control'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('quantidade', 'Quantidade ',['class'=>'control-label col-xs-2']) !!}
                                <div class="col-xs-5">
                                    {!! Form::number('quantidade', old('valor'), ['class'=>'form-control','placeholder'=>'Quantidade']) !!}
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


