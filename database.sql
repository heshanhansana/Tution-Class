-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 11:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `class_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(4) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `cid` int(4) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `tid` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`cid`, `cname`, `day`, `starttime`, `endtime`, `tid`) VALUES
(9, 'ET-Theory-2024', 'Saturday', '08:30:00', '10:30:00', 10),
(11, 'ET-Practical-2024', 'Sunday', '08:30:00', '15:30:00', 10),
(12, 'ICT-Theory-2024', 'Friday', '08:30:00', '00:30:00', 8),
(15, 'SFT-Revision-2024', 'Tuesday', '08:30:00', '12:30:00', 9);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stid` int(4) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `stname` varchar(255) NOT NULL,
  `stnic` decimal(15,0) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stid`, `batch`, `stname`, `stnic`, `address`, `phone`) VALUES
(55, '2024', 'Adeesha Lenmini', 200332045789, '229, Veyangoda road, Minuwangoda', 721234567),
(56, '2024', 'Oshadi Gayathri', 200334568798, '12A, Veyangoda road, Yakahatuwa', 732145698),
(57, '2024', 'Kawshali Lakmal', 200332045698, '33, Miriswatta road, Gampaha', 781234569),
(58, '2024', 'Umega Amajith', 200332014578, '78A, Yakahatuwa, Minuwangoda', 781236547),
(59, '2024', 'Anuja Lakshitha', 200332085964, '76, Kandy road, Kadawatha', 761234569);

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `aid` int(4) NOT NULL,
  `stid` int(4) DEFAULT NULL,
  `cid` int(4) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`aid`, `stid`, `cid`, `date`) VALUES
(48, 58, 12, '2024-04-02'),
(49, 58, 12, '2024-04-02'),
(50, 55, 12, '2024-04-02'),
(51, 55, 12, '2024-04-02'),
(52, 55, 9, '2024-04-02'),
(53, 55, 9, '2024-04-02'),
(54, 55, 9, '2024-04-02'),
(55, 55, 9, '2024-04-02'),
(56, 55, 9, '2024-04-02'),
(57, 55, 9, '2024-04-02'),
(58, 55, 9, '2024-04-02'),
(59, 55, 9, '2024-04-02'),
(60, 55, 9, '2024-04-02'),
(61, 55, 9, '2024-04-02'),
(62, 55, 9, '2024-04-02'),
(63, 55, 9, '2024-04-02'),
(64, 55, 9, '2024-04-02'),
(65, 55, 15, '2024-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `student_class`
--

CREATE TABLE `student_class` (
  `stid` int(4) NOT NULL,
  `cid` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_class`
--

INSERT INTO `student_class` (`stid`, `cid`) VALUES
(55, 9),
(55, 12),
(55, 14),
(55, 15),
(56, 9),
(58, 12);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `tid` int(4) NOT NULL,
  `tnic` decimal(12,0) NOT NULL,
  `tname` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`tid`, `tnic`, `tname`, `subject`, `phone`) VALUES
(8, 200332012782, 'Heshan Hansana', 'ICT', 72832234),
(9, 200332012781, 'Kasun Chamara', 'SFT', 712345678),
(10, 200332012458, 'Presad Chathuranga', 'ET', 722345678),
(11, 200332145789, 'Mattheesha Basuru', 'Biology', 761234569);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `tid` (`tid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stid`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `stid` (`stid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `student_class`
--
ALTER TABLE `student_class`
  ADD PRIMARY KEY (`stid`,`cid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `cid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `aid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `tid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `teacher` (`tid`);

--
-- Constraints for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD CONSTRAINT `student_attendance_ibfk_1` FOREIGN KEY (`stid`) REFERENCES `student` (`StId`),
  ADD CONSTRAINT `student_attendance_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `class` (`cid`);

--
-- Constraints for table `student_class`
--
ALTER TABLE `student_class`
  ADD CONSTRAINT `student_class_ibfk_1` FOREIGN KEY (`stid`) REFERENCES `student` (`StId`),
  ADD CONSTRAINT `student_class_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `class` (`cid`),
  ADD CONSTRAINT `student_class_ibfk_3` FOREIGN KEY (`stid`) REFERENCES `student` (`StId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
