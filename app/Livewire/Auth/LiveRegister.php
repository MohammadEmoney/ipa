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
    public $disabledCreate = true;
    public $disabledEdit = true;
    public $disableVerify = true;

    public function mount()
    {
        $this->step = 'register';
    }

    public function setCuurentTab($value)
    {
        $this->currentTab = $value;
    }

    public function render()
    {
        $educations = EnumEducationTypes::getTranslatedAll();
        $courses = Course::active()->get();
        $initialLevels = EnumInitialLevels::getTranslatedAll();
        $militaryStatuses = EnumMilitaryStatus::getTranslatedAll();
        return view('livewire.auth.live-register', compact('educations', 'courses', 'initialLevels', 'militaryStatuses'));
    }

    public function validations()
    {
        $this->validate([
            'data.first_name' => 'required|string|max:255',
            'data.last_name' => 'required|string|max:255',
            'data.national_code' => ['required', 'string', 'max:255', new ValidNationalCode(), 'unique:users,national_code,' . $this->user?->id],
            'data.mobile_1' => 'required|regex:/^09[0-9]{9}$/|unique:users,phone',
        ], [], [
            'data.first_name' => 'نام',
            'data.last_name' => 'نام خانوادگی',
            'data.national_code' => 'کد ملی',
            'data.mobile_1' => 'شماره موبایل',
        ]);
    }

    public function studentValidationOld()
    {
        $this->validate([
            'data.first_name' => 'required|string|max:255',
            'data.last_name' => 'required|string|max:255',
            'data.father_name' => 'required|string|max:255',
            'data.birth_date' => ['required', 'max:255', new JDate()],
            'data.national_code' => ['required', 'string', 'max:255', new ValidNationalCode(), 'unique:users,national_code,' . $this->user?->id],
            'data.landline_phone' => 'nullable|regex:/^0[0-9]{10}$/',
            'data.mobile_1' => 'required|regex:/^09[0-9]{9}$/|unique:users,phone',
            'data.mobile_2' => 'required|regex:/^09[0-9]{9}$/',
            'data.address' => 'required|string|max:2550',
            'data.job' => 'nullable|string|max:255',
            'data.education' => 'nullable|string|max:255',
            'data.preferd_course' => 'required|string|max:255',
            'data.initial_level' => 'required|string|max:255',
            'data.register_date' => ['required', 'max:255', new JDate()],
            'data.email' => 'nullable|email|max:255|unique:users,email',
            'data.personal_image' => 'required|image|max:2048',
            'data.national_card_image' => 'required|image|max:2048',
            'data.refferal_name' => 'nullable|string|max:255',
            'data.refferal_national_code' => ['nullable', 'string', 'max:255', new ValidNationalCode()],
            'data.refferal_phone' => 'nullable|string|max:255',
        ], [], [
            'data.first_name' => 'نام',
            'data.last_name' => 'نام خانوادگی',
            'data.email' => 'پست الکترونیکی',
            'data.father_name' => 'نام پدر',
            'data.birth_date' => 'تاریخ تولد',
            'data.national_code' => 'کد ملی',
            'data.landline_phone' => 'شماره تلفن',
            'data.mobile_1' => 'شماره موبایل 1',
            'data.mobile_2' => 'شماره موبایل 2',
            'data.address' => 'آدرس منزل',
            'data.job' => 'شغل',
            'data.education' => 'تحصیلات',
            'data.preferd_course' => 'دوره مورد نیاز',
            'data.initial_level' => 'تعیین سطح اولیه',
            'data.register_date' => 'تاریخ عضو یت',
            'data.national_card_image' => 'تصویر کارت ملی',
            'data.personal_image' => 'تصویر عکس پرسنلی',
            'data.refferal_name' => 'نام معرف',
            'data.refferal_national_code' => 'شماره ملی معرف',
            'data.refferal_phone' => 'شماره تماس معرف',
        ]);
    }

    public function staffValidationOld()
    {
        $this->validate([
            'data.first_name' => 'required|string|max:255',
            'data.last_name' => 'required|string|max:255',
            'data.father_name' => 'required|string|max:255',
            'data.birth_date' => ['required', 'string', 'max:255', new JDate()],
            'data.national_code' => ['required', 'string', 'max:255', new ValidNationalCode(), 'unique:users,national_code,' . $this->user?->id],
            'data.landline_phone' => 'nullable|regex:/^0[0-9]{10}$/',
            'data.mobile_1' => 'required|regex:/^09[0-9]{9}$/|unique:users,phone',
            'data.mobile_2' => 'required|regex:/^09[0-9]{9}$/',
            'data.address' => 'required|string|max:2550',
            'data.job' => 'nullable|string|max:255',
            'data.education' => 'nullable|string|max:255',
            'data.email' => 'nullable|email|max:255|unique:users,email',
            'data.personal_image' => 'required|image|max:2048',
            'data.national_card_image' => 'required|image|max:2048',
            'data.mariage_status' => 'required|boolean|max:255',
            'data.military_status' => 'required_if:data.gender,male|string|max:255',
        ], [
            'data.military_status.required_if' => 'فیلد وضعیت نظام وظیفه در صورتی که جنسیت آقا انتخاب شده باشد الزامی می باشد.'
        ], [
            'data.first_name' => 'نام',
            'data.last_name' => 'نام خانوادگی',
            'data.email' => 'پست الکترونیکی',
            'data.father_name' => 'نام پدر',
            'data.birth_date' => 'تاریخ تولد',
            'data.national_code' => 'کد ملی',
            'data.landline_phone' => 'شماره تلفن',
            'data.mobile_1' => 'شماره موبایل 1',
            'data.mobile_2' => 'شماره موبایل 2',
            'data.address' => 'آدرس منزل',
            'data.job' => 'شغل',
            'data.education' => 'تحصیلات',
            'data.preferd_course' => 'دوره مورد نیاز',
            'data.initial_level' => 'تعیین سطح اولیه',
            'data.register_date' => 'تاریخ عضو یت',
            'data.national_card_image' => 'تصویر کارت ملی',
            'data.personal_image' => 'تصویر عکس پرسنلی',
            'data.refferal_name' => 'نام معرف',
            'data.refferal_national_code' => 'شماره ملی معرف',
            'data.refferal_phone' => 'شماره تماس معرف',
            'data.mariage_status' => 'وضعیت تاهل',
            'data.military_status' => 'وضعیت نظام وظیفه',
        ]);
    }

    public function updatedData($value, $key)
    {
        $this->disabledCreate = true;
        $this->validations();
        // if ($this->currentTab == 'student')
        //     $this->studentValidation();
        // elseif ($this->currentTab == 'staff')
        //     $this->staffValidation();
        $this->disabledCreate = false;
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

    public function submitStudent()
    {
        $this->validations();

        $this->user = $user = User::create([
            'first_name' => $this->data['first_name'] ?? null,
            'last_name' => $this->data['last_name'] ?? null,
            'national_code' => $this->data['national_code'] ?? null,
            'email' => $this->data['email'] ?? null,
            'phone' => $this->data['mobile_1'] ?? null,
        ]);

        $user->userInfo()->create([
            'type' => 'student',
            'mobile_1' => $this->data['mobile_1'],
        ]);

        // $user->userInfo()->create([
        //     'type' => 'student',
        //     'father_name' => $this->data['father_name'] ?? null,
        //     'birth_date' => isset($this->data['birth_date']) ? $this->convertToGeorgianDate($this->data['birth_date']) : null,
        //     'landline_phone' => $this->data['landline_phone'] ?? null,
        //     'mobile_1' => $this->data['mobile_1'] ?? null,
        //     'mobile_2' => $this->data['mobile_2'] ?? null,
        //     'address' => $this->data['address'] ?? null,
        //     'job' => $this->data['job'] ?? null,
        //     'education' => $this->data['education'] ?? null,
        //     'preferd_course' => $this->data['preferd_course'] ?? null,
        //     'initial_level' => $this->data['initial_level'] ?? null,
        //     'register_date' => isset($this->data['register_date']) ? $this->convertToGeorgianDate($this->data['register_date']) : null,
        //     'email' => $this->data['email'] ?? null,
        //     'refferal_name' => $this->data['refferal_name'] ?? null,
        //     'refferal_national_code' => $this->data['refferal_national_code'] ?? null,
        //     'refferal_phone' => $this->data['refferal_phone'] ?? null,
        //     'mariage_status' => $this->data['mariage_status'] ?? null,
        //     'military_status' => $this->data['military_status'] ?? null,
        // ]);

        // $this->createImages($user);

        $user->assignRole('student');
        $this->sendCode($user);
    }

    public function submitStaff()
    {
        $this->validations();

        $this->user = $user = User::create([
            'first_name' => $this->data['first_name'] ?? null,
            'last_name' => $this->data['last_name'] ?? null,
            'national_code' => $this->data['national_code'] ?? null,
            'email' => $this->data['email'] ?? null,
            'phone' => $this->data['mobile_1'] ?? null,
        ]);
        $user->userInfo()->create([
            'type' => 'staff',
            'mobile_1' => $this->data['mobile_1'],
        ]);
        // $user->userInfo()->create([
        //     'type' => 'staff',
        //     'father_name' => $this->data['father_name'] ?? null,
        //     'birth_date' => isset($this->data['birth_date']) ? $this->convertToGeorgianDate($this->data['birth_date']) : null,
        //     'landline_phone' => $this->data['landline_phone'] ?? null,
        //     'mobile_1' => $this->data['mobile_1'] ?? null,
        //     'mobile_2' => $this->data['mobile_2'] ?? null,
        //     'address' => $this->data['address'] ?? null,
        //     'job' => $this->data['job'] ?? null,
        //     'education' => $this->data['education'] ?? null,
        //     'preferd_course' => $this->data['preferd_course'] ?? null,
        //     'initial_level' => $this->data['initial_level'] ?? null,
        //     'register_date' => isset($this->data['register_date']) ? $this->convertToGeorgianDate($this->data['register_date']) : null,
        //     'email' => $this->data['email'] ?? null,
        //     'refferal_name' => $this->data['refferal_name'] ?? null,
        //     'refferal_national_code' => $this->data['refferal_national_code'] ?? null,
        //     'refferal_phone' => $this->data['refferal_phone'] ?? null,
        //     'mariage_status' => $this->data['mariage_status'] ?? null,
        //     'military_status' => $this->data['military_status'] ?? null,
        // ]);
        // $this->saveJobs($user);
        $user->assignRole('teacher');

        // $this->createImages($user);
        $this->sendCode($user);
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

    protected function createImages(User $user)
    {
        if (
            isset($this->data['national_card_image']) &&
            !is_null($this->data['national_card_image']) &&
            $this->data['national_card_image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ) {
            $user->clearMediaCollection('national_card_image');
            $user
                ->addMedia($this->data['national_card_image']->getRealPath())
                ->usingName($this->data['national_card_image']->getClientOriginalName())
                ->toMediaCollection('national_card');
        }
        if (
            isset($this->data['personal_image']) &&
            !is_null($this->data['personal_image']) &&
            $this->data['personal_image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ) {
            $user->clearMediaCollection('personal_image');
            $user
                ->addMedia($this->data['personal_image']->getRealPath())
                ->usingName($this->data['personal_image']->getClientOriginalName())
                ->toMediaCollection('personal_image');
        }
        if (
            isset($this->data['id_first_page_image']) &&
            !is_null($this->data['id_first_page_image']) &&
            $this->data['id_first_page_image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ) {
            $user->clearMediaCollection('id_first_page_image');
            $user
                ->addMedia($this->data['id_first_page_image']->getRealPath())
                ->usingName($this->data['id_first_page_image']->getClientOriginalName())
                ->toMediaCollection('id_first_page');
        }
        if (
            isset($this->data['id_second_page_image']) &&
            !is_null($this->data['id_second_page_image']) &&
            $this->data['id_second_page_image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ) {
            $user->clearMediaCollection('id_second_page_image');
            $user
                ->addMedia($this->data['id_second_page_image']->getRealPath())
                ->usingName($this->data['id_second_page_image']->getClientOriginalName())
                ->toMediaCollection('id_second_page');
        }
        if (
            isset($this->data['document_image_1']) &&
            !is_null($this->data['document_image_1']) &&
            $this->data['document_image_1'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ) {
            $user->clearMediaCollection('document_image_1');
            $user
                ->addMedia($this->data['document_image_1']->getRealPath())
                ->usingName($this->data['document_image_1']->getClientOriginalName())
                ->toMediaCollection('document_1');
        }
        if (
            isset($this->data['document_image_2']) &&
            !is_null($this->data['document_image_2']) &&
            $this->data['document_image_2'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ) {
            $user->clearMediaCollection('document_image_2');
            $user
                ->addMedia($this->data['document_image_2']->getRealPath())
                ->usingName($this->data['document_image_2']->getClientOriginalName())
                ->toMediaCollection('document_2');
        }
        if (
            isset($this->data['document_image_3']) &&
            !is_null($this->data['document_image_3']) &&
            $this->data['document_image_3'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ) {
            $user->clearMediaCollection('document_image_3');
            $user
                ->addMedia($this->data['document_image_3']->getRealPath())
                ->usingName($this->data['document_image_3']->getClientOriginalName())
                ->toMediaCollection('document_3');
        }
        if (
            isset($this->data['document_image_4']) &&
            !is_null($this->data['document_image_4']) &&
            $this->data['document_image_4'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ) {
            $user->clearMediaCollection('document_image_4');
            $user
                ->addMedia($this->data['document_image_4']->getRealPath())
                ->usingName($this->data['document_image_4']->getClientOriginalName())
                ->toMediaCollection('document_4');
        }
        if (
            isset($this->data['document_image_5']) &&
            !is_null($this->data['document_image_5']) &&
            $this->data['document_image_5'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ) {
            $user->clearMediaCollection('document_image_5');
            $user
                ->addMedia($this->data['document_image_5']->getRealPath())
                ->usingName($this->data['document_image_5']->getClientOriginalName())
                ->toMediaCollection('document_5');
        }
        if (
            isset($this->data['document_image_6']) &&
            !is_null($this->data['document_image_6']) &&
            $this->data['document_image_6'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ) {
            $user->clearMediaCollection('document_image_6');
            $user
                ->addMedia($this->data['document_image_6']->getRealPath())
                ->usingName($this->data['document_image_6']->getClientOriginalName())
                ->toMediaCollection('document_6');
        }
        if (
            isset($this->data['document_image_7']) &&
            !is_null($this->data['document_image_7']) &&
            $this->data['document_image_7'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ) {
            $user->clearMediaCollection('document_image_7');
            $user
                ->addMedia($this->data['document_image_7']->getRealPath())
                ->usingName($this->data['document_image_7']->getClientOriginalName())
                ->toMediaCollection('document_7');
        }
        if (
            isset($this->data['document_image_8']) &&
            !is_null($this->data['document_image_8']) &&
            $this->data['document_image_8'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ) {
            $user->clearMediaCollection('document_image_8');
            $user
                ->addMedia($this->data['document_image_8']->getRealPath())
                ->usingName($this->data['document_image_8']->getClientOriginalName())
                ->toMediaCollection('document_8');
        }
    }
}
