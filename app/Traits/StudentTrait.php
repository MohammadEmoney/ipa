<?php

namespace App\Traits;

use App\Rules\JDate;
use App\Rules\ValidNationalCode;
use Livewire\Attributes\Validate;

trait StudentTrait
{
    public function mountStudentTrait()
    {
        //
    }

    public function updatedStudentTrait($property)
    {
        $this->validateOnly($property, [
            'data.personal_image' => 'nullable|mimes:jpeg,jpg,png,gif',
            'data.national_card_image' => 'nullable|mimes:jpeg,jpg,png,gif',
        ]);
    }

    public function studentValidation()
    {
        $this->validate([
            'data.first_name' => 'required|string|max:255',
            'data.last_name' => 'required|string|max:255',
            'data.father_name' => 'required|string|max:255',
            'data.birth_date' => ['required', 'string', 'max:255', new JDate()],
            'data.national_code' => ['required', 'string', 'max:255', new ValidNationalCode(), 'unique:users,national_code,' . $this->user?->id],
            'data.landline_phone' => 'nullable|regex:/^0[0-9]{10}$/',
            'data.mobile_1' => 'required|regex:/^09[0-9]{9}$/|unique:users,phone,' . $this->user->id,
            'data.mobile_2' => 'required|regex:/^09[0-9]{9}$/',
            'data.address' => 'required|string|max:2550',
            'data.job' => 'nullable|string|max:255',
            'data.education' => 'nullable|string|max:255',
            'data.preferd_course' => 'required|string|max:255',
            'data.initial_level' => 'required|string|max:255',
            'data.register_date' => ['required', 'max:255', new JDate()],
            'data.email' => 'nullable|email|max:255|unique:users,email,' . $this->user->id,
            'data.refferal_name' => 'nullable|string|max:255',
            'data.refferal_national_code' => ['nullable', 'string', 'max:255', new ValidNationalCode()],
            'data.refferal_phone' => 'nullable|string|max:255',
            'data.gender' => 'required|in:male,female|max:255',
        ],[],[
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
            'data.gender' => 'جنسیت',
        ]);
    }

    public function personalInfoValidation()
    {
        $this->validate([
            'data.first_name' => 'required|string|max:255',
            'data.last_name' => 'required|string|max:255',
            'data.father_name' => 'required|string|max:255',
            'data.birth_date' => ['required', 'string', 'max:255', new JDate()],
            'data.national_code' => ['required', 'string', 'max:255', new ValidNationalCode(), 'unique:users,national_code,' . $this->user?->id],
            'data.landline_phone' => 'nullable|regex:/^0[0-9]{10}$/',
            'data.mobile_1' => 'required|regex:/^09[0-9]{9}$/|unique:users,phone,' . $this->user->id,
            'data.mobile_2' => 'required|regex:/^09[0-9]{9}$/',
            'data.address' => 'required|string|max:2550',
            'data.job' => 'nullable|string|max:255',
            'data.education' => 'nullable|string|max:255',
        ],[],[
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
        ]);
    }

    public function furtherInfoValidation()
    {
        $this->validate([
            'data.preferd_course' => 'required|string|max:255',
            'data.initial_level' => 'required|string|max:255',
            'data.register_date' => ['required', 'max:255', new JDate()],
            'data.email' => 'nullable|email|max:255|unique:users,email,' . $this->user->id,
            // 'data.personal_image' => 'required|image|max:2048',
            // 'data.national_card_image' => 'required|image|max:2048',
            'data.refferal_name' => 'nullable|string|max:255',
            'data.refferal_national_code' => ['nullable', 'string', 'max:255', new ValidNationalCode()],
            'data.refferal_phone' => 'nullable|string|max:255',
            'data.gender' => 'required|in:male,female|max:255',
        ],[],[
            'data.preferd_course' => 'دوره مورد نیاز',
            'data.initial_level' => 'تعیین سطح اولیه',
            'data.register_date' => 'تاریخ عضو یت',
            'data.national_card_image' => 'تصویر کارت ملی',
            'data.personal_image' => 'تصویر عکس پرسنلی',
            'data.refferal_name' => 'نام معرف',
            'data.refferal_national_code' => 'شماره ملی معرف',
            'data.refferal_phone' => 'شماره تماس معرف',
            'data.gender' => 'جنسیت',
        ]);
    }

    public function submitStudentPersonalInfo()
    {
        $this->dispatch('autoFocus');
        $this->personalInfoValidation();

        $user = $this->user;
        $user->update([
            'first_name' => $this->data['first_name'] ?? null,
            'last_name' => $this->data['last_name'] ?? null,
            'national_code' => $this->data['national_code'] ?? null,
            'email' => $this->data['email'] ?? null,
            'phone' => $this->data['mobile_1'] ?? null,
        ]);

        $user->userInfo()->update([
            'father_name' => $this->data['father_name'] ?? null,
            'birth_date' => isset($this->data['birth_date']) ? $this->convertToGeorgianDate($this->data['birth_date']) : null,
            'landline_phone' => $this->data['landline_phone'] ?? null,
            'mobile_1' => $this->data['mobile_1'] ?? null,
            'mobile_2' => $this->data['mobile_2'] ?? null,
            'address' => $this->data['address'] ?? null,
            'job' => $this->data['job'] ?? null,
            'education' => $this->data['education'] ?? null,
        ]);

        $this->setStep("furtherInfo", 2);
    }

    public function submitFurtherInfo()
    {
        $this->dispatch('autoFocus');
        $this->furtherInfoValidation();
        $user = $this->user;
        $user->userInfo()->update([
            'preferd_course' => $this->data['preferd_course'] ?? null,
            'initial_level' => $this->data['initial_level'] ?? null,
            'email' => $this->data['email'] ?? null,
            'refferal_name' => $this->data['refferal_name'] ?? null,
            'refferal_national_code' => $this->data['refferal_national_code'] ?? null,
            'refferal_phone' => $this->data['refferal_phone'] ?? null,
            'gender' => $this->data['gender'] ?? "male",
        ]);
        $this->setStep("uploadMedia", 3);
    }

    public function submitStudent()
    {
        $this->dispatch('autoFocus');
        $this->studentValidation();
        $user = $this->user;
        if(!isset($this->data['national_card_image']) ){
            return $this->addError('data.national_card_image', 'تصویر کارت ملی الزامی می باشد.');
        }
        if(!isset($this->data['personal_image'])){
            return $this->addError('data.personal_image', 'تصویر پرسنلی الزامی می باشد.');
        }
        $this->createImages($user);
        $user->update(['register_complete' => true]);

        $this->alert('اطلاعات با موفقیت ویرایش شد.')->success();
        return redirect()->to(route('profile.edit'));
    }
}