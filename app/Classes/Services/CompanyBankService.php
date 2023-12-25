<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\ICompanyBankRepository;
use App\Classes\Services\Interfaces\ICompanyBankService;

/**
 * Implement UserService
 */
class CompanyBankService extends BaseService implements ICompanyBankService
{
    private $companyBankRepository;

    public function __construct(ICompanyBankRepository $companyBankRepository)
    {
        $this->companyBankRepository = $companyBankRepository;
    }
}
