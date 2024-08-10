<?php

namespace App\Livewire\Admin\Circulars;

use App\Models\Circular;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use Livewire\WithPagination;

class LiveCircularIndex extends Component
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
        $this->title = __('global.circulars');
    }

    public function resetFilter()
    {
        $this->filter = [];
    }

    public function download($id)
    {
        $circular = Circular::query()->find($id);
        if($circular->getFirstMedia('attachment'))
            return $circular->getFirstMedia('attachment');
        $this->alert(__('messages.file_not_exists'))->error();
    }

    public function create()
    {
        return redirect()->to(route('admin.circulars.create'));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('post_delete')){
            $circular = Circular::query()->find($id);

            if ($circular) {
                $circular->delete();
                $this->alert(__('messages.circular_deleted'))->success();
            }
            else{
                $this->alert(__('messages.circular_not_deleted'))->error();
            }
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.circulars.edit', ['circular' => $id]));
    }

    public function changeActiveStatus($id)
    {
        $circular = Circular::find($id);
        if($circular){
            $circular->update(['is_active' => !$circular->is_active]);
            $this->alert(__('messages.updated_successfully'))->success();
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $circulars = Circular::query()->with(['media']);
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $circulars = $circulars->where(function($query) use ($search){
                $query->where('title', "like", "%$search%")
                    ->orWhere('slug', "like", "%$search%");
                    // ->orWhere('description', "like", "%$search%")
                    // ->orWhere('summary', "like", "%$search%");
            });
        }
        $circulars = $circulars->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.admin.circulars.live-circular-index', compact('circulars'))->extends('layouts.admin-panel')->section('content');
    }
}
