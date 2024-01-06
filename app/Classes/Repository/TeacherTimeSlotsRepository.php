<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ITeacherTimeSlotsRepository;
use App\Models\TeacherTimeSlots;

class TeacherTimeSlotsRepository  extends BaseRepository implements ITeacherTimeSlotsRepository
{
    public function __construct(TeacherTimeSlots $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function deleteByTeacherId($teacher_id)
    {
        return $this->model->where('teacher_id', $teacher_id)->delete();
    }
}
