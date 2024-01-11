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

     /**
     * create a new data
     * @param array $data
     */
    public function createNew($data);

    /**
     * delete by id
     * @param int $id
     */
    public function delete($id);

    /**
     * create a new data
     * @param array $data
     */
    public function createTimeSlots($data);

    /**
     * filter data
     * @param array $data
     */
    public function filter($data);
}
