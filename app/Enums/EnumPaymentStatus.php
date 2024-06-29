<?php

namespace App\Enums;

class EnumPaymentStatus extends BaseEnum
{
    const CREATED = 'created';
    const FAILED = 'failed';
    const COMPLETED = 'completed';
    const CANCELED = 'canceled';
}

