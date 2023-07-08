<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AuthController, ProfileController, UserController};
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
    Route::get('/6462/75726971/', [UserController::class, 'index'])->name('users.index');
    Route::get('/6462/logout/', [ProfileController::class, 'logout'])->name('logout');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/6462/75726969/', [AuthController::class, 'getLogin'])->name('getLogin');
Route::post('/6462/75726969/', [AuthController::class, 'postLogin'])->name('postLogin');