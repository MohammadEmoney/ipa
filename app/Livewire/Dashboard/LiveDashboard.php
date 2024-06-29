<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class LiveDashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard.live-dashboard')->extends('layouts.panel')->section('content');
    }
}
