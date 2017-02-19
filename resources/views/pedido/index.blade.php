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
                                <h3 class="panel-title">Listagem de Pedidos</h3>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa"></em></th>
                                <th>Data do Pedido</th>
                                <th>Cliente</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pedidos as $pedido)
                                <tr>
                                    <td align="center">
                                        <a href="{{route('pedidos.detalhar',['id'=>$pedido->id])}}" class="btn btn-default"><em class="fa fa-eye"></em></a>
                                    </td>
                                    <td>{{$pedido->data_pedido}}</td>
                                    <td>{{$pedido->usuario->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div></div></div>
@endsection
