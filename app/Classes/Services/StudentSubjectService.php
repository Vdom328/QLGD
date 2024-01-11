<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IStudentSubjectRepository;
use App\Classes\Services\Interfaces\IStudentSubjectService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Implement UserService
 */
class StudentSubjectService implements IStudentSubjectService
{
    private $studentSubjectRepository;

    public function __construct(IStudentSubjectRepository $studentSubjectRepository)
    {
        $this->studentSubjectRepository = $studentSubjectRepository;
    }


    /**
     * @inheritDoc
     */
    public function createNew($data)
    {
        DB::beginTransaction();
        try {

            $deleteSubject = $this->studentSubjectRepository->deleteByStudentId($data['student_id']);

            foreach ($data['selectedSubjects'] as $teacher_subject_id) {
                $attr = [
                    'student_id' => $data['student_id'],
                    'teacher_subject_id' => $teacher_subject_id,
                ];
                $this->studentSubjectRepository->create($attr);
            }
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create new student subject: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function finByStudentId($id)
    {
        return $this->studentSubjectRepository->find(['student_id' => $id]);
    }

        /**
     * @inheritDoc
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $this->studentSubjectRepository->deleteById($id);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while delete subject: ' . $e->getMessage());
            return false;
        }
    }
}
