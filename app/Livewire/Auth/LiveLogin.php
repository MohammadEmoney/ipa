<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Rules\ValidNationalCode;
use App\Traits\AlertLiveComponent;
use App\Traits\SmsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LiveLogin extends Component
{
    use AlertLiveComponent;
    use SmsTrait;

    public $step = 'send_code';
    public $national_code;
    public $user;
    public $email;
    public $password;
    public $otp_code;
    public $title;
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

    public function sendCode()
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


        $this->user = $user = User::where('national_code', $this->national_code)->first();
        if($user){
            // Send Otp Sms
            $user->otp_code = rand(1111, 9999);

            $user->save();

            $response = $this->sendVerificationCode($user->phone, $user->first_name, $user->otp_code);
            Log::info(json_encode([$response]));

            $this->alert('جهت ورود کد چهار رقمی به شماره موبایل شما ارسال شد')->success();

            $this->step = 'verify';
            $this->disableSend = false;
        }else{
            $this->alert('کاربر پیدا نشد.')->error();
        }
    }

    public function verification()
    {
        $this->validate([
            'otp_code' => 'required|numeric'
        ],[],[
            'otp_code' => 'کد'
        ]);

        $redirect = $this->user?->userInfo?->type === 'student' ? 'profile.courses.select' : 'profile.edit';

        if($this->user->otp_code == $this->otp_code){
            $this->user->update(['otp_code' => null, 'phone_verified_at' => now()]);
            auth()->loginUsingId($this->user->id);
            $this->alert('ورود با موفقیت انجام شد.')->success();
            return redirect()->to(route($redirect));
        }
        $this->alert('کد وارد شده صحیح نمی باشد.')->error();
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
            return redirect()->intended('/');
        }
    }
}
