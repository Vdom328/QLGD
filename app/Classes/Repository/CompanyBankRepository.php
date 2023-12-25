<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ICompanyBankRepository;
use App\Models\CompanyBank;

class CompanyBankRepository extends BaseRepository implements ICompanyBankRepository
{
    public function __construct(CompanyBank $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function getCompanyBanksByCompanyId($id)
    {
        return $this->model->where('company_id', $id)->get();
    }

    public function deleteAllCompanyBankByCompanyId($id)
    {
        return $this->model->where('company_id', $id)->delete();
    }
}
