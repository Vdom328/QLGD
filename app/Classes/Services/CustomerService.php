<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\ICustomerManagerRepository;
use App\Classes\Repository\Interfaces\ICustomerRepository;
use App\Classes\Repository\Interfaces\IProjectRepository;
use App\Classes\Services\Interfaces\ICustomerService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Implement UserService
 */
class CustomerService extends BaseService implements ICustomerService
{
    private $customerRepository, $customerManagerRepository, $projectRepository;

    public function __construct(
        ICustomerRepository $customerRepository,
        ICustomerManagerRepository $customerManagerRepository,
        IProjectRepository $projectRepository
    )
    {
        $this->customerRepository = $customerRepository;
        $this->customerManagerRepository = $customerManagerRepository;
        $this->projectRepository = $projectRepository;
    }

    public function getAllCustomer()
    {
        return $this->customerRepository->find();
    }

    /**
     * @inheritDoc
     */
    public function getListCustomer($data)
    {
        return $this->customerRepository->getListCustomer($data);
    }

    /**
     * @inheritDoc
     */
    public function radomCustomerCode()
    {
        // If the number is not unique, generate a new one
        for ($code = 1; $code <= 99999; $code++) {
            $exists = $this->customerRepository->exists($code);
            if (!$exists) {
                return str_pad($code, 5, '0', STR_PAD_LEFT);
            }
        }
        return $code;
    }

    /**
     * @inheritDoc
     */
    public function saveCreate($data)
    {
        DB::beginTransaction();
        try {
            $attrCustomer = [
                "code" => $data['code'],
                "invoice_number" => $data['invoice_number'],
                "name" => $data['name'],
                "postcode" => ($data['postcode-first'] ?? '') . ($data['postcode-last'] ?? ''),
                "prefecture_id" => $data['prefecture_id'],
                "address" => $data['address'],
                "building_name" => $data['building_name'],
                "phone" => $data['phone'],
                "fax" => $data['fax'],
                "email" => $data['email'],
                "payment_terms" => $data['payment_terms'],
                "credit_limit" => $data['credit_limit'],
                "memo" => $data['memo'],
            ];
            $customer = $this->customerRepository->create($attrCustomer);
            $attrManagers = [];
            foreach ($data['managers'] as $item) {
                $attrManagers[] = [
                    "customer_id" => $customer->id,
                    "name" => $item['name_managers'],
                    "email" => $item['email_managers'],
                    "phone" => $item['phone_managers'],
                    "person_in_charge_id" => $item['person_in_charge_id'],
                ];
            }
            $customerManager = $this->customerManagerRepository->insert($attrManagers);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create customer: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function findById($id)
    {
        return $this->customerRepository->findById($id);
    }

    /**
     * @inheritDoc
     */
    public function updateCustomerById($data,$id)
    {
        DB::beginTransaction();
        try {
            $customer = $this->customerRepository->findById($id);
            if (!$customer) {
                return false;
            }
            $attrCustomer = [
                "code" => $data['code'],
                "invoice_number" => $data['invoice_number'],
                "name" => $data['name'],
                "postcode" => ($data['postcode-first'] ?? '') . ($data['postcode-last'] ?? ''),
                "prefecture_id" => $data['prefecture_id'],
                "address" => $data['address'],
                "building_name" => $data['building_name'],
                "phone" => $data['phone'],
                "fax" => $data['fax'],
                "email" => $data['email'],
                "payment_terms" => $data['payment_terms'],
                "credit_limit" => $data['credit_limit'],
                "memo" => $data['memo'],
            ];
            $customer = $this->customerRepository->update($customer ,$attrCustomer);
            $deleteManagers = $this->customerManagerRepository->deleteManagersByCustomerId($id);
            $attrManagers = [];
            foreach ($data['managers'] as $item) {
                $attrManagers[] = [
                    "customer_id" => $id,
                    "name" => $item['name_managers'],
                    "email" => $item['email_managers'],
                    "phone" => $item['phone_managers'],
                    "person_in_charge_id" => $item['person_in_charge_id'],
                ];
            }
            $customerManager = $this->customerManagerRepository->insert($attrManagers);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while update customer: ' . $e->getMessage());
            return false;
        }
    }

    public function find(array $conditions = []): \Illuminate\Database\Eloquent\Collection
    {
       return $this->customerRepository->find($conditions);
    }

    /**
     * @inheritDoc
     */
    public function getByStaffIdInCustomerManager($staffId) {
        return $this->customerRepository->getByStaffIdInCustomerManager($staffId);
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $exist = $this->projectRepository->find(['customer_id' => $id]);
            if ($exist->count() >= 1) {
                return false;
            }

            $deleteCustomerManager = $this->customerManagerRepository->deleteManagersByCustomerId($id);

            $deleteCustomer = $this->customerRepository->deleteById($id);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while delete customer: ' . $e->getMessage());
            return false;
        }
    }
}
