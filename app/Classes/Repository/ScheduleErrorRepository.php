<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IScheduleErrorRepository;
use App\Models\ScheduleError;

class ScheduleErrorRepository  extends BaseRepository implements IScheduleErrorRepository
{
    public function __construct(ScheduleError $model)
    {
        parent::__construct($model);
    }


}
