-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 03, 2018 at 09:23 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mapl_story`
--
CREATE DATABASE IF NOT EXISTS `mapl_story` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mapl_story`;

-- --------------------------------------------------------

--
-- Table structure for table `mapl_config`
--

DROP TABLE IF EXISTS `mapl_config`;
CREATE TABLE IF NOT EXISTS `mapl_config` (
  `mapl_salt` varchar(100) NOT NULL,
  `mapl_key` varchar(100) NOT NULL,
  `mapl_now_get_your_flag` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapl_config`
--

INSERT INTO `mapl_config` (`mapl_salt`, `mapl_key`, `mapl_now_get_your_flag`) VALUES
('ms_g00d_0ld_g4m3', 'You_Never_Guess_This_Tsug0d_1337', 'MeePwnCTF{__Abus1ng_SessioN_Is_AlwAys_C00L_1337!___}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(500) NOT NULL,
  `userEmail` varchar(500) NOT NULL,
  `userPass` varchar(500) DEFAULT NULL,
  `userIsAdmin` int(11) DEFAULT NULL,
  `userDesc` varchar(500) DEFAULT NULL,
  `userAvatar` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userEmail` (`userEmail`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`, `userIsAdmin`, `userDesc`, `userAvatar`) VALUES
(1, 'aaaa', 'admin@gmail.com', '16c70e4a22c1706b0adcc0de4a0a03b5cd859921c086e758eb3f1baf4eee04e9', 1, ' ', 'npc_1.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
