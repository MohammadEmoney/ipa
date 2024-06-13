<?php

namespace App\Enums;


class EnumLayoutFilter extends BaseEnum
{
    const SELECT = 'select';
    const NEWEST = 'newest';
    const OLDEST = 'oldest';
    const MOSTVISITED = 'most_visited';
    const MOSTPOPULAR = 'most_popular';
    const RANDOM = 'random';
    const BESTSELLING = 'bestselling';
    const DISCOUNT = 'discount';
    const CATEGORY = 'category';
    const TAG = 'tag';
}
