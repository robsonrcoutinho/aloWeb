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
                                <h3 class="panel-title">Listagem de Produtos</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                <a class="btn btn-sm btn-primary btn-create"
                                   href="{{route('produtos.novo')}}">Criar Novo</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa"></em></th>

                                <th>Nome Poduto</th>
                                <th>Valor</th>
                                <th>Categoria</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($produtos as $prod)
                            <tr>
                                <td align="center">
                                    <a class="btn btn-default"><em class="fa fa-pencil"></em></a>
                                    <a class="btn btn-danger" href="{{route('produtos.excluir',['id'=>$prod->id])}}"><em class="fa fa-trash"></em></a>
                                </td>
                                <td>{{$prod->nome_produto}}</td>
                                <td>{{$prod->valor}}</td>
                                <td>{{$prod->categoria->nome_categoria}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                  <!--  <div class="panel-footer">
                        <div class="row">
                            <div class="col col-xs-4">Page 1 of 5
                            </div>
                            <div class="col col-xs-8">
                                <ul class="pagination hidden-xs pull-right">
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                </ul>
                                <ul class="pagination visible-xs pull-right">
                                    <li><a href="#">«</a></li>
                                    <li><a href="#">»</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> !-->
                </div>

            </div></div></div>

    @endsection