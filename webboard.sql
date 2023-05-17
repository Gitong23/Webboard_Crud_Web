-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2023 at 07:19 AM
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
-- Database: `webboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `board_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`board_id`, `user_id`, `topic`, `content`) VALUES
(3, 2, 'ไก่ทอดหาดเล็ก หมาไม่แดก', 'อย่าหาแดกเลย นึกว่าหาดใหญ่ โดนแกงๆๆๆๆๆ'),
(5, 3, 'กุ้งเผา ครัวกุ้งๆๆๆๆ', 'อร่อย หวาน มัน กลิ่น ตุๆ'),
(6, 1, 'ไก่ต้มน้ำปลา เจ๊หวี หน้าโรงแรมอัมพร', 'ไก่เนื้ออย่างนุ่ม ซุปอย่างเค็ม'),
(7, 2, 'ข้าวมันไก่ ไอ้นุ้ย หน้าโรงเรียนวัดจันทร์', 'ไก่นุ่ม ข้าว หอม น้ำจิ้มเด็ด'),
(8, 2, 'ซูชิ หน้าโรงเรียนวัดธาราม สุดยอดด', 'ปลาแซลม่อนคือดีมากๆๆๆๆ');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_txt` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `board_id`, `user_id`, `comment_txt`) VALUES
(4, 5, 3, 'อยากกินมากกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกกก'),
(6, 3, 3, 'ต้องลองๆๆๆ'),
(7, 5, 1, 'ม่ายมีตังงับ'),
(8, 5, 2, 'น่ากินนนน'),
(9, 7, 2, 'น่ากินจัง'),
(10, 6, 2, 'เดกห'),
(11, 6, 2, 'ฟหดกดหฟกด'),
(12, 6, 2, 'ฟหดกดหฟ'),
(13, 6, 2, 'อยากกิน'),
(14, 7, 2, 'ลองแล้วไม่ผิดหวัง'),
(15, 7, 2, 'ไก่นุ่ม');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `img_no` int(11) NOT NULL,
  `board_id` int(11) NOT NULL,
  `file_name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`img_no`, `board_id`, `file_name`) VALUES
(8, 3, 'gdy8qRnDyLamsURyMWEV.jpg'),
(9, 3, 'รป-หลก-ของ-สตร-ไกทอดหาดใหญสตรเตม-พรอมวธเจยวหอม-กบทำขาวเหนยวงายๆ-ดวยหมอหงขาว.jpg'),
(12, 5, '5e313cc83a2547044e34a592.jpg'),
(13, 5, '1584346965_685720fc428113fefffeaff8e7a02f99.jpg'),
(14, 5, 'Kruayupin_91.jpg'),
(15, 6, '1058826638_1.jpg'),
(16, 7, 'bc87dbd926412df35d5b58720a934f29.jpg'),
(17, 7, 'tnfood6.jpg'),
(18, 7, '042-khaomankaimongkolwattana-blog-img_1.jpg'),
(19, 8, 'image2.jpg'),
(20, 8, 'sh1520.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Kaitom', 'gitong23@gmail.com', '0101'),
(2, 'komkai', 'sa@gmail.com', '0101'),
(3, 'Popo', 'admin@gmail.com', '0101');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`board_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`img_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `board_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `img_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
