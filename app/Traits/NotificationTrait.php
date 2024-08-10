<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\User;
use App\Notifications\Admin\NewOrderNotification;

trait NotificationTrait
{
    public function adminNewOrderNotifications(Order $order)
    {
        $users = User::role(['super-admin', 'admin', 'content-manager'])->get();
        foreach($users as $user){
            $user->notify(new NewOrderNotification($order));
        }
    }
}