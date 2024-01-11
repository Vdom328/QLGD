<?php

namespace App\Classes\Enum;

use App\Traits\EnumToLabel;

/**
 * 0:男性, 1:女性
 */
enum RoleUserEnum: int
{
    use EnumToLabel;

    case ADMIN = 1;
    case STAFF  = 2;
    case STUDENT  = 3;

    public function label(): string
    {
        return match($this) {
            RoleUserEnum::ADMIN => 'Admin',
            RoleUserEnum::STAFF => 'Teacher',
            RoleUserEnum::STUDENT => 'Student',
        };
    }
}
