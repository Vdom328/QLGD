<?php

namespace App\Http\Controllers;

use App\Classes\Enum\TypePaymentTermEnum;
use App\Classes\Services\Interfaces\IPaymentTermService;
use App\Http\Requests\PaymentTermRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session ;

class PaymentTermsController extends Controller
{

    protected $paymentTermService;

    public function __construct(
        IPaymentTermService $paymentTermService,
    ) {
        $this->paymentTermService = $paymentTermService;
    }

    /**
     * view blade list payment_term supplier
     */
    public function indexSupplier()
    {
        $data = $this->paymentTermService->getPaymentTermSupplier();
        return view('pages.payment_terms.supplier_payment_term',compact('data'));
    }


    /**
     * view blade register supplier payment_term
     */
    public function registerSupplier()
    {
        return view('pages.payment_terms.create_supplier');
    }

    /**
     * post data register supplier
     */
    public function postRegisterSupplier(PaymentTermRequest $request)
    {
        $create = $this->paymentTermService->createPaymentTerm($request->all());
        if ($create == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "支払条件サプライヤーの作成に成功しました !");
        return redirect()->route('supplier.payment_terms');
    }

    /**
     * view blade list payment_term customer
     */
    public function indexCustomer()
    {
        $data = $this->paymentTermService->getPaymentTermCustomer();
        return view('pages.payment_terms.customer_payment_term',compact('data'));
    }


    /**
     * view blade register customer payment_term
     */
    public function registerCustomer()
    {
        return view('pages.payment_terms.create_customer');
    }

    /**
     * post data register customer
     */
    public function postRegisterCustomer(PaymentTermRequest $request)
    {
        $create = $this->paymentTermService->createPaymentTerm($request->all());
        if ($create == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        Session::flash('success', "顧客の支払い条件が正常に作成されました !");
        return redirect()->route('customer.payment_terms');
    }

    /**
     * update payment term
     */
    public function updatePaymentTerm($id)
    {
        $data = $this->paymentTermService->findById($id);
        if ($data->type == TypePaymentTermEnum::customer->value) {
            return view('pages.payment_terms.edit_customer',compact('data'));
        }else{
            return view('pages.payment_terms.edit_supplier',compact('data'));
        }

    }

    /**
     * save update payment term
     */
    public function saveUpdatePaymentTerm(PaymentTermRequest $request,$id)
    {
        $update = $this->paymentTermService->updatePaymentTerm($request->all(),$id);
        if ($update == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        if ($request->type == TypePaymentTermEnum::customer) {
            Session::flash('success', "顧客の支払い条件が正常に更新されました !");
            return redirect()->route('customer.payment_terms');
        }else{
            Session::flash('success', "サプライヤーの支払い条件が正常に更新されました !");
            return redirect()->route('supplier.payment_terms');
        }
    }

    /**
     * delete payment term by id
     * @param int $id
     */
    public function delete($id)
    {
        $payment_term = $this->paymentTermService->findById($id);
        $type = $payment_term->type;
        $delete = $this->paymentTermService->delete($id);
        if ($delete == false) {
            Session::flash('error', "エラーが発生しました。もう一度やり直してください !");
            return redirect()->back();
        }
        
        Session::flash('success', "支払い条件が正常に削除されました !");
        if ($type == TypePaymentTermEnum::customer) {
            return redirect()->route('customer.payment_terms');
        }else{
            return redirect()->route('supplier.payment_terms');
        }
    }
}
