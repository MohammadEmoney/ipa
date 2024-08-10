<?php

namespace App\Enums;


class EnumOrderStatus extends BaseEnum
{
    const CREATED = 'created';
    const PENDING_PAYMENT = 'pending_payment';
    const PENDING_CONFIRM = 'pending_confirm';
    const PROCESSING = 'processing';
    const COMPLETED = 'completed';
    const NOT_CONFIRM = 'not_confirm';
}
