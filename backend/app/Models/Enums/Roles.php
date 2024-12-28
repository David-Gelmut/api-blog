<?php

namespace App\Models\Enums;

enum Roles: int
{
    case ADMIN = 1;
    case AUTHOR = 2;
    case READER = 3;

    public function role(): string
    {
        return match ($this) {
            self::ADMIN => 'Администратор',
            self::AUTHOR => 'Автор',
            self::READER => 'Читатель',
        };
    }

    public static function options(): array
    {
        return
            collect(self::cases())
            ->keyBy('value')
            ->map(fn($item)=>$item->role())
            ->toArray();
    }
}
