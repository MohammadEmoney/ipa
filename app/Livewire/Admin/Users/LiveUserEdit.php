<?php

namespace App\Livewire\Admin\Users;

use App\Enums\EnumEducationTypes;
use App\Enums\EnumInitialLevels;
use App\Enums\EnumMilitaryStatus;
use App\Enums\EnumUserRoles;
use App\Enums\EnumUserType;
use App\Models\Course;
use App\Models\JobReference;
use App\Models\User;
use App\Rules\JDate;
use App\Rules\ValidNationalCode;
use App\Traits\AlertLiveComponent;
use App\Traits\DateTrait;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Morilog\Jalali\Jalalian;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LiveUserEdit extends Component
{
    use AlertLiveComponent;
    use WithFileUploads;
    use DateTrait;

    public $edit = true;
    public $type;
    public $data = [];
    public $jobs = [];
    public $tempJobs = [];
    public $editingJobId;
    public $jobsDatePicker;
    public $stillWorking = false;
    public $haveJobReference = true;
    public $editPage = true;
    public $firstname;
    public $user;
    public $currentTab = 'student';
    public $disabledCreate = true;
    public $disabledEdit = true;
    public $selectedAll = false;
    public $allFalsePermissions = [];
    public $allTruePermissions = [];
    public $allAssignedPermissions = [];

    public function mount()
    {
        $this->type = $this->user->userInfo->type;
        $permissions = Permission::all();
        $this->allFalsePermissions = $permissions->pluck('id', 'id')->map(function ($item) {
            return false;
        })->toArray();
        $rolePermissions = $this->user->permissions()->pluck('id', 'id')->map(function ($item) {
            return true;
        })->toArray();
        $this->allTruePermissions = $permissions->pluck('id', 'id')->map(function ($item) {
            return true;
        })->toArray();
        $this->allAssignedPermissions = $permissions->pluck('id', 'id')->map(function ($item) {
            return true;
        })->toArray();
        $meregedArray = $rolePermissions + $this->allFalsePermissions;
        $this->data['direct_permissions'] = $meregedArray;
        $this->data['role'] = $this->user->getRoleNames()->first();

        $this->loadData();
    }

    public function loadData()
    {
        $this->data['first_name'] = $this->user->first_name;
        $this->data['last_name'] = $this->user->last_name;
        $this->data['national_code'] = $this->user->national_code;
        $this->data['gender'] = $this->user->userInfo->gender;
        $this->data['father_name'] = $this->user->userInfo->father_name;
        $this->data['birth_date'] = Jalalian::fromDateTime($this->user->userInfo->birth_date)->format('Y-m-d');
        $this->data['register_date'] = Jalalian::fromDateTime($this->user->userInfo->register_date)->format('Y-m-d');
        $this->data['landline_phone'] = $this->user->userInfo->landline_phone;
        $this->data['mobile_1'] = $this->user->userInfo->mobile_1;
        $this->data['mobile_2'] = $this->user->userInfo->mobile_2;
        $this->data['address'] = $this->user->userInfo->address;
        $this->data['job'] = $this->user->userInfo->job;
        $this->data['education'] = $this->user->userInfo->education;
        $this->data['preferd_course'] = $this->user->userInfo->preferd_course;
        $this->data['initial_level'] = $this->user->userInfo->initial_level;
        $this->data['email'] = $this->user->userInfo->email;
        $this->data['refferal_name'] = $this->user->userInfo->refferal_name;
        $this->data['refferal_national_code'] = $this->user->userInfo->refferal_national_code;
        $this->data['refferal_phone'] = $this->user->userInfo->refferal_phone;
        $this->data['mariage_status'] = $this->user->userInfo->mariage_status;
        $this->data['military_status'] = $this->user->userInfo->military_status;

        $this->data['national_card_image'] = $this->user->getFirstMedia('national_card');
        $this->data['personal_image'] = $this->user->getFirstMedia('personal_image');
        $this->data['id_first_page_image'] = $this->user->getFirstMedia('id_first_page');
        $this->data['id_second_page_image'] = $this->user->getFirstMedia('id_second_page');
        $this->data['document_image_1'] = $this->user->getFirstMedia('document_1');
        $this->data['document_image_2'] = $this->user->getFirstMedia('document_2');
        $this->data['document_image_3'] = $this->user->getFirstMedia('document_3');
        $this->data['document_image_4'] = $this->user->getFirstMedia('document_4');
        $this->data['document_image_5'] = $this->user->getFirstMedia('document_5');
        $this->data['document_image_6'] = $this->user->getFirstMedia('document_6');
        $this->data['document_image_7'] = $this->user->getFirstMedia('document_7');
        $this->data['document_image_8'] = $this->user->getFirstMedia('document_8');

        foreach($this->user->jobReferences as $job)
            $this->tempJobs[$job->id] = $job->toArray();
    }

    public function selectAll()
    {
        if(isset($this->data['direct_permissions']) && $this->selectedAll){
            $this->data['direct_permissions'] = $this->allTruePermissions;
        }else{
            $this->data['direct_permissions'] = $this->allFalsePermissions;
        }
    }

    public function addJobReference()
    {
        $this->jobsValidation();
        $this->tempJobs[] = $this->jobs;
        $this->jobs = [];
    }

    public function deleteJob($key)
    {
        JobReference::where('id', $key)->where('user_id', $this->user->id)->first()?->delete();
        unset($this->tempJobs[$key]);
    }

    public function editJob($key)
    {
        $this->jobs = $this->tempJobs[$key];
        $this->editingJobId = $key;
    }

    public function updateJob()
    {
        $this->jobsValidation();
        $this->tempJobs[$this->editingJobId] = $this->jobs;
        $this->jobs = [];
        $this->editingJobId = null;
    }

    public function jobsValidation()
    {
        $this->validate([
            'jobs.company_name' => 'required|string|max:255',
            'jobs.role' => 'required|string|max:255',
            'jobs.date_start' => ['required', 'string', 'max:255', new JDate()],
            'jobs.date_end' => ['required_without:jobs.still_working', 'string', 'max:255', new JDate()],
            'jobs.description' => 'nullable|string',
            'jobs.work_phone' => 'nullable|numeric',
            'jobs.work_address' => 'nullable|string',
            'jobs.still_working' => 'nullable|boolean',
        ],[],[
            'jobs.company_name' => 'نام شرکت',
            'jobs.role' => 'عنوان شغلی',
            'jobs.date_start' => 'شروع کار',
            'jobs.date_end' => 'پایان کار',
            'jobs.description' => 'توضیحات',
            'jobs.work_address' => 'آدرس محل کار',
            'jobs.work_phone' => 'شماره تلفن محل کار',
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
            'data.mobile_1' => 'required|regex:/^09[0-9]{9}$/',
            'data.mobile_2' => 'required|regex:/^09[0-9]{9}$/',
            'data.address' => 'required|string|max:2550',
            'data.job' => 'nullable|string|max:255',
            'data.education' => 'nullable|string|max:255',
            'data.preferd_course' => 'required|string|max:255',
            'data.initial_level' => 'required|string|max:255',
            'data.register_date' => ['required', 'max:255', new JDate()],
            'data.email' => 'nullable|email|max:255|unique:users,email,' . $this->user->id,
            // 'data.personal_image' => 'required|image|max:2048',
            // 'data.national_card_image' => 'required|image|max:2048',
            'data.refferal_name' => 'nullable|string|max:255',
            'data.refferal_national_code' => ['nullable', 'string', 'max:255', new ValidNationalCode()],
            'data.refferal_phone' => 'nullable|string|max:255',
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
            'data.mobile_1' => 'required|regex:/^09[0-9]{9}$/',
            'data.mobile_2' => 'required|regex:/^09[0-9]{9}$/',
            'data.address' => 'required|string|max:2550',
            'data.job' => 'nullable|string|max:255',
            'data.education' => 'nullable|string|max:255',
            'data.email' => 'required|email|max:255',
            'data.password' => 'nullable|confirmed|min:8|max:255',
            // 'data.personal_image' => 'required|image|max:2048',
            // 'data.national_card_image' => 'required|image|max:2048',
            'data.mariage_status' => 'required|boolean|max:255',
            'data.gender' => 'required|in:male,female|max:255',
            // 'data.military_status' => 'required_if:data.gender,male|string|max:255',
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
            'data.role' =>  auth()->user()->hasRole('super-admin') ? 'required|exists:roles,name' : 'nullable',
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

    public function updatedData($value, $key)
    {
        $this->disabledCreate = true;
        if($this->type == 'student')
            $this->studentValidation();
        elseif($this->type == 'staff')
            $this->staffValidation();
        $this->disabledCreate = false;
    }

    public function loadDatePicker()
    {
        $this->dispatch('selectJobsReference');
    }

    public function submitStudent()
    {
        $this->authorize('user_student_edit');
        $this->studentValidation();
        $user = $this->user;
        $user->update([
            'first_name' => $this->data['first_name'] ?? null,
            'last_name' => $this->data['last_name'] ?? null,
            'national_code' => $this->data['national_code'] ?? null,
            'email' => $this->data['email'] ?? null,
            'phone' => $this->data['phone'] ?? null,
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
        $user->syncRoles(EnumUserRoles::STUDENT);
        $this->createImages($user);
        $this->alert('دانش آموز با موفقیت ویرایش شد.')->success();
        return redirect()->to(route('admin.users.student.index'));
    }

    public function submitStaff()
    {
        $this->authorize('user_edit');
        $this->staffValidation();
        $user = $this->user;
        $user->update([
            'first_name' => $this->data['first_name'] ?? null,
            'last_name' => $this->data['last_name'] ?? null,
            'national_code' => $this->data['national_code'] ?? null,
            'email' => $this->data['email'] ?? null,
            'phone' => $this->data['phone'] ?? null,
            'password' => isset($this->data['password']) ? Hash::make($this->data['password']) : null,
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

        foreach($this->tempJobs as $key => $job){
            $job = JobReference::where('id', $key)->where('user_id', $this->user->id)->first();
            if($job){
                $job->update([
                    'company_name' => $job['company_name'],
                    'role' => $job['role'],
                    'date_start' => isset($job['date_start']) ? $this->convertToGeorgianDate($job['date_start']) : null,
                    'date_end' => isset($job['date_end']) ? $this->convertToGeorgianDate($job['date_end']) : null,
                    'description' => $job['description'] ?? null,
                    'still_working' => $job['still_working'] ?? 0,
                    'work_phone' => $job['work_phone'] ?? null,
                    'work_address' => $job['work_address'] ?? null,
                ]);
            }else{
                $user->jobReferences()->create([
                    'company_name' => $job['company_name'],
                    'role' => $job['role'],
                    'date_start' => isset($job['date_start']) ? $this->convertToGeorgianDate($job['date_start']) : null,
                    'date_end' => isset($job['date_end']) ? $this->convertToGeorgianDate($job['date_end']) : null,
                    'description' => $job['description'] ?? null,
                    'still_working' => $job['still_working'] ?? 0,
                    'work_phone' => $job['work_phone'] ?? null,
                    'work_address' => $job['work_address'] ?? null,
                ]);
            }
        }

        $this->createImages($user);

        $user->syncRoles($this->data['role'] ?? EnumUserRoles::TEACHER);
        $selectedPermissions = collect($this->data['direct_permissions'])->map(function($value, $key){
            if($value)
                return $key;
        })->filter();
        $permissions = Permission::whereIn('id', $selectedPermissions)->pluck('name');
        $user->syncPermissions($permissions);
        $this->alert('کاربر با موفقیت ویرایش شد.')->success();
        return redirect()->to(route('admin.users.staff.index'));
    }

    protected function createImages(User $user)
    {
        if(isset($this->data['national_card_image']) &&
            !is_null($this->data['national_card_image']) &&
            $this->data['national_card_image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $user->clearMediaCollection('national_card');
            $user
                ->addMedia($this->data['national_card_image']->getRealPath())
                ->usingName($this->data['national_card_image']->getClientOriginalName())
                ->toMediaCollection('national_card');
        }
        if(isset($this->data['personal_image']) &&
            !is_null($this->data['personal_image']) &&
            $this->data['personal_image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $user->clearMediaCollection('personal_image');
            $user
                ->addMedia($this->data['personal_image']->getRealPath())
                ->usingName($this->data['personal_image']->getClientOriginalName())
                ->toMediaCollection('personal_image');
        }
        if(isset($this->data['id_first_page_image']) &&
            !is_null($this->data['id_first_page_image']) &&
            $this->data['id_first_page_image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $user->clearMediaCollection('id_first_page');
            $user
                ->addMedia($this->data['id_first_page_image']->getRealPath())
                ->usingName($this->data['id_first_page_image']->getClientOriginalName())
                ->toMediaCollection('id_first_page');
        }
        if(isset($this->data['id_second_page_image']) &&
            !is_null($this->data['id_second_page_image']) &&
            $this->data['id_second_page_image'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $user->clearMediaCollection('id_second_page');
            $user
                ->addMedia($this->data['id_second_page_image']->getRealPath())
                ->usingName($this->data['id_second_page_image']->getClientOriginalName())
                ->toMediaCollection('id_second_page');
        }
        if(isset($this->data['document_image_1']) &&
            !is_null($this->data['document_image_1']) &&
            $this->data['document_image_1'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $user->clearMediaCollection('document_1');
            $user
                ->addMedia($this->data['document_image_1']->getRealPath())
                ->usingName($this->data['document_image_1']->getClientOriginalName())
                ->toMediaCollection('document_1');
        }
        if(isset($this->data['document_image_2']) &&
            !is_null($this->data['document_image_2']) &&
            $this->data['document_image_2'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $user->clearMediaCollection('document_2');
            $user
                ->addMedia($this->data['document_image_2']->getRealPath())
                ->usingName($this->data['document_image_2']->getClientOriginalName())
                ->toMediaCollection('document_2');
        }
        if(isset($this->data['document_image_3']) &&
            !is_null($this->data['document_image_3']) &&
            $this->data['document_image_3'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $user->clearMediaCollection('document_3');
            $user
                ->addMedia($this->data['document_image_3']->getRealPath())
                ->usingName($this->data['document_image_3']->getClientOriginalName())
                ->toMediaCollection('document_3');
        }
        if(isset($this->data['document_image_4']) &&
            !is_null($this->data['document_image_4']) &&
            $this->data['document_image_4'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $user->clearMediaCollection('document_4');
            $user
                ->addMedia($this->data['document_image_4']->getRealPath())
                ->usingName($this->data['document_image_4']->getClientOriginalName())
                ->toMediaCollection('document_4');
        }
        if(isset($this->data['document_image_5']) &&
            !is_null($this->data['document_image_5']) &&
            $this->data['document_image_5'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $user->clearMediaCollection('document_5');
            $user
                ->addMedia($this->data['document_image_5']->getRealPath())
                ->usingName($this->data['document_image_5']->getClientOriginalName())
                ->toMediaCollection('document_5');
        }
        if(isset($this->data['document_image_6']) &&
            !is_null($this->data['document_image_6']) &&
            $this->data['document_image_6'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $user->clearMediaCollection('document_6');
            $user
                ->addMedia($this->data['document_image_6']->getRealPath())
                ->usingName($this->data['document_image_6']->getClientOriginalName())
                ->toMediaCollection('document_6');
        }
        if(isset($this->data['document_image_7']) &&
            !is_null($this->data['document_image_7']) &&
            $this->data['document_image_7'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $user->clearMediaCollection('document_7');
            $user
                ->addMedia($this->data['document_image_7']->getRealPath())
                ->usingName($this->data['document_image_7']->getClientOriginalName())
                ->toMediaCollection('document_7');
        }
        if(isset($this->data['document_image_8']) &&
            !is_null($this->data['document_image_8']) &&
            $this->data['document_image_8'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $user->clearMediaCollection('document_8');
            $user
                ->addMedia($this->data['document_image_8']->getRealPath())
                ->usingName($this->data['document_image_8']->getClientOriginalName())
                ->toMediaCollection('document_8');
        }
    }

    public function deleteMedia($id, $collection)
    {
        Media::find($id)?->delete();
        $this->data[$collection] = null;
    }

    public function render()
    {
        $educations = EnumEducationTypes::getTranslatedAll();
        $courses = Course::active()->get();
        $initialLevels = EnumInitialLevels::getTranslatedAll();
        $militaryStatuses = EnumMilitaryStatus::getTranslatedAll();
        $roles = Role::get();
        $permissions = Permission::get();
        return view('livewire.admin.users.live-user-edit', compact('initialLevels', 'courses', 'educations', 'roles', 'permissions', 'militaryStatuses'));
    }
}
