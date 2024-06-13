<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use App\Traits\AlertLiveComponent;
use Livewire\Component;

class LiveOrderIndex extends Component
{
    use AlertLiveComponent;

    protected $listeners = ['destroy'];

    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;

    public function create()
    {
        return redirect()->to(route('admin.orders.create'));
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.orders.edit', $id));
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

    public function render()
    {
        $orders = Order::query();
        if($this->search && mb_strlen($this->search) > 2){
            $orders = $orders->where(function($query){
                $query->where('title', "like", "%$this->search%");
            });
        }
        $orders = $orders->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.admin.orders.live-order-index', compact('orders'))->extends('layouts.admin-panel')->section('content');
    }
}
