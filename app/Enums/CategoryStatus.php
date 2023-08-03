<?php

namespace App\Enums;

enum CategoryStatus: string
{
    case Published = 'published';
    case Draft = 'draft';
    case Deleted = 'deleted';

    public function getLabel(): string
    {
        return match ($this) {
            self::Published => 'Published',
            self::Draft => 'Draft',
            self::Deleted => 'Deleted',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Published => 'green',
            self::Draft => 'gray',
            self::Deleted => 'red',
        };
    }
}
