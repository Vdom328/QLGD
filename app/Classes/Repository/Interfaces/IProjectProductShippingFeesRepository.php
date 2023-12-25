<?php

namespace App\Classes\Repository\Interfaces;

use App\Models\Project;

interface IProjectProductShippingFeesRepository extends IBaseRepository
{
    /**
     * Insert shipping fees
     */
    public function insertByProject($data, $projectId);

    /**
     * Update shipping fees
     */
    public function updateByProject($data, Project $project);
}
