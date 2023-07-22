<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AuthController, ProfileController, UserController, ReportAgencyController, PlatformController, AgencyController, RecruitController, HostController};
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
    // return view('welcome');
    return redirect('/6462/75726969/');
});

// Auth::routes();

Route::group(['middleware' => ['admin_auth']], function(){
    
    Route::get('/6462/75726970/', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/6462/logout/', [ProfileController::class, 'logout'])->name('logout');

    // Users
    Route::get('/6462/75726971/', [UserController::class, 'index'])->name('users.index'); // tested
    Route::get('/6462/{id}/75726972', [UserController::class, 'edit'])->name('users.edit'); // tested
    Route::post('/6462/{id}/75726973', [UserController::class, 'update'])->name('users.update'); // tested
    Route::get('/6462/75726974', [UserController::class, 'create'])->name('users.create'); // tested
    Route::post('/6462/75726975', [UserController::class, 'store'])->name('users.store'); // tested
    Route::get('/6462/{id}/75726976', [UserController::class, 'destroy'])->name('users.destroy'); // tested

    // Reports
    Route::get('/6462/75727971/', [ReportAgencyController::class, 'index'])->name('reportagency.index'); // tested
    Route::get('/6462/{id}/75727972', [ReportAgencyController::class, 'edit'])->name('reportagency.edit'); // tested
    Route::post('/6462/{id}/75727973', [ReportAgencyController::class, 'update'])->name('reportagency.update'); // tested
    Route::get('/6462/75727974', [ReportAgencyController::class, 'create'])->name('reportagency.create'); // tested
    Route::post('/6462/75727975', [ReportAgencyController::class, 'store'])->name('reportagency.store'); // tested
    Route::get('/6462/{id}/75727976', [ReportAgencyController::class, 'destroy'])->name('reportagency.destroy'); // tested

    // Agency
    Route::get('/6462/75728971/', [AgencyController::class, 'index'])->name('agency.index'); // tested
    Route::get('/6462/{id}/75728972', [AgencyController::class, 'edit'])->name('agency.edit'); // tested
    Route::post('/6462/{id}/75728973', [AgencyController::class, 'update'])->name('agency.update'); // tested
    Route::get('/6462/75728974', [AgencyController::class, 'create'])->name('agency.create'); // tested
    Route::post('/6462/75728975', [AgencyController::class, 'store'])->name('agency.store'); // tested
    Route::get('/6462/{id}/75728976', [AgencyController::class, 'destroy'])->name('agency.destroy'); // tested

    // Platform
    Route::get('/6462/75729971/', [PlatformController::class, 'index'])->name('platform.index'); // tested
    Route::get('/6462/{id}/75729972', [PlatformController::class, 'edit'])->name('platform.edit'); // tested
    Route::post('/6462/{id}/75729973', [PlatformController::class, 'update'])->name('platform.update'); // tested
    Route::get('/6462/75729974', [PlatformController::class, 'create'])->name('platform.create'); // tested
    Route::post('/6462/75729975', [PlatformController::class, 'store'])->name('platform.store'); // tested
    Route::get('/6462/{id}/75729976', [PlatformController::class, 'destroy'])->name('platform.destroy'); // tested

    // Recruit
    Route::get('/6462/75721071/', [RecruitController::class, 'index'])->name('recruit.index'); // tested
    Route::get('/6462/{id}/75721072', [RecruitController::class, 'edit'])->name('recruit.edit'); // tested
    Route::post('/6462/{id}/75721073', [RecruitController::class, 'update'])->name('recruit.update'); // tested

    // Host
    Route::get('/6462/75721171/', [HostController::class, 'index'])->name('host.index'); // tested
    Route::get('/6462/{id}/75721172', [HostController::class, 'edit'])->name('host.edit'); // tested
    Route::post('/6462/{id}/75721173', [HostController::class, 'update'])->name('host.update'); // tested
    Route::get('/6462/75721174', [HostController::class, 'create'])->name('host.create'); // tested
    Route::post('/6462/75721175', [HostController::class, 'store'])->name('host.store'); // tested
    Route::get('/6462/{id}/75721176', [HostController::class, 'destroy'])->name('host.destroy'); // tested

    /**
     * PR
     * Modal for Deletion [almost done - kurang dimasukkan ke menu2 lainnya]
     * Report Agency Grid Table [done]
     * Report Agency Import Extraction [done]
     * Report Agency Auto End Date + 6 days from start date [done] [canceled by (SDED) logic]
     * Recruit Auto Create [done]
     * Recruit Auto Delete [pending]
     * User CRuD [done]
     * User Level Access Menu Agency dan Admin dibedakan [done]
     * 
     * Agency Auto Total PLatform, Total Host [done]
     * Platform Auto Total Agency, Total Host [done]
     * Host Menu for Agency Login dibedakan . Agency otomatis keiisi kolom Agency nya dan readonly 
     * Report Agency Total PaidHost, Total Salary, Total Share [done]
     * 
     * Report Agency Period Type Weekl / Monthly [done]
     * Report Agency kolom Week / Month Max 12 [done]
     * (SDED) Klo end date di bulan 7 dan start date di bulan 6, berarti itu masuk Week 1 dst , week 2 sampai 5 juga [done] [revision]
     *        [done] --> revisi logic: The control is on the report_startdate and report_enddate
     *                     If one of the two is change, it will do this logic:
     *                     1. Determine the range between report_startdate and report_enddate, if the diff less or the same as 7 days, than the report_period will be 1 (Weekly) when more than 7 days it will be 2 (Monthly)
     *                     2. If the report_period is set to Weekly, than fill the report_weekmonth with which week of the month is, according to the report_enddate as the main reference. If the report_period is set to Monthly, than fill the report_weekmonth with month of the year is, according to the report_enddate month as the reference.
     *                     Berlaku saat create dan edit
     * 
     * Report agency Upload execl tidak perlu required, opsional saja [done]
     * User CRUD diberi link ke Agency nya siapa [done]
     * Menu Non Admin - Host, difilter hanya yg agency nya dia saja [done]
     */
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/6462/75726969/', [AuthController::class, 'getLogin'])->name('getLogin');
Route::post('/6462/75726971/', [AuthController::class, 'postLogin'])->name('postLogin');

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
/*
Route::get('/file-import',[UserControllerTest::class,'importView'])->name('import-view');
Route::post('/import',[UserControllerTest::class,'import'])->name('import');
Route::get('/export-users',[UserControllerTest::class,'exportUsers'])->name('export-users');
*/