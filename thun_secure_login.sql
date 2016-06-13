-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 31 maj 2016 kl 06:55
-- Serverversion: 5.7.9
-- PHP-version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `thun_secure_login`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(8, '1464265819');

-- --------------------------------------------------------

--
-- Tabellstruktur `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(128) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `salt`) VALUES
(8, 'kr', 'kr@gmail.com', '72da3a70dab1826d36be9aebadc7b8f57d4bcbebf93322140f46518e05c388c65d42c0f02f5422e93a684cf4aa9ef76b8e9ac6cd7b3b753016472c4bf88be59b', '98b5a6d1afda10cff7bf4b4f9e71eb3439e88a066ca1d2f2c067e4830edfe62fbe9355e42c2fe303af11ae6652069a3a67961ae6be7d8309773da9570dd6b1a0'),
(9, 'kr', 'kr@gmail.com', 'c8dc3e27b76c58efa3b6f242d1314e2b8b1fcdb03b047d3c6cba4c6c9924152981931a92e35d9fa30e47157476a184a6bfe9b708d6943d13a82c713010d8a49a', 'c77992f50918dea0111618beeebe0a6d6ed77b766277cb7c77e8592a3e633bf01bd3224328bfc957a1256f5664d32806315a58adb2dee7c3abac5521c66e888b');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
