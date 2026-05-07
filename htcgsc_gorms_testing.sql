-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2026 at 08:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `htcgsc_gorms_testing`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `all_activities`
-- (See below for the actual view)
--
CREATE TABLE `all_activities` (
`referral_id` int(10) unsigned
,`student_id` decimal(10,0)
,`referrer_id` decimal(10,0)
,`created_at` timestamp
,`updated_at` timestamp
,`appointment_id` decimal(10,0)
,`referral_type` enum('Yourself','Someone Else')
,`reason` varchar(255)
,`appointment_date` date
,`appointment_time` enum('8:30 AM - 9:30 AM','9:30 AM - 10:30 AM','10:30 AM - 11:30 AM','1:30 PM - 2:30 PM','2:30 PM - 3:30 PM','3:30 PM - 4:30 PM')
,`appointment_status` enum('Scheduled','Done','Cancelled','Missed')
,`laravel_foreign_key` int(10) unsigned
,`laravel_model` varchar(22)
,`laravel_placeholders` varchar(88)
,`laravel_with` varchar(0)
);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(10) UNSIGNED NOT NULL,
  `referrer_id` int(10) UNSIGNED NOT NULL,
  `referral_id` int(10) UNSIGNED NOT NULL,
  `person_id` int(10) UNSIGNED DEFAULT NULL,
  `referral_type` enum('Yourself','Someone Else') NOT NULL,
  `reason` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` enum('8:30 AM - 9:30 AM','9:30 AM - 10:30 AM','10:30 AM - 11:30 AM','1:30 PM - 2:30 PM','2:30 PM - 3:30 PM','3:30 PM - 4:30 PM') NOT NULL,
  `appointment_status` enum('Scheduled','Done','Cancelled','Missed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `referrer_id`, `referral_id`, `person_id`, `referral_type`, `reason`, `appointment_date`, `appointment_time`, `appointment_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 46, 'Yourself', 'Quibusdam neque ea perferendis aspernatur ea doloribus temporibus.', '2026-05-19', '3:30 PM - 4:30 PM', 'Scheduled', '2026-05-03 18:03:00', '2026-05-06 09:35:05'),
(2, 2, 2, 44, 'Yourself', 'Omnis quis molestiae quo ipsam tenetur et voluptas.', '2026-06-01', '9:30 AM - 10:30 AM', 'Scheduled', '2026-04-13 06:07:27', '2026-04-13 16:19:18'),
(3, 3, 3, 49, 'Yourself', 'Eum voluptatem animi qui consequuntur temporibus est explicabo quis.', '2026-05-13', '10:30 AM - 11:30 AM', 'Scheduled', '2026-04-23 11:59:48', '2026-04-30 19:16:21'),
(4, 4, 4, 44, 'Yourself', 'Aspernatur eos tempore dolorum necessitatibus.', '2026-05-17', '8:30 AM - 9:30 AM', 'Scheduled', '2026-04-07 18:32:53', '2026-04-08 23:27:39'),
(5, 5, 5, 33, 'Yourself', 'Similique quibusdam ex expedita cumque.', '2026-05-29', '3:30 PM - 4:30 PM', 'Scheduled', '2026-05-04 10:38:22', '2026-05-05 14:41:35'),
(6, 6, 6, 32, 'Someone Else', 'Soluta nam quam sit quasi vel in repudiandae.', '2026-05-26', '10:30 AM - 11:30 AM', 'Scheduled', '2026-04-22 06:54:46', '2026-05-05 14:07:03'),
(7, 7, 7, 31, 'Someone Else', 'Modi perferendis quis voluptatem totam.', '2026-05-31', '2:30 PM - 3:30 PM', 'Scheduled', '2026-04-29 12:11:26', '2026-05-01 19:35:53'),
(8, 8, 8, 50, 'Someone Else', 'Ut eveniet et quis veritatis molestiae autem ex eaque.', '2026-05-24', '3:30 PM - 4:30 PM', 'Scheduled', '2026-04-10 06:34:05', '2026-04-16 05:59:40'),
(9, 9, 9, 53, 'Someone Else', 'Sed incidunt voluptatem maxime est.', '2026-05-08', '8:30 AM - 9:30 AM', 'Scheduled', '2026-04-27 07:27:55', '2026-04-27 09:21:07'),
(10, 10, 10, 46, 'Someone Else', 'Maxime autem nobis neque molestiae eos nostrum.', '2026-05-31', '1:30 PM - 2:30 PM', 'Scheduled', '2026-04-19 14:11:35', '2026-04-24 21:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '01_create_persons_table', 1),
(2, '02_create_students_table', 1),
(3, '03_create_users_table', 1),
(4, '04_create_referrers_table', 1),
(5, '05_create_referrals_table', 1),
(6, '06_create_appointments_table', 1),
(7, '07_create_reports_table', 1),
(8, '08_create_all_activities_view', 1),
(9, 'create_cache_locks_table', 1),
(10, 'create_cache_table', 1),
(11, 'create_failed_jobs_table', 1),
(12, 'create_job_batches_table', 1),
(13, 'create_jobs_table', 1),
(14, 'create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `person_id` int(10) UNSIGNED NOT NULL,
  `type` enum('Administrator','Employee','Student') NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `suffix` enum('Sr.','Jr.','II','III','IV','V','VI') DEFAULT NULL,
  `email_address` varchar(60) NOT NULL,
  `phone_number` varchar(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`person_id`, `type`, `last_name`, `first_name`, `middle_name`, `suffix`, `email_address`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Cariaga', 'Benhur', 'Leproso', NULL, 'bencariaga13@gmail.com', '09939597683', '2026-04-15 19:55:47', '2026-04-22 11:04:33'),
(2, 'Employee', 'Reilly', 'Kirk', 'Tremblay', NULL, 'ocrooks@gmail.com', '09986143220', '2026-04-26 23:45:49', '2026-04-30 02:33:23'),
(3, 'Employee', 'Bauch', 'Stephan', 'Yundt', NULL, 'isaac.murray@gmail.com', '09089305169', '2026-05-01 17:43:57', '2026-05-03 21:42:23'),
(4, 'Employee', 'Bednar', 'Turner', 'Grady', NULL, 'elinor.heidenreich@gmail.com', '09089458762', '2026-05-05 01:10:03', '2026-05-06 12:36:41'),
(5, 'Employee', 'Schoen', 'Margie', 'Muller', NULL, 'rfranecki@gmail.com', '09983330165', '2026-04-14 10:32:16', '2026-05-01 17:26:17'),
(6, 'Employee', 'Walker', 'Pascale', 'Lind', 'V', 'myah.kunde@gmail.com', '09987900815', '2026-04-13 20:06:28', '2026-04-23 01:09:50'),
(7, 'Employee', 'Schneider', 'Paxton', 'Daugherty', NULL, 'zrunolfsson@gmail.com', '09204132521', '2026-05-01 00:16:43', '2026-05-02 01:10:22'),
(8, 'Employee', 'Kovacek', 'Mariana', 'Cruickshank', NULL, 'ozella.keeling@gmail.com', '09175105904', '2026-04-27 08:18:11', '2026-04-30 20:25:30'),
(9, 'Employee', 'Lind', 'Lambert', 'Reynolds', NULL, 'wwolff@gmail.com', '09176508819', '2026-04-12 02:59:01', '2026-04-30 17:27:04'),
(10, 'Employee', 'Buckridge', 'Duncan', 'Herman', NULL, 'glind@gmail.com', '09199871201', '2026-05-03 16:59:18', '2026-05-06 06:59:12'),
(11, 'Employee', 'Kerluke', 'Kianna', 'Mueller', NULL, 'sunny.tremblay@gmail.com', '09197525049', '2026-05-06 16:03:23', '2026-05-07 01:24:09'),
(12, 'Employee', 'Runolfsdottir', 'Virgil', 'Daugherty', NULL, 'awuckert@gmail.com', '09186910031', '2026-04-30 23:49:33', '2026-05-02 08:06:32'),
(13, 'Employee', 'Quigley', 'Curt', 'Renner', NULL, 'nkuvalis@gmail.com', '09189592158', '2026-04-14 09:57:05', '2026-04-30 20:39:14'),
(14, 'Employee', 'Rice', 'Doris', 'Hand', NULL, 'qgreenfelder@gmail.com', '09192032013', '2026-04-28 04:49:16', '2026-04-28 09:30:43'),
(15, 'Employee', 'Funk', 'Lenore', 'Rau', NULL, 'fhoppe@gmail.com', '09207083612', '2026-05-04 09:17:09', '2026-05-06 16:05:24'),
(16, 'Employee', 'VonRueden', 'Fae', 'Doyle', NULL, 'margret43@gmail.com', '09180318668', '2026-05-06 08:12:48', '2026-05-07 03:29:31'),
(17, 'Employee', 'Hand', 'Roberto', 'Schimmel', 'III', 'jacynthe.zieme@gmail.com', '09184439852', '2026-05-06 18:00:45', '2026-05-07 05:18:08'),
(18, 'Employee', 'Block', 'Tess', 'Conroy', NULL, 'ekerluke@gmail.com', '09195287955', '2026-04-07 20:09:04', '2026-04-27 03:24:30'),
(19, 'Employee', 'Parker', 'Brandy', 'Johnson', NULL, 'araceli41@gmail.com', '09989851794', '2026-04-12 23:07:12', '2026-04-24 03:03:29'),
(20, 'Employee', 'Corwin', 'Kane', 'Cartwright', NULL, 'stehr.elbert@gmail.com', '09983397069', '2026-05-02 04:18:27', '2026-05-05 19:57:02'),
(21, 'Employee', 'Baumbach', 'Mireya', 'Windler', NULL, 'douglas.freida@gmail.com', '09084438403', '2026-04-07 17:34:34', '2026-04-11 03:23:00'),
(22, 'Employee', 'McClure', 'Alberto', 'Kuhic', NULL, 'zachery45@gmail.com', '09089068296', '2026-05-01 06:52:29', '2026-05-01 23:50:32'),
(23, 'Employee', 'Dach', 'Cornelius', 'Nicolas', NULL, 'blaze94@gmail.com', '09185905579', '2026-04-14 10:23:09', '2026-04-28 04:36:51'),
(24, 'Employee', 'Green', 'Haven', 'Haley', 'Jr.', 'scotty47@gmail.com', '09986209373', '2026-04-18 01:13:52', '2026-04-19 07:31:47'),
(25, 'Employee', 'Balistreri', 'Pauline', 'Robel', 'Sr.', 'lesley83@gmail.com', '09180928134', '2026-04-20 21:08:33', '2026-04-22 13:44:35'),
(26, 'Employee', 'Hegmann', 'Angus', 'Bogisich', NULL, 'gleason.rachelle@gmail.com', '09209194275', '2026-05-04 04:23:21', '2026-05-06 17:41:09'),
(27, 'Employee', 'Terry', 'Eduardo', 'Schiller', 'Sr.', 'lynn06@gmail.com', '09980118326', '2026-04-10 06:22:02', '2026-05-02 02:18:52'),
(28, 'Employee', 'Herman', 'Carol', 'Hoeger', NULL, 'amelie96@gmail.com', '09182872044', '2026-04-11 04:05:51', '2026-04-27 08:36:10'),
(29, 'Employee', 'Blick', 'Adrian', 'Kessler', NULL, 'tyson11@gmail.com', '09089999828', '2026-04-09 04:51:37', '2026-04-10 22:27:31'),
(30, 'Employee', 'Legros', 'Thurman', 'Klein', NULL, 'gregory77@gmail.com', '09195652679', '2026-04-19 20:07:05', '2026-04-29 06:00:34'),
(31, 'Student', 'Hartmann', 'Irma', 'Flatley', NULL, 'antoinette.hackett@online.htcgsc.edu.ph', '09981083800', '2026-04-19 22:37:58', '2026-05-02 13:18:59'),
(32, 'Student', 'Stiedemann', 'Kiel', 'Muller', NULL, 'funk.abdullah@online.htcgsc.edu.ph', '09082216158', '2026-05-04 15:23:05', '2026-05-04 21:40:03'),
(33, 'Student', 'Russel', 'Demarco', 'Mills', NULL, 'garrison16@online.htcgsc.edu.ph', '09187515413', '2026-05-07 02:58:46', '2026-05-07 05:27:20'),
(34, 'Student', 'Bosco', 'Jess', 'Stanton', NULL, 'eino.reinger@online.htcgsc.edu.ph', '09186842773', '2026-05-06 14:12:04', '2026-05-06 15:32:09'),
(35, 'Student', 'Roob', 'Dorthy', 'Thiel', NULL, 'lrath@online.htcgsc.edu.ph', '09176171596', '2026-04-11 14:12:15', '2026-04-17 03:19:47'),
(36, 'Student', 'Hintz', 'Herta', 'Gibson', NULL, 'oconnell.elenor@online.htcgsc.edu.ph', '09181700899', '2026-04-23 00:50:02', '2026-05-01 15:28:04'),
(37, 'Student', 'Pagac', 'Kitty', 'Zulauf', NULL, 'carroll.alvis@online.htcgsc.edu.ph', '09192130196', '2026-05-01 13:07:16', '2026-05-04 16:26:11'),
(38, 'Student', 'Nienow', 'Lula', 'Klein', NULL, 'chloe21@online.htcgsc.edu.ph', '09089563957', '2026-04-16 10:46:31', '2026-04-19 20:57:26'),
(39, 'Student', 'Grant', 'Jackson', 'Schuppe', NULL, 'kdamore@online.htcgsc.edu.ph', '09981507050', '2026-04-17 12:03:56', '2026-04-26 02:32:03'),
(40, 'Student', 'Parker', 'Reece', 'Bailey', NULL, 'gregg.kohler@online.htcgsc.edu.ph', '09984262407', '2026-04-20 23:13:29', '2026-04-21 05:37:39'),
(41, 'Student', 'Greenfelder', 'Caitlyn', 'Rodriguez', NULL, 'bbartoletti@online.htcgsc.edu.ph', '09180862092', '2026-04-27 21:36:20', '2026-04-28 21:30:20'),
(42, 'Student', 'Schoen', 'Maudie', 'Gleason', NULL, 'sipes.donald@online.htcgsc.edu.ph', '09088164269', '2026-04-07 16:54:45', '2026-04-08 15:05:31'),
(43, 'Student', 'Crona', 'Mohamed', 'Howell', NULL, 'pschaefer@online.htcgsc.edu.ph', '09082928553', '2026-04-29 13:33:20', '2026-05-07 01:43:14'),
(44, 'Student', 'Lindgren', 'Fredrick', 'Heidenreich', NULL, 'rlittel@online.htcgsc.edu.ph', '09183827052', '2026-04-23 14:03:54', '2026-04-27 22:01:40'),
(45, 'Student', 'Harber', 'Clovis', 'Pollich', NULL, 'murazik.tomas@online.htcgsc.edu.ph', '09982417309', '2026-05-03 02:44:35', '2026-05-04 10:35:25'),
(46, 'Student', 'Fadel', 'Sammy', 'Feil', NULL, 'jarod26@online.htcgsc.edu.ph', '09087336410', '2026-04-07 23:32:01', '2026-04-19 01:39:30'),
(47, 'Student', 'Schoen', 'Davin', 'Jacobson', NULL, 'ldaniel@online.htcgsc.edu.ph', '09192949092', '2026-04-20 06:39:58', '2026-04-29 04:57:16'),
(48, 'Student', 'Boyle', 'Sheridan', 'Labadie', NULL, 'aorn@online.htcgsc.edu.ph', '09989685895', '2026-04-28 00:55:02', '2026-05-07 00:58:49'),
(49, 'Student', 'Kovacek', 'Elnora', 'Koepp', NULL, 'cleve.mclaughlin@online.htcgsc.edu.ph', '09204160693', '2026-04-28 23:23:04', '2026-05-02 15:21:13'),
(50, 'Student', 'Kuhlman', 'Sibyl', 'Green', 'IV', 'wyman39@online.htcgsc.edu.ph', '09190158599', '2026-04-27 16:47:15', '2026-05-02 04:39:33'),
(51, 'Student', 'Davis', 'Elaina', 'Welch', 'VI', 'xbaumbach@online.htcgsc.edu.ph', '09080798407', '2026-04-13 14:55:06', '2026-04-25 07:33:14'),
(52, 'Student', 'Corkery', 'Felipa', 'Metz', NULL, 'qdurgan@online.htcgsc.edu.ph', '09183447866', '2026-04-17 14:08:49', '2026-05-04 20:26:01'),
(53, 'Student', 'O\'Keefe', 'Pattie', 'O\'Hara', NULL, 'kaycee67@online.htcgsc.edu.ph', '09176145950', '2026-05-03 21:34:51', '2026-05-06 09:04:16'),
(54, 'Student', 'Lakin', 'Shanny', 'Wehner', 'IV', 'bernier.lisette@online.htcgsc.edu.ph', '09200937926', '2026-05-04 02:53:08', '2026-05-06 15:28:55'),
(55, 'Student', 'Kemmer', 'Neva', 'Gusikowski', 'Jr.', 'carter.lesly@online.htcgsc.edu.ph', '09208312745', '2026-04-18 13:49:20', '2026-04-29 18:42:22'),
(56, 'Student', 'Jacobs', 'Okey', 'Tremblay', NULL, 'howe.domenick@online.htcgsc.edu.ph', '09986479272', '2026-05-06 08:04:48', '2026-05-07 00:39:29'),
(57, 'Student', 'Batz', 'Lesley', 'Senger', NULL, 'vbechtelar@online.htcgsc.edu.ph', '09172045454', '2026-05-06 17:34:56', '2026-05-06 22:14:49'),
(58, 'Student', 'Champlin', 'Henderson', 'Hartmann', NULL, 'jerod.fay@online.htcgsc.edu.ph', '09987693031', '2026-04-26 18:40:55', '2026-05-06 09:25:51'),
(59, 'Student', 'Mayert', 'Granville', 'Heathcote', 'II', 'craig08@online.htcgsc.edu.ph', '09183466710', '2026-05-05 20:25:07', '2026-05-06 05:21:37'),
(60, 'Student', 'Volkman', 'Adrianna', 'Barton', NULL, 'kdaniel@online.htcgsc.edu.ph', '09178374600', '2026-05-02 08:09:52', '2026-05-02 21:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `referral_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`referral_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 16, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(2, 14, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(3, 19, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(4, 14, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(5, 3, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(6, 2, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(7, 1, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(8, 20, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(9, 23, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(10, 16, '2026-05-07 06:43:25', '2026-05-07 06:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `referrers`
--

CREATE TABLE `referrers` (
  `referrer_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrers`
--

INSERT INTO `referrers` (`referrer_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 29, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(2, 15, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(3, 12, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(4, 3, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(5, 14, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(6, 13, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(7, 28, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(8, 2, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(9, 5, '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(10, 6, '2026-05-07 06:43:25', '2026-05-07 06:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `data_category` enum('Users','Students','Form Submissions') NOT NULL,
  `file_output_format` enum('PDF Document','Excel Spreadsheet') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `title`, `start_date`, `end_date`, `data_category`, `file_output_format`, `created_at`, `updated_at`) VALUES
(1, 'Vel explicabo qui.', '2026-01-29', '2026-06-07', 'Form Submissions', 'PDF Document', '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(2, 'Dolor ut esse non.', '2025-11-12', '2026-05-19', 'Users', 'PDF Document', '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(3, 'Nisi esse quo ea.', '2025-08-08', '2026-06-03', 'Users', 'Excel Spreadsheet', '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(4, 'Eum sapiente magni.', '2025-11-21', '2026-05-27', 'Users', 'Excel Spreadsheet', '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(5, 'Molestiae iure.', '2025-10-10', '2026-05-26', 'Form Submissions', 'Excel Spreadsheet', '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(6, 'Aliquam sunt sunt.', '2025-06-26', '2026-05-24', 'Students', 'PDF Document', '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(7, 'Et quia quia.', '2026-02-23', '2026-05-30', 'Form Submissions', 'PDF Document', '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(8, 'Ullam officiis.', '2025-05-23', '2026-05-08', 'Users', 'PDF Document', '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(9, 'Eos numquam odit.', '2026-02-15', '2026-05-29', 'Form Submissions', 'PDF Document', '2026-05-07 06:43:25', '2026-05-07 06:43:25'),
(10, 'Temporibus suscipit.', '2026-01-19', '2026-05-15', 'Users', 'PDF Document', '2026-05-07 06:43:25', '2026-05-07 06:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(10) UNSIGNED NOT NULL,
  `person_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `person_id`, `created_at`, `updated_at`) VALUES
(1, 31, '2026-04-26 02:36:20', '2026-05-01 23:23:51'),
(2, 32, '2026-04-20 17:48:28', '2026-04-29 06:42:38'),
(3, 33, '2026-04-23 02:17:09', '2026-04-30 00:26:17'),
(4, 34, '2026-04-28 11:29:12', '2026-04-29 18:48:28'),
(5, 35, '2026-05-06 22:05:06', '2026-05-07 05:16:01'),
(6, 36, '2026-04-23 11:04:15', '2026-05-04 16:13:21'),
(7, 37, '2026-04-26 15:42:30', '2026-05-02 11:40:09'),
(8, 38, '2026-04-15 09:50:50', '2026-04-25 21:33:40'),
(9, 39, '2026-04-17 08:42:18', '2026-04-22 09:23:35'),
(10, 40, '2026-05-05 07:49:04', '2026-05-06 18:41:17'),
(11, 41, '2026-05-07 06:43:21', '2026-05-07 06:43:24'),
(12, 42, '2026-04-09 16:29:00', '2026-04-22 13:20:02'),
(13, 43, '2026-05-03 23:53:30', '2026-05-04 12:53:42'),
(14, 44, '2026-05-06 20:27:51', '2026-05-06 22:31:19'),
(15, 45, '2026-04-25 00:39:15', '2026-04-30 01:18:56'),
(16, 46, '2026-04-20 15:11:34', '2026-04-24 09:20:09'),
(17, 47, '2026-04-25 05:33:01', '2026-04-26 00:16:50'),
(18, 48, '2026-04-15 13:42:32', '2026-04-18 08:38:08'),
(19, 49, '2026-04-21 08:30:59', '2026-04-25 16:06:59'),
(20, 50, '2026-04-22 15:32:03', '2026-04-24 00:08:00'),
(21, 51, '2026-04-10 11:46:06', '2026-04-25 08:37:33'),
(22, 52, '2026-04-22 21:16:13', '2026-04-27 18:05:34'),
(23, 53, '2026-04-28 21:48:14', '2026-05-03 04:43:38'),
(24, 54, '2026-05-02 23:25:11', '2026-05-05 08:34:59'),
(25, 55, '2026-04-30 18:16:59', '2026-05-03 05:47:31'),
(26, 56, '2026-04-10 13:59:52', '2026-05-06 21:24:12'),
(27, 57, '2026-05-06 03:48:18', '2026-05-06 20:21:42'),
(28, 58, '2026-04-07 08:37:32', '2026-04-11 22:04:01'),
(29, 59, '2026-05-02 13:18:27', '2026-05-03 09:09:41'),
(30, 60, '2026-04-13 11:41:36', '2026-04-23 07:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `person_id` int(10) UNSIGNED NOT NULL,
  `account_status` enum('Inactive','Active') NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `person_id`, `account_status`, `password`, `profile_picture`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Active', '$2y$04$SCAA18Js1K.AAiOkEGoVEuCu/pI74XTmZeXLjSNcrmhIndYuwGtHi', NULL, NULL, '2026-04-24 09:34:14', '2026-05-01 14:53:47'),
(2, 2, 'Active', '$2y$04$GBEdyGqx4tfrPFM1nIND1.Y1fdkytsSvwOX7dDNbzc9ZvOiVlA3wa', NULL, NULL, '2026-04-19 22:13:46', '2026-05-04 14:06:59'),
(3, 3, 'Active', '$2y$04$IdiHM/7swRXpqj3q2CulVuSJLyRoaOp7IgDYxjQrNt7FP1ihYHDwe', NULL, NULL, '2026-04-16 05:42:21', '2026-04-25 10:17:26'),
(4, 4, 'Active', '$2y$04$U3sMqJdSbwXfSDqgL0OVR.AQIVUdjBd7NjQDF/vQTCcdJouenYC7C', NULL, NULL, '2026-04-08 23:01:19', '2026-04-19 11:14:20'),
(5, 5, 'Active', '$2y$04$w1wQy3zXfpf8hXdvxRQ4m.VGVS/wyCWS2qIG4cY4xScPPkOKpkNQG', NULL, NULL, '2026-04-16 01:01:35', '2026-05-04 01:45:21'),
(6, 6, 'Active', '$2y$04$gQW1M46uTnd7vB2C5fWzTunN88/ZQJKMIUzhpF4mgO2z7Mi5kkdLm', NULL, NULL, '2026-04-09 14:47:09', '2026-04-20 06:51:33'),
(7, 7, 'Active', '$2y$04$GqJgKZZZIcSk0VwCCgwmzuIPD6XHs5ujC/TXCSShFcuUFn.8wejU.', NULL, NULL, '2026-04-18 19:03:00', '2026-04-28 21:37:43'),
(8, 8, 'Active', '$2y$04$F6y5dbR4OJ4u.5F0fBekRO.UKYyr8M952iqBmroFeJdRRxGGvqPUW', NULL, NULL, '2026-04-16 13:22:54', '2026-04-28 09:23:42'),
(9, 9, 'Active', '$2y$04$H6cEdpNgjUIKE2gb/gWqC.mCnEZUGe4GxSoKh2z4IyhLrf5n7myBa', NULL, NULL, '2026-04-20 22:28:38', '2026-04-27 23:42:33'),
(10, 10, 'Active', '$2y$04$WKhojtZqdJXM97432DCIFuoQMVSi9eqpELHNlOyPGqF5EtWTEwVuW', NULL, NULL, '2026-04-13 03:03:48', '2026-04-30 19:40:13'),
(11, 11, 'Active', '$2y$04$Rx6T21uOajC8GLwmDqeY2u.5kz2Irshc38h9I9HJuDO3NF2pKGBfK', NULL, NULL, '2026-04-19 15:54:41', '2026-05-05 21:37:51'),
(12, 12, 'Inactive', '$2y$04$oRHmCNe28lVSxCMdV9.2o.bqFF/iSWwx0XI86MScSHX3FXgvjsjtG', NULL, NULL, '2026-04-17 09:36:01', '2026-04-24 02:04:51'),
(13, 13, 'Inactive', '$2y$04$Jyd//xh5WeUcd6wgXPd3beKxwikmpRfbbVnir1UTs.7lLP0XZ5khm', NULL, NULL, '2026-05-02 17:30:09', '2026-05-04 03:24:40'),
(14, 14, 'Inactive', '$2y$04$IWJUi46c7sMvEWAZiepjAe6URwmB9FFmtRprgpgNy.OLKnKai3c3a', NULL, NULL, '2026-04-22 05:03:39', '2026-05-01 17:20:15'),
(15, 15, 'Inactive', '$2y$04$a51FJASE6tqQ.zG.neP0PO5.CYTyUawTY10p2U6FQopCUg3KtVIxS', NULL, NULL, '2026-04-08 13:23:10', '2026-04-29 04:17:06'),
(16, 16, 'Inactive', '$2y$04$wy.oM2WuoiQGLt0RejmCY.4NZGrZSe/YH3PZ8P6R9UowffCGDGP9K', NULL, NULL, '2026-04-18 16:31:39', '2026-05-04 08:42:56'),
(17, 17, 'Inactive', '$2y$04$N1fHna6fkyk4vsxsHiLoLeXUdtCrJMNQQijpWhU92Z1VA5qQCcBku', NULL, NULL, '2026-04-25 16:36:59', '2026-04-30 22:03:51'),
(18, 18, 'Inactive', '$2y$04$nA/ycmsCWVmPSC1PhIWcfOznmndovF2w0pSg8RV4YdusN/xJ87qQC', NULL, NULL, '2026-05-05 20:47:55', '2026-05-06 15:58:32'),
(19, 19, 'Inactive', '$2y$04$nWx.KjNKuV63z4UBRxNNje09pXufeMDiQmf382cPf9v25/RhHXUFu', NULL, NULL, '2026-04-20 03:24:55', '2026-04-23 11:28:20'),
(20, 20, 'Inactive', '$2y$04$FyBtA.8kg9l5xWb0BzYKdu3/YMz4ELXjYfTXvXHi6vNsQljJBOrE.', NULL, NULL, '2026-05-05 02:38:12', '2026-05-06 02:49:00'),
(21, 21, 'Inactive', '$2y$04$85ZPAQvZ.1Drqa/2unMUNurkeiCQII5GVrkiTYetXMiWKUFqwXfUm', NULL, NULL, '2026-04-12 08:20:19', '2026-05-01 13:13:15'),
(22, 22, 'Inactive', '$2y$04$uUE1qdOUcr/Gww1p1qsineeurVksl34Hzt8A/7t5KOT.2xTilDqrm', NULL, NULL, '2026-04-13 09:03:51', '2026-04-15 06:15:38'),
(23, 23, 'Inactive', '$2y$04$cgnoFtBCXlSqwdGOvUYsq.AtGK1wIJeCkJw3q5F7BTSMYqLb5yl/K', NULL, NULL, '2026-05-02 01:37:15', '2026-05-07 02:00:05'),
(24, 24, 'Inactive', '$2y$04$Wgtu5Tr6fAJbtRcSlS03jedyS2Pyj.bxGuhL3JvRmmtyT6NCxdJ2W', NULL, NULL, '2026-04-28 10:21:58', '2026-05-02 15:37:00'),
(25, 25, 'Inactive', '$2y$04$JUtsr4Pf5dG08AlUYa522ePsf8O6/QwlD5/eK.ilqFJ2dnLTDMGjW', NULL, NULL, '2026-04-28 07:22:48', '2026-05-05 06:39:42'),
(26, 26, 'Inactive', '$2y$04$V1OXIa50mZM0r.LsAlS4geD3HSD/jOXCpCLYP76dKnPmxr0Ki4XzC', NULL, NULL, '2026-04-28 11:38:22', '2026-05-05 22:18:22'),
(27, 27, 'Inactive', '$2y$04$v2rs5b2ocyvr8m.0JXQzZe6UB8BuEcohEIhLDcxUuACPs4cpMP9ze', NULL, NULL, '2026-04-10 10:47:47', '2026-05-04 23:43:15'),
(28, 28, 'Inactive', '$2y$04$brouYF7V9zTUhUYKr/g40OhTDtaw.ARcSxlfDnVuu.bt/qn3hEAc2', NULL, NULL, '2026-05-01 03:23:20', '2026-05-01 11:18:33'),
(29, 29, 'Inactive', '$2y$04$0578Irupc1oJElZfupKFHedWQUznoqgEVHKFrfntviNcmozpQ5nDa', NULL, NULL, '2026-04-15 10:56:38', '2026-04-20 16:49:30'),
(30, 30, 'Inactive', '$2y$04$ttxZNTkZMikReAytvALAnOtZwE5f77PKjdmC9rQNmqxqIovqnUJhC', NULL, NULL, '2026-04-21 00:25:54', '2026-05-04 02:43:13');

-- --------------------------------------------------------

--
-- Structure for view `all_activities`
--
DROP TABLE IF EXISTS `all_activities`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `all_activities`  AS SELECT `referrals`.`referral_id` AS `referral_id`, `referrals`.`student_id` AS `student_id`, NULL AS `referrer_id`, `referrals`.`created_at` AS `created_at`, `referrals`.`updated_at` AS `updated_at`, NULL AS `appointment_id`, NULL AS `referral_type`, NULL AS `reason`, NULL AS `appointment_date`, NULL AS `appointment_time`, NULL AS `appointment_status`, `referrals`.`student_id` AS `laravel_foreign_key`, 'App\\Models\\Referral' AS `laravel_model`, 'appointment_id,referral_type,reason,appointment_date,appointment_time,appointment_status' AS `laravel_placeholders`, '' AS `laravel_with` FROM `referrals`union all select `appointments`.`referral_id` AS `referral_id`,NULL AS `student_id`,`appointments`.`referrer_id` AS `referrer_id`,`appointments`.`created_at` AS `created_at`,`appointments`.`updated_at` AS `updated_at`,`appointments`.`appointment_id` AS `appointment_id`,`appointments`.`referral_type` AS `referral_type`,`appointments`.`reason` AS `reason`,`appointments`.`appointment_date` AS `appointment_date`,`appointments`.`appointment_time` AS `appointment_time`,`appointments`.`appointment_status` AS `appointment_status`,`referrals`.`student_id` AS `laravel_foreign_key`,'App\\Models\\Appointment' AS `laravel_model`,'student_id' AS `laravel_placeholders`,'' AS `laravel_with` from (`appointments` join `referrals` on(`referrals`.`referral_id` = `appointments`.`referral_id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `appointments_referrer_id_foreign` (`referrer_id`),
  ADD KEY `appointments_referral_id_foreign` (`referral_id`),
  ADD KEY `appointments_person_id_foreign` (`person_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`referral_id`),
  ADD KEY `referrals_student_id_foreign` (`student_id`);

--
-- Indexes for table `referrers`
--
ALTER TABLE `referrers`
  ADD PRIMARY KEY (`referrer_id`),
  ADD KEY `referrers_student_id_foreign` (`student_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `students_person_id_foreign` (`person_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `users_person_id_foreign` (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `referral_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `referrers`
--
ALTER TABLE `referrers`
  MODIFY `referrer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_referral_id_foreign` FOREIGN KEY (`referral_id`) REFERENCES `referrals` (`referral_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_referrer_id_foreign` FOREIGN KEY (`referrer_id`) REFERENCES `referrers` (`referrer_id`) ON DELETE CASCADE;

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `referrers`
--
ALTER TABLE `referrers`
  ADD CONSTRAINT `referrers_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
