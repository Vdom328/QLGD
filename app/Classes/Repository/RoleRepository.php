<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IRoleRepository;
use App\Models\Role;

class RoleRepository  extends BaseRepository implements IRoleRepository
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
