<?php

namespace App\Enums\Permissions;

enum Category: string
{
    case PUBLISH = 'publish category';
    case EDIT = 'edit category';
    case DELETE = 'delete category';

    public static function values(): array
    {
        $values = [];

        foreach (self::cases() as $props) {
            $values[] = $props->value;
        }

        return $values;
    }
}
