<?php

namespace App\Http\Controllers;

use App\Classes\Enum\ProjectStatusEnum;
use App\Classes\Services\Interfaces\ICategoryService;
use App\Classes\Services\Interfaces\IPaymentTermService;
use App\Classes\Services\Interfaces\IProjectService;
use App\Classes\Services\Interfaces\IProvinceService;
use App\Classes\Services\Interfaces\ISupplierService;
use App\Classes\Services\Interfaces\IUserService;
use App\Http\Requests\CreateSupplierRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{

    protected $supplierService, $provinceService, $userService, $paymentTermService, $projectService, $categoryService;

    public function __construct(
        ISupplierService $supplierService,
        IProvinceService $provinceService,
        IUserService $userService,
        IPaymentTermService $paymentTermService,
        IProjectService $projectService,
        ICategoryService $categoryService
    ) {
        $this->supplierService = $supplierService;
        $this->provinceService = $provinceService;
        $this->userService = $userService;
        $this->paymentTermService = $paymentTermService;
        $this->projectService = $projectService;
        $this->categoryService = $categoryService;
    }

    /**
     * get index supplier blade
     */
    public function index(Request $request)
    {
        $attr = $this->supplierService->getListSupplier($request->all());
        $paymentTerms = $this->paymentTermService->getPaymentTermSupplier();
        $staffs = $this->userService->getListUser();
        $suppliers = $attr['suppliers'];
        $column = $attr['column'];
        $direction = $attr['direction'];
        $key = $attr['key'];
        $staff_id = $attr['staff_id'];
        $filter_me = $attr['filter_me'];
        $payment_terms = $attr['payment_terms'];
        $suppliers->appends(['column' => $column, 'direction' => $direction, 'key' => $key, 'staff_id' => $staff_id, 'filter_me' => $filter_me, 'payment_terms' => $payment_terms]);
        return view('pages.supplier.index',compact('suppliers','staffs','direction','column','key','staff_id','filter_me','payment_terms','paymentTerms'));
    }

    /**
     * get create supplier blade
     */
    public function create(Request $request)
    {
        if (request()->ajax()) {
            $projects = $this->projectService->filter($request->all());
            $resultContainer = view('pages.supplier.partials._list_project', compact('projects'))->render();
            $paginate = view('partials.paginate', ['list' => $projects])->render();
            return response()->json([
                'resultContainer' => $resultContainer,
                'paginate' => $paginate
            ]);
        }

        $provinces = $this->provinceService->getListProvince();
        $suppliers = $this->supplierService->getAllSupplier();
        $staffs = $this->userService->getListUser();
        $paymentTerms = $this->paymentTermService->getPaymentTermSupplier();
        $managersCount = 0;
        //
        $projects = $this->projectService->getAllProject();
        $category = $this->categoryService->getAllCategory();
        $status_project = $this->getStatusProject();
        return view('pages.supplier.create', compact('provinces','staffs','managersCount','paymentTerms','projects','suppliers','category','status_project'));
    }

    /**
     * post data save supplier
     * @param mixed $request
     */
    public function saveCreate(CreateSupplierRequest $request)
    {
        $data = $this->supplierService->saveCreate($request->all());
        if ($data == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "サプライヤーの作成に成功しました !");
        return response()->json([
            'url' => Route('supplier.index'),

                ]);
    }

    /**
     * radom supplier code
     */
    public function radomSupplierCode(){
        $code = $this->supplierService->radomSupplierCode();
        return response()->json([
            'code' => $code,
        ]);
    }


    /**
     * Creates and renders a view for supplier managers.
     *
     * @param Request $request - The HTTP request object.
     * @return
     */
    public function createRender(Request $request)
    {
        $managersCount = $request->managersCount;
        $staffs = $this->userService->getListUser();
        $resultContainer = view('pages.supplier.partials.tr_manager_supplier', compact('staffs','managersCount'))->render();
        return response()->json([
            'resultContainer' => $resultContainer,
        ]);
    }

    /**
     * This function is used to retrieve the necessary data to display the edit page for a supplier.
     *
     * @param Request $request - The request object containing the ID of the supplier to be edited
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View - The view to be displayed
     */
    public function getEdit(Request $request)
    {
        if (request()->ajax()) {
            $projects = $this->projectService->filter($request->all());
            $resultContainer = view('pages.supplier.partials._list_project', compact('projects'))->render();
            $paginate = view('partials.paginate', ['list' => $projects])->render();
            return response()->json([
                'resultContainer' => $resultContainer,
                'paginate' => $paginate
            ]);
        }

        $provinces = $this->provinceService->getListProvince();
        $staffs = $this->userService->getListUser();
        $managersCount = 0;
        $paymentTerms = $this->paymentTermService->getPaymentTermSupplier();
        $supplier = $this->supplierService->findById($request->id);
        //
        $projects = $this->projectService->getAllProject();
        $category = $this->categoryService->getAllCategory();
        $status_project = $this->getStatusProject();
        $suppliers = $this->supplierService->getAllSupplier();
        return view('pages.supplier.edit', compact('supplier','provinces','staffs','managersCount','paymentTerms','projects','suppliers','category','status_project'));
    }


    /**
     * This function is used to save the edited data for a supplier.
     *
     * @param CreateSupplierRequest $request - The request object containing the edited data
     * @return \Illuminate\Http\JsonResponse - The JSON response containing the edited data
     */
    public function saveEdit(CreateSupplierRequest $request,$id)
    {
        $data = $this->supplierService->updateSupplierById($request->all(),$id);
        if ($data == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "サプライヤーを正常に更新しました !");
        return response()->json([
            'url' => Route('supplier.index'),
        ]);
    }

    /**
     * status project
     */
    public function getStatusProject()
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
     * delete customer by id
     * @param int $id
     */
    public function delete($id)
    {
        $delete = $this->supplierService->delete($id);
        if ($delete == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "サプライヤーが正常に削除されました !");
        return redirect()->route('supplier.index');
    }
}
