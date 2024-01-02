<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\ITeacherSubjectRepository;
use App\Classes\Repository\Interfaces\IUserRepository;
use App\Classes\Services\Interfaces\ITeacherSubjectService;
use App\Models\Subject;
use App\Models\TeacherSubject;
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

            $query = $this->teacherSubjectRepository->findById($data['id']);

            $attr = [
                'class' =>$data['class'],
            ];

            if ($query) {
                $this->teacherSubjectRepository->update($query,$attr);
            }
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

    /**
     * create a new data
     * @param array $data
     */
    public function createNew($data)
    {
        DB::beginTransaction();
        try {

            foreach ($data['selectedSubjects'] as $subject_id) {
                $randomColor = '#' . dechex(rand(0x000000, 0xFFFFFF));
                $attr = [
                    'teacher_id' => $data['teacher_id'],
                    'subject_id' => $subject_id,
                    'color' => $randomColor,
                ];
                $this->teacherSubjectRepository->create($attr);
            }
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
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $this->teacherSubjectRepository->deleteById($id);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while delete subject: ' . $e->getMessage());
            return false;
        }
    }
}
