<?php

namespace App\Livewire\Admin\Notifications;

use App\Enums\EnumNotificationMethods;
use App\Enums\EnumUserRoles;
use App\Models\User;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveNotificationCreate extends Component
{
    use AlertLiveComponent, WithFileUploads, MediaTrait;

    public $sendVia = ['email'];
    public $data = [];
    public $title;

    public function mount()
    {
        $this->title = __('global.create_notification');
        $this->data['roles'] = ['user'];
        $this->data['from'] = 'info@iranianpilotsassociation.ir';
    }

    public function updated()
    {
        // dd('asdasd');
        // $this->dispatch('loadJs');
    }

    public function getUsers()
    {
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
        
    }

    public function selectAll()
    {
        $this->dispatch('loadJs');
        foreach($this->users() as $user)
            $this->data['users'][] =  $user->id;
    }

    public function users()
    {
        // dd($this->data['roles']);
        return User::query()->whereHas('roles', function($query){
            $query->whereIn('name', $this->data['roles']);
        })->get();
    }

    public function valiadtions()
    {
        // 
    }

    public function submit()
    {
        dd($this->data);
    }

    public function render()
    {
        $roles = EnumUserRoles::getTranslatedAll();
        // dd($roles);
        $sendMethods = EnumNotificationMethods::getTranslatedAll();

        $users = $this->users();
        $this->dispatch('loadJs');
        return view('livewire.admin.notifications.live-notification-create', compact('roles', 'users', 'sendMethods'))->extends('layouts.admin-panel')->section('content');
    }
}
