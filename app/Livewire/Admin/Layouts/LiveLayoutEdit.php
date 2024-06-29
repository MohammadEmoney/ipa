<?php

namespace App\Livewire\Admin\Layouts;

use App\Enums\EnumLayoutFilter;
use App\Enums\EnumLayoutLinkType;
use App\Enums\EnumLayoutReleaseType;
use App\Enums\EnumLayoutType;
use App\Models\Category;
use App\Models\Layout;
use App\Models\LayoutGroup;
use App\Models\Page;
use App\Models\Post;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Morilog\Jalali\CalendarUtils;

class LiveLayoutEdit extends Component
{
    use WithFileUploads, MediaTrait, AlertLiveComponent;

    public string $title;

    public $data = [];
    public $layoutGroup;
    public $layout;

    public function mount(LayoutGroup $layoutGroup, Layout $layout)
    {
        $this->layoutGroup = $layoutGroup;
        $this->layout = $layout;
        $this->title = __('global.edit_layout');
        $this->load();
    }

    public function load()
    {
        $this->data['title'] = $this->layout->title;
        $this->data['parent_id'] = $this->layout->parent_id;
        $this->data['description'] = $this->layout->description;
        $this->data['icon'] = $this->layout->icon;
        $this->data['is_active'] = $this->layout->is_active ? true : false;
        $this->data['type'] = $this->layout->type;
        $this->data['lang'] =  $this->layout->lang;
        $this->data['priority'] =  $this->layout->priority;
        $this->data['link_type'] =  $this->layout->link_type;
        $this->data['filter'] =  $this->layout->filter;
        $this->data['release_type'] =  $this->layout->release_type;
        $this->data['start_date_release'] =  $this->layout->start_date_release;
        $this->data['end_date_release'] =  $this->layout->end_date_release;
        $this->data['count_list'] =  $this->layout->count_list;
        $this->data['tag'] =  $this->layout->tag;
        $this->data['data'] = $this->layout?->data;
        $this->data['filter'] = '';
        $this->data['mainImage'] = $this->layout->getFirstMedia('mainImage');
        switch ($this->data['type']) {
            case EnumLayoutType::MENU:
            case EnumLayoutType::SLIDER:
                $this->data['link_type'] = $this->data['data']['select_item'];
                $this->data['layoutable_value'] = $this->data['data']['select_id'];
                break;
            default:
                $this->data['filter'] = $this->data['data']['select_item'];
                if ($this->data['filter'] == EnumLayoutFilter::CATEGORY) {
                    $this->data['category'] = $this->data['data']['select_id'];
                } elseif ($this->data['filter'] == EnumLayoutFilter::SELECT) {
                    $this->data['post'] = $this->data['data']['select_id'];
                }
                break;
        }
        // $this->completedFrom();
    }

    public function completedFrom()
    {
        $this->data['title'] = 'اسلایدر بالای سایت';
        $this->data['icon'] = 'fa fa-facebook';
        $this->data['description'] = 'توضیحات اسلایدر';
        $this->data['type'] = EnumLayoutType::MENU;
        $this->data['link_type'] = EnumLayoutLinkType::CATEGORY;
        $this->data['release_type'] = EnumLayoutReleaseType::DATE;
        $this->data['start_date_release'] = '1403/04/11 10:10';
        $this->data['end_date_release'] = '1403/04/15 23:50';
        $this->data['priority'] = 0;
        $this->data['is_active'] = 1;
    }

    public function submit()
    {
        try {
            $data = Validator::make($this->data, [
                'parent_id' => 'nullable|exists:layouts,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|min:2|max:32000',
                'tag' => 'nullable|string|max:255',
                'type' => 'required|in:' . EnumLayoutType::asStringValues(),
                'release_type' => 'required|in:' . EnumLayoutReleaseType::asStringValues(),
                'priority' => 'required|numeric|min:0|max:10000',
                'is_active' =>  'required|boolean',
                'count_list' => ['nullable', 'min:0'],
                'icon' => 'nullable|string|max:255',
            ]);

            if ($data->fails()) {
                $this->alert($data->errors()->first())->error();
                return false;
            }

            $dta = [];
            switch ($this->data['type']) {
                case EnumLayoutType::SLIDER:
                case EnumLayoutType::MENU:
                    if (empty($this->data['link_type'])) {
                        $this->alert(__('messages.select_link_type'))->error();
                        return false;
                    }
                    if ($this->data['link_type'] == EnumLayoutLinkType::STATIC && empty($this->data['layoutable_value'])) {
                        $this->alert(__('messages.select_link_address'))->error();
                        return false;
                    }
                    if ($this->data['link_type'] == EnumLayoutLinkType::PAGE && empty($this->data['layoutable_value'])) {
                        $this->alert(__('messages.select_page'))->error();
                        return false;
                    }
                    if ($this->data['link_type'] == EnumLayoutLinkType::CATEGORY && empty($this->data['layoutable_value'])) {
                        $this->alert(__('messages.select_category'))->error();
                        return false;
                    }
                    if ($this->data['link_type'] == EnumLayoutLinkType::TAG && empty($this->data['layoutable_value'])) {
                        $this->alert(__('messages.select_tag'))->error();
                        return false;
                    }
                    break;
                default:
                    if (empty($this->data['filter'])) {
                        $this->alert(__('messages.select_display_filter'))->error();
                        return false;
                    }
                    if ($this->data['filter'] == EnumLayoutFilter::CATEGORY && empty($this->data['category'])) {
                        $this->alert(__('messages.select_category'))->error();
                        return false;
                    }
                    // if ($this->data['filter'] == EnumLayoutFilter::TAG && empty($this->data['tag'])) {
                    //     $this->alert(__('messages.select_tag'))->error();
                    //     return false;
                    // }
                    break;
            }

            $dataItem['select_item'] = $this->data['filter'] != '' ? $this->data['filter'] : $this->data['link_type'];
            if ($this->data['filter'] != '') {
                if ($this->data['post'] != '') {
                    $dataItem['select_id'] = $this->data['post'];
                } elseif ($this->data['category'] != '') {
                    $dataItem['select_id'] = $this->data['category'];
                } else {
                    $dataItem['select_id'] = '';
                }
            } elseif ($this->data['link_type'] != '') {
                $dataItem['select_id'] = $this->data['layoutable_value'];
            }


            if ($this->data['release_type'] == EnumLayoutReleaseType::DATE) {
                if (empty($this->data['start_date_release'])) {
                    $this->alert(__('messages.enter_start_date'))->error();
                    return false;
                }
                if (empty($this->data['end_date_release'])) {
                    $this->alert(__('messages.enter_end_date'))->error();
                    return false;
                }
                $dta['start_date_release'] = CalendarUtils::createDatetimeFromFormat('Y/m/d H:i', ($this->data['start_date_release'] ?? ''))->format('Y/m/d H:i:s');
                $dta['end_date_release'] = CalendarUtils::createDatetimeFromFormat('Y/m/d H:i', ($this->data['end_date_release'] ?? ''))->format('Y/m/d H:i:s');
            }

            DB::beginTransaction();

            $dta = array_merge([
                'parent_id' => $this->data['parent_id'] ?? null,
                'layout_group_id' => $this->layoutGroup->id,
                'title' => $this->data['title'],
                'description' => $this->data['description'] ?? null,
                'tag' => $this->data['taggable'] ?? '',
                'type' => $this->data['type'],
                'lang' => $this->data['lang'],
                'data' => $dataItem,
                'release_type' => $this->data['release_type'] ?? '',
                'priority' => $this->data['priority'] ?? '',
                'is_active' => $this->data['is_active'],
                'count_list' => (!empty($this->data['count_list']) ? $this->data['count_list'] : null),
                'icon' => $this->data['icon'] ?? null,
            ], $dta);

            $layout = $this->layout->update($dta);
            $this->createImage($this->layout);

            $this->alert(__('messages.layout_created_successfully'))->success()->autoClose()->redirect('admin.layouts.index', ['layoutGroup' => $this->layoutGroup]);
            DB::commit();
            return redirect()->to(route('admin.layouts.index', ['layoutGroup' => $this->layoutGroup->id]));

        } catch (\Exception $exception) {
            DB::rollBack();
            $this->alert($exception->getMessage())->error()->reload();
        }
    }

    public function updateddataType($value)
    {
        $this->data['filter'] = '';
        $this->data['tag'] = '';
        $this->data['category'] = '';
        $this->data['link_type'] = '';
        $this->data['layoutable_value'] = '';
    }

    public function updateddataFilter($value)
    {
        $this->data['tag'] = '';
        $this->data['category'] = '';
    }

    public function updateddataLinkType($value)
    {
        $this->data['layoutable_value'] = '';
    }

    public function render()
    {
        $categories = Category::query()->lang()->active()->get();
        // $tags = Tag::query()->language()->get();
        $posts = Post::query()->lang()->get();
        $pages = Page::query()->lang()->get();
        $layouts = Layout::query()->lang()->get();
        return view('livewire.admin.layouts.live-layout-edit', compact('categories', 'pages', 'layouts', 'posts'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
