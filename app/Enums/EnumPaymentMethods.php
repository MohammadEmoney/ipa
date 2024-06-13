<?php

namespace App\Enums;


class EnumPaymentMethods extends BaseEnum
{
    const CREDIT_CARD = 'credit_card';
    const CASH = 'cash';
    const POS = 'pos';
    const ONLINE = 'online';
    const CHEQUE = 'cheque';
}
