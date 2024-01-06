<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\ITeacherSubjectRepository;
use App\Classes\Repository\Interfaces\ITeacherTimeSlotsRepository;
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
    private $teacherSubjectRepository,$teacherTimeSlotsRepository;

    public function __construct(
        ITeacherSubjectRepository $teacherSubjectRepository,
        ITeacherTimeSlotsRepository $teacherTimeSlotsRepository
    )
    {
        $this->teacherSubjectRepository = $teacherSubjectRepository;
        $this->teacherTimeSlotsRepository = $teacherTimeSlotsRepository;
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

    /**
     * @inheritDoc
     */
    public function createTimeSlots($data)
    {
        DB::beginTransaction();
        try {

            $delete = $this->teacherTimeSlotsRepository->deleteByTeacherId($data['teacher_id']);
            $attr = [];
            foreach ($data['time_slots'] as $key => $value) {
                $attr[] = [
                    'teacher_id' => $data['teacher_id'],
                    'time_slot' =>  $value,
                    'created_at' =>  now(),
                ];
            }
            $this->teacherTimeSlotsRepository->insert($attr);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create a new teacher time slots: ' . $e->getMessage());
            return false;
        }
    }
}
