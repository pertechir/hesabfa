-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2025 at 11:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `hesabfa`
--

-- --------------------------------------------------------

--
-- Table structure for table `ashkhas`
--

CREATE TABLE `ashkhas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_hesabdari` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `family` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--
ALTER TABLE categories ADD COLUMN image VARCHAR(255);

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forosh`
--

CREATE TABLE `forosh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ashkhas_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `ashkhas_id` (`ashkhas_id`),
  CONSTRAINT `forosh_ibfk_1` FOREIGN KEY (`ashkhas_id`) REFERENCES `ashkhas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_forosh`
--

CREATE TABLE `item_forosh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forosh_id` int(11) NOT NULL,
  `kala_id` int(11) DEFAULT NULL,
  `khadamat_id` int(11) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `forosh_id` (`forosh_id`),
  KEY `kala_id` (`kala_id`),
  KEY `khadamat_id` (`khadamat_id`),
  CONSTRAINT `item_forosh_ibfk_1` FOREIGN KEY (`forosh_id`) REFERENCES `forosh` (`id`) ON DELETE CASCADE,
  CONSTRAINT `item_forosh_ibfk_2` FOREIGN KEY (`kala_id`) REFERENCES `kala` (`id`) ON DELETE SET NULL,
  CONSTRAINT `item_forosh_ibfk_3` FOREIGN KEY (`khadamat_id`) REFERENCES `khadamat` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Table structure for table `kala`
--

CREATE TABLE `kala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khadamat`
--

CREATE TABLE `khadamat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_hesabdari` varchar(20) NOT NULL UNIQUE,
  `company` varchar(100) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `family` varchar(50) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `type_customer` tinyint(1) DEFAULT 0,
  `type_supplier` tinyint(1) DEFAULT 0,
  `type_shareholder` tinyint(1) DEFAULT 0,
  `type_employee` tinyint(1) DEFAULT 0,
  `credit` decimal(20,2) DEFAULT 0.00,
  `price_list` varchar(50) DEFAULT NULL,
  `tax_type` varchar(50) DEFAULT NULL,
  `tax_registration` varchar(50) DEFAULT NULL,
  `shenase_meli` varchar(20) DEFAULT NULL,
  `code_eghtesadi` varchar(20) DEFAULT NULL,
  `shomare_sabt` varchar(20) DEFAULT NULL,
  `code_shobe` varchar(20) DEFAULT NULL,
  `tozihat` text DEFAULT NULL,
  `address_text` text DEFAULT NULL,
  `country` varchar(50) DEFAULT 'ایران',
  `ostan` varchar(50) DEFAULT NULL,
  `shahr` varchar(50) DEFAULT NULL,
  `codeposti` varchar(10) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `telephone1` varchar(20) DEFAULT NULL,
  `telephone2` varchar(20) DEFAULT NULL,
  `telephone3` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `marriage_date` date DEFAULT NULL,
  `membership_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `persons`
--
ALTER TABLE categories ADD COLUMN image VARCHAR(255);

INSERT INTO `persons` (`id`, `code_hesabdari`, `company`, `title`, `name`, `family`, `nickname`, `category`, `type_customer`, `type_supplier`, `type_shareholder`, `type_employee`, `credit`, `price_list`, `tax_type`, `tax_registration`, `shenase_meli`, `code_eghtesadi`, `shomare_sabt`, `code_shobe`, `tozihat`, `address_text`, `country`, `ostan`, `shahr`, `codeposti`, `telephone`, `mobile`, `fax`, `telephone1`, `telephone2`, `telephone3`, `email`, `website`, `birth_date`, `marriage_date`, `membership_date`, `created_at`, `updated_at`) VALUES
(1, '297958', 'سیب', 'سیب', 'سیب', 'سیب', 'سیب', '1', 1, 0, 0, 0, 61465.00, '656', '', '', '', '6546', '', '', 'یسبلیبل', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '2025-03-09 09:36:10', '2025-03-09 09:36:10');

COMMIT;