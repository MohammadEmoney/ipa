<?php

namespace App\Livewire\Admin\Semesters;

use App\Models\Semester;
use App\Traits\AlertLiveComponent;
use Livewire\Component;

class LiveSemesterIndex extends Component
{
    use AlertLiveComponent;

    protected $listeners = ['destroy'];

    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;

    public function create()
    {
        return redirect()->to(route('admin.semesters.create'));
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.semesters.edit', $id));
    }

    public function destroy($id)
    {
        if(auth()->user()->can('semester_delete')){
            $semester = Semester::query()->find($id);

            if ($semester) {
                $semester->delete();
                $this->alert('ترم حذف شد')->success();
            }
            else{
                $this->alert('ترم حذف نشد')->error();
            }
        }else{
            $this->alert('شما اجازه دسترسی به این بخش را ندارید.')->error();
        }
    }
    
    public function render()
    {
        $semesters = Semester::latest()->paginate();
        return view('livewire.admin.semesters.live-semester-index', compact('semesters'))->extends('layouts.admin-panel')->section('content');
    }
}
