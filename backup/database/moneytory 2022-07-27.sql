-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2022 at 08:41 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moneytory`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_profiles`
--

CREATE TABLE `company_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_profiles`
--

INSERT INTO `company_profiles` (`id`, `name`, `phone_number`, `email`, `address`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Adisoft Inc', '0987654321', 'customer@adisoft.id', 'Cirebon, Indonesia', '1658903968-My-Logo-–-3_0.png', '2022-07-27 06:38:15', '2022-07-27 06:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `debts`
--

CREATE TABLE `debts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `debt_type_id` bigint(20) UNSIGNED NOT NULL,
  `debt_status_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) NOT NULL,
  `on_behalf_of` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `debt_statuses`
--

CREATE TABLE `debt_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `debt_statuses`
--

INSERT INTO `debt_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Berhutang', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(2, 'Lunas', '2022-07-27 06:38:14', '2022-07-27 06:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `debt_types`
--

CREATE TABLE `debt_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `debt_types`
--

INSERT INTO `debt_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Terhutang', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(2, 'Penghutang', '2022-07-27 06:38:14', '2022-07-27 06:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `income_status_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `products` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amounts` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_prices` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prices` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discounts` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` int(11) NOT NULL,
  `extra_charge` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `income_status_id`, `code`, `products`, `amounts`, `base_prices`, `prices`, `discounts`, `total_price`, `extra_charge`, `created_at`, `updated_at`) VALUES
(1, 2, 'INC1', 'PROD769,PROD216', '3,1', '105753,72562', '124623,95967', '0,0', 479836, 10000, '2022-07-27 06:40:27', '2022-07-27 06:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `income_statuses`
--

CREATE TABLE `income_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `income_statuses`
--

INSERT INTO `income_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Belum Lunas', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(2, 'Lunas', '2022-07-27 06:38:14', '2022-07-27 06:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mac_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_menus`
--

CREATE TABLE `main_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_menus`
--

INSERT INTO `main_menus` (`id`, `name`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'bi bi-speedometer2', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(2, 'Bahan Mentah', 'bi bi-cart4', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(3, 'Bahan Dalam Proses', 'bi bi-cpu', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(4, 'Barang Jadi', 'bi bi-bag-check', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(5, 'Pemasukan', 'bi bi-arrow-down-circle', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(6, 'Pengeluaran', 'bi bi-arrow-up-circle', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(7, 'Hutang', 'bi bi-emoji-dizzy', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(8, 'Pengguna', 'bi bi-people', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(9, 'Pengaturan', 'bi bi-gear', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(10, 'Satuan', 'bi bi-123', '2022-07-27 06:38:14', '2022-07-27 06:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_menu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `main_menu_id`, `name`, `slug`, `display`, `url`, `icon`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dashboard', 'dashboard', 1, '/', 'bi bi-speedometer2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(2, 2, 'Bahan Mentah', 'bahan-mentah', 1, '/raw-ingredients', 'bi bi-cart4', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(3, 2, 'Tambah Bahan Mentah', 'tambah-bahan-mentah', 0, '/raw-ingredients/add-new', 'bi bi-plus-circle me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(4, 2, 'Ubah Bahan Mentah', 'ubah-bahan-mentah', 0, '/raw-ingredients/{code}/edit', 'bi bi-pencil me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(5, 2, 'Mengaktifkan Bahan Mentah', 'mengaktifkan-bahan-mentah', 0, '/raw-ingredients/{code}/activate', '', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(6, 2, 'Menonaktifkan Bahan Mentah', 'menonaktifkan-bahan-mentah', 0, '/raw-ingredients/{code}/deactivate', '', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(7, 2, 'Menghapus Bahan Mentah', 'menghapus-bahan-mentah', 0, '/raw-ingredients/{code}/delete', 'bi bi-trash me-md-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(8, 3, 'Bahan Dalam Proses', 'bahan-dalam-proses', 1, '/on-process-ingredients', 'bi bi-cpu', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(9, 3, 'Tambah Bahan Dalam Proses', 'tambah-bahan-dalam-proses', 0, '/on-process-ingredients/add-new', 'bi bi-plus-circle me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(10, 3, 'Ubah Bahan Dalam Proses', 'ubah-bahan-dalam-proses', 0, '/on-process-ingredients/{code}/edit', 'bi bi-pencil me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(11, 3, 'Mengaktifkan Bahan Dalam Proses', 'mengaktifkan-bahan-dalam-proses', 0, '/on-process-ingredients/{code}/activate', '', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(12, 3, 'Menonaktifkan Bahan Dalam Proses', 'menonaktifkan-bahan-dalam-proses', 0, '/on-process-ingredients/{code}/deactivate', '', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(13, 3, 'Menghapus Bahan Dalam Proses', 'menghapus-bahan-dalam-proses', 0, '/on-process-ingredients/{code}/delete', 'bi bi-trash me-md-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(14, 4, 'Barang Jadi', 'barang-jadi', 1, '/products', 'bi bi-bag-check', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(15, 4, 'Tambah Barang Jadi', 'tambah-barang-jadi', 0, '/products/add-new', 'bi bi-plus-circle me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(16, 4, 'Ubah Barang Jadi', 'ubah-barang-jadi', 0, '/products/{code}/edit', 'bi bi-pencil me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(17, 4, 'Mengaktifkan Barang Jadi', 'mengaktifkan-barang-jadi', 0, '/products/{code}/activate', '', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(18, 4, 'Menonaktifkan Barang Jadi', 'menonaktifkan-barang-jadi', 0, '/products/{code}/deactivate', '', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(19, 4, 'Menghapus Barang Jadi', 'menghapus-barang-jadi', 0, '/products/{code}/delete', 'bi bi-trash me-md-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(20, 5, 'Pemasukan', 'pemasukan', 1, '/incomes', 'bi bi-arrow-down-circle', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(21, 5, 'Tambah Pemasukan', 'tambah-pemasukan', 0, '/incomes/add-new', 'bi bi-plus-circle me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(22, 5, 'Ubah Pemasukan', 'ubah-pemasukan', 0, '/incomes/{code}/edit', 'bi bi-pencil me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(23, 5, 'Mengaktifkan Pemasukan', 'mengaktifkan-pemasukan', 0, '/incomes/{code}/activate', '', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(24, 5, 'Menonaktifkan Pemasukan', 'menonaktifkan-pemasukan', 0, '/incomes/{code}/deactivate', '', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(25, 5, 'Menghapus Pemasukan', 'menghapus-pemasukan', 0, '/incomes/{code}/delete', 'bi bi-trash me-md-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(26, 6, 'Pengeluaran', 'pengeluaran', 1, '/expenses', 'bi bi-arrow-up-circle', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(27, 6, 'Tambah Pengeluaran', 'tambah-pengeluaran', 0, '/expenses/add-new', 'bi bi-plus-circle me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(28, 6, 'Ubah Pengeluaran', 'ubah-pengeluaran', 0, '/expenses/{code}/edit', 'bi bi-pencil me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(29, 6, 'Menghapus Pengeluaran', 'menghapus-pengeluaran', 0, '/expenses/{code}/delete', 'bi bi-trash me-md-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(30, 7, 'Hutang', 'hutang', 1, '/debts', 'bi bi-emoji-dizzy', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(31, 7, 'Tambah Hutang', 'tambah-hutang', 0, '/debts/add-new', 'bi bi-plus-circle me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(32, 7, 'Ubah Hutang', 'ubah-hutang', 0, '/debts/{code}/edit', 'bi bi-pencil me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(33, 7, 'Mengaktifkan Hutang', 'mengaktifkan-hutang', 0, '/debts/{code}/activate', '', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(34, 7, 'Menonaktifkan Hutang', 'menonaktifkan-hutang', 0, '/debts/{code}/deactivate', '', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(35, 7, 'Menghapus Hutang', 'menghapus-hutang', 0, '/debts/{code}/delete', 'bi bi-trash me-md-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(36, 8, 'Pengguna', 'pengguna', 1, '/users', 'bi bi-people', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(37, 8, 'Registrasi Pengguna', 'registrasi-pengguna', 0, '/users/register', 'bi bi-plus-circle me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(38, 8, 'Ubah Pengguna', 'ubah-pengguna', 0, '/users/{username}/edit', 'bi bi-pencil me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(39, 8, 'Menghapus Pengguna', 'menghapus-pengguna', 0, '/users/{username}/delete', 'bi bi-trash me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(40, 8, 'Mengaktifkan Pengguna', 'mengaktifkan-pengguna', 0, '/users/activate/{username}', '', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(41, 8, 'Menonaktifkan Pengguna', 'menonaktifkan-pengguna', 0, '/users/deactivate/{username}', '', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(42, 9, 'Pengaturan', 'pengaturan', 1, '/settings', 'bi bi-gear', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(43, 9, 'Ubah Profil', 'ubah-profil', 0, '/settings/user-profile/{username}', 'bi bi-pencil me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(44, 9, 'Ubah Profil Perusahaan', 'ubah-profil-perusahaan', 1, '/settings/company-profile', 'bi bi-pencil me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(45, 9, 'Role', 'role', 1, '/roles', 'bi bi-people me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(46, 9, 'Tambah Role', 'tambah-role', 0, '/roles/add-new', 'bi bi-plus-circle me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(47, 9, 'Ubah Role', 'ubah-role', 0, '/roles/{name}/edit', 'bi bi-pencil me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(48, 9, 'Menghapus Role', 'menghapus-role', 0, '/roles/{name}/delete', 'bi bi-trash me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(49, 9, 'Ubah Hak Akses', 'ubah-hak-akses', 0, '/privileges/{name}/edit', 'bi bi-people me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(50, 10, 'Satuan', 'satuan', 1, '/units', 'bi bi-123 me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(51, 10, 'Tambah Satuan', 'tambah-satuan', 0, '/units/add-new', 'bi bi-plus-circle me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(52, 10, 'Ubah Satuan', 'ubah-satuan', 0, '/units/{name}/edit', 'bi bi-123 me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(53, 10, 'Menghapus Satuan', 'menghapus-satuan', 0, '/units/{name}/delete', 'bi bi-trash me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(54, 5, 'Order', 'order', 0, '/products/order', 'bi bi-bag-check me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(55, 5, 'Keranjang', 'keranjang', 0, '/cart', 'bi bi-cart me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(56, 5, 'Ubah Jumlah Item Keranjang', 'ubah-jumlah-item-keranjang', 0, '/cart/{code}/{action}', 'bi bi-pencil me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(57, 5, 'Menghapus Keranjang', 'menghapus-keranjang', 0, '/cart/{code}/delete', 'bi bi-trash me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(58, 5, 'Menghapus Semua Item Keranjang', 'menghapus-semua-item-keranjang', 0, '/cart/{code}/delete', 'bi bi-trash me-2', '2022-07-27 06:38:15', '2022-07-27 06:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_01_07_101304_create_company_profiles_table', 1),
(5, '2022_01_07_101435_create_roles_table', 1),
(6, '2022_01_07_101436_create_units_table', 1),
(7, '2022_01_07_101437_create_statuses_table', 1),
(8, '2022_01_07_101438_create_income_statuses_table', 1),
(9, '2022_01_07_101438_create_process_statuses_table', 1),
(10, '2022_01_07_101439_create_debt_types_table', 1),
(11, '2022_01_07_101440_create_debt_statuses_table', 1),
(12, '2022_01_07_101446_create_raw_ingredients_table', 1),
(13, '2022_01_07_101502_create_on_process_ingredients_table', 1),
(14, '2022_01_07_101510_create_products_table', 1),
(15, '2022_01_07_101525_create_incomes_table', 1),
(16, '2022_01_07_101533_create_expenses_table', 1),
(17, '2022_01_07_101540_create_debts_table', 1),
(18, '2022_01_07_101847_create_logs_table', 1),
(19, '2022_01_07_101847_create_users_table', 1),
(20, '2022_01_18_174336_create_main_menus_table', 1),
(21, '2022_01_19_175924_create_menus_table', 1),
(22, '2022_03_12_113828_create_privileges_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `on_process_ingredients`
--

CREATE TABLE `on_process_ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `raw_ingredient_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `on_process_ingredients`
--

INSERT INTO `on_process_ingredients` (`id`, `status_id`, `raw_ingredient_id`, `code`, `purpose`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'PROC001', 'Membuat kue ultah', 0.50, '2022-07-27 06:38:15', '2022-07-27 06:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(2, 1, 2, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(3, 1, 3, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(4, 1, 4, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(5, 1, 5, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(6, 1, 6, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(7, 1, 7, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(8, 1, 8, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(9, 1, 9, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(10, 1, 10, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(11, 1, 11, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(12, 1, 12, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(13, 1, 13, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(14, 1, 14, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(15, 1, 15, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(16, 1, 16, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(17, 1, 17, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(18, 1, 18, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(19, 1, 19, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(20, 1, 20, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(21, 1, 21, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(22, 1, 22, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(23, 1, 23, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(24, 1, 24, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(25, 1, 25, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(26, 1, 26, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(27, 1, 27, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(28, 1, 28, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(29, 1, 29, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(30, 1, 30, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(31, 1, 31, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(32, 1, 32, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(33, 1, 33, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(34, 1, 34, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(35, 1, 35, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(36, 1, 36, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(37, 1, 37, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(38, 1, 38, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(39, 1, 39, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(40, 1, 40, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(41, 1, 41, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(42, 1, 42, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(43, 1, 43, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(44, 1, 44, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(45, 1, 45, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(46, 1, 46, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(47, 1, 47, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(48, 1, 48, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(49, 1, 49, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(50, 1, 50, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(51, 1, 51, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(52, 1, 52, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(53, 1, 53, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(54, 1, 54, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(55, 1, 55, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(56, 1, 56, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(57, 1, 57, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(58, 1, 58, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(59, 2, 1, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(60, 2, 2, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(61, 2, 3, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(62, 2, 4, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(63, 2, 5, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(64, 2, 6, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(65, 2, 7, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(66, 2, 8, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(67, 2, 9, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(68, 2, 10, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(69, 2, 11, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(70, 2, 12, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(71, 2, 13, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(72, 2, 14, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(73, 2, 15, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(74, 2, 16, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(75, 2, 17, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(76, 2, 18, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(77, 2, 19, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(78, 2, 20, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(79, 2, 21, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(80, 2, 22, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(81, 2, 23, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(82, 2, 24, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(83, 2, 25, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(84, 2, 26, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(85, 2, 27, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(86, 2, 28, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(87, 2, 29, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(88, 2, 30, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(89, 2, 31, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(90, 2, 32, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(91, 2, 33, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(92, 2, 34, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(93, 2, 35, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(94, 2, 42, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(95, 2, 43, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(96, 2, 54, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(97, 2, 55, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(98, 2, 56, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(99, 2, 57, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(100, 2, 58, '2022-07-27 06:38:15', '2022-07-27 06:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `process_statuses`
--

CREATE TABLE `process_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `process_statuses`
--

INSERT INTO `process_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Selesai', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(2, 'Sedang Diproses', '2022-07-27 06:38:14', '2022-07-27 06:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_price` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `stock` double(8,2) NOT NULL,
  `minimum_stock` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `status_id`, `unit_id`, `code`, `name`, `base_price`, `profit`, `discount`, `stock`, `minimum_stock`, `image`, `created_at`, `updated_at`) VALUES
(1, 2, 7, 'PROD001', 'Roti Coklat', 1500, 500, 0, 2.00, 100.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(2, 2, 4, 'PROD642', 'Kane Roscoe', 65723, 24796, 0, 71.00, 1.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(3, 2, 4, 'PROD958', 'Santos Skylar', 55028, 21011, 0, 64.00, 2.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(4, 2, 6, 'PROD127', 'Louie Gideon', 95539, 5721, 0, 54.00, 9.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(5, 2, 9, 'PROD157', 'Daron Savannah', 107780, 11899, 0, 33.00, 2.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(6, 2, 7, 'PROD747', 'Ava Brett', 67341, 12622, 0, 33.00, 4.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(7, 2, 5, 'PROD243', 'Brady Reina', 102168, 5348, 0, 75.00, 7.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(8, 2, 2, 'PROD964', 'Tiana Kobe', 82936, 11353, 0, 88.00, 4.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(9, 2, 5, 'PROD479', 'Courtney Crystel', 116756, 18931, 0, 52.00, 6.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(10, 2, 2, 'PROD984', 'Taryn Isobel', 20006, 12747, 0, 76.00, 5.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(11, 2, 6, 'PROD947', 'Bella Sigmund', 34770, 12436, 0, 46.00, 5.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(12, 2, 9, 'PROD202', 'Shayna Dexter', 80302, 9321, 0, 29.00, 6.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(13, 2, 5, 'PROD666', 'Raina Reymundo', 13735, 19400, 0, 13.00, 10.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(14, 2, 4, 'PROD769', 'Krystal Leta', 105753, 18870, 0, 42.00, 6.00, NULL, '2022-07-27 06:38:15', '2022-07-27 06:40:27'),
(15, 2, 9, 'PROD602', 'Margot Adeline', 94871, 24079, 0, 89.00, 6.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(16, 2, 5, 'PROD808', 'Patricia Dorris', 58972, 24991, 0, 38.00, 6.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(17, 2, 10, 'PROD339', 'Lorna Alanna', 95966, 17173, 0, 18.00, 4.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(18, 2, 3, 'PROD314', 'Elouise Candelario', 37419, 12150, 0, 57.00, 5.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(19, 2, 8, 'PROD954', 'Rashawn Alyce', 74850, 12781, 0, 99.00, 1.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(20, 2, 6, 'PROD227', 'Dashawn Haylee', 115725, 14245, 0, 8.00, 10.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(21, 2, 3, 'PROD449', 'Era Macey', 114903, 11709, 0, 74.00, 9.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(22, 2, 8, 'PROD87', 'Casandra Emile', 77513, 6682, 0, 66.00, 5.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(23, 2, 5, 'PROD753', 'Orland Maya', 32475, 5410, 0, 57.00, 4.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(24, 2, 4, 'PROD302', 'Fabian Jordan', 24628, 6675, 0, 51.00, 8.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(25, 2, 1, 'PROD381', 'Imogene Ardella', 112347, 10170, 0, 99.00, 10.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(26, 2, 5, 'PROD570', 'Barbara Alana', 123609, 3769, 0, 22.00, 10.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(27, 2, 3, 'PROD59', 'Celine Ashleigh', 24899, 7620, 0, 43.00, 8.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(28, 2, 8, 'PROD662', 'Chanelle Fletcher', 66389, 18834, 0, 88.00, 9.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(29, 2, 1, 'PROD686', 'Mina Alejandrin', 105357, 5827, 0, 80.00, 10.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(30, 2, 3, 'PROD216', 'Josie Lillie', 72562, 23405, 0, 66.00, 7.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:40:27'),
(31, 2, 10, 'PROD656', 'Rachael Natalia', 63232, 18319, 0, 62.00, 7.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(32, 2, 4, 'PROD683', 'Euna Kassandra', 108469, 3624, 0, 42.00, 8.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(33, 2, 2, 'PROD129', 'Emelia Barney', 69843, 9528, 0, 64.00, 8.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(34, 2, 8, 'PROD660', 'Nya Sadie', 69192, 18110, 0, 38.00, 4.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(35, 2, 2, 'PROD213', 'Emmy Norma', 58898, 20926, 0, 20.00, 7.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16'),
(36, 2, 5, 'PROD901', 'Rowan Frieda', 56498, 4354, 0, 44.00, 5.00, NULL, '2022-07-27 06:38:16', '2022-07-27 06:38:16');

-- --------------------------------------------------------

--
-- Table structure for table `raw_ingredients`
--

CREATE TABLE `raw_ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` double(8,2) NOT NULL,
  `minimum_stock` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raw_ingredients`
--

INSERT INTO `raw_ingredients` (`id`, `status_id`, `unit_id`, `code`, `name`, `stock`, `minimum_stock`, `image`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 'RAW001', 'Gula Pasir', 1.00, 0.20, NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(2, 'Staff', '2022-07-27 06:38:14', '2022-07-27 06:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Nonaktif', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(2, 'Aktif', '2022-07-27 06:38:14', '2022-07-27 06:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Botol', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(2, 'Bungkus', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(3, 'Dus', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(4, 'Karung', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(5, 'Kaleng', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(6, 'Kg', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(7, 'Pcs', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(8, 'Lembar', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(9, 'Liter', '2022-07-27 06:38:14', '2022-07-27 06:38:14'),
(10, 'Pasang', '2022-07-27 06:38:14', '2022-07-27 06:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `status_id`, `username`, `password`, `name`, `phone_number`, `email`, `address`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'admin', '$2y$10$69YxYqgi7Svk8vCEOjHBp.AnsYNud.rW1OCFhsvfDeIaLQK6GUugG', 'Adhy Wiranto', '0987654321', 'adhy@adisoft.id', 'Cirebon, Indonesia', NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15'),
(2, 2, 2, 'jeongyeon', '$2y$10$69YxYqgi7Svk8vCEOjHBp.AnsYNud.rW1OCFhsvfDeIaLQK6GUugG', 'Yoo Jeongyeon', '0987654321', 'jeongyeon@adisoft.id', 'Seoul, Korea Selatan', NULL, '2022-07-27 06:38:15', '2022-07-27 06:38:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_profiles`
--
ALTER TABLE `company_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debts`
--
ALTER TABLE `debts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `debts_code_unique` (`code`),
  ADD KEY `debts_debt_type_id_foreign` (`debt_type_id`),
  ADD KEY `debts_debt_status_id_foreign` (`debt_status_id`);

--
-- Indexes for table `debt_statuses`
--
ALTER TABLE `debt_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debt_types`
--
ALTER TABLE `debt_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expenses_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `incomes_code_unique` (`code`),
  ADD KEY `incomes_income_status_id_foreign` (`income_status_id`);

--
-- Indexes for table `income_statuses`
--
ALTER TABLE `income_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_menus`
--
ALTER TABLE `main_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_slug_unique` (`slug`),
  ADD KEY `menus_main_menu_id_foreign` (`main_menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `on_process_ingredients`
--
ALTER TABLE `on_process_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `on_process_ingredients_code_unique` (`code`),
  ADD KEY `on_process_ingredients_status_id_foreign` (`status_id`),
  ADD KEY `on_process_ingredients_raw_ingredient_id_foreign` (`raw_ingredient_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `privileges_role_id_foreign` (`role_id`),
  ADD KEY `privileges_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `process_statuses`
--
ALTER TABLE `process_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD KEY `products_status_id_foreign` (`status_id`),
  ADD KEY `products_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `raw_ingredients`
--
ALTER TABLE `raw_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `raw_ingredients_code_unique` (`code`),
  ADD UNIQUE KEY `raw_ingredients_name_unique` (`name`),
  ADD KEY `raw_ingredients_status_id_foreign` (`status_id`),
  ADD KEY `raw_ingredients_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_status_id_foreign` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_profiles`
--
ALTER TABLE `company_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `debts`
--
ALTER TABLE `debts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `debt_statuses`
--
ALTER TABLE `debt_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `debt_types`
--
ALTER TABLE `debt_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `income_statuses`
--
ALTER TABLE `income_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_menus`
--
ALTER TABLE `main_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `on_process_ingredients`
--
ALTER TABLE `on_process_ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `process_statuses`
--
ALTER TABLE `process_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `raw_ingredients`
--
ALTER TABLE `raw_ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `debts`
--
ALTER TABLE `debts`
  ADD CONSTRAINT `debts_debt_status_id_foreign` FOREIGN KEY (`debt_status_id`) REFERENCES `debt_statuses` (`id`),
  ADD CONSTRAINT `debts_debt_type_id_foreign` FOREIGN KEY (`debt_type_id`) REFERENCES `debt_types` (`id`);

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_income_status_id_foreign` FOREIGN KEY (`income_status_id`) REFERENCES `income_statuses` (`id`);

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_main_menu_id_foreign` FOREIGN KEY (`main_menu_id`) REFERENCES `main_menus` (`id`);

--
-- Constraints for table `on_process_ingredients`
--
ALTER TABLE `on_process_ingredients`
  ADD CONSTRAINT `on_process_ingredients_raw_ingredient_id_foreign` FOREIGN KEY (`raw_ingredient_id`) REFERENCES `raw_ingredients` (`id`),
  ADD CONSTRAINT `on_process_ingredients_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `process_statuses` (`id`);

--
-- Constraints for table `privileges`
--
ALTER TABLE `privileges`
  ADD CONSTRAINT `privileges_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  ADD CONSTRAINT `privileges_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `raw_ingredients`
--
ALTER TABLE `raw_ingredients`
  ADD CONSTRAINT `raw_ingredients_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`),
  ADD CONSTRAINT `raw_ingredients_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
