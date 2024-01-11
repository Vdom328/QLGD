<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IClassRepository;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Config;

class ClassRepository  extends BaseRepository implements IClassRepository
{
    public function __construct(ClassModel $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function filter($data)
    {
        $query = $this->model;

        if (isset($data['status'])) {
            $query = $query->where('status', $data['status']);
        }
        if (isset($data['key'])) {
            $query = $query->where('name', 'LIKE', '%' . $data['key'] . '%')
                            ->orWhere('description', 'LIKE', '%' . $data['key'] . '%');
        }
        if (isset($data['column']) && isset($data['direction'])) {
            $query = $query->orderBy($data['column'], $data['direction']);
        }

        if (isset($data['paginate'])) {
           return $query->get();
        }

        return $query->paginate(paginate());
    }
}
