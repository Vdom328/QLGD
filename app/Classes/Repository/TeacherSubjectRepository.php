<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ITeacherSubjectRepository;
use App\Models\TeacherSubject;
use App\Models\User;

class TeacherSubjectRepository extends BaseRepository implements ITeacherSubjectRepository
{
    public function __construct(TeacherSubject $model)
    {
        parent::__construct($model);
    }


    /**
     * @inheritDoc
     */
    public function deleteData($teacher_id)
    {
        return $this->model->where('teacher_id', $teacher_id)->delete();
    }
}
