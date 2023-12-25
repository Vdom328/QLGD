<?php

namespace App\Classes\Enum;

use App\Traits\EnumToLabel;


enum TodoStatusEnum: int
{
    use EnumToLabel;

    case new = 1;
    case corresponding  = 2;
    case completed = 3;
    case success  = 4;
    case cancel = 5;

    public function label(): string
    {
        return match($this) {
            TodoStatusEnum::new => '新規',
            TodoStatusEnum::corresponding => '対応中',
            TodoStatusEnum::completed => '対応済み',
            TodoStatusEnum::success => '完了',
            TodoStatusEnum::cancel => '取り下げ',
        };
    }
}
