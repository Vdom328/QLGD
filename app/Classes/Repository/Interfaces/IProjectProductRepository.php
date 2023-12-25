<?php

namespace App\Classes\Repository\Interfaces;

use App\Models\Project;

interface IProjectProductRepository extends IBaseRepository
{
    /**
     * Insert by project
     */
    public function insertByProject($dataProducts,Project $project);

    /**
     * Update by project
     */
    public function updateByProject($dataProducts, Project $project);

    /**
     * Update project products ids system
     */
    public function updateByProjectSystem($dataProducts, Project $project);

    /**
     * Update project products handmade
     */
    public function updateProjectHandmade($dataProducts, Project $project);

    /**
     * Delete by Ids
     */
    public function deleteByIds(array $ids);

    public function getByProductId($id);
}
