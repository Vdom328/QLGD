<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\ICompanyBankRepository;
use App\Classes\Repository\Interfaces\ICompanyRepository;
use App\Classes\Repository\Interfaces\IProjectRepository;
use App\Classes\Services\Interfaces\ICompanyService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

/**
 * Implement UserService
 */
class CompanyService extends BaseService implements ICompanyService
{
    private $companyRepository;
    private $companyBankRepository;
    private $projectRepository;

    public function __construct(ICompanyRepository $companyRepository, ICompanyBankRepository $companyBankRepository, IProjectRepository $projectRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->companyBankRepository = $companyBankRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @inheritdoc
     */
    public function getAllCompany()
    {
        return $this->companyRepository->paginate(20);
    }

    /**
     * @inheritdoc
     */
    public function saveCreateCompany($data)
    {
        DB::beginTransaction();
        try {
            $postCode = $data['post_code_first'] . $data['post_code_last'];

            $company = [
                'name' => $data['name'],
                'invoice_number' => $data['invoice_number'],
                'postcode' => $postCode,
                'prefecture_id' => $data['prefecture_id'],
                'address' => $data['address'],
                'building_name' => $data['building_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'closing_date' => $data['closing_date'],
            ];

            if ($data->hasFile('logo') && $data->file('logo')) {
                $company['logo'] = $data->file('logo')->hashName();

                Storage::disk('public')->put('company', $data->file('logo'));
            }

            $company = $this->companyRepository->create($company);

            $banks = $data['banks'];
            if ($data['banks']) {
                $banks = json_decode($data['banks']);
                $this->saveBanks($company->id, $banks);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while created company: ' . $e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public function getCompanyById($id)
    {
        return $this->companyRepository->findById($id);
    }

    /**
     * @inheritdoc
     */
    public function saveUpdateCompany($data, $id)
    {
        DB::beginTransaction();
        try {
            $postCode = $data['post_code_first'] . $data['post_code_last'];

            $company = [
                'name' => $data['name'],
                'invoice_number' => $data['invoice_number'],
                'postcode' => $postCode,
                'prefecture_id' => $data['prefecture_id'],
                'address' => $data['address'],
                'building_name' => $data['building_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'closing_date' => $data['closing_date'],
            ];

            if (isset($data['logo'])) {

                $this->companyRepository->deleteLogoCompany($id);

                if ($data->hasFile('logo') && $data->file('logo')) {
                    $company['logo'] = $data->file('logo')->hashName();

                    Storage::disk('public')->put('company', $data->file('logo'));
                }
            }

            $this->companyRepository->updateById($id, $company);

            if (!empty($data['company_bank_id'])) {
                $existingCompanyBanks = $this->companyBankRepository->getCompanyBanksByCompanyId($id);
                foreach ($existingCompanyBanks as $companyBank) {
                    if (!in_array($companyBank->id, $data['company_bank_id'])) {
                        $this->companyBankRepository->deleteById($companyBank->id);
                    }
                }
            }

            if (empty($data['company_bank_id'])) {
                $this->companyBankRepository->deleteAllCompanyBankByCompanyId($id);
            }

            $banks = $data['banks'];
            if ($data['banks']) {
                $banks = json_decode($data['banks']);
                $this->saveBanks($id, $banks);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while updating company: ' . $e->getMessage());
        }
    }

    /**
     * Update or add new banks for a company
     */
    private function saveBanks($companyId, $banks)
    {
        foreach ($banks as $key => $value) {
            $attr = [];
            // build attribute for model bank
            foreach ($value as $item) {
                $name = $item->name;
                $val = $item->value;

                if (str_contains($name, 'company_bank_id')) {
                    continue;
                }

                if (str_contains($name, 'account_type')) {
                    $attr['account_type'] = $val;
                    continue;
                }

                if (str_contains($name, 'bank_id')) {
                    $attr['id'] = $val;
                    continue;
                }

                $attr[$name] = $val;
            }

            // case add new if not exists bank id
            if (empty($attr['id']) || $attr['id'] <= 0) {
                $attr['company_id'] = $companyId;
                $this->companyBankRepository->create($attr);
            } else {
                // case update if exists bank id
                $companyBank = $this->companyBankRepository->findById($attr['id']);
                if ($companyBank) {
                    $companyBank->update($attr);
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function deleteCompanyById($id)
    {
        $existingProjects = $this->projectRepository->getProjectByCompanyId($id);

        if (!$existingProjects) {
            $this->companyRepository->deleteById($id);

            $this->companyBankRepository->deleteAllCompanyBankByCompanyId($id);

            return  true;
        } else {
            return false;
        }
    }
}
