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
use App\Http\Middleware\IsLoggedIn;
use Illuminate\Support\Facades\Route;

/**
 * Dashboard Controller
 */
Route::get('/', [DashboardController::class, 'index'])->middleware(IsLoggedIn::class)->name('dashboard');

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
Route::get('/users', [UserController::class, 'index'])->middleware(IsLoggedIn::class)->name('pengguna');
Route::get('/users/register', [UserController::class, 'create'])->middleware(IsLoggedIn::class)->name('registrasi-pengguna');
Route::post('/users/register', [UserController::class, 'store'])->middleware(IsLoggedIn::class);
Route::patch('/users/deactivate/{username}', [UserController::class, 'deactivate'])->middleware(IsLoggedIn::class)->name('menonaktifkan-pengguna');
Route::patch('/users/activate/{username}', [UserController::class, 'activate'])->middleware(IsLoggedIn::class)->name('mengaktifkan-pengguna');
Route::delete('/users/{username}/delete', [UserController::class, 'destroy'])->middleware(IsLoggedIn::class)->name('menghapus-pengguna');
Route::get('/users/{username}/edit', [UserController::class, 'edit'])->middleware(IsLoggedIn::class)->name('ubah-pengguna');
Route::patch('/users/{username}/edit', [UserController::class, 'update'])->middleware(IsLoggedIn::class);
Route::patch('/users/{username}/update-password', [UserController::class, 'updatePassword'])->middleware(IsLoggedIn::class);
Route::get('/settings/user-profile/{username}', [UserController::class, 'editProfile'])->middleware(IsLoggedIn::class)->name('ubah-profil');
Route::patch('/settings/user-profile/{username}', [UserController::class, 'updateProfile'])->middleware(IsLoggedIn::class);
Route::patch('/settings/user-profile/{username}/update-password', [UserController::class, 'updateProfilePassword'])->middleware(IsLoggedIn::class);

/**
 * SettingController
 */
Route::get('/settings', [SettingController::class, 'index'])->middleware(IsLoggedIn::class)->name('pengaturan');

/**
 * CompanyProfileController
 */
Route::get('/settings/company-profile', [CompanyProfileController::class, 'edit'])->middleware(IsLoggedIn::class)->name('ubah-profil-perusahaan');
Route::patch('/settings/company-profile', [CompanyProfileController::class, 'update'])->middleware(IsLoggedIn::class);

/**
 * RawIngredientController
 */
Route::get('/raw-ingredients', [RawIngredientController::class, 'index'])->middleware(IsLoggedIn::class)->name('bahan-mentah');
Route::get('/raw-ingredients/add-new', [RawIngredientController::class, 'create'])->middleware(IsLoggedIn::class)->name('tambah-bahan-mentah');
Route::post('/raw-ingredients/add-new', [RawIngredientController::class, 'store'])->middleware(IsLoggedIn::class);
Route::patch('/raw-ingredients/{code}/deactivate', [RawIngredientController::class, 'deactivate'])->middleware(IsLoggedIn::class)->name('menonaktifkan-bahan-mentah');
Route::patch('/raw-ingredients/{code}/activate', [RawIngredientController::class, 'activate'])->middleware(IsLoggedIn::class)->name('mengaktifkan-bahan-mentah');
Route::get('/raw-ingredients/{code}/edit', [RawIngredientController::class, 'edit'])->middleware(IsLoggedIn::class)->name('ubah-bahan-mentah');
Route::patch('/raw-ingredients/{code}/edit', [RawIngredientController::class, 'update'])->middleware(IsLoggedIn::class);
Route::delete('/raw-ingredients/{code}/delete', [RawIngredientController::class, 'destroy'])->middleware(IsLoggedIn::class)->name('menghapus-bahan-mentah');

/**
 * OnProcessIngredientController
 */
Route::get('/on-process-ingredients', [OnProcessIngredientController::class, 'index'])->middleware(IsLoggedIn::class)->name('bahan-dalam-proses');
Route::get('/on-process-ingredients/add-new', [OnProcessIngredientController::class, 'create'])->middleware(IsLoggedIn::class)->name('tambah-bahan-dalam-proses');
Route::post('/on-process-ingredients/add-new', [OnProcessIngredientController::class, 'store'])->middleware(IsLoggedIn::class);
Route::delete('/on-process-ingredients/{code}/delete', [OnProcessIngredientController::class, 'destroy'])->middleware(IsLoggedIn::class)->name('menghapus-bahan-dalam-proses');
Route::patch('/on-process-ingredients/{code}/deactivate', [OnProcessIngredientController::class, 'deactivate'])->middleware(IsLoggedIn::class)->name('menonaktifkan-bahan-dalam-proses');
Route::patch('/on-process-ingredients/{code}/activate', [OnProcessIngredientController::class, 'activate'])->middleware(IsLoggedIn::class)->name('mengaktifkan-bahan-dalam-proses');
Route::get('/on-process-ingredients/{code}/edit', [OnProcessIngredientController::class, 'edit'])->middleware(IsLoggedIn::class)->name('ubah-bahan-dalam-proses');
Route::patch('/on-process-ingredients/{code}/edit', [OnProcessIngredientController::class, 'update'])->middleware(IsLoggedIn::class);

/**
 * ProductController
 */
Route::get('/products', [ProductController::class, 'index'])->middleware(IsLoggedIn::class)->name('barang-jadi');
Route::get('/products/add-new', [ProductController::class, 'create'])->middleware(IsLoggedIn::class)->name('tambah-barang-jadi');
Route::post('/products/add-new', [ProductController::class, 'store'])->middleware(IsLoggedIn::class);
Route::patch('/products/{code}/deactivate', [ProductController::class, 'deactivate'])->middleware(IsLoggedIn::class)->name('menonaktifkan-barang-jadi');
Route::patch('/products/{code}/activate', [ProductController::class, 'activate'])->middleware(IsLoggedIn::class)->name('mengaktifkan-barang-jadi');
Route::get('/products/{code}/edit', [ProductController::class, 'edit'])->middleware(IsLoggedIn::class)->name('ubah-barang-jadi');
Route::patch('/products/{code}/edit', [ProductController::class, 'update'])->middleware(IsLoggedIn::class);
Route::delete('/products/{code}/delete', [ProductController::class, 'destroy'])->middleware(IsLoggedIn::class)->name('menghapus-barang-jadi');

/**
 * IncomeController
 */
Route::get('/incomes', [IncomeController::class, 'index'])->middleware(IsLoggedIn::class)->name('pemasukan');
Route::get('/incomes/add-new', [IncomeController::class, 'create'])->middleware(IsLoggedIn::class)->name('tambah-pemasukan');
Route::post('/incomes/add-new', [IncomeController::class, 'store'])->middleware(IsLoggedIn::class);
Route::get('/incomes/{code}/edit', [IncomeController::class, 'edit'])->middleware(IsLoggedIn::class)->name('ubah-pemasukan');
Route::patch('/incomes/{code}/edit', [IncomeController::class, 'update'])->middleware(IsLoggedIn::class);
Route::patch('/incomes/{code}/deactivate', [IncomeController::class, 'deactivate'])->middleware(IsLoggedIn::class)->name('menonaktifkan-pemasukan');
Route::patch('/incomes/{code}/activate', [IncomeController::class, 'activate'])->middleware(IsLoggedIn::class)->name('mengaktifkan-pemasukan');
Route::delete('/incomes/{code}/delete', [IncomeController::class, 'destroy'])->middleware(IsLoggedIn::class)->name('menghapus-pemasukan');

/**
 * ExpenseController
 */
Route::get('/expenses', [ExpenseController::class, 'index'])->middleware(IsLoggedIn::class)->name('pengeluaran');
Route::get('/expenses/add-new', [ExpenseController::class, 'create'])->middleware(IsLoggedIn::class)->name('tambah-pengeluaran');
Route::post('/expenses/add-new', [ExpenseController::class, 'store'])->middleware(IsLoggedIn::class);
Route::get('/expenses/{code}/edit', [ExpenseController::class, 'edit'])->middleware(IsLoggedIn::class)->name('ubah-pengeluaran');
Route::patch('/expenses/{code}/edit', [ExpenseController::class, 'update'])->middleware(IsLoggedIn::class);
Route::delete('/expenses/{code}/delete', [ExpenseController::class, 'destroy'])->middleware(IsLoggedIn::class)->name('menghapus-pengeluaran');

/**
 * DebtController
 */
Route::get('/debts', [DebtController::class, 'index'])->middleware(IsLoggedIn::class)->name('hutang');
Route::get('/debts/add-new', [DebtController::class, 'create'])->middleware(IsLoggedIn::class)->name('tambah-hutang');
Route::post('/debts/add-new', [DebtController::class, 'store'])->middleware(IsLoggedIn::class);
Route::patch('/debts/{code}/deactivate', [DebtController::class, 'deactivate'])->middleware(IsLoggedIn::class)->name('menonaktifkan-hutang');
Route::patch('/debts/{code}/activate', [DebtController::class, 'activate'])->middleware(IsLoggedIn::class)->name('mengaktifkan-hutang');
Route::get('/debts/{code}/edit', [DebtController::class, 'edit'])->middleware(IsLoggedIn::class)->name('ubah-hutang');
Route::patch('/debts/{code}/edit', [DebtController::class, 'update'])->middleware(IsLoggedIn::class);
Route::delete('/debts/{code}/delete', [DebtController::class, 'destroy'])->middleware(IsLoggedIn::class)->name('menghapus-hutang');