<?php

namespace App\Classes\Services;

use App\Classes\Enum\StatusPaymentTermEnum;
use App\Classes\Enum\TypePaymentTermEnum;
use App\Classes\Repository\Interfaces\ICustomerRepository;
use App\Classes\Repository\Interfaces\IPaymentTermRepository;
use App\Classes\Repository\Interfaces\IProjectRepository;
use App\Classes\Repository\Interfaces\ISupplierRepository;
use App\Classes\Services\Interfaces\IPaymentTermService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Implement UserService
 */
class PaymentTermService extends BaseService implements IPaymentTermService
{
    private $paymentTermRepository, $customerRepository, $projectRepository, $supplierRepository;

    public function __construct(
        IPaymentTermRepository $paymentTermRepository,
        ICustomerRepository $customerRepository,
        IProjectRepository $projectRepository,
        ISupplierRepository $supplierRepository
        )
    {
        $this->paymentTermRepository = $paymentTermRepository;
        $this->customerRepository = $customerRepository;
        $this->projectRepository = $projectRepository;
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        return $this->paymentTermRepository->find();
    }

    /**
     * @inheritDoc
     */
    public function getPaymentTermSupplier()
    {
        return $this->paymentTermRepository->getPaymentTermSupplier();
    }


    /**
     * @inheritDoc
     */
    public function getPaymentTermCustomer()
    {
        return $this->paymentTermRepository->getPaymentTermCustomer();
    }

    /**
     * @inheritDoc
     */
    public function createPaymentTerm($data)
    {
        DB::beginTransaction();
        try {
            $attr = [
                "name" => $data['name'],
                "standard_type" => $data['standard_type'],
                "standard_value" => $data['standard_value'],
                "standard_unit" => $data['standard_unit'],
                "status" => StatusPaymentTermEnum::ON->value,
                "type" => $data['type'],
            ];
            $this->paymentTermRepository->create($attr);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create payment term : ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function findById($id)
    {
        return $this->paymentTermRepository->findById($id);
    }

    /**
     * @inheritDoc
     */
    public function updatePaymentTerm($data,$id)
    {
        DB::beginTransaction();
        try {
            $model = $this->paymentTermRepository->findById($id);
            $attr = [
                "name" => $data['name'],
                "standard_type" => $data['standard_type'],
                "standard_value" => $data['standard_value'],
                "standard_unit" => $data['standard_unit'],
                "status" => StatusPaymentTermEnum::ON->value,
                "type" => $data['type'],
            ];
            $this->paymentTermRepository->update($model,$attr);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while update payment term : ' . $e->getMessage());
            return false;
        }
    }


    /**
     * @inheritDoc
     */
    public function delete($id) : bool
    {
        DB::beginTransaction();
        try {

            $existCustomer = $this->customerRepository->find(['payment_terms' => $id]);
            if ($existCustomer->count() >= 1) {
                return false;
            }

            $existProject = $this->projectRepository->find(['payment_terms_setting_id' => $id]);
            if ($existProject->count() >= 1) {
                return false;
            }

            $existSupplier = $this->supplierRepository->find(['payment_terms' => $id]);
            if ($existSupplier->count() >= 1) {
                return false;
            }

            $delete = $this->paymentTermRepository->deleteById($id);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while deleted payment term : ' . $e->getMessage());
            return false;
        }
    }
}

