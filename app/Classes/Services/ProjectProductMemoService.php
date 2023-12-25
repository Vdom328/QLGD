<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IProjectProductMemoRepository;
use App\Classes\Services\Interfaces\IProjectProductMemoService;

class ProjectProductMemoService extends BaseService implements IProjectProductMemoService
{
    protected $projectProductMemoRepository;

    public function __construct(
        IProjectProductMemoRepository $projectProductMemoRepository
    )
    {
        $this->projectProductMemoRepository = $projectProductMemoRepository;
    }
}
