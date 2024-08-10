<?php

namespace App\Traits;

use App\Models\Filter;
use App\Rules\JDate;
use Illuminate\Database\Eloquent\Builder;

trait FilterTrait
{
    public $filters = [];

    // Method to apply filters to the query
    public function applyFilters(Builder $query): Builder
    {
        foreach ($this->filters as $filter => $value) {
            if (method_exists($this, $filter) && !empty($value)) {
                $query = $this->$filter($query, $value);
            }
        }

        return $query;
    }

    // Example filter method for a specific column (you can expand this)
    public function filterByName(Builder $query, $value): Builder
    {
        return $query->where('name', 'like', '%' . $value . '%');
    }

    public function addFilter()
    {
        $this->filtersValidation();
        $this->tempFilters[] = $this->filters;
        $this->filters = [];
        $this->loadDatePicker();
    }

    public function deleteFilter($key)
    {
        unset($this->tempFilters[$key]);
    }

    public function editFilter($key)
    {
        $this->filters = $this->tempFilters[$key];
        $this->editingFilterId = $key;
    }

    public function updateFilter()
    {
        $this->filtersValidation();
        $this->tempFilters[$this->editingFilterId] = $this->filters;
        $this->filters = [];
        $this->editingFilterId = null;
        $this->loadDatePicker();
    }

    public function loadDatePicker()
    {
        $this->dispatch('selectFilter');
    }

    public function filtersValidation()
    {
        $this->validate([
            'filters.company_name' => 'required|string|max:255',
            'filters.role' => 'required|string|max:255',
            'filters.date_start' => ['required', 'string', 'max:255', new JDate()],
            'filters.date_end' => ['required_without:filters.still_working', 'string', 'max:255', new JDate()],
            'filters.description' => 'nullable|string',
            'filters.work_phone' => 'nullable|numeric',
            'filters.work_address' => 'nullable|string',
            'filters.still_working' => 'nullable|boolean',
        ],[
            'filters.date_end.required_without' => 'پایان کار الزامی است'
        ],[
            'filters.company_name' => 'نام شرکت',
            'filters.role' => 'عنوان شغلی',
            'filters.date_start' => 'شروع کار',
            'filters.date_end' => 'پایان کار',
            'filters.description' => 'توضیحات',
            'filters.work_address' => 'آدرس محل کار',
            'filters.work_phone' => 'شماره تلفن محل کار',
            'filters.still_working' => 'مشغول به کار',
        ]);
    }

    public function saveFilters($user)
    {
        foreach($this->tempFilters as $filter){
            $stillWorking = $filter['still_working'] ?? 0;
            $user->filterReferences()->create([
                'company_name' => $filter['company_name'],
                'role' => $filter['role'],
                'date_start' => isset($filter['date_start']) ? $this->convertToGeorgianDate($filter['date_start']) : null,
                'date_end' => $stillWorking ? null :  (isset($filter['date_end']) ? $this->convertToGeorgianDate($filter['date_end']) : null),
                'description' => $filter['description'] ?? null,
                'still_working' => $stillWorking,
                'work_phone' => $filter['work_phone'] ?? null,
                'work_address' => $filter['work_address'] ?? null,
            ]);
        }
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }
    
    public function resetFilter()
    {
        $this->filters = [];
    }
}
