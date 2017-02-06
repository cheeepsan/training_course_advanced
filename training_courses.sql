-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2017 at 06:11 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training_courses`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auth_assignment`
--

DROP TABLE IF EXISTS `tbl_auth_assignment`;
CREATE TABLE `tbl_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auth_item`
--

DROP TABLE IF EXISTS `tbl_auth_item`;
CREATE TABLE `tbl_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_auth_item`
--

INSERT INTO `tbl_auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, 'userGroup', NULL, 1486218401, 1486218401),
('complete-task', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('delete', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('error', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('guest', 1, NULL, 'userGroup', NULL, 1486218401, 1486218401),
('index', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('list-all-tasks', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('list-courses', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('list-news', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('list-users', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('login', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('logout', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('new-article', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('new-course', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('new-task-from-parent', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('new-user', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('save-task', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('sign-up', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('update', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('user', 1, NULL, 'userGroup', NULL, 1486218401, 1486218401),
('view', 2, NULL, NULL, NULL, 1486218400, 1486218400),
('view-user', 2, NULL, NULL, NULL, 1486218400, 1486218400);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auth_item_child`
--

DROP TABLE IF EXISTS `tbl_auth_item_child`;
CREATE TABLE `tbl_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_auth_item_child`
--

INSERT INTO `tbl_auth_item_child` (`parent`, `child`) VALUES
('admin', 'delete'),
('admin', 'list-users'),
('admin', 'new-article'),
('admin', 'new-course'),
('admin', 'new-task-from-parent'),
('admin', 'new-user'),
('admin', 'user'),
('guest', 'error'),
('guest', 'login'),
('user', 'complete-task'),
('user', 'guest'),
('user', 'index'),
('user', 'list-all-tasks'),
('user', 'list-courses'),
('user', 'list-news'),
('user', 'logout'),
('user', 'save-task'),
('user', 'sign-up'),
('user', 'update'),
('user', 'view'),
('user', 'view-user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_auth_rule`
--

DROP TABLE IF EXISTS `tbl_auth_rule`;
CREATE TABLE `tbl_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_auth_rule`
--

INSERT INTO `tbl_auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('userGroup', 'O:26:"console\\rbac\\UserGroupRule":3:{s:4:"name";s:9:"userGroup";s:9:"createdAt";i:1486218400;s:9:"updatedAt";i:1486218400;}', 1486218400, 1486218400);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

DROP TABLE IF EXISTS `tbl_course`;
CREATE TABLE `tbl_course` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf16_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf16_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`id`, `name`, `description`, `status`, `start_date`, `end_date`) VALUES
(11, 'Blabla', '<p>Двухмесячный проект #МыХудеемВХельсинки с персональным тренером Veronika Alamoss<br />\r\n<br />\r\nЗдесь мы худеем и выигрываем призы!sasasa</p>\r\n', 1, '2016-08-01', '2017-04-12'),
(12, 'a', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_tasks`
--

DROP TABLE IF EXISTS `tbl_course_tasks`;
CREATE TABLE `tbl_course_tasks` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf16_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf16_unicode_ci,
  `status` tinyint(4) DEFAULT '0',
  `create_date` date DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `upload` text COLLATE utf16_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `tbl_course_tasks`
--

INSERT INTO `tbl_course_tasks` (`id`, `parent_id`, `name`, `description`, `status`, `create_date`, `publish_date`, `upload`) VALUES
(32, 11, 'Задание', '', NULL, NULL, NULL, NULL),
(33, 11, 'sdfgh', '', 1, '2017-01-19', '2017-01-31', '/uploads/071016.pdf'),
(34, 11, 'test1', '', NULL, NULL, NULL, NULL),
(36, 11, 'sdsad', '', NULL, '2017-01-18', NULL, '/uploads/071016.pdf'),
(37, 11, 'sd', '', 1, NULL, NULL, NULL),
(38, 11, 'NEW TASK', '', 1, '2017-02-08', '2017-02-25', NULL),
(39, 11, '1', '', 1, '2017-02-08', '2017-02-25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_user_map`
--

DROP TABLE IF EXISTS `tbl_course_user_map`;
CREATE TABLE `tbl_course_user_map` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `permission_read` tinyint(1) NOT NULL DEFAULT '0',
  `permission_write` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `tbl_course_user_map`
--

INSERT INTO `tbl_course_user_map` (`id`, `course_id`, `user_id`, `permission_read`, `permission_write`) VALUES
(68, 11, 31, 0, 0),
(69, 11, 1, 0, 0),
(70, 11, 34, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migration`
--

DROP TABLE IF EXISTS `tbl_migration`;
CREATE TABLE `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1485969219),
('m140506_102106_rbac_init', 1485969276);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

DROP TABLE IF EXISTS `tbl_news`;
CREATE TABLE `tbl_news` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf16_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf16_unicode_ci,
  `status` tinyint(4) DEFAULT '0',
  `create_date` date DEFAULT NULL,
  `publish_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `name`, `description`, `status`, `create_date`, `publish_date`) VALUES
(1, 'Loma', 'Vitusti viinaa', 1, '2016-12-01', '2016-12-15'),
(2, 'Harjoitus on peruttu', 'Teksti teksti teksti', 1, '2017-01-13', '2017-01-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_submit`
--

DROP TABLE IF EXISTS `tbl_task_submit`;
CREATE TABLE `tbl_task_submit` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `done` tinyint(4) NOT NULL DEFAULT '0',
  `comment` text,
  `done_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_task_submit`
--

INSERT INTO `tbl_task_submit` (`id`, `user_id`, `parent_id`, `done`, `comment`, `done_date`) VALUES
(3, 31, 32, 1, '', '0000-00-00'),
(4, 1, 32, 1, '', '0000-00-00'),
(5, 31, 33, 0, NULL, NULL),
(6, 1, 33, 1, '<p>dfgygkjuhkj</p>\r\n', '0000-00-00'),
(7, 32, 33, 0, NULL, NULL),
(8, 31, 34, 0, NULL, NULL),
(9, 1, 34, 1, '', '0000-00-00'),
(10, 32, 34, 0, NULL, NULL),
(14, 31, 36, 0, NULL, NULL),
(15, 1, 36, 1, '', '0000-00-00'),
(16, 32, 36, 0, NULL, NULL),
(17, 31, 37, 0, NULL, NULL),
(18, 1, 37, 1, '', '0000-00-00'),
(19, 32, 37, 0, NULL, NULL),
(20, 31, 38, 0, NULL, NULL),
(21, 1, 38, 1, '<p>awsdfasfd</p>\r\n', '0000-00-00'),
(22, 34, 38, 0, NULL, NULL),
(23, 31, 39, 0, NULL, NULL),
(24, 1, 39, 0, NULL, NULL),
(25, 34, 39, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_user`
--

DROP TABLE IF EXISTS `tbl_user_user`;
CREATE TABLE `tbl_user_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf16_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf16_unicode_ci DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `groups` text COLLATE utf16_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `phone` varchar(50) COLLATE utf16_unicode_ci DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `tbl_user_user`
--

INSERT INTO `tbl_user_user` (`id`, `user_id`, `name`, `surname`, `weight`, `date_of_birth`, `groups`, `active`, `phone`, `sex`, `instagram`, `facebook`) VALUES
(1, 1, 'admin', 'admin', '999.99', '2016-08-26', NULL, 0, NULL, NULL, '', ''),
(31, 27, 'Ivan', 'Khokhlachev', NULL, NULL, NULL, 1, NULL, NULL, '', ''),
(32, 28, '', '', '12.22', NULL, NULL, 1, NULL, NULL, '', ''),
(33, 29, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '', ''),
(34, 30, 'Jovana', 'Kacavenda', NULL, NULL, NULL, 1, NULL, NULL, '', ''),
(35, 31, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_users`
--

DROP TABLE IF EXISTS `tbl_user_users`;
CREATE TABLE `tbl_user_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf16_unicode_ci DEFAULT NULL,
  `signup` date DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  `authKey` varchar(255) COLLATE utf16_unicode_ci DEFAULT NULL,
  `accessToken` varchar(255) COLLATE utf16_unicode_ci NOT NULL,
  `identityClass` varchar(255) COLLATE utf16_unicode_ci DEFAULT NULL,
  `enableAutoLogin` tinyint(4) NOT NULL DEFAULT '0',
  `identityCookie` text COLLATE utf16_unicode_ci,
  `group` varchar(50) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `tbl_user_users`
--

INSERT INTO `tbl_user_users` (`id`, `username`, `password`, `signup`, `last_login`, `authKey`, `accessToken`, `identityClass`, `enableAutoLogin`, `identityCookie`, `group`) VALUES
(1, 'admin@transformation.fi', '$2y$13$XsJiVKEG5I3..w/od/8FjuPUvaNGGUJK3TEQ5owlOkxC5c/l3YdQC', '2016-07-16', NULL, 'test100key', '100-token', NULL, 0, NULL, 'admin'),
(27, 'ivan@t.fi', '$2y$13$Lxpklm8DIRcDt5NmID70CuUQMTm2LL/37qH9Bpdh8Bw4YCSwkE5Qu', '2017-01-21', NULL, 'refXzBTl6EKgSbDhM93aJVM2b40a0bE2', 'h78JPZBB96FE62ZDiomMPNG5HcsZGM1s', NULL, 0, NULL, 'user'),
(28, 'german', '$2y$13$c5wwbbtBtx3AUkoVng1.suGduzLGvQG.Zjo2383q0BuLSNJ2SUBl2', '2017-01-23', NULL, 'MXqeeVBAsKrivS01PhgSFfkj6uClHzNC', 'HlTFnTsZ_djwQTESAKadvomZ3fHCETUl', NULL, 0, NULL, 'user'),
(29, 'test', '$2y$13$pdiFegIaB/QClyfYWP55RONRdieVLk4bTR/tMHUsL9hzM9Cu.kSyy', '2017-02-04', NULL, 'uvtJvNlvq1QrAbzdBmSCG7fEW_AXVkoC', '39TAW9fSy8r1owrREkkyxrBPHbbMgg6s', NULL, 0, NULL, 'user'),
(30, 'jovana@gmail.com', '$2y$13$NALXiY/DqX8yU630ffsxt.KB/UYAHDndmaYh685u6OeKBjhbQnKk2', '2017-02-04', NULL, '9_CR1R9wS88ZgeaBXli5dhs2GopHUS_-', 'CsM6KlItW6VYBzZs2Hzy2yTlWYQbFq3K', NULL, 0, NULL, 'user'),
(31, 'test@siteseq.fi', '$2y$13$2IBAxFbc/6ZyMUT5qGdAgeFETjfOjDMhBRKvWf0IAdBkTOnSwAbiG', '2017-02-04', NULL, 'Dx33rqNyAqbMf9Nx5xy2mS-0bYJ2Wci9', '9IQRNGApbI8Fwu0Z68jlfLZ47bVv4_-W', NULL, 0, NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_auth_assignment`
--
ALTER TABLE `tbl_auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `tbl_auth_item`
--
ALTER TABLE `tbl_auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `tbl_auth_item_child`
--
ALTER TABLE `tbl_auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `tbl_auth_rule`
--
ALTER TABLE `tbl_auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_course_tasks`
--
ALTER TABLE `tbl_course_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_course_user_map`
--
ALTER TABLE `tbl_course_user_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_migration`
--
ALTER TABLE `tbl_migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_task_submit`
--
ALTER TABLE `tbl_task_submit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_user`
--
ALTER TABLE `tbl_user_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_users`
--
ALTER TABLE `tbl_user_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_course_tasks`
--
ALTER TABLE `tbl_course_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `tbl_course_user_map`
--
ALTER TABLE `tbl_course_user_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_task_submit`
--
ALTER TABLE `tbl_task_submit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tbl_user_user`
--
ALTER TABLE `tbl_user_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tbl_user_users`
--
ALTER TABLE `tbl_user_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_auth_assignment`
--
ALTER TABLE `tbl_auth_assignment`
  ADD CONSTRAINT `tbl_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_auth_item`
--
ALTER TABLE `tbl_auth_item`
  ADD CONSTRAINT `tbl_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `tbl_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_auth_item_child`
--
ALTER TABLE `tbl_auth_item_child`
  ADD CONSTRAINT `tbl_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
