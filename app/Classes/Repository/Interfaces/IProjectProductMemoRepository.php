<?php

namespace App\Classes\Repository\Interfaces;

use App\Models\Project;

interface IProjectProductMemoRepository extends IBaseRepository
{

    /**
     * Insert by project id
     */
    public function insertByProject($dataMemoProductsEst, $projectId);

    /**
     * Update by project id
     */
    public function updateByProject($data, Project $project);
}
