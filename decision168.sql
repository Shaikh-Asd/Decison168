-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2023 at 03:44 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `decision168`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_list`
--

CREATE TABLE `ad_list` (
  `aid` int(11) NOT NULL,
  `ad` text NOT NULL,
  `acreated_by` int(11) NOT NULL,
  `acreated_date` datetime NOT NULL,
  `astatus` varchar(30) NOT NULL,
  `pack_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ad_logo`
--

CREATE TABLE `ad_logo` (
  `id` int(11) NOT NULL,
  `clogo` text NOT NULL,
  `logo_link` text NOT NULL,
  `lcreated_by` int(11) NOT NULL,
  `lcreated_date` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_date` text NOT NULL,
  `qnotify` varchar(50) NOT NULL,
  `qnotify_clear` varchar(50) NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ad_logo`
--

INSERT INTO `ad_logo` (`id`, `clogo`, `logo_link`, `lcreated_by`, `lcreated_date`, `status`, `status_date`, `qnotify`, `qnotify_clear`, `reg_acc_status`) VALUES
(1, '1670157817_3.png', 'https://www.medsmarter.com/', 3, '2022-12-04 07:43:37', 'approved', '2022-12-04 07:43:58', 'seen', 'yes', ''),
(3, '1670158129_3.png', 'https://www.z2squared.com/', 3, '2022-12-04 07:48:49', 'approved', '2022-12-04 07:49:02', 'seen', 'yes', ''),
(5, '1670603196_3.png', 'https://www.decision168.com/', 0, '2022-12-09 11:16:56', 'approved', '2022-12-09 11:16:56', 'yes', 'no', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `cid` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `subtask_id` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `c_code` text NOT NULL,
  `message` text CHARACTER SET utf8mb4 NOT NULL,
  `c_created_by` int(11) NOT NULL,
  `c_created_date` datetime NOT NULL,
  `c_notify` text NOT NULL,
  `c_notify_clear` text NOT NULL,
  `delete_msg` varchar(50) NOT NULL,
  `deleted_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `project_id`, `task_id`, `subtask_id`, `portfolio_id`, `c_code`, `message`, `c_created_by`, `c_created_date`, `c_notify`, `c_notify_clear`, `delete_msg`, `deleted_date`, `reg_acc_status`) VALUES
(1, 1, 0, 0, 1, 'JG-3620', 'hi', 398, '2023-06-16 08:48:39', '', '', '', '', ''),
(2, 1, 0, 0, 1, 'JG-255', 'hey', 1, '2023-06-16 08:48:53', '', '', '', '', ''),
(3, 1, 0, 0, 1, 'JG-109', '@Uzma K', 1, '2023-06-16 08:48:59', '', '', '', '', ''),
(4, 4, 0, 0, 1, 'JG-5501', 'hi', 399, '2023-06-19 06:17:48', ',398', ',398', '', '', ''),
(5, 1, 0, 0, 1, 'JG-7896', 'hey', 399, '2023-06-26 01:19:07', ',398', ',398', '', '', ''),
(6, 14, 0, 0, 1, 'RE-5700', 'hey', 399, '2023-07-06 06:00:00', ',398', ',398', '', '', ''),
(7, 14, 0, 0, 1, 'RE-8811', 'hello', 1, '2023-07-06 06:01:25', ',398', ',398', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `confidence_level`
--

CREATE TABLE `confidence_level` (
  `id` int(11) NOT NULL,
  `level` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `confidence_level`
--

INSERT INTO `confidence_level` (`id`, `level`, `status`, `date`) VALUES
(1, 'Beginner', 'active', '2021-04-08 17:56:05'),
(2, 'Intermediate', 'active', '2021-04-08 17:56:05'),
(3, 'Advanced', 'active', '2021-04-08 17:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `contacted_company`
--

CREATE TABLE `contacted_company` (
  `cc_id` int(11) NOT NULL,
  `cc_name` text NOT NULL,
  `cc_email` text NOT NULL,
  `cc_name_on_card` text NOT NULL,
  `cc_tusers` text NOT NULL,
  `cc_username` text NOT NULL,
  `cc_pwd` text NOT NULL,
  `cc_corporate_id` text NOT NULL,
  `cc_corporate_id_encrypt` text NOT NULL,
  `cc_link` text NOT NULL,
  `cc_createddate` date NOT NULL,
  `contacted_sales_id` int(11) NOT NULL,
  `contacted_user_id` int(11) NOT NULL,
  `cc_status` varchar(30) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_use` varchar(30) NOT NULL,
  `stripe_cus_id` text NOT NULL,
  `package_start` datetime NOT NULL,
  `package_expiry` text NOT NULL,
  `sub_cancel_reason` varchar(50) NOT NULL,
  `sub_cancel_reason_notify` varchar(30) NOT NULL,
  `paid_amount` text NOT NULL,
  `paid_amount_currency` varchar(10) NOT NULL,
  `txn_id` text NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `renew` varchar(50) NOT NULL,
  `package_coupon_id` int(11) NOT NULL,
  `used_package_coupon_id` text NOT NULL,
  `extended_pack` varchar(30) NOT NULL,
  `extended_mail_sent` varchar(30) NOT NULL,
  `extended_mail_date` date NOT NULL,
  `inactivity_date_start` datetime NOT NULL,
  `inactivity_mail_days` int(11) NOT NULL,
  `deactive_date` date NOT NULL,
  `delete_date` date NOT NULL,
  `mail_code` text NOT NULL,
  `mail_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacted_company`
--

INSERT INTO `contacted_company` (`cc_id`, `cc_name`, `cc_email`, `cc_name_on_card`, `cc_tusers`, `cc_username`, `cc_pwd`, `cc_corporate_id`, `cc_corporate_id_encrypt`, `cc_link`, `cc_createddate`, `contacted_sales_id`, `contacted_user_id`, `cc_status`, `package_id`, `package_use`, `stripe_cus_id`, `package_start`, `package_expiry`, `sub_cancel_reason`, `sub_cancel_reason_notify`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `renew`, `package_coupon_id`, `used_package_coupon_id`, `extended_pack`, `extended_mail_sent`, `extended_mail_date`, `inactivity_date_start`, `inactivity_mail_days`, `deactive_date`, `delete_date`, `mail_code`, `mail_date`) VALUES
(1, 'Webtech', 'webtech@gmail.com', 'Webtech Comp', '200', 'Webtech', '284280ff0c62a137b3db689af0c8a95c', 'web305', 'cac380c4236df54029f0176ab5433b3d', 'http://localhost/decision168/corporate-registration/cac380c4236df54029f0176ab5433b3d', '2023-06-15', 3, 1, 'active', 23, 'yes', 'cus_O5OhoUVKytEVnb', '2023-06-15 07:00:07', '2023-07-15 07:00:07', '', '', '60', 'usd', 'sub_1NJDuHECBZEQ4z2Nacs0jXri', 'active', 'auto', 0, '', '', '', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00', '0000-00-00', '', '0000-00-00 00:00:00'),
(2, 'Comptech', 'comptech@gmail.com', 'Comptech', '600', 'Comptech', '91eb0d71f86b34d566b6151110a19187', 'com4548', '61d163b9a96b7252acbaba21de6fc185', 'http://localhost/decision168/corporate-registration/61d163b9a96b7252acbaba21de6fc185', '2023-06-16', 4, 2, 'active', 24, 'yes', 'cus_O5hTAjV4jXObRr', '2023-06-16 02:23:49', '2023-07-16 02:23:49', '', '', '79', 'usd', 'sub_1NJW4NECBZEQ4z2NCs48aiee', 'active', 'auto', 0, '', '', '', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00', '0000-00-00', '', '0000-00-00 00:00:00'),
(3, 'TechV', 'TechV@gmail.com', 'TechV', '500', 'TechV', 'a0d62e5284ddd34717d8077907dc2cef', 'tec5436', '138f042de423e10ed8d79f7bce4734f5', 'http://localhost/decision168/corporate-registration/138f042de423e10ed8d79f7bce4734f5', '2023-06-16', 5, 306, 'active', 25, 'yes', 'cus_O5hY2OTbzREIM3', '2023-06-16 02:28:39', '2023-07-16 02:28:39', '', '', '45', 'usd', 'sub_1NJW94ECBZEQ4z2Nzf7PeCQf', 'active', 'auto', 0, '', '', '', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00', '0000-00-00', '', '0000-00-00 00:00:00'),
(4, 'Test1com', 'Test1com@gmail.com', 'Test1com', '10', 'Test1com', '71ae08348a6670049709d51974d991c5', 'tes8860', '9d6fe4c321322d51aab82fdf5a385ec8', 'http://localhost/decision168/corporate-registration/9d6fe4c321322d51aab82fdf5a385ec8', '2023-07-04', 8, 400, 'active', 26, 'yes', 'cus_OCnxjKNzn6SHEG', '2023-07-05 01:34:24', '2024-03-31 01:34:24', '', '', '50', 'usd', 'sub_1NQOM3ECBZEQ4z2Nm5lN3srE', 'active', 'auto', 0, '', '', '', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00', '0000-00-00', '', '0000-00-00 00:00:00'),
(5, 'SaraTest', 'saratest@gmail.com', 'SaraTest', '5', 'SaraTest', '74595e91bfb31868a7675b88b8ab47d5', 'sar1801', '18b06d83d5f7445f42d0df78a44b4b49', 'http://localhost/decision168/corporate-registration/18b06d83d5f7445f42d0df78a44b4b49', '2023-07-10', 10, 5, 'active', 28, 'yes', 'cus_OEnppYZUnhV9ve', '2023-07-10 09:34:24', '2024-01-06 09:34:24', '', '', '60', 'usd', 'sub_1NSKEJECBZEQ4z2NdTZDNXGc', 'active', 'auto', 0, '', '', '', '0000-00-00', '0000-00-00 00:00:00', 0, '0000-00-00', '0000-00-00', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacted_company_emp`
--

CREATE TABLE `contacted_company_emp` (
  `cce_id` int(11) NOT NULL,
  `cc_id` int(11) NOT NULL,
  `emp_email` text NOT NULL,
  `emp_status` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `cce_date` date NOT NULL,
  `contacted_user` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacted_company_emp`
--

INSERT INTO `contacted_company_emp` (`cce_id`, `cc_id`, `emp_email`, `emp_status`, `status`, `cce_date`, `contacted_user`) VALUES
(1, 1, 'uzmakarjikar@gmail.com', 'active', 'accepted', '2023-06-15', 'yes'),
(2, 2, 'shaikhafrin33@gmail.com', 'active', 'accepted', '2023-06-16', 'yes'),
(3, 3, 'uzma.karjikar@gmail.com', 'active', 'accepted', '2023-06-16', 'yes'),
(4, 1, 'uzmakarjikar1@gmail.com', 'active', 'accepted', '2023-06-16', 'no'),
(5, 1, 'uzmakarjikar10@gmail.com', 'active', 'accepted', '2023-06-19', 'no'),
(6, 1, 'uzmakarjikar11@gmail.com', 'active', 'sent', '2023-06-26', 'no'),
(7, 4, 'uzma1@gmail.com', 'active', 'accepted', '2023-07-04', 'yes'),
(8, 1, 'uzmakarjikar12@gmail.com', 'active', 'sent', '2023-07-05', 'no'),
(9, 1, 'uzmakarjikar13@gmail.com', 'active', 'accepted', '2023-07-05', 'no'),
(10, 1, 'uzmakarjikar14@gmail.com', 'active', 'accepted', '2023-07-05', 'no'),
(11, 4, 'uzma2@gmail.com', 'active', 'sent', '2023-07-05', 'no'),
(12, 4, 'uzma22@gmail.com', 'active', 'accepted', '2023-07-05', 'no'),
(13, 5, 'saramaazkhan123@gmail.com', 'active', 'accepted', '2023-07-10', 'yes'),
(14, 5, 'saramaazkhan1234@gmail.com', 'active', 'accepted', '2023-07-10', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `contacted_company_roles`
--

CREATE TABLE `contacted_company_roles` (
  `ccr_id` int(11) NOT NULL,
  `cc_id` int(11) NOT NULL,
  `role` text NOT NULL,
  `privilege` text NOT NULL,
  `rstatus` varchar(30) NOT NULL,
  `ccr_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacted_company_roles`
--

INSERT INTO `contacted_company_roles` (`ccr_id`, `cc_id`, `role`, `privilege`, `rstatus`, `ccr_date`) VALUES
(1, 1, 'Manager', 'all', 'active', '2023-06-15'),
(2, 1, 'Team Leader', 'projects, content planner, task, subtask', 'active', '2023-06-15'),
(3, 1, 'Guest', 'view', 'active', '2023-06-20'),
(4, 5, 'COO', 'all', 'active', '2023-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `contact_sales`
--

CREATE TABLE `contact_sales` (
  `cid` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `email` text NOT NULL,
  `phone` bigint(20) NOT NULL,
  `total_users` varchar(50) NOT NULL,
  `contacted_date` datetime NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `response_status` varchar(50) NOT NULL,
  `response_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_sales`
--

INSERT INTO `contact_sales` (`cid`, `reg_id`, `fname`, `email`, `phone`, `total_users`, `contacted_date`, `reg_acc_status`, `response_status`, `response_date`) VALUES
(3, 1, 'Uzma A Karjikar', 'uzmakarjikar@gmail.com', 9809, '51-250', '2023-06-15 06:52:56', '', 'accepted', '2023-06-15'),
(4, 2, 'Afrin Murtuza Sayed', 'shaikhafrin33@gmail.com', 8975837654, '501+', '2023-06-15 07:14:55', '', 'accepted', '2023-06-16'),
(5, 306, 'uzair karjikar', 'uzma.karjikar@gmail.com', 0, '251-500', '2023-06-16 02:26:09', '', 'accepted', '2023-06-16'),
(8, 400, 'Uzma test1', 'uzma1@gmail.com', 0, '0-10', '2023-07-04 03:38:30', '', 'accepted', '2023-07-04'),
(10, 5, 'sara khan', 'saramaazkhan123@gmail.com', 0, '0-10', '2023-07-10 09:31:01', '', 'accepted', '2023-07-10');

-- --------------------------------------------------------

--
-- Table structure for table `content_planning`
--

CREATE TABLE `content_planning` (
  `pc_id` int(11) NOT NULL,
  `pc_project_assign` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `pcd_id` int(11) NOT NULL,
  `pc_code` text NOT NULL,
  `platform` text NOT NULL,
  `pc_title` text NOT NULL,
  `written_content` text NOT NULL,
  `written_content_2` text NOT NULL,
  `tags` text NOT NULL,
  `youtube_link` text NOT NULL,
  `target_audience` text NOT NULL,
  `solutions` text NOT NULL,
  `keywords` text NOT NULL,
  `internal_links` text NOT NULL,
  `external_links` text NOT NULL,
  `meta_title` text NOT NULL,
  `meta_description` text NOT NULL,
  `pc_link` text NOT NULL,
  `pc_link_comment` text NOT NULL,
  `pc_file` text NOT NULL,
  `doc_pc_file` text NOT NULL,
  `pc_status` varchar(50) NOT NULL,
  `pc_status_date` datetime NOT NULL,
  `written_content_assignee` int(11) NOT NULL,
  `pc_file_assignee` int(11) NOT NULL,
  `submit_to_approval` int(11) NOT NULL,
  `pc_created_by` int(11) NOT NULL,
  `pc_created_date` datetime NOT NULL,
  `pc_assignee` int(11) NOT NULL,
  `review` varchar(50) NOT NULL,
  `review_notify` varchar(50) NOT NULL,
  `trash` varchar(30) NOT NULL,
  `trash_date` text NOT NULL,
  `cp_archive` varchar(50) NOT NULL,
  `cp_archive_date` text NOT NULL,
  `cpsingle_trash` varchar(50) NOT NULL,
  `new_file` text NOT NULL,
  `pc_notify` text NOT NULL,
  `pc_notify_clear` text NOT NULL,
  `pc_notify_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `cp_file_it` varchar(50) NOT NULL,
  `cp_file_it_date` datetime NOT NULL,
  `corporate_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content_planning`
--

INSERT INTO `content_planning` (`pc_id`, `pc_project_assign`, `portfolio_id`, `dept_id`, `pcd_id`, `pc_code`, `platform`, `pc_title`, `written_content`, `written_content_2`, `tags`, `youtube_link`, `target_audience`, `solutions`, `keywords`, `internal_links`, `external_links`, `meta_title`, `meta_description`, `pc_link`, `pc_link_comment`, `pc_file`, `doc_pc_file`, `pc_status`, `pc_status_date`, `written_content_assignee`, `pc_file_assignee`, `submit_to_approval`, `pc_created_by`, `pc_created_date`, `pc_assignee`, `review`, `review_notify`, `trash`, `trash_date`, `cp_archive`, `cp_archive_date`, `cpsingle_trash`, `new_file`, `pc_notify`, `pc_notify_clear`, `pc_notify_date`, `reg_acc_status`, `cp_file_it`, `cp_file_it_date`, `corporate_id`) VALUES
(1, 3, 1, 2, 0, 'JU-1964', 'twitter', '', 'testing', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'done', '2023-06-16 09:46:54', 398, 1, 1, 1, '2023-06-16 09:46:54', 398, '', '', '', '', '', '', '', '', ',,,', '398,398,398,398', '2023-06-16 09:49:01', '', '', '0000-00-00 00:00:00', 'web305'),
(2, 3, 1, 2, 0, 'JU-7645', 'facebook', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'done', '2023-06-16 09:48:11', 398, 398, 1, 1, '2023-06-16 09:48:11', 0, '', '', '', '', '', '', '', '', ',,,', '398,398,398,398', '2023-06-16 09:49:01', '', '', '0000-00-00 00:00:00', 'web305'),
(3, 3, 1, 2, 0, 'JU-1191', 'instagram', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'done', '2023-06-16 09:49:01', 398, 398, 398, 398, '2023-06-16 09:49:01', 398, '', '', '', '', '', '', '', '', '', '398,398,398,398', '2023-06-16 09:49:01', '', '', '0000-00-00 00:00:00', 'web305'),
(4, 4, 1, 3, 0, 'JG-4621', 'twitter', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'done', '2023-06-19 03:35:43', 398, 399, 1, 399, '2023-06-19 03:35:43', 398, '', '', '', '', '', '', '', '', '398,,,398', '398,,,398', '2023-06-19 08:25:27', '', '', '0000-00-00 00:00:00', 'web305'),
(5, 4, 1, 3, 0, 'JG-2908', 'twitter', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'done', '2023-06-19 03:36:48', 398, 1, 1, 399, '2023-06-19 03:36:48', 0, '', '', '', '', '', '', '', '', '398,', '398,1,1,', '2023-06-19 03:36:48', '', 'yes', '2023-06-19 04:06:28', 'web305'),
(6, 4, 1, 3, 0, 'JG-4970', 'facebook', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1687843767_1.jpg', '', 'done', '2023-06-19 08:25:27', 398, 399, 1, 1, '2023-06-19 08:25:27', 0, '', '', '', '', '', '', '', '', '398,,', '398,,', '2023-06-27 01:45:50', '', '', '0000-00-00 00:00:00', 'web305'),
(7, 7, 1, 2, 0, 'TE-194', 'twitter', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'done', '2023-06-21 02:04:21', 399, 399, 399, 399, '2023-06-21 02:04:21', 399, '', '', '', '', '', '', '', '', ',,,', '', '2023-07-05 05:12:05', '', '', '0000-00-00 00:00:00', 'web305'),
(8, 9, 1, 3, 0, 'CO-68', 'twitter', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'done', '2023-06-21 02:24:53', 399, 399, 399, 399, '2023-06-21 02:24:53', 399, '', '', '', '', '', '', '', '', '', '399,399,399,399', '2023-06-21 02:24:53', '', 'yes', '2023-06-23 02:25:28', 'web305'),
(9, 7, 1, 2, 0, 'TE-3386', 'facebook', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1688554661_1687512504_2-.jpg', '', 'done', '2023-07-05 05:12:05', 399, 399, 399, 399, '2023-07-05 05:12:05', 399, '', '', '', '', '', '', '', '', ',,,', '', '2023-07-05 06:57:41', '', '', '0000-00-00 00:00:00', 'web305');

-- --------------------------------------------------------

--
-- Table structure for table `content_planning_trash`
--

CREATE TABLE `content_planning_trash` (
  `pc_trash_id` int(11) NOT NULL,
  `pc_id` int(11) NOT NULL,
  `pc_project_assign` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `pc_file` text NOT NULL,
  `doc_pc_file` text NOT NULL,
  `pc_trash` varchar(50) NOT NULL,
  `pc_trash_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` char(2) NOT NULL,
  `country_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AX', 'Aland Islands'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'AS', 'American Samoa'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua and Barbuda'),
(11, 'AR', 'Argentina'),
(12, 'AM', 'Armenia'),
(13, 'AW', 'Aruba'),
(14, 'AU', 'Australia'),
(15, 'AT', 'Austria'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BS', 'Bahamas'),
(18, 'BH', 'Bahrain'),
(19, 'BD', 'Bangladesh'),
(20, 'BB', 'Barbados'),
(21, 'BY', 'Belarus'),
(22, 'BE', 'Belgium'),
(23, 'BZ', 'Belize'),
(24, 'BJ', 'Benin'),
(25, 'BM', 'Bermuda'),
(26, 'BT', 'Bhutan'),
(27, 'BO', 'Bolivia'),
(28, 'BQ', 'Bonaire, Sint Eustatius and Saba'),
(29, 'BA', 'Bosnia and Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BV', 'Bouvet Island'),
(32, 'BR', 'Brazil'),
(33, 'IO', 'British Indian Ocean Territory'),
(34, 'BN', 'Brunei Darussalam'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'KH', 'Cambodia'),
(39, 'CM', 'Cameroon'),
(40, 'CA', 'Canada'),
(41, 'CV', 'Cape Verde'),
(42, 'KY', 'Cayman Islands'),
(43, 'CF', 'Central African Republic'),
(44, 'TD', 'Chad'),
(45, 'CL', 'Chile'),
(46, 'CN', 'China'),
(47, 'CX', 'Christmas Island'),
(48, 'CC', 'Cocos (Keeling) Islands'),
(49, 'CO', 'Colombia'),
(50, 'KM', 'Comoros'),
(51, 'CG', 'Congo'),
(52, 'CD', 'Congo, Democratic Republic of the Congo'),
(53, 'CK', 'Cook Islands'),
(54, 'CR', 'Costa Rica'),
(55, 'CI', 'Cote D\'Ivoire'),
(56, 'HR', 'Croatia'),
(57, 'CU', 'Cuba'),
(58, 'CW', 'Curacao'),
(59, 'CY', 'Cyprus'),
(60, 'CZ', 'Czech Republic'),
(61, 'DK', 'Denmark'),
(62, 'DJ', 'Djibouti'),
(63, 'DM', 'Dominica'),
(64, 'DO', 'Dominican Republic'),
(65, 'EC', 'Ecuador'),
(66, 'EG', 'Egypt'),
(67, 'SV', 'El Salvador'),
(68, 'GQ', 'Equatorial Guinea'),
(69, 'ER', 'Eritrea'),
(70, 'EE', 'Estonia'),
(71, 'ET', 'Ethiopia'),
(72, 'FK', 'Falkland Islands (Malvinas)'),
(73, 'FO', 'Faroe Islands'),
(74, 'FJ', 'Fiji'),
(75, 'FI', 'Finland'),
(76, 'FR', 'France'),
(77, 'GF', 'French Guiana'),
(78, 'PF', 'French Polynesia'),
(79, 'TF', 'French Southern Territories'),
(80, 'GA', 'Gabon'),
(81, 'GM', 'Gambia'),
(82, 'GE', 'Georgia'),
(83, 'DE', 'Germany'),
(84, 'GH', 'Ghana'),
(85, 'GI', 'Gibraltar'),
(86, 'GR', 'Greece'),
(87, 'GL', 'Greenland'),
(88, 'GD', 'Grenada'),
(89, 'GP', 'Guadeloupe'),
(90, 'GU', 'Guam'),
(91, 'GT', 'Guatemala'),
(92, 'GG', 'Guernsey'),
(93, 'GN', 'Guinea'),
(94, 'GW', 'Guinea-Bissau'),
(95, 'GY', 'Guyana'),
(96, 'HT', 'Haiti'),
(97, 'HM', 'Heard Island and Mcdonald Islands'),
(98, 'VA', 'Holy See (Vatican City State)'),
(99, 'HN', 'Honduras'),
(100, 'HK', 'Hong Kong'),
(101, 'HU', 'Hungary'),
(102, 'IS', 'Iceland'),
(103, 'IN', 'India'),
(104, 'ID', 'Indonesia'),
(105, 'IR', 'Iran, Islamic Republic of'),
(106, 'IQ', 'Iraq'),
(107, 'IE', 'Ireland'),
(108, 'IM', 'Isle of Man'),
(109, 'IL', 'Israel'),
(110, 'IT', 'Italy'),
(111, 'JM', 'Jamaica'),
(112, 'JP', 'Japan'),
(113, 'JE', 'Jersey'),
(114, 'JO', 'Jordan'),
(115, 'KZ', 'Kazakhstan'),
(116, 'KE', 'Kenya'),
(117, 'KI', 'Kiribati'),
(118, 'KP', 'Korea, Democratic People\'s Republic of'),
(119, 'KR', 'Korea, Republic of'),
(120, 'XK', 'Kosovo'),
(121, 'KW', 'Kuwait'),
(122, 'KG', 'Kyrgyzstan'),
(123, 'LA', 'Lao People\'s Democratic Republic'),
(124, 'LV', 'Latvia'),
(125, 'LB', 'Lebanon'),
(126, 'LS', 'Lesotho'),
(127, 'LR', 'Liberia'),
(128, 'LY', 'Libyan Arab Jamahiriya'),
(129, 'LI', 'Liechtenstein'),
(130, 'LT', 'Lithuania'),
(131, 'LU', 'Luxembourg'),
(132, 'MO', 'Macao'),
(133, 'MK', 'Macedonia, the Former Yugoslav Republic of'),
(134, 'MG', 'Madagascar'),
(135, 'MW', 'Malawi'),
(136, 'MY', 'Malaysia'),
(137, 'MV', 'Maldives'),
(138, 'ML', 'Mali'),
(139, 'MT', 'Malta'),
(140, 'MH', 'Marshall Islands'),
(141, 'MQ', 'Martinique'),
(142, 'MR', 'Mauritania'),
(143, 'MU', 'Mauritius'),
(144, 'YT', 'Mayotte'),
(145, 'MX', 'Mexico'),
(146, 'FM', 'Micronesia, Federated States of'),
(147, 'MD', 'Moldova, Republic of'),
(148, 'MC', 'Monaco'),
(149, 'MN', 'Mongolia'),
(150, 'ME', 'Montenegro'),
(151, 'MS', 'Montserrat'),
(152, 'MA', 'Morocco'),
(153, 'MZ', 'Mozambique'),
(154, 'MM', 'Myanmar'),
(155, 'NA', 'Namibia'),
(156, 'NR', 'Nauru'),
(157, 'NP', 'Nepal'),
(158, 'NL', 'Netherlands'),
(159, 'AN', 'Netherlands Antilles'),
(160, 'NC', 'New Caledonia'),
(161, 'NZ', 'New Zealand'),
(162, 'NI', 'Nicaragua'),
(163, 'NE', 'Niger'),
(164, 'NG', 'Nigeria'),
(165, 'NU', 'Niue'),
(166, 'NF', 'Norfolk Island'),
(167, 'MP', 'Northern Mariana Islands'),
(168, 'NO', 'Norway'),
(169, 'OM', 'Oman'),
(170, 'PK', 'Pakistan'),
(171, 'PW', 'Palau'),
(172, 'PS', 'Palestinian Territory, Occupied'),
(173, 'PA', 'Panama'),
(174, 'PG', 'Papua New Guinea'),
(175, 'PY', 'Paraguay'),
(176, 'PE', 'Peru'),
(177, 'PH', 'Philippines'),
(178, 'PN', 'Pitcairn'),
(179, 'PL', 'Poland'),
(180, 'PT', 'Portugal'),
(181, 'PR', 'Puerto Rico'),
(182, 'QA', 'Qatar'),
(183, 'RE', 'Reunion'),
(184, 'RO', 'Romania'),
(185, 'RU', 'Russian Federation'),
(186, 'RW', 'Rwanda'),
(187, 'BL', 'Saint Barthelemy'),
(188, 'SH', 'Saint Helena'),
(189, 'KN', 'Saint Kitts and Nevis'),
(190, 'LC', 'Saint Lucia'),
(191, 'MF', 'Saint Martin'),
(192, 'PM', 'Saint Pierre and Miquelon'),
(193, 'VC', 'Saint Vincent and the Grenadines'),
(194, 'WS', 'Samoa'),
(195, 'SM', 'San Marino'),
(196, 'ST', 'Sao Tome and Principe'),
(197, 'SA', 'Saudi Arabia'),
(198, 'SN', 'Senegal'),
(199, 'RS', 'Serbia'),
(200, 'CS', 'Serbia and Montenegro'),
(201, 'SC', 'Seychelles'),
(202, 'SL', 'Sierra Leone'),
(203, 'SG', 'Singapore'),
(204, 'SX', 'Sint Maarten'),
(205, 'SK', 'Slovakia'),
(206, 'SI', 'Slovenia'),
(207, 'SB', 'Solomon Islands'),
(208, 'SO', 'Somalia'),
(209, 'ZA', 'South Africa'),
(210, 'GS', 'South Georgia and the South Sandwich Islands'),
(211, 'SS', 'South Sudan'),
(212, 'ES', 'Spain'),
(213, 'LK', 'Sri Lanka'),
(214, 'SD', 'Sudan'),
(215, 'SR', 'Suriname'),
(216, 'SJ', 'Svalbard and Jan Mayen'),
(217, 'SZ', 'Swaziland'),
(218, 'SE', 'Sweden'),
(219, 'CH', 'Switzerland'),
(220, 'SY', 'Syrian Arab Republic'),
(221, 'TW', 'Taiwan, Province of China'),
(222, 'TJ', 'Tajikistan'),
(223, 'TZ', 'Tanzania, United Republic of'),
(224, 'TH', 'Thailand'),
(225, 'TL', 'Timor-Leste'),
(226, 'TG', 'Togo'),
(227, 'TK', 'Tokelau'),
(228, 'TO', 'Tonga'),
(229, 'TT', 'Trinidad and Tobago'),
(230, 'TN', 'Tunisia'),
(231, 'TR', 'Turkey'),
(232, 'TM', 'Turkmenistan'),
(233, 'TC', 'Turks and Caicos Islands'),
(234, 'TV', 'Tuvalu'),
(235, 'UG', 'Uganda'),
(236, 'UA', 'Ukraine'),
(237, 'AE', 'United Arab Emirates'),
(238, 'GB', 'United Kingdom'),
(239, 'US', 'United States'),
(240, 'UM', 'United States Minor Outlying Islands'),
(241, 'UY', 'Uruguay'),
(242, 'UZ', 'Uzbekistan'),
(243, 'VU', 'Vanuatu'),
(244, 'VE', 'Venezuela'),
(245, 'VN', 'Viet Nam'),
(246, 'VG', 'Virgin Islands, British'),
(247, 'VI', 'Virgin Islands, U.s.'),
(248, 'WF', 'Wallis and Futuna'),
(249, 'EH', 'Western Sahara'),
(250, 'YE', 'Yemen'),
(251, 'ZM', 'Zambia'),
(252, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `status`, `date`) VALUES
(1, 'Step 1', 'active', '2021-04-08 17:56:05'),
(2, 'Step 2 CK', 'active', '2021-04-08 17:56:05'),
(3, 'MCAT', 'active', '2021-04-08 17:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `daily_activities`
--

CREATE TABLE `daily_activities` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `daily_activity` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_activities`
--

INSERT INTO `daily_activities` (`id`, `student_id`, `daily_activity`, `status`, `date`) VALUES
(1, 0, 'Namaz', 'active', '2021-04-22 14:10:43'),
(2, 0, 'Breakfast', 'active', '2021-04-22 14:10:43'),
(3, 0, 'Exercise', 'active', '2021-04-22 14:10:43'),
(4, 0, 'Meeting', 'active', '2021-04-22 14:10:43'),
(5, 0, 'Lunch', 'active', '2021-04-22 14:10:43'),
(6, 0, 'Fajr', 'active', '2021-04-22 14:10:43'),
(7, 0, 'Nap', 'active', '2021-04-22 14:10:43'),
(8, 0, 'Asr', 'active', '2021-04-22 14:10:43'),
(9, 0, 'Playing', 'active', '2021-04-22 14:10:43'),
(10, 0, 'Magrib', 'active', '2021-04-22 14:10:43'),
(11, 0, 'Dinner', 'active', '2021-04-22 14:10:43'),
(12, 0, 'Esha', 'active', '2021-04-22 14:10:43'),
(13, 0, 'Sleeping', 'active', '2021-04-22 14:10:43'),
(14, 3, 'Jogging', 'active', '2021-04-22 16:15:10'),
(15, 15, 'Wake Up', 'active', '2021-04-23 21:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `draggable_events`
--

CREATE TABLE `draggable_events` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `event_name` text NOT NULL,
  `event_color` varchar(20) NOT NULL,
  `event_note` text NOT NULL,
  `event_start_date` date NOT NULL,
  `event_end_date` date NOT NULL,
  `event_start_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `event_repeat_option` varchar(30) NOT NULL,
  `event_allDay` varchar(30) NOT NULL,
  `event_reminder` varchar(30) NOT NULL,
  `show_draggable_event` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `duration`
--

CREATE TABLE `duration` (
  `id` int(11) NOT NULL,
  `time` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `duration`
--

INSERT INTO `duration` (`id`, `time`, `status`, `date`) VALUES
(1, '0 mins', 'active', '2021-10-25 11:15:12'),
(2, '15 mins', 'active', '2021-10-25 11:15:12'),
(3, '30 mins', 'active', '2021-10-25 11:15:12'),
(4, '45 mins', 'active', '2021-10-25 11:15:12'),
(5, '1 hr', 'active', '2021-10-25 11:15:12'),
(6, '1.5 hrs', 'active', '2021-10-25 11:15:12'),
(7, '2 hrs', 'active', '2021-10-25 11:15:12'),
(8, '2.5 hrs', 'active', '2021-10-25 11:15:12'),
(9, '3 hrs', 'active', '2021-10-25 11:15:12'),
(10, '3.5 hrs', 'active', '2021-10-25 11:15:12'),
(11, '4 hrs', 'active', '2021-10-25 11:15:12'),
(12, '4.5 hrs', 'active', '2021-10-25 11:15:12'),
(13, '5 hrs', 'active', '2021-10-25 11:15:12'),
(14, '5.5 hrs', 'active', '2021-10-25 11:15:12'),
(15, '6 hrs', 'active', '2021-10-25 11:15:12'),
(16, '6.5 hrs', 'active', '2021-10-25 11:15:12'),
(17, '7 hrs', 'active', '2021-10-25 11:15:12'),
(18, '7.5 hrs', 'active', '2021-10-25 11:15:12'),
(19, '8 hrs', 'active', '2021-10-25 11:15:12'),
(20, '8.5 hrs', 'active', '2021-10-25 11:15:12'),
(21, '9 hrs', 'active', '2021-10-25 11:15:12'),
(22, '9.5 hrs', 'active', '2021-10-25 11:15:12'),
(23, '10 hrs', 'active', '2021-10-25 11:15:12'),
(24, '10.5 hrs', 'active', '2021-10-25 11:15:12'),
(25, '11 hrs', 'active', '2021-10-25 11:15:12'),
(26, '11.5 hrs', 'active', '2021-10-25 11:15:12'),
(27, '12 hrs', 'active', '2021-10-25 11:15:12'),
(28, '12.5 hrs', 'active', '2021-10-25 11:15:12'),
(29, '13 hrs', 'active', '2021-10-25 11:15:12'),
(30, '13.5 hrs', 'active', '2021-10-25 11:15:12'),
(31, '14 hrs', 'active', '2021-10-25 11:15:12'),
(32, '14.5 hrs', 'active', '2021-10-25 11:15:12'),
(33, '15 hrs', 'active', '2021-10-25 11:15:12'),
(34, '15.5 hrs', 'active', '2021-10-25 11:15:12'),
(35, '16 hrs', 'active', '2021-10-25 11:15:12'),
(36, '16.5 hrs', 'active', '2021-10-25 11:15:12'),
(37, '17 hrs', 'active', '2021-10-25 11:15:12'),
(38, '17.5 hrs', 'active', '2021-10-25 11:15:12'),
(39, '18 hrs', 'active', '2021-10-25 11:15:12'),
(40, '18.5 hrs', 'active', '2021-10-25 11:15:12'),
(41, '19 hrs', 'active', '2021-10-25 11:15:12'),
(42, '19.5 hrs', 'active', '2021-10-25 11:15:12'),
(43, '20 hrs', 'active', '2021-10-25 11:15:12'),
(44, '20.5 hrs', 'active', '2021-10-25 11:15:12'),
(45, '21 hrs', 'active', '2021-10-25 11:15:12'),
(46, '21.5 hrs', 'active', '2021-10-25 11:15:12'),
(47, '22 hrs', 'active', '2021-10-25 11:15:12'),
(48, '22.5 hrs', 'active', '2021-10-25 11:15:12'),
(49, '23 hrs', 'active', '2021-10-25 11:15:12'),
(50, '23.5 hrs', 'active', '2021-10-25 11:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `event_name` text NOT NULL,
  `event_color` varchar(20) NOT NULL,
  `event_note` text NOT NULL,
  `event_start_date` date NOT NULL,
  `event_end_date` date DEFAULT NULL,
  `date_array` text NOT NULL,
  `end_date` date NOT NULL,
  `event_start_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `event_repeat_option` varchar(30) NOT NULL,
  `event_repeat_option_type` varchar(30) NOT NULL,
  `event_allDay` varchar(10) NOT NULL,
  `event_reminder` varchar(30) NOT NULL,
  `event_reminder_send` varchar(30) NOT NULL,
  `in_app_reminder` varchar(30) NOT NULL,
  `draggable_event` varchar(10) NOT NULL,
  `draggable_id` varchar(10) NOT NULL,
  `custom_day` varchar(200) DEFAULT NULL,
  `custom_all_day` varchar(200) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `created_type` varchar(200) DEFAULT NULL,
  `task_priority` varchar(200) DEFAULT NULL,
  `unique_key` varchar(200) DEFAULT NULL,
  `reminded` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  `meeting_link` text NOT NULL,
  `meeting_agenda` text NOT NULL,
  `meeting_location` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `mfile` text NOT NULL,
  `call_id` int(11) NOT NULL,
  `cm_id` int(11) NOT NULL,
  `expert_approval` int(11) NOT NULL,
  `reject_reason` text NOT NULL,
  `call_rate` text NOT NULL,
  `meeting_id` text NOT NULL,
  `paid` int(11) NOT NULL,
  `call_completed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `student_id`, `event_name`, `event_color`, `event_note`, `event_start_date`, `event_end_date`, `date_array`, `end_date`, `event_start_time`, `event_end_time`, `event_repeat_option`, `event_repeat_option_type`, `event_allDay`, `event_reminder`, `event_reminder_send`, `in_app_reminder`, `draggable_event`, `draggable_id`, `custom_day`, `custom_all_day`, `type`, `created_type`, `task_priority`, `unique_key`, `reminded`, `status`, `date`, `meeting_link`, `meeting_agenda`, `meeting_location`, `portfolio_id`, `mfile`, `call_id`, `cm_id`, `expert_approval`, `reject_reason`, `call_rate`, `meeting_id`, `paid`, `call_completed`) VALUES
(1, 1, 'm1', 'cus_cal_color15', '', '2023-06-20', '2023-06-20', '[\"2023-06\"]', '2023-06-20', '06:00:00', '06:30:00', 'Does not repeat', 'Does not repeat', 'false', 'No reminder', '', '', '', 'no_drag_id', NULL, NULL, 'event', 'meeting', 'No Priority', '64914fb62b5e1', 0, 'active', '2023-06-20 03:05:26', '', '', '', 1, '', 0, 0, 0, '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `events_call_booking`
--

CREATE TABLE `events_call_booking` (
  `ecid` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `call_id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `created_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events_call_booking`
--

INSERT INTO `events_call_booking` (`ecid`, `event_id`, `call_id`, `expert_id`, `created_type`) VALUES
(1, 650, 1, 2, 'Video Session'),
(4, 653, 4, 2, 'Video Session');

-- --------------------------------------------------------

--
-- Table structure for table `events_meeting`
--

CREATE TABLE `events_meeting` (
  `mid` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_unique_key` varchar(200) NOT NULL,
  `member` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_type` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  `status_date` datetime NOT NULL,
  `m_date` datetime NOT NULL,
  `m_event_reminder_send` varchar(30) NOT NULL,
  `m_in_app_reminder` varchar(30) NOT NULL,
  `m_notify_clear` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events_meeting`
--

INSERT INTO `events_meeting` (`mid`, `event_id`, `event_unique_key`, `member`, `created_by`, `created_type`, `status`, `status_date`, `m_date`, `m_event_reminder_send`, `m_in_app_reminder`, `m_notify_clear`) VALUES
(1, 1, '64914fb62b5e1', 398, 1, 'meeting', 'invited', '2023-06-20 03:05:52', '2023-06-20 03:05:26', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `events_meeting_invited_members`
--

CREATE TABLE `events_meeting_invited_members` (
  `imid` int(11) NOT NULL,
  `event_unique_key` varchar(200) NOT NULL,
  `member` text NOT NULL,
  `sent_by` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `status_date` datetime NOT NULL,
  `invite_date` datetime NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `removed` varchar(30) NOT NULL,
  `removed_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `events_todo`
--

CREATE TABLE `events_todo` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `parent_event_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_unique_key` varchar(200) NOT NULL,
  `task_name` text NOT NULL,
  `task_note` text NOT NULL,
  `task_category` text NOT NULL,
  `task_start_date` date NOT NULL,
  `task_start_time` time NOT NULL,
  `task_allDay` varchar(10) NOT NULL,
  `task_reminder` varchar(30) NOT NULL,
  `task_reminder_send` varchar(30) NOT NULL,
  `task_in_app_reminder` varchar(30) NOT NULL,
  `priority` varchar(20) NOT NULL,
  `is_completed` varchar(10) NOT NULL,
  `multiple_events` int(2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expert_call_booking`
--

CREATE TABLE `expert_call_booking` (
  `cid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `cm_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `book_time` text NOT NULL,
  `expert_approval` int(11) NOT NULL,
  `reject_reason` text NOT NULL,
  `call_rate` text NOT NULL,
  `meeting_id` text NOT NULL,
  `paid` int(11) NOT NULL,
  `paid_date` datetime NOT NULL,
  `booked_date` datetime NOT NULL,
  `call_completed` int(11) NOT NULL,
  `reschedule` int(11) NOT NULL,
  `dm_cus_id` text NOT NULL,
  `dm_package_id` int(11) NOT NULL,
  `dm_package_start` datetime NOT NULL,
  `dm_package_expiry` text NOT NULL,
  `dm_balance_amount` text NOT NULL,
  `dm_paid_amount` text NOT NULL,
  `dm_paid_amount_currency` varchar(10) NOT NULL,
  `dm_txn_id` text NOT NULL,
  `dm_payment_status` varchar(50) NOT NULL,
  `dm_refund_amount` text NOT NULL,
  `dm_refund_status` varchar(50) NOT NULL,
  `dm_refund_main_txn_id` text NOT NULL,
  `dm_refund_txn_id` text NOT NULL,
  `dm_renew` varchar(50) NOT NULL,
  `dm_package_coupon_id` int(11) NOT NULL,
  `dm_used_package_coupon_id` text NOT NULL,
  `dm_notify_clear` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expert_call_booking`
--

INSERT INTO `expert_call_booking` (`cid`, `user_id`, `expert_id`, `cm_id`, `booking_date`, `book_time`, `expert_approval`, `reject_reason`, `call_rate`, `meeting_id`, `paid`, `paid_date`, `booked_date`, `call_completed`, `reschedule`, `dm_cus_id`, `dm_package_id`, `dm_package_start`, `dm_package_expiry`, `dm_balance_amount`, `dm_paid_amount`, `dm_paid_amount_currency`, `dm_txn_id`, `dm_payment_status`, `dm_refund_amount`, `dm_refund_status`, `dm_refund_main_txn_id`, `dm_refund_txn_id`, `dm_renew`, `dm_package_coupon_id`, `dm_used_package_coupon_id`, `dm_notify_clear`) VALUES
(1, 1, 2, 3, '2023-07-06', '12:45 PM', 1, '', '450', '64a66afc5c8f31', 1, '2023-07-06 12:50:36', '2023-07-06 12:49:24', 0, 0, 'cus_ODCuvv0yNkDctZ', 5, '2023-07-06 12:50:36', '', '', '450', 'usd', 'pi_3NQmTzECBZEQ4z2N0LrAbs0P', 'succeeded', '', '', '', '', '', 0, '', ''),
(4, 1, 2, 1, '2023-07-06', '05:15 PM', 1, '', '150', '64a6a334c9a094', 1, '2023-07-06 16:50:20', '2023-07-06 16:49:16', 0, 0, 'cus_ODGlSD0mAcnlvJ', 2, '2023-07-06 16:50:20', '', '', '150', 'usd', 'pi_3NQqDsECBZEQ4z2N1VmAFAgb', 'succeeded', '', '', '', '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `expert_call_minute`
--

CREATE TABLE `expert_call_minute` (
  `cm_id` int(11) NOT NULL,
  `minute` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expert_call_minute`
--

INSERT INTO `expert_call_minute` (`cm_id`, `minute`, `status`, `created_date`) VALUES
(1, 'Quick - 15 Min', 'active', '2023-06-23 15:28:13'),
(2, 'Regular - 30 Min', 'active', '2023-06-23 15:28:13'),
(3, 'Extra - 45 Min', 'active', '2023-06-23 15:28:13'),
(4, 'All Access - 60 Min', 'active', '2023-06-23 15:28:13'),
(5, 'VIP - 75 Min', 'active', '2023-06-23 15:28:13'),
(6, 'Bonus - 90 Min', 'active', '2023-06-23 15:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `expert_call_rate`
--

CREATE TABLE `expert_call_rate` (
  `cr_id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `cm_id` int(11) NOT NULL,
  `call_rate` text NOT NULL,
  `stripe_product_id` text NOT NULL,
  `stripe_price_id` text NOT NULL,
  `pack_name` text NOT NULL,
  `coupon_pack` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expert_call_rate`
--

INSERT INTO `expert_call_rate` (`cr_id`, `expert_id`, `cm_id`, `call_rate`, `stripe_product_id`, `stripe_price_id`, `pack_name`, `coupon_pack`, `status`, `created_date`) VALUES
(1, 2, 2, '300', 'prod_O9qlD59qQ3Qp8o', 'price_1NQlhtECBZEQ4z2NeKDMbKXu', 'Decision Maker (Afrin Sayed) Regular - 30 Min', 'no', 'active', '2023-07-06 02:30:26'),
(2, 2, 1, '150', 'prod_O9qloxwnS5Yd2X', 'price_1NNX3yECBZEQ4z2N4omwH3xT', 'Decision Maker (Afrin Sayed) Quick - 15 Min', 'no', 'active', '2023-07-06 02:30:24'),
(5, 2, 3, '450', 'prod_ODC6juAMn4KPLt', 'price_1NQlhuECBZEQ4z2NwMAzQy5K', 'Decision Maker (Afrin Sayed) Extra - 45 Min', 'no', 'active', '2023-07-06 02:30:26'),
(6, 2, 4, '500', 'prod_ODC6tK5XL4EEVY', 'price_1NQlhvECBZEQ4z2NYJn0Z0z6', 'Decision Maker (Afrin Sayed) All Access - 60 Min', 'no', 'active', '2023-07-06 02:30:27'),
(7, 2, 5, '1000', 'prod_ODC6MVHTiNG7Ho', 'price_1NQlhwECBZEQ4z2NUz1Qeyfb', 'Decision Maker (Afrin Sayed) VIP - 75 Min', 'no', 'active', '2023-07-06 02:30:28'),
(8, 2, 6, '1500', 'prod_ODC6kwmPnE9uSu', 'price_1NQlhxECBZEQ4z2NgFBxqxvX', 'Decision Maker (Afrin Sayed) Bonus - 90 Min', 'no', 'active', '2023-07-06 02:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `expert_phone_numbers`
--

CREATE TABLE `expert_phone_numbers` (
  `pid` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `phone_number` text NOT NULL,
  `otp` text NOT NULL,
  `expert_session_id` text NOT NULL,
  `verified_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expert_phone_numbers`
--

INSERT INTO `expert_phone_numbers` (`pid`, `student_id`, `phone_number`, `otp`, `expert_session_id`, `verified_on`) VALUES
(1, 2, '+919657278655', '659478', '215de50a-3723-481b-979d-f05ba0b59398', '2023-06-15 04:30:53'),
(2, 2, '+919657278655', '855915', '1aa1c05f-78e7-47ac-b62c-37deec4b1137', '2023-06-19 18:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `file_preview_access`
--

CREATE TABLE `file_preview_access` (
  `fpid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `req_by` int(11) NOT NULL,
  `req_status` varchar(30) NOT NULL,
  `req_date` date NOT NULL,
  `req_accept_date` date NOT NULL,
  `req_notify` varchar(30) NOT NULL,
  `req_notify_clear` varchar(30) NOT NULL,
  `res_notify` varchar(30) NOT NULL,
  `res_notify_clear` varchar(30) NOT NULL,
  `res_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file_preview_access`
--

INSERT INTO `file_preview_access` (`fpid`, `pid`, `req_by`, `req_status`, `req_date`, `req_accept_date`, `req_notify`, `req_notify_clear`, `res_notify`, `res_notify_clear`, `res_date`) VALUES
(1, 1, 399, 'accepted', '2023-07-11', '2023-07-11', 'seen', 'yes', 'seen', 'yes', '2023-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `gid` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `gname` text NOT NULL,
  `gdes` text NOT NULL,
  `gdept` int(11) NOT NULL,
  `gstart_date` date NOT NULL,
  `gend_date` date NOT NULL,
  `gmanager` int(11) NOT NULL,
  `gcreated_by` int(11) NOT NULL,
  `gcreated_date` date NOT NULL,
  `g_trash` varchar(30) NOT NULL,
  `g_trash_date` text NOT NULL,
  `gsingle_trash` varchar(50) NOT NULL,
  `g_archive` varchar(50) NOT NULL,
  `g_archive_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `g_file_it` varchar(50) NOT NULL,
  `g_file_it_date` datetime NOT NULL,
  `corporate_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`gid`, `portfolio_id`, `gname`, `gdes`, `gdept`, `gstart_date`, `gend_date`, `gmanager`, `gcreated_by`, `gcreated_date`, `g_trash`, `g_trash_date`, `gsingle_trash`, `g_archive`, `g_archive_date`, `reg_acc_status`, `g_file_it`, `g_file_it_date`, `corporate_id`) VALUES
(1, 1, 'july goal', '', 3, '2023-07-01', '2023-07-31', 398, 1, '2023-06-15', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(2, 1, 'aug goal', '', 3, '2023-08-01', '2023-08-31', 0, 1, '2023-06-19', '', '', '', '', '', '', 'yes', '2023-06-23 03:52:02', 'web305'),
(3, 1, 'test goal', '', 3, '2023-06-21', '2023-06-30', 0, 399, '2023-06-21', '', '', '', '', '', '', 'yes', '2023-06-23 02:25:28', 'web305'),
(4, 1, 'aug goal', '', 3, '2023-08-01', '2023-08-31', 0, 1, '2023-06-26', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(5, 1, 'test', '', 2, '2023-07-05', '2023-07-20', 0, 399, '2023-07-05', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305');

-- --------------------------------------------------------

--
-- Table structure for table `goals_invited_members`
--

CREATE TABLE `goals_invited_members` (
  `igm_id` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `sent_from` int(11) NOT NULL,
  `sent_to` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_notify` varchar(50) NOT NULL,
  `status_notify_clear` varchar(50) NOT NULL,
  `invite_date` datetime NOT NULL,
  `accept_date` datetime NOT NULL,
  `g_trash` varchar(30) NOT NULL,
  `g_trash_date` text NOT NULL,
  `g_archive` varchar(50) NOT NULL,
  `g_archive_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `g_file_it` varchar(50) NOT NULL,
  `g_file_it_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `goals_members`
--

CREATE TABLE `goals_members` (
  `gmid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `gmember` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `gcreated_by` int(11) NOT NULL,
  `sent_date` datetime NOT NULL,
  `sent_notify_clear` varchar(50) NOT NULL,
  `status_date` datetime NOT NULL,
  `status_notify` varchar(50) NOT NULL,
  `status_notify_clear` varchar(50) NOT NULL,
  `g_trash` varchar(30) NOT NULL,
  `g_trash_date` text NOT NULL,
  `g_archive` varchar(50) NOT NULL,
  `g_archive_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `g_file_it` varchar(50) NOT NULL,
  `g_file_it_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goals_members`
--

INSERT INTO `goals_members` (`gmid`, `gid`, `portfolio_id`, `gmember`, `status`, `gcreated_by`, `sent_date`, `sent_notify_clear`, `status_date`, `status_notify`, `status_notify_clear`, `g_trash`, `g_trash_date`, `g_archive`, `g_archive_date`, `reg_acc_status`, `g_file_it`, `g_file_it_date`) VALUES
(1, 1, 1, '1', 'accepted', 1, '2023-06-15 08:24:18', 'yes', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(2, 1, 1, '398', 'accepted', 1, '2023-06-16 08:33:39', 'no', '2023-06-16 08:33:47', 'yes', 'no', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(3, 1, 1, '399', 'accepted', 1, '2023-06-19 02:09:08', 'yes', '2023-06-19 02:09:30', 'yes', 'no', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(4, 3, 1, '399', 'accepted', 399, '2023-06-21 01:15:34', 'yes', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(5, 3, 1, '1', 'send', 399, '2023-06-21 01:15:34', 'yes', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(6, 2, 1, '399', 'send', 1, '2023-06-21 01:54:31', 'yes', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(7, 4, 1, '399', 'accepted', 1, '2023-06-26 03:30:10', 'yes', '2023-06-26 06:48:20', 'yes', 'no', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(8, 5, 1, '399', 'accepted', 399, '2023-07-05 05:50:59', 'yes', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(9, 5, 1, '1', 'send', 399, '2023-07-05 05:51:15', 'yes', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `goals_suggested_members`
--

CREATE TABLE `goals_suggested_members` (
  `gs_id` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `suggest_id` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `already_register` varchar(50) NOT NULL,
  `suggested_by` int(11) NOT NULL,
  `suggested_date` datetime NOT NULL,
  `approve_date` datetime NOT NULL,
  `g_trash` varchar(30) NOT NULL,
  `g_trash_date` text NOT NULL,
  `g_archive` varchar(50) NOT NULL,
  `g_archive_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `g_file_it` varchar(50) NOT NULL,
  `g_file_it_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group_chat`
--

CREATE TABLE `group_chat` (
  `chat_id` int(11) NOT NULL,
  `gc_id` int(11) NOT NULL,
  `g_name` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `message` text COLLATE utf8mb4_bin NOT NULL,
  `chat_attachment` text COLLATE utf8mb4_bin NOT NULL,
  `msg_sent_by` int(11) NOT NULL,
  `msg_forward` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `msg_status` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `member_status` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `msg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `group_create`
--

CREATE TABLE `group_create` (
  `id` int(11) NOT NULL,
  `g_pic` varchar(300) NOT NULL,
  `g_name` varchar(300) NOT NULL,
  `g_des` varchar(500) NOT NULL,
  `g_members` varchar(500) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `delete_group` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group_msg`
--

CREATE TABLE `group_msg` (
  `id` int(11) NOT NULL,
  `gc_id` int(11) NOT NULL,
  `gr_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `gc_members` int(11) NOT NULL,
  `msg_status` varchar(100) NOT NULL,
  `read_yes` varchar(50) NOT NULL,
  `msg_read_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group_request`
--

CREATE TABLE `group_request` (
  `id` int(11) NOT NULL,
  `gc_id` int(11) NOT NULL,
  `gc_name` varchar(300) NOT NULL,
  `gc_members` varchar(500) NOT NULL,
  `request` varchar(200) NOT NULL,
  `a_r_date` datetime NOT NULL,
  `sent_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `notification` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hear_from`
--

CREATE TABLE `hear_from` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hear_from`
--

INSERT INTO `hear_from` (`id`, `name`, `status`, `date`) VALUES
(1, 'Magazine Ad', 'active', '2021-04-29 10:33:59'),
(2, 'E - News Letter', 'active', '2021-04-29 10:33:59'),
(3, 'Google', 'active', '2021-04-29 10:33:59'),
(4, 'Social Media', 'active', '2021-04-29 10:33:59'),
(5, 'Friend referral', 'active', '2021-04-29 10:33:59'),
(6, 'University referral', 'active', '2021-04-29 10:33:59'),
(7, 'Other', 'active', '2021-04-29 10:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `invited_supporter`
--

CREATE TABLE `invited_supporter` (
  `invite_id` int(11) NOT NULL,
  `email_address` text NOT NULL,
  `sent_on` datetime NOT NULL,
  `approve` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `names` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `names`, `status`, `date`) VALUES
(1, 'Study Allocator', 'active', '2021-04-05 20:10:26'),
(2, 'Scheduler', 'active', '2021-04-05 20:10:26'),
(3, 'CV Builder', 'active', '2021-04-05 20:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `motivator`
--

CREATE TABLE `motivator` (
  `id` int(11) NOT NULL,
  `quote` text NOT NULL,
  `writer` text NOT NULL,
  `qcreated_by` int(11) NOT NULL,
  `qcreated_date` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_date` text NOT NULL,
  `qnotify` varchar(50) NOT NULL,
  `qnotify_clear` varchar(50) NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `motivator`
--

INSERT INTO `motivator` (`id`, `quote`, `writer`, `qcreated_by`, `qcreated_date`, `status`, `status_date`, `qnotify`, `qnotify_clear`, `reg_acc_status`) VALUES
(1, 'We cannot solve our problems with the kind of thinking we employed when we came up with them.', 'Albert Einstein', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(2, 'The bad news is time flies. The good news is you\'re the pilot.', 'Michael Altshuler', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(3, 'Live as if you were to die tomorrow. Learn as if you were to live forever.', 'Mahatma Gandhi', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(4, 'Keep away from people who try to belittle your ambitions. Small people always do that, but the really great make you feel that you, too, can become great.', 'Mark Twain', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(5, 'When you give joy to other people, you get more joy in return. You should give a good thought to happiness that you can give out.', 'Eleanor Roosevelt', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(6, 'Change your thoughts and you change your world.', 'Norman Vincent Peale', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(7, 'Our lives improve only when we take chances - and the first and most difficult risk we can take is to be honest with ourselves.', 'Walter Anderson', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(8, 'Nature has given us all the pieces required to achieve exceptional wellness and health but has left it to us to put these pieces together.', 'Diane McLaren', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(9, 'Success is not final; failure is not fatal: It is the courage to continue that counts.', 'Winston S. Churchill', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(10, 'It is better to fail in originality than to succeed in imitation. He who has never failed somewhere: that man cannot be great. Failure is the true test of greatness.', 'Herman Melville', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(11, 'The road to success and the road to failure are almost exactly the same.', 'Colin R. Davis', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(12, 'Success usually comes to those who are too busy to be looking for it.', 'Henry David Thoreau', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(13, 'Develop success from failures. Discouragement and failure are two of the surest stepping stones to success.', 'Dale Carnegie', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(14, 'Nothing in the world can take the place of Persistence. Talent will not; nothing is more common than unsuccessful men with talent. Genius will not; unrewarded genius is almost a proverb. Education will not; the world is full of educated derelicts. The slogan \'Press On\' has solved and always will solve the problems of the human race.', 'Calvin Coolidge', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(15, 'There are three ways to ultimate success: The first way is to be kind. The second way is to be kind. The third way is to be kind.', 'Mister Rogers', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(16, 'Success is peace of mind which is a direct result of self-satisfaction in knowing you did your best to become the best you are capable of becoming.', 'John Wooden', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(17, 'I never dreamed about success. I worked for it.', 'Estée Lauder', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(18, 'Success is getting what you want, happiness is wanting what you get.', 'Dale Carnegie', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(19, 'The pessimist sees difficulty in every opportunity. The optimist sees opportunity in every difficulty.', 'Winston Churchill', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(21, 'Don\'t promise more than you can deliver, don\'t deliver less than you promise.', 'Don Mahmood', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(22, 'The worst of enemies at one time were most probably the best of friends. Keep your friends close so you don’t have to worry about keeping your enemies closer.', 'Don Mahmood', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(23, 'Be ready for life before life forces you to be ready for it!', 'Don Mahmood', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(24, 'I need to convince myself everyday that I AM the best, because I know I’m not good enough.', 'Shah Rukh Khan', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(25, 'The decisions we make today, shape the \'us\' of tomorrow.', 'Don Mahmood', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(26, 'The only person you are destined to become is the person you decide to be.', 'Ralph Waldo Emerson', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(27, 'Genius is one percent inspiration and ninety-nine percent perspiration.', 'Thomas Edison', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(28, 'I have not failed. I\'ve just found 10,000 ways that won\'t work.', 'Thomas Edison', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(29, 'I\'ve learned that people will forget what you said, people will forget what you did, but people will never forget how you made them feel.', 'Maya Angelou', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(30, 'Most of the important things in the world have been accomplished by people who have kept on trying when there seemed to be no hope at all.', 'Dale Carnegie', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(31, 'He who is not courageous enough to take risks will accomplish nothing in life.', 'Muhammad Ali', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(32, 'Coming together is a beginning; keeping together is progress; working together is success.', 'Henry Ford', 0, '2022-01-31 11:25:53', 'approved', '2022-01-31 11:25:53', 'seen', 'yes', ''),
(34, 'If you don’t build your dream someone will hire you to help build theirs.', 'Tony Gaskins', 0, '2022-02-24 23:53:40', 'approved', '2022-02-24 23:53:40', 'seen', 'yes', ''),
(35, 'Success is getting what you want, and happiness is wanting what you get.', 'Dale Carnegie', 3, '2022-04-13 18:20:39', 'approved', '2022-04-14 09:17:03', 'seen', 'yes', ''),
(36, 'I don’t stop when I’m tired, I stop when I’m done.', 'David Coggins', 0, '2022-06-10 11:26:26', 'approved', '2022-06-10 11:26:26', 'seen', 'yes', ''),
(39, 'Geniuses are not born, they are made. Consistency is key to success.', 'anonymous', 321, '2022-10-20 06:14:37', 'approved', '2023-01-17 07:32:57', 'seen', 'yes', 'deactivated'),
(40, 'You lack nothing, use what God has given you', 'Naila', 321, '2022-10-21 06:32:49', 'denied', '2023-01-17 07:33:00', 'seen', 'yes', 'deactivated'),
(41, 'Starting a company is like staring into the abyss and eating glass.', 'Elon Musk', 0, '2023-01-17 07:34:07', 'approved', '2023-01-17 07:34:07', 'seen', 'yes', ''),
(42, 'Master life by embracing your authentic self and doing the work it takes to be the best version of you.', 'Laila Ali', 0, '2023-02-21 21:50:17', 'approved', '2023-02-21 21:50:17', 'seen', 'yes', ''),
(44, 'Creativity is seeing what others see and thinking what no one else ever thought.', 'Albert Einstein', 3, '2023-03-31 02:01:51', 'approved', '2023-03-31 02:02:31', 'seen', 'yes', ''),
(45, 'When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left, and could say, ‘I used everything You gave me.\'', 'Chadwick Boseman', 0, '2023-04-16 22:43:29', 'approved', '2023-04-16 22:43:29', 'seen', 'yes', '');

-- --------------------------------------------------------

--
-- Table structure for table `ost_api_key`
--

CREATE TABLE `ost_api_key` (
  `id` int(10) UNSIGNED NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT 1,
  `ipaddr` varchar(64) NOT NULL,
  `apikey` varchar(255) NOT NULL,
  `can_create_tickets` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `can_exec_cron` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `notes` text DEFAULT NULL,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_attachment`
--

CREATE TABLE `ost_attachment` (
  `id` int(10) UNSIGNED NOT NULL,
  `object_id` int(11) UNSIGNED NOT NULL,
  `type` char(1) NOT NULL,
  `file_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `inline` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `lang` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_attachment`
--

INSERT INTO `ost_attachment` (`id`, `object_id`, `type`, `file_id`, `name`, `inline`, `lang`) VALUES
(1, 1, 'C', 2, NULL, 0, NULL),
(2, 8, 'T', 1, NULL, 1, NULL),
(3, 9, 'T', 1, NULL, 1, NULL),
(4, 10, 'T', 1, NULL, 1, NULL),
(5, 11, 'T', 1, NULL, 1, NULL),
(6, 12, 'T', 1, NULL, 1, NULL),
(7, 13, 'T', 1, NULL, 1, NULL),
(8, 14, 'T', 1, NULL, 1, NULL),
(9, 16, 'T', 1, NULL, 1, NULL),
(10, 17, 'T', 1, NULL, 1, NULL),
(11, 18, 'T', 1, NULL, 1, NULL),
(12, 19, 'T', 1, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ost_canned_response`
--

CREATE TABLE `ost_canned_response` (
  `canned_id` int(10) UNSIGNED NOT NULL,
  `dept_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `isenabled` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL DEFAULT '',
  `response` text NOT NULL,
  `lang` varchar(16) NOT NULL DEFAULT 'en_US',
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_canned_response`
--

INSERT INTO `ost_canned_response` (`canned_id`, `dept_id`, `isenabled`, `title`, `response`, `lang`, `notes`, `created`, `updated`) VALUES
(1, 0, 1, 'What is osTicket (sample)?', 'osTicket is a widely-used open source support ticket system, an\nattractive alternative to higher-cost and complex customer support\nsystems - simple, lightweight, reliable, open source, web-based and easy\nto setup and use.', 'en_US', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(2, 0, 1, 'Sample (with variables)', 'Hi %{ticket.name.first},\n<br>\n<br>\nYour ticket #%{ticket.number} created on %{ticket.create_date} is in\n%{ticket.dept.name} department.', 'en_US', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_config`
--

CREATE TABLE `ost_config` (
  `id` int(11) UNSIGNED NOT NULL,
  `namespace` varchar(64) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_config`
--

INSERT INTO `ost_config` (`id`, `namespace`, `key`, `value`, `updated`) VALUES
(1, 'core', 'admin_email', 'don@z2squared.com', '2021-10-20 06:05:18'),
(2, 'core', 'helpdesk_url', 'https://app.decision168.com/support/', '2021-10-20 06:05:18'),
(3, 'core', 'helpdesk_title', 'Decision168', '2021-10-20 06:05:18'),
(4, 'core', 'schema_signature', 'add628927ee030469f5d3272ebda1e16', '2021-10-20 06:05:18'),
(5, 'schedule.1', 'configuration', '{\"holidays\":[4]}', '2021-10-20 06:05:18'),
(6, 'core', 'time_format', 'hh:mm a', '2021-10-20 06:05:18'),
(7, 'core', 'date_format', 'MM/dd/y', '2021-10-20 06:05:18'),
(8, 'core', 'datetime_format', 'MM/dd/y h:mm a', '2021-10-20 06:05:18'),
(9, 'core', 'daydatetime_format', 'EEE, MMM d y h:mm a', '2021-10-20 06:05:18'),
(10, 'core', 'default_priority_id', '2', '2021-10-20 06:05:18'),
(11, 'core', 'enable_daylight_saving', '', '2021-10-20 06:05:18'),
(12, 'core', 'reply_separator', '-- reply above this line --', '2021-10-20 06:05:18'),
(13, 'core', 'isonline', '1', '2021-10-20 06:05:18'),
(14, 'core', 'staff_ip_binding', '', '2021-10-20 06:05:18'),
(15, 'core', 'staff_max_logins', '4', '2021-10-20 06:05:18'),
(16, 'core', 'staff_login_timeout', '2', '2021-10-20 06:05:18'),
(17, 'core', 'staff_session_timeout', '30', '2021-10-20 06:05:18'),
(18, 'core', 'passwd_reset_period', '', '2021-10-20 06:05:18'),
(19, 'core', 'client_max_logins', '4', '2021-10-20 06:05:18'),
(20, 'core', 'client_login_timeout', '2', '2021-10-20 06:05:18'),
(21, 'core', 'client_session_timeout', '30', '2021-10-20 06:05:18'),
(22, 'core', 'max_page_size', '25', '2021-10-20 06:05:18'),
(23, 'core', 'max_open_tickets', '', '2021-10-20 06:05:18'),
(24, 'core', 'autolock_minutes', '3', '2021-10-20 06:05:18'),
(25, 'core', 'default_smtp_id', '', '2021-10-20 06:05:18'),
(26, 'core', 'use_email_priority', '', '2021-10-20 06:05:18'),
(27, 'core', 'enable_kb', '', '2021-10-20 06:05:18'),
(28, 'core', 'enable_premade', '1', '2021-10-20 06:05:18'),
(29, 'core', 'enable_captcha', '', '2021-10-20 06:05:18'),
(30, 'core', 'enable_auto_cron', '', '2021-10-20 06:05:18'),
(31, 'core', 'enable_mail_polling', '', '2021-10-20 06:05:18'),
(32, 'core', 'send_sys_errors', '1', '2021-10-20 06:05:18'),
(33, 'core', 'send_sql_errors', '1', '2021-10-20 06:05:18'),
(34, 'core', 'send_login_errors', '1', '2021-10-20 06:05:18'),
(35, 'core', 'save_email_headers', '1', '2021-10-20 06:05:18'),
(36, 'core', 'strip_quoted_reply', '1', '2021-10-20 06:05:18'),
(37, 'core', 'ticket_autoresponder', '', '2021-10-20 06:05:18'),
(38, 'core', 'message_autoresponder', '', '2021-10-20 06:05:18'),
(39, 'core', 'ticket_notice_active', '1', '2021-10-20 06:05:18'),
(40, 'core', 'ticket_alert_active', '1', '2021-10-20 06:05:18'),
(41, 'core', 'ticket_alert_admin', '1', '2021-10-20 06:05:18'),
(42, 'core', 'ticket_alert_dept_manager', '1', '2021-10-20 06:05:18'),
(43, 'core', 'ticket_alert_dept_members', '', '2021-10-20 06:05:18'),
(44, 'core', 'message_alert_active', '1', '2021-10-20 06:05:18'),
(45, 'core', 'message_alert_laststaff', '1', '2021-10-20 06:05:18'),
(46, 'core', 'message_alert_assigned', '1', '2021-10-20 06:05:18'),
(47, 'core', 'message_alert_dept_manager', '', '2021-10-20 06:05:18'),
(48, 'core', 'note_alert_active', '', '2021-10-20 06:05:18'),
(49, 'core', 'note_alert_laststaff', '1', '2021-10-20 06:05:18'),
(50, 'core', 'note_alert_assigned', '1', '2021-10-20 06:05:18'),
(51, 'core', 'note_alert_dept_manager', '', '2021-10-20 06:05:18'),
(52, 'core', 'transfer_alert_active', '', '2021-10-20 06:05:18'),
(53, 'core', 'transfer_alert_assigned', '', '2021-10-20 06:05:18'),
(54, 'core', 'transfer_alert_dept_manager', '1', '2021-10-20 06:05:18'),
(55, 'core', 'transfer_alert_dept_members', '', '2021-10-20 06:05:18'),
(56, 'core', 'overdue_alert_active', '1', '2021-10-20 06:05:18'),
(57, 'core', 'overdue_alert_assigned', '1', '2021-10-20 06:05:18'),
(58, 'core', 'overdue_alert_dept_manager', '1', '2021-10-20 06:05:18'),
(59, 'core', 'overdue_alert_dept_members', '', '2021-10-20 06:05:18'),
(60, 'core', 'assigned_alert_active', '1', '2021-10-20 06:05:18'),
(61, 'core', 'assigned_alert_staff', '1', '2021-10-20 06:05:18'),
(62, 'core', 'assigned_alert_team_lead', '', '2021-10-20 06:05:18'),
(63, 'core', 'assigned_alert_team_members', '', '2021-10-20 06:05:18'),
(64, 'core', 'auto_claim_tickets', '1', '2021-10-20 06:05:18'),
(65, 'core', 'auto_refer_closed', '1', '2021-10-20 06:05:18'),
(66, 'core', 'collaborator_ticket_visibility', '1', '2021-10-20 06:05:18'),
(67, 'core', 'require_topic_to_close', '', '2021-10-20 06:05:18'),
(68, 'core', 'show_related_tickets', '1', '2021-10-20 06:05:18'),
(69, 'core', 'show_assigned_tickets', '1', '2021-10-20 06:05:18'),
(70, 'core', 'show_answered_tickets', '', '2021-10-20 06:05:18'),
(71, 'core', 'hide_staff_name', '', '2021-10-20 06:05:18'),
(72, 'core', 'disable_agent_collabs', '', '2021-10-20 06:05:18'),
(73, 'core', 'overlimit_notice_active', '', '2021-10-20 06:05:18'),
(74, 'core', 'email_attachments', '1', '2021-10-20 06:05:18'),
(75, 'core', 'ticket_number_format', '######', '2021-10-20 06:05:18'),
(76, 'core', 'ticket_sequence_id', '', '2021-10-20 06:05:18'),
(77, 'core', 'queue_bucket_counts', '', '2021-10-20 06:05:18'),
(78, 'core', 'allow_external_images', '', '2021-10-20 06:05:18'),
(79, 'core', 'task_number_format', '#', '2021-10-20 06:05:18'),
(80, 'core', 'task_sequence_id', '2', '2021-10-20 06:05:18'),
(81, 'core', 'log_level', '2', '2021-10-20 06:05:18'),
(82, 'core', 'log_graceperiod', '12', '2021-10-20 06:05:18'),
(83, 'core', 'client_registration', 'public', '2021-10-20 06:05:18'),
(84, 'core', 'default_ticket_queue', '1', '2021-10-20 06:05:18'),
(85, 'core', 'embedded_domain_whitelist', 'youtube.com, dailymotion.com, vimeo.com, player.vimeo.com, web.microsoftstream.com', '2021-10-20 06:05:18'),
(86, 'core', 'max_file_size', '134217728', '2021-10-20 06:05:18'),
(87, 'core', 'landing_page_id', '1', '2021-10-20 06:05:18'),
(88, 'core', 'thank-you_page_id', '2', '2021-10-20 06:05:18'),
(89, 'core', 'offline_page_id', '3', '2021-10-20 06:05:18'),
(90, 'core', 'system_language', 'en_US', '2021-10-20 06:05:18'),
(91, 'mysqlsearch', 'reindex', '0', '2021-10-20 08:53:06'),
(92, 'core', 'default_email_id', '1', '2021-10-20 06:05:18'),
(93, 'core', 'alert_email_id', '2', '2021-10-20 06:05:18'),
(94, 'core', 'default_dept_id', '1', '2021-10-20 06:05:18'),
(95, 'core', 'default_sla_id', '1', '2021-10-20 06:05:18'),
(96, 'core', 'schedule_id', '1', '2021-10-20 06:05:18'),
(97, 'core', 'default_template_id', '1', '2021-10-20 06:05:18'),
(98, 'core', 'default_timezone', 'Asia/Kolkata', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_content`
--

CREATE TABLE `ost_content` (
  `id` int(10) UNSIGNED NOT NULL,
  `isactive` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `type` varchar(32) NOT NULL DEFAULT 'other',
  `name` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_content`
--

INSERT INTO `ost_content` (`id`, `isactive`, `type`, `name`, `body`, `notes`, `created`, `updated`) VALUES
(1, 1, 'landing', 'Landing', '<h1>Welcome to the Support Center</h1> <p> In order to streamline support requests and better serve you, we utilize a support ticket system. Every support request is assigned a unique ticket number which you can use to track the progress and responses online. For your reference we provide complete archives and history of all your support requests. A valid email address is required to submit a ticket. </p>', 'The Landing Page refers to the content of the Customer Portal\'s initial view. The template modifies the content seen above the two links <strong>Open a New Ticket</strong> and <strong>Check Ticket Status</strong>.', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(2, 1, 'thank-you', 'Thank You', '<div>%{ticket.name},\n<br>\n<br>\nThank you for contacting us.\n<br>\n<br>\nA support ticket request has been created and a representative will be\ngetting back to you shortly if necessary.</p>\n<br>\n<br>\nSupport Team\n</div>', 'This template defines the content displayed on the Thank-You page after a\nClient submits a new ticket in the Client Portal.', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(3, 1, 'offline', 'Offline', '<div><h1>\n<span style=\"font-size: medium\">Support Ticket System Offline</span>\n</h1>\n<p>Thank you for your interest in contacting us.</p>\n<p>Our helpdesk is offline at the moment, please check back at a later\ntime.</p>\n</div>', 'The Offline Page appears in the Customer Portal when the Help Desk is offline.', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(4, 1, 'registration-staff', 'Welcome to osTicket', '<h3><strong>Hi %{recipient.name.first},</strong></h3> <div> We\'ve created an account for you at our help desk at %{url}.<br /> <br /> Please follow the link below to confirm your account and gain access to your tickets.<br /> <br /> <a href=\"%{link}\">%{link}</a><br /> <br /> <em style=\"font-size: small\">Your friendly Customer Support System<br /> %{company.name}</em> </div>', 'This template defines the initial email (optional) sent to Agents when an account is created on their behalf.', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(5, 1, 'pwreset-staff', 'osTicket Staff Password Reset', '<h3><strong>Hi %{staff.name.first},</strong></h3> <div> A password reset request has been submitted on your behalf for the helpdesk at %{url}.<br /> <br /> If you feel that this has been done in error, delete and disregard this email. Your account is still secure and no one has been given access to it. It is not locked and your password has not been reset. Someone could have mistakenly entered your email address.<br /> <br /> Follow the link below to login to the help desk and change your password.<br /> <br /> <a href=\"%{link}\">%{link}</a><br /> <br /> <em style=\"font-size: small\">Your friendly Customer Support System</em> <br /> <img src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" alt=\"Powered by osTicket\" width=\"126\" height=\"19\" style=\"width: 126px\" /> </div>', 'This template defines the email sent to Staff who select the <strong>Forgot My Password</strong> link on the Staff Control Panel Log In page.', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(6, 1, 'banner-staff', 'Authentication Required', '', 'This is the initial message and banner shown on the Staff Log In page. The first input field refers to the red-formatted text that appears at the top. The latter textarea is for the banner content which should serve as a disclaimer.', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(7, 1, 'registration-client', 'Welcome to %{company.name}', '<h3><strong>Hi %{recipient.name.first},</strong></h3> <div> We\'ve created an account for you at our help desk at %{url}.<br /> <br /> Please follow the link below to confirm your account and gain access to your tickets.<br /> <br /> <a href=\"%{link}\">%{link}</a><br /> <br /> <em style=\"font-size: small\">Your friendly Customer Support System <br /> %{company.name}</em> </div>', 'This template defines the email sent to Clients when their account has been created in the Client Portal or by an Agent on their behalf. This email serves as an email address verification. Please use %{link} somewhere in the body.', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(8, 1, 'pwreset-client', '%{company.name} Help Desk Access', '<h3><strong>Hi %{user.name.first},</strong></h3> <div> A password reset request has been submitted on your behalf for the helpdesk at %{url}.<br /> <br /> If you feel that this has been done in error, delete and disregard this email. Your account is still secure and no one has been given access to it. It is not locked and your password has not been reset. Someone could have mistakenly entered your email address.<br /> <br /> Follow the link below to login to the help desk and change your password.<br /> <br /> <a href=\"%{link}\">%{link}</a><br /> <br /> <em style=\"font-size: small\">Your friendly Customer Support System <br /> %{company.name}</em> </div>', 'This template defines the email sent to Clients who select the <strong>Forgot My Password</strong> link on the Client Log In page.', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(9, 1, 'banner-client', 'Sign in to %{company.name}', 'To better serve you, we encourage our Clients to register for an account.', 'This composes the header on the Client Log In page. It can be useful to inform your Clients about your log in and registration policies.', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(10, 1, 'registration-confirm', 'Account registration', '<div><strong>Thanks for registering for an account.</strong><br/> <br /> We\'ve just sent you an email to the address you entered. Please follow the link in the email to confirm your account and gain access to your tickets. </div>', 'This templates defines the page shown to Clients after completing the registration form. The template should mention that the system is sending them an email confirmation link and what is the next step in the registration process.', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(11, 1, 'registration-thanks', 'Account Confirmed!', '<div> <strong>Thanks for registering for an account.</strong><br /> <br /> You\'ve confirmed your email address and successfully activated your account. You may proceed to open a new ticket or manage existing tickets.<br /> <br /> <em>Your friendly support center</em><br /> %{company.name} </div>', 'This template defines the content displayed after Clients successfully register by confirming their account. This page should inform the user that registration is complete and that the Client can now submit a ticket or access existing tickets.', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(12, 1, 'access-link', 'Ticket [#%{ticket.number}] Access Link', '<h3><strong>Hi %{recipient.name.first},</strong></h3> <div> An access link request for ticket #%{ticket.number} has been submitted on your behalf for the helpdesk at %{url}.<br /> <br /> Follow the link below to check the status of the ticket #%{ticket.number}.<br /> <br /> <a href=\"%{recipient.ticket_link}\">%{recipient.ticket_link}</a><br /> <br /> If you <strong>did not</strong> make the request, please delete and disregard this email. Your account is still secure and no one has been given access to the ticket. Someone could have mistakenly entered your email address.<br /> <br /> --<br /> %{company.name} </div>', 'This template defines the notification for Clients that an access link was sent to their email. The ticket number and email address trigger the access link.', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(13, 1, 'email2fa-staff', 'osTicket Two Factor Authentication', '<h3><strong>Hi %{staff.name.first},</strong></h3> <div> You have just logged into for the helpdesk at %{url}.<br /> <br /> Use the verification code below to finish logging into the helpdesk.<br /> <br /> %{otp}<br /> <br /> <em style=\"font-size: small\">Your friendly Customer Support System</em> <br /> <img src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" alt=\"Powered by osTicket\" width=\"126\" height=\"19\" style=\"width: 126px\" /> </div>', 'This template defines the email sent to Staff who use Email for Two Factor Authentication', '2021-10-20 06:05:18', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_department`
--

CREATE TABLE `ost_department` (
  `id` int(11) UNSIGNED NOT NULL,
  `pid` int(11) UNSIGNED DEFAULT NULL,
  `tpl_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sla_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `schedule_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `email_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `autoresp_email_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `manager_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(128) NOT NULL DEFAULT '',
  `signature` text NOT NULL,
  `ispublic` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `group_membership` tinyint(1) NOT NULL DEFAULT 0,
  `ticket_auto_response` tinyint(1) NOT NULL DEFAULT 1,
  `message_auto_response` tinyint(1) NOT NULL DEFAULT 0,
  `path` varchar(128) NOT NULL DEFAULT '/',
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_department`
--

INSERT INTO `ost_department` (`id`, `pid`, `tpl_id`, `sla_id`, `schedule_id`, `email_id`, `autoresp_email_id`, `manager_id`, `flags`, `name`, `signature`, `ispublic`, `group_membership`, `ticket_auto_response`, `message_auto_response`, `path`, `updated`, `created`) VALUES
(1, NULL, 0, 0, 0, 0, 0, 0, 4, 'Support', 'Support Department', 1, 1, 1, 1, '/1/', '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(3, NULL, 0, 0, 0, 0, 0, 0, 4, 'Maintenance', 'Maintenance Department', 1, 0, 1, 1, '/3/', '2021-10-20 06:05:15', '2021-10-20 06:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `ost_draft`
--

CREATE TABLE `ost_draft` (
  `id` int(11) UNSIGNED NOT NULL,
  `staff_id` int(11) UNSIGNED NOT NULL,
  `namespace` varchar(32) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `extra` text DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_email`
--

CREATE TABLE `ost_email` (
  `email_id` int(11) UNSIGNED NOT NULL,
  `noautoresp` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `priority_id` int(11) UNSIGNED NOT NULL DEFAULT 2,
  `dept_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `topic_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `userid` varchar(255) NOT NULL,
  `userpass` varchar(255) CHARACTER SET ascii NOT NULL,
  `mail_active` tinyint(1) NOT NULL DEFAULT 0,
  `mail_host` varchar(255) NOT NULL,
  `mail_protocol` enum('POP','IMAP') NOT NULL DEFAULT 'POP',
  `mail_encryption` enum('NONE','SSL') NOT NULL,
  `mail_folder` varchar(255) DEFAULT NULL,
  `mail_port` int(6) DEFAULT NULL,
  `mail_fetchfreq` tinyint(3) NOT NULL DEFAULT 5,
  `mail_fetchmax` tinyint(4) NOT NULL DEFAULT 30,
  `mail_archivefolder` varchar(255) DEFAULT NULL,
  `mail_delete` tinyint(1) NOT NULL DEFAULT 0,
  `mail_errors` tinyint(3) NOT NULL DEFAULT 0,
  `mail_lasterror` datetime DEFAULT NULL,
  `mail_lastfetch` datetime DEFAULT NULL,
  `smtp_active` tinyint(1) DEFAULT 0,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` int(6) DEFAULT NULL,
  `smtp_secure` tinyint(1) NOT NULL DEFAULT 1,
  `smtp_auth` tinyint(1) NOT NULL DEFAULT 1,
  `smtp_auth_creds` int(11) DEFAULT 0,
  `smtp_userid` varchar(255) NOT NULL,
  `smtp_userpass` varchar(255) CHARACTER SET ascii NOT NULL,
  `smtp_spoofing` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_email`
--

INSERT INTO `ost_email` (`email_id`, `noautoresp`, `priority_id`, `dept_id`, `topic_id`, `email`, `name`, `userid`, `userpass`, `mail_active`, `mail_host`, `mail_protocol`, `mail_encryption`, `mail_folder`, `mail_port`, `mail_fetchfreq`, `mail_fetchmax`, `mail_archivefolder`, `mail_delete`, `mail_errors`, `mail_lasterror`, `mail_lastfetch`, `smtp_active`, `smtp_host`, `smtp_port`, `smtp_secure`, `smtp_auth`, `smtp_auth_creds`, `smtp_userid`, `smtp_userpass`, `smtp_spoofing`, `notes`, `created`, `updated`) VALUES
(1, 0, 2, 1, 0, 'support@decision168.com', 'Support', '', '', 0, '', 'POP', 'NONE', NULL, NULL, 5, 30, NULL, 0, 0, NULL, NULL, 0, '', NULL, 1, 1, 0, '', '', 0, NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(2, 0, 2, 1, 0, 'alerts@decision168.com', 'osTicket Alerts', '', '', 0, '', 'POP', 'NONE', NULL, NULL, 5, 30, NULL, 0, 0, NULL, NULL, 0, '', NULL, 1, 1, 0, '', '', 0, NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(3, 0, 2, 1, 0, 'noreply@decision168.com', '', '', '', 0, '', 'POP', 'NONE', NULL, NULL, 5, 30, NULL, 0, 0, NULL, NULL, 0, '', NULL, 1, 1, 0, '', '', 0, NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_email_account`
--

CREATE TABLE `ost_email_account` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `protocol` varchar(64) NOT NULL DEFAULT '',
  `host` varchar(128) NOT NULL DEFAULT '',
  `port` int(11) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `options` varchar(512) DEFAULT NULL,
  `errors` int(11) UNSIGNED DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `lastconnect` timestamp NULL DEFAULT NULL,
  `lasterror` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_email_template`
--

CREATE TABLE `ost_email_template` (
  `id` int(11) UNSIGNED NOT NULL,
  `tpl_id` int(11) UNSIGNED NOT NULL,
  `code_name` varchar(32) NOT NULL,
  `subject` varchar(255) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_email_template`
--

INSERT INTO `ost_email_template` (`id`, `tpl_id`, `code_name`, `subject`, `body`, `notes`, `created`, `updated`) VALUES
(1, 1, 'ticket.autoresp', 'Support Ticket Opened [#%{ticket.number}]', '<h3><strong>Dear %{recipient.name.first},</strong></h3> <p>A request for support has been created and assigned #%{ticket.number}. A representative will follow-up with you as soon as possible. You can <a href=\"%%7Brecipient.ticket_link%7D\">view this ticket\'s progress online</a>. </p> <br /> <div style=\"color:rgb(127, 127, 127)\">Your %{company.name} Team, <br /> %{signature} </div> <hr /> <div style=\"color:rgb(127, 127, 127);font-size:small\"><em>If you wish to provide additional comments or information regarding the issue, please reply to this email or <a href=\"%%7Brecipient.ticket_link%7D\"><span style=\"color:rgb(84, 141, 212)\">login to your account</span></a> for a complete archive of your support requests.</em></div>', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(2, 1, 'ticket.autoreply', 'Re: %{ticket.subject} [#%{ticket.number}]', '<h3><strong>Dear %{recipient.name.first},</strong></h3> A request for support has been created and assigned ticket <a href=\"%%7Brecipient.ticket_link%7D\">#%{ticket.number}</a> with the following automatic reply <br /> <br /> Topic: <strong>%{ticket.topic.name}</strong> <br /> Subject: <strong>%{ticket.subject}</strong> <br /> <br /> %{response} <br /> <br /> <div style=\"color:rgb(127, 127, 127)\">Your %{company.name} Team,<br /> %{signature}</div> <hr /> <div style=\"color:rgb(127, 127, 127);font-size:small\"><em>We hope this response has sufficiently answered your questions. If you wish to provide additional comments or information, please reply to this email or <a href=\"%%7Brecipient.ticket_link%7D\"><span style=\"color:rgb(84, 141, 212)\">login to your account</span></a> for a complete archive of your support requests.</em></div>', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(3, 1, 'message.autoresp', 'Message Confirmation', '<h3><strong>Dear %{recipient.name.first},</strong></h3> Your reply to support request <a href=\"%%7Brecipient.ticket_link%7D\">#%{ticket.number}</a> has been noted <br /> <br /> <div style=\"color:rgb(127, 127, 127)\">Your %{company.name} Team,<br /> %{signature} </div> <hr /> <div style=\"color:rgb(127, 127, 127);font-size:small;text-align:center\"><em>You can view the support request progress <a href=\"%%7Brecipient.ticket_link%7D\">online here</a></em> </div>', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(4, 1, 'ticket.notice', '%{ticket.subject} [#%{ticket.number}]', '<h3><strong>Dear %{recipient.name.first},</strong></h3> Our customer care team has created a ticket, <a href=\"%%7Brecipient.ticket_link%7D\">#%{ticket.number}</a> on your behalf, with the following details and summary: <br /> <br /> Topic: <strong>%{ticket.topic.name}</strong> <br /> Subject: <strong>%{ticket.subject}</strong> <br /> <br /> %{message} <br /> <br /> %{response} <br /> <br /> If need be, a representative will follow-up with you as soon as possible. You can also <a href=\"%%7Brecipient.ticket_link%7D\">view this ticket\'s progress online</a>. <br /> <br /> <div style=\"color:rgb(127, 127, 127)\">Your %{company.name} Team,<br /> %{signature}</div> <hr /> <div style=\"color:rgb(127, 127, 127);font-size:small\"><em>If you wish to provide additional comments or information regarding the issue, please reply to this email or <a href=\"%%7Brecipient.ticket_link%7D\"><span style=\"color:rgb(84, 141, 212)\">login to your account</span></a> for a complete archive of your support requests.</em></div>', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(5, 1, 'ticket.overlimit', 'Open Tickets Limit Reached', '<h3><strong>Dear %{ticket.name.first},</strong></h3> You have reached the maximum number of open tickets allowed. To be able to open another ticket, one of your pending tickets must be closed. To update or add comments to an open ticket simply <a href=\"%%7Burl%7D/tickets.php?e=%%7Bticket.email%7D\">login to our helpdesk</a>. <br /> <br /> Thank you,<br /> Support Ticket System', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(6, 1, 'ticket.reply', 'Re: %{ticket.subject} [#%{ticket.number}]', '<h3><strong>Dear %{recipient.name.first},</strong></h3> %{response} <br /> <br /> <div style=\"color:rgb(127, 127, 127)\">Your %{company.name} Team,<br /> %{signature} </div> <hr /> <div style=\"color:rgb(127, 127, 127);font-size:small;text-align:center\"><em>We hope this response has sufficiently answered your questions. If not, please do not send another email. Instead, reply to this email or <a href=\"%%7Brecipient.ticket_link%7D\" style=\"color:rgb(84, 141, 212)\">login to your account</a> for a complete archive of all your support requests and responses.</em></div>', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(7, 1, 'ticket.activity.notice', 'Re: %{ticket.subject} [#%{ticket.number}]', '<h3><strong>Dear %{recipient.name.first},</strong></h3> <div><em>%{poster.name}</em> just logged a message to a ticket in which you participate. </div> <br /> %{message} <br /> <br /> <hr /> <div style=\"color:rgb(127, 127, 127);font-size:small;text-align:center\"><em>You\'re getting this email because you are a collaborator on ticket <a href=\"%%7Brecipient.ticket_link%7D\" style=\"color:rgb(84, 141, 212)\">#%{ticket.number}</a>. To participate, simply reply to this email or <a href=\"%%7Brecipient.ticket_link%7D\" style=\"color:rgb(84, 141, 212)\">click here</a> for a complete archive of the ticket thread.</em> </div>', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(8, 1, 'ticket.alert', 'New Ticket Alert', '<h2>Hi %{recipient.name},</h2> New ticket #%{ticket.number} created <br /> <br /> <table><tbody><tr><td><strong>From</strong>: </td> <td>%{ticket.name} </td> </tr> <tr><td><strong>Department</strong>: </td> <td>%{ticket.dept.name} </td> </tr> </tbody> </table> <br /> %{message} <br /> <br /> <hr /> <div>To view or respond to the ticket, please <a href=\"%%7Bticket.staff_link%7D\">login</a> to the support ticket system</div> <em style=\"font-size:small\">Your friendly Customer Support System</em> <br /> <a href=\"https://osticket.com/\"><img width=\"126\" height=\"19\" style=\"width:126px\" alt=\"Powered By osTicket\" src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" /></a>', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(9, 1, 'message.alert', 'New Message Alert', '<h3><strong>Hi %{recipient.name},</strong></h3> New message appended to ticket <a href=\"%%7Bticket.staff_link%7D\">#%{ticket.number}</a> <br /> <br /> <table><tbody><tr><td><strong>From</strong>: </td> <td>%{poster.name} </td> </tr> <tr><td><strong>Department</strong>: </td> <td>%{ticket.dept.name} </td> </tr> </tbody> </table> <br /> %{message} <br /> <br /> <hr /> <div>To view or respond to the ticket, please <a href=\"%%7Bticket.staff_link%7D\"><span style=\"color:rgb(84, 141, 212)\">login</span></a> to the support ticket system</div> <em style=\"color:rgb(127,127,127);font-size:small\">Your friendly Customer Support System</em><br /> <img src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" alt=\"Powered by osTicket\" width=\"126\" height=\"19\" style=\"width:126px\" />', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(10, 1, 'note.alert', 'New Internal Activity Alert', '<h3><strong>Hi %{recipient.name},</strong></h3> An agent has logged activity on ticket <a href=\"%%7Bticket.staff_link%7D\">#%{ticket.number}</a> <br /> <br /> <table><tbody><tr><td><strong>From</strong>: </td> <td>%{note.poster} </td> </tr> <tr><td><strong>Title</strong>: </td> <td>%{note.title} </td> </tr> </tbody> </table> <br /> %{note.message} <br /> <br /> <hr /> To view/respond to the ticket, please <a href=\"%%7Bticket.staff_link%7D\">login</a> to the support ticket system <br /> <br /> <em style=\"font-size:small\">Your friendly Customer Support System</em> <br /> <img src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" alt=\"Powered by osTicket\" width=\"126\" height=\"19\" style=\"width:126px\" />', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(11, 1, 'assigned.alert', 'Ticket Assigned to you', '<h3><strong>Hi %{assignee.name.first},</strong></h3> Ticket <a href=\"%%7Bticket.staff_link%7D\">#%{ticket.number}</a> has been assigned to you by %{assigner.name.short} <br /> <br /> <table><tbody><tr><td><strong>From</strong>: </td> <td>%{ticket.name} </td> </tr> <tr><td><strong>Subject</strong>: </td> <td>%{ticket.subject} </td> </tr> </tbody> </table> <br /> %{comments} <br /> <br /> <hr /> <div>To view/respond to the ticket, please <a href=\"%%7Bticket.staff_link%7D\"><span style=\"color:rgb(84, 141, 212)\">login</span></a> to the support ticket system</div> <em style=\"font-size:small\">Your friendly Customer Support System</em> <br /> <img src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" alt=\"Powered by osTicket\" width=\"126\" height=\"19\" style=\"width:126px\" />', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(12, 1, 'transfer.alert', 'Ticket #%{ticket.number} transfer - %{ticket.dept.name}', '<h3>Hi %{recipient.name},</h3> Ticket <a href=\"%%7Bticket.staff_link%7D\">#%{ticket.number}</a> has been transferred to the %{ticket.dept.name} department by <strong>%{staff.name.short}</strong> <br /> <br /> <blockquote>%{comments} </blockquote> <hr /> <div>To view or respond to the ticket, please <a href=\"%%7Bticket.staff_link%7D\">login</a> to the support ticket system. </div> <em style=\"font-size:small\">Your friendly Customer Support System</em> <br /> <a href=\"https://osticket.com/\"><img width=\"126\" height=\"19\" alt=\"Powered By osTicket\" style=\"width:126px\" src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" /></a>', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(13, 1, 'ticket.overdue', 'Stale Ticket Alert', '<h3><strong>Hi %{recipient.name}</strong>,</h3> A ticket, <a href=\"%%7Bticket.staff_link%7D\">#%{ticket.number}</a> is seriously overdue. <br /> <br /> We should all work hard to guarantee that all tickets are being addressed in a timely manner. <br /> <br /> Signed,<br /> %{ticket.dept.manager.name} <hr /> <div>To view or respond to the ticket, please <a href=\"%%7Bticket.staff_link%7D\"><span style=\"color:rgb(84, 141, 212)\">login</span></a> to the support ticket system. You\'re receiving this notice because the ticket is assigned directly to you or to a team or department of which you\'re a member.</div> <em style=\"font-size:small\">Your friendly <span style=\"font-size:smaller\">(although with limited patience)</span> Customer Support System</em><br /> <img src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" height=\"19\" alt=\"Powered by osTicket\" width=\"126\" style=\"width:126px\" />', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(14, 1, 'task.alert', 'New Task Alert', '<h2>Hi %{recipient.name},</h2> New task <a href=\"%%7Btask.staff_link%7D\">#%{task.number}</a> created <br /> <br /> <table><tbody><tr><td><strong>Department</strong>: </td> <td>%{task.dept.name} </td> </tr> </tbody> </table> <br /> %{task.description} <br /> <br /> <hr /> <div>To view or respond to the task, please <a href=\"%%7Btask.staff_link%7D\">login</a> to the support system</div> <em style=\"font-size:small\">Your friendly Customer Support System</em> <br /> <a href=\"https://osticket.com/\"><img width=\"126\" height=\"19\" style=\"width:126px\" alt=\"Powered By osTicket\" src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" /></a>', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(15, 1, 'task.activity.notice', 'Re: %{task.title} [#%{task.number}]', '<h3><strong>Dear %{recipient.name.first},</strong></h3> <div><em>%{poster.name}</em> just logged a message to a task in which you participate. </div> <br /> %{message} <br /> <br /> <hr /> <div style=\"color:rgb(127, 127, 127);font-size:small;text-align:center\"><em>You\'re getting this email because you are a collaborator on task #%{task.number}. To participate, simply reply to this email.</em> </div>', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(16, 1, 'task.activity.alert', 'Task Activity [#%{task.number}] - %{activity.title}', '<h3><strong>Hi %{recipient.name},</strong></h3> Task <a href=\"%%7Btask.staff_link%7D\">#%{task.number}</a> updated: %{activity.description} <br /> <br /> %{message} <br /> <br /> <hr /> <div>To view or respond to the task, please <a href=\"%%7Btask.staff_link%7D\"><span style=\"color:rgb(84, 141, 212)\">login</span></a> to the support system</div> <em style=\"color:rgb(127,127,127);font-size:small\">Your friendly Customer Support System</em><br /> <img src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" alt=\"Powered by osTicket\" width=\"126\" height=\"19\" style=\"width:126px\" />', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(17, 1, 'task.assignment.alert', 'Task Assigned to you', '<h3><strong>Hi %{assignee.name.first},</strong></h3> Task <a href=\"%%7Btask.staff_link%7D\">#%{task.number}</a> has been assigned to you by %{assigner.name.short} <br /> <br /> %{comments} <br /> <br /> <hr /> <div>To view/respond to the task, please <a href=\"%%7Btask.staff_link%7D\"><span style=\"color:rgb(84, 141, 212)\">login</span></a> to the support system</div> <em style=\"font-size:small\">Your friendly Customer Support System</em> <br /> <img src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" alt=\"Powered by osTicket\" width=\"126\" height=\"19\" style=\"width:126px\" />', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(18, 1, 'task.transfer.alert', 'Task #%{task.number} transfer - %{task.dept.name}', '<h3>Hi %{recipient.name},</h3> Task <a href=\"%%7Btask.staff_link%7D\">#%{task.number}</a> has been transferred to the %{task.dept.name} department by <strong>%{staff.name.short}</strong> <br /> <br /> <blockquote>%{comments} </blockquote> <hr /> <div>To view or respond to the task, please <a href=\"%%7Btask.staff_link%7D\">login</a> to the support system. </div> <em style=\"font-size:small\">Your friendly Customer Support System</em> <br /> <a href=\"https://osticket.com/\"><img width=\"126\" height=\"19\" alt=\"Powered By osTicket\" style=\"width:126px\" src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" /></a>', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(19, 1, 'task.overdue.alert', 'Stale Task Alert', '<h3><strong>Hi %{recipient.name}</strong>,</h3> A task, <a href=\"%%7Btask.staff_link%7D\">#%{task.number}</a> is seriously overdue. <br /> <br /> We should all work hard to guarantee that all tasks are being addressed in a timely manner. <br /> <br /> Signed,<br /> %{task.dept.manager.name} <hr /> <div>To view or respond to the task, please <a href=\"%%7Btask.staff_link%7D\"><span style=\"color:rgb(84, 141, 212)\">login</span></a> to the support system. You\'re receiving this notice because the task is assigned directly to you or to a team or department of which you\'re a member.</div> <em style=\"font-size:small\">Your friendly <span style=\"font-size:smaller\">(although with limited patience)</span> Customer Support System</em><br /> <img src=\"cid:b56944cb4722cc5cda9d1e23a3ea7fbc\" height=\"19\" alt=\"Powered by osTicket\" width=\"126\" style=\"width:126px\" />', NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_email_template_group`
--

CREATE TABLE `ost_email_template_group` (
  `tpl_id` int(11) NOT NULL,
  `isactive` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(32) NOT NULL DEFAULT '',
  `lang` varchar(16) NOT NULL DEFAULT 'en_US',
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_email_template_group`
--

INSERT INTO `ost_email_template_group` (`tpl_id`, `isactive`, `name`, `lang`, `notes`, `created`, `updated`) VALUES
(1, 1, 'osTicket Default Template (HTML)', 'en_US', 'Default osTicket templates', '2021-10-20 06:05:18', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_event`
--

CREATE TABLE `ost_event` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_event`
--

INSERT INTO `ost_event` (`id`, `name`, `description`) VALUES
(1, 'created', NULL),
(2, 'closed', NULL),
(3, 'reopened', NULL),
(4, 'assigned', NULL),
(5, 'released', NULL),
(6, 'transferred', NULL),
(7, 'referred', NULL),
(8, 'overdue', NULL),
(9, 'edited', NULL),
(10, 'viewed', NULL),
(11, 'error', NULL),
(12, 'collab', NULL),
(13, 'resent', NULL),
(14, 'deleted', NULL),
(15, 'merged', NULL),
(16, 'unlinked', NULL),
(17, 'linked', NULL),
(18, 'login', NULL),
(19, 'logout', NULL),
(20, 'message', NULL),
(21, 'note', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ost_faq`
--

CREATE TABLE `ost_faq` (
  `faq_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ispublished` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `keywords` tinytext DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_faq_category`
--

CREATE TABLE `ost_faq_category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category_pid` int(10) UNSIGNED DEFAULT NULL,
  `ispublic` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(125) DEFAULT NULL,
  `description` text NOT NULL,
  `notes` tinytext NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_faq_topic`
--

CREATE TABLE `ost_faq_topic` (
  `faq_id` int(10) UNSIGNED NOT NULL,
  `topic_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_file`
--

CREATE TABLE `ost_file` (
  `id` int(11) NOT NULL,
  `ft` char(1) NOT NULL DEFAULT 'T',
  `bk` char(1) NOT NULL DEFAULT 'D',
  `type` varchar(255) CHARACTER SET ascii NOT NULL DEFAULT '',
  `size` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `key` varchar(86) CHARACTER SET ascii NOT NULL,
  `signature` varchar(86) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `attrs` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_file`
--

INSERT INTO `ost_file` (`id`, `ft`, `bk`, `type`, `size`, `key`, `signature`, `name`, `attrs`, `created`) VALUES
(1, 'T', 'D', 'image/png', 9452, 'b56944cb4722cc5cda9d1e23a3ea7fbc', 'gjMyblHhAxCQvzLfPBW3EjMUY1AmQQmz', 'powered-by-osticket.png', NULL, '2021-10-20 06:05:18'),
(2, 'T', 'D', 'text/plain', 24, '4wpg5MWtx86n3ccfeGGNagoRoTDtol7o', 'MWtx86n3ccfeGGNafaacpitTxmJ4h3Ls', 'osTicket.txt', NULL, '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_file_chunk`
--

CREATE TABLE `ost_file_chunk` (
  `file_id` int(11) NOT NULL,
  `chunk_id` int(11) NOT NULL,
  `filedata` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_file_chunk`
--

INSERT INTO `ost_file_chunk` (`file_id`, `chunk_id`, `filedata`) VALUES
(1, 0, 0x89504e470d0a1a0a0000000d49484452000000da0000002808060000009847e4c900000a43694343504943432070726f66696c65000078da9d53775893f7163edff7650f5642d8f0b1976c81002223ac08c81059a21092006184101240c585880a561415119c4855c482d50a489d88e2a028b867418a885a8b555c38ee1fdca7b57d7aefededfbd7fbbce79ce7fcce79cf0f8011122691e6a26a003952853c3ad81f8f4f48c4c9bd80021548e0042010e6cbc26705c50000f00379787e74b03ffc01af6f00020070d52e2412c7e1ff83ba50265700209100e02212e70b01905200c82e54c81400c81800b053b3640a009400006c797c422200aa0d00ecf4493e0500d8a993dc1700d8a21ca908008d0100992847240240bb00605581522c02c0c200a0ac40222e04c0ae018059b632470280bd0500768e58900f4060008099422ccc0020380200431e13cd03204c03a030d2bfe0a95f7085b8480100c0cb95cd974bd23314b895d01a77f2f0e0e221e2c26cb142611729106609e4229c979b231348e7034cce0c00001af9d1c1fe383f90e7e6e4e1e666e76ceff4c5a2fe6bf06f223e21f1dffebc8c020400104ecfefda5fe5e5d60370c701b075bf6ba95b00da560068dff95d33db09a05a0ad07af98b7938fc401e9ea150c83c1d1c0a0b0bed2562a1bd30e38b3eff33e16fe08b7ef6fc401efedb7af000719a4099adc0a383fd71616e76ae528ee7cb0442316ef7e723fec7857ffd8e29d1e234b15c2c158af15889b850224dc779b952914421c995e212e97f32f11f96fd0993770d00ac864fc04eb607b5cb6cc07eee01028b0e58d27600407ef32d8c1a0b91001067343279f7000093bff98f402b0100cd97a4e30000bce8185ca894174cc608000044a0812ab041070cc114acc00e9cc11dbcc01702610644400c24c03c104206e4801c0aa11896411954c03ad804b5b0031aa0119ae110b4c131380de7e0125c81eb70170660189ec218bc86090441c8081361213a8811628ed822ce0817998e04226148349280a420e988145122c5c872a402a9426a915d4823f22d7214398d5c40fa90dbc820328afc8abc47319481b25103d4027540b9a81f1a8ac6a073d174340f5d8096a26bd11ab41e3d80b6a2a7d14be87574007d8a8e6380d1310e668cd9615c8c87456089581a26c71663e55835568f35631d583776151bc09e61ef0824028b8013ec085e8410c26c82909047584c5843a825ec23b412ba085709838431c2272293a84fb4257a12f9c478623ab1905846ac26ee211e219e255e270e135f9348240ec992e44e0a21259032490b496b48db482da453a43ed210699c4c26eb906dc9dee408b280ac209791b7900f904f92fbc9c3e4b7143ac588e24c09a22452a494124a35653fe504a59f324299a0aa51cda99ed408aa883a9f5a496da076502f5387a91334759a25cd9b1643cba42da3d5d09a696769f7682fe974ba09dd831e4597d097d26be807e9e7e983f4770c0d860d83c7486228196b197b19a718b7192f994ca605d39799c85430d7321b9967980f986f55582af62a7c1591ca12953a9556957e95e7aa545573553fd579aa0b54ab550fab5e567da64655b350e3a909d416abd5a91d55bba936aece5277528f50cf515fa3be5ffd82fa630db2868546a08648a35463b7c6198d2116c63265f15842d6725603eb2c6b984d625bb2f9ec4c7605fb1b762f7b4c534373aa66ac6691669de671cd010ec6b1e0f039d99c4ace21ce0dce7b2d032d3f2db1d66aad66ad7ead37da7adabeda62ed72ed16edebdaef75709d409d2c9df53a6d3af77509ba36ba51ba85badb75cfea3ed363eb79e909f5caf50ee9ddd147f56df4a3f517eaefd6efd11f373034083690196c313863f0cc9063e86b9869b8d1f084e1a811cb68ba91c468a3d149a327b826ee8767e33578173e66ac6f1c62ac34de65dc6b3c61626932dba4c4a4c5e4be29cd946b9a66bad1b4d374ccccc82cdcacd8acc9ec8e39d59c6b9e61bed9bcdbfc8d85a5459cc54a8b368bc796da967ccb05964d96f7ac98563e567956f556d7ac49d65ceb2ceb6dd6576c501b579b0c9b3a9bcbb6a8ad9badc4769b6ddf14e2148f29d229f5536eda31ecfcec0aec9aec06ed39f661f625f66df6cf1dcc1c121dd63b743b7c727475cc766c70bceba4e134c3a9c4a9c3e957671b67a1739df33517a64b90cb1297769717536da78aa76e9f7acb95e51aeebad2b5d3f5a39bbb9bdcadd96dd4ddcc3dc57dabfb4d2e9b1bc95dc33def41f4f0f758e271cce39da79ba7c2f390e72f5e765e595efbbd1e4fb39c269ed6306dc8dbc45be0bdcb7b603a3e3d65facee9033ec63e029f7a9f87bea6be22df3dbe237ed67e997e07fc9efb3bfacbfd8ff8bfe179f216f14e056001c101e501bd811a81b3036b031f049904a50735058d05bb062f0c3e15420c090d591f72936fc017f21bf96333dc672c9ad115ca089d155a1bfa30cc264c1ed6118e86cf08df107e6fa6f94ce9ccb60888e0476c88b81f69199917f97d14292a32aa2eea51b453747174f72cd6ace459fb67bd8ef18fa98cb93bdb6ab6727667ac6a6c526c63ec9bb880b8aab8817887f845f1971274132409ed89e4c4d8c43d89e37302e76c9a339ce49a54967463aee5dca2b917e6e9cecb9e773c593559907c3885981297b23fe5832042502f184fe5a76e4d1d13f2849b854f45bea28da251b1b7b84a3c92e69d5695f638dd3b7d43fa68864f4675c633094f522b79911992b923f34d5644d6deaccfd971d92d39949c949ca3520d6996b42bd730b728b74f662b2b930de479e66dca1b9387caf7e423f973f3db156c854cd1a3b452ae500e164c2fa82b785b185b78b848bd485ad433df66feeaf9230b82167cbd90b050b8b0b3d8b87859f1e022bf45bb16238b5317772e315d52ba647869f0d27dcb68cbb296fd50e2585255f26a79dcf28e5283d2a5a5432b82573495a994c9cb6eaef45ab9631561956455ef6a97d55b567f2a17955fac70aca8aef8b046b8e6e2574e5fd57cf5796ddadade4ab7caedeb48eba4eb6eacf759bfaf4abd6a41d5d086f00dad1bf18de51b5f6d4ade74a17a6af58ecdb4cdcacd03356135ed5bccb6acdbf2a136a3f67a9d7f5dcb56fdadabb7bed926dad6bfdd777bf30e831d153bdeef94ecbcb52b78576bbd457df56ed2ee82dd8f1a621bbabfe67eddb847774fc59e8f7ba57b07f645efeb6a746f6cdcafbfbfb2096d52368d1e483a70e59b806fda9bed9a77b5705a2a0ec241e5c127dfa67c7be350e8a1cec3dcc3cddf997fb7f508eb48792bd23abf75ac2da36da03da1bdefe88ca39d1d5e1d47beb7ff7eef31e36375c7358f579ea09d283df1f9e48293e3a764a79e9d4e3f3dd499dc79f74cfc996b5d515dbd6743cf9e3f1774ee4cb75ff7c9f3dee78f5df0bc70f422f762db25b74bad3dae3d477e70fde148af5b6feb65f7cbed573cae74f44deb3bd1efd37ffa6ac0d573d7f8d72e5d9f79bdefc6ec1bb76e26dd1cb825baf5f876f6ed17770aee4cdc5d7a8f78affcbedafdea07fa0fea7fb4feb165c06de0f860c060cfc3590fef0e09879efe94ffd387e1d247cc47d52346238d8f9d1f1f1b0d1abdf264ce93e1a7b2a713cfca7e56ff79eb73abe7dffde2fb4bcf58fcd8f00bf98bcfbfae79a9f372efaba9af3ac723c71fbcce793df1a6fcadcedb7defb8efbadfc7bd1f9928fc40fe50f3d1fa63c7a7d04ff73ee77cfefc2ff784f3fb803925110000001974455874536f6674776172650041646f626520496d616765526561647971c9653c0000032869545874584d4c3a636f6d2e61646f62652e786d7000000000003c3f787061636b657420626567696e3d22efbbbf222069643d2257354d304d7043656869487a7265537a4e54637a6b633964223f3e203c783a786d706d65746120786d6c6e733a783d2261646f62653a6e733a6d6574612f2220783a786d70746b3d2241646f626520584d5020436f726520352e362d633031342037392e3135363739372c20323031342f30382f32302d30393a35333a30322020202020202020223e203c7264663a52444620786d6c6e733a7264663d22687474703a2f2f7777772e77332e6f72672f313939392f30322f32322d7264662d73796e7461782d6e7323223e203c7264663a4465736372697074696f6e207264663a61626f75743d222220786d6c6e733a786d703d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f2220786d6c6e733a786d704d4d3d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f6d6d2f2220786d6c6e733a73745265663d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f73547970652f5265736f75726365526566232220786d703a43726561746f72546f6f6c3d2241646f62652050686f746f73686f70204343203230313420284d6163696e746f7368292220786d704d4d3a496e7374616e636549443d22786d702e6969643a36453243393544454136373331314534424443444446393146414639344441352220786d704d4d3a446f63756d656e7449443d22786d702e6469643a3645324339354446413637333131453442444344444639314641463934444135223e203c786d704d4d3a4465726976656446726f6d2073745265663a696e7374616e636549443d22786d702e6969643a4346413734453446413637313131453442444344444639314641463934444135222073745265663a646f63756d656e7449443d22786d702e6469643a4346413734453530413637313131453442444344444639314641463934444135222f3e203c2f7264663a4465736372697074696f6e3e203c2f7264663a5244463e203c2f783a786d706d6574613e203c3f787061636b657420656e643d2272223f3e8bfef6ca0000170b4944415478daec5d099c53d5d53f2f7b32c9646680617118905d3637d0cfad282aa82d0af6f3b3b62ef52bd6d685ba206eb54a15c1adf6538b52b4d53a564454a42c0565d132a86c82a0ac82ec8b0233ccc24c9297f7dd9bfc6f73e64e92c90c5071ccf9fd0e249397f7eebbf7fccff99f73efbb31860f1f4e593936a4da74d2d8eeef53b17f2f51c4fd5d6b7e4ba19385ee177a9bd0ed8d3e832534dfa4d2351ebafaad3cb2d92cb219cd636c6d59f3ceca11920b849e27f4c742af68f4b7a342f34c5ab8de4d3f9b12a4b0005d7301991447d63ebed7e2125a283457a85d680d22d2be26463405995d8dfeb63f4a4b44241bfa463e5902642d7d518a5a59a065e5bb29ad849e2a7480d0d384b617ea05e024bb89080d093d287495d0e94267093d90c1b9edf85f82b4a2d19451006dc65617ed2bb3538f76618a449b57c76781f6fd908e42af14fabf42bb65f89dde42af12ba4ce848a10bd21c9b23741803f3bb42c709fd6d4657921015003b74c8205f8ed9ec4096cdd19abf7884de2e74210cbf5b13ce2123e05ca1f7e37cc9e45788921c3af703d80d47b3a049b3b739e989d21c2aca8d36cb81c802adf94a6ba15385fe41e87147c04e1e018dbc00399da49b4542ef4d13b97e2d343fed999d16d57ee3a0498b7dd426b779e56559ead8fce504a16f0aed7584cf7b2e72bbbd426b01b8d6691c763f8a97fa1f4c471bb71db4d194b51e6a17c8022d2bdf1d9151e695a30032253ee47c99caef285ecd1c9b92df0aea58e88fc672b3e654d2cf52c7e62d922af6ff96ae2de3d152a1cb8556b1bfcb4249cb3a47ca54cc23fec93569fe1a0f4522061946f31d946c443be65c5fe470befd736aca64f19193f5427f227487d00e427f29f432e477dfc4efcf8abbf76094e6adf4d0a4955e9ab6d14d6e41218de63cac59cb3e86bc9e11a592eda79019f60aab6b74f54de64a7725f9bb9c3c2eff0fddc2c342bf04555c47f142493f11e7a6935d00cc6fc6d0f4e55e07fdf4a502ba654690262ef791d76191c76135efb1cd9af7b123d2a36f3e14a4903d4c5eabd1fe5d468e9edadf4a854e04008347b9f9e385be56871afaa22171232119c50e96dbe9c036173d58eaa7399b5c541532c8efb2a87bab08990263d1e68db32cd08e297a61086bb36cb4fa4031f5cfdf127b9da104845ea3fd4d4694a1145f62d5e62837fd39a1a312ad11912b274aabd67b68f1976eea901fa1055b5cf468690eb5f34763343127271eb14debfb31b68eb3cf3e3b6be1c7904c9bbf8cdedcdd8bfab7d824dc7cc67ef02c8a97dd95940178df20b66c10dae22834572ed31a416ad58808c2729de2e37372c914579db5c94d0b05d00c579472dd227ab5689eab3eb211ed3b99a75994e7aa8a17452c8f30de8c5cbe5c31ef62ef1f12ba04afe522e12784be91c178cbfcea75d04c59ccc8a37839df29b412f95e5b009b50f45856e70c820e4e58e1a5cdbb9d542822598fb689758bdf57906581760c8add885255d843353541f2d84399d04759363f91bdff40e8abda316b8456537c82399dc849ee0758cae8a3c42a907244ca2280f64ca18384ce8e013d2a401834e9ab3d4eca775a146a19891539be2570c9f6ca2561edf17e8fd079420f6581969598f8edb5b4a2a20d95ecec4bc33b7f4854eb6fe82b8329be1e51c95f11c5b874a1d4eb1489196349ec559ec8b142229456daaac856673e4cca761457a653e2319b7cf258bbb6ee70d1b0c979b4eda09d5a78a37252ad1dc527b723a0b029fd0bc5579a48aa5b20d48df6ca08bab109dd2823f23d4207328afb43a1dbb240cb4a4c2c11481c24cbddb528f11b149f074e29329aa9b027170fbf9be498ae1ab5d42f2acff027725a9f4b44dcfb561e9d2828dfd567098c1db2c59b107b80c650935d6159c720b96adf8a3d42b39d0a22347e6e80566e7752f7b691588e46f155ff72517315ce904a64e4dc041a7abef437147f22e079a13765a963568e8a14b8aae9fdbddde8e4e00eea259442fe5460cb038553f24fd03b5d4e4e79b15819de7a37e2b61e731cb4d17df302f4e4877e6a2fa8dfac0d6eaa0e1bb4b7d246c37ad7d0c80b2a880ec46696db89e6b48c3529d7dc459ee8a1454b7cf4d66a0f15b73415c808f91c01340d492ef2c2969478b6cddbc42e8c6ac0361b88a8474a8e475ff786d39891055a7a31601c4e78e3508ae33c38a6065efec82418369376d40468555911f50aec8d47b6e4f36a72deac2f5eef448ea58ba461dd539aa3db9a496dc2b74c9c951b1afb5e20669d9d5acb0286413336ba636b0f0f08a0e57b2c1a39a052dcb14057b55125a0b05ae464f3b7d718e3576df6866f9e9627724b8a1dc74af68af65530c33759dea7447e26172aaf07d8f2d1ff9587317effe985263d50483a09efc76581d6b0c8817e01b98f7cd46434c59f3ae6d287e2eb0adbe3987b8ed4c5a30254c7b92b68b22cf38b88d6397777aacd7ae4fc5800afbf04fdd2e5062d874b80cc4e2f52dbf0cdcfcccc0ddd332d488581682b9f61150b70796d762bd2ca67c9a7a537b7f24523f3b63ae9ea92022ab9f28004db12ea5a3b78f906d7ce817715c92a89af4b71a83857e05180cc0580c8b63c04f07b589e269dd2a39478505452cf3b50c49120fc239c979b9ab225c2b727ed19c8482fbc648196a22641f179a90ef83f999517a0b2e54c6ac8870b36e1903d22b2391ca174391a5fa8bb32491e24dbf500e94bed2cda2d22d96801b2179ef9672eddfe76b0b038dfbcc9618b3da8d99e5d4d562a17442d7ab263303a7ff27a3779dfc9a347cfaf282f793dbf7cd2a75e5bb9d3bab66361e41671813ed1ba516a8bd0c729be624497afd96b79839f4a40e3fdd66398e5a44b96b7a1a0a36c657f16680d4b84d1c50329a8e341786e19fd761f8d46380d934ab69d4277772a25476c5ecd96cc8b2af944fb4c56dcfe86aa20972951d378c0e631d74e1054f1376fe69dd12edf7cce65a753a256ec3e5e84d1c8fce807422f911a8ed2bdc707cd715345def6c53e3b2ddeee143431fa74aff6a111a66944c5e7938d3855947d271fd11922f44f42cf107a9d9623f19ccdc5de77a2f8960b76383bb984ec1f49ba463ec83a18d4b91011b312e3b080e24f103444e5e5b3729782d606e18cc653dd6df22ea6f814462125a638e48a9b49ac827922faba9386a78be18465db2a1c48e04e45c366a3027435c5e74b1623c1ae4c929b0c42e2e7c54517c13311e3d936500895a0cbfd248a1156373203f6e33b1edce81e50221931fac393c8b9a0f9e0f2c40ca115dab91e83d4055c7913a8d520e42816aa72ff22aa57b23e139d9583aadd7a16fa53f17d1b8b14ea7c3f419fc8364ea3f88a0c79ce8b700e3948ab9200a2ad8a1ec436c2310c8b361fcaa750d41e075a7d69cd220fa78db2523706c512259206de4fdee8c48dfbedd18b1f6b4355216a2f403631e0b27a09ca27f3895b847ea5e577d7a3fa375600715fae2bf67dea986f5e651834221436b6898ebdc2a80ff47384fe1db6f421c5d75c72e2ca6b9e4a4e02ad54f29724409351f74eaabfae53c9f9a0a5e9e6cc241b795a285f16f53aeb7be9c0e4130757012c94a40db7012f8310b975b9041a73d60e7886e7d1b07168e80fd817e682e7abd02e9fde7d099e8a8b1cec6728be625b1ad673f04c37e3fc5246a1e42baf251fa128c1df47c33822f03412a47281ea29da3556c218168236498fd91946f50d3aef200658523e39b1da513b4729dab412efefa6f813c05e96d34cc8b052c6238bccd32e637f1b05e02fc2a0f5c0352f64d4497a6639b92ce79be6087d4f672b3e7b38be06b2be7871ef2aeaeec06bb9825edf5a6035a2ca72b975c0dc751efabacaa016bee81d22924990cd455b7507548b5cb50ad1718cc8df66e5ba2de90ccfb5e2cdba2f49342538b47b30c63722572b6ba01fab01bc54858c47615fe9641302433ab6f6a80632d9c6e1b8df7600dd59ecf3b5c82dbba3df7bc0b6fa30c79f4eec3656fdf1c2e0fb2131fd9a798817019a020040814c469979e8401f3af63a78e6103aac2f2b459fc3ae752e5e0710663d300809b25718c85622628510a64bd01935ac3347a0ed8468741e0cb823c02bc1f5193e3f0bf7e0c7bd3d82f698308e7d309ece1974a0c9bcd710b4750dfe5688b6ca39ac298c6674d1bc7e3bbc9e579f395874c874c68a23290a364578fd3972a2f3e138b8bc1feb5f4b80cc1fa5671704e80e919715e644fb8a9cec06ac9abf2b09c8b8bc0a1b90ece15aadf4fe759aef2d40df47f0dd4ccaf2a9a2dd4d1ac8c2601fd2f15e4ef10d825e461008a5c8ab09c7ddc8decf60202314b8ce624ce54644da7e9478d68e40379f84d31f053ac9dbfe216cf23119c06c1a979527fe394070298b6203e1010650624ee65550aef371ace2acf701040bf1fe7480e838189d92229627aa0d5c2621c2aa05b2b7e3264f4747d78262de0b6e1d66605d0bca3012e7e8064e3d1c6d3f9112cf6bf5c2ebdb1958ef46243f1714b5b1320614fc62500a15b106c1d89570b6309819eb7bf5124541196f68bf8c7caeea64f9591eebb7452cc7716a51659830d7ed5460d2cb4b7c3462662e15e444c9668bf5878cda6fb3e89e4ed444f87fc381aad2fd3d6c2c75d98131b95ca3a48d957614df558b8bbcee50b09a77c042ae475ffb293117a700bb034e9f6fa9b00481a196a51043d8e712c47fc6e726d281fbd8e79781cd3c0150717eff36aaaeb29d636d5a989ec0e6623ec609945c04a35586f104a302ff82272018f879f83e21dcb646bee447b42c0705cd47e408b2ca4d4f16c966200fca017551e7ec0bc0d5e0fd6e78aaa9888aaa48f019724c173cdc348a3f662fe517a07152a683ea124acabf078dc9a41225650522a389c8328e1d73211cd6a78c21a81caf27f37ecbeb700d234a65110fe5b92b523d759dcbfa6d03a35e4abe821155927ca8b2ca46ef6f709343bcf60bfa28685f6f16493399cc5d0e70754234fb2bae712ea2d6431897028db6495bd9494d9b6754116d288bfc0446f287469c672f22ea5896b7ae41fff05d99af003323b0a82949ce3507e3ad72d801acc063d3a87dcaaae347dafb8540a90340511bbe7c00bac2450128884e919ee57794d8cca5150cfe7544ce4b0096fe68d42ae459aa43a5112e8331dbe0557258343c9e79a2c5cc903bb2c8f95f42bf40874431707e166d78de56cbdeaf03e8bb6708b4355a65f22b78d0e3e048b602cc27c3500d44e9beac9feb806c77ad9ffa04f6500719cdcc64f978ec3e5d68f716fcad428bb09bd50f47bcbed447afadf052b7c2887cc8d260fd9ce98f51ec8113ea0276f011a2dbd3a0c00f42bf86432c45eeb688524ff8672a03b5f72f36f2fb39a070aa382103c4ad8ce613ec94afa07122425a0c3435781d4832c5a2072d473aa09949383325a9bed524f1827c998b1b615919db190015013c1edcb4a45abd19c857b39bd80f301bec26aad1e6cf61546ecde055b9d8c3a2d35a749a9d1213a6657008aa1ad8d4690e2345bf998c46a836ce06fde90c2adb07ed5c0be7f36f17bead26482709903dd06336b96d2210c4b636a85710e9c61cdc4a561451530f712aeab2a862a793a62cf3519ba0a99e64b6b17bce34d2f07b72b2b11c08ca7521c6b21fe8d71046a16ea3a62de8b592cc17963761aeed4cadb89183ea376940e37b509e4ce996ae252490c206281dd0f42771fbb063b6800214c31b77609e946040f90c8835180809b40b1065f6c0b0d4e31a97b2c8f239c01566d5a3a19a975625f508aeafa2939d4d2896c3abfa71ce61f0faea7307bedf17f75180e8a8775ecb0c9377d20a1c525a30c7b28b45cd4fe0746e60c587c5e897b86559063dde6d2e15f9f7922706325faafd434e60c6ae8a2821966bc7fb4dd0c48dfb1d34759d9bba251ebc3429b18f48a65b1cf8d02f11aa3b191b01f5fd107d5c8cfe389b152ae458fc8cd4063d4d77680d1a740ad1135c2722dc0ac684ec5a7e1b4d33b513812d39d938da523889a41f0e67865f4075574e7fc0e634bab2ea939acfb99b356235cbf3545e520c63530f10560268a762e03e62002318e48fd8353aa12cfb77cc6354a7a8506d619dd70ff9a2fabc27a620fe0f45096530c35815d48e42498b46785c791dbe95c055ecf522ad38a1728e1fe3f55bfc8445de723a217f0b051d358864494196c768ed275a345774b0b681b6af67ce3413e986b2f676e43cc751fd5d882df4ff5c140706e2d8412812351560116d0e2caf09e79a8cc2899256a81afa5864afd12aa6e750628ef53ca61742252bfb23632e562aa0e911ed14508e1994982c56d59979283a8c00b04623227c4675378699c1aa6c2b0028bf96b4efc580f462f3149fb282cc6078da975052fd1237d59d150f2a29f92e5e5528e85c8ece9c8af73b0186b6e884ab50d0990083790305971e1ac01b0299eac7f1e8fc001c886acb1bec3899a7fd1ac704d01f1ff393dedd7901d9648551e665a99fae1e0c5af309c6454fc0b7fddb68c206752988d0d0eeb5b468bb33b6210e9b5b5355c427a8e15f8c198871fc1ba2f5c7282efd94524f0eaf42d1621cf2ba579b18d1b668efafd48b470dc84e14abd6c0299eceeee90e7c56a61546fc68ffc126445deef4ea453413206b8f12797f366877e2f517a03ddfe0c43f44a9bd279bb3b99575fc622de1547310fb984795b29479ad7988ac07603897a20cdf1dc73c850a612b56c20d68f73209f31f11789aab31d7d1964d41bc817997296cde6b24b8fcb3ac1c1d4891c3799937fc1cfd740da2956acb48f4012f362dd34ac075263c7d22a251c4956e407bb36af04b1ab52e60112d4eb1420605da86e99ad3ab687fb54d2f5e95829d5cdf80111531765302c32f474a509421bd360f23a2bda339b611193a4362fdb10bf6f080e6181e44c48d52dd5fcc398df886430d8bfe53555d5345343bbcf218d0421faa6faf22a228f907f8f7507829278ce503ccb570cab20f03d409de9dd39c7b01885012ef340509fee5302c17403a15d14c958d7f815c6a13d55ff0f96718f930388230ee63068b2221dceb2c783737aef11a0a149df09d64fb227e8168e083e793e7ba19f9de7e50953949b8fd2c4653e7d43b6b6d4046323f0a25fb357a7c3afab83568d044eddb43d87447c254455493e57d2dfecb717a1ce77b0aa5fb6949eeb31051bf330cfe23e6cc6474fe2dc621d91c4457440cd223772365261cb09a1af1c0514e44fb7781950c80dd946aed71b2a2d47b70a4a318061e076b9b08a7a3162bdc8f7b180f675a0bc7ab72d0a56c0cabc122fc6c8e6d246cdb702449123f8031bb603cc9f8cb3a2493ea07ec4269e6629642939d635d9acedd806b38718db0768d43946492579315e87855de0f27b91f799ebfc0a118aca0f05192e90e2e07883d6f0419858133b581568598202596fe7c46f5d73d8a56ca072bad9e18248b45275e391b4ff5374bed01cf4cf51c83e8bdb25a1b850e19e4c8abb349ce3478f88761b0cfc24195e13ecec4679dd08fb7b3b3be00605f0b631c073a1ac1980d46b42844e49d7e184033d1b73329b1be533ab8df205f3f08f0b580935ca84d29e8b4ee1938d67e782f03c6efc1c64621d5506ee97f702f07d8bde502d8250c685b70dd8b5865732cdabec491a20a6965904cd311981fc9440ef7814a4b4b728fd675944198294ac0772202f664b4b1fef2a5785eb618cce257c8fb0a700fd310c9e624b9c60044f728a22d8b5d069d5d14a2d33a86686bb99de76984fc6433febf15aa8ff12bf0ee3bd8df556efe340a4bc9b650280350c768fdebd70a3b5e061ebbc6b2942c075d7c9e018458becbabb105547709569ec6de760004bc10750baabf8fe0be9e625328c114d5d9965a3f3d0c6718607892dad1a135c04d59391a92835c53816c33a8653a59096ae6426ea976a14a3597730306fb7ad27f9d53d0c62e27d4d2259b6a68cc9c80005a3d5ff01aa2f3a598f66801606f06655b9ae2bacb29f123f132a76907b0ec039d9f4dc937d7998e625618f7f515ab844e4074f253fd5f195d8aebfd08ff7766154875cd994865a6e37f0b6dd0e9ffdb486b06205ab544dbbdf8ee2728989d838ab91f4e541ebb15e77c5f3be722b4eb564a4c8dc99469bef1f2cb2ff742688ca0911bb3b838e222a9c62fe12177c2fb7f9aecc0ebca4635e5fc7654212b51c1ad2f4193464f0fd298d21cea10349b439f1a70306a43950a4acc2736b8a3519a7ed40b377644332fd84235a8aad540db5a2070c9e3cbfe5f800100b3e0af98735d4afd0000000049454e44ae426082),
(2, 0, 0x43616e6e6564204174746163686d656e747320526f636b21);

-- --------------------------------------------------------

--
-- Table structure for table `ost_filter`
--

CREATE TABLE `ost_filter` (
  `id` int(11) UNSIGNED NOT NULL,
  `execorder` int(10) UNSIGNED NOT NULL DEFAULT 99,
  `isactive` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `flags` int(10) UNSIGNED DEFAULT 0,
  `status` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `match_all_rules` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `stop_onmatch` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `target` enum('Any','Web','Email','API') NOT NULL DEFAULT 'Any',
  `email_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(32) NOT NULL DEFAULT '',
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_filter`
--

INSERT INTO `ost_filter` (`id`, `execorder`, `isactive`, `flags`, `status`, `match_all_rules`, `stop_onmatch`, `target`, `email_id`, `name`, `notes`, `created`, `updated`) VALUES
(1, 99, 1, 0, 0, 0, 0, 'Email', 0, 'SYSTEM BAN LIST', 'Internal list for email banning. Do not remove', '2021-10-20 06:05:18', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_filter_action`
--

CREATE TABLE `ost_filter_action` (
  `id` int(11) UNSIGNED NOT NULL,
  `filter_id` int(10) UNSIGNED NOT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `type` varchar(24) NOT NULL,
  `configuration` text DEFAULT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_filter_rule`
--

CREATE TABLE `ost_filter_rule` (
  `id` int(11) UNSIGNED NOT NULL,
  `filter_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `what` varchar(32) NOT NULL,
  `how` enum('equal','not_equal','contains','dn_contain','starts','ends','match','not_match') NOT NULL,
  `val` varchar(255) NOT NULL,
  `isactive` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `notes` tinytext NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_form`
--

CREATE TABLE `ost_form` (
  `id` int(11) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(8) NOT NULL DEFAULT 'G',
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL,
  `instructions` varchar(512) DEFAULT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_form`
--

INSERT INTO `ost_form` (`id`, `pid`, `type`, `flags`, `title`, `instructions`, `name`, `notes`, `created`, `updated`) VALUES
(1, NULL, 'U', 1, 'Contact Information', NULL, '', NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(2, NULL, 'T', 1, 'Ticket Details', 'Please Describe Your Issue', '', 'This form will be attached to every ticket, regardless of its source.\nYou can add any fields to this form and they will be available to all\ntickets, and will be searchable with advanced search and filterable.', '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(3, NULL, 'C', 1, 'Company Information', 'Details available in email templates', '', NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(4, NULL, 'O', 1, 'Organization Information', 'Details on user organization', '', NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(5, NULL, 'A', 1, 'Task Details', 'Please Describe The Issue', '', 'This form is used to create a task.', '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(6, NULL, 'L1', 0, 'Ticket Status Properties', 'Properties that can be set on a ticket status.', '', NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `ost_form_entry`
--

CREATE TABLE `ost_form_entry` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_id` int(11) UNSIGNED NOT NULL,
  `object_id` int(11) UNSIGNED DEFAULT NULL,
  `object_type` char(1) NOT NULL DEFAULT 'T',
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `extra` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_form_entry`
--

INSERT INTO `ost_form_entry` (`id`, `form_id`, `object_id`, `object_type`, `sort`, `extra`, `created`, `updated`) VALUES
(1, 4, 1, 'O', 1, NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(2, 3, NULL, 'C', 1, NULL, '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(3, 1, 1, 'U', 1, NULL, '2021-10-20 06:05:19', '2021-10-20 06:05:19'),
(4, 2, 1, 'T', 0, '{\"disable\":[]}', '2021-10-20 06:05:19', '2021-10-20 06:05:19'),
(5, 1, 2, 'U', 1, NULL, '2021-10-20 08:54:16', '2021-10-20 08:54:16'),
(6, 2, 2, 'T', 0, '{\"disable\":[]}', '2021-10-20 08:56:00', '2021-10-20 08:56:00'),
(7, 2, 3, 'T', 0, '{\"disable\":[]}', '2021-10-20 11:45:25', '2021-10-20 11:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `ost_form_entry_values`
--

CREATE TABLE `ost_form_entry_values` (
  `entry_id` int(11) UNSIGNED NOT NULL,
  `field_id` int(11) UNSIGNED NOT NULL,
  `value` text DEFAULT NULL,
  `value_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_form_entry_values`
--

INSERT INTO `ost_form_entry_values` (`entry_id`, `field_id`, `value`, `value_id`) VALUES
(1, 28, '1120 5th Street\nAlexandria, LA 71301', NULL),
(1, 29, '3182903674', NULL),
(1, 30, 'https://osticket.com', NULL),
(1, 31, 'Not only do we develop the software, we also use it to manage support for osTicket. Let us help you quickly implement and leverage the full potential of osTicket\'s features and functionality. Contact us for professional support or visit our website for documentation and community support.', NULL),
(2, 23, 'Decision168', NULL),
(2, 24, NULL, NULL),
(2, 25, NULL, NULL),
(2, 26, NULL, NULL),
(3, 3, NULL, NULL),
(3, 4, NULL, NULL),
(4, 20, 'osTicket Installed!', NULL),
(4, 22, 'Normal', 2),
(5, 3, '777777X91', NULL),
(5, 4, NULL, NULL),
(6, 20, 'test first ticket', NULL),
(6, 22, 'Low', 1),
(7, 20, 'test feedback ticket', NULL),
(7, 22, 'Low', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ost_form_field`
--

CREATE TABLE `ost_form_field` (
  `id` int(11) UNSIGNED NOT NULL,
  `form_id` int(11) UNSIGNED NOT NULL,
  `flags` int(10) UNSIGNED DEFAULT 1,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `label` varchar(255) NOT NULL,
  `name` varchar(64) NOT NULL,
  `configuration` text DEFAULT NULL,
  `sort` int(11) UNSIGNED NOT NULL,
  `hint` varchar(512) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_form_field`
--

INSERT INTO `ost_form_field` (`id`, `form_id`, `flags`, `type`, `label`, `name`, `configuration`, `sort`, `hint`, `created`, `updated`) VALUES
(1, 1, 489395, 'text', 'Email Address', 'email', '{\"size\":40,\"length\":64,\"validator\":\"email\"}', 1, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(2, 1, 489395, 'text', 'Full Name', 'name', '{\"size\":40,\"length\":64}', 2, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(3, 1, 13057, 'phone', 'Phone Number', 'phone', NULL, 3, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(4, 1, 12289, 'memo', 'Internal Notes', 'notes', '{\"rows\":4,\"cols\":40}', 4, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(20, 2, 489265, 'text', 'Issue Summary', 'subject', '{\"size\":40,\"length\":50}', 1, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(21, 2, 480547, 'thread', 'Issue Details', 'message', NULL, 2, 'Details on the reason(s) for opening the ticket.', '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(22, 2, 274609, 'priority', 'Priority Level', 'priority', NULL, 3, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(23, 3, 291249, 'text', 'Company Name', 'name', '{\"size\":40,\"length\":64}', 1, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(24, 3, 274705, 'text', 'Website', 'website', '{\"size\":40,\"length\":64}', 2, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(25, 3, 274705, 'phone', 'Phone Number', 'phone', '{\"ext\":false}', 3, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(26, 3, 12545, 'memo', 'Address', 'address', '{\"rows\":2,\"cols\":40,\"html\":false,\"length\":100}', 4, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(27, 4, 489395, 'text', 'Name', 'name', '{\"size\":40,\"length\":64}', 1, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(28, 4, 13057, 'memo', 'Address', 'address', '{\"rows\":2,\"cols\":40,\"length\":100,\"html\":false}', 2, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(29, 4, 13057, 'phone', 'Phone', 'phone', NULL, 3, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(30, 4, 13057, 'text', 'Website', 'website', '{\"size\":40,\"length\":0}', 4, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(31, 4, 12289, 'memo', 'Internal Notes', 'notes', '{\"rows\":4,\"cols\":40}', 5, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(32, 5, 487601, 'text', 'Title', 'title', '{\"size\":40,\"length\":50}', 1, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(33, 5, 413939, 'thread', 'Description', 'description', NULL, 2, 'Details on the reason(s) for creating the task.', '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(34, 6, 487665, 'state', 'State', 'state', '{\"prompt\":\"State of a ticket\"}', 1, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(35, 6, 471073, 'memo', 'Description', 'description', '{\"rows\":\"2\",\"cols\":\"40\",\"html\":\"\",\"length\":\"100\"}', 3, NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `ost_group`
--

CREATE TABLE `ost_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL,
  `flags` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(120) NOT NULL DEFAULT '',
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_help_topic`
--

CREATE TABLE `ost_help_topic` (
  `topic_id` int(11) UNSIGNED NOT NULL,
  `topic_pid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ispublic` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `noautoresp` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `flags` int(10) UNSIGNED DEFAULT 0,
  `status_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `priority_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `dept_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `staff_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `team_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sla_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `page_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sequence_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `topic` varchar(32) NOT NULL DEFAULT '',
  `number_format` varchar(32) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_help_topic`
--

INSERT INTO `ost_help_topic` (`topic_id`, `topic_pid`, `ispublic`, `noautoresp`, `flags`, `status_id`, `priority_id`, `dept_id`, `staff_id`, `team_id`, `sla_id`, `page_id`, `sequence_id`, `sort`, `topic`, `number_format`, `notes`, `created`, `updated`) VALUES
(1, 0, 1, 0, 2, 0, 2, 0, 0, 0, 0, 0, 0, 1, 'General Inquiry', NULL, 'Questions about products or services', '2021-10-20 06:05:15', '2021-10-20 06:05:15'),
(2, 0, 1, 0, 2, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'Feedback', NULL, 'Tickets that primarily concern the sales and billing departments', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(10, 0, 1, 0, 2, 0, 2, 3, 0, 0, 0, 0, 0, 0, 'Report a Problem', NULL, 'Product, service, or equipment related issues', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(11, 10, 1, 0, 2, 0, 3, 0, 0, 0, 1, 0, 0, 1, 'Access Issue', NULL, 'Report an inability access a physical or virtual asset', '2021-10-20 06:05:18', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_help_topic_form`
--

CREATE TABLE `ost_help_topic_form` (
  `id` int(11) UNSIGNED NOT NULL,
  `topic_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `form_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `extra` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_help_topic_form`
--

INSERT INTO `ost_help_topic_form` (`id`, `topic_id`, `form_id`, `sort`, `extra`) VALUES
(1, 1, 2, 1, '{\"disable\":[]}'),
(2, 2, 2, 1, '{\"disable\":[]}'),
(3, 10, 2, 1, '{\"disable\":[]}'),
(4, 11, 2, 1, '{\"disable\":[]}');

-- --------------------------------------------------------

--
-- Table structure for table `ost_list`
--

CREATE TABLE `ost_list` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_plural` varchar(255) DEFAULT NULL,
  `sort_mode` enum('Alpha','-Alpha','SortCol') NOT NULL DEFAULT 'Alpha',
  `masks` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `type` varchar(16) DEFAULT NULL,
  `configuration` text NOT NULL,
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_list`
--

INSERT INTO `ost_list` (`id`, `name`, `name_plural`, `sort_mode`, `masks`, `type`, `configuration`, `notes`, `created`, `updated`) VALUES
(1, 'Ticket Status', 'Ticket Statuses', 'SortCol', 13, 'ticket-status', '{\"handler\":\"TicketStatusList\"}', 'Ticket statuses', '2021-10-20 06:05:15', '2021-10-20 06:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `ost_list_items`
--

CREATE TABLE `ost_list_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `list_id` int(11) DEFAULT NULL,
  `status` int(11) UNSIGNED NOT NULL DEFAULT 1,
  `value` varchar(255) NOT NULL,
  `extra` varchar(255) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 1,
  `properties` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_lock`
--

CREATE TABLE `ost_lock` (
  `lock_id` int(11) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `expire` datetime DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_note`
--

CREATE TABLE `ost_note` (
  `id` int(11) UNSIGNED NOT NULL,
  `pid` int(11) UNSIGNED DEFAULT NULL,
  `staff_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `ext_id` varchar(10) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `status` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_organization`
--

CREATE TABLE `ost_organization` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL DEFAULT '',
  `manager` varchar(16) NOT NULL DEFAULT '',
  `status` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `domain` varchar(256) NOT NULL DEFAULT '',
  `extra` text DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_organization`
--

INSERT INTO `ost_organization` (`id`, `name`, `manager`, `status`, `domain`, `extra`, `created`, `updated`) VALUES
(1, 'osTicket', '', 8, '', NULL, '2021-10-20 06:05:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ost_organization__cdata`
--

CREATE TABLE `ost_organization__cdata` (
  `org_id` int(11) UNSIGNED NOT NULL,
  `name` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_organization__cdata`
--

INSERT INTO `ost_organization__cdata` (`org_id`, `name`) VALUES
(1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ost_plugin`
--

CREATE TABLE `ost_plugin` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `install_path` varchar(60) NOT NULL,
  `isphar` tinyint(1) NOT NULL DEFAULT 0,
  `isactive` tinyint(1) NOT NULL DEFAULT 0,
  `version` varchar(64) DEFAULT NULL,
  `installed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_queue`
--

CREATE TABLE `ost_queue` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `columns_id` int(11) UNSIGNED DEFAULT NULL,
  `sort_id` int(11) UNSIGNED DEFAULT NULL,
  `flags` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `staff_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(60) DEFAULT NULL,
  `config` text DEFAULT NULL,
  `filter` varchar(64) DEFAULT NULL,
  `root` varchar(32) DEFAULT NULL,
  `path` varchar(80) NOT NULL DEFAULT '/',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_queue`
--

INSERT INTO `ost_queue` (`id`, `parent_id`, `columns_id`, `sort_id`, `flags`, `staff_id`, `sort`, `title`, `config`, `filter`, `root`, `path`, `created`, `updated`) VALUES
(1, 0, NULL, 1, 3, 0, 1, 'Open', '[[\"status__state\",\"includes\",{\"open\":\"Open\"}]]', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(2, 1, NULL, 4, 43, 0, 1, 'Open', '{\"criteria\":[[\"isanswered\",\"nset\",null]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(3, 1, NULL, 4, 43, 0, 2, 'Answered', '{\"criteria\":[[\"isanswered\",\"set\",null]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(4, 1, NULL, 4, 43, 0, 3, 'Overdue', '{\"criteria\":[[\"isoverdue\",\"set\",null]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(5, 0, NULL, 3, 3, 0, 3, 'My Tickets', '{\"criteria\":[[\"assignee\",\"includes\",{\"M\":\"Me\",\"T\":\"One of my teams\"}],[\"status__state\",\"includes\",{\"open\":\"Open\"}]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(6, 5, NULL, NULL, 43, 0, 1, 'Assigned to Me', '{\"criteria\":[[\"assignee\",\"includes\",{\"M\":\"Me\"}]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(7, 5, NULL, NULL, 43, 0, 2, 'Assigned to Teams', '{\"criteria\":[[\"assignee\",\"!includes\",{\"M\":\"Me\"}]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(8, 0, NULL, 5, 3, 0, 4, 'Closed', '{\"criteria\":[[\"status__state\",\"includes\",{\"closed\":\"Closed\"}]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(9, 8, NULL, 5, 43, 0, 1, 'Today', '{\"criteria\":[[\"closed\",\"period\",\"td\"]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(10, 8, NULL, 5, 43, 0, 2, 'Yesterday', '{\"criteria\":[[\"closed\",\"period\",\"yd\"]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(11, 8, NULL, 5, 43, 0, 3, 'This Week', '{\"criteria\":[[\"closed\",\"period\",\"tw\"]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(12, 8, NULL, 5, 43, 0, 4, 'This Month', '{\"criteria\":[[\"closed\",\"period\",\"tm\"]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(13, 8, NULL, 6, 43, 0, 5, 'This Quarter', '{\"criteria\":[[\"closed\",\"period\",\"tq\"]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(14, 8, NULL, 7, 43, 0, 6, 'This Year', '{\"criteria\":[[\"closed\",\"period\",\"ty\"]],\"conditions\":[]}', NULL, 'T', '/', '2021-10-20 06:05:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ost_queue_column`
--

CREATE TABLE `ost_queue_column` (
  `id` int(11) UNSIGNED NOT NULL,
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(64) NOT NULL DEFAULT '',
  `primary` varchar(64) NOT NULL DEFAULT '',
  `secondary` varchar(64) DEFAULT NULL,
  `filter` varchar(32) DEFAULT NULL,
  `truncate` varchar(16) DEFAULT NULL,
  `annotations` text DEFAULT NULL,
  `conditions` text DEFAULT NULL,
  `extra` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_queue_column`
--

INSERT INTO `ost_queue_column` (`id`, `flags`, `name`, `primary`, `secondary`, `filter`, `truncate`, `annotations`, `conditions`, `extra`) VALUES
(1, 0, 'Ticket #', 'number', NULL, 'link:ticketP', 'wrap', '[{\"c\":\"TicketSourceDecoration\",\"p\":\"b\"}]', '[{\"crit\":[\"isanswered\",\"nset\",null],\"prop\":{\"font-weight\":\"bold\"}}]', NULL),
(2, 0, 'Date Created', 'created', NULL, 'date:full', 'wrap', '[]', '[]', NULL),
(3, 0, 'Subject', 'cdata__subject', NULL, 'link:ticket', 'ellipsis', '[{\"c\":\"TicketThreadCount\",\"p\":\">\"},{\"c\":\"ThreadAttachmentCount\",\"p\":\"a\"},{\"c\":\"OverdueFlagDecoration\",\"p\":\"<\"},{\"c\":\"LockDecoration\",\"p\":\"<\"}]', '[{\"crit\":[\"isanswered\",\"nset\",null],\"prop\":{\"font-weight\":\"bold\"}}]', NULL),
(4, 0, 'User Name', 'user__name', NULL, NULL, 'wrap', '[{\"c\":\"ThreadCollaboratorCount\",\"p\":\">\"}]', '[]', NULL),
(5, 0, 'Priority', 'cdata__priority', NULL, NULL, 'wrap', '[]', '[]', NULL),
(6, 0, 'Status', 'status__id', NULL, NULL, 'wrap', '[]', '[]', NULL),
(7, 0, 'Close Date', 'closed', NULL, 'date:full', 'wrap', '[]', '[]', NULL),
(8, 0, 'Assignee', 'assignee', NULL, NULL, 'wrap', '[]', '[]', NULL),
(9, 0, 'Due Date', 'duedate', 'est_duedate', 'date:human', 'wrap', '[]', '[]', NULL),
(10, 0, 'Last Updated', 'lastupdate', NULL, 'date:full', 'wrap', '[]', '[]', NULL),
(11, 0, 'Department', 'dept_id', NULL, NULL, 'wrap', '[]', '[]', NULL),
(12, 0, 'Last Message', 'thread__lastmessage', NULL, 'date:human', 'wrap', '[]', '[]', NULL),
(13, 0, 'Last Response', 'thread__lastresponse', NULL, 'date:human', 'wrap', '[]', '[]', NULL),
(14, 0, 'Team', 'team_id', NULL, NULL, 'wrap', '[]', '[]', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ost_queue_columns`
--

CREATE TABLE `ost_queue_columns` (
  `queue_id` int(11) UNSIGNED NOT NULL,
  `column_id` int(11) UNSIGNED NOT NULL,
  `staff_id` int(11) UNSIGNED NOT NULL,
  `bits` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `heading` varchar(64) DEFAULT NULL,
  `width` int(10) UNSIGNED NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_queue_columns`
--

INSERT INTO `ost_queue_columns` (`queue_id`, `column_id`, `staff_id`, `bits`, `sort`, `heading`, `width`) VALUES
(1, 1, 0, 1, 1, 'Ticket', 100),
(1, 3, 0, 1, 3, 'Subject', 300),
(1, 4, 0, 1, 4, 'From', 185),
(1, 5, 0, 1, 5, 'Priority', 85),
(1, 8, 0, 1, 6, 'Assigned To', 160),
(1, 10, 0, 1, 2, 'Last Updated', 150),
(2, 1, 0, 1, 1, 'Ticket', 100),
(2, 3, 0, 1, 3, 'Subject', 300),
(2, 4, 0, 1, 4, 'From', 185),
(2, 5, 0, 1, 5, 'Priority', 85),
(2, 8, 0, 1, 6, 'Assigned To', 160),
(2, 10, 0, 1, 2, 'Last Updated', 150),
(3, 1, 0, 1, 1, 'Ticket', 100),
(3, 3, 0, 1, 3, 'Subject', 300),
(3, 4, 0, 1, 4, 'From', 185),
(3, 5, 0, 1, 5, 'Priority', 85),
(3, 8, 0, 1, 6, 'Assigned To', 160),
(3, 10, 0, 1, 2, 'Last Updated', 150),
(4, 1, 0, 1, 1, 'Ticket', 100),
(4, 3, 0, 1, 3, 'Subject', 300),
(4, 4, 0, 1, 4, 'From', 185),
(4, 5, 0, 1, 5, 'Priority', 85),
(4, 8, 0, 1, 6, 'Assigned To', 160),
(4, 9, 0, 1, 9, 'Due Date', 150),
(5, 1, 0, 1, 1, 'Ticket', 100),
(5, 3, 0, 1, 3, 'Subject', 300),
(5, 4, 0, 1, 4, 'From', 185),
(5, 5, 0, 1, 5, 'Priority', 85),
(5, 10, 0, 1, 2, 'Last Update', 150),
(5, 11, 0, 1, 6, 'Department', 160),
(6, 1, 0, 1, 1, 'Ticket', 100),
(6, 3, 0, 1, 3, 'Subject', 300),
(6, 4, 0, 1, 4, 'From', 185),
(6, 5, 0, 1, 5, 'Priority', 85),
(6, 10, 0, 1, 2, 'Last Update', 150),
(6, 11, 0, 1, 6, 'Department', 160),
(7, 1, 0, 1, 1, 'Ticket', 100),
(7, 3, 0, 1, 3, 'Subject', 300),
(7, 4, 0, 1, 4, 'From', 185),
(7, 5, 0, 1, 5, 'Priority', 85),
(7, 10, 0, 1, 2, 'Last Update', 150),
(7, 14, 0, 1, 6, 'Team', 160),
(8, 1, 0, 1, 1, 'Ticket', 100),
(8, 3, 0, 1, 3, 'Subject', 300),
(8, 4, 0, 1, 4, 'From', 185),
(8, 7, 0, 1, 2, 'Date Closed', 150),
(8, 8, 0, 1, 6, 'Closed By', 160),
(9, 1, 0, 1, 1, 'Ticket', 100),
(9, 3, 0, 1, 3, 'Subject', 300),
(9, 4, 0, 1, 4, 'From', 185),
(9, 7, 0, 1, 2, 'Date Closed', 150),
(9, 8, 0, 1, 6, 'Closed By', 160),
(10, 1, 0, 1, 1, 'Ticket', 100),
(10, 3, 0, 1, 3, 'Subject', 300),
(10, 4, 0, 1, 4, 'From', 185),
(10, 7, 0, 1, 2, 'Date Closed', 150),
(10, 8, 0, 1, 6, 'Closed By', 160),
(11, 1, 0, 1, 1, 'Ticket', 100),
(11, 3, 0, 1, 3, 'Subject', 300),
(11, 4, 0, 1, 4, 'From', 185),
(11, 7, 0, 1, 2, 'Date Closed', 150),
(11, 8, 0, 1, 6, 'Closed By', 160),
(12, 1, 0, 1, 1, 'Ticket', 100),
(12, 3, 0, 1, 3, 'Subject', 300),
(12, 4, 0, 1, 4, 'From', 185),
(12, 7, 0, 1, 2, 'Date Closed', 150),
(12, 8, 0, 1, 6, 'Closed By', 160),
(13, 1, 0, 1, 1, 'Ticket', 100),
(13, 3, 0, 1, 3, 'Subject', 300),
(13, 4, 0, 1, 4, 'From', 185),
(13, 7, 0, 1, 2, 'Date Closed', 150),
(13, 8, 0, 1, 6, 'Closed By', 160),
(14, 1, 0, 1, 1, 'Ticket', 100),
(14, 3, 0, 1, 3, 'Subject', 300),
(14, 4, 0, 1, 4, 'From', 185),
(14, 7, 0, 1, 2, 'Date Closed', 150),
(14, 8, 0, 1, 6, 'Closed By', 160);

-- --------------------------------------------------------

--
-- Table structure for table `ost_queue_config`
--

CREATE TABLE `ost_queue_config` (
  `queue_id` int(11) UNSIGNED NOT NULL,
  `staff_id` int(11) UNSIGNED NOT NULL,
  `setting` text DEFAULT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_queue_export`
--

CREATE TABLE `ost_queue_export` (
  `id` int(11) UNSIGNED NOT NULL,
  `queue_id` int(11) UNSIGNED NOT NULL,
  `path` varchar(64) NOT NULL DEFAULT '',
  `heading` varchar(64) DEFAULT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_queue_sort`
--

CREATE TABLE `ost_queue_sort` (
  `id` int(11) UNSIGNED NOT NULL,
  `root` varchar(32) DEFAULT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `columns` text DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_queue_sort`
--

INSERT INTO `ost_queue_sort` (`id`, `root`, `name`, `columns`, `updated`) VALUES
(1, NULL, 'Priority + Most Recently Updated', '[\"-cdata__priority\",\"-lastupdate\"]', '2021-10-20 06:05:18'),
(2, NULL, 'Priority + Most Recently Created', '[\"-cdata__priority\",\"-created\"]', '2021-10-20 06:05:18'),
(3, NULL, 'Priority + Due Date', '[\"-cdata__priority\",\"-est_duedate\"]', '2021-10-20 06:05:18'),
(4, NULL, 'Due Date', '[\"-est_duedate\"]', '2021-10-20 06:05:18'),
(5, NULL, 'Closed Date', '[\"-closed\"]', '2021-10-20 06:05:18'),
(6, NULL, 'Create Date', '[\"-created\"]', '2021-10-20 06:05:18'),
(7, NULL, 'Update Date', '[\"-lastupdate\"]', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_queue_sorts`
--

CREATE TABLE `ost_queue_sorts` (
  `queue_id` int(11) UNSIGNED NOT NULL,
  `sort_id` int(11) UNSIGNED NOT NULL,
  `bits` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_queue_sorts`
--

INSERT INTO `ost_queue_sorts` (`queue_id`, `sort_id`, `bits`, `sort`) VALUES
(1, 1, 0, 0),
(1, 2, 0, 0),
(1, 3, 0, 0),
(1, 4, 0, 0),
(1, 6, 0, 0),
(1, 7, 0, 0),
(5, 1, 0, 0),
(5, 2, 0, 0),
(5, 3, 0, 0),
(5, 4, 0, 0),
(5, 6, 0, 0),
(5, 7, 0, 0),
(6, 1, 0, 0),
(6, 2, 0, 0),
(6, 3, 0, 0),
(6, 4, 0, 0),
(6, 6, 0, 0),
(6, 7, 0, 0),
(7, 1, 0, 0),
(7, 2, 0, 0),
(7, 3, 0, 0),
(7, 4, 0, 0),
(7, 6, 0, 0),
(7, 7, 0, 0),
(8, 1, 0, 0),
(8, 2, 0, 0),
(8, 3, 0, 0),
(8, 4, 0, 0),
(8, 5, 0, 0),
(8, 6, 0, 0),
(8, 7, 0, 0),
(9, 1, 0, 0),
(9, 2, 0, 0),
(9, 3, 0, 0),
(9, 4, 0, 0),
(9, 5, 0, 0),
(9, 6, 0, 0),
(9, 7, 0, 0),
(10, 1, 0, 0),
(10, 2, 0, 0),
(10, 3, 0, 0),
(10, 4, 0, 0),
(10, 5, 0, 0),
(10, 6, 0, 0),
(10, 7, 0, 0),
(11, 1, 0, 0),
(11, 2, 0, 0),
(11, 3, 0, 0),
(11, 4, 0, 0),
(11, 5, 0, 0),
(11, 6, 0, 0),
(11, 7, 0, 0),
(12, 1, 0, 0),
(12, 2, 0, 0),
(12, 3, 0, 0),
(12, 4, 0, 0),
(12, 5, 0, 0),
(12, 6, 0, 0),
(12, 7, 0, 0),
(13, 1, 0, 0),
(13, 2, 0, 0),
(13, 3, 0, 0),
(13, 4, 0, 0),
(13, 5, 0, 0),
(13, 6, 0, 0),
(13, 7, 0, 0),
(14, 1, 0, 0),
(14, 2, 0, 0),
(14, 3, 0, 0),
(14, 4, 0, 0),
(14, 5, 0, 0),
(14, 6, 0, 0),
(14, 7, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ost_role`
--

CREATE TABLE `ost_role` (
  `id` int(11) UNSIGNED NOT NULL,
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(64) DEFAULT NULL,
  `permissions` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_role`
--

INSERT INTO `ost_role` (`id`, `flags`, `name`, `permissions`, `notes`, `created`, `updated`) VALUES
(1, 1, 'All Access', '{\"ticket.assign\":1,\"ticket.close\":1,\"ticket.create\":1,\"ticket.delete\":1,\"ticket.edit\":1,\"thread.edit\":1,\"ticket.link\":1,\"ticket.markanswered\":1,\"ticket.merge\":1,\"ticket.reply\":1,\"ticket.refer\":1,\"ticket.release\":1,\"ticket.transfer\":1,\"task.assign\":1,\"task.close\":1,\"task.create\":1,\"task.delete\":1,\"task.edit\":1,\"task.reply\":1,\"task.transfer\":1,\"canned.manage\":1}', 'Role with unlimited access', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(2, 1, 'Expanded Access', '{\"ticket.assign\":1,\"ticket.close\":1,\"ticket.create\":1,\"ticket.edit\":1,\"ticket.link\":1,\"ticket.merge\":1,\"ticket.reply\":1,\"ticket.refer\":1,\"ticket.release\":1,\"ticket.transfer\":1,\"task.assign\":1,\"task.close\":1,\"task.create\":1,\"task.edit\":1,\"task.reply\":1,\"task.transfer\":1,\"canned.manage\":1}', 'Role with expanded access', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(3, 1, 'Limited Access', '{\"ticket.assign\":1,\"ticket.create\":1,\"ticket.link\":1,\"ticket.merge\":1,\"ticket.refer\":1,\"ticket.release\":1,\"ticket.transfer\":1,\"task.assign\":1,\"task.reply\":1,\"task.transfer\":1}', 'Role with limited access', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(4, 1, 'View only', NULL, 'Simple role with no permissions', '2021-10-20 06:05:18', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_schedule`
--

CREATE TABLE `ost_schedule` (
  `id` int(11) UNSIGNED NOT NULL,
  `flags` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `timezone` varchar(64) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_schedule`
--

INSERT INTO `ost_schedule` (`id`, `flags`, `name`, `timezone`, `description`, `created`, `updated`) VALUES
(1, 1, 'Monday - Friday 8am - 5pm with U.S. Holidays', NULL, '', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(2, 1, '24/7', NULL, '', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(3, 1, '24/5', NULL, '', '2021-10-20 06:05:18', '2021-10-20 06:05:18'),
(4, 0, 'U.S. Holidays', NULL, '', '2021-10-20 06:05:18', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_schedule_entry`
--

CREATE TABLE `ost_schedule_entry` (
  `id` int(11) UNSIGNED NOT NULL,
  `schedule_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `flags` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `sort` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `repeats` varchar(16) NOT NULL DEFAULT 'never',
  `starts_on` date DEFAULT NULL,
  `starts_at` time DEFAULT NULL,
  `ends_on` date DEFAULT NULL,
  `ends_at` time DEFAULT NULL,
  `stops_on` datetime DEFAULT NULL,
  `day` tinyint(4) DEFAULT NULL,
  `week` tinyint(4) DEFAULT NULL,
  `month` tinyint(4) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_schedule_entry`
--

INSERT INTO `ost_schedule_entry` (`id`, `schedule_id`, `flags`, `sort`, `name`, `repeats`, `starts_on`, `starts_at`, `ends_on`, `ends_at`, `stops_on`, `day`, `week`, `month`, `created`, `updated`) VALUES
(1, 1, 0, 0, 'Monday', 'weekly', '2019-01-07', '08:00:00', '2019-01-07', '17:00:00', NULL, 1, NULL, NULL, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(2, 1, 0, 0, 'Tuesday', 'weekly', '2019-01-08', '08:00:00', '2019-01-08', '17:00:00', NULL, 2, NULL, NULL, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(3, 1, 0, 0, 'Wednesday', 'weekly', '2019-01-09', '08:00:00', '2019-01-09', '17:00:00', NULL, 3, NULL, NULL, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(4, 1, 0, 0, 'Thursday', 'weekly', '2019-01-10', '08:00:00', '2019-01-10', '17:00:00', NULL, 4, NULL, NULL, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(5, 1, 0, 0, 'Friday', 'weekly', '2019-01-11', '08:00:00', '2019-01-11', '17:00:00', NULL, 5, NULL, NULL, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(6, 2, 0, 0, 'Daily', 'daily', '2019-01-01', '00:00:00', '2019-01-01', '23:59:59', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(7, 3, 0, 0, 'Weekdays', 'weekdays', '2019-01-01', '00:00:00', '2019-01-01', '23:59:59', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(8, 4, 0, 0, 'New Year\'s Day', 'yearly', '2019-01-01', '00:00:00', '2019-01-01', '23:59:59', NULL, 1, NULL, 1, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(9, 4, 0, 0, 'MLK Day', 'yearly', '2019-01-21', '00:00:00', '2019-01-21', '23:59:59', NULL, 1, 3, 1, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(10, 4, 0, 0, 'Memorial Day', 'yearly', '2019-05-27', '00:00:00', '2019-05-27', '23:59:59', NULL, 1, -1, 5, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(11, 4, 0, 0, 'Independence Day (4th of July)', 'yearly', '2019-07-04', '00:00:00', '2019-07-04', '23:59:59', NULL, 4, NULL, 7, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(12, 4, 0, 0, 'Labor Day', 'yearly', '2019-09-02', '00:00:00', '2019-09-02', '23:59:59', NULL, 1, 1, 9, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(13, 4, 0, 0, 'Indigenous Peoples\' Day (Whodat Columbus)', 'yearly', '2019-10-14', '00:00:00', '2019-10-14', '23:59:59', NULL, 1, 2, 10, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(14, 4, 0, 0, 'Veterans Day', 'yearly', '2019-11-11', '00:00:00', '2019-11-11', '23:59:59', NULL, 11, NULL, 11, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(15, 4, 0, 0, 'Thanksgiving Day', 'yearly', '2019-11-28', '00:00:00', '2019-11-28', '23:59:59', NULL, 4, 4, 11, '0000-00-00 00:00:00', '2021-10-20 06:05:18'),
(16, 4, 0, 0, 'Christmas Day', 'yearly', '2019-11-25', '00:00:00', '2019-11-25', '23:59:59', NULL, 25, NULL, 12, '0000-00-00 00:00:00', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_sequence`
--

CREATE TABLE `ost_sequence` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `flags` int(10) UNSIGNED DEFAULT NULL,
  `next` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `increment` int(11) DEFAULT 1,
  `padding` char(1) DEFAULT '0',
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_sequence`
--

INSERT INTO `ost_sequence` (`id`, `name`, `flags`, `next`, `increment`, `padding`, `updated`) VALUES
(1, 'General Tickets', 1, 1, 1, '0', '0000-00-00 00:00:00'),
(2, 'Tasks Sequence', 1, 1, 1, '0', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ost_session`
--

CREATE TABLE `ost_session` (
  `session_id` varchar(255) CHARACTER SET ascii NOT NULL DEFAULT '',
  `session_data` blob DEFAULT NULL,
  `session_expire` datetime DEFAULT NULL,
  `session_updated` datetime DEFAULT NULL,
  `user_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'osTicket staff/client ID',
  `user_ip` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ost_session`
--

INSERT INTO `ost_session` (`session_id`, `session_data`, `session_expire`, `session_updated`, `user_id`, `user_ip`, `user_agent`) VALUES
('035f12aa6c7e017210011cb7c6de5e80', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2234623430393065346338366538366662333130333462666131333063313134356437393165393533223b733a343a2274696d65223b693a313633343732303334333b7d5f617574687c613a323a7b733a353a227374616666223b613a333a7b733a323a226964223b693a313b733a333a226b6579223b733a31383a226c6f63616c3a443136385f537570706f7274223b733a333a22326661223b4e3b7d733a343a2275736572223b613a303a7b7d7d5f73746166667c613a313a7b733a343a2261757468223b613a323a7b733a343a2264657374223b733a32323a222f737570706f72742f7363702f61646d696e2e706870223b733a333a226d7367223b733a32333a2241757468656e7469636174696f6e205265717569726564223b7d7d3a746f6b656e7c613a313a7b733a353a227374616666223b733a37363a2262643732373235376539623234306134663831343063653439613934346239333a313633343732303233363a3239386566363165376461633232633439383466366562376361613637353135223b7d6366673a636f72657c613a313a7b733a31313a2264625f74696d657a6f6e65223b733a333a22555443223b7d6c61737463726f6e63616c6c7c693a313633343732303137353b3a3a513a547c693a313b736f72747c613a313a7b693a313b613a323a7b733a393a227175657565736f7274223b4f3a393a225175657565536f7274223a373a7b733a383a225f636f6c756d6e73223b613a323a7b733a31353a2263646174615f5f7072696f72697479223b623a313b733a31303a226c617374757064617465223b623a313b7d733a363a225f6578747261223b4e3b733a323a226874223b613a353a7b733a323a226964223b693a313b733a343a22726f6f74223b4e3b733a343a226e616d65223b733a33323a225072696f72697479202b204d6f737420526563656e746c792055706461746564223b733a373a22636f6c756d6e73223b733a33343a225b222d63646174615f5f7072696f72697479222c222d6c617374757064617465225d223b733a373a2275706461746564223b733a31393a22323032312d31302d32302030363a30353a3138223b7d733a353a226469727479223b613a303a7b7d733a373a225f5f6e65775f5f223b623a303b733a31313a225f5f64656c657465645f5f223b623a303b733a31323a225f5f64656665727265645f5f223b613a303a7b7d7d733a333a22646972223b693a303b7d7d71636f756e74737c613a313a7b733a34383a22636f756e74732e7175657565732e312e67654d715034713072617546615165577034774c4971744939656534446d5159223b613a323a7b733a363a22636f756e7473223b613a31343a7b733a323a227131223b643a323b733a323a227132223b643a323b733a323a227136223b643a303b733a323a227139223b643a303b733a323a227133223b643a303b733a323a227137223b643a303b733a333a22713130223b643a303b733a323a227134223b643a303b733a323a227135223b643a303b733a333a22713131223b643a303b733a323a227138223b643a303b733a333a22713132223b643a303b733a333a22713133223b643a303b733a333a22713134223b643a303b7d733a343a2274696d65223b693a313633343732303137333b7d7d3a6d7367737c613a303a7b7d, '2021-10-21 08:59:03', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('05f07fc385f77eab099de99a71f11a78', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2236633132346536616638393064616330633232333562313962323630623964316164343162656161223b733a343a2274696d65223b693a313633343732393534353b7d, '2021-10-21 11:32:25', NULL, '0', '103.161.40.19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('0b6ce4458b971bf2387bbd581da20b0b', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2230656132663163356334313664366639616438313434616439666136343365653839656531316332223b733a343a2274696d65223b693a313637343232383334373b7d, '2023-01-21 15:25:47', NULL, '0', '172.126.35.202', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36'),
('11c48cd818e7ae1cef62b0eee7541a44', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2239663631363261623538336462666633353565353464326438653033633530346236623931363630223b733a343a2274696d65223b693a313633343733393738303b7d5f73746166667c613a313a7b733a343a2261757468223b613a323a7b733a343a2264657374223b733a36313a222f737570706f72742f7363702f6c6f676f75742e7068703f617574683d3739386238636632363662323135333862373435306332613936306136623739223b733a333a226d7367223b733a32333a2241757468656e7469636174696f6e205265717569726564223b7d7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2021-10-21 14:23:00', NULL, '0', '2409:4042:4e07:9790:b574:d721:6f5c:a4bf', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('14593cf8372bfcb834a54079e5490208', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2232383562626432623161386565643435363934626236653038636332383139653533623131376262223b733a343a2274696d65223b693a313633343733313131363b7d5f617574687c613a313a7b733a343a2275736572223b613a323a7b733a323a226964223b693a323b733a333a226b6579223b733a34373a2261757468746f6b656e3a6f327432686338316537323864396434633266363336663036376638396363313438363263223b7d7d3a746f6b656e7c613a313a7b733a363a22636c69656e74223b733a37363a2233623636633037303639393032656333656534306230356465373235343938373a313633343733313131353a6363616361623938393132383534376662303361336533326136613861643230223b7d6366673a636f72657c613a313a7b733a31313a2264625f74696d657a6f6e65223b733a333a22555443223b7d, '2021-10-21 11:58:36', NULL, '0', '49.44.84.230', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36'),
('185cc1d5c92e7c21a57834b92febb826', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2230663832363830313363376438613033393962613164353264396363656339616364323933396632223b733a343a2274696d65223b693a313633343732343137393b7d, '2021-10-21 10:02:59', NULL, '0', '49.44.83.7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36'),
('227f19421a7629997cdfc8eeb7066856', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2261323463386331303639613837376132666339653562326161653831363538373365366264623965223b733a343a2274696d65223b693a313633343732383131303b7d5f73746166667c613a313a7b733a343a2261757468223b613a313a7b733a333a226d7367223b733a32353a2256616c6964204353524620546f6b656e205265717569726564223b7d7d, '2021-10-21 11:08:30', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('2553ccfd0073094d93ed890f1156c667', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2230343531623136326666353639343234633734306435626563323239616361323761323765666364223b733a343a2274696d65223b693a313633373632393333393b7d, '2021-11-24 01:02:19', NULL, '0', '172.126.35.202', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
('27c04c75eecf3c7d019f5112e5512880', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2230363366623439653134613236353163303539613631323062626134623664343262643466313136223b733a343a2274696d65223b693a313633343732383131303b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2021-10-21 11:08:30', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('2b697a0b89fcd72c9bda661f7d94358f', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2262323736346437643261386336343435326233373433316639363739636261616334616531373833223b733a343a2274696d65223b693a313633343732323031373b7d5f617574687c613a313a7b733a343a2275736572223b613a303a7b7d7d3a746f6b656e7c613a303a7b7d6366673a636f72657c613a313a7b733a31313a2264625f74696d657a6f6e65223b733a333a22555443223b7d, '2021-10-21 09:26:57', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('2c6131aa802b40f249e8bf78f829e968', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2238616461653764623730643261383461343762643363633037333733343831303664306162306237223b733a343a2274696d65223b693a313633343732303534303b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2021-10-21 09:02:20', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('2ea34190ae06fbaed0e67dcabcf35255', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2235646564616234386461663763343931326233626330386332386665336662303733653039373665223b733a343a2274696d65223b693a313633343733333233323b7d5f617574687c613a323a7b733a343a2275736572223b4e3b733a353a227374616666223b4e3b7d, '2021-10-21 12:33:52', NULL, '0', '103.195.83.108', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('3e5431b5d7302dc7299a928dfde66285', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2234303664616539366265353934346261633161343134646263656332363135653064633430653933223b733a343a2274696d65223b693a313633343731333837393b7d, '2021-10-21 07:11:19', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('45aa45a3e9bd973c8389962dcd5b882c', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2233313830313265646330356133626132643438303166383539656362663865626234656433353431223b733a343a2274696d65223b693a313633343732333631373b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2021-10-21 09:53:37', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('491bdc4ffd0f732218b98a9f882fbeff', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2238356463393039633637343238366334613532356664326466386365343063373032386665333263223b733a343a2274696d65223b693a313633343731393833353b7d, '2021-10-21 08:50:35', NULL, '0', '2401:4900:5020:e79f:1d77:dc97:6540:371c', 'Mozilla/5.0 (Linux; Android 10; SAMSUNG SM-A920F) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/15.0 Chrome/90.0.4430.210 Mobile Safari/537.36'),
('50dcfcb8f17579b3eac0b4d0ecefc058', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2234623430393065346338366538366662333130333462666131333063313134356437393165393533223b733a343a2274696d65223b693a313633343732303136303b7d5f617574687c613a323a7b733a353a227374616666223b613a333a7b733a323a226964223b693a313b733a333a226b6579223b733a31383a226c6f63616c3a443136385f537570706f7274223b733a333a22326661223b4e3b7d733a343a2275736572223b613a323a7b733a323a226964223b693a323b733a333a226b6579223b733a383a22636c69656e743a32223b7d7d5f73746166667c613a313a7b733a343a2261757468223b613a323a7b733a343a2264657374223b733a32323a222f737570706f72742f7363702f61646d696e2e706870223b733a333a226d7367223b733a32333a2241757468656e7469636174696f6e205265717569726564223b7d7d3a746f6b656e7c613a323a7b733a353a227374616666223b733a37363a2237376538356164316336386264363566373530323834396233613033393230663a313633343731393937393a3239386566363165376461633232633439383466366562376361613637353135223b733a363a22636c69656e74223b733a37363a2233353837643531356239386234313466633838623131306435356164313731663a313633343732303136303a3239386566363165376461633232633439383466366562376361613637353135223b7d6366673a636f72657c613a313a7b733a31313a2264625f74696d657a6f6e65223b733a333a22555443223b7d6c61737463726f6e63616c6c7c693a313633343731393938363b, '2021-10-21 08:56:01', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('510b26dcf3b4318e950004c133462f0e', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2261393436376161633635646232386339323262376635303361346431616439333832646131623966223b733a343a2274696d65223b693a313633343732303531313b7d5f617574687c613a313a7b733a343a2275736572223b4e3b7d, '2021-10-21 09:01:51', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('5ec02f8311aa41ffae17e97d48686689', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2239366434386130663433333139393633306430333234366339343566666430316261343963343964223b733a343a2274696d65223b693a313633343731393934353b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2021-10-21 08:52:25', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('629233190125f03e3dff5e98c150afaf', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2235373263386633666130346332393834626337376435353565643162636437386633653464303765223b733a343a2274696d65223b693a313633343731333530363b7d, '2021-10-21 07:05:06', NULL, '0', '2401:4900:5029:94e6:b05e:6e99:6e3a:d441', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('631b08d93d59580a701554b439e485d9', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2237323464363830653465343333323839643730363761383132636662633132333430323833366534223b733a343a2274696d65223b693a313633343732333631303b7d, '2021-10-21 09:53:30', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('68188b241374bb65416976dfaf814ada', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2239313835376638306663383130353135383833373133616462653334363735313731303532386537223b733a343a2274696d65223b693a313633343731393936373b7d5f73746166667c613a313a7b733a343a2261757468223b613a313a7b733a333a226d7367223b733a32353a2256616c6964204353524620546f6b656e205265717569726564223b7d7d, '2021-10-21 08:52:47', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('684cf039c98bbfefd94063eca9c9d843', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2238336262373038666163666535393162613965356231363639666133656538363638366362326563223b733a343a2274696d65223b693a313633373637353538383b7d, '2021-11-24 13:53:08', NULL, '0', '172.126.35.202', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36'),
('6c7ee00187dd69ddd04140254a5f516a', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2239313030663539343834663733373165373538323565663036383636326538373164653562343362223b733a343a2274696d65223b693a313633343732303533393b7d5f73746166667c613a313a7b733a343a2261757468223b613a313a7b733a333a226d7367223b733a32353a2256616c6964204353524620546f6b656e205265717569726564223b7d7d, '2021-10-21 09:02:19', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('6f46c60d6a2bdbfe4495bd0e04edf90b', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2233383630663435626530386236396138663732396233306464666634353433653161366330306431223b733a343a2274696d65223b693a313633343731333736363b7d, '2021-10-21 07:09:26', NULL, '0', '2401:4900:5029:94e6:b05e:6e99:6e3a:d441', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36 Edg/94.0.992.50'),
('733df2dc720cfb4921530b7e0dd82413', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2264326535326331643330623038323637393430656530393130373064313432643838383737613332223b733a343a2274696d65223b693a313633343732383039333b7d5f73746166667c613a313a7b733a343a2261757468223b613a313a7b733a333a226d7367223b733a32353a2256616c6964204353524620546f6b656e205265717569726564223b7d7d, '2021-10-21 11:08:13', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('74b8efb695dae498acaedcd9eec35e8f', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2234363363313830663731653139363837313665633462386231343737363735636232646231386531223b733a343a2274696d65223b693a313633343732333538373b7d5f73746166667c613a313a7b733a343a2261757468223b613a323a7b733a343a2264657374223b733a32323a222f737570706f72742f7363702f61646d696e2e706870223b733a333a226d7367223b733a32333a2241757468656e7469636174696f6e205265717569726564223b7d7d5f617574687c613a333a7b733a353a227374616666223b613a333a7b733a323a226964223b693a313b733a333a226b6579223b733a31383a226c6f63616c3a443136385f537570706f7274223b733a333a22326661223b4e3b7d733a343a2275736572223b4e3b733a31313a22757365722d7469636b6574223b733a363a22333236363034223b7d3a746f6b656e7c613a323a7b733a353a227374616666223b733a37363a2230303131373362386462653339336363393362366361396639333662643836613a313633343732313932393a3239386566363165376461633232633439383466366562376361613637353135223b733a363a22636c69656e74223b4e3b7d6366673a636f72657c613a313a7b733a31313a2264625f74696d657a6f6e65223b733a333a22555443223b7d71636f756e74737c613a313a7b733a34383a22636f756e74732e7175657565732e312e67654d715034713072617546615165577034774c4971744939656534446d5159223b613a323a7b733a363a22636f756e7473223b613a31343a7b733a323a227131223b643a323b733a323a227132223b643a313b733a323a227136223b643a313b733a323a227139223b643a303b733a323a227133223b643a313b733a323a227137223b643a303b733a333a22713130223b643a303b733a323a227134223b643a303b733a323a227135223b643a313b733a333a22713131223b643a303b733a323a227138223b643a303b733a333a22713132223b643a303b733a333a22713133223b643a303b733a333a22713134223b643a303b7d733a343a2274696d65223b693a313633343732313837333b7d7d6c61737463726f6e63616c6c7c693a313633343732313837353b3a3a513a547c693a313b736f72747c613a313a7b693a313b613a323a7b733a393a227175657565736f7274223b4f3a393a225175657565536f7274223a373a7b733a383a225f636f6c756d6e73223b613a323a7b733a31353a2263646174615f5f7072696f72697479223b623a313b733a31303a226c617374757064617465223b623a313b7d733a363a225f6578747261223b4e3b733a323a226874223b613a353a7b733a323a226964223b693a313b733a343a22726f6f74223b4e3b733a343a226e616d65223b733a33323a225072696f72697479202b204d6f737420526563656e746c792055706461746564223b733a373a22636f6c756d6e73223b733a33343a225b222d63646174615f5f7072696f72697479222c222d6c617374757064617465225d223b733a373a2275706461746564223b733a31393a22323032312d31302d32302030363a30353a3138223b7d733a353a226469727479223b613a303a7b7d733a373a225f5f6e65775f5f223b623a303b733a31313a225f5f64656c657465645f5f223b623a303b733a31323a225f5f64656665727265645f5f223b613a303a7b7d7d733a333a22646972223b693a303b7d7d3a513a75736572737c433a383a225175657279536574223a3737313a7b613a31363a7b733a353a226d6f64656c223b733a343a2255736572223b733a31313a22636f6e73747261696e7473223b613a303a7b7d733a31363a22706174685f636f6e73747261696e7473223b613a303a7b7d733a383a226f72646572696e67223b613a313a7b693a303b733a343a226e616d65223b7d733a373a2272656c61746564223b623a303b733a363a2276616c756573223b613a373a7b733a323a226964223b733a323a226964223b733a343a226e616d65223b733a343a226e616d65223b733a32323a2264656661756c745f656d61696c5f5f61646472657373223b733a32323a2264656661756c745f656d61696c5f5f61646472657373223b733a31313a226163636f756e745f5f6964223b733a31313a226163636f756e745f5f6964223b733a31353a226163636f756e745f5f737461747573223b733a31353a226163636f756e745f5f737461747573223b733a373a2263726561746564223b733a373a2263726561746564223b733a373a2275706461746564223b733a373a2275706461746564223b7d733a353a226465666572223b613a303a7b7d733a31303a2261676772656761746564223b623a303b733a31313a22616e6e6f746174696f6e73223b613a313a7b733a31323a227469636b65745f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b733a373a227469636b657473223b733a383a2264697374696e6374223b623a303b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31323a227469636b65745f636f756e74223b7d7d733a353a226578747261223b613a303a7b7d733a383a2264697374696e6374223b613a303a7b7d733a343a226c6f636b223b623a303b733a353a22636861696e223b613a303a7b7d733a373a226f7074696f6e73223b613a303a7b7d733a343a2269746572223b693a323b733a383a22636f6d70696c6572223b733a31333a224d7953716c436f6d70696c6572223b7d7d, '2021-10-21 09:53:07', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('7c18877722e1964176b06b4fc0ad2e68', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2263313166376331333764346530333838666330613862303563343039613837363337343635613662223b733a343a2274696d65223b693a313633363132353239363b7d5f73746166667c613a313a7b733a343a2261757468223b613a323a7b733a343a2264657374223b733a32393a222f737570706f72742f7363702f7469636b6574732e7068703f69643d33223b733a333a226d7367223b733a32333a2241757468656e7469636174696f6e205265717569726564223b7d7d5f617574687c613a323a7b733a353a227374616666223b4e3b733a343a2275736572223b4e3b7d, '2021-11-06 15:14:56', NULL, '0', '172.126.35.202', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36'),
('7ffc9d164bb6084575decc41a490fc57', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2263663533313436663239366637303961383933636166646334333534643735386233663039356630223b733a343a2274696d65223b693a313633343731393639333b7d5f617574687c613a323a7b733a353a227374616666223b4e3b733a343a2275736572223b4e3b7d, '2021-10-21 08:48:13', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('80d239090bc5618e5983456349a0aeb9', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2239356333373931386365303134643038376162373734333765666161663434376133636232386564223b733a343a2274696d65223b693a313633343732393839393b7d, '2021-10-21 11:38:19', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('8a5e4e4af447ead6b7e32b74a06f5a07', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2266393465643061386636326461323130326638316262633933306639353039343665633161366363223b733a343a2274696d65223b693a313633343732393936393b7d5f617574687c613a323a7b733a343a2275736572223b4e3b733a353a227374616666223b613a333a7b733a323a226964223b693a313b733a333a226b6579223b733a31383a226c6f63616c3a443136385f537570706f7274223b733a333a22326661223b4e3b7d7d5f73746166667c613a313a7b733a343a2261757468223b613a323a7b733a343a2264657374223b733a31333a222f737570706f72742f7363702f223b733a333a226d7367223b733a32333a2241757468656e7469636174696f6e205265717569726564223b7d7d3a746f6b656e7c613a313a7b733a353a227374616666223b733a37363a2237626235623937613063336330633538663766366538336435623465396362343a313633343732393936393a3239386566363165376461633232633439383466366562376361613637353135223b7d3a3a513a547c693a313b736f72747c613a313a7b693a313b613a323a7b733a393a227175657565736f7274223b4f3a393a225175657565536f7274223a373a7b733a383a225f636f6c756d6e73223b613a323a7b733a31353a2263646174615f5f7072696f72697479223b623a313b733a31303a226c617374757064617465223b623a313b7d733a363a225f6578747261223b4e3b733a323a226874223b613a353a7b733a323a226964223b693a313b733a343a22726f6f74223b4e3b733a343a226e616d65223b733a33323a225072696f72697479202b204d6f737420526563656e746c792055706461746564223b733a373a22636f6c756d6e73223b733a33343a225b222d63646174615f5f7072696f72697479222c222d6c617374757064617465225d223b733a373a2275706461746564223b733a31393a22323032312d31302d32302030363a30353a3138223b7d733a353a226469727479223b613a303a7b7d733a373a225f5f6e65775f5f223b623a303b733a31313a225f5f64656c657465645f5f223b623a303b733a31323a225f5f64656665727265645f5f223b613a303a7b7d7d733a333a22646972223b693a303b7d7d6366673a636f72657c613a313a7b733a31313a2264625f74696d657a6f6e65223b733a333a22555443223b7d71636f756e74737c613a313a7b733a34383a22636f756e74732e7175657565732e312e67654d715034713072617546615165577034774c4971744939656534446d5159223b613a323a7b733a363a22636f756e7473223b613a31343a7b733a323a227131223b643a323b733a323a227132223b643a313b733a323a227136223b643a313b733a323a227139223b643a303b733a323a227133223b643a313b733a323a227137223b643a303b733a333a22713130223b643a303b733a323a227134223b643a303b733a323a227135223b643a313b733a333a22713131223b643a303b733a323a227138223b643a303b733a333a22713132223b643a303b733a333a22713133223b643a303b733a333a22713134223b643a303b7d733a343a2274696d65223b693a313633343732393934323b7d7d6c61737463726f6e63616c6c7c693a313633343732393934323b, '2021-10-21 11:39:29', NULL, '1', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('98328f0710013f854d83a42613cbae14', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2263366435343765306661393065646561363837306537343837633362303333613165623432313966223b733a343a2274696d65223b693a313633343732313634343b7d5f617574687c613a313a7b733a343a2275736572223b4e3b7d, '2021-10-21 09:20:44', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('9872e0730bc4c376c83da8a83e28dcea', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2262636362333362306562623833653132373766613366343164386633313736326332346635353733223b733a343a2274696d65223b693a313633343731393936383b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2021-10-21 08:52:48', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('9d2c962c211a1292b988c3fd07a66285', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2233356639633663636339326461386138366666373138326532663563356463666539313531323365223b733a343a2274696d65223b693a313633343731393933313b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2021-10-21 08:52:11', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('a07fbad2cd6071563ded2273411958eb', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2266356331386662366565666132373164656633336262363838623839363766316361663532323932223b733a343a2274696d65223b693a313633343733303236313b7d, '2021-10-21 11:44:21', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('a407581a50ca93fc3ff21f2cb5d08142', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2235383562303434366663363935383336323163643762366561343034333264313838336265326530223b733a343a2274696d65223b693a313633343733313039363b7d6366673a636f72657c613a313a7b733a31313a2264625f74696d657a6f6e65223b733a333a22555443223b7d5f73746166667c613a313a7b733a343a2261757468223b613a323a7b733a343a2264657374223b733a32323a222f737570706f72742f7363702f696e6465782e706870223b733a333a226d7367223b733a32333a2241757468656e7469636174696f6e205265717569726564223b7d7d5f617574687c613a323a7b733a353a227374616666223b613a333a7b733a323a226964223b693a313b733a333a226b6579223b733a31383a226c6f63616c3a443136385f537570706f7274223b733a333a22326661223b4e3b7d733a343a2275736572223b613a323a7b733a323a226964223b693a323b733a333a226b6579223b733a383a22636c69656e743a32223b7d7d3a746f6b656e7c613a323a7b733a353a227374616666223b733a37363a2261613439613762333939323666663336306564636632653334313464363065383a313633343733303935343a3239386566363165376461633232633439383466366562376361613637353135223b733a363a22636c69656e74223b733a37363a2266626364663634323132393138313635336461386366313865383230383161363a313633343733313039363a3239386566363165376461633232633439383466366562376361613637353135223b7d3a3a513a547c693a313b736f72747c613a323a7b693a313b613a323a7b733a333a22636f6c223b693a383b733a333a22646972223b693a313b7d693a383b613a323a7b733a393a227175657565736f7274223b4f3a393a225175657565536f7274223a373a7b733a383a225f636f6c756d6e73223b613a313a7b733a363a22636c6f736564223b623a313b7d733a363a225f6578747261223b4e3b733a323a226874223b613a353a7b733a323a226964223b693a353b733a343a22726f6f74223b4e3b733a343a226e616d65223b733a31313a22436c6f7365642044617465223b733a373a22636f6c756d6e73223b733a31313a225b222d636c6f736564225d223b733a373a2275706461746564223b733a31393a22323032312d31302d32302030363a30353a3138223b7d733a353a226469727479223b613a303a7b7d733a373a225f5f6e65775f5f223b623a303b733a31313a225f5f64656c657465645f5f223b623a303b733a31323a225f5f64656665727265645f5f223b613a303a7b7d7d733a333a22646972223b693a303b7d7d71636f756e74737c613a313a7b733a34383a22636f756e74732e7175657565732e312e67654d715034713072617546615165577034774c4971744939656534446d5159223b613a323a7b733a363a22636f756e7473223b613a31343a7b733a323a227131223b643a323b733a323a227132223b643a313b733a323a227136223b643a313b733a323a227139223b643a313b733a323a227133223b643a313b733a323a227137223b643a303b733a333a22713130223b643a303b733a323a227134223b643a303b733a323a227135223b643a313b733a333a22713131223b643a313b733a323a227138223b643a313b733a333a22713132223b643a313b733a333a22713133223b643a313b733a333a22713134223b643a313b7d733a343a2274696d65223b693a313633343733303935373b7d7d6c61737463726f6e63616c6c7c693a313633343733303935373b3a6d7367737c613a303a7b7d636c69656e743a517c613a313a7b733a363a22737461747573223b733a343a226f70656e223b7d3a513a75736572737c433a383a225175657279536574223a3737313a7b613a31363a7b733a353a226d6f64656c223b733a343a2255736572223b733a31313a22636f6e73747261696e7473223b613a303a7b7d733a31363a22706174685f636f6e73747261696e7473223b613a303a7b7d733a383a226f72646572696e67223b613a313a7b693a303b733a343a226e616d65223b7d733a373a2272656c61746564223b623a303b733a363a2276616c756573223b613a373a7b733a323a226964223b733a323a226964223b733a343a226e616d65223b733a343a226e616d65223b733a32323a2264656661756c745f656d61696c5f5f61646472657373223b733a32323a2264656661756c745f656d61696c5f5f61646472657373223b733a31313a226163636f756e745f5f6964223b733a31313a226163636f756e745f5f6964223b733a31353a226163636f756e745f5f737461747573223b733a31353a226163636f756e745f5f737461747573223b733a373a2263726561746564223b733a373a2263726561746564223b733a373a2275706461746564223b733a373a2275706461746564223b7d733a353a226465666572223b613a303a7b7d733a31303a2261676772656761746564223b623a303b733a31313a22616e6e6f746174696f6e73223b613a313a7b733a31323a227469636b65745f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b733a373a227469636b657473223b733a383a2264697374696e6374223b623a303b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31323a227469636b65745f636f756e74223b7d7d733a353a226578747261223b613a303a7b7d733a383a2264697374696e6374223b613a303a7b7d733a343a226c6f636b223b623a303b733a353a22636861696e223b613a303a7b7d733a373a226f7074696f6e73223b613a303a7b7d733a343a2269746572223b693a323b733a383a22636f6d70696c6572223b733a31333a224d7953716c436f6d70696c6572223b7d7d3a3a513a417c733a303a22223b3a51413a3a736f72747c613a323a7b693a303b733a373a2263726561746564223b693a313b693a303b7d3a513a7461736b737c433a383a225175657279536574223a323535393a7b613a31363a7b733a353a226d6f64656c223b733a343a225461736b223b733a31313a22636f6e73747261696e7473223b613a323a7b693a303b433a313a2251223a3130363a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b693a303b433a313a2251223a35373a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b733a31333a22666c6167735f5f686173626974223b693a313b7d7d7d7d7d7d693a313b433a313a2251223a3338333a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b693a303b433a313a2251223a3333333a7b613a333a7b693a303b693a303b693a313b693a323b693a323b613a333a7b693a303b433a313a2251223a37363a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a323a7b733a31333a22666c6167735f5f686173626974223b693a313b733a383a2273746166665f6964223b693a313b7d7d7d693a313b433a313a2251223a3130303a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a323a7b733a31363a227469636b65745f5f73746166665f6964223b693a313b733a32313a227469636b65745f5f7374617475735f5f7374617465223b733a343a226f70656e223b7d7d7d693a323b433a313a2251223a37333a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b733a31313a22646570745f69645f5f696e223b613a323a7b693a303b693a313b693a313b693a333b7d7d7d7d7d7d7d7d7d7d7d733a31363a22706174685f636f6e73747261696e7473223b613a303a7b7d733a383a226f72646572696e67223b613a313a7b693a303b733a383a222d63726561746564223b7d733a373a2272656c61746564223b623a303b733a363a2276616c756573223b613a31333a7b733a323a226964223b733a323a226964223b733a363a226e756d626572223b733a363a226e756d626572223b733a373a2263726561746564223b733a373a2263726561746564223b733a383a2273746166665f6964223b733a383a2273746166665f6964223b733a373a227465616d5f6964223b733a373a227465616d5f6964223b733a31363a2273746166665f5f66697273746e616d65223b733a31363a2273746166665f5f66697273746e616d65223b733a31353a2273746166665f5f6c6173746e616d65223b733a31353a2273746166665f5f6c6173746e616d65223b733a31303a227465616d5f5f6e616d65223b733a31303a227465616d5f5f6e616d65223b733a31303a22646570745f5f6e616d65223b733a31303a22646570745f5f6e616d65223b733a31323a2263646174615f5f7469746c65223b733a31323a2263646174615f5f7469746c65223b733a353a22666c616773223b733a353a22666c616773223b733a31343a227469636b65745f5f6e756d626572223b733a31343a227469636b65745f5f6e756d626572223b733a31373a227469636b65745f5f7469636b65745f6964223b733a31373a227469636b65745f5f7469636b65745f6964223b7d733a353a226465666572223b613a303a7b7d733a31303a2261676772656761746564223b623a303b733a31313a22616e6e6f746174696f6e73223b613a333a7b733a31323a22636f6c6c61625f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b733a32313a227468726561645f5f636f6c6c61626f7261746f7273223b733a383a2264697374696e6374223b623a313b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31323a22636f6c6c61625f636f756e74223b7d733a31363a226174746163686d656e745f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b4f3a373a2253716c43617365223a353a7b733a353a226361736573223b613a313a7b693a303b613a323a7b693a303b4f3a383a2253716c4669656c64223a353a7b733a353a226c6576656c223b693a303b733a383a226f70657261746f72223b4e3b733a383a226f706572616e6473223b4e3b733a353a22616c696173223b4e3b733a353a226669656c64223b733a33363a227468726561645f5f656e74726965735f5f6174746163686d656e74735f5f696e6c696e65223b7d693a313b4e3b7d7d733a343a22656c7365223b4f3a383a2253716c4669656c64223a353a7b733a353a226c6576656c223b693a303b733a383a226f70657261746f72223b4e3b733a383a226f706572616e6473223b4e3b733a353a22616c696173223b4e3b733a353a226669656c64223b733a32383a227468726561645f5f656e74726965735f5f6174746163686d656e7473223b7d733a353a22616c696173223b4e3b733a343a2266756e63223b733a343a2243415345223b733a343a2261726773223b613a303a7b7d7d733a383a2264697374696e6374223b623a313b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31363a226174746163686d656e745f636f756e74223b7d733a31323a227468726561645f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b4f3a373a2253716c43617365223a353a7b733a353a226361736573223b613a313a7b693a303b613a323a7b693a303b433a313a2251223a37343a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b733a33303a227468726561645f5f656e74726965735f5f666c6167735f5f686173626974223b693a343b7d7d7d693a313b4e3b7d7d733a343a22656c7365223b4f3a383a2253716c4669656c64223a353a7b733a353a226c6576656c223b693a303b733a383a226f70657261746f72223b4e3b733a383a226f706572616e6473223b4e3b733a353a22616c696173223b4e3b733a353a226669656c64223b733a31393a227468726561645f5f656e74726965735f5f6964223b7d733a353a22616c696173223b4e3b733a343a2266756e63223b733a343a2243415345223b733a343a2261726773223b613a303a7b7d7d733a383a2264697374696e6374223b623a313b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31323a227468726561645f636f756e74223b7d7d733a353a226578747261223b613a303a7b7d733a383a2264697374696e6374223b613a303a7b7d733a343a226c6f636b223b623a303b733a353a22636861696e223b613a303a7b7d733a373a226f7074696f6e73223b613a303a7b7d733a343a2269746572223b693a323b733a383a22636f6d70696c6572223b733a31333a224d7953716c436f6d70696c6572223b7d7d, '2021-10-21 11:58:16', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('a40b068e5551a91b185fcdc0d2973b90', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2234393862616364346265366132383636613963646330333638313566343136323762323662333535223b733a343a2274696d65223b693a313633343732313637303b7d, '2021-10-21 09:21:10', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('a8188add26ae9218ab65ea26f4d6e733', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2264336639333362383339623438626662396165643663396662363062323432653432643836646362223b733a343a2274696d65223b693a313633343837393634353b7d, '2021-10-23 05:14:05', NULL, '0', '2401:4900:5020:e79f:b543:ef11:d602:8182', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('aabe776c8697fb3557ce14b7d64e5e55', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2232663066356230376563376336386236613039313433333731616463336536653638346239353937223b733a343a2274696d65223b693a313633343731393933303b7d5f73746166667c613a313a7b733a343a2261757468223b613a313a7b733a333a226d7367223b733a32353a2256616c6964204353524620546f6b656e205265717569726564223b7d7d, '2021-10-21 08:52:10', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('ac7778d9237e0d0cb60d763e8549a6b9', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2261326333326138386164343366383034333935353633626233616438323861306439363763353366223b733a343a2274696d65223b693a313633343732363838353b7d, '2021-10-21 10:48:05', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('aeeb4c791d62a412c50e4b3029fbb002', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2231613965626534356531666434353433366535636566666339633132386662613034646561656162223b733a343a2274696d65223b693a313633343732353935303b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2021-10-21 10:32:30', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('b6806c3971f912e983f617175376f3b5', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2239613236666364643630336430373866363730343561663138336334383734313865313365646339223b733a343a2274696d65223b693a313633373632393335373b7d, '2021-11-24 01:02:37', NULL, '0', '52.114.128.147', 'Mozilla/5.0 (Windows NT 6.1; WOW64) SkypeUriPreview Preview/0.5 skype-url-preview@microsoft.com'),
('baba863f29bc5683659354fe30ba702f', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2234623162626630303466356662306163366337373762613136303463313062613435643265313932223b733a343a2274696d65223b693a313633343732363734343b7d, '2021-10-21 10:45:44', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('bcf29dd72ea540bfb6e329e3e112bb14', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2238343365343834306436323738633631303661303635623161373863373736653364346133326139223b733a343a2274696d65223b693a313633343731393934343b7d5f73746166667c613a313a7b733a343a2261757468223b613a313a7b733a333a226d7367223b733a32353a2256616c6964204353524620546f6b656e205265717569726564223b7d7d, '2021-10-21 08:52:24', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('c169f6627890453c707005b8a61db624', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2233336136343064653936363963633733666531303665616531356638643836343966393938623761223b733a343a2274696d65223b693a313633343732383037323b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2021-10-21 11:07:52', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('ca2c476335ee59ef38fc241cc33b8c19', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2263376635386331323561396531373634666235613737613337373164333266353061383761306138223b733a343a2274696d65223b693a313633343732303038343b7d, '2021-10-21 08:54:44', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36');
INSERT INTO `ost_session` (`session_id`, `session_data`, `session_expire`, `session_updated`, `user_id`, `user_ip`, `user_agent`) VALUES
('cc3a83afc69860c9bb0e9a9e1fde0c6a', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2265636337643436363439663062646238376163613131393833373261656261343961666338356231223b733a343a2274696d65223b693a313633343732393237343b7d5f617574687c613a323a7b733a353a227374616666223b613a333a7b733a323a226964223b693a313b733a333a226b6579223b733a31383a226c6f63616c3a443136385f537570706f7274223b733a333a22326661223b4e3b7d733a343a2275736572223b613a323a7b733a323a226964223b693a323b733a333a226b6579223b733a383a22636c69656e743a32223b7d7d3a746f6b656e7c613a323a7b733a363a22636c69656e74223b733a37363a2235353666336666376632323363306234626133316133326437373032356566663a313633343732393237343a3239386566363165376461633232633439383466366562376361613637353135223b733a353a227374616666223b733a37363a2231656465643832376663366331656164383235353461346436373462353936653a313633343732393235303a3239386566363165376461633232633439383466366562376361613637353135223b7d636c69656e743a517c4e3b6366673a636f72657c613a313a7b733a31313a2264625f74696d657a6f6e65223b733a333a22555443223b7d3a3a513a547c693a313b736f72747c613a313a7b693a313b613a323a7b733a393a227175657565736f7274223b4f3a393a225175657565536f7274223a373a7b733a383a225f636f6c756d6e73223b613a323a7b733a31353a2263646174615f5f7072696f72697479223b623a313b733a31303a226c617374757064617465223b623a313b7d733a363a225f6578747261223b4e3b733a323a226874223b613a353a7b733a323a226964223b693a313b733a343a22726f6f74223b4e3b733a343a226e616d65223b733a33323a225072696f72697479202b204d6f737420526563656e746c792055706461746564223b733a373a22636f6c756d6e73223b733a33343a225b222d63646174615f5f7072696f72697479222c222d6c617374757064617465225d223b733a373a2275706461746564223b733a31393a22323032312d31302d32302030363a30353a3138223b7d733a353a226469727479223b613a303a7b7d733a373a225f5f6e65775f5f223b623a303b733a31313a225f5f64656c657465645f5f223b623a303b733a31323a225f5f64656665727265645f5f223b613a303a7b7d7d733a333a22646972223b693a303b7d7d71636f756e74737c613a313a7b733a34383a22636f756e74732e7175657565732e312e67654d715034713072617546615165577034774c4971744939656534446d5159223b613a323a7b733a363a22636f756e7473223b613a31343a7b733a323a227131223b643a323b733a323a227132223b643a313b733a323a227136223b643a313b733a323a227139223b643a303b733a323a227133223b643a313b733a323a227137223b643a303b733a333a22713130223b643a303b733a323a227134223b643a303b733a323a227135223b643a313b733a333a22713131223b643a303b733a323a227138223b643a303b733a333a22713132223b643a303b733a333a22713133223b643a303b733a333a22713134223b643a303b7d733a343a2274696d65223b693a313633343732393137313b7d7d6c61737463726f6e63616c6c7c693a313633343732393137313b3a553a7469636b6574737c433a383a225175657279536574223a343339323a7b613a31363a7b733a353a226d6f64656c223b733a363a225469636b6574223b733a31313a22636f6e73747261696e7473223b613a323a7b693a303b433a313a2251223a313032313a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b733a31333a227469636b65745f69645f5f696e223b433a383a225175657279536574223a3934373a7b613a31363a7b733a353a226d6f64656c223b733a363a225469636b6574223b733a31313a22636f6e73747261696e7473223b613a313a7b693a303b433a313a2251223a35303a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b733a373a22757365725f6964223b693a323b7d7d7d7d733a31363a22706174685f636f6e73747261696e7473223b613a303a7b7d733a383a226f72646572696e67223b613a303a7b7d733a373a2272656c61746564223b623a303b733a363a2276616c756573223b613a313a7b693a303b733a393a227469636b65745f6964223b7d733a353a226465666572223b613a303a7b7d733a31303a2261676772656761746564223b623a303b733a31313a22616e6e6f746174696f6e73223b613a303a7b7d733a353a226578747261223b613a303a7b7d733a383a2264697374696e6374223b613a303a7b7d733a343a226c6f636b223b623a303b733a353a22636861696e223b613a313a7b693a303b613a323a7b693a303b433a383a225175657279536574223a3436343a7b613a31363a7b733a353a226d6f64656c223b733a363a225469636b6574223b733a31313a22636f6e73747261696e7473223b613a313a7b693a303b433a313a2251223a37343a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b733a33303a227468726561645f5f636f6c6c61626f7261746f72735f5f757365725f6964223b693a323b7d7d7d7d733a31363a22706174685f636f6e73747261696e7473223b613a303a7b7d733a383a226f72646572696e67223b613a303a7b7d733a373a2272656c61746564223b623a303b733a363a2276616c756573223b613a313a7b693a303b733a393a227469636b65745f6964223b7d733a353a226465666572223b613a303a7b7d733a31303a2261676772656761746564223b623a303b733a31313a22616e6e6f746174696f6e73223b613a303a7b7d733a353a226578747261223b613a303a7b7d733a383a2264697374696e6374223b613a303a7b7d733a343a226c6f636b223b623a303b733a353a22636861696e223b613a303a7b7d733a373a226f7074696f6e73223b613a303a7b7d733a343a2269746572223b693a333b733a383a22636f6d70696c6572223b733a31333a224d7953716c436f6d70696c6572223b7d7d693a313b623a303b7d7d733a373a226f7074696f6e73223b613a303a7b7d733a343a2269746572223b693a333b733a383a22636f6d70696c6572223b733a31333a224d7953716c436f6d70696c6572223b7d7d7d7d7d693a313b433a313a2251223a3738323a7b613a333a7b693a303b693a303b693a313b693a323b693a323b613a333a7b693a303b433a313a2251223a3337323a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a323a7b733a31333a227374617475735f5f7374617465223b733a343a226f70656e223b693a303b433a313a2251223a3239303a7b613a333a7b693a303b693a303b693a313b693a323b693a323b613a333a7b733a383a2273746166665f6964223b693a313b733a33343a227468726561645f5f726566657272616c735f5f6167656e745f5f73746166665f6964223b693a313b693a303b433a313a2251223a3137353a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b693a303b433a313a2251223a3132353a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a323a7b733a32353a226368696c645f7468726561645f5f6f626a6563745f74797065223b733a313a2243223b733a34303a226368696c645f7468726561645f5f726566657272616c735f5f6167656e745f5f73746166665f6964223b693a313b7d7d7d7d7d7d7d7d7d7d7d7d693a313b433a313a2251223a3133343a7b613a333a7b693a303b693a303b693a313b693a323b693a323b613a323a7b733a31313a22646570745f69645f5f696e223b613a323a7b693a303b693a313b693a313b693a333b7d733a33313a227468726561645f5f726566657272616c735f5f646570745f5f69645f5f696e223b613a323a7b693a303b693a313b693a313b693a333b7d7d7d7d693a323b433a313a2251223a3139303a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b693a303b433a313a2251223a3134303a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a323a7b733a32353a226368696c645f7468726561645f5f6f626a6563745f74797065223b733a313a2243223b733a33373a226368696c645f7468726561645f5f726566657272616c735f5f646570745f5f69645f5f696e223b613a323a7b693a303b693a313b693a313b693a333b7d7d7d7d7d7d7d7d7d7d7d733a31363a22706174685f636f6e73747261696e7473223b613a313a7b733a343a226c6f636b223b613a313a7b693a303b433a313a2251223a3133313a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b733a31363a226c6f636b5f5f6578706972655f5f6774223b4f3a31313a2253716c46756e6374696f6e223a333a7b733a353a22616c696173223b4e3b733a343a2266756e63223b733a333a224e4f57223b733a343a2261726773223b613a303a7b7d7d7d7d7d7d7d733a383a226f72646572696e67223b613a313a7b693a303b733a383a222d63726561746564223b7d733a373a2272656c61746564223b623a303b733a363a2276616c756573223b613a32313a7b733a383a2273746166665f6964223b733a383a2273746166665f6964223b733a31363a2273746166665f5f66697273746e616d65223b733a31363a2273746166665f5f66697273746e616d65223b733a31353a2273746166665f5f6c6173746e616d65223b733a31353a2273746166665f5f6c6173746e616d65223b733a31303a227465616d5f5f6e616d65223b733a31303a227465616d5f5f6e616d65223b733a373a227465616d5f6964223b733a373a227465616d5f6964223b733a31333a226c6f636b5f5f6c6f636b5f6964223b733a31333a226c6f636b5f5f6c6f636b5f6964223b733a31343a226c6f636b5f5f73746166665f6964223b733a31343a226c6f636b5f5f73746166665f6964223b733a393a2269736f766572647565223b733a393a2269736f766572647565223b733a393a227374617475735f6964223b733a393a227374617475735f6964223b733a31323a227374617475735f5f6e616d65223b733a31323a227374617475735f5f6e616d65223b733a31333a227374617475735f5f7374617465223b733a31333a227374617475735f5f7374617465223b733a363a226e756d626572223b733a363a226e756d626572223b733a31343a2263646174615f5f7375626a656374223b733a31343a2263646174615f5f7375626a656374223b733a393a227469636b65745f6964223b733a393a227469636b65745f6964223b733a363a22736f75726365223b733a363a22736f75726365223b733a373a22646570745f6964223b733a373a22646570745f6964223b733a31303a22646570745f5f6e616d65223b733a31303a22646570745f5f6e616d65223b733a373a22757365725f6964223b733a373a22757365725f6964223b733a32383a22757365725f5f64656661756c745f656d61696c5f5f61646472657373223b733a32383a22757365725f5f64656661756c745f656d61696c5f5f61646472657373223b733a31303a22757365725f5f6e616d65223b733a31303a22757365725f5f6e616d65223b733a31303a226c617374757064617465223b733a31303a226c617374757064617465223b7d733a353a226465666572223b613a303a7b7d733a31303a2261676772656761746564223b623a303b733a31313a22616e6e6f746174696f6e73223b613a333a7b733a31323a22636f6c6c61625f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b733a32313a227468726561645f5f636f6c6c61626f7261746f7273223b733a383a2264697374696e6374223b623a313b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31323a22636f6c6c61625f636f756e74223b7d733a31363a226174746163686d656e745f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b4f3a373a2253716c43617365223a353a7b733a353a226361736573223b613a313a7b693a303b613a323a7b693a303b4f3a383a2253716c4669656c64223a353a7b733a353a226c6576656c223b693a303b733a383a226f70657261746f72223b4e3b733a383a226f706572616e6473223b4e3b733a353a22616c696173223b4e3b733a353a226669656c64223b733a33363a227468726561645f5f656e74726965735f5f6174746163686d656e74735f5f696e6c696e65223b7d693a313b4e3b7d7d733a343a22656c7365223b4f3a383a2253716c4669656c64223a353a7b733a353a226c6576656c223b693a303b733a383a226f70657261746f72223b4e3b733a383a226f706572616e6473223b4e3b733a353a22616c696173223b4e3b733a353a226669656c64223b733a32383a227468726561645f5f656e74726965735f5f6174746163686d656e7473223b7d733a353a22616c696173223b4e3b733a343a2266756e63223b733a343a2243415345223b733a343a2261726773223b613a303a7b7d7d733a383a2264697374696e6374223b623a313b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31363a226174746163686d656e745f636f756e74223b7d733a31323a227468726561645f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b4f3a373a2253716c43617365223a353a7b733a353a226361736573223b613a313a7b693a303b613a323a7b693a303b433a313a2251223a37343a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b733a33303a227468726561645f5f656e74726965735f5f666c6167735f5f686173626974223b693a343b7d7d7d693a313b4e3b7d7d733a343a22656c7365223b4f3a383a2253716c4669656c64223a353a7b733a353a226c6576656c223b693a303b733a383a226f70657261746f72223b4e3b733a383a226f706572616e6473223b4e3b733a353a22616c696173223b4e3b733a353a226669656c64223b733a31393a227468726561645f5f656e74726965735f5f6964223b7d733a353a22616c696173223b4e3b733a343a2266756e63223b733a343a2243415345223b733a343a2261726773223b613a303a7b7d7d733a383a2264697374696e6374223b623a313b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31323a227468726561645f636f756e74223b7d7d733a353a226578747261223b613a303a7b7d733a383a2264697374696e6374223b613a313a7b693a303b733a393a227469636b65745f6964223b7d733a343a226c6f636b223b623a303b733a353a22636861696e223b613a303a7b7d733a373a226f7074696f6e73223b613a303a7b7d733a343a2269746572223b693a323b733a383a22636f6d70696c6572223b733a31333a224d7953716c436f6d70696c6572223b7d7d3a513a75736572737c433a383a225175657279536574223a3737313a7b613a31363a7b733a353a226d6f64656c223b733a343a2255736572223b733a31313a22636f6e73747261696e7473223b613a303a7b7d733a31363a22706174685f636f6e73747261696e7473223b613a303a7b7d733a383a226f72646572696e67223b613a313a7b693a303b733a343a226e616d65223b7d733a373a2272656c61746564223b623a303b733a363a2276616c756573223b613a373a7b733a323a226964223b733a323a226964223b733a343a226e616d65223b733a343a226e616d65223b733a32323a2264656661756c745f656d61696c5f5f61646472657373223b733a32323a2264656661756c745f656d61696c5f5f61646472657373223b733a31313a226163636f756e745f5f6964223b733a31313a226163636f756e745f5f6964223b733a31353a226163636f756e745f5f737461747573223b733a31353a226163636f756e745f5f737461747573223b733a373a2263726561746564223b733a373a2263726561746564223b733a373a2275706461746564223b733a373a2275706461746564223b7d733a353a226465666572223b613a303a7b7d733a31303a2261676772656761746564223b623a303b733a31313a22616e6e6f746174696f6e73223b613a313a7b733a31323a227469636b65745f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b733a373a227469636b657473223b733a383a2264697374696e6374223b623a303b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31323a227469636b65745f636f756e74223b7d7d733a353a226578747261223b613a303a7b7d733a383a2264697374696e6374223b613a303a7b7d733a343a226c6f636b223b623a303b733a353a22636861696e223b613a303a7b7d733a373a226f7074696f6e73223b613a303a7b7d733a343a2269746572223b693a323b733a383a22636f6d70696c6572223b733a31333a224d7953716c436f6d70696c6572223b7d7d3a3a513a417c733a303a22223b3a51413a3a736f72747c613a323a7b693a303b733a373a2263726561746564223b693a313b693a303b7d3a513a7461736b737c433a383a225175657279536574223a323535393a7b613a31363a7b733a353a226d6f64656c223b733a343a225461736b223b733a31313a22636f6e73747261696e7473223b613a323a7b693a303b433a313a2251223a3130363a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b693a303b433a313a2251223a35373a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b733a31333a22666c6167735f5f686173626974223b693a313b7d7d7d7d7d7d693a313b433a313a2251223a3338333a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b693a303b433a313a2251223a3333333a7b613a333a7b693a303b693a303b693a313b693a323b693a323b613a333a7b693a303b433a313a2251223a37363a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a323a7b733a31333a22666c6167735f5f686173626974223b693a313b733a383a2273746166665f6964223b693a313b7d7d7d693a313b433a313a2251223a3130303a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a323a7b733a31363a227469636b65745f5f73746166665f6964223b693a313b733a32313a227469636b65745f5f7374617475735f5f7374617465223b733a343a226f70656e223b7d7d7d693a323b433a313a2251223a37333a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b733a31313a22646570745f69645f5f696e223b613a323a7b693a303b693a313b693a313b693a333b7d7d7d7d7d7d7d7d7d7d7d733a31363a22706174685f636f6e73747261696e7473223b613a303a7b7d733a383a226f72646572696e67223b613a313a7b693a303b733a383a222d63726561746564223b7d733a373a2272656c61746564223b623a303b733a363a2276616c756573223b613a31333a7b733a323a226964223b733a323a226964223b733a363a226e756d626572223b733a363a226e756d626572223b733a373a2263726561746564223b733a373a2263726561746564223b733a383a2273746166665f6964223b733a383a2273746166665f6964223b733a373a227465616d5f6964223b733a373a227465616d5f6964223b733a31363a2273746166665f5f66697273746e616d65223b733a31363a2273746166665f5f66697273746e616d65223b733a31353a2273746166665f5f6c6173746e616d65223b733a31353a2273746166665f5f6c6173746e616d65223b733a31303a227465616d5f5f6e616d65223b733a31303a227465616d5f5f6e616d65223b733a31303a22646570745f5f6e616d65223b733a31303a22646570745f5f6e616d65223b733a31323a2263646174615f5f7469746c65223b733a31323a2263646174615f5f7469746c65223b733a353a22666c616773223b733a353a22666c616773223b733a31343a227469636b65745f5f6e756d626572223b733a31343a227469636b65745f5f6e756d626572223b733a31373a227469636b65745f5f7469636b65745f6964223b733a31373a227469636b65745f5f7469636b65745f6964223b7d733a353a226465666572223b613a303a7b7d733a31303a2261676772656761746564223b623a303b733a31313a22616e6e6f746174696f6e73223b613a333a7b733a31323a22636f6c6c61625f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b733a32313a227468726561645f5f636f6c6c61626f7261746f7273223b733a383a2264697374696e6374223b623a313b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31323a22636f6c6c61625f636f756e74223b7d733a31363a226174746163686d656e745f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b4f3a373a2253716c43617365223a353a7b733a353a226361736573223b613a313a7b693a303b613a323a7b693a303b4f3a383a2253716c4669656c64223a353a7b733a353a226c6576656c223b693a303b733a383a226f70657261746f72223b4e3b733a383a226f706572616e6473223b4e3b733a353a22616c696173223b4e3b733a353a226669656c64223b733a33363a227468726561645f5f656e74726965735f5f6174746163686d656e74735f5f696e6c696e65223b7d693a313b4e3b7d7d733a343a22656c7365223b4f3a383a2253716c4669656c64223a353a7b733a353a226c6576656c223b693a303b733a383a226f70657261746f72223b4e3b733a383a226f706572616e6473223b4e3b733a353a22616c696173223b4e3b733a353a226669656c64223b733a32383a227468726561645f5f656e74726965735f5f6174746163686d656e7473223b7d733a353a22616c696173223b4e3b733a343a2266756e63223b733a343a2243415345223b733a343a2261726773223b613a303a7b7d7d733a383a2264697374696e6374223b623a313b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31363a226174746163686d656e745f636f756e74223b7d733a31323a227468726561645f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b4f3a373a2253716c43617365223a353a7b733a353a226361736573223b613a313a7b693a303b613a323a7b693a303b433a313a2251223a37343a7b613a333a7b693a303b693a303b693a313b693a303b693a323b613a313a7b733a33303a227468726561645f5f656e74726965735f5f666c6167735f5f686173626974223b693a343b7d7d7d693a313b4e3b7d7d733a343a22656c7365223b4f3a383a2253716c4669656c64223a353a7b733a353a226c6576656c223b693a303b733a383a226f70657261746f72223b4e3b733a383a226f706572616e6473223b4e3b733a353a22616c696173223b4e3b733a353a226669656c64223b733a31393a227468726561645f5f656e74726965735f5f6964223b7d733a353a22616c696173223b4e3b733a343a2266756e63223b733a343a2243415345223b733a343a2261726773223b613a303a7b7d7d733a383a2264697374696e6374223b623a313b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31323a227468726561645f636f756e74223b7d7d733a353a226578747261223b613a303a7b7d733a383a2264697374696e6374223b613a303a7b7d733a343a226c6f636b223b623a303b733a353a22636861696e223b613a303a7b7d733a373a226f7074696f6e73223b613a303a7b7d733a343a2269746572223b693a323b733a383a22636f6d70696c6572223b733a31333a224d7953716c436f6d70696c6572223b7d7d, '2021-10-21 11:27:54', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('d04a03f21bdd59613f1f097397dd92dc', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2235393136646237666235353434373530653033373063373133326363636436323863626238376532223b733a343a2274696d65223b693a313633343732303038343b7d5f617574687c613a313a7b733a343a2275736572223b613a303a7b7d7d3a746f6b656e7c613a303a7b7d, '2021-10-21 08:54:44', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('d99ecc7874aee1b0144a2584f8602a41', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2231326536626262343934643536363565616632636165313737343063303161306430626661373162223b733a343a2274696d65223b693a313633343730393937313b7d, '2021-10-21 06:06:12', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('dddcb3233df66825dca013d51497d88a', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2239393863333930616330643031386432363263386463353364333664663034636365386666613763223b733a343a2274696d65223b693a313633343731393738363b7d5f617574687c613a313a7b733a343a2275736572223b4e3b7d, '2021-10-21 08:49:46', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('edd4a5a8317328bddddc142a134b9023', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2232373635616361386262326236376438323035656465323466373664373537356230663737643330223b733a343a2274696d65223b693a313633343733343537333b7d5f73746166667c613a313a7b733a343a2261757468223b613a323a7b733a343a2264657374223b733a31333a222f737570706f72742f7363702f223b733a333a226d7367223b733a32333a2241757468656e7469636174696f6e205265717569726564223b7d7d5f617574687c613a313a7b733a353a227374616666223b613a333a7b733a323a226964223b693a313b733a333a226b6579223b733a31383a226c6f63616c3a443136385f537570706f7274223b733a333a22326661223b4e3b7d7d3a746f6b656e7c613a313a7b733a353a227374616666223b733a37363a2264316639386266306439316361336635393234633733643561373764646263323a313633343733343535343a3966633862373230373465353030623934333039373065373861313365623538223b7d3a3a513a547c693a313b736f72747c613a313a7b693a313b613a323a7b733a393a227175657565736f7274223b4f3a393a225175657565536f7274223a373a7b733a383a225f636f6c756d6e73223b613a323a7b733a31353a2263646174615f5f7072696f72697479223b623a313b733a31303a226c617374757064617465223b623a313b7d733a363a225f6578747261223b4e3b733a323a226874223b613a353a7b733a323a226964223b693a313b733a343a22726f6f74223b4e3b733a343a226e616d65223b733a33323a225072696f72697479202b204d6f737420526563656e746c792055706461746564223b733a373a22636f6c756d6e73223b733a33343a225b222d63646174615f5f7072696f72697479222c222d6c617374757064617465225d223b733a373a2275706461746564223b733a31393a22323032312d31302d32302030363a30353a3138223b7d733a353a226469727479223b613a303a7b7d733a373a225f5f6e65775f5f223b623a303b733a31313a225f5f64656c657465645f5f223b623a303b733a31323a225f5f64656665727265645f5f223b613a303a7b7d7d733a333a22646972223b693a303b7d7d6366673a636f72657c613a313a7b733a31313a2264625f74696d657a6f6e65223b733a333a22555443223b7d71636f756e74737c613a313a7b733a34383a22636f756e74732e7175657565732e312e67654d715034713072617546615165577034774c4971744939656534446d5159223b613a323a7b733a363a22636f756e7473223b613a31343a7b733a323a227131223b643a323b733a323a227132223b643a313b733a323a227136223b643a313b733a323a227139223b643a313b733a323a227133223b643a313b733a323a227137223b643a303b733a333a22713130223b643a303b733a323a227134223b643a303b733a323a227135223b643a313b733a333a22713131223b643a313b733a323a227138223b643a313b733a333a22713132223b643a313b733a333a22713133223b643a313b733a333a22713134223b643a313b7d733a343a2274696d65223b693a313633343733343434383b7d7d6c61737463726f6e63616c6c7c693a313633343733343434383b3a513a75736572737c433a383a225175657279536574223a3737313a7b613a31363a7b733a353a226d6f64656c223b733a343a2255736572223b733a31313a22636f6e73747261696e7473223b613a303a7b7d733a31363a22706174685f636f6e73747261696e7473223b613a303a7b7d733a383a226f72646572696e67223b613a313a7b693a303b733a343a226e616d65223b7d733a373a2272656c61746564223b623a303b733a363a2276616c756573223b613a373a7b733a323a226964223b733a323a226964223b733a343a226e616d65223b733a343a226e616d65223b733a32323a2264656661756c745f656d61696c5f5f61646472657373223b733a32323a2264656661756c745f656d61696c5f5f61646472657373223b733a31313a226163636f756e745f5f6964223b733a31313a226163636f756e745f5f6964223b733a31353a226163636f756e745f5f737461747573223b733a31353a226163636f756e745f5f737461747573223b733a373a2263726561746564223b733a373a2263726561746564223b733a373a2275706461746564223b733a373a2275706461746564223b7d733a353a226465666572223b613a303a7b7d733a31303a2261676772656761746564223b623a303b733a31313a22616e6e6f746174696f6e73223b613a313a7b733a31323a227469636b65745f636f756e74223b4f3a31323a2253716c416767726567617465223a353a7b733a343a2266756e63223b733a353a22434f554e54223b733a343a2265787072223b733a373a227469636b657473223b733a383a2264697374696e6374223b623a303b733a31303a22636f6e73747261696e74223b623a303b733a353a22616c696173223b733a31323a227469636b65745f636f756e74223b7d7d733a353a226578747261223b613a303a7b7d733a383a2264697374696e6374223b613a303a7b7d733a343a226c6f636b223b623a303b733a353a22636861696e223b613a303a7b7d733a373a226f7074696f6e73223b613a303a7b7d733a343a2269746572223b693a323b733a383a22636f6d70696c6572223b733a31333a224d7953716c436f6d70696c6572223b7d7d, '2021-10-21 12:56:13', NULL, '1', '172.126.35.202', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36'),
('f2bc6fdbcd1049f43426dafce1d56864', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2232656435313965323566663261353937333261363761636132303836393864386637643266396239223b733a343a2274696d65223b693a313633343732303531373b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2021-10-21 09:01:57', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('f62e7b9be274b5b005445e5fd029bdc8', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2266653138666639383036666365303762646132653961383664353261386366343438656239333639223b733a343a2274696d65223b693a313633343732383039343b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2021-10-21 11:08:14', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362'),
('f9a9576b35c7b60b74011b6451a70937', 0x637372667c613a323a7b733a353a22746f6b656e223b733a34303a2233636330656564386663363232313564663063656666363037356363303737313033363130333963223b733a343a2274696d65223b693a313633343732393839313b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2021-10-21 11:38:11', NULL, '0', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36 Edge/18.18362');

-- --------------------------------------------------------

--
-- Table structure for table `ost_sla`
--

CREATE TABLE `ost_sla` (
  `id` int(11) UNSIGNED NOT NULL,
  `schedule_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 3,
  `grace_period` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(64) NOT NULL DEFAULT '',
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_sla`
--

INSERT INTO `ost_sla` (`id`, `schedule_id`, `flags`, `grace_period`, `name`, `notes`, `created`, `updated`) VALUES
(1, 0, 3, 18, 'Default SLA', NULL, '2021-10-20 06:05:15', '2021-10-20 06:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `ost_staff`
--

CREATE TABLE `ost_staff` (
  `staff_id` int(11) UNSIGNED NOT NULL,
  `dept_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `username` varchar(32) NOT NULL DEFAULT '',
  `firstname` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `passwd` varchar(128) DEFAULT NULL,
  `backend` varchar(32) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(24) NOT NULL DEFAULT '',
  `phone_ext` varchar(6) DEFAULT NULL,
  `mobile` varchar(24) NOT NULL DEFAULT '',
  `signature` text NOT NULL,
  `lang` varchar(16) DEFAULT NULL,
  `timezone` varchar(64) DEFAULT NULL,
  `locale` varchar(16) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT 1,
  `isadmin` tinyint(1) NOT NULL DEFAULT 0,
  `isvisible` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `onvacation` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `assigned_only` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `show_assigned_tickets` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `change_passwd` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `max_page_size` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `auto_refresh_rate` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `default_signature_type` enum('none','mine','dept') NOT NULL DEFAULT 'none',
  `default_paper_size` enum('Letter','Legal','Ledger','A4','A3') NOT NULL DEFAULT 'Letter',
  `extra` text DEFAULT NULL,
  `permissions` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `passwdreset` datetime DEFAULT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_staff`
--

INSERT INTO `ost_staff` (`staff_id`, `dept_id`, `role_id`, `username`, `firstname`, `lastname`, `passwd`, `backend`, `email`, `phone`, `phone_ext`, `mobile`, `signature`, `lang`, `timezone`, `locale`, `notes`, `isactive`, `isadmin`, `isvisible`, `onvacation`, `assigned_only`, `show_assigned_tickets`, `change_passwd`, `max_page_size`, `auto_refresh_rate`, `default_signature_type`, `default_paper_size`, `extra`, `permissions`, `created`, `lastlogin`, `passwdreset`, `updated`) VALUES
(1, 1, 1, 'D168_Support', 'Don', 'Mahmood', '$2a$08$5lQpdKsLzVgR6LpkGjhgUeohtw9LpsZeR/VgW2kSupzHsP7Pv9JIO', NULL, 'don@z2squared.com', '', NULL, '', '', NULL, NULL, NULL, NULL, 1, 1, 1, 0, 0, 0, 0, 25, 0, 'none', 'Letter', '{\"browser_lang\":\"en_US\"}', '{\"user.create\":1,\"user.delete\":1,\"user.edit\":1,\"user.manage\":1,\"user.dir\":1,\"org.create\":1,\"org.delete\":1,\"org.edit\":1,\"faq.manage\":1,\"visibility.agents\":1,\"emails.banlist\":1,\"visibility.departments\":1}', '2021-10-20 06:05:18', '2021-10-20 12:42:13', '2021-10-20 06:05:18', '2021-10-20 12:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `ost_staff_dept_access`
--

CREATE TABLE `ost_staff_dept_access` (
  `staff_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `dept_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_staff_dept_access`
--

INSERT INTO `ost_staff_dept_access` (`staff_id`, `dept_id`, `role_id`, `flags`) VALUES
(1, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ost_syslog`
--

CREATE TABLE `ost_syslog` (
  `log_id` int(11) UNSIGNED NOT NULL,
  `log_type` enum('Debug','Warning','Error') NOT NULL,
  `title` varchar(255) NOT NULL,
  `log` text NOT NULL,
  `logger` varchar(64) NOT NULL,
  `ip_address` varchar(64) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_syslog`
--

INSERT INTO `ost_syslog` (`log_id`, `log_type`, `title`, `log`, `logger`, `ip_address`, `created`, `updated`) VALUES
(1, 'Debug', 'osTicket installed!', 'Congratulations osTicket basic installation completed!\n\nThank you for choosing osTicket!', '', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', '2021-10-20 06:05:19', '2021-10-20 06:05:19'),
(2, 'Warning', 'Invalid CSRF Token __CSRFToken__', 'Invalid CSRF token [cf53146f296f709a893cafdc4354d758b3f095f0] on https://app.decision168.com:443/support/scp/login.php', '', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', '2021-10-20 08:52:10', '2021-10-20 08:52:10'),
(3, 'Warning', 'Invalid CSRF Token __CSRFToken__', 'Invalid CSRF token [35f9c6ccc92da8a86ff7182e2f5c5dcfe915123e] on https://app.decision168.com:443/support/scp/login.php', '', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', '2021-10-20 08:52:24', '2021-10-20 08:52:24'),
(4, 'Warning', 'Invalid CSRF Token __CSRFToken__', 'Invalid CSRF token [96d48a0f433199630d03246c945ffd01ba49c49d] on https://app.decision168.com:443/support/scp/login.php', '', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', '2021-10-20 08:52:47', '2021-10-20 08:52:47'),
(5, 'Error', 'DB Error #1054', '[INSERT INTO `ost_user__cdata` SET `phone`=\'777777X91\', `user_id`= 2 ON DUPLICATE KEY UPDATE `phone`=\'777777X91\'] Unknown column \'phone\' in \'field list\'<br /> <br /> ---- Backtrace ----<br /> #0 (root)/include/mysqli.php(201): osTicket-&gt;logDBError(\'DB Error #1054\', \'[INSERT INTO `o...\')<br /> #1 (root)/include/class.dynamic_forms.php(381): db_query(\'INSERT INTO `os...\')<br /> #2 (root)/include/class.dynamic_forms.php(396): DynamicForm::updateDynamicDataView(Object(DynamicFormEntryAnswer), NULL)<br /> #3 (root)/include/class.signal.php(98): DynamicForm::updateDynamicFormEntryAnswer(Object(DynamicFormEntryAnswer), NULL)<br /> #4 (root)/include/class.orm.php(680): Signal::send(\'model.created\', Object(DynamicFormEntryAnswer))<br /> #5 (root)/include/class.dynamic_forms.php(1536): VerySimpleModel-&gt;save(false)<br /> #6 (root)/include/class.dynamic_forms.php(1378): DynamicFormEntryAnswer-&gt;save(false)<br /> #7 (root)/include/class.dynamic_forms.php(1317): DynamicFormEntry-&gt;saveAnswers(NULL, false)<br /> #8 (root)/include/class.user.php(348): DynamicFormEntry-&gt;save()<br /> #9 (root)/include/class.user.php(421): User-&gt;addForm(Object(UserForm), 1, Array)<br /> #10 (root)/include/class.user.php(249): User-&gt;addDynamicData(Array)<br /> #11 (root)/include/class.user.php(287): User::fromVars(Array, true)<br /> #12 (root)/account.php(100): User::fromForm(Object(SimpleForm))<br /> #13 {main}', '', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', '2021-10-20 08:54:17', '2021-10-20 08:54:17'),
(6, 'Error', 'DB Error #1054', '[INSERT INTO `ost_user__cdata` SET `notes`=\'\', `user_id`= 2 ON DUPLICATE KEY UPDATE `notes`=\'\'] Unknown column \'notes\' in \'field list\'<br /> <br /> ---- Backtrace ----<br /> #0 (root)/include/mysqli.php(201): osTicket-&gt;logDBError(\'DB Error #1054\', \'[INSERT INTO `o...\')<br /> #1 (root)/include/class.dynamic_forms.php(381): db_query(\'INSERT INTO `os...\')<br /> #2 (root)/include/class.dynamic_forms.php(396): DynamicForm::updateDynamicDataView(Object(DynamicFormEntryAnswer), NULL)<br /> #3 (root)/include/class.signal.php(98): DynamicForm::updateDynamicFormEntryAnswer(Object(DynamicFormEntryAnswer), NULL)<br /> #4 (root)/include/class.orm.php(680): Signal::send(\'model.created\', Object(DynamicFormEntryAnswer))<br /> #5 (root)/include/class.dynamic_forms.php(1536): VerySimpleModel-&gt;save(false)<br /> #6 (root)/include/class.dynamic_forms.php(1378): DynamicFormEntryAnswer-&gt;save(false)<br /> #7 (root)/include/class.dynamic_forms.php(1317): DynamicFormEntry-&gt;saveAnswers(NULL, false)<br /> #8 (root)/include/class.user.php(348): DynamicFormEntry-&gt;save()<br /> #9 (root)/include/class.user.php(421): User-&gt;addForm(Object(UserForm), 1, Array)<br /> #10 (root)/include/class.user.php(249): User-&gt;addDynamicData(Array)<br /> #11 (root)/include/class.user.php(287): User::fromVars(Array, true)<br /> #12 (root)/account.php(100): User::fromForm(Object(SimpleForm))<br /> #13 {main}', '', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', '2021-10-20 08:54:17', '2021-10-20 08:54:17'),
(7, 'Warning', 'Invalid CSRF Token __CSRFToken__', 'Invalid CSRF token [2ed519e25ff2a59732a67aca208698d8f7d2f9b9] on https://app.decision168.com:443/support/scp/login.php', '', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', '2021-10-20 09:02:19', '2021-10-20 09:02:19'),
(8, 'Warning', 'Invalid CSRF Token __CSRFToken__', 'Invalid CSRF token [c969a3ee8fcbdec1cc0c4dc974cdde61f7261f1f] on https://app.decision168.com:443/support/login.php', '', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', '2021-10-20 09:53:07', '2021-10-20 09:53:07'),
(9, 'Warning', 'Invalid CSRF Token __CSRFToken__', 'Invalid CSRF token [33a640de9669cc73fe106eae15f8d8649f998b7a] on https://app.decision168.com:443/support/scp/login.php', '', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', '2021-10-20 11:08:13', '2021-10-20 11:08:13'),
(10, 'Warning', 'Invalid CSRF Token __CSRFToken__', 'Invalid CSRF token [fe18ff9806fce07bda2e9a86d52a8cf448eb9369] on https://app.decision168.com:443/support/scp/login.php', '', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', '2021-10-20 11:08:30', '2021-10-20 11:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `ost_task`
--

CREATE TABLE `ost_task` (
  `id` int(11) UNSIGNED NOT NULL,
  `object_id` int(11) NOT NULL DEFAULT 0,
  `object_type` char(1) NOT NULL,
  `number` varchar(20) DEFAULT NULL,
  `dept_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `staff_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `team_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `lock_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `duedate` datetime DEFAULT NULL,
  `closed` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_task__cdata`
--

CREATE TABLE `ost_task__cdata` (
  `task_id` int(11) UNSIGNED NOT NULL,
  `title` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_team`
--

CREATE TABLE `ost_team` (
  `team_id` int(10) UNSIGNED NOT NULL,
  `lead_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(125) NOT NULL DEFAULT '',
  `notes` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_team`
--

INSERT INTO `ost_team` (`team_id`, `lead_id`, `flags`, `name`, `notes`, `created`, `updated`) VALUES
(1, 0, 1, 'Level I Support', 'Tier 1 support, responsible for the initial iteraction with customers', '2021-10-20 06:05:18', '2021-10-20 06:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `ost_team_member`
--

CREATE TABLE `ost_team_member` (
  `team_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_thread`
--

CREATE TABLE `ost_thread` (
  `id` int(11) UNSIGNED NOT NULL,
  `object_id` int(11) UNSIGNED NOT NULL,
  `object_type` char(1) NOT NULL,
  `extra` text DEFAULT NULL,
  `lastresponse` datetime DEFAULT NULL,
  `lastmessage` datetime DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_thread`
--

INSERT INTO `ost_thread` (`id`, `object_id`, `object_type`, `extra`, `lastresponse`, `lastmessage`, `created`) VALUES
(1, 1, 'T', NULL, NULL, '2021-10-20 06:05:19', '2021-10-20 06:05:19'),
(2, 2, 'T', NULL, '2021-10-20 08:56:44', '2021-10-20 08:56:00', '2021-10-20 08:56:00'),
(3, 3, 'T', NULL, '2021-10-20 11:46:42', '2021-10-20 11:45:25', '2021-10-20 11:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `ost_thread_collaborator`
--

CREATE TABLE `ost_thread_collaborator` (
  `id` int(11) UNSIGNED NOT NULL,
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `thread_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `role` char(1) NOT NULL DEFAULT 'M',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_thread_entry`
--

CREATE TABLE `ost_thread_entry` (
  `id` int(11) UNSIGNED NOT NULL,
  `pid` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `thread_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `staff_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `type` char(1) NOT NULL DEFAULT '',
  `flags` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `poster` varchar(128) NOT NULL DEFAULT '',
  `editor` int(10) UNSIGNED DEFAULT NULL,
  `editor_type` char(1) DEFAULT NULL,
  `source` varchar(32) NOT NULL DEFAULT '',
  `title` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `format` varchar(16) NOT NULL DEFAULT 'html',
  `ip_address` varchar(64) NOT NULL DEFAULT '',
  `extra` text DEFAULT NULL,
  `recipients` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_thread_entry`
--

INSERT INTO `ost_thread_entry` (`id`, `pid`, `thread_id`, `staff_id`, `user_id`, `type`, `flags`, `poster`, `editor`, `editor_type`, `source`, `title`, `body`, `format`, `ip_address`, `extra`, `recipients`, `created`, `updated`) VALUES
(1, 0, 1, 0, 1, 'M', 65, 'osTicket Support', NULL, NULL, 'Web', 'osTicket Installed!', ' <p>Thank you for choosing osTicket. </p> <p>Please make sure you join the <a href=\"https://forum.osticket.com\">osTicket forums</a> and our <a href=\"https://osticket.com\">mailing list</a> to stay up to date on the latest news, security alerts and updates. The osTicket forums are also a great place to get assistance, guidance, tips, and help from other osTicket users. In addition to the forums, the osTicket wiki provides a useful collection of educational materials, documentation, and notes from the community. We welcome your contributions to the osTicket community. </p> <p>If you are looking for a greater level of support, we provide professional services and commercial support with guaranteed response times, and access to the core development team. We can also help customize osTicket or even add new features to the system to meet your unique needs. </p> <p>If the idea of managing and upgrading this osTicket installation is daunting, you can try osTicket as a hosted service at <a href=\"https://supportsystem.com\">https://supportsystem.com/</a> -- no installation required and we can import your data! With SupportSystem\'s turnkey infrastructure, you get osTicket at its best, leaving you free to focus on your customers without the burden of making sure the application is stable, maintained, and secure. </p> <p>Cheers, </p> <p>-<br /> osTicket Team https://osticket.com/ </p> <p><strong>PS.</strong> Don\'t just make customers happy, make happy customers! </p>', 'html', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', NULL, NULL, '2021-10-20 06:05:19', '0000-00-00 00:00:00'),
(2, 0, 2, 0, 2, 'M', 65, 'uzma karjikar', NULL, NULL, '', NULL, '<p>test first ticket detail</p>', 'html', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', NULL, NULL, '2021-10-20 08:56:00', '0000-00-00 00:00:00'),
(3, 2, 2, 1, 0, 'R', 576, 'Don Mahmood', NULL, NULL, '', NULL, '<p>reply to first ticket</p>', 'html', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', NULL, '{\"to\":{\"2\":\"uzma karjikar <uzmakarjikar@gmail.com>\"}}', '2021-10-20 08:56:44', '0000-00-00 00:00:00'),
(4, 0, 3, 0, 2, 'M', 65, 'uzma karjikar', NULL, NULL, '', NULL, '<p>testing feedback ticket</p>', 'html', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', NULL, NULL, '2021-10-20 11:45:25', '0000-00-00 00:00:00'),
(5, 4, 3, 1, 0, 'R', 576, 'Don Mahmood', NULL, NULL, '', NULL, '<p>working</p>', 'html', '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', NULL, '{\"to\":{\"2\":\"uzma karjikar <uzmakarjikar@gmail.com>\"}}', '2021-10-20 11:46:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ost_thread_entry_email`
--

CREATE TABLE `ost_thread_entry_email` (
  `id` int(11) UNSIGNED NOT NULL,
  `thread_entry_id` int(11) UNSIGNED NOT NULL,
  `email_id` int(11) UNSIGNED DEFAULT NULL,
  `mid` varchar(255) NOT NULL,
  `headers` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_thread_entry_merge`
--

CREATE TABLE `ost_thread_entry_merge` (
  `id` int(11) UNSIGNED NOT NULL,
  `thread_entry_id` int(11) UNSIGNED NOT NULL,
  `data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_thread_event`
--

CREATE TABLE `ost_thread_event` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `thread_type` char(1) NOT NULL DEFAULT '',
  `event_id` int(11) UNSIGNED DEFAULT NULL,
  `staff_id` int(11) UNSIGNED NOT NULL,
  `team_id` int(11) UNSIGNED NOT NULL,
  `dept_id` int(11) UNSIGNED NOT NULL,
  `topic_id` int(11) UNSIGNED NOT NULL,
  `data` varchar(1024) DEFAULT NULL COMMENT 'Encoded differences',
  `username` varchar(128) NOT NULL DEFAULT 'SYSTEM',
  `uid` int(11) UNSIGNED DEFAULT NULL,
  `uid_type` char(1) NOT NULL DEFAULT 'S',
  `annulled` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_thread_event`
--

INSERT INTO `ost_thread_event` (`id`, `thread_id`, `thread_type`, `event_id`, `staff_id`, `team_id`, `dept_id`, `topic_id`, `data`, `username`, `uid`, `uid_type`, `annulled`, `timestamp`) VALUES
(1, 1, 'T', 1, 0, 0, 1, 1, NULL, 'SYSTEM', 1, 'U', 0, '2021-10-20 06:05:19'),
(2, 2, 'T', 1, 0, 0, 1, 2, NULL, 'uzma karjikar', 2, 'U', 0, '2021-10-20 08:56:00'),
(3, 3, 'T', 1, 0, 0, 1, 2, NULL, 'SYSTEM', 2, 'U', 0, '2021-10-20 11:45:25'),
(4, 3, 'T', 2, 1, 0, 1, 2, '{\"status\":[3,\"Closed\"]}', 'D168_Support', 1, 'S', 0, '2021-10-20 11:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `ost_thread_referral`
--

CREATE TABLE `ost_thread_referral` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(11) UNSIGNED NOT NULL,
  `object_id` int(11) UNSIGNED NOT NULL,
  `object_type` char(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_thread_referral`
--

INSERT INTO `ost_thread_referral` (`id`, `thread_id`, `object_id`, `object_type`, `created`) VALUES
(1, 3, 1, 'S', '2021-10-20 11:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `ost_ticket`
--

CREATE TABLE `ost_ticket` (
  `ticket_id` int(11) UNSIGNED NOT NULL,
  `ticket_pid` int(11) UNSIGNED DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_email_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `status_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `dept_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sla_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `topic_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `staff_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `team_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `email_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `lock_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `ip_address` varchar(64) NOT NULL DEFAULT '',
  `source` enum('Web','Email','Phone','API','Other') NOT NULL DEFAULT 'Other',
  `source_extra` varchar(40) DEFAULT NULL,
  `isoverdue` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `isanswered` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `duedate` datetime DEFAULT NULL,
  `est_duedate` datetime DEFAULT NULL,
  `reopened` datetime DEFAULT NULL,
  `closed` datetime DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_ticket`
--

INSERT INTO `ost_ticket` (`ticket_id`, `ticket_pid`, `number`, `user_id`, `user_email_id`, `status_id`, `dept_id`, `sla_id`, `topic_id`, `staff_id`, `team_id`, `email_id`, `lock_id`, `flags`, `sort`, `ip_address`, `source`, `source_extra`, `isoverdue`, `isanswered`, `duedate`, `est_duedate`, `reopened`, `closed`, `lastupdate`, `created`, `updated`) VALUES
(1, NULL, '594075', 1, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Web', NULL, 0, 0, NULL, '2021-10-22 06:05:19', NULL, NULL, '2021-10-20 06:05:19', '2021-10-20 06:05:19', '2021-10-20 06:05:19'),
(2, NULL, '326604', 2, 0, 1, 1, 1, 2, 1, 0, 0, 0, 0, 0, '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Web', NULL, 0, 1, NULL, '2021-10-22 08:56:00', NULL, NULL, '2021-10-20 08:56:00', '2021-10-20 08:56:00', '2021-10-20 08:56:45'),
(3, NULL, '978307', 2, 0, 3, 1, 1, 2, 1, 0, 0, 0, 0, 0, '2401:4900:5020:e79f:782f:5931:2bf5:8ba5', 'Web', NULL, 0, 1, NULL, '2021-10-22 11:30:00', NULL, '2021-10-20 11:46:42', '2021-10-20 11:46:42', '2021-10-20 11:45:25', '2021-10-20 11:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `ost_ticket_priority`
--

CREATE TABLE `ost_ticket_priority` (
  `priority_id` tinyint(4) NOT NULL,
  `priority` varchar(60) NOT NULL DEFAULT '',
  `priority_desc` varchar(30) NOT NULL DEFAULT '',
  `priority_color` varchar(7) NOT NULL DEFAULT '',
  `priority_urgency` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `ispublic` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_ticket_priority`
--

INSERT INTO `ost_ticket_priority` (`priority_id`, `priority`, `priority_desc`, `priority_color`, `priority_urgency`, `ispublic`) VALUES
(1, 'low', 'Low', '#DDFFDD', 4, 1),
(2, 'normal', 'Normal', '#FFFFF0', 3, 1),
(3, 'high', 'High', '#FEE7E7', 2, 1),
(4, 'emergency', 'Emergency', '#FEE7E7', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ost_ticket_status`
--

CREATE TABLE `ost_ticket_status` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `state` varchar(16) DEFAULT NULL,
  `mode` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `flags` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `properties` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_ticket_status`
--

INSERT INTO `ost_ticket_status` (`id`, `name`, `state`, `mode`, `flags`, `sort`, `properties`, `created`, `updated`) VALUES
(1, 'Open', 'open', 3, 0, 1, '{\"description\":\"Open tickets.\"}', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(2, 'Resolved', 'closed', 1, 0, 2, '{\"allowreopen\":true,\"reopenstatus\":0,\"description\":\"Resolved tickets\"}', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(3, 'Closed', 'closed', 3, 0, 3, '{\"allowreopen\":true,\"reopenstatus\":0,\"description\":\"Closed tickets. Tickets will still be accessible on client and staff panels.\"}', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(4, 'Archived', 'archived', 3, 0, 4, '{\"description\":\"Tickets only adminstratively available but no longer accessible on ticket queues and client panel.\"}', '2021-10-20 06:05:18', '0000-00-00 00:00:00'),
(5, 'Deleted', 'deleted', 3, 0, 5, '{\"description\":\"Tickets queued for deletion. Not accessible on ticket queues.\"}', '2021-10-20 06:05:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ost_ticket__cdata`
--

CREATE TABLE `ost_ticket__cdata` (
  `ticket_id` int(11) UNSIGNED NOT NULL,
  `subject` mediumtext DEFAULT NULL,
  `priority` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_ticket__cdata`
--

INSERT INTO `ost_ticket__cdata` (`ticket_id`, `subject`, `priority`) VALUES
(1, 'osTicket Installed!', '2'),
(2, 'test first ticket', '1'),
(3, 'test feedback ticket', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ost_translation`
--

CREATE TABLE `ost_translation` (
  `id` int(11) UNSIGNED NOT NULL,
  `object_hash` char(16) CHARACTER SET ascii DEFAULT NULL,
  `type` enum('phrase','article','override') DEFAULT NULL,
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `revision` int(11) UNSIGNED DEFAULT NULL,
  `agent_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `lang` varchar(16) NOT NULL DEFAULT '',
  `text` mediumtext NOT NULL,
  `source_text` text DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ost_user`
--

CREATE TABLE `ost_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `org_id` int(10) UNSIGNED NOT NULL,
  `default_email_id` int(10) NOT NULL,
  `status` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_user`
--

INSERT INTO `ost_user` (`id`, `org_id`, `default_email_id`, `status`, `name`, `created`, `updated`) VALUES
(1, 1, 1, 0, 'osTicket Support', '2021-10-20 06:05:19', '2021-10-20 06:05:19'),
(2, 0, 2, 0, 'uzma karjikar', '2021-10-20 08:54:16', '2021-10-20 08:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `ost_user_account`
--

CREATE TABLE `ost_user_account` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `timezone` varchar(64) DEFAULT NULL,
  `lang` varchar(16) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `passwd` varchar(128) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `backend` varchar(32) DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `registered` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_user_account`
--

INSERT INTO `ost_user_account` (`id`, `user_id`, `status`, `timezone`, `lang`, `username`, `passwd`, `backend`, `extra`, `registered`) VALUES
(1, 2, 1, 'Asia/Kolkata', NULL, NULL, '$2a$08$nVKynJEgi.eGT/felcZIYutRkSOTFXb4v589iB.ix2JQT9Zs43FQ2', NULL, '{\"browser_lang\":\"en_US\"}', '2021-10-20 08:54:17');

-- --------------------------------------------------------

--
-- Table structure for table `ost_user_email`
--

CREATE TABLE `ost_user_email` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `flags` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_user_email`
--

INSERT INTO `ost_user_email` (`id`, `user_id`, `flags`, `address`) VALUES
(1, 1, 0, 'support@osticket.com'),
(2, 2, 0, 'uzmakarjikar@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `ost_user__cdata`
--

CREATE TABLE `ost_user__cdata` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `email` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost_user__cdata`
--

INSERT INTO `ost_user__cdata` (`user_id`, `email`) VALUES
(1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ost__search`
--

CREATE TABLE `ost__search` (
  `object_type` varchar(8) NOT NULL,
  `object_id` int(11) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ost__search`
--

INSERT INTO `ost__search` (`object_type`, `object_id`, `title`, `content`) VALUES
('H', 1, 'osTicket Installed!', 'Thank you for choosing osTicket. Please make sure you join the osTicket forums and our mailing list to stay up to date on the latest news, security alerts and updates. The osTicket forums are also a great place to get assistance, guidance, tips, and help from other osTicket users. In addition to the forums, the osTicket wiki provides a useful collection of educational materials, documentation, and notes from the community. We welcome your contributions to the osTicket community. If you are looking for a greater level of support, we provide professional services and commercial support with guaranteed response times, and access to the core development team. We can also help customize osTicket or even add new features to the system to meet your unique needs. If the idea of managing and upgrading this osTicket installation is daunting, you can try osTicket as a hosted service at https://supportsystem.com/ -- no installation required and we can import your data! With SupportSystem\'s turnkey infrastructure, you get osTicket at its best, leaving you free to focus on your customers without the burden of making sure the application is stable, maintained, and secure. Cheers, - osTicket Team https://osticket.com/ PS. Don\'t just make customers happy, make happy customers!'),
('H', 2, '', 'test first ticket detail'),
('H', 3, '', 'reply to first ticket'),
('H', 4, '', 'testing feedback ticket'),
('H', 5, '', 'working'),
('O', 1, 'osTicket', '1120 5th Street Alexandria, LA 71301\n(318) 290-3674\nhttps://osticket.com\nNot only do we develop the software, we also use it to manage support for osTicket. Let us help you quickly implement and leverage the full potential of osTicket\'s features and functionality. Contact us for professional support or visit our website for documentation and community support.'),
('T', 1, '594075 osTicket Installed!', ''),
('T', 2, '326604 test first ticket', 'test first ticket'),
('T', 3, '978307 test feedback ticket', 'test feedback ticket'),
('U', 1, 'osTicket Support', 'support@osticket.com'),
('U', 2, 'uzma karjikar', ' uzmakarjikar@gmail.com\nuzmakarjikar@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

CREATE TABLE `pricing` (
  `pack_id` int(11) NOT NULL,
  `stripe_link` varchar(30) NOT NULL,
  `stripe_product_id` text NOT NULL,
  `stripe_price_id` text NOT NULL,
  `pack_name` text NOT NULL,
  `pack_validity` text NOT NULL,
  `pack_price` varchar(50) NOT NULL,
  `pack_portfolio` text NOT NULL,
  `pack_goals` text NOT NULL,
  `pack_goals_strategies` text NOT NULL,
  `pack_goals_strategies_projects` text NOT NULL,
  `pack_projects` text NOT NULL,
  `pack_team_members` text NOT NULL,
  `pack_tasks` text NOT NULL,
  `pack_storage` text NOT NULL,
  `pack_acc_tracking` text NOT NULL,
  `pack_doc_collaboration` text NOT NULL,
  `pack_kanban_boards` text NOT NULL,
  `pack_motivator` text NOT NULL,
  `pack_internal_chat` text NOT NULL,
  `pack_content_planner` text NOT NULL,
  `pack_data_recovery` text NOT NULL,
  `pack_tagline` text NOT NULL,
  `pack_created_date` date NOT NULL,
  `pack_status` varchar(50) NOT NULL,
  `custom_pack` varchar(30) NOT NULL,
  `custom_cid` int(11) NOT NULL,
  `custom_reg_id` int(11) NOT NULL,
  `coupon_pack` varchar(50) NOT NULL,
  `validity_period` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`pack_id`, `stripe_link`, `stripe_product_id`, `stripe_price_id`, `pack_name`, `pack_validity`, `pack_price`, `pack_portfolio`, `pack_goals`, `pack_goals_strategies`, `pack_goals_strategies_projects`, `pack_projects`, `pack_team_members`, `pack_tasks`, `pack_storage`, `pack_acc_tracking`, `pack_doc_collaboration`, `pack_kanban_boards`, `pack_motivator`, `pack_internal_chat`, `pack_content_planner`, `pack_data_recovery`, `pack_tagline`, `pack_created_date`, `pack_status`, `custom_pack`, `custom_cid`, `custom_reg_id`, `coupon_pack`, `validity_period`) VALUES
(1, 'yes', 'prod_Ll5ddS3i6uEpEC', 'price_1L3ZS0ECBZEQ4z2NVIXRaZjk', 'Solo', 'free forever', '0', '1', '3', '5', '2', '10', 'unlimited', 'unlimited', '100 MB', '', '', '', '', '', '52', '', 'For individuals looking to organize & track their work', '2022-06-09', 'active', 'no', 0, 0, 'no', ''),
(2, 'yes', 'prod_LiuemTO1BzgAmx', 'price_1L1SpEECBZEQ4z2NC1BpiR2j', 'Professional', '30', '7.28', '3', '3', '5', '2', '50', 'unlimited', 'unlimited', '10 GB', '', '', '', '', '', '100', '', 'For the professional looking to collaborate with small teams to organize, track, start scaling.', '2022-06-09', 'active', 'no', 0, 0, 'no', ''),
(3, 'yes', 'prod_LiuhxFbLrnbkk2', 'price_1N4INnECBZEQ4z2NXFB2R5C3', 'Business', '365', '201.60', '10', '5', '10', '2', '350', 'unlimited', 'unlimited', '40 GB', '', '', '', '', '', '300', '', 'FOR A LIMITED TIME! You can now UPGRADE to the Powerful Business Level Plan. MOST POPULAR!', '2022-06-09', 'active', 'no', 0, 0, 'no', ''),
(7, 'no', '', '', 'ENTERPRISE', '', '', 'unlimited', 'unlimited', 'unlimited', '', 'unlimited', 'unlimited', 'unlimited', 'custom', '', '', '', '', '', 'custom', '', 'Set clear goals & achieve objectives repeatedly. Contact us for customized pricing', '2023-01-09', 'active', 'no', 0, 0, 'no', ''),
(23, 'yes', 'prod_O5Oc7DP3wEZQTG', 'price_1NJDpPECBZEQ4z2N8YzB1ON9', 'Webtech Pack', '30', '60', '20', '25', '30', '', '35', 'unlimited', 'unmlimited', 'unlimited', '', '', '', '', '', 'unlimited', '', 'Webtech Enterprise Pack', '2023-06-15', 'active', 'yes', 3, 1, 'no', 'One Month'),
(24, 'yes', 'prod_O5hFqVxxR5KfmJ', 'price_1NJVr0ECBZEQ4z2NYHNM6xD1', 'Comptech pack', '30', '79', '30', '30', '30', '', '30', 'unlimited', 'unlimited', 'unlimited', '', '', '', '', '', '30', '', 'Comptech enterprise pack', '2023-06-16', 'active', 'yes', 4, 2, 'no', 'one month'),
(25, 'yes', 'prod_O5hXyuONN8pcpL', 'price_1NJW87ECBZEQ4z2NtIiiE0rB', 'TechV', '30', '45', '20', '20', '20', '', '20', 'unlimited', 'unlimited', 'unlimited', '', '', '', '', '', '20', '', 'TechV enterprise', '2023-06-16', 'active', 'yes', 5, 306, 'no', 'one month'),
(26, 'yes', 'prod_OCSltlFsxTZ8fw', 'price_1NQ54NECBZEQ4z2N8St3eFz3', 'Test1com pack', '270', '50', '10', '20', '30', '', '30', 'unlimited', 'unlimited', '10000', '', '', '', '', '', '30', '', '', '2023-07-04', 'active', 'yes', 8, 400, 'no', '9 months'),
(27, 'yes', 'prod_OCUh3s3G5AIHLV', 'price_1NQ5kJECBZEQ4z2NhJPupJtG', 'Testing', '180', '90', '90', 'unlimited', 'unlimited', '', 'unlimited', 'unlimited', 'unlimited', '10000', '', '', '', '', '', 'unlimited', '', '', '2023-07-04', 'inactive', 'no', 0, 0, 'no', ''),
(28, 'yes', 'prod_OEnobRsG8s4p0a', 'price_1NSKCfECBZEQ4z2NVhrHO1RT', 'SaraTest pack', '180', '60', '25', '20', '20', '', '40', 'unlimited', 'unlimited', '1000', '', '', '', '', '', '40', '', 'Testing Merged code', '2023-07-10', 'active', 'yes', 10, 5, 'no', '6 months');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_labels`
--

CREATE TABLE `pricing_labels` (
  `plabel` int(11) NOT NULL,
  `pack_id` int(11) NOT NULL,
  `portfolio` text NOT NULL,
  `goals` text NOT NULL,
  `goals_strategies` text NOT NULL,
  `goals_strategies_projects` text NOT NULL,
  `projects` text NOT NULL,
  `team_members` text NOT NULL,
  `task` text NOT NULL,
  `storage` text NOT NULL,
  `accountability_tracking` text NOT NULL,
  `document_collaboration` text NOT NULL,
  `kanban_boards` text NOT NULL,
  `motivator` text NOT NULL,
  `internal_chat` text NOT NULL,
  `content_planner` text NOT NULL,
  `data_recovery` text NOT NULL,
  `email_support` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricing_labels`
--

INSERT INTO `pricing_labels` (`plabel`, `pack_id`, `portfolio`, `goals`, `goals_strategies`, `goals_strategies_projects`, `projects`, `team_members`, `task`, `storage`, `accountability_tracking`, `document_collaboration`, `kanban_boards`, `motivator`, `internal_chat`, `content_planner`, `data_recovery`, `email_support`) VALUES
(1, 1, 'portfolio', 'goals', 'strategies per goal', 'projects per strategy', 'active projects', 'team members', 'task', 'storage', 'accountability tracking', 'document collaboration', 'kanban boards', 'motivator', 'internal chat', 'posts / mo. content planner', 'data recovery', '24/7 email support'),
(2, 2, 'portfolios', 'goals', 'strategies per goal', 'projects per strategy', 'active projects', 'team members', 'task', 'storage', 'accountability tracking', 'document collaboration', 'kanban boards', 'motivator (logo)', 'internal chat', 'posts / mo. content planner', 'data recovery', '24/7 email support'),
(3, 3, 'portfolios', 'goals', 'strategies per goal', 'projects per strategy', 'active projects', 'team members', 'task', 'storage', 'accountability tracking', 'document collaboration', 'kanban boards', 'motivator (logo)', 'internal chat', 'posts / mo. content planner', 'data recovery', '24/7 email support'),
(7, 7, 'portfolio', 'goals', 'KPIs per goal', 'projects per KPIs', 'active projects', 'team members', 'task', 'storage', 'accountability tracking', 'document collaboration', 'kanban boards', 'motivator', 'internal chat', 'posts / mo. content planner', 'data recovery', '24/7 email support'),
(25, 23, 'portfolio', 'goals', 'KPIs per goal', 'projects per KPIs', 'active projects', 'team members', 'task', 'storage', 'accountability tracking', 'document collaboration', 'kanban boards', 'motivator', 'internal chat', 'posts / mo. content planner', 'data recovery', '24/7 email support'),
(26, 24, 'portfolio', 'goals', 'KPIs per goal', 'projects per KPIs', 'active projects', 'team members', 'task', 'storage', 'accountability tracking', 'document collaboration', 'kanban boards', 'motivator', 'internal chat', 'posts / mo. content planner', 'data recovery', '24/7 email support'),
(27, 25, 'portfolio', 'goals', 'KPIs per goal', 'projects per KPIs', 'active projects', 'team members', 'task', 'storage', 'accountability tracking', 'document collaboration', 'kanban boards', 'motivator', 'internal chat', 'posts / mo. content planner', 'data recovery', '24/7 email support'),
(28, 26, 'portfolio', 'goals', 'KPIs per goal', 'projects per KPIs', 'active projects', 'team members', 'task', 'storage', 'accountability tracking', 'document collaboration', 'kanban boards', 'motivator', 'internal chat', 'posts / mo. content planner', 'data recovery', '24/7 email support'),
(29, 27, 'portfolio', 'goals', 'KPIs per goal', 'projects per KPIs', 'active projects', 'team members', 'task', 'storage', 'accountability tracking', 'document collaboration', 'kanban boards', 'motivator', 'internal chat', 'posts / mo. content planner', 'data recovery', '24/7 email support'),
(30, 28, 'portfolio', 'goals', 'KPIs per goal', 'projects per KPIs', 'active projects', 'team members', 'task', 'storage', 'accountability tracking', 'document collaboration', 'kanban boards', 'motivator', 'internal chat', 'posts / mo. content planner', 'data recovery', '24/7 email support');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_pack_coupon`
--

CREATE TABLE `pricing_pack_coupon` (
  `co_id` int(11) NOT NULL,
  `code` text NOT NULL,
  `co_validity` bigint(20) NOT NULL,
  `co_limit` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `co_status` varchar(30) NOT NULL,
  `pack_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `pid` int(11) NOT NULL,
  `pname` text NOT NULL,
  `pdes` text NOT NULL,
  `plink` text NOT NULL,
  `plink_comment` text NOT NULL,
  `pmanager` int(11) NOT NULL,
  `pcreated_by` int(11) NOT NULL,
  `pcreated_date` datetime NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `ptrash` varchar(30) NOT NULL,
  `ptrash_date` text NOT NULL,
  `project_archive` varchar(50) NOT NULL,
  `project_archive_date` text NOT NULL,
  `psingle_trash` varchar(50) NOT NULL,
  `ptype` varchar(50) NOT NULL,
  `gid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `p_publish` date NOT NULL,
  `regularproj_to_contentproj` int(11) NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `project_file_it` varchar(50) NOT NULL,
  `project_file_it_date` datetime NOT NULL,
  `corporate_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pid`, `pname`, `pdes`, `plink`, `plink_comment`, `pmanager`, `pcreated_by`, `pcreated_date`, `portfolio_id`, `dept_id`, `ptrash`, `ptrash_date`, `project_archive`, `project_archive_date`, `psingle_trash`, `ptype`, `gid`, `sid`, `p_publish`, `regularproj_to_contentproj`, `reg_acc_status`, `project_file_it`, `project_file_it_date`, `corporate_id`) VALUES
(1, 'jg k1 p1', '', '', '', 0, 1, '2023-06-15 08:37:05', 1, 3, '', '', '', '', '', 'goal_strategy', 1, 1, '0000-00-00', 0, '', '', '0000-00-00 00:00:00', 'web305'),
(2, 'jg k1 p2', '', '', '', 0, 1, '2023-06-16 06:12:30', 1, 3, '', '', '', '', '', 'goal_strategy', 1, 1, '0000-00-00', 0, '', '', '0000-00-00 00:00:00', 'web305'),
(3, 'july regular content', '', '', '', 1, 1, '2023-06-16 09:25:23', 1, 2, '', '', '', '', '', 'content', 0, 0, '2023-07-31', 0, '', '', '0000-00-00 00:00:00', 'web305'),
(4, 'jg k1 c1', '', '', '', 0, 1, '2023-06-19 03:34:49', 1, 3, '', '', '', '', '', 'content', 1, 1, '2023-07-31', 1, '', '', '0000-00-00 00:00:00', 'web305'),
(5, 'test project', '', '', '', 0, 399, '2023-06-20 08:04:35', 1, 2, '', '', '', '', '', 'regular', 0, 0, '0000-00-00', 0, '', '', '0000-00-00 00:00:00', 'web305'),
(6, 'regular project', '', '', '', 0, 1, '2023-06-21 02:00:28', 1, 3, '', '', '', '', '', 'regular', 0, 0, '0000-00-00', 0, '', '', '0000-00-00 00:00:00', 'web305'),
(7, 'test content', '', '', '', 0, 399, '2023-06-21 02:03:48', 1, 2, '', '', '', '', '', 'content', 0, 0, '2023-06-30', 0, '', '', '0000-00-00 00:00:00', 'web305'),
(8, 'proj 1', '', '', '', 0, 399, '2023-06-21 02:24:38', 1, 3, '', '', '', '', '', 'goal_strategy', 3, 2, '0000-00-00', 0, '', 'yes', '2023-06-23 02:25:28', 'web305'),
(9, 'con 1', '', '', '', 0, 399, '2023-06-21 02:24:49', 1, 3, '', '', '', '', '', 'content', 3, 2, '2023-06-30', 0, '', 'yes', '2023-06-23 02:25:28', 'web305'),
(10, 'test 2', '', '', '', 0, 399, '2023-06-23 07:02:53', 1, 3, 'yes', '2023-07-23', '', '', 'yes', 'regular', 0, 0, '0000-00-00', 0, '', '', '0000-00-00 00:00:00', 'web305'),
(11, 'test 3', '', '', '', 0, 399, '2023-06-23 07:03:10', 1, 2, '', '', 'yes', '2023-06-23 07:03:23', '', 'regular', 0, 0, '0000-00-00', 0, '', 'yes', '2023-06-23 07:03:13', 'web305'),
(12, 'ag k1 p1', '', '', '', 0, 1, '2023-06-26 03:30:01', 1, 3, '', '', '', '', '', 'goal_strategy', 4, 3, '0000-00-00', 0, '', '', '0000-00-00 00:00:00', 'web305'),
(13, 'test proj', '', '', '', 0, 399, '2023-07-04 03:16:28', 2, 4, '', '', '', '', '', 'regular', 0, 0, '0000-00-00', 0, '', '', '0000-00-00 00:00:00', 'web305'),
(14, 'regular project 2', 'test', '', '', 0, 1, '2023-07-06 05:58:26', 1, 3, '', '', '', '', '', 'regular', 0, 0, '0000-00-00', 0, '', '', '0000-00-00 00:00:00', 'web305'),
(15, 'jg k1 c2', '', '', '', 0, 1, '2023-07-07 02:43:53', 1, 3, '', '', '', '', '', 'content', 1, 1, '2023-07-31', 0, '', '', '0000-00-00 00:00:00', 'web305');

-- --------------------------------------------------------

--
-- Table structure for table `project_files`
--

CREATE TABLE `project_files` (
  `pfile_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `pfile` text NOT NULL,
  `pcreated_by` varchar(100) NOT NULL,
  `pfile_date` datetime NOT NULL,
  `ptrash` varchar(30) NOT NULL,
  `ptrash_date` text NOT NULL,
  `project_archive` varchar(50) NOT NULL,
  `project_archive_date` text NOT NULL,
  `pfnotify` text NOT NULL,
  `pfnotify_clear` text NOT NULL,
  `pfnotify_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `project_file_it` varchar(50) NOT NULL,
  `project_file_it_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_files`
--

INSERT INTO `project_files` (`pfile_id`, `pid`, `pfile`, `pcreated_by`, `pfile_date`, `ptrash`, `ptrash_date`, `project_archive`, `project_archive_date`, `pfnotify`, `pfnotify_clear`, `pfnotify_date`, `reg_acc_status`, `project_file_it`, `project_file_it_date`) VALUES
(1, 1, '1687512493_1.jpg', '399', '2023-06-23 05:28:13', '', '', '', '', ',398', ',398', '2023-06-23 05:28:13', '', '', '0000-00-00 00:00:00'),
(2, 5, '1687850340_1687512493_1-.jpg', '399', '2023-06-27 03:19:00', '', '', '', '', '', '', '2023-06-27 03:19:00', '', '', '0000-00-00 00:00:00'),
(3, 13, '1688455004_1687512493_1.jpg', '399', '2023-07-04 03:16:44', '', '', '', '', '', '', '2023-07-04 03:16:44', '', '', '0000-00-00 00:00:00'),
(4, 14, '1688637617_9.jpg', '399', '2023-07-06 06:00:17', '', '', '', '', ',398', ',398', '2023-07-06 06:00:17', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_history`
--

CREATE TABLE `project_history` (
  `hid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `h_date` datetime NOT NULL,
  `h_resource_id` int(11) NOT NULL,
  `h_resource` varchar(200) NOT NULL,
  `h_description` text NOT NULL,
  `pfile_id` int(11) NOT NULL,
  `pinvited_id` int(11) NOT NULL,
  `pmanage_id` int(11) NOT NULL,
  `pmfield_id` int(11) NOT NULL,
  `pmember_id` int(11) NOT NULL,
  `pmsuggested_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `subtask_id` int(11) NOT NULL,
  `preqm_id` int(11) NOT NULL,
  `pc_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `gmember_id` int(11) NOT NULL,
  `ginvited_id` int(11) NOT NULL,
  `gmsuggested_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_history`
--

INSERT INTO `project_history` (`hid`, `pid`, `h_date`, `h_resource_id`, `h_resource`, `h_description`, `pfile_id`, `pinvited_id`, `pmanage_id`, `pmfield_id`, `pmember_id`, `pmsuggested_id`, `task_id`, `subtask_id`, `preqm_id`, `pc_id`, `c_id`, `gid`, `sid`, `gmember_id`, `ginvited_id`, `gmsuggested_id`) VALUES
(1, 0, '2023-06-15 08:24:18', 1, 'Uzma Karjikar', 'Goal Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(2, 0, '2023-06-15 08:24:24', 1, 'Uzma Karjikar', 'KPI Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(3, 1, '2023-06-15 08:37:05', 1, 'Uzma Karjikar', 'Project Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(4, 1, '2023-06-16 04:27:23', 1, 'Uzma Karjikar', 'Project Edited By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(5, 1, '2023-06-16 05:44:21', 1, 'Uzma Karjikar', 'Task Code: JG-4352 , Task Name: jg k1 p1 t1, Created by Uzma Karjikar and assigned to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(6, 1, '2023-06-16 06:12:08', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-4352, New status:- In Progress', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(7, 2, '2023-06-16 06:12:30', 1, 'Uzma Karjikar', 'Project Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(8, 0, '2023-06-16 08:33:40', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma K', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 2, 0, 0),
(9, 0, '2023-06-16 08:33:47', 398, 'Uzma K', 'Team Member Request Accepted By Uzma K', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 2, 0, 0),
(10, 1, '2023-06-16 08:48:16', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma K', 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(11, 1, '2023-06-16 08:48:26', 398, 'Uzma K', 'Team Member Request Accepted By Uzma K', 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(12, 1, '2023-06-16 08:48:26', 398, 'Uzma K', 'Edit Permission not allowed to Uzma K', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(13, 1, '2023-06-16 08:48:39', 398, 'Uzma K', 'Comment Code: JG-3620 ,  Sent by Uzma K', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0),
(14, 1, '2023-06-16 08:48:53', 1, 'Uzma Karjikar', 'Comment Code: JG-255 ,  Sent by Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 1, 1, 0, 0, 0),
(15, 1, '2023-06-16 08:48:59', 1, 'Uzma Karjikar', 'Comment Code: JG-109 ,  Sent by Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 1, 1, 0, 0, 0),
(16, 1, '2023-06-16 09:02:32', 1, 'Uzma Karjikar', 'Project Moved To Trash By Project Owner Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(17, 1, '2023-06-16 09:02:51', 1, 'Uzma Karjikar', 'jg k1 p1 Project Restored by Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(18, 1, '2023-06-16 09:05:16', 1, 'Uzma Karjikar', 'Task Code: JG-7713 , Task Name: jg k1 p1 t2, Created by Uzma Karjikar and assigned to Uzma K', 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(19, 3, '2023-06-16 09:25:23', 1, 'Uzma Karjikar', 'Project Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(20, 3, '2023-06-16 09:25:23', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma K', 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(21, 3, '2023-06-16 09:46:54', 1, 'Uzma Karjikar', 'Plan Content Code: JU-1964 , Platform: twitter, Created by Uzma Karjikar and submitted for Approval to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0),
(22, 3, '2023-06-16 09:47:52', 1, 'Uzma Karjikar', 'Plan Content Code: JU-1964 , Platform: twitter, Updated by Uzma Karjikar and submitted for Approval to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0),
(23, 3, '2023-06-16 09:48:11', 1, 'Uzma Karjikar', 'Plan Content Code: JU-7645 , Platform: facebook, Created by Uzma Karjikar and submitted for Approval to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0),
(24, 3, '2023-06-16 09:48:20', 398, 'Uzma K', 'Team Member Request Accepted By Uzma K', 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 3, '2023-06-16 09:48:20', 398, 'Uzma K', 'Edit Permission not allowed to Uzma K', 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(26, 3, '2023-06-16 09:48:37', 398, 'Uzma K', 'Plan Content Code: JU-1964 , Platform: twitter, Updated by Uzma K and submitted for Approval to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0),
(27, 3, '2023-06-16 09:49:01', 398, 'Uzma K', 'Plan Content Code: JU-1191 , Platform: instagram, Created by Uzma K and submitted for Approval to Uzma K', 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0),
(28, 0, '2023-06-19 02:09:08', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma K', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 3, 0, 0),
(29, 0, '2023-06-19 02:09:30', 399, 'Uzma K', 'Team Member Request Accepted By Uzma K', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 3, 0, 0),
(30, 1, '2023-06-19 03:34:24', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma K', 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(31, 1, '2023-06-19 03:34:31', 399, 'Uzma K', 'Team Member Request Accepted By Uzma K', 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(32, 1, '2023-06-19 03:34:31', 399, 'Uzma K', 'Edit Permission not allowed to Uzma K', 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(33, 4, '2023-06-19 03:34:49', 1, 'Uzma Karjikar', 'Project Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(34, 4, '2023-06-19 03:34:49', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma K', 0, 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(35, 4, '2023-06-19 03:34:57', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma K', 0, 0, 0, 0, 5, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(36, 4, '2023-06-19 03:35:20', 399, 'Uzma A', 'Team Member Request Accepted By Uzma A', 0, 0, 0, 0, 5, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(37, 4, '2023-06-19 03:35:20', 399, 'Uzma A', 'Edit Permission not allowed to Uzma A', 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(38, 4, '2023-06-19 03:35:43', 399, 'Uzma A', 'Plan Content Code: JG-4621 , Platform: twitter, Created by Uzma A and submitted for Approval to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 1, 1, 0, 0, 0),
(39, 4, '2023-06-19 03:35:53', 399, 'Uzma A', 'JG-4621 Content Filed by Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 1, 1, 0, 0, 0),
(40, 4, '2023-06-19 03:36:48', 399, 'Uzma A', 'Plan Content Code: JG-2908 , Platform: twitter, Created by Uzma A and submitted for Approval to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 1, 1, 0, 0, 0),
(41, 4, '2023-06-19 04:05:18', 399, 'Uzma A', 'JG-2908 Content Filed by Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 1, 1, 0, 0, 0),
(42, 4, '2023-06-19 04:05:49', 1, 'Uzma Karjikar', 'Project Filed By Project Owner Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(43, 4, '2023-06-19 04:06:01', 1, 'Uzma Karjikar', 'Project Reopened By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(44, 4, '2023-06-19 04:06:28', 1, 'Uzma Karjikar', 'JG-2908 Content Filed by Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 1, 1, 0, 0, 0),
(45, 4, '2023-06-19 05:34:46', 1, 'Uzma Karjikar', 'Task Code: JG-3711 , Task Name: jg k1 c1 t1, Created by Uzma Karjikar and assigned to Uzma A', 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(46, 4, '2023-06-19 05:35:06', 399, 'Uzma A', 'Uzma A Changed Status of JG-3711, New status:- In Progress', 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(47, 4, '2023-06-19 06:17:34', 399, 'Uzma A', 'Task Code: JG-3911 , Task Name: jg k1 c1 t2, Created by Uzma A and assigned to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(48, 4, '2023-06-19 06:17:48', 399, 'Uzma A', 'Comment Code: JG-5501 ,  Sent by Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 1, 1, 0, 0, 0),
(49, 0, '2023-06-19 06:42:10', 1, 'Uzma Karjikar', 'Goal Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0),
(50, 4, '2023-06-19 08:17:02', 399, 'Uzma A', 'Request for Edit Permission From Uzma A', 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(51, 4, '2023-06-19 08:17:57', 399, 'Uzma A', 'Request for Edit Permission From Uzma A', 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(52, 4, '2023-06-19 08:25:27', 1, 'Uzma Karjikar', 'Plan Content Code: JG-4970 , Platform: facebook, Created by Uzma Karjikar and submitted for Approval to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 1, 1, 0, 0, 0),
(53, 4, '2023-06-19 08:35:30', 1, 'Uzma Karjikar', 'Task Code: JG-195 , Task Name: jg k1 c1 t3 , Created by Uzma Karjikar', 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(54, 1, '2023-06-19 08:35:46', 1, 'Uzma Karjikar', 'Task Code: JG-7932 , Task Name: jg k1 p1 t2 , Created by Uzma Karjikar', 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(55, 1, '2023-06-19 08:35:55', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-7932, New status:- Done', 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(56, 5, '2023-06-20 08:04:35', 399, 'Uzma A', 'Project Created By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(57, 1, '2023-06-20 08:59:07', 1, 'Uzma Karjikar', 'Uzma Karjikar Assigned Uzma K as a Project Manager', 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(58, 0, '2023-06-21 01:15:34', 399, 'Uzma A', 'Goal Created By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0),
(59, 0, '2023-06-21 01:15:34', 399, 'Uzma A', 'Uzma A sent team member request to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 5, 0, 0),
(60, 0, '2023-06-21 01:15:49', 399, 'Uzma A', 'KPI Created By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 2, 0, 0, 0),
(61, 0, '2023-06-21 01:25:10', 1, 'Uzma Karjikar', 'Uzma Karjikar Assigned Uzma A as a Goal Manager', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 3, 0, 0),
(62, 0, '2023-06-21 01:54:31', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 6, 0, 0),
(63, 6, '2023-06-21 02:00:28', 1, 'Uzma Karjikar', 'Project Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(64, 7, '2023-06-21 02:03:49', 399, 'Uzma A', 'Project Created By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(65, 7, '2023-06-21 02:04:21', 399, 'Uzma A', 'Plan Content Code: TE-194 , Platform: twitter, Created by Uzma A and submitted for Approval to Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0),
(66, 8, '2023-06-21 02:24:38', 399, 'Uzma A', 'Project Created By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 2, 0, 0, 0),
(67, 9, '2023-06-21 02:24:49', 399, 'Uzma A', 'Project Created By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 2, 0, 0, 0),
(68, 9, '2023-06-21 02:24:53', 399, 'Uzma A', 'Plan Content Code: CO-68 , Platform: twitter, Created by Uzma A and submitted for Approval to Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 0, 3, 2, 0, 0, 0),
(69, 1, '2023-06-21 02:27:00', 1, 'Uzma Karjikar', 'Uzma Karjikar Assigned Uzma A as a Project Manager', 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(70, 1, '2023-06-21 03:00:28', 1, 'Uzma Karjikar', 'Subtask Code: JG-9523 , Subtask Name: jg k1 p1 t1 s1, Created by Uzma Karjikar and assigned to Uzma A', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0),
(71, 1, '2023-06-21 03:26:38', 1, 'Uzma Karjikar', 'Uzma Karjikar \r\n                                  Changed Task Assignee of JG-4352', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(72, 1, '2023-06-21 08:10:57', 399, 'Uzma A', 'Uzma A Changed Status of JG-9523, New status:- In Progress', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0),
(73, 4, '2023-06-21 08:11:00', 399, 'Uzma A', 'Uzma A Changed Status of JG-3711, New status:- To Do', 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(74, 4, '2023-06-21 08:24:40', 399, 'Uzma A', 'Uzma A Changed Status of JG-3711, New status:- In Progress', 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(75, 4, '2023-06-21 08:24:42', 399, 'Uzma A', 'Uzma A Changed Status of JG-3711, New status:- To Do', 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(76, 4, '2023-06-21 08:25:03', 399, 'Uzma A', 'Uzma A Changed Status of JG-3711, New status:- To Do', 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(77, 4, '2023-06-22 01:32:38', 399, 'Uzma A', 'Uzma A Changed Status of JG-3711, New status:- To Do', 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(78, 1, '2023-06-22 03:22:58', 1, 'Uzma Karjikar', 'Uzma Karjikar \r\n                                  Changed Task Assignee of JG-7932', 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(79, 1, '2023-06-22 03:23:01', 1, 'Uzma Karjikar', 'Uzma Karjikar Edited Task Priority of JG-7932, Priority: high', 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(80, 4, '2023-06-22 03:34:04', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-195, New status:- In Progress', 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(81, 4, '2023-06-22 03:38:16', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-3911, New status:- To Do', 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(82, 4, '2023-06-22 03:55:23', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-195, New status:- In Progress', 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(83, 1, '2023-06-22 03:55:34', 399, 'Uzma A', 'Uzma A Changed Status of JG-9523, New status:- To Do', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0),
(84, 1, '2023-06-22 08:38:39', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Task Status of JG-7932, Status: in_progress', 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(85, 1, '2023-06-22 08:38:49', 1, 'Uzma Karjikar', 'Uzma Karjikar Edited Task Name of JG-7932, Name: jg k1 p1 t2', 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(86, 4, '2023-06-22 08:41:34', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-3911, New status:- To Do', 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(87, 4, '2023-06-22 09:22:49', 1, 'Uzma Karjikar', 'Task Code: JG-182 , Task Name: jg k1 c1 t3 , Created by Uzma Karjikar', 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(88, 4, '2023-06-22 09:23:00', 1, 'Uzma Karjikar', 'Task Code: JG-182 , Task Name: jg k1 c1 t3, Edited by Uzma Karjikar and assigned to Uzma A', 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(89, 4, '2023-06-22 09:23:12', 1, 'Uzma Karjikar', 'Task Code: JG-4031 , Task Name: jg k1 c1 t4 , Created by Uzma Karjikar', 0, 0, 0, 0, 0, 0, 8, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(90, 4, '2023-06-22 09:23:21', 1, 'Uzma Karjikar', 'Task Code: JG-4031 , Task Name: jg k1 c1 t4, Edited by Uzma Karjikar and assigned to Uzma A', 0, 0, 0, 0, 0, 0, 8, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(91, 4, '2023-06-22 09:39:02', 1, 'Uzma Karjikar', 'Uzma Karjikar Edited Task Priority of JG-195, Priority: low', 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(92, 4, '2023-06-22 09:53:25', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-3911, New status:- To Do', 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(93, 1, '2023-06-22 09:53:26', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-7932, New status:- In Progress', 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(94, 1, '2023-06-22 09:53:27', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-7932, New status:- In Progress', 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(95, 4, '2023-06-23 01:03:07', 399, 'Uzma A', 'Uzma A Changed Status of JG-4031, New status:- To Do', 0, 0, 0, 0, 0, 0, 8, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(96, 4, '2023-06-23 01:03:55', 1, 'Uzma Karjikar', 'Task Code: JG-195 , Task Name: jg k1 c1 t3, Edited by Uzma Karjikar and assigned to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(97, 4, '2023-06-23 01:30:51', 399, 'Uzma A', 'Uzma A Changed Status of JG-4031, New status:- In Progress', 0, 0, 0, 0, 0, 0, 8, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(98, 4, '2023-06-23 02:17:18', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-195, New status:- In Progress', 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(99, 4, '2023-06-23 02:17:20', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-195, New status:- In Progress', 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(100, 4, '2023-06-23 02:17:29', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-195, New status:- To Do', 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(101, 5, '2023-06-23 02:24:18', 399, 'Uzma A', 'Task Code: TE-3243 , Task Name: test task, Created by Uzma A and assigned to Uzma A', 0, 0, 0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(102, 5, '2023-06-23 02:24:30', 399, 'Uzma A', 'Subtask Code: TE-7086 , Subtask Name: test subtask, Created by Uzma A and assigned to Uzma A', 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(103, 5, '2023-06-23 02:24:37', 399, 'Uzma A', 'Project Edited By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(104, 5, '2023-06-23 02:25:02', 399, 'Uzma A', 'Uzma A Changed Status of TE-7086, New status:- Done', 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0),
(105, 5, '2023-06-23 02:25:04', 399, 'Uzma A', 'Uzma A Changed Status of TE-3243, New status:- Done', 0, 0, 0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(106, 5, '2023-06-23 02:25:12', 399, 'Uzma A', 'Project Filed By Project Owner Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(107, 0, '2023-06-23 02:25:28', 399, 'Uzma A', 'Goal Filed By Goal Owner Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0),
(108, 4, '2023-06-23 03:14:50', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-3911, New status:- To Do', 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(109, 0, '2023-06-23 03:52:02', 1, 'Uzma Karjikar', 'Goal Filed By Goal Owner Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0),
(110, 1, '2023-06-23 05:28:13', 399, 'Uzma A', '1.jpg File Uploaded By Uzma A', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(111, 1, '2023-06-23 05:28:24', 399, 'Uzma A', 'Task Code: JG-4352 , Task Name: jg k1 p1 t1, Edited by Uzma A and assigned to Uzma A', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(112, 1, '2023-06-23 05:28:35', 399, 'Uzma A', 'Subtask Code: JG-9523 , Task Name: jg k1 p1 t1 s1, Edited by Uzma A and assigned to Uzma A', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0),
(113, 1, '2023-06-23 05:37:28', 399, 'Uzma A', '2.jpg File Downloaded By Uzma A', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(114, 5, '2023-06-23 07:01:39', 399, 'Uzma A', 'Project Archived By Project Owner Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(115, 5, '2023-06-23 07:02:16', 399, 'Uzma A', 'Project Reopened By Project Owner Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(116, 5, '2023-06-23 07:02:24', 399, 'Uzma A', 'Project Filed By Project Owner Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(117, 10, '2023-06-23 07:02:53', 399, 'Uzma A', 'Project Created By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(118, 10, '2023-06-23 07:02:55', 399, 'Uzma A', 'Project Moved To Trash By Project Owner Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(119, 11, '2023-06-23 07:03:10', 399, 'Uzma A', 'Project Created By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(120, 11, '2023-06-23 07:03:13', 399, 'Uzma A', 'Project Filed By Project Owner Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(121, 11, '2023-06-23 07:03:23', 399, 'Uzma A', 'Project Archived By Project Owner Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(122, 2, '2023-06-23 07:05:11', 1, 'Uzma Karjikar', 'Project Moved To Trash By Project Owner Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(123, 2, '2023-06-23 07:05:41', 1, 'Uzma Karjikar', 'jg k1 p2 Project Restored by Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(124, 2, '2023-06-23 07:05:46', 1, 'Uzma Karjikar', 'Project Filed By Project Owner Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(125, 2, '2023-06-23 07:05:55', 1, 'Uzma Karjikar', 'Project Archived By Project Owner Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(126, 2, '2023-06-23 07:06:06', 1, 'Uzma Karjikar', 'Project Reopened By Project Owner Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(127, 4, '2023-06-26 01:03:34', 399, 'Uzma A', 'Task Code: JG-182 , Task Name: jg k1 c1 t3, Edited by Uzma A and assigned to Uzma A', 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(128, 1, '2023-06-26 01:19:07', 399, 'Uzma A', 'Comment Code: JG-7896 ,  Sent by Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 1, 1, 0, 0, 0),
(129, 6, '2023-06-26 01:28:46', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma A', 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(130, 0, '2023-06-26 03:28:23', 1, 'Uzma Karjikar', 'Goal Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0),
(131, 0, '2023-06-26 03:29:05', 1, 'Uzma Karjikar', 'KPI Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 3, 0, 0, 0),
(132, 0, '2023-06-26 03:29:05', 1, 'Uzma Karjikar', 'KPI Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 4, 0, 0, 0),
(133, 0, '2023-06-26 03:29:21', 1, 'Uzma Karjikar', 'KPI Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 5, 0, 0, 0),
(134, 12, '2023-06-26 03:30:01', 1, 'Uzma Karjikar', 'Project Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 3, 0, 0, 0),
(135, 0, '2023-06-26 03:30:10', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 7, 0, 0),
(136, 2, '2023-06-26 05:31:19', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma A', 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(137, 1, '2023-06-26 05:31:55', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of JG-7932, New status:- Done', 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(138, 2, '2023-06-26 06:42:32', 399, 'Uzma A', 'Team Member Request Accepted By Uzma A', 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(139, 2, '2023-06-26 06:42:32', 399, 'Uzma A', 'Edit Permission not allowed to Uzma A', 0, 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(140, 0, '2023-06-26 06:48:20', 399, 'Uzma A', 'Team Member Request Accepted By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 7, 0, 0),
(141, 4, '2023-06-27 01:29:27', 1, 'Uzma Karjikar', 'Plan Content Code: JG-4970 , Platform: facebook, Updated by Uzma Karjikar and submitted for Approval to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 1, 1, 0, 0, 0),
(142, 4, '2023-06-27 01:45:50', 1, 'Uzma Karjikar', 'Plan Content Code: JG-4970 , Platform: facebook, Updated by Uzma Karjikar and submitted for Approval to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 1, 1, 0, 0, 0),
(143, 1, '2023-06-27 02:33:30', 1, 'Uzma Karjikar', '1.jpg File Downloaded By Uzma Karjikar', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(144, 1, '2023-06-27 02:35:56', 1, 'Uzma Karjikar', '1.jpg File Downloaded By Uzma Karjikar', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(145, 1, '2023-06-27 02:36:06', 1, 'Uzma Karjikar', '2.jpg File Downloaded By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(146, 1, '2023-06-27 02:36:59', 1, 'Uzma Karjikar', '2.jpg File Downloaded By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(147, 1, '2023-06-27 02:41:44', 1, 'Uzma Karjikar', 'Subtask Code: JG-9523 , Task Name: jg k1 p1 t1 s1, Edited by Uzma Karjikar and assigned to Uzma A', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0),
(148, 1, '2023-06-27 02:41:53', 1, 'Uzma Karjikar', 'test-cases.xlsx File Downloaded By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0),
(149, 4, '2023-06-27 02:44:43', 1, 'Uzma Karjikar', '1.jpg File Downloaded By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 1, 1, 0, 0, 0),
(150, 1, '2023-06-27 02:48:40', 1, 'Uzma Karjikar', '3.jpg File Downloaded By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0),
(151, 1, '2023-06-27 02:48:45', 1, 'Uzma Karjikar', '2.jpg File Downloaded By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(152, 1, '2023-06-27 02:48:48', 1, 'Uzma Karjikar', '1.jpg File Downloaded By Uzma Karjikar', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(153, 5, '2023-06-27 03:18:53', 399, 'Uzma A', 'Project Reopened By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(154, 5, '2023-06-27 03:19:00', 399, 'Uzma A', '1687512493_1-.jpg File Uploaded By Uzma A', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(155, 1, '2023-06-28 02:50:12', 1, 'Uzma Karjikar', 'Uzma Karjikar Removed Uzma A as a Project Manager', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(156, 1, '2023-07-03 04:37:54', 1, 'Uzma Karjikar', 'Uzma Karjikar Removed Uzma A from project', 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(157, 1, '2023-07-03 04:43:03', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma A', 0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(158, 1, '2023-07-03 04:44:26', 1, 'Uzma Karjikar', 'Uzma Karjikar Removed Uzma A from project', 0, 0, 0, 0, 8, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(159, 1, '2023-07-03 05:03:14', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma A', 0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(160, 1, '2023-07-03 05:20:44', 1, 'Uzma Karjikar', 'Uzma Karjikar Removed Uzma A from project', 0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(161, 1, '2023-07-03 05:43:52', 1, 'Uzma Karjikar', 'Uzma Karjikar sent team member request to Uzma A', 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(162, 1, '2023-07-03 05:44:00', 399, 'Uzma A', 'Team Member Request Accepted By Uzma A', 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(163, 1, '2023-07-03 05:44:00', 399, 'Uzma A', 'Edit Permission not allowed to Uzma A', 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(164, 4, '2023-07-04 02:09:13', 399, 'Uzma A', ' Content File Downloaded By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 1, 1, 0, 0, 0),
(165, 4, '2023-07-04 02:31:05', 399, 'Uzma A', ' Content File Downloaded By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 1, 1, 0, 0, 0),
(166, 13, '2023-07-04 03:16:28', 399, 'Uzma A', 'Project Created By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(167, 13, '2023-07-04 03:16:28', 399, 'Uzma A', 'Uzma A sent team member request to Uzma Karjikar', 0, 0, 0, 0, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(168, 13, '2023-07-04 03:16:44', 399, 'Uzma A', '1687512493_1.jpg File Uploaded By Uzma A', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(169, 13, '2023-07-04 03:17:09', 1, 'Uzma Karjikar', 'Team Member Request Accepted By Uzma Karjikar', 0, 0, 0, 0, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(170, 13, '2023-07-04 03:17:09', 1, 'Uzma Karjikar', 'Edit Permission not allowed to Uzma Karjikar', 0, 0, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(171, 7, '2023-07-05 05:12:05', 399, 'Uzma A', 'Plan Content Code: TE-3386 , Platform: facebook, Created by Uzma A and submitted for Approval to Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0),
(172, 0, '2023-07-05 05:50:59', 399, 'Uzma A', 'Goal Created By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 0),
(173, 0, '2023-07-05 05:51:04', 399, 'Uzma A', 'KPI Created By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 6, 0, 0, 0),
(174, 0, '2023-07-05 05:51:15', 399, 'Uzma A', 'Uzma A sent team member request to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 9, 0, 0),
(175, 1, '2023-07-05 06:32:23', 1, 'Uzma Karjikar', 'Uzma Karjikar Assigned Uzma A as a Project Manager', 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(176, 7, '2023-07-05 06:43:19', 399, 'Uzma A', 'Project Filed By Project Owner Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(177, 7, '2023-07-05 06:43:28', 399, 'Uzma A', 'Project Reopened By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(178, 7, '2023-07-05 06:43:36', 399, 'Uzma A', 'Project Filed By Project Owner Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(179, 7, '2023-07-05 06:44:13', 399, 'Uzma A', 'Project Reopened By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(180, 7, '2023-07-05 06:57:41', 399, 'Uzma A', 'Plan Content Code: TE-3386 , Platform: facebook, Updated by Uzma A and submitted for Approval to Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 9, 0, 0, 0, 0, 0, 0),
(181, 1, '2023-07-05 08:37:03', 1, 'Uzma Karjikar', 'Uzma Karjikar Removed Uzma A as a Project Manager', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(182, 1, '2023-07-05 08:39:40', 1, 'Uzma Karjikar', 'Uzma Karjikar Assigned Uzma A as a Project Manager', 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(183, 1, '2023-07-05 08:41:30', 1, 'Uzma Karjikar', 'Uzma Karjikar Removed Uzma A as a Project Manager', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(184, 2, '2023-07-05 09:44:23', 1, 'Uzma Karjikar', 'Task Code: JG-6355 , Task Name: new t, Created by Uzma Karjikar and assigned to Uzma A', 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(185, 14, '2023-07-06 05:58:26', 1, 'Uzma Karjikar', 'Project Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(186, 14, '2023-07-06 05:58:26', 1, 'Uzma Karjikar', 'Uzma Karjikar sent project manager request to Uzma A', 0, 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(187, 14, '2023-07-06 05:58:58', 399, 'Uzma A', 'Team Member Request Accepted By Uzma A', 0, 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(188, 14, '2023-07-06 05:58:58', 399, 'Uzma A', 'Edit Permission not allowed to Uzma A', 0, 0, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(189, 14, '2023-07-06 05:59:45', 399, 'Uzma A', 'Uzma A sent team member request to Uzma K', 0, 0, 0, 0, 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(190, 14, '2023-07-06 06:00:00', 399, 'Uzma A', 'Comment Code: RE-5700 ,  Sent by Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0),
(191, 14, '2023-07-06 06:00:17', 399, 'Uzma A', '9.jpg File Uploaded By Uzma A', 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(192, 14, '2023-07-06 06:00:43', 1, 'Uzma Karjikar', 'Uzma Karjikar Removed Uzma A as a Project Manager', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(193, 14, '2023-07-06 06:01:25', 1, 'Uzma Karjikar', 'Comment Code: RE-8811 ,  Sent by Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 0),
(194, 14, '2023-07-06 06:01:50', 1, 'Uzma Karjikar', 'Uzma Karjikar Assigned Uzma A as a Project Manager', 0, 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(195, 14, '2023-07-06 06:04:30', 399, 'Uzma A', 'Project Edited By Uzma A', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(196, 14, '2023-07-06 06:49:17', 1, 'Uzma Karjikar', 'Uzma Karjikar Removed Uzma A as a Project Manager', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(197, 14, '2023-07-06 06:49:23', 1, 'Uzma Karjikar', 'Uzma Karjikar Assigned Uzma A as a Project Manager', 0, 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(198, 14, '2023-07-06 07:12:18', 1, 'Uzma Karjikar', 'Task Code: RE-3582 , Task Name: rp2 t1, Created by Uzma Karjikar and assigned to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(199, 14, '2023-07-06 07:12:32', 1, 'Uzma Karjikar', 'Task Code: RE-8613 , Task Name: rp2 t2, Created by Uzma Karjikar and assigned to Uzma A', 0, 0, 0, 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(200, 14, '2023-07-07 01:11:44', 1, 'Uzma Karjikar', 'Uzma Karjikar Removed Uzma A as a Project Manager', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(201, 14, '2023-07-07 01:12:15', 1, 'Uzma Karjikar', 'Uzma Karjikar Assigned Uzma A as a Project Manager', 0, 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(202, 14, '2023-07-07 01:28:03', 1, 'Uzma Karjikar', 'Uzma Karjikar Removed Uzma A as a Project Manager', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(203, 0, '2023-07-07 02:43:01', 1, 'Uzma Karjikar', 'Goal Edited By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0),
(204, 0, '2023-07-07 02:43:16', 1, 'Uzma Karjikar', 'Uzma Karjikar Assigned Uzma K as a Goal Manager', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 2, 0, 0),
(205, 15, '2023-07-07 02:43:53', 1, 'Uzma Karjikar', 'Project Created By Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(206, 14, '2023-07-07 04:03:03', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Task Status of RE-3582, Status: in_progress', 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(207, 14, '2023-07-07 04:03:44', 399, 'Uzma A', 'Uzma A Changed Status of RE-8613, New status:- Submit for Review, Review:- Sent', 0, 0, 0, 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(208, 14, '2023-07-07 05:05:44', 1, 'Uzma Karjikar', 'Uzma Karjikar Changed Status of RE-8613, New status:- Done, Review:- Approved', 0, 0, 0, 0, 0, 0, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(209, 1, '2023-07-11 01:09:02', 1, 'Uzma Karjikar', '1.jpg File Downloaded By Uzma Karjikar', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(210, 1, '2023-07-11 01:15:58', 1, 'Uzma Karjikar', 'Task Code: JG-3692 , Task Name: jg k1 p1 t3, Created by Uzma Karjikar and assigned to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 13, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(211, 1, '2023-07-11 01:16:07', 1, 'Uzma Karjikar', 'Task Code: JG-2748 , Task Name: jg k1 p1 t4 , Created by Uzma Karjikar', 0, 0, 0, 0, 0, 0, 14, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(212, 1, '2023-07-11 01:16:24', 1, 'Uzma Karjikar', 'Task Code: JG-2748 , Task Name: jg k1 p1 t4, Edited by Uzma Karjikar and assigned to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 14, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(213, 1, '2023-07-11 01:16:42', 1, 'Uzma Karjikar', 'Task Code: JG-7033 , Task Name: jg k1 p1 t5, Created by Uzma Karjikar and assigned to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 15, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(214, 1, '2023-07-11 01:22:03', 1, 'Uzma Karjikar', 'Task Code: JG-6281 , Task Name: jg k1 p1 t8, Created by Uzma Karjikar and assigned to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 16, 0, 0, 0, 0, 1, 1, 0, 0, 0),
(215, 12, '2023-07-11 01:43:13', 1, 'Uzma Karjikar', 'Task Code: AG-349 , Task Name: testing, Created by Uzma Karjikar and assigned to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 17, 0, 0, 0, 0, 4, 3, 0, 0, 0),
(216, 12, '2023-07-11 01:54:02', 1, 'Uzma Karjikar', 'Subtask Code: AG-9921 , Subtask Name: testing s1, Created by Uzma Karjikar and assigned to Uzma Karjikar', 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 4, 3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_invited_members`
--

CREATE TABLE `project_invited_members` (
  `im_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `sent_from` int(11) NOT NULL,
  `sent_to` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_notify` varchar(50) NOT NULL,
  `status_notify_clear` varchar(50) NOT NULL,
  `invite_date` datetime NOT NULL,
  `accept_date` datetime NOT NULL,
  `ptrash` varchar(30) NOT NULL,
  `ptrash_date` text NOT NULL,
  `project_archive` varchar(50) NOT NULL,
  `project_archive_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `project_file_it` varchar(50) NOT NULL,
  `project_file_it_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project_management`
--

CREATE TABLE `project_management` (
  `m_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `powner` int(11) NOT NULL,
  `pmember` int(11) NOT NULL,
  `edit_allow` varchar(50) NOT NULL,
  `permission_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `approved_edited_on` datetime NOT NULL,
  `ptrash` varchar(30) NOT NULL,
  `ptrash_date` text NOT NULL,
  `project_archive` varchar(50) NOT NULL,
  `project_archive_date` text NOT NULL,
  `project_file_it` varchar(50) NOT NULL,
  `project_file_it_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_management`
--

INSERT INTO `project_management` (`m_id`, `pid`, `powner`, `pmember`, `edit_allow`, `permission_date`, `status`, `approved_edited_on`, `ptrash`, `ptrash_date`, `project_archive`, `project_archive_date`, `project_file_it`, `project_file_it_date`) VALUES
(1, 1, 1, 398, 'no', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', '', '0000-00-00 00:00:00'),
(2, 3, 1, 398, 'no', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', '', '0000-00-00 00:00:00'),
(3, 1, 1, 399, 'no', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', '', '0000-00-00 00:00:00'),
(4, 4, 1, 399, 'no', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', '', '0000-00-00 00:00:00'),
(5, 2, 1, 399, 'no', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', '', '0000-00-00 00:00:00'),
(6, 1, 1, 399, 'no', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', '', '0000-00-00 00:00:00'),
(7, 13, 399, 1, 'no', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', '', '0000-00-00 00:00:00'),
(8, 14, 1, 399, 'no', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '', '', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_management_fields`
--

CREATE TABLE `project_management_fields` (
  `id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `powner` int(11) NOT NULL,
  `pmember` int(11) NOT NULL,
  `r_pname` varchar(100) NOT NULL,
  `r_pdes` text NOT NULL,
  `r_date` datetime NOT NULL,
  `ap_date` datetime NOT NULL,
  `ap_fields` varchar(100) NOT NULL,
  `ptrash` varchar(30) NOT NULL,
  `ptrash_date` text NOT NULL,
  `project_archive` varchar(50) NOT NULL,
  `project_archive_date` text NOT NULL,
  `project_file_it` varchar(50) NOT NULL,
  `project_file_it_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `pm_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `pmember` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `pcreated_by` int(11) NOT NULL,
  `sent_date` datetime NOT NULL,
  `sent_notify_clear` varchar(50) NOT NULL,
  `status_date` datetime NOT NULL,
  `status_notify` varchar(50) NOT NULL,
  `status_notify_clear` varchar(50) NOT NULL,
  `ptrash` varchar(30) NOT NULL,
  `ptrash_date` text NOT NULL,
  `project_archive` varchar(50) NOT NULL,
  `project_archive_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `project_file_it` varchar(50) NOT NULL,
  `project_file_it_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_members`
--

INSERT INTO `project_members` (`pm_id`, `pid`, `portfolio_id`, `pmember`, `status`, `pcreated_by`, `sent_date`, `sent_notify_clear`, `status_date`, `status_notify`, `status_notify_clear`, `ptrash`, `ptrash_date`, `project_archive`, `project_archive_date`, `reg_acc_status`, `project_file_it`, `project_file_it_date`) VALUES
(1, 1, 1, '398', 'accepted', 1, '2023-06-16 08:48:16', 'yes', '2023-06-16 08:48:25', 'seen', 'no', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(2, 3, 1, '398', 'accepted', 1, '2023-06-16 09:25:23', 'no', '2023-06-16 09:48:20', 'seen', 'no', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(4, 4, 1, '398', 'send', 1, '2023-06-19 03:34:49', 'yes', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(5, 4, 1, '399', 'accepted', 1, '2023-06-19 03:34:57', 'yes', '2023-06-19 03:35:20', 'seen', 'no', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(6, 6, 1, '399', 'send', 1, '2023-06-26 01:28:46', 'yes', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(7, 2, 1, '399', 'accepted', 1, '2023-06-26 05:31:19', 'yes', '2023-06-26 06:42:32', 'seen', 'yes', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(10, 1, 1, '399', 'accepted', 1, '2023-07-03 05:43:52', 'yes', '2023-07-03 05:44:00', 'seen', 'no', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(11, 13, 2, '1', 'accepted', 399, '2023-07-04 03:16:28', 'yes', '2023-07-04 03:17:09', 'seen', 'no', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(12, 14, 1, '399', 'accepted', 1, '2023-07-06 05:58:26', 'yes', '2023-07-06 05:58:58', 'seen', 'no', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(13, 14, 1, '398', 'send', 399, '2023-07-06 05:59:45', 'yes', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_portfolio`
--

CREATE TABLE `project_portfolio` (
  `portfolio_id` int(11) NOT NULL,
  `portfolio_name` text NOT NULL,
  `portfolio_mname` text NOT NULL,
  `portfolio_lname` text NOT NULL,
  `about_portfolio` text NOT NULL,
  `email_address` text NOT NULL,
  `designation` text NOT NULL,
  `company_individual` text NOT NULL,
  `portfolio_user` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `gender_other` text NOT NULL,
  `country` varchar(50) NOT NULL,
  `phone_number` text NOT NULL,
  `social_media_icon` text NOT NULL,
  `social_media` text NOT NULL,
  `photo` text NOT NULL,
  `cover_photo` text NOT NULL,
  `contact_fname` text NOT NULL,
  `contact_mname` text NOT NULL,
  `contact_lname` text NOT NULL,
  `contact_phone_number` text NOT NULL,
  `company_website` text NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `portfolio_createdby` int(11) NOT NULL,
  `portfolio_createddate` datetime NOT NULL,
  `portfolio_trash` varchar(30) NOT NULL,
  `portfolio_trash_date` text NOT NULL,
  `delete_agree` varchar(10) NOT NULL,
  `portfolio_archive` varchar(50) NOT NULL,
  `portfolio_archive_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `portfolio_file_it` varchar(50) NOT NULL,
  `portfolio_file_it_date` datetime NOT NULL,
  `corporate_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_portfolio`
--

INSERT INTO `project_portfolio` (`portfolio_id`, `portfolio_name`, `portfolio_mname`, `portfolio_lname`, `about_portfolio`, `email_address`, `designation`, `company_individual`, `portfolio_user`, `gender`, `gender_other`, `country`, `phone_number`, `social_media_icon`, `social_media`, `photo`, `cover_photo`, `contact_fname`, `contact_mname`, `contact_lname`, `contact_phone_number`, `company_website`, `street`, `city`, `state`, `portfolio_createdby`, `portfolio_createddate`, `portfolio_trash`, `portfolio_trash_date`, `delete_agree`, `portfolio_archive`, `portfolio_archive_date`, `reg_acc_status`, `portfolio_file_it`, `portfolio_file_it_date`, `corporate_id`) VALUES
(1, 'Dev Mode', '', '', '', 'uzma@mail.com', '', '', 'company', '', '', '', '45465', '', '', '', '', 'Uzma', '', 'K', '44654', 'www.dev.mode', '', '', '', 1, '2023-06-15 07:48:47', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(2, 'test portfolio', '', '', '', 'uzma@mail.com', '', '', 'company', '', '', '', '213232', '', '', '', '', 'uzma', '', 'tests', '322', 'www.test.in', '', '', '', 399, '2023-06-23 06:52:29', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305');

-- --------------------------------------------------------

--
-- Table structure for table `project_portfolio_department`
--

CREATE TABLE `project_portfolio_department` (
  `portfolio_dept_id` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `department` text NOT NULL,
  `dstatus` varchar(30) NOT NULL,
  `createddate` datetime NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_portfolio_department`
--

INSERT INTO `project_portfolio_department` (`portfolio_dept_id`, `portfolio_id`, `department`, `dstatus`, `createddate`, `createdby`) VALUES
(1, 1, 'Human resources', 'active', '2023-06-15 07:48:47', 1),
(2, 1, 'Marketing', 'active', '2023-06-15 07:48:47', 1),
(3, 1, 'Research & Development', 'active', '2023-06-15 07:48:47', 1),
(4, 2, 'Administration', 'active', '2023-06-23 06:52:29', 399);

-- --------------------------------------------------------

--
-- Table structure for table `project_portfolio_member`
--

CREATE TABLE `project_portfolio_member` (
  `pim_id` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `sent_to` text NOT NULL,
  `sent_from` int(11) NOT NULL,
  `working_status` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_date` datetime NOT NULL,
  `reminder_date` text NOT NULL,
  `status_notify` varchar(50) NOT NULL,
  `status_notify_clear` varchar(50) NOT NULL,
  `portfolio_trash` text NOT NULL,
  `portfolio_trash_date` text NOT NULL,
  `portfolio_archive` varchar(50) NOT NULL,
  `portfolio_archive_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `portfolio_file_it` varchar(50) NOT NULL,
  `portfolio_file_it_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_portfolio_member`
--

INSERT INTO `project_portfolio_member` (`pim_id`, `portfolio_id`, `sent_to`, `sent_from`, `working_status`, `status`, `status_date`, `reminder_date`, `status_notify`, `status_notify_clear`, `portfolio_trash`, `portfolio_trash_date`, `portfolio_archive`, `portfolio_archive_date`, `reg_acc_status`, `portfolio_file_it`, `portfolio_file_it_date`) VALUES
(1, 1, 'uzmakarjikar@gmail.com', 1, 'active', 'accepted', '2023-06-15 07:48:47', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(2, 1, 'uzmakarjikar1@gmail.com', 1, 'active', 'accepted', '2023-06-16 09:48:20', '2023-06-17 08:33:40', 'seen', 'yes', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(3, 1, 'uzmakarjikar10@gmail.com', 1, 'active', 'accepted', '2023-07-06 05:58:58', '2023-06-20 02:09:08', 'seen', 'yes', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(4, 2, 'uzmakarjikar10@gmail.com', 399, 'active', 'accepted', '2023-06-23 06:52:29', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00'),
(5, 2, 'uzmakarjikar@gmail.com', 399, 'active', 'accepted', '2023-07-04 03:17:09', '2023-07-05 03:16:28', 'seen', 'yes', '', '', '', '', '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_request_member`
--

CREATE TABLE `project_request_member` (
  `req_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `mreq_notify` varchar(50) NOT NULL,
  `mreq_notify_clear` varchar(50) NOT NULL,
  `mode` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project_suggested_members`
--

CREATE TABLE `project_suggested_members` (
  `s_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `suggest_id` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `already_register` varchar(50) NOT NULL,
  `suggested_by` int(11) NOT NULL,
  `suggested_date` datetime NOT NULL,
  `approve_date` datetime NOT NULL,
  `ptrash` varchar(30) NOT NULL,
  `ptrash_date` text NOT NULL,
  `project_archive` varchar(50) NOT NULL,
  `project_archive_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `project_file_it` varchar(50) NOT NULL,
  `project_file_it_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `reg_id` int(11) NOT NULL,
  `stripe_cus_id` text NOT NULL,
  `first_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `about_me` text NOT NULL,
  `email_address` text NOT NULL,
  `password` text NOT NULL,
  `login_password` text NOT NULL,
  `country` varchar(10) NOT NULL,
  `designation` text NOT NULL,
  `company` text NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `gender_other` text NOT NULL,
  `dob` date NOT NULL,
  `photo` text NOT NULL,
  `cover_photo` text NOT NULL,
  `social_media_icon` text NOT NULL,
  `social_media` text NOT NULL,
  `country_code` int(11) NOT NULL,
  `logged_in_with` text NOT NULL,
  `profile_link` text NOT NULL,
  `socialmedia_id` text NOT NULL,
  `socialmedia_picture` text NOT NULL,
  `google_locale` text NOT NULL,
  `mail_code` text NOT NULL,
  `verification_code` text NOT NULL,
  `verified` varchar(10) NOT NULL,
  `agree_terms_privacy` varchar(30) NOT NULL,
  `mail_date` datetime NOT NULL,
  `reg_date` datetime NOT NULL,
  `msg_flag` int(2) NOT NULL,
  `last_login` datetime NOT NULL,
  `inactivity_mail_days` int(11) NOT NULL,
  `deactive_date` date NOT NULL,
  `delete_date` date NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `send_activate_req` varchar(30) NOT NULL,
  `send_activate_req_date` date NOT NULL,
  `package_coupon_id` int(11) NOT NULL,
  `used_package_coupon_id` text NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_start` datetime NOT NULL,
  `package_expiry` text NOT NULL,
  `card_number` bigint(20) NOT NULL,
  `card_exp_month` varchar(5) NOT NULL,
  `card_exp_year` varchar(10) NOT NULL,
  `card_cvc` text NOT NULL,
  `card_exp_alert` text NOT NULL,
  `balance_amount` text NOT NULL,
  `paid_amount` text NOT NULL,
  `paid_amount_currency` varchar(10) NOT NULL,
  `txn_id` text NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `refund_amount` text NOT NULL,
  `refund_status` varchar(50) NOT NULL,
  `refund_main_txn_id` text NOT NULL,
  `refund_txn_id` text NOT NULL,
  `old_package` int(11) NOT NULL,
  `renew` varchar(50) NOT NULL,
  `sub_cancel_reason` varchar(50) NOT NULL,
  `sub_cancel_reason_notify` varchar(30) NOT NULL,
  `role` text NOT NULL,
  `supporter_mail` int(11) NOT NULL,
  `supporter_mail_date` datetime NOT NULL,
  `supporter_approve` varchar(20) NOT NULL,
  `supporter_status` varchar(20) NOT NULL,
  `tour_step` text NOT NULL,
  `expert_photo` text NOT NULL,
  `expertise` text NOT NULL,
  `expert` int(11) NOT NULL,
  `expert_apply_date` datetime NOT NULL,
  `expert_approve` int(11) NOT NULL,
  `expert_approved_date` datetime NOT NULL,
  `expert_status` varchar(20) NOT NULL,
  `add_expert_tag` int(11) NOT NULL,
  `call_rate_set` int(11) NOT NULL,
  `call_notify_clear` varchar(20) NOT NULL,
  `call_notify` varchar(20) NOT NULL,
  `used_corporate_id` text NOT NULL,
  `cce_id` int(11) NOT NULL,
  `role_in_comp` text NOT NULL,
  `personal_acc_created` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`reg_id`, `stripe_cus_id`, `first_name`, `middle_name`, `last_name`, `about_me`, `email_address`, `password`, `login_password`, `country`, `designation`, `company`, `phone_number`, `gender`, `gender_other`, `dob`, `photo`, `cover_photo`, `social_media_icon`, `social_media`, `country_code`, `logged_in_with`, `profile_link`, `socialmedia_id`, `socialmedia_picture`, `google_locale`, `mail_code`, `verification_code`, `verified`, `agree_terms_privacy`, `mail_date`, `reg_date`, `msg_flag`, `last_login`, `inactivity_mail_days`, `deactive_date`, `delete_date`, `reg_acc_status`, `send_activate_req`, `send_activate_req_date`, `package_coupon_id`, `used_package_coupon_id`, `package_id`, `package_start`, `package_expiry`, `card_number`, `card_exp_month`, `card_exp_year`, `card_cvc`, `card_exp_alert`, `balance_amount`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `refund_amount`, `refund_status`, `refund_main_txn_id`, `refund_txn_id`, `old_package`, `renew`, `sub_cancel_reason`, `sub_cancel_reason_notify`, `role`, `supporter_mail`, `supporter_mail_date`, `supporter_approve`, `supporter_status`, `tour_step`, `expert_photo`, `expertise`, `expert`, `expert_apply_date`, `expert_approve`, `expert_approved_date`, `expert_status`, `add_expert_tag`, `call_rate_set`, `call_notify_clear`, `call_notify`, `used_corporate_id`, `cce_id`, `role_in_comp`, `personal_acc_created`) VALUES
(1, 'cus_Ll9bgy9QRDJEta', 'Uzma', 'A', 'Karjikar', 'Web Developer', 'uzmakarjikar@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345', '', '', '', 9809, 'female', '', '1996-07-27', '1682934593_1.png', '1682934575_1.png', 'Facebook,LinkedIn', 'https://www.facebook.com,https://www.linkedin.com', 0, '', '', '', '', '', '', '60e5981ae61d160e5981ae61d4', 'yes', 'yes', '0000-00-00 00:00:00', '2021-07-07 17:33:38', 1, '2023-07-11 06:09:09', 0, '0000-00-00', '0000-00-00', 'activated', '', '0000-00-00', 0, '', 23, '2023-06-15 07:00:07', '2023-07-15 07:00:07', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 'supporter', 1, '2023-03-02 01:05:09', 'yes', 'active', '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0, '', '', 'web305', 1, 'contacted_user', ''),
(2, 'cus_O5hDVUBoV8kzdW', 'Afrin', 'Murtuza', 'Sayed', 'Focused on crafting great web experiences. Designing and Coding have been my passion since the days I started working with computers. I enjoy creating beautifully designed, intuitive and functional websites.', 'shaikhafrin33@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', 'IN', 'Senior Web Developer', '', 8975837654, 'female', '', '1995-07-29', '1686826965_2.png', '1686826980_2.png', 'YouTube,LinkedIn,Instagram,Facebook', 'www.youtube.com,https://www.linkedin.com/in/afrin-sayed-96a5a112a,https://www.instagram.com/afrin_sayed7786,https://www.facebook.com/afrin.sayed.5201', 0, 'google', '', '104339070519686640669', 'https://lh3.googleusercontent.com/a-/AOh14GgWZC2KtU1Ey914tJ5UylTuyZNKJxGmQWl8V49OcQ=s96-c', 'en-GB', '60ed38cd0541a60ed38cd0541e', '', 'yes', 'yes', '2021-07-13 12:25:09', '2021-07-08 15:45:39', 1, '2023-06-16 02:22:55', 0, '0000-00-00', '0000-00-00', 'activated', '', '0000-00-00', 0, '', 24, '2023-06-16 02:23:49', '2023-07-16 02:23:49', 0, '', '', '', '', '', '', '', '', '', '', 'no_refund', '', '', 2, '', '', '', 'supporter', 1, '2023-02-21 08:50:29', 'yes', 'active', '11,16,1,2,3,13', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0, '', '', 'com4548', 2, 'contacted_user', ''),
(5, 'cus_LlSrbGZgwjV0Ak', 'sara', '', 'khan', '', 'saramaazkhan123@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345', '', '', '', 0, '', '', '2021-10-28', '', '1656674985_5.png', '', '', 0, '', '', '', '', '', '', '60fe9e1171b8860fe9e1171b8c', 'yes', 'yes', '0000-00-00 00:00:00', '2021-07-26 17:05:45', 1, '2023-07-10 09:34:30', 0, '0000-00-00', '0000-00-00', 'activated', 'approved', '2023-01-14', 0, '', 28, '2023-07-10 09:34:24', '2024-01-06 09:34:24', 0, '', '', '', '', '', '', '', '', '', '', 'no_refund', '', '', 2, '', '', '', '', 0, '0000-00-00 00:00:00', '', '', '10', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0, '', '', 'sar1801', 13, 'contacted_user', ''),
(306, '', 'uzair', '', 'karjikar', '', 'uzma.karjikar@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345', '', '', '', 0, '', '', '2022-06-29', '', '', '', '', 0, '', '', '', '', '', '62bbf7f95d82b62bbf7f95d82e', '62bbf5860114562bbf5860114a', 'yes', 'yes', '2022-06-29 02:58:01', '2022-06-29 02:47:34', 1, '2023-06-16 02:26:03', 0, '0000-00-00', '0000-00-00', 'activated', '', '0000-00-00', 0, '', 25, '2023-06-16 02:28:39', '2023-07-16 02:28:39', 0, '', '', '', '', '', '0', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0, '', '', 'tec5436', 3, 'contacted_user', ''),
(398, '', 'Uzma', '', 'K', 'Web Developer', 'uzmakarjikar1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345', '', '', '', 9809, 'female', '', '1996-07-27', '1682934593_1.png', '1682934575_1.png', 'Facebook,LinkedIn', 'https://www.facebook.com,https://www.linkedin.com', 0, '', '', '', '', '', '', '60e5981ae61d160e5981ae61d4', 'yes', 'yes', '0000-00-00 00:00:00', '2021-07-07 17:33:38', 1, '2023-06-16 08:33:11', 0, '0000-00-00', '0000-00-00', 'activated', '', '0000-00-00', 0, '', 23, '2023-06-15 07:00:07', '2023-07-15 07:00:07', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', 'supporter', 1, '2023-03-02 01:05:09', 'yes', 'active', '10,', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0, '', '', 'web305', 4, 'employee', ''),
(399, '', 'Uzma', '', 'A', '', 'uzmakarjikar10@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345', '', '', '', 0, '', '', '0000-00-00', '', '', '', '', 0, '', '', '', '', '', '', '648fe898042a7648fe898042ab', 'yes', 'yes', '0000-00-00 00:00:00', '2023-06-19 01:33:12', 1, '2023-07-11 01:03:36', 0, '0000-00-00', '0000-00-00', 'activated', '', '0000-00-00', 0, '', 23, '2023-06-15 07:00:07', '2023-07-15 07:00:07', 0, '', '', '', '', '', '0', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '', '', '10,', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0, '', '', 'web305', 5, '3', ''),
(400, '', 'Uzma', '', 'test1', '', 'uzma1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345', '', '', '', 0, '', '', '0000-00-00', '', '', '', '', 0, '', '', '', '', '', '', '648fe898042a7648fe898042ab', 'yes', 'yes', '0000-00-00 00:00:00', '2023-06-19 01:33:12', 1, '2023-07-04 03:37:18', 0, '0000-00-00', '0000-00-00', 'activated', '', '0000-00-00', 0, '', 26, '2023-07-05 01:34:24', '2024-03-31 01:34:24', 0, '', '', '', '', '', '0', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '', '', '0', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0, '', '', 'tes8860', 7, 'contacted_user', ''),
(402, '', 'uzma', '', 'ak', '', 'uzmakarjikar13@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345', '', '', '', 0, '', '', '0000-00-00', '', '', '', '', 0, '', '', '', '', '', '', '64a50ba2b813f64a50ba2b8148', 'no', 'yes', '0000-00-00 00:00:00', '2023-07-05 02:20:18', 0, '0000-00-00 00:00:00', 0, '0000-00-00', '0000-00-00', 'activated', '', '0000-00-00', 0, '', 23, '2023-06-15 07:00:07', '2023-07-15 07:00:07', 0, '', '', '', '', '', '0', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0, '', '', 'web305', 9, 'employee', ''),
(403, '', 'uzma', '', 'uak', '', 'uzmakarjikar14@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345', '', '', '', 0, '', '', '0000-00-00', '', '', '', '', 0, '', '', '', '', '', '', '64a50db2f2f9d64a50db2f2fa7', 'no', 'yes', '0000-00-00 00:00:00', '2023-07-05 02:29:06', 0, '0000-00-00 00:00:00', 0, '0000-00-00', '0000-00-00', 'activated', '', '0000-00-00', 0, '', 23, '2023-06-15 07:00:07', '2023-07-15 07:00:07', 0, '', '', '', '', '', '0', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0, '', '', 'web305', 10, 'employee', ''),
(404, '', 'uzma', '', 'u', '', 'uzma22@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345', '', '', '', 0, '', '', '0000-00-00', '', '', '', '', 0, '', '', '', '', '', '', '64a51fa4bd99c64a51fa4bd9a7', 'no', 'yes', '0000-00-00 00:00:00', '2023-07-05 03:45:40', 0, '0000-00-00 00:00:00', 0, '0000-00-00', '0000-00-00', 'activated', '', '0000-00-00', 0, '', 26, '2023-07-05 01:34:24', '2024-03-31 01:34:24', 0, '', '', '', '', '', '0', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0, '', '', 'tes8860', 12, 'employee', ''),
(405, '', 'sara', '', 'test', '', 'saramaazkhan1234@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345', '', '', '', 0, '', '', '0000-00-00', '', '', '', '', 0, '', '', '', '', '', '', '64ac09829a24e64ac09829a259', 'yes', 'yes', '0000-00-00 00:00:00', '2023-07-10 09:37:06', 1, '2023-07-10 09:39:27', 0, '0000-00-00', '0000-00-00', 'activated', '', '0000-00-00', 0, '', 28, '2023-07-10 09:34:24', '2024-01-06 09:34:24', 0, '', '', '', '', '', '0', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '', '', '0', '', '', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0, '', '', 'sar1801', 14, '4', '');

-- --------------------------------------------------------

--
-- Table structure for table `registration_deleted`
--

CREATE TABLE `registration_deleted` (
  `reg_did` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `stripe_cus_id` text NOT NULL,
  `first_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email_address` text NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `deleted_date` datetime NOT NULL,
  `used_corporate_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration_deleted`
--

INSERT INTO `registration_deleted` (`reg_did`, `reg_id`, `stripe_cus_id`, `first_name`, `middle_name`, `last_name`, `email_address`, `phone_number`, `deleted_date`, `used_corporate_id`) VALUES
(1, 386, '', 'Uzma', '', 'A', 'uzmakarjikar1@gmail.com', 0, '2023-05-22 09:37:12', 'web1896'),
(2, 387, '', 'Uzma', '', 'K', 'uzmakarjikar2@gmail.com', 0, '2023-05-22 09:38:37', 'web1896'),
(3, 388, '', 'uzair', '', 'karjikar', 'uzmakarjikar3@gmail.com', 0, '2023-05-23 02:16:01', '');

-- --------------------------------------------------------

--
-- Table structure for table `report_template`
--

CREATE TABLE `report_template` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `report_for` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report_usertemplate`
--

CREATE TABLE `report_usertemplate` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `report_for` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report_usertemplate`
--

INSERT INTO `report_usertemplate` (`id`, `name`, `user_id`, `portfolio_id`, `start_date`, `end_date`, `report_for`, `created_date`) VALUES
(1, 'test', 1, 1, '0000-00-00', '0000-00-00', 1, '2023-07-10 20:06:19'),
(2, 'test2', 1, 1, '0000-00-00', '0000-00-00', 2, '2023-07-10 20:09:32'),
(3, 'test3', 1, 1, '0000-00-00', '0000-00-00', 2, '2023-07-10 20:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `school_names`
--

CREATE TABLE `school_names` (
  `id` int(11) NOT NULL,
  `names` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_names`
--

INSERT INTO `school_names` (`id`, `names`, `status`, `date`) VALUES
(1, 'Addis Ababa University, Ethiopia', 'active', '2021-04-05 16:11:33'),
(2, 'Al Mustan Syria University COM ', 'active', '2021-04-05 16:11:33'),
(3, 'Al-Kindy COM Baghdad University', 'active', '2021-04-05 16:11:33'),
(4, 'Albert Einstein COM', 'active', '2021-04-05 16:11:33'),
(5, 'All Saints University SOM', 'active', '2021-04-05 16:11:33'),
(6, 'American International SOM', 'active', '2021-04-05 16:11:33'),
(7, 'American University of Antigua COM', 'active', '2021-04-05 16:11:33'),
(8, 'American University of Carribean', 'active', '2021-04-05 16:11:33'),
(9, 'American University of Integrative Sciences', 'active', '2021-04-05 16:11:33'),
(10, 'American University School of Medicine Aruba', 'active', '2021-04-05 16:11:33'),
(11, 'Amrita Institute of Medical Sciences', 'active', '2021-04-05 16:11:33'),
(12, 'Apollo Institute of Medical Sciences & Research', 'active', '2021-04-05 16:11:33'),
(13, 'Atlantic University', 'active', '2021-04-05 16:11:33'),
(14, 'Aureus University School of Medicine', 'active', '2021-04-05 16:11:33'),
(15, 'Avalon Univeresity SOM', 'active', '2021-04-05 16:11:33'),
(16, 'Baghdad College of Medicine', 'active', '2021-04-05 16:11:33'),
(17, 'Baylor University', 'active', '2021-04-05 16:11:33'),
(18, 'Bhaskar Medical College, India', 'active', '2021-04-05 16:11:33'),
(19, 'Cairo University, Egypt', 'active', '2021-04-05 16:11:33'),
(20, 'California Northstate University COM', 'active', '2021-04-05 16:11:33'),
(21, 'Caribbean Medical University', 'active', '2021-04-05 16:11:33'),
(22, 'Case Western Reserve University SOM', 'active', '2021-04-05 16:11:33'),
(23, 'Catholic University of Santa María', 'active', '2021-04-05 16:11:33'),
(24, 'Crete SOM', 'active', '2021-04-05 16:11:33'),
(25, 'Dammam University', 'active', '2021-04-05 16:11:33'),
(26, 'Dhaka Medical College, Bangladesh', 'active', '2021-04-05 16:11:33'),
(27, 'Emory University', 'active', '2021-04-05 16:11:33'),
(28, 'Ethnikon kai Kapodistriakon Panepistimion, Greece', 'active', '2021-04-05 16:11:33'),
(29, 'Faculte De Medecine de Besancon', 'active', '2021-04-05 16:11:33'),
(30, 'First Pavlov State Med. Univ. of St. Petersburg, Russia', 'active', '2021-04-05 16:11:33'),
(31, 'Fundacion Barcelo, Argentina', 'active', '2021-04-05 16:11:33'),
(32, 'Gazi University Medical School, Turkey', 'active', '2021-04-05 16:11:33'),
(33, 'Hacettepe Üniversity', 'active', '2021-04-05 16:11:33'),
(34, 'Heidelberg Universiity SOM', 'active', '2021-04-05 16:11:33'),
(35, 'Ibilis State Medical Univ. (Rep. of GA)', 'active', '2021-04-05 16:11:33'),
(36, 'Icahn School of Medicine at Mount Sinai', 'active', '2021-04-05 16:11:33'),
(37, 'International American University SOM', 'active', '2021-04-05 16:11:33'),
(38, 'Kathmandu University', 'active', '2021-04-05 16:11:33'),
(39, 'Kempegowda', 'active', '2021-04-05 16:11:33'),
(40, 'Lady Hardinge Medical College', 'active', '2021-04-05 16:11:33'),
(41, 'Mahidol Univ. / American Global Univ.', 'active', '2021-04-05 16:11:33'),
(42, 'Maringa State University,  Brazil', 'active', '2021-04-05 16:11:33'),
(43, 'Medical College of Baroda', 'active', '2021-04-05 16:11:33'),
(44, 'Medical College of Georgia', 'active', '2021-04-05 16:11:33'),
(45, 'Medical University of South Carolina', 'active', '2021-04-05 16:11:33'),
(46, 'Meharry Medical College', 'active', '2021-04-05 16:11:33'),
(47, 'Mercer University SOM', 'active', '2021-04-05 16:11:33'),
(48, 'MGM Medical College Navi Mumbai', 'active', '2021-04-05 16:11:33'),
(49, 'Mimer Medical College, India', 'active', '2021-04-05 16:11:33'),
(50, 'Morehouse SOM', 'active', '2021-04-05 16:11:33'),
(51, 'Obafemi Awolowo University ', 'active', '2021-04-05 16:11:33'),
(52, 'Philadelphia College of Osteopathic Medicine (PCOM)', 'active', '2021-04-05 16:11:33'),
(53, 'Ross University  SOM', 'active', '2021-04-05 16:11:33'),
(54, 'Royal College of Surgeons - Med. University of Bahrain', 'active', '2021-04-05 16:11:33'),
(55, 'Russia, Novoibizsk Med. Academy', 'active', '2021-04-05 16:11:33'),
(56, 'SABA University SOM', 'active', '2021-04-05 16:11:33'),
(57, 'Saint James School of Medicine', 'active', '2021-04-05 16:11:33'),
(58, 'Santa Casa of Sao Paulo Medical School', 'active', '2021-04-05 16:11:33'),
(59, 'Serbian Medical School', 'active', '2021-04-05 16:11:33'),
(60, 'Shandong University SOM', 'active', '2021-04-05 16:11:33'),
(61, 'SOMAH, Unversity of the Gambia', 'active', '2021-04-05 16:11:33'),
(62, 'South East Medical University', 'active', '2021-04-05 16:11:33'),
(63, 'Spartan Health Sciences', 'active', '2021-04-05 16:11:33'),
(64, 'St. Georges University SOM', 'active', '2021-04-05 16:11:33'),
(65, 'St. Matthew\'s University SOM', 'active', '2021-04-05 16:11:33'),
(66, 'Suez Canal University', 'active', '2021-04-05 16:11:33'),
(67, 'Texilla American University', 'active', '2021-04-05 16:11:33'),
(68, 'Tishreen University, Syria', 'active', '2021-04-05 16:11:33'),
(69, 'Trinity School of Medicine', 'active', '2021-04-05 16:11:33'),
(70, 'UAG - Universidad Autónoma de Guadalajara', 'active', '2021-04-05 16:11:33'),
(71, 'University of Mediciine and Health Sciences', 'active', '2021-04-05 16:11:33'),
(72, 'UNITAU - University of Taubaté, Brazil', 'active', '2021-04-05 16:11:33'),
(73, 'University Autonoma de Guadalajara', 'active', '2021-04-05 16:11:33'),
(74, 'University of Damascus', 'active', '2021-04-05 16:11:33'),
(75, 'Univeristy of Haiti SOM', 'active', '2021-04-05 16:11:33'),
(76, 'University of Ilorin, Nigeria', 'active', '2021-04-05 16:11:33'),
(77, 'University of Lago, Nigeria', 'active', '2021-04-05 16:11:33'),
(78, 'University of South Carolina', 'active', '2021-04-05 16:11:33'),
(79, 'Universidad de Panama SOM', 'active', '2021-04-05 16:11:33'),
(80, 'Universidad del Zulia', 'active', '2021-04-05 16:11:33'),
(81, 'Universidad Latino de Costa Rica', 'active', '2021-04-05 16:11:33'),
(82, 'Université de Bourgogne, France', 'active', '2021-04-05 16:11:33'),
(83, 'University of Georgia', 'active', '2021-04-05 16:11:33'),
(84, 'University of Health Sciences Antigua', 'active', '2021-04-05 16:11:33'),
(85, 'University of Pisa, Italy', 'active', '2021-04-05 16:11:33'),
(86, 'University of Titu Maiorescu, Bucharest', 'active', '2021-04-05 16:11:33'),
(87, 'University of Science, Arts and Technology', 'active', '2021-04-05 16:11:33'),
(88, 'Usmania SOM', 'active', '2021-04-05 16:11:33'),
(89, 'VCOM - Carolinas', 'active', '2021-04-05 16:11:33'),
(90, 'Washington University of Health & Sciences', 'active', '2021-04-05 16:11:33'),
(91, 'Windsor University SOM ', 'active', '2021-04-05 16:11:33'),
(92, 'Xavier University SOM', 'active', '2021-04-05 16:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `strategies`
--

CREATE TABLE `strategies` (
  `sid` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `gdept_id` int(11) NOT NULL,
  `sname` text NOT NULL,
  `sdes` text NOT NULL,
  `sprogress` varchar(50) NOT NULL,
  `screated_by` int(11) NOT NULL,
  `screated_date` date NOT NULL,
  `s_trash` varchar(30) NOT NULL,
  `s_trash_date` text NOT NULL,
  `s_single_trash` varchar(50) NOT NULL,
  `s_archive` varchar(50) NOT NULL,
  `s_archive_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `s_file_it` varchar(50) NOT NULL,
  `s_file_it_date` datetime NOT NULL,
  `corporate_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `strategies`
--

INSERT INTO `strategies` (`sid`, `portfolio_id`, `gid`, `gdept_id`, `sname`, `sdes`, `sprogress`, `screated_by`, `screated_date`, `s_trash`, `s_trash_date`, `s_single_trash`, `s_archive`, `s_archive_date`, `reg_acc_status`, `s_file_it`, `s_file_it_date`, `corporate_id`) VALUES
(1, 1, 1, 3, 'jg k1', '', 'in_progress', 1, '2023-06-15', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(2, 1, 3, 3, 'test kpi', '', 'to_do', 399, '2023-06-21', '', '', '', '', '', '', 'yes', '2023-06-23 02:25:28', 'web305'),
(3, 1, 4, 3, 'ag k1', '', 'to_do', 1, '2023-06-26', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(4, 1, 4, 3, 'ag k2', '', 'to_do', 1, '2023-06-26', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(5, 1, 4, 3, 'ag k3', '', 'to_do', 1, '2023-06-26', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(6, 1, 5, 2, 'test kpi', '', 'to_do', 399, '2023-07-05', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `is_scheduled` varchar(10) NOT NULL,
  `exam_date` date NOT NULL,
  `confidence_level_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_module`
--

CREATE TABLE `student_module` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subtask`
--

CREATE TABLE `subtask` (
  `stid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `stproject_assign` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `stcode` text NOT NULL,
  `stname` text NOT NULL,
  `stdes` text NOT NULL,
  `stlink` text NOT NULL,
  `stlink_comment` text NOT NULL,
  `stnote` text NOT NULL,
  `stfile` text NOT NULL,
  `stpriority` varchar(50) NOT NULL,
  `ststatus` varchar(50) NOT NULL,
  `ststatus_date` datetime NOT NULL,
  `sreview` varchar(50) NOT NULL,
  `sreview_clear` varchar(50) NOT NULL,
  `sreview_notify` varchar(50) NOT NULL,
  `po_sreview_clear` varchar(50) NOT NULL,
  `po_sreview_notify` varchar(50) NOT NULL,
  `sreview_notdate` text NOT NULL,
  `stassignee` int(11) NOT NULL,
  `stcreated_by` int(11) NOT NULL,
  `stcreated_date` datetime NOT NULL,
  `stdue_date` date NOT NULL,
  `stdue_date_clear` varchar(50) NOT NULL,
  `stnotify` varchar(30) NOT NULL,
  `stnotify_clear` varchar(50) NOT NULL,
  `stnotify_date` text NOT NULL,
  `strash` varchar(30) NOT NULL,
  `strash_date` text NOT NULL,
  `estimated_stime` text NOT NULL,
  `start_stimer` text NOT NULL,
  `start_stimer_new` text NOT NULL,
  `sflag` int(11) NOT NULL,
  `tracked_stime` text NOT NULL,
  `timer_salert_status` int(11) NOT NULL,
  `subtask_archive` varchar(50) NOT NULL,
  `subtask_archive_date` text NOT NULL,
  `snew_file` text NOT NULL,
  `stfnotify` text NOT NULL,
  `stfnotify_clear` text NOT NULL,
  `stfnotify_date` text NOT NULL,
  `stsingle_trash` varchar(50) NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `subtask_file_it` varchar(50) NOT NULL,
  `subtask_file_it_date` datetime NOT NULL,
  `corporate_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subtask`
--

INSERT INTO `subtask` (`stid`, `tid`, `stproject_assign`, `gid`, `sid`, `portfolio_id`, `dept_id`, `stcode`, `stname`, `stdes`, `stlink`, `stlink_comment`, `stnote`, `stfile`, `stpriority`, `ststatus`, `ststatus_date`, `sreview`, `sreview_clear`, `sreview_notify`, `po_sreview_clear`, `po_sreview_notify`, `sreview_notdate`, `stassignee`, `stcreated_by`, `stcreated_date`, `stdue_date`, `stdue_date_clear`, `stnotify`, `stnotify_clear`, `stnotify_date`, `strash`, `strash_date`, `estimated_stime`, `start_stimer`, `start_stimer_new`, `sflag`, `tracked_stime`, `timer_salert_status`, `subtask_archive`, `subtask_archive_date`, `snew_file`, `stfnotify`, `stfnotify_clear`, `stfnotify_date`, `stsingle_trash`, `reg_acc_status`, `subtask_file_it`, `subtask_file_it_date`, `corporate_id`) VALUES
(1, 1, 1, 1, 1, 1, 3, 'JG-9523', 'jg k1 p1 t1 s1', '', '', '', '', '1687512515_3.jpg,1687848104_test-cases.xlsx', 'medium', 'to_do', '2023-07-10 09:54:09', '', '', '', '', '', '', 399, 1, '2023-06-21 03:00:28', '2023-07-24', 'no', 'seen', 'yes', '2023-06-27 02:41:44', '', '', '', '', '', 0, '00:00:00', 0, '', '', '1687848104_test-cases.xlsx', ',398', ',398', '2023-06-27 02:41:44', '', '', '', '0000-00-00 00:00:00', 'web305'),
(2, 9, 5, 0, 0, 1, 2, 'TE-7086', 'test subtask', '', '', '', '', '', 'medium', 'done', '2023-06-23 02:25:02', '', '', '', '', '', '', 399, 399, '2023-06-23 02:24:30', '2023-06-29', 'yes', 'seen', 'yes', '2023-06-23 02:24:30', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(3, 17, 12, 4, 3, 1, 3, 'AG-9921', 'testing s1', '', '', '', '', '', 'high', 'to_do', '2023-07-11 03:35:04', '', '', '', '', '', '', 1, 1, '2023-07-11 01:54:02', '2023-08-22', 'no', 'yes', 'no', '2023-07-11 01:54:02', '', '', '', '', '', 0, '00:01:02', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305');

-- --------------------------------------------------------

--
-- Table structure for table `subtask_trash`
--

CREATE TABLE `subtask_trash` (
  `strash_id` int(11) NOT NULL,
  `stid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `stfile` text NOT NULL,
  `stask_trash` varchar(50) NOT NULL,
  `stask_trash_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `sa_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `verified` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`sa_id`, `username`, `password`, `verified`) VALUES
(1, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `tid` int(11) NOT NULL,
  `tcode` text NOT NULL,
  `tname` text NOT NULL,
  `tdes` text NOT NULL,
  `tlink` text NOT NULL,
  `tlink_comment` text NOT NULL,
  `tnote` text NOT NULL,
  `tfile` text NOT NULL,
  `tpriority` varchar(50) NOT NULL,
  `tstatus` varchar(50) NOT NULL,
  `tstatus_date` datetime NOT NULL,
  `tproject_assign` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `review` varchar(50) NOT NULL,
  `review_clear` varchar(50) NOT NULL,
  `review_notify` varchar(50) NOT NULL,
  `po_review_clear` varchar(50) NOT NULL,
  `po_review_notify` varchar(50) NOT NULL,
  `review_notdate` text NOT NULL,
  `tassignee` int(11) NOT NULL,
  `tcreated_by` int(11) NOT NULL,
  `tcreated_date` datetime NOT NULL,
  `tdue_date` date NOT NULL,
  `tdue_date_clear` varchar(50) NOT NULL,
  `tnotify` varchar(30) NOT NULL,
  `tnotify_clear` varchar(50) NOT NULL,
  `tnotify_date` text NOT NULL,
  `trash` varchar(30) NOT NULL,
  `trash_date` text NOT NULL,
  `estimated_time` text NOT NULL,
  `start_timer` text NOT NULL,
  `start_timer_new` text NOT NULL,
  `flag` int(11) NOT NULL,
  `tracked_time` text DEFAULT '\'00:00:00\'',
  `timer_alert_status` int(11) NOT NULL,
  `task_archive` varchar(50) NOT NULL,
  `task_archive_date` text NOT NULL,
  `new_file` text NOT NULL,
  `tfnotify` text NOT NULL,
  `tfnotify_clear` text NOT NULL,
  `tfnotify_date` text NOT NULL,
  `tsingle_trash` varchar(50) NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL,
  `task_file_it` varchar(50) NOT NULL,
  `task_file_it_date` datetime NOT NULL,
  `corporate_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`tid`, `tcode`, `tname`, `tdes`, `tlink`, `tlink_comment`, `tnote`, `tfile`, `tpriority`, `tstatus`, `tstatus_date`, `tproject_assign`, `gid`, `sid`, `portfolio_id`, `dept_id`, `review`, `review_clear`, `review_notify`, `po_review_clear`, `po_review_notify`, `review_notdate`, `tassignee`, `tcreated_by`, `tcreated_date`, `tdue_date`, `tdue_date_clear`, `tnotify`, `tnotify_clear`, `tnotify_date`, `trash`, `trash_date`, `estimated_time`, `start_timer`, `start_timer_new`, `flag`, `tracked_time`, `timer_alert_status`, `task_archive`, `task_archive_date`, `new_file`, `tfnotify`, `tfnotify_clear`, `tfnotify_date`, `tsingle_trash`, `reg_acc_status`, `task_file_it`, `task_file_it_date`, `corporate_id`) VALUES
(1, 'JG-4352', 'jg k1 p1 t1', '', '', '', '', '1687512504_2.jpg', 'low', 'in_progress', '2023-07-10 09:54:22', 1, 1, 1, 1, 3, '', '', '', '', '', '', 399, 1, '2023-06-16 05:44:21', '2023-07-30', 'no', 'seen', 'yes', '2023-06-23 05:28:24', '', '', '', '', '', 0, '09:30:09', 0, '', '', '1687512504_2.jpg', ',398', ',398', '2023-06-28 03:28:22', '', '', '', '0000-00-00 00:00:00', 'web305'),
(2, 'JG-7713', 'jg k1 p1 t2', '', '', '', '', '', 'high', 'to_do', '2023-07-10 09:41:19', 1, 1, 1, 1, 3, '', '', '', '', '', '', 398, 1, '2023-06-16 09:05:16', '2023-07-12', 'no', 'seen', 'no', '2023-06-16 09:05:16', '', '', '', '', '', 0, '00:00:00', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(3, 'JG-3711', 'jg k1 c1 t1', '', '', '', '', '', 'low', 'to_do', '2023-06-22 01:32:38', 4, 1, 1, 1, 3, '', '', '', '', '', '', 399, 1, '2023-06-19 05:34:46', '2023-06-30', 'yes', 'seen', 'yes', '2023-06-19 05:34:46', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(4, 'JG-3911', 'jg k1 c1 t2', '', '', '', '', '', 'medium', 'to_do', '2023-06-23 03:14:50', 4, 1, 1, 1, 3, '', '', '', '', '', '', 1, 399, '2023-06-19 06:17:34', '2023-06-30', 'yes', 'seen', 'yes', '2023-06-19 06:17:34', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(5, 'JG-195', 'jg k1 c1 t3', '', '', '', '', '', 'low', 'to_do', '2023-07-10 09:27:52', 4, 1, 1, 1, 3, '', '', '', '', '', '', 1, 1, '2023-06-19 08:35:30', '2023-06-23', 'yes', 'seen', 'yes', '2023-06-23 01:03:55', '', '', '', '', '', 0, '00:00:07', 0, '', '', '', '', '', '2023-06-23 01:03:55', '', '', '', '0000-00-00 00:00:00', 'web305'),
(6, 'JG-7932', 'jg k1 p1 t2', '', '', '', '', '', 'high', 'done', '2023-06-26 05:31:55', 1, 1, 1, 1, 3, '', '', '', '', '', '', 1, 1, '2023-06-19 08:35:46', '2023-07-30', 'no', 'seen', 'yes', '2023-06-22 03:22:58', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(7, 'JG-182', 'jg k1 c1 t3', '', '', '', '', '', 'medium', 'to_do', '2023-06-22 09:22:49', 4, 1, 1, 1, 3, '', '', '', '', '', '', 399, 1, '2023-06-22 09:22:49', '2023-06-26', 'yes', 'seen', 'yes', '2023-06-26 01:03:34', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '2023-06-26 01:03:34', '', '', '', '0000-00-00 00:00:00', 'web305'),
(8, 'JG-4031', 'jg k1 c1 t4', '', '', '', '', '', 'medium', 'in_progress', '2023-06-23 01:30:51', 4, 1, 1, 1, 3, '', '', '', '', '', '', 399, 1, '2023-06-22 09:23:12', '2023-06-24', 'yes', 'seen', 'yes', '2023-06-22 09:23:21', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '2023-06-22 09:23:21', '', '', '', '0000-00-00 00:00:00', 'web305'),
(9, 'TE-3243', 'test task', '', '', '', '', '', 'medium', 'done', '2023-06-23 02:25:04', 5, 0, 0, 1, 2, '', '', '', '', '', '', 399, 399, '2023-06-23 02:24:18', '2023-06-29', 'yes', 'seen', 'yes', '2023-06-23 02:24:18', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(10, 'JG-6355', 'new t', '', '', '', '', '1688564663_1687843767_1-.jpg', 'high', 'to_do', '2023-07-05 09:44:23', 2, 1, 1, 1, 3, '', '', '', '', '', '', 399, 1, '2023-07-05 09:44:23', '2023-07-06', 'yes', 'seen', 'yes', '2023-07-05 09:44:23', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(11, 'RE-3582', 'rp2 t1', '', '', '', '', '', 'high', 'in_progress', '2023-07-07 04:03:03', 14, 0, 0, 1, 3, '', '', '', '', '', '', 1, 1, '2023-07-06 07:12:18', '2023-07-07', 'yes', 'seen', 'yes', '2023-07-06 07:12:18', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(12, 'RE-8613', 'rp2 t2', '', '', '', '', '', 'high', 'done', '2023-07-07 04:03:44', 14, 0, 0, 1, 3, 'approved', 'yes', 'sent_yes', 'yes', 'sent_yes', '2023-07-07 05:05:44', 399, 1, '2023-07-06 07:12:32', '2023-07-08', 'yes', 'yes', 'yes', '2023-07-06 07:12:32', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(13, 'JG-3692', 'jg k1 p1 t3', '', '', '', '', '', 'low', 'to_do', '2023-07-11 01:15:58', 1, 1, 1, 1, 3, '', '', '', '', '', '', 1, 1, '2023-07-11 01:15:58', '2023-07-12', 'no', 'seen', 'no', '2023-07-11 01:15:58', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(14, 'JG-2748', 'jg k1 p1 t4', '', '', '', '', '', 'low', 'to_do', '2023-07-11 01:16:07', 1, 1, 1, 1, 3, '', '', '', '', '', '', 1, 1, '2023-07-11 01:16:07', '2023-07-11', 'no', 'seen', 'no', '2023-07-11 01:16:24', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '2023-07-11 01:16:24', '', '', '', '0000-00-00 00:00:00', 'web305'),
(15, 'JG-7033', 'jg k1 p1 t5', '', '', '', '', '', 'high', 'to_do', '2023-07-11 01:16:42', 1, 1, 1, 1, 3, '', '', '', '', '', '', 1, 1, '2023-07-11 01:16:42', '2023-07-14', 'no', 'seen', 'no', '2023-07-11 01:16:42', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(16, 'JG-6281', 'jg k1 p1 t8', '', '', '', '', '', 'medium', 'to_do', '2023-07-11 01:22:03', 1, 1, 1, 1, 3, '', '', '', '', '', '', 1, 1, '2023-07-11 01:22:03', '2023-07-12', 'no', 'seen', 'no', '2023-07-11 01:22:03', '', '', '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305'),
(17, 'AG-349', 'testing', '', '', '', '', '', 'low', 'in_progress', '2023-07-11 02:04:06', 12, 4, 3, 1, 3, '', '', '', '', '', '', 1, 1, '2023-07-11 01:43:13', '2023-08-23', 'no', 'seen', 'no', '2023-07-11 01:43:13', '', '', '', '', '', 0, '02:08:53', 0, '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 'web305');

-- --------------------------------------------------------

--
-- Table structure for table `task_trash`
--

CREATE TABLE `task_trash` (
  `trash_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `tfile` text NOT NULL,
  `task_trash` varchar(50) NOT NULL,
  `task_trash_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `unique_id` text NOT NULL,
  `subject` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `priority` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `attached_files` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `assignee` int(11) NOT NULL,
  `assignee_comment` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `approve` varchar(20) NOT NULL,
  `deny_date` datetime NOT NULL,
  `opened_date` datetime NOT NULL,
  `assigned_date` datetime NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `in_progress_date` datetime NOT NULL,
  `in_review_date` datetime NOT NULL,
  `pending_date` datetime NOT NULL,
  `resolved_date` datetime NOT NULL,
  `closed_date` datetime NOT NULL,
  `cancelled_date` datetime NOT NULL,
  `cancelled_by` varchar(50) NOT NULL,
  `reverted_date` datetime NOT NULL,
  `notify` text NOT NULL,
  `notify_date` datetime NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `unique_id`, `subject`, `type`, `priority`, `description`, `attached_files`, `created_by`, `assignee`, `assignee_comment`, `start_date`, `end_date`, `status`, `approve`, `deny_date`, `opened_date`, `assigned_date`, `assigned_by`, `in_progress_date`, `in_review_date`, `pending_date`, `resolved_date`, `closed_date`, `cancelled_date`, `cancelled_by`, `reverted_date`, `notify`, `notify_date`, `deleted`) VALUES
(1, '6865', 'Test Ticket', 'Issue', 'Medium', 'This is a test issue', '1676987327_decision_168_unlock_power_of_getting_started_post.png', 3, 2, '', '0000-00-00 00:00:00', '2023-02-28 00:00:00', 'cancelled', '', '0000-00-00 00:00:00', '2023-02-21 08:48:47', '2023-02-21 08:50:55', 0, '2023-02-21 08:53:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-02-21 09:04:26', 'Supporter', '0000-00-00 00:00:00', 'ticket_in_progress', '2023-02-21 09:04:26', 1),
(2, '7855', 'File Cabinet is not working', 'Issue', 'High', 'Test', '', 12, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'cancelled', '', '0000-00-00 00:00:00', '2023-03-14 08:14:48', '2023-03-14 08:15:35', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2023-05-04 04:58:16', 'Supporter', '0000-00-00 00:00:00', '', '2023-05-04 04:58:16', 0),
(3, '5638', 'found bug in porfolio', 'Issue', 'High', 'phone number textbox accepts invalid test data like(1234)\r\nplease fix this issue', '', 369, 9, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'assigned', '', '0000-00-00 00:00:00', '2023-03-30 09:35:57', '2023-05-15 04:08:47', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 'ticket_created,ticket_assigned', '2023-05-15 04:08:47', 0),
(4, '6701', 'project name more than 100 words but it allows only limited words', 'Inquiry', 'Low', 'project name more than 100 words but it allows only limited words', '', 369, 2, '', '0000-00-00 00:00:00', '2023-05-24 00:00:00', 'assigned', '', '0000-00-00 00:00:00', '2023-03-31 05:37:50', '2023-05-15 04:08:37', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 'ticket_created', '2023-05-15 04:08:37', 0),
(5, '1765', 'Calendar Date Select Scrolling', 'Issue', 'Medium', 'When attempting to select a date while creating an event, the calendar doesn\'t scroll down for me to select the desired date.', '1682337943_screenshot_2023-04-24_at_8.03.20_am.png', 3, 1, '', '0000-00-00 00:00:00', '2023-04-25 00:00:00', 'resolved', 'yes', '0000-00-00 00:00:00', '2023-04-24 08:05:43', '2023-04-24 08:06:40', 0, '2023-04-25 01:50:20', '2023-04-25 07:53:14', '2023-04-25 13:57:30', '2023-05-15 07:52:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 'ticket_created,ticket_in_progress,ticket_in_review,ticket_resolved', '2023-05-15 07:52:01', 0),
(6, '3271', 'testinggg', 'Inquiry', 'Low', 'fdfsdf', '', 5, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'open', '', '0000-00-00 00:00:00', '2023-05-15 03:04:33', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '2023-05-17 10:53:04', 'ticket_created', '2023-05-17 10:53:04', 0),
(7, '1952', 'Ticket to test', 'Inquiry', 'Low', 'Ticket to test', '', 5, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'assigned', '', '0000-00-00 00:00:00', '2023-05-15 10:44:26', '2023-05-15 11:14:19', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 'ticket_created', '2023-05-15 11:14:19', 0),
(8, '6150', 'new latest ticket', 'Complaint', 'Medium', 'asd wqa f wqdqweq', '', 5, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'assigned', '', '0000-00-00 00:00:00', '2023-05-16 10:32:50', '2023-05-17 10:46:59', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 'ticket_created,ticket_assigned', '2023-05-17 10:46:59', 0),
(9, '9724', 'sefsdf', 'Inquiry', 'Low', 'fsdfsd', '1684335055_chat-5638_.pdf,1684335055_chat-2258_.pdf,1684335055_chat-5638_1.pdf,1684335055_assigned_tickets.xlsx', 5, 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'assigned', '', '0000-00-00 00:00:00', '2023-05-17 10:50:55', '2023-05-17 11:43:42', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 'ticket_created', '2023-05-17 11:43:42', 0),
(10, '3834', 'sf r rewr', 'Complaint', 'Medium', 'werrew', '1684335072_1683791727_1675254423_landing-1-.png', 5, 2, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'assigned', '', '0000-00-00 00:00:00', '2023-05-17 10:51:12', '2023-05-17 10:52:10', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 'ticket_created,ticket_assigned', '2023-05-17 10:52:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_chat`
--

CREATE TABLE `ticket_chat` (
  `chat_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `notify` int(11) NOT NULL,
  `notify_date` datetime NOT NULL,
  `message_date` datetime NOT NULL,
  `delete_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_chat`
--

INSERT INTO `ticket_chat` (`chat_id`, `ticket_id`, `message`, `user_id`, `user_role`, `status`, `notify`, `notify_date`, `message_date`, `delete_date`) VALUES
(1, 1, 'can you update me on the status of this issue', 3, 'user', 'active', 1, '2023-02-21 08:54:22', '2023-02-21 08:54:17', '0000-00-00 00:00:00'),
(2, 1, 'Will Update', 2, 'supporter', 'active', 1, '2023-02-21 08:54:47', '2023-02-21 08:54:42', '0000-00-00 00:00:00'),
(3, 1, 'Updated', 2, 'supporter', 'active', 1, '2023-02-21 08:56:36', '2023-02-21 08:56:12', '0000-00-00 00:00:00'),
(4, 1, ':)', 3, 'user', 'active', 1, '2023-02-21 08:58:53', '2023-02-21 08:57:09', '0000-00-00 00:00:00'),
(5, 1, '👍🏻', 2, 'supporter', 'active', 1, '2023-02-21 09:04:37', '2023-02-21 08:58:53', '0000-00-00 00:00:00'),
(6, 3, 'hi', 369, 'user', 'inactive', 1, '2023-03-31 07:18:37', '2023-03-31 05:37:09', '2023-03-31 05:37:31'),
(7, 3, 'project name more than 100 words but it allows only limited words project name more than 100 words but it allows only limited words project name more than 100 words but it allows only limited words project name more than 100 words but it allows only limited wordsproject name more than 100 words but it allows only limited words', 369, 'user', 'inactive', 1, '2023-03-31 07:18:37', '2023-03-31 05:37:15', '2023-03-31 05:37:23'),
(8, 3, '👍', 1, 'supporter', 'active', 1, '2023-04-24 08:06:30', '2023-04-20 03:51:04', '0000-00-00 00:00:00'),
(9, 4, 'dsfsd', 0, 'superadmin', 'active', 1, '2023-05-15 01:54:13', '2023-05-09 02:48:21', '0000-00-00 00:00:00'),
(10, 5, 'hi', 1, 'supporter', 'active', 1, '2023-05-22 02:50:46', '2023-05-17 06:51:31', '0000-00-00 00:00:00'),
(11, 9, 'heii', 1, 'supporter', 'inactive', 1, '2023-05-17 11:54:46', '2023-05-17 11:44:42', '2023-05-17 11:44:54'),
(12, 10, 'hi', 0, 'superadmin', 'active', 1, '2023-05-17 12:32:02', '2023-05-17 12:03:30', '0000-00-00 00:00:00'),
(13, 9, 'hiee', 1, 'supporter', 'inactive', 1, '2023-05-22 02:53:55', '2023-05-17 12:42:21', '2023-05-17 12:47:39'),
(14, 8, 'sdfsdfs', 2, 'supporter', 'inactive', 1, '2023-05-22 03:09:58', '2023-05-17 12:42:45', '2023-05-17 12:47:58'),
(15, 10, 'hiiii', 2, 'supporter', 'active', 1, '2023-05-22 02:53:42', '2023-05-17 12:48:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_history`
--

CREATE TABLE `ticket_history` (
  `hid` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `assignee_id` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `h_description` text NOT NULL,
  `assignee_reject_reason` text NOT NULL,
  `h_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_history`
--

INSERT INTO `ticket_history` (`hid`, `ticket_id`, `assignee_id`, `assigned_by`, `h_description`, `assignee_reject_reason`, `h_date`) VALUES
(1, 1, 9, 0, 'Assigned the Ticket', '', '2023-02-21 08:49:55'),
(2, 1, 0, 0, 'Assigned the Ticket', '', '2023-02-21 08:50:18'),
(3, 1, 2, 0, 'Assigned the Ticket', '', '2023-02-21 08:50:55'),
(4, 1, 2, 0, 'ticket_in_progress', '', '2023-02-21 08:53:33'),
(5, 1, 2, 0, 'ticket_cancelled', '', '2023-02-21 09:04:26'),
(6, 2, 1, 0, 'Assigned the Ticket', '', '2023-03-14 08:15:35'),
(7, 3, 1, 0, 'Assigned the Ticket', '', '2023-03-30 09:44:00'),
(8, 4, 1, 0, 'Assigned the Ticket', '', '2023-03-31 07:18:34'),
(9, 5, 1, 0, 'Assigned the Ticket', '', '2023-04-24 08:06:40'),
(10, 5, 1, 0, 'ticket_in_progress', '', '2023-04-25 01:50:20'),
(11, 5, 1, 0, 'ticket_in_review', '', '2023-04-25 07:53:14'),
(12, 5, 1, 0, 'ticket_approved_pending', '', '2023-04-25 13:57:30'),
(13, 2, 1, 0, 'ticket_cancelled', '', '2023-05-04 04:58:16'),
(14, 4, 2, 0, 'Assigned the Ticket', '', '2023-05-15 04:08:37'),
(15, 3, 9, 0, 'Assigned the Ticket', '', '2023-05-15 04:08:47'),
(16, 6, 1, 1, 'Assigned the Ticket', '', '2023-05-15 06:04:32'),
(17, 5, 1, 0, 'ticket_resolved', '', '2023-05-15 07:52:01'),
(18, 6, 1, 0, 'ticket_in_progress', '', '2023-05-15 07:52:10'),
(19, 7, 1, 1, 'Assigned the Ticket', '', '2023-05-15 11:14:19'),
(20, 8, 1, 1, 'Assigned the Ticket', '', '2023-05-17 10:46:59'),
(21, 10, 2, 2, 'Assigned the Ticket', '', '2023-05-17 10:52:10'),
(22, 6, 1, 0, 'Reverted the Ticket', 'please check', '2023-05-17 10:53:04'),
(23, 9, 1, 0, 'Assigned the Ticket', '', '2023-05-17 11:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `time_12hours`
--

CREATE TABLE `time_12hours` (
  `id` int(11) NOT NULL,
  `time` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_12hours`
--

INSERT INTO `time_12hours` (`id`, `time`, `status`, `date`) VALUES
(1, '12:00 AM', 'active', '2021-05-25 11:15:12'),
(2, '12:15 AM', 'active', '2021-05-25 11:15:12'),
(3, '12:30 AM', 'active', '2021-05-25 11:15:12'),
(4, '12:45 AM', 'active', '2021-05-25 11:15:12'),
(5, '01:00 AM', 'active', '2021-05-25 11:15:12'),
(6, '01:15 AM', 'active', '2021-05-25 11:15:12'),
(7, '01:30 AM', 'active', '2021-05-25 11:15:12'),
(8, '01:45 AM', 'active', '2021-05-25 11:15:12'),
(9, '02:00 AM', 'active', '2021-05-25 11:15:12'),
(10, '02:15 AM', 'active', '2021-05-25 11:15:12'),
(11, '02:30 AM', 'active', '2021-05-25 11:15:12'),
(12, '02:45 AM', 'active', '2021-05-25 11:15:12'),
(13, '03:00 AM', 'active', '2021-05-25 11:15:12'),
(14, '03:15 AM', 'active', '2021-05-25 11:15:12'),
(15, '03:30 AM', 'active', '2021-05-25 11:15:12'),
(16, '03:45 AM', 'active', '2021-05-25 11:15:12'),
(17, '04:00 AM', 'active', '2021-05-25 11:15:12'),
(18, '04:15 AM', 'active', '2021-05-25 11:15:12'),
(19, '04:30 AM', 'active', '2021-05-25 11:15:12'),
(20, '04:45 AM', 'active', '2021-05-25 11:15:12'),
(21, '05:00 AM', 'active', '2021-05-25 11:15:12'),
(22, '05:15 AM', 'active', '2021-05-25 11:15:12'),
(23, '05:30 AM', 'active', '2021-05-25 11:15:12'),
(24, '05:45 AM', 'active', '2021-05-25 11:15:12'),
(25, '06:00 AM', 'active', '2021-05-25 11:15:12'),
(26, '06:15 AM', 'active', '2021-05-25 11:15:12'),
(27, '06:30 AM', 'active', '2021-05-25 11:15:12'),
(28, '06:45 AM', 'active', '2021-05-25 11:15:12'),
(29, '07:00 AM', 'active', '2021-05-25 11:15:12'),
(30, '07:15 AM', 'active', '2021-05-25 11:15:12'),
(31, '07:30 AM', 'active', '2021-05-25 11:15:12'),
(32, '07:45 AM', 'active', '2021-05-25 11:15:12'),
(33, '08:00 AM', 'active', '2021-05-25 11:15:12'),
(34, '08:15 AM', 'active', '2021-05-25 11:15:12'),
(35, '08:30 AM', 'active', '2021-05-25 11:15:12'),
(36, '08:45 AM', 'active', '2021-05-25 11:15:12'),
(37, '09:00 AM', 'active', '2021-05-25 11:15:12'),
(38, '09:15 AM', 'active', '2021-05-25 11:15:12'),
(39, '09:30 AM', 'active', '2021-05-25 11:15:12'),
(40, '09:45 AM', 'active', '2021-05-25 11:15:12'),
(41, '10:00 AM', 'active', '2021-05-25 11:15:12'),
(42, '10:15 AM', 'active', '2021-05-25 11:15:12'),
(43, '10:30 AM', 'active', '2021-05-25 11:15:12'),
(44, '10:45 AM', 'active', '2021-05-25 11:15:12'),
(45, '11:00 AM', 'active', '2021-05-25 11:15:12'),
(46, '11:15 AM', 'active', '2021-05-25 11:15:12'),
(47, '11:30 AM', 'active', '2021-05-25 11:15:12'),
(48, '11:45 AM', 'active', '2021-05-25 11:15:12'),
(49, '12:00 PM', 'active', '2021-05-25 11:15:12'),
(50, '12:15 PM', 'active', '2021-05-25 11:15:12'),
(51, '12:30 PM', 'active', '2021-05-25 11:15:12'),
(52, '12:45 PM', 'active', '2021-05-25 11:15:12'),
(53, '01:00 PM', 'active', '2021-05-25 11:15:12'),
(54, '01:15 PM', 'active', '2021-05-25 11:15:12'),
(55, '01:30 PM', 'active', '2021-05-25 11:15:12'),
(56, '01:45 PM', 'active', '2021-05-25 11:15:12'),
(57, '02:00 PM', 'active', '2021-05-25 11:15:12'),
(58, '02:15 PM', 'active', '2021-05-25 11:15:12'),
(59, '02:30 PM', 'active', '2021-05-25 11:15:12'),
(60, '02:45 PM', 'active', '2021-05-25 11:15:12'),
(61, '03:00 PM', 'active', '2021-05-25 11:15:12'),
(62, '03:15 PM', 'active', '2021-05-25 11:15:12'),
(63, '03:30 PM', 'active', '2021-05-25 11:15:12'),
(64, '03:45 PM', 'active', '2021-05-25 11:15:12'),
(65, '04:00 PM', 'active', '2021-05-25 11:15:12'),
(66, '04:15 PM', 'active', '2021-05-25 11:15:12'),
(67, '04:30 PM', 'active', '2021-05-25 11:15:12'),
(68, '04:45 PM', 'active', '2021-05-25 11:15:12'),
(69, '05:00 PM', 'active', '2021-05-25 11:15:12'),
(70, '05:15 PM', 'active', '2021-05-25 11:15:12'),
(71, '05:30 PM', 'active', '2021-05-25 11:15:12'),
(72, '05:45 PM', 'active', '2021-05-25 11:15:12'),
(73, '06:00 PM', 'active', '2021-05-25 11:15:12'),
(74, '06:15 PM', 'active', '2021-05-25 11:15:12'),
(75, '06:30 PM', 'active', '2021-05-25 11:15:12'),
(76, '06:45 PM', 'active', '2021-05-25 11:15:12'),
(77, '07:00 PM', 'active', '2021-05-25 11:15:12'),
(78, '07:15 PM', 'active', '2021-05-25 11:15:12'),
(79, '07:30 PM', 'active', '2021-05-25 11:15:12'),
(80, '07:45 PM', 'active', '2021-05-25 11:15:12'),
(81, '08:00 PM', 'active', '2021-05-25 11:15:12'),
(82, '08:15 PM', 'active', '2021-05-25 11:15:12'),
(83, '08:30 PM', 'active', '2021-05-25 11:15:12'),
(84, '08:45 PM', 'active', '2021-05-25 11:15:12'),
(85, '09:00 PM', 'active', '2021-05-25 11:15:12'),
(86, '09:15 PM', 'active', '2021-05-25 11:15:12'),
(87, '09:30 PM', 'active', '2021-05-25 11:15:12'),
(88, '09:45 PM', 'active', '2021-05-25 11:15:12'),
(89, '10:00 PM', 'active', '2021-05-25 11:15:12'),
(90, '10:15 PM', 'active', '2021-05-25 11:15:12'),
(91, '10:30 PM', 'active', '2021-05-25 11:15:12'),
(92, '10:45 PM', 'active', '2021-05-25 11:15:12'),
(93, '11:00 PM', 'active', '2021-05-25 11:15:12'),
(94, '11:15 PM', 'active', '2021-05-25 11:15:12'),
(95, '11:30 PM', 'active', '2021-05-25 11:15:12'),
(96, '11:45 PM', 'active', '2021-05-25 11:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `time_24hours`
--

CREATE TABLE `time_24hours` (
  `id` int(11) NOT NULL,
  `time` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_24hours`
--

INSERT INTO `time_24hours` (`id`, `time`, `status`, `date`) VALUES
(1, '00:00', 'active', '2021-05-25 11:15:12'),
(2, '00:15', 'active', '2021-05-25 11:15:12'),
(3, '00:30', 'active', '2021-05-25 11:15:12'),
(4, '00:45', 'active', '2021-05-25 11:15:12'),
(5, '01:00', 'active', '2021-05-25 11:15:12'),
(6, '01:15', 'active', '2021-05-25 11:15:12'),
(7, '01:30', 'active', '2021-05-25 11:15:12'),
(8, '01:45', 'active', '2021-05-25 11:15:12'),
(9, '02:00', 'active', '2021-05-25 11:15:12'),
(10, '02:15', 'active', '2021-05-25 11:15:12'),
(11, '02:30', 'active', '2021-05-25 11:15:12'),
(12, '02:45', 'active', '2021-05-25 11:15:12'),
(13, '03:00', 'active', '2021-05-25 11:15:12'),
(14, '03:15', 'active', '2021-05-25 11:15:12'),
(15, '03:30', 'active', '2021-05-25 11:15:12'),
(16, '03:45', 'active', '2021-05-25 11:15:12'),
(17, '04:00', 'active', '2021-05-25 11:15:12'),
(18, '04:15', 'active', '2021-05-25 11:15:12'),
(19, '04:30', 'active', '2021-05-25 11:15:12'),
(20, '04:45', 'active', '2021-05-25 11:15:12'),
(21, '05:00', 'active', '2021-05-25 11:15:12'),
(22, '05:15', 'active', '2021-05-25 11:15:12'),
(23, '05:30', 'active', '2021-05-25 11:15:12'),
(24, '05:45', 'active', '2021-05-25 11:15:12'),
(25, '06:00', 'active', '2021-05-25 11:15:12'),
(26, '06:15', 'active', '2021-05-25 11:15:12'),
(27, '06:30', 'active', '2021-05-25 11:15:12'),
(28, '06:45', 'active', '2021-05-25 11:15:12'),
(29, '07:00', 'active', '2021-05-25 11:15:12'),
(30, '07:15', 'active', '2021-05-25 11:15:12'),
(31, '07:30', 'active', '2021-05-25 11:15:12'),
(32, '07:45', 'active', '2021-05-25 11:15:12'),
(33, '08:00', 'active', '2021-05-25 11:15:12'),
(34, '08:15', 'active', '2021-05-25 11:15:12'),
(35, '08:30', 'active', '2021-05-25 11:15:12'),
(36, '08:45', 'active', '2021-05-25 11:15:12'),
(37, '09:00', 'active', '2021-05-25 11:15:12'),
(38, '09:15', 'active', '2021-05-25 11:15:12'),
(39, '09:30', 'active', '2021-05-25 11:15:12'),
(40, '09:45', 'active', '2021-05-25 11:15:12'),
(41, '10:00', 'active', '2021-05-25 11:15:12'),
(42, '10:15', 'active', '2021-05-25 11:15:12'),
(43, '10:30', 'active', '2021-05-25 11:15:12'),
(44, '10:45', 'active', '2021-05-25 11:15:12'),
(45, '11:00', 'active', '2021-05-25 11:15:12'),
(46, '11:15', 'active', '2021-05-25 11:15:12'),
(47, '11:30', 'active', '2021-05-25 11:15:12'),
(48, '11:45', 'active', '2021-05-25 11:15:12'),
(49, '12:00', 'active', '2021-05-25 11:15:12'),
(50, '12:15', 'active', '2021-05-25 11:15:12'),
(51, '12:30', 'active', '2021-05-25 11:15:12'),
(52, '12:45', 'active', '2021-05-25 11:15:12'),
(53, '13:00', 'active', '2021-05-25 11:15:12'),
(54, '13:15', 'active', '2021-05-25 11:15:12'),
(55, '13:30', 'active', '2021-05-25 11:15:12'),
(56, '13:45', 'active', '2021-05-25 11:15:12'),
(57, '14:00', 'active', '2021-05-25 11:15:12'),
(58, '14:15', 'active', '2021-05-25 11:15:12'),
(59, '14:30', 'active', '2021-05-25 11:15:12'),
(60, '14:45', 'active', '2021-05-25 11:15:12'),
(61, '15:00', 'active', '2021-05-25 11:15:12'),
(62, '15:15', 'active', '2021-05-25 11:15:12'),
(63, '15:30', 'active', '2021-05-25 11:15:12'),
(64, '15:45', 'active', '2021-05-25 11:15:12'),
(65, '16:00', 'active', '2021-05-25 11:15:12'),
(66, '16:15', 'active', '2021-05-25 11:15:12'),
(67, '16:30', 'active', '2021-05-25 11:15:12'),
(68, '16:45', 'active', '2021-05-25 11:15:12'),
(69, '17:00', 'active', '2021-05-25 11:15:12'),
(70, '17:15', 'active', '2021-05-25 11:15:12'),
(71, '17:30', 'active', '2021-05-25 11:15:12'),
(72, '17:45', 'active', '2021-05-25 11:15:12'),
(73, '18:00', 'active', '2021-05-25 11:15:12'),
(74, '18:15', 'active', '2021-05-25 11:15:12'),
(75, '18:30', 'active', '2021-05-25 11:15:12'),
(76, '18:45', 'active', '2021-05-25 11:15:12'),
(77, '19:00', 'active', '2021-05-25 11:15:12'),
(78, '19:15', 'active', '2021-05-25 11:15:12'),
(79, '19:30', 'active', '2021-05-25 11:15:12'),
(80, '19:45', 'active', '2021-05-25 11:15:12'),
(81, '20:00', 'active', '2021-05-25 11:15:12'),
(82, '20:15', 'active', '2021-05-25 11:15:12'),
(83, '20:30', 'active', '2021-05-25 11:15:12'),
(84, '20:45', 'active', '2021-05-25 11:15:12'),
(85, '21:00', 'active', '2021-05-25 11:15:12'),
(86, '21:15', 'active', '2021-05-25 11:15:12'),
(87, '21:30', 'active', '2021-05-25 11:15:12'),
(88, '21:45', 'active', '2021-05-25 11:15:12'),
(89, '22:00', 'active', '2021-05-25 11:15:12'),
(90, '22:15', 'active', '2021-05-25 11:15:12'),
(91, '22:30', 'active', '2021-05-25 11:15:12'),
(92, '22:45', 'active', '2021-05-25 11:15:12'),
(93, '23:00', 'active', '2021-05-25 11:15:12'),
(94, '23:15', 'active', '2021-05-25 11:15:12'),
(95, '23:30', 'active', '2021-05-25 11:15:12'),
(96, '23:45', 'active', '2021-05-25 11:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `tour_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`tour_id`, `reg_id`, `name`, `date`) VALUES
(1, 1, 'till_portfolio', '2023-04-19 01:35:08'),
(2, 1, 'after_portfolio', '2023-04-19 01:35:08'),
(3, 306, 'till_portfolio', '2023-04-19 01:41:57'),
(4, 2, 'till_portfolio', '2023-04-19 01:44:13'),
(5, 2, 'after_portfolio', '2023-04-19 01:44:13'),
(6, 306, 'after_portfolio', '2023-04-19 03:58:20'),
(7, 307, 'till_portfolio', '2023-04-19 05:45:00'),
(8, 307, 'after_portfolio', '2023-04-19 05:45:00'),
(9, 3, 'till_portfolio', '2023-04-19 06:38:18'),
(10, 3, 'after_portfolio', '2023-04-19 06:38:18'),
(11, 15, 'till_portfolio', '2023-04-20 01:02:16'),
(12, 12, 'till_portfolio', '2023-04-20 01:02:44'),
(13, 364, 'till_portfolio', '2023-04-20 01:44:45'),
(14, 364, 'after_portfolio', '2023-04-20 01:44:45'),
(15, 340, 'till_portfolio', '2023-04-23 10:51:38'),
(16, 340, 'after_portfolio', '2023-04-23 10:51:38'),
(17, 18, 'till_portfolio', '2023-04-24 17:33:59'),
(18, 18, 'after_portfolio', '2023-04-24 17:33:59'),
(19, 375, 'till_portfolio', '2023-04-25 01:11:56'),
(20, 9, 'till_portfolio', '2023-04-25 01:29:40'),
(21, 345, 'till_portfolio', '2023-04-25 15:51:10'),
(22, 376, 'till_portfolio', '2023-04-26 03:53:20'),
(23, 376, 'after_portfolio', '2023-04-26 03:53:20'),
(24, 365, 'till_portfolio', '2023-04-26 08:22:55'),
(25, 365, 'after_portfolio', '2023-04-26 08:22:55'),
(26, 5, 'till_portfolio', '2023-05-02 01:33:01'),
(27, 377, 'till_portfolio', '2023-05-17 05:27:20'),
(28, 396, 'till_portfolio', '2023-05-25 02:20:03'),
(29, 395, 'till_portfolio', '2023-05-25 09:35:01'),
(30, 5, 'after_portfolio', '2023-05-29 03:41:55'),
(31, 389, 'till_portfolio', '2023-06-05 04:48:08'),
(32, 389, 'after_portfolio', '2023-06-12 09:21:09'),
(33, 390, 'till_portfolio', '2023-06-13 03:26:19'),
(34, 398, 'till_portfolio', '2023-06-16 08:33:12'),
(35, 398, 'after_portfolio', '2023-06-16 08:49:12'),
(36, 399, 'till_portfolio', '2023-06-19 01:57:46'),
(37, 399, 'after_portfolio', '2023-06-19 03:33:24'),
(38, 400, 'till_portfolio', '2023-07-04 03:37:19'),
(39, 405, 'till_portfolio', '2023-07-10 09:38:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_list`
--
ALTER TABLE `ad_list`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `ad_logo`
--
ALTER TABLE `ad_logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `confidence_level`
--
ALTER TABLE `confidence_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacted_company`
--
ALTER TABLE `contacted_company`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `contacted_company_emp`
--
ALTER TABLE `contacted_company_emp`
  ADD PRIMARY KEY (`cce_id`);

--
-- Indexes for table `contacted_company_roles`
--
ALTER TABLE `contacted_company_roles`
  ADD PRIMARY KEY (`ccr_id`);

--
-- Indexes for table `contact_sales`
--
ALTER TABLE `contact_sales`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `content_planning`
--
ALTER TABLE `content_planning`
  ADD PRIMARY KEY (`pc_id`);

--
-- Indexes for table `content_planning_trash`
--
ALTER TABLE `content_planning_trash`
  ADD PRIMARY KEY (`pc_trash_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_activities`
--
ALTER TABLE `daily_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draggable_events`
--
ALTER TABLE `draggable_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duration`
--
ALTER TABLE `duration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events_call_booking`
--
ALTER TABLE `events_call_booking`
  ADD PRIMARY KEY (`ecid`);

--
-- Indexes for table `events_meeting`
--
ALTER TABLE `events_meeting`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `events_meeting_invited_members`
--
ALTER TABLE `events_meeting_invited_members`
  ADD PRIMARY KEY (`imid`);

--
-- Indexes for table `events_todo`
--
ALTER TABLE `events_todo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expert_call_booking`
--
ALTER TABLE `expert_call_booking`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `expert_call_minute`
--
ALTER TABLE `expert_call_minute`
  ADD PRIMARY KEY (`cm_id`);

--
-- Indexes for table `expert_call_rate`
--
ALTER TABLE `expert_call_rate`
  ADD PRIMARY KEY (`cr_id`);

--
-- Indexes for table `expert_phone_numbers`
--
ALTER TABLE `expert_phone_numbers`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `file_preview_access`
--
ALTER TABLE `file_preview_access`
  ADD PRIMARY KEY (`fpid`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `goals_invited_members`
--
ALTER TABLE `goals_invited_members`
  ADD PRIMARY KEY (`igm_id`);

--
-- Indexes for table `goals_members`
--
ALTER TABLE `goals_members`
  ADD PRIMARY KEY (`gmid`);

--
-- Indexes for table `goals_suggested_members`
--
ALTER TABLE `goals_suggested_members`
  ADD PRIMARY KEY (`gs_id`);

--
-- Indexes for table `group_chat`
--
ALTER TABLE `group_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `group_create`
--
ALTER TABLE `group_create`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_msg`
--
ALTER TABLE `group_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_request`
--
ALTER TABLE `group_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hear_from`
--
ALTER TABLE `hear_from`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invited_supporter`
--
ALTER TABLE `invited_supporter`
  ADD PRIMARY KEY (`invite_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motivator`
--
ALTER TABLE `motivator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ost_api_key`
--
ALTER TABLE `ost_api_key`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apikey` (`apikey`),
  ADD KEY `ipaddr` (`ipaddr`);

--
-- Indexes for table `ost_attachment`
--
ALTER TABLE `ost_attachment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `file-type` (`object_id`,`file_id`,`type`),
  ADD UNIQUE KEY `file_object` (`file_id`,`object_id`);

--
-- Indexes for table `ost_canned_response`
--
ALTER TABLE `ost_canned_response`
  ADD PRIMARY KEY (`canned_id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `active` (`isenabled`);

--
-- Indexes for table `ost_config`
--
ALTER TABLE `ost_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `namespace` (`namespace`,`key`);

--
-- Indexes for table `ost_content`
--
ALTER TABLE `ost_content`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ost_department`
--
ALTER TABLE `ost_department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`pid`),
  ADD KEY `manager_id` (`manager_id`),
  ADD KEY `autoresp_email_id` (`autoresp_email_id`),
  ADD KEY `tpl_id` (`tpl_id`),
  ADD KEY `flags` (`flags`);

--
-- Indexes for table `ost_draft`
--
ALTER TABLE `ost_draft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `namespace` (`namespace`);

--
-- Indexes for table `ost_email`
--
ALTER TABLE `ost_email`
  ADD PRIMARY KEY (`email_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `priority_id` (`priority_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `ost_email_account`
--
ALTER TABLE `ost_email_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ost_email_template`
--
ALTER TABLE `ost_email_template`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `template_lookup` (`tpl_id`,`code_name`);

--
-- Indexes for table `ost_email_template_group`
--
ALTER TABLE `ost_email_template_group`
  ADD PRIMARY KEY (`tpl_id`);

--
-- Indexes for table `ost_event`
--
ALTER TABLE `ost_event`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ost_faq`
--
ALTER TABLE `ost_faq`
  ADD PRIMARY KEY (`faq_id`),
  ADD UNIQUE KEY `question` (`question`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `ispublished` (`ispublished`);

--
-- Indexes for table `ost_faq_category`
--
ALTER TABLE `ost_faq_category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `ispublic` (`ispublic`);

--
-- Indexes for table `ost_faq_topic`
--
ALTER TABLE `ost_faq_topic`
  ADD PRIMARY KEY (`faq_id`,`topic_id`);

--
-- Indexes for table `ost_file`
--
ALTER TABLE `ost_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ft` (`ft`),
  ADD KEY `key` (`key`),
  ADD KEY `signature` (`signature`),
  ADD KEY `type` (`type`),
  ADD KEY `created` (`created`),
  ADD KEY `size` (`size`);

--
-- Indexes for table `ost_file_chunk`
--
ALTER TABLE `ost_file_chunk`
  ADD PRIMARY KEY (`file_id`,`chunk_id`);

--
-- Indexes for table `ost_filter`
--
ALTER TABLE `ost_filter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `target` (`target`),
  ADD KEY `email_id` (`email_id`);

--
-- Indexes for table `ost_filter_action`
--
ALTER TABLE `ost_filter_action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filter_id` (`filter_id`);

--
-- Indexes for table `ost_filter_rule`
--
ALTER TABLE `ost_filter_rule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `filter` (`filter_id`,`what`,`how`,`val`),
  ADD KEY `filter_id` (`filter_id`);

--
-- Indexes for table `ost_form`
--
ALTER TABLE `ost_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `ost_form_entry`
--
ALTER TABLE `ost_form_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entry_lookup` (`object_type`,`object_id`);

--
-- Indexes for table `ost_form_entry_values`
--
ALTER TABLE `ost_form_entry_values`
  ADD PRIMARY KEY (`entry_id`,`field_id`);

--
-- Indexes for table `ost_form_field`
--
ALTER TABLE `ost_form_field`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_id` (`form_id`),
  ADD KEY `sort` (`sort`);

--
-- Indexes for table `ost_group`
--
ALTER TABLE `ost_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `ost_help_topic`
--
ALTER TABLE `ost_help_topic`
  ADD PRIMARY KEY (`topic_id`),
  ADD UNIQUE KEY `topic` (`topic`,`topic_pid`),
  ADD KEY `topic_pid` (`topic_pid`),
  ADD KEY `priority_id` (`priority_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `staff_id` (`staff_id`,`team_id`),
  ADD KEY `sla_id` (`sla_id`),
  ADD KEY `page_id` (`page_id`);

--
-- Indexes for table `ost_help_topic_form`
--
ALTER TABLE `ost_help_topic_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic-form` (`topic_id`,`form_id`);

--
-- Indexes for table `ost_list`
--
ALTER TABLE `ost_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `ost_list_items`
--
ALTER TABLE `ost_list_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_item_lookup` (`list_id`);

--
-- Indexes for table `ost_lock`
--
ALTER TABLE `ost_lock`
  ADD PRIMARY KEY (`lock_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `ost_note`
--
ALTER TABLE `ost_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ext_id` (`ext_id`);

--
-- Indexes for table `ost_organization`
--
ALTER TABLE `ost_organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ost_organization__cdata`
--
ALTER TABLE `ost_organization__cdata`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `ost_plugin`
--
ALTER TABLE `ost_plugin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ost_queue`
--
ALTER TABLE `ost_queue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `ost_queue_column`
--
ALTER TABLE `ost_queue_column`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ost_queue_columns`
--
ALTER TABLE `ost_queue_columns`
  ADD PRIMARY KEY (`queue_id`,`column_id`,`staff_id`);

--
-- Indexes for table `ost_queue_config`
--
ALTER TABLE `ost_queue_config`
  ADD PRIMARY KEY (`queue_id`,`staff_id`);

--
-- Indexes for table `ost_queue_export`
--
ALTER TABLE `ost_queue_export`
  ADD PRIMARY KEY (`id`),
  ADD KEY `queue_id` (`queue_id`);

--
-- Indexes for table `ost_queue_sort`
--
ALTER TABLE `ost_queue_sort`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ost_queue_sorts`
--
ALTER TABLE `ost_queue_sorts`
  ADD PRIMARY KEY (`queue_id`,`sort_id`);

--
-- Indexes for table `ost_role`
--
ALTER TABLE `ost_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ost_schedule`
--
ALTER TABLE `ost_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ost_schedule_entry`
--
ALTER TABLE `ost_schedule_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `repeats` (`repeats`);

--
-- Indexes for table `ost_sequence`
--
ALTER TABLE `ost_sequence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ost_session`
--
ALTER TABLE `ost_session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `updated` (`session_updated`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ost_sla`
--
ALTER TABLE `ost_sla`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ost_staff`
--
ALTER TABLE `ost_staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `issuperuser` (`isadmin`),
  ADD KEY `isactive` (`isactive`),
  ADD KEY `onvacation` (`onvacation`);

--
-- Indexes for table `ost_staff_dept_access`
--
ALTER TABLE `ost_staff_dept_access`
  ADD PRIMARY KEY (`staff_id`,`dept_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `ost_syslog`
--
ALTER TABLE `ost_syslog`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `log_type` (`log_type`);

--
-- Indexes for table `ost_task`
--
ALTER TABLE `ost_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `created` (`created`),
  ADD KEY `object` (`object_id`,`object_type`),
  ADD KEY `flags` (`flags`);

--
-- Indexes for table `ost_task__cdata`
--
ALTER TABLE `ost_task__cdata`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `ost_team`
--
ALTER TABLE `ost_team`
  ADD PRIMARY KEY (`team_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `lead_id` (`lead_id`);

--
-- Indexes for table `ost_team_member`
--
ALTER TABLE `ost_team_member`
  ADD PRIMARY KEY (`team_id`,`staff_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `ost_thread`
--
ALTER TABLE `ost_thread`
  ADD PRIMARY KEY (`id`),
  ADD KEY `object_id` (`object_id`),
  ADD KEY `object_type` (`object_type`);

--
-- Indexes for table `ost_thread_collaborator`
--
ALTER TABLE `ost_thread_collaborator`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `collab` (`thread_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ost_thread_entry`
--
ALTER TABLE `ost_thread_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `ost_thread_entry_email`
--
ALTER TABLE `ost_thread_entry_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_entry_id` (`thread_entry_id`),
  ADD KEY `mid` (`mid`),
  ADD KEY `email_id` (`email_id`);

--
-- Indexes for table `ost_thread_entry_merge`
--
ALTER TABLE `ost_thread_entry_merge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_entry_id` (`thread_entry_id`);

--
-- Indexes for table `ost_thread_event`
--
ALTER TABLE `ost_thread_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_state` (`thread_id`,`event_id`,`timestamp`),
  ADD KEY `ticket_stats` (`timestamp`,`event_id`);

--
-- Indexes for table `ost_thread_referral`
--
ALTER TABLE `ost_thread_referral`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ref` (`object_id`,`object_type`,`thread_id`),
  ADD KEY `thread_id` (`thread_id`);

--
-- Indexes for table `ost_ticket`
--
ALTER TABLE `ost_ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `created` (`created`),
  ADD KEY `closed` (`closed`),
  ADD KEY `duedate` (`duedate`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `sla_id` (`sla_id`),
  ADD KEY `ticket_pid` (`ticket_pid`);

--
-- Indexes for table `ost_ticket_priority`
--
ALTER TABLE `ost_ticket_priority`
  ADD PRIMARY KEY (`priority_id`),
  ADD UNIQUE KEY `priority` (`priority`),
  ADD KEY `priority_urgency` (`priority_urgency`),
  ADD KEY `ispublic` (`ispublic`);

--
-- Indexes for table `ost_ticket_status`
--
ALTER TABLE `ost_ticket_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `state` (`state`);

--
-- Indexes for table `ost_ticket__cdata`
--
ALTER TABLE `ost_ticket__cdata`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `ost_translation`
--
ALTER TABLE `ost_translation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`,`lang`),
  ADD KEY `object_hash` (`object_hash`);

--
-- Indexes for table `ost_user`
--
ALTER TABLE `ost_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `default_email_id` (`default_email_id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `ost_user_account`
--
ALTER TABLE `ost_user_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ost_user_email`
--
ALTER TABLE `ost_user_email`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `address` (`address`),
  ADD KEY `user_email_lookup` (`user_id`);

--
-- Indexes for table `ost_user__cdata`
--
ALTER TABLE `ost_user__cdata`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ost__search`
--
ALTER TABLE `ost__search`
  ADD PRIMARY KEY (`object_type`,`object_id`);
ALTER TABLE `ost__search` ADD FULLTEXT KEY `search` (`title`,`content`);

--
-- Indexes for table `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`pack_id`);

--
-- Indexes for table `pricing_labels`
--
ALTER TABLE `pricing_labels`
  ADD PRIMARY KEY (`plabel`);

--
-- Indexes for table `pricing_pack_coupon`
--
ALTER TABLE `pricing_pack_coupon`
  ADD PRIMARY KEY (`co_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `project_files`
--
ALTER TABLE `project_files`
  ADD PRIMARY KEY (`pfile_id`);

--
-- Indexes for table `project_history`
--
ALTER TABLE `project_history`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `project_invited_members`
--
ALTER TABLE `project_invited_members`
  ADD PRIMARY KEY (`im_id`);

--
-- Indexes for table `project_management`
--
ALTER TABLE `project_management`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `project_management_fields`
--
ALTER TABLE `project_management_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`pm_id`);

--
-- Indexes for table `project_portfolio`
--
ALTER TABLE `project_portfolio`
  ADD PRIMARY KEY (`portfolio_id`);

--
-- Indexes for table `project_portfolio_department`
--
ALTER TABLE `project_portfolio_department`
  ADD PRIMARY KEY (`portfolio_dept_id`);

--
-- Indexes for table `project_portfolio_member`
--
ALTER TABLE `project_portfolio_member`
  ADD PRIMARY KEY (`pim_id`);

--
-- Indexes for table `project_request_member`
--
ALTER TABLE `project_request_member`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `project_suggested_members`
--
ALTER TABLE `project_suggested_members`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `registration_deleted`
--
ALTER TABLE `registration_deleted`
  ADD PRIMARY KEY (`reg_did`);

--
-- Indexes for table `report_template`
--
ALTER TABLE `report_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_usertemplate`
--
ALTER TABLE `report_usertemplate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_names`
--
ALTER TABLE `school_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strategies`
--
ALTER TABLE `strategies`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_module`
--
ALTER TABLE `student_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subtask`
--
ALTER TABLE `subtask`
  ADD PRIMARY KEY (`stid`);

--
-- Indexes for table `subtask_trash`
--
ALTER TABLE `subtask_trash`
  ADD PRIMARY KEY (`strash_id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`sa_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `task_trash`
--
ALTER TABLE `task_trash`
  ADD PRIMARY KEY (`trash_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `ticket_chat`
--
ALTER TABLE `ticket_chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `ticket_history`
--
ALTER TABLE `ticket_history`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `time_12hours`
--
ALTER TABLE `time_12hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_24hours`
--
ALTER TABLE `time_24hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`tour_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_list`
--
ALTER TABLE `ad_list`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ad_logo`
--
ALTER TABLE `ad_logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `confidence_level`
--
ALTER TABLE `confidence_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacted_company`
--
ALTER TABLE `contacted_company`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacted_company_emp`
--
ALTER TABLE `contacted_company_emp`
  MODIFY `cce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacted_company_roles`
--
ALTER TABLE `contacted_company_roles`
  MODIFY `ccr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_sales`
--
ALTER TABLE `contact_sales`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `content_planning`
--
ALTER TABLE `content_planning`
  MODIFY `pc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `content_planning_trash`
--
ALTER TABLE `content_planning_trash`
  MODIFY `pc_trash_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `daily_activities`
--
ALTER TABLE `daily_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `draggable_events`
--
ALTER TABLE `draggable_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `duration`
--
ALTER TABLE `duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events_call_booking`
--
ALTER TABLE `events_call_booking`
  MODIFY `ecid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events_meeting`
--
ALTER TABLE `events_meeting`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events_meeting_invited_members`
--
ALTER TABLE `events_meeting_invited_members`
  MODIFY `imid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events_todo`
--
ALTER TABLE `events_todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expert_call_booking`
--
ALTER TABLE `expert_call_booking`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expert_call_minute`
--
ALTER TABLE `expert_call_minute`
  MODIFY `cm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expert_call_rate`
--
ALTER TABLE `expert_call_rate`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expert_phone_numbers`
--
ALTER TABLE `expert_phone_numbers`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `file_preview_access`
--
ALTER TABLE `file_preview_access`
  MODIFY `fpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `goals_invited_members`
--
ALTER TABLE `goals_invited_members`
  MODIFY `igm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goals_members`
--
ALTER TABLE `goals_members`
  MODIFY `gmid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `goals_suggested_members`
--
ALTER TABLE `goals_suggested_members`
  MODIFY `gs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_chat`
--
ALTER TABLE `group_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_create`
--
ALTER TABLE `group_create`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_msg`
--
ALTER TABLE `group_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_request`
--
ALTER TABLE `group_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hear_from`
--
ALTER TABLE `hear_from`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invited_supporter`
--
ALTER TABLE `invited_supporter`
  MODIFY `invite_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `motivator`
--
ALTER TABLE `motivator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `ost_api_key`
--
ALTER TABLE `ost_api_key`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_attachment`
--
ALTER TABLE `ost_attachment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ost_canned_response`
--
ALTER TABLE `ost_canned_response`
  MODIFY `canned_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ost_config`
--
ALTER TABLE `ost_config`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `ost_content`
--
ALTER TABLE `ost_content`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ost_department`
--
ALTER TABLE `ost_department`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ost_draft`
--
ALTER TABLE `ost_draft`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_email`
--
ALTER TABLE `ost_email`
  MODIFY `email_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ost_email_account`
--
ALTER TABLE `ost_email_account`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_email_template`
--
ALTER TABLE `ost_email_template`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ost_email_template_group`
--
ALTER TABLE `ost_email_template_group`
  MODIFY `tpl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ost_event`
--
ALTER TABLE `ost_event`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ost_faq`
--
ALTER TABLE `ost_faq`
  MODIFY `faq_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_faq_category`
--
ALTER TABLE `ost_faq_category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_file`
--
ALTER TABLE `ost_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ost_filter`
--
ALTER TABLE `ost_filter`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ost_filter_action`
--
ALTER TABLE `ost_filter_action`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_filter_rule`
--
ALTER TABLE `ost_filter_rule`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_form`
--
ALTER TABLE `ost_form`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ost_form_entry`
--
ALTER TABLE `ost_form_entry`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ost_form_field`
--
ALTER TABLE `ost_form_field`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ost_group`
--
ALTER TABLE `ost_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_help_topic`
--
ALTER TABLE `ost_help_topic`
  MODIFY `topic_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ost_help_topic_form`
--
ALTER TABLE `ost_help_topic_form`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ost_list`
--
ALTER TABLE `ost_list`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ost_list_items`
--
ALTER TABLE `ost_list_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_lock`
--
ALTER TABLE `ost_lock`
  MODIFY `lock_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_note`
--
ALTER TABLE `ost_note`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_organization`
--
ALTER TABLE `ost_organization`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ost_plugin`
--
ALTER TABLE `ost_plugin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_queue`
--
ALTER TABLE `ost_queue`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ost_queue_column`
--
ALTER TABLE `ost_queue_column`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ost_queue_export`
--
ALTER TABLE `ost_queue_export`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_queue_sort`
--
ALTER TABLE `ost_queue_sort`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ost_role`
--
ALTER TABLE `ost_role`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ost_schedule`
--
ALTER TABLE `ost_schedule`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ost_schedule_entry`
--
ALTER TABLE `ost_schedule_entry`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ost_sequence`
--
ALTER TABLE `ost_sequence`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ost_sla`
--
ALTER TABLE `ost_sla`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ost_staff`
--
ALTER TABLE `ost_staff`
  MODIFY `staff_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ost_syslog`
--
ALTER TABLE `ost_syslog`
  MODIFY `log_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ost_task`
--
ALTER TABLE `ost_task`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_team`
--
ALTER TABLE `ost_team`
  MODIFY `team_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ost_thread`
--
ALTER TABLE `ost_thread`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ost_thread_collaborator`
--
ALTER TABLE `ost_thread_collaborator`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_thread_entry`
--
ALTER TABLE `ost_thread_entry`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ost_thread_entry_email`
--
ALTER TABLE `ost_thread_entry_email`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_thread_entry_merge`
--
ALTER TABLE `ost_thread_entry_merge`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_thread_event`
--
ALTER TABLE `ost_thread_event`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ost_thread_referral`
--
ALTER TABLE `ost_thread_referral`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ost_ticket`
--
ALTER TABLE `ost_ticket`
  MODIFY `ticket_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ost_ticket_priority`
--
ALTER TABLE `ost_ticket_priority`
  MODIFY `priority_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ost_ticket_status`
--
ALTER TABLE `ost_ticket_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ost_translation`
--
ALTER TABLE `ost_translation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ost_user`
--
ALTER TABLE `ost_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ost_user_account`
--
ALTER TABLE `ost_user_account`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ost_user_email`
--
ALTER TABLE `ost_user_email`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pricing`
--
ALTER TABLE `pricing`
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pricing_labels`
--
ALTER TABLE `pricing_labels`
  MODIFY `plabel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pricing_pack_coupon`
--
ALTER TABLE `pricing_pack_coupon`
  MODIFY `co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `project_files`
--
ALTER TABLE `project_files`
  MODIFY `pfile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_history`
--
ALTER TABLE `project_history`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `project_invited_members`
--
ALTER TABLE `project_invited_members`
  MODIFY `im_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_management`
--
ALTER TABLE `project_management`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `project_management_fields`
--
ALTER TABLE `project_management_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_members`
--
ALTER TABLE `project_members`
  MODIFY `pm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `project_portfolio`
--
ALTER TABLE `project_portfolio`
  MODIFY `portfolio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_portfolio_department`
--
ALTER TABLE `project_portfolio_department`
  MODIFY `portfolio_dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project_portfolio_member`
--
ALTER TABLE `project_portfolio_member`
  MODIFY `pim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_request_member`
--
ALTER TABLE `project_request_member`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_suggested_members`
--
ALTER TABLE `project_suggested_members`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=406;

--
-- AUTO_INCREMENT for table `registration_deleted`
--
ALTER TABLE `registration_deleted`
  MODIFY `reg_did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `report_template`
--
ALTER TABLE `report_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_usertemplate`
--
ALTER TABLE `report_usertemplate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school_names`
--
ALTER TABLE `school_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `strategies`
--
ALTER TABLE `strategies`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_course`
--
ALTER TABLE `student_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_module`
--
ALTER TABLE `student_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subtask`
--
ALTER TABLE `subtask`
  MODIFY `stid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subtask_trash`
--
ALTER TABLE `subtask_trash`
  MODIFY `strash_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `sa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `task_trash`
--
ALTER TABLE `task_trash`
  MODIFY `trash_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ticket_chat`
--
ALTER TABLE `ticket_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ticket_history`
--
ALTER TABLE `ticket_history`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `time_12hours`
--
ALTER TABLE `time_12hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `time_24hours`
--
ALTER TABLE `time_24hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `tour`
--
ALTER TABLE `tour`
  MODIFY `tour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
