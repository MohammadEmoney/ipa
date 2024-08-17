<?php

namespace App\Livewire\Front\Pages;

use App\Models\Page;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Livewire\Component;

class LivePageShow extends Component
{    
    use AlertLiveComponent;
    
    public $page;
    public $title;

    public function mount(Page $page)
    {
        $this->page = $page->load(['createdBy', 'media']);
        $this->title = $page->title;
    }

    public function download($collection = 'attachment')
    {
        $page = $this->page;
        if($page->getFirstMedia($collection))
            return $page->getFirstMedia($collection);
        $this->alert(__('messages.file_not_exists'))->error();
    }

    public function render()
    {
        return view('livewire.front.pages.live-page-show')->extends('layouts.front')->section('content');
    }
}
