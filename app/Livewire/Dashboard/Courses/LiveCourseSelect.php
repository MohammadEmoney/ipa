<?php

namespace App\Livewire\Dashboard\Courses;

use App\Models\Course;
use Livewire\Component;

class LiveCourseSelect extends Component
{
    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;
    public $searchTerm;
    public $showAll = false;
    public $disableSearchBtn = true;
    public $display;

    public function mount()
    {
        $this->display = false;
    }

    public function displayAll()
    {
        $this->search = null;
        $this->searchTerm = null;
        $this->showAll = true;
        $this->disableSearchBtn = true;
        $this->display = true;
    }

    public function submit()
    {
        $this->searchTerm = $this->search;
        $this->display = true;
    }

    public function updatedSearch($value)
    {
        if($value > 0)
            $this->disableSearchBtn = false;
        else
            $this->disableSearchBtn = true;
    }

    public function render()
    {
        $courses = Course::query();
        if(!$this->showAll)
            $courses = $courses->where('id', null);
        if($this->searchTerm && mb_strlen($this->searchTerm) > 2){
            $courses = $courses->where(function($query){
                $query->where('title', "like", "%$this->searchTerm%");
            });
        }
        $courses = $courses->orderBy($this->sort, $this->sortDirection)->paginate($this->paginate);
        return view('livewire.dashboard.courses.live-course-select', compact('courses'))->extends('layouts.panel')->section('content');
    }
}
