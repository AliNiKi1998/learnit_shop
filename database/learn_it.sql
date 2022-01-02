-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2021 at 10:23 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learn_it`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) NOT NULL,
  `author_name` varchar(191) NOT NULL,
  `author_last_name` varchar(191) NOT NULL,
  `title` varchar(191) NOT NULL,
  `body` text NOT NULL,
  `tags` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `blog_id` bigint(20) NOT NULL,
  `comment` text NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `approved` tinyint(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `payment_code` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `parent_id` bigint(20) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'برنامه نویسی وب', 0, '2021-05-21 04:28:10', '2021-05-21 11:12:58', NULL),
(2, 'php', 1, '2021-05-21 05:02:37', '2021-05-21 11:12:19', NULL),
(3, 'طراحی وب', 0, '2021-05-21 07:56:01', NULL, NULL),
(4, 'برنامه نویسی موبایل', 0, '2021-05-21 07:56:37', NULL, NULL),
(5, 'asp', 1, '2021-05-21 07:56:48', '2021-05-21 11:24:48', NULL),
(6, 'js', 1, '2021-05-21 10:53:35', '2021-05-21 11:12:31', NULL),
(7, 'html', 3, '2021-05-21 11:25:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `comment` text NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `status` tinyint(5) NOT NULL DEFAULT 0,
  `approved` tinyint(5) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `time` bigint(20) DEFAULT 0,
  `image` varchar(191) NOT NULL,
  `students` bigint(20) DEFAULT NULL,
  `description` text NOT NULL,
  `price` bigint(20) NOT NULL,
  `tags` varchar(225) NOT NULL,
  `cat_id` bigint(20) NOT NULL,
  `professor_id` bigint(20) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `time`, `image`, `students`, `description`, `price`, `tags`, `cat_id`, `professor_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'آموزش برنامه نویسی php', 18, 'a:2:{s:5:\"small\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_14_28_38_71.jpg\";s:3:\"big\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_14_28_38_34.jpg\";}', 20, '&lt;p&gt;pgpfpgf&lt;/p&gt;\r\n\r\n&lt;p&gt;adgfgsdg&lt;/p&gt;\r\n\r\n&lt;p&gt;S&lt;br /&gt;\r\nDGF&lt;/p&gt;\r\n\r\n&lt;p&gt;s&lt;br /&gt;\r\nHSF&lt;br /&gt;\r\nRWh&lt;/p&gt;\r\n\r\n&lt;p&gt;S&lt;br /&gt;\r\nFh&lt;/p&gt;\r\n\r\n&lt;p&gt;wrh&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;SH&lt;br /&gt;\r\nSH&lt;/p&gt;\r\n', 20000, 'php web', 2, 1, '0', '2021-05-21 09:06:27', '2021-06-05 16:58:39', NULL),
(3, 'php مقدماتی', 13, 'a:2:{s:5:\"small\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_10_35_46_11.jpg\";s:3:\"big\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_10_35_46_10.jpg\";}', NULL, '&lt;p&gt;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php ph&lt;/p&gt;\r\n\r\n&lt;p&gt;p&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n', 56000, 'php web', 2, 3, '0', '2021-05-29 12:27:27', '2021-06-05 14:11:04', NULL),
(4, 'php پیشرفته', 0, 'a:2:{s:5:\"small\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_10_30_14_17.jpg\";s:3:\"big\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_10_30_14_63.jpg\";}', NULL, '&lt;p&gt;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php vphp php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php&amp;nbsp;&lt;/p&gt;\r\n', 50000, 'php web php advanced', 2, 3, '0', '2021-05-29 14:35:38', '2021-06-05 13:00:14', NULL),
(5, 'php mvc', 0, 'a:2:{s:5:\"small\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_10_31_52_96.jpg\";s:3:\"big\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_10_31_52_50.jpg\";}', NULL, '&lt;p&gt;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;vphp php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;php php php&amp;nbsp;&lt;/p&gt;\r\n', 20000, 'php phpmvc web', 2, 3, '0', '2021-05-29 14:40:11', '2021-06-05 13:01:52', NULL),
(6, 'java script مقدماتی', 0, 'a:2:{s:5:\"small\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_10_33_02_36.jpg\";s:3:\"big\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_10_33_02_46.jpg\";}', NULL, '&lt;p&gt;sfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfssssssssssssss&lt;/p&gt;\r\n', 0, 'js  javascript es8', 6, 3, '0', '2021-05-29 14:41:09', '2021-06-05 13:03:02', NULL),
(7, 'آموزش برنامه نویسی java script', 6, 'a:2:{s:5:\"small\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_14_28_49_36.jpg\";s:3:\"big\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_14_28_49_93.jpg\";}', NULL, '&lt;p&gt;آموزش برنامه نویس phpآموزش برنامه نویس phpآموزش برنامه نویس phpآموزش برنامه نویس phpآموزش برنامه نویس phpآموزش برنامه نویس phpآموزش برنامه نویس phpآموزش برنامه نویس phpآموزش برنامه نویس phpآموزش برنامه نویس phpآموزش برنامه نویس phpآموزش برنامه نویس php&lt;/p&gt;\r\n', 500000, 'javascript js jqjavascript jq', 6, 1, '0', '2021-05-29 15:48:09', '2021-06-05 16:58:49', NULL),
(8, 'php1', 0, '', NULL, '&lt;p&gt;sfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfsssssssssssssssfssssssssssssss&lt;/p&gt;\r\n', 20000, 'sgf sfg sg g wr gq s awr wg', 5, 1, '0', '2021-06-01 18:03:13', NULL, NULL),
(9, 'java script پیشرفته', 0, 'a:2:{s:5:\"small\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_10_33_49_62.jpg\";s:3:\"big\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_10_33_49_24.jpg\";}', NULL, '&lt;p&gt;dfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdf&lt;/p&gt;\r\n\r\n&lt;p&gt;dfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfd&lt;/p&gt;\r\n\r\n&lt;p&gt;fdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdf&lt;/p&gt;\r\n\r\n&lt;p&gt;dfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdf&lt;/p&gt;\r\n\r\n&lt;p&gt;dfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdfd&lt;/p&gt;\r\n\r\n&lt;p&gt;fdfdfdfdf&lt;/p&gt;\r\n', 500000, 'javascript js es8', 6, 3, '0', '2021-06-04 14:47:04', '2021-06-05 13:03:49', NULL),
(10, 'react js', 0, 'a:2:{s:5:\"small\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_10_34_36_56.jpg\";s:3:\"big\";s:59:\"/images/course/image/2021/Jun/05/2021_06_05_10_34_36_51.jpg\";}', NULL, '&lt;p&gt;mfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffuyrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr&lt;/p&gt;\r\n', 50000, 'js reactjs javascript es8', 6, 3, '0', '2021-06-04 15:00:22', '2021-06-05 13:04:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `is_active` enum('0','1') NOT NULL DEFAULT '0',
  `user_type` enum('professor','not') NOT NULL DEFAULT 'professor',
  `description` text NOT NULL,
  `facebook` varchar(191) DEFAULT NULL,
  `instagram` varchar(191) DEFAULT NULL,
  `telegram` varchar(191) DEFAULT NULL,
  `verify_token` varchar(191) DEFAULT NULL,
  `remember_token` varchar(191) DEFAULT NULL,
  `remember_token_expire` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`id`, `first_name`, `last_name`, `email`, `password`, `image`, `status`, `is_active`, `user_type`, `description`, `facebook`, `instagram`, `telegram`, `verify_token`, `remember_token`, `remember_token_expire`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'امیر عباس ', 'نیک مهر', 'aliniki123@yahoo.com', '$2y$10$fHmrLWT.swcDUB3W3Wrx6.LmhUr928tfwcSjgN41OqwhevRG0PIaS', 'a:2:{s:5:\"small\";s:62:\"/images/professor/image/2021/Jun/08/2021_06_08_12_09_08_89.jpg\";s:3:\"big\";s:62:\"/images/professor/image/2021/Jun/08/2021_06_08_12_09_08_81.jpg\";}', '0', '1', 'professor', 'gfیسیسیسی', NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-24 07:21:04', '2021-06-08 14:39:21', NULL),
(3, 'علی', 'نیک مهر', 'alinikmehr128@yahoo.com', '$2y$10$fHmrLWT.swcDUB3W3Wrx6.LmhUr928tfwcSjgN41OqwhevRG0PIaS', 'a:2:{s:5:\"small\";s:62:\"/images/professor/image/2021/Jun/04/2021_06_04_13_16_58_42.jpg\";s:3:\"big\";s:62:\"/images/professor/image/2021/Jun/04/2021_06_04_13_16_58_12.jpg\";}', '0', '1', 'professor', 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. ', 'https://www.instagram.com/cristiano/', 'https://www.instagram.com/ali_niki_98/', 'https://www.instagram.com/cristiano/', '985f44098d665147de6f623068253fabca077cbdeb2dd0eaad3466086afb3f89', '63724488a8906a31b8a8633bef1f64260f104e1cf23f41856303913306a70692', '2021-05-27 07:36:52', '2021-05-27 09:10:29', '2021-06-04 15:46:58', NULL),
(4, 'kamal', 'niki', 'alinikmehr123@yahoo.com', '$2y$10$553ccEzD3OZ7ZK9zBBBDgOz5xKP268H1E5viUlMAtCb7ZqKmq85Py', 'a:2:{s:5:\"small\";s:62:\"/images/professor/image/2021/Jun/04/2021_06_04_12_01_10_50.jpg\";s:3:\"big\";s:62:\"/images/professor/image/2021/Jun/04/2021_06_04_12_01_10_50.jpg\";}', '0', '1', 'professor', '                                                        d;lkjgfoe;jw;gfljwoejgfw                                                ', NULL, NULL, NULL, 'f91e6c9488af9c590210fd09fe23f31f76cbea0e1329d5f33b8e2f0501abe477', NULL, NULL, '2021-06-04 14:31:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `avatar` varchar(191) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `user_type` enum('admin','user','writer') NOT NULL DEFAULT 'user',
  `verify_token` varchar(191) DEFAULT NULL,
  `remember_token` varchar(191) DEFAULT NULL,
  `remember_token_expire` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `avatar`, `status`, `is_active`, `user_type`, `verify_token`, `remember_token`, `remember_token_expire`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'علی', 'نیکی', 'aliniki@yahoo.com', '$2y$10$WDeG9oXZ1n7iVMhGjmqyUengyVswMfMvAvYSVc2zB1PGZPBq2FAMi', '/images/users/avatar/2021/May/27/2021_05_27_07_56_13_91.jpg', '1', 1, 'admin', '445adc3f497601e65c6cd00bfd6ad273361a0fc274cd5412a52b7547fc83e13d', NULL, NULL, '2021-05-21 04:29:00', '2021-05-27 10:26:13', NULL),
(3, 'ali', 'niki', 'alinikmehr128@yahoo.com', '$2y$10$WDeG9oXZ1n7iVMhGjmqyUengyVswMfMvAvYSVc2zB1PGZPBq2FAMi', '/images/users/avatar/2021/May/27/2021_05_27_07_56_39_36.jpg', '0', 1, 'user', '445adc3f497601e65c6cd00bfd6ad273361a0fc274cd5412a52b7547fc83e13d', '935097a877d85afc8dea67b26cfe62c86f72e2bc721da6cf0517f26238620310', '2021-05-27 07:29:42', '2021-05-22 10:11:25', '2021-05-27 10:29:03', NULL),
(5, 'کمال', 'ماهان فر', 'alinikmehr128@gmail.com', '$2y$10$cZ/0oY4uAfiz9fEA/hdsseLTCenL.FqTJqhSCnYYytquDWgg4/etW', '/images/users/avatar/2021/May/27/2021_05_27_07_57_24_97.jpg', '1', 1, 'admin', 'a9cb44d823e3da89fd6e61d89d30a180574c9458e7e23dec2b1c9606eba5517d', '13e88550f71671183336df365be3c57e5dd78143f63e6cd6e01f53e84e11a099', '2021-05-24 01:28:14', '2021-05-22 15:59:00', '2021-05-27 10:27:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_courses`
--

CREATE TABLE `users_courses` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `price` int(7) NOT NULL,
  `payment_code` varchar(225) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_courses`
--

INSERT INTO `users_courses` (`id`, `user_id`, `course_id`, `price`, `payment_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, 20000, 'dsdsd', '2021-06-18 15:47:11', '2021-06-20 15:41:42', NULL),
(2, 3, 3, 56000, NULL, '2021-06-18 15:47:12', NULL, '2021-06-20 15:55:35'),
(3, 3, 4, 50000, NULL, '2021-06-18 15:47:14', NULL, '2021-06-20 15:55:58'),
(5, 3, 3, 56000, NULL, '2021-06-20 15:44:09', NULL, '2021-06-20 15:55:38'),
(6, 3, 3, 56000, 'payment code valid', '2021-06-20 18:35:38', '2021-06-20 18:36:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `video` varchar(225) NOT NULL,
  `time` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `professor_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `video`, `time`, `status`, `professor_id`, `course_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'جلسه اول', 'videos/courses/2021/Jun/03/2021_06_03_13_59_17_31.mp4', 13, '1', 1, 1, '2021-06-03 16:29:17', NULL, NULL),
(2, 'جلسه دوم', 'videos/courses/2021/Jun/03/2021_06_03_14_04_14_35.mp4', 1, '1', 1, 1, '2021-06-03 16:34:14', '2021-06-03 16:42:23', NULL),
(3, 'جلسه اول جاوا اسکریپت', 'videos/courses/2021/Jun/03/2021_06_03_14_13_06_40.mp4', 1, '1', 1, 7, '2021-06-03 16:43:06', '2021-06-03 16:46:51', NULL),
(4, 'جلسه اول ', 'videos/courses/2021/Jun/03/2021_06_03_14_18_13_83.mp4', 5, '1', 1, 7, '2021-06-03 16:48:13', NULL, NULL),
(5, 'جلسه اول', 'videos/courses/2021/Jun/03/2021_06_03_19_23_26_27.mp4', 5, '1', 3, 3, '2021-06-03 21:42:31', '2021-06-03 21:53:50', NULL),
(6, 'جلسه دوم', 'videos/courses/2021/Jun/03/2021_06_03_19_24_20_82.mp4', 4, '1', 3, 3, '2021-06-03 21:54:20', '2021-06-03 21:54:31', NULL),
(7, 'course 3', 'videos/courses/2021/Jun/04/2021_06_04_13_00_45_38.mp4', 4, '1', 3, 3, '2021-06-04 15:30:45', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_courses`
--
ALTER TABLE `users_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users_courses`
--
ALTER TABLE `users_courses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
