<?php

namespace App\Enum;

abstract class TaskStatus
{
    public const NOT_STARTED = 'not_started';
    public const IN_PROGRESS = 'in_progress';
    public const COMPLETED = 'completed';

    public static function all(): array
    {
        return [
            self::NOT_STARTED,
            self::IN_PROGRESS,
            self::COMPLETED,
        ];
    }
}
