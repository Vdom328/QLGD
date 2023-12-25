<?php

namespace App\Http\Controllers;

use App\Classes\Services\EstSupplierAmountService;
use App\Classes\Services\Interfaces\ICategoryService;
use App\Classes\Services\Interfaces\IEstProductService;
use App\Classes\Services\Interfaces\ISupplierService;
use App\Models\EstProductKeyWord;
use App\Models\EstProductNotice;
use App\Models\EstProductQuantity;
use App\Models\EstSupplierAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    protected $productService, $categoryService, $supplierService;

    public function __construct(
        IEstProductService $productService,
        ICategoryService $categoryService,
        ISupplierService $supplierService,
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->supplierService = $supplierService;
    }


    /**
     * List products with optional filtering and sorting.
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request containing filters and sorting options.
     * @return \Illuminate\View\View The view displaying the list of products.
     */
    public function listProduct(Request $request)
    {
        $attr = $this->productService->listProduct($request->all());

        $categories = $this->categoryService->getAllCategory();

        $column = $attr['column'];

        $direction = $attr['direction'];

        $category_id = $attr['category_id'];

        $key = $attr['key'];

        $products = $attr['products'];

        $filter_me = $attr['filter_me'];

        $products->appends(['column' => $column, 'direction' => $direction, 'key' => $key, 'category_id' => $category_id, 'filter_me' => $filter_me]);

        return view('pages.product.list', compact('products', 'categories', 'column', 'direction', 'key', 'category_id', 'filter_me'));
    }

    /**
     * Display the product creation form.
     *
     * @return \Illuminate\View\View The view for creating a new product.
     */
    public function createProduct()
    {
        $categories = $this->categoryService->getAllCategory();

        $suppliers = $this->supplierService->getAllSupplier();

        return view('pages.product.create', compact('categories', 'suppliers'));
    }

    /**
     * Render a product notice form for dynamic addition.
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the rendered form.
     */
    public function renderProductNotice(Request $request)
    {
        $notice = new EstProductNotice();
        $index = 1;
        $resultcontainer = view('pages.product.partials.notice', compact('notice', 'index'))->render();

        return response()->json([
            'resultcontainer' => $resultcontainer,
        ]);
    }

    /**
     * Render a product keyword form for dynamic addition.
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the rendered form.
     */
    public function renderProductKeyword(Request $request)
    {
        $keyWord = new EstProductKeyWord();
        $index = 1;

        $resultcontainer = view('pages.product.partials.keyword', compact('keyWord', 'index'))->render();

        return response()->json([
            'resultcontainer' => $resultcontainer,
        ]);
    }

    /**
     * Render a product quantity form for dynamic addition.
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the rendered form.
     */
    public function renderProductQuantity(Request $request)
    {
        $suppliers = $this->supplierService->getAllSupplier();

        $quantity = new EstProductQuantity();

        $supplier = new EstSupplierAmount();

        $resultcontainer = view('pages.product.partials._quantity', compact('suppliers', 'quantity', 'supplier'))->render();

        return response()->json([
            'resultcontainer' => $resultcontainer,
        ]);
    }

    /**
     * Generate an auto-generated code for a product.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the generated code.
     */
    public function autoGenCode()
    {
        $code = $this->productService->autoGenCode();
        return response()->json([
            'code' => $code,
        ]);
    }

    /**
     * Save a newly created product.
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request containing product data.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating success or error.
     */
    public function saveCreateProduct(Request $request)
    {
        $customMessages = $this->messageErrors();

        $validator = Validator::make($request->all(), [
            'control_number' => ['required', 'numeric', 'digits:5', Rule::unique('est_products')->ignore($request['control_number'])],
            'name' => 'required',
            'model_number' => ['required'],
            'category_id' => 'required',
            'email' => 'nullable|email|regex:/^[^@]+@[^\.]+\..+$/i',
        ], $customMessages);

        $keywords = $this->toKeyWordArr(json_decode($request->keywords));
        $validatorKeyword = Validator::make($keywords, [
            '*.keyword' => 'required',
        ], $customMessages);

        $notices = $this->toNoticeArr(json_decode($request->notices));
        $validatorNotices = Validator::make($notices, [
            '*.notice' => 'required',
        ], $customMessages);

        $suppliers = $this->toSupplierArr(json_decode($request->quantities));
        $validatorSuppliers = Validator::make($suppliers, [
            '*.price' => 'required|numeric',
            '*.selling_price' => 'required|numeric',
            '*.min_quantity' => 'required|numeric',
        ], $customMessages);

        $quantities = $this->toQuantitiesArr(json_decode($request->quantities));
        $validatorQuantities = Validator::make($quantities, [
            '*.quantity' => 'required|numeric',
        ], $customMessages);

        if ($validator->passes() && $validatorKeyword->passes() && $validatorNotices->passes() && $validatorSuppliers->passes() && $validatorQuantities->passes()) {
            if (!empty($keywords) && !empty($notices) && !empty($suppliers) && !empty($quantities)) {

                $create = $this->productService->saveCreateProduct($request);
                if (!$create == false) {
                    Session::flash('error', "エラーが発生しました。もう一度やり直してください!");
                    return redirect()->back();
                }
                Session::flash('success', "追加しました。");

                $checkCreate = true;
                return response()->json(['checkUpdate' => $checkCreate]);
            }
            Session::flash('error', "価格情報を入力してください");
            $checkCreate = false;
            return response()->json(['checkUpdate' => $checkCreate]);
        } else {
            return response()->json(['errors' => $validator->errors(), 'keyword_errors' => $validatorKeyword->errors(), 'notice_errors' => $validatorNotices->errors(), 'supplier_errors' => $validatorSuppliers->errors(), 'quantity_errors' => $validatorQuantities->errors()]);
        }
    }

    /**
     * Display the product update form.
     *
     * @param  int  $id The ID of the product to update.
     * @return \Illuminate\View\View The view for updating a product.
     */
    public function updateProduct($id)
    {
        $categories = $this->categoryService->getAllCategory();

        $product = $this->productService->getProductById($id);

        $suppliers = $this->supplierService->getAllSupplier();

        return view('pages.product.update', compact('categories', 'product', 'suppliers'));
    }

    /**
     * Save the updated product data.
     *
     * @param  \Illuminate\Http\Request  $request The HTTP request containing updated product data.
     * @param  int  $id The ID of the product to update.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating success or error.
     */
    public function saveUpdateProduct(Request $request, $id)
    {
        $customMessages = $this->messageErrors();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'model_number' => ['required'],
            'category_id' => 'required',
            'email' => 'nullable|email|regex:/^[^@]+@[^\.]+\..+$/i',
        ], $customMessages);

        $keywords = $this->toKeyWordArr(json_decode($request->keywords));
        $validatorKeyword = Validator::make($keywords, [
            '*.keyword' => 'required',
        ], $customMessages);

        $notices = $this->toNoticeArr(json_decode($request->notices));
        $validatorNotices = Validator::make($notices, [
            '*.notice' => 'required',
        ], $customMessages);

        $suppliers = $this->toSupplierArr(json_decode($request->quantities));
        $validatorSuppliers = Validator::make($suppliers, [
            '*.price' => 'required|numeric',
            '*.selling_price' => 'required|numeric',
            '*.min_quantity' => 'required|numeric',
        ], $customMessages);

        $quantities = $this->toQuantitiesArr(json_decode($request->quantities));
        $validatorQuantities = Validator::make($quantities, [
            '*.quantity' => 'required|numeric',
        ], $customMessages);

        if ($validator->passes() && $validatorKeyword->passes() && $validatorNotices->passes()  && $validatorSuppliers->passes() && $validatorQuantities->passes()) {
            if (!empty($keywords) && !empty($notices) && !empty($suppliers) && !empty($quantities)) {

                $update = $this->productService->saveUpdateProduct($request, $id);
                if (!$update == false) {
                    Session::flash('error', "エラーが発生しました。もう一度やり直してください!");
                    return redirect()->back();
                }
                Session::flash('success', "正常に更新されました");

                $checkUpdate = true;
                return response()->json(['checkUpdate' => $checkUpdate]);
            }
            Session::flash('error', "価格情報を入力してください");
            $checkUpdate = false;
            return response()->json(['checkUpdate' => $checkUpdate]);
        } else {
            return response()->json(['errors' => $validator->errors(), 'keyword_errors' => $validatorKeyword->errors(), 'notice_errors' => $validatorNotices->errors(), 'supplier_errors' => $validatorSuppliers->errors(), 'quantity_errors' => $validatorQuantities->errors()]);
        }
    }

    /**
     * Delete a product by its ID.
     *
     * @param  int  $id The ID of the product to delete.
     * @return \Illuminate\Http\Response The HTTP response indicating success or error.
     */
    public function delete($id)
    {
        $delete = $this->productService->delete($id);

        if ($delete) {
            Session::flash('success', "正常に削除されました");

            return redirect()->route('product.index');
        } else {
            Session::flash('error', "この記録は削除できません。");

            return redirect()->back();
        }
    }

    /**
     * Get custom error messages for product validation.
     *
     * @return array An array of custom error messages.
     */
    public function messageErrors()
    {
        $customMessages = [
            'control_number.required' => 'コントロール番号は必須です。',
            'control_number.unique' => 'このコントロール番号は既に存在しています。',
            'name.required' => '商品名は必須です。',
            'model_number.required' => 'モデル番号は必須です。',
            'control_number.numeric' => 'モデル番号は数字でなければなりません。',
            'control_number.digits' => 'モデル番号は5桁でなければなりません。',
            'category_id.required' => 'カテゴリーは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.regex' => '有効なメールアドレスを入力してください。',
            '*.keyword.required' => 'キーワードは必須です。',
            '*.notice.required' => '注意事項は必須です。',
            '*.price.required' => '価格は必須です。',
            '*.price.numeric' => '価格は数値でなければなりません。',
            '*.quantity.required' => '数量は必須です。',
            '*.quantity.numeric' => '数量は数値でなければなりません。',
            '*.selling_price.required' => '販売価格は必須です。',
            '*.selling_price.numeric' => '販売価格は数値でなければなりません。',
            '*.min_quantity.required' => '最小数量は必須です。',
            '*.min_quantity.numeric' => '最小数量は数値でなければなりません。',
        ];

        return $customMessages;
    }

    /**
     * Convert JSON data to an array of product keywords.
     *
     * @param  mixed  $keywords The JSON data representing product keywords.
     * @return array An array of product keywords.
     */
    private function toKeyWordArr($keywords)
    {
        $result = [];
        foreach ($keywords as $key => $value) {
            $attr = [];

            foreach ($value as $item) {
                $name = $item->name;
                $val = $item->value;

                if (str_contains($name, 'keyword1')) {
                    continue;
                }

                $attr[$name] = $val;

                array_push($result, $attr);
            }
        }

        return $result;
    }

    /**
     * Convert JSON data to an array of product notices.
     *
     * @param  mixed  $notices The JSON data representing product notices.
     * @return array An array of product notices.
     */
    private function toNoticeArr($notices)
    {
        $result = [];
        foreach ($notices as $key => $value) {
            $attr = [];

            foreach ($value as $item) {
                $name = $item->name;
                $val = $item->value;

                if (str_contains($name, 'notice1')) {
                    continue;
                }

                $attr[$name] = $val;

                array_push($result, $attr);
            }
        }

        return $result;
    }

    /**
     * Convert JSON data to an array of product suppliers and their quantities.
     *
     * @param  mixed  $suppliers The JSON data representing product suppliers and quantities.
     * @return array An array of product suppliers and their quantities.
     */
    private function toSupplierArr($suppliers)
    {
        $result = [];

        foreach ($suppliers as $supplierItem) {
            foreach ($supplierItem->amounts as $amountItem) {
                $amountData = [
                    'supplier_id' => $amountItem->supplier_id,
                    'price' => $amountItem->price,
                    'selling_price' => $amountItem->selling_price,
                    'min_quantity' => $amountItem->min_quantity,
                ];

                $result[] = $amountData;
            }
        }

        return $result;
    }

    /**
     * Convert JSON data to an array of product quantities.
     *
     * @param  mixed  $quantities The JSON data representing product quantities.
     * @return array An array of product quantities.
     */
    private function toQuantitiesArr($quantities)
    {
        $result = [];

        foreach ($quantities as $quantityItem) {
            $quantityData = [
                'quantity' => $quantityItem->quantity,
            ];

            $result[] = $quantityData;
        }

        return $result;
    }
}
