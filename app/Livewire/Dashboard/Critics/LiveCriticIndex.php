<?php

namespace App\Livewire\Dashboard\Critics;

use App\Models\Critic;
use App\Traits\AlertLiveComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LiveCriticIndex extends Component
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
        $this->title = __('global.critics');
    }

    public function resetFilter()
    {
        $this->filter = [];
    }

    public function show($id)
    {
        return redirect()->to(route('user.critics.show', ['critic' => $id]));
    }

    public function create()
    {
        return redirect()->to(route('user.critics.create'));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('post_delete')){
            $critic = Critic::query()->find($id);

            if ($critic) {
                $critic->delete();
                $this->alert(__('messages.critic_deleted'))->success();
            }
            else{
                $this->alert(__('messages.critic_not_deleted'))->error();
            }
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function changeActiveStatus($id)
    {
        $critic = Critic::find($id);
        if($critic){
            $critic->update(['is_active' => !$critic->is_active]);
            $this->alert(__('messages.updated_successfully'))->success();
        }
    }

    public function render()
    {
        $critics = Critic::query()->whereBelongsTo(Auth::user());
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $critics = $critics->where(function($query) use ($search){
                $query->where('title', "like", "%$search%")
                    ->orWhere('slug', "like", "%$search%");
                    // ->orWhere('description', "like", "%$search%")
                    // ->orWhere('summary', "like", "%$search%");
            });
        }
        $critics = $critics->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.dashboard.critics.live-critic-index', compact('critics'))->extends('layouts.panel')->section('content');
    }
}
