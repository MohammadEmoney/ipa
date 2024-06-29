<?php

namespace App\Livewire\Dashboard\Users;

use App\Traits\AlertLiveComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LiveUserPassword extends Component
{
    use AlertLiveComponent;

    public $disabledCreate = true;
    public $data = [];

    public function passwordValidation()
    {
        $this->validate(
            [
                'data.current_password' => 'required|string',
                'data.password' => 'required|confirmed|min:8|max:255',
            ],
            [],
            [
                'data.password' => __('global.password'),
                'data.current_password' => __('global.current_password'),
            ]
        );
    }

    public function updatedData()
    {
        $this->disabledCreate = true;
        $this->passwordValidation();
        $this->disabledCreate = false;
    }

    public function checkData()
    {
        $this->disabledCreate = true;
        $this->passwordValidation();
        $this->disabledCreate = false;
    }

    public function submit()
    {
        $this->passwordValidation();
        $user = Auth::user();
        if(Hash::check($this->data['current_password'], $user->password)){
            $user->update(['password' => Hash::make($this->data['password'])]);
            $this->data = [];
            $this->alert(__('messages.password_changed'))->success();
        }else{
            $this->alert(__('messages.current_password_not_correct'))->error();
        }
    }


    public function render()
    {
        return view('livewire.dashboard.users.live-user-password')->extends('layouts.panel')->section('content');
    }
}
