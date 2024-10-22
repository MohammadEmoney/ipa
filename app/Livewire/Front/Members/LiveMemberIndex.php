<?php

namespace App\Livewire\Front\Members;

use App\Models\Member;
use Livewire\Component;

class LiveMemberIndex extends Component
{
    public $title;
    
    public function mount()
    {
        $this->title = __('global.team_members');
    }

    public function render()
    {
        $members = Member::query()->active()->latest()->get();
        return view('livewire.front.members.live-member-index', compact('members'))
            ->extends('layouts.front')->section('content');
    }
}
