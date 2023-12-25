<?php

use App\Http\Controllers\StaffsController;
use App\Http\Controllers\ProfileController;
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


    });


});

