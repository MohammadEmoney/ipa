<?php

namespace App\Livewire\Admin\Books;

use App\Enums\EnumCourseAges;
use App\Models\Book;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveBookCreate extends Component
{
    use AlertLiveComponent;
    use MediaTrait;
    use WithFileUploads;

    public $disabledCreate = true;
    public $book;
    public $data = [];

    public function validations()
    {
        $this->validate(
            [
                'data.age' => 'required|in:' . EnumCourseAges::asStringValues(),
                'data.title' => 'required|string|min:2|max:255',
                'data.inventory' => 'required|min:0',
                'data.sale_price' => 'nullable|min:0',
                'data.price' => 'required|min:0',
                'data.description' => 'nullable|string',
            ],
            [],
            [
                'data.age' => 'رده سنی',
                'data.title' => 'عنوان کتاب',
                'data.inventory' => 'موجودی',
                'data.sale_price' => 'مبلغ تخفیف',
                'data.price' => 'مبلغ',
                'data.description' => 'توضیحات',
            ]
        );
    }

    public function updated($field, $value)
    {
        $this->disabledCreate = true;
        $this->validations();
        $this->disabledCreate = false;
    }

    public function submit()
    {
        $this->validations();
        if(!isset($this->data['mainImage']) ){
            return $this->addError('data.mainImage', 'تصویر کتاب الزامی می باشد.');
        }
        $book =  Book::create([
            'age' => $this->data['age'],
            'title' => $this->data['title'],
            'inventory' => $this->data['inventory'],
            'sale_price' => $this->data['sale_price'] ?? 0,
            'price' => $this->data['price'],
            'description' => $this->data['description'] ?? null,
        ]);

        $this->createBookImage($book);
        $this->alert('کتاب با موفقیت ثبت شد.')->success();
        return redirect()->to(route('admin.books.index'));
    }
    
    public function render()
    {
        $ages = EnumCourseAges::getTranslatedAll();
        return view('livewire.admin.books.live-book-create', compact('ages'))->extends('layouts.admin-panel')->section('content');
    }
}
