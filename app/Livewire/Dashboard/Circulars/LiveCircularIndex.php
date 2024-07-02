<?php

namespace App\Livewire\Dashboard\Circulars;

use App\Models\Circular;
use App\Traits\AlertLiveComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LiveCircularIndex extends Component
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
        $this->title = __('global.circulars');
    }

    public function resetFilter()
    {
        $this->filter = [];
    }

    public function download($id)
    {
        if(Auth::user()->can('active_user')){
            $circular = Circular::query()->find($id);
            if($circular->getFirstMedia('attachment'))
                return $circular->getFirstMedia('attachment');
            $this->alert(__('messages.file_not_exists'))->error();
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function show($id)
    {
        return redirect()->to(route('user.circulars.show', $id));
    }

    public function render()
    {
        $circulars = Circular::query()->lang()->with(['media']);
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
        return view('livewire.dashboard.circulars.live-circular-index', compact('circulars'))->extends('layouts.panel')->section('content');
    }
}
