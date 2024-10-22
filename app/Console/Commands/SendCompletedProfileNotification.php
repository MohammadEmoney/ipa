<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\CompletedProfileNotification;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class SendCompletedProfileNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:completed-profile';

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
        $usersCompletedProfile = User::query()->active()->whereHas('roles', function($query){
            $query->whereIn('name', ['users']);
        })->whereNot(function (Builder $query) {
            $query->whereNull('first_name')
                  ->orWhereNull('last_name')
                  ->orWhereNull('phone')
                  ->orWhereNull('phone_verified_at');
        })
        ->whereHas('media', function (Builder $query) {
            $query->whereIn('collection_name', ['nationalCard', 'license']);
        })
        ->whereHas('userInfo', function (Builder $query) {
            $query->whereNotNull('situation')
                  ->where(function (Builder $query) {
                      $query->where('situation', '!=', 'employed')
                            ->orWhereNotNull('airline_id');
                  });
        })
        ->get();

        foreach($usersCompletedProfile as $user)
            $user->notify(new CompletedProfileNotification);
    }
}
