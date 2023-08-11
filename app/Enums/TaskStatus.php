<?php

namespace App\Enums;

enum TaskStatus: string
{
    case START = 'not started';
    case IN_PROGRESS = 'in progress';
    case FINISHED = 'finished';

    public static function all(): array
    {
        return [
            self::START->value,
            self::IN_PROGRESS->value,
            self::FINISHED->value,
        ];
    }
}
