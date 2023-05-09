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

Route::get('test', function() {
    $path = config('order-import.default_file');

    \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\OrderImport(), $path);
    dd('what do i get here?', [
        \App\Models\Office::count(),
        \App\Models\Employee::count(),
        \App\Models\Customer::count(),
        \App\Models\Order::count()
    ]);
});
