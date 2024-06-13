<?php

namespace App\Livewire\Admin\Dashboards;

use App\Models\Semester;
use App\Models\User;
use Livewire\Component;

class LiveStudentSearch extends Component
{
    public $type;
    public $paginate = 10;
    public $sort = 'created_at';
    public $sortDirection = 'DESC';
    public $search;
    public $searchSemester;

    public function show($id)
    {
        return redirect()->to(route('admin.users.student.show', $id));
    }

    public function edit($id)
    {
        return redirect()->to(route('admin.users.student.edit', $id));
    }

    public function render()
    {
        $users = User::query()->with(['userInfo', 'orders'])->whereRelation('userInfo', 'type', 'student');
            if($this->search && mb_strlen($this->search) > 2){
                $users = $users->where(function($query){
                    $query->where('first_name', "like", "%$this->search%")
                        ->orWhere('last_name', "like", "%$this->search%")
                        ->orWhere('email', "like", "%$this->search%")
                        ->orWhere('national_code', "like", "%$this->search%")
                        ->orWhereHas('userInfo', function($query) {
                            $query->where('mobile_1', 'like', "%$this->search%")
                            ->orWhere('mobile_2', "like", "%$this->search%")
                            ->orWhere('landline_phone', "like", "%$this->search%");
                        });
                });
            }
        $users = $users->orderBy($this->sort, $this->sortDirection)->take(10)->get();

        $semesters = Semester::query()->with(['students', 'course']);
        if($this->searchSemester && mb_strlen($this->searchSemester) > 2){
            $semesters = $semesters->whereRelation('course', 'title', 'like', "%$this->searchSemester%")
                            ->orWhereHas('teacher',function($query) {
                                $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$this->searchSemester%"]);
                            });
        }
        $semesters = $semesters->orderBy($this->sort, $this->sortDirection)->take(10)->get();

        return view('livewire.admin.dashboards.live-student-search', compact('users', 'semesters'));
    }
}
