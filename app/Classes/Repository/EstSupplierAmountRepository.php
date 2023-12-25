<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IEstSupplierAmountRepository;
use App\Models\EstSupplierAmount;

class EstSupplierAmountRepository extends BaseRepository implements IEstSupplierAmountRepository
{
    public function __construct(EstSupplierAmount $model)
    {
        parent::__construct($model);
    }

    public function deleteAllSupplierAmountByProductQuantityId($quantityId)
    {
        $this->model->whereIn('est_product_quantity_id', $quantityId)->delete();
    }
}
