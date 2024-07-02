<?php

namespace App\Livewire\Admin\Circulars;

use App\Models\Circular;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use App\Enums\EnumLanguages;
use App\Models\User;
use App\Notifications\CircularNotification;
use App\Traits\MediaTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class LiveCircularCreate extends Component
{
    use AlertLiveComponent;
    use MediaTrait;
    use WithFileUploads;

    public $title;
    public $circular;
    public $data = [];

    public function mount()
    {
        $this->title = __('global.create_circular');
    }

    public function validations()
    {
        $this->validate(
            [
                'data.lang' => 'nullable|in:' . EnumLanguages::asStringValues(),
                'data.title' => 'required|string|min:2|max:255',
                'data.slug' => 'required|unique:circulars,slug',
                'data.description' => 'nullable|string',
            ],
            [],
            [
                'data.lang' => __('global.lang'),
                'data.title' => __('global.title'),
                'data.slug' => __('global.slug'),
                'data.description' =>__('global.description'),
            ]
        );
    }

    public function updated($field, $value)
    {
        if($field === 'data.title')
            $this->data['slug'] = Str::slug($value);
        $this->dispatch('select2Initiation');
        $this->validations();
    }

    public function submit()
    {
        $this->validations();
        if(!isset($this->data['attachment']) ){
            return $this->addError('data.attachment', __('messages.circular_main_image_required'));
        }
        try {
            $circular =  Circular::create([
                'lang' => $this->data['lang'] ?? app()->getLocale(),
                'title' => $this->data['title'],
                'slug' =>  Str::slug($this->data['slug'] ?? ""),
                'description' => $this->data['description'] ?? null,
                'is_active' => true,
                'created_by' => Auth::id(),
            ]);
            $this->createImage($circular, 'attachment');
            $this->createImage($circular);
            $users = User::role('user')->permission('active_user')->get();
            Notification::send($users, new CircularNotification($circular));
            $this->alert(__('messages.circular_created_successfully'))->success();
            return redirect()->to(route('admin.circulars.index'));
        } catch (Exception $e) {
            $this->alert($e->getMessage())->error();
        }
       
    }
    public function render()
    {
        $langs = EnumLanguages::getTranslatedAll();
        return view('livewire.admin.circulars.live-circular-create', compact('langs'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
