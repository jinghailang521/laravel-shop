@extends('layouts.app')
@section('title','订单列表')

@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">订单列表</div>
            <div class="panel-body">
                <ul class="list-group">
                    @foreach( $orders as $order )
                        <li class="list-group-item">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    订单号：{{ $order->no }}
                                    <span class="pull-right">{{ $order->created_at->format('Y-m-d H:i:s') }}</span>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>商品信息</th>
                                                <th class="text-center">单价</th>
                                                <th class="text-center">数量</th>
                                                <th class="text-center">订单总价</th>
                                                <th class="text-center">状态</th>
                                                <th class="text-center">操作</th>
                                            </tr>
                                        </thead>
                                        @foreach( $order->items as $index=>$item )

                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="pull-right">{{ $orders->render() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection