<?php

namespace App\Livewire\Admin\GroupLayouts;

use Livewire\Component;

class LiveGroupLayoutEdit extends Component
{
    public function render()
    {
        return view('livewire.admin.group-layouts.live-group-layout-edit')
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
