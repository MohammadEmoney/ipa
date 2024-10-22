<?php

namespace App\Livewire\Admin\Layouts;

use App\Models\Layout;
use App\Models\LayoutGroup;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use Livewire\WithPagination;

class LiveLayoutIndex extends Component
{
    use AlertLiveComponent, WithPagination;

    protected $listeners = [ 'destroy'];

    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;
    public $title;
    public $filter = [];
    public $layoutGroup;
    public $layout;

    public function mount(LayoutGroup $layoutGroup, $layout = null)
    {
        $this->layout = $layout;
        $this->title = __('global.layouts');
        $this->layoutGroup = $layoutGroup;
    }

    public function resetFilter()
    {
        $this->filter = [];
    }

    public function show($id)
    {
        return redirect()->to(route('admin.layouts.show', ['layoutGroup' => $this->layoutGroup->id, 'layout' => $id]));
    }

    public function create()
    {
        return redirect()->to(route('admin.layouts.create', ['layoutGroup' => $this->layoutGroup->id ]));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('layout_delete')){
            $layout = Layout::query()->find($id);

            if ($layout) {
                $layout->delete();
                $this->alert(__('messages.deleted_successfully'))->success();
            }
            else{
                $this->alert(__('messages.not_deleted', ['name' => __('global.layout')]))->error();
            }
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.layouts.edit', ['layoutGroup' => $this->layoutGroup->id, 'layout' => $id]));
    }

    public function changeActiveStatus($id)
    {
        $layout = Layout::find($id);
        if($layout){
            $layout->update(['is_active' => !$layout->is_active]);
            $this->alert(__('messages.updated_successfully'))->success();
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $layouts = Layout::query()->where('layout_group_id', $this->layoutGroup->id)->with(['layoutGroup']);
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $layouts = $layouts->where(function($query) use ($search){
                $query->where('title', "like", "%$search%")
                    ->orWhere('slug', "like", "%$search%");
                    // ->orWhere('description', "like", "%$search%")
                    // ->orWhere('summary', "like", "%$search%");
            });
        }
        if($this->layout)
            $layouts = $layouts->where('parent_id', $this->layout);
        $layouts = $layouts->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.admin.layouts.live-layout-index', compact('layouts'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}