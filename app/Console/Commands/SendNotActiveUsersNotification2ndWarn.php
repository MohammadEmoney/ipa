<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\SecondMembershipWarningNotification;
use Illuminate\Console\Command;

class SendNotActiveUsersNotification2ndWarn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:not-active-second';

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
            $user->notify(new SecondMembershipWarningNotification);
    }
}
