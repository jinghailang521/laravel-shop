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
        return view('cart.index',['cartItems'=>$cartItems]);
    }

    //
    public function add(AddCartRequest $request)
    {
        $user   = $request->user();
        $skuId  = $request->input('sku_id');
        $amount = $request->input('amount');

        //商品是否已经在购物车内
        if( $cart = $user->cartItems()->where('product_sku_id',$skuId)->first() ){
            //存在则叠加商品数量
            $cart->update([
                'amount' => $cart->amount + $amount
            ]);
        }else{
            //创建新购物车
            $cart = new CartItem();
            $cart->amount = $amount;
            $cart->user()->associate($user);    //更新关联属性
            $cart->productSku()->associate($skuId); //更新管理属性
            $cart->save();
        }
        return [];
    }
    //移除商品
    public function remove($id,Request $request)
    {
        $request->user()->cartItems()->where('id',$id)->delete();
        return [];
    }
}
