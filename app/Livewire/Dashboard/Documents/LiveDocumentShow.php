<?php

namespace App\Livewire\Dashboard\Documents;

use App\Models\Document;
use App\Traits\AlertLiveComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveDocumentShow extends Component
{
    use AlertLiveComponent;
    use WithFileUploads;

    public $document;
    public $title;

    public function mount(Document $document)
    {
        $this->document = $document;
        $this->title = $document->title;
    }

    public function download()
    {
        if(Auth::user()->can('active_user')){
            $document = $this->document;
            if($mediaItem = $document->getFirstMedia('attachment'))
                return $document->getFirstMedia('attachment');
            $this->alert(__('messages.file_not_exists'))->error();
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.documents.live-document-show')->extends('layouts.panel')->section('content');
    }
}
