<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\TicketMessageController;
use App\Http\Controllers\API\ConversationController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\FaqController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Category
// Rute untuk menampilkan kategori melalui metode `index`
Route::middleware('auth:sanctum')->get('/categories', [CategoryController::class, 'index']);

// Rute untuk menampilkan kategori melalui metode `view`
Route::get('/categories-view', [App\Http\Controllers\API\CategoryController::class, 'view']);

// Ticket
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/ticket', [App\Http\Controllers\API\TicketController::class, 'index']);
    Route::post('/tickets', [App\Http\Controllers\API\TicketController::class, 'store']);
    Route::put('/tickets/{ticket}', [App\Http\Controllers\API\TicketController::class, 'update']);
    // Route::post('/tickets/{id}/accept', [App\Http\Controllers\API\TicketController::class, 'acceptTicket']);
    // Route::post('/tickets/{id}/close', [App\Http\Controllers\API\TicketController::class, 'closeTicket']);

    // Ticket Messages
    Route::get('/tickets/{ticketId}/messages', [TicketMessageController::class, 'index']);
    Route::post('/tickets/{ticketId}/messages', [TicketMessageController::class, 'store']);

    // Profile routes
    Route::middleware('auth:sanctum')->prefix('profile')->group(function () {
        Route::put('/update', [ProfileController::class, 'updateProfile']);
        Route::put('/password', [ProfileController::class, 'updatePassword']);
        Route::put('/notifications', [ProfileController::class, 'updateNotifications']);
        Route::get('/', [ProfileController::class, 'getProfile']); // Tambahkan ini
    });
});

// Conversation API Routes
Route::prefix('conversation')->group(function () {
    Route::get('/initial', [ConversationController::class, 'getInitialNodes']);
    Route::get('/children/{parentId}', [ConversationController::class, 'getChildNodes']);
    Route::get('/node/{id}', [ConversationController::class, 'getNode']);
    Route::get('/path/{nodeId}', [ConversationController::class, 'getConversationPath']);
    
});

Route::get('/faq-categories', [FaqController::class, 'index']);
Route::get('/faqs/category/{categoryId}', [FaqController::class, 'getByCategory']);
Route::get('/faqs/subsCategory/{subsId}', [FaqController::class, 'getsubsCategory']);
Route::get('/faqs/getfaq/{faqId}', [FaqController::class, 'getFaqsBySubsCategory']);

Route::get('/faqs/categories-with-faqs', [FaqController::class, 'getFaqCategoriesWithSubcategoriesAndFaqs']);


// Route::prefix('faqs')->group(function () {
//     Route::get('/', [FaqController::class, 'index']);         // Mendapatkan semua FAQ
// });
