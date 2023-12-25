<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\ICompanyRepository;
use App\Models\Company;

class CompanyRepository extends BaseRepository implements ICompanyRepository
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    public function deleteLogoCompany($id)
    {
        return $this->model->where('id', $id)->update(['logo' => null]);
    }
}
