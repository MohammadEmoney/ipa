<?php

namespace App\Livewire\Admin\Airlines;

use App\Models\Airline;
use App\Traits\AlertLiveComponent;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LiveAirlineCreate extends Component
{
    use AlertLiveComponent;

    public $title;
    public $airline;
    public $data = [];

    public function mount()
    {
        $this->title = __('global.create_airline');
        $this->data['is_active'] = true;
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
            DB::beginTransaction();
            $airline =  Airline::create([
                'title' => $this->data['title'],
                'title_en' =>  $this->data['title_en'],
                'description' => $this->data['description'] ?? null,
                'is_active' => $this->data['is_active'] ?? false,
            ]);
            DB::commit();
            $this->alert(__('messages.airline_created_successfully'))->success();
            return redirect()->to(route('admin.airlines.index'));
        } catch (Exception $e) {
            $this->alert($e->getMessage())->error();
        }
       
    }
    public function render()
    {
        return view('livewire.admin.airlines.live-airline-create')
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
