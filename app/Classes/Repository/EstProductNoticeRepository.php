<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IEstProductNoticeRepository;
use App\Models\EstProductNotice;

class EstProductNoticeRepository extends BaseRepository implements IEstProductNoticeRepository
{
    public function __construct(EstProductNotice $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function deleteAllProductNoticeByProductId($id)
    {
        return $this->model->where('est_product_id', $id)->delete();
    }
}
