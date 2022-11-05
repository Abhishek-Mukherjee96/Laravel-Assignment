<?php

use App\Http\Controllers\auth\LoginController;
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

Route::get('/', [LoginController::class, 'registration_form']);
Route::post('/registration-form-action', [LoginController::class, 'registration_form_action'])->name('registration_form_action');

Route::get('/login-form', [LoginController::class, 'login_form'])->name('login_form');
Route::post('/login-form-action', [LoginController::class, 'login_form_action'])->name('login_form_action');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    //BUYER ROUTES
    Route::get('/seller-dashboard', [LoginController::class, 'seller_dashboard'])->name('seller-dashboard');
    Route::post('/profile-action/{id}', [LoginController::class, 'profile_action'])->name('profile_action');
    Route::get('/rate-chart', [LoginController::class, 'rate_chart'])->name('rate_chart');
    Route::post('/rate-chart-action/{id}', [LoginController::class, 'rate_chart_action'])->name('rate_chart_action');
    Route::get('/edit-rate-chart/{id}', [LoginController::class, 'edit_rate_chart'])->name('edit_rate_chart');
    Route::post('/edit-rate-chart-action/{id}', [LoginController::class, 'edit_rate_chart_action'])->name('edit_rate_chart_action');

    //BUYER ROUTES
    Route::get('/buyer-dashboard', [LoginController::class, 'buyer_dashboard'])->name('buyer-dashboard');
    Route::get('/view-profile/{id}', [LoginController::class, 'view_profile'])->name('view_profile');

});
