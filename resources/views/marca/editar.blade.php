@extends('main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <ol class="breadcrumb panel-heading">
                        <li><a href="{{ route('marcas') }}">Marca</a></li>
                        <li class="active">Editar</li>
                    </ol>

                    <div class="panel-body">
                        {!! Form::open(['route'=>['marcas.alterar', $marca->id], 'method'=>'put']) !!}
                        {{ csrf_field() }}
                        @if($errors->any())
                            <div class="alert alert-warning">
                                @foreach(collect($errors->all())->unique() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group">
                            {!! Form::hidden ('id', $marca->id, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label ('marca', 'Marca: ') !!}
                            {!! Form::text ('marca', $marca->marca, ['class'=>'form-control']) !!}
                        </div>
                        {!! Form::submit ('Gravar', ['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection