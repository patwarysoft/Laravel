-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2018 at 05:16 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_evening`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `al` ()  BEGIN
/* 0. All Category */
SELECT * FROM categories ORDER by name asc;

/* 0. All SubCategory */
SELECT * FROM subcategories ORDER by name asc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `category` (IN `ids` INT)  BEGIN
/* 0. All Category */
SELECT * FROM categories ORDER by name asc;

/* 0. All SubCategory */
SELECT * FROM subcategories ORDER by name asc;

SELECT p.id, p.title, p.price, p.discount, p.picture1, p.picture2, p.picture3, c.name cname, sc.name scname, 
		u.name uname
FROM products p, categories c, subcategories sc, units u
where p.Subcategory_id = sc.id and
sc.Category_id = c.id AND
p.Unti_id = u.id and
c.id = ids
order by p.id DESC
LIMIT 12
;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkout` ()  BEGIN
/* 0. All Category */
SELECT * FROM categories ORDER by name asc;

/* 0. All SubCategory */
SELECT * FROM subcategories ORDER by name asc;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `details` (IN `ids` INT)  BEGIN
/* 0. All Category */
SELECT * FROM categories ORDER by name asc;

/* 1. All SubCategory */
SELECT * FROM subcategories ORDER by name asc;

/* 2. Selected Product */
SELECT p.id, p.title, p.price, p.discount, p.picture1, p.picture2, p.picture3, c.name cname, sc.id scid, sc.name scname, u.name uname, 
c.id cid, sc.id scid
FROM products p, categories c, subcategories sc, units u
where p.Subcategory_id = sc.id and
sc.Category_id = c.id AND
p.Unti_id = u.id and
p.id = ids LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `home` ()  BEGIN
/* 0. All Category */
SELECT * FROM categories ORDER by name asc;

/* 0. All SubCategory */
SELECT * FROM subcategories ORDER by name asc;

SELECT p.id, p.title, p.price, p.discount, p.picture1, p.picture2, p.picture3, c.name cname, sc.name scname, 
		u.name uname
FROM products p, categories c, subcategories sc, units u
where p.Subcategory_id = sc.id and
sc.Category_id = c.id AND
p.Unti_id = u.id
order by p.id DESC
LIMIT 12;

 SELECT p.id, p.title, p.price, p.discount, p.picture1, p.picture2, p.picture3, c.name cname, sc.name scname, u.name uname, (SELECT sum(sales_details.quantity)
FROM sales_details where sales_details.product_id = p.id) total
FROM products p, categories c, subcategories sc, units u
where p.Subcategory_id = sc.id and
sc.Category_id = c.id AND
p.Unti_id = u.id
order by total DESC
LIMIT 12;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `atiks`
--

CREATE TABLE `atiks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adderess` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Frozen', NULL, NULL),
(3, 'saree', NULL, NULL),
(4, 'cloth', NULL, NULL),
(5, 'kurti', NULL, NULL),
(6, 'punjabi', NULL, NULL),
(7, 'cotton', NULL, NULL),
(8, 'electronics', NULL, NULL),
(9, 'bag', NULL, NULL),
(10, 'toy', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'No City Selected', 1, NULL, NULL),
(4, 'Dhaka', 1, NULL, NULL),
(5, 'Khulna', 1, NULL, NULL),
(6, 'New York', 2, NULL, NULL),
(7, 'Rajshahi', 1, NULL, NULL),
(8, 'DC', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Bangladesh', NULL, NULL),
(2, 'USA', NULL, NULL);

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
(59, '2018_07_04_085215_create_countries_table', 1),
(60, '2018_07_04_085454_create_cities_table', 1),
(61, '2018_07_04_085518_create_categories_table', 1),
(62, '2018_07_04_085545_create_subcategories_table', 1),
(63, '2018_07_04_085608_create_units_table', 1),
(64, '2018_07_04_085633_create_products_table', 1),
(65, '2018_07_04_085653_create_users_table', 1),
(66, '2018_07_04_085722_create_shippings_table', 1),
(67, '2018_07_04_085742_create_sales_table', 1),
(68, '2018_07_04_091428_create_sales_details_table', 1),
(69, '2018_07_04_091505_create_reviews_table', 1),
(70, '2018_07_04_091533_create_sales_reviews_table', 1),
(71, '2018_07_05_133657_create_atiks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `stock` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Unti_id` tinyint(3) UNSIGNED NOT NULL,
  `Subcategory_id` tinyint(3) UNSIGNED NOT NULL,
  `picture1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture3` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `stock`, `discount`, `Unti_id`, `Subcategory_id`, `picture1`, `picture2`, `picture3`, `created_at`, `updated_at`) VALUES
(33, 'Silver Stainless Steel Analog Watch (Men)', 3000.00, '10', '1', 1, 1, 'jpg', '', '', NULL, NULL),
(34, 'Mi V2 - Power Bank - 10000mAh- Silver', 5000.00, '10', '1', 1, 1, 'jpg', '', '', NULL, NULL),
(35, 'Tan Synthetic Moccasin Shoe (Women)', 2000.00, '15', '2', 1, 1, 'jpg', '', '', NULL, NULL),
(36, 'Wow Box Real Time GPS Vehicle Tracker', 10000.00, '5', '0', 1, 1, 'jpg', '', '', NULL, NULL),
(37, 'Sky Blue Synthetic Top (Women)', 2500.00, '20', '1', 1, 1, 'jpg', '', '', NULL, NULL),
(38, 'New Top Ten Sienna Artificial Leather Hand Bag', 3000.00, '5', '1', 1, 1, 'jpg', '', '', NULL, NULL),
(39, 'Golden Anti-Reflective Sunglasses for Women', 1000.00, '5', '1', 1, 1, 'jpg', '', '', NULL, NULL),
(40, 'Arrow Roberto Multicolor Polyester Tie', 700.00, '15', '1', 1, 1, 'jpg', '', '', NULL, NULL),
(41, 'Colors & Shades Multi Color Cotton Scarf', 500.00, '30', '0', 1, 1, 'jpg', '', '', NULL, NULL),
(42, 'Blue Cotton Formal Shirt For Men', 1000.00, '5', '0', 1, 1, 'jpg', '', '', NULL, NULL),
(43, 'FERDOUS GIFT & FASHION Baby Red Party Dress', 4000.00, '10', '1', 1, 1, 'jpg', '', '', NULL, NULL),
(44, 'Black Cotton Long Sleeve Casual Jacket (Men)', 2500.00, '15', '2', 1, 1, 'jpg', '', '', NULL, NULL),
(45, 'OMA 5920CA Motorized Treadmill - 4.0 Black and Red', 100000.00, '2', '0', 1, 1, 'jpg', '', '', NULL, NULL),
(46, 'Cotton Short Sleeve T-shirt for Girls', 500.00, '10', '0', 1, 1, 'jpg', '', '', NULL, NULL),
(47, 'Brown Leather Wallet For Men', 1500.00, '2', '0', 1, 1, 'jpg', '', '', NULL, NULL),
(48, 'Pink PU Leather Shoe For Baby', 2000.00, '12', '1', 1, 1, 'jpg', '', '', NULL, NULL),
(49, 'Golden gold Plated Jewelry Set For Women', 5000.00, '2', '1', 1, 1, 'jpg', '', '', NULL, NULL),
(50, 'Keyless Finger Print Door Glass Lock - Black', 20000.00, '10', '2', 1, 1, 'jpg', '', '', NULL, NULL),
(51, 'Cotton Kraft Purple Cotton Punjabi for Men', 2000.00, '25', '2', 1, 1, 'jpg', '', '', NULL, NULL),
(52, 'Red Color Georgette Saree For Women', 10000.00, '10', '0', 1, 1, 'jpg', '', '', NULL, NULL),
(53, 'Blue and White Synthetic Casual Shoe for Boys', 1500.00, '10', '1', 1, 1, 'jpg', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `shipping_id` tinyint(4) DEFAULT NULL,
  `date` datetime NOT NULL,
  `token` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `created_at`, `updated_at`, `status`, `shipping_id`, `date`, `token`) VALUES
(1, NULL, NULL, 1, 2, '2018-07-05 00:00:00', '15318375098420'),
(2, NULL, NULL, 1, 4, '2018-07-06 07:27:29', '15318388699026'),
(3, NULL, NULL, 1, 5, '2018-07-07 05:13:22', '15318390976346'),
(4, NULL, NULL, 1, 6, '2018-07-15 00:00:00', '15318393506863'),
(5, NULL, NULL, 1, 7, '2018-07-18 00:00:00', '15318393883328'),
(6, NULL, NULL, 1, 6, '2018-07-18 00:00:00', '15319261111482'),
(7, NULL, NULL, 1, 5, '2018-07-19 21:00:10', '15320124109794');

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sale_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(100) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `discount` float(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`id`, `created_at`, `updated_at`, `sale_id`, `product_id`, `quantity`, `price`, `discount`) VALUES
(1, NULL, NULL, 1, 52, 1, 10000.00, 0.00),
(2, NULL, NULL, 1, 51, 5, 2000.00, 2.00),
(3, NULL, NULL, 2, 52, 1, 10000.00, 0.00),
(4, NULL, NULL, 2, 51, 5, 2000.00, 2.00),
(5, NULL, NULL, 3, 52, 1, 10000.00, 0.00),
(6, NULL, NULL, 3, 51, 5, 2000.00, 2.00),
(7, NULL, NULL, 4, 52, 1, 10000.00, 0.00),
(8, NULL, NULL, 4, 51, 5, 2000.00, 2.00),
(9, NULL, NULL, 5, 52, 1, 10000.00, 0.00),
(10, NULL, NULL, 5, 51, 5, 2000.00, 2.00),
(11, NULL, NULL, 6, 51, 3, 2000.00, 2.00),
(12, NULL, NULL, 7, 46, 4, 500.00, 0.00),
(13, NULL, NULL, 7, 47, 8, 1500.00, 0.00),
(14, NULL, NULL, 7, 48, 12, 2000.00, 1.00),
(15, NULL, NULL, 7, 49, 4, 5000.00, 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales_reviews`
--

CREATE TABLE `sales_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `fullname`, `address`, `contact`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Hasan', 'Kallyanpur, Dhaka', '01674086310', 11, NULL, NULL),
(4, 'Hasan', 'Kallyanpur, Dhaka', '01674086310', 11, NULL, NULL),
(5, 'Hasan', 'fasf s', '01674086310', 2, NULL, NULL),
(6, 'Hasan', 'f asf saf', '01674086310', 11, NULL, NULL),
(7, 'Hasan', 'f asf saf', '01674086310', 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Category_id` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `Category_id`, `created_at`, `updated_at`) VALUES
(1, 'Fish', 1, NULL, NULL),
(2, 'saree', 3, NULL, NULL),
(4, 'cloth', 4, NULL, NULL),
(5, 'punjabi', 6, NULL, NULL),
(6, 'electronics', 8, NULL, NULL),
(7, 'toy', 10, NULL, NULL),
(8, 'bag', 9, NULL, NULL),
(9, 'kurti', 5, NULL, NULL),
(10, 'cotton_normal', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'KG', '2018-07-10 10:35:50', '2018-07-10 10:35:50'),
(2, 'inch', '2018-07-10 10:58:22', '2018-07-10 10:58:22'),
(3, 'meter', '2018-07-10 10:58:22', '2018-07-10 10:58:22'),
(4, 'gm', '2018-07-10 11:18:21', '2018-07-10 11:18:21'),
(5, 'mm', '2018-07-10 11:18:21', '2018-07-10 11:18:21'),
(6, 'mg', '2018-07-10 11:19:12', '2018-07-10 11:19:12'),
(7, 'TG', '2018-07-10 11:20:00', '2018-07-10 11:20:00'),
(8, 'nm', '2018-07-10 11:20:40', '2018-07-10 11:20:40'),
(9, 'ninch', '2018-07-10 11:21:04', '2018-07-10 11:21:04'),
(10, 'mega', '2018-07-10 11:21:55', '2018-07-10 11:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `gender` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` tinyint(3) UNSIGNED NOT NULL,
  `status` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `address`, `type`, `gender`, `contact`, `age`, `city_id`, `status`, `provider`, `picture`, `created_at`, `updated_at`) VALUES
(2, 'Atik Patwary', 'atik@gmail.com', '$2y$10$BV78Nx7pxTgkf8Jh5HS3IuRyTh/BbcSOBOH36OMoleXf38EJLhEKi', 'Ye5I0ICjxx8aUrdeiAcqoJrwSk0cvtg0uuJMNIpX2BqlzlINeMMyZBBXxGOf', 'Dhaka', '3', NULL, NULL, NULL, 4, NULL, NULL, NULL, '2018-07-05 08:59:21', '2018-07-05 08:59:21'),
(3, 'ss', 's@gmail.com', '$2y$10$GM0YcpblhrtuP9NGbDtudOA1tFP9uUmM96uvMBAdp9jHNbGTfc74m', 'J4ggc5FIcxsXb3CSMwxCWULQ30vHU1B1WdlxtnVQraMN5AP7xhSoHTQzNjcZ', 'kcccf', '2', NULL, NULL, NULL, 5, '264467', NULL, NULL, '2018-07-09 09:29:49', '2018-07-09 09:29:49'),
(4, 'admin', 'a@gmail.com', '$2y$10$KNm7n6BI4GMx3Ky9rZBCJeWEQBFfkKy9G.Lcyoaz1uDChHoG82dLG', 'IKMeljBPCA25LgnNxV5Vo6e3Z50YoYMx55seKyRsjhjo5ACw4Vs3sok1ENKu', 'jkjc', '3', NULL, NULL, NULL, 4, '724159', NULL, NULL, '2018-07-11 02:43:13', '2018-07-11 02:43:13'),
(5, 'z', 'z@gmail.com', '$2y$10$XyljD8SyPkb4mtVy1UfqVuTW.gQMYlgGkU8l3HwCFCoD60tzfWe3y', 'LVSMMVJB837Lak5JH9028npHxKCsXycKHl3LKgZp69bIKDjBeUm5pVqiuEBF', 'cc', '3', NULL, NULL, NULL, 8, '502330', NULL, NULL, '2018-07-11 03:37:21', '2018-07-11 03:37:21'),
(6, 'Anis', 'anis@anis.com', '$2y$10$lZ0pxIy6KRXqMlWsF30ya.Ifw.9Orow2HTBsNf7UO5SnPBm/dwQGi', NULL, 'anis mirpur', '1', NULL, NULL, NULL, 5, '951810', NULL, NULL, '2018-07-14 07:24:24', '2018-07-14 07:24:24'),
(11, 'Sk Abul Hasan', 'hasancse016@gmail.com', NULL, 'dayQsTaafqE6N9bPzD4P9kgwJO0IW5H6CBUMDCFhofu8p2TGAZQdstjZc1qM', NULL, '1', NULL, NULL, NULL, 1, NULL, '10212384165497245', NULL, '2018-07-17 07:42:00', '2018-07-17 07:50:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atiks`
--
ALTER TABLE `atiks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `atiks_name_unique` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_unti_id_foreign` (`Unti_id`),
  ADD KEY `products_subcategory_id_foreign` (`Subcategory_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_reviews`
--
ALTER TABLE `sales_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_user_id_foreign` (`user_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategories_name_unique` (`name`),
  ADD KEY `subcategories_category_id_foreign` (`Category_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_city_id_foreign` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atiks`
--
ALTER TABLE `atiks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sales_reviews`
--
ALTER TABLE `sales_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`Subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_unti_id_foreign` FOREIGN KEY (`Unti_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`Category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
