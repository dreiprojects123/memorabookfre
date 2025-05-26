-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 07:08 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnus_bio`
--

CREATE TABLE `alumnus_bio` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `batch_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `email` varchar(250) NOT NULL,
  `connected_to` text NOT NULL,
  `avatar` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= Unverified, 1= Verified',
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumnus_bio`
--

INSERT INTO `alumnus_bio` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `batch_id`, `course_id`, `email`, `connected_to`, `avatar`, `status`, `date_created`) VALUES
(9, 'Anton', 'M.', 'Macatangay', 'Male', 5, 6, 'antonmacatangay@gmail.com', 'DYCI', '1748234280_Screenshot 2025-05-26 122705.png', 1, '2025-05-26'),
(10, 'Justin Mark', 'F.', 'Padilla', 'Male', 5, 1, 'justinpadilla@gmail.com', 'DYCI', '1748234640_Screenshot 2025-05-26 124127.png', 1, '2025-05-26'),
(11, 'Andrei', 'M.', 'Cruz', 'Male', 5, 1, 'andreicruz@gmail.com', 'DYCI', '1748234700_Screenshot 2025-05-26 124529.png', 1, '2025-05-26'),
(12, 'Stephen Ivan', 'F.', 'Santiago', 'Male', 5, 1, 'stephenivan@gmail.com', 'DYCI', '1748234760_Screenshot 2025-05-26 124614.png', 1, '2025-05-26'),
(13, 'Dharrell', 'Andrei', 'Montion', 'Male', 5, 1, 'dharrel@gmail.com', 'DYCI', '1748234820_Screenshot 2025-05-26 124728.png', 1, '2025-05-26'),
(14, 'Ryan', 'F.', 'Fadrigalan', 'Male', 5, 1, 'ryanfadrigalan@gmail.com', 'DYCI', '1748234880_Screenshot 2025-05-26 124829.png', 1, '2025-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(30) NOT NULL,
  `year` year(4) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `year`, `created`) VALUES
(1, 2021, '2025-05-07 10:57:12'),
(2, 2022, '2025-05-21 17:50:59'),
(3, 2023, '2025-05-21 17:50:59'),
(4, 2024, '2025-05-21 17:52:18'),
(5, 2025, '2025-05-21 17:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` int(30) NOT NULL,
  `company` varchar(250) NOT NULL,
  `location` text NOT NULL,
  `job_title` text NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `company`, `location`, `job_title`, `description`, `user_id`, `date_created`) VALUES
(1, 'IT Company', 'Home-Based', 'Web Developer', '&lt;p style=&quot;-webkit-tap-highlight-color: rgba(0, 0, 0, 0); margin-top: 1.5em; margin-bottom: 1.5em; line-height: 1.5; animation: 1000ms linear 0s 1 normal none running fadeInLorem;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sagittis eu volutpat odio facilisis mauris sit amet massa vitae. In tellus integer feugiat scelerisque varius morbi enim. Orci eu lobortis elementum nibh tellus molestie nunc. Vulputate ut pharetra sit amet aliquam id diam maecenas ultricies. Lacus sed viverra tellus in hac habitasse platea dictumst vestibulum. Eleifend donec pretium vulputate sapien nec. Enim praesent elementum facilisis leo vel fringilla est ullamcorper. Quam adipiscing vitae proin sagittis nisl rhoncus. Sed viverra ipsum nunc aliquet bibendum. Enim ut sem viverra aliquet eget sit amet tellus. Integer feugiat scelerisque varius morbi enim nunc faucibus.&lt;/p&gt;&lt;p style=&quot;-webkit-tap-highlight-color: rgba(0, 0, 0, 0); margin-top: 1.5em; margin-bottom: 1.5em; line-height: 1.5; animation: 1000ms linear 0s 1 normal none running fadeInLorem;&quot;&gt;Viverra justo nec ultrices dui. Leo vel orci porta non pulvinar neque laoreet. Id semper risus in hendrerit gravida rutrum quisque non tellus. Sit amet consectetur adipiscing elit ut. Id neque aliquam vestibulum morbi blandit cursus risus. Tristique senectus et netus et malesuada. Amet aliquam id diam maecenas ultricies mi eget mauris. Morbi tristique senectus et netus et malesuada. Diam phasellus vestibulum lorem sed risus. Tempor orci dapibus ultrices in. Mi sit amet mauris commodo quis imperdiet. Quisque sagittis purus sit amet volutpat. Vehicula ipsum a arcu cursus. Ornare quam viverra orci sagittis eu volutpat odio facilisis. Id volutpat lacus laoreet non curabitur. Cursus euismod quis viverra nibh cras pulvinar mattis nunc. Id aliquet lectus proin nibh nisl condimentum id venenatis. Eget nulla facilisi etiam dignissim diam quis enim lobortis. Lacus suspendisse faucibus interdum posuere lorem ipsum dolor sit amet.&lt;/p&gt;', 3, '2020-10-15 14:14:27'),
(2, 'Sample Company', 'Sample location', 'IT Specialist', '&lt;p style=&quot;margin-top: 1.5em; margin-bottom: 1.5em; margin-right: unset; margin-left: unset; color: rgb(68, 68, 68); font-family: &amp;quot;Open Sans&amp;quot;, sans-serif; font-size: 16px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); line-height: 1.5; animation: 1000ms linear 0s 1 normal none running fadeInLorem;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sagittis eu volutpat odio facilisis mauris sit amet massa vitae. In tellus integer feugiat scelerisque varius morbi enim. Orci eu lobortis elementum nibh tellus molestie nunc. Vulputate ut pharetra sit amet aliquam id diam maecenas ultricies. Lacus sed viverra tellus in hac habitasse platea dictumst vestibulum. Eleifend donec pretium vulputate sapien nec. Enim praesent elementum facilisis leo vel fringilla est ullamcorper. Quam adipiscing vitae proin sagittis nisl rhoncus. Sed viverra ipsum nunc aliquet bibendum. Enim ut sem viverra aliquet eget sit amet tellus. Integer feugiat scelerisque varius morbi enim nunc faucibus.&lt;/p&gt;&lt;p style=&quot;margin-top: 1.5em; margin-bottom: 1.5em; margin-right: unset; margin-left: unset; color: rgb(68, 68, 68); font-family: &amp;quot;Open Sans&amp;quot;, sans-serif; font-size: 16px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); line-height: 1.5; animation: 1000ms linear 0s 1 normal none running fadeInLorem;&quot;&gt;Viverra justo nec ultrices dui. Leo vel orci porta non pulvinar neque laoreet. Id semper risus in hendrerit gravida rutrum quisque non tellus. Sit amet consectetur adipiscing elit ut. Id neque aliquam vestibulum morbi blandit cursus risus. Tristique senectus et netus et malesuada. Amet aliquam id diam maecenas ultricies mi eget mauris. Morbi tristique senectus et netus et malesuada. Diam phasellus vestibulum lorem sed risus. Tempor orci dapibus ultrices in. Mi sit amet mauris commodo quis imperdiet. Quisque sagittis purus sit amet volutpat. Vehicula ipsum a arcu cursus. Ornare quam viverra orci sagittis eu volutpat odio facilisis. Id volutpat lacus laoreet non curabitur. Cursus euismod quis viverra nibh cras pulvinar mattis nunc. Id aliquet lectus proin nibh nisl condimentum id venenatis. Eget nulla facilisi etiam dignissim diam quis enim lobortis. Lacus suspendisse faucibus interdum posuere lorem ipsum dolor sit amet.&lt;/p&gt;', 1, '2020-10-15 15:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(30) NOT NULL,
  `course` text NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `about`) VALUES
(1, 'BS Information Technology', 'Sample'),
(6, 'BS Computer Science', ''),
(7, 'BS Computer Engineering', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `schedule` datetime NOT NULL,
  `banner` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `content`, `schedule`, `banner`, `date_created`) VALUES
(6, 'CCS Retreat 2k25', 'Take a break, find peace, and connect deeper&mdash;join us on our upcoming CCS Retreat at Tagaytay Angel&rsquo;s Hills! Let&rsquo;s grow together, DYCIans!', '2025-06-03 06:00:00', '1748080800_angels.png', '2025-05-24 17:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `event_commits`
--

CREATE TABLE `event_commits` (
  `id` int(30) NOT NULL,
  `event_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_commits`
--

INSERT INTO `event_commits` (`id`, `event_id`, `user_id`) VALUES
(1, 1, 3),
(2, 2, 18),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `id` int(30) NOT NULL,
  `topic_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_comments`
--

INSERT INTO `forum_comments` (`id`, `topic_id`, `comment`, `user_id`, `date_created`) VALUES
(3, 3, 'Sample', 1, '2020-10-16 08:48:02'),
(5, 0, '', 1, '2020-10-16 09:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `id` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`id`, `title`, `description`, `user_id`, `date_created`) VALUES
(2, 'Sample Topic 2', '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;&lt;/span&gt;', 3, '2020-10-15 15:20:51'),
(3, 'Sample Topic 3', '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Vivamus gravida nunc orci. Proin ut tristique odio. Nulla suscipit ipsum arcu, a luctus lorem vulputate et. Maecenas magna lorem, tempor id ultrices id, vehicula eu diam. Aliquam erat volutpat. Praesent in sem tincidunt, mattis odio nec, ultrices justo. Vivamus sit amet sapien ornare tortor porttitor congue vel et lorem. In interdum eget metus ut sagittis. In accumsan nec purus vel ornare. Quisque non scelerisque libero, et aliquam risus. Mauris tincidunt ullamcorper efficitur. Nullam venenatis in massa et elementum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; In mollis, tortor sed pellentesque ultrices, sem sem interdum lectus, a laoreet nulla lacus at risus. Ut placerat orci at enim fermentum, eget pretium ante pharetra. Nam id nunc congue augue feugiat egestas.&lt;/span&gt;', 3, '2020-10-15 15:22:30'),
(4, 'Topic by Admin', '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: bolder; margin: 0px; padding: 0px; text-align: justify;&quot;&gt;Lorem Ipsum&lt;/span&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;', 1, '2020-10-16 08:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(30) NOT NULL,
  `batch_id` int(30) NOT NULL,
  `about` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `batch_id`, `about`, `created`) VALUES
(18, 4, 'Empowered by knowledge, driven by purpose — DYCI Class of 2024.', '2025-05-24 18:11:25'),
(19, 3, 'Beyond the gown and cap lies a journey just begun.', '2025-05-24 18:36:02'),
(21, 5, 'Your education is a dress rehearsal for a life that is yours to lead. -Stephen Gordon', '2025-05-24 18:40:14'),
(22, 5, 'Four years, countless memories, one proud moment. -Faith Marquez', '2025-05-24 18:41:08'),
(23, 5, 'Together we learned. Together we grew. Together we soar. - Anton Bratan', '2025-05-24 18:42:22'),
(24, 5, 'The best way to predict the future is to create it. -Justine Anne Gamboa', '2025-05-24 18:43:30'),
(25, 4, 'Your life is your story, and the adventure ahead of you is the journey to fulfill your own purpose and potential. -Justin Waray', '2025-05-24 18:44:27'),
(27, 2, 'Beyond the gown and cap lies a journey just begun. - Stephanie makmak', '2025-05-24 18:46:43'),
(28, 3, 'From student to graduate, from dreamer to achiever. -Dharnie Santiago', '2025-05-24 18:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'MemoraBook', 'info@sample.comm', '+6948 8542 623', '1748080320_485157431_1055146023312797_2806802539263514845_n.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Alumni officer, 3= alumnus',
  `auto_generated_pass` text NOT NULL,
  `alumnus_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`, `auto_generated_pass`, `alumnus_id`) VALUES
(3, 'Mike Williams', 'mwilliams@sample.com', '3cc93e9a6741d8b40460457139cf8ced', 3, '', 2),
(21, 'Anton Macatangay', 'antonmacatangay@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, '', 9),
(22, 'Justin Mark Padilla', 'justinpadilla@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, '', 10),
(23, 'Andrei Cruz', 'andreicruz@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, '', 11),
(24, 'Stephen Ivan Santiago', 'stephenivan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, '', 12),
(25, 'Dharrell Montion', 'dharrel@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, '', 13),
(26, 'Ryan Fadrigalan', 'ryanfadrigalan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, '', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_commits`
--
ALTER TABLE `event_commits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `event_commits`
--
ALTER TABLE `event_commits`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  ADD CONSTRAINT `alumnus_bio_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`id`) ON DELETE CASCADE;

ALTER TABLE `gallery`
  MODIFY `id` INT(30) NOT NULL AUTO_INCREMENT,
  ADD `event_name` VARCHAR(100) DEFAULT NULL,
  ADD `title` VARCHAR(100) DEFAULT NULL,
  ADD `caption` TEXT DEFAULT NULL,
  ADD `contributor` VARCHAR(100) DEFAULT NULL,
  ADD `image_path` VARCHAR(255) DEFAULT NULL,
  ADD `image_blob` LONGBLOB DEFAULT NULL;

ALTER TABLE `batch`
ADD COLUMN `img` TEXT DEFAULT NULL AFTER `year`;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
