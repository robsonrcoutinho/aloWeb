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
                               <!-- @can('salvar', App\Marca::class)
                                <a href="{{ route('marcas.novo')}}" class="btn btn-sm btn-primary btn-create">Criar
                                    novo</a>
                                @endcan -->
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            @foreach($chats as $chat)

                                <fieldset>
                                   <!-- <legend>Mensagem</legend> -->
                                    <h5>{{'Data/Hora: '.date('d/m/Y H:i:s', strtotime($chat->created_at))}}</h5>
                                    <h5>{{utf8_encode('Usuário: '.$chat->usuario->name)}}</h5>
                                    <textarea readonly class="form-control">{{$chat->mensagem}}</textarea>
                                    <br />
                                    <a href="{{route('chats.excluir',['id'=>$chat->id])}}" class="btn btn-danger"><em
                                                class="fa fa-trash"></em></a>
                                </fieldset>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection