<?php

namespace App\Livewire\Admin\Books;

use App\Enums\EnumCourseAges;
use App\Models\Book;
use App\Traits\AlertLiveComponent;
use App\Traits\MediaTrait;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveBookEdit extends Component
{
    use AlertLiveComponent;
    use MediaTrait;
    use WithFileUploads;

    public $book;
    public $data = [];

    public function mount(Book $book)
    {
        $this->book = $book;
        $this->data['age'] = $book->age;
        $this->data['title'] = $book->title;
        $this->data['inventory'] = $book->inventory;
        $this->data['sale_price'] = $book->sale_price;
        $this->data['price'] = $book->price;
        $this->data['description'] = $book->description;
        $this->data['mainImage'] = $book->getFirstMedia('mainImage');
    }

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
        //
    }

    public function submit()
    {
        $this->validations();
        if(!isset($this->data['mainImage']) ){
            return $this->addError('data.mainImage', 'تصویر کتاب الزامی می باشد.');
        }
        $book =  $this->book->update([
            'age' => $this->data['age'],
            'title' => $this->data['title'],
            'inventory' => $this->data['inventory'],
            'sale_price' => $this->data['sale_price'] ?? 0,
            'price' => $this->data['price'],
            'description' => $this->data['description'] ?? null,
        ]);

        $this->createBookImage($book);
        $this->alert('کتاب با موفقیت ویرایش شد.')->success();
        return redirect()->to(route('admin.books.index'));
    }

    public function render()
    {
        $ages = EnumCourseAges::getTranslatedAll();
        return view('livewire.admin.books.live-book-edit', compact('ages'))->extends('layouts.admin-panel')->section('content');
    }
}
