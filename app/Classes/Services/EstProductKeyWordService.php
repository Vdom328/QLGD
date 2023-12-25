<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IEstProductKeyWordRepository;
use App\Classes\Services\Interfaces\IEstProductKeyWordService;


/**
 * Implement UserService
 */
class EstProductKeyWordService extends BaseService implements IEstProductKeyWordService
{
    private $estProductKeyWordRepository;

    public function __construct(IEstProductKeyWordRepository $estProductKeyWordRepository)
    {
        $this->estProductKeyWordRepository = $estProductKeyWordRepository;
    }
}
