<?php

namespace App\Livewire\Admin\Auth;

use App\Models\User;
use App\Traits\AlertLiveComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LiveLogin extends Component
{
    use AlertLiveComponent;

    public $title;
    public $email;
    public $password;
    public $remember_me;

    public function mount()
    {
        if (auth()->check()){
            if(auth()->user()->hasRole('super-admin'))
                return redirect()->to(route('admin.dashboard'));
            return redirect()->to(route('home'));
        }
        $this->title = __('global.login');
    }

    public function render()
    {
        return view('livewire.admin.auth.live-login')->extends('layouts.auth')->section('content');
    }

    public function login()
    {
        $this->validate(
            ['email' => 'required|email', 'password' => 'required', 'remember_me' => 'nullable|boolean'],
            [],
            ['email' => __('global.username'), 'password' => __('global.password'), 'remember_me' => __('global.remember_me')]
        );

        $user = User::where('email' , $this->email)->first();
        if($user && $user->hasRole(['super-admin', 'admin'])){
            if(Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)){
                $this->alert(__('messages.user_login'))->success();
                return redirect()->to(route('admin.dashboard'));
            }
        }
        $this->alert(__('messages.incorrect_login'))->error();

    }
}
