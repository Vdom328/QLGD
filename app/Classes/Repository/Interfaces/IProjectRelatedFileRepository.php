<?php

namespace App\Classes\Repository\Interfaces;

interface IProjectRelatedFileRepository extends IBaseRepository
{
    /**
     * Insert related files by project ID
     */
    public function insertRelatedFilesByProject($data, $projectId);

    /**
     * Update related files by project ID
     */
    public function updateRelatedFilesByProject($data, $projectId);

    /**
     *  Removes related files by url project ID
     */
    public function removeRelatedFilesByUrlProject($projectId);
}
