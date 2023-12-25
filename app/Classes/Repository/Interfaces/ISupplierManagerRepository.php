<?php

namespace App\Classes\Repository\Interfaces;

interface ISupplierManagerRepository extends IBaseRepository
{
    /**
     * delete
     */
    public function deleteManagersSupplierById($id);
}
