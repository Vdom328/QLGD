<?php

namespace App\Classes\Repository\Interfaces;

interface ICustomerRepository extends IBaseRepository
{
    public function exists($code);

    public function getListCustomer($data);

    public function sortCustomer($data);

    /**
     * Get customers by "staff_id" in Customer Manager
     */
    public function getByStaffIdInCustomerManager($staffId);
}
