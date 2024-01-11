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
        App::bind(IRepository\ISubjectRepository::class, Repository\SubjectRepository::class);
        App::bind(IRepository\ISubjectLabsRepository::class, Repository\SubjectLabsRepository::class);
        App::bind(IRepository\ITeacherSubjectRepository::class, Repository\TeacherSubjectRepository::class);
        App::bind(IRepository\IScheduleRepository::class, Repository\ScheduleRepository::class);
        App::bind(IRepository\IScheduleTableRepository::class, Repository\ScheduleTableRepository::class);
        App::bind(IRepository\IScheduleErrorRepository::class, Repository\ScheduleErrorRepository::class);
        App::bind(IRepository\ITeacherTimeSlotsRepository::class, Repository\TeacherTimeSlotsRepository::class);
        App::bind(IRepository\IClassRepository::class, Repository\ClassRepository::class);
        App::bind(IRepository\IStudentSubjectRepository::class, Repository\StudentSubjectRepository::class);
    }
}
