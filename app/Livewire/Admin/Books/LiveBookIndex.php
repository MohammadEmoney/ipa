<?php

namespace App\Livewire\Admin\Books;

use App\Models\Book;
use App\Traits\AlertLiveComponent;
use Livewire\Component;

class LiveBookIndex extends Component
{
    use AlertLiveComponent;

    protected $listeners = ['destroy'];

    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;

    public function create()
    {
        return redirect()->to(route('admin.books.create'));
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.books.edit', $id));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('book_delete')){
            $book = Book::query()->find($id);

            if ($book) {
                $book->delete();
                $this->alert('کتاب حذف شد')->success();
            }
            else{
                $this->alert('کتاب حذف نشد')->error();
            }
        }else{
            $this->alert('شما اجازه دسترسی به این بخش را ندارید.')->error();
        }
    }
    
    public function render()
    {
        $books = Book::query();
        if($this->search && mb_strlen($this->search) > 2){
            $books = $books->where(function($query){
                $query->where('title', "like", "%$this->search%");
            });
        }
        $books = $books->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.admin.books.live-book-index', compact('books'))->extends('layouts.admin-panel')->section('content');
    }
}
