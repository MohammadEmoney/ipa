<?php

namespace App\Livewire\Dashboard\Circulars;

use App\Models\Circular;
use App\Traits\AlertLiveComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveCircularShow extends Component
{
    use AlertLiveComponent;
    use WithFileUploads;

    public $circular;
    public $title;

    public function mount(Circular $circular)
    {
        $this->circular = $circular;
        $this->title = $circular->title;
    }

    public function download()
    {
        if(Auth::user()->can('active_user')){
            $circular = $this->circular;
            if($mediaItem = $circular->getFirstMedia('attachment'))
                return $circular->getFirstMedia('attachment');
            $this->alert(__('messages.file_not_exists'))->error();
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.circulars.live-circular-show')->extends('layouts.panel')->section('content');
    }
}
