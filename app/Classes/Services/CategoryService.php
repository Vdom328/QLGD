<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\ICategoryRepository;
use App\Classes\Services\Interfaces\ICategoryService;

/**
 * Implement UserService
 */
class CategoryService extends BaseService implements ICategoryService
{
    private $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @inheritdoc
     */
    public function getAllCategory()
    {
        return $this->categoryRepository->find();
    }
}
