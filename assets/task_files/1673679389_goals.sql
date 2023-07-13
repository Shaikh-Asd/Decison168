-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2022 at 09:30 AM
-- Server version: 5.7.39-42-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbdakt3syq6bnj`
--

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
  `gcreated_by` int(11) NOT NULL,
  `gcreated_date` date NOT NULL,
  `g_trash` varchar(30) NOT NULL,
  `g_trash_date` text NOT NULL,
  `gsingle_trash` varchar(50) NOT NULL,
  `g_archive` varchar(50) NOT NULL,
  `g_archive_date` text NOT NULL,
  `reg_acc_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`gid`, `portfolio_id`, `gname`, `gdes`, `gdept`, `gstart_date`, `gend_date`, `gcreated_by`, `gcreated_date`, `g_trash`, `g_trash_date`, `gsingle_trash`, `g_archive`, `g_archive_date`, `reg_acc_status`) VALUES
(1, 2, 'Development', 'Dev goal', 4, '2022-12-01', '2023-01-31', 1, '2022-11-29', '', '', '', '', '', ''),
(2, 7, 'Website Dev.', '12 pages site', 5, '2022-12-01', '2023-03-31', 2, '2022-11-29', '', '', '', '', '', ''),
(3, 12, 'YouTube Monetization', 'Youtube content creation and engagement to monetization.', 6, '2022-12-01', '2023-02-28', 3, '2022-11-29', '', '', '', '', '', ''),
(4, 2, 'Development new', 'Dev goal', 4, '2022-12-15', '2023-02-02', 1, '2022-12-09', 'yes', '2023-01-10', 'yes', '', '', ''),
(5, 2, 'Development latest', 'Dev goal', 4, '2022-12-01', '2023-01-31', 1, '2022-12-09', 'yes', '2023-01-10', 'yes', '', '', ''),
(6, 2, 'Development final', 'Dev goal', 4, '2022-12-01', '2023-01-31', 1, '2022-12-09', 'yes', '2023-01-10', 'yes', '', '', ''),
(7, 2, 'Development staging', 'Dev goal', 4, '2022-12-01', '2023-01-31', 1, '2022-12-09', 'yes', '2023-01-10', 'yes', '', '', ''),
(8, 2, 'Development prod', 'Dev goal', 4, '2022-12-01', '2023-01-31', 1, '2022-12-09', 'yes', '2023-01-10', 'yes', '', '', ''),
(9, 2, 'Goal 10-12', '', 3, '2022-12-14', '2022-12-29', 1, '2022-12-10', '', '', '', '', '', ''),
(11, 12, 'WISH_ND: Core Implementation', 'Wishek Hospital Core Implementation', 9, '2022-12-12', '2023-01-23', 3, '2022-12-12', '', '', '', '', '', ''),
(12, 12, 'Monetize Youtube Channel', 'Implement strategies and content to achieve monetization of the Decision 168 Youtube channel.', 6, '2022-12-13', '2023-03-31', 3, '2022-12-13', '', '', '', '', '', ''),
(13, 2, 'GTest 16', 'testing of goals and its functionality', 3, '2022-12-20', '2022-12-30', 1, '2022-12-15', '', '', '', '', '', ''),
(14, 2, 'ABC Goal', '', 1, '2022-12-18', '2022-12-24', 1, '2022-12-16', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`gid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
