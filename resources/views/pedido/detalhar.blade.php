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
                                <h3 class="panel-title">Detalhes de Pedido</h3>
                            </div>
                            <div class="col col-xs-6 text-right">


                                @can('aceitar',$pedido)
                                <a class="btn btn-sm btn-primary btn-create"
                                   href="{{route('pedidos.aceitar',['id'=>$pedido->id] )}}">Aceitar</a>
                                @endcan
                                @can('despachar',$pedido)
                                <a class="btn btn-sm btn-success btn-create"
                                   href="{{route('pedidos.despachar',['id'=>$pedido->id] )}}">Despachar</a>
                                @endcan
                                @can('cancelar', $pedido)
                                    <a class="btn btn-sm btn-danger"
                                       href="{{route('pedidos.cancelar',['id'=>$pedido->id] )}}">Cancelar</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p>{{'Cliente: '.$pedido->usuario->name}}</p>
                        <p>{{'Data: '.date('d/m/Y',strtotime($pedido->data_pedido))}}</p>
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa"></em></th>
                                <th>Item</th>
                                <th>Quantidade</th>
                                <th>Valor Unitario</th>
                                <th>Valor Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pedido->items as $item)
                                <tr>
                                    <td align="center">
                                    </td>
                                    <td>
                                        @if($item->elemento_type === 'App\Promocao')
                                            {{'Promocao: '.$item->elemento->titulo}}
                                            @foreach($item->elemento->produtos as $produto)
                                                <br/> {{$produto->nome_produto}}
                                            @endforeach
                                        @else
                                            {{$item->elemento->nome_produto}}
                                        @endif
                                    </td>
                                    <td>{{$item->quantidade}}</td>
                                    <td>{{number_format($item->elemento->valor, 2, ',', '.')}}</td>
                                    <td>{{number_format($item->quantidade * $item->elemento->valor, 2, ',', '.')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4">Total</td>
                                <td>{{$total}}</td>
                            </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
