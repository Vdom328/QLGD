<?php

namespace App\Http\Controllers;

use App\Classes\Services\Interfaces\ICategoryService;
use App\Classes\Services\Interfaces\ICustomerService;
use App\Classes\Services\Interfaces\IPaymentTermService;
use App\Classes\Services\Interfaces\IProjectService;
use App\Classes\Services\Interfaces\IProvinceService;
use App\Classes\Services\Interfaces\ISupplierService;
use App\Classes\Services\Interfaces\IUserService;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    protected $customerService, $provinceService, $userService, $paymentTermService, $projectService, $categoryService, $supplierService;

    public function __construct(
        ICustomerService $customerService,
        IProvinceService $provinceService,
        IUserService $userService,
        IProjectService $projectService,
        IPaymentTermService $paymentTermService,
        ICategoryService $categoryService,
        ISupplierService $supplierService
    ) {
        $this->customerService = $customerService;
        $this->provinceService = $provinceService;
        $this->userService = $userService;
        $this->paymentTermService = $paymentTermService;
        $this->projectService = $projectService;
        $this->categoryService = $categoryService;
        $this->supplierService = $supplierService;
    }

    /**
     * get index customer blade
     */
    public function index(Request $request)
    {
        $attr = $this->customerService->getListCustomer($request->all());
        $staffs = $this->userService->getListUser();
        $customers = $attr['customer'];
        $column = $attr['column'];
        $direction = $attr['direction'];
        $key = $attr['key'];
        $staff_id = $attr['staff_id'];
        $filter_me = $attr['filter_me'];
        $payment_terms = $attr['payment_terms'];
        $paymentTerms = $this->paymentTermService->getPaymentTermCustomer();
        $customers->appends(['column' => $column, 'direction' => $direction, 'key' => $key, 'staff_id' => $staff_id, 'filter_me' => $filter_me, 'payment_terms' => $payment_terms]);
        return view('pages.customer.index',compact('paymentTerms','customers','staffs','direction','column','key','staff_id','filter_me','payment_terms'));
    }

    /**
     * get create customer blade
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            return $this->ajaxLoadData();
        }
        $provinces = $this->provinceService->getListProvince();
        $staffs = $this->userService->getListUser();
        $managersCount = 0;
        $paymentTerms = $this->paymentTermService->getPaymentTermCustomer();
        $projects = $this->projectService->getAllProject();
        $categories = $this->categoryService->getAllCategory();
        $customers = $this->customerService->getAllCustomer();
        $suppliers = $this->supplierService->getAllSupplier();
        return view('pages.customer.create', compact('paymentTerms','provinces','staffs','managersCount', 'projects', 'categories', 'customers', 'suppliers'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxLoadData()
    {
        $projects = $this->projectService->getAllProject();

        $resultcontainer = view('pages.customer.partials._table_project', compact('projects'))->render();
        $projectpaginate = view('partials.paginate', ['list' => $projects])->render();
        return response()->json([
            'resultcontainer' => $resultcontainer,
            'projectpaginate' => $projectpaginate
        ]);
    }

    public function searchAndFilter(Request $request)
    {
        $projects = $this->projectService->searchAndFilter($request);

        $resultcontainer = view('pages.customer.partials._table_project', compact('projects'))->render();
        $projectpaginate = view('partials.paginate', ['list' => $projects])->render();
        return response()->json([
            'resultcontainer' => $resultcontainer,
            'projectpaginate' => $projectpaginate
        ]);
    }

    /**
     * radom Customer code
     */
    public function radomCustomerCode(){
        $code = $this->customerService->radomCustomerCode();
        return response()->json([
            'code' => $code,
        ]);
    }

    /**
     * Creates and renders a view for customer managers.
     *
     * @param Request $request - The HTTP request object.
     * @return
     */
    public function createRender(Request $request)
    {
        $managersCount = $request->managersCount;
        $staffs = $this->userService->getListUser();
        $resultContainer = view('pages.customer.partials.tr_manager_customer', compact('staffs','managersCount'))->render();
        return response()->json([
            'resultContainer' => $resultContainer,
        ]);
    }

    /**
     * post data save customer
     * @param mixed $request
     */
    public function saveCreate(CustomerRequest $request)
    {
        $data = $this->customerService->saveCreate($request->all());
        if ($data == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "顧客が正常に作成されました !");
        return response()->json([
            'url' => Route('customer.index'),
        ]);
    }

    /**
     * This function is used to retrieve the necessary data to display the edit page for a customer.
     *
     * @param Request $request - The request object containing the ID of the customer to be edited
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View - The view to be displayed
     */
    public function getEdit(Request $request)
    {
        $paymentTerms = $this->paymentTermService->getPaymentTermCustomer();
        $provinces = $this->provinceService->getListProvince();
        $staffs = $this->userService->getListUser();
        $managersCount = 0;
        $customer = $this->customerService->findById($request->id);
        $projects = $this->projectService->getAllProject();
        $categories = $this->categoryService->getAllCategory();
        $customers = $this->customerService->getAllCustomer();
        $suppliers = $this->supplierService->getAllSupplier();
        return view('pages.customer.edit', compact('paymentTerms','customer','provinces','staffs','managersCount', 'categories', 'projects', 'customers', 'suppliers'));
    }


    /**
     * This function is used to save the edited data for a customer.
     *
     * @param CustomerRequest $request - The request object containing the edited data
     * @return \Illuminate\Http\JsonResponse - The JSON response containing the edited data
     */
    public function saveEdit(CustomerRequest $request,$id)
    {
        $data = $this->customerService->updateCustomerById($request->all(),$id);
        if ($data == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "顧客を正常に更新しました !");
        return response()->json([
            'url' => Route('customer.index'),
        ]);
    }

    /**
     * delete customer by id
     * @param int $id
     */
    public function delete($id)
    {
        $delete = $this->customerService->delete($id);
        if ($delete == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "顧客を正常に削除しました !");
        return redirect()->route('customer.index');
    }
}
