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
                                <h3 class="panel-title">Listagem de Estoques</h3>
                            </div>
                            <!-- @can('salvar', App\Estoque::class) <div class="col col-xs-6 text-right">
                                    <a class="btn btn-sm btn-primary btn-create"
                                    href="{{route('estoques.novo')}}">Criar Novo</a>
                                    @endcan
                                    </div>-->
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! $estoques->render() !!}
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa"></em></th>
                                <th>Nome Poduto</th>
                                <th>Quantidade</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($estoques as $estoque)
                                <tr>
                                    <td align="center">
                                        @can('alterar', App\Estoque::class)
                                        <a class="btn btn-default" title="Editar"
                                           href="{{route('estoques.editar',['id'=>$estoque->id])}}">
                                            <em class="fa fa-pencil"></em></a>
                                        @endcan
                                                <!--  @can('excluir', App\Estoque::class) <a class="btn btn-danger" href="{{route('estoques.excluir',['id'=>$estoque->id])}}"><em class="fa fa-trash"></em></a> @endcan -->
                                    </td>
                                    <td>{{$estoque->produto->nome_produto}}</td>
                                    <td>{{$estoque->quantidade}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $estoques->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
