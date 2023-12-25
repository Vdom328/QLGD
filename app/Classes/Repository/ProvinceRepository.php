<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IProvinceRepository;
use App\Models\Province;

class ProvinceRepository  extends BaseRepository implements IProvinceRepository
{
    public function __construct(Province $model)
    {
        parent::__construct($model);
    }
}
