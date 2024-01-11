<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IStudentSubjectRepository;
use App\Models\StudentSubject;

class StudentSubjectRepository  extends BaseRepository implements IStudentSubjectRepository
{
    public function __construct(StudentSubject $model)
    {
        parent::__construct($model);
    }

    public function deleteByStudentId($id)
    {
        return $this->model->where('student_id', $id)->delete();
    }
}
