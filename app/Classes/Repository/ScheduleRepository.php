<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IScheduleRepository;
use App\Models\Schedule;

class ScheduleRepository  extends BaseRepository implements IScheduleRepository
{
    public function __construct(Schedule $model)
    {
        parent::__construct($model);
    }


}
