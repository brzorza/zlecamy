<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case NEW = 'new';
    case PAID = 'paid';
    case IN_PROGRESS = 'in_progress';
    case FINISHED = 'finished';
    case EXPIRED = 'expired';
    case CANCELLED = 'cancelled';

    const TYPES = [
        self::NEW,
        self::PAID,
        self::IN_PROGRESS,
        self::FINISHED,
        self::CANCELLED,
        self::EXPIRED,
    ];
    public static function getValues(): array
    {
        return [
            self::NEW,
            self::PAID,
            self::IN_PROGRESS,
            self::CANCELLED,
            self::EXPIRED,
        ];
    }
}
