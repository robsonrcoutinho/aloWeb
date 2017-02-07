@extends('main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <ol class="breadcrumb panel-heading">
                        <li><a href="{{ route('marcas') }}">Marca</a></li>
                        <li class="active">Novo</li>
                    </ol>
                    <div class="panel-body">
                        <form action="{{ route('marcas.salvar')}}" method="post">
                            {{ csrf_field() }}
                            @if($errors->any())
                                <ul class="alert alert-warning">
                                    @foreach(collect($errors->all())->unique() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="form-group">
                                {!! Form::label ('marca', 'Marca: ') !!}
                                {!! Form::text ('marca', null, ['class'=>'form-control']) !!}
                            </div>
                            <button class="btn btn-info">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection