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
-- Database: `htcgsc_gorms`
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
(1, 1, 1, 42, 'Yourself', 'Ducimus asperiores voluptas sed maxime harum quisquam quidem.', '2026-05-25', '1:30 PM - 2:30 PM', 'Scheduled', '2026-04-16 04:50:36', '2026-04-26 16:19:53'),
(2, 2, 2, 54, 'Yourself', 'Commodi dicta voluptatem voluptas voluptas ea.', '2026-06-04', '8:30 AM - 9:30 AM', 'Scheduled', '2026-05-05 09:47:42', '2026-05-06 06:15:44'),
(3, 3, 3, 57, 'Yourself', 'Praesentium harum eveniet aut quae quae reprehenderit aut.', '2026-05-20', '3:30 PM - 4:30 PM', 'Scheduled', '2026-05-05 22:52:54', '2026-05-07 05:43:34'),
(4, 4, 4, 43, 'Yourself', 'Alias omnis in dignissimos animi tempore ea commodi expedita.', '2026-05-16', '9:30 AM - 10:30 AM', 'Scheduled', '2026-04-22 02:18:55', '2026-04-25 16:22:35'),
(5, 5, 5, 43, 'Yourself', 'Neque magnam necessitatibus sit sit.', '2026-05-14', '9:30 AM - 10:30 AM', 'Scheduled', '2026-04-10 22:23:04', '2026-04-22 10:30:48'),
(6, 6, 6, 57, 'Someone Else', 'Quos in voluptates aut dolor deleniti.', '2026-05-31', '9:30 AM - 10:30 AM', 'Scheduled', '2026-04-20 02:41:57', '2026-05-04 05:37:58'),
(7, 7, 7, 47, 'Someone Else', 'Beatae quis deleniti dolore.', '2026-05-23', '3:30 PM - 4:30 PM', 'Scheduled', '2026-04-18 06:11:52', '2026-04-27 13:13:14'),
(8, 8, 8, 37, 'Someone Else', 'Nobis eaque doloremque in ut.', '2026-06-03', '2:30 PM - 3:30 PM', 'Scheduled', '2026-04-24 06:10:48', '2026-04-28 13:48:38'),
(9, 9, 9, 38, 'Someone Else', 'Sit omnis exercitationem vero sed quisquam aut culpa.', '2026-05-18', '1:30 PM - 2:30 PM', 'Scheduled', '2026-05-02 04:44:04', '2026-05-06 23:21:30'),
(10, 10, 10, 46, 'Someone Else', 'Enim veniam alias harum repudiandae.', '2026-05-16', '9:30 AM - 10:30 AM', 'Scheduled', '2026-05-02 05:16:12', '2026-05-05 01:03:15');

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
(1, 'create_cache_locks_table', 1),
(2, 'create_cache_table', 1),
(3, 'create_failed_jobs_table', 1),
(4, 'create_job_batches_table', 1),
(5, 'create_jobs_table', 1),
(6, 'create_sessions_table', 1),
(7, '01_create_persons_table', 2),
(8, '02_create_students_table', 3),
(9, '03_create_users_table', 4),
(10, '04_create_referrers_table', 5),
(11, '05_create_referrals_table', 6),
(12, '06_create_appointments_table', 7),
(13, '07_create_reports_table', 8),
(14, '08_create_all_activities_view', 9);

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
(1, 'Administrator', 'Cariaga', 'Benhur', 'Leproso', NULL, 'bencariaga13@gmail.com', '09939597683', '2026-04-16 21:58:43', '2026-04-23 07:32:04'),
(2, 'Employee', 'Boehm', 'London', 'Jast', NULL, 'edickinson@gmail.com', '09204510534', '2026-04-11 17:55:24', '2026-05-04 06:26:55'),
(3, 'Employee', 'Yost', 'Jessy', 'Fritsch', NULL, 'esmeralda.johnston@gmail.com', '09171594681', '2026-04-13 12:14:32', '2026-04-27 20:48:01'),
(4, 'Employee', 'Kilback', 'Robb', 'Feeney', 'V', 'pprice@gmail.com', '09190398532', '2026-04-11 16:46:06', '2026-04-29 06:22:23'),
(5, 'Employee', 'Hyatt', 'Bobby', 'Turcotte', NULL, 'peyton72@gmail.com', '09202875802', '2026-04-27 22:42:32', '2026-04-29 09:45:56'),
(6, 'Employee', 'Becker', 'Litzy', 'Hansen', NULL, 'dooley.morris@gmail.com', '09086993909', '2026-04-29 07:04:51', '2026-05-04 17:35:57'),
(7, 'Employee', 'Hoppe', 'Liliane', 'Bailey', NULL, 'matt.koelpin@gmail.com', '09181011785', '2026-04-20 01:38:53', '2026-04-30 14:23:37'),
(8, 'Employee', 'Wintheiser', 'Sid', 'Fahey', NULL, 'roselyn98@gmail.com', '09176616479', '2026-04-16 04:01:04', '2026-04-19 09:43:57'),
(9, 'Employee', 'Buckridge', 'Brittany', 'Krajcik', NULL, 'aurore70@gmail.com', '09192920879', '2026-04-25 02:38:04', '2026-05-04 07:55:13'),
(10, 'Employee', 'Schneider', 'Velda', 'Gleason', NULL, 'isabelle33@gmail.com', '09208626123', '2026-04-23 06:33:45', '2026-05-02 11:23:00'),
(11, 'Employee', 'Lubowitz', 'Maynard', 'Kulas', NULL, 'sawayn.kari@gmail.com', '09186441984', '2026-04-27 20:34:16', '2026-05-04 15:59:38'),
(12, 'Employee', 'Bruen', 'Stone', 'Ritchie', NULL, 'barney.kuhn@gmail.com', '09173999963', '2026-04-25 21:46:43', '2026-04-27 15:54:58'),
(13, 'Employee', 'Borer', 'Marielle', 'Sawayn', 'Jr.', 'xjenkins@gmail.com', '09189544917', '2026-04-19 15:08:18', '2026-05-01 22:49:59'),
(14, 'Employee', 'Towne', 'Elmo', 'Ullrich', NULL, 'henri49@gmail.com', '09194306141', '2026-04-23 23:17:13', '2026-04-29 17:09:39'),
(15, 'Employee', 'Kirlin', 'Edna', 'Auer', NULL, 'nkris@gmail.com', '09174694792', '2026-04-12 18:14:28', '2026-04-20 08:00:34'),
(16, 'Employee', 'Halvorson', 'Cortez', 'Kunze', 'III', 'lflatley@gmail.com', '09183012735', '2026-04-17 14:24:55', '2026-04-28 12:24:42'),
(17, 'Employee', 'Feest', 'Alexandria', 'Lang', 'V', 'mccullough.rebeka@gmail.com', '09201935025', '2026-04-10 03:20:44', '2026-05-04 15:50:52'),
(18, 'Employee', 'Kris', 'Alexanne', 'Pouros', NULL, 'ben18@gmail.com', '09086685610', '2026-04-19 13:41:32', '2026-05-03 09:07:40'),
(19, 'Employee', 'Mayert', 'Ramiro', 'Weissnat', NULL, 'kaelyn.paucek@gmail.com', '09177180636', '2026-04-09 15:45:18', '2026-04-27 10:40:07'),
(20, 'Employee', 'Welch', 'Reginald', 'Berge', NULL, 'obeatty@gmail.com', '09172654853', '2026-05-02 06:26:50', '2026-05-05 03:38:07'),
(21, 'Employee', 'Jenkins', 'Melisa', 'Hirthe', NULL, 'bboyer@gmail.com', '09080623204', '2026-04-08 07:33:22', '2026-04-28 12:03:02'),
(22, 'Employee', 'Botsford', 'Manuel', 'Collins', NULL, 'tessie16@gmail.com', '09199842871', '2026-04-15 11:09:10', '2026-05-06 14:09:01'),
(23, 'Employee', 'Bradtke', 'Amari', 'Pfeffer', NULL, 'hwintheiser@gmail.com', '09084992118', '2026-04-10 06:03:11', '2026-05-02 20:53:31'),
(24, 'Employee', 'Hamill', 'Juana', 'Douglas', 'VI', 'swaniawski.ernestina@gmail.com', '09172787791', '2026-05-02 22:08:30', '2026-05-06 00:00:59'),
(25, 'Employee', 'Veum', 'Gerardo', 'Okuneva', 'II', 'xdaniel@gmail.com', '09181372882', '2026-05-04 02:08:04', '2026-05-04 21:32:54'),
(26, 'Employee', 'Conroy', 'Afton', 'Jones', NULL, 'henriette76@gmail.com', '09182994135', '2026-04-13 16:23:47', '2026-04-21 18:03:23'),
(27, 'Employee', 'Sawayn', 'Amely', 'Cummings', NULL, 'tcorkery@gmail.com', '09089772758', '2026-05-07 02:35:02', '2026-05-07 05:43:28'),
(28, 'Employee', 'Batz', 'Elisa', 'Hessel', 'VI', 'priscilla53@gmail.com', '09086587395', '2026-04-25 17:11:41', '2026-04-28 09:21:01'),
(29, 'Employee', 'Ruecker', 'Thaddeus', 'Stoltenberg', NULL, 'jocelyn64@gmail.com', '09986663154', '2026-05-06 06:42:13', '2026-05-06 21:04:39'),
(30, 'Employee', 'Beahan', 'Dorian', 'Tromp', NULL, 'damien39@gmail.com', '09207126048', '2026-05-05 07:41:48', '2026-05-05 23:23:50'),
(31, 'Student', 'Zemlak', 'Christopher', 'Hudson', NULL, 'ethyl81@online.htcgsc.edu.ph', '09190813933', '2026-04-21 05:36:40', '2026-05-02 03:01:13'),
(32, 'Student', 'Schowalter', 'Ariel', 'O\'Reilly', NULL, 'shannon55@online.htcgsc.edu.ph', '09984225868', '2026-04-28 01:30:20', '2026-05-04 09:55:55'),
(33, 'Student', 'Grant', 'Roberto', 'Braun', 'VI', 'desmond.gerlach@online.htcgsc.edu.ph', '09983943297', '2026-05-04 17:49:00', '2026-05-05 22:37:23'),
(34, 'Student', 'Davis', 'Garrick', 'Raynor', NULL, 'jaime60@online.htcgsc.edu.ph', '09203718341', '2026-04-24 02:09:24', '2026-04-29 18:29:07'),
(35, 'Student', 'White', 'Robin', 'Waelchi', 'IV', 'jerde.isac@online.htcgsc.edu.ph', '09982214163', '2026-05-03 23:17:06', '2026-05-06 03:01:17'),
(36, 'Student', 'Ebert', 'Veronica', 'Schneider', 'V', 'marie79@online.htcgsc.edu.ph', '09176384464', '2026-04-24 04:31:38', '2026-04-24 07:45:26'),
(37, 'Student', 'Von', 'Herminio', 'Volkman', NULL, 'jhoeger@online.htcgsc.edu.ph', '09089841810', '2026-04-18 13:08:13', '2026-04-22 00:21:24'),
(38, 'Student', 'Turner', 'Macey', 'Schneider', 'II', 'fred.jaskolski@online.htcgsc.edu.ph', '09080623682', '2026-04-27 17:41:48', '2026-05-01 18:12:38'),
(39, 'Student', 'Kassulke', 'Marlene', 'Schulist', 'V', 'shania62@online.htcgsc.edu.ph', '09173961981', '2026-04-10 21:53:48', '2026-04-15 01:02:28'),
(40, 'Student', 'Dickinson', 'Harmony', 'Wuckert', NULL, 'grover.goyette@online.htcgsc.edu.ph', '09197111075', '2026-05-02 11:14:46', '2026-05-06 14:22:41'),
(41, 'Student', 'Lind', 'Adeline', 'Ernser', NULL, 'treva.kessler@online.htcgsc.edu.ph', '09178978893', '2026-05-06 17:54:33', '2026-05-06 22:53:13'),
(42, 'Student', 'Aufderhar', 'Henri', 'Smith', 'V', 'myrtis99@online.htcgsc.edu.ph', '09984193028', '2026-04-10 03:39:38', '2026-04-28 07:05:03'),
(43, 'Student', 'Walter', 'Pedro', 'Lind', NULL, 'xtremblay@online.htcgsc.edu.ph', '09200963731', '2026-04-15 15:00:01', '2026-05-06 00:43:26'),
(44, 'Student', 'Willms', 'Frederik', 'Labadie', NULL, 'jody.huel@online.htcgsc.edu.ph', '09199119462', '2026-05-06 20:51:01', '2026-05-07 04:27:24'),
(45, 'Student', 'Raynor', 'Sydnee', 'Erdman', 'V', 'zmcglynn@online.htcgsc.edu.ph', '09178903735', '2026-04-07 10:38:46', '2026-05-07 02:58:59'),
(46, 'Student', 'Hirthe', 'Margaret', 'Ratke', NULL, 'jermaine83@online.htcgsc.edu.ph', '09207169555', '2026-04-18 11:50:34', '2026-04-25 02:28:22'),
(47, 'Student', 'Torp', 'Flo', 'Terry', NULL, 'joe.cartwright@online.htcgsc.edu.ph', '09173618264', '2026-04-18 15:59:53', '2026-05-05 20:13:47'),
(48, 'Student', 'Schoen', 'Mike', 'Greenfelder', NULL, 'bridie19@online.htcgsc.edu.ph', '09175343778', '2026-04-23 20:25:40', '2026-04-24 21:31:19'),
(49, 'Student', 'King', 'Aurelio', 'McDermott', NULL, 'raheem13@online.htcgsc.edu.ph', '09207984519', '2026-04-08 00:53:11', '2026-05-02 13:33:09'),
(50, 'Student', 'Lueilwitz', 'Jordi', 'Hoppe', NULL, 'loraine.harris@online.htcgsc.edu.ph', '09176296105', '2026-04-20 06:27:00', '2026-05-04 18:13:49'),
(51, 'Student', 'Bradtke', 'Tyshawn', 'Williamson', NULL, 'darrin87@online.htcgsc.edu.ph', '09984515105', '2026-04-10 20:58:21', '2026-04-13 23:59:01'),
(52, 'Student', 'Beer', 'Treva', 'Crist', NULL, 'pabernathy@online.htcgsc.edu.ph', '09191904870', '2026-04-13 03:20:38', '2026-04-29 09:05:20'),
(53, 'Student', 'Wisoky', 'Constance', 'Bayer', 'VI', 'hilpert.tiara@online.htcgsc.edu.ph', '09194399972', '2026-05-06 13:44:43', '2026-05-07 05:41:57'),
(54, 'Student', 'Ritchie', 'Ursula', 'Haag', 'IV', 'rolfson.cielo@online.htcgsc.edu.ph', '09192272087', '2026-04-12 00:32:59', '2026-05-03 05:41:53'),
(55, 'Student', 'Crooks', 'Fatima', 'Powlowski', NULL, 'weimann.domenick@online.htcgsc.edu.ph', '09178143761', '2026-04-08 20:36:14', '2026-04-30 21:29:11'),
(56, 'Student', 'Gutmann', 'Enos', 'Schumm', NULL, 'mitchell.dixie@online.htcgsc.edu.ph', '09171356557', '2026-05-03 19:31:13', '2026-05-06 17:06:19'),
(57, 'Student', 'Rohan', 'Ellsworth', 'Lehner', NULL, 'vmarvin@online.htcgsc.edu.ph', '09184300994', '2026-04-07 10:20:32', '2026-04-21 23:07:18'),
(58, 'Student', 'Welch', 'Darryl', 'Boyle', 'VI', 'levi74@online.htcgsc.edu.ph', '09200829951', '2026-05-03 15:12:47', '2026-05-05 15:27:50'),
(59, 'Student', 'Wisozk', 'Nicola', 'Harris', NULL, 'kparker@online.htcgsc.edu.ph', '09174334408', '2026-04-09 07:12:08', '2026-04-15 03:23:49'),
(60, 'Student', 'Witting', 'Alisa', 'Blick', NULL, 'kessler.jerome@online.htcgsc.edu.ph', '09172684265', '2026-04-23 21:22:53', '2026-04-26 20:05:07');

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
(1, 12, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(2, 24, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(3, 27, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(4, 13, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(5, 13, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(6, 27, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(7, 17, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(8, 7, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(9, 8, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(10, 16, '2026-05-07 06:46:07', '2026-05-07 06:46:07');

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
(1, 23, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(2, 27, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(3, 21, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(4, 10, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(5, 2, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(6, 23, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(7, 8, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(8, 14, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(9, 30, '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(10, 28, '2026-05-07 06:46:07', '2026-05-07 06:46:07');

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
(1, 'Vel modi natus quis.', '2025-10-17', '2026-05-20', 'Users', 'Excel Spreadsheet', '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(2, 'Delectus magni enim.', '2025-07-17', '2026-05-11', 'Form Submissions', 'PDF Document', '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(3, 'Ut dolores autem.', '2026-01-11', '2026-05-11', 'Users', 'Excel Spreadsheet', '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(4, 'Nisi est quis dolor.', '2025-12-06', '2026-05-23', 'Form Submissions', 'Excel Spreadsheet', '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(5, 'Blanditiis voluptas.', '2025-07-23', '2026-05-15', 'Users', 'Excel Spreadsheet', '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(6, 'Explicabo ex modi.', '2025-08-10', '2026-05-17', 'Form Submissions', 'PDF Document', '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(7, 'Aperiam iure aut.', '2026-01-19', '2026-06-04', 'Students', 'Excel Spreadsheet', '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(8, 'Ipsam et corporis.', '2025-08-28', '2026-05-18', 'Users', 'Excel Spreadsheet', '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(9, 'Nihil et in sequi.', '2025-10-18', '2026-05-21', 'Students', 'PDF Document', '2026-05-07 06:46:07', '2026-05-07 06:46:07'),
(10, 'Sit corporis in.', '2026-05-06', '2026-06-06', 'Students', 'PDF Document', '2026-05-07 06:46:07', '2026-05-07 06:46:07');

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
(1, 31, '2026-04-23 03:00:20', '2026-05-02 22:59:02'),
(2, 32, '2026-04-20 21:20:31', '2026-04-22 09:50:10'),
(3, 33, '2026-05-05 10:47:09', '2026-05-05 19:33:34'),
(4, 34, '2026-04-22 23:02:03', '2026-05-04 12:51:36'),
(5, 35, '2026-04-08 23:06:02', '2026-05-01 11:02:21'),
(6, 36, '2026-04-17 10:36:52', '2026-04-29 04:43:31'),
(7, 37, '2026-05-01 01:55:50', '2026-05-04 20:50:35'),
(8, 38, '2026-05-02 01:56:57', '2026-05-03 08:07:42'),
(9, 39, '2026-04-29 00:46:52', '2026-05-02 14:09:00'),
(10, 40, '2026-04-16 09:07:21', '2026-04-17 04:57:14'),
(11, 41, '2026-04-25 07:09:55', '2026-04-25 10:09:52'),
(12, 42, '2026-04-16 10:46:09', '2026-05-05 03:17:50'),
(13, 43, '2026-05-05 21:05:25', '2026-05-06 03:49:51'),
(14, 44, '2026-04-08 03:09:58', '2026-04-08 17:52:29'),
(15, 45, '2026-05-03 17:18:27', '2026-05-07 03:42:35'),
(16, 46, '2026-04-09 11:39:50', '2026-04-14 16:57:10'),
(17, 47, '2026-04-14 06:55:26', '2026-05-04 21:41:32'),
(18, 48, '2026-04-29 05:16:48', '2026-05-02 03:25:36'),
(19, 49, '2026-05-03 14:36:41', '2026-05-06 23:17:58'),
(20, 50, '2026-04-21 04:58:58', '2026-04-23 14:25:20'),
(21, 51, '2026-05-05 23:33:06', '2026-05-06 14:37:01'),
(22, 52, '2026-05-02 15:13:25', '2026-05-05 20:51:58'),
(23, 53, '2026-04-11 20:01:18', '2026-04-27 00:56:23'),
(24, 54, '2026-05-07 02:07:05', '2026-05-07 06:45:58'),
(25, 55, '2026-04-15 00:47:26', '2026-05-03 06:38:16'),
(26, 56, '2026-05-06 21:11:00', '2026-05-06 22:57:39'),
(27, 57, '2026-04-08 04:06:39', '2026-04-20 22:18:41'),
(28, 58, '2026-04-20 03:03:25', '2026-04-28 06:19:06'),
(29, 59, '2026-04-14 18:58:59', '2026-04-30 16:21:11'),
(30, 60, '2026-05-07 00:43:44', '2026-05-07 06:06:22');

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
(1, 1, 'Active', '$2y$12$TlHtgvb4CUqNERZ0.bdm/uOufXprlB/LiD.kly046NI7fh7Zwtwaq', NULL, NULL, '2026-04-11 10:50:43', '2026-04-29 13:50:42'),
(2, 2, 'Active', '$2y$12$.dVO6lxMB0KkeDgW2cHmm.HV1KCX5sni6L7XRouPE/lg6rrhgvH1O', NULL, NULL, '2026-04-27 22:54:09', '2026-04-29 05:09:20'),
(3, 3, 'Active', '$2y$12$tLIKiIGTB17.qsBR.8z9DOXl9RE7rJ2kkB.PVc5NgyRHvVBJjdVFy', NULL, NULL, '2026-04-27 16:35:27', '2026-05-06 04:39:22'),
(4, 4, 'Active', '$2y$12$NES6Z.JET9AcU5cRYVQEYODDmRYq0.159DDapVDrBxodNANHNfzQS', NULL, NULL, '2026-05-02 06:05:27', '2026-05-06 06:01:55'),
(5, 5, 'Active', '$2y$12$8sx345NZv35y/iGRLzOY3eWFjSMnwzgFm67yaQquU.iAjS00e7Hha', NULL, NULL, '2026-04-08 18:12:29', '2026-04-21 11:05:05'),
(6, 6, 'Active', '$2y$12$TFB4B9BBOuJQPQKFD4swH.Isk26CM9J5xrDgUVTZ.3wVDZOXMSig.', NULL, NULL, '2026-04-23 22:13:17', '2026-04-29 19:08:09'),
(7, 7, 'Active', '$2y$12$Qee8RXHHjLrEqkilpF6X/uJg8WI2pEvqqCDo0lVa7GcnO52zVAxui', NULL, NULL, '2026-04-18 06:43:38', '2026-04-28 10:58:07'),
(8, 8, 'Active', '$2y$12$bUmEG0kZ4jbcPp/O5flfL.RrR1ThswiUbllXeX7vTMcBDTvahyyHm', NULL, NULL, '2026-04-29 00:11:50', '2026-05-05 07:40:25'),
(9, 9, 'Active', '$2y$12$a19OWCW8bqUE7aC9vhRqweYa44bBLfk0OI37aNEGy/bCdC6vxvIeW', NULL, NULL, '2026-04-22 17:15:29', '2026-05-05 17:39:22'),
(10, 10, 'Active', '$2y$12$W2P28D43CXRXCDFOcMPJ9e7j99fazM.sZS2G9L3azilXQjpsfA5L.', NULL, NULL, '2026-04-20 20:10:08', '2026-04-28 04:25:41'),
(11, 11, 'Active', '$2y$12$MiWAtJsHmNfoRdsoM38W6uSj6hCssfr1cFIo7LF1XbtZPKJ7NbQpm', NULL, NULL, '2026-04-12 09:54:50', '2026-05-01 13:17:57'),
(12, 12, 'Inactive', '$2y$12$kv.eJ0miCAu3OPxYBYa40O38QifAnpDHFZWgodF70HK.PmQQnZtMW', NULL, NULL, '2026-05-06 11:46:58', '2026-05-07 06:32:20'),
(13, 13, 'Inactive', '$2y$12$AOy/3EDeobnUgOVAU537M.bo5eKi.Vjmy6xzkwlgFpmfIa3dd2ef6', NULL, NULL, '2026-04-24 23:02:06', '2026-04-27 08:50:33'),
(14, 14, 'Inactive', '$2y$12$yFWMr.i0Q3J3fqebrA/N1O8E6lmI9/anbi1VL0u/4d7T7H5K/uXKK', NULL, NULL, '2026-05-02 06:53:58', '2026-05-02 20:41:55'),
(15, 15, 'Inactive', '$2y$12$KLb/kmdGKk9LzTCircf2h.qKcHetkBdaIUTuhmIUWDI4tbjjvdtqK', NULL, NULL, '2026-04-20 16:59:08', '2026-04-28 02:44:36'),
(16, 16, 'Inactive', '$2y$12$dbuATDZ7zELeu4weqPEDC.3ldKGXJH0/hiUdkFo6ptce28abO.Rhm', NULL, NULL, '2026-05-02 12:11:52', '2026-05-03 12:09:40'),
(17, 17, 'Inactive', '$2y$12$AcjDVAUM4vhOhsIxZpNQ4OwMYKhWO4RTBzm5zZpxbXSXCSjqDAhmi', NULL, NULL, '2026-05-01 09:53:58', '2026-05-05 08:28:11'),
(18, 18, 'Inactive', '$2y$12$xXo0MUSyyj2O5N8Sx0FJ3.pGLcEoQjh9r8uz.nc5/Fq8q6wKJm3RG', NULL, NULL, '2026-04-10 15:12:37', '2026-05-02 01:44:08'),
(19, 19, 'Inactive', '$2y$12$T6Ik0r2pH1XGe5761V.K2.AGS8rQlpsSiRetLQuSedqfXI7HYm312', NULL, NULL, '2026-04-08 11:40:06', '2026-04-10 00:16:53'),
(20, 20, 'Inactive', '$2y$12$c4IRF.UOIlMWHwbtCojz3.FoPZg6KjqM3YvzNJ0BSpHXrWMZDrbnq', NULL, NULL, '2026-04-11 20:48:53', '2026-04-27 10:35:51'),
(21, 21, 'Inactive', '$2y$12$kDYV4VJ1fSJwhjQBkzbA3O8fr97WJnJGpO62T9bIBC7tpObVmCRny', NULL, NULL, '2026-04-17 21:45:06', '2026-04-28 16:27:34'),
(22, 22, 'Inactive', '$2y$12$iM6dbkdtFKFyCh4lIzy6QeSFhD1t3XV8iDVIv7OyGc9SWWrsLNhPu', NULL, NULL, '2026-04-21 18:45:30', '2026-04-21 20:44:30'),
(23, 23, 'Inactive', '$2y$12$sEzys7k9toe332Pax3qY8OHt2tQC9wY4a/miAvaR.C9NIposkX9bi', NULL, NULL, '2026-04-07 19:54:20', '2026-05-03 10:37:04'),
(24, 24, 'Inactive', '$2y$12$0idUo3uygQ3/guQfcia6oODOgtkgkgLax4o4Gf5JGT8iR.Zij0cdK', NULL, NULL, '2026-04-23 01:57:27', '2026-04-29 10:09:21'),
(25, 25, 'Inactive', '$2y$12$7j8cldIEK0UbMWOlVgWnP.s9v6Mg4Opfb5DGgn1oJNWcpfcXsA9rC', NULL, NULL, '2026-05-06 01:45:21', '2026-05-07 00:48:22'),
(26, 26, 'Inactive', '$2y$12$xDYprghTSmjYXnFjjU6qte3N.IAGERE8xgO866gXiuvp1P8EjR2qO', NULL, NULL, '2026-04-17 19:21:47', '2026-05-03 00:25:44'),
(27, 27, 'Inactive', '$2y$12$cRy5iSXXn94LMHz3xniTmOlwWUzwceL061yt8k9vpMdQFUQea0rHm', NULL, NULL, '2026-05-02 02:25:44', '2026-05-03 01:57:17'),
(28, 28, 'Inactive', '$2y$12$HpBmAIzEbn/RGkxmTBwgeOELV1F7H4tc8xAga8iMfQpe1IFN81Yrm', NULL, NULL, '2026-04-18 01:14:21', '2026-05-02 06:25:03'),
(29, 29, 'Inactive', '$2y$12$nhw.OTcW61D3jraLNY5vS.9FRcBwzELM/Pq07gHL.616IIKkpMhfK', NULL, NULL, '2026-05-05 13:26:40', '2026-05-06 10:34:12'),
(30, 30, 'Inactive', '$2y$12$fiPNbirUb98o9GO//GbU/OxyPDQKC7gqZm7HGNWPPBvBkqHtgDxqu', NULL, NULL, '2026-04-13 06:34:06', '2026-04-23 13:32:34');

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
