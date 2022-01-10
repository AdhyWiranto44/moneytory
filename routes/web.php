<?php

use App\Http\Controllers\CompanyRegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/**
 * Dashboard Controller
 */
Route::get('/', [DashboardController::class, 'index']);

/**
 * Welcome Controller
 */
Route::get('/welcome', [WelcomeController::class, 'index']);

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
Route::post('/registration/user', [UserRegistrationController::class, 'store']);

/**
 * User Controller
 */
Route::get('/users', [UserController::class, 'index']);