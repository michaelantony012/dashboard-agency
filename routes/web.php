<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AuthController, ProfileController, UserController, ReportAgencyController, PlatformController, AgencyController};
use App\Http\Controllers\UserControllerTest;

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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::group(['middleware' => ['admin_auth']], function(){
    
    Route::get('/6462/75726970/', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/6462/logout/', [ProfileController::class, 'logout'])->name('logout');

    // Users
    Route::get('/6462/75726971/', [UserController::class, 'index'])->name('users.index');
    Route::get('/6462/{id}/75726972', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/6462/75726973', [UserController::class, 'update'])->name('users.update');
    Route::get('/6462/75726974', [UserController::class, 'create'])->name('users.create');
    Route::post('/6462/75726975', [UserController::class, 'store'])->name('users.store');
    Route::get('/6462/{id}/75726976', [UserController::class, 'destroy'])->name('users.destroy');

    // Reports
    Route::get('/6462/75727971/', [ReportAgencyController::class, 'index'])->name('reportagency.index');
    Route::get('/6462/{id}/75727972', [ReportAgencyController::class, 'edit'])->name('reportagency.edit');
    Route::post('/6462/75727973', [ReportAgencyController::class, 'update'])->name('reportagency.update');
    Route::get('/6462/75727974', [ReportAgencyController::class, 'create'])->name('reportagency.create');
    Route::post('/6462/75727975', [ReportAgencyController::class, 'store'])->name('reportagency.store');
    Route::get('/6462/{id}/75727976', [ReportAgencyController::class, 'destroy'])->name('reportagency.destroy');

    // Reports
    Route::get('/6462/75728971/', [AgencyController::class, 'index'])->name('agency.index');
    Route::get('/6462/{id}/75728972', [AgencyController::class, 'edit'])->name('agency.edit');
    Route::post('/6462/75728973', [AgencyController::class, 'update'])->name('agency.update');
    Route::get('/6462/75728974', [AgencyController::class, 'create'])->name('agency.create');
    Route::post('/6462/75728975', [AgencyController::class, 'store'])->name('agency.store');
    Route::get('/6462/{id}/75728976', [AgencyController::class, 'destroy'])->name('agency.destroy');

    // Reports
    Route::get('/6462/75729971/', [PlatformController::class, 'index'])->name('platform.index');
    Route::get('/6462/{id}/75729972', [PlatformController::class, 'edit'])->name('platform.edit');
    Route::post('/6462/75729973', [PlatformController::class, 'update'])->name('platform.update');
    Route::get('/6462/75729974', [PlatformController::class, 'create'])->name('platform.create');
    Route::post('/6462/75729975', [PlatformController::class, 'store'])->name('platform.store');
    Route::get('/6462/{id}/75729976', [PlatformController::class, 'destroy'])->name('platform.destroy');

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/6462/75726969/', [AuthController::class, 'getLogin'])->name('getLogin');
Route::post('/6462/75726969/', [AuthController::class, 'postLogin'])->name('postLogin');

/**
 * test import export
 * SOURCES: https://techvblogs.com/blog/laravel-import-export-excel-csv-file
 * 
 * step install maatwebsite/excel
 * composer require maatwebsite/excel --ignore-platform-reqs
 * it will be installed version 3.1
 * follow the publishing procedures until succedeed
 * run composer update again, it will downgrading the zipstream-php 3.1 to 2.2.6, because of php 7.4. And the export will be working. I have a screenshot on it
 */

Route::get('/file-import',[UserControllerTest::class,'importView'])->name('import-view');
Route::post('/import',[UserControllerTest::class,'import'])->name('import');
Route::get('/export-users',[UserControllerTest::class,'exportUsers'])->name('export-users');
