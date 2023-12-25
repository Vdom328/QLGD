<?php

namespace App\Classes\Enum;

use App\Traits\EnumToLabel;

enum ProjectIsExprireDateEnum: int
{
    use EnumToLabel;

    case OFF = 0;
    case ON = 1;
}
