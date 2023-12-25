<?php

namespace App\Classes\Services\Interfaces;

use App\Models\Project;

interface IProjectService
{

    /**
     * Get all projects
     */
    public function getAllProject();

    public function searchAndFilter($request);

    /**
     * Find by id project
     */
    public function findId($id): \Illuminate\Database\Eloquent\Model;

    /**
     * Save or update register project
     */
    public function saveOrUpdateRegister($data): array;

    /**
     * auto rend field "no"
     */
    public function automaticNo(): int;

    /**
     * Check if the data field "no" exists?
     */
    public function checkFieldNoExists($no): bool;

    /**
     * Filter projects
     */
    public function filter($dataFilter);

    /**
     * get project by staff id
     * @param int $id
     * @param mixed $key
     */
    public function getByStaffId($staff_id,$key);

    /**
     * Get supplier by project
     */
    public function getSupplierByProject(Project $project);

}
