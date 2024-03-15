<?php

namespace App\Enums;

enum CategoryStatus: int
{
    case Published = 0;
    case Draft = 1;
    case Deleted = 2;

    public function label(): string
    {
        return match ($this) {
            self::Published => 'Published',
            self::Draft => 'Draft',
            self::Deleted => 'Deleted',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Published => 'green',
            self::Draft => 'gray',
            self::Deleted => 'red',
        };
    }
}
