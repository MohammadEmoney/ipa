<?php

namespace App\Livewire\Admin\Categories;

use App\Enums\EnumLanguages;
use App\Models\Category;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveCategoryEdit extends Component
{
    use AlertLiveComponent;
    use MediaTrait;
    use WithFileUploads;

    public $title;
    public $category;
    public $data = [];

    public function mount(Category $category)
    {
        $this->title = __('global.edit_category');
        $this->data = [
            'lang' => $category->lang,
            'title' => $category->title,
            'slug' => $category->slug,
            'parent_id' => $category->parent_id,
            'description' => $category->description,
        ];
        $this->data['mainImage'] = $category->getFirstMedia('mainImage');
    }

    public function validations()
    {
        $this->validate(
            [
                'data.lang' => 'required|in:' . EnumLanguages::asStringValues(),
                'data.title' => 'required|string|min:2|max:255',
                'data.slug' => 'required|unique:categories,slug,' . $this->category->id,
                'data.parent_id' => 'nullable|exists:categories,id',
                'data.description' => 'required|string',
            ],
            [],
            [
                'data.lang' => __('global.lang'),
                'data.title' => __('global.title'),
                'data.slug' => __('global.slug'),
                'data.parent_id' => __('global.parent_category'),
                'data.description' =>__('global.description'),
            ]
        );
    }

    public function updated($field, $value)
    {
        if($field === 'data.title')
            $this->data['slug'] = Str::slug($value);
        $this->validations();
    }

    public function submit()
    {
        $this->validations();
        $this->category->update([
            'lang' => $this->data['lang'],
            'title' => $this->data['title'],
            'slug' => $this->data['slug'],
            'parent_id' => $this->data['parent_id'] ?? 0,
            'description' => $this->data['description'] ?? null,
        ]);

        $this->createImage($this->category);
        $this->alert(__('messages.category_created_successfully'))->success();
        return redirect()->to(route('admin.categories.index'));
    }
    
    public function render()
    {
        $categories = Category::query()->select('title', 'id')->get()->except([$this->category->id]);
        $langs = EnumLanguages::getTranslatedAll();
        return view('livewire.admin.categories.live-category-edit', compact('categories', 'langs'))
            ->extends('layouts.admin-panel')->section('content');
    }
}
