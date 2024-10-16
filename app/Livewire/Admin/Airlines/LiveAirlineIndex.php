<?php

namespace App\Livewire\Admin\Airlines;

use App\Models\Airline;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use Livewire\WithPagination;

class LiveAirlineIndex extends Component
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
        $this->title = __('global.airlines');
    }

    public function resetFilter()
    {
        $this->filter = [];
    }

    public function download($id)
    {
        $airline = Airline::query()->find($id);
        if($airline->getFirstMedia('attachment'))
            return $airline->getFirstMedia('attachment');
        $this->alert(__('messages.file_not_exists'))->error();
    }

    public function create()
    {
        return redirect()->to(route('admin.airlines.create'));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('post_delete')){
            $airline = Airline::query()->find($id);

            if ($airline) {
                $airline->delete();
                $this->alert(__('messages.airline_deleted'))->success();
            }
            else{
                $this->alert(__('messages.airline_not_deleted'))->error();
            }
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.airlines.edit', ['airline' => $id]));
    }

    public function changeActiveStatus($id)
    {
        $airline = Airline::find($id);
        if($airline){
            $airline->update(['is_active' => !$airline->is_active]);
            $this->alert(__('messages.updated_successfully'))->success();
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $airlines = Airline::query();
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $airlines = $airlines->where(function($query) use ($search){
                $query->where('title', "like", "%$search%")
                    ->orWhere('title_en', "like", "%$search%");
                    // ->orWhere('description', "like", "%$search%")
                    // ->orWhere('summary', "like", "%$search%");
            });
        }
        $airlines = $airlines->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.admin.airlines.live-airline-index', compact('airlines'))->extends('layouts.admin-panel')->section('content');
    }
}
