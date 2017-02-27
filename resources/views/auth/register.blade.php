@extends('layouts.app')

@section('content')
    <section class="login-inner">
        <div class="login-middle">
            <div class="login-details">
                <form role='form' class="form-horizontal" action="{{ route('register')}}" method="post">
                    {!! csrf_field() !!}
                    <h2>Registro</h2>
                    <ul class="alert alert-warning">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        @endif
                    </ul>
                    <div class="form-group">
                            {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Nome']) !!}
                    </div>
                    <div class="form-group">
                            {!! Form::text('email', old('email'), ['class'=>'form-control','placeholder'=>'E-mail']) !!}
                    </div>
                    <div class="form-group">
                           <!-- {!! Form::text('razao_social', old('razao_social'), ['class'=>'form-control', 'placeholder'=>'Razao Social']) !!} -->
                        <input type="text" class="form-control" name="razao_social" value="{{old('razao_social')}}" placeholder="Raz&atilde;o Social">
                    </div>
                    <div class="form-group">
                            {!! Form::text('nome_fantasia', old('nome_fantasia'), ['class'=>'form-control','placeholder'=>'Nome Fantasia']) !!}
                    </div>
                    <div class="form-group">
                            {!! Form::text('rua', old('rua'), ['class'=>'form-control','placeholder'=>'Rua']) !!}
                    </div>
                    <div class="form-group">
                            {!! Form::text('cidade', old('cidade'), ['class'=>'form-control','placeholder'=>'Cidade']) !!}
                    </div>
                    <div class="form-group">
                            {!! Form::text('uf', old('uf'), ['class'=>'form-control','placeholder'=>'UF']) !!}
                    </div>
                    <div class="form-group">
                            {!! Form::text('cnpj_cpf', old('cnpj_cpf'), ['class'=>'form-control','placeholder'=>'CNPJ/CPF']) !!}
                    </div>
                    <div class="form-group">
                            {!! Form::text('telefone', old('telefone'), ['class'=>'form-control','placeholder'=>'Telefone']) !!}
                    </div>
                    <div class="form-group">
                            <input type="password" name="password" placeholder="Senha"/>
                    </div>
                    <div class="form-group">
                            <input type="password" name="password_confirmation" placeholder="Confirmar Senha"/>
                    </div>
                    <div class="form-group">
                            <button class="pink-btn">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
