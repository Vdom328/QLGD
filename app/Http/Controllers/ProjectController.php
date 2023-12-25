<?php

namespace App\Http\Controllers;

use App\Classes\Enum\ProjectStatusEnum;
use App\Classes\Services\Interfaces\ICategoryService;
use App\Classes\Services\Interfaces\ICompanyService;
use App\Classes\Services\Interfaces\ICustomerManagerService;
use App\Classes\Services\Interfaces\ICustomerService;
use App\Classes\Services\Interfaces\IEstProductService;
use App\Classes\Services\Interfaces\IPaymentTermService;
use App\Classes\Services\Interfaces\IProjectProductService;
use App\Classes\Services\Interfaces\IProjectService;
use App\Classes\Services\Interfaces\ISupplierService;
use App\Classes\Services\Interfaces\IUserService;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $categoryService, $projectService, $userService, $customerManagerService,
            $customerService, $paymentTermService, $estProductService, $companyService,
            $supplierService, $projectProductService;

    public function __construct(
        ICategoryService $categoryService,
        IProjectService  $projectService,
        IUserService $userService,
        ICustomerManagerService $customerManagerService,
        ICustomerService $customerService,
        IPaymentTermService $paymentTermService,
        IEstProductService $estProductService,
        ICompanyService $companyService,
        ISupplierService $supplierService,
        IProjectProductService $projectProductService,
    )
    {
        $this->categoryService = $categoryService;
        $this->projectService = $projectService;
        $this->customerManagerService = $customerManagerService;
        $this->userService = $userService;
        $this->customerService = $customerService;
        $this->paymentTermService = $paymentTermService;
        $this->estProductService = $estProductService;
        $this->companyService = $companyService;
        $this->supplierService = $supplierService;
        $this->projectProductService = $projectProductService;
    }

    /**
     * list project
     */
    public function index()
    {
        $statusValues = $this->getStatus();
        $categories = $this->categoryService->getAllCategory();
        $projects = $this->projectService->getAllProject();
        $staffs = $this->userService->getListUser();
        $customers = $this->customerService->getAllCustomer();
        $supplies = $this->supplierService->getAllSupplier();
        $paymentTerms = $this->paymentTermService->getAll();
        return view('pages.project.list', compact(
            'statusValues',
            'categories',
            'projects',
            'staffs',
            'customers',
            'paymentTerms',
            'supplies'
        ));
    }

    /**
     * Get register project blade
     */
    public function register(Request $request)
    {
        $categoryId = $request->category_id;
        $statusValues = $this->getStatus();
        $categories = $this->categoryService->getAllCategory();

        $categorySelect = $categories->first();
        if (!empty($categoryId) && $categories->count() > 0) {
            $categorySelect = $categories->where('id', (int)$categoryId)->first() ?? $categorySelect;
        }

        $paymentTerms = $this->paymentTermService->getAll();
        $staffs = $this->userService->getListUser();
        $companies = $this->companyService->getAllCompany();

        $project = null;
        $supplier = null;
        $calculateTotalEst = [];
        if ($request->copyProjectId) {
            $project = $this->projectService->findId((int)$request->copyProjectId);
            $supplier = $this->projectService->getSupplierByProject($project);
            $categorySelect = $project->category;
            $calculateTotalEst = $this->projectProductService->calculateTotalEst($project);
        }

        return view('pages.project.register', compact(
            'statusValues',
            'categories',
            'paymentTerms',
            'categorySelect',
            'staffs',
            'companies',
            'project',
            'supplier',
            'calculateTotalEst'
        ));
    }

    /**
     * Get edit project blade
     */
    public function update(Request $request,$id)
    {
        $categoryId = $request->category_id;
        $categories = $this->categoryService->getAllCategory();
        $project = $this->projectService->findId($id);
        $supplier = $this->projectService->getSupplierByProject($project);
        $calculateTotalEst = $this->projectProductService->calculateTotalEst($project);

        if (!empty($categoryId) && $categories->count() > 0) {
            $categorySelect = $categories->first();
            $categorySelect = $categories->where('id', (int)$categoryId)->first() ?? $categorySelect;
        } else {
            $categorySelect = $project->category;
        }

        $statusValues = $this->getStatus();
        $paymentTerms = [];
        $staffs = $this->userService->getListUser();
        $companies = $this->companyService->getAllCompany();

        return view('pages.project.register', compact(
            'project',
            'statusValues',
            'categories',
            'paymentTerms',
            'staffs',
            'categorySelect',
            'companies',
            'supplier',
            'calculateTotalEst'
        ));
    }

    /**
     * Get status default in project
     */
    public function getStatus(): array
    {
        $statusValues = [];
        $statusCases = ProjectStatusEnum::cases();
        foreach ($statusCases as $status) {
            $statusValues[] = [
                'value' => $status->value,
                'name' => ProjectStatusEnum::getLabel($status->value)
            ];
        }
        return $statusValues;
    }

    /**
     * Save or Update register project blade
     */
    public function saveOrUpdateRegister(ProjectRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $result = $this->projectService->saveOrUpdateRegister($data);
        return $this->sendResponse($result['data'], $result['status'], $result['messageError']);
    }

    /**
     * Automatic field "no" in form
     */
    public function automaticNo(): \Illuminate\Http\JsonResponse
    {
        $noAutomatic = $this->projectService->automaticNo();
        return response()->json([
            'no' => $noAutomatic
        ]);
    }

    public function filter(Request $request)
    {
        $data = $request->all();
        $projects = $this->projectService->filter($data);
        return view('pages.project.partials.table_show_list', compact(
            'projects',
            'data'
        ));
    }

    /**
     * Show list customer by staff
     */
    public function showByStaff(Request $request)
    {
        $data = $request->all();
        $customersManager = $this->customerManagerService->find([
            'person_in_charge_id' => (int)$data['staff_id']
        ]);
        return view('pages.customer.partials.list_by_staff', compact('customersManager'));
    }

    /* Show ajax list projects in register */
    public function showListInRegister(Request $request)
    {
        $data = $request->all();
        $projects = $this->projectService->filter($data);
        return view('pages.project.partials.show_list_in_register', compact(
            'projects',
            'data'
        ));
    }

    /* Show ajax list products */
    public function showProducts(Request $request) {
        $data = $request->all();
        $idsProduct = [];
        if (!empty($data['idsProduct']) && count($data['idsProduct']) > 0) {
            $idsProduct = array_map('intval', $data['idsProduct']);
        }
        $supplies = $this->supplierService->getAllSupplier();
        $supplierIdDefault = optional($supplies->first())->id;
        $supplier_id = $data['supplier_id'] ?? $supplierIdDefault;
        $products = $this->estProductService->listProduct(compact('supplier_id') + $data);
        return view('pages.project.partials.estimate_items.show_list_product', compact(
            'products',
            'supplies',
            'supplier_id',
            'idsProduct'
        ));
    }

}
