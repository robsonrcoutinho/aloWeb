@extends('main')
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">Listagem de Mensagens do Chat</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                @can('salvar', App\Chat::class)
                                <a href="{{ route('chats.chat')}}" class="btn btn-sm btn-primary">Entrar</a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            @foreach($chats as $chat)
                                    <h5>{{'Data/Hora: '.date('d/m/Y H:i:s', strtotime($chat->created_at))}}</h5>
                                    <h5>{{utf8_encode('Usuário: '.$chat->usuario->name)}}</h5>
                                    <p>{{'Mensagem: '.$chat->mensagem}}</p>
                                    <a href="{{route('chats.excluir',['id'=>$chat->id])}}" class="btn btn-danger"><em
                                                class="fa fa-trash"></em></a>
                                <hr />
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection