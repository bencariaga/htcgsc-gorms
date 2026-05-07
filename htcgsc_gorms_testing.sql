-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2026 at 08:48 AM
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
(1, 1, 1, 45, 'Yourself', 'Aut distinctio mollitia deleniti culpa commodi.', '2026-05-08', '2:30 PM - 3:30 PM', 'Scheduled', '2026-04-28 02:01:19', '2026-05-04 11:14:45'),
(2, 2, 2, 49, 'Yourself', 'Necessitatibus possimus eligendi numquam sed nostrum hic.', '2026-05-29', '1:30 PM - 2:30 PM', 'Scheduled', '2026-04-10 10:34:56', '2026-04-22 00:03:54'),
(3, 3, 3, 58, 'Yourself', 'Doloribus consectetur dolores omnis tempore error suscipit.', '2026-06-05', '2:30 PM - 3:30 PM', 'Scheduled', '2026-04-23 19:05:56', '2026-04-27 13:52:31'),
(4, 4, 4, 46, 'Yourself', 'Minima consequatur voluptatem enim cumque.', '2026-05-25', '3:30 PM - 4:30 PM', 'Scheduled', '2026-04-17 14:38:30', '2026-05-01 03:19:51'),
(5, 5, 5, 57, 'Yourself', 'Harum aut architecto qui.', '2026-05-14', '8:30 AM - 9:30 AM', 'Scheduled', '2026-04-15 18:46:31', '2026-05-01 06:27:16'),
(6, 6, 6, 34, 'Someone Else', 'Est ea voluptatibus qui.', '2026-05-19', '1:30 PM - 2:30 PM', 'Scheduled', '2026-04-27 18:22:21', '2026-05-04 11:34:37'),
(7, 7, 7, 36, 'Someone Else', 'Repellendus vitae voluptatem illo doloremque.', '2026-05-24', '3:30 PM - 4:30 PM', 'Scheduled', '2026-04-05 15:29:50', '2026-04-23 11:25:33'),
(8, 8, 8, 32, 'Someone Else', 'Et eveniet vel consequatur non rem quia aut repellat.', '2026-05-16', '2:30 PM - 3:30 PM', 'Scheduled', '2026-04-28 01:28:38', '2026-05-01 08:05:26'),
(9, 9, 9, 38, 'Someone Else', 'Qui dolorum sint facere dolorem aut.', '2026-05-08', '3:30 PM - 4:30 PM', 'Scheduled', '2026-04-17 16:42:14', '2026-04-25 03:53:34'),
(10, 10, 10, 57, 'Someone Else', 'Iusto est voluptatem eos.', '2026-05-16', '3:30 PM - 4:30 PM', 'Scheduled', '2026-04-06 02:14:55', '2026-04-15 21:52:23');

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
(1, 'Administrator', 'Cariaga', 'Benhur', 'Leproso', NULL, 'bencariaga13@gmail.com', '09939597683', '2026-04-20 00:18:01', '2026-04-26 21:33:41'),
(2, 'Employee', 'Green', 'Candice', 'Pollich', NULL, 'jennifer.langosh@gmail.com', '09988069785', '2026-04-24 07:39:24', '2026-04-24 19:51:34'),
(3, 'Employee', 'Armstrong', 'Susan', 'Bayer', NULL, 'patsy.reinger@gmail.com', '09089442558', '2026-04-10 05:32:31', '2026-04-14 16:45:54'),
(4, 'Employee', 'Wehner', 'Annabel', 'Torphy', NULL, 'daisy.walsh@gmail.com', '09084648654', '2026-05-01 06:42:17', '2026-05-01 21:27:25'),
(5, 'Employee', 'Farrell', 'Oma', 'Howe', NULL, 'marvin.al@gmail.com', '09081351534', '2026-04-26 00:24:59', '2026-04-30 19:02:13'),
(6, 'Employee', 'Fisher', 'Jayda', 'Hettinger', NULL, 'alene09@gmail.com', '09986027215', '2026-04-06 23:29:00', '2026-04-25 19:24:21'),
(7, 'Employee', 'Braun', 'Kimberly', 'Kozey', NULL, 'uconsidine@gmail.com', '09171406053', '2026-04-17 05:13:12', '2026-05-04 20:36:01'),
(8, 'Employee', 'Jaskolski', 'Carmel', 'Gleason', NULL, 'zfranecki@gmail.com', '09196785594', '2026-04-29 05:26:46', '2026-05-04 06:43:26'),
(9, 'Employee', 'McKenzie', 'Lennie', 'Leannon', NULL, 'thiel.hazle@gmail.com', '09175676195', '2026-05-03 15:44:28', '2026-05-03 19:18:59'),
(10, 'Employee', 'Kautzer', 'Garland', 'Terry', 'III', 'camryn.koelpin@gmail.com', '09088992880', '2026-04-17 08:45:35', '2026-04-23 22:27:01'),
(11, 'Employee', 'Terry', 'Alvina', 'Batz', 'IV', 'alena80@gmail.com', '09086261701', '2026-04-09 07:32:21', '2026-05-02 07:04:49'),
(12, 'Employee', 'Rempel', 'Gregg', 'Koch', NULL, 'kerluke.liana@gmail.com', '09183175251', '2026-04-20 13:08:47', '2026-04-21 23:33:07'),
(13, 'Employee', 'Champlin', 'Devin', 'Ullrich', NULL, 'armstrong.aryanna@gmail.com', '09183048947', '2026-04-08 13:39:38', '2026-05-04 00:44:27'),
(14, 'Employee', 'Jast', 'Eddie', 'Rohan', NULL, 'lorena.walsh@gmail.com', '09983232009', '2026-04-20 22:55:28', '2026-05-04 22:12:35'),
(15, 'Employee', 'Hegmann', 'Ebba', 'Reichel', NULL, 'isai.fay@gmail.com', '09172342309', '2026-04-20 08:41:26', '2026-04-27 23:06:24'),
(16, 'Employee', 'Effertz', 'Nicholaus', 'Kuhn', NULL, 'shanon.little@gmail.com', '09185673192', '2026-04-05 10:35:06', '2026-04-23 11:47:55'),
(17, 'Employee', 'Kassulke', 'Bell', 'Towne', 'II', 'jones.milan@gmail.com', '09208955752', '2026-05-04 12:10:24', '2026-05-04 21:22:08'),
(18, 'Employee', 'Stiedemann', 'Delfina', 'Glover', NULL, 'zieme.salvatore@gmail.com', '09986551295', '2026-04-11 01:29:06', '2026-04-28 05:25:41'),
(19, 'Employee', 'Wilkinson', 'Burdette', 'Kunze', NULL, 'leonardo.harris@gmail.com', '09204330865', '2026-04-10 12:51:27', '2026-04-26 05:36:19'),
(20, 'Employee', 'Hickle', 'Devante', 'Langosh', NULL, 'lew35@gmail.com', '09202152732', '2026-04-16 20:42:30', '2026-05-02 16:44:14'),
(21, 'Employee', 'Buckridge', 'Zechariah', 'Bernhard', NULL, 'ohara.anastacio@gmail.com', '09204387726', '2026-04-23 00:23:42', '2026-04-27 12:45:26'),
(22, 'Employee', 'Kerluke', 'Tara', 'Lindgren', NULL, 'joyce50@gmail.com', '09985060085', '2026-05-03 06:22:43', '2026-05-03 19:35:09'),
(23, 'Employee', 'Parisian', 'Alvah', 'Torphy', 'Sr.', 'pmarks@gmail.com', '09204946486', '2026-04-25 09:25:21', '2026-05-05 03:24:16'),
(24, 'Employee', 'Kerluke', 'Jimmie', 'Harber', NULL, 'israel98@gmail.com', '09082665526', '2026-04-09 12:43:20', '2026-04-12 03:40:05'),
(25, 'Employee', 'Considine', 'Dahlia', 'McClure', NULL, 'efay@gmail.com', '09179616035', '2026-04-19 10:42:10', '2026-04-24 07:29:14'),
(26, 'Employee', 'Kunze', 'Marian', 'Bahringer', NULL, 'lexie13@gmail.com', '09197473963', '2026-04-23 20:31:48', '2026-05-01 11:45:26'),
(27, 'Employee', 'Fadel', 'Mitchel', 'Baumbach', NULL, 'cremin.shyann@gmail.com', '09203097020', '2026-04-26 19:44:35', '2026-04-30 12:23:05'),
(28, 'Employee', 'Bruen', 'Derek', 'Block', NULL, 'prosacco.jewell@gmail.com', '09202877871', '2026-04-11 10:19:48', '2026-04-25 12:00:12'),
(29, 'Employee', 'Medhurst', 'Harmony', 'Koch', NULL, 'earl.braun@gmail.com', '09177415822', '2026-04-27 04:52:26', '2026-05-03 17:37:30'),
(30, 'Employee', 'Williamson', 'Lempi', 'Kerluke', NULL, 'bins.bert@gmail.com', '09186470232', '2026-05-03 00:52:27', '2026-05-03 07:04:18'),
(31, 'Student', 'Gutkowski', 'Jerad', 'Skiles', NULL, 'lschinner@online.htcgsc.edu.ph', '09198494670', '2026-04-07 14:41:45', '2026-04-12 20:13:30'),
(32, 'Student', 'Anderson', 'Idella', 'Schultz', NULL, 'blowe@online.htcgsc.edu.ph', '09088398640', '2026-04-24 04:41:14', '2026-04-30 23:32:24'),
(33, 'Student', 'Pollich', 'Hillary', 'Harris', 'III', 'saige.bosco@online.htcgsc.edu.ph', '09184322004', '2026-05-03 07:50:43', '2026-05-03 13:32:38'),
(34, 'Student', 'Nitzsche', 'Rene', 'Donnelly', 'II', 'runolfsson.gregg@online.htcgsc.edu.ph', '09086321914', '2026-04-26 13:32:16', '2026-05-04 00:38:12'),
(35, 'Student', 'Fisher', 'Meggie', 'Farrell', NULL, 'kenny.rau@online.htcgsc.edu.ph', '09087346520', '2026-04-22 15:28:13', '2026-04-23 04:06:42'),
(36, 'Student', 'Carter', 'Gilbert', 'Ratke', NULL, 'logan.witting@online.htcgsc.edu.ph', '09981775892', '2026-04-09 17:04:48', '2026-05-05 03:49:01'),
(37, 'Student', 'Turcotte', 'Freeman', 'Cruickshank', 'Jr.', 'marcelina33@online.htcgsc.edu.ph', '09203298509', '2026-04-05 23:57:09', '2026-04-08 21:16:44'),
(38, 'Student', 'Ward', 'Jamarcus', 'Lubowitz', NULL, 'zdickinson@online.htcgsc.edu.ph', '09200021068', '2026-04-30 23:00:34', '2026-05-03 12:53:00'),
(39, 'Student', 'Barton', 'Kelley', 'Moore', NULL, 'alison.braun@online.htcgsc.edu.ph', '09189039211', '2026-05-03 17:40:05', '2026-05-04 10:42:54'),
(40, 'Student', 'Labadie', 'Arnaldo', 'Prohaska', NULL, 'mckenzie.zora@online.htcgsc.edu.ph', '09086421042', '2026-04-30 00:55:02', '2026-04-30 10:28:27'),
(41, 'Student', 'Willms', 'Johathan', 'Mosciski', NULL, 'kaylah.boyle@online.htcgsc.edu.ph', '09195044558', '2026-04-17 16:01:16', '2026-04-28 12:53:05'),
(42, 'Student', 'Johns', 'Destiny', 'Prosacco', NULL, 'miracle46@online.htcgsc.edu.ph', '09085153359', '2026-04-22 19:09:57', '2026-04-30 21:38:30'),
(43, 'Student', 'Champlin', 'Katharina', 'Parisian', NULL, 'wilson.moen@online.htcgsc.edu.ph', '09194246372', '2026-04-26 10:35:15', '2026-04-29 08:18:19'),
(44, 'Student', 'Christiansen', 'Demario', 'Dach', NULL, 'kbruen@online.htcgsc.edu.ph', '09188255755', '2026-04-14 23:13:39', '2026-04-16 21:05:00'),
(45, 'Student', 'Emmerich', 'Richie', 'Luettgen', NULL, 'ogrimes@online.htcgsc.edu.ph', '09183614787', '2026-04-24 08:43:03', '2026-04-29 12:27:04'),
(46, 'Student', 'Hirthe', 'Kathryne', 'Robel', 'Jr.', 'torphy.bettye@online.htcgsc.edu.ph', '09988277674', '2026-04-28 10:29:20', '2026-05-01 02:34:10'),
(47, 'Student', 'Aufderhar', 'Ova', 'Beahan', NULL, 'clarissa.hoeger@online.htcgsc.edu.ph', '09209177137', '2026-04-16 09:27:03', '2026-04-24 10:22:49'),
(48, 'Student', 'Christiansen', 'Carey', 'Mitchell', 'Sr.', 'mcglynn.trisha@online.htcgsc.edu.ph', '09171229511', '2026-04-21 12:48:40', '2026-04-29 07:41:22'),
(49, 'Student', 'Bashirian', 'Esperanza', 'Bergstrom', 'II', 'asporer@online.htcgsc.edu.ph', '09185218212', '2026-04-08 14:40:40', '2026-04-23 14:46:38'),
(50, 'Student', 'Collier', 'Parker', 'Ortiz', NULL, 'schimmel.modesto@online.htcgsc.edu.ph', '09188485519', '2026-05-04 22:07:18', '2026-05-04 22:26:12'),
(51, 'Student', 'Nienow', 'Lesley', 'Wolff', NULL, 'mbernier@online.htcgsc.edu.ph', '09207863213', '2026-04-12 11:43:40', '2026-04-24 22:26:00'),
(52, 'Student', 'Wyman', 'Halle', 'Stanton', NULL, 'sylvia.hintz@online.htcgsc.edu.ph', '09177323382', '2026-04-14 17:32:03', '2026-05-03 15:49:52'),
(53, 'Student', 'Hansen', 'Herminia', 'Kohler', NULL, 'theodore.reichert@online.htcgsc.edu.ph', '09186478545', '2026-04-25 02:50:46', '2026-05-01 12:28:50'),
(54, 'Student', 'Nienow', 'Katelyn', 'Hansen', NULL, 'christop60@online.htcgsc.edu.ph', '09200424963', '2026-05-02 19:34:54', '2026-05-02 22:01:32'),
(55, 'Student', 'O\'Hara', 'Monique', 'Homenick', NULL, 'federico26@online.htcgsc.edu.ph', '09181956839', '2026-04-09 08:31:25', '2026-04-25 17:04:21'),
(56, 'Student', 'Jones', 'Elbert', 'Harris', NULL, 'freida.langworth@online.htcgsc.edu.ph', '09203131326', '2026-04-21 03:34:14', '2026-04-23 14:07:25'),
(57, 'Student', 'Witting', 'Sven', 'Satterfield', NULL, 'violette62@online.htcgsc.edu.ph', '09194846826', '2026-04-15 19:19:55', '2026-05-05 00:25:47'),
(58, 'Student', 'Kreiger', 'Desiree', 'Green', NULL, 'tressa13@online.htcgsc.edu.ph', '09987737607', '2026-04-27 21:41:24', '2026-04-28 08:28:40'),
(59, 'Student', 'Kutch', 'Libbie', 'Kemmer', NULL, 'carolanne.bode@online.htcgsc.edu.ph', '09175591786', '2026-04-16 22:19:26', '2026-04-18 09:45:24'),
(60, 'Student', 'Yost', 'Breanna', 'O\'Reilly', NULL, 'grippin@online.htcgsc.edu.ph', '09180798534', '2026-04-07 08:52:02', '2026-04-19 10:07:17');

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
(1, 15, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(2, 19, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(3, 28, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(4, 16, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(5, 27, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(6, 4, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(7, 6, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(8, 2, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(9, 8, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(10, 27, '2026-05-05 06:47:14', '2026-05-05 06:47:14');

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
(1, 9, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(2, 19, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(3, 4, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(4, 21, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(5, 9, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(6, 9, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(7, 12, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(8, 21, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(9, 10, '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(10, 16, '2026-05-05 06:47:14', '2026-05-05 06:47:14');

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
(1, 'Expedita a eos.', '2026-03-05', '2026-05-31', 'Students', 'PDF Document', '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(2, 'Voluptatem et.', '2025-06-25', '2026-05-31', 'Users', 'PDF Document', '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(3, 'Sit aut beatae.', '2026-01-29', '2026-05-11', 'Form Submissions', 'Excel Spreadsheet', '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(4, 'Voluptatum magni et.', '2025-05-16', '2026-05-10', 'Form Submissions', 'PDF Document', '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(5, 'Temporibus nulla.', '2025-11-28', '2026-05-08', 'Students', 'PDF Document', '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(6, 'Qui delectus atque.', '2026-04-19', '2026-05-15', 'Form Submissions', 'PDF Document', '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(7, 'Omnis illum quidem.', '2026-03-12', '2026-05-17', 'Form Submissions', 'PDF Document', '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(8, 'Voluptate ea sunt.', '2025-11-27', '2026-05-17', 'Users', 'PDF Document', '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(9, 'Rem ex saepe.', '2025-06-16', '2026-05-28', 'Form Submissions', 'Excel Spreadsheet', '2026-05-05 06:47:14', '2026-05-05 06:47:14'),
(10, 'Qui libero.', '2025-08-04', '2026-05-25', 'Students', 'Excel Spreadsheet', '2026-05-05 06:47:14', '2026-05-05 06:47:14');

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
(1, 31, '2026-04-13 13:28:12', '2026-04-26 14:57:07'),
(2, 32, '2026-04-30 13:40:25', '2026-05-04 11:30:20'),
(3, 33, '2026-04-14 08:25:31', '2026-04-16 11:24:11'),
(4, 34, '2026-04-17 18:12:53', '2026-05-04 08:57:41'),
(5, 35, '2026-04-25 09:49:36', '2026-05-01 02:07:17'),
(6, 36, '2026-04-18 07:22:42', '2026-05-01 09:28:03'),
(7, 37, '2026-04-06 23:40:53', '2026-04-21 01:54:14'),
(8, 38, '2026-04-14 01:06:44', '2026-04-24 09:59:26'),
(9, 39, '2026-04-06 00:28:02', '2026-04-09 09:32:50'),
(10, 40, '2026-05-04 19:57:00', '2026-05-05 03:50:41'),
(11, 41, '2026-05-01 11:50:24', '2026-05-02 10:39:39'),
(12, 42, '2026-04-19 19:36:34', '2026-04-21 14:50:08'),
(13, 43, '2026-04-11 12:32:03', '2026-04-18 04:51:54'),
(14, 44, '2026-04-16 22:15:57', '2026-04-22 13:06:24'),
(15, 45, '2026-05-01 19:50:59', '2026-05-04 00:58:57'),
(16, 46, '2026-04-19 08:27:09', '2026-04-22 01:26:17'),
(17, 47, '2026-04-10 22:04:21', '2026-04-15 04:46:40'),
(18, 48, '2026-04-26 14:27:24', '2026-05-02 17:02:38'),
(19, 49, '2026-04-08 06:34:53', '2026-04-09 12:06:59'),
(20, 50, '2026-04-23 01:07:41', '2026-05-01 15:58:02'),
(21, 51, '2026-04-24 18:06:03', '2026-04-28 09:30:55'),
(22, 52, '2026-04-22 10:31:32', '2026-04-30 13:26:45'),
(23, 53, '2026-04-27 21:59:40', '2026-05-05 04:08:49'),
(24, 54, '2026-04-28 10:12:15', '2026-05-02 02:33:35'),
(25, 55, '2026-04-26 16:09:29', '2026-04-27 00:51:18'),
(26, 56, '2026-04-25 03:05:53', '2026-04-29 19:45:25'),
(27, 57, '2026-04-14 16:50:30', '2026-04-27 02:36:50'),
(28, 58, '2026-04-18 00:32:03', '2026-04-20 04:43:57'),
(29, 59, '2026-04-08 02:55:10', '2026-04-29 15:48:00'),
(30, 60, '2026-04-26 13:29:57', '2026-04-28 13:21:11');

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
(1, 1, 'Active', '$2y$12$013TW9.EkWbSkeq1SFFEkOfpttJrqvHuANZzT2KRcVlwDP57tCtLW', NULL, NULL, '2026-04-18 18:40:58', '2026-04-29 19:25:59'),
(2, 2, 'Inactive', '$2y$12$gSptyhQfJEzHFfTnh1xYo.pHUXTemPLTwGQIMogQT0QdylGGktFxy', NULL, NULL, '2026-04-16 01:11:52', '2026-05-02 15:35:13'),
(3, 3, 'Inactive', '$2y$12$gw9NuwGbQtQ6UBdNU3f7b.8.rd2.3aTPwSJTyIVgTlo6DIHBBMnM.', NULL, NULL, '2026-05-01 16:49:40', '2026-05-02 23:47:44'),
(4, 4, 'Inactive', '$2y$12$G7tFsQaN5v7Sp293jhHStOOfL6WWbZ/Zjb8zM0uq8wRtwFCq2roLu', NULL, NULL, '2026-04-27 04:55:55', '2026-05-04 10:30:04'),
(5, 5, 'Inactive', '$2y$12$3KsSn7q2rS.5HbnXVgbcS.6GHGtMAlA/Ma67/Jch3o2sUNr.9tX32', NULL, NULL, '2026-04-11 20:57:23', '2026-04-20 16:22:13'),
(6, 6, 'Inactive', '$2y$12$Zx5xiuyrofv0nrY4lJ.bVu13mxEbCxufDUsCBUJLytzS7M.Q.fSsO', NULL, NULL, '2026-05-02 02:24:56', '2026-05-04 18:56:08'),
(7, 7, 'Inactive', '$2y$12$BDF9bOJ0cAZ0znILBMj1m.lMPAI8rUF6UTzoC4lpes2yiiPLUNsEu', NULL, NULL, '2026-04-17 05:11:57', '2026-04-29 03:14:54'),
(8, 8, 'Inactive', '$2y$12$RTJsaaS04evI6I0w/yGwh.XByaPILZyrS1wA6vVJFN6B.a3b0YzXu', NULL, NULL, '2026-04-21 17:07:41', '2026-04-22 11:48:38'),
(9, 9, 'Inactive', '$2y$12$1uEVnHYsL.rNq4OKhMxFi.vUVesZIxIVQ15BGtWTIAPzXy2ravglK', NULL, NULL, '2026-04-17 12:51:25', '2026-05-04 11:08:21'),
(10, 10, 'Inactive', '$2y$12$o42EZbZxuYofhgv4y2O7CelADAwtSU7Zc6R1GdILMwiAaXTNqumgG', NULL, NULL, '2026-04-30 18:42:23', '2026-05-01 06:50:32'),
(11, 11, 'Inactive', '$2y$12$r7QWXmFcbw/1S0LDz6kZWuPoKsWlVjnjoP12bdIWqhyrwSfsaN59e', NULL, NULL, '2026-04-10 21:10:08', '2026-04-29 11:08:27'),
(12, 12, 'Inactive', '$2y$12$d7MV8TPb2Zh86p9B54uTqOo7D6gyGVFmGdoP/gXoJD6Rkzhgzehqi', NULL, NULL, '2026-04-19 21:52:48', '2026-05-03 05:53:37'),
(13, 13, 'Inactive', '$2y$12$CgL93Th4/dzHSGpad1iOhOskFTeMOeukilqwFXfSHR3yPxqlF2mFS', NULL, NULL, '2026-04-20 23:17:03', '2026-04-29 12:32:35'),
(14, 14, 'Inactive', '$2y$12$CR6wigwMqA9/0Zs9qGXpiOos7EYdilsTFd6xwkaCm2N2bnrJJQZVO', NULL, NULL, '2026-04-25 10:09:16', '2026-05-02 19:39:27'),
(15, 15, 'Inactive', '$2y$12$YgyihOoyRaZtjCSU64fI.ueaazyH3Xo7aQYMJJq5y1sTh4YA1541K', NULL, NULL, '2026-04-14 10:04:24', '2026-04-22 13:27:39'),
(16, 16, 'Inactive', '$2y$12$bND0EZF0GZt7UrrY4qLIQ.J0yyVgZtI.51YzB/7MolcvdUIiIdlVa', NULL, NULL, '2026-05-01 14:45:12', '2026-05-01 16:25:41'),
(17, 17, 'Inactive', '$2y$12$sUv1AEMuKFi0z6yOk2DdWeTppgmJBS.G2lNNO4.T7EZhCtVOYj666', NULL, NULL, '2026-04-21 15:47:53', '2026-04-22 04:45:26'),
(18, 18, 'Inactive', '$2y$12$W5VlnFWa..NGFRVtNYx7U.Cml99lrsMeU9Sh0oVZhyiVarctV5vCC', NULL, NULL, '2026-04-12 02:59:38', '2026-04-17 14:19:12'),
(19, 19, 'Inactive', '$2y$12$nLiL6lFdGHzTlRAtqQkLaeidRxAE2XF/zqU/j21pDwlcu9SKYN9bK', NULL, NULL, '2026-04-11 23:58:12', '2026-04-12 00:46:19'),
(20, 20, 'Inactive', '$2y$12$SiaI5YeS4Tlf3DYYB9eTmOb7nb7c7Wf8uliC3C5jWQxdOvVq9yid.', NULL, NULL, '2026-04-07 07:34:33', '2026-04-09 09:47:01'),
(21, 21, 'Inactive', '$2y$12$UbW2brq1BD0at4fU5RrnNeCdaejzpr1dJKlWfwheuVUcSQmiC86Me', NULL, NULL, '2026-05-04 00:46:55', '2026-05-04 06:53:35'),
(22, 22, 'Inactive', '$2y$12$0uq884gosgurHgf6jX8QXu9yFUnJtvWEpUXLYh2VMUiMeg8SyvyS2', NULL, NULL, '2026-04-19 03:11:39', '2026-05-03 21:07:40'),
(23, 23, 'Inactive', '$2y$12$FJ3Ge35ursze8F6B8MVotuyOVnJNZ2jxaQY4ESek3Jpc4X6Y3EyRm', NULL, NULL, '2026-04-23 19:17:04', '2026-04-28 16:26:50'),
(24, 24, 'Inactive', '$2y$12$ZSeWNRgYulXy.veQwvDqgeECeOQd1ZUK23LV9zSTnikq2CcNi4ZdS', NULL, NULL, '2026-04-08 00:47:43', '2026-04-26 23:38:09'),
(25, 25, 'Inactive', '$2y$12$DZePHdvEWfh/KHI6wN5gIu5yteNx1A1B4I.wz7IF4jR8ByZnavAZu', NULL, NULL, '2026-04-22 08:18:48', '2026-04-26 03:57:38'),
(26, 26, 'Inactive', '$2y$12$RwG1/BqSH/iRzVPcdJ1SeuWZrdaJS8SksPD4/p.zYnqwImJqgk2iC', NULL, NULL, '2026-05-03 00:50:41', '2026-05-04 11:17:10'),
(27, 27, 'Inactive', '$2y$12$kfNk3TE9l4JYZCfNsdpBcuf4Kva6MqcupoS.tif1AA0ofZFdJcizq', NULL, NULL, '2026-04-14 08:50:30', '2026-04-26 02:14:25'),
(28, 28, 'Inactive', '$2y$12$rb98cj3x9u52gAcu2qawduvLmOAz0wOgFw70t5aijcO/yvGFqtRHu', NULL, NULL, '2026-04-25 14:50:09', '2026-04-25 23:02:10'),
(29, 29, 'Inactive', '$2y$12$hT6QbMuvL8ZoopoK7Vbq.eaY7yE.tbCsQusqiaVG4TP0UkQQPcalW', NULL, NULL, '2026-04-25 17:23:26', '2026-05-04 10:24:58'),
(30, 30, 'Inactive', '$2y$12$VjGNCTQEzXVYBuvCXQXew.4Vwku.6xHDx4jmC6qYyphJerE/BshBG', NULL, NULL, '2026-04-14 11:08:25', '2026-04-19 13:07:06');

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
