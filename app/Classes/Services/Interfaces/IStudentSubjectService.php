<?php

namespace App\Classes\Services\Interfaces;


interface IStudentSubjectService
{

    /**
     * create a new student subject
     */
    public function createNew($data);


    /**
     * find by student id
     * @param int  $id
     */
    public function finByStudentId($id);

    /**
     * delete by id
     * @param int $id
     */
    public function delete($id);
}
