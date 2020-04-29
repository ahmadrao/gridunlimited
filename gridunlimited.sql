-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2020 at 09:57 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gridunlimited`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `updated_at`) VALUES
(1, 'admin@gmail.com', '123456', '2019-11-13 13:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(100) NOT NULL,
  `category` varchar(5000) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `image` varchar(10000) NOT NULL,
  `added_at` varchar(200) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(500) NOT NULL DEFAULT 'published'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `description`, `image`, `added_at`, `updated_at`, `status`) VALUES
(1, 'Hip Hop Dance', '  Tension Free', '', '13th  November 2019 07:23 AM', '2019-11-17 11:11:22', 'published'),
(2, 'Entertainment', ' Tested', 'Shop3512547comp_beat.jpg', '13th  November 2019 07:58 AM', '2019-12-05 06:47:04', 'published'),
(3, 'okay bro', 'xshbxvscd', 'Shop1525559binplus.png', '13th  November 2019 06:46 PM', '2019-11-17 04:27:26', 'published'),
(7, 'Shop', 'Jaldi Lekar ana', 'Shop3512547comp_beat.jpg', '16th  November 2019 06:06 AM', '2019-11-17 04:27:56', 'published'),
(8, 'Category 1', 'Jaldi Lekar ana', 'd43bbbdf5f98d9becabe7f9ea5ba8dc7.png', '16th  November 2019 06:23 AM', '2019-11-17 04:38:57', 'published'),
(9, 'Demo Channal', 'test', '130deff497ccf13af59a3787fa9162fa.jpg', '14th  December 2019 04:05 PM', '2019-12-14 10:35:08', 'published'),
(10, 'Demo Channal1', 'test', 'cb62f4d79ce0f7f7aef36684d0d57e03.jpg', '14th  December 2019 04:05 PM', '2019-12-14 10:35:31', 'published'),
(11, 'Demo Channal2', 'test', '357bbeff532fa9b9bcb3d3e363bda5da.jpg', '14th  December 2019 04:05 PM', '2019-12-14 10:35:58', 'published'),
(12, 'thunder cat', 'cartoon stuff', '41d06f8abaf1c5a6854ece0020bf4c52.png', '31st  December 2019 03:09 AM', '2019-12-30 21:39:25', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(5000) NOT NULL,
  `video_url` varchar(10000) NOT NULL,
  `duration` varchar(1000) NOT NULL,
  `added_at` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(500) NOT NULL DEFAULT 'published'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `category_id`, `title`, `video_url`, `duration`, `added_at`, `updated_at`, `status`) VALUES
(2, 1, 'Hiphop Tamizha', 'https://www.youtube.com/watch?v=F-ApnMmP5Qk', '00:11:31', '13th  November 2019 02:13 PM', '2020-04-23 16:46:46', 'published'),
(3, 2, 'Do You Charge A Fee For Visiting My House And Making An Offer?', 'https://www.youtube.com/watch?v=KsXyPotG4dA', '00:33:12', '13th  November 2019 06:44 PM', '2020-04-21 12:22:35', 'published'),
(4, 3, 'episode 1', 'https://www.youtube.com/watch?v=F-ApnMmP5Qk', '00:03:11', '13th  November 2019 06:47 PM', '2020-04-21 12:22:55', 'published'),
(5, 1, 'Nas is Like', 'https://www.youtube.com/watch?v=lFkn_I3HT9M', '00:33:21', '15th  November 2019 02:18 AM', '2020-04-21 12:23:16', 'published'),
(6, 2, 'Star wars mandalorian', 'https://www.youtube.com/watch?v=TRP2i41yxrg', '00:21:21', '16th  November 2019 04:16 AM', '2020-04-21 12:23:26', 'published'),
(9, 1, 'Shopping2t', 'https://www.youtube.com/watch?v=MaHATuzHGaU', '00:21:21', '16th  November 2019 07:49 AM', '2020-04-21 12:23:39', 'published'),
(10, 7, 'Shopping2', 'https://www.youtube.com/watch?v=F-ApnMmP5Qk', '00:21:21', '17th  November 2019 09:16 AM', '2020-04-21 12:23:45', 'published'),
(11, 8, 'Test', 'https://www.youtube.com/watch?v=MaHATuzHGaU', '00:11:23', '17th  November 2019 09:25 AM', '2020-04-21 12:23:54', 'published'),
(12, 8, 'Cartoon', 'youtube.com/watch?v=qM5yoXki_So', '00:12:32', '17th  November 2019 09:25 AM', '2020-04-21 12:24:02', 'published'),
(13, 2, 'Kids game', 'https://www.youtube.com/watch?v=F-ApnMmP5Qk', '00:05:22', '5th  December 2019 12:15 PM', '2020-04-21 12:24:09', 'published'),
(14, 1, 'Dances', 'https://www.youtube.com/watch?v=9M_FlkAiTSo', '00:06:32', '12th  December 2019 02:24 PM', '2020-04-21 12:24:18', 'published'),
(15, 1, 'Badanamu', 'https://www.youtube.com/watch?v=XhpGp9d9jSA', '00:34:32', '12th  December 2019 02:24 PM', '2020-04-21 12:24:32', 'published'),
(16, 1, 'Tom and Jerry', 'https://www.youtube.com/watch?v=Fk0HMKObKXU', '00:32:12', '12th  December 2019 02:24 PM', '2020-04-21 12:24:41', 'published'),
(17, 1, 'Cartooni', 'https://www.youtube.com/watch?v=JZ0Hw6-J9yg', '00:04:32', '12th  December 2019 02:24 PM', '2020-04-21 12:24:48', 'published'),
(18, 1, 'Clothings', 'https://www.youtube.com/watch?v=67MMPKH3swI', '00:32:12', '12th  December 2019 02:24 PM', '2020-04-21 12:24:59', 'published'),
(19, 9, 'Cartoon', 'https://www.youtube.com/watch?v=TKlHvVGn_Sg', '00:45:32', '14th  December 2019 04:09 PM', '2020-04-21 12:25:19', 'published'),
(20, 9, 'cartoon1', 'https://www.youtube.com/watch?v=TKlHvVGn_Sg', '00:09:32', '14th  December 2019 04:09 PM', '2020-04-21 12:25:36', 'published'),
(21, 9, 'Kids game', 'https://www.youtube.com/watch?v=TKlHvVGn_Sg', '00:32:32', '14th  December 2019 04:09 PM', '2020-04-21 12:25:45', 'published'),
(22, 10, 'Kids game', 'https://www.youtube.com/watch?v=TKlHvVGn_Sg', '00:07:32', '14th  December 2019 04:10 PM', '2020-04-21 12:25:58', 'published'),
(23, 11, 'Kids game', 'https://www.youtube.com/watch?v=TKlHvVGn_Sg', '01:32:32', '14th  December 2019 04:11 PM', '2020-04-21 12:26:08', 'published'),
(24, 11, 'Kids game5', 'https://www.youtube.com/watch?v=TKlHvVGn_Sg', '00:43:23', '14th  December 2019 04:11 PM', '2020-04-21 12:26:17', 'published'),
(25, 1, 'Wutang Triumph', 'https://www.youtube.com/watch?v=cPRKsKwEdUQ', '00:19:20', '27th  December 2019 04:52 AM', '2020-04-21 12:26:29', 'published'),
(26, 10, 'Kids game', 'https://www.youtube.com/watch?v=w6MOd_05OLE', '00:23:21', '27th  December 2019 06:17 PM', '2020-04-21 12:26:35', 'published'),
(27, 1, 'Glass Textile Reinforced Concrete Crash Barrier', ' https://www.youtube.com/watch?v=cPRKsKwEdUQ ', '00:21:21', '28th  December 2019 09:55 AM', '2020-04-21 12:26:38', 'published'),
(28, 1, 'Glass Textile Reinforced Concrete Crash Barrier', ' https://www.youtube.com/watch?v=cPRKsKwEdUQ ', '00:21:21', '28th  December 2019 09:56 AM', '2020-04-21 12:26:41', 'published'),
(29, 2, 'Glass Textile Reinforced Concrete Crash Barrier', 'https://www.youtube.com/watch?v=cPRKsKwEdUQ', '00:21:21', '28th  December 2019 09:57 AM', '2020-04-21 12:26:44', 'published'),
(30, 11, 'star wars', 'https://www.youtube.com/watch?v=UUX_Vv6Rpvs', '00:21:21', '28th  December 2019 02:01 PM', '2020-04-21 12:26:48', 'published'),
(31, 12, 'Emulator', 'https://www.youtube.com/watch?v=RxGzXGoPpO0', '00:21:21', '31st  December 2019 03:10 AM', '2020-04-21 12:26:51', 'published');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
