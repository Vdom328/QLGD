<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\ITeacherSubjectRepository;
use App\Classes\Repository\Interfaces\IUserRepository;
use App\Classes\Services\Interfaces\ITeacherSubjectService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Implement TeacherSubjectService
 */
class TeacherSubjectService extends BaseService implements ITeacherSubjectService
{
    private $teacherSubjectRepository;

    public function __construct(ITeacherSubjectRepository $teacherSubjectRepository)
    {
        $this->teacherSubjectRepository = $teacherSubjectRepository;
    }


    /**
     * @inheritDoc
     */
    public function createNewData($data)
    {
        DB::beginTransaction();
        try {

            $delete = $this->teacherSubjectRepository->deleteData($data['teacher_id']);

            $attr = [];
            foreach ($data['subject_id'] as $value) {
                $attr[] = [
                    'teacher_id' =>$data['teacher_id'],
                    'subject_id' =>$value,
                ];
            }

            $this->teacherSubjectRepository->insert($attr);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create new teacher subject: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function finByTeacherId($teacher_id)
    {
        return $this->teacherSubjectRepository->find(['teacher_id' => $teacher_id]);
    }
}
