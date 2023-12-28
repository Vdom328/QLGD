<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IClassRoomRepository;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Config;

class ClassRoomRepository  extends BaseRepository implements IClassRoomRepository
{
    public function __construct(ClassRoom $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function filter($data)
    {
        return $this->model->paginate(Config::get('const.pagination'));
    }
}
