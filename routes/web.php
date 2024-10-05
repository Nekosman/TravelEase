<?php

use App\Http\Controllers\AuthController;
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

    Route::get('/officer/tickets', [TicketController::class, 'myTicketsForOfficer'])->name('officer.ticket');
    Route::get('officer/tickets/{id}/accept', [TicketController::class, 'showAcceptForm'])->name('officer.showAcceptForm');
    Route::post('officer/acceptTicket/{id}', [TicketController::class, 'acceptTicket'])->name('officer.accept');
});

Route::middleware(['auth', 'user-access:user'])->group(function(){
    Route::get('/home',[HomeController::class, 'userHome'])->name('user.home');

    
    Route::get('/tickets', [TicketController::class, 'indexTicket'])->name('ticket.index');
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

    // // Rute ini HANYA untuk menangani percakapan, bukan untuk merender halaman chatbot
    // Route::get('/botman/chat', function () {
    //     return '';
    // });
});
