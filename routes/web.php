<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardCsController;
use App\Http\Controllers\TicketAlertController;
use App\Http\Controllers\ChatController;


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
    return view('welcome');
});

// Route untuk dashboard
Route::get('/dashboard', [DashboardCsController::class, 'index'])->name('dashboard.index');
// Route untuk ticket_alert
Route::get('/Tickets', [TicketAlertController::class, 'index'])->name('tickets.index');
// Route untuk chat
Route::get('/Chat', [ChatController::class, 'index'])->name('chat.index');
