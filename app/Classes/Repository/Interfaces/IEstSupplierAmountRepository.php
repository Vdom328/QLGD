<?php

namespace App\Classes\Repository\Interfaces;

interface IEstSupplierAmountRepository extends IBaseRepository
{
    public function deleteAllSupplierAmountByProductQuantityId($quantityId);
}
