<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ICategoryRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements ICategoryRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
