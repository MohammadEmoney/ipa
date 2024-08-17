<?php

namespace App\Livewire\Admin\Pages;

use App\Enums\EnumLanguages;
use App\Models\Category;
use App\Models\Page;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class LivePageCreate extends Component
{
    use AlertLiveComponent;
    use MediaTrait;
    use WithFileUploads;

    public $title;
    public $page;
    public $data = [];

    public function mount()
    {
        $this->title = __('global.create_page');
    }

    public function validations()
    {
        $this->validate(
            [
                'data.lang' => 'required|in:' . EnumLanguages::asStringValues(),
                'data.title' => 'required|string|min:2|max:255',
                'data.slug' => 'required|unique:pages,slug',
                'data.description' => 'required|string',
            ],
            [],
            [
                'data.lang' => __('global.lang'),
                'data.title' => __('global.title'),
                'data.slug' => __('global.slug'),
                'data.description' =>__('global.description'),
            ]
        );
    }

    public function updated($field, $value)
    {
        if($field === 'data.title')
            $this->data['slug'] = Str::slug($value);
        $this->dispatch('select2Initiation');
        $this->validations();
    }

    public function submit()
    {
        $this->validations();
        if(!isset($this->data['mainImage']) ){
            return $this->addError('data.mainImage', __('messages.page_main_image_required'));
        }
        try {
            $page =  Page::create([
                'lang' => $this->data['lang'],
                'title' => $this->data['title'],
                'slug' =>  Str::slug($this->data['slug'] ?? ""),
                'description' => $this->data['description'] ?? null,
                'private_description' => $this->data['private_description'] ?? null,
                'is_active' => true,
                'created_by' => Auth::id(),
            ]);
            $this->createImage($page);
            $this->createImage($page, 'attachment');
            $this->alert(__('messages.page_created_successfully'))->success();
            return redirect()->to(route('admin.pages.index'));
        } catch (Exception $e) {
            $this->alert($e->getMessage())->error();
        }
       
    }

    public function render()
    {
        $langs = EnumLanguages::getTranslatedAll();
        return view('livewire.admin.pages.live-page-create', compact('langs'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
