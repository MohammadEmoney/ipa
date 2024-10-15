<?php

namespace App\Livewire\Auth;

use App\Enums\EnumEducationTypes;
use App\Enums\EnumInitialLevels;
use App\Enums\EnumMilitaryStatus;
use App\Enums\EnumOrderStatus;
use App\Enums\EnumPaymentMethods;
use App\Enums\EnumUserSituation;
use App\Mail\VerificationEmail;
use App\Models\Airline;
use App\Models\Course;
use App\Models\OtpCode;
use App\Models\User;
use App\Repositories\SettingsRepository;
use App\Rules\JDate;
use App\Rules\ValidNationalCode;
use App\Traits\AlertLiveComponent;
use App\Traits\DateTrait;
use App\Traits\JobsTrait;
use App\Traits\MediaTrait;
use App\Traits\NotificationTrait;
use App\Traits\OrderTrait;
use App\Traits\PaymentTrait;
use App\Traits\SmsTrait;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveRegister extends Component
{
    use AlertLiveComponent, WithFileUploads, DateTrait, MediaTrait, SmsTrait, PaymentTrait, OrderTrait, NotificationTrait;

    public $data = [];
    public $firstname;
    public $tempReceipt;
    public $user;
    public $currentTab = 'student';
    public $step;
    public $otpCode;
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
        $setting = app(SettingsRepository::class)->getByKey('payment_via');
        $this->data['payment_method'] = $setting[0] ?? "";
        $this->step = 'info';
        // $this->step = 'payment';
        // $this->user = User::find(14);
        $this->payableAmount = $this->orderAmount = $settings['membership_fee'] ?? 0;
        $this->title = __('global.register');
    }

    public function setCuurentTab($value)
    {
        $this->currentTab = $value;
    }

    public function render()
    {
        $situations = EnumUserSituation::getTranslatedAll();
        $airlines = Airline::active()->get();
        return view('livewire.auth.live-register', compact('situations', 'airlines'))->extends('layouts.front')->section('content');
    }

    public function validations()
    {
        $this->validate([
            'data.first_name' => 'required|string|uni_regex:^[\x{0621}-\x{0628}\x{062A}-\x{063A}\x{0641}-\x{0642}\x{0644}-\x{0648}\x{064E}-\x{0651}\x{0655}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06BE}\x{06CC} ]+$|max:255',
            'data.last_name' => 'required|string|uni_regex:^[\x{0621}-\x{0628}\x{062A}-\x{063A}\x{0641}-\x{0642}\x{0644}-\x{0648}\x{064E}-\x{0651}\x{0655}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06BE}\x{06CC} ]+$|max:255',
            'data.phone' => 'required|regex:/^09[0-9]{9}$/|unique:users,phone',
            // 'data.email' => 'required|email|unique:users,email',
            // 'data.password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
            // 'data.situation' => 'required|in:' . EnumUserSituation::asStringValues(),
            // 'data.university' => 'required_if:situation,' . EnumUserSituation::STUDENT,
            // 'data.airline_id' => ['required_if:situation,' . EnumUserSituation::EMPLOYED, 'exists:airlines,id'],
        ], [
            'data.first_name.uni_regex' => 'لطفا از حروف فارسی برای نام خود استفاده نمایید.',
            'data.last_name.uni_regex' => 'لطفا از حروف فارسی برای نام خانوادگی خود استفاده نمایید.',
            'data.phone.unique' => 'شماره همراه قبلا ثبت شده است. در صورتی که قبلا با این شماره ثبت نام انجام داده اید از طریق صفحه ورود اقدام به ورود نمایید.',
        ], [
            'data.first_name' => __('global.first_name'),
            'data.last_name' => __('global.last_name'),
            'data.email' =>  __('global.email'),
            'data.phone' => __('global.phone_number'),
            'data.password' => __('global.password'),
            'data.situation' => __('global.job_status'),
            'data.university' => __('global.university_name'),
            'data.airline_id' => __('global.company_name'),
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
        $this->dispatch('autoFocus');
        $this->validations();

        DB::beginTransaction();

        $this->user = $user = User::create([
            'first_name' => $this->data['first_name'] ?? null,
            'last_name' => $this->data['last_name'] ?? null,
            'phone' => $this->data['phone'] ?? null,
            // 'email' => $this->data['email'] ?? null,
            // 'password' => Hash::make($this->data['password']),
        ]);

        // $airline = Airline::find($this->data['airline_id'] ?? null);

        $user->userInfo()->create([
            'phone_1' => $this->data['phone'] ?? null,
            // 'situation' => $this->data['situation'] ?? null,
            // 'university' => $this->data['university'] ?? null,
            // 'company_name' => $airline->title ?? null,
            // 'airline_id' => $airline->id ?? null,
        ]);

        $user->assignRole('user');
        DB::commit();
        $this->sendCode($user);
        // auth()->loginUsingId($user->id);
        // $this->alert(__('messages.register_completed'))->success();
    }

    public function sendCode(User $user)
    {
        // Send Otp Sms
        try {
            $this->step = 'confirm';
            $this->dispatch('autoFocus');
            $code = $user->otp_code = rand(1111, 9999);
            $this->otpCode = OtpCode::create(['code' => $code, 'expire_time' => Carbon::now()->addMinutes(3)]);
            $user->save();

            $response = $this->sendVerificationCode($user->phone, $user->first_name, $user->otp_code);
            // Log::info(json_encode([$response]));

            // Mail::to($user->email)->send(new VerificationEmail($user->otp_code));

            $this->alert(__('messages.sent_code_to_phone'))->success();
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

        if ($this->otpCode?->code == $this->otp_code) {
            $this->otpCode?->delete();
            $this->user->update(['otp_code' => null, 'phone_verified_at' => now()]);
            $this->step = 'payment';
            $this->alert(__('messages.phone_confirmed'))->success();
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
            if($this->data['payment_method'] ?? null){
                if($this->data['payment_method'] === 'credit_card'){
                    DB::beginTransaction();
                    $order = $this->createOrder($this->user, EnumPaymentMethods::CREDIT_CARD, null, EnumOrderStatus::PENDING_CONFIRM);
                    $this->createImage($order, 'bankReceipt');
                    $this->adminNewOrderNotifications($order);
                    DB::commit();
                    $this->alert(__('messages.bank_receipt_upload_success'))->success()->redirect('home');
                }elseif($this->data['payment_method'] === 'online'){
                    auth()->loginUsingId($this->user->id);
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
}
