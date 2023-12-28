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
        App::bind(IRepository\IRoleUserRepository::class, Repository\RoleUserRepository::class);
        App::bind(IRepository\IClassRoomRepository::class, Repository\ClassRoomRepository::class);
    }
}
