<?php

namespace App\Livewire\Admin\Documents;

use App\Enums\EnumLanguages;
use App\Models\Document;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveDocumentEdit extends Component
{
    use AlertLiveComponent;
    use MediaTrait;
    use WithFileUploads;

    public $title;
    public $document;
    public $data = [];

    public function mount(Document $document)
    {
        $this->title = __('global.edit_document');
        $this->document = $document;
        $this->data = [
            'lang' => $document->lang,
            'title' => $document->title,
            'slug' => $document->slug,
            'description' => $document->description,
        ];
        $this->data['attachment'] = $document->getFirstMedia('attachment');
    }

    public function download()
    {
        $document = $this->document;
        if($document->getFirstMedia('attachment'))
            return $document->getFirstMedia('attachment');
        $this->alert(__('messages.file_not_exists'))->error();
    }

    public function validations()
    {
        $this->validate(
            [
                'data.lang' => 'required|in:' . EnumLanguages::asStringValues(),
                'data.title' => 'required|string|min:2|max:255',
                'data.slug' => 'required|unique:documents,slug,' . $this->document->id,
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
            $this->document->update([
                'lang' => $this->data['lang'],
                'title' => $this->data['title'],
                'slug' =>  Str::slug($this->data['slug'] ?? ""),
                'description' => $this->data['description'] ?? null,
                'updated_by' => Auth::id(),
            ]);

            $this->createImage($this->document, 'attachment');
            $this->alert(__('messages.document_created_successfully'))->success();
            return redirect()->to(route('admin.documents.index'));
        } catch (Exception $e) {
            $this->alert($e->getMessage())->error();
        }
       
    }

    public function render()
    {
        $langs = EnumLanguages::getTranslatedAll();
        return view('livewire.admin.documents.live-document-edit', compact('langs'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
