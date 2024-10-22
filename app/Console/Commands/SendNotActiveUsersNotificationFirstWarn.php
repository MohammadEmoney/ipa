<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\FirstMembershipWarningNotification;
use Illuminate\Console\Command;

class SendNotActiveUsersNotificationFirstWarn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:not-active-first';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notActiveUsers = User::query()->whereHas('roles', function($query){
            $query->whereIn('name', ['users']);
        })->notActive()->get();

        foreach($notActiveUsers as $user)
            $user->notify(new FirstMembershipWarningNotification);
    }
}
