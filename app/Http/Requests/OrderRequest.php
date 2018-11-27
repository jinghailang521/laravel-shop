<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\ProductSku;

class OrderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //判断用户提交的地址ID是否存在于数据库并属于当前用户
            'address_id'    => ['required',Rule::exists('user_addresses','id')->where('user_id',$this->user()->id)],
            'item'          => ['required'.'array'],
            'items.*.sku_id'=> [
                'required',
                function($attribute,$value,$fail){
                    if( !$sku = ProductSku::find($value) ){
                        $fail('该商品不存在');
                        return;
                    }
                    if( !$sku->product->on_sale ){
                        $fail('该商品未上架');
                        return;
                    }
                    if( $sku->stock === 0 ){
                        $fail('该商品已售完');
                    }
                    //获取当前索引
                    preg_match('/items\.(\d+)\.sku_id/',$attribute,$m);
                    $index = $m[1];
                    //根据索引找到用户提交的购买数量
                    $amount = $this->input('items')[$index]['amount'];
                    if( $amount>0 && $amount > $sku->stock ){
                        $fail('该商品库存不足');
                    }
                }
            ],
            'items.*.amount'    => ['required','integer','min:1']
        ];
    }
}
