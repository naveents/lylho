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
-- Databas: `thun_lylho`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `quotes`
--

DROP TABLE IF EXISTS `quotes`;
CREATE TABLE IF NOT EXISTS `quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(25) NOT NULL,
  `quote` text NOT NULL,
  `topic` varchar(25) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `quotes`
--

INSERT INTO `quotes` (`id`, `author`, `quote`, `topic`, `date`) VALUES
(1, 'kristoffer', 'kadfÃ¶asfsgfgfhjnhfdgc', 'Ã–vrigt', '2016-05-02 08:32:21'),
(4, 'Kristoffer', 'Hejsan hur mÃ¥r du', 'Inspirerande', '2016-05-02 08:49:51'),
(5, 'Kristoffer', 'Hejsan hur mÃ¥r du', 'Inspirerande', '2016-05-02 08:50:10'),
(6, '', '', '', '2016-05-02 08:51:27'),
(7, 'kristoffer', 'hejsan hur mÃ¥r du', 'Ã–vrigt', '2016-05-02 08:51:55'),
(8, 'kristoffer', 'hejsan hur mÃ¥r du', 'Ã–vrigt', '2016-05-02 08:52:31'),
(9, 'kristoffer', 'hejsan hur mÃ¥r du', 'Ã–vrigt', '2016-05-02 08:52:37'),
(15, 'kristoffer', 'hej hur mÃ¥r du', 'Ã–vrigt', '2016-05-02 09:39:02'),
(16, 'kristoffer', 'hej hur mÃ¥r du', 'Ã–vrigt', '2016-05-02 09:39:20'),
(17, 'kristoffer', 'vad ska du gÃ¶ra', 'Humor', '2016-05-02 09:39:47'),
(18, 'kristoffer', 'hej hur mÃ¥r du', 'Inspirerande', '2016-05-02 10:54:45'),
(19, 'kristoffer', 'hej hur mÃ¥r du', 'Ã–vrigt', '2016-05-03 07:44:50'),
(21, 'kristoffer', 'hej hur mÃ¥r du', 'Ã–vrigt', '2016-05-03 07:49:08'),
(22, 'kristoffer', 'hej hur mÃ¥r du', 'Ã–vrigt', '2016-05-03 07:51:25'),
(23, 'kristoffer', 'hej hur mÃ¥r du', 'Ã–vrigt', '2016-05-03 07:51:33'),
(24, 'kristoffer', 'hej hur mÃ¥r du', 'Ã–vrigt', '2016-05-03 07:52:20'),
(25, 'Mahatma Gandhi', 'vaddskadkasmdkÃ¶mÃ¶asmÃ¶lfwdgerÂ¨h\r\nvaddskadkasmdkÃ¶mÃ¶asmÃ¶lfwdgerÂ¨h\r\nvaddskadkasmdkÃ¶mÃ¶asmÃ¶lfwdgerÂ¨h\r\nvaddskadkasmdkÃ¶mÃ¶asmÃ¶lfwdgerÂ¨h\r\n', 'Humor', '2016-05-16 10:48:09'),
(26, 'Steve Jobs', 'Stay Foolish, stay hungry.', 'Inspirerande', '2016-05-17 10:22:16'),
(27, 'kristoffer', 'hejsan hur mÃ¥r du?', 'Inspirerande', '2016-05-26 11:19:51'),
(28, 'kristoffer', 'Hejsan hur mÃ¥r du?', 'Humor', '2016-05-26 11:20:05'),
(29, 'Ghandi', 'What should i do', 'Inspirerande', '2016-05-26 11:22:48');

-- --------------------------------------------------------

--
-- Tabellstruktur `voting_count`
--

DROP TABLE IF EXISTS `voting_count`;
CREATE TABLE IF NOT EXISTS `voting_count` (
  `id` int(11) NOT NULL,
  `unique_content_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vote_up` int(11) NOT NULL,
  `vote_down` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumpning av Data i tabell `voting_count`
--

INSERT INTO `voting_count` (`id`, `unique_content_id`, `vote_up`, `vote_down`) VALUES
(1, 'b8c37e33defde51cf91e1e03e51657da', 1, 0),
(2, 'c81e728d9d4c2f636f067f89cc14862c', 3, 0),
(3, 'c4ca4238a0b923820dcc509a6f75849b', 0, 2),
(4, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 4, 1),
(5, '1679091c5a880faf6fb5e6087eb1b2dc', 1, 0),
(6, 'e4da3b7fbbce2345d7772b0674a318d5', 2, 0),
(7, '8f14e45fceea167a5a36dedd4bea2543', 2, 0),
(8, '3c59dc048e8850243be8079a5c74d079', 1, 0),
(9, '98f13708210194c475687be6106a3b84', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
