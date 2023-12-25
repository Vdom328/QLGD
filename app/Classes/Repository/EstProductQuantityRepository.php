<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IEstProductQuantityRepository;
use App\Models\EstProductQuantity;

class EstProductQuantityRepository extends BaseRepository implements IEstProductQuantityRepository
{
    public function __construct(EstProductQuantity $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function deleteAllProductQuantityByProductId($id)
    {
        return $this->model->where('est_product_id', $id)->delete();
    }

    /**
     * @inheritdoc
     */
    public function getQuantityIdByProductId($id)
    {
        return $this->model->where('est_product_id', $id)->pluck('id');
    }
}
