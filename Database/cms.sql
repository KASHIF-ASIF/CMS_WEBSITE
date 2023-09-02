-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 08:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `date_of_upload` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `author`, `text`, `image_path`, `date_of_upload`, `title`, `category`) VALUES
(2, 'ADMIN', 'In the vast world of science, there are countless mysteries waiting to be unraveled. From the smallest particles to the grandest galaxies, nature presents us with an awe-inspiring array of phenomena. Join us on a journey through the cosmos, where we\'ll delve into the mysteries of black holes, supernovae, and the fundamental forces that shape our universe.', '64f33d734120c.jpg', '2023-09-02 15:49:39', 'Exploring the Wonders of Nature', 'Science'),
(3, 'ADMIN', ' Food is not just sustenance; it\'s an art form. From the delicate flavors of French cuisine to the fiery spices of Indian dishes, culinary traditions from around the world offer a sensory experience like no other. In this post, we\'ll explore the rich tapestry of global cuisine, from street food to haute cuisine, and discover the stories behind each delectable dish.', '64f33da1dcbfd.jpeg', '2023-09-02 15:50:25', 'The Art of Culinary Excellence', 'Food'),
(4, 'ADMIN', ' In a fast-paced world filled with distractions, finding inner peace and mental clarity is a universal aspiration. Mindfulness meditation has emerged as a powerful practice to achieve just that. Join us on a journey to explore the benefits of mindfulness, learn how to incorporate it into your daily life, and discover the science behind its transformative effects on the mind and body.', '64f33de4f2b95.png', '2023-09-02 15:51:32', 'The Power of Mindfulness Meditation', 'Health and Wellness'),
(5, 'ADMIN', 'Adventure beckons to those who seek excitement beyond the ordinary. From scaling towering peaks to diving into the depths of the ocean, adventure travel offers an adrenaline rush like no other. In this post, we\'ll take you on a virtual expedition to the world\'s most thrilling destinations, where you can embark on heart-pounding adventures and create unforgettable memories.', '64f33e2988239.jpg', '2023-09-02 15:52:41', 'The Thrills and Chills of Adventure Travel', 'Travel'),
(6, 'ADMIN', 'The digital age has transformed every aspect of our lives, from how we work and communicate to how we entertain ourselves. In this post, we\'ll dive into the ever-evolving world of technology, exploring the latest innovations, trends, and challenges. From artificial intelligence to blockchain, we\'ll unravel the complexities of the digital landscape and its impact on society.', '64f33e675275e.jpg', '2023-09-02 15:53:43', 'Navigating the Digital Landscape', 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `allow` varchar(5) DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `allow`) VALUES
(1, 'ADMIN', 'admin@admin.com', 'admin', 'yes'),
(2, 'KASHIF', 'kashif@mail.com', 'kashifasif', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
