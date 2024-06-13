<?php

namespace App\Livewire\Admin\Dashboards;

use App\Models\Course;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class LiveDashboardStatusCard extends Component
{
    public $users;
    public $staff;
    public $orders;
    public $posts;

    public function mount()
    {
        // dd(config('app.locale'));
        $this->users = User::count();
        $this->staff = 0;
        $this->orders = 0;
        $this->posts = Post::count();
    }

    public function redirectTo($route)
    {
        return redirect()->to(route($route));
    }

    public function render()
    {
        return view('livewire.admin.dashboards.live-dashboard-status-card');
    }
}
