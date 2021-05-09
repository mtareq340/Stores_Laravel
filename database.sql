-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2021 at 10:21 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tireplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carcolors`
--

CREATE TABLE `carcolors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carcolors`
--

INSERT INTO `carcolors` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'احمر', '2021-04-25 18:20:06', '2021-04-25 18:20:06'),
(2, 'رصاصي', '2021-04-25 18:20:06', '2021-04-25 18:20:06'),
(3, 'ابيض', '2021-04-25 18:20:06', '2021-04-25 18:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'bmw', NULL, NULL),
(2, 'mercedes', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carsorts`
--

CREATE TABLE `carsorts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carsorts`
--

INSERT INTO `carsorts` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'bm', '2021-05-05 18:05:10', '2021-05-05 18:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'الهواء', '2021-04-25 18:20:06', '2021-04-25 18:20:06'),
(2, 'اللحام', '2021-04-25 18:20:06', '2021-04-25 18:20:06'),
(3, 'الترصيص', '2021-04-25 18:20:06', '2021-04-25 18:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `store_id`, `name`, `phone`, `created_at`, `updated_at`) VALUES
(1, 3, 'العميل الاول', '0122020', '2021-04-26 17:39:40', '2021-04-26 17:39:40'),
(2, 3, 'مازن المصري', '0101111111', '2021-05-02 12:14:00', '2021-05-02 12:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `client_car`
--

CREATE TABLE `client_car` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `car_id` int(10) UNSIGNED NOT NULL,
  `carnumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carcolor_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_car`
--

INSERT INTO `client_car` (`id`, `client_id`, `car_id`, `carnumber`, `carcolor_id`) VALUES
(1, 1, 1, '12545', 1),
(2, 2, 1, '12545hfdf', 2);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'alex', '2021-04-25 18:23:10', '2021-04-25 18:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mainproducts`
--

CREATE TABLE `mainproducts` (
  `id` int(11) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mainproducts`
--

INSERT INTO `mainproducts` (`id`, `category_id`, `name`, `quantity`, `created_at`, `updated_at`) VALUES
(15, 1, 'بلف تيواني', 80, '2021-04-26 11:36:32', '2021-04-26 15:50:04'),
(16, 2, 'لحام الجنط', 80, '2021-04-26 11:36:59', '2021-04-26 15:50:04'),
(17, 2, 'الجنوط الجنوط', 0, '2021-04-26 20:40:24', '2021-04-26 20:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `mainproduct_storeorder`
--

CREATE TABLE `mainproduct_storeorder` (
  `id` int(10) UNSIGNED NOT NULL,
  `mainproduct_id` int(11) DEFAULT NULL,
  `storeorder_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unitprice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mainproduct_storeorder`
--

INSERT INTO `mainproduct_storeorder` (`id`, `mainproduct_id`, `storeorder_id`, `quantity`, `unitprice`) VALUES
(4, 15, 2, 20, 4),
(5, 16, 2, 20, 5),
(6, 17, 3, 20, 5);

-- --------------------------------------------------------

--
-- Table structure for table `mainproduct_supplierorder`
--

CREATE TABLE `mainproduct_supplierorder` (
  `id` int(10) UNSIGNED NOT NULL,
  `mainproduct_id` int(11) DEFAULT NULL,
  `supplierorder_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unitprice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mainproduct_supplierorder`
--

INSERT INTO `mainproduct_supplierorder` (`id`, `mainproduct_id`, `supplierorder_id`, `quantity`, `unitprice`) VALUES
(7, 15, 3, 100, 2),
(8, 16, 3, 100, 3),
(9, 17, 4, 20, 2);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_17_114230_admins', 1),
(5, '2021_01_08_190617_create_categories_table', 1),
(6, '2021_01_08_214031_create_technicals_table', 1),
(7, '2021_01_08_214743_create_products_table', 1),
(8, '2021_01_08_220852_create_orders_table', 1),
(9, '2021_01_08_221138_product_order', 1),
(10, '2021_01_17_120137_create_roles_table', 1),
(11, '2021_01_17_120703_user_role', 1),
(12, '2021_01_26_123538_permissions', 1),
(13, '2021_01_26_124131_permission_role', 1),
(14, '2021_01_31_141625_store_product', 1),
(15, '2021_01_7_055_create_carcolors_table', 1),
(16, '2021_01_8_214412_clients', 1),
(17, '2021_02_03_094737_misorders', 1),
(18, '2021_02_05_090809_product_misorder', 1),
(19, '2021_02_08_130005_create_countries_table', 1),
(20, '2021_02_08_130458_create_stocks_table', 1),
(21, '2021_02_09_114803_product_country', 1),
(22, '2021_03_09_210913_create_suppliers_table', 1),
(23, '2021_03_09_213603_create_mainproducts_table', 1),
(24, '2021_03_09_214413_create_supplierorders_table', 1),
(25, '2021_03_09_214457_mainproduct_supplierorder', 1),
(26, '2021_03_27_103604_create_storeorders_table', 1),
(27, '2021_03_27_103753_mainproduct_storeorder', 1),
(28, '2021_03_27_135737_store_mainproducts', 1),
(29, '2021_04_06_100148_create_shifts_table', 1),
(30, '2021_04_14_103554_create_cars_table', 1),
(31, '2021_04_14_225735_client_car', 1),
(32, '2021_05_05_193223_create_carsorts_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `misorders`
--

CREATE TABLE `misorders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `technical_id` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `total_price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `misorders`
--

INSERT INTO `misorders` (`id`, `order_id`, `technical_id`, `store_id`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 3, 90.00, '2021-04-26 21:38:38', '2021-04-26 21:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `technical_id` int(10) UNSIGNED DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `total_price` double(8,2) DEFAULT NULL,
  `client_car_id` int(10) UNSIGNED DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `price_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `price_after_discount` double(8,2) NOT NULL DEFAULT 0.00,
  `discount_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `technical_id`, `store_id`, `total_price`, `client_car_id`, `confirmed`, `price_confirmed`, `discount`, `price_after_discount`, `discount_confirmed`, `created_at`, `updated_at`) VALUES
(3, 1, 3, 3, 210.00, 1, 1, 1, 10.00, 200.00, 1, '2021-04-26 20:44:45', '2021-04-27 11:13:36'),
(4, NULL, 3, 3, 66.00, 1, 1, 1, 0.00, 66.00, 0, '2021-04-26 22:04:32', '2021-04-26 22:05:24'),
(5, 1, 2, 3, 90.00, 1, 1, 1, 0.00, 90.00, 0, '2021-04-27 12:49:09', '2021-04-27 13:12:54'),
(6, 1, 1, 3, 20.00, 1, 1, 1, 0.00, 20.00, 0, '2021-04-27 12:51:10', '2021-04-27 14:22:54'),
(7, 1, 3, 3, 45.00, 1, 1, 1, 0.00, 45.00, 0, '2021-04-27 12:51:31', '2021-04-27 13:43:34'),
(8, 1, 2, 3, 470.00, 1, 1, 1, 55.00, 415.00, 1, '2021-04-27 14:08:55', '2021-04-27 14:10:48'),
(9, NULL, 4, 5, 30.00, NULL, 0, 0, 0.00, 0.00, 0, '2021-05-01 12:07:47', '2021-05-01 12:07:47'),
(10, NULL, 3, 3, 50.00, NULL, 0, 0, 0.00, 0.00, 0, '2021-05-01 18:20:14', '2021-05-01 18:20:14'),
(11, NULL, 2, 3, 50.00, NULL, 0, 0, 0.00, 0.00, 0, '2021-05-01 18:51:02', '2021-05-01 18:51:02'),
(12, 1, 2, 3, 120.00, 1, 1, 1, 0.00, 120.00, 0, '2021-05-01 18:52:15', '2021-05-01 18:53:20'),
(13, 1, 1, 3, 100.00, 1, 1, 1, 0.00, 100.00, 0, '2021-05-02 11:32:22', '2021-05-02 11:33:20'),
(14, NULL, 2, 3, 50.00, NULL, 0, 0, 0.00, 0.00, 0, '2021-05-02 11:52:05', '2021-05-02 11:52:06'),
(15, NULL, 1, 3, 20.00, NULL, 0, 0, 0.00, 0.00, 0, '2021-05-02 11:54:22', '2021-05-02 11:54:23'),
(16, NULL, 2, 3, 50.00, NULL, 0, 0, 0.00, 0.00, 0, '2021-05-02 11:59:09', '2021-05-02 11:59:10'),
(17, NULL, 2, 3, 20.00, NULL, 0, 0, 0.00, 0.00, 0, '2021-05-02 12:07:32', '2021-05-02 12:07:33'),
(18, NULL, 2, 3, 20.00, NULL, 0, 0, 0.00, 0.00, 0, '2021-05-02 12:09:13', '2021-05-02 12:09:13'),
(19, 2, 3, 3, 80.00, 2, 1, 1, 30.00, 50.00, 1, '2021-05-02 12:10:23', '2021-05-02 12:14:24'),
(20, 2, 4, 5, 15.00, 2, 1, 1, 5.00, 10.00, 1, '2021-05-02 12:28:48', '2021-05-02 12:33:40'),
(21, 2, 4, 5, 30.00, 2, 1, 1, 5.00, 25.00, 1, '2021-05-02 12:29:08', '2021-05-02 12:35:25');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'عرض_الاقسام', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(2, 'عرض_الخدمات', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(3, 'عرض_المناطق', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(4, 'عرض_الفروع', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(5, 'عرض_المخزن', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(6, 'عرض_الموردين', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(7, 'عرض_طلبات_الموردين', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(8, 'عرض_العمالة', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(9, 'عرض_مديرين_الفروع', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(10, 'عرض_الفواتير', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(11, 'عرض_العملاء', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(12, 'عرض_الوان_السيارات', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(13, 'عرض_المستخدمين', '2021-04-25 18:20:04', '2021-04-25 18:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED DEFAULT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_value` int(11) NOT NULL DEFAULT 0,
  `countable` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price_value`, `countable`, `created_at`, `updated_at`) VALUES
(14, 1, 'نفخ الهواء', 0, 0, '2021-04-26 11:35:53', '2021-04-26 11:35:53'),
(15, 1, 'بلف تيواني', 1, 1, '2021-04-26 11:36:32', '2021-04-26 11:36:32'),
(16, 2, 'لحام الجنط', 2, 1, '2021-04-26 11:36:59', '2021-04-26 11:36:59'),
(17, 2, 'الجنوط الجنوط', 2, 1, '2021-04-26 20:40:24', '2021-04-26 20:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_country`
--

CREATE TABLE `product_country` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_country`
--

INSERT INTO `product_country` (`id`, `country_id`, `product_id`, `price`) VALUES
(6, 1, 14, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_misorder`
--

CREATE TABLE `product_misorder` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `misorder_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_misorder`
--

INSERT INTO `product_misorder` (`id`, `product_id`, `misorder_id`, `quantity`, `price`) VALUES
(1, 14, 1, 1, 0),
(2, 15, 1, 1, 0),
(3, 16, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`id`, `product_id`, `order_id`, `quantity`, `price`) VALUES
(6, 14, 3, 1, 5),
(7, 15, 3, 2, 15),
(8, 16, 3, 4, 10),
(9, 17, 3, 4, 10),
(10, 14, 4, 1, 5),
(11, 15, 4, 1, 15),
(12, 16, 4, 1, 7),
(13, 17, 4, 1, 9),
(14, 16, 5, 3, 20),
(15, 15, 5, 2, 15),
(16, 14, 6, 1, 5),
(17, 15, 6, 1, 15),
(18, 15, 7, 1, 15),
(19, 17, 7, 1, 10),
(20, 14, 7, 1, 5),
(21, 14, 8, 1, 5),
(22, 15, 8, 10, 15),
(23, 16, 8, 6, 30),
(24, 17, 8, 1, 30),
(25, 14, 9, 1, 5),
(26, 16, 9, 2, 0),
(27, 17, 9, 3, 0),
(28, 14, 10, 1, 5),
(29, 15, 10, 1, 15),
(30, 16, 10, 1, 0),
(31, 17, 10, 1, 0),
(32, 14, 11, 1, 5),
(33, 15, 11, 1, 15),
(34, 16, 11, 1, 0),
(35, 17, 11, 1, 0),
(36, 14, 12, 2, 5),
(37, 15, 12, 2, 15),
(38, 16, 12, 2, 5),
(39, 17, 12, 2, 5),
(40, 14, 13, 2, 5),
(41, 15, 13, 2, 15),
(42, 16, 13, 2, 0),
(43, 17, 13, 2, 0),
(44, 14, 14, 1, 5),
(45, 15, 14, 1, 15),
(46, 16, 14, 1, 0),
(47, 17, 14, 1, 0),
(48, 14, 15, 1, 5),
(49, 15, 15, 1, 15),
(50, 14, 16, 1, 5),
(51, 15, 16, 1, 15),
(52, 16, 16, 1, 0),
(53, 17, 16, 1, 0),
(54, 14, 17, 1, 5),
(55, 15, 17, 1, 15),
(56, 16, 17, 1, 0),
(57, 17, 17, 1, 0),
(58, 14, 18, 1, 5),
(59, 15, 18, 1, 15),
(60, 16, 18, 1, 0),
(61, 17, 18, 1, 0),
(62, 14, 19, 2, 5),
(63, 15, 19, 2, 15),
(64, 16, 19, 2, 5),
(65, 17, 19, 2, 15),
(66, 14, 20, 1, 5),
(67, 16, 20, 1, 5),
(68, 17, 20, 1, 5),
(69, 14, 21, 2, 5),
(70, 16, 21, 2, 5),
(71, 17, 21, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(2, 'cacheir', '2021-04-25 18:20:04', '2021-04-25 18:20:04'),
(3, 'store', '2021-04-25 18:20:04', '2021-04-25 18:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(10) UNSIGNED NOT NULL,
  `cacheir_id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `start` tinyint(1) DEFAULT 0,
  `total_price` double(8,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `cacheir_id`, `store_id`, `start_date`, `end_date`, `start`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 4, 3, NULL, NULL, 0, 0.00, '2021-04-25 19:04:16', '2021-04-25 19:04:16'),
(2, 4, 3, '2021-04-25 19:05:07', '2021-04-28 10:47:16', 0, 836.00, '2021-04-25 19:05:07', '2021-04-28 10:47:16'),
(3, 4, 3, '2021-04-28 10:50:57', '2021-04-28 10:50:58', 0, 0.00, '2021-04-28 10:50:57', '2021-04-28 10:50:58'),
(4, 6, 5, NULL, NULL, 0, 0.00, '2021-04-30 12:15:18', '2021-04-30 12:15:18'),
(5, 6, 5, '2021-04-30 12:30:04', '2021-05-02 12:16:12', 0, 0.00, '2021-04-30 12:30:04', '2021-05-02 12:16:12'),
(6, 4, 3, '2021-05-01 11:52:56', '2021-05-01 18:23:14', 0, 0.00, '2021-05-01 11:52:56', '2021-05-01 18:23:14'),
(7, 4, 3, '2021-05-01 18:50:23', '2021-05-01 18:51:22', 0, 0.00, '2021-05-01 18:50:23', '2021-05-01 18:51:22'),
(8, 4, 3, '2021-05-01 18:51:38', '2021-05-01 18:53:49', 0, 120.00, '2021-05-01 18:51:38', '2021-05-01 18:53:49'),
(9, 4, 3, '2021-05-01 21:22:32', '2021-05-01 21:31:39', 0, 0.00, '2021-05-01 21:22:32', '2021-05-01 21:31:39'),
(10, 4, 3, '2021-05-01 21:44:14', NULL, 1, 0.00, '2021-05-01 21:44:14', '2021-05-01 21:44:14'),
(11, 4, 3, '2021-05-01 21:44:14', '2021-05-01 21:44:16', 0, 0.00, '2021-05-01 21:44:14', '2021-05-01 21:44:16'),
(12, 4, 3, '2021-05-01 21:44:17', '2021-05-01 21:44:18', 0, 0.00, '2021-05-01 21:44:17', '2021-05-01 21:44:18'),
(13, 4, 3, '2021-05-01 21:44:20', NULL, 1, 0.00, '2021-05-01 21:44:20', '2021-05-01 21:44:20'),
(14, 4, 3, '2021-05-01 21:44:20', '2021-05-01 21:44:21', 0, 0.00, '2021-05-01 21:44:20', '2021-05-01 21:44:21'),
(15, 4, 3, '2021-05-01 21:44:23', '2021-05-01 21:44:24', 0, 0.00, '2021-05-01 21:44:23', '2021-05-01 21:44:24'),
(16, 4, 3, '2021-05-01 21:44:25', NULL, 1, 0.00, '2021-05-01 21:44:25', '2021-05-01 21:44:25'),
(17, 4, 3, '2021-05-01 21:44:26', '2021-05-01 21:44:26', 0, 0.00, '2021-05-01 21:44:26', '2021-05-01 21:44:26'),
(18, 4, 3, '2021-05-01 21:45:16', '2021-05-01 21:45:19', 0, 0.00, '2021-05-01 21:45:16', '2021-05-01 21:45:19'),
(19, 4, 3, '2021-05-01 22:09:16', '2021-05-02 11:31:54', 0, 0.00, '2021-05-01 22:09:16', '2021-05-02 11:31:54'),
(20, 4, 3, '2021-05-02 11:32:01', '2021-05-02 11:34:43', 0, 100.00, '2021-05-02 11:32:01', '2021-05-02 11:34:43'),
(21, 4, 3, '2021-05-02 11:51:38', '2021-05-02 12:15:38', 0, 50.00, '2021-05-02 11:51:38', '2021-05-02 12:15:38'),
(22, 6, 5, '2021-05-02 12:16:15', '2021-05-02 12:36:26', 0, 35.00, '2021-05-02 12:16:15', '2021-05-02 12:36:26'),
(23, 6, 5, '2021-05-05 17:17:38', NULL, 1, 0.00, '2021-05-05 17:17:38', '2021-05-05 17:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storeorders`
--

CREATE TABLE `storeorders` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `total_price` double(8,2) DEFAULT NULL,
  `paid_price` double(8,2) DEFAULT NULL,
  `remaining_price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storeorders`
--

INSERT INTO `storeorders` (`id`, `store_id`, `total_price`, `paid_price`, `remaining_price`, `created_at`, `updated_at`) VALUES
(2, 3, 180.00, 100.00, 80.00, '2021-04-26 15:50:05', '2021-04-26 15:50:05'),
(3, 3, 100.00, 60.00, 40.00, '2021-04-26 20:44:24', '2021-04-26 20:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `store_mainproducts`
--

CREATE TABLE `store_mainproducts` (
  `id` int(10) UNSIGNED NOT NULL,
  `mainproduct_id` int(11) DEFAULT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_mainproducts`
--

INSERT INTO `store_mainproducts` (`id`, `mainproduct_id`, `store_id`, `quantity`) VALUES
(9, 15, 3, 7),
(10, 16, 3, 8),
(11, 17, 3, 8),
(12, 15, 5, 20),
(13, 16, 5, 15),
(14, 17, 5, 14);

-- --------------------------------------------------------

--
-- Table structure for table `store_product`
--

CREATE TABLE `store_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_product`
--

INSERT INTO `store_product` (`id`, `store_id`, `product_id`, `price`) VALUES
(6, 3, 15, 15),
(7, 5, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplierorders`
--

CREATE TABLE `supplierorders` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `total_price` double(8,2) DEFAULT NULL,
  `paid_price` double(8,2) DEFAULT NULL,
  `remaining_price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplierorders`
--

INSERT INTO `supplierorders` (`id`, `supplier_id`, `total_price`, `paid_price`, `remaining_price`, `created_at`, `updated_at`) VALUES
(1, 1, 750.00, 500.00, 250.00, '2021-04-26 10:50:52', '2021-04-26 10:50:52'),
(3, 1, 500.00, 200.00, 300.00, '2021-04-26 15:49:24', '2021-04-26 15:49:24'),
(4, 1, 40.00, 30.00, 10.00, '2021-04-26 20:42:33', '2021-04-26 20:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `address`, `email`, `created_at`, `updated_at`) VALUES
(1, 'مازن المصري', '0101111111', 'ابوسليم', NULL, '2021-04-26 10:50:02', '2021-04-26 10:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `technicals`
--

CREATE TABLE `technicals` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technicals`
--

INSERT INTO `technicals` (`id`, `store_id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 3, 'محمد محمود السيد', 'mohamed@technical.com', '01013115444', '2021-04-25 18:20:07', '2021-04-25 18:20:07'),
(2, 3, 'اسلام احمد رضوان', 'eslam@technical.com', '01254552525', '2021-04-25 18:20:07', '2021-04-25 18:20:07'),
(3, 3, 'رضا الونش محسن', 'reda@technical.com', '01254555556', '2021-04-25 18:20:07', '2021-04-25 18:20:07'),
(4, 5, 'مازن المصري', 'admin@admin.com', '0101111111', '2021-04-30 11:59:40', '2021-04-30 11:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `store_id`, `country_id`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'الادمن الاول', 'admin@admin.com', NULL, '$2y$10$GmDK39oWEkPyM/ruMV9xPuIY6iCedSK5n5LWA1SbEeaYC.b7ydIpC', NULL, NULL, 1, NULL, '2021-04-25 18:20:05', '2021-04-25 18:20:05'),
(3, 'المتجر الاول', 'store@store.com', NULL, '$2y$10$3pUFY8IEzg1uftcecMaKzukuNRv47spVsOSPFdQmwToL/qn5Qa4Sa', NULL, 1, 0, NULL, '2021-04-25 18:20:05', '2021-04-25 18:20:05'),
(4, 'cacheir', 'cacheir@cacheir.com', NULL, '$2y$10$o6mQeFkCDqAVTBGdbQ3n8./xMk.LDdy4vmA6OdFAW32VsMbtZDNKa', 3, NULL, 0, NULL, '2021-04-25 19:04:16', '2021-04-25 19:04:16'),
(5, 'store2', 'store2@store.com', NULL, '$2y$10$RMJQqiHyd1Iz.ncyZs39yuT0L.jbDqRAnWwxB/defrpuv2237CLry', NULL, 1, 0, NULL, '2021-04-30 11:31:25', '2021-04-30 11:31:25'),
(6, 'cacheir2', 'cacheir2@cacheir.com', NULL, '$2y$10$mANWw4WbKuwyQVD5WAZdIOnHbSuGNW8MGRkT6t1b2o2nAh/s7MsSy', 5, NULL, 0, NULL, '2021-04-30 12:15:17', '2021-04-30 12:15:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(3, 3, 3),
(4, 4, 2),
(5, 5, 3),
(6, 6, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carcolors`
--
ALTER TABLE `carcolors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carsorts`
--
ALTER TABLE `carsorts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_store_id_foreign` (`store_id`);

--
-- Indexes for table `client_car`
--
ALTER TABLE `client_car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_car_client_id_foreign` (`client_id`),
  ADD KEY `client_car_car_id_foreign` (`car_id`),
  ADD KEY `client_car_carcolor_id_foreign` (`carcolor_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mainproducts`
--
ALTER TABLE `mainproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mainproducts_category_id_foreign` (`category_id`);

--
-- Indexes for table `mainproduct_storeorder`
--
ALTER TABLE `mainproduct_storeorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mainproduct_storeorder_mainproduct_id_foreign` (`mainproduct_id`),
  ADD KEY `mainproduct_storeorder_storeorder_id_foreign` (`storeorder_id`);

--
-- Indexes for table `mainproduct_supplierorder`
--
ALTER TABLE `mainproduct_supplierorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mainproduct_supplierorder_mainproduct_id_foreign` (`mainproduct_id`),
  ADD KEY `mainproduct_supplierorder_supplierorder_id_foreign` (`supplierorder_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `misorders`
--
ALTER TABLE `misorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `misorders_technical_id_foreign` (`technical_id`),
  ADD KEY `misorders_store_id_foreign` (`store_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_client_id_foreign` (`client_id`),
  ADD KEY `orders_technical_id_foreign` (`technical_id`),
  ADD KEY `orders_store_id_foreign` (`store_id`),
  ADD KEY `orders_client_car_id_foreign` (`client_car_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_country`
--
ALTER TABLE `product_country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_country_country_id_foreign` (`country_id`),
  ADD KEY `product_country_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_misorder`
--
ALTER TABLE `product_misorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_misorder_product_id_foreign` (`product_id`),
  ADD KEY `product_misorder_misorder_id_foreign` (`misorder_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_order_product_id_foreign` (`product_id`),
  ADD KEY `product_order_order_id_foreign` (`order_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shifts_cacheir_id_foreign` (`cacheir_id`),
  ADD KEY `shifts_store_id_foreign` (`store_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storeorders`
--
ALTER TABLE `storeorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storeorders_store_id_foreign` (`store_id`);

--
-- Indexes for table `store_mainproducts`
--
ALTER TABLE `store_mainproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_mainproducts_mainproduct_id_foreign` (`mainproduct_id`),
  ADD KEY `store_mainproducts_store_id_foreign` (`store_id`);

--
-- Indexes for table `store_product`
--
ALTER TABLE `store_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_product_store_id_foreign` (`store_id`),
  ADD KEY `store_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `supplierorders`
--
ALTER TABLE `supplierorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplierorders_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technicals`
--
ALTER TABLE `technicals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `technicals_store_id_foreign` (`store_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_user_id_foreign` (`user_id`),
  ADD KEY `user_role_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carcolors`
--
ALTER TABLE `carcolors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carsorts`
--
ALTER TABLE `carsorts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client_car`
--
ALTER TABLE `client_car`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mainproduct_storeorder`
--
ALTER TABLE `mainproduct_storeorder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mainproduct_supplierorder`
--
ALTER TABLE `mainproduct_supplierorder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `misorders`
--
ALTER TABLE `misorders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_country`
--
ALTER TABLE `product_country`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_misorder`
--
ALTER TABLE `product_misorder`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `storeorders`
--
ALTER TABLE `storeorders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store_mainproducts`
--
ALTER TABLE `store_mainproducts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `store_product`
--
ALTER TABLE `store_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplierorders`
--
ALTER TABLE `supplierorders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `technicals`
--
ALTER TABLE `technicals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client_car`
--
ALTER TABLE `client_car`
  ADD CONSTRAINT `client_car_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_car_carcolor_id_foreign` FOREIGN KEY (`carcolor_id`) REFERENCES `carcolors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `client_car_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mainproducts`
--
ALTER TABLE `mainproducts`
  ADD CONSTRAINT `mainproducts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mainproduct_storeorder`
--
ALTER TABLE `mainproduct_storeorder`
  ADD CONSTRAINT `mainproduct_storeorder_mainproduct_id_foreign` FOREIGN KEY (`mainproduct_id`) REFERENCES `mainproducts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mainproduct_storeorder_storeorder_id_foreign` FOREIGN KEY (`storeorder_id`) REFERENCES `storeorders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mainproduct_supplierorder`
--
ALTER TABLE `mainproduct_supplierorder`
  ADD CONSTRAINT `mainproduct_supplierorder_mainproduct_id_foreign` FOREIGN KEY (`mainproduct_id`) REFERENCES `mainproducts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mainproduct_supplierorder_supplierorder_id_foreign` FOREIGN KEY (`supplierorder_id`) REFERENCES `supplierorders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `misorders`
--
ALTER TABLE `misorders`
  ADD CONSTRAINT `misorders_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `misorders_technical_id_foreign` FOREIGN KEY (`technical_id`) REFERENCES `technicals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_car_id_foreign` FOREIGN KEY (`client_car_id`) REFERENCES `client_car` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_technical_id_foreign` FOREIGN KEY (`technical_id`) REFERENCES `technicals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_country`
--
ALTER TABLE `product_country`
  ADD CONSTRAINT `product_country_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_country_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_misorder`
--
ALTER TABLE `product_misorder`
  ADD CONSTRAINT `product_misorder_misorder_id_foreign` FOREIGN KEY (`misorder_id`) REFERENCES `misorders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_misorder_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_order_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shifts`
--
ALTER TABLE `shifts`
  ADD CONSTRAINT `shifts_cacheir_id_foreign` FOREIGN KEY (`cacheir_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shifts_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `storeorders`
--
ALTER TABLE `storeorders`
  ADD CONSTRAINT `storeorders_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `store_mainproducts`
--
ALTER TABLE `store_mainproducts`
  ADD CONSTRAINT `store_mainproducts_mainproduct_id_foreign` FOREIGN KEY (`mainproduct_id`) REFERENCES `mainproducts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_mainproducts_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `store_product`
--
ALTER TABLE `store_product`
  ADD CONSTRAINT `store_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_product_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supplierorders`
--
ALTER TABLE `supplierorders`
  ADD CONSTRAINT `supplierorders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `technicals`
--
ALTER TABLE `technicals`
  ADD CONSTRAINT `technicals_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
