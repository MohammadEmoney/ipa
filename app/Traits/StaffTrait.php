<?php

namespace App\Traits;

use App\Models\JobReference;
use App\Rules\JDate;
use App\Rules\ValidNationalCode;
use Illuminate\Support\Facades\Hash;

trait StaffTrait
{
    public function mountStaffTrait()
    {
        if($this->user->jobReferences()->count()){
            $this->haveJobReference = true;
        }
    }

    public function updatedStaffTrait($property)
    {
        $this->validateOnly($property, [
            'data.personal_image' => 'nullable|mimes:jpeg,jpg,png,gif',
            'data.national_card_image' => 'nullable|mimes:jpeg,jpg,png,gif',
            'data.id_first_page_image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'data.id_second_page_image' => 'nullable|mimes:jpeg,jpg,png,gif',
            'data.document_image_1' => 'nullable|mimes:jpeg,jpg,png,gif',
            'data.document_image_2' => 'nullable|mimes:jpeg,jpg,png,gif',
            'data.document_image_3' => 'nullable|mimes:jpeg,jpg,png,gif',
            'data.document_image_4' => 'nullable|mimes:jpeg,jpg,png,gif',
            'data.document_image_5' => 'nullable|mimes:jpeg,jpg,png,gif',
            'data.document_image_6' => 'nullable|mimes:jpeg,jpg,png,gif',
            'data.document_image_7' => 'nullable|mimes:jpeg,jpg,png,gif',
            'data.document_image_8' => 'nullable|mimes:jpeg,jpg,png,gif',
        ]);
    }

    public function staffValidation()
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
            'data.email' => 'nullable|email|max:255|unique:users,email,' . $this->user->id,
            'data.password' => 'nullable|confirmed|min:8|max:255',
            // 'data.personal_image' => 'required|image|max:2048',
            // 'data.national_card_image' => 'required|image|max:2048',
            'data.mariage_status' => 'required|boolean|max:255',
            'data.gender' => 'required|in:male,female|max:255',
            'data.military_status' => 'required_if:data.gender,male|nullable|string|max:255',
            // 'data.id_first_page_image' => 'required|image|max:2048',
            // 'data.id_second_page_image' => 'required|image|max:2048',
            // 'data.document_image_1' => 'required|image|max:2048',
            // 'data.document_image_2' => 'required|image|max:2048',
            // 'data.document_image_3' => 'required|image|max:2048',
            // 'data.document_image_4' => 'nullable|image|max:2048',
            // 'data.document_image_5' => 'nullable|image|max:2048',
            // 'data.document_image_6' => 'nullable|image|max:2048',
            // 'data.document_image_7' => 'nullable|image|max:2048',
            // 'data.document_image_8' => 'nullable|image|max:2048',
        ],[
            'data.military_status.required_if' => 'فیلد وضعیت نظام وظیفه در صورتی که جنسیت آقا انتخاب شده باشد الزامی می باشد.'
        ],[
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
            'data.personal_image' => 'آپلود عکس',
            'data.id_first_page_image' => 'بارگذاری شناسنامه ص 1',
            'data.id_second_page_image' => 'بارگذاری شناسنامه ص 2',
            'data.document_image_1' => 'بارگذاری مدارک 1',
            'data.document_image_2' => 'بارگذاری مدارک 2',
            'data.document_image_3' => 'بارگذاری مدارک 3',
            'data.document_image_4' => 'بارگذاری مدارک 4',
            'data.document_image_5' => 'بارگذاری مدارک 5',
            'data.document_image_6' => 'بارگذاری مدارک 6',
            'data.document_image_7' => 'بارگذاری مدارک 7',
            'data.document_image_8' => 'بارگذاری مدارک 8',
            'data.role' => 'نقش کاربر',
            'data.gender' => 'جنسیت',
            'data.password' => 'رمز عبور',
        ]);
    }

    public function staffPersonalInfoValidation()
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
            'data.mariage_status' => 'required|boolean|max:255',
            'data.gender' => 'required|in:male,female|max:255',
            'data.military_status' => 'required_if:data.gender,male|nullable|string|max:255',
        ],[
            'data.military_status.required_if' => 'فیلد وضعیت نظام وظیفه در صورتی که جنسیت آقا انتخاب شده باشد الزامی می باشد.'
        ],[
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
            'data.mariage_status' => 'وضعیت تاهل',
            'data.military_status' => 'وضعیت نظام وظیفه',
            'data.gender' => 'جنسیت',
        ]);
    }

    public function submitStaffPersonalInfo()
    {
        $this->dispatch('autoFocus');
        $this->staffPersonalInfoValidation();
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
            'email' => $this->data['email'] ?? null,
            'mariage_status' => $this->data['mariage_status'] ?? null,
            'military_status' => $this->data['military_status'] ?? null,
            'gender' => $this->data['gender'] ?? "male",
        ]);
        $this->setStep("jobReferences", 2);
    }

    public function submitJobReferences()
    {
        $user = $this->user;
        foreach($this->tempJobs as $key => $item){
            $job = JobReference::where('id', $key)->where('user_id', $this->user->id)->first();

            $stillWorking = $item['still_working'] ?? 0;
            if($job){
                $job->update([
                    'company_name' => $item['company_name'],
                    'role' => $item['role'],
                    'date_start' => isset($item['date_start']) ? $this->convertToGeorgianDate($item['date_start']) : null,
                    'date_end' => $stillWorking ? null :  (isset($item['date_end']) ? $this->convertToGeorgianDate($item['date_end']) : null),
                    'description' => $item['description'] ?? null,
                    'still_working' => $stillWorking,
                    'work_phone' => $item['work_phone'] ?? null,
                    'work_address' => $item['work_address'] ?? null,
                ]);
            }else{
                $user->jobReferences()->create([
                    'company_name' => $item['company_name'],
                    'role' => $item['role'],
                    'date_start' => isset($item['date_start']) ? $this->convertToGeorgianDate($item['date_start']) : null,
                    'date_end' => $stillWorking ? null :  (isset($item['date_end']) ? $this->convertToGeorgianDate($item['date_end']) : null),
                    'description' => $item['description'] ?? null,
                    'still_working' => $stillWorking,
                    'work_phone' => $item['work_phone'] ?? null,
                    'work_address' => $item['work_address'] ?? null,
                ]);
            }

        }
        $this->setStep("uploadMedia", 3);
    }

    public function submitStaff()
    {
        $this->dispatch('autoFocus');
        $this->staffValidation();
        if(!isset($this->data['national_card_image']) && !$this->data['national_card_image']){
            return $this->addError('data.national_card_image', 'تصویر کارت ملی الزامی می باشد.');
        }
        if(!isset($this->data['personal_image']) && !$this->data['personal_image']){
            return $this->addError('data.personal_image', 'تصویر پرسنلی الزامی می باشد.');
        }
        if(!isset($this->data['id_first_page_image']) && !$this->data['id_first_page_image']){
            return $this->addError('data.id_first_page_image', 'بارگذاری شناسنامه ص 1 الزامی می باشد.');
        }
        if(!isset($this->data['id_second_page_image']) && !$this->data['id_second_page_image']){
            return $this->addError('data.id_second_page_image', 'بارگذاری شناسنامه ص 2 الزامی می باشد.');
        }
        if(!isset($this->data['document_image_1']) && !$this->data['document_image_1']){
            return $this->addError('data.document_image_1', 'بارگذاری مدارک 1 الزامی می باشد.');
        }
        if(!isset($this->data['document_image_2']) && !$this->data['document_image_2']){
            return $this->addError('data.document_image_2', 'بارگذاری مدارک 2 الزامی می باشد.');
        }
        if(!isset($this->data['document_image_3']) && !$this->data['document_image_3']){
            return $this->addError('data.document_image_3', 'بارگذاری مدارک 3 الزامی می باشد.');
        }
        $user = $this->user;

        $this->createImages($user);

        $user->update(['register_complete' => true]);

        $this->alert('اطلاعات شما با موفقیت ویرایش شد.')->success();
        return redirect()->to(route('profile.edit'));
    }

    // public $jobs = [];
    // public $tempJobs = [];
    // public $editingJobId;
    // public $jobsDatePicker;

    // public function addJobReference()
    // {
    //     $this->jobsValidation();
    //     $this->tempJobs[] = $this->jobs;
    //     $this->jobs = [];
    // }

    // public function deleteJob($key)
    // {
    //     JobReference::where('id', $key)->where('user_id', $this->user->id)->first()?->delete();
    //     unset($this->tempJobs[$key]);
    // }

    // public function editJob($key)
    // {
    //     $this->jobs = $this->tempJobs[$key];
    //     $this->editingJobId = $key;
    // }

    // public function updateJob()
    // {
    //     $this->jobsValidation();
    //     $this->tempJobs[$this->editingJobId] = $this->jobs;
    //     $this->jobs = [];
    //     $this->editingJobId = null;
    // }

    // public function jobsValidation()
    // {
    //     $this->validate([
    //         'jobs.company_name' => 'required|string|max:255',
    //         'jobs.role' => 'required|string|max:255',
    //         'jobs.date_start' => ['required', 'string', 'max:255', new JDate()],
    //         'jobs.date_end' => ['required_without:jobs.still_working', 'string', 'max:255', new JDate()],
    //         'jobs.description' => 'nullable|string',
    //         'jobs.work_phone' => 'nullable|numeric',
    //         'jobs.work_address' => 'nullable|string',
    //         'jobs.still_working' => 'nullable|boolean',
    //     ],[
    //         'jobs.date_end.required_without' => 'پایان کار الزامی است'
    //     ],[
    //         'jobs.company_name' => 'نام شرکت',
    //         'jobs.role' => 'عنوان شغلی',
    //         'jobs.date_start' => 'شروع کار',
    //         'jobs.date_end' => 'پایان کار',
    //         'jobs.description' => 'توضیحات',
    //         'jobs.work_address' => 'آدرس محل کار',
    //         'jobs.work_phone' => 'شماره تلفن محل کار',
    //     ]);
    // }

    // public function loadDatePicker()
    // {
    //     $this->dispatch('selectJobsReference');
    // }
}