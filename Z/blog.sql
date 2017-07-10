-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2017 at 03:02 pm
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
(4, 'http://www.google.com', '9b3998042cf513576ac445ce3e1a4badc791801f.jpg', 1493589600, 1501538400, '/login', 'enabled'),
(5, 'http://www.facebook.com', 'de5eecafb7aeb1e61c635c042d864931ce94e023.png', 1493589600, 1498773600, '/', 'disabled'),
(6, 'https://duckduckgo.com/?q=spaghitti&amp;t=ffsb&amp;iax=1&amp;ia=images', '3c6bdd88f9e784672aabc3c7cc9cf5a417c268d5.jpg', 1498946400, 1501970400, '/post/:text/:id', 'enabled'),
(7, 'https://us.coca-cola.com/', '9221ea7062f246b486e9fbb797a9716b28b6fb99.jpg', 1497391200, 1507240800, '/category/:text/:id', 'enabled'),
(8, 'http://www.android.com', 'fdcc1e0553cb0478b459b656268a80079676f22c.jpg', 1499292000, 1504648800, '/register', 'enabled'),
(9, 'http://www.linkedin.com', '61b61d35e3b16c2a8c38d69586b452332f5d0ab3.jpg', 1501970400, 1504648800, '/contact', 'enabled'),
(10, 'http://www.linux.org', 'bc8b98cda0bddce60982a53605028450d40316aa.jpg', 1494021600, 1508968800, '/', 'enabled'),
(11, 'http://www.bugatti.com/home/', 'efc4461f96f53c555124be523a7ae42a19ddc99f.jpg', 1499119200, 1512687600, '/about', 'enabled'),
(12, 'https://duckduckgo.com', '793139689d9554df2d3a19b58caca2acb2b2aec5.png', 1499378400, 1531087200, '/contact', 'enabled'),
(13, 'https://www.discuvver.com/', '149f1da7ff7cfb3f849fee769e65c0907396c81f.png', 1496959200, 1502229600, '/login', 'enabled'),
(14, 'http://muslims-res.com/', '052e804b31cd4fcd13aac5bb5a7900a705a1ae34.png', 1498687200, 1504044000, '/', 'enabled');

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
(15, 0, 'News', 'enabled'),
(16, 0, 'Economy', 'enabled'),
(23, 0, 'Health', 'enabled'),
(26, 0, 'Politics', 'enabled'),
(27, 0, 'Technology', 'disabled');

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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `uid`, `post_id`, `comment`, `created`, `status`) VALUES
(9, 2, 5, 'Awesome', 1499486480, 'enabled'),
(10, 2, 5, 'Now photos are visible', 1499486496, 'enabled'),
(13, 2, 14, 'convallis luctus pretium. Quisque tincidunt massa eu nulla consectetur fermentum. Cras imperdiet neque at sem lacinia, et mollis magna faucibus. Donec in ante at elit sodales tempor. Duis consequat eros fermentum', 1499585884, 'enabled'),
(18, 2, 26, 'ante at eros blandit ornare. Vestibulum cursus libero in eros placerat convallis. Integer laoreet, erat eu mattis venenatis, est quam fermentum sem, eget ullamcorper mi purus', 1499690738, 'enabled'),
(20, 2, 26, 'ante at eros blandit ornare. Vestibulum cursus libero in eros placerat convallis. Integer laoreet, erat eu mattis venenatis, est quam fermentum sem, eget ullamcorper mi purus', 1499690743, 'enabled');

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

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uid`, `cid`, `title`, `text`, `img`, `tags`, `related_posts`, `views`, `created`, `status`) VALUES
(5, 1, 16, 'First post', '&lt;b&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tincidunt nibh nibh, ac ultricies dui commodo eget. Proin sed volutpat enim. Nunc ac tellus ut nunc auctor laoreet. Donec accumsan ex in egestas fringilla. Nam non ornare mi. Sed sit amet placerat lorem. Ut lacinia consectetur convallis. Morbi ullamcorper a massa eu sagittis. Nunc convallis luctus pretium.\r\n\r\nQuisque tincidunt massa eu nulla consectetur fermentum. Cras imperdiet neque at sem lacinia, et mollis magna faucibus. Donec in ante at elit sodales tempor. Duis consequat eros fermentum, cursus enim a, consectetur nisl. Proin quam sapien, tristique sit amet tempus vitae, vulputate nec mauris. Proin id felis dapibus, porttitor ante a, mattis nisl. Aliquam erat volutpat. Etiam ac erat nec libero semper venenatis. Morbi egestas lectus vitae tortor sodales rutrum. Ut eget mauris sodales, porttitor leo vitae, faucibus augue. Morbi mattis quam vel rhoncus condimentum. Vivamus maximus euismod nisi, ut dignissim elit pulvinar sed. Donec ultrices mattis vulputate.&lt;/b&gt;', '07f41d195eaed1e8b2849480fa6c8933773a3e84.jpg', 'adasdsad', '', 115, 1498672526, 'enabled'),
(14, 1, 16, 'Milan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tincidunt nibh nibh, ac ultricies dui commodo eget. Proin sed volutpat enim. Nunc ac tellus ut nunc auctor laoreet. Donec accumsan ex in egestas fringilla. Nam non ornare mi. Sed sit amet placerat lorem. Ut lacinia consectetur convallis. Morbi ullamcorper a massa eu sagittis. Nunc convallis luctus pretium.\r\n\r\nQuisque tincidunt massa eu nulla consectetur fermentum. Cras imperdiet neque at sem lacinia, et mollis magna faucibus. Donec in ante at elit sodales tempor. Duis consequat eros fermentum, cursus enim a, consectetur nisl. Proin quam sapien, tristique sit amet tempus vitae, vulputate nec mauris. Proin id felis dapibus, porttitor ante a, mattis nisl. Aliquam erat volutpat. Etiam ac erat nec libero semper venenatis. Morbi egestas lectus vitae tortor sodales rutrum. Ut eget mauris sodales, porttitor leo vitae, faucibus augue. Morbi mattis quam vel rhoncus condimentum. Vivamus maximus euismod nisi, ut dignissim elit pulvinar sed. Donec ultrices mattis vulputate.', '37458a19943d6bfb1e71f29c2771d499a6fb3526.jpg', 'abc', '', 0, 1498713138, 'enabled'),
(25, 2, 23, 'العنوان', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu tempor nisl, vel sodales velit. Ut sodales eros eu ex interdum, nec dapibus nulla accumsan. Nullam vel tristique neque. Donec gravida, mauris nec rhoncus lobortis, sapien turpis pharetra sem, quis tempus odio neque vitae justo. Phasellus nibh diam, viverra nec suscipit vel, viverra iaculis dui. Nulla laoreet, tortor non sollicitudin tincidunt, mauris magna faucibus massa, vel suscipit metus nulla sed urna. Aenean dictum molestie ullamcorper. Phasellus scelerisque ultricies elit ut ultrices. Etiam auctor odio dolor, at placerat felis mollis blandit. In pharetra metus ac efficitur consectetur.\r\n\r\nSed ut orci sed ante tempus fermentum in id elit. Vestibulum a sem in felis ullamcorper consequat. Donec id placerat sem. Cras semper, mi ac suscipit lacinia, libero purus aliquet est, et laoreet neque diam venenatis tortor. Sed consectetur metus neque, et rutrum libero interdum ut. Aliquam a aliquet ligula, a vulputate odio. Donec luctus, tellus ac pretium feugiat, velit nisl dignissim quam, sit amet venenatis mauris erat eget odio. Sed erat purus, placerat eu posuere quis, hendrerit ut ipsum. Suspendisse rhoncus congue lacus, nec sollicitudin sem. Sed faucibus, metus quis iaculis accumsan, ligula orci condimentum felis, vel pulvinar purus purus et quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque finibus tellus varius hendrerit facilisis. Sed fringilla rhoncus faucibus. Ut at eros porta, condimentum lectus eget, maximus dui.\r\n\r\nMorbi bibendum congue mauris in bibendum. Ut condimentum, arcu non gravida elementum, augue orci malesuada libero, at ornare leo nisl ut risus. Curabitur id libero enim. Mauris eget ante at eros blandit ornare. Vestibulum cursus libero in eros placerat convallis. Integer laoreet, erat eu mattis venenatis, est quam fermentum sem, eget ullamcorper mi purus quis urna. Ut neque urna, accumsan sed nisl vel, malesuada feugiat lacus. Praesent ut ipsum a nisi euismod scelerisque. Proin lobortis massa at pellentesque imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque neque justo, tempus non urna quis, placerat tempus neque. Maecenas consequat consectetur eros eu auctor. Ut ultricies interdum placerat. Proin et risus et sapien dictum vehicula vitae sit amet velit. Fusce risus lectus, pulvinar vitae molestie ac, pharetra vel nunc. Proin id viverra libero.\r\n\r\nInteger consequat euismod tellus, ac dictum dolor consequat cursus. Phasellus quis viverra magna. Quisque vel accumsan sem. Sed eleifend neque id velit ultrices feugiat. Mauris et lorem ligula. Praesent ex nisi, vulputate et velit eget, gravida convallis augue. Nam non augue et turpis pharetra mollis. In hac habitasse platea dictumst. Pellentesque dignissim placerat orci id aliquet. Integer auctor semper elit facilisis malesuada. Maecenas venenatis, neque ut tincidunt dapibus, eros sapien rhoncus diam, tempus condimentum sapien ipsum aliquam massa. Proin et vestibulum diam. Proin non urna nunc. Mauris consequat neque massa, ut aliquet mauris tempor nec. Phasellus tristique, libero at dignissim ornare, sapien sapien porttitor orci, non sodales orci velit eget ante.\r\n\r\nPraesent imperdiet metus sit amet nunc posuere, vel suscipit nulla sodales. Sed lectus leo, rhoncus vel orci sit amet, interdum luctus mauris. Sed sit amet vestibulum dolor, id fermentum metus. Vestibulum congue suscipit justo. Etiam hendrerit hendrerit finibus. Cras bibendum accumsan odio nec placerat. Cras malesuada posuere magna, eu aliquam leo dignissim non. Nullam a quam lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean sit amet tellus ac massa placerat facilisis. In imperdiet quis tortor eget tristique. Proin ornare eros eu sem aliquam sollicitudin. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse commodo odio at magna tempor, volutpat suscipit elit interdum.', '30f68e73c7354f1a04f41d7b84089f7b36f814a1.jpg', 'article', '', 25, 1499621017, 'enabled'),
(26, 2, 1, 'title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu tempor nisl, vel sodales velit. Ut sodales eros eu ex interdum, nec dapibus nulla accumsan. Nullam vel tristique neque. Donec gravida, mauris nec rhoncus lobortis, sapien turpis pharetra sem, quis tempus odio neque vitae justo. Phasellus nibh diam, viverra nec suscipit vel, viverra iaculis dui. Nulla laoreet, tortor non sollicitudin tincidunt, mauris magna faucibus massa, vel suscipit metus nulla sed urna. Aenean dictum molestie ullamcorper. Phasellus scelerisque ultricies elit ut ultrices. Etiam auctor odio dolor, at placerat felis mollis blandit. In pharetra metus ac efficitur consectetur.\r\n\r\nSed ut orci sed ante tempus fermentum in id elit. Vestibulum a sem in felis ullamcorper consequat. Donec id placerat sem. Cras semper, mi ac suscipit lacinia, libero purus aliquet est, et laoreet neque diam venenatis tortor. Sed consectetur metus neque, et rutrum libero interdum ut. Aliquam a aliquet ligula, a vulputate odio. Donec luctus, tellus ac pretium feugiat, velit nisl dignissim quam, sit amet venenatis mauris erat eget odio. Sed erat purus, placerat eu posuere quis, hendrerit ut ipsum. Suspendisse rhoncus congue lacus, nec sollicitudin sem. Sed faucibus, metus quis iaculis accumsan, ligula orci condimentum felis, vel pulvinar purus purus et quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque finibus tellus varius hendrerit facilisis. Sed fringilla rhoncus faucibus. Ut at eros porta, condimentum lectus eget, maximus dui.\r\n\r\nMorbi bibendum congue mauris in bibendum. Ut condimentum, arcu non gravida elementum, augue orci malesuada libero, at ornare leo nisl ut risus. Curabitur id libero enim. Mauris eget ante at eros blandit ornare. Vestibulum cursus libero in eros placerat convallis. Integer laoreet, erat eu mattis venenatis, est quam fermentum sem, eget ullamcorper mi purus quis urna. Ut neque urna, accumsan sed nisl vel, malesuada feugiat lacus. Praesent ut ipsum a nisi euismod scelerisque. Proin lobortis massa at pellentesque imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque neque justo, tempus non urna quis, placerat tempus neque. Maecenas consequat consectetur eros eu auctor. Ut ultricies interdum placerat. Proin et risus et sapien dictum vehicula vitae sit amet velit. Fusce risus lectus, pulvinar vitae molestie ac, pharetra vel nunc. Proin id viverra libero.\r\n\r\nInteger consequat euismod tellus, ac dictum dolor consequat cursus. Phasellus quis viverra magna. Quisque vel accumsan sem. Sed eleifend neque id velit ultrices feugiat. Mauris et lorem ligula. Praesent ex nisi, vulputate et velit eget, gravida convallis augue. Nam non augue et turpis pharetra mollis. In hac habitasse platea dictumst. Pellentesque dignissim placerat orci id aliquet. Integer auctor semper elit facilisis malesuada. Maecenas venenatis, neque ut tincidunt dapibus, eros sapien rhoncus diam, tempus condimentum sapien ipsum aliquam massa. Proin et vestibulum diam. Proin non urna nunc. Mauris consequat neque massa, ut aliquet mauris tempor nec. Phasellus tristique, libero at dignissim ornare, sapien sapien porttitor orci, non sodales orci velit eget ante.\r\n\r\nPraesent imperdiet metus sit amet nunc posuere, vel suscipit nulla sodales. Sed lectus leo, rhoncus vel orci sit amet, interdum luctus mauris. Sed sit amet vestibulum dolor, id fermentum metus. Vestibulum congue suscipit justo. Etiam hendrerit hendrerit finibus. Cras bibendum accumsan odio nec placerat. Cras malesuada posuere magna, eu aliquam leo dignissim non. Nullam a quam lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean sit amet tellus ac massa placerat facilisis. In imperdiet quis tortor eget tristique. Proin ornare eros eu sem aliquam sollicitudin. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse commodo odio at magna tempor, volutpat suscipit elit interdum.', '9675afb7b05bafed1f50e1261ce5d4ac1b81cc3b.jpg', 'title,text', '', 58, 1499621892, 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `email` varchar(32) NOT NULL,
  `status` tinytext NOT NULL,
  `msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `email`, `status`, `msg`) VALUES
(1, 'AE-AdvBlog', 'info@aeadvblog.com', 'on', 'Site is under maintenance, Please try reloading this page later ..');

-- --------------------------------------------------------

--
-- Table structure for table `u`
--

CREATE TABLE `u` (
  `id` int(11) NOT NULL,
  `ugid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created` bigint(12) NOT NULL,
  `status` text NOT NULL,
  `ip` varchar(32) NOT NULL,
  `code` varchar(48) NOT NULL,
  `bio` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `u`
--

INSERT INTO `u` (`id`, `ugid`, `name`, `email`, `pass`, `img`, `created`, `status`, `ip`, `code`, `bio`) VALUES
(1, 1, 'Amr', 'akkk33@protonmail.com', '$2y$10$zwJy.TitrI57UdptY94Ge.HuuyGHHlp7.4cmc6bLGitB132lUkOYG', 'fbd03f28c16f170e0b2026b3ca1fcfc87cd96550.jpg', 1496552991, 'enabled', '::1', '7e380d3d0c4755a2e37e245a6aacad6f3ee08646', 'Web developer, YouTuber, Project manager, Android and Linux fan'),
(2, 1, 'admin', 'admin@test.account', '$2y$10$0WSHbKzT6gmUHWBE64FEYuo0kKr5K2DmX/FpFtTcdl2BCBhP9bgCu', 'a882b7771673ce5fb3e89590f578ba17ded8cdc9.png', 1499116526, 'enabled', '::1', 'e65cbad12b0487e271ef175dfe44d2ff05214f4d', 'ligula orci condimentum felis, vel pulvinar purus purus et quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque .'),
(21, 2, 'abbas', 'abbas@gmail.comd', '$2y$10$/iGl0C2wMhynmHlmzhi6aOKl2wOIUq06M49ADQws94xfnWd2mgDLe', '5e6df7aa4c14d2b1ed8998f5be6d50c0c08773a9.png', 1499555837, 'enabled', '::1', '60f095df54eb82fc7bcfbdc21c9ff8c3dbfdabe2', 'I\'m fucking abbas');

-- --------------------------------------------------------

--
-- Table structure for table `ug`
--

CREATE TABLE `ug` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'User-Group-name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Groups' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ug`
--

INSERT INTO `ug` (`id`, `name`) VALUES
(1, 'Admins'),
(2, 'Users'),
(3, 'Another group');

-- --------------------------------------------------------

--
-- Table structure for table `ugp`
--

CREATE TABLE `ugp` (
  `id` int(11) NOT NULL,
  `ugid` int(11) NOT NULL,
  `page` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Group Permissions' ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ugp`
--

INSERT INTO `ugp` (`id`, `ugid`, `page`) VALUES
(212, 3, '/admin/login'),
(213, 2, '/admin/login'),
(214, 2, '/admin/login/submit'),
(262, 1, '/admin/login'),
(263, 1, '/admin/login/submit'),
(264, 1, '/admin'),
(265, 1, '/admin/dashboard'),
(266, 1, '/admin/submit'),
(267, 1, '/admin/users'),
(268, 1, '/admin/users/add'),
(269, 1, '/admin/users/submit'),
(270, 1, '/admin/users/edit/:id'),
(271, 1, '/admin/users/save/:id'),
(272, 1, '/admin/users/delete/:id'),
(273, 1, '/admin/users-groups'),
(274, 1, '/admin/users-groups/add'),
(275, 1, '/admin/users-groups/submit'),
(276, 1, '/admin/users-groups/edit/:id'),
(277, 1, '/admin/users-groups/save/:id'),
(278, 1, '/admin/users-groups/delete/:id'),
(279, 1, '/admin/posts'),
(280, 1, '/admin/posts/add'),
(281, 1, '/admin/posts/submit'),
(282, 1, '/admin/posts/edit/:id'),
(283, 1, '/admin/posts/save/:id'),
(284, 1, '/admin/posts/delete/:id'),
(285, 1, '/admin/comments'),
(286, 1, '/admin/:id/comments/delete'),
(287, 1, '/admin/categories'),
(288, 1, '/admin/categories/add'),
(289, 1, '/admin/categories/submit'),
(290, 1, '/admin/categories/edit/:id'),
(291, 1, '/admin/categories/save/:id'),
(292, 1, '/admin/categories/delete/:id'),
(293, 1, '/admin/settings'),
(294, 1, '/admin/settings/submit'),
(295, 1, '/admin/contact'),
(296, 1, '/admin/contact/reply/:id'),
(297, 1, '/admin/contact/send/:id'),
(298, 1, '/admin/ads'),
(299, 1, '/admin/ads/add'),
(300, 1, '/admin/ads/submit'),
(301, 1, '/admin/ads/edit/:id'),
(302, 1, '/admin/ads/save/:id'),
(303, 1, '/admin/ads/delete/:id'),
(304, 1, '/admin/profile'),
(305, 1, '/admin/profile/submit/:id'),
(306, 1, '/admin/logout');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `u`
--
ALTER TABLE `u`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `ug`
--
ALTER TABLE `ug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ugp`
--
ALTER TABLE `ugp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
