<?php

namespace App\Livewire\Admin\Users;

use App\Enums\EnumUserRoles;
use App\Enums\EnumUserSituation;
use App\Models\Airline;
use App\Models\User;
use App\Traits\AlertLiveComponent;
use App\Traits\DateTrait;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\DB;
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
    use MediaTrait;

    public $edit = true;
    public $data = [];
    public $editPage = true;
    public $firstname;
    public $user;
    public $title;
    public $highestCode;
    public $currentTab = 'student';
    public $disabledCreate = true;
    public $disabledEdit = true;
    public $selectedAll = false;
    public $allFalsePermissions = [];
    public $allTruePermissions = [];
    public $allAssignedPermissions = [];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->title = __('global.edit_user');
        $highestCode = User::max('code');
        $this->highestCode = $highestCode ? $highestCode + 1 : 1101;
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
        $this->data['is_active'] = $this->user->is_active ? true : false;
        $this->data['first_name'] = $this->user->first_name;
        $this->data['last_name'] = $this->user->last_name;
        $this->data['phone'] = $this->user->phone;
        $this->data['phone_verified_at'] = $this->user->phone_verified_at;
        $this->data['email_verified_at'] = $this->user->email_verified_at;
        $this->data['code'] = $this->user->code;
        $this->data['national_code'] = $this->user->userInfo?->national_code;
        // $this->data['birth_date'] = Jalalian::fromDateTime($this->user->userInfo?->birth_date)->format('Y-m-d');
        $this->data['landline_phone'] = $this->user->userInfo?->landline_phone;
        $this->data['phone_1'] = $this->user->userInfo?->phone_1;
        $this->data['phone_2'] = $this->user->userInfo?->phone_2;
        $this->data['address'] = $this->user->userInfo?->address;
        $this->data['job_title'] = $this->user->userInfo?->job_title;
        $this->data['education'] = $this->user->userInfo?->education;
        $this->data['email'] = $this->user->email;
        $this->data['company_name'] = $this->user->userInfo?->company_name;
        $this->data['compnay_address'] = $this->user->userInfo?->compnay_address;
        $this->data['compnay_phone'] = $this->user->userInfo?->compnay_phone;
        $this->data['situation'] = $this->user->userInfo?->situation;
        $this->data['university'] = $this->user->userInfo?->university;
        $this->data['airline_id'] = $this->user->userInfo?->airline_id;

        $this->data['avatar'] = $this->user->getFirstMedia('avatar');
        $this->data['nationalCard'] = $this->user->getFirstMedia('nationalCard');
        $this->data['license'] = $this->user->getFirstMedia('license');
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
            'data.email' => 'nullable|email|max:255|unique:users,email,' . $this->user->id,
            'data.code' => 'nullable|integer|max:999999|unique:users,code,' . $this->user->id,
            'data.password' => 'nullable|confirmed|min:8|max:255',
            // 'data.gender' => 'required|in:male,female|max:255',
            // 'data.avatar' => 'nullable|image|max:2048',
            'data.role' =>  'required|exists:roles,name',
            'data.situation' => 'required|in:' . EnumUserSituation::asStringValues(),
            'data.university' => 'required_if:situation,' . EnumUserSituation::STUDENT,
            // 'data.company_name' => 'required_if:situation,' . EnumUserSituation::EMPLOYED,
            'data.airline_id' => ['required_if:situation,' . EnumUserSituation::EMPLOYED, 'exists:airlines,id'],
        ],[],
        [
            'data.father_name' => 'نام پدر',
            'data.birth_date' => 'تاریخ تولد',
            'data.national_code' => 'کد ملی',
            'data.code' => 'کد',
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
            'data.airline_id' => __('global.company_name'),
        ]);
    }

    public function submit()
    {
        try {
            $this->authorize('user_edit');
            $this->validations();
            DB::beginTransaction();
            $user = $this->user;
            $user->update([
                'first_name' => $this->data['first_name'] ?? null,
                'last_name' => $this->data['last_name'] ?? null,
                'email' => $this->data['email'] ?? null,
                'phone' => $this->data['phone'] ?? null,
                'code' => $this->data['code'] ?? null,
            ]);

            if(isset($this->data['password']))
                $user->update(['password' => Hash::make($this->data['password'])]);

            $airline = Airline::find($this->data['airline_id'] ?? null);
            $user->userInfo()->update([
                'national_code' => $this->data['national_code'] ?? null,
                'birth_date' => isset($this->data['birth_date']) ? $this->convertToGeorgianDate($this->data['birth_date']) : null,
                'landline_phone' => $this->data['landline_phone'] ?? null,
                'phone_1' => $this->data['phone_1'] ?? null,
                'phone_2' => $this->data['phone_2'] ?? null,
                'address' => $this->data['address'] ?? null,
                'job_title' => $this->data['job_title'] ?? null,
                'company_name' => $airline->title ?? null,
                'company_phone' => $this->data['company_phone'] ?? null,
                'company_address' => $this->data['company_address'] ?? null,
                'education' => $this->data['education'] ?? null,
                'situation' => $this->data['situation'] ?? null,
                'university' => $this->data['university'] ?? null,
                'airline_id' => $this->data['airline_id'] ?? null
            ]);

            $this->createImage($user, 'avatar');
            $this->createImage($user, 'nationalCode');
            $this->createImage($user, 'license');

            $user->syncRoles($this->data['role'] ?? EnumUserRoles::USER);
            $selectedPermissions = collect($this->data['direct_permissions'])->map(function($value, $key){
                if($value)
                    return $key;
            })->filter();
            $permissions = Permission::whereIn('id', $selectedPermissions)->pluck('name');
            $user->syncPermissions($permissions);
            DB::commit();
            $this->alert(__('messages.user_updated_successfully'))->success();
            return redirect()->to(route('admin.users.index'));
        } catch (\Exception $e) {
            $this->alert($e->getMessage())->error();
        }
    }

    public function deleteMedia($id, $collection)
    {
        Media::find($id)?->delete();
        $this->data[$collection] = null;
    }

    public function render()
    {
        $roles = Role::get();
        $permissions = Permission::get();
        $airlines = Airline::active()->get();
        $situations = EnumUserSituation::getTranslatedAll();
        return view('livewire.admin.users.live-user-edit', compact('roles', 'permissions', 'situations', 'airlines'))->extends(('layouts.admin-panel'))->section('content');
    }
}
