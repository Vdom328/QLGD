<?php

namespace App\Classes;

use App\Classes\Repository\Interfaces as IRepository;
use App\Classes\Repository as  Repository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;


class RepositoryProvider extends ServiceProvider
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
        App::bind(IRepository\IUserRepository::class, Repository\UserRepository::class);
        App::bind(IRepository\IProfileRepository::class, Repository\ProfileRepository::class);
        App::bind(IRepository\IRoleRepository::class, Repository\RoleRepository::class);
        App::bind(IRepository\IUserNotificationRepository::class, Repository\UserNotificationRepository::class);
        App::bind(IRepository\IRoleUserRepository::class, Repository\RoleUserRepository::class);
        App::bind(IRepository\ICompanyRepository::class, Repository\CompanyRepository::class);
        App::bind(IRepository\ISupplierRepository::class, Repository\SupplierRepository::class);
        App::bind(IRepository\ISupplierManagerRepository::class, Repository\SupplierManagerRepository::class);
        App::bind(IRepository\ICompanyBankRepository::class, Repository\CompanyBankRepository::class);
        App::bind(IRepository\IProvinceRepository::class, Repository\ProvinceRepository::class);
        App::bind(IRepository\IEstProductRepository::class, Repository\EstProductRepository::class);
        App::bind(IRepository\IEstProductNoticeRepository::class, Repository\EstProductNoticeRepository::class);
        App::bind(IRepository\IEstProductKeyWordRepository::class, Repository\EstProductKeyWordRepository::class);
        App::bind(IRepository\ICategoryRepository::class, Repository\CategoryRepository::class);
        App::bind(IRepository\ICustomerRepository::class, Repository\CustomerRepository::class);
        App::bind(IRepository\ICustomerManagerRepository::class, Repository\CustomerManagerRepository::class);
        App::bind(IRepository\IPaymentTermRepository::class, Repository\PaymentTermRepository::class);
        App::bind(IRepository\IEstProductQuantityRepository::class, Repository\EstProductQuantityRepository::class);
        App::bind(IRepository\IEstSupplierAmountRepository::class, Repository\EstSupplierAmountRepository::class);
        App::bind(IRepository\IProjectRepository::class, Repository\ProjectRepository::class);
        App::bind(IRepository\IProjectRelatedFileRepository::class, Repository\ProjectRelatedFileRepository::class);
        App::bind(IRepository\ITodoRepository::class, Repository\TodoRepository::class);
        App::bind(IRepository\ITodoAttachmentsRepository::class, Repository\TodoAttachmentsRepository::class);
        App::bind(IRepository\IProjectProductRepository::class, Repository\ProjectProductRepository::class);
        App::bind(IRepository\IProjectProductMemoRepository::class, Repository\ProjectProductMemoRepository::class);
        App::bind(IRepository\IProjectProductShippingFeesRepository::class, Repository\ProjectProductShippingFeesRepository::class);
    }
}
