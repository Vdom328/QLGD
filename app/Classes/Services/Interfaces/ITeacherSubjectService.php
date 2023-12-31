<?php

namespace App\Classes\Services\Interfaces;

interface ITeacherSubjectService
{

    /**
     * create a new data
     * @param array $data
     */
    public function createNewData($data);

    /**
     * find data by teacher_id
     */
    public function finByTeacherId($teacher_id);
}
