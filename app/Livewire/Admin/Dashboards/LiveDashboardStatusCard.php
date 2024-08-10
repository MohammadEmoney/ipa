<?php

namespace App\Livewire\Admin\Dashboards;

use App\Enums\EnumOrderStatus;
use App\Models\Course;
use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class LiveDashboardStatusCard extends Component
{
    public $users;
    public $activeUsers;
    public $orders;
    public $posts;
    public $newOrder;
    public $newUser;
    public $newActiveUser;
    public $newPost;

    public function mount()
    {
        $today = Carbon::today();

        $orders = Order::query();
        $totalOrders = $orders->where('status' , EnumOrderStatus::COMPLETED)->sum('payable_amount');

        $users = User::query()->role('user');
        $newUsers = clone $users;

        $posts = Post::query();
        $newPosts = clone $posts;

        $this->newOrder = $orders->whereDate('created_at', '>=', $today)->count();
        $this->newUser = $newUsers->whereDate('created_at', '>=', $today)->count();
        $this->newActiveUser = $newUsers->permission('active_user')->whereDate('created_at', '>=', $today)->count();
        $this->newPost = $newPosts->whereDate('created_at', '>=', $today)->count();

        $this->users = $users->count();
        $this->activeUsers = $users->permission('active_user')->count();
        $this->orders = $totalOrders;
        $this->posts = $posts->count();
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
