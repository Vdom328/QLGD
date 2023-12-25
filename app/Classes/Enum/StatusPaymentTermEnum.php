<?php

namespace App\Classes\Enum;

use App\Traits\EnumToLabel;

/**
 * 0:男性, 1:女性
 */
enum StatusPaymentTermEnum: int
{
    use EnumToLabel;

    case ON = 1;
    case OFF  = 2;

    public function label(): string
    {
        return match($this) {
            StatusPaymentTermEnum::ON => 'オン',
            StatusPaymentTermEnum::OFF => 'オフ',
        };
    }
}
