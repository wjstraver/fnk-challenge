<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::get('orders', function() {
    $orders = \App\Models\Order::with('employee', 'office', 'customer')->get();

    return \App\Http\Resources\OrderResource::collection($orders);
});

Route::get('employees', function() {
    $employees = \App\Models\Employee::withCount('orders')->get();

    return \App\Http\Resources\EmployeeResource::collection($employees);
});


Route::get('products', function() {
    // $products = Order select raw distinct and count
    $o = \App\Models\Order::query()
        ->selectRaw('product, COUNT(*) as sale_count')
        ->groupBy('product')
        ->get();

    dd($o->toArray());
});
