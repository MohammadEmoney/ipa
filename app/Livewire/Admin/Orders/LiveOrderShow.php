<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\EnumOrderStatus;
use App\Models\Order;
use App\Traits\AlertLiveComponent;
use Livewire\Component;

class LiveOrderShow extends Component
{
    use AlertLiveComponent;
    
    public $title;
    public $order;
    public $user;
    public $status;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->title = __('global.show_order');
        $this->user = $order->user;
        $this->status = $order->status;
    }

    public function confirm()
    {
        $user = $this->order->user;
        if($user){
            $user->update(['is_active' => true]);
            $user->givePermissionTo(['active_user']);
            $this->status = $status = EnumOrderStatus::COMPLETED;
            $this->order->update(['status' => $status]);
            $this->alert(__('messages.order_confirm'))->success();
        }else{
            $this->alert(__('messages.order_confirm_error'))->error();
        }
    }

    public function disprove()
    {
        $user = $this->order->user;
        if($user){
            $user->update(['is_active' => false]);
            $user->revokePermissionTo(['active_user']);
            $this->status = $status = EnumOrderStatus::NOT_CONFIRM;
            $this->order->update(['status' => $status]);
            $this->alert(__('messages.order_disprove'))->success();
        }else{
            $this->alert(__('messages.order_disprove_error'))->error();
        }
    }

    public function updatedStatus()
    {
        $this->order->update(['status' => $this->status]);
        $this->alert(__('messages.order_status_updated'))->success();
    }

    public function editOrder()
    {
        return redirect()->to(route('admin.orders.edit', ['order' => $this->order->id]));
    }
    
    public function render()
    {
        $statuses = EnumOrderStatus::getTranslatedAll();
        return view('livewire.admin.orders.live-order-show', compact('statuses'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
