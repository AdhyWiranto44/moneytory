<?php

use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CompanyRegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OnProcessIngredientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RawIngredientController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsLoggedIn;
use Illuminate\Support\Facades\Route;

/**
 * Dashboard Controller
 */
Route::get('/', [DashboardController::class, 'index'])->middleware(IsLoggedIn::class);

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
Route::get('/users', [UserController::class, 'index'])->middleware(IsAdmin::class);
Route::get('/users/register', [UserController::class, 'create'])->middleware(IsAdmin::class);
Route::post('/users/register', [UserController::class, 'store'])->middleware(IsAdmin::class);
Route::patch('/users/deactivate/{username}', [UserController::class, 'deactivate'])->middleware(IsAdmin::class);
Route::patch('/users/activate/{username}', [UserController::class, 'activate'])->middleware(IsAdmin::class);
Route::delete('/users/{username}/delete', [UserController::class, 'destroy'])->middleware(IsAdmin::class);
Route::get('/users/{username}/edit', [UserController::class, 'edit'])->middleware(IsAdmin::class);
Route::patch('/users/{username}/edit', [UserController::class, 'update'])->middleware(IsAdmin::class);
Route::patch('/users/{username}/update-password', [UserController::class, 'updatePassword'])->middleware(IsAdmin::class);
Route::get('/settings/user-profile/{username}', [UserController::class, 'editProfile'])->middleware(IsLoggedIn::class);
Route::patch('/settings/user-profile/{username}', [UserController::class, 'updateProfile'])->middleware(IsLoggedIn::class);
Route::patch('/settings/user-profile/{username}/update-password', [UserController::class, 'updateProfilePassword'])->middleware(IsLoggedIn::class);

/**
 * SettingController
 */
Route::get('/settings', [SettingController::class, 'index'])->middleware(IsLoggedIn::class);

/**
 * CompanyProfileController
 */
Route::get('/settings/company-profile', [CompanyProfileController::class, 'edit'])->middleware(IsAdmin::class);
Route::patch('/settings/company-profile', [CompanyProfileController::class, 'update'])->middleware(IsAdmin::class);

/**
 * RawIngredientController
 */
Route::get('/raw-ingredients', [RawIngredientController::class, 'index'])->middleware(IsAdmin::class);
Route::get('/raw-ingredients/add-new', [RawIngredientController::class, 'create'])->middleware(IsAdmin::class);
Route::post('/raw-ingredients/add-new', [RawIngredientController::class, 'store'])->middleware(IsAdmin::class);
Route::patch('/raw-ingredients/deactivate/{code}', [RawIngredientController::class, 'deactivate'])->middleware(IsAdmin::class);
Route::patch('/raw-ingredients/activate/{code}', [RawIngredientController::class, 'activate'])->middleware(IsAdmin::class);

/**
 * OnProcessIngredientController
 */
Route::get('/on-process-ingredients', [OnProcessIngredientController::class, 'index'])->middleware(IsAdmin::class);

/**
 * ProductController
 */
Route::get('/products', [ProductController::class, 'index'])->middleware(IsAdmin::class);