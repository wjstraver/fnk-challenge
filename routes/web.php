<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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

Route::get('', [Controller::class, 'index'])->name('index');

Route::prefix('customers')->as('customers.')->group(function () {
    Route::get('', [CustomerController::class, 'index'])->name('index');
    Route::get('{customer}', [CustomerController::class, 'show'])->name('show');
});

Route::prefix('employees')->as('employees.')->group(function () {
    Route::get('', [EmployeeController::class, 'index'])->name('index');
    Route::get('{employee}', [EmployeeController::class, 'show'])->name('show');
});

Route::prefix('offices')->as('offices.')->group(function () {
    Route::get('', [OfficeController::class, 'index'])->name('index');
    Route::get('{office}', [OfficeController::class, 'show'])->name('show');
});

Route::prefix('orders')->as('orders.')->group(function () {
    Route::get('', [OrderController::class, 'index'])->name('index');
    Route::get('{order}', [OrderController::class, 'show'])->name('show');
});

Route::prefix('products')->as('products.')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('index');
    Route::get('{product}', [ProductController::class, 'show'])->name('show');
});
