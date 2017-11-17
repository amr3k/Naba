SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `blog`;

DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `img` varchar(64) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `page` varchar(24) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Advertisements' ROW_FORMAT=COMPACT;

TRUNCATE TABLE `ads`;
INSERT INTO `ads` (`id`, `link`, `img`, `start`, `end`, `page`, `status`) VALUES
(4, 'http://www.google.com', '9b3998042cf513576ac445ce3e1a4badc791801f.jpg', 1493589600, 1501538400, '/login', 'enabled'),
(5, 'http://www.facebook.com', 'de5eecafb7aeb1e61c635c042d864931ce94e023.png', 1493589600, 1498773600, '/', 'disabled'),
(6, 'https://duckduckgo.com/?q=spaghitti&amp;t=ffsb&amp;iax=1&amp;ia=images', '3c6bdd88f9e784672aabc3c7cc9cf5a417c268d5.jpg', 1498946400, 1501970400, '/post/:id', 'enabled'),
(7, 'https://us.coca-cola.com/', '9221ea7062f246b486e9fbb797a9716b28b6fb99.jpg', 1497391200, 1507240800, '/category/:text/:id', 'enabled'),
(8, 'http://www.android.com', 'fdcc1e0553cb0478b459b656268a80079676f22c.jpg', 1499292000, 1504648800, '/register', 'enabled'),
(9, 'http://www.linkedin.com', '61b61d35e3b16c2a8c38d69586b452332f5d0ab3.jpg', 1501970400, 1504648800, '/contact', 'enabled'),
(10, 'http://www.linux.org', 'bc8b98cda0bddce60982a53605028450d40316aa.jpg', 1494021600, 1508968800, '/tag/:text', 'enabled'),
(11, 'http://www.bugatti.com/home/', 'efc4461f96f53c555124be523a7ae42a19ddc99f.jpg', 1498946400, 1514415600, '/about', 'enabled'),
(12, 'https://duckduckgo.com', '793139689d9554df2d3a19b58caca2acb2b2aec5.png', 1499378400, 1531087200, '/contact', 'enabled'),
(13, 'https://www.discuvver.com/', '149f1da7ff7cfb3f849fee769e65c0907396c81f.png', 1496959200, 1502229600, '/login', 'enabled'),
(14, 'http://muslims-res.com/', '052e804b31cd4fcd13aac5bb5a7900a705a1ae34.png', 1498687200, 1504044000, '/search', 'enabled'),
(16, 'https://www.youtube.com/c/3Minutes', '35f342aa1ac5ec6a30002b7fc26cfbfcbbbd6b91.png', 1498341600, 1609369200, '/', 'enabled');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL COMMENT 'Parent ID',
  `name` varchar(64) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

TRUNCATE TABLE `categories`;
INSERT INTO `categories` (`id`, `pid`, `name`, `status`) VALUES
(1, 0, 'Sports', 'enabled'),
(15, 0, 'News', 'enabled'),
(16, 0, 'Economy', 'enabled'),
(23, 0, 'Health', 'enabled');

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` int(11) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

TRUNCATE TABLE `comments`;
INSERT INTO `comments` (`id`, `uid`, `post_id`, `comment`, `created`, `status`) VALUES
(9, 2, 5, 'Awesome', 1499486480, 'enabled'),
(10, 2, 5, 'Now photos are visible', 1499486496, 'enabled'),
(13, 2, 14, 'convallis luctus pretium. Quisque tincidunt massa eu nulla consectetur fermentum. Cras imperdiet neque at sem lacinia, et mollis magna faucibus. Donec in ante at elit sodales tempor. Duis consequat eros fermentum', 1499585884, 'enabled'),
(18, 2, 26, 'ante at eros blandit ornare. Vestibulum cursus libero in eros placerat convallis. Integer laoreet, erat eu mattis venenatis, est quam fermentum sem, eget ullamcorper mi purus', 1499690738, 'enabled'),
(20, 2, 26, 'ante at eros blandit ornare. Vestibulum cursus libero in eros placerat convallis. Integer laoreet, erat eu mattis venenatis, est quam fermentum sem, eget ullamcorper mi purus', 1499690743, 'enabled'),
(24, 1, 26, 'scelerisque. Proin lobortis massa at pellentesque imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque neque justo, tempus non urna quis, placerat tempus', 1499720020, 'enabled'),
(25, 1, 28, '&lt;script&gt;alert(1);&lt;/script&gt;', 1499971867, 'enabled'),
(26, 1, 27, 'hi', 1503601732, 'enabled');

DROP TABLE IF EXISTS `contacts`;
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

TRUNCATE TABLE `contacts`;
DROP TABLE IF EXISTS `online`;
CREATE TABLE `online` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `la` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `online`;
DROP TABLE IF EXISTS `posts`;
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

TRUNCATE TABLE `posts`;
INSERT INTO `posts` (`id`, `uid`, `cid`, `title`, `text`, `img`, `tags`, `related_posts`, `views`, `created`, `status`) VALUES
(5, 1, 16, 'First post', '&lt;b&gt;&lt;/b&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tincidunt nibh nibh, ac ultricies dui commodo eget. Proin sed volutpat enim. Nunc ac tellus ut nunc auctor laoreet. Donec accumsan ex in egestas fringilla. Nam non ornare mi. Sed sit amet placerat lorem. Ut lacinia consectetur convallis. Morbi ullamcorper a massa eu sagittis. Nunc convallis luctus pretium.\r\n\r\nQuisque tincidunt massa eu nulla consectetur fermentum. Cras imperdiet neque at sem lacinia, et mollis magna faucibus. Donec in ante at elit sodales tempor. Duis consequat eros fermentum, cursus enim a, consectetur nisl. Proin quam sapien, tristique sit amet tempus vitae, vulputate nec mauris. Proin id felis dapibus, porttitor ante a, mattis nisl. Aliquam erat volutpat. Etiam ac erat nec libero semper venenatis. Morbi egestas lectus vitae tortor sodales rutrum. Ut eget mauris sodales, porttitor leo vitae, faucibus augue. Morbi mattis quam vel rhoncus condimentum. Vivamus maximus euismod nisi, ut dignissim elit pulvinar sed. Donec ultrices mattis vulputate.&lt;b&gt;&lt;/b&gt;', '07f41d195eaed1e8b2849480fa6c8933773a3e84.jpg', 'adasdsad', '', 1506, 1498672526, 'enabled'),
(14, 1, 16, 'dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tincidunt nibh nibh, ac ultricies dui commodo eget. Proin sed volutpat enim. Nunc ac tellus ut nunc auctor laoreet. Donec accumsan ex in egestas fringilla. Nam non ornare mi. Sed sit amet placerat lorem. Ut lacinia consectetur convallis. Morbi ullamcorper a massa eu sagittis. Nunc convallis luctus pretium.\r\n\r\nQuisque tincidunt massa eu nulla consectetur fermentum. Cras imperdiet neque at sem lacinia, et mollis magna faucibus. Donec in ante at elit sodales tempor. Duis consequat eros fermentum, cursus enim a, consectetur nisl. Proin quam sapien, tristique sit amet tempus vitae, vulputate nec mauris. Proin id felis dapibus, porttitor ante a, mattis nisl. Aliquam erat volutpat. Etiam ac erat nec libero semper venenatis. Morbi egestas lectus vitae tortor sodales rutrum. Ut eget mauris sodales, porttitor leo vitae, faucibus augue. Morbi mattis quam vel rhoncus condimentum. Vivamus maximus euismod nisi, ut dignissim elit pulvinar sed. Donec ultrices mattis vulputate.', '37458a19943d6bfb1e71f29c2771d499a6fb3526.jpg', 'abc', '', 18, 1498713138, 'enabled'),
(25, 2, 23, 'Cras semper', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu tempor nisl, vel sodales velit. Ut sodales eros eu ex interdum, nec dapibus nulla accumsan. Nullam vel tristique neque. Donec gravida, mauris nec rhoncus lobortis, sapien turpis pharetra sem, quis tempus odio neque vitae justo. Phasellus nibh diam, viverra nec suscipit vel, viverra iaculis dui. Nulla laoreet, tortor non sollicitudin tincidunt, mauris magna faucibus massa, vel suscipit metus nulla sed urna. Aenean dictum molestie ullamcorper. Phasellus scelerisque ultricies elit ut ultrices. Etiam auctor odio dolor, at placerat felis mollis blandit. In pharetra metus ac efficitur consectetur.\r\n\r\nSed ut orci sed ante tempus fermentum in id elit. Vestibulum a sem in felis ullamcorper consequat. Donec id placerat sem. Cras semper, mi ac suscipit lacinia, libero purus aliquet est, et laoreet neque diam venenatis tortor. Sed consectetur metus neque, et rutrum libero interdum ut. Aliquam a aliquet ligula, a vulputate odio. Donec luctus, tellus ac pretium feugiat, velit nisl dignissim quam, sit amet venenatis mauris erat eget odio. Sed erat purus, placerat eu posuere quis, hendrerit ut ipsum. Suspendisse rhoncus congue lacus, nec sollicitudin sem. Sed faucibus, metus quis iaculis accumsan, ligula orci condimentum felis, vel pulvinar purus purus et quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque finibus tellus varius hendrerit facilisis. Sed fringilla rhoncus faucibus. Ut at eros porta, condimentum lectus eget, maximus dui.\r\n\r\nMorbi bibendum congue mauris in bibendum. Ut condimentum, arcu non gravida elementum, augue orci malesuada libero, at ornare leo nisl ut risus. Curabitur id libero enim. Mauris eget ante at eros blandit ornare. Vestibulum cursus libero in eros placerat convallis. Integer laoreet, erat eu mattis venenatis, est quam fermentum sem, eget ullamcorper mi purus quis urna. Ut neque urna, accumsan sed nisl vel, malesuada feugiat lacus. Praesent ut ipsum a nisi euismod scelerisque. Proin lobortis massa at pellentesque imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque neque justo, tempus non urna quis, placerat tempus neque. Maecenas consequat consectetur eros eu auctor. Ut ultricies interdum placerat. Proin et risus et sapien dictum vehicula vitae sit amet velit. Fusce risus lectus, pulvinar vitae molestie ac, pharetra vel nunc. Proin id viverra libero.\r\n\r\nInteger consequat euismod tellus, ac dictum dolor consequat cursus. Phasellus quis viverra magna. Quisque vel accumsan sem. Sed eleifend neque id velit ultrices feugiat. Mauris et lorem ligula. Praesent ex nisi, vulputate et velit eget, gravida convallis augue. Nam non augue et turpis pharetra mollis. In hac habitasse platea dictumst. Pellentesque dignissim placerat orci id aliquet. Integer auctor semper elit facilisis malesuada. Maecenas venenatis, neque ut tincidunt dapibus, eros sapien rhoncus diam, tempus condimentum sapien ipsum aliquam massa. Proin et vestibulum diam. Proin non urna nunc. Mauris consequat neque massa, ut aliquet mauris tempor nec. Phasellus tristique, libero at dignissim ornare, sapien sapien porttitor orci, non sodales orci velit eget ante.\r\n\r\nPraesent imperdiet metus sit amet nunc posuere, vel suscipit nulla sodales. Sed lectus leo, rhoncus vel orci sit amet, interdum luctus mauris. Sed sit amet vestibulum dolor, id fermentum metus. Vestibulum congue suscipit justo. Etiam hendrerit hendrerit finibus. Cras bibendum accumsan odio nec placerat. Cras malesuada posuere magna, eu aliquam leo dignissim non. Nullam a quam lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean sit amet tellus ac massa placerat facilisis. In imperdiet quis tortor eget tristique. Proin ornare eros eu sem aliquam sollicitudin. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse commodo odio at magna tempor, volutpat suscipit elit interdum.', '30f68e73c7354f1a04f41d7b84089f7b36f814a1.jpg', 'article', '', 344, 1499621017, 'enabled'),
(26, 2, 1, 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu tempor nisl, vel sodales velit. Ut sodales eros eu ex interdum, nec dapibus nulla accumsan. Nullam vel tristique neque. Donec gravida, mauris nec rhoncus lobortis, sapien turpis pharetra sem, quis tempus odio neque vitae justo. Phasellus nibh diam, viverra nec suscipit vel, viverra iaculis dui. Nulla laoreet, tortor non sollicitudin tincidunt, mauris magna faucibus massa, vel suscipit metus nulla sed urna. Aenean dictum molestie ullamcorper. Phasellus scelerisque ultricies elit ut ultrices. Etiam auctor odio dolor, at placerat felis mollis blandit. In pharetra metus ac efficitur consectetur.\r\n\r\nSed ut orci sed ante tempus fermentum in id elit. Vestibulum a sem in felis ullamcorper consequat. Donec id placerat sem. Cras semper, mi ac suscipit lacinia, libero purus aliquet est, et laoreet neque diam venenatis tortor. Sed consectetur metus neque, et rutrum libero interdum ut. Aliquam a aliquet ligula, a vulputate odio. Donec luctus, tellus ac pretium feugiat, velit nisl dignissim quam, sit amet venenatis mauris erat eget odio. Sed erat purus, placerat eu posuere quis, hendrerit ut ipsum. Suspendisse rhoncus congue lacus, nec sollicitudin sem. Sed faucibus, metus quis iaculis accumsan, ligula orci condimentum felis, vel pulvinar purus purus et quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque finibus tellus varius hendrerit facilisis. Sed fringilla rhoncus faucibus. Ut at eros porta, condimentum lectus eget, maximus dui.\r\n\r\nMorbi bibendum congue mauris in bibendum. Ut condimentum, arcu non gravida elementum, augue orci malesuada libero, at ornare leo nisl ut risus. Curabitur id libero enim. Mauris eget ante at eros blandit ornare. Vestibulum cursus libero in eros placerat convallis. Integer laoreet, erat eu mattis venenatis, est quam fermentum sem, eget ullamcorper mi purus quis urna. Ut neque urna, accumsan sed nisl vel, malesuada feugiat lacus. Praesent ut ipsum a nisi euismod scelerisque. Proin lobortis massa at pellentesque imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque neque justo, tempus non urna quis, placerat tempus neque. Maecenas consequat consectetur eros eu auctor. Ut ultricies interdum placerat. Proin et risus et sapien dictum vehicula vitae sit amet velit. Fusce risus lectus, pulvinar vitae molestie ac, pharetra vel nunc. Proin id viverra libero.\r\n\r\nInteger consequat euismod tellus, ac dictum dolor consequat cursus. Phasellus quis viverra magna. Quisque vel accumsan sem. Sed eleifend neque id velit ultrices feugiat. Mauris et lorem ligula. Praesent ex nisi, vulputate et velit eget, gravida convallis augue. Nam non augue et turpis pharetra mollis. In hac habitasse platea dictumst. Pellentesque dignissim placerat orci id aliquet. Integer auctor semper elit facilisis malesuada. Maecenas venenatis, neque ut tincidunt dapibus, eros sapien rhoncus diam, tempus condimentum sapien ipsum aliquam massa. Proin et vestibulum diam. Proin non urna nunc. Mauris consequat neque massa, ut aliquet mauris tempor nec. Phasellus tristique, libero at dignissim ornare, sapien sapien porttitor orci, non sodales orci velit eget ante.\r\n\r\nPraesent imperdiet metus sit amet nunc posuere, vel suscipit nulla sodales. Sed lectus leo, rhoncus vel orci sit amet, interdum luctus mauris. Sed sit amet vestibulum dolor, id fermentum metus. Vestibulum congue suscipit justo. Etiam hendrerit hendrerit finibus. Cras bibendum accumsan odio nec placerat. Cras malesuada posuere magna, eu aliquam leo dignissim non. Nullam a quam lectus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean sit amet tellus ac massa placerat facilisis. In imperdiet quis tortor eget tristique. Proin ornare eros eu sem aliquam sollicitudin. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse commodo odio at magna tempor, volutpat suscipit elit interdum.', '9675afb7b05bafed1f50e1261ce5d4ac1b81cc3b.jpg', 'title,text,lorem', '', 87, 1499621892, 'enabled'),
(27, 1, 15, 'Vestibulum in risus nec lorem', '&lt;p&gt;&lt;/p&gt;&lt;p&gt;\r\nIn vehicula, lorem vitae vulputate vestibulum, est felis porttitor nisl,\r\n quis volutpat lacus urna et metus. Aenean faucibus nibh sed lorem \r\naliquet, in porttitor dolor finibus. Nulla placerat lorem quis molestie \r\nfringilla. Suspendisse faucibus auctor nibh, vitae pharetra eros tempor \r\nin. Etiam tincidunt lorem in magna sagittis, non tristique elit commodo.\r\n Suspendisse semper tellus eu elit efficitur elementum. In hac habitasse\r\n platea dictumst. Phasellus faucibus dignissim lectus vel lobortis. \r\nNullam finibus finibus volutpat. Morbi eget elementum neque. Nam \r\ndignissim quam ut aliquam egestas. Quisque congue, mi quis tristique \r\neleifend, ligula magna sagittis justo, malesuada congue enim velit id \r\neros.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nUt laoreet, eros et laoreet fringilla, purus justo feugiat sapien, id \r\nimperdiet urna metus eu nisl. Ut eget rutrum felis, quis volutpat \r\ntortor. Suspendisse iaculis tempus mi, non ultrices justo elementum vel.\r\n Vestibulum ante ipsum primis in faucibus orci luctus et ultrices \r\nposuere cubilia Curae; In sit amet ante maximus, mattis eros a, sodales \r\nenim. Praesent metus metus, tincidunt in consectetur in, commodo non \r\nurna. Quisque dictum velit vitae enim vestibulum gravida. Fusce \r\nfermentum viverra feugiat. Maecenas euismod rutrum tellus.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nSed diam ante, pharetra eget feugiat ut, eleifend eu lorem. Phasellus \r\neuismod, magna a viverra lacinia, magna risus euismod nisl, ut malesuada\r\n quam mi eleifend nisl. Duis consectetur laoreet neque, non eleifend est\r\n consequat id. Vestibulum molestie blandit mi ac eleifend. Cras eu arcu \r\nnec eros semper iaculis non ac tellus. Vestibulum in risus nec lorem \r\nullamcorper semper. Cras sit amet velit non tortor eleifend imperdiet. \r\nNullam eleifend rutrum eros, vel sodales sapien viverra vel. Cras \r\nconvallis eleifend nibh sit amet luctus. Pellentesque habitant morbi \r\ntristique senectus et netus et malesuada fames ac turpis egestas. \r\nPraesent luctus tincidunt quam, ac elementum diam.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nSed id quam tempus, hendrerit augue et, tincidunt metus. Curabitur \r\nornare accumsan pretium. Nam vulputate, ex sagittis elementum \r\nsollicitudin, tellus orci rutrum mauris, nec convallis urna eros eget \r\nnibh. Duis gravida gravida ligula eget cursus. Duis in volutpat turpis. \r\nNullam dolor turpis, dictum at massa in, ornare sollicitudin orci. \r\nQuisque vitae pellentesque ante. Duis rhoncus vulputate nisl, non \r\nfaucibus enim hendrerit vitae. Mauris nibh nulla, pellentesque tristique\r\n erat a, imperdiet dictum eros. Morbi mattis molestie egestas. Nunc \r\nsagittis leo non tempus sagittis. Integer quis tristique ipsum. Integer \r\njusto leo, viverra at turpis et, ultrices mollis massa. Suspendisse \r\nmagna ex, tincidunt id imperdiet et, consectetur eget odio. Aliquam \r\ndolor enim, convallis nec nibh non, lacinia consectetur nisi. In mauris \r\nenim, vestibulum sit amet neque sed, fringilla vulputate enim.\r\n&lt;/p&gt;&lt;br&gt;&lt;p&gt;&lt;/p&gt;', 'b9cbb0f4b6acfd5527ee7ac0f64c04615ac151ce.jpg', 'lorem', '', 25, 1499731709, 'enabled'),
(28, 1, 1, 'Aenean faucibus', '&lt;p&gt;&lt;/p&gt;&lt;h1&gt;\r\nIn vehicula, lorem vitae vulputate vestibulum, est felis porttitor nisl,\r\n quis volutpat lacus urna et metus.&lt;/h1&gt;&lt;p&gt; Aenean faucibus nibh sed lorem \r\naliquet, in porttitor dolor finibus. Nulla placerat lorem quis molestie \r\n&lt;b&gt;fringilla&lt;/b&gt;. Suspendisse faucibus auctor nibh, vitae pharetra eros tempor \r\nin. Etiam tincidunt lorem in magna sagittis, non tristique elit commodo.\r\n Suspendisse semper tellus eu elit efficitur elementum. In hac habitasse\r\n platea dictumst. Phasellus faucibus dignissim &lt;i&gt;lectus vel lobortis. \r\nNullam&lt;/i&gt; &lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;small&gt;finibus finibus volutpat.&lt;/small&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt; Morbi eget elementum neque. &lt;br&gt;&lt;/li&gt;&lt;/ul&gt;&lt;ol&gt;&lt;li&gt;Nam \r\ndignissim quam ut aliquam egestas. &lt;br&gt;&lt;/li&gt;&lt;/ol&gt;&lt;blockquote&gt;&lt;blockquote&gt;&lt;p&gt;Quisque congue, mi quis tristique \r\neleifend, &lt;br&gt;&lt;/p&gt;&lt;/blockquote&gt;&lt;/blockquote&gt;&lt;p&gt;&lt;/p&gt;&lt;blockquote&gt;ligula magna sagittis justo,&lt;/blockquote&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt; &lt;/b&gt;&lt;u&gt;&lt;b&gt;malesuada congue enim velit id \r\neros&lt;/b&gt;&lt;/u&gt;&lt;b&gt;.\r\n&lt;/b&gt;&lt;/p&gt;&amp;nbsp;&lt;br&gt;&lt;br&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;alert(0);&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;br&gt;&lt;p&gt;&lt;/p&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;', '56bc8d775c298d9cfe5995fef673e6135a785b0c.png', 'aenean,nibh,sed', '', 65, 1499731763, 'enabled'),
(30, 1, 23, 'Aenean eget varius tellus', '&lt;p&gt;&lt;/p&gt;&lt;h1&gt;Lorem&lt;br&gt;&lt;/h1&gt;&lt;p&gt;\r\nMorbi quis orci tempus, placerat urna a, molestie elit. Sed quis justo \r\ntincidunt, eleifend urna nec, convallis nunc. Duis viverra est \r\nfacilisis, viverra augue id, lacinia lacus. Donec ullamcorper, nisi a \r\nornare maximus, arcu orci gravida nibh, at tincidunt tortor ligula sed \r\nvelit. Cras egestas nulla ac blandit aliquam. Interdum et malesuada \r\nfames ac ante ipsum primis in faucibus. Nullam rhoncus libero eu neque \r\ncondimentum, a molestie nibh euismod. Donec ac mauris neque. Curabitur \r\nconsectetur, nunc eu scelerisque auctor, est sem dictum libero, \r\nfringilla consequat quam tellus nec felis.\r\n&lt;/p&gt;&lt;br&gt;&lt;p&gt;&lt;/p&gt;', 'cf097bffeb725907c5a31e7256180c279bd50b89.jpg', 'libero', '', 0, 1503610131, 'enabled');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `k` varchar(255) NOT NULL,
  `v` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

TRUNCATE TABLE `settings`;
INSERT INTO `settings` (`id`, `k`, `v`) VALUES
(1, 'name', 'AE-AdvBlog'),
(2, 'email', 'info@aeadvblog.com'),
(3, 'status', 'on'),
(4, 'msg', '&lt;b&gt;Site is under maintenance, Please try reloading this page later .&lt;/b&gt;&lt;h2&gt;&lt;b&gt;&lt;/b&gt;Thanks in adva&lt;b&gt;&lt;/b&gt;&lt;b&gt;&lt;/b&gt;&lt;b&gt;&lt;/b&gt;nce ..&lt;b&gt;&lt;/b&gt;&lt;/h2&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;'),
(5, 'contact', '&lt;h3&gt;Hello&lt;/h3&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;\r\nNunc rutrum efficitur odio in sagittis. Etiam molestie purus eget urna \r\ngravida, non bibendum libero pretium. Cras in feugiat eros. Morbi quis \r\nlectus justo. Morbi viverra urna a euismod aliquet. Cras a arcu dui. \r\nVestibulum mattis mattis elit ut hendrerit. Nam sit amet nibh venenatis,\r\n faucibus nunc at, sagittis odio. Cras tincidunt, justo venenatis \r\nfaucibus mattis, ligula eros iaculis mi, ut ornare metus massa ut magna.\r\n Mauris sodales malesuada molestie. Maecenas eget luctus nisl, ut dictum\r\n erat. Fusce maximus rhoncus enim in facilisis.\r\n&lt;/p&gt;&lt;p&gt;&lt;/p&gt;'),
(6, 'about', '&lt;p&gt;&lt;/p&gt;&lt;p&gt;\r\n&lt;b&gt;Donec&lt;/b&gt; pellentesque odio ac dolor semper, rhoncus finibus orci congue. In\r\n iaculis orci ac erat hendrerit luctus. Aenean venenatis bibendum nulla \r\nnon placerat. Sed hendrerit, elit eget ullamcorper tempor, diam mauris \r\nsuscipit massa, non laoreet orci tellus vel purus. &lt;i&gt;Donec sollicitudin ac\r\n ligula vitae finibus&lt;/i&gt;. Quisque faucibus nisi eros, a consectetur lectus \r\nsuscipit eget. Phasellus placerat lacinia ex vitae interdum. Integer \r\nfinibus lacinia turpis, eu mollis ex. Nunc eleifend augue tortor, vel \r\ntincidunt velit elementum tincidunt. Integer eu vestibulum metus. Etiam \r\neleifend augue in volutpat suscipit. Fusce finibus dui et ipsum blandit,\r\n eu dictum metus ultricies. Nulla nec dolor lorem. Aliquam facilisis \r\ndictum dui, &lt;u&gt;in efficitur mauris vehicula eu&lt;/u&gt;. Integer euismod, lorem eget\r\n pellentesque lacinia, tortor velit sodales risus, quis gravida ligula \r\narcu vitae ipsum. Proin at pulvinar nunc.\r\n&lt;/p&gt;\r\n&lt;p&gt;&lt;small&gt;\r\nNunc rutrum efficitur odio in sagittis. Etiam molestie purus eget urna \r\ngravida, non bibendum libero pretium. Cras in feugiat eros. Morbi quis \r\nlectus justo. Morbi viverra urna a euismod aliquet. Cras a arcu dui. \r\nVestibulum mattis mattis elit ut hendrerit. Nam sit amet nibh venenatis,\r\n faucibus nunc at, sagittis odio. Cras tincidunt, justo venenatis \r\nfaucibus mattis, ligula eros iaculis mi, ut ornare metus massa ut magna.\r\n Mauris sodales malesuada molestie. Maecenas eget luctus nisl, ut dictum\r\n erat. Fusce maximus rhoncus enim in facilisis. &lt;br&gt;&lt;/small&gt;&lt;/p&gt;&lt;p&gt;&lt;small&gt;&lt;/small&gt;&lt;/p&gt;&lt;blockquote&gt;&lt;small&gt;I\'m happy to see you here&lt;/small&gt;&lt;/blockquote&gt;&lt;p&gt;&lt;/p&gt;\r\n&lt;p&gt;\r\nDuis sed mi hendrerit, hendrerit purus in, ullamcorper orci. Nullam quis\r\n sapien vel eros consequat vestibulum ut quis sapien. In nec diam quis \r\narcu volutpat tincidunt a a mauris. Phasellus arcu turpis, malesuada in \r\nporttitor et, maximus at nisl. Nulla semper tincidunt efficitur. Aenean \r\neuismod sollicitudin ornare. Sed pellentesque elit in ligula vestibulum,\r\n sit amet viverra sem ornare. Sed iaculis turpis vel arcu mattis \r\nvolutpat. Maecenas sollicitudin nunc vel volutpat dignissim. Fusce a \r\nquam velit. Curabitur id magna mi. Nam consequat, nisi ut tincidunt \r\nullamcorper, ex est scelerisque velit, faucibus viverra nibh massa vitae\r\n ex. Nam ipsum enim, consectetur ut nisl id, ullamcorper &lt;a target=&quot;_blank&quot; rel=&quot;nofollow&quot; href=&quot;https://github.com/akkk33/AE-AdvBlog&quot;&gt;vulputate eros&lt;/a&gt;. &lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;'),
(7, 'facebook', 'https://www.facebook.com/amrelkhenany'),
(8, 'icon', 'icon.png'),
(9, 'twitter', 'https://twitter.com/___A_M_R___'),
(10, 'instagram', 'https://www.instagram.com/amrelkhenany');

DROP TABLE IF EXISTS `u`;
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

TRUNCATE TABLE `u`;
INSERT INTO `u` (`id`, `ugid`, `name`, `email`, `pass`, `img`, `created`, `status`, `ip`, `code`, `bio`) VALUES
(1, 1, 'amr', 'akkk33@protonmail.com', '$2y$10$aWTiX/Mg/8gpj8l4KiDkv.mf7JSuvKZhObGswlkOT.xuNgzb4T7C2', 'ec100553f3d96506bace65cd9d0970813692ac65.jpg', 1496552991, 'enabled', '::1', '7e380d3d0c4755a2e37e245a6aacad6f3ee08646', 'Web developer, YouTuber, Project manager, Android and Linux fan'),
(2, 1, 'admin', 'admin@test.account', '$2y$10$0WSHbKzT6gmUHWBE64FEYuo0kKr5K2DmX/FpFtTcdl2BCBhP9bgCu', 'a7c298f54a05d336f1adcbce9bce1e49c06fa6df.jpg', 1499116526, 'enabled', '::1', 'e65cbad12b0487e271ef175dfe44d2ff05214f4d', 'ligula orci condimentum felis, vel pulvinar purus purus et quam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque .'),
(21, 2, 'abbas', 'abbas@gmail.comd', '$2y$10$/iGl0C2wMhynmHlmzhi6aOKl2wOIUq06M49ADQws94xfnWd2mgDLe', '5e6df7aa4c14d2b1ed8998f5be6d50c0c08773a9.png', 1499555837, 'disabled', '::1', '60f095df54eb82fc7bcfbdc21c9ff8c3dbfdabe2', 'I\'m fucking abbas');

DROP TABLE IF EXISTS `ug`;
CREATE TABLE `ug` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'User-Group-name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Groups' ROW_FORMAT=COMPACT;

TRUNCATE TABLE `ug`;
INSERT INTO `ug` (`id`, `name`) VALUES
(1, 'Admins'),
(2, 'Users');

DROP TABLE IF EXISTS `ugp`;
CREATE TABLE `ugp` (
  `id` int(11) NOT NULL,
  `ugid` int(11) NOT NULL,
  `page` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Group Permissions' ROW_FORMAT=COMPACT;

TRUNCATE TABLE `ugp`;
INSERT INTO `ugp` (`id`, `ugid`, `page`) VALUES
(213, 2, '/admin/login'),
(214, 2, '/admin/login/submit'),
(352, 1, '/admin/login'),
(353, 1, '/admin/login/submit'),
(354, 1, '/admin'),
(355, 1, '/admin/dashboard'),
(356, 1, '/admin/submit'),
(357, 1, '/admin/users'),
(358, 1, '/admin/users/add'),
(359, 1, '/admin/users/submit'),
(360, 1, '/admin/users/edit/:id'),
(361, 1, '/admin/users/save/:id'),
(362, 1, '/admin/users/delete/:id'),
(363, 1, '/admin/users-groups'),
(364, 1, '/admin/users-groups/add'),
(365, 1, '/admin/users-groups/submit'),
(366, 1, '/admin/users-groups/edit/:id'),
(367, 1, '/admin/users-groups/save/:id'),
(368, 1, '/admin/users-groups/delete/:id'),
(369, 1, '/admin/posts'),
(370, 1, '/admin/posts/add'),
(371, 1, '/admin/posts/submit'),
(372, 1, '/admin/posts/edit/:id'),
(373, 1, '/admin/posts/save/:id'),
(374, 1, '/admin/posts/delete/:id'),
(375, 1, '/admin/comments'),
(376, 1, '/admin/:id/comments/delete'),
(377, 1, '/admin/categories'),
(378, 1, '/admin/categories/add'),
(379, 1, '/admin/categories/submit'),
(380, 1, '/admin/categories/edit/:id'),
(381, 1, '/admin/categories/save/:id'),
(382, 1, '/admin/categories/delete/:id'),
(383, 1, '/admin/settings'),
(384, 1, '/admin/settings/submit'),
(385, 1, '/admin/contact'),
(386, 1, '/admin/contact/reply/:id'),
(387, 1, '/admin/contact/send/:id'),
(388, 1, '/admin/ads'),
(389, 1, '/admin/ads/add'),
(390, 1, '/admin/ads/submit'),
(391, 1, '/admin/ads/edit/:id'),
(392, 1, '/admin/ads/save/:id'),
(393, 1, '/admin/ads/delete/:id'),
(394, 1, '/admin/profile'),
(395, 1, '/admin/profile/submit/:id'),
(396, 1, '/admin/logout');


ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `online`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `u`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ug`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ugp`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
ALTER TABLE `u`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
ALTER TABLE `ug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `ugp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=397;COMMIT;
