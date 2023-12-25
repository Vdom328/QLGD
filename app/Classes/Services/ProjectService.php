<?php

namespace App\Classes\Services;

use App\Classes\Enum\ProjectIsExprireDateEnum;
use App\Classes\Repository\Interfaces\IProjectProductMemoRepository;
use App\Classes\Repository\Interfaces\IProjectProductRepository;
use App\Classes\Repository\Interfaces\IProjectProductShippingFeesRepository;
use App\Classes\Repository\Interfaces\IProjectRelatedFileRepository;
use App\Classes\Repository\Interfaces\IProjectRepository;
use App\Classes\Services\Interfaces\IProjectService;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectService extends BaseService implements IProjectService
{
    private $projectRepository, $projectRelatedFileRepository, $projectProductRepository, $projectProductMemoRepository, $projectProductShippingFeesRepository;

    public function __construct(
        IProjectRepository            $projectRepository,
        IProjectRelatedFileRepository $projectRelatedFileRepository,
        IProjectProductRepository     $projectProductRepository,
        IProjectProductMemoRepository $projectProductMemoRepository,
        IProjectProductShippingFeesRepository $projectProductShippingFeesRepository
    )
    {
        $this->projectRepository = $projectRepository;
        $this->projectRelatedFileRepository = $projectRelatedFileRepository;
        $this->projectProductRepository = $projectProductRepository;
        $this->projectProductMemoRepository = $projectProductMemoRepository;
        $this->projectProductShippingFeesRepository = $projectProductShippingFeesRepository;
    }

    /**
     * @inheritdoc
     */
    public function getAllProject()
    {
        return $this->projectRepository->paginate(20);
    }

    public function searchAndFilter($request)
    {
        return $this->projectRepository->searchAndFilter($request);
    }

    /**
     * @inheritdoc
     */
    public function findId($id): \Illuminate\Database\Eloquent\Model
    {
        return $this->projectRepository->findById($id);
    }

    /**
     * @inheritdoc
     */
    public function saveOrUpdateRegister($data): array
    {
        // Data default return
        $dataResult = [
            'status' => true,
            'messageError' => '',
            'data' => [
                'filedNoError' => false
            ]
        ];
        try {
            DB::beginTransaction();

            $projectData = [
                'category_id' => (int)$data['category_id'],
                'no' => $data['no'],
                'parent_id' => $data['parent_id'] ?? null,
                'case_number' => $data['case_number'] ?? null,
                'name' => $data['name'],
                'status' => (int)$data['status'],
                'staff_id' => $data['staff_id'] ?? null,
                'customer_id' => $data['customer_id'] ?? null,
                'customer_manager_id' => $data['customer_manager_id'] ?? null,
                'exprire_date' => $data['exprire_date'],
                'is_exprire_date' => !empty($data['is_exprire_date']) ? ProjectIsExprireDateEnum::ON->value : ProjectIsExprireDateEnum::OFF->value,
                'payment_terms_setting_id' => $data['payment_terms_setting_id'] ?? null,
                'delivery_location' => $data['delivery_location'] ?? null,
                'inspection_fee' => $data['inspection_fee'] ?? null,
                'spares' => $data['spares'] ?? null,
                'accessories' => $data['accessories'] ?? null,
                'top_special_notes_1' => $data['top_special_notes_1'] ?? null,
                'top_special_notes_2' => $data['top_special_notes_2'] ?? null,
                'top_special_notes_3' => $data['top_special_notes_3'] ?? null,
                'top_special_notes_4' => $data['top_special_notes_4'] ?? null,
                'top_special_notes_5' => $data['top_special_notes_5'] ?? null,
                'shipping_address' => $data['shipping_address'] ?? null,
                'notices' => $data['notices'] ?? null,
                'memo' => $data['memo'] ?? null,
                'order_date' => $data['order_date'] ?? null,
                'receipt_order_date' => $data['receipt_order_date'],
                'completion_date' => $data['completion_date'] ?? null,
                'is_ordered' => !empty($data['is_ordered']) ? ProjectIsExprireDateEnum::ON->value : ProjectIsExprireDateEnum::OFF->value,
                'scheduled_billing_date' => $data['scheduled_billing_date'] ?? null,
                'is_invoice_issued' => !empty($data['is_invoice_issued']) ? ProjectIsExprireDateEnum::ON->value : ProjectIsExprireDateEnum::OFF->value,
                'planned_deposit_date' => $data['planned_deposit_date'] ?? null,
                'is_payment_confirmed' => !empty($data['is_payment_confirmed']) ? ProjectIsExprireDateEnum::ON->value : ProjectIsExprireDateEnum::OFF->value,
                'delivery_contact_date' => $data['delivery_contact_date'] ?? null,
                'confirmed_delivery_date_contact_date' => $data['confirmed_delivery_date_contact_date'] ?? null,
                'vehicle_type_and_size' => $data['vehicle_type_and_size'] ?? null,
                'driver_information' => $data['driver_information'] ?? null,
                'is_driver_information_sent' => !empty($data['is_driver_information_sent']) ? ProjectIsExprireDateEnum::ON->value : ProjectIsExprireDateEnum::OFF->value,
                'qr_number' => $data['qr_number'] ?? null,
                'et_payment_date' => $data['et_payment_date'] ?? null,
                'is_et_payment_date_sent' => !empty($data['is_et_payment_date_sent']) ? ProjectIsExprireDateEnum::ON->value : ProjectIsExprireDateEnum::OFF->value,
                'estimate_notes' => $data['estimate_notes'] ?? null,
                'purchase_order_notes' => $data['purchase_order_notes'] ?? null,
                'invoice_notes' => $data['invoice_notes'] ?? null,
            ];

            // Update
            if (!empty($data['id'])) {
                $id = (int)$data['id'];
                $projectEdit = $this->projectRepository->findById($id);
                // Check project edit not exist => return false
                if (!$projectEdit) {
                    $dataResult['status'] = false;
                    $dataResult['messageError'] = 'プロジェクトが存在しません!';
                    return $dataResult;
                }

                /* Check filed "no" */
                if ($projectEdit->no !== (int)$data['no']) {
                    // check field "no" is Exist
                    $checkNoIsset = $this->checkFieldNoExists($data['no']);
                    if ($checkNoIsset) {
                        $dataResult['status'] = false;
                        $dataResult['data']['filedNoError'] = true;
                    }
                } else {
                    unset($data['no']);
                }

                // Update project
                $this->projectRepository->updateById($projectEdit->id, $projectData);

                // Update related_files
                $this->projectRelatedFileRepository->updateRelatedFilesByProject($data, $projectEdit->id);


                // Update project_products
                $dataUpdate = $data['data_products_est'] ?? [];
                $this->projectProductRepository->updateByProject($dataUpdate, $projectEdit);

                // Update project
                $this->projectRepository->updateById($projectEdit->id, $projectData);
                // Update project_products memo
                $this->projectProductMemoRepository->updateByProject($data, $projectEdit);

                // Update project_products shipping fees
                $this->projectProductShippingFeesRepository->updateByProject($data, $projectEdit);

            } // Create
            else {
                $checkNoIsset = $this->checkFieldNoExists($data['no']);
                if ($checkNoIsset) {
                    $dataResult['status'] = false;
                    $dataResult['data']['filedNoError'] = true;
                } else {
                    // Create project
                    $projectCreate = $this->projectRepository->create($projectData);

                    // Create related_files
                    if (!empty($data['related_files']) && is_array($data['related_files'])) {
                        $this->projectRelatedFileRepository->insertRelatedFilesByProject($data['related_files'], $projectCreate->id);
                    }
                    // Create project_products
                    if (!empty($data['data_products_est'])) {
                        $this->projectProductRepository->insertByProject($data['data_products_est'], $projectCreate);
                    }
                    // Create project_products memo
                    if (!empty($data['data_memo_products_est'])) {
                        $this->projectProductMemoRepository->insertByProject($data['data_memo_products_est'], $projectCreate->id);
                    }
                    // Create project_products shipping fees
                    if (!empty($data['data_shipping_fees_products_est'])) {
                        $this->projectProductShippingFeesRepository->insertByProject($data['data_shipping_fees_products_est'], $projectCreate->id);
                    }

                }
            }

            DB::commit();
            return $dataResult;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while created project: ' . $e->getMessage());
            $dataResult['status'] = false;
            return $dataResult;
        }
    }

    /**
     * @inheritdoc
     */
    public function automaticNo(): int
    {
        $projects = $this->projectRepository->find();
        $maxNoProject = $projects->max('no');
        return $maxNoProject + 1;
    }

    /**
     * @inheritdoc
     */
    public function checkFieldNoExists($no): bool
    {
        $project = $this->projectRepository->findOne([
            'no' => $no,
        ]);
        return (bool)$project;
    }

    /**
     * @inheritDoc
     */
    public function filter($dataFilter)
    {
        return $this->projectRepository->filter($dataFilter);
    }

    /**
     * @inheritDoc
     */
    public function getByStaffId($staff_id, $key)
    {
        return $this->projectRepository->getByStaffId($staff_id, $key);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierByProject(Project $project) {
        $supplier = null;
        if ($project->projectProducts->count() > 0) {
            $projectProductSupplier = $project->projectProducts->whereNotNull('supplier_id');
            if ($projectProductSupplier->first()) {
                $supplier = $projectProductSupplier->first()->supplier;
            }
        }
        return $supplier;
    }

}
