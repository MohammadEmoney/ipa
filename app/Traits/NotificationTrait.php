<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\User;
use App\Notifications\Admin\NewOrderNotification;
use App\Notifications\NewDocNotification;
use Illuminate\Support\Facades\Artisan;

trait NotificationTrait
{
    public function stripTagsPreservingNewlines($text)
    {
        // Replace block-level tags with a newline character
        $text = preg_replace('/<\/?(p|div|h[1-6])\s*.*?>/', ' ', $text);
        
        // Now strip all other tags
        $text = strip_tags($text);
        
        // Optionally, trim extra new lines
        $text = preg_replace('/\n+/', ' ', $text); // Replace multiple newlines with a single newline
        $text = trim($text); // Trim whitespace from the beginning and end

        return $text;
    }

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

    public function completedProfile()
    {
        return Artisan::call('notify:completed-profile');
    }

    public function notCompletedProfile()
    {
        return Artisan::call('notify:not-completed-profile');
    }

    public function membershipFirstWarning()
    {
        return Artisan::call('notify:not-active-first');
    }

    public function membershipSecondWarning()
    {
        return Artisan::call('notify:not-active-second');
    }
}