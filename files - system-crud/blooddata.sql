-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 04, 2024 at 06:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blooddata`
--

-- --------------------------------------------------------

--
-- Table structure for table `datablood`
--

CREATE TABLE `datablood` (
  `id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `city` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `save_life_date` varchar(30) NOT NULL,
  `confirm_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `datablood`
--

INSERT INTO `datablood` (`id`, `Name`, `dob`, `blood_group`, `gender`, `email`, `contact_no`, `city`, `password`, `save_life_date`, `confirm_password`) VALUES
(1, 'tamoor', '01/08/1998', 'B+', 'male', 'blood@gmail.com', '03051818044', 'fortabbas', '123456', '', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datablood`
--
ALTER TABLE `datablood`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datablood`
--
ALTER TABLE `datablood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
