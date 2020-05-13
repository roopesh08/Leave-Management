-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2020 at 09:46 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lev`
--

-- --------------------------------------------------------

--
-- Table structure for table `campususers`
--

CREATE TABLE `campususers` (
  `user_id` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(35) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `campususers`
--

INSERT INTO `campususers` (`user_id`, `username`, `email`, `password`, `role`) VALUES
(1, 'roopesh', 'roopesh@gmail.com', 'b576b2c83bda27611a15e3a0fe8bf665', '1');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `sno` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `section` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`sno`, `year`, `branch`, `section`) VALUES
(1, 3, 'Computer Science and Engineering', 'A'),
(2, 3, 'Computer Science and Engineering', 'B'),
(3, 3, 'Computer Science and Engineering', 'C'),
(4, 3, 'Computer Science and Engineering', 'D'),
(5, 1, 'Computer Science and Engineering', 'A'),
(6, 1, 'Computer Science and Engineering', 'B'),
(7, 1, 'Computer Science and Engineering', 'C'),
(8, 1, 'Computer Science and Engineering', 'D'),
(9, 2, 'Computer Science and Engineering', 'A'),
(10, 2, 'Computer Science and Engineering', 'B'),
(11, 2, 'Computer Science and Engineering', 'C'),
(12, 2, 'Computer Science and Engineering', 'D'),
(13, 4, 'Computer Science and Engineering', 'A'),
(14, 4, 'Computer Science and Engineering', 'B'),
(15, 4, 'Computer Science and Engineering', 'C'),
(16, 4, 'Computer Science and Engineering', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `sno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`sno`, `name`) VALUES
(1, 'MONDAY'),
(2, 'TUESDAY'),
(3, 'WEDNESDAY'),
(4, 'THURSDAY'),
(5, 'FRIDAY'),
(6, 'SATURDAY');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(5) NOT NULL,
  `department` varchar(35) NOT NULL,
  `department_abbreviation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `department`, `department_abbreviation`) VALUES
(1, 'Computer Science and Engineering', 'CSE');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_subject_class`
--

CREATE TABLE `faculty_subject_class` (
  `sno` int(11) NOT NULL,
  `faculty_id` varchar(50) NOT NULL,
  `subject_id` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_subject_class`
--

INSERT INTO `faculty_subject_class` (`sno`, `faculty_id`, `subject_id`, `class`) VALUES
(1, '1', 'S01', '2'),
(2, '2', 'S02', '2'),
(3, '3', 'S03', '2'),
(4, '4', 'S04', '2'),
(5, '5', 'S05', '2');

-- --------------------------------------------------------

--
-- Table structure for table `leave_log`
--

CREATE TABLE `leave_log` (
  `leave_id` int(11) NOT NULL,
  `faculty_id` varchar(150) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` varchar(150) NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `applied_date` date NOT NULL,
  `approved_date` date NOT NULL,
  `body` longtext NOT NULL,
  `leave_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_log`
--

INSERT INTO `leave_log` (`leave_id`, `faculty_id`, `from_date`, `to_date`, `status`, `no_of_days`, `applied_date`, `approved_date`, `body`, `leave_type`) VALUES
(1, '1', '2020-05-04', '2020-05-05', 'PENDING', 2, '2020-05-02', '0000-00-00', 'test\r\n', 'optional');

-- --------------------------------------------------------

--
-- Table structure for table `leave_timetable`
--

CREATE TABLE `leave_timetable` (
  `sno` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `actual_faculty_id` varchar(150) NOT NULL,
  `replaced_faculty_id` varchar(150) NOT NULL,
  `subject_id` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `day` varchar(20) NOT NULL,
  `period` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `section` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_timetable`
--

INSERT INTO `leave_timetable` (`sno`, `leave_id`, `actual_faculty_id`, `replaced_faculty_id`, `subject_id`, `date`, `day`, `period`, `year`, `branch`, `section`) VALUES
(1, 1, '1', '4', 'S01', '2020-05-04', 'MONDAY', 1, 3, 'Computer Science and Engineering', 'B'),
(2, 1, '1', '3', 'S01', '2020-05-05', 'TUESDAY', 3, 3, 'Computer Science and Engineering', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `break` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session`, `break`) VALUES
(1, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subject_id` varchar(50) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `subject_abbreviation` varchar(100) NOT NULL,
  `year` int(50) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `sem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject_id`, `subject_name`, `subject_abbreviation`, `year`, `branch`, `sem`) VALUES
(1, 'S01', 'WT', 'Web Technologies', 3, 'Computer Science and Engineering', '2'),
(2, 'S02', 'CD', 'Compiler Desgin', 3, 'Computer Science and Engineering', '2'),
(3, 'S03', 'DWDM', 'Data Warehouse Data Mining', 3, 'Computer Science and Engineering', '2'),
(4, 'S04', 'OOAD', 'Object-oriented analysis and design', 3, 'Computer Science and Engineering', '2'),
(5, 'S05', 'MEFA', 'Managerial Economics and Financial Analysis', 3, 'Computer Science and Engineering', '2');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `tid` varchar(50) NOT NULL,
  `subject_id` varchar(50) NOT NULL,
  `period` int(50) NOT NULL,
  `year` int(11) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `tid`, `subject_id`, `period`, `year`, `branch`, `section`, `day`) VALUES
(1, '1', 'S01', 1, 3, 'Computer Science and Engineering', 'B', 'MONDAY'),
(2, '2', 'S02', 2, 3, 'Computer Science and Engineering', 'B', 'MONDAY'),
(3, '3', 'S03', 3, 3, 'Computer Science and Engineering', 'B', 'MONDAY'),
(4, '4', 'S04', 4, 3, 'Computer Science and Engineering', 'B', 'MONDAY'),
(5, '4', 'S04', 5, 3, 'Computer Science and Engineering', 'B', 'MONDAY'),
(6, '5', 'S05', 6, 3, 'Computer Science and Engineering', 'B', 'MONDAY'),
(7, '2', 'S02', 1, 3, 'Computer Science and Engineering', 'B', 'TUESDAY'),
(8, '4', 'S04', 2, 3, 'Computer Science and Engineering', 'B', 'TUESDAY'),
(9, '1', 'S01', 3, 3, 'Computer Science and Engineering', 'B', 'TUESDAY'),
(10, '5', 'S05', 4, 3, 'Computer Science and Engineering', 'B', 'TUESDAY'),
(11, '3', 'S03', 5, 3, 'Computer Science and Engineering', 'B', 'TUESDAY'),
(12, '2', 'S02', 6, 3, 'Computer Science and Engineering', 'B', 'TUESDAY'),
(13, '3', 'S03', 1, 3, 'Computer Science and Engineering', 'B', 'WEDNESDAY'),
(14, '3', 'S03', 2, 3, 'Computer Science and Engineering', 'B', 'WEDNESDAY'),
(15, '5', 'S05', 3, 3, 'Computer Science and Engineering', 'B', 'WEDNESDAY'),
(16, '1', 'S01', 4, 3, 'Computer Science and Engineering', 'B', 'WEDNESDAY'),
(17, '4', 'S04', 5, 3, 'Computer Science and Engineering', 'B', 'WEDNESDAY'),
(18, '2', 'S02', 6, 3, 'Computer Science and Engineering', 'B', 'WEDNESDAY'),
(19, '1', 'S01', 1, 3, 'Computer Science and Engineering', 'B', 'THURSDAY'),
(20, '4', 'S04', 2, 3, 'Computer Science and Engineering', 'B', 'THURSDAY'),
(21, '5', 'S05', 3, 3, 'Computer Science and Engineering', 'B', 'THURSDAY'),
(22, '2', 'S02', 4, 3, 'Computer Science and Engineering', 'B', 'THURSDAY'),
(23, '2', 'S02', 5, 3, 'Computer Science and Engineering', 'B', 'THURSDAY'),
(24, '3', 'S03', 6, 3, 'Computer Science and Engineering', 'B', 'THURSDAY'),
(25, '1', 'S01', 1, 3, 'Computer Science and Engineering', 'B', 'FRIDAY'),
(26, '1', 'S01', 2, 3, 'Computer Science and Engineering', 'B', 'FRIDAY'),
(27, '2', 'S02', 3, 3, 'Computer Science and Engineering', 'B', 'FRIDAY'),
(28, '3', 'S03', 4, 3, 'Computer Science and Engineering', 'B', 'FRIDAY'),
(29, '4', 'S04', 5, 3, 'Computer Science and Engineering', 'B', 'FRIDAY'),
(30, '5', 'S05', 6, 3, 'Computer Science and Engineering', 'B', 'FRIDAY'),
(31, '2', 'S02', 1, 3, 'Computer Science and Engineering', 'B', 'SATURDAY'),
(32, '5', 'S05', 2, 3, 'Computer Science and Engineering', 'B', 'SATURDAY'),
(33, '3', 'S03', 3, 3, 'Computer Science and Engineering', 'B', 'SATURDAY'),
(34, '1', 'S01', 4, 3, 'Computer Science and Engineering', 'B', 'SATURDAY'),
(35, '5', 'S05', 5, 3, 'Computer Science and Engineering', 'B', 'SATURDAY'),
(36, '4', 'S04', 6, 3, 'Computer Science and Engineering', 'B', 'SATURDAY');

-- --------------------------------------------------------

--
-- Table structure for table `tprofile`
--

CREATE TABLE `tprofile` (
  `user_id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL,
  `id` varchar(25) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `department` varchar(50) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phno` bigint(50) NOT NULL,
  `address` varchar(35) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tprofile`
--

INSERT INTO `tprofile` (`user_id`, `name`, `id`, `gender`, `pass`, `dob`, `department`, `email`, `phno`, `address`, `role`) VALUES
(1, 'tarakeswar', '1', 'male', 'tarakeswar', '0001-01-01', 'Computer', 'tarakeswar@vjit.ac.in', 122, 'Hyderabad', 1),
(2, 'Aruna', '2', 'female', 'aruna', '0001-01-01', 'Computer', 'aruna@vjit.ac.in', 12, 'hyderabad', 1),
(3, 'majeed', '3', 'male', 'majeed', '0001-01-01', 'Computer', 'majeed@vjit.ac.in', 121, 'hyderabad', 1),
(4, 'sameerasuina', '4', 'female', 'sameerasuina', '0001-01-01', 'Computer', 'summerasunia@vjit.ac.in', 12, 'hyderabad', 1),
(5, 'Masart jahan', '5', 'female', 'masartjahan', '0001-01-01', 'Computer', 'masartjahan@vjit.ac.in', 22, 'hyderabad', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campususers`
--
ALTER TABLE `campususers`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_subject_class`
--
ALTER TABLE `faculty_subject_class`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `leave_log`
--
ALTER TABLE `leave_log`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `leave_timetable`
--
ALTER TABLE `leave_timetable`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_id` (`subject_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tprofile`
--
ALTER TABLE `tprofile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campususers`
--
ALTER TABLE `campususers`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faculty_subject_class`
--
ALTER TABLE `faculty_subject_class`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leave_log`
--
ALTER TABLE `leave_log`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leave_timetable`
--
ALTER TABLE `leave_timetable`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tprofile`
--
ALTER TABLE `tprofile`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
