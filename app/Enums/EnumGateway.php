<?php

namespace App\Enums;

class EnumGateway extends BaseEnum
{
    const MELLAT = 'behpardakht';
    const ZARINPAL = 'zarinpal';
    const SAMAN = "saman";
    const PARSIAN = "parsian";

    /**
     * Get Direction Site
     * @param string $key
     * @return string
     */
    public static function icon(string $key):string
    {
        $namespace = explode('\\', static::class);
        return  __('admin/enums/' . end($namespace) . ".icon.$key");
    }
}

