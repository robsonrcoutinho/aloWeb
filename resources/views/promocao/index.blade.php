@extends('main')
@section('content')


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
      <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">Listagem de Promoções</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                @can('salvar', App\Promocao::class)
                                <a class="btn btn-sm btn-primary btn-create"
                                   href="{{route('promocaos.novo')}}">Criar Novo</a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa"></em></th>
                                <th>Título Promocao</th>
                                <th>Valor</th>
                                <th>Produtos</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($promocaos as $promocao)
                            <tr>
                                <td align="center">
                                    @can('alterar', App\Promocao::class)
                                    <a class="btn btn-default" href="{{route('promocaos.editar',['id'=>$promocao->id])}}"><em class="fa fa-pencil"></em></a>
                                    @endcan
                                    @can('excluir', App\Promocao::class)
                                    <a class="btn btn-danger" href="{{route('promocaos.excluir',['id'=>$promocao->id])}}"><em class="fa fa-trash"></em></a>
                                    @endcan
                                </td>
                                <td>{{$promocao->titulo}}</td>
                                <td>{{$promocao->valor}}</td>
                                <td>
                                    @foreach($promocao->produtos as $produto)
                                        <p>{{$produto->nome_produto}}</p>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div></div></div>

    @endsection