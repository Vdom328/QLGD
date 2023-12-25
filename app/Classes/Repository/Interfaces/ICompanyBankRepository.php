<?php

namespace App\Classes\Repository\Interfaces;

interface ICompanyBankRepository extends IBaseRepository
{
    /**
     * Get a collection of banks associated with a company based on the company's unique identifier.
     *
     * @param int $id The unique identifier of the company.
     *
     * @return \Illuminate\Database\Eloquent\Collection A collection of banks associated with the company.
     */
    public function getCompanyBanksByCompanyId($id);

    public function deleteAllCompanyBankByCompanyId($id);
}
