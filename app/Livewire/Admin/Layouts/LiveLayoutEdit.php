<?php

namespace App\Livewire\Admin\Layouts;

use Livewire\Component;

class LiveLayoutEdit extends Component
{
    public function render()
    {
        return view('livewire.admin.layouts.live-layout-edit')
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
