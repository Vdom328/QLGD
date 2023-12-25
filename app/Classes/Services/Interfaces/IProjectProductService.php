<?php

namespace App\Classes\Services\Interfaces;

use App\Models\Project;

interface IProjectProductService
{
    /**
     * Calculate the total est
     */
    public function calculateTotalEst(Project $project): array;
}
