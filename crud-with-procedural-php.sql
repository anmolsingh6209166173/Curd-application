-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 30, 2024 at 07:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud-with-procedural-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(20) DEFAULT NULL,
  `message` varchar(2000) DEFAULT NULL,
  `profile_picture` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `number`, `message`, `profile_picture`, `is_deleted`, `deleted_at`, `deleted_by`, `facebook`, `instagram`, `linkedin`, `whatsapp`, `twitter`) VALUES
(1, 'Anmol', 'kumar', 'anmolsingh6209166173@gmail.com', '9939831435', 'hii', 'wepik-export-20231212075002yykY.png', 1, '2024-05-07 08:14:40', 'deleted_by_user', '', '', '', '', ''),
(2, 'अनमोल', 'कुमार', 'anmolsingh6209166173@gmail.com', '9939831435', 'hii anmol singh rajput', 'WhatsApp Image 2023-10-05 at 10.31.22 AM.jpeg', 0, NULL, NULL, 'https://www.facebook.com/ammcdsjh/', 'https://www.facebook.com/mAviatorGroup/', '', '', ''),
(3, 'Anmol', 'kumar', 'Sirrajeevranjan121@gmail.com', '9939831435', 'hkgk', 'soni-about-small.jpg', 1, '2024-05-07 09:24:26', 'deleted_by_user', '', '', '', '', ''),
(4, 'Anmol', 'kumar', 'anmolsingh6209166173@gmail.com', '9939831435', 'ghgh', 'wp6293190-krishna-mahabharat-wallpapers.jpg', 0, NULL, NULL, 'https://www.facebook.com/mAviatorGroup/', 'https://www.facebook.com/mAviatorGroup/', 'https://www.facebook.com/mAviatorGroup/', 'https://www.facebook.com/mAviatorGroup/', 'https://www.facebook.com/anmol/'),
(5, 'Anmol', 'kumar', 'anmolsingh6209166173@gmail.com', '9939831435', 'gugioy', 'WhatsApp Image 2023-10-05 at 10.31.22 AM.jpeg', 0, NULL, NULL, 'https://www.facebook.com/mAviatorGroup/', '', '', '', ''),
(6, 'Anmol', 'kumar', 'Sirrajeevranjan121@gmail.com', '9939831435', 'o8yoiyp', 'auth-icon.jpg', 1, '2024-05-21 07:03:03', 'deleted_by_user', '', '', '', '', ''),
(7, 'Nikhil', 'Shaw', 'nikhilkumar251@gmail.com', '8709305218', 'Full Stack Developer', 'blue-circle-with-white-user_78370-4707.jpg', 0, NULL, NULL, 'https://www.facebook.com/ammcdsjh/', 'https://www.facebook.com/mAviatorGroup/', 'https://www.facebook.com/mAviatorGroup/', 'https://www.facebook.com/mAviatorGroup/', 'https://www.facebook.com/mAviatorGroup/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
