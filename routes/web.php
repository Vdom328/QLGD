<?php

use App\Http\Controllers\AnalyzeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositWithdrawalController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MenuContronller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentTermsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::redirect('/home', '/', 301);
Route::group(['middleware' => ['auth']], function () {
    // Dashboard route
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::group(['prefix' => '/dashboard'], function () {
    });

    // Profile route
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/{id}', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/update', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
        Route::get('/radom/staff_no', [ProfileController::class, 'radomStaffNo'])->name('profile.radomStaffNo');
    });

    Route::group(['prefix' => 'deposit-withdrawal-management'], function () {
        Route::get('/', [DepositWithdrawalController::class, 'index'])->name('deposit-withdrawal.index');
    });

    Route::group(['prefix' => 'invoice'], function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
    });

    Route::group(['prefix' => 'setting', 'middleware' => ['role:admin']], function () {

        // route staffs
        Route::group(['prefix' => 'staffs'], function () {
            Route::get('/', [StaffsController::class, 'getListStaffs'])->name('staffs');
            Route::get('/create', [StaffsController::class, 'createStaff'])->name('staffs.create');
            Route::post('/create', [StaffsController::class, 'saveCreateStaff'])->name('staffs.create.save');
            Route::get('/update/{id}', [StaffsController::class, 'updateStaff'])->name('staffs.update');
            Route::post('/update', [StaffsController::class, 'saveUpdateStaff'])->name('staffs.update.save');
            Route::get('/filter', [StaffsController::class, 'filterStaffs'])->name('staffs.filter');
            Route::post('/sort-data', [StaffsController::class, 'sortStaffs'])->name('staffs.sort');
        });

        // route company
        Route::group(['prefix' => 'company'], function () {
            Route::get('/', [CompanyController::class, 'listCompany'])->name('company.index');
            Route::get('/create', [CompanyController::class, 'createCompany'])->name('company.create');
            Route::post('/create', [CompanyController::class, 'saveCreateCompany'])->name('company.create.save');
            Route::get('/update/{id}', [CompanyController::class, 'updateCompany'])->name('company.update');
            Route::post('/update/{id}', [CompanyController::class, 'saveUpdateCompany'])->name('company.update.save');
            Route::get('/company-bank', [CompanyController::class, 'renderCompanyBank'])->name('company.render');
            Route::delete('/delete/{id}', [CompanyController::class, 'deleteCompany'])->name('company.delete');
        });

        // Supplier route
        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
            Route::get('/register', [SupplierController::class, 'create'])->name('supplier.create');
            Route::post('/register', [SupplierController::class, 'saveCreate'])->name('supplier.saveCreate');
            Route::get('/register/render', [SupplierController::class, 'createRender'])->name('supplier.create.render');
            Route::get('/radom/supplier_code', [SupplierController::class, 'radomSupplierCode'])->name('supplier.supplier_code');
            Route::get('/update', [SupplierController::class, 'getEdit'])->name('supplier.getEdit');
            Route::post('/update/{id}', [SupplierController::class, 'saveEdit'])->name('supplier.saveEdit');
            Route::get('/sort_project', [SupplierController::class, 'sortProject'])->name('supplier.sortProject');
            Route::delete('/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
        });

        // customer route
        Route::group(['prefix' => 'customer'], function () {
            Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
            Route::get('/register', [CustomerController::class, 'create'])->name('customer.create');
            Route::post('/registerCustomer', [CustomerController::class, 'saveCreate'])->name('customer.saveCreate');
            Route::get('/register/render', [CustomerController::class, 'createRender'])->name('customer.create.render');
            Route::get('/radom/customer_code', [CustomerController::class, 'radomCustomerCode'])->name('customer.customer_code');
            Route::get('/update', [CustomerController::class, 'getEdit'])->name('customer.getEdit');
            Route::post('/update/{id}', [CustomerController::class, 'saveEdit'])->name('customer.saveEdit');
            Route::get('/search-filter', [CustomerController::class, 'searchAndFilter'])->name('customer.search.filter');
            Route::delete('/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
        });

        // route product
        Route::group(['prefix' => 'estimation/product'], function () {
            Route::get('/', [ProductController::class, 'listProduct'])->name('product.index');
            Route::get('/register', [ProductController::class, 'createProduct'])->name('product.create');
            Route::post('/register', [ProductController::class, 'saveCreateProduct'])->name('product.create.save');
            Route::get('/update/{id}', [ProductController::class, 'updateProduct'])->name('product.update');
            Route::post('/update/{id}', [ProductController::class, 'saveUpdateProduct'])->name('product.update.save');
            Route::get('/code', [ProductController::class, 'autoGenCode'])->name('product.code');
            Route::get('/product-notice', [ProductController::class, 'renderProductNotice'])->name('product.render.notice');
            Route::get('/product-keyword', [ProductController::class, 'renderProductKeyword'])->name('product.render.keyword');
            Route::get('/product-quantity', [ProductController::class, 'renderProductQuantity'])->name('product.render.quantity');
            Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        });

        // route supplier payment_terms
        Route::group(['prefix' => 'supplier-payment-terms'], function () {
            Route::get('/', [PaymentTermsController::class, 'indexSupplier'])->name('supplier.payment_terms');
            Route::get('/register', [PaymentTermsController::class, 'registerSupplier'])->name('supplier.payment_terms.register');
            Route::post('/register', [PaymentTermsController::class, 'postRegisterSupplier'])->name('supplier.payment_terms.postRegister');
        });
        Route::get('/payment-terms/update/{id}', [PaymentTermsController::class, 'updatePaymentTerm'])->name('payment_terms.updatePaymentTerm');
        Route::post('/payment-terms/update/{id}', [PaymentTermsController::class, 'saveUpdatePaymentTerm'])->name('payment_terms.saveUpdate');
        Route::delete('/payment-terms/{id}', [PaymentTermsController::class, 'delete'])->name('payment_terms.delete');
        // route customer payment_terms
        Route::group(['prefix' => 'customer-payment-terms'], function () {
            Route::get('/', [PaymentTermsController::class, 'indexCustomer'])->name('customer.payment_terms');
            Route::get('/register', [PaymentTermsController::class, 'registerCustomer'])->name('customer.payment_terms.register');
            Route::post('/register', [PaymentTermsController::class, 'postRegisterCustomer'])->name('customer.payment_terms.postRegister');
        });

        Route::group(['prefix' => 'menu'], function () {
            Route::get('/', [MenuContronller::class, 'index'])->name('menu.index');
        });
    });

    // route todo
    Route::group(['prefix' => 'todo'], function () {
       Route::get('/', [TodoController::class, 'index'])->name('todo.index');
       Route::get('/register', [TodoController::class, 'register'])->name('todo.register');
       Route::get('/getProject', [TodoController::class, 'getProject'])->name('todo.getProject');
       Route::post('/register', [TodoController::class, 'createTodo'])->name('todo.createTodo');
       Route::get('/update/{id}', [TodoController::class, 'update'])->name('todo.update');
       Route::post('/save_update/{id}', [TodoController::class, 'saveUpdate'])->name('todo.saveUpdate');
       Route::delete('/delete/{id}', [TodoController::class, 'delete'])->name('todo.delete');
    });

    // route project
    Route::group(['prefix' => 'project'], function () {
        Route::get('/register', [ProjectController::class, 'register'])->name('project.register');
        Route::get('/update/{id}', [ProjectController::class, 'update'])->name('project.update');
        Route::post('/save-or-update-register', [ProjectController::class, 'saveOrUpdateRegister'])->name('project.saveOrUpdateRegister');
        Route::get('/automatic-no', [ProjectController::class, 'automaticNo'])->name('project.automatic.no',);
        Route::get('/', [ProjectController::class, 'index'])->name('project.index');
        Route::get('/filter', [ProjectController::class, 'filter'])->name('project.filter');
        Route::get('/show-customer-by-staff', [ProjectController::class, 'showByStaff'])->name('project.showCustomerByStaff');
        Route::get('/show-list-in-register', [ProjectController::class, 'showListInRegister'])->name('project.showListInRegister');
        Route::get('/show-products', [ProjectController::class, 'showProducts'])->name('project.showProducts');
    });


    // route estimates
    Route::group(['prefix' => 'estimation'], function () {
        Route::get('/', [EstimateController::class, 'index'])->name('estimation.index');
    });

    // route order
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
    });

    // route analyze
    Route::group(['prefix' => 'analyze'], function (){
        Route::get('/sales', [AnalyzeController::class, 'sales_index'])->name('analyze.sales.index');
        Route::get('/order', [AnalyzeController::class, 'order_index'])->name('analyze.order.index');
        Route::get('/gross-profit-total', [AnalyzeController::class, 'gross_profit_total_index'])->name('analyze.gross-profit-total.index');
        Route::get('/gross-profit-margin', [AnalyzeController::class, 'gross_profit_margin_index'])->name('analyze.gross-profit-margin.index');
    });
});

