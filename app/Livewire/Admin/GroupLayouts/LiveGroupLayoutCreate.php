<?php

namespace App\Livewire\Admin\GroupLayouts;

use App\Models\LayoutGroup;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveGroupLayoutCreate extends Component
{
    use AlertLiveComponent, WithFileUploads, MediaTrait;

    public $data = [];
    public $categories, $tags, $title;

    public function mount()
    {
        $this->load();
        $this->title = __('global.create_group_layout');
    }

    public function load()
    {
        $this->data['is_active'] = 1;
        $this->data['lang'] = app()->getLocale();

        // $this->completedFrom();
    }

    public function completedFrom()
    {
        $this->data['title'] = 'اسلایدر بالای سایت';
        $this->data['description'] = 'توضیحات اسلایدر';
        $this->data['count_list'] = 2;
        $this->data['is_active'] = 1;
        
    }

    public function submit()
    {
        $image = '';
        try {
            $data = Validator::make($this->data, [
                'title' => 'required|string|min:2|max:255',
                'tag' => 'required|string|max:255',
                'description' => 'nullable|string|min:2|max:32000',
                'count_list' => 'required|numeric|max:999',
                'is_active' => 'required|boolean',
                // 'image' => 'nullable|mimes:png,jpeg|max:512',
            ]);

            if ($data->fails()) {
                $this->alert($data->errors()->first())->error();
                return false;
            }
            DB::beginTransaction();


            $layoutGroup = LayoutGroup::query()->create([
                'title' => $this->data['title'],
                'description' => $this->data['description'] ?? null,
                'tag' => $this->data['tag'] ?? '',
                'count_list' => $this->data['count_list'],
                'is_active' => $this->data['is_active'],
                'lang' => $this->data['lang'],
            ]);

            $this->createImage($layoutGroup);

            $this->alert(__('messages.group_layout_created_successfully'))->success()->autoClose();
            DB::commit();
            return redirect()->to(route('admin.group-layouts.index'));

        } catch (\Exception $exception) {
            DB::rollBack();
            $this->alert($exception->getMessage())->error()->reload();
        }
    }

    public function render()
    {
        return view('livewire.admin.group-layouts.live-group-layout-create')
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
