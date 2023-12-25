<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IProvinceRepository;
use App\Classes\Services\Interfaces\IProvinceService;

/**
 * Implement UserService
 */
class ProvinceService extends BaseService implements IProvinceService
{
    private $provinceRepository;

    public function __construct(IProvinceRepository $provinceRepository)
    {
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * get list role
     */
    public function getListProvince()
    {
        return $this->provinceRepository->find();
    }
}
