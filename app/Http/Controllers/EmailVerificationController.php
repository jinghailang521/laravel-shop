<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Cache;

class EmailVerificationController extends Controller
{
    //
    public function verify(Request $request)
    {
        //从url取出email和token两个参数
        $email = $request->input('email');
        $token = $request->input('token');

        if( !$email || !$token ){
            throw new Exception('验证链接不正确');
        }
        //从缓存中读取数据，我们把url中的token与缓存中的值做对比
        if($token != Cache::get('email_verification_'.$email) ){
            throw new Exception('验证链接不正确或已过期');
        }
        //获取用户且验证
        if( !$user = User::where('email',$email)->first() ){
            throw new Exception('用户不存在');
        }
        //完成验证，删除缓存中的key
        Cache::forget('email_verification_'.$email);
        $user->update(['email_verified'=>true]);

    }
}
