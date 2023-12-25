<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IProfileRepository;
use App\Models\Profile;

class ProfileRepository extends BaseRepository implements IProfileRepository
{
    public function __construct(Profile $model)
    {
        parent::__construct($model);
    }

    public function exists($staffNo)
    {
        return $this->model->where('staff_no', $staffNo)->exists();
    }
}
