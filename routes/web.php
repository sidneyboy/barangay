<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/proceeding', [App\Http\Controllers\Barangay_controller::class, 'proceeding'])->name('proceeding');
Route::post('/proceeding_register', [App\Http\Controllers\Barangay_controller::class, 'proceeding_register'])->name('proceeding_register');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
