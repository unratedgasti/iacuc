-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2021 at 07:40 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `approval_attachments`
--

INSERT INTO `approval_attachments` (`id`, `protocol_id`, `filename`, `original_filename`, `uploaded_by`, `date_uploaded`) VALUES
(1, 30, 'prf_id-30-approval_attachment-9SUkPBfg.pdf', 'Bank deposit authorization (1).pdf', 3, '2021-06-02 15:19:14'),
(2, 30, 'prf_id-30-approval_attachment-tsT5GU73.pdf', 'Bank deposit authorization (2).pdf', 3, '2021-06-02 15:19:18');

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
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prf_protocol`
--

INSERT INTO `prf_protocol` (`protocol_id`, `protocol_no`, `approval_ref`, `invest_id`, `institute_id`, `protocol_name`, `funding_source`, `prev_protocol`, `prev_protocol_no`, `purpose`, `objectives`, `date_from`, `date_to`, `background_significance`, `basis_in_selecting`, `quarantine_conditioning`, `cage_type`, `num_animals`, `identification_animals`, `cage_cleaning`, `living_condition`, `animal_diet`, `method_desc`, `method_location`, `method_dosing`, `method_collection`, `method_examination`, `method_anesthetics`, `method_surgical`, `humane_endpoint`, `potential_hazards`, `waste_disposal`, `suitable_alternatives`, `other_reference`, `date_created`) VALUES
(15, 'PRF-2021-001-T', NULL, 1, 2, 'asdasd', 'asdasdasdasd\r\nasdasdasd\r\nasdasd', 1, 'sadsadasd', 'TEACHING', 'sadasdasdsadhjfhkasd\r\nsaddsad', '2021-01-20 00:00:00', '2021-01-22 00:00:00', 'asdasdasd\r\nsadasd\r\nasdasdasdasd sadasd', 'dsasdasd', 'asdsds sdasdasdasd', 'asdasd asdasd asdasda\r\nsd asdasd', 'asdsddsas', 'dasdsdasdasd', 'asdsdfffgfdf', 'dfdfdfdfgfgfdfgdfg', 'dfgfdgfdg', 'fdgdfg', 'dfgfdgfdg', 'gfdgfdgd', 'fgdfgdfg', 'dfgdfgdf', 'gdfgdf', 'gdfgdfgdfgsdsdgf', 'gfhgfhgfh', 'dsfsdfsdfsdf', 'gfhfghfghfghfgh', 'fdgdgfdgfdg', 'fsdfsdgsdfgsd\r\nfsd fsdfsd\r\nfsdf\r\n sdfsdfsdf', '2021-01-21 13:20:23'),
(16, 'PRF-2021-002-T', NULL, 1, 2, 'asdasd', 'asdasdasdasd\r\nasdasdasd\r\nasdasd', 1, 'sadsadasd', 'TEACHING', 'sadasdasdsadhjfhkasd\r\nsaddsad\r\n\r\nsdfsdf\r\n\r\nasdasdasd', '2021-01-20 00:00:00', '2021-01-22 00:00:00', 'asdasdasd\r\nsadasd\r\nasdasdasdasd sadasd', 'dsasdasd', 'asdsds sdasdasdasd', 'asdasd asdasd asdasda\r\nsd asdasd', 'asdsddsas', 'dasdsdasdasd', 'asdsdfffgfdf', 'dfdfdfdfgfgfdfgdfg', 'dfgfdgfdg', 'fdgdfg', 'dfgfdgfdg', 'gfdgfdgd', 'fgdfgdfg', 'dfgdfgdf', 'gdfgdf', 'xzcxzcxzcxz\r\nsdfsdfsdfsd', 'gfhgfhgfh', 'dsfsdfsdfsdf', 'gfhfghfghfghfgh', 'gfhfghfghfghfgh', 'fsdfsdgsdfgsd\r\nfsd fsdfsd\r\nfsdf\r\n sdfsdfsdf', '2021-01-21 13:20:23'),
(17, 'PRF-2021-003-T', NULL, 1, 2, 'asdasd', 'asdasdasdasd\r\nasdasdasd\r\nasdasd', 1, 'sadsadasd', 'TEACHING', 'sadasdasdsadhjfhkasd\r\nsaddsad', '2021-01-20 00:00:00', '2021-01-22 00:00:00', 'asdasdasd\r\nsadasd\r\nasdasdasdasd sadasd', 'dsasdasd', 'asdsds sdasdasdasd', 'asdasd asdasd asdasda\r\nsd asdasd', 'asdsddsas', 'dasdsdasdasd', 'asdsdfffgfdf', 'dfdfdfdfgfgfdfgdfg', 'dfgfdgfdg', 'fdgdfg', 'dfgfdgfdg', 'gfdgfdgd', 'fgdfgdfg', 'dfgdfgdf', 'gdfgdf', 'gdfgdfgdfgsdsdgf', 'gfhgfhgfh', 'dsfsdfsdfsdf', 'gfhfghfghfghfgh', 'fdgdgfdgfdg', 'fsdfsdgsdfgsd\r\nfsd fsdfsd\r\nfsdf\r\n sdfsdfsdf', '2021-01-21 13:20:23'),
(18, 'PRF-2021-004-T', NULL, 1, 2, 'asdasd', 'asdasdasdasd\r\nasdasdasd\r\nasdasd', 1, 'sadsadasd', 'TEACHING', 'sadasdasdsadhjfhkasd\r\nsaddsad', '2021-01-20 00:00:00', '2021-01-22 00:00:00', 'asdasdasd\r\nsadasd\r\nasdasdasdasd sadasd', 'dsasdasd', 'asdsds sdasdasdasd', 'asdasd asdasd asdasda\r\nsd asdasd', 'asdsddsas', 'dasdsdasdasd', 'asdsdfffgfdf', 'dfdfdfdfgfgfdfgdfg', 'dfgfdgfdg', 'fdgdfg', 'dfgfdgfdg', 'gfdgfdgd', 'fgdfgdfg', 'dfgdfgdf', 'gdfgdf', 'gdfgdfgdfgsdsdgf', 'gfhgfhgfh', 'dsfsdfsdfsdf', 'gfhfghfghfghfgh', 'fdgdgfdgfdg', 'fsdfsdgsdfgsd\r\nfsd fsdfsd\r\nfsdf\r\n sdfsdfsdf', '2021-01-21 13:20:23'),
(19, 'PRF-2021-009-R', NULL, 1, 1, 'dsadsadasdasd', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(20, 'PRF-2021-010-R', NULL, 1, 1, 'dsadsadasdasd', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(21, 'PRF-2021-011-R', NULL, 1, 1, 'dsadsadasdasd', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(22, 'PRF-2021-012-R', NULL, 1, 1, 'dsadsadasdasd', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(23, 'PRF-2021-013-R', NULL, 1, 1, 'dsadsadasdasd', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(24, 'PRF-2021-014-R', NULL, 1, 1, 'sds', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(25, 'PRF-2021-015-R', NULL, 1, 1, 'sds', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(26, 'PRF-2021-016-R', NULL, 1, 1, 'sds', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(27, 'PRF-2021-017-R', NULL, 1, 1, 'sds', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(28, 'PRF-2021-018-R', NULL, 1, 1, 'sds', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(29, 'PRF-2021-019-R', NULL, 1, 1, 'sds', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(30, 'PRF-2021-020-R', NULL, 1, 1, 'sds', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(31, 'PRF-2021-021-R', NULL, 1, 1, 'sds', NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-21 13:20:23'),
(32, 'PRF-2021-022-T', NULL, 1, 2, 'asdasd', 'xzczxc', 1, 'xcxzc', 'TEACHING', 'xzcxzczc', '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'zxczxczxc', 'xzczxc', 'zxczx', 'zxczxc', 'zxczxc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sdasdasd \r\nasdasda\r\nasdasd\r\nasdasd\r\nasdasd\r\nasddasd', '2021-01-21 13:20:23'),
(33, 'PRF-2021-023-R', NULL, 1, 1, NULL, NULL, 0, NULL, 'RESEARCH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-19 09:58:12'),
(34, 'PRF-2021-024-R', NULL, 1, 1, 'asdasddsada', 'asdasd', 1, 'sadasdasd', 'RESEARCH', 'asdasd', '2021-02-18 00:00:00', '2021-02-25 00:00:00', 'asadsadasd', 'sadadsa', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'sadasd', 'asdasd', 'asdasd', 'asdasd', 'asdasdas', 'asdasd', 'a. asdasd\r\nb. asdasdasd\r\nc. asdasdasd\r\nd. asdsadasd', 'asdasd', 'asdasdsad', 'asdasd', 'asdasd', 'sadasdasdasdasdasd\r\nsadasdasd', '2021-02-24 10:23:33'),
(35, 'PRF-2021-025-R', NULL, 2, 1, 'asdsd', 'asdasdasd', 1, 'sddasdasdad', 'RESEARCH', 'asdasd', '1970-01-28 00:00:00', '1970-01-16 00:00:00', 'adasdasd dadsad', 'asdasd', 'asdasd', 'asdasd', 'sadasd', 'asddas', 'asdasd', 'sadasd', 'asdasd', 'sadasd', 'asdsad', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'ddsfdsfsd', 'asdas', 'asda', 'asdasd', 'asdasd', 'asdasdasdasd', '2021-02-24 12:46:45');

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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prf_protocol_animals`
--

INSERT INTO `prf_protocol_animals` (`id`, `protocol_id`, `species`, `strain`, `source`, `age`, `weight`, `sex`, `number`) VALUES
(1, 8, 'asdasdas', NULL, 'sadasd', 'asdasd', 'asdasd', 'asdasd', 'dasdasd'),
(2, 8, 'asdasd', 'asdasd', 'asdasd', 'dasdas', 'asdsad', 'asdasd', 'asdasd'),
(3, 10, 'asdasdas', NULL, 'sadasd', 'asdasd', 'asdasd', 'asdasd', 'dasdasd'),
(4, 10, 'asdasd', 'asdasd', 'asdasd', 'dasdas', 'asdsad', 'asdasd', 'asdasd'),
(5, 11, 'asdasdas', NULL, 'sadasd', 'asdasd', 'asdasd', 'asdasd', 'dasdasd'),
(6, 11, 'asdasd', 'asdasd', 'asdasd', 'dasdas', 'asdsad', 'asdasd', 'asdasd'),
(7, 12, 'asdasdas', NULL, 'sadasd', 'asdasd', 'asdasd', 'asdasd', 'dasdasd'),
(8, 12, 'asdasd', 'asdasd', 'asdasd', 'dasdas', 'asdsad', 'asdasd', 'asdasd'),
(9, 13, 'asdasdas', NULL, 'sadasd', 'asdasd', 'asdasd', 'asdasd', 'dasdasd'),
(10, 13, 'asdasd', 'asdasd', 'asdasd', 'dasdas', 'asdsad', 'asdasd', 'asdasd'),
(11, 14, 'sadasd', 'asdas', 'dasdas', 'asd', 'asdasd', 'sadas', 'dasdasd'),
(32, 16, 'asdasd', 'asdasd', 'sadasd', NULL, NULL, NULL, NULL),
(33, 16, 'sdfsdfsd', 'fsdfsdfsd', NULL, 'fsdfsd', 'fsdf', 'sdfsdf', 'sdfsdf'),
(14, 17, 'asdasdas', 'dasdasd', NULL, 'asdasd', 'dsadas', 'dasdasd', 'sadasd'),
(15, 18, 'asdasdas', 'dasdasd', NULL, 'asdasd', 'dsadas', 'dasdasd', 'sadasd'),
(16, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 29, 'asdadasd', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 31, NULL, 'asdasd', NULL, NULL, NULL, NULL, NULL),
(39, 34, 'asdasd', 'asdasd', 'asdasd', 'sad', 'sadasd', 'dsadsad', 'asdas'),
(38, 34, 'asdasd', 'sadasd', 'asdasd', 'asdasd', 'asdas', 'asdas', 'dsadas'),
(36, 35, 'asdasd', 'saddas', 'asdasd', '12', '12', '123', '122'),
(37, 35, '123', '123', '123', '123', '12', '123', '123');

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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prf_protocol_personnel`
--

INSERT INTO `prf_protocol_personnel` (`id`, `protocol_id`, `name`, `title`, `roles`, `qualification`, `training_vacc`) VALUES
(1, 8, 'ssdasd', NULL, NULL, 'sadasdasd', 'sadasdas'),
(2, 8, 'sdasdasd', NULL, 'asdasda', 'sdasdsa', NULL),
(3, 10, 'ssdasd', NULL, NULL, 'sadasdasd', 'sadasdas'),
(4, 10, 'sdasdasd', NULL, 'asdasda', 'sdasdsa', NULL),
(5, 11, 'ssdasd', NULL, NULL, 'sadasdasd', 'sadasdas'),
(6, 11, 'sdasdasd', NULL, 'asdasda', 'sdasdsa', NULL),
(7, 12, 'ssdasd', NULL, NULL, 'sadasdasd', 'sadasdas'),
(8, 12, 'sdasdasd', NULL, 'asdasda', 'sdasdsa', NULL),
(9, 13, 'ssdasd', NULL, NULL, 'sadasdasd', 'sadasdas'),
(10, 13, 'sdasdasd', NULL, 'asdasda', 'sdasdsa', NULL),
(11, 14, 'dsdsd', NULL, 'dsdsda', 'asdasd', 'asdasd'),
(12, 14, NULL, NULL, 'asdasd', 'dasdasd', NULL),
(31, 16, NULL, NULL, 'sadasd', 'sadasd', NULL),
(14, 17, 'dgdfgfd', NULL, 'dfgdfgfg', 'gfgf', 'gfgfg'),
(15, 18, 'dgdfgfd', NULL, 'dfgdfgfg', 'gfgf', 'gfgfg'),
(16, 23, NULL, NULL, NULL, NULL, NULL),
(17, 29, NULL, NULL, NULL, NULL, NULL),
(18, 30, NULL, NULL, NULL, NULL, NULL),
(19, 32, 'sadasdsad', NULL, NULL, NULL, NULL),
(32, 16, 'fsdfsdf', NULL, 'sdfsdf', 'sdfsdf', 'sdfsdf'),
(39, 34, NULL, NULL, 'asdasd', 'asdasd', 'asdasd'),
(38, 34, NULL, NULL, 'asdasd', 'asdasd', 'dasdasd'),
(37, 34, NULL, NULL, 'asd', 'asdasd', 'asdd'),
(36, 35, 'dsfsd', NULL, 'dsfsdfsdfsd sfsd', 'asdasd', 'aasdasd');

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
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prf_protocol_qualifications`
--

INSERT INTO `prf_protocol_qualifications` (`id`, `protocol_id`, `qualification_desc`) VALUES
(1, 9, 'asdasdas'),
(2, 9, 'dasdasd'),
(3, 9, 'asdasdasd'),
(4, 10, 'asdasdas'),
(5, 10, 'dasdasd'),
(6, 10, 'asdasdasd'),
(7, 10, NULL),
(8, 11, 'asdasdas'),
(9, 11, 'dasdasd'),
(10, 11, 'asdasdasd'),
(11, 11, NULL),
(12, 12, 'asdasdas'),
(13, 12, 'dasdasd'),
(14, 12, 'asdasdasd'),
(15, 12, NULL),
(16, 13, 'asdasdas'),
(17, 13, 'dasdasd'),
(18, 13, 'asdasdasd'),
(19, 13, NULL),
(20, 14, 'asdasdasd'),
(39, 16, 'asdasdasdasdasdasdsadasdasddsadasd'),
(38, 16, 'asdasdasdasdasdasdsadasdasddsadasd'),
(23, 18, 'asdasdasdasdasdasdsadasdasddsadasd'),
(48, 34, 'sadasd'),
(47, 34, 'dsadasd'),
(46, 34, 'sadasd'),
(43, 35, 'asdasd'),
(44, 35, 'asdasd'),
(45, 35, 'asdasd');

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
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prf_protocol_rs`
--

INSERT INTO `prf_protocol_rs` (`id`, `protocol_id`, `research_study`) VALUES
(1, 9, 'sadas'),
(2, 9, 'asdasd'),
(3, 9, 'asdasd'),
(4, 10, 'sadas'),
(5, 10, 'asdasd'),
(6, 10, 'asdasd'),
(7, 11, 'sadas'),
(8, 11, 'asdasd'),
(9, 11, 'asdasd'),
(10, 12, 'sadas'),
(11, 12, 'asdasd'),
(12, 12, 'asdasd'),
(13, 13, 'sadas'),
(14, 13, 'asdasd'),
(15, 13, 'asdasd'),
(16, 14, 'asdasd'),
(17, 15, 'asdasd'),
(18, 15, 'dsds'),
(19, 15, 'sadasdas'),
(37, 16, 'asdasdasdasdasdasd'),
(21, 17, 'asdasdasdasdasdasd'),
(22, 18, 'asdasdasdasdasdasd'),
(36, 16, 'asdasdasd'),
(50, 34, 'dasdasd'),
(40, 32, 'asdasd'),
(49, 34, 'dasdas'),
(48, 34, 'sadasd'),
(46, 35, 'asdasdasd'),
(47, 35, 'dsdsdsd');

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
(1, 'PRF', 2021, 'PRF-2021-025', 3, 25),
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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `protocol_status`
--

INSERT INTO `protocol_status` (`id`, `protocol_id`, `status`, `created_by`, `date_created`) VALUES
(1, 11, 1, 1, '2021-01-14 16:33:49'),
(2, 12, 1, 1, '2021-01-14 16:34:00'),
(3, 13, 1, 1, '2021-01-14 16:39:45'),
(4, 14, 1, 1, '2021-01-14 16:41:53'),
(5, 16, 2, 1, '2021-01-19 14:40:20'),
(6, 17, 1, 1, '2021-01-19 14:40:27'),
(7, 18, 1, 1, '2021-01-19 14:40:47'),
(8, 23, 1, 1, '2021-01-19 14:48:21'),
(9, 29, 1, 1, '2021-01-19 15:09:28'),
(10, 30, 1, 1, '2021-01-19 15:09:56'),
(11, 31, 1, 1, '2021-01-19 15:13:30'),
(12, 32, 1, 1, '2021-01-19 15:14:58'),
(13, 11, 3, 1, '2021-01-19 16:25:58'),
(14, 32, 2, 1, '2021-01-21 09:53:08'),
(15, 30, 6, 1, '2021-01-21 09:54:24'),
(16, 33, 1, 1, '2021-02-19 09:58:12'),
(17, 34, 1, 2, '2021-02-24 10:23:33'),
(18, 34, 2, 2, '2021-02-24 10:52:38'),
(19, 16, 3, 5, '2021-02-24 11:44:18'),
(20, 35, 1, 2, '2021-02-24 12:46:45'),
(21, 35, 2, 2, '2021-02-24 12:51:58'),
(22, 35, 3, 1, '2021-02-24 12:55:29'),
(23, 34, 6, 4, '2021-03-22 17:02:12');

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit_reviews`
--

INSERT INTO `unit_reviews` (`id`, `protocol_id`, `is_approval_unit`, `is_secretary`, `unit_id`, `protocol_comments`, `objectives_comments`, `duration_comments`, `investigator_comments`, `background_comments`, `animals_comments`, `basis_comments`, `quarantine_comments`, `cage_comments`, `numanimals_comments`, `identification_comments`, `cageclean_comments`, `living_comments`, `diet_comments`, `general_comments`, `location_comments`, `dosing_comments`, `collection_comments`, `examination_comments`, `anesthetics_comments`, `surgical_comments`, `humane_comments`, `hazards_comments`, `disposal_comments`, `alternative_comments`, `personnel_comments`, `references_comments`, `review_status`, `date_created`, `created_by`) VALUES
(9, 35, 1, 0, 2, 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdas', 'asdasd', 'asdasd', 'asdasd', 'sadasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'sadsad', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdsad', 'asdasd', 'RETURNED', '2021-02-24 12:54:35', 1),
(10, 34, 1, 0, 1, 'sfsfsdfdsf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Approve by Unit', '2021-02-26 05:26:05', 4),
(8, 30, 0, 1, 2, 'asdasd\r\nasdasd\r\nasdasd', 'dasdas', 'sadasd', 'sadasd', 'asdasd', 'asdasd', 'asdasd', 'sadasd', 'sadasd', 'sadasd', 'asdasd', 'asdasd', 'asdas', 'asdasd', 'asddasd', 'sadasd', 'asdasd', 'sadasd', 'asdasd', 'asdasdasd', 'asdasd', 'asdasd', 'sadasd', 'asdasd', 'asdasd', 'asdasd', NULL, 'SAVED', '2021-02-24 10:15:04', 5),
(7, 16, 1, 0, 2, 'asdasd\r\n\\\r\nasdasd', 'asdasd', 'asdasd \r\nasdasd\r\nasdasd', 'sdsdasdasd', 'fdfdfdf', 'asdasd', 'sadasd', 'asdasd', 'asdasd', 'sdadsa', 'sadsad', 'asdasd', 'asdasddsad\r\nsdadasd', 'sadasd', 'asdasd', 'sadasdsa', 'sadasd', 'asdasd', 'asdasdasd', 'sadasdasd', 'asdadsasd', 'sadasdasd', 'sadasd', 'sadasd', 'sadasdasd', 'dsfsdf', 'sdfsdfsdffsdfsdf', 'RETURNED', '2021-02-23 14:58:23', 1),
(6, 16, 1, 0, 2, 'asdasd', 'asdasd', 'asdasd \r\nasdasd\r\nasdasd', 'sdsdasdasd', 'fdfdfdf', 'asdasd', 'sadasd', 'asdasd', 'asdasd', 'sdadsa', 'sadsad', 'asdasd', 'asdasddsad\r\nsdadasd', 'sadasd', 'asdasd', 'sadasdsa', 'sadasd', 'asdasd', 'asdasdasd', 'sadasdasd', 'asdadsasd', 'sadasdasd', 'sadasd', 'sadasd', 'sadasdasd', 'dsfsdf', 'sdfsdfsdffsdfsdf', 'SAVED', '2021-02-23 14:41:08', 1),
(11, 34, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SAVED', '2021-03-24 15:17:56', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact_number`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'REGINALD MURILLO', 'reginaldnmurillo@gmail.com', '09955584519', '2020-11-16 16:00:00', '$2y$10$yTo36BpaJCHxBZPK1bDAsOVhdlwhG2xhoaYn60N3DsFYy8Fy450nS', NULL, '2020-11-16 16:00:00', '2020-11-16 16:00:00', 1),
(2, 'nonoy murillo', 'nonoymurillo@gmail.com', '09955584519', NULL, '$2y$10$2106q4qSTEBlOUkZFUgY8ufu55lzWdRn2RRnYrFXjDm2zTMluRIJm', NULL, NULL, NULL, 1),
(3, 'secretary', 'secretary@email.com', '213123123', NULL, '$2y$10$Iz1iEXEyWAZMd5dF2Gh77OAQco1mr3wGTJqceP6SwAC3Q4KE9MRi.', NULL, NULL, NULL, 1),
(4, 'ibrep', 'ibrep@email.com', '123213213', NULL, '$2y$10$f2Ufkq7tqsJGr8o13uDouORPdI8phi6sZQLORUQUg3nUvbfsd6yFS', NULL, NULL, NULL, 1),
(5, 'icrep', 'icrep@email.com', '13123111', NULL, '$2y$10$kFgzOIGneI7YUtR7wCtYZ.4315WPGPgzrYoUC/6lkws1IRRzD3P0e', NULL, NULL, NULL, 1),
(6, 'superadmin', 'superadmin@email.com', '12345678', NULL, '$2y$10$FK3a6.KV1Mnya3/95s14JuhRZpPcyul4MgHxVKyw6i/ZCCe7ZKDym', NULL, NULL, NULL, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `unit_id`) VALUES
(1, 1, 1, NULL),
(2, 1, 2, NULL),
(3, 1, 3, 2),
(4, 2, 2, NULL),
(5, 3, 4, NULL),
(11, 6, 1, NULL),
(7, 5, 3, 2),
(10, 4, 3, 1);

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_protocol_status`  AS  select `a`.`protocol_id` AS `protocol_id`,`d`.`description` AS `status`,`a`.`status_date` AS `status_date` from ((((select `c`.`protocol_id` AS `protocol_id`,`c`.`status` AS `status`,`c`.`date_created` AS `status_date` from `protocol_status` `c` where (`c`.`date_created` = (select max(`protocol_status`.`date_created`) from `protocol_status` where (`protocol_status`.`protocol_id` = `c`.`protocol_id`))))) `a` left join `prf_protocol` `b` on((`b`.`protocol_id` = `a`.`protocol_id`))) left join `ref_status` `d` on((`d`.`id` = `a`.`status`))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
