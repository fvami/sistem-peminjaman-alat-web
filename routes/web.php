<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanDetailController;

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
    return view('public.landing');
});



Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name(('register.store'));
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth', 'administrator'])->group(function () {
    Route::get('/user-view', [AccountController::class, 'index'])->name('user.view');
    Route::get('/user', [AccountController::class, 'user']);
    Route::get('/user-show/{id}', [AccountController::class, 'show']);
    Route::put('/user-update/{id}', [AccountController::class, 'update']);
    Route::get('/user-delete/{id}', [AccountController::class, 'delete']);

    Route::get('/category-view', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/category', [CategoryController::class, 'category'])->name('category.view');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/tool-view', [ToolController::class, 'index'])->name('admin.tool');
    Route::get('/tool', [ToolController::class, 'tool'])->name('tool.view');
    Route::get('/tool/{id}', [ToolController::class, 'show'])->name('tool.show');
    Route::post('/tool', [ToolController::class, 'store'])->name('tool.store');
    Route::put('/tool/{id}', [ToolController::class, 'update'])->name('tool.update');
    Route::delete('/tool/{id}', [ToolController::class, 'delete'])->name('tool.delete');
});

Route::middleware(['auth', 'operator'])->group(function () {
    Route::get('/loan-view', [LoanController::class, 'index'])->name('operator.loan');
    Route::post('/loans/cart', [LoanController::class, 'cart'])->name('loans.cart');
    Route::post('/loans/store', [LoanController::class, 'store'])->name('loans.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.view');
    Route::prefix('/loans-detail-view')->group(function () {
        Route::get('/', [LoanDetailController::class, 'index'])->name('loans.detail');
        Route::post('/{loan}/update-status', [LoanDetailController::class, 'updateStatus'])->name('loans.update-global-status');
        Route::delete('/{loan}', [LoanDetailController::class, 'destroy'])->name('loans.destroy');
    });
});
