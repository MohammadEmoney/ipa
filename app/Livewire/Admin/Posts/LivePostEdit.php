<?php

namespace App\Livewire\Admin\Posts;

use App\Enums\EnumLanguages;
use App\Models\Category;
use App\Models\Post;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class LivePostEdit extends Component
{
    use AlertLiveComponent;
    use MediaTrait;
    use WithFileUploads;

    public $title;
    public $post;
    public $data = [];

    public function mount(Post $post)
    {
        $this->title = __('global.edit_post');
        $this->post = $post;
        $this->data = [
            'lang' => $post->lang,
            'title' => $post->title,
            'slug' => $post->slug,
            'summary' => $post->summary,
            'description' => $post->description,
            'is_active' => $post->is_active ? true : false,
            'is_private' => $post->is_private ? true : false,
            'category_id' => $post->mainCategory?->first()?->id,
            'categories' => $post->categories->pluck('id')->toArray(),
        ];
        // dd($this->data);
        $this->data['mainImage'] = $post->getFirstMedia('mainImage');
    }

    public function validations()
    {
        $this->validate(
            [
                'data.lang' => 'required|in:' . EnumLanguages::asStringValues(),
                'data.title' => 'required|string|min:2|max:255',
                'data.slug' => 'required|unique:posts,slug,' . $this->post->id,
                'data.category_id' => 'required|exists:categories,id',
                'data.categories' => 'nullable|array',
                'data.categories.*' => 'required|exists:categories,id',
                'data.summary' => 'required|string',
                'data.description' => 'required|string',
            ],
            [],
            [
                'data.lang' => __('global.lang'),
                'data.title' => __('global.title'),
                'data.slug' => __('global.slug'),
                'data.summary' => __('global.summary'),
                'data.description' =>__('global.description'),
                'data.category_id' =>__('global.main_category'),
                'data.categories' =>__('global.categories'),
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
        if(!isset($this->data['mainImage']) ){
            return $this->addError('data.mainImage', __('messages.post_main_image_required'));
        }
        try {
            $this->post->update([
                'lang' => $this->data['lang'],
                'title' => $this->data['title'],
                'slug' =>  Str::slug($this->data['slug'] ?? ""),
                'is_private' => $this->data['is_private'] ?? false,
                'is_active' => $this->data['is_active'] ?? false,
                'summary' => $this->data['summary'] ?? 0,
                'description' => $this->data['description'] ?? null,
                'updated_by' => Auth::id(),
            ]);

            $this->post->mainCategory()->sync([$this->data['category_id'] => ['is_main' => true]]);
            $this->post->categories()->sync($this->data['categories'] ?? []);
    
            $this->createPostImage($this->post);
            $this->alert(__('messages.post_created_successfully'))->success();
            return redirect()->to(route('admin.posts.index'));
        } catch (Exception $e) {
            $this->alert($e->getMessage())->error();
        }
       
    }
    
    public function render()
    {
        $langs = EnumLanguages::getTranslatedAll();
        $categories = Category::active()->lang()->select('title', 'id')->get();
        return view('livewire.admin.posts.live-post-edit', compact('langs', 'categories'))
            ->extends('layouts.admin-panel')
            ->section('content');
    }
}
