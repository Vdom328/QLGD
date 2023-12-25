<?php

namespace App\Classes\Enum;

use App\Traits\EnumToLabel;

/**
 * 0:男性, 1:女性
 */
enum ProfileEnum: int
{
    use EnumToLabel;

    case No = 0;
    case Yes  = 1;
}
