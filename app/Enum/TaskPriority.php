<?php

namespace App\Enum;

abstract class TaskPriority
{
    public const LOW = 'low';
    public const NORMAL = 'normal';
    public const HIGH = 'high';

    public static function all(): array
    {
        return [
            self::LOW,
            self::NORMAL,
            self::HIGH,
        ];
    }
}
