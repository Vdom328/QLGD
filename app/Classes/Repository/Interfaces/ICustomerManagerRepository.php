<?php

namespace App\Classes\Repository\Interfaces;

interface ICustomerManagerRepository extends IBaseRepository
{

    /**
     * delete
     */
    public function deleteManagersByCustomerId($id);
}
