-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2017 at 02:50 am
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `img` varchar(64) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `page` varchar(24) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Advertisements' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `link`, `img`, `start`, `end`, `page`, `status`) VALUES
(1, 'www.fb.com', '', 25, 0, '', ''),
(2, 'www.google.com', '', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL COMMENT 'Parent ID',
  `name` varchar(64) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `pid`, `name`, `status`) VALUES
(1, 0, 'Sports', 'enabled'),
(3, 0, 'Sport', 'disabled'),
(7, 0, 'Politics', 'enabled'),
(8, 0, 'Economy', 'disabled'),
(9, 0, 'News', 'disabled');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` int(11) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `created` int(11) NOT NULL,
  `status` varchar(24) NOT NULL,
  `reply` text NOT NULL,
  `reply_by` int(11) NOT NULL,
  `reply_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE `online` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `la` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL COMMENT 'Category ID',
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `related_posts` text NOT NULL,
  `views` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `k` varchar(255) NOT NULL,
  `v` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `u`
--

CREATE TABLE `u` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created` bigint(12) NOT NULL,
  `status` text NOT NULL,
  `ip` varchar(32) NOT NULL,
  `code` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `u`
--

INSERT INTO `u` (`id`, `uid`, `name`, `email`, `pass`, `img`, `created`, `status`, `ip`, `code`) VALUES
(1, 1, 'Amr Elkhenany', 'akkk33@protonmail.com', '$2y$10$B/E0/bZcvoKdsLVVP9Ish.yeURykbFhEbiJvq16xKfROkNmjHPW92', '', 170608030000, 'enabled', '', '7e380d3d0c4755a2e37e245a6aacad6f3ee08646');

-- --------------------------------------------------------

--
-- Table structure for table `ug`
--

CREATE TABLE `ug` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Groups' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ugp`
--

CREATE TABLE `ugp` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `page` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Group Permissions' ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `u`
--
ALTER TABLE `u`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ug`
--
ALTER TABLE `ug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ugp`
--
ALTER TABLE `ugp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `online`
--
ALTER TABLE `online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `u`
--
ALTER TABLE `u`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ug`
--
ALTER TABLE `ug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ugp`
--
ALTER TABLE `ugp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
