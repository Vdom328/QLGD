<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IEstSupplierAmountRepository;
use App\Classes\Repository\Interfaces\IProjectRepository;
use App\Classes\Repository\Interfaces\ISupplierManagerRepository;
use App\Classes\Repository\Interfaces\ISupplierRepository;
use App\Classes\Services\Interfaces\ISupplierService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Implement UserService
 */
class SupplierService extends BaseService implements ISupplierService
{
    private $supplierRepository, $supplierManagerRepository, $estSupplierAmountRepository;

    public function __construct(
        ISupplierRepository $supplierRepository,
        ISupplierManagerRepository $supplierManagerRepository,
        IEstSupplierAmountRepository $estSupplierAmountRepository
    )
    {
        $this->supplierRepository = $supplierRepository;
        $this->supplierManagerRepository = $supplierManagerRepository;
        $this->estSupplierAmountRepository = $estSupplierAmountRepository;
    }

    public function getAllSupplier()
    {
        return $this->supplierRepository->find();
    }

    /**
     * @inheritdoc
     */
    public function saveCreate($data)
    {
        DB::beginTransaction();
        try {
            $attrSupplier = [
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
            $supplier = $this->supplierRepository->create($attrSupplier);
            $attrManagers = [];
            foreach ($data['managers'] as $item) {
                $attrManagers[] = [
                    "supplier_id" => $supplier->id,
                    "name" => $item['name_managers'],
                    "email" => $item['email_managers'],
                    "phone" => $item['phone_managers'],
                    "person_in_charge_id" => $item['person_in_charge_id'],
                ];
            }
            $supplierManager = $this->supplierManagerRepository->insert($attrManagers);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while create supplier: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function radomSupplierCode()
    {
        // If the number is not unique, generate a new one
        for ($code = 1; $code <= 99999; $code++) {
            $exists = $this->supplierRepository->exists($code);
            if (!$exists) {
                return str_pad($code, 5, '0', STR_PAD_LEFT);
            }
        }
        return $code;
    }

    /**
     * @inheritDoc
     */
    public function getListSupplier($data)
    {
        return $this->supplierRepository->getListSupplier($data);
    }

    /**
     * @inheritDoc
     */
    public function sortSupplier($data)
    {
        return $this->supplierRepository->sortSupplier($data);
    }

    /**
     * @inheritDoc
     */
    public function findById($id)
    {
        return $this->supplierRepository->findById($id);
    }

    /**
     * update supplier by id
     * @inheritDoc
     */
    public function updateSupplierById($data,$id)
    {
        DB::beginTransaction();
        try {
            $supplier = $this->supplierRepository->findById($id);
            if (!$supplier) {
                return false;
            }
            $attrSupplier = [
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
            $supplier = $this->supplierRepository->update($supplier ,$attrSupplier);
            $deleteManagers = $this->supplierManagerRepository->deleteManagersSupplierById($id);
            $attrManagers = [];
            foreach ($data['managers'] as $item) {
                $attrManagers[] = [
                    "supplier_id" => $id,
                    "name" => $item['name_managers'],
                    "email" => $item['email_managers'],
                    "phone" => $item['phone_managers'],
                    "person_in_charge_id" => $item['person_in_charge_id'],
                ];
            }
            $supplierManager = $this->supplierManagerRepository->insert($attrManagers);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while update supplier: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $exist = $this->estSupplierAmountRepository->find(['supplier_id' => $id]);
            if ($exist->count() >= 1) {
                return false;
            }

            $deleteSupplierManager = $this->supplierManagerRepository->deleteManagersSupplierById($id);

            $deleteSupplier = $this->supplierRepository->deleteById($id);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while delete supplier: ' . $e->getMessage());
            return false;
        }
    }

}
