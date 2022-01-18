<?php

use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CompanyRegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SettingController;
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
 * User Controller
 */
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/register', [UserController::class, 'create']);
Route::post('/users/register', [UserController::class, 'store']);
Route::patch('/users/deactivate/{username}', [UserController::class, 'deactivate']);
Route::patch('/users/activate/{username}', [UserController::class, 'activate']);
Route::delete('/users/{username}/delete', [UserController::class, 'destroy']);
Route::get('/users/{username}/edit', [UserController::class, 'edit']);
Route::patch('/users/{username}/edit', [UserController::class, 'update']);
Route::patch('/users/{username}/update-password', [UserController::class, 'updatePassword']);

/**
 * SettingController
 */
Route::get('/settings', [SettingController::class, 'index']);

/**
 * CompanyProfileController
 */
Route::get('/settings/company-profile', [CompanyProfileController::class, 'edit']);
Route::patch('/settings/company-profile', [CompanyProfileController::class, 'update']);