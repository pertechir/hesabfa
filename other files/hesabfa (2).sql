-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 01:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hesabfa`
--

-- --------------------------------------------------------

--
-- Table structure for table `ashkhas`
--

CREATE TABLE `ashkhas` (
  `id` int(11) NOT NULL,
  `code_hesabdari` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `family` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `code`, `description`, `status`, `created_at`, `updated_at`, `image`) VALUES
(1, 2, 'کامپیوتر', 'C0001', 'سبی', 1, '2025-03-09 18:13:11', '2025-03-09 21:07:43', ''),
(2, NULL, 'موس', 'C0002', 'سیب', 1, '2025-03-09 19:52:50', '2025-03-09 19:52:50', ''),
(3, NULL, 'موس تسکو 1', 'C0003', 'سیر', 1, '2025-03-09 20:41:03', '2025-03-09 20:41:26', 'uploads/categories/67cdfcdf1cb17.png'),
(4, NULL, '1', '', '', 1, '2025-03-10 15:27:46', '2025-03-10 15:27:46', ''),
(5, NULL, '1', '', '', 1, '2025-03-10 15:27:51', '2025-03-10 15:27:51', ''),
(6, NULL, 'موس', '', '', 1, '2025-03-10 15:29:33', '2025-03-10 15:29:33', ''),
(7, NULL, 'ش', '', '', 1, '2025-03-10 15:37:34', '2025-03-10 15:37:34', ''),
(10, NULL, 'کیبورد', 'C0010', 'کیبوردهای مختلف', 1, '2025-03-10 15:44:34', '2025-03-10 15:44:34', NULL),
(11, NULL, 'ماوس', 'C0011', 'ماوس‌های مختلف', 1, '2025-03-10 15:46:34', '2025-03-10 15:46:34', NULL),
(12, NULL, 'پرینتر', 'C0012', 'پرینترهای مختلف', 1, '2025-03-10 15:48:34', '2025-03-10 15:48:34', NULL),
(13, NULL, 'اسکنر', 'C0013', 'اسکنرهای مختلف', 1, '2025-03-10 15:50:34', '2025-03-10 15:50:34', NULL),
(14, NULL, 'هارد دیسک', 'C0014', 'هارد دیسک‌های مختلف', 1, '2025-03-10 15:52:34', '2025-03-10 15:52:34', NULL),
(15, NULL, 'SSD', 'C0015', 'حافظه‌های SSD', 1, '2025-03-10 15:54:34', '2025-03-10 15:54:34', NULL),
(16, NULL, 'رم', 'C0016', 'حافظه‌های رم', 1, '2025-03-10 15:56:34', '2025-03-10 15:56:34', NULL),
(17, NULL, 'مادربرد', 'C0017', 'مادربردهای مختلف', 1, '2025-03-10 15:58:34', '2025-03-10 15:58:34', NULL),
(18, NULL, 'پردازنده', 'C0018', 'پردازنده‌های مختلف', 1, '2025-03-10 16:00:34', '2025-03-10 16:00:34', NULL),
(19, NULL, 'کارت گرافیک', 'C0019', 'کارت گرافیک‌های مختلف', 1, '2025-03-10 16:02:34', '2025-03-10 16:02:34', NULL),
(20, NULL, 'کابل', 'C0020', 'کابل‌های مختلف', 1, '2025-03-10 16:04:34', '2025-03-10 16:04:34', NULL),
(21, NULL, 'کیس کامپیوتر', 'C0021', 'کیس‌های کامپیوتر', 1, '2025-03-10 16:06:34', '2025-03-10 16:06:34', NULL),
(22, NULL, 'پاور کامپیوتر', 'C0022', 'پاورهای کامپیوتر', 1, '2025-03-10 16:08:34', '2025-03-10 16:08:34', NULL),
(23, NULL, 'هدفون', 'C0023', 'هدفون‌های مختلف', 1, '2025-03-10 16:10:34', '2025-03-10 16:10:34', NULL),
(24, NULL, 'هندزفری', 'C0024', 'هندزفری‌های مختلف', 1, '2025-03-10 16:12:34', '2025-03-10 16:12:34', NULL),
(25, NULL, 'اسپیکر', 'C0025', 'اسپیکرهای مختلف', 1, '2025-03-10 16:14:34', '2025-03-10 16:14:34', NULL),
(26, NULL, 'ساندبار', 'C0026', 'ساندبارهای مختلف', 1, '2025-03-10 16:16:34', '2025-03-10 16:16:34', NULL),
(27, NULL, 'وب‌کم', 'C0027', 'وب‌کم‌های مختلف', 1, '2025-03-10 16:18:34', '2025-03-10 16:18:34', NULL),
(28, NULL, 'مودم', 'C0028', 'مودم‌های مختلف', 1, '2025-03-10 16:20:34', '2025-03-10 16:20:34', NULL),
(29, NULL, 'روتر', 'C0029', 'روترهای مختلف', 1, '2025-03-10 16:22:34', '2025-03-10 16:22:34', NULL),
(30, NULL, 'سوئیچ شبکه', 'C0030', 'سوئیچ‌های شبکه', 1, '2025-03-10 16:24:34', '2025-03-10 16:24:34', NULL),
(31, NULL, 'اکسس پوینت', 'C0031', 'اکسس پوینت‌های مختلف', 1, '2025-03-10 16:26:34', '2025-03-10 16:26:34', NULL),
(32, NULL, 'هارد اکسترنال', 'C0032', 'هاردهای اکسترنال', 1, '2025-03-10 16:28:34', '2025-03-10 16:28:34', NULL),
(33, NULL, 'فلش مموری', 'C0033', 'فلش مموری‌های مختلف', 1, '2025-03-10 16:30:34', '2025-03-10 16:30:34', NULL),
(34, NULL, 'کارت حافظه', 'C0034', 'کارت حافظه‌های مختلف', 1, '2025-03-10 16:32:34', '2025-03-10 16:32:34', NULL),
(35, NULL, 'دوربین دیجیتال', 'C0035', 'دوربین‌های دیجیتال', 1, '2025-03-10 16:34:34', '2025-03-10 16:34:34', NULL),
(36, NULL, 'دوربین امنیتی', 'C0036', 'دوربین‌های امنیتی', 1, '2025-03-10 16:36:34', '2025-03-10 16:36:34', NULL),
(37, NULL, 'گجت پوشیدنی', 'C0037', 'گجت‌های پوشیدنی', 1, '2025-03-10 16:38:34', '2025-03-10 16:38:34', NULL),
(38, NULL, 'ساعت هوشمند', 'C0038', 'ساعت‌های هوشمند', 1, '2025-03-10 16:40:34', '2025-03-10 16:40:34', NULL),
(39, NULL, 'دستبند هوشمند', 'C0039', 'دستبندهای هوشمند', 1, '2025-03-10 16:42:34', '2025-03-10 16:42:34', NULL),
(40, NULL, 'پاور بانک', 'C0040', 'پاور بانک‌های مختلف', 1, '2025-03-10 16:44:34', '2025-03-10 16:44:34', NULL),
(41, NULL, 'شارژر', 'C0041', 'شارژرهای مختلف', 1, '2025-03-10 16:46:34', '2025-03-10 16:46:34', NULL),
(42, NULL, 'کیف موبایل', 'C0042', 'کیف‌های موبایل', 1, '2025-03-10 16:48:34', '2025-03-10 16:48:34', NULL),
(43, NULL, 'کاور موبایل', 'C0043', 'کاورهای موبایل', 1, '2025-03-10 16:50:34', '2025-03-10 16:50:34', NULL),
(44, NULL, 'محافظ صفحه نمایش', 'C0044', 'محافظ صفحه نمایش‌های مختلف', 1, '2025-03-10 16:52:34', '2025-03-10 16:52:34', NULL),
(45, NULL, 'پایه نگهدارنده موبایل', 'C0045', 'پایه نگهدارنده‌های مختلف', 1, '2025-03-10 16:54:34', '2025-03-10 16:54:34', NULL),
(46, NULL, 'کنترلر بازی', 'C0046', 'کنترلرهای بازی مختلف', 1, '2025-03-10 16:56:34', '2025-03-10 16:56:34', NULL),
(47, NULL, 'کنسول بازی', 'C0047', 'کنسول‌های بازی', 1, '2025-03-10 16:58:34', '2025-03-10 16:58:34', NULL),
(48, NULL, 'دسته بازی', 'C0048', 'دسته‌های بازی مختلف', 1, '2025-03-10 17:00:34', '2025-03-10 17:00:34', NULL),
(49, NULL, 'تجهیزات شبکه', 'C0049', 'تجهیزات شبکه مختلف', 1, '2025-03-10 17:02:34', '2025-03-10 17:02:34', NULL),
(50, NULL, 'لپ‌تاپ گیمینگ', 'C0050', 'لپ‌تاپ‌های گیمینگ', 1, '2025-03-10 17:04:34', '2025-03-10 17:04:34', NULL),
(51, NULL, 'لپ‌تاپ اداری', 'C0051', 'لپ‌تاپ‌های اداری', 1, '2025-03-10 17:06:34', '2025-03-10 17:06:34', NULL),
(52, NULL, 'لپ‌تاپ دانشجویی', 'C0052', 'لپ‌تاپ‌های دانشجویی', 1, '2025-03-10 17:08:34', '2025-03-10 17:08:34', NULL),
(53, NULL, 'تبلت اندروید', 'C0053', 'تبلت‌های اندرویدی', 1, '2025-03-10 17:10:34', '2025-03-10 17:10:34', NULL),
(54, NULL, 'تبلت iOS', 'C0054', 'تبلت‌های iOS', 1, '2025-03-10 17:12:34', '2025-03-10 17:12:34', NULL),
(55, NULL, 'گوشی اندروید', 'C0055', 'گوشی‌های اندرویدی', 1, '2025-03-10 17:14:34', '2025-03-10 17:14:34', NULL),
(56, NULL, 'گوشی iOS', 'C0056', 'گوشی‌های iOS', 1, '2025-03-10 17:16:34', '2025-03-10 17:16:34', NULL),
(57, NULL, 'لپ‌تاپ اپل', 'C0057', 'لپ‌تاپ‌های اپل', 1, '2025-03-10 17:18:34', '2025-03-10 17:18:34', NULL),
(58, NULL, 'موبایل اپل', 'C0058', 'موبایل‌های اپل', 1, '2025-03-10 17:20:34', '2025-03-10 17:20:34', NULL),
(59, NULL, 'نرم‌افزار کامپیوتر', 'C0059', 'نرم‌افزارهای کامپیوتری', 1, '2025-03-10 17:22:34', '2025-03-10 17:22:34', NULL),
(60, NULL, 'نرم‌افزار موبایل', 'C0060', 'نرم‌افزارهای موبایل', 1, '2025-03-10 17:24:34', '2025-03-10 17:24:34', NULL),
(61, NULL, 'نرم‌افزار گرافیکی', 'C0061', 'نرم‌افزارهای گرافیکی', 1, '2025-03-10 17:26:34', '2025-03-10 17:26:34', NULL),
(62, NULL, 'نرم‌افزار اداری', 'C0062', 'نرم‌افزارهای اداری', 1, '2025-03-10 17:28:34', '2025-03-10 17:28:34', NULL),
(63, NULL, 'نرم‌افزار آموزشی', 'C0063', 'نرم‌افزارهای آموزشی', 1, '2025-03-10 17:30:34', '2025-03-10 17:30:34', NULL),
(64, NULL, 'نرم‌افزار امنیتی', 'C0064', 'نرم‌افزارهای امنیتی', 1, '2025-03-10 17:32:34', '2025-03-10 17:32:34', NULL),
(65, NULL, 'سرویس‌های ابری', 'C0065', 'سرویس‌های ابری مختلف', 1, '2025-03-10 17:34:34', '2025-03-10 17:34:34', NULL),
(66, NULL, 'سرور', 'C0066', 'سرورهای مختلف', 1, '2025-03-10 17:36:34', '2025-03-10 17:36:34', NULL),
(67, NULL, 'ذخیره‌سازی ابری', 'C0067', 'سرویس‌های ذخیره‌سازی ابری', 1, '2025-03-10 17:38:34', '2025-03-10 17:38:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forosh`
--

CREATE TABLE `forosh` (
  `id` int(11) NOT NULL,
  `ashkhas_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_forosh`
--

CREATE TABLE `item_forosh` (
  `id` int(11) NOT NULL,
  `forosh_id` int(11) NOT NULL,
  `kala_id` int(11) DEFAULT NULL,
  `khadamat_id` int(11) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kala`
--

CREATE TABLE `kala` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khadamat`
--

CREATE TABLE `khadamat` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `id` int(11) NOT NULL,
  `code_hesabdari` varchar(20) NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`id`, `code_hesabdari`, `company`, `title`, `name`, `family`, `nickname`, `category`, `type_customer`, `type_supplier`, `type_shareholder`, `type_employee`, `credit`, `price_list`, `tax_type`, `tax_registration`, `shenase_meli`, `code_eghtesadi`, `shomare_sabt`, `code_shobe`, `tozihat`, `address_text`, `country`, `ostan`, `shahr`, `codeposti`, `telephone`, `mobile`, `fax`, `telephone1`, `telephone2`, `telephone3`, `email`, `website`, `birth_date`, `marriage_date`, `membership_date`, `created_at`, `updated_at`) VALUES
(1, '297958', 'سیب', 'سیب', 'سیب', 'سیب', 'سیب', '1', 1, 0, 0, 0, 61465.00, '656', '', '', '', '6546', '', '', 'یسبلیبل', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '2025-03-09 06:06:10', '2025-03-09 06:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `person_categories`
--

CREATE TABLE `person_categories` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `main_unit` varchar(255) NOT NULL,
  `sub_unit` varchar(255) DEFAULT NULL,
  `conversion_factor` decimal(8,4) DEFAULT 1.0000,
  `category` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `inventory_control` varchar(255) DEFAULT NULL,
  `reorder_point` int(11) DEFAULT NULL,
  `lead_time` int(11) DEFAULT NULL,
  `max_inventory` int(11) DEFAULT NULL,
  `min_inventory` int(11) DEFAULT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `purchase_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `main_unit`, `sub_unit`, `conversion_factor`, `category`, `type`, `product_code`, `barcode`, `inventory_control`, `reorder_point`, `lead_time`, `max_inventory`, `min_inventory`, `sale_price`, `purchase_price`) VALUES
(1, 'محصول 1', 10000.00, '', 'number', '', 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'محصول 2', 20000.00, '', 'number', '', 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'محصول 3', 30000.00, '', 'number', '', 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'محصول 4', 40000.00, 'سیبس', 'number', '', 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'محصول 5', 50000.00, '', 'number', '', 1.0000, '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '', 0.00, 'سیبسی', 'number', '', 1.0000, '31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ashkhas`
--
ALTER TABLE `ashkhas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `forosh`
--
ALTER TABLE `forosh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ashkhas_id` (`ashkhas_id`);

--
-- Indexes for table `item_forosh`
--
ALTER TABLE `item_forosh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forosh_id` (`forosh_id`),
  ADD KEY `kala_id` (`kala_id`),
  ADD KEY `khadamat_id` (`khadamat_id`);

--
-- Indexes for table `kala`
--
ALTER TABLE `kala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khadamat`
--
ALTER TABLE `khadamat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_hesabdari` (`code_hesabdari`);

--
-- Indexes for table `person_categories`
--
ALTER TABLE `person_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ashkhas`
--
ALTER TABLE `ashkhas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `forosh`
--
ALTER TABLE `forosh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_forosh`
--
ALTER TABLE `item_forosh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kala`
--
ALTER TABLE `kala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khadamat`
--
ALTER TABLE `khadamat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `person_categories`
--
ALTER TABLE `person_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forosh`
--
ALTER TABLE `forosh`
  ADD CONSTRAINT `forosh_ibfk_1` FOREIGN KEY (`ashkhas_id`) REFERENCES `ashkhas` (`id`);

--
-- Constraints for table `item_forosh`
--
ALTER TABLE `item_forosh`
  ADD CONSTRAINT `item_forosh_ibfk_1` FOREIGN KEY (`forosh_id`) REFERENCES `forosh` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_forosh_ibfk_2` FOREIGN KEY (`kala_id`) REFERENCES `kala` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `item_forosh_ibfk_3` FOREIGN KEY (`khadamat_id`) REFERENCES `khadamat` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `person_categories`
--
ALTER TABLE `person_categories`
  ADD CONSTRAINT `person_categories_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`),
  ADD CONSTRAINT `person_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
