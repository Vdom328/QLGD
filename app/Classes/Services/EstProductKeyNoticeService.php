<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IEstProductNoticeRepository;
use App\Classes\Services\Interfaces\IEstProductKeyNoticeService;


/**
 * Implement UserService
 */
class EstProductKeyNoticeService extends BaseService implements IEstProductKeyNoticeService
{
    private $estProductNoticeRepository;

    public function __construct(IEstProductNoticeRepository $estProductNoticeRepository)
    {
        $this->estProductNoticeRepository = $estProductNoticeRepository;
    }
}
