<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\EnumOrderStatus;
use App\Enums\EnumPaymentMethods;
use App\Models\Order;
use App\Traits\AlertLiveComponent;
use App\Traits\FilterTrait;
use Livewire\Component;
use Livewire\WithPagination;

class LiveOrderIndex extends Component
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
        $this->title = __('global.orders');
    }

    public function create()
    {
        return redirect()->to(route('admin.orders.create'));
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.orders.edit', ['order' => $id]));
    }

    public function show($id)
    {
        return redirect()->to(route('admin.orders.show', ['order' => $id]));
    }

    public function editUser($id)
    {
        return redirect()->to(route('admin.users.edit', ['user' => $id]));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('order_delete')){
            $order = Order::query()->find($id);

            if ($order) {
                $order->delete();
                $this->alert(__('messages.order_deleted'))->success();
            }
            else{
                $this->alert(__('messages.order_not_deleted'))->error();
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
        $orders = Order::query();
        if($this->search && mb_strlen($this->search) > 2){
            $orders = $orders->where(function($query){
                $query->where('track_number', "like", "%$this->search%")
                    ->orWhereHas('user',function($query) {
                        $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$this->search%"]);
                    });
            });
        }
        if($paymentMethod = data_get($this->filters, 'payment_method')){
            $orders = $orders->where(function($query) use($paymentMethod){
                $query->where('payment_method', $paymentMethod);
            });
        }
        if($paymentStatus = data_get($this->filters, 'status')){
            $orders = $orders->where(function($query) use($paymentStatus){
                $query->where('status', $paymentStatus);
            });
        }
        $orders = $orders->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        $paymentMethods = EnumPaymentMethods::getTranslatedAll();
        $statuses = EnumOrderStatus::getTranslatedAll();
        return view('livewire.admin.orders.live-order-index', compact('orders', 'paymentMethods', 'statuses'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
