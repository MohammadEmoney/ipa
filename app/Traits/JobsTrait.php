<?php

namespace App\Traits;

use App\Models\JobReference;
use App\Rules\JDate;

trait JobsTrait
{
    public $haveJobReference = false;
    public $editPage = false;
    public $jobs = [];
    public $tempJobs = [];
    public $editingJobId;
    public $jobsDatePicker;
    public $stillWorking = false;

    // public function mountJobsTrait()
    // {
    //     $this->jobs['still_working'] = 0;
    // }

    public function addJobReference()
    {
        $this->jobsValidation();
        $this->tempJobs[] = $this->jobs;
        $this->jobs = [];
        $this->loadDatePicker();
    }

    public function deleteJob($key)
    {
        unset($this->tempJobs[$key]);
    }

    public function editJob($key)
    {
        $this->jobs = $this->tempJobs[$key];
        $this->editingJobId = $key;
    }

    public function updateJob()
    {
        $this->jobsValidation();
        $this->tempJobs[$this->editingJobId] = $this->jobs;
        $this->jobs = [];
        $this->editingJobId = null;
        $this->loadDatePicker();
    }

    public function loadDatePicker()
    {
        $this->dispatch('selectJobsReference');
    }

    public function jobsValidation()
    {
        // dd($this->jobs);
        $this->validate([
            'jobs.company_name' => 'required|string|max:255',
            'jobs.role' => 'required|string|max:255',
            'jobs.date_start' => ['required', 'string', 'max:255', new JDate()],
            'jobs.date_end' => ['required_without:jobs.still_working', 'string', 'max:255', new JDate()],
            'jobs.description' => 'nullable|string',
            'jobs.work_phone' => 'nullable|numeric',
            'jobs.work_address' => 'nullable|string',
            'jobs.still_working' => 'nullable|boolean',
        ],[
            'jobs.date_end.required_without' => 'پایان کار الزامی است'
        ],[
            'jobs.company_name' => 'نام شرکت',
            'jobs.role' => 'عنوان شغلی',
            'jobs.date_start' => 'شروع کار',
            'jobs.date_end' => 'پایان کار',
            'jobs.description' => 'توضیحات',
            'jobs.work_address' => 'آدرس محل کار',
            'jobs.work_phone' => 'شماره تلفن محل کار',
            'jobs.still_working' => 'مشغول به کار',
        ]);
    }

    public function saveJobs($user)
    {
        foreach($this->tempJobs as $job){
            $stillWorking = $job['still_working'] ?? 0;
            $user->jobReferences()->create([
                'company_name' => $job['company_name'],
                'role' => $job['role'],
                'date_start' => isset($job['date_start']) ? $this->convertToGeorgianDate($job['date_start']) : null,
                'date_end' => $stillWorking ? null :  (isset($job['date_end']) ? $this->convertToGeorgianDate($job['date_end']) : null),
                'description' => $job['description'] ?? null,
                'still_working' => $stillWorking,
                'work_phone' => $job['work_phone'] ?? null,
                'work_address' => $job['work_address'] ?? null,
            ]);
        }
    }

    public function updateJobs($user)
    {
        foreach($this->tempJobs as $key => $job){
            $job = JobReference::where('id', $key)->where('user_id', $this->user->id)->first();
            if($job){
                $job->update([
                    'company_name' => $job['company_name'],
                    'role' => $job['role'],
                    'date_start' => isset($job['date_start']) ? $this->convertToGeorgianDate($job['date_start']) : null,
                    'date_end' => isset($job['date_end']) ? $this->convertToGeorgianDate($job['date_end']) : null,
                    'description' => $job['description'] ?? null,
                ]);
            }else{
                $user->jobReferences()->create([
                    'company_name' => $job['company_name'],
                    'role' => $job['role'],
                    'date_start' => isset($job['date_start']) ? $this->convertToGeorgianDate($job['date_start']) : null,
                    'date_end' => isset($job['date_end']) ? $this->convertToGeorgianDate($job['date_end']) : null,
                    'description' => $job['description'] ?? null,
                ]);
            }

        }
    }
}
