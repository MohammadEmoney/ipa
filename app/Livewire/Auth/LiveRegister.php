<?php

namespace App\Livewire\Auth;

use App\Enums\EnumEducationTypes;
use App\Enums\EnumInitialLevels;
use App\Enums\EnumMilitaryStatus;
use App\Mail\VerificationEmail;
use App\Models\Course;
use App\Models\User;
use App\Rules\JDate;
use App\Rules\ValidNationalCode;
use App\Traits\AlertLiveComponent;
use App\Traits\DateTrait;
use App\Traits\JobsTrait;
use App\Traits\MediaTrait;
use App\Traits\PaymentTrait;
use App\Traits\SmsTrait;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveRegister extends Component
{
    use AlertLiveComponent, WithFileUploads, DateTrait, MediaTrait, SmsTrait, PaymentTrait;

    public $data = [];
    public $firstname;
    public $user;
    public $currentTab = 'student';
    public $step;
    public $otp_code;
    public $title;
    public $orderAmount;
    public $payableAmount;
    public $tax;
    public $disabledCreate = true;
    public $disabledEdit = true;
    public $disableVerify = true;

    public function mount()
    {
        if (auth()->check()){
            if(auth()->user()->hasRole('super-admin'))
                return redirect()->to(route('admin.dashboard'));
            return redirect()->to(route('home'));
        }
        $this->step = 'info';
        // $this->step = 'payment';
        // $this->user = User::find(9);
        $this->payableAmount = $this->orderAmount = $settings['membership_fee'] ?? 0;
        $this->title = __('global.register');
    }

    public function setCuurentTab($value)
    {
        $this->currentTab = $value;
    }

    public function render()
    {
        return view('livewire.auth.live-register')->extends('layouts.front')->section('content');
    }

    public function validations()
    {
        $this->validate([
            'data.first_name' => 'required|string|max:255',
            'data.last_name' => 'required|string|max:255',
            'data.phone' => 'required|regex:/^09[0-9]{9}$/|unique:users,phone',
            'data.email' => 'required|email|unique:users,email',
            'data.password' => 'required|min:8|confirmed',
        ], [], [
            'data.first_name' => __('global.first_name'),
            'data.last_name' => __('global.last_name'),
            'data.email' =>  __('global.email'),
            'data.phone' => __('global.phone_number'),
            'data.password' => __('global.password'),
        ]);
    }

    public function updated($method)
    {
        if ($method == "otp_code") {
            $this->disableVerify = true;
            $this->validate([
                'otp_code' => 'required|numeric|digits_between:4,4'
            ], [
                'otp_code.digits_between' => 'تعداد ارقام باید 4 رقم باشد.'
            ], [
                'otp_code' => 'کد'
            ]);
            $this->disableVerify = false;
        }
    }

    public function submit()
    {
        $this->validations();

        DB::beginTransaction();

        $this->user = $user = User::create([
            'first_name' => $this->data['first_name'] ?? null,
            'last_name' => $this->data['last_name'] ?? null,
            'email' => $this->data['email'] ?? null,
            'phone' => $this->data['phone'] ?? null,
            'password' => Hash::make($this->data['password']),
        ]);

        $user->userInfo()->create([
            'phone_1' => $this->data['phone'] ?? null,
        ]);

        $user->assignRole('user');
        $this->sendCode($user);
        // auth()->loginUsingId($user->id);
        // $this->alert(__('messages.register_completed'))->success();
        DB::commit();
    }

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
        auth()->loginUsingId($this->user->id);
        return redirect()->to(route('payment.create'));
    }
}
