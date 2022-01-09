<?php

use App\Http\Controllers\CompanyRegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserRegistrationController;
use Illuminate\Support\Facades\Route;

/**
 * Dashboard Controller
 */
Route::get('/', [DashboardController::class, 'index']);

/**
 * Login Controller
 */
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

/**
 * Logout Controller
 */
Route::delete('/logout', [LogoutController::class, 'logout']);

/**
 * Company Registration Controller
 */
Route::get('/registration/company', [CompanyRegistrationController::class, 'index']);
Route::post('/registration/company', [CompanyRegistrationController::class, 'store']);

/**
 * User Registration Controller
 */
Route::get('/registration/user', [UserRegistrationController::class, 'index']);
