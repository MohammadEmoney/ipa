<?php

namespace App\Livewire\Dashboard;

use App\Models\Circular;
use App\Models\Document;
use Livewire\Component;

class LiveDashboard extends Component
{
    public function render()
    {
        $circulars = Circular::latest()->active()->lang()->take(4)->get();
        $documents = Document::latest()->active()->lang()->take(4)->get();
        return view('livewire.dashboard.live-dashboard', compact('circulars', 'documents'))->extends('layouts.panel')->section('content');
    }
}
