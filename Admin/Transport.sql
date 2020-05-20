-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2018 at 10:36 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `awesome`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(5, 'Business');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(255) NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'img'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(128) NOT NULL,
  `name` varchar(258) NOT NULL,
  `email` varchar(258) NOT NULL,
  `country` varchar(258) NOT NULL,
  `message` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `country`, `message`, `time`) VALUES
(1, 'Victor Gabriel', 'vicky@gmail.com', 'Nigeria', 'Suspendisse ex erat, fringilla eget elementum sit amet, tincidunt eget neque. Suspendisse potenti. Aenean ac accumsan libero, at sollicitudin ante. Proin nec faucibus quam. Integer euismod nunc sed bibendum facilisis. Maecenas quis accumsan odio, sit amet facilisis ante. Maecenas arcu justo, rhoncus sed interdum vitae, congue a est. Etiam consectetur et sapien eget maximus. Proin fringilla metus non tellus maximus, sit amet luctus urna ullamcorper. Proin vitae purus ut sem tempus viverra. Nam faucibus purus nec tellus accumsan, quis accumsan nisl maximus. Sed posuere ultricies risus in suscipit', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `author` int(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `description`, `image`, `author`, `category`, `time`, `view`) VALUES
(3, 'Mobile Rush - (Black Friday)...', 'Donec eu massa in tellus tempus semper. Maecenas quis laoreet neque, vitae dictum arcu. Duis at metus lacus. Quisque vitae tortor efficitur, bibendum leo mollis, varius ipsum. Donec est massa, porta sit amet lacinia eu, dictum blandit enim. Curabitur felis ex, gravida quis porttitor id, sodales sit amet purus. Donec purus libero, volutpat non tristique a, ultrices vitae urna. Aliquam luctus ligula eget velit elementum hendrerit. Nam imperdiet et sem ut efficitur. Vestibulum mi diam, blandit placerat nisi nec, molestie iaculis nibh. Mauris viverra tempor augue, et suscipit ipsum congue a. Donec tempus ligula ac ante euismod bibendum.', 'TLupload_5a29437f5ef0b2.35389783.jpg', 1, 'Business', '2017-12-07 14:34:56', 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `Profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `author`, `email`, `pwd`, `Profile`) VALUES
(1, 'Fernando Gabriel', 'chibuzo.fg@gmail.com', '$2y$10$7XUAdvnLttuLerfm5P/fVu.9YW3A/RfWEJQovg1kkV6rbQIEUdcsu', 'TLupload_5a458b888e5248.71625527.jpg');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `post` ADD FULLTEXT KEY `title` (`title`,`description`);
ALTER TABLE `post` ADD FULLTEXT KEY `title_2` (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
