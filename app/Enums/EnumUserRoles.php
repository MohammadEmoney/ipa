<?php

namespace App\Enums;


class EnumUserRoles extends BaseEnum
{
    const SUPER_ADMIN = 'super-admin';
    const ADMIN = 'admin';
    const SUPERVISOR = 'supervisor';
    const MANAGEMENT = 'management';
    const CONTENT_MANAGER = 'content-manager';
    const USER = 'user';
}
