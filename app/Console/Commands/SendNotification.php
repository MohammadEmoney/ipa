<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notification';

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
        // $user =User::find(119);
        // dd($user);
        $activeUsers = User::query()->active()->whereHas('roles', function($query){
            $query->whereIn('name', ['users']);
        })->count();
        $notActiveUsers = User::query()->whereHas('roles', function($query){
            $query->whereIn('name', ['users']);
        })->notActive()->count();
        $usersNotCompletedProfile = User::query()->active()->whereHas('roles', function($query){
            $query->whereIn('name', ['users']);
        })->where(function (Builder $query) {
            // Check for required fields in User model
            $query->whereNull('first_name')
                  ->orWhereNull('last_name')
                  ->orWhereNull('phone')
                  ->orWhereNull('phone_verified_at');
        })
        ->orWhereDoesntHave('media', function (Builder $query) {
            // Check for media for nationalCard and license
            $query->whereIn('name', ['nationalCard', 'license']);
        })
        ->orWhereDoesntHave('userInfo', function (Builder $query) {
            // Check for required fields in userInfo
            $query->whereNull('situation')
                  ->orWhere(function (Builder $query) {
                      $query->where('situation', 'employed')
                            ->whereNull('airline_id');
                  });
        })
        ->count();
        $usersCompletedProfile = User::query()->active()->whereHas('roles', function($query){
            $query->whereIn('name', ['users']);
        })->whereNot(function (Builder $query) {
            // Check for required fields in User model
            $query->whereNull('first_name')
                  ->orWhereNull('last_name')
                  ->orWhereNull('phone')
                  ->orWhereNull('phone_verified_at');
        })
        ->whereHas('media', function (Builder $query) {
            // Ensure media for nationalCard and license exists
            $query->whereIn('collection_name', ['nationalCard', 'license']);
        })
        ->whereHas('userInfo', function (Builder $query) {
            // Ensure required fields in userInfo are filled
            $query->whereNotNull('situation')
                  ->where(function (Builder $query) {
                      $query->where('situation', '!=', 'employed')
                            ->orWhereNotNull('airline_id');
                  });
        })
        ->count();

        dd($activeUsers, $notActiveUsers, $usersCompletedProfile, $usersNotCompletedProfile);

    }
}
