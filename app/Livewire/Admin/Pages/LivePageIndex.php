<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use Livewire\WithPagination;

class LivePageIndex extends Component
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
        $this->title = __('global.pages');
    }

    public function resetFilter()
    {
        $this->filter = [];
    }

    public function show($id)
    {
        // return redirect()->to(route('admin.pages.show', $id));
    }

    public function create()
    {
        return redirect()->to(route('admin.pages.create'));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('page_delete')){
            $page = Page::query()->find($id);

            if ($page) {
                $page->delete();
                $this->alert(__('messages.psot_deleted'))->success();
            }
            else{
                $this->alert(__('messages.psot_not_deleted'))->error();
            }
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.pages.edit', $id));
    }

    public function changeActiveStatus($id)
    {
        $page = Page::find($id);
        if($page){
            $page->update(['is_active' => !$page->is_active]);
            $this->alert(__('messages.updated_successfully'))->success();
        }
    }

    public function render()
    {
        $pages = Page::query()->with(['createdBy', 'updatedBy']);
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $pages = $pages->where(function($query) use ($search){
                $query->where('title', "like", "%$search%")
                    ->orWhere('slug', "like", "%$search%");
                    // ->orWhere('description', "like", "%$search%")
                    // ->orWhere('summary', "like", "%$search%");
            });
        }
        $pages = $pages->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);

        return view('livewire.admin.pages.live-page-index', compact('pages'))->extends('layouts.admin-panel')->section('content');
    }
}
