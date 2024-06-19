<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use App\Traits\AlertLiveComponent;
use Livewire\Component;
use Livewire\WithPagination;

class LiveCategoryIndex extends Component
{
    use AlertLiveComponent, WithPagination;

    protected $listeners = [ 'destroy'];

    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;
    public $title;
    public $filter = [];

    public function mount()
    {
        $this->title = __('global.categories');
    }

    public function resetFilter()
    {
        $this->filter = [];
    }

    public function show($id)
    {
        // return redirect()->to(route('admin.categories.show', $id));
    }

    public function create()
    {
        return redirect()->to(route('admin.categories.create'));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('category_delete')){
            $category = Category::query()->find($id);

            if ($category) {
                $category->delete();
                $this->alert(__('messages.psot_deleted'))->success();
            }
            else{
                $this->alert(__('messages.psot_not_deleted'))->error();
            }
        }else{
            $this->alert(__('messages.not_have_access'))->error();
        }
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.categories.edit', ['category' => $id]));
    }

    public function changeActiveStatus($id)
    {
        $category = Category::find($id);
        if($category){
            $category->update(['is_active' => !$category->is_active]);
            $this->alert(__('messages.updated_successfully'))->success();
        }
    }

    public function render()
    {
        $categories = Category::query()->with(['parent']);
        $search = trim($this->search);
        if($search && mb_strlen($search) > 2){
            $categories = $categories->where(function($query) use ($search){
                $query->where('title', "like", "%$search%")
                    ->orWhere('slug', "like", "%$search%");
                    // ->orWhere('description', "like", "%$search%")
                    // ->orWhere('summary', "like", "%$search%");
            });
        }
        $categories = $categories->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.admin.categories.live-category-index', compact('categories'))
            ->extends('layouts.admin-panel')->section('content');
    }
}
