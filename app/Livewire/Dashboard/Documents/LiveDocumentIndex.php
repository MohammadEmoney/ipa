<?php

namespace App\Livewire\Dashboard\Documents;

use App\Models\Document;
use App\Traits\AlertLiveComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LiveDocumentIndex extends Component
{
    use AlertLiveComponent, WithPagination;

    protected $listeners = [ 'destroy'];

    public $paginate = 8;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;
    public $title;
    public $filter = [];

    public function mount()
    {
        $this->title = __('global.documents');
    }

    public function resetFilter()
    {
        $this->filter = [];
    }

    public function download($id)
    {
        if(Auth::user()->can('active_user')){
            $document = Document::query()->find($id);
            if($document->getFirstMedia('attachment'))
                return $document->getFirstMedia('attachment');
            $this->alert(__('messages.file_not_exists'))->error();
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function show($id)
    {
        return redirect()->to(route('user.documents.show', $id));
    }

    public function render()
    {
        $documents = Document::query()->lang()->with(['media']);
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $documents = $documents->where(function($query) use ($search){
                $query->where('title', "like", "%$search%")
                    ->orWhere('slug', "like", "%$search%");
                    // ->orWhere('description', "like", "%$search%")
                    // ->orWhere('summary', "like", "%$search%");
            });
        }
        $documents = $documents->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.dashboard.documents.live-document-index', compact('documents'))->extends('layouts.panel')->section('content');
    }
}
