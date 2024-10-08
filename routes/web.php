<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use BotMan\BotMan\BotMan;
use App\Http\conversations\TreeConversation;



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

    
    Route::get('/tickets', [TicketController::class, 'indexTicket'])->name('user.ticket');
    Route::get('/tickets/create', [TicketController::class, 'createTicket'])->name('ticket.create');
    Route::post('/tickets', [TicketController::class, 'storeTicket'])->name('ticket.store');
    Route::get('/tickets/edit/{ticket}', [TicketController::class, 'editTicket'])->name('ticket.edit');
    Route::put('/tickets/update/{ticket}', [TicketController::class, 'updateTicket'])->name('ticket.update');
    Route::delete('tickets/delete/{id}', [TicketController::class, 'destroyTicket'])->name('ticket.destroy');
});

Route::middleware(['auth'])->group(function() {
    // Rute untuk menampilkan halaman chatbot
    Route::get('/chatbot', function () {
        return view('chatbot.chatbot');
    });

    Route::match(['get', 'post'], '/botman', function () {
        $botman = app('botman');
    
        $botman->hears('{message}', function (BotMan $botman, $message) {
            $botman->startConversation( new TreeConversation);
        });
    
        $botman->listen();
    });
});

Route::middleware(['auth', 'user-access:admin, officer'])->group(function() {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/tickets/list', [TicketController::class, 'myTicketsForOfficer'])->name('ticket');
    Route::post('/acceptTicket/{id}', [TicketController::class, 'acceptTicket'])->name('accept');
});
