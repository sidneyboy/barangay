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

Route::get('/official_assistance_request/{user_id}', [App\Http\Controllers\Official_controller::class, 'official_assistance_request'])->name('official_assistance_request');
Route::post('/official_assistance_approved', [App\Http\Controllers\Official_controller::class, 'official_assistance_approved'])->name('official_assistance_approved');

Route::get('/official_profile/{user_id}', [App\Http\Controllers\Official_controller::class, 'official_profile'])->name('official_profile');
Route::post('/official_profile_update', [App\Http\Controllers\Official_controller::class, 'official_profile_update'])->name('official_profile_update');
Route::post('/official_profile_update_image', [App\Http\Controllers\Official_controller::class, 'official_profile_update_image'])->name('official_profile_update_image');









Route::get('/official_logout', [App\Http\Controllers\Official_controller::class, 'official_logout'])->name('official_logout');

Route::get('/resident_welcome/{resident_id}', [App\Http\Controllers\Resident_controller::class, 'resident_welcome'])->name('resident_welcome');
Route::get('/res_assistance/{resident_id}', [App\Http\Controllers\Resident_controller::class, 'res_assistance'])->name('res_assistance');
Route::post('/res_assistance_process', [App\Http\Controllers\Resident_controller::class, 'res_assistance_process'])->name('res_assistance_process');

Route::get('/res_assistance_request/{resident_id}', [App\Http\Controllers\Resident_controller::class, 'res_assistance_request'])->name('res_assistance_request');


Route::get('/resident_profile/{resident_id}', [App\Http\Controllers\Resident_controller::class, 'resident_profile'])->name('resident_profile');
Route::post('/resident_profile_update', [App\Http\Controllers\Resident_controller::class, 'resident_profile_update'])->name('resident_profile_update');
Route::post('/resident_profile_image_update', [App\Http\Controllers\Resident_controller::class, 'resident_profile_image_update'])->name('resident_profile_image_update');

Route::get('/resident_complain/{resident_id}', [App\Http\Controllers\Resident_controller::class, 'resident_complain'])->name('resident_complain');
Route::post('/resident_complain_process', [App\Http\Controllers\Resident_controller::class, 'resident_complain_process'])->name('resident_complain_process');

Route::get('/resident_complain_request/{resident_id}', [App\Http\Controllers\Resident_controller::class, 'resident_complain_request'])->name('resident_complain_request');









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


Route::get('/barangay_logo', [App\Http\Controllers\Barangay_controller::class, 'barangay_logo'])->name('barangay_logo');
Route::post('/barangay_logo_process', [App\Http\Controllers\Barangay_controller::class, 'barangay_logo_process'])->name('barangay_logo_process');


Route::get('/barangay_resident_register', [App\Http\Controllers\Barangay_controller::class, 'barangay_resident_register'])->name('barangay_resident_register');
Route::post('/barangay_resident_register_process', [App\Http\Controllers\Barangay_controller::class, 'barangay_resident_register_process'])->name('barangay_resident_register_process');

Route::get('/barangay_resident_profile', [App\Http\Controllers\Barangay_controller::class, 'barangay_resident_profile'])->name('barangay_resident_profile');

Route::get('/barangay_profile', [App\Http\Controllers\Barangay_controller::class, 'barangay_profile'])->name('barangay_profile');

Route::post('/barangay_profile_update_process', [App\Http\Controllers\Barangay_controller::class, 'barangay_profile_update_process'])->name('barangay_profile_update_process');
Route::post('/barangay_profile_update_image', [App\Http\Controllers\Barangay_controller::class, 'barangay_profile_update_image'])->name('barangay_profile_update_image');

Route::get('/register_officials', [App\Http\Controllers\Barangay_controller::class, 'register_officials'])->name('register_officials');


Route::get('/barangay_complain_report', [App\Http\Controllers\Barangay_controller::class, 'barangay_complain_report'])->name('barangay_complain_report');
Route::post('/barangay_complain_approved', [App\Http\Controllers\Barangay_controller::class, 'barangay_complain_approved'])->name('barangay_complain_approved');



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
