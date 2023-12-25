<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ICustomerManagerRepository;
use App\Models\CustomerManagers;

class CustomerManagerRepository  extends BaseRepository implements ICustomerManagerRepository
{
    public function __construct(CustomerManagers $model)
    {
        parent::__construct($model);
    }
    
    /**
     * @inheritDoc
     */
    public function deleteManagersByCustomerId($id)
    {
        return $this->model->where('customer_id', $id)->delete();
    }
}
