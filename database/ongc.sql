-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2023 at 07:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ongc`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ev_id` bigint(20) UNSIGNED NOT NULL,
  `event_name` varchar(200) NOT NULL,
  `event_location` longtext NOT NULL,
  `event_datefr` timestamp NOT NULL DEFAULT current_timestamp(),
  `event_dateto` timestamp NOT NULL DEFAULT current_timestamp(),
  `event_details` longtext DEFAULT NULL,
  `pdf_path` mediumtext DEFAULT NULL,
  `create_by` int(11) NOT NULL,
  `actv_event` int(11) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Expired',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ev_id`, `event_name`, `event_location`, `event_datefr`, `event_dateto`, `event_details`, `pdf_path`, `create_by`, `actv_event`, `created_at`, `updated_at`) VALUES
(1, 'Event Us-2', 'Panchkula Hariyana', '2023-10-20 06:36:00', '2023-10-27 06:36:00', NULL, NULL, 1, 1, '2023-09-21 06:49:42', '2023-09-28 01:23:41'),
(2, 'Test Event 23', 'Evant Locaton Test', '2023-10-23 18:30:00', '2023-10-23 18:30:00', 'evdtl_TestEvent23_1696575132.pdf', 'http://localhost/ongcc/storage/app/event_pdf/', 1, 1, '2023-09-21 06:53:44', '2023-10-06 01:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `event_books`
--

CREATE TABLE `event_books` (
  `ev_book_id` bigint(20) UNSIGNED NOT NULL,
  `event_cd` int(11) NOT NULL,
  `hotel_cd` int(11) NOT NULL,
  `hotel_cat_cd` int(11) NOT NULL,
  `employee_cds` varchar(100) NOT NULL,
  `employee_cds_info` varchar(240) NOT NULL,
  `ev_create_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_books`
--

INSERT INTO `event_books` (`ev_book_id`, `event_cd`, `hotel_cd`, `hotel_cat_cd`, `employee_cds`, `employee_cds_info`, `ev_create_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '2', '0^2^0', 1, '2023-09-27 05:32:02', NULL),
(2, 1, 3, 8, '2', '0^2^0', 1, '2023-09-27 05:33:42', NULL),
(3, 1, 3, 8, '2', '0^2^0', 1, '2023-09-27 05:34:06', NULL),
(4, 2, 3, 9, '2', '0^2^0', 1, '2023-09-27 05:51:12', NULL),
(5, 2, 1, 2, '505', '6^505^514', 1, '2023-09-28 04:01:44', '2023-09-29 00:55:13'),
(6, 2, 1, 2, '517,516', '0^517^504||0^516^504', 1, '2023-10-06 04:31:12', NULL),
(7, 2, 1, 2, '517,516', '0^517^504||0^516^504', 1, '2023-10-06 04:31:35', NULL),
(8, 2, 1, 2, '517,516', '0^517^504||0^516^504', 1, '2023-10-06 04:32:09', NULL),
(9, 2, 1, 1, '527,530', '0^527^1018||0^530^1018', 1, '2023-10-06 04:46:57', NULL),
(10, 2, 6, 19, '530,553', '0^530^1016||0^553^1016', 1, '2023-10-06 04:49:34', NULL),
(11, 2, 3, 10, '539,547', '0^539^1015||0^547^1015', 1, '2023-10-06 04:54:03', NULL),
(12, 2, 3, 10, '539,547', '0^539^1015||0^547^1015', 1, '2023-10-06 04:54:38', NULL),
(13, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 04:56:34', NULL),
(14, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 04:57:38', NULL),
(15, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 04:58:32', NULL),
(16, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 04:58:50', NULL),
(17, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 04:59:38', NULL),
(18, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 05:00:22', NULL),
(19, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 05:00:48', NULL),
(20, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 05:01:06', NULL),
(21, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 05:01:38', NULL),
(22, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 05:02:33', NULL),
(23, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 05:03:02', NULL),
(24, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 05:03:13', NULL),
(25, 2, 6, 17, '527', '0^527^1011', 1, '2023-10-06 05:03:26', NULL),
(26, 2, 1, 2, '503,519', '0^503^2||0^519^2', 1, '2023-10-06 05:06:08', NULL),
(27, 2, 1, 2, '516,530', '0^516^2||0^530^2', 1, '2023-10-06 05:13:12', NULL),
(28, 2, 1, 2, '544', '98^544^0', 1, '2023-10-06 05:17:29', '2023-10-06 06:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `event_books_emp`
--

CREATE TABLE `event_books_emp` (
  `emp_ev_book_id` bigint(20) UNSIGNED NOT NULL,
  `event_book_id` int(11) NOT NULL,
  `emp_cd` int(11) NOT NULL,
  `emp_event_cd` int(11) NOT NULL,
  `emp_hotel_cd` int(11) NOT NULL,
  `emp_hotel_cat_cd` int(11) NOT NULL,
  `share_room_with_empcd` varchar(200) DEFAULT NULL,
  `arv_flight_no` varchar(100) DEFAULT NULL,
  `arv_date_time` timestamp NULL DEFAULT NULL,
  `arv_location` longtext DEFAULT NULL,
  `dptr_flight_no` varchar(100) DEFAULT NULL,
  `dptr_date_time` timestamp NULL DEFAULT NULL,
  `dptr_location` longtext DEFAULT NULL,
  `flight_status` int(11) NOT NULL DEFAULT 0 COMMENT '0:Active, 1:Expired',
  `drvr_name` varchar(100) DEFAULT NULL,
  `drvr_number` varchar(20) DEFAULT NULL,
  `drvr_veh_details` longtext DEFAULT NULL,
  `ev_emp_create_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_books_emp`
--

INSERT INTO `event_books_emp` (`emp_ev_book_id`, `event_book_id`, `emp_cd`, `emp_event_cd`, `emp_hotel_cd`, `emp_hotel_cat_cd`, `share_room_with_empcd`, `arv_flight_no`, `arv_date_time`, `arv_location`, `dptr_flight_no`, `dptr_date_time`, `dptr_location`, `flight_status`, `drvr_name`, `drvr_number`, `drvr_veh_details`, `ev_emp_create_by`, `created_at`, `updated_at`, `check_in`, `check_out`) VALUES
(1, 1, 2, 2, 1, 2, '2,524,545,544', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, '2023-09-27 05:32:02', NULL, NULL, NULL),
(4, 4, 2, 1, 3, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, '2023-09-27 05:51:12', NULL, NULL, NULL),
(5, 5, 504, 2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, '2023-09-28 04:01:44', NULL, NULL, NULL),
(6, 5, 505, 2, 3, 13, '514', '', NULL, '', '', NULL, '', 0, '', '', '', 1, '2023-09-28 04:01:44', '2023-10-05 02:12:57', NULL, NULL),
(96, 28, 524, 2, 1, 2, '524,545,544', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, '2023-10-06 05:17:29', NULL, NULL, NULL),
(97, 28, 545, 2, 1, 2, '524,545,544', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, '2023-10-06 05:17:29', NULL, NULL, NULL),
(98, 28, 544, 2, 1, 2, '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, '2023-10-06 05:17:29', '2023-10-06 06:22:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `htl_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_name` varchar(200) NOT NULL,
  `hotel_address` longtext DEFAULT NULL,
  `hotel_geolocation` longtext DEFAULT NULL,
  `hotel_image` longtext DEFAULT NULL,
  `image_path` varchar(200) DEFAULT NULL,
  `create_by` int(11) NOT NULL,
  `actv_hotel` int(11) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Expired',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`htl_id`, `hotel_name`, `hotel_address`, `hotel_geolocation`, `hotel_image`, `image_path`, `create_by`, `actv_hotel`, `created_at`, `updated_at`) VALUES
(1, 'Hotel Test Star', 'Sd Df Wefg Weftw We Wet', 'wwegfwef wqet wetwet e4t2t2', 'htl_abchotelname_1695366306.jpg', 'http://localhost/ongcc/storage/app/hotel_image/', 1, 1, '2023-09-22 01:35:06', '2023-09-28 01:42:59'),
(3, 'Economic Hotel', 'Sdf Weft Et Wetrw E Twet', 'wer twtq q q2 3', 'htl_Abc33333333334_1695637010_0.png||htl_Abc33333333334_1695637010_1.png||htl_Abc33333333334_1695638455_0.jpg||htl_Abc33333333334_1695638455_1.png||htl_Abc33333333334_1695638455_2.png', 'http://localhost/ongcc/storage/app/hotel_image/', 1, 1, '2023-09-25 01:51:20', '2023-09-28 01:44:15'),
(6, 'Surya Hotel', '', '', NULL, 'http://localhost/ongcc/storage/app/hotel_image/', 1, 1, '2023-10-04 23:43:06', NULL),
(7, 'Hotel Aakash', 'Abc Hotel', NULL, 'htl_HotelAakash_1696571487_0.png||htl_HotelAakash_1696571487_1.png||htl_HotelAakash_1696571487_2.png', 'http://localhost/ongcc/storage/app/hotel_image/', 1, 1, '2023-10-04 23:43:06', '2023-10-06 00:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `hotels_category`
--

CREATE TABLE `hotels_category` (
  `htl_cat_id` bigint(20) UNSIGNED NOT NULL,
  `htl_idd` bigint(20) UNSIGNED NOT NULL,
  `hotel_nm` varchar(200) NOT NULL,
  `hotel_category` varchar(200) NOT NULL,
  `total_rooms` int(11) NOT NULL,
  `occupied_rooms` int(11) NOT NULL,
  `vacent_rooms` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `soft_delete_yn` int(11) NOT NULL DEFAULT 0 COMMENT '1:Yes, 0:No',
  `soft_delete_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels_category`
--

INSERT INTO `hotels_category` (`htl_cat_id`, `htl_idd`, `hotel_nm`, `hotel_category`, `total_rooms`, `occupied_rooms`, `vacent_rooms`, `create_by`, `soft_delete_yn`, `soft_delete_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hotel Test Star', 'Business Class', 55, 0, 55, 1, 0, NULL, '2023-09-22 01:35:06', '2023-09-28 01:42:59'),
(2, 1, 'Hotel Test Star', 'One Star', 52, 0, 52, 1, 0, NULL, '2023-09-22 01:35:06', '2023-09-28 01:42:59'),
(3, 1, 'Abc Hotel Name', 'Fhturturt 55522222', 402, 0, 402, 1, 1, '2023-09-22 04:24:58', '2023-09-22 01:35:06', '2023-09-22 04:10:14'),
(4, 1, 'Hotel Test Star', 'Casino Class', 10, 0, 10, 1, 0, NULL, '2023-09-22 04:10:14', '2023-09-28 01:42:59'),
(5, 1, 'Hotel Test Star', 'Delux', 10, 0, 10, 1, 0, NULL, '2023-09-22 04:24:58', '2023-09-28 01:42:59'),
(8, 3, 'Economic Hotel', 'Delux', 45, 0, 45, 1, 0, NULL, '2023-09-25 01:51:20', '2023-09-28 01:44:15'),
(9, 3, 'Economic Hotel', 'Business Class	', 12, 0, 12, 1, 0, NULL, '2023-09-25 01:51:20', '2023-09-28 01:44:15'),
(10, 3, 'Economic Hotel', 'One Star', 35, 0, 35, 1, 0, NULL, '2023-09-28 01:44:15', NULL),
(12, 1, 'Hotel Test Star', 'Two Star', 1, 1, 1, 1, 0, NULL, '2023-10-04 04:57:57', NULL),
(13, 3, 'Economic Hotel', 'Business Class', 1, 1, 1, 1, 0, NULL, '2023-10-04 04:57:57', NULL),
(17, 6, 'Surya Hotel', 'Two Star', 1, 1, 1, 1, 0, NULL, '2023-10-04 23:43:06', NULL),
(18, 7, 'Hotel Aakash', 'Delux', 1, 1, 0, 1, 0, NULL, '2023-10-04 23:43:06', '2023-10-06 00:24:16'),
(19, 6, 'Surya Hotel', 'One Star', 1, 1, 1, 1, 0, NULL, '2023-10-04 23:43:07', NULL),
(20, 6, 'Surya Hotel', 'Delux', 1, 1, 1, 1, 0, NULL, '2023-10-04 23:43:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_09_21_080729_create_events_table', 1),
(10, '2023_09_21_081433_create_hotels_table', 2),
(11, '2016_06_01_000001_create_oauth_auth_codes_table', 3),
(12, '2016_06_01_000002_create_oauth_access_tokens_table', 3),
(13, '2016_06_01_000003_create_oauth_refresh_tokens_table', 3),
(14, '2016_06_01_000004_create_oauth_clients_table', 3),
(15, '2016_06_01_000005_create_oauth_personal_access_clients_table', 3),
(17, '2023_09_21_082447_create_event_books_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\User', 2, 'admin22@admin.com', 'a596029617128c536b88b1b75947ceb3bde7b3cc915c0c6b130e4bc7caab16e7', '[\"*\"]', '2023-09-27 00:30:44', NULL, '2023-09-27 00:29:47', '2023-09-27 00:30:44'),
(4, 'App\\Models\\User', 2, 'admin22@admin.com', 'e6f82248a68bb7114a91b8236c15695da305e5e1ac16795dc241db54e025d125', '[\"*\"]', '2023-09-27 00:31:27', NULL, '2023-09-27 00:31:13', '2023-09-27 00:31:27'),
(5, 'App\\Models\\User', 2, 'admin22@admin.com', 'a86dc12428ae7a975a98c27e4532f5377873dc8ed5aa7929ae6e1fe88ec2e116', '[\"*\"]', '2023-09-27 00:36:26', NULL, '2023-09-27 00:35:33', '2023-09-27 00:36:26'),
(6, 'App\\Models\\User', 2, 'admin22@admin.com', '14d4f03f63726557c636f6657ddf97c33778ff9db30fa29300769b5c91bc2500', '[\"*\"]', NULL, NULL, '2023-09-27 23:32:48', '2023-09-27 23:32:48'),
(7, 'App\\Models\\User', 2, 'admin22@admin.com', '07251c78a0d3b28579cd419cfc72fdda46bfaeab1ca8e9fdf95966c58c5c0757', '[\"*\"]', NULL, NULL, '2023-09-29 06:42:23', '2023-09-29 06:42:23'),
(8, 'App\\Models\\User', 2, 'admin22@admin.com', '0cd2b7b397bc9a69ccf25c5147abd0d87a2cb603e8757c993320da7b1c77fdaf', '[\"*\"]', NULL, NULL, '2023-09-29 06:48:05', '2023-09-29 06:48:05'),
(9, 'App\\Models\\User', 2, 'admin22@admin.com', '29ead525200181bc9341cd18f7bd2a92f6fac7f6c87332aee48414d0603006cf', '[\"*\"]', NULL, NULL, '2023-10-02 23:31:14', '2023-10-02 23:31:14'),
(10, 'App\\Models\\User', 2, 'admin22@admin.com', '908a545f6975372148e6f5cf691477d344f6fb346437b1e6c4db468995968811', '[\"*\"]', NULL, NULL, '2023-10-02 23:32:09', '2023-10-02 23:32:09'),
(11, 'App\\Models\\User', 2, 'admin22@admin.com', '8d8a4a70b50fe82575d3c9840639d615eaee656d18e796aec84a500a94228b1b', '[\"*\"]', NULL, NULL, '2023-10-02 23:45:04', '2023-10-02 23:45:04'),
(12, 'App\\Models\\User', 2, 'admin22@admin.com', 'f60171f3b5b886b9d411629b41f1ef2edb9e1bf554d054ee4c3e967e61a66804', '[\"*\"]', NULL, NULL, '2023-10-03 00:11:07', '2023-10-03 00:11:07'),
(13, 'App\\Models\\User', 2, 'admin22@admin.com', '06b98579fc55a66d94203203ce8316857f83f8dd9ab01cc71e3dc6abc4784aa9', '[\"*\"]', NULL, NULL, '2023-10-03 00:12:05', '2023-10-03 00:12:05'),
(14, 'App\\Models\\User', 2, 'admin22@admin.com', 'e54c9bc85063639cad91d18079cb9ce7bf8548d5bcf5fcb82032153dec8f1830', '[\"*\"]', NULL, NULL, '2023-10-03 00:12:16', '2023-10-03 00:12:16'),
(15, 'App\\Models\\User', 2, 'admin22@admin.com', '7dd72dfb97350c46755d635a1f17c5c2ef2b0838308d14e07d7c3f28333147ea', '[\"*\"]', NULL, NULL, '2023-10-03 00:12:22', '2023-10-03 00:12:22'),
(16, 'App\\Models\\User', 2, 'admin22@admin.com', 'e36b9d26be91a66f2f0b92e7ad314d188b596be51d742d938cbc71eafeecec97', '[\"*\"]', '2023-10-06 01:37:09', NULL, '2023-10-03 04:51:44', '2023-10-06 01:37:09'),
(17, 'App\\Models\\User', 2, 'admin22@admin.com', '9ffe7aa490b1ed5ab575c09a3facbf7b6f5e6f83893e3b4c1cc08d0bd8db71a5', '[\"*\"]', NULL, NULL, '2023-10-04 00:08:47', '2023-10-04 00:08:47'),
(18, 'App\\Models\\User', 2, 'admin22@admin.com', '6c7d9054368ccfc85e81b05ec81fddc88a8b9474268722bccdb58a2eea67305c', '[\"*\"]', NULL, NULL, '2023-10-04 00:22:58', '2023-10-04 00:22:58'),
(19, 'App\\Models\\User', 2, 'admin22@admin.com', '401f53e305925c99d41d4c89f11037359e4eeedb5a45c7b3861bfcf420871171', '[\"*\"]', NULL, NULL, '2023-10-04 00:56:56', '2023-10-04 00:56:56'),
(20, 'App\\Models\\User', 2, 'admin22@admin.com', '32a29315d7f50f33bbdfb10c7e96f76d77592abceeb4217935e39626cbb4bda3', '[\"*\"]', NULL, NULL, '2023-10-04 00:57:32', '2023-10-04 00:57:32'),
(21, 'App\\Models\\User', 2, 'admin22@admin.com', '26bd91148f4060d934860295be98b4b429e0f71a7ff0f2a86ea6d41d51379441', '[\"*\"]', NULL, NULL, '2023-10-04 01:42:31', '2023-10-04 01:42:31'),
(22, 'App\\Models\\User', 2, 'admin22@admin.com', 'ea74d8243a6f707024f78fdc80f32c067bfbe07b2bae1c3604d882bef1760936', '[\"*\"]', NULL, NULL, '2023-10-04 01:52:53', '2023-10-04 01:52:53'),
(23, 'App\\Models\\User', 2, 'admin22@admin.com', '4706b7ff66e0763264059fe1c61cb0f8d8787479360ec49dc01ffb42a843f4e9', '[\"*\"]', NULL, NULL, '2023-10-04 02:33:52', '2023-10-04 02:33:52'),
(24, 'App\\Models\\User', 2, 'admin22@admin.com', '168cbeab9e816ad329b1d1dd87812006bb7ee96950ca4c98847e694c0bd7abd5', '[\"*\"]', NULL, NULL, '2023-10-04 04:06:07', '2023-10-04 04:06:07'),
(25, 'App\\Models\\User', 2, 'admin22@admin.com', 'ade279a7e3f051e05eec092e1e907ec942df5529f1cd17bebec4b53f12e4802c', '[\"*\"]', NULL, NULL, '2023-10-04 23:29:43', '2023-10-04 23:29:43'),
(26, 'App\\Models\\User', 2, 'admin22@admin.com', 'c157b540a4e30b8bfa89552b356a3c9f8e30f7b94fc42dfb174d86a15d140dbd', '[\"*\"]', NULL, NULL, '2023-10-05 01:33:26', '2023-10-05 01:33:26'),
(27, 'App\\Models\\User', 2, 'admin22@admin.com', '8b668b28939ac8419b19cb3cb46510af734b07e25ab8e464acf12d804354cfcc', '[\"*\"]', NULL, NULL, '2023-10-05 01:54:26', '2023-10-05 01:54:26'),
(28, 'App\\Models\\User', 2, 'admin22@admin.com', '8b1aeec1ea14b35e9b19e3eef379a596a9b0177c1e3aea81d27a7bc655d19e42', '[\"*\"]', NULL, NULL, '2023-10-05 01:56:57', '2023-10-05 01:56:57'),
(29, 'App\\Models\\User', 2, 'admin22@admin.com', 'edfd20a784c60f8326e5660a90be7cfb648c7b85d3f96fffc3a8f12e9e8a7297', '[\"*\"]', NULL, NULL, '2023-10-05 02:03:44', '2023-10-05 02:03:44'),
(30, 'App\\Models\\User', 2, 'admin22@admin.com', '923e050126c28016b7b330c6b0207b95dfe9df418123b05abd3b04d45e44d9fc', '[\"*\"]', NULL, NULL, '2023-10-05 02:04:17', '2023-10-05 02:04:17'),
(31, 'App\\Models\\User', 2, 'admin22@admin.com', 'f50bea116f2e2e8c6f3b37eb9d26e28a6cbab09e0b08f8003e116b4a6bcdd2ae', '[\"*\"]', NULL, NULL, '2023-10-05 23:38:26', '2023-10-05 23:38:26'),
(32, 'App\\Models\\User', 2, 'admin22@admin.com', '057ef443a570ab5fbddd592c56ada6ad867debced4d5e1d405c334d6afe6a35c', '[\"*\"]', NULL, NULL, '2023-10-05 23:59:08', '2023-10-05 23:59:08'),
(33, 'App\\Models\\User', 2, 'admin22@admin.com', '1c4275b45b348b3096326e67974678ce5a26cc9825f74a8b4ac6f5198fff790b', '[\"*\"]', NULL, NULL, '2023-10-06 00:03:57', '2023-10-06 00:03:57'),
(34, 'App\\Models\\User', 2, 'admin22@admin.com', 'a07336cded0e53a388ce381d65a9643104c723000714b6b329c5e15a89decf7a', '[\"*\"]', NULL, NULL, '2023-10-06 00:05:23', '2023-10-06 00:05:23'),
(35, 'App\\Models\\User', 2, 'admin22@admin.com', '1b522093586823141af8d773f4bf73903212d7b3dad0478df034d37dd626fc86', '[\"*\"]', NULL, NULL, '2023-10-06 00:05:33', '2023-10-06 00:05:33'),
(36, 'App\\Models\\User', 2, 'admin22@admin.com', '606cb8afb17939444f9fa233f916a97aef4b62a4f929a0c7e4bfca25fdf0d543', '[\"*\"]', NULL, NULL, '2023-10-06 00:30:43', '2023-10-06 00:30:43'),
(37, 'App\\Models\\User', 2, 'admin22@admin.com', 'a57b01ad30c4ab366983d95938a5bf59a87c220e8b071ec1dc51ebf3e4f473e1', '[\"*\"]', NULL, NULL, '2023-10-06 00:52:02', '2023-10-06 00:52:02'),
(38, 'App\\Models\\User', 2, 'admin22@admin.com', '084b5877a0fc8bf7fc7b4dec5e69df9e208309d4e7abb3267832b0903d0a1c2f', '[\"*\"]', NULL, NULL, '2023-10-06 01:02:31', '2023-10-06 01:02:31'),
(39, 'App\\Models\\User', 2, 'admin22@admin.com', 'fc42498793d10c533f30ba6f5080e0000f5c74f82494595402db075ab97a6cba', '[\"*\"]', NULL, NULL, '2023-10-06 01:02:31', '2023-10-06 01:02:31'),
(40, 'App\\Models\\User', 2, 'admin22@admin.com', '333f830327813deaac95771e35661a937b8854495e70947cfc06268b25d3198b', '[\"*\"]', NULL, NULL, '2023-10-06 01:06:47', '2023-10-06 01:06:47'),
(41, 'App\\Models\\User', 2, 'admin22@admin.com', '5a356eb9eec4cfac027f89491a9686e8dabf767ccd2d6257fb312f864d47f5b7', '[\"*\"]', NULL, NULL, '2023-10-06 01:06:47', '2023-10-06 01:06:47'),
(42, 'App\\Models\\User', 2, 'admin22@admin.com', '9ef34a2bea2ed85d1b9ebfae5b8bfe3f5facf0c007bf5288ea61b1be9c9797c8', '[\"*\"]', NULL, NULL, '2023-10-06 01:08:38', '2023-10-06 01:08:38'),
(43, 'App\\Models\\User', 2, 'admin22@admin.com', '3afb35dbe847dd4211335ccb62968d49e12f316dc45a66fe4df8b6bc8ebd1a77', '[\"*\"]', NULL, NULL, '2023-10-06 01:10:06', '2023-10-06 01:10:06'),
(44, 'App\\Models\\User', 2, 'admin22@admin.com', '41efc4f9bf666d74730fa7f5a25915fa94d42da1708a34c0a8c4b04397f753ff', '[\"*\"]', NULL, NULL, '2023-10-06 01:11:59', '2023-10-06 01:11:59'),
(45, 'App\\Models\\User', 2, 'admin22@admin.com', '61f04719f439f32fc55874d3f2299a1f6c7df716a951cb05a6d49c122cb075be', '[\"*\"]', NULL, NULL, '2023-10-06 01:13:49', '2023-10-06 01:13:49'),
(46, 'App\\Models\\User', 2, 'admin22@admin.com', 'cd1c1601f04a6fb727d1ad544752de82a820355f3cc58baa795ac70f6abccb1f', '[\"*\"]', NULL, NULL, '2023-10-06 01:14:17', '2023-10-06 01:14:17'),
(47, 'App\\Models\\User', 2, 'admin22@admin.com', '90c9bddbe9bf120f81f1b924f4ed67dd30fcda9fc462fb66bbc66c34e8097d4a', '[\"*\"]', NULL, NULL, '2023-10-06 01:14:59', '2023-10-06 01:14:59'),
(48, 'App\\Models\\User', 2, 'admin22@admin.com', '564ace033f91d9b9d72ac081ad6f8d03a2e1412de697ff5ff9f11b9c04b8114c', '[\"*\"]', NULL, NULL, '2023-10-06 01:30:15', '2023-10-06 01:30:15'),
(49, 'App\\Models\\User', 2, 'admin22@admin.com', '6b3fc05b1e94bbcee179358233ef3723b57d682dde0f4b2a0f8a887885a09c13', '[\"*\"]', NULL, NULL, '2023-10-06 01:31:16', '2023-10-06 01:31:16'),
(50, 'App\\Models\\User', 2, 'admin22@admin.com', '2ba263c79a7661413e167b182181c23bfd1734c7fbe88a436798aa548c83045c', '[\"*\"]', NULL, NULL, '2023-10-06 01:39:36', '2023-10-06 01:39:36'),
(51, 'App\\Models\\User', 2, 'admin22@admin.com', 'd12fed035d304cfb401c8fff16b97bc9a929426daa158cc4c13ad114c69ebf26', '[\"*\"]', NULL, NULL, '2023-10-06 01:40:09', '2023-10-06 01:40:09'),
(52, 'App\\Models\\User', 2, 'admin22@admin.com', 'fb6bfac97add12108b83e6a8c67f5eaa9a1f269dafc8f4f116e2afe853b49910', '[\"*\"]', NULL, NULL, '2023-10-06 01:52:23', '2023-10-06 01:52:23'),
(53, 'App\\Models\\User', 2, 'admin22@admin.com', 'e4f9c45b138792d20b839e37cc64e6b771ee66eff1d8ae0047dba6497ce3a475', '[\"*\"]', NULL, NULL, '2023-10-06 01:59:52', '2023-10-06 01:59:52'),
(54, 'App\\Models\\User', 2, 'admin22@admin.com', '14090e746876d68df8fb1f8f17528ec48f0e901885876d54f268ebba1a3a6aed', '[\"*\"]', NULL, NULL, '2023-10-06 02:00:30', '2023-10-06 02:00:30'),
(55, 'App\\Models\\User', 2, 'admin22@admin.com', '7d13fffa09b48b5e465c956ecb8544d337c7c089012dcb778c6b48f857fc2f45', '[\"*\"]', NULL, NULL, '2023-10-06 02:01:02', '2023-10-06 02:01:02'),
(56, 'App\\Models\\User', 2, 'admin22@admin.com', 'dcd4f4ef7cb9409a657f3d34601f8a74b68ba20d2751324b401c83e5e166fba2', '[\"*\"]', NULL, NULL, '2023-10-06 02:03:32', '2023-10-06 02:03:32'),
(57, 'App\\Models\\User', 2, 'admin22@admin.com', 'a00a463137777e58eff5f51478a9a2662bdb524994b3a33676c5586c6d4e303a', '[\"*\"]', NULL, NULL, '2023-10-06 02:03:45', '2023-10-06 02:03:45'),
(58, 'App\\Models\\User', 2, 'admin22@admin.com', '09c28007ba2cedba8fefb1197a60570738c32c1b2fa47c7b8000a8f7ab85c70b', '[\"*\"]', NULL, NULL, '2023-10-06 02:20:35', '2023-10-06 02:20:35'),
(59, 'App\\Models\\User', 2, 'admin22@admin.com', '5963e77c2028eec82b1d6fd978100c6f462d4a202b0977afa341ff0b2311b360', '[\"*\"]', NULL, NULL, '2023-10-06 02:24:30', '2023-10-06 02:24:30'),
(60, 'App\\Models\\User', 2, 'admin22@admin.com', 'f8067a992f616c67ae5ae71b2f5c1eb1abbd2c407c51d11968e25683f3f4599d', '[\"*\"]', NULL, NULL, '2023-10-06 02:27:34', '2023-10-06 02:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `cpf_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `level` varchar(200) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `user_type` int(11) NOT NULL DEFAULT 2 COMMENT '0:Superadmin, 1:Admin, 2:Employee, 3:Hotel',
  `actv_status` int(11) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Deleted',
  `create_by` int(10) DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `cpf_no`, `email`, `email_verified_at`, `password`, `mobile`, `level`, `designation`, `category`, `location`, `user_type`, `actv_status`, `create_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin12', 'admin@gmail.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, NULL, NULL),
(2, 'Umesh Singh', 'CPF11122333', 'admin22@admin.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8987535454', 'A9', 'Abcabc', 'Catrer', 'Pnchkula', 2, 1, 1, 'fM4qNemZz0OGpByIgnymJWbR40TmN1Oi3tJt071Db8yH3HTJ0qQR3UUq6EGA', '2023-09-25 01:09:19', '2023-10-06 02:27:34'),
(503, 'Jobi Paulack', 'CPF8554587535', 'jpaulack0@myspace.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6768347537', 'A', 'Technicians', 'III', 'Apt 802', 2, 1, 1, NULL, '2022-12-09 18:30:00', NULL),
(504, 'Keely Pleasance', 'CPF5351757347', 'kpleasance1@cdbaby.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1998455289', 'B2', 'Energy engineer', 'Jr', 'Suite 85', 2, 1, 1, NULL, '2023-08-20 18:30:00', NULL),
(505, 'Celine Pegden', 'CPF3323947274', 'cpegden2@biblegateway.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2425502122', 'B3', 'Mining engineer', 'Jr', 'PO Box 18332', 2, 1, 1, NULL, '2023-05-29 18:30:00', NULL),
(506, 'Hilda Ellwell', 'CPF9366493491', 'hellwell3@yandex.ru', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5991516689', 'B3', 'Drilling engineer', 'III', 'Room 1280', 2, 1, 1, NULL, '2023-06-18 18:30:00', NULL),
(507, 'Engracia Foulis', 'CPF6594698616', 'efoulis4@altervista.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7175365480', 'C', 'Mining engineer', 'Jr', '9th Floor', 2, 1, 1, NULL, '2023-06-08 18:30:00', NULL),
(508, 'Simone DOnise', 'CPF0195634965', 'sdonise5@123-reg.co.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6427727633', 'D', 'Drilling engineer', 'Sr', 'Apt 1186', 2, 1, 1, NULL, '2023-09-03 18:30:00', NULL),
(509, 'Chuck Fost', 'CPF7992092153', 'cfost6@linkedin.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7382017922', 'A1', 'Mining engineer', 'III', 'Room 716', 2, 1, 1, NULL, '2022-10-31 18:30:00', NULL),
(510, 'Ronny Stuke', 'CPF3496836750', 'rstuke7@europa.eu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9711684660', 'A', 'Mining engineer', 'III', 'Room 1282', 2, 1, 1, NULL, '2023-09-21 18:30:00', NULL),
(511, 'Tremaine Jzhakov', 'CPF0023716056', 'tjzhakov8@barnesandnoble.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9804857368', 'A2', 'Energy engineer', 'Sr', 'Apt 1153', 2, 1, 1, NULL, '2023-09-09 18:30:00', NULL),
(512, 'Jessamine Calbrathe', 'CPF7435782359', 'jcalbrathe9@delicious.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2127054649', 'B1', 'Energy engineer', 'Jr', 'Apt 667', 2, 1, 1, NULL, '2022-11-15 18:30:00', NULL),
(513, 'Chrotoem Babbs', 'CPF6391663072', 'cbabbsa@meetup.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7935162468', 'B1', 'Mining engineer', 'Sr', 'PO Box 22076', 2, 1, 1, NULL, '2023-08-08 18:30:00', NULL),
(514, 'Devondra Latch', 'CPF8488506268', 'dlatchb@ted.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9064387125', 'B1', 'Energy engineer', 'II', 'Apt 914', 2, 1, 1, NULL, '2023-03-07 18:30:00', NULL),
(515, 'Abba Sudron', 'CPF0232892078', 'asudronc@comsenz.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1012217881', 'B3', 'Project Manager', 'IV', 'Room 1046', 2, 1, 1, NULL, '2023-06-18 18:30:00', NULL),
(516, 'Laurice Oleszcuk', 'CPF7933617244', 'loleszcukd@hostgator.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8055698822', 'E', 'Project Manager', 'Sr', 'PO Box 58164', 2, 1, 1, NULL, '2023-02-02 18:30:00', NULL),
(517, 'Sven Duffield', 'CPF3429206095', 'sduffielde@youtube.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2394688222', 'E1', 'Drilling engineer', 'Jr', 'PO Box 18875', 2, 1, 1, NULL, '2022-12-24 18:30:00', NULL),
(518, 'Marshal Guitel', 'CPF8896433549', 'mguitelf@china.com.cn', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9432867216', 'A2', 'Technicians', 'IV', 'Suite 74', 2, 1, 1, NULL, '2023-06-24 18:30:00', NULL),
(519, 'Andi Petrussi', 'CPF8973137214', 'apetrussig@cloudflare.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4776196859', 'E3', 'Energy engineer', 'IV', 'Apt 1270', 2, 1, 1, NULL, '2023-05-23 18:30:00', NULL),
(520, 'Max Aldwick', 'CPF4721302081', 'maldwickh@sphinn.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2652153240', 'A', 'Drilling engineer', 'II', '17th Floor', 2, 1, 1, NULL, '2023-03-11 18:30:00', NULL),
(521, 'Marlow Chidler', 'CPF1178303406', 'mchidleri@upenn.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3747220112', 'B', 'Mining engineer', 'IV', 'Room 158', 2, 1, 1, NULL, '2023-07-30 18:30:00', NULL),
(522, 'Tommy Bulbrook', 'CPF7299538697', 'tbulbrookj@state.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5869584411', 'E1', 'Drilling engineer', 'IV', '15th Floor', 2, 1, 1, NULL, '2023-01-21 18:30:00', NULL),
(523, 'Maryl Chazette', 'CPF9372002266', 'mchazettek@biglobe.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1752870944', 'E2', 'Energy engineer', 'IV', 'Suite 64', 2, 1, 1, NULL, '2023-07-10 18:30:00', NULL),
(524, 'Alidia Guillford', 'CPF5511513425', 'aguillfordl@twitpic.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8775524058', 'B', 'Energy engineer', 'III', 'Apt 1410', 2, 1, 1, NULL, '2023-09-11 18:30:00', NULL),
(525, 'Engelbert Anfusso', 'CPF7656442260', 'eanfussom@ihg.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3154331130', 'B1', 'Energy engineer', 'II', 'Apt 1158', 2, 1, 1, NULL, '2023-01-23 18:30:00', NULL),
(526, 'Talbert Chazier', 'CPF6956825661', 'tchaziern@si.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6796454899', 'B3', 'Mining engineer', 'Jr', 'Suite 37', 2, 1, 1, NULL, '2023-07-05 18:30:00', NULL),
(527, 'Licha Viles', 'CPF0665231336', 'lvileso@arizona.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4425312378', 'D', 'Mining engineer', 'Sr', 'Suite 42', 2, 1, 1, NULL, '2023-03-08 18:30:00', NULL),
(528, 'Reggie Cunney', 'CPF1949872270', 'rcunneyp@virginia.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8627231931', 'A', 'Energy engineer', 'III', 'Apt 1966', 2, 1, 1, NULL, '2023-01-12 18:30:00', NULL),
(529, 'Othello Hawthorne', 'CPF0573842791', 'ohawthorneq@ovh.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6282143792', 'E', 'Sales and Busines', 'II', 'Apt 221', 2, 1, 1, NULL, '2023-01-03 18:30:00', NULL),
(530, 'Noellyn McShirrie', 'CPF8604026493', 'nmcshirrier@google.com.hk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5079349448', 'D', 'Drilling engineer', 'Jr', 'Apt 1641', 2, 1, 1, NULL, '2023-05-30 18:30:00', NULL),
(531, 'Orlando Fosken', 'CPF9074782549', 'ofoskens@jalbum.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2204459691', 'E2', 'Energy engineer', 'III', 'PO Box 54758', 2, 1, 1, NULL, '2023-08-05 18:30:00', NULL),
(532, 'Buck Lanfere', 'CPF1792839534', 'blanferet@timesonline.co.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2678036267', 'A1', 'Energy engineer', 'II', 'Apt 1779', 2, 1, 1, NULL, '2023-09-19 18:30:00', NULL),
(533, 'Bondie Simeoli', 'CPF2757787114', 'bsimeoliu@pcworld.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5861579081', 'D', 'Sales and Busines', 'Jr', 'Apt 356', 2, 1, 1, NULL, '2023-04-11 18:30:00', NULL),
(534, 'Clint Hubner', 'CPF4902897500', 'chubnerv@uiuc.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4036642398', 'A1', 'Technicians', 'III', 'Apt 1034', 2, 1, 1, NULL, '2023-09-09 18:30:00', NULL),
(535, 'Rickie Pocke', 'CPF2525958066', 'rpockew@marketwatch.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3669020846', 'D', 'Mining engineer', 'Jr', '10th Floor', 2, 1, 1, NULL, '2022-09-28 18:30:00', NULL),
(536, 'Roxy Greatland', 'CPF9264426714', 'rgreatlandx@1688.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5651530578', 'A1', 'Technicians', 'Sr', 'PO Box 23625', 2, 1, 1, NULL, '2023-04-05 18:30:00', NULL),
(537, 'Sheeree Allsopp', 'CPF9585640532', 'sallsoppy@yellowbook.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4733191605', 'B3', 'Sales and Busines', 'II', 'Apt 483', 2, 1, 1, NULL, '2023-07-19 18:30:00', NULL),
(538, 'Esma Cashell', 'CPF9557688496', 'ecashellz@shop-pro.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9197818901', 'D', 'Technicians', 'II', 'Apt 1146', 2, 1, 1, NULL, '2023-02-22 18:30:00', NULL),
(539, 'Nanice De Antoni', 'CPF4229462288', 'nde10@tamu.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1281501155', 'A2', 'Sales and Busines', 'II', '2nd Floor', 2, 1, 1, NULL, '2023-03-31 18:30:00', NULL),
(540, 'Emanuele Ingree', 'CPF1714721444', 'eingree11@hatena.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5028520666', 'A1', 'Project Manager', 'IV', 'Apt 1786', 2, 1, 1, NULL, '2023-08-13 18:30:00', NULL),
(541, 'Arturo Jannex', 'CPF0380453815', 'ajannex12@zdnet.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8011004139', 'A1', 'Project Manager', 'Sr', 'Room 31', 2, 1, 1, NULL, '2022-10-13 18:30:00', NULL),
(542, 'Helaine Wein', 'CPF3019476484', 'hwein13@ucoz.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5958539860', 'D', 'Drilling engineer', 'III', 'Room 144', 2, 1, 1, NULL, '2023-09-20 18:30:00', NULL),
(543, 'Kirstyn Mackro', 'CPF8918997291', 'kmackro14@bloglovin.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2054319347', 'B3', 'Technicians', 'IV', 'Suite 50', 2, 1, 1, NULL, '2023-04-10 18:30:00', NULL),
(544, 'Dian Gallone', 'CPF4996214707', 'dgallone15@goo.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6393438244', 'E2', 'Mining engineer', 'Sr', 'Room 1284', 2, 1, 1, NULL, '2023-05-10 18:30:00', NULL),
(545, 'Jolene Teligin', 'CPF1476194497', 'jteligin16@drupal.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6395786497', 'B3', 'Mining engineer', 'II', 'Apt 73', 2, 1, 1, NULL, '2023-09-02 18:30:00', NULL),
(546, 'Virgina Ralphs', 'CPF3868853373', 'vralphs17@wikia.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3844955354', 'E', 'Energy engineer', 'III', 'Suite 98', 2, 1, 1, NULL, '2022-10-18 18:30:00', NULL),
(547, 'Dehlia Covell', 'CPF9024023843', 'dcovell18@about.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4695418309', 'B3', 'Energy engineer', 'II', '16th Floor', 2, 1, 1, NULL, '2023-05-21 18:30:00', NULL),
(548, 'Chastity Enterle', 'CPF9060436195', 'centerle19@jigsy.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7624354529', 'A1', 'Sales and Busines', 'Jr', 'PO Box 69098', 2, 1, 1, NULL, '2023-09-06 18:30:00', NULL),
(549, 'Burl Pargeter', 'CPF6317928648', 'bpargeter1a@springer.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1742895554', 'B1', 'Energy engineer', 'IV', '12th Floor', 2, 1, 1, NULL, '2023-02-02 18:30:00', NULL),
(550, 'Wolf Wasselin', 'CPF7845742105', 'wwasselin1b@studiopress.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7516716503', 'A2', 'Mining engineer', 'IV', 'PO Box 70048', 2, 1, 1, NULL, '2023-09-06 18:30:00', NULL),
(551, 'Bridie Dymock', 'CPF9231553270', 'bdymock1c@w3.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3443271596', 'E3', 'Mining engineer', 'IV', 'Apt 1486', 2, 1, 1, NULL, '2023-02-24 18:30:00', NULL),
(552, 'Thane Abercrombie', 'CPF1875704849', 'tabercrombie1d@ted.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2072559195', 'E2', 'Drilling engineer', 'Jr', 'Apt 75', 2, 1, 1, NULL, '2022-12-19 18:30:00', NULL),
(553, 'Elana Hurll', 'CPF5802712614', 'ehurll1e@artisteer.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6098955908', 'A2', 'Mining engineer', 'IV', 'Suite 23', 2, 1, 1, NULL, '2023-08-05 18:30:00', NULL),
(554, 'Ethan Bomb', 'CPF7104227861', 'ebomb1f@youku.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2266732094', 'E1', 'Sales and Busines', 'Jr', 'Room 1475', 2, 1, 1, NULL, '2022-10-04 18:30:00', NULL),
(555, 'Gunner Rachuig', 'CPF3199936570', 'grachuig1g@java.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1577149793', 'B2', 'Technicians', 'IV', 'PO Box 3937', 2, 1, 1, NULL, '2022-12-12 18:30:00', NULL),
(556, 'Aleece Gallego', 'CPF4858345662', 'agallego1h@aol.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9219558189', 'A', 'Project Manager', 'IV', 'PO Box 74078', 2, 1, 1, NULL, '2023-01-07 18:30:00', NULL),
(557, 'Denny Toffanelli', 'CPF7367414091', 'dtoffanelli1i@who.int', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5968734973', 'B3', 'Mining engineer', 'Sr', '11th Floor', 2, 1, 1, NULL, '2023-08-16 18:30:00', NULL),
(558, 'Richy Imorts', 'CPF9913965102', 'rimorts1j@wikia.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9322705880', 'E3', 'Technicians', 'IV', 'Apt 332', 2, 1, 1, NULL, '2022-12-20 18:30:00', NULL),
(559, 'Christean Slimme', 'CPF9043911059', 'cslimme1k@deliciousdays.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7503877633', 'B3', 'Drilling engineer', 'II', '14th Floor', 2, 1, 1, NULL, '2022-10-15 18:30:00', NULL),
(560, 'Bret Senn', 'CPF0666614204', 'bsenn1l@squarespace.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8919415147', 'A1', 'Technicians', 'Sr', 'Room 1410', 2, 1, 1, NULL, '2023-03-23 18:30:00', NULL),
(561, 'Sonni Kiebes', 'CPF1644361852', 'skiebes1m@weebly.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8438442223', 'E', 'Energy engineer', 'Sr', 'Room 581', 2, 1, 1, NULL, '2023-06-28 18:30:00', NULL),
(562, 'Waldo Kimbell', 'CPF3327262133', 'wkimbell1n@foxnews.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3944385082', 'B1', 'Energy engineer', 'Jr', '8th Floor', 2, 1, 1, NULL, '2023-05-25 18:30:00', NULL),
(563, 'Betta O\'Hickey', 'CPF8983261177', 'bohickey1o@tripadvisor.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6308859907', 'B2', 'Sales and Busines', 'Jr', 'Room 1351', 2, 1, 1, NULL, '2023-06-24 18:30:00', NULL),
(564, 'Adrianna Lulham', 'CPF9688240388', 'alulham1p@tinyurl.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3698137087', 'A', 'Technicians', 'II', 'Room 1976', 2, 1, 1, NULL, '2023-03-14 18:30:00', NULL),
(565, 'Thoma Crease', 'CPF6614622858', 'tcrease1q@eventbrite.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6476982178', 'C', 'Mining engineer', 'Jr', 'Apt 695', 2, 1, 1, NULL, '2023-08-26 18:30:00', NULL),
(566, 'Sidonnie Huddy', 'CPF0270915484', 'shuddy1r@chicagotribune.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4817831004', 'D', 'Drilling engineer', 'IV', 'Room 574', 2, 1, 1, NULL, '2022-11-01 18:30:00', NULL),
(567, 'Eilis Kasperski', 'CPF4414241813', 'ekasperski1s@imageshack.us', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3147087685', 'C', 'Drilling engineer', 'Sr', 'Apt 1165', 2, 1, 1, NULL, '2023-07-29 18:30:00', NULL),
(568, 'Sly Winham', 'CPF5387664360', 'swinham1t@typepad.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9483183593', 'A1', 'Mining engineer', 'Jr', 'Apt 681', 2, 1, 1, NULL, '2022-12-07 18:30:00', NULL),
(569, 'Cesare Giacopazzi', 'CPF6100319466', 'cgiacopazzi1u@seesaa.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3214278862', 'E3', 'Mining engineer', 'Jr', 'Suite 86', 2, 1, 1, NULL, '2023-06-02 18:30:00', NULL),
(570, 'Kimbra Avrahamy', 'CPF3889359663', 'kavrahamy1v@apache.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9055289251', 'B3', 'Energy engineer', 'II', 'Suite 60', 2, 1, 1, NULL, '2022-11-25 18:30:00', NULL),
(571, 'Juan Wilcinskis', 'CPF7070314362', 'jwilcinskis1w@tripod.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5552455033', 'A2', 'Drilling engineer', 'Jr', 'Room 839', 2, 1, 1, NULL, '2023-03-27 18:30:00', NULL),
(572, 'Dorolisa Vennings', 'CPF2370714906', 'dvennings1x@ameblo.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5085420844', 'E3', 'Mining engineer', 'III', 'PO Box 42963', 2, 1, 1, NULL, '2023-01-28 18:30:00', NULL),
(573, 'Arnold Pickworth', 'CPF4907962534', 'apickworth1y@gov.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7694953711', 'B2', 'Energy engineer', 'II', 'Suite 36', 2, 1, 1, NULL, '2023-05-06 18:30:00', NULL),
(574, 'Sawyer Figures', 'CPF1350284410', 'sfigures1z@ucoz.ru', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1224357031', 'A1', 'Project Manager', 'III', 'Suite 30', 2, 1, 1, NULL, '2022-12-08 18:30:00', NULL),
(575, 'Durant De Mattia', 'CPF7412678600', 'dde20@sakura.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3597827306', 'B3', 'Mining engineer', 'II', 'Room 1371', 2, 1, 1, NULL, '2023-02-06 18:30:00', NULL),
(576, 'Gerty Picheford', 'CPF9642324048', 'gpicheford21@tuttocitta.it', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7691129407', 'B', 'Energy engineer', 'III', '7th Floor', 2, 1, 1, NULL, '2023-04-23 18:30:00', NULL),
(577, 'Niles Noyes', 'CPF5231094715', 'nnoyes22@opera.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7404370655', 'E', 'Project Manager', 'Jr', 'Room 914', 2, 1, 1, NULL, '2023-04-14 18:30:00', NULL),
(578, 'Rosina Dicky', 'CPF3207882838', 'rdicky23@unblog.fr', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6338708570', 'B1', 'Energy engineer', 'Jr', 'Room 1255', 2, 1, 1, NULL, '2023-08-24 18:30:00', NULL),
(579, 'Brier Teers', 'CPF0380380840', 'bteers24@paypal.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7709196078', 'A1', 'Sales and Busines', 'III', 'Suite 18', 2, 1, 1, NULL, '2023-03-31 18:30:00', NULL),
(580, 'Lethia Gaitskill', 'CPF0604655146', 'lgaitskill25@howstuffworks.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4328530405', 'B1', 'Energy engineer', 'IV', 'Apt 815', 2, 1, 1, NULL, '2023-06-02 18:30:00', NULL),
(581, 'Ephrayim Cranage', 'CPF4082063116', 'ecranage26@cafepress.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3484252526', 'E2', 'Drilling engineer', 'IV', '12th Floor', 2, 1, 1, NULL, '2023-02-16 18:30:00', NULL),
(582, 'Gnni Lamping', 'CPF3327206662', 'glamping27@sogou.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4754341036', 'A1', 'Project Manager', 'II', 'PO Box 18170', 2, 1, 1, NULL, '2022-10-11 18:30:00', NULL),
(583, 'Mickey Goldsmith', 'CPF8105962302', 'mgoldsmith28@netscape.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4046839375', 'E2', 'Technicians', 'IV', 'Apt 1728', 2, 1, 1, NULL, '2022-12-21 18:30:00', NULL),
(584, 'Cad Heigold', 'CPF0608834009', 'cheigold29@ca.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2923001075', 'B2', 'Project Manager', 'III', 'Room 880', 2, 1, 1, NULL, '2023-07-30 18:30:00', NULL),
(585, 'Jere Francie', 'CPF6398546966', 'jfrancie2a@netlog.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5328715251', 'B', 'Mining engineer', 'Jr', 'Suite 95', 2, 1, 1, NULL, '2023-05-16 18:30:00', NULL),
(586, 'Wilhelm Antrim', 'CPF5039305957', 'wantrim2b@tamu.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9205960334', 'A2', 'Energy engineer', 'IV', 'Room 1993', 2, 1, 1, NULL, '2023-06-16 18:30:00', NULL),
(587, 'Chelsy Rosenstengel', 'CPF5325982766', 'crosenstengel2c@narod.ru', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8777737776', 'E2', 'Drilling engineer', 'III', 'Suite 14', 2, 1, 1, NULL, '2023-08-10 18:30:00', NULL),
(588, 'Pepe Seman', 'CPF5167327842', 'pseman2d@so-net.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5526056336', 'E2', 'Mining engineer', 'Jr', 'PO Box 91422', 2, 1, 1, NULL, '2023-02-25 18:30:00', NULL),
(589, 'Alvera Rubroe', 'CPF2975554395', 'arubroe2e@smugmug.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7239413926', 'A2', 'Mining engineer', 'Sr', 'Suite 28', 2, 1, 1, NULL, '2023-09-20 18:30:00', NULL),
(590, 'Aggi Loyndon', 'CPF3546583199', 'aloyndon2f@elpais.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5359624948', 'A1', 'Mining engineer', 'Sr', 'Apt 1365', 2, 1, 1, NULL, '2023-06-27 18:30:00', NULL),
(591, 'Emmet Androlli', 'CPF1168067062', 'eandrolli2g@yolasite.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1772481372', 'E', 'Drilling engineer', 'III', 'Apt 1448', 2, 1, 1, NULL, '2022-11-23 18:30:00', NULL),
(592, 'Toddy Baigent', 'CPF5653545816', 'tbaigent2h@blog.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2457696440', 'E1', 'Sales and Busines', 'III', 'PO Box 33923', 2, 1, 1, NULL, '2022-12-30 18:30:00', NULL),
(593, 'Alasdair Johncey', 'CPF5922217292', 'ajohncey2i@tmall.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1639652996', 'B', 'Technicians', 'IV', 'PO Box 10535', 2, 1, 1, NULL, '2023-03-01 18:30:00', NULL),
(594, 'Efrem Hinemoor', 'CPF5675610758', 'ehinemoor2j@gnu.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8633622251', 'B1', 'Project Manager', 'IV', 'Room 1711', 2, 1, 1, NULL, '2022-09-29 18:30:00', NULL),
(595, 'Agna Cooke', 'CPF8216837281', 'acooke2k@amazon.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5859532538', 'B3', 'Energy engineer', 'IV', 'Apt 1471', 2, 1, 1, NULL, '2023-06-08 18:30:00', NULL),
(596, 'Trevar Agerskow', 'CPF8177229584', 'tagerskow2l@google.co.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3441833816', 'A', 'Technicians', 'IV', '11th Floor', 2, 1, 1, NULL, '2023-03-12 18:30:00', NULL),
(597, 'Luigi Kopta', 'CPF4484296535', 'lkopta2m@go.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2684446799', 'D', 'Project Manager', 'Jr', 'Suite 7', 2, 1, 1, NULL, '2023-03-25 18:30:00', NULL),
(598, 'Davin Mougel', 'CPF3072890857', 'dmougel2n@networksolutions.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1709048042', 'E', 'Sales and Busines', 'IV', 'Room 1794', 2, 1, 1, NULL, '2022-11-20 18:30:00', NULL),
(599, 'Eward Wheelhouse', 'CPF7594990415', 'ewheelhouse2o@wunderground.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5578061361', 'E1', 'Sales and Busines', 'II', '5th Floor', 2, 1, 1, NULL, '2022-11-24 18:30:00', NULL),
(600, 'Bank Chase', 'CPF4190731762', 'bchase2p@dell.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3534964854', 'D', 'Sales and Busines', 'III', 'PO Box 96657', 2, 1, 1, NULL, '2022-11-17 18:30:00', NULL),
(601, 'Gilberte Leyzell', 'CPF5219819961', 'gleyzell2q@rakuten.co.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2816409482', 'B3', 'Energy engineer', 'Jr', '7th Floor', 2, 1, 1, NULL, '2022-11-03 18:30:00', NULL),
(602, 'Orazio Waterworth', 'CPF4283682893', 'owaterworth2r@flavors.me', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8077091464', 'E2', 'Sales and Busines', 'II', 'Apt 960', 2, 1, 1, NULL, '2023-07-15 18:30:00', NULL),
(603, 'Miltie Hartup', 'CPF6189262658', 'mhartup2s@csmonitor.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7778034670', 'E', 'Technicians', 'III', 'PO Box 13262', 2, 1, 1, NULL, '2023-03-23 18:30:00', NULL),
(604, 'Callida Chasney', 'CPF8685027647', 'cchasney2t@smugmug.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8663396753', 'B', 'Sales and Busines', 'Jr', 'Apt 1922', 2, 1, 1, NULL, '2022-11-30 18:30:00', NULL),
(605, 'Omero Franciottoi', 'CPF2766649590', 'ofranciottoi2u@netlog.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8703431573', 'B', 'Technicians', 'IV', 'Room 841', 2, 1, 1, NULL, '2022-10-05 18:30:00', NULL),
(606, 'Nicolai Corrin', 'CPF4105308168', 'ncorrin2v@loc.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8725721888', 'B2', 'Technicians', 'IV', '1st Floor', 2, 1, 1, NULL, '2022-11-14 18:30:00', NULL),
(607, 'Calvin Zavattieri', 'CPF5644203204', 'czavattieri2w@shareasale.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1293078967', 'E3', 'Sales and Busines', 'IV', 'PO Box 23898', 2, 1, 1, NULL, '2022-12-08 18:30:00', NULL),
(608, 'Kaia Vivers', 'CPF2545975705', 'kvivers2x@histats.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2605990045', 'A', 'Technicians', 'Jr', '3rd Floor', 2, 1, 1, NULL, '2022-11-03 18:30:00', NULL),
(609, 'Christen Stukings', 'CPF4125072307', 'cstukings2y@go.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1044727025', 'B1', 'Technicians', 'III', 'PO Box 48460', 2, 1, 1, NULL, '2023-05-17 18:30:00', NULL),
(610, 'Faunie Ducaen', 'CPF0849651533', 'fducaen2z@squidoo.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9152094072', 'E3', 'Energy engineer', 'Sr', 'Suite 18', 2, 1, 1, NULL, '2023-05-08 18:30:00', NULL),
(611, 'Joice Gilling', 'CPF0253244673', 'jgilling30@arstechnica.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7789619671', 'E3', 'Technicians', 'Jr', 'Suite 50', 2, 1, 1, NULL, '2022-10-10 18:30:00', NULL),
(612, 'Salem Charville', 'CPF8895061706', 'scharville31@tinyurl.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7605380077', 'E3', 'Energy engineer', 'IV', 'PO Box 72998', 2, 1, 1, NULL, '2023-08-26 18:30:00', NULL),
(613, 'Jed Gabbatt', 'CPF8567567474', 'jgabbatt32@xing.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5803008904', 'A', 'Energy engineer', 'IV', '20th Floor', 2, 1, 1, NULL, '2023-04-04 18:30:00', NULL),
(614, 'Angele Hartshorne', 'CPF0031871084', 'ahartshorne33@home.pl', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2794776827', 'E', 'Sales and Busines', 'II', 'PO Box 21815', 2, 1, 1, NULL, '2023-05-26 18:30:00', NULL),
(615, 'Laural Lakenden', 'CPF3862109905', 'llakenden34@washington.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7337718324', 'E2', 'Drilling engineer', 'III', 'PO Box 43651', 2, 1, 1, NULL, '2023-09-12 18:30:00', NULL),
(616, 'Aurthur Jagoe', 'CPF1374687306', 'ajagoe35@imageshack.us', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5744481349', 'A1', 'Energy engineer', 'II', 'PO Box 76603', 2, 1, 1, NULL, '2022-10-29 18:30:00', NULL),
(617, 'Clemens Greensted', 'CPF5202429709', 'cgreensted36@tinyurl.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5554143726', 'B1', 'Sales and Busines', 'Jr', 'PO Box 46875', 2, 1, 1, NULL, '2022-10-07 18:30:00', NULL),
(618, 'Sibeal Woodhead', 'CPF3965555142', 'swoodhead37@cpanel.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8369103320', 'B', 'Drilling engineer', 'III', 'Room 461', 2, 1, 1, NULL, '2022-10-19 18:30:00', NULL),
(619, 'Brandyn Blackborow', 'CPF6663609055', 'bblackborow38@usnews.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7476685775', 'A1', 'Sales and Busines', 'Jr', '10th Floor', 2, 1, 1, NULL, '2023-01-23 18:30:00', NULL),
(620, 'Rosetta Ferreiro', 'CPF0562329072', 'rferreiro39@tripadvisor.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3929832273', 'B1', 'Drilling engineer', 'Jr', '10th Floor', 2, 1, 1, NULL, '2023-04-13 18:30:00', NULL),
(621, 'Marcos Ducker', 'CPF9458427764', 'mducker3a@marketwatch.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4117420010', 'E1', 'Project Manager', 'Jr', 'Suite 55', 2, 1, 1, NULL, '2023-02-08 18:30:00', NULL),
(622, 'Akim Shieldon', 'CPF8650620347', 'ashieldon3b@twitpic.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8073760814', 'E2', 'Sales and Busines', 'IV', 'Suite 42', 2, 1, 1, NULL, '2023-09-19 18:30:00', NULL),
(623, 'Reynolds Salvidge', 'CPF4042960181', 'rsalvidge3c@oaic.gov.au', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8348231269', 'A', 'Sales and Busines', 'III', '2nd Floor', 2, 1, 1, NULL, '2023-03-27 18:30:00', NULL),
(624, 'Dody Dunaway', 'CPF6120225122', 'ddunaway3d@constantcontact.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8972730643', 'A2', 'Sales and Busines', 'Sr', 'PO Box 84099', 2, 1, 1, NULL, '2023-01-14 18:30:00', NULL),
(625, 'Skipper Wenden', 'CPF2442348684', 'swenden3e@usda.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9678478709', 'A', 'Project Manager', 'IV', '14th Floor', 2, 1, 1, NULL, '2023-05-04 18:30:00', NULL),
(626, 'Curtis Beades', 'CPF8866110181', 'cbeades3f@mozilla.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7101105615', 'B2', 'Technicians', 'Jr', 'PO Box 10731', 2, 1, 1, NULL, '2022-10-27 18:30:00', NULL),
(627, 'Marni Gulley', 'CPF7168714766', 'mgulley3g@comcast.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3145321475', 'E1', 'Sales and Busines', 'Jr', 'Apt 1600', 2, 1, 1, NULL, '2023-02-15 18:30:00', NULL),
(628, 'Cariotta Tonge', 'CPF5856310527', 'ctonge3h@printfriendly.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7878415651', 'B2', 'Project Manager', 'Jr', 'PO Box 90385', 2, 1, 1, NULL, '2023-07-15 18:30:00', NULL),
(629, 'Agnola Enoch', 'CPF1587807775', 'aenoch3i@ucla.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8737982955', 'A', 'Energy engineer', 'Jr', 'Suite 35', 2, 1, 1, NULL, '2023-07-07 18:30:00', NULL),
(630, 'Felike Rosenstock', 'CPF5716552341', 'frosenstock3j@dyndns.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2676522192', 'B', 'Technicians', 'Jr', 'PO Box 73677', 2, 1, 1, NULL, '2022-10-10 18:30:00', NULL),
(631, 'Karalee Manes', 'CPF3210869287', 'kmanes3k@usatoday.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3142154279', 'C', 'Energy engineer', 'IV', 'Apt 1408', 2, 1, 1, NULL, '2023-03-28 18:30:00', NULL),
(632, 'Marian Matton', 'CPF6122207964', 'mmatton3l@hud.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3828833516', 'A1', 'Energy engineer', 'III', 'Suite 5', 2, 1, 1, NULL, '2023-04-18 18:30:00', NULL),
(633, 'Jillayne Delahunty', 'CPF4385089353', 'jdelahunty3m@intel.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2086999757', 'D', 'Project Manager', 'Jr', 'Suite 75', 2, 1, 1, NULL, '2023-05-06 18:30:00', NULL),
(634, 'Page Maingot', 'CPF0802195355', 'pmaingot3n@examiner.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6475448379', 'A', 'Energy engineer', 'II', 'Room 398', 2, 1, 1, NULL, '2023-03-14 18:30:00', NULL),
(635, 'Denna Simmon', 'CPF8992114690', 'dsimmon3o@photobucket.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4599973442', 'B3', 'Project Manager', 'III', 'Apt 299', 2, 1, 1, NULL, '2022-11-07 18:30:00', NULL),
(636, 'Bealle Glanton', 'CPF1000096849', 'bglanton3p@stanford.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7622230343', 'E3', 'Technicians', 'II', 'Room 69', 2, 1, 1, NULL, '2022-11-05 18:30:00', NULL),
(637, 'Craig Harkus', 'CPF0247936387', 'charkus3q@accuweather.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8433220838', 'A2', 'Energy engineer', 'Jr', 'Apt 677', 2, 1, 1, NULL, '2022-11-06 18:30:00', NULL),
(638, 'Monika Ganny', 'CPF1652492270', 'mganny3r@printfriendly.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9574405489', 'E1', 'Mining engineer', 'IV', 'PO Box 32790', 2, 1, 1, NULL, '2023-04-10 18:30:00', NULL),
(639, 'Trumann Stoney', 'CPF9956392093', 'tstoney3s@imageshack.us', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3418213657', 'A2', 'Energy engineer', 'Jr', 'Suite 22', 2, 1, 1, NULL, '2022-10-18 18:30:00', NULL),
(640, 'Kimbell Keilty', 'CPF0934078117', 'kkeilty3t@admin.ch', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5531593568', 'B2', 'Technicians', 'Jr', 'Apt 1486', 2, 1, 1, NULL, '2023-05-10 18:30:00', NULL),
(641, 'Malinde O\'Howbane', 'CPF7331151043', 'mohowbane3u@indiegogo.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6279096555', 'B3', 'Mining engineer', 'Sr', 'Suite 71', 2, 1, 1, NULL, '2023-07-29 18:30:00', NULL),
(642, 'Wenda Provis', 'CPF3218455977', 'wprovis3v@nsw.gov.au', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2543150173', 'E', 'Mining engineer', 'IV', 'PO Box 31520', 2, 1, 1, NULL, '2023-02-10 18:30:00', NULL),
(643, 'Abelard Whorall', 'CPF3725929873', 'awhorall3w@craigslist.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7937594814', 'B2', 'Mining engineer', 'II', 'PO Box 5996', 2, 1, 1, NULL, '2023-06-12 18:30:00', NULL),
(644, 'Loydie Webby', 'CPF9319936227', 'lwebby3x@sogou.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3543428006', 'A1', 'Project Manager', 'IV', 'Suite 65', 2, 1, 1, NULL, '2022-11-04 18:30:00', NULL),
(645, 'Mada Rummings', 'CPF9672214518', 'mrummings3y@artisteer.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4269015613', 'E', 'Sales and Busines', 'Sr', 'Apt 880', 2, 1, 1, NULL, '2023-04-23 18:30:00', NULL),
(646, 'Loise Cottem', 'CPF0487728286', 'lcottem3z@ox.ac.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6394989859', 'A1', 'Drilling engineer', 'Jr', 'Suite 66', 2, 1, 1, NULL, '2023-04-29 18:30:00', NULL),
(647, 'Teador Hamner', 'CPF9545319395', 'thamner40@chron.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5312955929', 'B3', 'Mining engineer', 'Jr', 'Room 1946', 2, 1, 1, NULL, '2023-08-17 18:30:00', NULL),
(648, 'Saul Ianson', 'CPF9949632702', 'sianson41@twitpic.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1784144534', 'C', 'Project Manager', 'IV', 'Room 910', 2, 1, 1, NULL, '2023-09-16 18:30:00', NULL),
(649, 'Jaclyn Kindred', 'CPF0725901722', 'jkindred42@51.la', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2034295191', 'E1', 'Project Manager', 'Jr', 'Apt 1962', 2, 1, 1, NULL, '2023-01-23 18:30:00', NULL),
(650, 'Allianora Ruff', 'CPF7120158090', 'aruff43@e-recht24.de', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6747978528', 'A', 'Sales and Busines', 'Sr', 'Room 1257', 2, 1, 1, NULL, '2022-10-03 18:30:00', NULL),
(651, 'Dallon Hardern', 'CPF1090059238', 'dhardern44@nyu.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5614805122', 'E1', 'Mining engineer', 'Sr', '15th Floor', 2, 1, 1, NULL, '2023-07-21 18:30:00', NULL),
(652, 'Denny Demer', 'CPF2975964934', 'ddemer45@delicious.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5821113520', 'A', 'Drilling engineer', 'IV', 'Room 431', 2, 1, 1, NULL, '2023-05-14 18:30:00', NULL),
(653, 'Diana Oyley', 'CPF2045408494', 'doyley46@cnbc.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3061220508', 'B2', 'Technicians', 'IV', 'Room 327', 2, 1, 1, NULL, '2023-05-16 18:30:00', NULL),
(654, 'Christian Lindores', 'CPF3176413067', 'clindores47@cpanel.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7176946824', 'A1', 'Sales and Busines', 'II', '2nd Floor', 2, 1, 1, NULL, '2022-09-27 18:30:00', NULL),
(655, 'Sandra Quesne', 'CPF2752613758', 'squesne48@businesswire.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7514620839', 'D', 'Project Manager', 'Sr', 'Room 603', 2, 1, 1, NULL, '2023-09-16 18:30:00', NULL),
(656, 'Thaddeus Shinner', 'CPF8134967966', 'tshinner49@nih.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9962269829', 'E', 'Energy engineer', 'II', 'Room 457', 2, 1, 1, NULL, '2022-10-17 18:30:00', NULL),
(657, 'Jessica Aldren', 'CPF1184440987', 'jaldren4a@usnews.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3584084258', 'E1', 'Project Manager', 'IV', 'PO Box 39311', 2, 1, 1, NULL, '2023-08-08 18:30:00', NULL),
(658, 'Flory Faldoe', 'CPF9011478386', 'ffaldoe4b@fema.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4737625576', 'E', 'Project Manager', 'IV', 'Room 1667', 2, 1, 1, NULL, '2022-11-11 18:30:00', NULL),
(659, 'Arlen O\'Spellissey', 'CPF9354218476', 'aospellissey4c@myspace.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6771093535', 'E3', 'Sales and Busines', 'Jr', 'Room 718', 2, 1, 1, NULL, '2023-01-21 18:30:00', NULL),
(660, 'Crista Abson', 'CPF1939091562', 'cabson4d@ow.ly', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3601051646', 'C', 'Sales and Busines', 'Sr', 'PO Box 46870', 2, 1, 1, NULL, '2023-08-18 18:30:00', NULL),
(661, 'Avigdor Boulton', 'CPF9998111456', 'aboulton4e@yale.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1517331077', 'B', 'Energy engineer', 'Jr', 'Room 682', 2, 1, 1, NULL, '2023-06-18 18:30:00', NULL),
(662, 'Percy Mockett', 'CPF6242146392', 'pmockett4f@amazon.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3652511991', 'E3', 'Energy engineer', 'IV', 'PO Box 72017', 2, 1, 1, NULL, '2022-10-16 18:30:00', NULL),
(663, 'Ches Dingate', 'CPF1047634771', 'cdingate4g@mit.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2314383428', 'E2', 'Energy engineer', 'II', 'Room 869', 2, 1, 1, NULL, '2023-07-03 18:30:00', NULL),
(664, 'Vallie Jekyll', 'CPF8855599704', 'vjekyll4h@ucoz.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3141909609', 'A1', 'Technicians', 'III', 'PO Box 99184', 2, 1, 1, NULL, '2023-07-24 18:30:00', NULL),
(665, 'Curtice Edgley', 'CPF9929092388', 'cedgley4i@flavors.me', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7518629947', 'C', 'Sales and Busines', 'II', 'Room 1404', 2, 1, 1, NULL, '2023-08-02 18:30:00', NULL),
(666, 'Barrie Parzis', 'CPF8448634544', 'bparzis4j@weather.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7761106152', 'D', 'Technicians', 'IV', 'Room 31', 2, 1, 1, NULL, '2023-04-30 18:30:00', NULL),
(667, 'Christophorus Janosevic', 'CPF1363956094', 'cjanosevic4k@netscape.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1422461829', 'D', 'Project Manager', 'III', 'Suite 60', 2, 1, 1, NULL, '2023-01-21 18:30:00', NULL),
(668, 'Alika Godby', 'CPF1298935472', 'agodby4l@wired.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5736850327', 'D', 'Energy engineer', 'III', 'Suite 64', 2, 1, 1, NULL, '2023-04-21 18:30:00', NULL),
(669, 'Beatrice Lendrem', 'CPF9440906857', 'blendrem4m@msu.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3068346402', 'B1', 'Technicians', 'III', '5th Floor', 2, 1, 1, NULL, '2022-10-03 18:30:00', NULL),
(670, 'Malena Haker', 'CPF6131753303', 'mhaker4n@goodreads.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3903529224', 'E3', 'Mining engineer', 'II', 'Apt 1268', 2, 1, 1, NULL, '2022-12-12 18:30:00', NULL),
(671, 'Leandra Keuneke', 'CPF1041321052', 'lkeuneke4o@cargocollective.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3941332401', 'C', 'Project Manager', 'Jr', 'PO Box 27764', 2, 1, 1, NULL, '2023-08-15 18:30:00', NULL),
(672, 'Theresa Ceaplen', 'CPF8538897392', 'tceaplen4p@parallels.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3744456524', 'B3', 'Drilling engineer', 'II', 'Apt 1373', 2, 1, 1, NULL, '2023-04-24 18:30:00', NULL),
(673, 'Gabe Mattheeuw', 'CPF6343172646', 'gmattheeuw4q@dagondesign.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6727278733', 'E3', 'Project Manager', 'Jr', 'Room 1663', 2, 1, 1, NULL, '2023-04-03 18:30:00', NULL),
(674, 'Hetty Bruckent', 'CPF5769714171', 'hbruckent4r@mozilla.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2974693298', 'B1', 'Technicians', 'II', 'Suite 83', 2, 1, 1, NULL, '2023-08-27 18:30:00', NULL),
(675, 'Trixy Wadeling', 'CPF9137083779', 'twadeling4s@photobucket.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2994557618', 'E3', 'Mining engineer', 'III', '13th Floor', 2, 1, 1, NULL, '2022-12-25 18:30:00', NULL),
(676, 'Sherill Brentnall', 'CPF3578719788', 'sbrentnall4t@usgs.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1623058917', 'A2', 'Project Manager', 'III', 'PO Box 91336', 2, 1, 1, NULL, '2023-08-14 18:30:00', NULL),
(677, 'Starr Bramah', 'CPF1995315353', 'sbramah4u@vkontakte.ru', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1917589546', 'B2', 'Technicians', 'II', 'PO Box 40770', 2, 1, 1, NULL, '2023-07-02 18:30:00', NULL),
(678, 'Jory Dot', 'CPF4698838928', 'jdot4v@mozilla.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9774173310', 'A', 'Mining engineer', 'III', '4th Floor', 2, 1, 1, NULL, '2023-08-20 18:30:00', NULL),
(679, 'Melany Nucci', 'CPF3731683278', 'mnucci4w@google.es', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1371794198', 'B3', 'Technicians', 'Sr', 'Room 1134', 2, 1, 1, NULL, '2022-12-16 18:30:00', NULL),
(680, 'Shellie Mountfort', 'CPF4389252495', 'smountfort4x@theglobeandmail.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6569935354', 'E3', 'Drilling engineer', 'Jr', '7th Floor', 2, 1, 1, NULL, '2023-09-20 18:30:00', NULL),
(681, 'Nanete Bragge', 'CPF6377436216', 'nbragge4y@elegantthemes.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4303465051', 'B2', 'Drilling engineer', 'Sr', 'PO Box 10554', 2, 1, 1, NULL, '2023-04-13 18:30:00', NULL),
(682, 'Holden Coats', 'CPF2938803624', 'hcoats4z@instagram.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1419781264', 'C', 'Sales and Busines', 'IV', 'Apt 1840', 2, 1, 1, NULL, '2023-04-07 18:30:00', NULL),
(683, 'Amy Spurway', 'CPF8595651070', 'aspurway50@arizona.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5783167096', 'E1', 'Mining engineer', 'II', 'Suite 6', 2, 1, 1, NULL, '2023-09-10 18:30:00', NULL),
(684, 'Marijo Le Brun', 'CPF3507844211', 'mle51@nydailynews.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5082153195', 'E1', 'Energy engineer', 'Jr', '18th Floor', 2, 1, 1, NULL, '2023-04-14 18:30:00', NULL),
(685, 'Doralin Feake', 'CPF3919720294', 'dfeake52@tripadvisor.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7504034419', 'E', 'Mining engineer', 'Jr', 'Suite 36', 2, 1, 1, NULL, '2023-01-15 18:30:00', NULL),
(686, 'Chryste Penniall', 'CPF7092259155', 'cpenniall53@soundcloud.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3977355767', 'B', 'Drilling engineer', 'II', 'Apt 1954', 2, 1, 1, NULL, '2023-05-07 18:30:00', NULL),
(687, 'Derron Hearnaman', 'CPF0603488887', 'dhearnaman54@cisco.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3266536836', 'A', 'Mining engineer', 'II', 'Room 1600', 2, 1, 1, NULL, '2022-12-21 18:30:00', NULL),
(688, 'Petronille Ezzle', 'CPF1757318126', 'pezzle55@businessweek.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9686811496', 'E2', 'Energy engineer', 'II', 'PO Box 91021', 2, 1, 1, NULL, '2023-06-08 18:30:00', NULL),
(689, 'Orbadiah Milesap', 'CPF4632868766', 'omilesap56@ning.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1147368650', 'E', 'Sales and Busines', 'II', 'PO Box 93762', 2, 1, 1, NULL, '2023-03-27 18:30:00', NULL),
(690, 'Euell Arthars', 'CPF4773826738', 'earthars57@barnesandnoble.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6179954775', 'A', 'Project Manager', 'Jr', 'Room 1390', 2, 1, 1, NULL, '2023-04-06 18:30:00', NULL),
(691, 'Mickie Cleverly', 'CPF4343373369', 'mcleverly58@bloglines.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1858850082', 'B3', 'Sales and Busines', 'II', '10th Floor', 2, 1, 1, NULL, '2023-07-14 18:30:00', NULL),
(692, 'Greggory Spragg', 'CPF1693526879', 'gspragg59@sphinn.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7891189614', 'E1', 'Technicians', 'Sr', 'Suite 78', 2, 1, 1, NULL, '2022-11-16 18:30:00', NULL),
(693, 'Madelin Ledgard', 'CPF8684829966', 'mledgard5a@privacy.gov.au', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9014369388', 'B', 'Mining engineer', 'Jr', 'PO Box 88946', 2, 1, 1, NULL, '2022-10-10 18:30:00', NULL),
(694, 'Glynis Vido', 'CPF2150510755', 'gvido5b@bing.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8583435775', 'B3', 'Technicians', 'Jr', 'Room 1345', 2, 1, 1, NULL, '2023-07-06 18:30:00', NULL),
(695, 'Ermin Romi', 'CPF4297317084', 'eromi5c@google.it', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9352576894', 'E', 'Project Manager', 'IV', '10th Floor', 2, 1, 1, NULL, '2023-08-17 18:30:00', NULL),
(696, 'Ritchie Scobbie', 'CPF9794630381', 'rscobbie5d@google.es', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3653294806', 'E', 'Sales and Busines', 'II', '13th Floor', 2, 1, 1, NULL, '2023-06-02 18:30:00', NULL),
(697, 'Arther Alston', 'CPF5385231192', 'aalston5e@cam.ac.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7077685662', 'B1', 'Mining engineer', 'Sr', 'PO Box 26950', 2, 1, 1, NULL, '2023-06-24 18:30:00', NULL),
(698, 'Alisun Bisacre', 'CPF8450904198', 'abisacre5f@stanford.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3617094596', 'E', 'Technicians', 'Sr', 'Suite 37', 2, 1, 1, NULL, '2023-02-16 18:30:00', NULL),
(699, 'Reg Durnford', 'CPF8087190814', 'rdurnford5g@blogger.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5134424455', 'E', 'Energy engineer', 'Sr', 'Apt 1705', 2, 1, 1, NULL, '2023-01-24 18:30:00', NULL),
(700, 'Barbey Pecey', 'CPF0738104898', 'bpecey5h@mozilla.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4395165611', 'E3', 'Project Manager', 'Jr', 'Room 301', 2, 1, 1, NULL, '2022-10-25 18:30:00', NULL),
(701, 'Ronnie Dudbridge', 'CPF7437228155', 'rdudbridge5i@patch.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2959982487', 'B', 'Mining engineer', 'Jr', 'Room 1617', 2, 1, 1, NULL, '2023-07-24 18:30:00', NULL),
(702, 'Lora Rosenstock', 'CPF4360542526', 'lrosenstock5j@multiply.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3737825461', 'A2', 'Drilling engineer', 'II', '5th Floor', 2, 1, 1, NULL, '2023-08-22 18:30:00', NULL),
(703, 'Montague List', 'CPF0077725931', 'mlist5k@yellowbook.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5424990584', 'A2', 'Technicians', 'II', 'Suite 28', 2, 1, 1, NULL, '2022-10-31 18:30:00', NULL),
(704, 'Arlan McNair', 'CPF9045950665', 'amcnair5l@cnn.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3824552666', 'E3', 'Mining engineer', 'II', 'Apt 887', 2, 1, 1, NULL, '2023-09-26 18:30:00', NULL),
(705, 'Artemas O\' Markey', 'CPF0548065722', 'ao5m@gizmodo.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1607173208', 'E', 'Technicians', 'Jr', 'Room 522', 2, 1, 1, NULL, '2023-06-24 18:30:00', NULL),
(706, 'Othella McCosh', 'CPF6732560076', 'omccosh5n@nhs.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3652391799', 'E2', 'Drilling engineer', 'Sr', 'Suite 32', 2, 1, 1, NULL, '2023-08-17 18:30:00', NULL),
(707, 'Scarlet Hardy-Piggin', 'CPF5977290192', 'shardypiggin5o@flickr.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4149033151', 'B1', 'Energy engineer', 'Jr', 'Room 1840', 2, 1, 1, NULL, '2023-01-28 18:30:00', NULL),
(708, 'Patty Skilton', 'CPF8122387321', 'pskilton5p@ning.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3849994017', 'E2', 'Energy engineer', 'Sr', 'Room 716', 2, 1, 1, NULL, '2023-09-21 18:30:00', NULL),
(709, 'Ethelin Swannick', 'CPF3956640437', 'eswannick5q@discovery.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1082939156', 'B3', 'Technicians', 'IV', 'PO Box 26662', 2, 1, 1, NULL, '2023-01-11 18:30:00', NULL);
INSERT INTO `users` (`id`, `name`, `cpf_no`, `email`, `email_verified_at`, `password`, `mobile`, `level`, `designation`, `category`, `location`, `user_type`, `actv_status`, `create_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(710, 'Tawnya Ivashechkin', 'CPF1754467950', 'tivashechkin5r@china.com.cn', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8641301193', 'E2', 'Sales and Busines', 'IV', 'Suite 81', 2, 1, 1, NULL, '2023-05-12 18:30:00', NULL),
(711, 'Gratia Yesenev', 'CPF6603091907', 'gyesenev5s@tinypic.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2412937670', 'E3', 'Drilling engineer', 'IV', 'PO Box 1168', 2, 1, 1, NULL, '2022-10-17 18:30:00', NULL),
(712, 'Brannon Sains', 'CPF3093708595', 'bsains5t@oaic.gov.au', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6289332619', 'B1', 'Sales and Busines', 'IV', 'Suite 39', 2, 1, 1, NULL, '2023-06-07 18:30:00', NULL),
(713, 'Mendie Vinker', 'CPF2170779090', 'mvinker5u@chron.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3754771349', 'B2', 'Sales and Busines', 'II', 'Suite 94', 2, 1, 1, NULL, '2023-08-17 18:30:00', NULL),
(714, 'Ambrosius Caddie', 'CPF6505844046', 'acaddie5v@army.mil', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8883070448', 'C', 'Mining engineer', 'III', 'Apt 1561', 2, 1, 1, NULL, '2023-08-07 18:30:00', NULL),
(715, 'Augusta Stroder', 'CPF9647831160', 'astroder5w@umn.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8122427635', 'D', 'Drilling engineer', 'Jr', 'Suite 100', 2, 1, 1, NULL, '2022-11-25 18:30:00', NULL),
(716, 'Rriocard Sawdon', 'CPF9422849668', 'rsawdon5x@adobe.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5796847803', 'B2', 'Sales and Busines', 'II', '13th Floor', 2, 1, 1, NULL, '2023-08-02 18:30:00', NULL),
(717, 'Mel Knotton', 'CPF5239499915', 'mknotton5y@webs.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6013780346', 'A', 'Sales and Busines', 'III', 'Apt 449', 2, 1, 1, NULL, '2023-08-13 18:30:00', NULL),
(718, 'Kimberley Heaviside', 'CPF4279413585', 'kheaviside5z@wiley.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9964582851', 'B', 'Project Manager', 'III', '6th Floor', 2, 1, 1, NULL, '2023-02-14 18:30:00', NULL),
(719, 'Cherey Hamil', 'CPF9725429002', 'chamil60@opensource.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7222202320', 'D', 'Energy engineer', 'Jr', '2nd Floor', 2, 1, 1, NULL, '2022-09-29 18:30:00', NULL),
(720, 'Lyle Furneaux', 'CPF0067400398', 'lfurneaux61@pbs.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5423023814', 'C', 'Sales and Busines', 'IV', 'Suite 74', 2, 1, 1, NULL, '2023-08-13 18:30:00', NULL),
(721, 'Wang Mora', 'CPF1943310370', 'wmora62@google.com.au', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5465658142', 'B3', 'Sales and Busines', 'IV', 'Suite 29', 2, 1, 1, NULL, '2022-12-11 18:30:00', NULL),
(722, 'Farley Skehan', 'CPF9572067184', 'fskehan63@google.co.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9208709250', 'B2', 'Energy engineer', 'Sr', 'Apt 1201', 2, 1, 1, NULL, '2023-07-19 18:30:00', NULL),
(723, 'Aleksandr Semeniuk', 'CPF0639872514', 'asemeniuk64@un.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1814072983', 'C', 'Technicians', 'IV', 'Apt 1395', 2, 1, 1, NULL, '2022-12-22 18:30:00', NULL),
(724, 'Malinda Joannic', 'CPF6589049243', 'mjoannic65@webs.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9623770853', 'E', 'Energy engineer', 'IV', 'Room 1654', 2, 1, 1, NULL, '2022-11-06 18:30:00', NULL),
(725, 'Herminia Mainstone', 'CPF7484230840', 'hmainstone66@biblegateway.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6776748464', 'C', 'Project Manager', 'Sr', 'Suite 81', 2, 1, 1, NULL, '2023-04-07 18:30:00', NULL),
(726, 'Artemas Kordova', 'CPF8157109498', 'akordova67@tuttocitta.it', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8559198210', 'E1', 'Technicians', 'II', 'Suite 18', 2, 1, 1, NULL, '2023-03-19 18:30:00', NULL),
(727, 'Francesca Koopman', 'CPF7217314959', 'fkoopman68@dailymail.co.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1479940432', 'D', 'Energy engineer', 'III', 'Suite 66', 2, 1, 1, NULL, '2022-10-14 18:30:00', NULL),
(728, 'Victor di Rocca', 'CPF7112328735', 'vdi69@amazon.de', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7064755149', 'B1', 'Technicians', 'IV', 'Suite 97', 2, 1, 1, NULL, '2022-10-22 18:30:00', NULL),
(729, 'Barbe Reeme', 'CPF1568079746', 'breeme6a@dell.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6144302660', 'E1', 'Energy engineer', 'Jr', 'Suite 12', 2, 1, 1, NULL, '2023-07-26 18:30:00', NULL),
(730, 'Jami Egarr', 'CPF8590757907', 'jegarr6b@nba.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4414666222', 'B2', 'Project Manager', 'IV', '3rd Floor', 2, 1, 1, NULL, '2023-09-16 18:30:00', NULL),
(731, 'Iosep Braidwood', 'CPF7230340919', 'ibraidwood6c@mail.ru', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9039239502', 'A1', 'Mining engineer', 'II', 'PO Box 43493', 2, 1, 1, NULL, '2023-05-03 18:30:00', NULL),
(732, 'Allissa Skeemer', 'CPF3651093443', 'askeemer6d@toplist.cz', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8823634293', 'E', 'Drilling engineer', 'III', 'PO Box 82495', 2, 1, 1, NULL, '2023-06-09 18:30:00', NULL),
(733, 'Nicky Whild', 'CPF7172751803', 'nwhild6e@skype.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3865410605', 'E2', 'Project Manager', 'Sr', 'PO Box 59647', 2, 1, 1, NULL, '2023-02-27 18:30:00', NULL),
(734, 'Annalise Campelli', 'CPF0819949988', 'acampelli6f@xing.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5722158715', 'E1', 'Technicians', 'Sr', 'PO Box 30241', 2, 1, 1, NULL, '2023-05-15 18:30:00', NULL),
(735, 'Ingemar Senchenko', 'CPF2789844459', 'isenchenko6g@ihg.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5716530371', 'E1', 'Project Manager', 'Jr', 'Room 1262', 2, 1, 1, NULL, '2023-04-27 18:30:00', NULL),
(736, 'Parker Chantillon', 'CPF0071739014', 'pchantillon6h@yellowpages.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8148473368', 'E2', 'Sales and Busines', 'Sr', 'Suite 37', 2, 1, 1, NULL, '2022-11-30 18:30:00', NULL),
(737, 'Mehetabel Seelbach', 'CPF8104569185', 'mseelbach6i@histats.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9436334950', 'A2', 'Project Manager', 'III', 'Apt 1495', 2, 1, 1, NULL, '2023-08-08 18:30:00', NULL),
(738, 'Vera Licciardi', 'CPF3750553292', 'vlicciardi6j@cpanel.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1243871840', 'A1', 'Project Manager', 'Sr', 'PO Box 29941', 2, 1, 1, NULL, '2022-12-06 18:30:00', NULL),
(739, 'Trina Whellams', 'CPF7046721927', 'twhellams6k@reuters.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1221626822', 'E2', 'Sales and Busines', 'Sr', 'Apt 1487', 2, 1, 1, NULL, '2023-05-01 18:30:00', NULL),
(740, 'Pearline Extill', 'CPF3651820726', 'pextill6l@cloudflare.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9164771154', 'A', 'Technicians', 'IV', 'Room 996', 2, 1, 1, NULL, '2023-04-12 18:30:00', NULL),
(741, 'Aubine Skeats', 'CPF2701784421', 'askeats6m@cocolog-nifty.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2438422045', 'E', 'Energy engineer', 'III', 'PO Box 25095', 2, 1, 1, NULL, '2022-10-18 18:30:00', NULL),
(742, 'Teressa Gurg', 'CPF3348694902', 'tgurg6n@nationalgeographic.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8538948075', 'E2', 'Drilling engineer', 'IV', 'Room 1486', 2, 1, 1, NULL, '2022-10-08 18:30:00', NULL),
(743, 'Geraldine Dalbey', 'CPF3954559869', 'gdalbey6o@ted.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3119751125', 'C', 'Sales and Busines', 'Sr', 'Apt 442', 2, 1, 1, NULL, '2022-10-22 18:30:00', NULL),
(744, 'Dorolice Presdee', 'CPF9213260025', 'dpresdee6p@businessinsider.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8148903141', 'A1', 'Sales and Busines', 'Jr', 'PO Box 15113', 2, 1, 1, NULL, '2023-01-23 18:30:00', NULL),
(745, 'Townie Kenealy', 'CPF7181547650', 'tkenealy6q@eepurl.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3821658819', 'A2', 'Technicians', 'Jr', '1st Floor', 2, 1, 1, NULL, '2023-09-04 18:30:00', NULL),
(746, 'Lenka Bevir', 'CPF1196390187', 'lbevir6r@sun.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4965483368', 'B', 'Energy engineer', 'Jr', '14th Floor', 2, 1, 1, NULL, '2023-04-07 18:30:00', NULL),
(747, 'Wilhelmine Basketter', 'CPF5431277422', 'wbasketter6s@uiuc.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8429072716', 'A2', 'Energy engineer', 'Sr', '2nd Floor', 2, 1, 1, NULL, '2023-06-01 18:30:00', NULL),
(748, 'Bamby Paish', 'CPF8253771869', 'bpaish6t@who.int', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4355885685', 'B', 'Drilling engineer', 'III', 'PO Box 44792', 2, 1, 1, NULL, '2023-06-05 18:30:00', NULL),
(749, 'Kurtis Back', 'CPF7643969335', 'kback6u@ox.ac.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9947791961', 'E1', 'Energy engineer', 'II', 'Room 790', 2, 1, 1, NULL, '2023-07-23 18:30:00', NULL),
(750, 'Monroe Petrushanko', 'CPF7824484599', 'mpetrushanko6v@list-manage.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4099240914', 'A', 'Technicians', 'Sr', 'Apt 30', 2, 1, 1, NULL, '2022-10-15 18:30:00', NULL),
(751, 'Adey Roxbrough', 'CPF0963005776', 'aroxbrough6w@technorati.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5303818564', 'E', 'Sales and Busines', 'Sr', 'Suite 91', 2, 1, 1, NULL, '2023-08-05 18:30:00', NULL),
(752, 'Lydia Weepers', 'CPF5499938710', 'lweepers6x@squarespace.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4037005696', 'A', 'Technicians', 'Jr', '17th Floor', 2, 1, 1, NULL, '2023-09-09 18:30:00', NULL),
(753, 'Maribeth Hoult', 'CPF9451694406', 'mhoult6y@biglobe.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2884904100', 'B1', 'Project Manager', 'Jr', 'PO Box 85908', 2, 1, 1, NULL, '2022-11-23 18:30:00', NULL),
(754, 'Nerita Rash', 'CPF1239400946', 'nrash6z@umich.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7132863218', 'C', 'Sales and Busines', 'III', 'Suite 79', 2, 1, 1, NULL, '2023-07-29 18:30:00', NULL),
(755, 'Tabor Garside', 'CPF8733548923', 'tgarside70@theatlantic.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4979707750', 'E3', 'Energy engineer', 'IV', '19th Floor', 2, 1, 1, NULL, '2023-09-07 18:30:00', NULL),
(756, 'Arthur Esome', 'CPF9781972496', 'aesome71@bluehost.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2391959743', 'E1', 'Drilling engineer', 'III', 'Suite 27', 2, 1, 1, NULL, '2023-07-15 18:30:00', NULL),
(757, 'Fan Hedderly', 'CPF2496551658', 'fhedderly72@yelp.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6061373802', 'E3', 'Project Manager', 'IV', 'Apt 93', 2, 1, 1, NULL, '2022-12-26 18:30:00', NULL),
(758, 'Roddie Quartermain', 'CPF5070225655', 'rquartermain73@huffingtonpost.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5374172737', 'D', 'Technicians', 'IV', '15th Floor', 2, 1, 1, NULL, '2023-02-27 18:30:00', NULL),
(759, 'Angelina Burg', 'CPF3879921125', 'aburg74@unblog.fr', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3162126877', 'B1', 'Mining engineer', 'Sr', 'PO Box 8670', 2, 1, 1, NULL, '2022-12-10 18:30:00', NULL),
(760, 'Ellis McGarahan', 'CPF4016607239', 'emcgarahan75@msn.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8908499495', 'A2', 'Energy engineer', 'IV', '17th Floor', 2, 1, 1, NULL, '2022-11-18 18:30:00', NULL),
(761, 'Milissent Oldacres', 'CPF4001517375', 'moldacres76@theguardian.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6838164433', 'E2', 'Mining engineer', 'Sr', 'PO Box 52692', 2, 1, 1, NULL, '2023-07-13 18:30:00', NULL),
(762, 'Gypsy Pelfer', 'CPF6262625787', 'gpelfer77@harvard.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3359054121', 'E', 'Sales and Busines', 'Sr', 'PO Box 11170', 2, 1, 1, NULL, '2023-05-11 18:30:00', NULL),
(763, 'Adrianne Castilljo', 'CPF7748353539', 'acastilljo78@va.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7501476316', 'A1', 'Drilling engineer', 'IV', 'Apt 1728', 2, 1, 1, NULL, '2022-11-04 18:30:00', NULL),
(764, 'Glynda Impey', 'CPF8249005589', 'gimpey79@slideshare.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7393236365', 'B2', 'Energy engineer', 'III', 'Room 43', 2, 1, 1, NULL, '2023-02-23 18:30:00', NULL),
(765, 'Jozef Feldbrin', 'CPF2610434002', 'jfeldbrin7a@sbwire.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9121397386', 'E1', 'Energy engineer', 'III', 'PO Box 2405', 2, 1, 1, NULL, '2023-02-19 18:30:00', NULL),
(766, 'Kennie Kingswoode', 'CPF3559659648', 'kkingswoode7b@infoseek.co.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9048571831', 'C', 'Drilling engineer', 'Sr', '16th Floor', 2, 1, 1, NULL, '2023-03-26 18:30:00', NULL),
(767, 'Nicolais Stummeyer', 'CPF2718604452', 'nstummeyer7c@privacy.gov.au', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4391029223', 'B1', 'Sales and Busines', 'Sr', 'PO Box 70766', 2, 1, 1, NULL, '2023-04-12 18:30:00', NULL),
(768, 'Clemmy Fursse', 'CPF2475200261', 'cfursse7d@businessweek.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1774860417', 'B', 'Drilling engineer', 'Sr', 'PO Box 96703', 2, 1, 1, NULL, '2023-08-20 18:30:00', NULL),
(769, 'Carilyn Causbey', 'CPF6073372897', 'ccausbey7e@chronoengine.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9451134076', 'A1', 'Mining engineer', 'Jr', '13th Floor', 2, 1, 1, NULL, '2023-08-12 18:30:00', NULL),
(770, 'Maritsa Martinot', 'CPF9325178574', 'mmartinot7f@skype.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5787909103', 'E3', 'Technicians', 'Jr', 'Room 487', 2, 1, 1, NULL, '2022-12-25 18:30:00', NULL),
(771, 'Dulcia Beeckx', 'CPF3771502605', 'dbeeckx7g@nytimes.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2544473545', 'B', 'Technicians', 'II', 'Suite 25', 2, 1, 1, NULL, '2023-07-03 18:30:00', NULL),
(772, 'Veronika Orange', 'CPF6784385479', 'vorange7h@chron.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1042247229', 'B', 'Project Manager', 'IV', '7th Floor', 2, 1, 1, NULL, '2022-10-14 18:30:00', NULL),
(773, 'Ivie O\'Hengerty', 'CPF9650129062', 'iohengerty7i@engadget.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6603207619', 'B', 'Energy engineer', 'Sr', 'PO Box 40344', 2, 1, 1, NULL, '2023-04-12 18:30:00', NULL),
(774, 'Marena Clell', 'CPF5818148965', 'mclell7j@posterous.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1411188353', 'D', 'Project Manager', 'II', 'Room 1971', 2, 1, 1, NULL, '2022-12-11 18:30:00', NULL),
(775, 'Arnuad Wareham', 'CPF6043331772', 'awareham7k@altervista.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4305623300', 'B2', 'Energy engineer', 'Jr', 'PO Box 22977', 2, 1, 1, NULL, '2023-08-14 18:30:00', NULL),
(776, 'Bronnie Hortop', 'CPF9745550149', 'bhortop7l@sitemeter.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9844621042', 'E1', 'Project Manager', 'Jr', 'Suite 85', 2, 1, 1, NULL, '2022-11-21 18:30:00', NULL),
(777, 'Norrie Shakelade', 'CPF5177628193', 'nshakelade7m@alibaba.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9859179576', 'E3', 'Mining engineer', 'Jr', 'Suite 92', 2, 1, 1, NULL, '2023-05-24 18:30:00', NULL),
(778, 'Wendall Jack', 'CPF0316751268', 'wjack7n@smugmug.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5036316627', 'E2', 'Sales and Busines', 'Sr', 'Room 881', 2, 1, 1, NULL, '2023-01-21 18:30:00', NULL),
(779, 'Janaye Benazet', 'CPF6039751308', 'jbenazet7o@cdc.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8295827135', 'B', 'Technicians', 'III', '2nd Floor', 2, 1, 1, NULL, '2023-01-25 18:30:00', NULL),
(780, 'Marwin Streight', 'CPF1440402068', 'mstreight7p@yellowbook.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2209569697', 'C', 'Energy engineer', 'Jr', '1st Floor', 2, 1, 1, NULL, '2023-08-24 18:30:00', NULL),
(781, 'Cobb Willes', 'CPF1693025955', 'cwilles7q@myspace.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9742326211', 'A2', 'Energy engineer', 'III', 'Room 1329', 2, 1, 1, NULL, '2023-01-04 18:30:00', NULL),
(782, 'Ashlin Goublier', 'CPF3501703461', 'agoublier7r@huffingtonpost.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1411079740', 'A', 'Energy engineer', 'II', 'PO Box 15002', 2, 1, 1, NULL, '2023-09-19 18:30:00', NULL),
(783, 'Crissie Bagenal', 'CPF6747542522', 'cbagenal7s@wisc.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8886791838', 'A', 'Energy engineer', 'Sr', 'Room 1308', 2, 1, 1, NULL, '2023-03-12 18:30:00', NULL),
(784, 'Mitzi Ceci', 'CPF5506040260', 'mceci7t@independent.co.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3173142994', 'B', 'Technicians', 'III', 'Apt 446', 2, 1, 1, NULL, '2023-04-18 18:30:00', NULL),
(785, 'Malinda Castello', 'CPF2768498495', 'mcastello7u@techcrunch.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1081985818', 'E1', 'Drilling engineer', 'II', 'Apt 1482', 2, 1, 1, NULL, '2023-01-20 18:30:00', NULL),
(786, 'Zorina Grimwade', 'CPF4851946351', 'zgrimwade7v@furl.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9031905162', 'B', 'Sales and Busines', 'II', 'Suite 85', 2, 1, 1, NULL, '2023-05-03 18:30:00', NULL),
(787, 'Elfreda Dron', 'CPF4106392502', 'edron7w@skype.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7608630870', 'B1', 'Mining engineer', 'IV', '4th Floor', 2, 1, 1, NULL, '2023-01-23 18:30:00', NULL),
(788, 'Bobbe Dionisii', 'CPF7495393235', 'bdionisii7x@chicagotribune.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2469375614', 'E3', 'Project Manager', 'IV', 'PO Box 56113', 2, 1, 1, NULL, '2022-10-11 18:30:00', NULL),
(789, 'Ariela Annice', 'CPF2891600992', 'aannice7y@ocn.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1053835026', 'B2', 'Energy engineer', 'Sr', 'Apt 1250', 2, 1, 1, NULL, '2023-09-13 18:30:00', NULL),
(790, 'Colver Poole', 'CPF3861180823', 'cpoole7z@nymag.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7275896490', 'A', 'Sales and Busines', 'II', 'Apt 78', 2, 1, 1, NULL, '2022-09-28 18:30:00', NULL),
(791, 'Zsa zsa Passey', 'CPF6163312566', 'zzsa80@ucsd.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7754374740', 'A1', 'Mining engineer', 'Sr', '10th Floor', 2, 1, 1, NULL, '2022-10-20 18:30:00', NULL),
(792, 'Kelila Gooddy', 'CPF4407617468', 'kgooddy81@ehow.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7181301800', 'A', 'Mining engineer', 'Sr', 'Room 36', 2, 1, 1, NULL, '2022-11-12 18:30:00', NULL),
(793, 'Shaylyn Kegg', 'CPF9006883356', 'skegg82@irs.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3479149995', 'E1', 'Energy engineer', 'III', '6th Floor', 2, 1, 1, NULL, '2023-02-07 18:30:00', NULL),
(794, 'Leilah Darree', 'CPF2791888840', 'ldarree83@imdb.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1754535280', 'B2', 'Project Manager', 'IV', 'PO Box 9267', 2, 1, 1, NULL, '2023-09-07 18:30:00', NULL),
(795, 'Daphne Dowsett', 'CPF7344652131', 'ddowsett84@unblog.fr', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7236107925', 'E1', 'Drilling engineer', 'II', '17th Floor', 2, 1, 1, NULL, '2023-01-18 18:30:00', NULL),
(796, 'Tiler Davioud', 'CPF3049297230', 'tdavioud85@ycombinator.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5688472997', 'C', 'Project Manager', 'II', 'Apt 1968', 2, 1, 1, NULL, '2023-03-26 18:30:00', NULL),
(797, 'Lu Haylock', 'CPF1366857466', 'lhaylock86@spotify.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3084477341', 'B1', 'Drilling engineer', 'II', '15th Floor', 2, 1, 1, NULL, '2022-12-13 18:30:00', NULL),
(798, 'Gwenni Beatty', 'CPF2817653318', 'gbeatty87@nhs.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2369950789', 'E1', 'Technicians', 'IV', 'Room 1824', 2, 1, 1, NULL, '2023-06-22 18:30:00', NULL),
(799, 'Omar Dericut', 'CPF8970861912', 'odericut88@tinyurl.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6604147424', 'C', 'Mining engineer', 'Jr', 'Suite 7', 2, 1, 1, NULL, '2023-02-24 18:30:00', NULL),
(800, 'Johannes Dhenin', 'CPF8132986698', 'jdhenin89@prnewswire.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5484772066', 'E1', 'Drilling engineer', 'IV', '16th Floor', 2, 1, 1, NULL, '2023-07-26 18:30:00', NULL),
(801, 'Shannen Henriquet', 'CPF3466493816', 'shenriquet8a@furl.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2935150842', 'E1', 'Technicians', 'Jr', '20th Floor', 2, 1, 1, NULL, '2023-04-30 18:30:00', NULL),
(802, 'Ky Ralphs', 'CPF2261984250', 'kralphs8b@ibm.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9997338541', 'B', 'Technicians', 'III', 'Suite 38', 2, 1, 1, NULL, '2022-12-08 18:30:00', NULL),
(803, 'Orazio Roberti', 'CPF5644656539', 'oroberti8c@mapquest.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9483424634', 'C', 'Mining engineer', 'Sr', 'Suite 31', 2, 1, 1, NULL, '2023-06-15 18:30:00', NULL),
(804, 'Sonnnie Garbott', 'CPF9741592154', 'sgarbott8d@accuweather.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6923489535', 'A', 'Technicians', 'III', 'Suite 2', 2, 1, 1, NULL, '2022-10-04 18:30:00', NULL),
(805, 'Boyce Denziloe', 'CPF1496572911', 'bdenziloe8e@bbb.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5323462620', 'C', 'Technicians', 'IV', 'Suite 10', 2, 1, 1, NULL, '2023-05-26 18:30:00', NULL),
(806, 'Lefty Steed', 'CPF8338634938', 'lsteed8f@google.com.au', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5346765551', 'E', 'Sales and Busines', 'Sr', 'Apt 703', 2, 1, 1, NULL, '2022-11-11 18:30:00', NULL),
(807, 'Farleigh Linggood', 'CPF1106099284', 'flinggood8g@goo.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6906303713', 'A1', 'Technicians', 'II', 'Room 1878', 2, 1, 1, NULL, '2022-12-27 18:30:00', NULL),
(808, 'Sheri Dover', 'CPF3786916046', 'sdover8h@admin.ch', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5873469548', 'E', 'Project Manager', 'Jr', 'Room 69', 2, 1, 1, NULL, '2023-09-12 18:30:00', NULL),
(809, 'Cy Dumbelton', 'CPF0334948171', 'cdumbelton8i@51.la', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5219731311', 'A', 'Project Manager', 'II', 'Room 1030', 2, 1, 1, NULL, '2023-01-26 18:30:00', NULL),
(810, 'Phillis Langelaan', 'CPF1296203776', 'plangelaan8j@google.co.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3891931747', 'D', 'Sales and Busines', 'II', 'PO Box 54603', 2, 1, 1, NULL, '2023-03-18 18:30:00', NULL),
(811, 'Rodd Aberdein', 'CPF3645496144', 'raberdein8k@woothemes.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5133622502', 'A1', 'Technicians', 'IV', 'Suite 78', 2, 1, 1, NULL, '2022-12-02 18:30:00', NULL),
(812, 'Fonzie Sifleet', 'CPF5726836754', 'fsifleet8l@who.int', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9749632706', 'C', 'Sales and Busines', 'Sr', 'Apt 1638', 2, 1, 1, NULL, '2023-03-13 18:30:00', NULL),
(813, 'Brantley McCuffie', 'CPF1614810625', 'bmccuffie8m@pinterest.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9182174526', 'B3', 'Technicians', 'II', 'Apt 158', 2, 1, 1, NULL, '2022-11-22 18:30:00', NULL),
(814, 'Alyssa Bowes', 'CPF8363379624', 'abowes8n@plala.or.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8556570678', 'E1', 'Energy engineer', 'IV', 'Room 299', 2, 1, 1, NULL, '2022-11-22 18:30:00', NULL),
(815, 'Babette Breckell', 'CPF5960410350', 'bbreckell8o@usatoday.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4703420280', 'A2', 'Mining engineer', 'III', 'Apt 1679', 2, 1, 1, NULL, '2023-08-15 18:30:00', NULL),
(816, 'Dayna Birdsall', 'CPF0641307384', 'dbirdsall8p@cdc.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6803856804', 'B1', 'Energy engineer', 'III', 'Room 1521', 2, 1, 1, NULL, '2022-11-22 18:30:00', NULL),
(817, 'Aimee Robert', 'CPF1187439400', 'arobert8q@pinterest.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2872534873', 'A', 'Mining engineer', 'Sr', 'Room 100', 2, 1, 1, NULL, '2023-06-19 18:30:00', NULL),
(818, 'Ezechiel Sandwich', 'CPF4145431526', 'esandwich8r@de.vu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7288664369', 'C', 'Sales and Busines', 'IV', 'PO Box 98201', 2, 1, 1, NULL, '2023-08-17 18:30:00', NULL),
(819, 'Arley Escoffier', 'CPF3097096367', 'aescoffier8s@fda.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9185335397', 'B3', 'Drilling engineer', 'III', 'Room 1798', 2, 1, 1, NULL, '2023-06-22 18:30:00', NULL),
(820, 'Ramsey Reignard', 'CPF7989255883', 'rreignard8t@youtube.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6745145384', 'D', 'Technicians', 'Jr', 'PO Box 1557', 2, 1, 1, NULL, '2023-03-19 18:30:00', NULL),
(821, 'Shawna Harrowing', 'CPF5370673695', 'sharrowing8u@discovery.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5458473723', 'E1', 'Project Manager', 'Jr', 'Room 864', 2, 1, 1, NULL, '2023-06-23 18:30:00', NULL),
(822, 'Aila Penfold', 'CPF6413990893', 'apenfold8v@sogou.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6283621364', 'E1', 'Mining engineer', 'II', 'Room 780', 2, 1, 1, NULL, '2022-11-18 18:30:00', NULL),
(823, 'Donal Como', 'CPF4935098142', 'dcomo8w@tumblr.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9438505279', 'C', 'Technicians', 'III', 'PO Box 20477', 2, 1, 1, NULL, '2023-07-11 18:30:00', NULL),
(824, 'Ray Gelder', 'CPF0608170596', 'rgelder8x@nationalgeographic.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9761319168', 'B', 'Project Manager', 'IV', '8th Floor', 2, 1, 1, NULL, '2023-05-10 18:30:00', NULL),
(825, 'Colin Buckberry', 'CPF7769838094', 'cbuckberry8y@wufoo.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8181042342', 'E3', 'Project Manager', 'Sr', '2nd Floor', 2, 1, 1, NULL, '2022-11-19 18:30:00', NULL),
(826, 'Christye Axby', 'CPF1638829449', 'caxby8z@hexun.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5213644817', 'A2', 'Energy engineer', 'II', 'PO Box 14397', 2, 1, 1, NULL, '2023-06-06 18:30:00', NULL),
(827, 'Marji Debnam', 'CPF3121079541', 'mdebnam90@ocn.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3103947241', 'B', 'Project Manager', 'Sr', 'Room 24', 2, 1, 1, NULL, '2023-08-06 18:30:00', NULL),
(828, 'Osborne Khosa', 'CPF9871535320', 'okhosa91@biglobe.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8677694852', 'B2', 'Technicians', 'II', 'Apt 852', 2, 1, 1, NULL, '2023-08-06 18:30:00', NULL),
(829, 'Erina Radolf', 'CPF8929718436', 'eradolf92@51.la', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2344144116', 'A1', 'Drilling engineer', 'Jr', '8th Floor', 2, 1, 1, NULL, '2023-02-13 18:30:00', NULL),
(830, 'Nowell Orneblow', 'CPF7671224526', 'norneblow93@taobao.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3774513942', 'E2', 'Mining engineer', 'IV', 'PO Box 37692', 2, 1, 1, NULL, '2023-07-24 18:30:00', NULL),
(831, 'Marguerite Rego', 'CPF5236769918', 'mrego94@patch.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2163934115', 'E3', 'Drilling engineer', 'Sr', 'Room 1084', 2, 1, 1, NULL, '2023-05-24 18:30:00', NULL),
(832, 'Alano Scupham', 'CPF3815600615', 'ascupham95@forbes.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5749219672', 'E3', 'Drilling engineer', 'III', 'Suite 46', 2, 1, 1, NULL, '2023-06-25 18:30:00', NULL),
(833, 'Marinna Sedworth', 'CPF9001565159', 'msedworth96@xrea.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5952417674', 'D', 'Drilling engineer', 'II', 'PO Box 94004', 2, 1, 1, NULL, '2022-12-29 18:30:00', NULL),
(834, 'Remy Caulton', 'CPF5516387600', 'rcaulton97@virginia.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7226148739', 'D', 'Technicians', 'Sr', 'Apt 731', 2, 1, 1, NULL, '2023-03-07 18:30:00', NULL),
(835, 'Rikki Tutchener', 'CPF1835866197', 'rtutchener98@cbsnews.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4508230509', 'E1', 'Mining engineer', 'Sr', '15th Floor', 2, 1, 1, NULL, '2023-01-26 18:30:00', NULL),
(836, 'Anastasie Cayzer', 'CPF7101405877', 'acayzer99@java.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9948255715', 'B3', 'Technicians', 'Sr', 'Apt 1645', 2, 1, 1, NULL, '2022-12-17 18:30:00', NULL),
(837, 'Berna Lomasny', 'CPF9442170161', 'blomasny9a@engadget.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5243599619', 'A1', 'Project Manager', 'II', 'Room 1101', 2, 1, 1, NULL, '2023-02-23 18:30:00', NULL),
(838, 'Starla Backwell', 'CPF1871665403', 'sbackwell9b@pagesperso-orange.fr', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1408091089', 'B1', 'Project Manager', 'Jr', 'Room 1160', 2, 1, 1, NULL, '2023-08-07 18:30:00', NULL),
(839, 'Vi Glendzer', 'CPF5368475226', 'vglendzer9c@princeton.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4834284076', 'A1', 'Project Manager', 'Jr', '1st Floor', 2, 1, 1, NULL, '2022-11-29 18:30:00', NULL),
(840, 'Jeremiah McCroft', 'CPF3332851200', 'jmccroft9d@berkeley.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1406381050', 'E3', 'Mining engineer', 'II', 'Room 686', 2, 1, 1, NULL, '2023-03-29 18:30:00', NULL),
(841, 'Elise Arboine', 'CPF8467789314', 'earboine9e@friendfeed.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1416076054', 'E2', 'Project Manager', 'Sr', 'PO Box 153', 2, 1, 1, NULL, '2023-05-19 18:30:00', NULL),
(842, 'Justino Folli', 'CPF9378608307', 'jfolli9f@howstuffworks.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8773180742', 'E2', 'Technicians', 'II', 'Room 973', 2, 1, 1, NULL, '2023-02-21 18:30:00', NULL),
(843, 'Salome Carpe', 'CPF0744282058', 'scarpe9g@archive.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3872795314', 'E3', 'Sales and Busines', 'Sr', 'Suite 48', 2, 1, 1, NULL, '2022-12-05 18:30:00', NULL),
(844, 'Paulie McCabe', 'CPF8245748871', 'pmccabe9h@g.co', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7252344389', 'E1', 'Energy engineer', 'II', 'Room 747', 2, 1, 1, NULL, '2023-08-05 18:30:00', NULL),
(845, 'Austina Dalinder', 'CPF6191966352', 'adalinder9i@soundcloud.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3606344079', 'D', 'Mining engineer', 'IV', 'Suite 76', 2, 1, 1, NULL, '2023-03-06 18:30:00', NULL),
(846, 'Mord Fensome', 'CPF8585790624', 'mfensome9j@cpanel.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3883815161', 'B', 'Project Manager', 'Jr', 'Suite 6', 2, 1, 1, NULL, '2023-01-11 18:30:00', NULL),
(847, 'Merrie Hasel', 'CPF8247896704', 'mhasel9k@imdb.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3868124776', 'E2', 'Sales and Busines', 'III', 'Room 1553', 2, 1, 1, NULL, '2023-04-30 18:30:00', NULL),
(848, 'Malissa Livesley', 'CPF6235210007', 'mlivesley9l@vistaprint.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6713770695', 'C', 'Mining engineer', 'Jr', 'Suite 35', 2, 1, 1, NULL, '2023-09-10 18:30:00', NULL),
(849, 'Marysa Aggs', 'CPF7810402769', 'maggs9m@goo.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8367820173', 'A1', 'Energy engineer', 'III', 'Suite 51', 2, 1, 1, NULL, '2023-06-09 18:30:00', NULL),
(850, 'Lonnard Maryman', 'CPF5551641404', 'lmaryman9n@usa.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4028933016', 'A', 'Mining engineer', 'Sr', 'Suite 79', 2, 1, 1, NULL, '2023-06-18 18:30:00', NULL),
(851, 'Alleyn Crossland', 'CPF5301101179', 'acrossland9o@dedecms.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5156528413', 'B3', 'Drilling engineer', 'III', 'Room 1424', 2, 1, 1, NULL, '2022-10-19 18:30:00', NULL),
(852, 'Filberto Minchinden', 'CPF7751230701', 'fminchinden9p@liveinternet.ru', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6719350731', 'D', 'Sales and Busines', 'II', 'Suite 61', 2, 1, 1, NULL, '2023-01-31 18:30:00', NULL),
(853, 'Kellie Lawlor', 'CPF3660841245', 'klawlor9q@tmall.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9482158675', 'E2', 'Drilling engineer', 'III', 'Suite 21', 2, 1, 1, NULL, '2022-12-05 18:30:00', NULL),
(854, 'Cathlene Sargint', 'CPF4270533420', 'csargint9r@amazon.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1102987766', 'B3', 'Project Manager', 'Sr', 'Suite 18', 2, 1, 1, NULL, '2023-06-15 18:30:00', NULL),
(855, 'Marmaduke Pordall', 'CPF7113376346', 'mpordall9s@odnoklassniki.ru', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2212010066', 'A2', 'Sales and Busines', 'Jr', 'PO Box 10152', 2, 1, 1, NULL, '2023-01-30 18:30:00', NULL),
(856, 'Sinclare Mayzes', 'CPF9771540182', 'smayzes9t@miitbeian.gov.cn', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7301501612', 'A', 'Sales and Busines', 'II', 'Room 711', 2, 1, 1, NULL, '2023-01-01 18:30:00', NULL),
(857, 'Hayes Allinson', 'CPF4247633148', 'hallinson9u@army.mil', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5379598436', 'A1', 'Sales and Busines', 'III', 'Room 568', 2, 1, 1, NULL, '2023-09-10 18:30:00', NULL),
(858, 'Shelbi McMurrugh', 'CPF4047321022', 'smcmurrugh9v@vinaora.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7219092846', 'E3', 'Energy engineer', 'IV', '1st Floor', 2, 1, 1, NULL, '2022-10-15 18:30:00', NULL),
(859, 'Zenia Castillon', 'CPF3297486730', 'zcastillon9w@typepad.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4102844533', 'D', 'Sales and Busines', 'III', '4th Floor', 2, 1, 1, NULL, '2023-08-22 18:30:00', NULL),
(860, 'Jasmine Mangam', 'CPF9918711741', 'jmangam9x@amazon.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3069099228', 'E3', 'Sales and Busines', 'Sr', 'PO Box 78744', 2, 1, 1, NULL, '2023-07-10 18:30:00', NULL),
(861, 'Rance MacTrustie', 'CPF2548418096', 'rmactrustie9y@wunderground.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8304398498', 'E2', 'Sales and Busines', 'Jr', 'PO Box 27460', 2, 1, 1, NULL, '2022-11-17 18:30:00', NULL),
(862, 'Cary Littler', 'CPF9408347071', 'clittler9z@usatoday.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2735467281', 'A', 'Project Manager', 'Sr', 'Suite 96', 2, 1, 1, NULL, '2023-06-17 18:30:00', NULL),
(863, 'Amandie Olivello', 'CPF1189871720', 'aolivelloa0@surveymonkey.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7166258093', 'B2', 'Technicians', 'II', '3rd Floor', 2, 1, 1, NULL, '2023-08-01 18:30:00', NULL),
(864, 'Monah O\'Ruane', 'CPF9817672651', 'moruanea1@linkedin.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5483338560', 'A', 'Mining engineer', 'II', '18th Floor', 2, 1, 1, NULL, '2022-10-03 18:30:00', NULL),
(865, 'Guilbert Whillock', 'CPF3183224516', 'gwhillocka2@umich.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3416883990', 'E3', 'Energy engineer', 'Sr', 'Room 234', 2, 1, 1, NULL, '2023-05-29 18:30:00', NULL),
(866, 'Hamil Frankland', 'CPF9562681599', 'hfranklanda3@techcrunch.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6619465077', 'C', 'Drilling engineer', 'III', '8th Floor', 2, 1, 1, NULL, '2022-12-22 18:30:00', NULL),
(867, 'Karlyn Coulling', 'CPF2843308703', 'kcoullinga4@hexun.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1901055415', 'B3', 'Sales and Busines', 'III', '9th Floor', 2, 1, 1, NULL, '2022-11-12 18:30:00', NULL),
(868, 'Sullivan Cherry', 'CPF9418870814', 'scherrya5@usatoday.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6031932506', 'B1', 'Drilling engineer', 'II', '19th Floor', 2, 1, 1, NULL, '2023-04-25 18:30:00', NULL),
(869, 'Gail MacCroary', 'CPF3311583728', 'gmaccroarya6@unblog.fr', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1683066354', 'B1', 'Sales and Busines', 'III', 'Suite 72', 2, 1, 1, NULL, '2023-03-14 18:30:00', NULL),
(870, 'Gennie Orae', 'CPF8330986165', 'goraea7@alibaba.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4415997427', 'C', 'Project Manager', 'IV', 'Apt 610', 2, 1, 1, NULL, '2023-04-03 18:30:00', NULL),
(871, 'Ray Brill', 'CPF4833580070', 'rbrilla8@arizona.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6502768814', 'A', 'Energy engineer', 'III', 'Suite 46', 2, 1, 1, NULL, '2022-12-28 18:30:00', NULL),
(872, 'Rosana Basile', 'CPF4724128437', 'rbasilea9@twitpic.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4182496074', 'E2', 'Project Manager', 'II', 'Suite 54', 2, 1, 1, NULL, '2022-10-08 18:30:00', NULL),
(873, 'Heath Akitt', 'CPF1607340677', 'hakittaa@toplist.cz', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9592944156', 'E', 'Mining engineer', 'III', 'Apt 1831', 2, 1, 1, NULL, '2023-01-26 18:30:00', NULL),
(874, 'Thea Verbeke', 'CPF6551266020', 'tverbekeab@theglobeandmail.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2037429713', 'E2', 'Drilling engineer', 'IV', 'PO Box 20215', 2, 1, 1, NULL, '2023-03-17 18:30:00', NULL),
(875, 'Goddart Aleavy', 'CPF2679144798', 'galeavyac@t-online.de', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2176523795', 'C', 'Drilling engineer', 'Sr', '16th Floor', 2, 1, 1, NULL, '2023-04-09 18:30:00', NULL),
(876, 'Ailis Lownie', 'CPF8082466481', 'alowniead@blogtalkradio.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6893952460', 'A', 'Mining engineer', 'II', 'PO Box 1254', 2, 1, 1, NULL, '2022-10-10 18:30:00', NULL),
(877, 'Eydie Bladen', 'CPF7372018275', 'ebladenae@163.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8844317742', 'A2', 'Sales and Busines', 'Jr', 'Room 530', 2, 1, 1, NULL, '2023-07-02 18:30:00', NULL),
(878, 'Lucio de Clerk', 'CPF8810249167', 'ldeaf@opensource.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6576579786', 'E2', 'Sales and Busines', 'II', 'Room 1055', 2, 1, 1, NULL, '2022-11-20 18:30:00', NULL),
(879, 'Mab Statham', 'CPF9395575433', 'mstathamag@dailymail.co.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2441055615', 'E', 'Mining engineer', 'Jr', '1st Floor', 2, 1, 1, NULL, '2023-08-06 18:30:00', NULL),
(880, 'Rad Lopez', 'CPF5440651766', 'rlopezah@github.io', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5798378171', 'E', 'Drilling engineer', 'IV', 'Suite 59', 2, 1, 1, NULL, '2023-06-05 18:30:00', NULL),
(881, 'Elisa Arpur', 'CPF1418316804', 'earpurai@moonfruit.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4712171522', 'B', 'Project Manager', 'III', 'Suite 7', 2, 1, 1, NULL, '2022-12-26 18:30:00', NULL),
(882, 'Jeffy Hunton', 'CPF6554322179', 'jhuntonaj@fema.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9647881451', 'E', 'Energy engineer', 'Jr', 'Suite 19', 2, 1, 1, NULL, '2022-11-23 18:30:00', NULL),
(883, 'Trixi Doxsey', 'CPF0741991169', 'tdoxseyak@bigcartel.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7936069929', 'A2', 'Drilling engineer', 'II', 'PO Box 17840', 2, 1, 1, NULL, '2023-01-10 18:30:00', NULL),
(884, 'Ashien Terbeck', 'CPF8851290655', 'aterbeckal@salon.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6636724029', 'B2', 'Technicians', 'II', 'PO Box 82207', 2, 1, 1, NULL, '2023-03-08 18:30:00', NULL),
(885, 'Margalo Rings', 'CPF5489799937', 'mringsam@hostgator.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5521558153', 'E2', 'Project Manager', 'III', 'Apt 1666', 2, 1, 1, NULL, '2022-10-13 18:30:00', NULL),
(886, 'Lettie Kock', 'CPF5775287551', 'lkockan@google.fr', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1108411153', 'B', 'Technicians', 'II', 'Suite 91', 2, 1, 1, NULL, '2022-11-26 18:30:00', NULL),
(887, 'Sonny Eschelle', 'CPF8165749688', 'seschelleao@rakuten.co.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9056856305', 'C', 'Mining engineer', 'IV', 'Room 1189', 2, 1, 1, NULL, '2023-07-07 18:30:00', NULL),
(888, 'Alfi Hearthfield', 'CPF4146282148', 'ahearthfieldap@imdb.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2469747092', 'B3', 'Sales and Busines', 'II', 'Apt 1553', 2, 1, 1, NULL, '2023-08-06 18:30:00', NULL),
(889, 'Fanni Jakes', 'CPF3735365386', 'fjakesaq@gravatar.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5044603271', 'E2', 'Technicians', 'IV', '10th Floor', 2, 1, 1, NULL, '2023-08-09 18:30:00', NULL),
(890, 'Chan Meeland', 'CPF3429422878', 'cmeelandar@tiny.cc', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2523444193', 'D', 'Sales and Busines', 'III', 'Apt 680', 2, 1, 1, NULL, '2022-12-12 18:30:00', NULL),
(891, 'Stephine Reeme', 'CPF9652022027', 'sreemeas@miitbeian.gov.cn', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9687415098', 'A2', 'Technicians', 'III', 'Suite 68', 2, 1, 1, NULL, '2022-10-22 18:30:00', NULL),
(892, 'Stephana Wiggans', 'CPF3722950396', 'swiggansat@bandcamp.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5817177972', 'C', 'Mining engineer', 'III', 'Apt 1230', 2, 1, 1, NULL, '2023-04-13 18:30:00', NULL),
(893, 'Margit Jugging', 'CPF7417777908', 'mjuggingau@over-blog.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6806102738', 'E1', 'Sales and Busines', 'Jr', 'Room 7', 2, 1, 1, NULL, '2023-06-30 18:30:00', NULL),
(894, 'Olimpia Limpricht', 'CPF9380756991', 'olimprichtav@va.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2425996813', 'B3', 'Project Manager', 'Sr', 'Suite 58', 2, 1, 1, NULL, '2023-06-30 18:30:00', NULL),
(895, 'Ellene Keeton', 'CPF4975272772', 'ekeetonaw@goo.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9194059489', 'E1', 'Drilling engineer', 'IV', 'Apt 1886', 2, 1, 1, NULL, '2023-07-08 18:30:00', NULL),
(896, 'Chelsy Dillestone', 'CPF1168239841', 'cdillestoneax@msn.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2504942199', 'A1', 'Mining engineer', 'III', 'Apt 291', 2, 1, 1, NULL, '2023-06-21 18:30:00', NULL),
(897, 'Allissa Stoner', 'CPF2196400828', 'astoneray@themeforest.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6081604282', 'B', 'Project Manager', 'II', 'Suite 60', 2, 1, 1, NULL, '2022-11-04 18:30:00', NULL),
(898, 'Shea Eddis', 'CPF7323817190', 'seddisaz@zdnet.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6383378634', 'B2', 'Technicians', 'Sr', 'Apt 1956', 2, 1, 1, NULL, '2023-08-04 18:30:00', NULL),
(899, 'Benedict Stanex', 'CPF0653311691', 'bstanexb0@livejournal.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8552913054', 'E1', 'Technicians', 'Sr', 'PO Box 24471', 2, 1, 1, NULL, '2022-10-09 18:30:00', NULL),
(900, 'Alexis Spensley', 'CPF4235849056', 'aspensleyb1@list-manage.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3794272523', 'E', 'Sales and Busines', 'III', '6th Floor', 2, 1, 1, NULL, '2023-05-09 18:30:00', NULL),
(901, 'Reine Shakspeare', 'CPF8751369906', 'rshakspeareb2@reuters.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1812949561', 'D', 'Mining engineer', 'II', '12th Floor', 2, 1, 1, NULL, '2023-04-16 18:30:00', NULL),
(902, 'Will Slorance', 'CPF3775624644', 'wsloranceb3@google.ru', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2083310897', 'B2', 'Energy engineer', 'II', 'Suite 56', 2, 1, 1, NULL, '2022-10-14 18:30:00', NULL),
(903, 'Oralle Mellanby', 'CPF3263585335', 'omellanbyb4@instagram.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5609456551', 'E3', 'Mining engineer', 'II', 'Apt 216', 2, 1, 1, NULL, '2022-11-24 18:30:00', NULL),
(904, 'Shirl McChesney', 'CPF7228053732', 'smcchesneyb5@comsenz.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4042798465', 'E3', 'Energy engineer', 'IV', 'Apt 1956', 2, 1, 1, NULL, '2023-01-23 18:30:00', NULL),
(905, 'Reinald Haspineall', 'CPF3140146003', 'rhaspineallb6@omniture.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6883963471', 'B1', 'Technicians', 'II', 'Apt 187', 2, 1, 1, NULL, '2023-01-07 18:30:00', NULL),
(906, 'Ruddy Faulkes', 'CPF8338356500', 'rfaulkesb7@zdnet.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2266371165', 'A2', 'Energy engineer', 'IV', '1st Floor', 2, 1, 1, NULL, '2023-03-22 18:30:00', NULL),
(907, 'Michell Lamey', 'CPF1289115033', 'mlameyb8@timesonline.co.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3935341154', 'E2', 'Mining engineer', 'Jr', 'Room 1266', 2, 1, 1, NULL, '2022-10-08 18:30:00', NULL),
(908, 'Biddie De la Yglesias', 'CPF7452288518', 'bdeb9@tamu.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1277530051', 'B3', 'Drilling engineer', 'IV', '13th Floor', 2, 1, 1, NULL, '2023-04-08 18:30:00', NULL),
(909, 'Dorothee Roderick', 'CPF7315975210', 'droderickba@github.io', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7926360948', 'A2', 'Sales and Busines', 'Jr', 'Room 885', 2, 1, 1, NULL, '2023-04-23 18:30:00', NULL),
(910, 'Bren MacDermand', 'CPF1931366291', 'bmacdermandbb@pinterest.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4875299641', 'A', 'Project Manager', 'II', 'Apt 1489', 2, 1, 1, NULL, '2023-01-09 18:30:00', NULL),
(911, 'Anatol Barwack', 'CPF7732968543', 'abarwackbc@businessinsider.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3291695576', 'E2', 'Energy engineer', 'IV', 'Room 26', 2, 1, 1, NULL, '2023-02-26 18:30:00', NULL),
(912, 'Joby Tyson', 'CPF3245039888', 'jtysonbd@cdc.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2252988611', 'A2', 'Technicians', 'Sr', '14th Floor', 2, 1, 1, NULL, '2023-03-30 18:30:00', NULL),
(913, 'Chadd Senecaut', 'CPF5672390244', 'csenecautbe@com.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9717963161', 'A2', 'Technicians', 'III', 'PO Box 61253', 2, 1, 1, NULL, '2023-06-13 18:30:00', NULL),
(914, 'Mareah Hollerin', 'CPF1578190168', 'mhollerinbf@unesco.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7632441013', 'A2', 'Energy engineer', 'Sr', 'PO Box 60946', 2, 1, 1, NULL, '2023-08-26 18:30:00', NULL),
(915, 'Ugo Craney', 'CPF7600096116', 'ucraneybg@yale.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8164959360', 'A1', 'Drilling engineer', 'II', 'Suite 61', 2, 1, 1, NULL, '2023-04-05 18:30:00', NULL),
(916, 'Sophi Bibb', 'CPF0482071402', 'sbibbbh@hc360.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2891045706', 'E', 'Technicians', 'Jr', 'Suite 57', 2, 1, 1, NULL, '2023-02-21 18:30:00', NULL),
(917, 'Daphene Welbelove', 'CPF7492567463', 'dwelbelovebi@about.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2945194521', 'E', 'Energy engineer', 'IV', 'Apt 454', 2, 1, 1, NULL, '2023-07-08 18:30:00', NULL),
(918, 'Rosaline Wyld', 'CPF6213546455', 'rwyldbj@github.io', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4373553514', 'E2', 'Project Manager', 'IV', 'Room 1439', 2, 1, 1, NULL, '2023-02-26 18:30:00', NULL);
INSERT INTO `users` (`id`, `name`, `cpf_no`, `email`, `email_verified_at`, `password`, `mobile`, `level`, `designation`, `category`, `location`, `user_type`, `actv_status`, `create_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(919, 'Bartholemy Phinnis', 'CPF9014649178', 'bphinnisbk@spotify.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3081747311', 'E2', 'Technicians', 'II', 'Room 80', 2, 1, 1, NULL, '2023-07-01 18:30:00', NULL),
(920, 'Tillie Ohrtmann', 'CPF0597052621', 'tohrtmannbl@de.vu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1492660998', 'A2', 'Energy engineer', 'IV', 'Apt 1785', 2, 1, 1, NULL, '2023-03-11 18:30:00', NULL),
(921, 'Cristal Giovani', 'CPF3592052319', 'cgiovanibm@ted.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8467383019', 'B1', 'Project Manager', 'II', 'Room 258', 2, 1, 1, NULL, '2022-12-15 18:30:00', NULL),
(922, 'Marice Brentnall', 'CPF4643523466', 'mbrentnallbn@discovery.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5568348009', 'C', 'Mining engineer', 'II', 'Suite 63', 2, 1, 1, NULL, '2022-10-31 18:30:00', NULL),
(923, 'Roxi Megarrell', 'CPF9368640408', 'rmegarrellbo@phpbb.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9758143360', 'A', 'Drilling engineer', 'IV', 'Apt 1318', 2, 1, 1, NULL, '2023-02-18 18:30:00', NULL),
(924, 'Dorie Derobert', 'CPF1401890758', 'dderobertbp@alibaba.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7824337105', 'B', 'Energy engineer', 'Jr', 'Room 1493', 2, 1, 1, NULL, '2022-11-23 18:30:00', NULL),
(925, 'Jonah Fyall', 'CPF8310108211', 'jfyallbq@comcast.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7676344270', 'E1', 'Mining engineer', 'Sr', 'PO Box 83104', 2, 1, 1, NULL, '2022-11-08 18:30:00', NULL),
(926, 'Minnie Cormode', 'CPF3038403799', 'mcormodebr@adobe.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9123614286', 'E1', 'Mining engineer', 'III', 'PO Box 98416', 2, 1, 1, NULL, '2023-04-16 18:30:00', NULL),
(927, 'Callida Angelini', 'CPF9353310253', 'cangelinibs@archive.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9222330246', 'B3', 'Drilling engineer', 'III', 'Room 1120', 2, 1, 1, NULL, '2023-04-09 18:30:00', NULL),
(928, 'Katinka Runnacles', 'CPF1008032679', 'krunnaclesbt@census.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7896578261', 'E2', 'Energy engineer', 'Jr', 'Suite 42', 2, 1, 1, NULL, '2022-11-01 18:30:00', NULL),
(929, 'Taite Mechic', 'CPF3807197691', 'tmechicbu@reverbnation.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2065260892', 'B', 'Energy engineer', 'III', 'Room 1091', 2, 1, 1, NULL, '2023-06-23 18:30:00', NULL),
(930, 'Ariadne Lowfill', 'CPF6021256495', 'alowfillbv@merriam-webster.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8072255716', 'A2', 'Project Manager', 'Jr', 'Apt 1979', 2, 1, 1, NULL, '2023-07-19 18:30:00', NULL),
(931, 'Currey Dauber', 'CPF7122751268', 'cdauberbw@wikispaces.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3584402161', 'E', 'Mining engineer', 'Sr', 'Apt 833', 2, 1, 1, NULL, '2022-11-05 18:30:00', NULL),
(932, 'Kendal Delagnes', 'CPF0418633345', 'kdelagnesbx@hatena.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5938659266', 'C', 'Project Manager', 'III', 'Apt 928', 2, 1, 1, NULL, '2023-02-27 18:30:00', NULL),
(933, 'Ham Cardello', 'CPF5151931695', 'hcardelloby@edublogs.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8362815119', 'E2', 'Mining engineer', 'II', 'Room 1075', 2, 1, 1, NULL, '2023-07-15 18:30:00', NULL),
(934, 'Gayle Metcalfe', 'CPF8330922909', 'gmetcalfebz@51.la', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3433638787', 'B', 'Sales and Busines', 'II', 'PO Box 73799', 2, 1, 1, NULL, '2023-02-01 18:30:00', NULL),
(935, 'Pru Beauchamp', 'CPF1507072191', 'pbeauchampc0@fema.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1213680611', 'E3', 'Technicians', 'Jr', '3rd Floor', 2, 1, 1, NULL, '2022-11-19 18:30:00', NULL),
(936, 'Lelia Dmitrievski', 'CPF4365613580', 'ldmitrievskic1@myspace.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9354832729', 'A1', 'Energy engineer', 'Sr', 'Suite 14', 2, 1, 1, NULL, '2022-12-30 18:30:00', NULL),
(937, 'Owen Rycroft', 'CPF5899329330', 'orycroftc2@buzzfeed.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8379152550', 'E1', 'Energy engineer', 'III', 'Room 1124', 2, 1, 1, NULL, '2023-09-18 18:30:00', NULL),
(938, 'Gelya Angric', 'CPF4835697786', 'gangricc3@psu.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6389951039', 'E', 'Technicians', 'IV', 'Apt 3', 2, 1, 1, NULL, '2023-06-06 18:30:00', NULL),
(939, 'Lovell Barthel', 'CPF6057079640', 'lbarthelc4@ftc.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9332103799', 'E1', 'Project Manager', 'III', 'Room 1652', 2, 1, 1, NULL, '2023-01-02 18:30:00', NULL),
(940, 'Dotty Taynton', 'CPF9388364874', 'dtayntonc5@cocolog-nifty.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3057015613', 'E3', 'Drilling engineer', 'III', '16th Floor', 2, 1, 1, NULL, '2023-07-06 18:30:00', NULL),
(941, 'Chevy Tick', 'CPF9829788240', 'ctickc6@hhs.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1844198354', 'B3', 'Sales and Busines', 'Jr', 'Suite 9', 2, 1, 1, NULL, '2023-01-05 18:30:00', NULL),
(942, 'Billye Pinard', 'CPF6783040187', 'bpinardc7@about.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6044864486', 'E2', 'Project Manager', 'Sr', 'Apt 331', 2, 1, 1, NULL, '2023-01-05 18:30:00', NULL),
(943, 'Elene New', 'CPF7265115123', 'enewc8@dropbox.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8752940895', 'B1', 'Drilling engineer', 'II', 'Suite 97', 2, 1, 1, NULL, '2022-11-09 18:30:00', NULL),
(944, 'Nalani D\'Avaux', 'CPF1052135362', 'ndavauxc9@skyrock.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6177835953', 'B', 'Project Manager', 'Jr', 'Room 1601', 2, 1, 1, NULL, '2023-02-14 18:30:00', NULL),
(945, 'Jane Varnam', 'CPF9505836452', 'jvarnamca@va.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6273317236', 'E2', 'Sales and Busines', 'Sr', 'PO Box 64943', 2, 1, 1, NULL, '2023-04-04 18:30:00', NULL),
(946, 'Bree Hammelberg', 'CPF5199479992', 'bhammelbergcb@xrea.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6351358580', 'A', 'Sales and Busines', 'IV', 'Room 616', 2, 1, 1, NULL, '2023-08-06 18:30:00', NULL),
(947, 'Gerek Blakeley', 'CPF4151103239', 'gblakeleycc@microsoft.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3967759617', 'A1', 'Sales and Busines', 'IV', 'Suite 96', 2, 1, 1, NULL, '2022-10-04 18:30:00', NULL),
(948, 'Nani Lardez', 'CPF9243627154', 'nlardezcd@creativecommons.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4982727617', 'E1', 'Energy engineer', 'II', '9th Floor', 2, 1, 1, NULL, '2023-03-14 18:30:00', NULL),
(949, 'Urbanus Bewicke', 'CPF3154029924', 'ubewickece@loc.gov', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7965269982', 'C', 'Energy engineer', 'III', 'Suite 57', 2, 1, 1, NULL, '2023-03-19 18:30:00', NULL),
(950, 'Clementine Pilling', 'CPF3502943266', 'cpillingcf@gmpg.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7215814229', 'B', 'Technicians', 'II', 'Room 1530', 2, 1, 1, NULL, '2023-08-15 18:30:00', NULL),
(951, 'Fina Gratland', 'CPF3367104665', 'fgratlandcg@yahoo.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3221436163', 'A', 'Drilling engineer', 'IV', 'Suite 31', 2, 1, 1, NULL, '2022-10-30 18:30:00', NULL),
(952, 'Christabella Sauvain', 'CPF3421358327', 'csauvainch@prlog.org', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5884331008', 'C', 'Technicians', 'II', 'PO Box 1398', 2, 1, 1, NULL, '2023-01-12 18:30:00', NULL),
(953, 'Haley Mallindine', 'CPF9537867347', 'hmallindineci@blog.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7919735935', 'E3', 'Project Manager', 'IV', '2nd Floor', 2, 1, 1, NULL, '2022-09-28 18:30:00', NULL),
(954, 'Hamel Drydale', 'CPF2733632463', 'hdrydalecj@si.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3355136307', 'E2', 'Project Manager', 'II', 'Room 596', 2, 1, 1, NULL, '2023-08-23 18:30:00', NULL),
(955, 'Eran Kinde', 'CPF3986625718', 'ekindeck@free.fr', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2357796271', 'D', 'Energy engineer', 'II', 'Room 966', 2, 1, 1, NULL, '2023-05-19 18:30:00', NULL),
(956, 'Violetta Resdale', 'CPF6673123779', 'vresdalecl@php.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2099655048', 'E1', 'Mining engineer', 'Sr', 'Room 1305', 2, 1, 1, NULL, '2023-08-26 18:30:00', NULL),
(957, 'Romain Allon', 'CPF8187563308', 'ralloncm@eepurl.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3157971811', 'B2', 'Energy engineer', 'III', '16th Floor', 2, 1, 1, NULL, '2023-02-17 18:30:00', NULL),
(958, 'Nolana Dillestone', 'CPF0402430762', 'ndillestonecn@lycos.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6061511699', 'B1', 'Mining engineer', 'Jr', '7th Floor', 2, 1, 1, NULL, '2023-05-01 18:30:00', NULL),
(959, 'Christian Bodiam', 'CPF8627682599', 'cbodiamco@tripod.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7301114565', 'A1', 'Sales and Busines', 'Sr', '6th Floor', 2, 1, 1, NULL, '2022-10-26 18:30:00', NULL),
(960, 'Jamaal Titley', 'CPF3877863996', 'jtitleycp@ucla.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4323467922', 'E3', 'Mining engineer', 'IV', 'Apt 56', 2, 1, 1, NULL, '2022-10-04 18:30:00', NULL),
(961, 'Garey Grubb', 'CPF1336490676', 'ggrubbcq@usatoday.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3497858632', 'C', 'Technicians', 'III', 'Room 1270', 2, 1, 1, NULL, '2023-05-02 18:30:00', NULL),
(962, 'Lillis Bottomer', 'CPF6151553596', 'lbottomercr@hatena.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9426787812', 'E1', 'Project Manager', 'Sr', 'Room 717', 2, 1, 1, NULL, '2023-05-09 18:30:00', NULL),
(963, 'Perri Docwra', 'CPF2995832891', 'pdocwracs@biglobe.ne.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2036730338', 'A1', 'Technicians', 'Jr', 'Suite 3', 2, 1, 1, NULL, '2023-02-03 18:30:00', NULL),
(964, 'Neil Mapother', 'CPF4485999141', 'nmapotherct@blinklist.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2995347386', 'B3', 'Sales and Busines', 'Jr', '14th Floor', 2, 1, 1, NULL, '2023-05-06 18:30:00', NULL),
(965, 'Valma Bonehill', 'CPF5640337324', 'vbonehillcu@amazon.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1121801469', 'B3', 'Sales and Busines', 'IV', 'PO Box 58607', 2, 1, 1, NULL, '2023-05-18 18:30:00', NULL),
(966, 'Shep Ambrogio', 'CPF6696586574', 'sambrogiocv@wikispaces.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1573888451', 'A', 'Drilling engineer', 'II', 'Room 1322', 2, 1, 1, NULL, '2023-05-28 18:30:00', NULL),
(967, 'Agneta Swinbourne', 'CPF0596384760', 'aswinbournecw@furl.net', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3441922406', 'E3', 'Mining engineer', 'II', 'PO Box 59319', 2, 1, 1, NULL, '2023-06-28 18:30:00', NULL),
(968, 'Chauncey Scamaden', 'CPF8041795742', 'cscamadencx@plala.or.jp', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1937755689', 'B3', 'Sales and Busines', 'IV', 'PO Box 77239', 2, 1, 1, NULL, '2022-10-10 18:30:00', NULL),
(969, 'Aryn Blowin', 'CPF3349924093', 'ablowincy@bloglines.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4046659896', 'E3', 'Mining engineer', 'III', 'Suite 60', 2, 1, 1, NULL, '2023-09-08 18:30:00', NULL),
(970, 'Modestine Bison', 'CPF3172241751', 'mbisoncz@over-blog.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6766024637', 'E2', 'Technicians', 'Jr', 'Apt 785', 2, 1, 1, NULL, '2022-12-31 18:30:00', NULL),
(971, 'Lorry Veasey', 'CPF9374539410', 'lveaseyd0@wix.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9201449729', 'A2', 'Drilling engineer', 'III', '8th Floor', 2, 1, 1, NULL, '2023-07-15 18:30:00', NULL),
(972, 'Casey Nani', 'CPF9183742895', 'cnanid1@telegraph.co.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6513934261', 'D', 'Sales and Busines', 'Sr', 'Suite 90', 2, 1, 1, NULL, '2022-12-23 18:30:00', NULL),
(973, 'Gal Halson', 'CPF0368128240', 'ghalsond2@google.pl', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6347183510', 'A1', 'Project Manager', 'Sr', 'Apt 1890', 2, 1, 1, NULL, '2023-03-22 18:30:00', NULL),
(974, 'Selle O\'Flaverty', 'CPF0631830837', 'soflavertyd3@webeden.co.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8972747040', 'A1', 'Sales and Busines', 'IV', 'PO Box 76556', 2, 1, 1, NULL, '2023-01-15 18:30:00', NULL),
(975, 'Aura MacDunlevy', 'CPF8304435489', 'amacdunlevyd4@diigo.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1681999169', 'C', 'Mining engineer', 'IV', 'Apt 337', 2, 1, 1, NULL, '2022-11-30 18:30:00', NULL),
(976, 'Rollin Doni', 'CPF4140281447', 'rdonid5@symantec.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1587823436', 'B3', 'Project Manager', 'IV', 'Room 26', 2, 1, 1, NULL, '2023-07-01 18:30:00', NULL),
(977, 'Cassandry Wigelsworth', 'CPF1469148841', 'cwigelsworthd6@wired.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4922824473', 'A', 'Drilling engineer', 'II', '15th Floor', 2, 1, 1, NULL, '2023-08-21 18:30:00', NULL),
(978, 'Antin Slocombe', 'CPF1425581914', 'aslocombed7@youtube.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3675309319', 'E', 'Drilling engineer', 'II', 'Room 273', 2, 1, 1, NULL, '2022-11-24 18:30:00', NULL),
(979, 'Amberly Terbrugge', 'CPF8481860307', 'aterbrugged8@intel.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2695693602', 'E3', 'Mining engineer', 'IV', 'Room 40', 2, 1, 1, NULL, '2023-05-30 18:30:00', NULL),
(980, 'Milty Kinningley', 'CPF6583124889', 'mkinningleyd9@wsj.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7144640793', 'B2', 'Project Manager', 'III', 'Room 595', 2, 1, 1, NULL, '2023-09-16 18:30:00', NULL),
(981, 'Hanson Curwen', 'CPF6914316144', 'hcurwenda@1und1.de', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1267249147', 'B1', 'Sales and Busines', 'IV', '1st Floor', 2, 1, 1, NULL, '2023-03-05 18:30:00', NULL),
(982, 'Cordell Fallowes', 'CPF2423127879', 'cfallowesdb@mozilla.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7338536262', 'B2', 'Project Manager', 'Jr', 'Suite 95', 2, 1, 1, NULL, '2023-08-04 18:30:00', NULL),
(983, 'Janaya Baus', 'CPF9889757150', 'jbausdc@hugedomains.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7883618333', 'E1', 'Project Manager', 'Sr', 'Room 173', 2, 1, 1, NULL, '2023-02-23 18:30:00', NULL),
(984, 'Yovonnda Brumwell', 'CPF0544518155', 'ybrumwelldd@elpais.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '2607052810', 'E3', 'Energy engineer', 'Jr', 'PO Box 64006', 2, 1, 1, NULL, '2023-09-09 18:30:00', NULL),
(985, 'Patsy Martell', 'CPF4166746554', 'pmartellde@yandex.ru', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7284239520', 'A', 'Mining engineer', 'II', 'Suite 52', 2, 1, 1, NULL, '2023-03-29 18:30:00', NULL),
(986, 'Sidoney Fairhall', 'CPF3834995315', 'sfairhalldf@huffingtonpost.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4563934639', 'A', 'Project Manager', 'II', 'Room 1628', 2, 1, 1, NULL, '2023-02-19 18:30:00', NULL),
(987, 'Fredrika Olifard', 'CPF3841159485', 'folifarddg@unblog.fr', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9434784179', 'D', 'Sales and Busines', 'Jr', 'Apt 1611', 2, 1, 1, NULL, '2022-12-23 18:30:00', NULL),
(988, 'Luci Weatherell', 'CPF4939476157', 'lweatherelldh@51.la', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4566303815', 'E3', 'Technicians', 'Sr', 'PO Box 22574', 2, 1, 1, NULL, '2022-10-25 18:30:00', NULL),
(989, 'Yasmeen Molan', 'CPF2554039632', 'ymolandi@cnn.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8668777708', 'B3', 'Sales and Busines', 'II', 'Room 1733', 2, 1, 1, NULL, '2023-06-26 18:30:00', NULL),
(990, 'Isidora Gallymore', 'CPF0748192453', 'igallymoredj@google.fr', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '1118383493', 'B1', 'Mining engineer', 'III', '9th Floor', 2, 1, 1, NULL, '2023-08-09 18:30:00', NULL),
(991, 'Pernell Ciciotti', 'CPF1114157206', 'pciciottidk@hibu.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4457640950', 'E3', 'Mining engineer', 'II', '6th Floor', 2, 1, 1, NULL, '2022-11-03 18:30:00', NULL),
(992, 'Othilie McArdell', 'CPF8819095993', 'omcardelldl@cornell.edu', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '7476599726', 'B', 'Energy engineer', 'Jr', 'Room 674', 2, 1, 1, NULL, '2023-01-04 18:30:00', NULL),
(993, 'Ivette De Maine', 'CPF4484962361', 'idedm@blinklist.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4286256422', 'B1', 'Mining engineer', 'IV', 'Suite 29', 2, 1, 1, NULL, '2022-12-06 18:30:00', NULL),
(994, 'Aimee Atmore', 'CPF2749322420', 'aatmoredn@sciencedirect.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '9622130659', 'B2', 'Drilling engineer', 'IV', 'Apt 539', 2, 1, 1, NULL, '2023-08-31 18:30:00', NULL),
(995, 'Nealon Rookes', 'CPF2373610031', 'nrookesdo@theglobeandmail.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '5615419729', 'B2', 'Mining engineer', 'Jr', 'Suite 52', 2, 1, 1, NULL, '2023-04-03 18:30:00', NULL),
(996, 'Sherrie Allberry', 'CPF4932816100', 'sallberrydp@1688.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4307696451', 'B1', 'Energy engineer', 'II', 'Suite 11', 2, 1, 1, NULL, '2023-02-05 18:30:00', NULL),
(997, 'Juliane Klisch', 'CPF8359498632', 'jklischdq@boston.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6302979209', 'E3', 'Drilling engineer', 'II', 'Suite 71', 2, 1, 1, NULL, '2023-08-17 18:30:00', NULL),
(998, 'Oberon Nattrass', 'CPF8473176017', 'onattrassdr@hibu.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6365010215', 'B2', 'Sales and Busines', 'IV', 'Apt 1594', 2, 1, 1, NULL, '2022-11-20 18:30:00', NULL),
(999, 'Jessee Fermer', 'CPF2730532065', 'jfermerds@ft.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '4417157885', 'A', 'Energy engineer', 'II', 'Suite 95', 2, 1, 1, NULL, '2022-12-28 18:30:00', NULL),
(1000, 'Evangelia Coan', 'CPF9388168303', 'ecoandt@telegraph.co.uk', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '6934796525', 'B', 'Technicians', 'IV', 'Suite 68', 2, 1, 1, NULL, '2023-02-17 18:30:00', NULL),
(1001, 'Lou Schowenburg', 'CPF0987847431', 'lschowenburgdu@4shared.com', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '8642315261', 'D', 'Project Manager', 'Jr', 'PO Box 65279', 2, 1, 1, NULL, '2023-06-10 18:30:00', NULL),
(1002, 'Sharlene Gales', 'CPF7381163493', 'sgalesdv@tiny.cc', NULL, '$2y$10$sCs96PZQfX2FGrUM3QOkFOzHkGqPWl6SFKgm3aERB3PsBO8U/lnV2', '3242264268', 'B1', 'Energy engineer', 'II', '12th Floor', 2, 1, 1, NULL, '2022-12-23 18:30:00', NULL),
(1011, 'Milli Classen', 'CPF5144002885', 'mclassen2@technorati.com', NULL, '$2y$10$/3jMW3mqk0x/1Pqew17XKuYyB6oCLq6YMd.YzId2jk29t0eRmyYGm', '3394337123', 'E', 'Technicians', 'Two Star', '18284 David Crossing', 2, 1, 1, NULL, '2023-10-04 23:43:06', NULL),
(1012, 'Conni Cottham', 'CPF9462428377', 'ccottham5@miibeian.gov.cn', NULL, '$2y$10$woTYik6HlddlSzlkWE0aZuyp1rnZbqP82nm3d3NcxmpnPhTS.yI62', '5305548103', 'D', 'Energy Engineer', 'Two Star', '77692 Brickson Park Trail', 2, 1, 1, NULL, '2023-10-04 23:43:06', NULL),
(1013, 'Glori Arnault', 'CPF8852136016', 'garnault1@miibeian.gov.cn', NULL, '$2y$10$Qz6soE9wFUkKR1c6T8iLwuVla8gkKT4uprOr/vmswbfFfsE.QXjFC', '6673831700', 'A1', 'Technicians', 'Two Star', '497 Warner Place', 2, 1, 1, NULL, '2023-10-04 23:43:06', NULL),
(1014, 'Riannon Bewshea', 'CPF3748572189', 'rbewshea4@altervista.org', NULL, '$2y$10$qMrGvkPMUuggvAVyEHvyyORWW6.J/nhKaRhJqRf4u0xDKhgb0BDK6', '6779146187', 'C', 'Project Manager', 'Delux', '370 Old Shore Park', 2, 1, 1, NULL, '2023-10-04 23:43:06', NULL),
(1015, 'Vin Haggarty', 'CPF6650298944', 'vhaggarty3@rakuten.co.jp', NULL, '$2y$10$ECPskxb1aUoSG9jAKazYWOQ3jPVR3H72Vy/WwHzEFjblnUT6Zu7QW', '4219791058', 'E1', 'Mining Engineer', 'One Star', '4493 Springs Point', 2, 1, 1, NULL, '2023-10-04 23:43:06', NULL),
(1016, 'Greggory Schwand', 'CPF9910464003', 'gschwand7@ted.com', NULL, '$2y$10$Zh/1JnOtyj0.m.l2oJ8n0e2zBVp7hJ3ClN6ZA0Ylaa861Ieh94s/m', '3586287493', 'A1', 'Project Manager', 'One Star', '1 Stang Place', 2, 1, 1, NULL, '2023-10-04 23:43:07', NULL),
(1017, 'Axe Milmoe', 'CPF1127463108', 'amilmoe8@slashdot.org', NULL, '$2y$10$zJor8sslvmL1c8W0vDCdxuc23j/v3OPf6FFde/K/5nDVD8gDzqSNC', '7379447735', 'A3', 'Energy Engineer', 'Delux', '75321 Gateway Crossing', 2, 1, 1, NULL, '2023-10-04 23:43:07', NULL),
(1018, 'Celene Penhale', 'CPF7622641319', 'cpenhale6@arstechnica.com', NULL, '$2y$10$O5bxomVz7.L4vkeVqLls5.uJeDKcVaCgAeAN/VTkewAI7ymN8CkzC', '9583502133', 'A3', 'Project Manager', 'Business Class', '56 Oxford Lane', 2, 1, 1, NULL, '2023-10-04 23:43:07', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ev_id`);

--
-- Indexes for table `event_books`
--
ALTER TABLE `event_books`
  ADD PRIMARY KEY (`ev_book_id`);

--
-- Indexes for table `event_books_emp`
--
ALTER TABLE `event_books_emp`
  ADD PRIMARY KEY (`emp_ev_book_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`htl_id`);

--
-- Indexes for table `hotels_category`
--
ALTER TABLE `hotels_category`
  ADD PRIMARY KEY (`htl_cat_id`),
  ADD KEY `hotels_category_htl_idd_foreign` (`htl_idd`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_cpf_no_unique` (`cpf_no`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ev_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_books`
--
ALTER TABLE `event_books`
  MODIFY `ev_book_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `event_books_emp`
--
ALTER TABLE `event_books_emp`
  MODIFY `emp_ev_book_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `htl_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hotels_category`
--
ALTER TABLE `hotels_category`
  MODIFY `htl_cat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1019;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotels_category`
--
ALTER TABLE `hotels_category`
  ADD CONSTRAINT `hotels_category_htl_idd_foreign` FOREIGN KEY (`htl_idd`) REFERENCES `hotels` (`htl_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
