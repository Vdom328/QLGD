<?php

namespace App\Classes\Enum;

use App\Traits\EnumToLabel;

/**
 * 0:男性, 1:女性
 */
enum CompanyBankAccountTypeEnum: int
{
    use EnumToLabel;

    case USUALLY = 1;
    case CURRENT  = 2;

    public function label(): string
    {
        return match($this) {
            CompanyBankAccountTypeEnum::USUALLY => '普通',
            CompanyBankAccountTypeEnum::CURRENT => '当座',
        };
    }
}
