<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IRoleUserRepository;
use App\Models\RoleUser;

class RoleUserRepository  extends BaseRepository implements IRoleUserRepository
{
    public function __construct(RoleUser $model)
    {
        parent::__construct($model);
    }
}
