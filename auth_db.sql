-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 05:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auth_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pp` varchar(255) NOT NULL DEFAULT 'default-pp.png',
  `code` int(6) NOT NULL DEFAULT 0,
  `status` varchar(20) NOT NULL DEFAULT 'verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `email`, `username`, `password`, `pp`, `code`, `status`) VALUES
(1, 'MD Wali Ullah Khan', 'waliullahkhan3012@gmail.com', 'CringyNoob', '$2y$10$v1Bu4SaNUlhdAjIlO6dFZOfHA1bcy6N0QrwCVL03XKNLeFwH9ty4G', 'CringyNoob66dd6e14515162.51005458.jpg', 0, 'verified'),
(2, 'trtyry', 'code@gmail.com', 'treat', '$2y$10$szeBmpodEm7/yRux1lgvNO1it0MfmdiIg9/KGoFZxmTr6OASkN0v2', 'default-pp.png', 0, 'verified'),
(3, 'Ahnaf Atique', 'aranov1107@gmail.com', 'aranov', '$2y$10$0dRO3SKUEWp3X.O6ypsBJ.xwSqzhyS45uHOUeYDNnKPGq5sQvdHkq', 'aranov66dee782b4bcf0.20190191.jpg', 0, 'verified'),
(4, 'NIHAL', 'asdasd', 'asd', '$2y$10$RLbqoSBdBPCr3VKLt7Ibp.HSK0bWT8aB1iEZaa5xpneb3uQwq465C', 'asd66ddd281286611.64056058.png', 0, 'verified'),
(5, 'khan', 'ok@gmail.com', 'kite', '$2y$10$actSolkyU5j1zUOtp0HZsuQwGzItnHrEHdPwkxxEbWSKBlm9OC8JK', 'kite66ddd486d6b4a7.03386828.png', 429586, 'verified'),
(7, 'MD Wali Ullah', 'wali.official71@gmail.com', 'Cringy', '$2y$10$6RYo0Hxi96ZUqYDBFJPpqu21JM1WSRj6qtkQgIKuQwAtaH47B2bQe', 'default-pp.png', 0, 'verified'),
(9, 'MD Wali Ullah', 'wali.official72@gmail.com', 'jun', '$2y$10$Bd3lwFa5rlKoQTZRietxn.uNoyIYGHeqo224fdhCU4eZuVcjxUFuW', 'default-pp.png', 0, 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`username`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
