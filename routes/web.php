<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {return view('official_login');});
Route::post('/official_login_process', [App\Http\Controllers\Official_controller::class, 'official_login_process'])->name('official_login_process');

Route::get('/official_welcome/{user_id}', [App\Http\Controllers\Official_controller::class, 'official_welcome'])->name('official_welcome');

Route::get('/official_assistance_type/{user_id}', [App\Http\Controllers\Official_controller::class, 'official_assistance_type'])->name('official_assistance_type');
Route::post('/official_assistance_type_process', [App\Http\Controllers\Official_controller::class, 'official_assistance_type_process'])->name('official_assistance_type_process');

Route::get('/official_res_registration/{user_id}', [App\Http\Controllers\Official_controller::class, 'official_res_registration'])->name('official_res_registration');
Route::post('/official_res_registration_process', [App\Http\Controllers\Official_controller::class, 'official_res_registration_process'])->name('official_res_registration_process');


Route::get('/official_res_profile/{user_id}', [App\Http\Controllers\Official_controller::class, 'official_res_profile'])->name('official_res_profile');
Route::post('/official_res_profile_update', [App\Http\Controllers\Official_controller::class, 'official_res_profile_update'])->name('official_res_profile_update');



Route::get('/barangay_admin', function () {return view('welcome');});

Auth::routes();

Route::get('/proceeding', [App\Http\Controllers\Barangay_controller::class, 'proceeding'])->name('proceeding');
Route::post('/proceeding_register', [App\Http\Controllers\Barangay_controller::class, 'proceeding_register'])->name('proceeding_register');

Route::get('/barangay_admin_login', [App\Http\Controllers\Barangay_controller::class, 'barangay_admin_login'])->name('barangay_admin_login');
Route::get('/home', [App\Http\Controllers\Barangay_controller::class, 'home'])->name('home')->middleware(['auth', 'verified']);


Route::get('/barangay_position', [App\Http\Controllers\Barangay_controller::class, 'barangay_position'])->name('barangay_position');
Route::post('/barangay_position_process', [App\Http\Controllers\Barangay_controller::class, 'barangay_position_process'])->name('barangay_position_process');
Route::post('/barangay_position_update', [App\Http\Controllers\Barangay_controller::class, 'barangay_position_update'])->name('barangay_position_update');
Route::get('/barangay_position_delete/{id}', [App\Http\Controllers\Barangay_controller::class, 'barangay_position_delete'])->name('barangay_position_delete');

Route::get('/barangay_register', [App\Http\Controllers\Barangay_controller::class, 'barangay_register'])->name('barangay_register');
Route::post('/barangay_register_process', [App\Http\Controllers\Barangay_controller::class, 'barangay_register_process'])->name('barangay_register_process');

Route::get('/barangay_officials_profile', [App\Http\Controllers\Barangay_controller::class, 'barangay_officials_profile'])->name('barangay_officials_profile');
Route::post('/barangay_official_update', [App\Http\Controllers\Barangay_controller::class, 'barangay_official_update'])->name('barangay_official_update');

Route::get('/barangay_logout', [App\Http\Controllers\Barangay_controller::class, 'barangay_logout'])->name('barangay_logout');









Route::get('/register_officials', [App\Http\Controllers\Barangay_controller::class, 'register_officials'])->name('register_officials');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
