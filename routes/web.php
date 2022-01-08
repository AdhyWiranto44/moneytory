<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrationController;
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

Route::get('/', [DashboardController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::delete('/logout', [LogoutController::class, 'logout']);
Route::get('/registration/company', [RegistrationController::class, 'registerCompany']);
Route::get('/registration/user', [RegistrationController::class, 'registerUser']);
