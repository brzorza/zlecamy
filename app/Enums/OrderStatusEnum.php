<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case AWAITING = 'awaiting';
    case PAID = 'paid';
    case EXPIRED = 'expired';
    case CANCELLED = 'cancelled';

    const TYPES = [
        self::AWAITING,
        self::PAID,
        self::CANCELLED,
        self::EXPIRED,
    ];
    public static function getValues(): array
    {
        return [
            self::AWAITING,
            self::PAID,
            self::CANCELLED,
            self::EXPIRED,
        ];
    }
}
