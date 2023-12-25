<?php

namespace App\Classes\Repository\Interfaces;

interface ICompanyRepository extends IBaseRepository
{
    /**
     * Delete the logo of a company by its unique identifier.
     *
     * @param int $id The unique identifier of the company.
     *
     * @return bool True if the logo was successfully deleted; otherwise, false.
     */
    public function deleteLogoCompany($id);
}
