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
        App::bind(IService\IClassRoomService::class, Service\ClassRoomService::class);
        App::bind(IService\ISubjectService::class, Service\SubjectService::class);
        App::bind(IService\ILabsService::class, Service\LabsService::class);
        App::bind(IService\ITeacherSubjectService::class, Service\TeacherSubjectService::class);
        App::bind(IService\ISchedulerService::class, Service\SchedulerService::class);
        App::bind(IService\IClassService::class, Service\ClassService::class);
        App::bind(IService\IStudentSubjectService::class, Service\StudentSubjectService::class);
    }
}
