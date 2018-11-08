<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Cache;
use App\Notifications\EmailVerificationNotification;
use Mail;
use App\Exceptions\InvalidRequestException;

class EmailVerificationController extends Controller
{
    //
    public function verify(Request $request)
    {
        //从url取出email和token两个参数
        $email = $request->input('email');
        $token = $request->input('token');

        if( !$email || !$token ){
            throw new InvalidRequestException('验证链接不正确');
        }
        //从缓存中读取数据，我们把url中的token与缓存中的值做对比
        if($token != Cache::get('email_verification_'.$email) ){
            throw new InvalidRequestException('验证链接不正确或已过期');
        }
        //获取用户且验证
        if( !$user = User::where('email',$email)->first() ){
            throw new InvalidRequestException('用户不存在');
        }
        //完成验证，删除缓存中的key
        Cache::forget('email_verification_'.$email);
        $user->update(['email_verified'=>true]);

        return view('pages.success',['msg'=>'邮箱验证成功']);
    }
    //手动发送
    public function send(Request $request)
    {
        $user = $request->user();
        if( $user->email_verified ){
            throw new InvalidRequestException('你已经验证过邮箱');
        }
        $user->notify(new EmailVerificationNotification);
        return view('pages.success',['msg'=>'邮件发送成功']);
    }
}
