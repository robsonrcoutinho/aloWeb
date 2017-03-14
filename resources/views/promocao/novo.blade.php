@extends('main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <ol class="breadcrumb panel-heading">
                        <li><a href="{{ route('promocaos') }}">Promocao</a></li>
                        <li class="active">Novo</li>
                    </ol>
                    <div class="form-horizontal">
                        {!! Form::open(['route'=>'promocaos.salvar']) !!}
                        {{ csrf_field() }}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach(collect($errors->all())->unique() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </div>
                        @endif
                        <div class="form-group">
                            {!! Form::label ('titulo', 'Titulo: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('titulo', null, ['class'=>'form-control', 'value'=>old('titulo'), 'placeholder'=>"Titulo"]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label ('valor', 'Valor: ',['class'=>'control-label col-xs-2']) !!}
                            <div class="col-xs-5">
                                {!! Form::text('valor', null, ['class'=>'form-control', 'value'=>old('valor'), 'placeholder'=>"Valor"]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#ModalProdutos"> Produtos
                                </button>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="ModalProdutos" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Produtos</h4>
                                    </div>
                                    <div class="modal-body">
                                        @foreach($produtos as $produto)
                                            {!! Form::checkbox('produtos[]', $produto->id, null,['id'=>$produto->id, 'class'=>'filled-in']) !!}
                                            {!! Form::label($produto->id, $produto->nome_produto) !!}
                                            <br/>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Html::script('js/app.js') !!}
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-10">
                                {{ Form::submit ('Gravar', ['class'=>'btn btn-primary']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection