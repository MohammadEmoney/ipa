<?php

namespace App\Livewire\Admin\Dashboards;

use App\Enums\EnumOrderStatus;
use App\Models\Course;
use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class LiveDashboardStatusCard extends Component
{
    public $users;
    public $activeUsers;
    public $orders;
    public $posts;

    public function mount()
    {
        // dd(config('app.locale'));
        $this->users = User::count();
        $this->activeUsers = User::role('user')->permission('active_user')->count();
        $this->orders = Order::where('status' , EnumOrderStatus::COMPLETED)->sum('payable_amount');
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
