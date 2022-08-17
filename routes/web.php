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

Route::get('/barangay_admin', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/proceeding', [App\Http\Controllers\Barangay_controller::class, 'proceeding'])->name('proceeding');
Route::post('/proceeding_register', [App\Http\Controllers\Barangay_controller::class, 'proceeding_register'])->name('proceeding_register');

Route::get('/barangay_admin_login', [App\Http\Controllers\Barangay_controller::class, 'barangay_admin_login'])->name('barangay_admin_login');
Route::get('/home', [App\Http\Controllers\Barangay_controller::class, 'home'])->name('home')->middleware(['auth', 'verified']);


Route::get('/barangay_position', [App\Http\Controllers\Barangay_controller::class, 'barangay_position'])->name('barangay_position');
Route::get('/register_officials', [App\Http\Controllers\Barangay_controller::class, 'register_officials'])->name('register_officials');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
