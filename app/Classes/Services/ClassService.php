<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IClassRepository;
use App\Classes\Services\Interfaces\IClassService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Implement UserService
 */
class ClassService extends BaseService implements IClassService
{
    private $classRepository;

    public function __construct(
        IClassRepository $classRepository,
    ) {
        $this->classRepository = $classRepository;
    }

    /**
     * @inheritDoc
     */
    public function createNewData($data)
    {
        DB::beginTransaction();
        try {

            if (!isset($data['status'])) {
                $status = Config::get('const.status.no');
            }else{
                $status = $data['status'];
            }
            $attr = [
                'name' =>$data['name'],
                'status' =>$status,
                'description'=>$data['description'],
            ];

            $this->classRepository->create($attr);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create new class: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function filter($data)
    {
        return $this->classRepository->filter($data);
    }

    /**
     * {@inheritdoc}
     */
    public function findById($id)
    {
        return $this->classRepository->findById($id);
    }

    /**
     * {@inheritdoc}
     */
    public function saveUpdate($data)
    {
        DB::beginTransaction();
        try {

            if (!isset($data['status'])) {
                $status = Config::get('const.status.no');
            }else{
                $status = $data['status'];
            }
            $attr = [
                'name' =>$data['name'],
                'status' =>$status,
                'description'=>$data['description'],
            ];

            $this->classRepository->updateById($data['id'],$attr);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while update class: ' . $e->getMessage());
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
            $this->classRepository->deleteById($id);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while delete class: ' . $e->getMessage());
            return false;
        }
    }
}
