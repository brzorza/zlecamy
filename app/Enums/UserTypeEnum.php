<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case USER = 'user';
    case SELLER = 'seller';

    const TYPES = [
        self::USER,
        self::SELLER,
    ];
    public static function getValues(): array
    {
        return [
            self::USER,
            self::SELLER,
        ];
    }
}
