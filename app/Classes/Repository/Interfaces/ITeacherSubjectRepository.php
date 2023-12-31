<?php

namespace App\Classes\Repository\Interfaces;

interface ITeacherSubjectRepository extends IBaseRepository
{

    /**
     * delete data by teacher_id
     */
    public function deleteData($teacher_id);
}
