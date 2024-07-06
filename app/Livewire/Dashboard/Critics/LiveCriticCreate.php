<?php

namespace App\Livewire\Dashboard\Critics;

use App\Models\Critic;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use App\Enums\EnumLanguages;
use App\Models\User;
use App\Notifications\CriticNotification;
use App\Traits\MediaTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class LiveCriticCreate extends Component
{
    use AlertLiveComponent;
    use MediaTrait;
    use WithFileUploads;

    public $title;
    public $critic;
    public $data = [];

    public function mount()
    {
        $this->title = __('global.create_critic');
    }

    public function validations()
    {
        $this->validate(
            [
                'data.title' => 'required|string|min:2|max:255',
                'data.description' => 'required|string',
            ],
            [],
            [
                'data.title' => __('global.title'),
                'data.description' =>__('global.description'),
            ]
        );
    }

    public function updated($field, $value)
    {
        $this->validations();
    }

    public function submit()
    {
        $this->validations();
        // if(!isset($this->data['attachment']) ){
        //     return $this->addError('data.attachment', __('messages.critic_main_image_required'));
        // }
        try {
            $critic =  Critic::create([
                'title' => $this->data['title'],
                'description' => $this->data['description'] ?? null,
                'user_id' => Auth::id(),
            ]);
            // $this->createImage($critic, 'attachment');
            // $users = User::role('user')->permission('active_user')->get();
            // Notification::send($users, new CriticNotification($critic));
            $this->alert(__('messages.critic_created_successfully'))->success();
            return redirect()->to(route('user.critics.index'));
        } catch (Exception $e) {
            $this->alert($e->getMessage())->error();
        }
       
    }
    public function render()
    {
        return view('livewire.dashboard.critics.live-critic-create')
            ->extends('layouts.panel')
            ->section('content');
    }
}
