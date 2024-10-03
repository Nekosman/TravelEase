<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('landing_page   ');
});



Route::controller(AuthController::class)->group(function () {
    //register
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    //login
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    //logout
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware(['auth', 'user-access:admin'])->group(function(){
    Route::get('/admin',[HomeController::class, 'adminHome'])->name('admin.home');
});

Route::middleware(['auth', 'user-access:officer'])->group(function(){
    Route::get('/agent',[HomeController::class, 'adminOfficer'])->name('officer.home');
});

Route::middleware(['auth', 'user-access:user'])->group(function(){
    Route::get('/home',[HomeController::class, 'userHome'])->name('user.home');
});