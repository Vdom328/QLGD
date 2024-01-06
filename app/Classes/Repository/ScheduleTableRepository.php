<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IScheduleTableRepository;
use App\Models\Schedule;
use App\Models\ScheduleTable;

class ScheduleTableRepository  extends BaseRepository implements IScheduleTableRepository
{
    public function __construct(ScheduleTable $model)
    {
        parent::__construct($model);
    }


}
