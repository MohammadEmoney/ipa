<?php

namespace App\Livewire\Admin\GroupLayouts;

use App\Models\LayoutGroup;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveGroupLayoutEdit extends Component
{
    use AlertLiveComponent, WithFileUploads, MediaTrait;

    public $data = [];
    public $categories, $tags, $title;
    public $layoutGroup;

    public function mount(LayoutGroup $layoutGroup)
    {
        $this->load();
        $this->title = __('global.edit_group_layout');
        $this->layoutGroup = $layoutGroup;
    }

    public function load()
    {
        $this->data['is_active'] = $this->layoutGroup->is_active ? true : false;
        $this->data['lang'] = $this->layoutGroup->lang;
        $this->data['title'] = $this->layoutGroup->title;
        $this->data['tag'] = $this->layoutGroup->tag;
        $this->data['description'] = $this->layoutGroup->description;
        $this->data['count_list'] = $this->layoutGroup->count_list;

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


            $this->layoutGroup->update([
                'title' => $this->data['title'],
                'description' => $this->data['description'] ?? null,
                'tag' => $this->data['tag'] ?? '',
                'count_list' => $this->data['count_list'],
                'is_active' => $this->data['is_active'],
                'lang' => $this->data['lang'],
            ]);

            $this->createImage($this->layoutGroup);

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
        return view('livewire.admin.group-layouts.live-group-layout-edit')
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
