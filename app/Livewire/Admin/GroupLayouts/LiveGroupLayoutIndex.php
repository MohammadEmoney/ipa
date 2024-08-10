<?php

namespace App\Livewire\Admin\GroupLayouts;

use App\Models\LayoutGroup;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use Livewire\WithPagination;

class LiveGroupLayoutIndex extends Component
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
        $this->title = __('global.group_layouts');
    }

    public function resetFilter()
    {
        $this->filter = [];
    }

    public function show($id)
    {
        return redirect()->to(route('admin.layouts.index', ['layoutGroup' => $id]));
    }

    public function create()
    {
        return redirect()->to(route('admin.group-layouts.create'));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('group_layout_delete')){
            $layoutGroup = LayoutGroup::query()->find($id);

            if ($layoutGroup) {
                $layoutGroup->delete();
                $this->alert(__('messages.deleted_successfully'))->success();
            }
            else{
                $this->alert(__('messages.not_deleted', ['name' => __('global.group_layout')]))->error();
            }
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.group-layouts.edit', ['layoutGroup' => $id]));
    }

    public function changeActiveStatus($id)
    {
        $layoutGroup = LayoutGroup::find($id);
        if($layoutGroup){
            $layoutGroup->update(['is_active' => !$layoutGroup->is_active]);
            $this->alert(__('messages.updated_successfully'))->success();
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $layoutGroups = LayoutGroup::query()->with(['layouts']);
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $layoutGroups = $layoutGroups->where(function($query) use ($search){
                $query->where('title', "like", "%$search%")
                    ->orWhere('slug', "like", "%$search%");
                    // ->orWhere('description', "like", "%$search%")
                    // ->orWhere('summary', "like", "%$search%");
            });
        }
        $layoutGroups = $layoutGroups->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.admin.group-layouts.live-group-layout-index', compact('layoutGroups'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
