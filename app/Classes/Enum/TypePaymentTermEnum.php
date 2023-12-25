<?php

namespace App\Classes\Enum;

use App\Traits\EnumToLabel;

/**
 * 0:男性, 1:女性
 */
enum TypePaymentTermEnum: int
{
    use EnumToLabel;

    case customer = 1;
    case supplier  = 2;

    public function label(): string
    {
        return match($this) {
            TypePaymentTermEnum::customer => '取引先',
            TypePaymentTermEnum::supplier => '仕入れ先',
        };
    }
}
