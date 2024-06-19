<?php

namespace App\Livewire\Auth;

use App\Enums\EnumEducationTypes;
use App\Enums\EnumInitialLevels;
use App\Enums\EnumMilitaryStatus;
use App\Models\Course;
use App\Models\User;
use App\Rules\JDate;
use App\Rules\ValidNationalCode;
use App\Traits\AlertLiveComponent;
use App\Traits\DateTrait;
use App\Traits\JobsTrait;
use App\Traits\SmsTrait;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveRegister extends Component
{
    use AlertLiveComponent, WithFileUploads, DateTrait, JobsTrait, SmsTrait;

    public $data = [];
    public $firstname;
    public $user;
    public $currentTab = 'student';
    public $step;
    public $otp_code;
    public $title;
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
        $this->step = 'register';
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
        // $this->sendCode($user);
        auth()->loginUsingId($user->id);
        $this->alert(__('messages.register_completed'))->success();
        DB::commit();
        return redirect()->to(route('home'));
    }

    public function sendCode(User $user)
    {
        // Send Otp Sms
        try {
            $this->step = 'verify';
            $user->otp_code = rand(1111, 9999);
            $user->save();

            $response = $this->sendVerificationCode($user->phone, $user->first_name, $user->otp_code);
            Log::info(json_encode([$response]));

            $this->alert('جهت تکمیل ثبتنام و تایید شماره موبایل شما، کد چهار رقمی به شماره موبایل شما ارسال شد')->success();
        } catch (\Exception $e) {
            Log::info(json_encode([$e->getMessage()]));
            $this->alert('در ارسال کد مشکلی پیش آمده است.')->error();
            // $this->step = 'register';
        }
    }

    public function verification()
    {
        $this->validate([
            'otp_code' => 'required|numeric'
        ], [], [
            'otp_code' => 'کد'
        ]);

        $redirect = 'profile.edit';

        if ($this->user->otp_code == $this->otp_code) {
            $this->user->update(['otp_code' => null, 'phone_verified_at' => now()]);
            auth()->loginUsingId($this->user->id);
            $this->alert('ثبت نام با موفقیت انجام شد.')->success();
            return redirect()->to(route($redirect));
        }
        $this->alert('کد وارد شده صحیح نمی باشد.')->error();
    }
}
