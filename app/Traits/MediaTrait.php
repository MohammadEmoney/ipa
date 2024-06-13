<?php

namespace App\Traits;

use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait MediaTrait
{
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

    public function createPostImage($post)
    {
        if(isset($this->data['mainImage']) &&
            !is_null($this->data['mainImage']) &&
            $this->data['mainImage'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $post->clearMediaCollection('mainImage');
            $post
                ->addMedia($this->data['mainImage']->getRealPath())
                ->usingName($this->data['mainImage']->getClientOriginalName())
                ->toMediaCollection('mainImage');
        }
    }
    
    public function createImage($model, $collection = "mainImage")
    {
        if(isset($this->data[$collection]) &&
            !is_null($this->data[$collection]) &&
            $this->data[$collection] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $model->clearMediaCollection($collection);
            $model
                ->addMedia($this->data[$collection]->getRealPath())
                ->usingName($this->data[$collection]->getClientOriginalName())
                ->toMediaCollection($collection);
        }
    }

    public function createDocument($model)
    {
        if(isset($this->data['documents']) &&
            !is_null($this->data['documents']) &&
            $this->data['documents'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $model->clearMediaCollection('documents');
            $model
                ->addMedia($this->data['documents']->getRealPath())
                ->usingName($this->data['documents']->getClientOriginalName())
                ->toMediaCollection('documents');
        }
    }

    public function createInstallmentDocument($model)
    {
        if(isset($this->installments['documents']) &&
            !is_null($this->installments['documents']) &&
            $this->installments['documents'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile
        ){
            $model->clearMediaCollection('documents');
            $model
                ->addMedia($this->installments['documents']->getRealPath())
                ->usingName($this->installments['documents']->getClientOriginalName())
                ->toMediaCollection('documents');
        }
    }

    public function deleteMedia($id, $collection)
    {
        Media::find($id)?->delete();
        $this->data[$collection] = null;
    }
}