<?php

namespace App\Enums;

enum TransactionAction: string
{
    case ADD_STOCK = 'add_stock';
    case REMOVE_STOCK = 'remove_stock';
    case SALE = 'sale';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
