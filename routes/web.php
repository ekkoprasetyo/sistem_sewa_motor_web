<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ChangeProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MasterMotorController;
use App\Http\Controllers\MotorRentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index']);

//Login Section
Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/validate', [LoginController::class, 'validate_login'])->name('login.validate');
    Route::get('/destroy', [LoginController::class, 'destroy'])->name('login.destroy');
});

//Recover Password Section
Route::prefix('recover-password')->group(function () {
    Route::get('/', [LoginController::class, 'recover_password'])->name('recover-password');
    Route::post('/validate', [LoginController::class, 'recover_password_validate'])->name('recover-password.validate');
});

//Clock
Route::get('/clock', function () {
    return response()->json(['status' => 'success', 'clock' => date("j F, Y, H:i:s")]);
})->name('clock');

//Route Home
Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

//Route Need Session and Check Force Change Password
Route::group(['middleware' => ['session.login','user.force_change_password']], function () {

    //Route Change Profile
    Route::prefix('change-profile')->group(function () {
        Route::post('/', [ChangeProfileController::class, 'index'])->name('change-profile');
        Route::patch('/update-profile', [ChangeProfileController::class, 'update_profile'])->name('change-profile.update-profile');
        Route::post('/password',[ChangeProfileController::class, 'password'])->name('change-profile.password');
        Route::patch('/update-password',[ChangeProfileController::class, 'update_password'])->name('change-profile.update-password');
    });

    // Route Need Permission
    Route::group(['middleware' => ['user.permission']], function () {
        //Route Permission
        Route::prefix('permission')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('permission');
            Route::post('/datatables',[PermissionController::class, 'datatables'])->name('permission.datatables');
            Route::post('/add', [PermissionController::class, 'add'])->name('permission.add');
            Route::post('/store', [PermissionController::class, 'store'])->name('permission.store');
            Route::post('/edit', [PermissionController::class, 'edit'])->name('permission.edit');
            Route::patch('/update', [PermissionController::class, 'update'])->name('permission.update');
            Route::post('/delete', [PermissionController::class, 'delete'])->name('permission.delete');
            Route::patch('/destroy', [PermissionController::class, 'destroy'])->name('permission.destroy');
        });

        //Route Role
        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('role');
            Route::post('/datatables',[RoleController::class, 'datatables'])->name('role.datatables');
            Route::post('/add', [RoleController::class, 'add'])->name('role.add');
            Route::post('/store', [RoleController::class, 'store'])->name('role.store');
            Route::post('/edit', [RoleController::class, 'edit'])->name('role.edit');
            Route::post('/edit-permission', [RoleController::class, 'edit_permission'])->name('role.edit-permission');
            Route::patch('/update', [RoleController::class, 'update'])->name('role.update');
            Route::patch('/update-permission', [RoleController::class, 'update_permission'])->name('role.update-permission');
            Route::post('/delete', [RoleController::class, 'delete'])->name('role.delete');
            Route::patch('/destroy', [RoleController::class, 'destroy'])->name('role.destroy');
            Route::post('/detail', [RoleController::class, 'detail'])->name('role.detail');
        });

        //Route User
        Route::prefix('user')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('user');
            Route::post('/datatables',[UsersController::class, 'datatables'])->name('user.datatables');
            Route::post('/add', [UsersController::class, 'add'])->name('user.add');
            Route::post('/store', [UsersController::class, 'store'])->name('user.store');
            Route::post('/detail', [UsersController::class, 'detail'])->name('user.detail');
            Route::post('/edit', [UsersController::class, 'edit'])->name('user.edit');
            Route::patch('/update', [UsersController::class, 'update'])->name('user.update');
            Route::post('/edit-password', [UsersController::class, 'edit_password'])->name('user.edit-password');
            Route::patch('/update-password', [UsersController::class, 'update_password'])->name('user.update-password');
            Route::post('/delete', [UsersController::class, 'delete'])->name('user.delete');
            Route::patch('/destroy', [UsersController::class, 'destroy'])->name('user.destroy');
        });

        //Route Master Motor
        Route::prefix('master-motor')->group(function () {
            Route::get('/', [MasterMotorController::class, 'index'])->name('master-motor');
            Route::post('/datatables',[MasterMotorController::class, 'datatables'])->name('master-motor.datatables');
            Route::post('/add', [MasterMotorController::class, 'add'])->name('master-motor.add');
            Route::post('/store', [MasterMotorController::class, 'store'])->name('master-motor.store');
            Route::post('/edit', [MasterMotorController::class, 'edit'])->name('master-motor.edit');
            Route::patch('/update', [MasterMotorController::class, 'update'])->name('master-motor.update');
            Route::post('/detail', [MasterMotorController::class, 'detail'])->name('master-motor.detail');
            Route::post('/delete', [MasterMotorController::class, 'delete'])->name('master-motor.delete');
            Route::patch('/destroy', [MasterMotorController::class, 'destroy'])->name('master-motor.destroy');
        });

        //Route Motor Rent
        Route::prefix('motor-rent')->group(function () {
            Route::get('/', [MotorRentController::class, 'index'])->name('motor-rent');
            Route::post('/datatables',[MotorRentController::class, 'datatables'])->name('motor-rent.datatables');
            Route::post('/add', [MotorRentController::class, 'add'])->name('motor-rent.add');
            Route::post('/store', [MotorRentController::class, 'store'])->name('motor-rent.store');
            Route::post('/edit', [MotorRentController::class, 'edit'])->name('motor-rent.edit');
            Route::patch('/update', [MotorRentController::class, 'update'])->name('motor-rent.update');
            Route::post('/detail', [MotorRentController::class, 'detail'])->name('motor-rent.detail');
            Route::post('/delete', [MotorRentController::class, 'delete'])->name('motor-rent.delete');
            Route::patch('/destroy', [MotorRentController::class, 'destroy'])->name('motor-rent.destroy');
        });
    });
});
