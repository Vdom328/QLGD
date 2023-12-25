<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ISupplierManagerRepository;
use App\Models\SupplierManagers;

class SupplierManagerRepository  extends BaseRepository implements ISupplierManagerRepository
{
    public function __construct(SupplierManagers $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function deleteManagersSupplierById($id)
    {
        return $this->model->where('supplier_id', $id)->delete();
    }
}
