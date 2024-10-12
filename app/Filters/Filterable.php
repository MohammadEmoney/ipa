<?php

namespace App\Filters;

interface Filterable
{
    public function filter(array $filters);
}