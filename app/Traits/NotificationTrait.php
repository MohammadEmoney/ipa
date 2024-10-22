<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\User;
use App\Notifications\Admin\NewOrderNotification;
use App\Notifications\NewDocNotification;

trait NotificationTrait
{
    public function adminNewOrderNotifications(Order $order)
    {
        $users = User::role(['super-admin', 'admin', 'content-manager'])->get();
        foreach($users as $user){
            $user->notify(new NewOrderNotification($order));
        }
    }

    public function getUsers($roles = ['user'])
    {
        return User::query()->active()->whereHas('roles', function($query) use ($roles){
            $query->whereIn('name', $roles);
        })->get();
    }

    public function sendNewDocNotification($document, $roles = ['user'])
    {
        $users = $this->getUsers($roles);
        foreach($users as $user)
            $user->notify(new NewDocNotification($document));
    }
}