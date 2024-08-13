<?php

declare(strict_types=1);

namespace common\domain\dictionary;
enum UserType
{
    case guest;
    case user;

    public static function all(): array
    {
        return array_map(
            fn(UserType $item) => $item->name,
            UserType::cases()
        );
    }
}
