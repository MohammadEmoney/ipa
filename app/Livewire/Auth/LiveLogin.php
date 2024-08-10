<?php

namespace App\Livewire\Auth;

use App\Enums\EnumOrderStatus;
use App\Enums\EnumPaymentMethods;
use App\Mail\VerificationEmail;
use App\Models\User;
use App\Repositories\SettingsRepository;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use App\Traits\NotificationTrait;
use App\Traits\OrderTrait;
use App\Traits\PaymentTrait;
use App\Traits\SmsTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveLogin extends Component
{
    use AlertLiveComponent;
    use SmsTrait;
    use WithFileUploads;
    use MediaTrait;
    use PaymentTrait;
    use OrderTrait;
    use NotificationTrait;

    public $data = [];
    public $step = 'info';
    public $national_code;
    public $user;
    public $email;
    public $password;
    public $otp_code;
    public $title;
    public $payableAmount;
    public $orderAmount;
    public $disableSend = true;
    public $disableVerify = true;

    public function mount()
    {
        if (auth()->check()){
            if(auth()->user()->hasRole('super-admin'))
                return redirect()->to(route('admin.dashboard'));
            return redirect()->to(route('home'));
        }
        $this->title = __('global.login');
        $this->payableAmount = $this->orderAmount = $settings['membership_fee'] ?? 0;
    }

    public function render()
    {
        return view('livewire.auth.live-login')->extends('layouts.front')->section('content');
    }

    public function updated($method)
    {
        if($method == "otp_code"){
            $this->disableVerify = true;
            $this->validate([
                'otp_code' => 'required|numeric|digits_between:4,4'
            ],[
                'otp_code.digits_between' => 'تعداد ارقام باید 4 رقم باشد.'
            ],[
                'otp_code' => 'کد'
            ]);
            $this->disableVerify = false;
        }
    }

    // public function sendCode()
    // {
    //     $this->validate([
    //         'email' => ['required', 'email' , 'exists:users,email'],
    //         'password' => 'required'
    //     ],[
    //         // 'exists: :national_code '
    //     ],[
    //         'email' => __('global.email'),
    //         'password' => __('global.password'),
    //     ]);


    //     $this->user = $user = User::where('national_code', $this->national_code)->first();
    //     if($user){
    //         // Send Otp Sms
    //         $user->otp_code = rand(1111, 9999);

    //         $user->save();

    //         $response = $this->sendVerificationCode($user->phone, $user->first_name, $user->otp_code);
    //         Log::info(json_encode([$response]));

    //         $this->alert('جهت ورود کد چهار رقمی به شماره موبایل شما ارسال شد')->success();

    //         $this->step = 'verify';
    //         $this->disableSend = false;
    //     }else{
    //         $this->alert('کاربر پیدا نشد.')->error();
    //     }
    // }

    // public function verification()
    // {
    //     $this->validate([
    //         'otp_code' => 'required|numeric'
    //     ],[],[
    //         'otp_code' => 'کد'
    //     ]);

    //     $redirect = $this->user?->userInfo?->type === 'student' ? 'profile.courses.select' : 'profile.edit';

    //     if($this->user->otp_code == $this->otp_code){
    //         $this->user->update(['otp_code' => null, 'phone_verified_at' => now()]);
    //         auth()->loginUsingId($this->user->id);
    //         $this->alert('ورود با موفقیت انجام شد.')->success();
    //         return redirect()->to(route($redirect));
    //     }
    //     $this->alert('کد وارد شده صحیح نمی باشد.')->error();
    // }

    public function sendCode(User $user)
    {
        // Send Otp Sms
        try {
            $this->step = 'confirm';
            $this->dispatch('autoFocus');
            $user->otp_code = rand(1111, 9999);
            $user->save();

            // $response = $this->sendVerificationCode($user->phone, $user->first_name, $user->otp_code);
            // Log::info(json_encode([$response]));

            Mail::to($user->email)->send(new VerificationEmail($user->otp_code));

            $this->alert(__('messages.sent_code'))->success();
        } catch (\Exception $e) {
            Log::info(json_encode([$e->getMessage()]));
            $this->alert(__('messages.sent_code_problem'))->error();
            // $this->step = 'register';
        }
    }

    public function verification()
    {
        // $this->alert(__('messages.incorrect_code'))->error();
        $this->validate([
            'otp_code' => 'required|numeric'
        ], [], [
            'otp_code' => __('global.otp_code')
        ]);

        if ($this->user->otp_code == $this->otp_code) {
            $this->user->update(['otp_code' => null, 'email_verified_at' => now()]);
            $this->step = 'upload';
            $this->alert(__('messages.email_confirmed'))->success();
        }else{
            $this->alert(__('messages.incorrect_code'))->error();
        }
    }

    public function submitUpload()
    {
        if(!isset($this->data['nationalCard']) ){
            return $this->addError('data.nationalCard', __('messages.national_card_required'));
        }
        if(!isset($this->data['license']) ){
            return $this->addError('data.license', __('messages.license_required'));
        }

        $this->createImage($this->user, 'nationalCard');
        $this->createImage($this->user, 'license');

        $this->alert(__('messages.image_uploaded'))->success();
        $this->step = 'payment';
    }

    public function pay()
    {
        try {
            $setting = new SettingsRepository();
            if($setting->getByKey('payment_via') === 'credit_card'){
                DB::beginTransaction();
                $order = $this->createOrder($this->user, EnumPaymentMethods::CREDIT_CARD, null, EnumOrderStatus::PENDING_CONFIRM);
                $this->createImage($order, 'bankReceipt');
                $this->adminNewOrderNotifications($order);
                DB::commit();
                $this->alert(__('messages.bank_receipt_upload_success'))->success()->redirect('home');
            }elseif($setting->getByKey('payment_via') === 'online'){
                auth()->loginUsingId($this->user->id);
                return redirect()->to(route('payment.create'));
            }else{
                $this->alert(__('messages.register_error'))->error();
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            $this->alert(__('messages.register_error'))->error();
        }
    }

    public function setStep($step)
    {
        $this->step = $step;
    }

    public function login()
    {
        $this->validate([
            'email' => ['required', 'email' , 'exists:users,email'],
            'password' => 'required'
        ],[
            // 'exists: :national_code '
        ],[
            'email' => __('global.email'),
            'password' => __('global.password'),
        ]);
 
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = $this->user = Auth::user();
            if(!$user->email_verified_at)
                $this->sendCode($user);
            elseif(!$user->getFirstMediaUrl('nationalCard') && !$user->getFirstMediaUrl('license'))
                $this->setStep('upload');
            elseif(!$user->is_active)
                $this->setStep('payment');
            else
                return redirect()->intended('/fa/dashboard');
        }else{
            $this->alert(__('messages.login_failed'))->error();
        }
    }
}
