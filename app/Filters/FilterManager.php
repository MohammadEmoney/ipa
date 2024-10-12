<?php

namespace App\Filters;

class FilterManager
{
    protected $model;

    public function __construct(Filterable $model)
    {
        $this->model = $model;
    }

    public function apply(array $filters)
    {
        return $this->model->filter($filters);
    }
}