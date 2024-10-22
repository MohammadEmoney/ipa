<?php

namespace App\Livewire\Admin\Members;

use App\Enums\EnumLanguages;
use App\Enums\EnumMemberRoles;
use App\Enums\EnumMemberSituation;
use App\Enums\EnumSocialNetworks;
use App\Models\Airline;
use App\Models\Member;
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

class LiveMemberEdit extends Component
{
    use AlertLiveComponent;
    use WithFileUploads;
    use DateTrait;
    use MediaTrait;

    public $edit = true;
    public $data = [];
    public $editPage = true;
    public $firstname;
    public $member;
    public $title;
    public $highestCode;
    public $currentTab = 'student';
    public $disabledCreate = true;
    public $disabledEdit = true;
    public $selectedAll = false;
    public $allFalsePermissions = [];
    public $allTruePermissions = [];
    public $allAssignedPermissions = [];

    public function mount(Member $member)
    {
        $this->member = $member;
        $this->title = __('global.edit_member');
        $this->loadData();
    }

    public function loadData()
    {
        $this->data['is_active'] = $this->member->is_active ? true : false;
        $this->data['first_name'] = $this->member->first_name;
        $this->data['last_name'] = $this->member->last_name;
        $this->data['phone'] = $this->member->phone;
        $this->data['title'] = $this->member->title;
        $this->data['email'] = $this->member->email;
        $this->data['lang'] = $this->member->lang;
        $this->data['description'] = $this->member->description;
        $this->data['socials'] = $this->member->social;

        $this->data['avatar'] = $this->member->getFirstMedia('avatar');
    }

    public function addSocial()
    {
        $this->data['socials'][] = [
            'social' => '',
            'link' => '',
        ];
    }

    public function removeSocial($index)
    {
        unset($this->data['socials'][$index]);
        $this->data['socials'] = array_values($this->data['socials']); // Re-index the array
    }

    public function validations()
    {
        $this->validate([
            'data.first_name' => 'required|string|max:255',
            'data.last_name' => 'required|string|max:255',
            'data.title' => 'nullable|string|max:255',
            'data.social' => 'nullable|array|max:255',
            'data.description' => 'nullable|string|max:2550',
            'data.email' => 'nullable|email|max:255',
            'data.lang' => 'nullable|in:' . EnumLanguages::asStringValues(),
        ],[],
        [
            'data.lang' => __('global.lang'),
            'data.first_name' => __('global.first_name'),
            'data.last_name' => __('global.last_name'),
            'data.email' =>  __('global.email'),
            'data.title' =>  __('global.title'),
            'data.description' =>  __('global.description'),
            'data.phone' => __('global.phone_number'),
            'data.social' => __('global.socials'),
            'data.avatar' => __('global.upload_image'),
        ]);
    }

    public function submit()
    {
        try {
            $this->authorize('member_edit');
            $this->validations();
            DB::beginTransaction();
            $member = $this->member;
            $member->update([
                'first_name' => $this->data['first_name'] ?? null,
                'last_name' => $this->data['last_name'] ?? null,
                'email' => $this->data['email'] ?? null,
                'phone' => $this->data['phone'] ?? null,
                'title' => $this->data['title'] ?? null,
                'lang' => $this->data['lang'] ?? 'fa',
                'description' => $this->data['description'] ?? null,
                'social' => $this->data['socials'] ?? [],
            ]);

            
            $this->createImage($member, 'avatar');
            DB::commit();
            $this->alert(__('messages.member_updated_successfully'))->success();
            return redirect()->to(route('admin.members.index'));
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
        $langs = EnumLanguages::getTranslatedAll();
        $socials = EnumSocialNetworks::getTranslatedAll();
        return view('livewire.admin.members.live-member-edit', compact('langs', 'socials'))->extends(('layouts.admin-panel'))->section('content');
    }
}
