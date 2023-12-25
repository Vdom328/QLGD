<?php

namespace App\Classes\Repository;

use App\Classes\Enum\StatusPaymentTermEnum;
use App\Classes\Enum\TypePaymentTermEnum;
use App\Classes\Repository\Interfaces\IPaymentTermRepository;
use App\Models\PaymentTermsSetting;

class PaymentTermRepository extends BaseRepository implements IPaymentTermRepository
{
    public function __construct(PaymentTermsSetting $model)
    {
        parent::__construct($model);
    }

    /**
     * get list payment term supplier
     * status == on
     * type == supplier
     */
    public function getPaymentTermSupplier()
    {
        return $this->model->where('status', StatusPaymentTermEnum::ON)
                            ->where('type', TypePaymentTermEnum::supplier)
                            ->get();
    }


    /**
     * get list payment term customer
     * status == on
     * type == customer
     */
    public function getPaymentTermCustomer()
    {
        return $this->model->where('status', StatusPaymentTermEnum::ON)
                            ->where('type', TypePaymentTermEnum::customer)
                            ->get();
    }
}
