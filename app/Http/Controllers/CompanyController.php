<?php

namespace App\Http\Controllers;

use App\Classes\Enum\CompanyBankAccountTypeEnum;
use App\Classes\Services\Interfaces\ICompanyService;
use App\Classes\Services\Interfaces\IProvinceService;
use App\Http\Requests\CompanyRequest;
use App\Models\CompanyBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    protected $companyService, $provinceService;

    public function __construct(
        ICompanyService $companyService,
        IProvinceService $provinceService
    ) {
        $this->companyService = $companyService;
        $this->provinceService = $provinceService;
    }

    /**
     * Display a list of all companies.
     *
     * @return \Illuminate\View\View A view displaying a list of all companies.
     */
    public function listCompany()
    {
        $companies = $this->companyService->getAllCompany();

        return view('pages.company.list', compact('companies'));
    }

    /**
     * Display a form to create a new company.
     *
     * @return \Illuminate\View\View A view displaying a form to create a new company.
     */
    public function createCompany()
    {
        $provinces = $this->provinceService->getListProvince();

        $totalCompanyBank = 0;
        $bank = new CompanyBank();
        $accountTypeDefault = CompanyBankAccountTypeEnum::USUALLY;
        $bank->account_type = $accountTypeDefault->value;
        $index = 1;

        return view('pages.company.create', compact('provinces', 'totalCompanyBank', 'bank', 'index'));
    }

    /**
     * Save a new company to the database.
     *
     * @param \App\Http\Requests\Request $request The HTTP request object containing the data for the new company.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the company index page.
     */
    public function saveCreateCompany(Request $request)
    {
        $customMessages = $this->messageErrors();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'post_code_first' => 'nullable|numeric|digits:3',
            'post_code_last' => 'nullable|numeric|digits:4',
            'logo' => 'image',
            'phone' => 'nullable|numeric',
            'email' => 'nullable|email|regex:/^[^@]+@[^\.]+\..+$/i',
        ], $customMessages);

        $banks = $this->toBankArr(json_decode($request->banks));
        $validatorBank = Validator::make($banks, [
            '*.bank_name' => 'required',
            '*.branch_name' => 'required',
            '*.account_number' => 'required|numeric',
            '*.account_holder' => 'required',
        ], $customMessages);

        if ($validator->passes() && $validatorBank->passes()) {
            if (!empty($banks)) {
                $create = $this->companyService->saveCreateCompany($request);

                if (!$create == false) {
                    Session::flash('error', "エラーが発生しました。もう一度やり直してください!");
                    return redirect()->back();
                }
                Session::flash('success', "追加しました。");

                $checkUpdate = true;
                return response()->json(['checkUpdate' => $checkUpdate]);
            }
            Session::flash('error', "口座情報を入力してください。");
            $checkUpdate = false;
            return response()->json(['checkUpdate' => $checkUpdate]);
        } else {
            return response()->json(['errors' => $validator->errors(), 'bank_errors' => $validatorBank->errors()]);
        }
    }

    /**
     * Display a form to update an existing company.
     *
     * @param int $id The ID of the company to update.
     * @return \Illuminate\View\View A view displaying a form to update an existing company.
     */
    public function updateCompany($id)
    {
        $provinces = $this->provinceService->getListProvince();

        $company = $this->companyService->getCompanyById($id);

        $companyBanks = $company->companyBanks;

        $totalCompanyBank = count($companyBanks);

        return view('pages.company.update', compact('provinces', 'company', 'totalCompanyBank'));
    }

    /**
     * Save an updated company to the database.
     *
     * @param \App\Http\Requests\Request $request The HTTP request object containing the updated data for the company.
     * @param int $id The ID of the company to update.
     * @return \Illuminate\Http\RedirectResponse A redirect response to the company index page.
     */
    public function saveUpdateCompany(Request $request, $id)
    {
        $customMessages = $this->messageErrors();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'post_code_first' => 'nullable|numeric|digits:3',
            'post_code_last' => 'nullable|numeric|digits:4',
            'logo' => 'image',
            'phone' => 'nullable|numeric',
            'email' => 'nullable|email|regex:/^[^@]+@[^\.]+\..+$/i',
        ], $customMessages);

        $banks = $this->toBankArr(json_decode($request->banks));

        $validatorBank = Validator::make($banks, [
            '*.bank_name' => 'required',
            '*.branch_name' => 'required',
            '*.account_number' => 'required|numeric',
            '*.account_holder' => 'required',
        ], $customMessages);

        if ($validator->passes() && $validatorBank->passes()) {
            if (!empty($banks)) {

                $update = $this->companyService->saveUpdateCompany($request, $id);
                if (!$update == false) {
                    Session::flash('error', "エラーが発生しました。もう一度やり直してください!");
                    return redirect()->back();
                }
                Session::flash('success', "正常に更新されました");

                $checkUpdate = true;
                return response()->json(['checkUpdate' => $checkUpdate]);
            }
            Session::flash('error', "口座情報を入力してください。");
            $checkUpdate = false;
            return response()->json(['checkUpdate' => $checkUpdate]);
        } else {
            return response()->json(['errors' => $validator->errors(), 'bank_errors' => $validatorBank->errors()]);
        }
    }

    /**
     * Get a list of custom error messages for company validation.
     *
     * @return array
     */
    public function messageErrors()
    {
        $customMessages = [
            'name.required' => '名前は必須です。',
            'post_code_first.numeric' => '郵便番号の最初の部分は数字で入力してください。',
            'post_code_first.digits' => '郵便番号の最初の部分は3桁の数字で入力してください。',
            'post_code_last.numeric' => '郵便番号の最後の部分は数字で入力してください。',
            'post_code_last.digits' => '郵便番号の最後の部分は4桁の数字で入力してください。',
            'phone.numeric' => '電話番号を数字で入力してください',
            'logo.image' => 'ロゴは画像ファイルである必要があります。',
            'email.email' => '有効なメールアドレス形式で入力してください。',
            'email.regex' => '有効なメールアドレス形式で入力してください。',
            '*.bank_name.required' => '銀行名は必須です。',
            '*.branch_name.required' => '支店名は必須です。',
            '*.account_number.required' => '口座番号は必須です。',
            '*.account_number.numeric' => '口座番号は数字でなければなりません。',
            '*.account_holder.required' => '口座名義は必須です。',
        ];

        return $customMessages;
    }

    /**
     * Convert data from JSON arrays to arrays for banks.
     *
     * @param  mixed  $banks
     * @return array
     */
    private function toBankArr($banks)
    {
        $result = [];
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

            array_push($result, $attr);
        }

        return $result;
    }

    /**
     * Render a partial view for adding or updating a company bank.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the data for the company bank.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the rendered partial view and the total number of company banks.
     */
    public function renderCompanyBank(Request $request)
    {
        $provinces = $this->provinceService->getListProvince();

        $bank = new CompanyBank();
        $accountTypeDefault = CompanyBankAccountTypeEnum::USUALLY;
        $bank->account_type = $accountTypeDefault->value;

        $index = $request->input('index');
        $totalCompanyBank = $request->input('total_company_bank');
        if (!$request->input('id')) {
            $totalCompanyBank++;
        }

        $resultcontainer = view('pages.company.partials._company_bank', compact('provinces', 'bank', 'index'))->render();

        return response()->json([
            'resultcontainer' => $resultcontainer,
            'totalCompanyBank' => $totalCompanyBank
        ]);
    }

    /**
     * Delete a company by its ID.
     *
     * @param  int  $id The ID of the company to be deleted.
     * @return \Illuminate\Http\Response
     */
    public function deleteCompany($id)
    {
        $delete = $this->companyService->deleteCompanyById($id);

        if ($delete) {
            Session::flash('success', "正常に削除されました");

            return redirect()->route('company.index');
        } else {
            Session::flash('error', "この記録は削除できません。");

            return redirect()->back();
        }
    }
}
