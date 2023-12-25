<?php

namespace App\Classes;

use App\Classes\Services as Service;
use App\Classes\Services\Interfaces as IService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider as LServiceProvider;

class ServiceProvider extends LServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(IService\IUserService::class, Service\UserService::class);
        App::bind(IService\IProfileService::class, Service\ProfileService::class);
        App::bind(IService\IRoleService::class, Service\RoleService::class);
        App::bind(IService\ICompanyService::class, Service\CompanyService::class);
        App::bind(IService\ICompanyBankService::class, Service\CompanyBankService::class);
        App::bind(IService\ISupplierService::class, Service\SupplierService::class);
        App::bind(IService\IProvinceService::class, Service\ProvinceService::class);
        App::bind(IService\IEstProductService::class, Service\EstProductService::class);
        App::bind(IService\IEstProductNoticeService::class, Service\EstProductNoticeService::class);
        App::bind(IService\IEstProductKeyWordService::class, Service\EstProductKeyWordService::class);
        App::bind(IService\ICategoryService::class, Service\CategoryService::class);
        App::bind(IService\ICustomerManagerService::class, Service\CustomerManagerService::class);
        App::bind(IService\ICustomerService::class, Service\CustomerService::class);
        App::bind(IService\IPaymentTermService::class, Service\PaymentTermService::class);
        App::bind(IService\IEstProductQuantityService::class, Service\EstProductQuantityService::class);
        App::bind(IService\IEstSupplierAmountService::class, Service\EstSupplierAmountService::class);
        App::bind(IService\IProjectService::class, Service\ProjectService::class);
        App::bind(IService\IProjectRelatedFileService::class, Service\ProjectRelatedFileService::class);
        App::bind(IService\ITodoService::class, Service\TodoService::class);
        App::bind(IService\IProjectProductService::class, Service\ProjectProductService::class);
        App::bind(IService\IProjectProductMemoService::class, Service\ProjectProductMemoService::class);
    }
}
