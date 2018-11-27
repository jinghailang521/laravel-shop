<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Http\Requests\AddCartRequest;
use App\Models\ProductSku;

class CartController extends Controller
{

    public function index(Request $request)
    {
        $cartItems = $request->user()->cartItems()->with(['productSku.product'])->get();
        $addresses = $request->user()->addresses()->orderBy('last_used_at', 'desc')->get();
        return view('cart.index', ['cartItems' => $cartItems, 'addresses' => $addresses]);
    }

    //
    public function add(AddCartRequest $request)
    {
        $user = $request->user();
        $skuId = $request->input('sku_id');
        $amount = $request->input('amount');
        //从数据库查询是否已经存在购物车
        if( $cart = $user->cartItems()->where('product_sku_id',$skuId)->first() ){
            $cart->update([
                'amount' => $cart->amount + $amount
            ]);
        }else{
            $cart = new CartItem(['amount'=>$amount]);
            $cart->user()->associate($user);
            $cart->productSku()->associate($skuId);
            $cart->save();
        }
    }
    //移除商品
    public function remove($id,Request $request)
    {
        $request->user()->cartItems()->where('id',$id)->delete();
        return [];
    }
}
