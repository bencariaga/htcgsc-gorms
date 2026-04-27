-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2026 at 04:57 AM
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
`referral_id` int(11)
,`student_id` int(11)
,`referrer_id` int(11)
,`created_at` timestamp
,`updated_at` timestamp
,`appointment_id` int(11)
,`referral_type` enum('Yourself','Someone Else')
,`reason` varchar(255)
,`appointment_date` date
,`appointment_time` enum('8:30 AM - 9:30 AM','9:30 AM - 10:30 AM','10:30 AM - 11:30 AM','1:30 PM - 2:30 PM','2:30 PM - 3:30 PM','3:30 PM - 4:30 PM')
,`appointment_status` enum('Scheduled','Done','Cancelled','Missed')
,`laravel_foreign_key` int(11)
,`laravel_model` varchar(22)
,`laravel_placeholders` varchar(88)
,`laravel_with` varchar(0)
);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `referrer_id` int(11) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
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
(1, 1, 1, 48, 'Yourself', 'Ullam accusantium non quasi vel tempora quo maxime sunt.', '2026-05-03', '9:30 AM - 10:30 AM', 'Scheduled', '2026-04-19 02:49:14', '2026-04-21 05:31:15'),
(2, 2, 2, 52, 'Yourself', 'In ipsa nihil sint voluptates.', '2026-05-02', '2:30 PM - 3:30 PM', 'Scheduled', '2026-03-29 06:57:33', '2026-04-13 05:23:12'),
(3, 3, 3, 56, 'Yourself', 'Earum est autem est cumque voluptatem.', '2026-05-08', '8:30 AM - 9:30 AM', 'Scheduled', '2026-04-04 01:50:38', '2026-04-10 03:07:29'),
(4, 4, 4, 60, 'Yourself', 'Et ex neque deserunt est velit nesciunt.', '2026-05-14', '2:30 PM - 3:30 PM', 'Scheduled', '2026-04-06 02:10:12', '2026-04-09 18:56:53'),
(5, 5, 5, 43, 'Yourself', 'Aliquam commodi tempora ut molestiae.', '2026-05-06', '3:30 PM - 4:30 PM', 'Scheduled', '2026-04-12 00:22:36', '2026-04-12 10:16:40'),
(6, 6, 6, 51, 'Someone Else', 'Consectetur non dolores dolor quo ducimus velit impedit.', '2026-04-22', '1:30 PM - 2:30 PM', 'Missed', '2026-03-23 03:58:42', '2026-04-23 06:36:40'),
(7, 7, 7, 58, 'Someone Else', 'Sit sint quis et autem.', '2026-05-22', '9:30 AM - 10:30 AM', 'Scheduled', '2026-04-14 06:18:47', '2026-04-19 22:59:47'),
(8, 8, 8, 55, 'Someone Else', 'Sunt natus quaerat pariatur hic dolorem.', '2026-05-21', '1:30 PM - 2:30 PM', 'Scheduled', '2026-03-30 11:51:41', '2026-04-20 15:44:34'),
(9, 9, 9, 51, 'Someone Else', 'Molestiae qui quaerat deleniti eaque exercitationem esse.', '2026-05-13', '3:30 PM - 4:30 PM', 'Scheduled', '2026-04-08 22:23:33', '2026-04-15 23:27:15'),
(10, 10, 10, 57, 'Someone Else', 'Non ab veniam doloremque voluptatem deserunt et minima.', '2026-05-04', '1:30 PM - 2:30 PM', 'Scheduled', '2026-04-15 19:15:39', '2026-04-19 14:48:27');

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
(7, 'create_persons_table', 2),
(8, 'create_students_table', 3),
(9, 'create_users_table', 4),
(10, 'create_referrers_table', 5),
(11, 'create_referrals_table', 6),
(12, 'create_appointments_table', 7),
(13, 'create_reports_table', 8),
(14, 'create_all_activities_view', 9),
(15, 'add_auto_increment', 10),
(16, '2026_04_27_094052_add_person_id_to_appointments_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `person_id` int(11) NOT NULL,
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
(1, 'Administrator', 'Cariaga', 'Benhur', 'Leproso', NULL, 'bencariaga13@gmail.com', '09939597683', '2026-04-20 19:54:44', '2026-04-27 02:29:31'),
(2, 'Employee', 'Mayert', 'Mason', 'Lockman', NULL, 'wolf.vena@gmail.com', '09204105576', '2026-03-31 02:55:53', '2026-04-03 21:59:29'),
(3, 'Employee', 'Stokes', 'Sabina', 'Bins', NULL, 'chasity54@gmail.com', '09208796531', '2026-03-29 17:27:07', '2026-04-22 07:42:04'),
(4, 'Employee', 'Kozey', 'Berneice', 'Schultz', NULL, 'kieran53@gmail.com', '09190979909', '2026-04-16 03:30:16', '2026-04-17 04:59:38'),
(5, 'Employee', 'Brown', 'Korbin', 'Mitchell', NULL, 'maybelle24@gmail.com', '09170443534', '2026-03-29 12:08:01', '2026-04-18 21:18:36'),
(6, 'Employee', 'Hoeger', 'London', 'Zieme', 'II', 'tyra.brown@gmail.com', '09086346900', '2026-03-24 06:29:11', '2026-04-10 01:27:19'),
(7, 'Employee', 'Bergstrom', 'Tara', 'Fahey', NULL, 'koelpin.martine@gmail.com', '09189139913', '2026-04-07 09:37:17', '2026-04-09 11:19:15'),
(8, 'Employee', 'Kunze', 'Ophelia', 'Haag', NULL, 'smitham.sandrine@gmail.com', '09208168149', '2026-04-11 00:36:01', '2026-04-17 10:52:38'),
(9, 'Employee', 'Rau', 'Lucio', 'Abshire', NULL, 'chloe.rogahn@gmail.com', '09088951487', '2026-04-01 23:07:40', '2026-04-03 17:15:46'),
(10, 'Employee', 'Waelchi', 'Jabari', 'Reichert', 'IV', 'vhegmann@gmail.com', '09205602640', '2026-04-13 22:01:05', '2026-04-14 23:27:09'),
(11, 'Employee', 'Stracke', 'Marisa', 'Muller', NULL, 'rachelle.runolfsson@gmail.com', '09086246704', '2026-04-11 07:57:34', '2026-04-20 20:07:07'),
(12, 'Employee', 'Rogahn', 'Felton', 'Reichert', 'II', 'kameron.johnston@gmail.com', '09182747824', '2026-04-10 06:06:57', '2026-04-22 03:32:54'),
(13, 'Employee', 'Erdman', 'Lacy', 'Jones', NULL, 'alison85@gmail.com', '09983791809', '2026-03-22 18:30:03', '2026-04-06 06:27:50'),
(14, 'Employee', 'Wisozk', 'Meta', 'Herman', NULL, 'gerald72@gmail.com', '09984046185', '2026-04-16 20:09:49', '2026-04-20 00:26:52'),
(15, 'Employee', 'Greenfelder', 'Katelynn', 'Kovacek', 'II', 'maybelle.hills@gmail.com', '09179486057', '2026-04-15 01:38:24', '2026-04-16 04:14:38'),
(16, 'Employee', 'Streich', 'Imogene', 'Mann', NULL, 'astark@gmail.com', '09175639898', '2026-04-03 10:30:52', '2026-04-11 01:06:06'),
(17, 'Employee', 'Gorczany', 'Doris', 'Wintheiser', NULL, 'waufderhar@gmail.com', '09086098997', '2026-04-09 18:36:34', '2026-04-13 20:34:46'),
(18, 'Employee', 'Kreiger', 'Rod', 'Batz', 'Jr.', 'jbaumbach@gmail.com', '09985802781', '2026-04-05 00:26:47', '2026-04-14 01:43:12'),
(19, 'Employee', 'Johns', 'Lee', 'Cassin', NULL, 'wilfredo.johnston@gmail.com', '09208933256', '2026-04-05 20:10:12', '2026-04-12 20:22:20'),
(20, 'Employee', 'Moen', 'Brianne', 'Schultz', NULL, 'antonietta.boehm@gmail.com', '09189444709', '2026-04-16 05:36:15', '2026-04-21 23:13:47'),
(21, 'Employee', 'Schumm', 'Cayla', 'Klein', NULL, 'schowalter.shane@gmail.com', '09185797987', '2026-04-01 23:47:03', '2026-04-11 01:16:58'),
(22, 'Employee', 'Fay', 'Craig', 'McCullough', 'Sr.', 'myrtice67@gmail.com', '09985434498', '2026-03-27 19:09:24', '2026-04-13 11:08:19'),
(23, 'Employee', 'Jones', 'Sylvester', 'Zulauf', NULL, 'khudson@gmail.com', '09193072322', '2026-04-11 04:13:29', '2026-04-20 17:41:39'),
(24, 'Employee', 'Wiza', 'Elisa', 'Gusikowski', 'II', 'lind.madge@gmail.com', '09988561678', '2026-04-02 03:39:43', '2026-04-10 15:31:38'),
(25, 'Employee', 'Bogisich', 'Mekhi', 'Marvin', NULL, 'kuvalis.kathryn@gmail.com', '09188295266', '2026-04-15 14:45:19', '2026-04-19 03:25:22'),
(26, 'Employee', 'Heaney', 'Betty', 'Bergstrom', NULL, 'xmarvin@gmail.com', '09208678254', '2026-03-26 01:02:05', '2026-03-26 01:31:43'),
(27, 'Employee', 'Prosacco', 'Cathryn', 'Daniel', NULL, 'tamara73@gmail.com', '09181581024', '2026-04-17 02:13:40', '2026-04-20 18:05:42'),
(28, 'Employee', 'Jacobi', 'Juliet', 'Weber', NULL, 'camren54@gmail.com', '09201927197', '2026-04-12 02:29:42', '2026-04-16 02:43:40'),
(29, 'Employee', 'Little', 'Percy', 'O\'Keefe', NULL, 'easton39@gmail.com', '09202307386', '2026-03-27 01:18:37', '2026-04-19 07:12:23'),
(30, 'Employee', 'Volkman', 'Lempi', 'Klocko', NULL, 'grant.savanah@gmail.com', '09203991208', '2026-03-23 08:58:50', '2026-04-06 17:12:29'),
(31, 'Student', 'Feeney', 'Gaylord', 'Bechtelar', NULL, 'hillard.gerlach@htcgsc.edu.ph', '09177234391', '2026-04-11 09:43:35', '2026-04-21 11:14:23'),
(32, 'Student', 'Rippin', 'Diamond', 'Nolan', NULL, 'vmohr@htcgsc.edu.ph', '09080024084', '2026-04-12 14:07:56', '2026-04-21 12:26:03'),
(33, 'Student', 'Ryan', 'Ethel', 'Volkman', 'VI', 'rohan.layla@htcgsc.edu.ph', '09082809785', '2026-04-19 04:29:52', '2026-04-20 07:42:24'),
(34, 'Student', 'Jacobi', 'Preston', 'Lubowitz', 'Sr.', 'xwolf@htcgsc.edu.ph', '09171406287', '2026-04-09 18:24:00', '2026-04-19 13:36:23'),
(35, 'Student', 'Keeling', 'Caitlyn', 'Lemke', NULL, 'jefferey87@htcgsc.edu.ph', '09088902063', '2026-03-25 13:14:59', '2026-03-27 02:14:33'),
(36, 'Student', 'Walter', 'Kristin', 'Lueilwitz', NULL, 'haskell69@htcgsc.edu.ph', '09186008603', '2026-04-03 02:45:00', '2026-04-04 20:33:49'),
(37, 'Student', 'Friesen', 'Jana', 'Kling', NULL, 'ubartoletti@htcgsc.edu.ph', '09185950426', '2026-04-03 12:24:11', '2026-04-20 09:45:27'),
(38, 'Student', 'Emard', 'Mireille', 'Moore', 'VI', 'west.madaline@htcgsc.edu.ph', '09088775170', '2026-04-19 09:22:30', '2026-04-20 23:47:18'),
(39, 'Student', 'Swift', 'Colleen', 'Mills', 'III', 'lreichel@htcgsc.edu.ph', '09982282515', '2026-03-26 05:53:37', '2026-04-07 19:38:09'),
(40, 'Student', 'Beahan', 'Mckayla', 'Will', NULL, 'abernathy.emerson@htcgsc.edu.ph', '09179238541', '2026-04-04 07:50:11', '2026-04-22 00:03:15'),
(41, 'Student', 'Becker', 'Jesse', 'Williamson', NULL, 'zlang@htcgsc.edu.ph', '09171962579', '2026-04-22 06:07:01', '2026-04-22 06:28:25'),
(42, 'Student', 'Yundt', 'Eddie', 'Powlowski', NULL, 'qnolan@htcgsc.edu.ph', '09196939856', '2026-04-04 06:54:00', '2026-04-07 05:58:28'),
(43, 'Student', 'Hahn', 'Newell', 'O\'Reilly', NULL, 'terrell63@htcgsc.edu.ph', '09197872417', '2026-04-13 11:22:11', '2026-04-16 05:27:41'),
(44, 'Student', 'Schaefer', 'Maria', 'Hills', NULL, 'lonie.halvorson@htcgsc.edu.ph', '09173304246', '2026-03-28 18:38:17', '2026-04-15 18:54:25'),
(45, 'Student', 'Purdy', 'Bill', 'Toy', NULL, 'bvonrueden@htcgsc.edu.ph', '09175026127', '2026-03-25 14:15:46', '2026-04-10 17:27:54'),
(46, 'Student', 'Gleichner', 'Christopher', 'Schuster', NULL, 'ogottlieb@htcgsc.edu.ph', '09178738661', '2026-03-24 03:25:23', '2026-04-05 14:19:58'),
(47, 'Student', 'Borer', 'Kenny', 'Schneider', NULL, 'rippin.cielo@htcgsc.edu.ph', '09985913464', '2026-04-18 05:43:50', '2026-04-18 17:17:42'),
(48, 'Student', 'Osinski', 'Joana', 'Ryan', NULL, 'alena08@htcgsc.edu.ph', '09082083665', '2026-04-14 06:59:03', '2026-04-16 14:49:31'),
(49, 'Student', 'Yost', 'Vern', 'Sanford', NULL, 'kris.braxton@htcgsc.edu.ph', '09081883541', '2026-03-29 15:41:37', '2026-04-05 17:42:56'),
(50, 'Student', 'Zboncak', 'Adelle', 'Renner', NULL, 'mckenzie.maggie@htcgsc.edu.ph', '09188912531', '2026-04-18 23:14:38', '2026-04-19 07:13:05'),
(51, 'Student', 'Bashirian', 'Kevon', 'Herzog', NULL, 'hzboncak@htcgsc.edu.ph', '09195234286', '2026-04-18 12:02:15', '2026-04-21 05:55:31'),
(52, 'Student', 'Lindgren', 'Ignacio', 'Greenfelder', NULL, 'guillermo17@htcgsc.edu.ph', '09085290707', '2026-04-15 06:10:51', '2026-04-18 03:13:50'),
(53, 'Student', 'Konopelski', 'Issac', 'Waters', 'Jr.', 'ebrekke@htcgsc.edu.ph', '09180525960', '2026-04-08 15:56:55', '2026-04-15 13:30:48'),
(54, 'Student', 'Runolfsson', 'Novella', 'West', NULL, 'skyla.batz@htcgsc.edu.ph', '09986773769', '2026-03-29 23:17:36', '2026-04-06 12:41:54'),
(55, 'Student', 'Purdy', 'Santiago', 'Auer', NULL, 'brittany83@htcgsc.edu.ph', '09193708084', '2026-03-29 20:28:08', '2026-04-04 06:14:59'),
(56, 'Student', 'Pfannerstill', 'Katrine', 'O\'Conner', NULL, 'julie.abbott@htcgsc.edu.ph', '09200886973', '2026-04-14 09:05:28', '2026-04-18 22:24:41'),
(57, 'Student', 'Mueller', 'Reyes', 'Boyer', NULL, 'hunter28@htcgsc.edu.ph', '09987785068', '2026-03-22 21:22:46', '2026-04-13 12:59:33'),
(58, 'Student', 'Thompson', 'Samara', 'Medhurst', 'V', 'stamm.amara@htcgsc.edu.ph', '09195959924', '2026-04-06 11:37:00', '2026-04-20 19:37:19'),
(59, 'Student', 'Deckow', 'Krystina', 'Bayer', NULL, 'aliyah.erdman@htcgsc.edu.ph', '09980961115', '2026-03-27 15:14:07', '2026-03-28 14:37:45'),
(60, 'Student', 'Jacobi', 'Bethel', 'Murray', NULL, 'penelope.ernser@htcgsc.edu.ph', '09176941823', '2026-04-03 13:25:44', '2026-04-20 07:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `referral_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`referral_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 18, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(2, 22, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(3, 26, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(4, 30, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(5, 13, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(6, 21, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(7, 28, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(8, 25, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(9, 21, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(10, 27, '2026-04-22 08:42:19', '2026-04-22 08:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `referrers`
--

CREATE TABLE `referrers` (
  `referrer_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrers`
--

INSERT INTO `referrers` (`referrer_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, 28, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(2, 20, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(3, 10, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(4, 7, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(5, 25, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(6, 4, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(7, 13, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(8, 26, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(9, 12, '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(10, 5, '2026-04-22 08:42:19', '2026-04-22 08:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
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
(1, 'User Report', '2025-09-06', '2026-04-10', 'Users', 'PDF Document', '2026-04-22 08:42:19', '2026-04-23 13:02:19'),
(2, 'Unde voluptas ipsam.', '2026-04-22', '2026-04-28', 'Users', 'PDF Document', '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(3, 'Pariatur et quas.', '2025-05-04', '2026-05-21', 'Form Submissions', 'PDF Document', '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(4, 'Ullam qui corporis.', '2026-04-20', '2026-05-02', 'Users', 'Excel Spreadsheet', '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(5, 'Aspernatur autem.', '2025-05-20', '2026-05-13', 'Users', 'PDF Document', '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(6, 'Molestiae aut.', '2025-07-29', '2026-04-27', 'Students', 'Excel Spreadsheet', '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(7, 'Animi dolor.', '2026-04-22', '2026-05-05', 'Students', 'PDF Document', '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(8, 'Et voluptatem quam.', '2025-11-28', '2026-04-28', 'Students', 'Excel Spreadsheet', '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(9, 'Iure cum harum.', '2025-09-25', '2026-04-26', 'Users', 'Excel Spreadsheet', '2026-04-22 08:42:19', '2026-04-22 08:42:19'),
(10, 'Commodi velit eos.', '2025-09-29', '2026-05-03', 'Form Submissions', 'PDF Document', '2026-04-22 08:42:19', '2026-04-22 08:42:19');

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
  `student_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `person_id`, `created_at`, `updated_at`) VALUES
(1, 31, '2026-03-23 22:16:40', '2026-04-20 21:08:11'),
(2, 32, '2026-04-18 09:48:58', '2026-04-21 01:44:46'),
(3, 33, '2026-04-19 13:07:52', '2026-04-20 00:32:13'),
(4, 34, '2026-03-24 08:15:30', '2026-04-19 14:38:41'),
(5, 35, '2026-04-19 16:53:18', '2026-04-19 19:27:10'),
(6, 36, '2026-04-10 09:04:43', '2026-04-16 01:29:48'),
(7, 37, '2026-04-07 18:18:30', '2026-04-21 11:59:15'),
(8, 38, '2026-03-23 13:03:15', '2026-03-26 06:29:12'),
(9, 39, '2026-03-29 09:37:39', '2026-04-08 09:23:26'),
(10, 40, '2026-04-07 12:58:25', '2026-04-18 03:16:56'),
(11, 41, '2026-04-06 20:14:57', '2026-04-19 15:47:36'),
(12, 42, '2026-04-12 17:53:18', '2026-04-16 21:40:19'),
(13, 43, '2026-04-18 04:57:11', '2026-04-19 08:14:10'),
(14, 44, '2026-04-09 19:42:03', '2026-04-16 11:15:56'),
(15, 45, '2026-04-20 05:46:21', '2026-04-20 15:36:07'),
(16, 46, '2026-03-30 14:36:42', '2026-04-08 07:03:30'),
(17, 47, '2026-03-23 12:54:07', '2026-04-21 02:52:59'),
(18, 48, '2026-03-24 15:13:34', '2026-03-24 18:21:10'),
(19, 49, '2026-04-05 22:12:08', '2026-04-09 04:17:55'),
(20, 50, '2026-03-30 10:22:32', '2026-03-31 03:18:10'),
(21, 51, '2026-04-16 05:27:19', '2026-04-19 08:27:38'),
(22, 52, '2026-04-02 12:59:12', '2026-04-03 16:29:20'),
(23, 53, '2026-03-23 23:13:13', '2026-04-18 17:04:18'),
(24, 54, '2026-03-29 18:56:27', '2026-04-15 23:29:32'),
(25, 55, '2026-04-21 01:34:42', '2026-04-21 09:53:37'),
(26, 56, '2026-03-22 13:49:27', '2026-04-22 07:14:45'),
(27, 57, '2026-03-26 05:02:57', '2026-03-30 08:54:23'),
(28, 58, '2026-04-12 00:21:03', '2026-04-12 11:55:03'),
(29, 59, '2026-04-09 11:46:55', '2026-04-20 02:25:54'),
(30, 60, '2026-03-31 13:48:54', '2026-04-19 20:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
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
(1, 1, 'Active', '$2y$12$FFpgmXcWyGLsBsKnzu/ns.5uiXPS7xh8tkcOgqGwU8Y4gB1Gv0paK', 'profile-pictures/7GEF7BkrSjbQzlKuHUUHkbClFvPb6P6a5BagaN8d.jpg', NULL, '2026-04-11 12:48:13', '2026-04-15 08:44:09'),
(2, 2, 'Inactive', '$2y$12$8OZcHgiocAz2ToaGRriVi.yMA5IVfeY3Pzl0wgW15h00YpYNhRp8a', NULL, NULL, '2026-04-13 14:25:41', '2026-04-17 12:56:38'),
(3, 3, 'Inactive', '$2y$12$j5NwB5RFsVPIuCFp5HH7ju3wBUh7ChpDjLP.P2U47nPUXTbt8LBaq', NULL, NULL, '2026-04-17 02:00:17', '2026-04-18 06:19:44'),
(4, 4, 'Inactive', '$2y$12$cuH8gjjAEpNL/n/In5GJXOEF/vRTsmJyWKROPDAyuvPWXLakIOZTG', NULL, NULL, '2026-03-29 21:19:35', '2026-04-16 22:23:38'),
(5, 5, 'Inactive', '$2y$12$eNGRA92f73yn8rkwOuS/WeXCedcLYK4mSP0M.x2M9Nv2Rp0aUImxW', NULL, NULL, '2026-04-08 15:19:56', '2026-04-18 02:08:27'),
(6, 6, 'Inactive', '$2y$12$KFDGwss.F5qU2pQYN5wOhe.4PpeCW/Pf7a.NSeLfOeyQmvW66iKp6', NULL, NULL, '2026-04-22 02:25:37', '2026-04-22 04:49:08'),
(7, 7, 'Inactive', '$2y$12$.us5CcAg7R.YqgSpsJtKgeQH8ynx17AKWHFTqESBwxdiGqXgdA536', NULL, NULL, '2026-03-30 23:48:52', '2026-03-31 11:16:29'),
(8, 8, 'Inactive', '$2y$12$0ZMl2mcxRZXWc7W4MZAhouuur49hiHT1m7uObMzbSx5fJrsCqehb2', NULL, NULL, '2026-04-10 18:39:07', '2026-04-13 07:32:31'),
(9, 9, 'Inactive', '$2y$12$bKHftigFbbafcB4lc.rKIeQ01Ab3P1ZJfcHLbIFcc7vl7qce5.MGa', NULL, NULL, '2026-04-13 00:08:27', '2026-04-20 23:38:07'),
(10, 10, 'Inactive', '$2y$12$MJEzCRNX/Wk7YjhSFKhn5uNCfIoYRfMdntOn9mTCChvW53fmhAqTe', NULL, NULL, '2026-04-10 21:01:28', '2026-04-11 00:09:13'),
(11, 11, 'Inactive', '$2y$12$RsvAPbW/VuNId3jioZxIqustjZW5zFFMyNjOA7oTo4dXW.6KvQs0C', NULL, NULL, '2026-03-30 23:36:01', '2026-04-12 09:48:14'),
(12, 12, 'Inactive', '$2y$12$vXGO64BRKjydjnUOr/2liOq33jCpILenHkf2bud4ZNoIo33B0JGZe', NULL, NULL, '2026-04-10 04:58:48', '2026-04-16 03:56:48'),
(13, 13, 'Inactive', '$2y$12$zQyT78wHfCQxsY.QxaweVudAdBh4VUVTAINe4D5VMucnUKMc8jofy', NULL, NULL, '2026-03-31 06:51:17', '2026-04-14 03:48:53'),
(14, 14, 'Inactive', '$2y$12$KbiYfWRs1k446i17.PmBT.yRKL69IUqyR24fPK3h9/s2JSpP2OBra', NULL, NULL, '2026-04-11 05:19:06', '2026-04-13 05:25:42'),
(15, 15, 'Inactive', '$2y$12$rJy/QxNhodiag0H4ri56GOqKNNXNH4qF8qMD206vFkzOwowY5hNba', NULL, NULL, '2026-04-17 10:43:51', '2026-04-18 10:35:04'),
(16, 16, 'Inactive', '$2y$12$0NkzrzQG6z7ikoXPnIetlOx3IoU2dssk5GZBKQ30jdbHr4VvuNmfO', NULL, NULL, '2026-04-07 21:54:47', '2026-04-14 08:09:48'),
(17, 17, 'Inactive', '$2y$12$LW4xEufxOD.TkPSdYDGYL.J5kCPxjGGZ7OmDD3vBkesJHYuSwff7m', NULL, NULL, '2026-04-13 05:30:46', '2026-04-17 01:29:48'),
(18, 18, 'Inactive', '$2y$12$EsoCE4CMEhRk6GfcB2Z7X.3vbUKD2tXoc7lKVSRrebQZkZFBYQjuC', NULL, NULL, '2026-04-08 01:34:49', '2026-04-22 08:25:47'),
(19, 19, 'Inactive', '$2y$12$0TCei04JmjclYC7UKHELlOdl0PHdh.mWo6oFmtaiOwP8Xz5xuivn.', NULL, NULL, '2026-04-10 15:54:06', '2026-04-17 03:31:52'),
(20, 20, 'Inactive', '$2y$12$uZVhzBbY8Kro6EtwVPJxFOcmRWwRNBPzDEzpsFNgAaeshbW8QJMCq', NULL, NULL, '2026-04-20 20:10:17', '2026-04-21 07:04:32'),
(21, 21, 'Inactive', '$2y$12$BXc31cnExoCyn1lUjIO6EeHLRni7Q7T6wHucGIe0YanhkjjThNK6S', NULL, NULL, '2026-04-09 22:53:00', '2026-04-17 02:37:01'),
(22, 22, 'Inactive', '$2y$12$y2WYTrY8Hy.12mQ8q88jkOLMF2XMbcTdWkZ2g5y21/5eVVk9qw4YS', NULL, NULL, '2026-04-04 03:37:01', '2026-04-12 08:06:24'),
(23, 23, 'Inactive', '$2y$12$BuYEBO.WkQKIlo.GOqb/3eyFHdohMiNf7I11pRxdk4tDKE.ytWv5.', NULL, NULL, '2026-04-02 08:17:11', '2026-04-15 13:51:03'),
(24, 24, 'Inactive', '$2y$12$rKw0MhfioKKT/9IC9f/Ske4NizS5Vv4GtifG9CjB8WkK61sC3rbRO', NULL, NULL, '2026-03-25 11:48:14', '2026-04-17 02:45:23'),
(25, 25, 'Inactive', '$2y$12$mFalMvpSP5jCCDBK8BODF.YeRtCHqF5pjJs8oEGqUi7lBjRfr8Ita', NULL, NULL, '2026-03-26 09:10:57', '2026-04-02 14:44:40'),
(26, 26, 'Inactive', '$2y$12$b.sQ1h9NF89k7gS/kWL1qe3SdQBjfwVnZUlKM1rVyy4ZKP9ToC.2q', NULL, NULL, '2026-04-10 13:25:41', '2026-04-21 16:43:39'),
(27, 27, 'Inactive', '$2y$12$uVvvPieh7CZ5Qwxi2ZQavOf9MyYbJcpUsL6blEAoEM0k19GMCX4te', NULL, NULL, '2026-04-09 04:39:14', '2026-04-16 14:14:52'),
(28, 28, 'Inactive', '$2y$12$Xer5ssXrzC7qYGdoYY.Xge/pR8eeN8RASNA08eJVrGNY1rZu.htBS', NULL, NULL, '2026-03-28 04:26:56', '2026-04-14 01:20:57'),
(29, 29, 'Inactive', '$2y$12$KUL8F.B4vgB8J7PoaMwxOu0V477j6sympcCXHi8js/m.bSm5lYHA2', NULL, NULL, '2026-04-10 21:26:18', '2026-04-22 05:11:40'),
(30, 30, 'Inactive', '$2y$12$KFecwYK.zndX1Ndr5nY3KuE4uk6IFCP7vVMmWzqcn7tjr2FqqdW1y', NULL, NULL, '2026-03-24 15:58:52', '2026-04-18 11:44:27');

-- --------------------------------------------------------

--
-- Structure for view `all_activities`
--
DROP TABLE IF EXISTS `all_activities`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `all_activities`  AS   (select `referrals`.`referral_id` AS `referral_id`,`referrals`.`student_id` AS `student_id`,NULL AS `referrer_id`,`referrals`.`created_at` AS `created_at`,`referrals`.`updated_at` AS `updated_at`,NULL AS `appointment_id`,NULL AS `referral_type`,NULL AS `reason`,NULL AS `appointment_date`,NULL AS `appointment_time`,NULL AS `appointment_status`,`referrals`.`student_id` AS `laravel_foreign_key`,'App\\Models\\Referral' AS `laravel_model`,'appointment_id,referral_type,reason,appointment_date,appointment_time,appointment_status' AS `laravel_placeholders`,'' AS `laravel_with` from `referrals`) union all (select `appointments`.`referral_id` AS `referral_id`,NULL AS `student_id`,`appointments`.`referrer_id` AS `referrer_id`,`appointments`.`created_at` AS `created_at`,`appointments`.`updated_at` AS `updated_at`,`appointments`.`appointment_id` AS `appointment_id`,`appointments`.`referral_type` AS `referral_type`,`appointments`.`reason` AS `reason`,`appointments`.`appointment_date` AS `appointment_date`,`appointments`.`appointment_time` AS `appointment_time`,`appointments`.`appointment_status` AS `appointment_status`,`referrals`.`student_id` AS `laravel_foreign_key`,'App\\Models\\Appointment' AS `laravel_model`,'student_id' AS `laravel_placeholders`,'' AS `laravel_with` from (`appointments` join `referrals` on(`referrals`.`referral_id` = `appointments`.`referral_id`)))  ;

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
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `referral_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `referrers`
--
ALTER TABLE `referrers`
  MODIFY `referrer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
