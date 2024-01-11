<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ITeacherSubjectRepository;
use App\Models\TeacherSubject;
use App\Models\User;
use Illuminate\Support\Facades\Config;

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


    /**
     * @inheritDoc
     */
    public function filter($data)
    {
        $query = $this->model;

        if (isset($data['filter_me']) && $data['filter_me'] == 'true') {
            $query = $query->where('avoid_first_lesson', Config::get('const.status.yes'));
        }

        if (isset($data['labs']) && $data['labs'] == 'true') {
            $query = $query->where('require_class_room', Config::get('const.status.yes'));
        }

        if (isset($data['status'])) {
            $query = $query->where('status', $data['status']);
        }
        if (isset($data['key'])) {
            $query = $query->where('name', 'LIKE', '%' . $data['key'] . '%')
                            ->orWhere('credits_no', 'LIKE', '%' . $data['key'] . '%');
        }
        if (isset($data['column']) && isset($data['direction'])) {
            $query = $query->orderBy($data['column'], $data['direction']);
        }
        if (isset($data['paginate']) && $data['paginate'] == 'false') {
            return $query->get();
         }
        return $query->with('subject_labs')->paginate(paginate());
    }
}
