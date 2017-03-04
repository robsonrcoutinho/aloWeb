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
                                <h3 class="panel-title">Listagem de Categorias</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                @can('salvar', App\Categoria::class)
                                <a href="{{ route('categorias.novo')}}" class="btn btn-sm btn-primary btn-create">Criar
                                    novo</a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa"></em></th>
                                <th>Nome Categoria</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categorias as $categoria)
                                <tr>
                                    <td align="center">
                                        @can('alterar', App\Categoria::class)
                                        <a href="{{route('categorias.editar',['id'=>$categoria->id])}}"
                                           class="btn btn-default"><em class="fa fa-pencil"></em></a>
                                        @endcan
                                        @can('excluir', App\Categoria::class)
                                        <a href="{{route('categorias.excluir',['id'=>$categoria->id])}}"
                                           class="btn btn-danger"><em class="fa fa-trash"></em></a>
                                        @endcan
                                    </td>
                                    <td>{{$categoria->nome_categoria}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection