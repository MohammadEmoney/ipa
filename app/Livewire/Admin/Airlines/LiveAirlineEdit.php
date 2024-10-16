<?php

namespace App\Livewire\Admin\Airlines;

use App\Enums\EnumLanguages;
use App\Models\Airline;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveAirlineEdit extends Component
{
    use AlertLiveComponent;
    use MediaTrait;
    use WithFileUploads;

    public $title;
    public $airline;
    public $data = [];

    public function mount(Airline $airline)
    {
        $this->title = __('global.edit_airline');
        $this->airline = $airline;
        $this->data = [
            'title' => $airline->title,
            'title_en' => $airline->title_en,
            'is_active' => $airline->is_active ? true : false,
            'description' => $airline->description,
        ];
    }

    public function validations()
    {
        $this->validate(
            [
                'data.title' => 'required|string|min:2|max:255',
                'data.title_en' => 'required|string|min:2|max:255',
                'data.description' => 'nullable|string',
                'data.is_active' => 'nullable|boolean',
            ],
            [],
            [
                'data.title_en' => __('global.title_en'),
                'data.title' => __('global.title'),
                'data.is_active' => __('global.is_active'),
                'data.description' =>__('global.description'),
            ]
        );
    }

    public function updated($field, $value)
    {
        $this->validations();
    }

    public function submit()
    {
        $this->validations();
        try {
            $this->airline->update([
                'title' => $this->data['title'],
                'title_en' =>  $this->data['title_en'],
                'description' => $this->data['description'] ?? null,
                'is_active' => $this->data['is_active'] ?? false,
            ]);
            $this->alert(__('messages.airline_updated_successfully'))->success();
            return redirect()->to(route('admin.airlines.index'));
        } catch (Exception $e) {
            $this->alert($e->getMessage())->error();
        }
       
    }

    public function render()
    {
        return view('livewire.admin.airlines.live-airline-edit')
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
