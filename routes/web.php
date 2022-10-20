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

Route::get('/', function () {return view('background');});
Route::get('/official_login', function () {return view('official_login');});

// official_login
Route::post('/official_login_process', [App\Http\Controllers\Official_controller::class, 'official_login_process'])->name('official_login_process');




Route::get('/finance_welcome/{user_id}', [App\Http\Controllers\Official_controller::class, 'finance_welcome'])->name('finance_welcome');

Route::get('/chairman_welcome/{user_id}', [App\Http\Controllers\Official_controller::class, 'chairman_welcome'])->name('chairman_welcome');



// Route::get('/finance_document_request_received_payment/{user_id}', [App\Http\Controllers\Official_controller::class, 'official_welcome'])->name('official_welcome');


Route::get('/finance_document_request_received_payment/{document_request_id}/{document_id}/{resident_id}/{user_id}', [App\Http\Controllers\Official_controller::class, 'finance_document_request_received_payment'])->name('finance_document_request_received_payment');








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
Route::get('/resident_logout', [App\Http\Controllers\Official_controller::class, 'resident_logout'])->name('resident_logout');

Route::get('/official_complain_report/{user_id}', [App\Http\Controllers\Official_controller::class, 'official_complain_report'])->name('official_complain_report');




Route::get('/staff_welcome/{user_id}', [App\Http\Controllers\Official_controller::class, 'staff_welcome'])->name('staff_welcome');
Route::get('/staff_document_request/{user_id}', [App\Http\Controllers\Official_controller::class, 'staff_document_request'])->name('staff_document_request');
// Route::get('/staff_document_request_approved/{user_id}', [App\Http\Controllers\Official_controller::class, 'staff_document_request_approved'])->name('staff_document_request_approved');

Route::get('/staff_document_request_approved/{document_request_id}/{document_id}/{resident_id}/{user_id}', [App\Http\Controllers\Official_controller::class, 'staff_document_request_approved'])->name('staff_document_request_approved');
Route::get('/staff_document_request_received/{document_request_id}/{document_id}/{resident_id}/{user_id}', [App\Http\Controllers\Official_controller::class, 'staff_document_request_received'])->name('staff_document_request_received');




Route::get('/staff_complain_report/{user_id}', [App\Http\Controllers\Official_controller::class, 'staff_complain_report'])->name('staff_complain_report');
Route::get('/staff_resident_profile/{user_id}', [App\Http\Controllers\Official_controller::class, 'staff_resident_profile'])->name('staff_resident_profile');
Route::post('/staff_resident_search/', [App\Http\Controllers\Official_controller::class, 'staff_resident_search'])->name('staff_resident_search');



Route::get('/staff_assistance/{user_id}', [App\Http\Controllers\Official_controller::class, 'staff_assistance'])->name('staff_assistance');
Route::get('/census_register_resident/{user_id}', [App\Http\Controllers\Official_controller::class, 'census_register_resident'])->name('census_register_resident');
Route::post('/offical_resident_registration_process/', [App\Http\Controllers\Official_controller::class, 'offical_resident_registration_process'])->name('offical_resident_registration_process');

Route::get('/print_document/{id}', [App\Http\Controllers\Official_controller::class, 'print_document'])->name('print_document');






















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

Route::get('/resident_document_request/{resident_id}', [App\Http\Controllers\Resident_controller::class, 'resident_document_request'])->name('resident_document_request');


Route::post('/resident_document_request_process', [App\Http\Controllers\Resident_controller::class, 'resident_document_request_process'])->name('resident_document_request_process');



































// Route::get('/barangay_admin', function () {return view('trial');});
// Route::get('/barangay_admin', function () {return view('welcome');});

Auth::routes();
Route::get('/barangay_admin', [App\Http\Controllers\Barangay_controller::class, 'barangay_admin'])->name('barangay_admin');
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

Route::post('/barangay_complain_status_change_to_on_progess', [App\Http\Controllers\Barangay_controller::class, 'barangay_complain_status_change_to_on_progess'])->name('barangay_complain_status_change_to_on_progess');
Route::post('/barangay_complain_status_change_to_end', [App\Http\Controllers\Barangay_controller::class, 'barangay_complain_status_change_to_end'])->name('barangay_complain_status_change_to_end');

Route::get('/barangay_document_type', [App\Http\Controllers\Barangay_controller::class, 'barangay_document_type'])->name('barangay_document_type');
Route::post('/barangay_document_save', [App\Http\Controllers\Barangay_controller::class, 'barangay_document_save'])->name('barangay_document_save');

Route::get('/barangay_document_type_update/{document_id}', [App\Http\Controllers\Barangay_controller::class, 'barangay_document_type_update'])->name('barangay_document_type_update');

Route::post('/barangay_document_type_update_process', [App\Http\Controllers\Barangay_controller::class, 'barangay_document_type_update_process'])->name('barangay_document_type_update_process');
Route::post('/barangay_document_type_update_file_process', [App\Http\Controllers\Barangay_controller::class, 'barangay_document_type_update_file_process'])->name('barangay_document_type_update_file_process');

Route::get('/barangay_document_request/', [App\Http\Controllers\Barangay_controller::class, 'barangay_document_request'])->name('barangay_document_request');
Route::get('/barangay_document_request_approved/{document_request_id}/{document_id}/{resident_id}/{user_id}', [App\Http\Controllers\Barangay_controller::class, 'barangay_document_request_approved'])->name('barangay_document_request_approved');
Route::get('/barangay_document_request_received/{document_request_id}/{document_id}/{resident_id}', [App\Http\Controllers\Barangay_controller::class, 'barangay_document_request_received'])->name('barangay_document_request_received');

Route::get('/barangay_dashboard', [App\Http\Controllers\Barangay_controller::class, 'barangay_dashboard'])->name('barangay_dashboard');


Route::get('/barangay_staff_register', [App\Http\Controllers\Barangay_controller::class, 'barangay_staff_register'])->name('barangay_staff_register');


Route::post('/barangay_staff_register_process', [App\Http\Controllers\Barangay_controller::class, 'barangay_staff_register_process'])->name('barangay_staff_register_process');

Route::post('/barangay_admin_get_province', [App\Http\Controllers\Barangay_controller::class, 'barangay_admin_get_province'])->name('barangay_admin_get_province');
Route::post('/barangay_admin_get_municipality', [App\Http\Controllers\Barangay_controller::class, 'barangay_admin_get_municipality'])->name('barangay_admin_get_municipality');
Route::post('/barangay_admin_get_barangay', [App\Http\Controllers\Barangay_controller::class, 'barangay_admin_get_barangay'])->name('barangay_admin_get_barangay');
Route::get('/barangay_admin_staff', [App\Http\Controllers\Barangay_controller::class, 'barangay_admin_staff'])->name('barangay_admin_staff');
Route::get('/barangay_assistance_type', [App\Http\Controllers\Barangay_controller::class, 'barangay_assistance_type'])->name('barangay_assistance_type');
Route::post('/barangay_assistance_type_process', [App\Http\Controllers\Barangay_controller::class, 'barangay_assistance_type_process'])->name('barangay_assistance_type_process');
Route::post('/assistance_type_update', [App\Http\Controllers\Barangay_controller::class, 'assistance_type_update'])->name('assistance_type_update');
Route::get('/barangay_document_request_list', [App\Http\Controllers\Barangay_controller::class, 'barangay_document_request_list'])->name('barangay_document_request_list');
Route::get('/barangay_message', [App\Http\Controllers\Barangay_controller::class, 'barangay_message'])->name('barangay_message');
Route::post('/complain_report_print', [App\Http\Controllers\Barangay_controller::class, 'complain_report_print'])->name('complain_report_print');
Route::post('/document_report_print', [App\Http\Controllers\Barangay_controller::class, 'document_report_print'])->name('document_report_print');
Route::get('/barangay_assistance_record', [App\Http\Controllers\Barangay_controller::class, 'barangay_assistance_record'])->name('barangay_assistance_record');
Route::post('/assistance_report_print', [App\Http\Controllers\Barangay_controller::class, 'assistance_report_print'])->name('assistance_report_print');



































Route::get('/super_user_login', [App\Http\Controllers\Super_user_controller::class, 'super_user_login'])->name('super_user_login');
Route::post('/super_user_login_process', [App\Http\Controllers\Super_user_controller::class, 'super_user_login_process'])->name('super_user_login_process');
Route::get('/super_user_dashboard/{user_id}', [App\Http\Controllers\Super_user_controller::class, 'super_user_dashboard'])->name('super_user_dashboard');
Route::get('/super_user_logut', [App\Http\Controllers\Super_user_controller::class, 'super_user_logut'])->name('super_user_logut');
Route::get('/status_approval/{user_id}/{status}/{barangay_id}', [App\Http\Controllers\Super_user_controller::class, 'status_approval'])->name('status_approval');

Route::post('/super_user_message_barangay', [App\Http\Controllers\Super_user_controller::class, 'super_user_message_barangay'])->name('super_user_message_barangay');

Route::get('/super_user_registration/{user_id}', [App\Http\Controllers\Super_user_controller::class, 'super_user_registration'])->name('super_user_registration');
Route::post('/super_user_registration_process/', [App\Http\Controllers\Super_user_controller::class, 'super_user_registration_process'])->name('super_user_registration_process');

Route::get('/super_user_logs/{user_id}', [App\Http\Controllers\Super_user_controller::class, 'super_user_logs'])->name('super_user_logs');










// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
