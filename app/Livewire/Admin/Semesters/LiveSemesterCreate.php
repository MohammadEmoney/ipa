<?php

namespace App\Livewire\Admin\Semesters;

use App\Enums\EnumClassTypes;
use App\Enums\EnumSemesterGender;
use App\Models\Course;
use App\Models\Semester;
use App\Models\User;
use App\Rules\JDate;
use App\Traits\AlertLiveComponent;
use App\Traits\DateTrait;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class LiveSemesterCreate extends Component
{
    use AlertLiveComponent;
    use DateTrait;

    public $disabledCreate = true;
    public $semester;
    public $dayType;
    public $data = [];
    public $selectedDays = [];
    public $time_start;
    public $time_end;

    public function validations()
    {
        $this->validate(
            [
                'data.tuition_fee' => 'required|numeric|min:0',
                'data.course_id' => 'required|numeric|exists:courses,id',
                'data.teacher_id' => 'required|numeric|exists:users,id',
                'data.date_start' => ['required', 'string', 'max:255', new JDate()],
                'data.date_end' => ['required', 'string', 'max:255', new JDate()],
                'time_start' => ['required', 'string', 'max:255', 'date_format:H:i'],
                'time_end' => ['required', 'string', 'max:255', 'date_format:H:i'],
                'selectedDays' => 'required|array',
                'data.class_number' => 'required',
                'data.term_number' => 'required|min:1|max:999',
                'data.gender' => 'required|in:' . EnumSemesterGender::asStringValues(),
                'data.students' => 'nullable|array',
                'data.students.*' => 'required|exists:users,id',
            ],
            [
                'time_start.date_format' => 'فرمت شروع کلاس معتبر نمی باشد.',
                'time_end.date_format' => 'فرمت پایان کلاس معتبر نمی باشد.',
            ],
            [
                'data.tuition_fee' => 'شهریه',
                'data.course_id' => 'دوره',
                'data.teacher_id' => 'مدرس',
                'data.date_start' => 'شروع ترم',
                'data.date_end' => 'پایان ترم',
                'time_start' => 'شروع کلاس',
                'time_end' => 'پایان کلاس',
                'data.class_number' => 'شماره کلاس',
                'data.students' => 'دانش آموزان',
                'data.gender' => 'جنسیت',
                'data.term_number' => 'شماره ترم',
            ]
        );
    }

    public function updated($field, $value)
    {
        if($field == "dayType"){
            if($value === "even" ){
                $this->selectedDays = [
                    "saturday" => true,
                    "sunday" => false,
                    "monday" => true,
                    "tuesday" => false,
                    "wednesday" => true,
                    "thursday" => false,
                    "friday" => false,
                 ];
            }elseif($value === "odd"){
                $this->selectedDays = [
                    "saturday" => false,
                    "sunday" => true,
                    "monday" => false,
                    "tuesday" => true,
                    "wednesday" => false,
                    "thursday" => true,
                    "friday" => false,
                 ];
            }else{
                $this->selectedDays = [];
            }
        }

        if($field == "data.time_start"){
            $convertedTime = \Morilog\Jalali\CalendarUtils::convertNumbers($value, true);
            $this->time_start = $convertedTime;
        }

        if($field == "data.time_end"){
            $convertedTime = \Morilog\Jalali\CalendarUtils::convertNumbers($value, true);
            $this->time_end = $convertedTime;
        }
        

        if($field == "data.course_id"){
            $course = Course::find($this->data['course_id']);
            $this->data['tuition_fee'] = $course?->price ?: null;
        }
        

        $this->disabledCreate = true;
        $this->validations();
        $this->disabledCreate = false;
    }

    public function submit()
    {
        $this->authorize('semester_create');
        $this->validations();
        $this->createSemester();
        $this->createStudents();
        $this->alert('ترم با موفقیت ایجاد شد.')->success();
        return redirect()->to(route('admin.semesters.edit', $this->semester->id));
    }

    protected function createSemester()
    {
        $this->validations();
    
        $this->semester = Semester::create([
            'course_id' => $this->data['course_id'],
            'teacher_id' => $this->data['teacher_id'],
            'date_start' => $this->convertToGeorgianDate($this->data['date_start']),
            'date_end' => $this->convertToGeorgianDate($this->data['date_end']),
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'tuition_fee' => $this->data['tuition_fee'],
            'class_number' => $this->data['class_number'],
            'term_number' => $this->data['term_number'],
            'gender' => $this->data['gender'],
            'week_days' => [
                'days' => $this->selectedDays,
                'type' => $this->dayType
            ],
        ]);
    }

    protected function createStudents()
    {
        $this->semester->students()->attach($this->data['students'] ?? [], ['class_number' => $this->data['class_number']]);
    }

    public function render()
    {
        $courses = Course::select('title', 'id', 'part_number')->latest()->get();
        $classTypes = EnumClassTypes::All();
        $genders = EnumSemesterGender::getTranslatedAll();
        $staff = User::with('userInfo')->whereRelation('userInfo', 'type', 'staff')->get();
        $students = User::with('userInfo')->whereRelation('userInfo', 'type', 'student')->get();
        $weekDays = [
            "saturday",
            "sunday",
            "monday",
            "tuesday",
            "wednesday",
            "thursday",
            "friday",
        ];
        return view('livewire.admin.semesters.live-semester-create', compact('courses', 'staff', 'students','weekDays', 'classTypes', 'genders'))->extends('layouts.admin-panel')->section('content');
    }
}
