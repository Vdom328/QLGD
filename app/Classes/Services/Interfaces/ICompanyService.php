<?php

namespace App\Classes\Services\Interfaces;

interface ICompanyService
{
    /**
     * Retrieve a list of all companies.
     *
     * @return \Illuminate\Database\Eloquent\Collection A collection of all companies.
     */
    public function getAllCompany();

    /**
     * Create a new company using the provided data.
     *
     * @param $data The data needed to create the company.
     *
     * @return \App\Models\Company The newly created company instance.
     */
    public function saveCreateCompany($data);

    /**
     * Retrieve a company by its unique identifier.
     *
     * @param int $id The unique identifier of the company.
     *
     * @return \App\Models\Company|null The company instance or null if not found.
     */
    public function getCompanyById($id);

    /**
     * Update an existing company using the provided data and identifier.
     *
     * @param $data The data needed to update the company.
     * @param int   $id   The unique identifier of the company to update.
     *
     * @return bool True if the update was successful; otherwise, false.
     */
    public function saveUpdateCompany($data, $id);

    /**
     * Delete a company by its ID.
     *
     * @param  int  $id The ID of the company to be deleted.
     * @return void
     */
    public function deleteCompanyById($id);
}
