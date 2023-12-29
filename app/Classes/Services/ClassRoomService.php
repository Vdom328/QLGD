<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IClassRoomRepository;
use App\Classes\Repository\Interfaces\IProfileRepository;
use App\Classes\Services\Interfaces\IClassRoomService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Implement UserService
 */
class ClassRoomService extends BaseService implements IClassRoomService
{
    private $classRoomRepository;

    public function __construct(
        IClassRoomRepository $classRoomRepository,
    ) {
        $this->classRoomRepository = $classRoomRepository;
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

            $this->classRoomRepository->create($attr);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create new class room: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function filter($data)
    {
        return $this->classRoomRepository->filter($data);
    }

    /**
     * {@inheritdoc}
     */
    public function findById($id)
    {
        return $this->classRoomRepository->findById($id);
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

            $this->classRoomRepository->updateById($data['id'],$attr);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while update class room: ' . $e->getMessage());
            return false;
        }
    }
}
