-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 09:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursework2`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `question_id`, `user_id`, `content`, `created_at`) VALUES
(12, 15, 7, 'sasdas', '2025-04-24 11:51:18'),
(13, 15, NULL, 'asdasd', '2025-04-24 11:51:28'),
(14, 16, 7, 'Woowwwwww', '2025-04-24 11:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `moduleName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `moduleName`) VALUES
(1, 'Math'),
(2, 'Chemical'),
(3, 'Physical'),
(4, 'Poem'),
(6, 'Music');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `module_id`, `title`, `content`, `image`, `created_at`) VALUES
(14, 1, 2, 'Question 1', 'How it\'s going?', 'uploads/cristiano-ronaldo-12430.webp', '2025-04-24 15:01:04'),
(15, 3, 1, 'test123123124141', 'hello how its going', 'uploads/kujira.jpg', '2025-04-24 03:45:11'),
(16, 1, 1, 'test123456993', 'how its going, man', 'uploads/nature.jpg', '2025-04-24 15:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `status` enum('active','disabled') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `role`, `status`) VALUES
(1, 'test', '$2y$10$KOSjZAxotjesCsUGr41aI.6uxT4BJh63E8DyIXD7DSSHoCHDbAvZa', 'test@gmail.com', '2025-03-20 10:08:10', 'admin', 'active'),
(2, 'test2', '$2y$10$mtmAHXztPWhL9yYqZyF0LuLxYSSqg1HeMZca0GcZ0n/52w5CkIp9u', 'test2@gmail.com', '2025-03-31 02:59:13', 'admin', 'active'),
(3, 'test3', '$2y$10$W3dNRrA5DIfYEhLK9BN6nO/WzjoY6HobQ5KomuGqRLWh8L.F4Clv2', 'luunguyentanbao@gmail.com', '2025-04-24 03:44:31', 'user', 'active'),
(4, 'test4', '$2y$10$69EKwzbUjh7rc9xOhU9STOmzYEhrFU2KEU4NTsTcI0oK0lOf6iMRi', 'test@gmail.com', '2025-04-24 05:06:06', 'user', 'active'),
(5, 'test5', '$2y$10$K7kD43zUp169eUbLcW.ROeGe8V5oacxwrch0FAQuq6uG2FtV4//sO', 'luunguyentanbao@gmail.com', '2025-04-24 05:08:50', 'user', 'active'),
(6, 'bao', '$2y$10$PDbjSKUVBl8tNjtSVjxDh.xZ3Kdw8VN3zkMrTOkyF/zLxMM/XlZl2', 'test@gmail.com', '2025-04-24 05:10:53', 'admin', 'active'),
(7, 'bao1', '$2y$10$Jm.EZ7ErDnpsPyz2mPi7Iup47/AOp6zQqLc/fBk7tZO3xVFpkuzuS', 'test3333333@gmail.com', '2025-04-24 11:34:07', 'admin', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_id` (`question_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
