<?php

namespace App\Livewire\Dashboard;

use App\Enums\EnumOrderStatus;
use App\Enums\EnumPaymentMethods;
use App\Models\Circular;
use App\Models\Document;
use App\Repositories\SettingsRepository;
use App\Traits\AlertLiveComponent;
use App\Traits\OrderTrait;
use App\Traits\PaymentTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LiveDashboard extends Component
{
    use AlertLiveComponent, PaymentTrait, OrderTrait;

    public $user;
    public $data = [];

    public function mount()
    {
        $user = $this->user = Auth::user();
        $setting = app(SettingsRepository::class)->getByKey('payment_via');
        $this->data['payment_method'] = $setting[0] ?? "";
        if(!$user->hasPermissionTo('active_user'))
            $this->alert(__('messages.not_active_error_message'))->error();
    }

    public function pay()
    {
        try {
            $setting = new SettingsRepository();
            if($this->data['payment_method'] ?? null){
                if($this->data['payment_method'] === 'credit_card'){
                    DB::beginTransaction();
                    $order = $this->createOrder($this->user, EnumPaymentMethods::CREDIT_CARD, null, EnumOrderStatus::PENDING_CONFIRM);
                    $this->createImage($order, 'bankReceipt');
                    $this->adminNewOrderNotifications($order);
                    DB::commit();
                    $this->alert(__('messages.bank_receipt_upload_success'))->success()->redirect('home');
                }elseif($this->data['payment_method'] === 'online'){
                    return redirect()->to(route('payment.create'));
                }else{
                    $this->alert(__('messages.register_error'))->error();
                }
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            $this->alert(__('messages.register_error'))->error();
        }
    }

    public function render()
    {
        $circulars = Circular::latest()->active()->lang()->take(4)->get();
        $documents = Document::latest()->active()->lang()->take(4)->get();
        return view('livewire.dashboard.live-dashboard', compact('circulars', 'documents'))->extends('layouts.panel')->section('content');
    }
}
