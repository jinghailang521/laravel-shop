<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Auth\Events\Registered;

//implements ShouldQueue 让这个
class RegisteredListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * 当事件触发时执行，对应事件的监听器触发
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        //获取刚刚注册的用户
        $user = $event->user();
        $user->notify(New EmailVerificationNotification());

    }
}
