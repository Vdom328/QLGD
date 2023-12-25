<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IEstSupplierAmountRepository;
use App\Classes\Services\Interfaces\IEstSupplierAmountService;


/**
 * Implement UserService
 */
class EstSupplierAmountService extends BaseService implements IEstSupplierAmountService
{
    private $estSupplierAmountRepository;

    public function __construct(IEstSupplierAmountRepository $estSupplierAmountRepository)
    {
        $this->estSupplierAmountRepository = $estSupplierAmountRepository;
    }
}
