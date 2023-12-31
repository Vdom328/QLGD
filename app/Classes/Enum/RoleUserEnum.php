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

    public function label(): string
    {
        return match($this) {
            RoleUserEnum::ADMIN => '管理者',
            RoleUserEnum::STAFF => 'スタッフ',
        };
    }
}
