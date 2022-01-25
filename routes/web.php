<?php

use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CompanyRegistrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
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
Route::get('/raw-ingredients/{code}/edit', [RawIngredientController::class, 'edit'])->middleware(IsAdmin::class);
Route::patch('/raw-ingredients/{code}/edit', [RawIngredientController::class, 'update'])->middleware(IsAdmin::class);
Route::delete('/raw-ingredients/{code}/delete', [RawIngredientController::class, 'destroy'])->middleware(IsAdmin::class);

/**
 * OnProcessIngredientController
 */
Route::get('/on-process-ingredients', [OnProcessIngredientController::class, 'index'])->middleware(IsAdmin::class);
Route::get('/on-process-ingredients/add-new', [OnProcessIngredientController::class, 'create'])->middleware(IsAdmin::class);
Route::post('/on-process-ingredients/add-new', [OnProcessIngredientController::class, 'store'])->middleware(IsAdmin::class);
Route::delete('/on-process-ingredients/{code}/delete', [OnProcessIngredientController::class, 'destroy'])->middleware(IsAdmin::class);
Route::patch('/on-process-ingredients/{code}/deactivate', [OnProcessIngredientController::class, 'deactivate'])->middleware(IsAdmin::class);
Route::patch('/on-process-ingredients/{code}/activate', [OnProcessIngredientController::class, 'activate'])->middleware(IsAdmin::class);
Route::get('/on-process-ingredients/{code}/edit', [OnProcessIngredientController::class, 'edit'])->middleware(IsAdmin::class);
Route::patch('/on-process-ingredients/{code}/edit', [OnProcessIngredientController::class, 'update'])->middleware(IsAdmin::class);

/**
 * ProductController
 */
Route::get('/products', [ProductController::class, 'index'])->middleware(IsAdmin::class);
Route::get('/products/add-new', [ProductController::class, 'create'])->middleware(IsAdmin::class);
Route::post('/products/add-new', [ProductController::class, 'store'])->middleware(IsAdmin::class);
Route::patch('/products/{code}/deactivate', [ProductController::class, 'deactivate'])->middleware(IsAdmin::class);
Route::patch('/products/{code}/activate', [ProductController::class, 'activate'])->middleware(IsAdmin::class);
Route::get('/products/{code}/edit', [ProductController::class, 'edit'])->middleware(IsAdmin::class);
Route::patch('/products/{code}/edit', [ProductController::class, 'update'])->middleware(IsAdmin::class);
Route::delete('/products/{code}/delete', [ProductController::class, 'destroy'])->middleware(IsAdmin::class);

/**
 * IncomeController
 */
Route::get('/incomes', [IncomeController::class, 'index'])->middleware(IsAdmin::class);
Route::get('/incomes/add-new', [IncomeController::class, 'create'])->middleware(IsAdmin::class);
Route::post('/incomes/add-new', [IncomeController::class, 'store'])->middleware(IsAdmin::class);
Route::get('/incomes/{code}/edit', [IncomeController::class, 'edit'])->middleware(IsAdmin::class);
Route::patch('/incomes/{code}/edit', [IncomeController::class, 'update'])->middleware(IsAdmin::class);
Route::patch('/incomes/{code}/deactivate', [IncomeController::class, 'deactivate'])->middleware(IsAdmin::class);
Route::patch('/incomes/{code}/activate', [IncomeController::class, 'activate'])->middleware(IsAdmin::class);
Route::delete('/incomes/{code}/delete', [IncomeController::class, 'destroy'])->middleware(IsAdmin::class);

/**
 * ExpenseController
 */
Route::get('/expenses', [ExpenseController::class, 'index'])->middleware(IsAdmin::class);
Route::get('/expenses/add-new', [ExpenseController::class, 'create'])->middleware(IsAdmin::class);
Route::post('/expenses/add-new', [ExpenseController::class, 'store'])->middleware(IsAdmin::class);
Route::get('/expenses/{code}/edit', [ExpenseController::class, 'edit'])->middleware(IsAdmin::class);
Route::patch('/expenses/{code}/edit', [ExpenseController::class, 'update'])->middleware(IsAdmin::class);
Route::delete('/expenses/{code}/delete', [ExpenseController::class, 'destroy'])->middleware(IsAdmin::class);

/**
 * DebtController
 */
Route::get('/debts', [DebtController::class, 'index'])->middleware(IsAdmin::class);
Route::get('/debts/add-new', [DebtController::class, 'create'])->middleware(IsAdmin::class);
Route::post('/debts/add-new', [DebtController::class, 'store'])->middleware(IsAdmin::class);
Route::patch('/debts/{code}/deactivate', [DebtController::class, 'deactivate'])->middleware(IsAdmin::class);
Route::patch('/debts/{code}/activate', [DebtController::class, 'activate'])->middleware(IsAdmin::class);
Route::delete('/debts/{code}/delete', [DebtController::class, 'destroy'])->middleware(IsAdmin::class);