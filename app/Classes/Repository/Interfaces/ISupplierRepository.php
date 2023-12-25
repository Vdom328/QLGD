<?php

namespace App\Classes\Repository\Interfaces;

interface ISupplierRepository extends IBaseRepository
{
    public function exists($code);

    public function sortSupplier($data);

    public function getListSupplier($data);
}
