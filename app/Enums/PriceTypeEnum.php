<?php

namespace App\Enums;

enum PriceTypeEnum: string
{
    case HOUR = 'godzinę';
    case PROJECT = 'realizację';

    const TYPES = [
        self::HOUR,
        self::PROJECT,
    ];
    public static function getValues(): array
    {
        return [
            self::HOUR,
            self::PROJECT,
        ];
    }
}