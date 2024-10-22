<?php

namespace App\Livewire\Admin\Members;

use App\Enums\EnumLanguages;
use App\Enums\EnumSocialNetworks;
use App\Models\Member;
use App\Traits\AlertLiveComponent;
use App\Traits\DateTrait;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveMemberCreate extends Component
{
    use AlertLiveComponent;
    use WithFileUploads;
    use DateTrait;
    use MediaTrait;

    public $edit = false;
    public $title;
    public $data = [];
    public $firstname;
    public $member;
    public $highestCode;
    public $disabledCreate = true;
    public $disabledEdit = true;

    public function mount()
    {
        $this->title = __('global.create_member');
        $this->data['socials'] = [];
        $this->data['lang'] = EnumLanguages::FARSI;
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
            'data.avatar' => 'nullable|image|max:2048',
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
            // dd($this->data);
            $this->authorize('member_create');
            $this->validations();

            DB::beginTransaction();

            $this->member = $member = Member::create([
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
            $this->alert(__('messages.member_created_successfully'))->success();
            return redirect()->to(route('admin.members.index'));   
        } catch (\Exception $e) {
            $this->alert($e->getMessage())->error();
        }
    }

    public function render()
    {
        $langs = EnumLanguages::getTranslatedAll();
        $socials = EnumSocialNetworks::getTranslatedAll();
        return view('livewire.admin.members.live-member-create', compact('langs', 'socials'))->extends('layouts.admin-panel')->section('content');
    }
}
