<?php

namespace App\Classes\Enum;

use App\Traits\EnumToLabel;

/**
 * 0:男性, 1:女性
 */
enum StaffStatusEnum: int
{
    use EnumToLabel;

    case INVALID = 0;
    case VALID  = 1;

    public function label(): string
    {
        return match($this) {
            StaffStatusEnum::INVALID => 'Vô hiệu hóa',
            StaffStatusEnum::VALID => 'Có hiệu lực',
        };
    }
}
