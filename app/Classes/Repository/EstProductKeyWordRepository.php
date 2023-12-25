<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IEstProductKeyWordRepository;
use App\Models\EstProductKeyWord;

class EstProductKeyWordRepository extends BaseRepository implements IEstProductKeyWordRepository
{
    public function __construct(EstProductKeyWord $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function deleteAllProductKeyWordByProductId($id)
    {
        return $this->model->where('est_product_id', $id)->delete();
    }
}
