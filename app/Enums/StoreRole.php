<?php

namespace App\Enums;

enum StoreRole: string
{
    case OWNER = 'owner';
    case EMPLOYEE = 'employee';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
