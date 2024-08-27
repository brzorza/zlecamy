<?php

namespace App\Enums;

enum ChatTextTypeEnum: string
{
    case TEXT = 'text';
    case IMAGE = 'image';
    case FILE = 'file';
    case ORDER = 'order';

    const TYPES = [
        self::TEXT,
        self::IMAGE,
        self::FILE,
        self::ORDER,
    ];
    public static function getValues(): array
    {
        return [
            self::TEXT,
            self::IMAGE,
            self::FILE,
            self::ORDER,
        ];
    }
}
