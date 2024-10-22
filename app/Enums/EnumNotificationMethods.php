<?php

namespace App\Enums;

use App\Enums\BaseEnum;

class EnumNotificationMethods extends BaseEnum
{
    const SMS = 'sms';
    const EMAIL = 'email';
    const DATABASE = 'database';
}