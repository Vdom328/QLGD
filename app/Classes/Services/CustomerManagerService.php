<?php

namespace App\Classes\Services;

use Illuminate\Database\Eloquent\Collection;

use App\Classes\Repository\Interfaces\ICustomerManagerRepository;
use App\Classes\Services\Interfaces\ICustomerManagerService;

class CustomerManagerService implements ICustomerManagerService
{
    protected $customerManagerRepository;

    public function __construct(
        ICustomerManagerRepository $customerManagerRepository
    )
    {
        $this->customerManagerRepository = $customerManagerRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAllCustomerManager(): Collection
    {
        return $this->customerManagerRepository->find();
    }

    /**
     * @inheritDoc
     */
    public function find(array $conditions = []): Collection
    {
        return $this->customerManagerRepository->find($conditions);
    }
}
