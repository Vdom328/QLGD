<?php

namespace App\Classes\Enum;

use App\Traits\EnumToLabel;


enum TodoTypeEnum: int
{
    use EnumToLabel;

    case repeat = 1;
    case contact  = 2;
    case confirm = 3;
    case reminder  = 4;
    case in_addition = 5;
    case important  = 6;

    public function label(): string
    {
        return match($this) {
            TodoTypeEnum::repeat => 'リマインド',
            TodoTypeEnum::contact => '連絡',
            TodoTypeEnum::confirm => '確認',
            TodoTypeEnum::reminder => '催促',
            TodoTypeEnum::in_addition => 'その他',
            TodoTypeEnum::important => '重要',
        };
    }
}
