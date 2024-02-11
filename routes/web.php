<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterPemetaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get("/",[BerandaController::class,"index"])->name("beranda");
Route::get("login", [LoginController::class, 'index'])->name('login');
Route::post("login", [LoginController::class, 'store'])->name('login.store');
Route::get("register", [RegisterController::class, 'index'])->name('register');
Route::post("register", [RegisterController::class, 'store'])->name("register.store");
Route::get("logout", [LoginController::class, 'logout'])->name('logout');
Route::prefix('account')->group(function () {
    Route::middleware("multiauth")->group(function(){
        Route::get("dashboard", [DashboardController::class, "index"])->name("dashboard");
        Route::resource("master-pemetaan",MasterPemetaanController::class);
        Route::resource("profile",ProfileController::class);        
      
    });

    Route::middleware(["multiauth","isAdmin"])->group(function(){
        Route::resource("master-vendor",UserController::class);
    });
});
