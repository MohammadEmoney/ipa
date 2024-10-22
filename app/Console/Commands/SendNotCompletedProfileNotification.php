<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\NotCompletedProfileNotification;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class SendNotCompletedProfileNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:not-completed-profile';

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
        $usersNotCompletedProfile = User::query()->active()->whereHas('roles', function($query){
            $query->whereIn('name', ['users']);
        })->where(function (Builder $query) {
            $query->whereNull('first_name')
                  ->orWhereNull('last_name')
                  ->orWhereNull('phone')
                  ->orWhereNull('phone_verified_at');
        })
        ->orWhereDoesntHave('media', function (Builder $query) {
            $query->whereIn('name', ['nationalCard', 'license']);
        })
        ->orWhereDoesntHave('userInfo', function (Builder $query) {
            $query->whereNull('situation')
                  ->orWhere(function (Builder $query) {
                      $query->where('situation', 'employed')
                            ->whereNull('airline_id');
                  });
        })
        ->get();

        foreach($usersNotCompletedProfile as $user)
            $user->notify(new NotCompletedProfileNotification);
    }
}
