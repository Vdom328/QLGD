<?php

use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\LabsController;
use App\Http\Controllers\StaffsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchedulerController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherSubjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

    Route::get('/', [StaffsController::class, 'getListStaffs'])->name('home');
    // Profile route
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/{id}', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/update', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
        Route::get('/radom/staff_no', [ProfileController::class, 'radomStaffNo'])->name('profile.radomStaffNo');
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

        // class rooms routes
        Route::group(['prefix' => 'class-room'], function () {
            Route::get('/', [ClassRoomController::class, 'index'])->name('classroom.index');
            Route::get('/create', [ClassRoomController::class, 'create'])->name('classroom.create');
            Route::post('/post-register', [ClassRoomController::class, 'postRegister'])->name('classroom.postRegister');
            Route::get('/update/{id}', [ClassRoomController::class, 'update'])->name('classroom.update');
            Route::post('/update', [ClassRoomController::class, 'saveUpdate'])->name('classroom.saveUpdate');
            Route::delete('/delete/{id}', [ClassRoomController::class, 'delete'])->name('classroom.delete');
        });

        // subject routes
        Route::group(['prefix' => 'subject'], function () {
            Route::get('/', [SubjectController::class, 'index'])->name('subject.index');
            Route::get('/create', [SubjectController::class, 'create'])->name('subject.create');
            Route::get('/radomNo', [SubjectController::class, 'radomNo'])->name('subject.radomNo');
            Route::post('/post-register', [SubjectController::class, 'saveCreate'])->name('subject.saveCreate');
            Route::get('/update/{id}', [SubjectController::class, 'update'])->name('subject.update');
            Route::post('/update', [SubjectController::class, 'saveUpdate'])->name('subject.saveUpdate');
            Route::delete('/delete/{id}', [SubjectController::class, 'delete'])->name('subject.delete');
        });

        // labs routes
        Route::group(['prefix' => 'labs'], function () {
            Route::get('/', [LabsController::class, 'index'])->name('labs.index');
            Route::post('/create', [LabsController::class, 'create'])->name('labs.create');
        });

        // teachers subject routes
        Route::group(['prefix' => 'teacher-subject'], function () {
            Route::get('/', [TeacherSubjectController::class, 'index'])->name('teacherSubject.index');
            Route::get('/update/{id}', [TeacherSubjectController::class, 'update'])->name('teacherSubject.update');
            Route::post('/create', [TeacherSubjectController::class, 'create'])->name('teacherSubject.create');
            Route::post('/create-subject', [TeacherSubjectController::class, 'createSubject'])->name('teacherSubject.createSubject');
            Route::delete('/delete/{id}', [TeacherSubjectController::class, 'delete'])->name('teacherSubject.delete');
            Route::post('/create-time-slots', [TeacherSubjectController::class, 'createTimeSlots'])->name('teacherSubject.createTimeSlots');
        });

        // scheduler routes
        Route::group(['prefix' => 'scheduler'], function () {
            Route::get('/', [SchedulerController::class, 'index'])->name('scheduler.index');
            Route::get('/create-new', [SchedulerController::class, 'createNew'])->name('scheduler.createNew');
        });

        // settings
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', [SettingController::class, 'index'])->name('settings.index');
            Route::post('/update', [SettingController::class, 'update'])->name('settings.update');

        });
    });


});

