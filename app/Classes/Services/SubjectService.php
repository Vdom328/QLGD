<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IRoleRepository;
use App\Classes\Repository\Interfaces\ISubjectRepository;
use App\Classes\Services\Interfaces\ISubjectService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Implement UserService
 */
class SubjectService implements ISubjectService
{
    private $subjectRepository;

    public function __construct(ISubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * @inheritDoc
     */
    public function randomNo()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $length = 7;
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        while ($this->subjectRepository->exists($randomString)) {
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
        }

        return $randomString;
    }


    /**
     * @inheritDoc
     */
    public function createNewData($data)
    {
        DB::beginTransaction();
        try {

            if (!isset($data['credits_no'])) {
                $data['credits_no'] = $this->randomNo();
            }

            if (!isset($data['status'])) {
                $status = Config::get('const.status.no');
            }else{
                $status = $data['status'];
            }

            $attr = [
                'name' =>$data['name'],
                'status' =>$status,
                'credits_no' =>$data['credits_no'],
                'avoid_last_lesson'=>$data['avoid_last_lesson'],
                'block'=>$data['block'],
                'require_spacing'=>$data['require_spacing'],
                'require_class_room' =>$data['require_class_room'],
                'quantity_credits' =>$data['quantity_credits'],
            ];

            $this->subjectRepository->create($attr);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create new subject: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function filter($data)
    {
        return $this->subjectRepository->filter($data);
    }

    /**
     * @inheritDoc
     */
    public function findById($id)
    {
        return $this->subjectRepository->findById($id);
    }

    /**
     * @inheritDoc
     */
    public function saveUpdate($data)
    {
        DB::beginTransaction();
        try {

            if (!isset($data['credits_no'])) {
                $data['credits_no'] = $this->randomNo();
            }

            if (!isset($data['status'])) {
                $status = Config::get('const.status.no');
            }else{
                $status = $data['status'];
            }

            $attr = [
                'name' =>$data['name'],
                'status' =>$status,
                'credits_no' =>$data['credits_no'],
                'avoid_last_lesson'=>$data['avoid_last_lesson'],
                'block'=>$data['block'],
                'require_spacing'=>$data['require_spacing'],
                'require_class_room' =>$data['require_class_room'],
                'quantity_credits' =>$data['quantity_credits'],
            ];

            $this->subjectRepository->updateById($data['id'], $attr);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while update subject: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            $this->subjectRepository->deleteById($id);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while delete subject: ' . $e->getMessage());
            return false;
        }
    }
}
