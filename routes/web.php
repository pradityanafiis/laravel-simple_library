<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

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

Auth::routes();
Route::get('/', [LoginController::class, 'showLoginForm']);
Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('book', BookController::class)->except(['show']);
    Route::resource('member', MemberController::class)->except(['show']);
    Route::resource('transaction', TransactionController::class);
    Route::put('transaction/{transaction}/return', [TransactionController::class, 'returnBook'])->name('transaction.return');
    Route::put('transaction/{transaction}/cancel', [TransactionController::class, 'cancelTransaction'])->name('transaction.cancel');
    Route::resource('report', ReportController::class)->only(['index']);
    Route::post('report/download', [ReportController::class, 'download'])->name('report.download');
});
