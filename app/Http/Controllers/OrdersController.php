<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;


class OrdersController extends Controller
{

    public function index(Request $request)
    {
        $orders = Order::query()
            ->with(['items.product','items.productSku'])
            ->where('user_id',$request->user()->id)
            ->orderBy('created_at','desc')
            ->paginate();
        return view('orders.index',['orders'=>$orders]);
    }

    public function show(Request $request,Order $order)
    {
        $this->authorize('own',$order);
        return view('orders.show',['order'=>$order->load(['items.productSku','items.product'])]);
    }

    public function store(OrderRequest $request,CartService $cartService,OrderService $orderService)
    {
        $user = $request->user();
        $address = UserAddress::find($request->input('address_id'));
        return $orderService->store($user, $address, $request->input('remark'), $request->input('items'));
    }
}
