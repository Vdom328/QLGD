<?php

namespace App\Classes\Repository\Interfaces;

interface IPaymentTermRepository extends IBaseRepository
{
    public function getPaymentTermSupplier();

    public function getPaymentTermCustomer();
}
