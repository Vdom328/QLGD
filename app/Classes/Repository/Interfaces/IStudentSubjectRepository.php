<?php

namespace App\Classes\Repository\Interfaces;

interface IStudentSubjectRepository extends IBaseRepository
{


    /**
     * delete bu student id
     * @param int $id
     */
    public function deleteByStudentId($id);
}
