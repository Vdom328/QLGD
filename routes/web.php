<?php

use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\LabsController;
use App\Http\Controllers\StaffsController;
use App\Http\Controllers\ProfileController;
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
        });

        // subject routes
        Route::group(['prefix' => 'subject'], function () {
            Route::get('/', [SubjectController::class, 'index'])->name('subject.index');
            Route::get('/create', [SubjectController::class, 'create'])->name('subject.create');
            Route::get('/radomNo', [SubjectController::class, 'radomNo'])->name('subject.radomNo');
            Route::post('/post-register', [SubjectController::class, 'saveCreate'])->name('subject.saveCreate');
            Route::get('/update/{id}', [SubjectController::class, 'update'])->name('subject.update');
            Route::post('/update', [SubjectController::class, 'saveUpdate'])->name('subject.saveUpdate');
        });

        // labs routes
        Route::group(['prefix' => 'labs'], function () {
            Route::get('/', [LabsController::class, 'index'])->name('labs.index');
            Route::post('/create', [LabsController::class, 'create'])->name('labs.create');
        });

        // teachers subject routes
        Route::group(['prefix' => 'teacher-subject'], function () {
            Route::get('/', [TeacherSubjectController::class, 'index'])->name('teacherSubject.index');
        });
    });


});

