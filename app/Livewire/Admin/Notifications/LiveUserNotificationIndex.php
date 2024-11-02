<?php

namespace App\Livewire\Admin\Notifications;

use App\Models\UserNotification;
use App\Traits\AlertLiveComponent;
use App\Traits\FilterTrait;
use Illuminate\Notifications\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class LiveUserNotificationIndex extends Component
{
    use AlertLiveComponent, FilterTrait, WithPagination;

    protected $listeners = ['destroy'];

    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;
    public $title;

    public function mount()
    {
        $this->title = __('global.notifications');
        // $this->alert(__('messages.under_development'))->warning()->redirect('admin.dashboard');
    }

    public function create()
    {
        return redirect()->to(route('admin.notifications.create'));
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.notifications.edit', ['notification' => $id]));
    }

    public function show($id)
    {
        return redirect()->to(route('admin.notifications.show', ['notification' => $id]));
    }

    public function editUser($id)
    {
        return redirect()->to(route('admin.users.edit', ['user' => $id]));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('notification_delete')){
            $notification = Notification::query()->find($id);

            if ($notification) {
                $notification->delete();
                $this->alert(__('messages.notification_deleted'))->success();
            }
            else{
                $this->alert(__('messages.notification_not_deleted'))->error();
            }
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $notifications = UserNotification::query()->with('user');
        if($this->search && mb_strlen($this->search) > 2){
            $notifications = $notifications->where(function($query){
                $query->where('title', "like", "%$this->search%")
                    ->orWhereHas('user',function($query) {
                        $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$this->search%"]);
                    });
            });
        }
        if($paymentMethod = data_get($this->filters, 'payment_method')){
            $notifications = $notifications->where(function($query) use($paymentMethod){
                $query->where('payment_method', $paymentMethod);
            });
        }
        if($paymentStatus = data_get($this->filters, 'status')){
            $notifications = $notifications->where(function($query) use($paymentStatus){
                $query->where('status', $paymentStatus);
            });
        }
        $notifications = $notifications->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.admin.notifications.live-user-notification-index', compact('notifications'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
