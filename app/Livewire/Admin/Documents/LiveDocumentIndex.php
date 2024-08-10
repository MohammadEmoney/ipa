<?php

namespace App\Livewire\Admin\Documents;

use App\Models\Document;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use Livewire\WithPagination;

class LiveDocumentIndex extends Component
{
    use AlertLiveComponent, WithPagination;

    protected $listeners = [ 'destroy'];

    public $paginate = 10;
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
        $document = Document::query()->find($id);
        if($document->getFirstMedia('attachment'))
            return $document->getFirstMedia('attachment');
        $this->alert(__('messages.file_not_exists'))->error();
    }

    public function create()
    {
        return redirect()->to(route('admin.documents.create'));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('post_delete')){
            $document = Document::query()->find($id);

            if ($document) {
                $document->delete();
                $this->alert(__('messages.document_deleted'))->success();
            }
            else{
                $this->alert(__('messages.document_not_deleted'))->error();
            }
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.documents.edit', ['document' => $id]));
    }

    public function changeActiveStatus($id)
    {
        $document = Document::find($id);
        if($document){
            $document->update(['is_active' => !$document->is_active]);
            $this->alert(__('messages.updated_successfully'))->success();
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $documents = Document::query()->with(['media']);
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
        return view('livewire.admin.documents.live-document-index', compact('documents'))->extends('layouts.admin-panel')->section('content');
    }
}
