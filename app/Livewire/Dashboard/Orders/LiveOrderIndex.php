<?php

namespace App\Livewire\Dashboard\Orders;

use App\Enums\EnumPaymentMethods;
use App\Models\Order;
use App\Traits\AlertLiveComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LiveOrderIndex extends Component
{
    use AlertLiveComponent;

    protected $listeners = ['destroy'];

    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;
    public $title;
    public $filter = [];

    public function mount( )
    {
        $this->title = __('global.orders');
    }

    public function create()
    {
        // return redirect()->to(route('user.orders.create'));
    }

    public function edit($id)
    {
        // return redirect()->to(route('user.orders.edit', $id));
    }

    public function show($id)
    {
        // return redirect()->to(route('user.orders.show', $id));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('order_delete')){
            $order = Order::query()->find($id);

            if ($order) {
                $order->delete();
                $this->alert('سفارش حذف شد')->success();
            }
            else{
                $this->alert('سفارش حذف نشد')->error();
            }
        }else{
            $this->alert('شما اجازه دسترسی به این بخش را ندارید.')->error();
        }
    }

    public function resetFilter()
    {
        $this->filter = [];
    }
    
    public function render()
    {
        $paymentMethods = EnumPaymentMethods::getTranslatedAll();
        $orders = Order::query()->where('user_id', Auth::id())->with(['user']);
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $orders = $orders->where(function($query) use ($search){
                $query->where('track_number', "like", "%$search%");
            });
        }
        $orders = $orders->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.dashboard.orders.live-order-index', compact('orders', 'paymentMethods'))->extends('layouts.panel')->section('content');
    }
}
