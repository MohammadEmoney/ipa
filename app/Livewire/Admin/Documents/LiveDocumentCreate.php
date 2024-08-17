<?php

namespace App\Livewire\Admin\Documents;

use App\Models\Document;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use App\Enums\EnumLanguages;
use App\Traits\MediaTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class LiveDocumentCreate extends Component
{
    use AlertLiveComponent;
    use MediaTrait;
    use WithFileUploads;

    public $title;
    public $document;
    public $data = [];

    public function mount()
    {
        $this->title = __('global.create_document');
    }

    public function validations()
    {
        $this->validate(
            [
                'data.lang' => 'nullable|in:' . EnumLanguages::asStringValues(),
                'data.title' => 'required|string|min:2|max:255',
                'data.slug' => 'required|unique:documents,slug',
                'data.description' => 'nullable|string',
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
        if(!isset($this->data['attachment']) ){
            return $this->addError('data.attachment', __('messages.document_main_image_required'));
        }
        try {
            DB::beginTransaction();
            $document =  Document::create([
                'lang' => $this->data['lang'] ?? app()->getLocale(),
                'title' => $this->data['title'],
                'slug' =>  Str::slug($this->data['slug'] ?? ""),
                'description' => $this->data['description'] ?? null,
                'is_active' => true,
                'created_by' => Auth::id(),
            ]);
            $this->createImage($document, 'attachment');
            DB::commit();
            $this->alert(__('messages.document_created_successfully'))->success();
            return redirect()->to(route('admin.documents.index'));
        } catch (Exception $e) {
            $this->alert($e->getMessage())->error();
        }
       
    }

    public function render()
    {
        $langs = EnumLanguages::getTranslatedAll();
        return view('livewire.admin.documents.live-document-create', compact('langs'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
