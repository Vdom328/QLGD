<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IProjectRelatedFileRepository;
use App\Classes\Services\Interfaces\IProjectRelatedFileService;

class ProjectRelatedFileService extends BaseService implements IProjectRelatedFileService
{
    private $projectRelatedFileRepository;

    public function __construct(
        IProjectRelatedFileRepository $projectRelatedFileRepository
    )
    {
        $this->projectRelatedFileRepository = $projectRelatedFileRepository;
    }
}
