-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 14, 2021 at 01:22 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iacuc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval_attachments`
--

DROP TABLE IF EXISTS `approval_attachments`;
CREATE TABLE IF NOT EXISTS `approval_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `original_filename` varchar(255) NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `date_uploaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `approval_attachments`
--

INSERT INTO `approval_attachments` (`id`, `protocol_id`, `filename`, `original_filename`, `uploaded_by`, `date_uploaded`) VALUES
(1, 1, 'prf_id-1-approval_attachment-tFWZsBkn.pdf', 'Tinao, Daniel D. -Toggl_Track_summary_report_2021-08-01_2021-08-31 (1).pdf', 3, '2021-09-04 21:09:52'),
(2, 2, 'prf_id-2-approval_attachment-WUIqatC5.pdf', 'Tinao, Daniel D. -Toggl_Track_summary_report_2021-08-01_2021-08-31.pdf', 3, '2021-09-04 21:16:47'),
(3, 2, 'prf_id-2-approval_attachment-tzQ0r31o.pdf', 'Tinao, Daniel D. -Toggl_Track_summary_report_2021-08-01_2021-08-31 (1).pdf', 3, '2021-09-04 21:19:26'),
(4, 11, 'prf_id-11-approval_attachment-ZtU7kPwM.pdf', '20210914165739.pdf', 3, '2021-09-25 20:26:11'),
(5, 11, 'prf_id-11-approval_attachment-YBqQN6yI.pdf', '20210914165739.pdf', 3, '2021-09-25 20:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prf_protocol`
--

DROP TABLE IF EXISTS `prf_protocol`;
CREATE TABLE IF NOT EXISTS `prf_protocol` (
  `protocol_id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol_no` varchar(255) DEFAULT NULL,
  `approval_ref` varchar(255) DEFAULT NULL,
  `invest_id` int(11) NOT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `protocol_name` varchar(255) DEFAULT NULL,
  `funding_source` text,
  `prev_protocol` tinyint(4) NOT NULL DEFAULT '0',
  `prev_protocol_no` varchar(255) DEFAULT NULL,
  `purpose` text,
  `objectives` text,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `background_significance` text,
  `basis_in_selecting` text,
  `quarantine_conditioning` text,
  `cage_type` text,
  `num_animals` text,
  `identification_animals` text,
  `cage_cleaning` text,
  `living_condition` text,
  `animal_diet` text,
  `method_desc` text,
  `method_location` text,
  `method_dosing` text,
  `method_collection` text,
  `method_examination` text,
  `method_anesthetics` text,
  `method_surgical` text,
  `humane_endpoint` text,
  `potential_hazards` text,
  `waste_disposal` text,
  `suitable_alternatives` text,
  `other_reference` text,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`protocol_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prf_protocol`
--

INSERT INTO `prf_protocol` (`protocol_id`, `protocol_no`, `approval_ref`, `invest_id`, `institute_id`, `category`, `protocol_name`, `funding_source`, `prev_protocol`, `prev_protocol_no`, `purpose`, `objectives`, `date_from`, `date_to`, `background_significance`, `basis_in_selecting`, `quarantine_conditioning`, `cage_type`, `num_animals`, `identification_animals`, `cage_cleaning`, `living_condition`, `animal_diet`, `method_desc`, `method_location`, `method_dosing`, `method_collection`, `method_examination`, `method_anesthetics`, `method_surgical`, `humane_endpoint`, `potential_hazards`, `waste_disposal`, `suitable_alternatives`, `other_reference`, `date_created`) VALUES
(1, NULL, NULL, 9, 1, NULL, 'TEST', 'TEST', 0, NULL, 'RESEARCH', NULL, '2021-09-01 00:00:00', '2021-09-30 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-04 20:39:59'),
(2, '456', NULL, 1, 1, NULL, '2nd TEST', 'TEST', 1, 'TEST', 'RESEARCH', 'TEST', '2021-09-04 00:00:00', '2021-09-05 00:00:00', 'TEST', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '11', '1', '1', '1', '1', '1', '1', '2021-09-04 21:12:57'),
(3, NULL, NULL, 9, 1, 4, '1', '1', 1, '1', 'RESEARCH', '1', '2021-09-04 00:00:00', '2021-09-05 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2021-09-04 21:22:22'),
(4, NULL, NULL, 1, 1, NULL, NULL, NULL, 0, NULL, 'RESEARCH', NULL, '2021-09-09 00:00:00', '2021-09-10 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-09 20:13:46'),
(5, NULL, NULL, 1, 1, NULL, NULL, NULL, 0, NULL, 'RESEARCH', NULL, '2021-09-09 00:00:00', '2021-09-10 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-09 21:15:27'),
(6, NULL, NULL, 1, 1, NULL, '11', '1', 1, '1', 'RESEARCH', '1', '2021-08-01 00:00:00', '2021-08-31 00:00:00', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', NULL, '1', '1', '1', '1', '2021-09-09 21:20:09'),
(7, NULL, NULL, 1, 1, NULL, NULL, NULL, 0, NULL, 'RESEARCH', NULL, '2021-09-09 00:00:00', '2021-09-10 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-09 21:20:32'),
(8, '1234', NULL, 1, 1, 1, 'TESTTEST', NULL, 0, NULL, 'RESEARCH', NULL, '2021-09-09 00:00:00', '2021-09-10 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-09 21:20:57'),
(9, NULL, NULL, 1, 1, NULL, '1', '11', 1, '1', 'RESEARCH', '1', '2021-09-09 00:00:00', '2021-09-23 00:00:00', '1', '1', '1', '1', '1', '11', '1', '1', '1', '1', '1', '1', '11', '1', NULL, '1', '1', '1', '1', '1', '1', '2021-09-09 21:32:17'),
(10, NULL, NULL, 15, 1, NULL, 'Test', 'TEST', 1, 'TEST', 'RESEARCH', 'Test', '2021-09-25 00:00:00', '2021-09-30 00:00:00', 'TEST', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', NULL, 'TEst', 'TEst', 'TEst', 'TEst', 'TEST', '2021-09-25 19:20:26'),
(11, '123456', NULL, 16, 1, NULL, 'Test', 'TEST', 1, 'ETS', 'RESEARCH', 'TEST', '2021-09-25 00:00:00', '2021-09-30 00:00:00', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'v', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', '2021-09-25 19:42:06'),
(12, NULL, NULL, 16, 1, NULL, 'TEST', 'TEST', 1, 'TEST', 'RESEARCH', 'TEST', '2021-09-27 00:00:00', '2021-09-30 00:00:00', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TESTTEST', 'TESTqTEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', '2021-09-25 22:06:51'),
(13, NULL, NULL, 16, 1, NULL, NULL, NULL, 0, NULL, 'RESEARCH', NULL, '2021-09-25 00:00:00', '2021-09-26 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-25 22:57:50'),
(14, NULL, NULL, 16, 1, NULL, 'TEST', 'TEST', 1, 'TEST', 'RESEARCH', 'TEST', '2021-12-13 00:00:00', '2021-12-17 00:00:00', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'v', NULL, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', '2021-12-13 23:04:22'),
(15, NULL, NULL, 16, 1, NULL, 'TEST', 'TEST', 1, 'TEST', 'RESEARCH', 'TEST', '2021-12-13 00:00:00', '2021-12-14 00:00:00', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'v', NULL, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', '2021-12-13 23:05:19'),
(16, NULL, NULL, 16, 1, NULL, 'TEST', 'TEST', 1, 'TEST', 'RESEARCH', 'TEST', '2021-12-13 00:00:00', '2021-12-14 00:00:00', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'v', NULL, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', '2021-12-13 23:05:48'),
(17, NULL, NULL, 16, 1, NULL, 'TEST', 'TEST', 1, 'TEST', 'RESEARCH', 'TEST', '2021-12-13 00:00:00', '2021-12-14 00:00:00', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'v', NULL, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', '2021-12-13 23:06:01'),
(18, NULL, NULL, 16, 1, NULL, 'TEST', 'TEST', 1, 'TEST', 'RESEARCH', 'TEST', '2021-12-13 00:00:00', '2021-12-14 00:00:00', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'v', NULL, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', '2021-12-13 23:07:40');

-- --------------------------------------------------------

--
-- Table structure for table `prf_protocol_animals`
--

DROP TABLE IF EXISTS `prf_protocol_animals`;
CREATE TABLE IF NOT EXISTS `prf_protocol_animals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol_id` int(11) NOT NULL,
  `species` varchar(255) DEFAULT NULL,
  `strain` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prf_protocol_animals`
--

INSERT INTO `prf_protocol_animals` (`id`, `protocol_id`, `species`, `strain`, `source`, `age`, `weight`, `sex`, `number`) VALUES
(3, 2, 'TEST', 'TEST', 'TEST', '1', '1', '1', '1'),
(2, 9, '1', '1', '1', '1', '1', '1', '1'),
(5, 6, '1', '1', '1', '1', '1', '1', '1'),
(9, 3, '1', '1', '1', '1', '1', '1', '1'),
(19, 10, 'test', 'test', 'teset', '123', '121', '2', '2'),
(18, 10, 'Test', 'test', 'test', '213', '23', '23', '23'),
(21, 11, 'TEST', 'TEST', 'TEST', '1', '121', '2', '21'),
(28, 12, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'Female', 'TEST'),
(26, 13, '1', '2', '3', '4', '5', 'Female', '5'),
(27, 13, '23', '4', '5', '6', '8', 'N/A', '1'),
(29, 12, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'Male', 'TEST'),
(30, 15, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'Male', 'TEST'),
(31, 16, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'Male', 'TEST'),
(32, 17, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'Male', 'TEST'),
(33, 18, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST', 'Male', 'TEST');

-- --------------------------------------------------------

--
-- Table structure for table `prf_protocol_personnel`
--

DROP TABLE IF EXISTS `prf_protocol_personnel`;
CREATE TABLE IF NOT EXISTS `prf_protocol_personnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `roles` text,
  `qualification` text,
  `training_vacc` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prf_protocol_personnel`
--

INSERT INTO `prf_protocol_personnel` (`id`, `protocol_id`, `name`, `title`, `roles`, `qualification`, `training_vacc`) VALUES
(3, 2, '1', '1', '1', '1', '1'),
(2, 9, '1', '1', '1', '1', '11'),
(5, 6, '1', '1', '1', '11', '1'),
(9, 3, '1', '1', '1', '1', '1'),
(19, 10, 'TEST', 'TEST', 'TEST', '1', '2'),
(18, 10, 'test', 'test', 'test', '1', '2'),
(21, 11, 'TEST', 'TEST', 'TEST', '1', '1'),
(26, 12, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST'),
(27, 15, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST'),
(28, 16, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST'),
(29, 17, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST'),
(30, 18, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST');

-- --------------------------------------------------------

--
-- Table structure for table `prf_protocol_qualifications`
--

DROP TABLE IF EXISTS `prf_protocol_qualifications`;
CREATE TABLE IF NOT EXISTS `prf_protocol_qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol_id` int(11) NOT NULL,
  `qualification_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prf_protocol_qualifications`
--

INSERT INTO `prf_protocol_qualifications` (`id`, `protocol_id`, `qualification_desc`) VALUES
(15, 10, 'TEST'),
(14, 10, 'TEST'),
(13, 10, 'TEST'),
(17, 11, 'TEST'),
(22, 12, 'TEST'),
(23, 14, 'TEST'),
(24, 15, 'TEST'),
(25, 16, 'TEST'),
(26, 17, 'TEST'),
(27, 18, 'TEST');

-- --------------------------------------------------------

--
-- Table structure for table `prf_protocol_rs`
--

DROP TABLE IF EXISTS `prf_protocol_rs`;
CREATE TABLE IF NOT EXISTS `prf_protocol_rs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol_id` int(11) NOT NULL,
  `research_study` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prf_protocol_rs`
--

INSERT INTO `prf_protocol_rs` (`id`, `protocol_id`, `research_study`) VALUES
(1, 1, 'TEST'),
(4, 2, 'TEST'),
(3, 9, '1'),
(6, 6, '1'),
(10, 3, '1'),
(15, 10, 'TEST'),
(19, 11, 'TEST'),
(18, 11, 'Test'),
(24, 12, 'TEST'),
(25, 14, 'TEST'),
(26, 15, 'TEST'),
(27, 16, 'TEST'),
(28, 17, 'TEST'),
(29, 18, 'TEST');

-- --------------------------------------------------------

--
-- Table structure for table `prf_series`
--

DROP TABLE IF EXISTS `prf_series`;
CREATE TABLE IF NOT EXISTS `prf_series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `current_last` varchar(255) NOT NULL,
  `counter_length` int(11) NOT NULL,
  `current_counter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prf_series`
--

INSERT INTO `prf_series` (`id`, `type`, `year`, `current_last`, `counter_length`, `current_counter`) VALUES
(1, 'PRF', 2021, 'PRF-2021-051', 3, 51),
(2, 'AP', 2021, 'AP-2021-000', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `protocol_status`
--

DROP TABLE IF EXISTS `protocol_status`;
CREATE TABLE IF NOT EXISTS `protocol_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `protocol_status`
--

INSERT INTO `protocol_status` (`id`, `protocol_id`, `status`, `created_by`, `date_created`) VALUES
(1, 1, 1, 9, '2021-09-04 20:42:35'),
(2, 1, 2, 9, '2021-09-04 20:48:51'),
(3, 1, 3, 4, '2021-09-04 20:55:23'),
(4, 1, 2, 9, '2021-09-04 21:00:25'),
(5, 1, 6, 4, '2021-09-04 21:03:54'),
(6, 1, 8, 3, '2021-09-04 21:09:57'),
(7, 2, 1, 9, '2021-09-04 21:12:57'),
(8, 2, 2, 9, '2021-09-04 21:14:48'),
(9, 2, 6, 4, '2021-09-04 21:15:57'),
(10, 2, 7, 3, '2021-09-04 21:16:50'),
(11, 2, 6, 9, '2021-09-04 21:18:34'),
(12, 2, 9, 3, '2021-09-04 21:19:29'),
(13, 2, 2, 9, '2021-09-04 21:20:17'),
(14, 2, 6, 4, '2021-09-04 21:21:38'),
(15, 3, 1, 9, '2021-09-04 21:22:22'),
(16, 4, 1, 1, '2021-09-09 20:13:46'),
(17, 5, 1, 1, '2021-09-09 21:15:27'),
(18, 6, 1, 1, '2021-09-09 21:20:09'),
(19, 6, 2, 1, '2021-09-09 21:20:27'),
(20, 7, 1, 1, '2021-09-09 21:20:32'),
(21, 7, 2, 1, '2021-09-09 21:20:38'),
(22, 8, 1, 1, '2021-09-09 21:20:57'),
(23, 8, 2, 1, '2021-09-09 21:21:04'),
(24, 9, 1, 1, '2021-09-09 21:32:17'),
(25, 9, 2, 1, '2021-09-09 21:56:24'),
(26, 9, 2, 1, '2021-09-09 21:59:02'),
(27, 2, 9, 3, '2021-09-09 22:05:40'),
(28, 2, 2, 1, '2021-09-09 22:06:02'),
(29, 6, 6, 4, '2021-09-09 22:07:03'),
(30, 6, 9, 3, '2021-09-09 22:07:24'),
(31, 6, 6, 1, '2021-09-09 22:08:10'),
(32, 6, 9, 3, '2021-09-09 22:08:25'),
(33, 6, 6, 1, '2021-09-09 22:08:38'),
(34, 6, 8, 3, '2021-09-09 22:10:21'),
(35, 3, 2, 9, '2021-09-09 22:14:07'),
(36, 3, 6, 4, '2021-09-09 22:14:30'),
(37, 3, 9, 3, '2021-09-09 22:14:48'),
(38, 7, 3, 4, '2021-09-09 22:35:04'),
(39, 8, 6, 4, '2021-09-09 22:36:04'),
(40, 3, 6, 9, '2021-09-09 22:38:55'),
(41, 3, 6, 9, '2021-09-09 22:39:21'),
(42, 3, 6, 9, '2021-09-09 22:39:54'),
(43, 10, 1, 15, '2021-09-25 19:20:27'),
(44, 10, 2, 15, '2021-09-25 19:20:54'),
(45, 10, 2, 15, '2021-09-25 19:21:18'),
(46, 10, 2, 15, '2021-09-25 19:22:18'),
(47, 10, 2, 15, '2021-09-25 19:23:24'),
(48, 11, 1, 16, '2021-09-25 19:42:06'),
(49, 11, 2, 16, '2021-09-25 19:42:12'),
(50, 11, 6, 4, '2021-09-25 19:51:03'),
(51, 11, 6, 4, '2021-09-25 19:51:04'),
(52, 11, 9, 3, '2021-09-25 20:26:17'),
(53, 11, 6, 16, '2021-09-25 20:30:05'),
(54, 11, 8, 3, '2021-09-25 20:30:37'),
(55, 9, 6, 1, '2021-09-25 21:11:35'),
(56, 2, 6, 4, '2021-09-25 21:12:11'),
(57, 12, 1, 16, '2021-09-25 22:06:51'),
(58, 12, 2, 16, '2021-09-25 22:07:06'),
(59, 12, 2, 16, '2021-09-25 22:08:39'),
(60, 13, 1, 16, '2021-09-25 22:57:50'),
(61, 12, 2, 16, '2021-09-25 23:05:58'),
(62, 15, 1, 16, '2021-12-13 23:05:20'),
(63, 16, 1, 16, '2021-12-13 23:05:49'),
(64, 17, 1, 16, '2021-12-13 23:06:02'),
(65, 18, 1, 16, '2021-12-13 23:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status`
--

DROP TABLE IF EXISTS `ref_status`;
CREATE TABLE IF NOT EXISTS `ref_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_status`
--

INSERT INTO `ref_status` (`id`, `description`) VALUES
(1, 'CREATED'),
(2, 'FOR APPROVAL UNIT'),
(3, 'RETURNED FROM UNIT'),
(9, 'REJECTED'),
(6, 'FOR APPROVAL SECRETARY'),
(7, 'MINOR REVISIONS'),
(8, 'FINAL APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'SUPERUSER'),
(2, 'PRINCIPAL INVESTIGATOR'),
(3, 'UNIT REPRESENTATIVE'),
(4, 'SECRETARY');

-- --------------------------------------------------------

--
-- Table structure for table `signatories`
--

DROP TABLE IF EXISTS `signatories`;
CREATE TABLE IF NOT EXISTS `signatories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signatories`
--

INSERT INTO `signatories` (`id`, `description`, `name`) VALUES
(1, 'CHAIRPERSON', 'Cynthia Saloma, PhD'),
(2, 'VETERINARIAN', 'Ma. Amelita Estacio, DVM, PhD, DPCLAM');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `partner_unit` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `partner_unit`, `description`) VALUES
(1, 'IB', 2, 'Institute of Biology'),
(2, 'IC', 1, 'Institute of Chemistry'),
(3, 'MSI', 4, 'Marine Science Institute'),
(4, 'NIMBB', 3, 'National Institute of Molecular Biology and Biotechnology'),
(5, 'NSRI', 6, 'Natural Sciences Research Institute'),
(6, 'CHE', 5, 'text');

-- --------------------------------------------------------

--
-- Table structure for table `unit_reviews`
--

DROP TABLE IF EXISTS `unit_reviews`;
CREATE TABLE IF NOT EXISTS `unit_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol_id` int(11) DEFAULT NULL,
  `is_approval_unit` tinyint(4) DEFAULT NULL,
  `is_secretary` tinyint(4) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `protocol_comments` text,
  `objectives_comments` text,
  `duration_comments` text,
  `investigator_comments` text,
  `background_comments` text,
  `animals_comments` text,
  `basis_comments` text,
  `quarantine_comments` text,
  `cage_comments` text,
  `numanimals_comments` text,
  `identification_comments` text,
  `cageclean_comments` text,
  `living_comments` text,
  `diet_comments` text,
  `general_comments` text,
  `location_comments` text,
  `dosing_comments` text,
  `collection_comments` text,
  `examination_comments` text,
  `anesthetics_comments` text,
  `surgical_comments` text,
  `humane_comments` text,
  `hazards_comments` text,
  `disposal_comments` text,
  `alternative_comments` text,
  `personnel_comments` text,
  `references_comments` text,
  `review_status` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit_reviews`
--

INSERT INTO `unit_reviews` (`id`, `protocol_id`, `is_approval_unit`, `is_secretary`, `unit_id`, `protocol_comments`, `objectives_comments`, `duration_comments`, `investigator_comments`, `background_comments`, `animals_comments`, `basis_comments`, `quarantine_comments`, `cage_comments`, `numanimals_comments`, `identification_comments`, `cageclean_comments`, `living_comments`, `diet_comments`, `general_comments`, `location_comments`, `dosing_comments`, `collection_comments`, `examination_comments`, `anesthetics_comments`, `surgical_comments`, `humane_comments`, `hazards_comments`, `disposal_comments`, `alternative_comments`, `personnel_comments`, `references_comments`, `review_status`, `date_created`, `created_by`) VALUES
(1, 1, 1, 0, 1, 'TEST 1', 'TEST 2', 'TEST 3', 'TEST 4', 'TEST 5', 'TEST 6', 'TEST 7', 'TEST 8', 'TEST 9', 'TEST 10', 'TEST 11', 'TEST 12', 'TEST 13', 'TEST 14', 'TEST 15', 'TEST 16', 'TEST 17', 'TEST 18', 'TEST 19', 'TEST 20', 'TEST 16', 'TEST 16', 'TEST 16', 'TEST 16', 'TEST 16', 'TEST 16', 'TEST 16', 'FINAL APPROVED', '2021-09-04 20:55:09', 4),
(2, 2, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Approve by Unit', '2021-09-04 21:15:46', 4),
(3, 6, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FINAL APPROVED', '2021-09-09 22:06:52', 4),
(4, 3, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MINOR REVISIONS', '2021-09-09 22:14:21', 4),
(5, 7, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RETURNED', '2021-09-09 22:35:00', 4),
(6, 8, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Approve by Unit', '2021-09-09 22:35:55', 4),
(7, 11, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FINAL APPROVED', '2021-09-25 19:42:39', 4),
(8, 9, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Approve by Unit', '2021-09-25 21:07:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `honorifics` text COLLATE utf8mb4_unicode_ci,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `honorifics`, `name`, `email`, `contact_number`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Mr.', 'REGINALD MURILLO', 'reginaldnmurillo@gmail.com', '09955584519', '2020-11-16 16:00:00', '$2y$10$OhUgvHRBag2/NprOUbF1m.qxL0Ntabg1L4stLSLRx1mhmjcrKzcp.', NULL, '2020-11-16 16:00:00', '2020-11-16 16:00:00', 1),
(2, NULL, 'nonoy murillo', 'nonoymurillo@gmail.com', '09955584519', NULL, '$2y$10$OhUgvHRBag2/NprOUbF1m.qxL0Ntabg1L4stLSLRx1mhmjcrKzcp.', NULL, NULL, NULL, 1),
(3, NULL, 'secretary', 'secretary@email.com', '213123123', NULL, '$2y$10$OhUgvHRBag2/NprOUbF1m.qxL0Ntabg1L4stLSLRx1mhmjcrKzcp.', NULL, NULL, NULL, 1),
(4, NULL, 'ibrep', 'ibrep@email.com', '123213213', NULL, '$2y$10$OhUgvHRBag2/NprOUbF1m.qxL0Ntabg1L4stLSLRx1mhmjcrKzcp.', NULL, NULL, NULL, 1),
(5, NULL, 'icrep', 'icrep@email.com', '13123111', NULL, '$2y$10$OhUgvHRBag2/NprOUbF1m.qxL0Ntabg1L4stLSLRx1mhmjcrKzcp.', NULL, NULL, NULL, 1),
(6, NULL, 'superadmin', 'superadmin@email.com', '12345678', NULL, '$2y$10$OhUgvHRBag2/NprOUbF1m.qxL0Ntabg1L4stLSLRx1mhmjcrKzcp.', NULL, NULL, NULL, 1),
(16, 'Mr.', 'Daniel Tinao', 'danieltinao@gmail.com', '09562756220', NULL, '$2y$10$SIIyN8ipVz2fA4MKDJkveekGuijK3aSRgy3g5rYZDhHobSOEp0z7K', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `unit_id`) VALUES
(19, 11, 1, NULL),
(17, 10, 1, NULL),
(16, 1, 1, 2),
(4, 2, 2, NULL),
(5, 3, 4, NULL),
(11, 6, 1, NULL),
(7, 5, 3, 2),
(10, 4, 3, 1),
(14, 8, 2, NULL),
(13, 7, 2, NULL),
(18, 9, 2, NULL),
(20, 12, 1, NULL),
(21, 13, 1, NULL),
(24, 14, 1, NULL),
(25, 15, 2, NULL),
(26, 16, 2, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_protocol_status`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_protocol_status`;
CREATE TABLE IF NOT EXISTS `vw_protocol_status` (
`protocol_id` int(11)
,`status` varchar(255)
,`status_date` datetime
);

-- --------------------------------------------------------

--
-- Structure for view `vw_protocol_status`
--
DROP TABLE IF EXISTS `vw_protocol_status`;

DROP VIEW IF EXISTS `vw_protocol_status`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_protocol_status`  AS  select `a`.`protocol_id` AS `protocol_id`,`d`.`description` AS `status`,`a`.`status_date` AS `status_date` from ((((select `c`.`protocol_id` AS `protocol_id`,`c`.`status` AS `status`,`c`.`date_created` AS `status_date` from `protocol_status` `c` where (`c`.`date_created` = (select max(`protocol_status`.`date_created`) from `protocol_status` where (`protocol_status`.`protocol_id` = `c`.`protocol_id`))))) `a` left join `prf_protocol` `b` on((`b`.`protocol_id` = `a`.`protocol_id`))) left join `ref_status` `d` on((`d`.`id` = `a`.`status`))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
