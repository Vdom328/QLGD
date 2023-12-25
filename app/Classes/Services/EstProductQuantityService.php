<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IEstProductQuantityRepository;
use App\Classes\Services\Interfaces\IEstProductQuantityService;


/**
 * Implement UserService
 */
class EstProductQuantityService extends BaseService implements IEstProductQuantityService
{
    private $estProductQuantityRepository;

    public function __construct(IEstProductQuantityRepository $estProductQuantityRepository)
    {
        $this->estProductQuantityRepository = $estProductQuantityRepository;
    }
}
