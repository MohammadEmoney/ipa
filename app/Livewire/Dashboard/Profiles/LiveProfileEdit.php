<?php

namespace App\Livewire\Dashboard\Profiles;

use App\Enums\EnumEducationTypes;
use App\Enums\EnumInitialLevels;
use App\Enums\EnumMilitaryStatus;
use App\Enums\EnumUserSituation;
use App\Traits\StaffTrait;
use App\Traits\StudentTrait;
use App\Models\Course;
use App\Models\JobReference;
use App\Models\User;
use App\Rules\JDate;
use App\Rules\ValidNationalCode;
use App\Traits\AlertLiveComponent;
use App\Traits\DateTrait;
use App\Traits\JobsTrait;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Morilog\Jalali\Jalalian;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LiveProfileEdit extends Component
{
    use AlertLiveComponent;
    use WithFileUploads;
    use DateTrait;
    use MediaTrait;

    public $step = "personalInfo";
    public $stepNumber = 1;
    public $progressValue = 0;
    public $user;
    public $title;
    public $data;
    public $edit = true;
    public $type;
    
    public $firstname;
    public $currentTab = 'student';
    public $disabledCreate = true;
    public $disabledEdit = true;

    public function mount()
    {
        $this->user = $user = auth()->user();
        $this->type = $user->userInfo?->type ?: 'student';
        $this->data['first_name'] = $user->first_name;
        $this->data['last_name'] = $user->last_name;
        $this->data['email'] = $user->email;
        $this->data['phone'] = $user->phone;
        $this->data['national_code'] = $user->userInfo?->national_code;
        $this->data['birth_date'] = Jalalian::fromDateTime($user->userInfo?->birth_date)->format('Y-m-d');
        $this->data['phone_1'] = $user->userInfo?->phone_1;
        $this->data['phone_2'] = $user->userInfo?->phone_2;
        $this->data['address'] = $user->userInfo?->address;
        $this->data['job_title'] = $user->userInfo?->job_title;
        $this->data['situation'] = $user->userInfo?->situation;
        $this->data['education'] = $user->userInfo?->education;
        $this->data['university'] = $user->userInfo?->university;
        $this->data['company_name'] = $user->userInfo?->company_name;

        $this->data['avatar'] = $this->user->getFirstMedia('avatar');
        $this->data['nationalCard'] = $this->user->getFirstMedia('nationalCard');
        $this->data['license'] = $this->user->getFirstMedia('license');

        $this->title = __('global.edit_profile');
    }

    public function validations()
    {
        $this->validate([
            'data.first_name' => 'required|string|max:255',
            'data.last_name' => 'required|string|max:255',
            // 'data.landline_phone' => 'nullable|regex:/^0[0-9]{10}$/',
            'data.phone' => 'required|regex:/^09[0-9]{9}$/|unique:users,phone,' . $this->user->id,
            // 'data.phone_2' => 'required|regex:/^09[0-9]{9}$/',
            'data.address' => 'nullable|string|max:2550',
            // 'data.job' => 'nullable|string|max:255',
            // 'data.education' => 'nullable|string|max:255',
            'data.email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'data.password' => 'nullable|confirmed|min:8|max:255',
            // 'data.gender' => 'required|in:male,female|max:255',
            // 'data.avatar' => 'nullable|image|max:2048',
            'data.situation' => 'required|in:' . EnumUserSituation::asStringValues(),
            'data.university' => 'required_if:situation,' . EnumUserSituation::STUDENT,
            'data.company_name' => 'required_if:situation,' . EnumUserSituation::EMPLOYED,
        ],[],
        [
            'data.father_name' => 'نام پدر',
            'data.birth_date' => 'تاریخ تولد',
            'data.national_code' => 'کد ملی',
            'data.landline_phone' => 'شماره تلفن',
            'data.phone_1' => 'شماره موبایل 1',
            'data.phone_2' => 'شماره موبایل 2',
            'data.address' => __('global.address'),
            'data.avatar' => __('global.upload_image'),
            'data.first_name' => __('global.first_name'),
            'data.last_name' => __('global.last_name'),
            'data.email' =>  __('global.email'),
            'data.phone' => __('global.phone_number'),
            'data.password' => __('global.password'),
            'data.role' => __('global.user_role'),
            'data.gender' => __('global.gender'),
            'data.situation' => __('global.job_status'),
            'data.university' => __('global.university_name'),
            'data.company_name' => __('global.company_name'),
        ]);
    }

    public function submit()
    {
        try {
            $this->validations();
            $user = $this->user;
            $user->update([
                'first_name' => $this->data['first_name'] ?? null,
                'last_name' => $this->data['last_name'] ?? null,
                'email' => $this->data['email'] ?? null,
                'phone' => $this->data['phone'] ?? null,
            ]);

            $user->userInfo()->update([
                'national_code' => $this->data['national_code'] ?? null,
                'birth_date' => isset($this->data['birth_date']) ? $this->convertToGeorgianDate($this->data['birth_date']) : null,
                'landline_phone' => $this->data['landline_phone'] ?? null,
                'phone_1' => $this->data['phone'] ?? null,
                'phone_2' => $this->data['phone_2'] ?? null,
                'address' => $this->data['address'] ?? null,
                'job_title' => $this->data['job_title'] ?? null,
                'company_name' => $this->data['company_name'] ?? null,
                'company_phone' => $this->data['company_phone'] ?? null,
                'company_address' => $this->data['company_address'] ?? null,
                'education' => $this->data['education'] ?? null,
                'situation' => $this->data['situation'] ?? null,
                'university' => $this->data['university'] ?? null,
            ]);

            $this->createImage($user, 'avatar');
            $this->createImage($user, 'nationalCard');
            $this->createImage($user, 'license');
            $this->alert(__('messages.profile_updated_successfully'))->success();
        } catch (\Exception $e) {
            $this->alert($e->getMessage())->error();
        }
    }

    public function loadScripts()
    {
        $this->dispatch('persianDate');
    }

    public function render()
    {
        $educations = EnumEducationTypes::getTranslatedAll();
        $situations = EnumUserSituation::getTranslatedAll();
        return view('livewire.dashboard.profiles.live-profile-edit', compact('situations', 'educations'))->extends('layouts.panel')->section('content');
    }
}
