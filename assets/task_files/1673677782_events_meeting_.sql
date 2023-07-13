-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2023 at 08:03 AM
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
  `m_in_app_reminder` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events_meeting`
--

INSERT INTO `events_meeting` (`mid`, `event_id`, `event_unique_key`, `member`, `created_by`, `created_type`, `status`, `status_date`, `m_date`, `m_event_reminder_send`, `m_in_app_reminder`) VALUES
(1, 326, '63b7d531a8f0e', 1, 5, 'meeting', 'accepted', '2023-01-06 03:01:28', '2023-01-06 03:00:49', '', 'shown'),
(2, 323, '63b7d7b1df28a', 1, 5, 'meeting', 'accepted', '2023-01-06 03:11:41', '2023-01-06 03:11:29', 'sent', 'shown');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events_meeting`
--
ALTER TABLE `events_meeting`
  ADD PRIMARY KEY (`mid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events_meeting`
--
ALTER TABLE `events_meeting`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
