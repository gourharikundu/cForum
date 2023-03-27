-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2023 at 04:12 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(8) NOT NULL,
  `cat_title` varchar(30) NOT NULL,
  `cat_description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`, `cat_description`, `date`) VALUES
(1, 'Python', 'Python is a high-level, general-purpose programming language. Its design philosophy emphasizes code readability with the use of significant indentation. Python is dynamically-typed and garbage-collected. It supports multiple programming paradigms, including structured, object-oriented and functional programming.', '2022-10-22 12:35:30'),
(2, 'JavaScript', 'JavaScript, often abbreviated as JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS. As of 2022, 98% of websites use JavaScript on the client side for webpage behavior, often incorporating third-party libraries.', '2022-10-22 12:35:52'),
(3, 'Django', 'Django is a free and open-source, Python-based web framework that follows the model–template–views architectural pattern. It is maintained by the Django Software Foundation, an independent organization established in the US as a 501 non-profit.', '2022-10-22 12:36:10'),
(4, 'Flask', 'Flask is a micro web framework written in Python. It is classified as a microframework because it does not require particular tools or libraries. It has no database abstraction layer, form validation, or any other components where pre-existing third-party libraries provide common functions. ', '2022-10-22 12:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(8) NOT NULL,
  `comment` text NOT NULL,
  `thread_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment`, `thread_id`, `user_id`, `date`) VALUES
(1, 'Try to reinstalling python or updating pip', 1, 2, '2022-10-22 18:52:06'),
(2, 'Try updating the pip or reinstalling the python', 2, 1, '2022-10-22 19:11:39'),
(3, 'install the latest version of pip', 1, 4, '2022-10-22 19:13:25'),
(4, 'Install the latest version of pip', 2, 1, '2022-10-22 19:14:14'),
(5, 'Simply try reinstalling the django framework and that will probably fix the error you are having.', 3, 2, '2022-10-23 11:30:26'),
(6, 'Uninstall python and then install latest version of python, and that will probably fix the error', 1, 3, '2022-10-23 11:31:55'),
(7, 'open cmd and type pip install --upgrade pip and press enter', 7, 2, '2022-10-23 12:16:54'),
(8, 'open cmd and type pip install --upgrade', 7, 1, '2022-10-23 12:19:47'),
(9, 'open cmd and type pip install --upgrade pip and press enter', 7, 3, '2022-10-23 12:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `thread_id` int(8) NOT NULL,
  `thread_title` varchar(30) NOT NULL,
  `thread_description` text NOT NULL,
  `cat_id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`thread_id`, `thread_title`, `thread_description`, `cat_id`, `user_id`, `date`) VALUES
(1, 'pyaudio is not installing', 'pyaudio module is not installing on my windows(x64). Kindly someone help me fixing it.', 1, 1, '2022-10-22 14:16:15'),
(2, 'pip not working', 'pip command is not working in my windows(x64) pc. Kindly someone help me fixing it.', 1, 2, '2022-10-22 14:17:03'),
(3, 'django is not installing', 'There is some problem while installing the django framework. Kindly help me to figure it out', 3, 3, '2022-10-22 18:40:35'),
(4, 'Flask is not installing', 'There is some problem while installing the flaskframework. Kindly help me to figure it out', 4, 1, '2022-10-22 18:42:54'),
(5, 'React is not installing on my ', 'I have installed react framework but it is now working on my pc. Someone help me', 2, 3, '2022-10-22 18:46:41'),
(6, 'React is nor working', 'I have installed react framework but it is now working on my pc. Someone help me', 2, 1, '2022-10-22 18:47:36'),
(7, 'how to update pip', 'I am not able to update the pip. How to update it? Please help me.\r\n', 1, 4, '2022-10-23 12:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(8) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `date`) VALUES
(1, 'Rakesh', '$2y$10$3XuIPXKTWy2GH5MpYj6J7.v0sHO6XDfwG.7b1afjs04utMfV67Vue', '2022-10-22 19:40:24'),
(2, 'Gourhari', '$2y$10$GOjR/8lw/rS6Cy3LApUi9.ES5uXRXtYmp3GYrarigre1T0/OA4n3O', '2022-10-22 20:05:19'),
(3, 'Rohit', '$2y$10$IEsBNcmdWtAIZrdrxVrZ3ORYN3StZ0BKp7jXvHhWQwYgEM1MHmV.O', '2022-10-22 20:06:09'),
(4, 'Rahul', '$2y$10$87lF.sBbV6yCCfCI6W2fFO8P2QXG2wVwb4d.fleRGDuh/65idy2g2', '2022-10-23 12:46:25'),
(5, 'Rakesh220', '$2y$10$sXkVENbBjGCyjZAsIvb8lumNz2OPETV6pU5bbUBKpBbjnf1KxG01S', '2023-03-27 19:40:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`thread_id`);
ALTER TABLE `thread` ADD FULLTEXT KEY `thread_title` (`thread_title`,`thread_description`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `thread_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
