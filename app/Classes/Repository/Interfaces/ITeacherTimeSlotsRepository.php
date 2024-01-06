<?php

namespace App\Classes\Repository\Interfaces;

interface ITeacherTimeSlotsRepository extends IBaseRepository
{

    /**
     * delete by teacher_id
     * @param int $teacher_id
     */
    public function deleteByTeacherId($teacher_id);
}
