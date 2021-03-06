<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Order;

class OrderPolicy
{
    use HandlesAuthorization;

    public function own(User $user,Order $order)
    {
        return $order->user_id == $user->id;
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
