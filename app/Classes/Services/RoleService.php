<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IRoleRepository;
use App\Classes\Services\Interfaces\IRoleService;

/**
 * Implement UserService
 */
class RoleService extends BaseService implements IRoleService
{
    private $roleRepository;

    public function __construct(IRoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * get list role
     */
    public function getListRole()
    {
        return $this->roleRepository->find();
    }
}
