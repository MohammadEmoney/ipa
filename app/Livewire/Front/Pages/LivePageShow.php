<?php

namespace App\Livewire\Front\Pages;

use App\Models\Page;
use Livewire\Component;

class LivePageShow extends Component
{
    public $page;
    public $title;

    public function mount(Page $page)
    {
        $this->page = $page->load(['createdBy', 'media']);
        $this->title = $page->title;
    }

    public function render()
    {
        return view('livewire.front.pages.live-page-show')->extends('layouts.front')->section('content');
    }
}
