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
                                <h3 class="panel-title">Chat</h3>
                            </div>

                        </div>
                    </div>


                    <div class="panel-body">

                        <fieldset>
                            <legend>Mensagem</legend>
                            <textarea class="form-control" maxlength="255" id="mensagem" name="mensagem"></textarea>

                        </fieldset>
                        <button class="btn btn-primary" id="btn-enviar" value="Enviar">Enviar</button>

                        <fieldset>

                            <legend>Mensagens</legend>
                            <ul id="mensagens" class="list-unstyled">
                                @foreach($chats as $chat)
                                    <li id="{{'chat_'.$chat->id}}">
                                        {{$chat->usuario->name.' '.date('d/m/Y H:i:s', strtotime($chat->created_at))}}
                                        <br/>
                                        {{$chat->mensagem}}
                                    </li>
                                @endforeach
                            </ul>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
     {!! Html::script('js/chat.js') !!}
@endsection