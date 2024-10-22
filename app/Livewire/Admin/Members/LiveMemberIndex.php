<?php

namespace App\Livewire\Admin\Members;

use App\Filters\FilterManager;
use App\Models\Member;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use Livewire\WithPagination;

class LiveMemberIndex extends Component
{
    use AlertLiveComponent, WithPagination;

    protected $listeners = [ 'destroy'];

    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;
    public $title;

    public $filters = [
        'name' => null,
        'phone' => null,
        'email' => null,
        'active' => null,
    ];

    public function mount()
    {
        $this->title = __('global.members');
    }

    public function show($id)
    {
        return redirect()->to(route('admin.members.show', ['member' => $id]));
    }

    public function create()
    {
        return redirect()->to(route('admin.members.create'));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('member_delete')){
            $member = Member::query()->find($id);

            if ($member) {
                $member->delete();
                $this->alert(__('messages.member_deleted'))->success();
            }
            else{
                $this->alert(__('messages.member_not_deleted'))->error();
            }
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.members.edit', ['member' => $id]));
    }

    public function changeActiveStatus($id)
    {
        $member = Member::find($id);
        if($member){
            $member->update(['is_active' => !$member->is_active]);
            $this->alert(__('messages.updated_successfully'))->success();
        }
    }

    public function resetFilter()
    {
        $this->filters = [];
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $members = (new FilterManager(new Member))->apply($this->filters);
        // $members = Member::query()->with(['memberInfo']);
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $members = $members->where(function($query) use ($search){
                $query->where('first_name', "like", "%$search%")
                    ->orWhere('last_name', "like", "%$search%")
                    ->orWhere('email', "like", "%$search%")
                    ->orWhere('phone', "like", "%$search%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$search%"]);
            });
        }
        $members = $members->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.admin.members.live-member-index', compact('members'))->extends('layouts.admin-panel')->section('content');
    }
}
