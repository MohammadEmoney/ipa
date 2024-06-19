<?php

namespace App\Livewire\Admin\Users;

use App\Enums\EnumCourseTypes;
use App\Enums\EnumEducationTypes;
use App\Enums\EnumInitialLevels;
use App\Enums\EnumMilitaryStatus;
use App\Enums\EnumUserRoles;
use App\Enums\EnumUserType;
use App\Models\Course;
use App\Models\User;
use App\Rules\JDate;
use App\Rules\ValidNationalCode;
use App\Traits\AlertLiveComponent;
use App\Traits\DateTrait;
use App\Traits\JobsTrait;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LiveUserCreate extends Component
{
    use AlertLiveComponent;
    use WithFileUploads;
    use DateTrait;
    use MediaTrait;

    public $edit = false;
    public $title;
    public $data = [];
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
        $this->title = __('global.create_user');
        $permissions = Permission::all();
        $this->allFalsePermissions = $permissions->pluck('id', 'id')->map(function ($item) {
            return false;
        })->toArray();
        $this->allTruePermissions = $permissions->pluck('id', 'id')->map(function ($item) {
            return true;
        })->toArray();
        $this->data['direct_permissions'] = $this->allFalsePermissions;

        $this->data['gender'] = \App\Enums\EnumUserGender::MALE;
    }

    public function selectAll()
    {
        if(isset($this->data['direct_permissions']) && $this->selectedAll){
            $this->data['direct_permissions'] = $this->allTruePermissions;
        }else{
            $this->data['direct_permissions'] = $this->allFalsePermissions;
        }
    }

    public function validations()
    {
        $this->validate([
            'data.first_name' => 'required|string|max:255',
            'data.last_name' => 'required|string|max:255',
            // 'data.landline_phone' => 'nullable|regex:/^0[0-9]{10}$/',
            // 'data.phone_1' => 'required|regex:/^09[0-9]{9}$/|unique:users,phone',
            // 'data.phone_2' => 'required|regex:/^09[0-9]{9}$/',
            'data.address' => 'nullable|string|max:2550',
            // 'data.job' => 'nullable|string|max:255',
            // 'data.education' => 'nullable|string|max:255',
            'data.email' => 'required|email|max:255|unique:users,email',
            'data.password' => 'required|confirmed|min:8|max:255',
            // 'data.gender' => 'required|in:male,female|max:255',
            'data.avatar' => 'nullable|image|max:2048',
            'data.role' =>  'required|exists:roles,name',
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
        ]);
    }

    public function submit()
    {
        $this->authorize('user_create');
        $this->validations();

        DB::beginTransaction();

        $this->user = $user = User::create([
            'first_name' => $this->data['first_name'] ?? null,
            'last_name' => $this->data['last_name'] ?? null,
            'email' => $this->data['email'] ?? null,
            'phone' => $this->data['phone'] ?? null,
            'password' => isset($this->data['password']) ? Hash::make($this->data['password']) : null,
        ]);

        $user->userInfo()->create([
            'national_code' => $this->data['national_code'] ?? null,
            'birth_date' => isset($this->data['birth_date']) ? $this->convertToGeorgianDate($this->data['birth_date']) : null,
            'landline_phone' => $this->data['landline_phone'] ?? null,
            'phone_1' => $this->data['phone_1'] ?? null,
            'phone_2' => $this->data['phone_2'] ?? null,
            'address' => $this->data['address'] ?? null,
            'job_title' => $this->data['job_title'] ?? null,
            'company_name' => $this->data['company_name'] ?? null,
            'company_phone' => $this->data['company_phone'] ?? null,
            'company_address' => $this->data['company_address'] ?? null,
            'education' => $this->data['education'] ?? null,
        ]);

        $this->createImage($user, 'avatar');

        $user->assignRole($this->data['role'] ?? EnumUserRoles::TEACHER);
        $selectedPermissions = collect($this->data['direct_permissions'])->map(function($value, $key){
            if($value)
                return $key;
        })->filter();
        $permissions = Permission::whereIn('id', $selectedPermissions)->pluck('name');
        $user->givePermissionTo($permissions);
        DB::commit();
        $this->alert(__('messages.user_created_successfully'))->success();
        return redirect()->to(route('admin.users.index'));
    }

    public function render()
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('livewire.admin.users.live-user-create', compact('roles', 'permissions'))->extends('layouts.admin-panel')->section('content');
    }
}
