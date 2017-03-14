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
                                <h3 class="panel-title">Listagem de Marcas</h3>
                            </div>
                            <div class="col col-xs-6 text-right">
                                @can('salvar', App\Marca::class)
                                <a href="{{ route('marcas.novo')}}" class="btn btn-sm btn-primary btn-create">
                                    Criar novo</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! $marcas->render() !!}
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa"></em></th>
                                <th>Marca</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($marcas as $marca)
                                <tr>
                                    <td align="center">
                                        @can('alterar', App\Marca::class)
                                        <a class="btn btn-default" title="Editar"
                                           href="{{route('marcas.editar',['id'=>$marca->id])}}">
                                            <em class="fa fa-pencil"></em></a>
                                        @endcan
                                        @can('excluir', App\Marca::class)
                                        <a class="btn btn-danger" title="Excluir"
                                           href="{{route('marcas.excluir',['id'=>$marca->id])}}">
                                            <em class="fa fa-trash"></em></a>
                                        @endcan
                                    </td>
                                    <td>{{$marca->marca}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $marcas->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection