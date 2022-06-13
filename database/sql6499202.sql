-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: sql6.freemysqlhosting.net:3306
-- Generation Time: Jun 13, 2022 at 08:29 PM
-- Server version: 5.5.62-0ubuntu0.14.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql6499202`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(15) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `passwordA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `passwordA`) VALUES
('Admin', 'Mihir', '0192023a7bbd73250516f069df18b500'),
('Wizards', 'Mihir_Client4', 'd3c3662ffb978a7c0094ed643be12b8e');

-- --------------------------------------------------------

--
-- Table structure for table `lecture_entry`
--

CREATE TABLE `lecture_entry` (
  `lec_id` int(11) NOT NULL,
  `tutor_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `sdate` date NOT NULL,
  `stime` time NOT NULL,
  `etime` time NOT NULL DEFAULT '07:27:00',
  `duration` float NOT NULL,
  `conducted` tinyint(1) NOT NULL DEFAULT '0',
  `payment` tinyint(4) NOT NULL DEFAULT '0',
  `submitted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecture_entry`
--

INSERT INTO `lecture_entry` (`lec_id`, `tutor_id`, `stu_id`, `subject`, `sdate`, `stime`, `etime`, `duration`, `conducted`, `payment`, `submitted`) VALUES
(1, 2, 2, 'Welding', '2022-06-29', '20:21:00', '21:21:00', 1, 0, 0, 0),
(2, 4, 1, 'Dancing', '2022-06-12', '16:28:00', '18:28:00', 2, 0, 0, 0),
(3, 3, 1, 'Singing', '2022-06-20', '15:34:00', '18:34:00', 3, 0, 0, 0),
(4, 5, 6, 'NET', '2022-06-13', '17:36:00', '21:36:00', 4, 1, 0, 0),
(5, 5, 6, 'NET', '2022-06-13', '17:19:00', '18:19:00', 1, 1, 0, 0),
(6, 5, 2, 'Maths', '2022-06-25', '16:25:00', '17:25:00', 1, 0, 0, 0),
(7, 5, 1, 'PT', '2022-06-15', '21:44:00', '22:44:00', 1, 0, 0, 0),
(8, 5, 6, 'Maths', '2022-06-25', '04:42:00', '05:42:00', 1, 1, 0, 0),
(9, 5, 6, 'No', '2022-07-04', '16:51:00', '19:51:00', 3, 1, 0, 0),
(10, 5, 5, 'MONGO DB', '2022-06-30', '20:52:00', '22:52:00', 2, 0, 0, 0),
(11, 5, 2, 'ds', '2022-06-25', '16:54:00', '17:54:00', 1, 0, 0, 0),
(12, 5, 2, 'Mth', '2022-06-28', '17:06:00', '18:06:00', 1, 0, 0, 0),
(13, 5, 3, 'asd', '2022-06-30', '05:17:00', '05:47:00', 1, 0, 0, 0),
(14, 5, 2, 'MM', '2022-06-13', '06:19:00', '07:49:00', 2, 0, 0, 0),
(15, 5, 3, 'sdlkfn', '2022-06-29', '18:59:00', '19:59:00', 1, 0, 0, 0),
(16, 5, 2, 'Maths', '2022-06-23', '15:15:00', '16:15:00', 1, 0, 0, 0),
(17, 5, 2, 'MATHS', '2022-06-18', '23:22:00', '04:22:00', 5, 0, 0, 0),
(18, 5, 2, 'kaad', '2022-06-12', '00:22:00', '01:22:00', 1, 1, 0, 0),
(19, 1, 1, 'Maa', '2022-06-06', '22:36:00', '23:06:00', 1, 0, 0, 0),
(20, 5, 1, 'MM', '2022-06-08', '16:40:00', '16:40:00', 0, 0, 0, 0),
(21, 5, 1, 'Cocking', '2022-06-13', '18:49:00', '18:49:00', 0, 1, 0, 0),
(22, 2, 2, 'Weld', '2022-06-13', '07:24:00', '07:54:00', 1, 0, 0, 0),
(23, 4, 1, 'KH', '2022-06-13', '01:48:00', '02:18:00', 1, 0, 0, 0),
(24, 5, 1, 'NET', '2022-06-21', '19:49:00', '21:49:00', 2, 0, 0, 0),
(25, 5, 6, 'Database', '2022-06-14', '11:33:00', '13:33:00', 2, 1, 0, 0),
(26, 6, 7, 'Security', '2022-06-14', '11:34:00', '13:04:00', 2, 1, 0, 0),
(27, 5, 6, 'NETWORKING', '2022-06-14', '11:51:00', '13:21:00', 2, 1, 0, 0),
(28, 5, 6, 'MATHS', '2022-06-14', '23:53:00', '01:23:00', 2, 1, 0, 0),
(29, 5, 6, 'Nice', '2022-06-15', '13:06:00', '15:36:00', 2.5, 1, 0, 0),
(30, 5, 6, 'NET', '2022-06-13', '12:50:00', '13:20:00', 0.5, 0, 0, 0),
(31, 5, 6, 'Fifa', '2022-06-14', '01:00:00', '01:30:00', 0.5, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(11) NOT NULL,
  `stu_name` varchar(50) NOT NULL,
  `stu_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `stu_name`, `stu_email`) VALUES
(2, 'abx', 'a@gmail.com'),
(3, 'Warner', 'war@gmail.com'),
(4, 'Gayle', 'gayle@gmail.com'),
(5, 'Morris', 'morris@gmail.com'),
(6, 'John', 'mihir.hemnani99@gmail.com'),
(7, 'Mihir', 'gandhimihir0909@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `tutor_id` int(11) NOT NULL,
  `tutor_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `passwordT` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`tutor_id`, `tutor_name`, `email`, `contact_no`, `subject`, `passwordT`) VALUES
(1, 'Sachin', 'sachin@gmail.com', '8795462130', 'PT', '6slvurdj'),
(3, 'Yoyo', 'honey@gmail.com', '5468792130', 'singing', 'Sta$i@HF'),
(4, 'Michal', 'jakson@gmail.com', '7539518604', 'Dancing', 'qirvg4Of'),
(5, 'Mihir', 'hemnani.mihir93@gmail.com', '3216549870', 'Net', '%hqo&a#T'),
(6, 'RRR', 'mihir.hemnani99@gmail.com', '7894561232', 'Security', '2xP!4Fvo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `lecture_entry`
--
ALTER TABLE `lecture_entry`
  ADD PRIMARY KEY (`lec_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`tutor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecture_entry`
--
ALTER TABLE `lecture_entry`
  MODIFY `lec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
