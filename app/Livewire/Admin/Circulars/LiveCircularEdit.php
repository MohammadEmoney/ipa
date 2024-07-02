<?php

namespace App\Livewire\Admin\Circulars;

use App\Enums\EnumLanguages;
use App\Models\Circular;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveCircularEdit extends Component
{
    use AlertLiveComponent;
    use MediaTrait;
    use WithFileUploads;

    public $title;
    public $circular;
    public $data = [];

    public function mount(Circular $circular)
    {
        $this->title = __('global.edit_circular');
        $this->circular = $circular;
        $this->data = [
            'lang' => $circular->lang,
            'title' => $circular->title,
            'slug' => $circular->slug,
            'description' => $circular->description,
        ];
        $this->data['attachment'] = $circular->getFirstMedia('attachment');
        $this->data['mainImage'] = $circular->getFirstMedia('mainImage');
    }

    public function download()
    {
        $circular = $this->circular;
        if($circular->getFirstMedia('attachment'))
            return $circular->getFirstMedia('attachment');
        $this->alert(__('messages.file_not_exists'))->error();
    }

    public function validations()
    {
        $this->validate(
            [
                'data.lang' => 'required|in:' . EnumLanguages::asStringValues(),
                'data.title' => 'required|string|min:2|max:255',
                'data.slug' => 'required|unique:circulars,slug,' . $this->circular->id,
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
        // $this->dispatch('ckeditorInitiation');
        Log::info('test');
        $this->validations();
    }

    public function submit()
    {
        $this->validations();
        if(!isset($this->data['attachment']) ){
            return $this->addError('data.attachment', __('messages.post_main_image_required'));
        }
        try {
            $this->circular->update([
                'lang' => $this->data['lang'],
                'title' => $this->data['title'],
                'slug' =>  Str::slug($this->data['slug'] ?? ""),
                'description' => $this->data['description'] ?? null,
                'updated_by' => Auth::id(),
            ]);

            $this->createImage($this->circular, 'attachment');
            $this->createImage($this->circular);
            $this->alert(__('messages.circular_created_successfully'))->success();
            return redirect()->to(route('admin.circulars.index'));
        } catch (Exception $e) {
            $this->alert($e->getMessage())->error();
        }
       
    }

    public function render()
    {
        $langs = EnumLanguages::getTranslatedAll();
        return view('livewire.admin.circulars.live-circular-edit', compact('langs'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
