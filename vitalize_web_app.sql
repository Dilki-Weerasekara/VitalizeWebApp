-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2024 at 04:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vitalize_web_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('published','rejected','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Good Topic to discuss xunos 👍', 'published', '2024-01-08 00:19:16', '2024-01-08 00:20:02'),
(2, 2, 4, 'Fantastic initiative! Opening up a dialogue about social anxiety is so important. It\'s a condition that many experience yet often struggle to talk about. This group provides a much-needed platform for sharing experiences, offering support, and learning coping strategies. Looking forward to the insights and conversations!', 'published', '2024-01-08 00:33:46', '2024-01-08 00:34:03'),
(3, 6, 6, 'This post beautifully captures the essence of compassion and understanding needed in suicide prevention. It\'s a powerful reminder that reaching out for help signifies courage and resilience. Remember, every step towards asking for help is a step towards healing and hope.', 'published', '2024-01-08 01:44:07', '2024-01-08 01:45:01'),
(4, 10, 7, 'It\'s so important to recognize that depression isn\'t just a mental state; it profoundly affects the body too. This post sheds light on the often overlooked physical symptoms, reminding us that mental health is inseparable from our physical wellbeing.', 'published', '2024-01-08 02:09:40', '2024-01-08 02:10:01'),
(5, 14, 8, ' It\'s a vivid representation that sometimes, the voices around us can impact our mental health. Let\'s remember to be kind to ourselves and seek out stress management techniques that resonate with our individual needs. Together, we can learn to find our inner calm amidst the chaos', 'published', '2024-01-08 02:27:48', '2024-01-08 02:28:01'),
(6, 7, 8, 'I love my family ❤️😍', 'published', '2024-01-08 02:28:47', '2024-01-08 02:29:01'),
(7, 13, 9, 'Thank you so much for valuable information.', 'published', '2024-01-08 02:44:34', '2024-01-08 02:45:01'),
(8, 12, 10, '❤️👍', 'published', '2024-01-08 02:52:51', '2024-01-08 02:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `customer_supports`
--

CREATE TABLE `customer_supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `following_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `friend_id` bigint(20) UNSIGNED NOT NULL,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','accepted','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `accepted_at`, `created_at`, `updated_at`, `status`) VALUES
(1, 2, 1, '2024-01-08 01:58:38', '2024-01-08 00:07:39', '2024-01-08 01:58:38', 'accepted'),
(2, 3, 2, '2024-01-08 02:20:44', '2024-01-08 00:18:23', '2024-01-08 02:20:44', 'accepted'),
(3, 3, 1, '2024-01-08 01:58:27', '2024-01-08 00:18:26', '2024-01-08 01:58:27', 'accepted'),
(4, 4, 3, NULL, '2024-01-08 00:23:08', '2024-01-08 00:23:08', 'pending'),
(5, 4, 2, NULL, '2024-01-08 00:23:13', '2024-01-08 00:23:13', 'pending'),
(6, 5, 4, NULL, '2024-01-08 00:37:14', '2024-01-08 00:37:14', 'pending'),
(7, 5, 3, NULL, '2024-01-08 00:37:18', '2024-01-08 00:37:18', 'pending'),
(8, 6, 5, NULL, '2024-01-08 01:55:15', '2024-01-08 01:55:15', 'pending'),
(9, 6, 2, '2024-01-08 02:20:42', '2024-01-08 01:55:17', '2024-01-08 02:20:42', 'accepted'),
(10, 6, 4, NULL, '2024-01-08 01:55:20', '2024-01-08 01:55:20', 'pending'),
(11, 6, 1, '2024-01-08 01:58:24', '2024-01-08 01:57:58', '2024-01-08 01:58:24', 'accepted'),
(12, 1, 3, NULL, '2024-01-08 01:58:54', '2024-01-08 01:58:54', 'pending'),
(13, 1, 6, NULL, '2024-01-08 01:58:55', '2024-01-08 01:58:55', 'pending'),
(14, 1, 5, NULL, '2024-01-08 01:59:11', '2024-01-08 01:59:11', 'pending'),
(15, 7, 5, NULL, '2024-01-08 02:05:51', '2024-01-08 02:05:51', 'pending'),
(16, 7, 3, NULL, '2024-01-08 02:05:53', '2024-01-08 02:05:53', 'pending'),
(17, 7, 6, NULL, '2024-01-08 02:06:06', '2024-01-08 02:06:06', 'pending'),
(18, 2, 7, NULL, '2024-01-08 02:20:54', '2024-01-08 02:20:54', 'pending'),
(19, 8, 5, NULL, '2024-01-08 02:26:41', '2024-01-08 02:26:41', 'pending'),
(20, 8, 6, NULL, '2024-01-08 02:26:44', '2024-01-08 02:26:44', 'pending'),
(21, 8, 4, NULL, '2024-01-08 02:26:47', '2024-01-08 02:26:47', 'pending'),
(22, 9, 8, NULL, '2024-01-08 02:30:02', '2024-01-08 02:30:02', 'pending'),
(23, 9, 7, NULL, '2024-01-08 02:30:05', '2024-01-08 02:30:05', 'pending'),
(24, 9, 5, NULL, '2024-01-08 02:30:06', '2024-01-08 02:30:06', 'pending'),
(25, 9, 6, NULL, '2024-01-08 02:30:19', '2024-01-08 02:30:19', 'pending'),
(26, 10, 8, NULL, '2024-01-08 02:46:36', '2024-01-08 02:46:36', 'pending'),
(27, 10, 4, NULL, '2024-01-08 02:46:38', '2024-01-08 02:46:38', 'pending'),
(28, 10, 9, NULL, '2024-01-08 02:46:39', '2024-01-08 02:46:39', 'pending'),
(29, 11, 6, NULL, '2024-01-08 02:58:05', '2024-01-08 02:58:05', 'pending'),
(30, 11, 10, NULL, '2024-01-08 02:58:06', '2024-01-08 02:58:06', 'pending'),
(31, 11, 4, NULL, '2024-01-08 02:58:08', '2024-01-08 02:58:08', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `members` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `uuid`, `user_id`, `icon`, `thumbnail`, `description`, `name`, `location`, `type`, `members`, `is_private`, `created_at`, `updated_at`) VALUES
(1, '5b1de012-1238-4b3a-bb29-3b7513cb56a0', 2, 'groups/qLMQVUdPr7UMUxK9hqMFwxH8qpQW1vMOZ91C0npB.png', 'groups/1mEb5q0fM2HJHIuXtNTyS5P4uNNLDjUyBfyPnJQM.jpg', 'Welcome to the Stress Management and Resilience Group, a supportive community dedicated to helping individuals navigate the complexities of stress in today’s fast-paced world. Our group provides a safe and nurturing space for members to learn, share, and apply effective strategies for managing stress.', 'Stress Management', 'Consequat Minus dol', 'Resource Hub', 3, 0, '2024-01-08 00:04:07', '2024-01-08 03:00:46'),
(2, 'b1375676-aff0-4fba-bf74-0251084d30de', 3, 'groups/JJlD5eOjqCtmTjX5fE4rrHpY4TNpg9vnYlDGzdbI.jpg', 'groups/4lmPIErUB5lFrvOcV8TDjOm20H0xCZXhb5Z0N9xS.jpg', '\"Mental Health Matters\" is a compassionate and inclusive community dedicated to discussing, understanding, and supporting mental health. In this group, we acknowledge the importance of mental wellbeing and encourage open conversations about mental health challenges. We aim to create a stigma-free space where members can share experiences, offer support, and gain insights. Whether you\'re seeking advice, information, or just a place to talk, you\'re welcome here. Together, we can raise awareness, break down barriers, and promote mental health as a vital part of our overall well-being.', 'Mental Health Matters', 'Est quasi in quas s', 'Disscussion Forum', 5, 0, '2024-01-08 00:16:40', '2024-01-08 03:00:47'),
(3, '0ed987d2-4d57-45de-9d56-edafb469c3a1', 4, 'groups/LGRWMbQKAwvX0sz5dxqIbIfZi6iJa6wg2HK4PuWp.jpg', 'groups/GhCHLYE2lxyl3lTFTOWwX0HReVXmNEJJOu1l3mFu.jpg', '\"Depression Guidance\" is a supportive community dedicated to helping individuals navigate the challenges of depression. Our group offers a safe, understanding space for sharing experiences, offering mutual support, and exploring coping strategies. We believe in the power of collective wisdom and compassion to provide guidance and hope. Whether you\'re seeking to understand your own feelings, looking for ways to cope, or simply need a compassionate ear, you\'re welcome here. Together, we strive to create a nurturing environment for healing, learning, and personal growth.', 'Depression Guidance', 'Consectetur est sunt', 'Disscussion Forum', 4, 0, '2024-01-08 00:29:48', '2024-01-08 02:46:48'),
(4, '0feffd30-555d-48f5-a175-a648918c8188', 5, 'groups/vN50YaetshWnTaXVC6m3XyUKRm1InkTcOsDZLagL.webp', 'groups/7utIP1Hf0VxAbHgxxg1pMhiVukgXAbDaNGQWoKMF.jpg', 'Welcome to our Cognitive Behavioral Therapy (CBT) Group, a supportive community dedicated to exploring and practicing CBT techniques. This group focuses on understanding the interplay between thoughts, emotions, and behaviors, and how to positively influence this dynamic for mental wellbeing. Whether you\'re new to CBT or seeking to deepen your practice, this space offers a safe environment to learn, share experiences, and grow. Together, we\'ll explore strategies to cope with anxiety, depression, and other challenges, fostering resilience and promoting a healthier mindset.', 'Cognitive Behaviour Therapy', 'Sunt non laborum V', 'Resource Hub', 4, 0, '2024-01-08 00:43:00', '2024-01-08 02:46:47'),
(5, 'd8784def-bfed-4624-ada6-82e0e4fb9e03', 5, 'groups/kRJfi6A3XhqyMPWMv3xYIbyqbT5pncf6dykRa7ei.webp', 'groups/zFMI8NQU86RdtufqA7xqfjDMoB3nWHuqecCBq91y.jpg', 'This group is dedicated to suicide prevention, providing a safe space for open dialogue, support, and resources. Our aim is to offer a compassionate community for those struggling, share preventative strategies, and raise awareness about mental health. Together, we can be a beacon of hope and understanding, reinforcing the message that everyone\'s life is valuable and help is always available.', 'Suicide Prevention', 'Reiciendis adipisci ', 'Resource Hub', 4, 0, '2024-01-08 01:36:57', '2024-01-08 02:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`id`, `user_id`, `group_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 2, 1, '2024-01-08 00:04:07', '2024-01-08 00:04:07', 'active'),
(2, 3, 1, '2024-01-08 00:15:04', '2024-01-08 00:15:04', 'active'),
(3, 3, 2, '2024-01-08 00:16:40', '2024-01-08 00:16:40', 'active'),
(4, 4, 3, '2024-01-08 00:29:48', '2024-01-08 00:29:48', 'active'),
(5, 4, 2, '2024-01-08 00:32:34', '2024-01-08 00:32:34', 'active'),
(6, 5, 4, '2024-01-08 00:43:00', '2024-01-08 00:43:00', 'active'),
(7, 5, 3, '2024-01-08 00:46:54', '2024-01-08 00:46:54', 'active'),
(8, 5, 5, '2024-01-08 01:36:57', '2024-01-08 01:36:57', 'active'),
(9, 6, 3, '2024-01-08 01:48:02', '2024-01-08 01:48:02', 'active'),
(10, 6, 2, '2024-01-08 01:48:08', '2024-01-08 01:48:08', 'active'),
(11, 1, 3, '2024-01-08 01:59:31', '2024-01-08 01:59:31', 'active'),
(12, 1, 5, '2024-01-08 01:59:35', '2024-01-08 01:59:35', 'active'),
(13, 1, 4, '2024-01-08 01:59:40', '2024-01-08 01:59:40', 'active'),
(14, 7, 2, '2024-01-08 02:06:23', '2024-01-08 02:06:23', 'active'),
(15, 7, 4, '2024-01-08 02:06:26', '2024-01-08 02:06:26', 'active'),
(16, 7, 5, '2024-01-08 02:06:32', '2024-01-08 02:06:32', 'active'),
(17, 8, 1, '2024-01-08 02:27:55', '2024-01-08 02:27:55', 'active'),
(18, 8, 4, '2024-01-08 02:27:56', '2024-01-08 02:27:56', 'active'),
(19, 8, 5, '2024-01-08 02:27:57', '2024-01-08 02:27:57', 'active'),
(21, 9, 2, '2024-01-08 02:30:28', '2024-01-08 02:30:28', 'active'),
(22, 9, 5, '2024-01-08 02:30:37', '2024-01-08 02:30:37', 'active'),
(23, 10, 4, '2024-01-08 02:46:47', '2024-01-08 02:46:47', 'active'),
(24, 10, 3, '2024-01-08 02:46:48', '2024-01-08 02:46:48', 'active'),
(25, 11, 1, '2024-01-08 03:00:46', '2024-01-08 03:00:46', 'active'),
(26, 11, 2, '2024-01-08 03:00:47', '2024-01-08 03:00:47', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2024-01-08 00:18:40', '2024-01-08 00:18:40'),
(2, 2, 4, '2024-01-08 00:32:52', '2024-01-08 00:32:52'),
(3, 1, 4, '2024-01-08 00:32:55', '2024-01-08 00:32:55'),
(4, 3, 5, '2024-01-08 00:36:48', '2024-01-08 00:36:48'),
(5, 2, 5, '2024-01-08 00:36:51', '2024-01-08 00:36:51'),
(6, 1, 5, '2024-01-08 00:36:53', '2024-01-08 00:36:53'),
(7, 4, 5, '2024-01-08 01:28:57', '2024-01-08 01:28:57'),
(8, 6, 6, '2024-01-08 01:44:09', '2024-01-08 01:44:09'),
(9, 5, 6, '2024-01-08 01:44:12', '2024-01-08 01:44:12'),
(10, 4, 6, '2024-01-08 01:44:15', '2024-01-08 01:44:15'),
(11, 3, 6, '2024-01-08 01:44:17', '2024-01-08 01:44:17'),
(12, 2, 6, '2024-01-08 01:44:20', '2024-01-08 01:44:20'),
(13, 1, 6, '2024-01-08 01:44:21', '2024-01-08 01:44:21'),
(14, 9, 1, '2024-01-08 02:01:41', '2024-01-08 02:01:41'),
(15, 8, 1, '2024-01-08 02:01:43', '2024-01-08 02:01:43'),
(16, 7, 1, '2024-01-08 02:01:45', '2024-01-08 02:01:45'),
(17, 6, 1, '2024-01-08 02:01:48', '2024-01-08 02:01:48'),
(18, 5, 1, '2024-01-08 02:01:50', '2024-01-08 02:01:50'),
(19, 4, 1, '2024-01-08 02:01:52', '2024-01-08 02:01:52'),
(20, 3, 1, '2024-01-08 02:01:55', '2024-01-08 02:01:55'),
(21, 2, 1, '2024-01-08 02:01:57', '2024-01-08 02:01:57'),
(22, 1, 1, '2024-01-08 02:01:58', '2024-01-08 02:01:58'),
(23, 2, 7, '2024-01-08 02:07:54', '2024-01-08 02:07:54'),
(24, 10, 7, '2024-01-08 02:08:05', '2024-01-08 02:08:05'),
(25, 9, 7, '2024-01-08 02:08:11', '2024-01-08 02:08:11'),
(26, 8, 7, '2024-01-08 02:08:14', '2024-01-08 02:08:14'),
(27, 7, 7, '2024-01-08 02:08:18', '2024-01-08 02:08:18'),
(28, 6, 7, '2024-01-08 02:08:19', '2024-01-08 02:08:19'),
(29, 5, 7, '2024-01-08 02:08:22', '2024-01-08 02:08:22'),
(30, 4, 7, '2024-01-08 02:08:24', '2024-01-08 02:08:24'),
(31, 1, 7, '2024-01-08 02:08:28', '2024-01-08 02:08:28'),
(32, 13, 2, '2024-01-08 02:24:28', '2024-01-08 02:24:28'),
(33, 12, 2, '2024-01-08 02:24:30', '2024-01-08 02:24:30'),
(34, 11, 2, '2024-01-08 02:24:32', '2024-01-08 02:24:32'),
(35, 10, 2, '2024-01-08 02:24:34', '2024-01-08 02:24:34'),
(36, 9, 2, '2024-01-08 02:24:36', '2024-01-08 02:24:36'),
(37, 8, 2, '2024-01-08 02:24:37', '2024-01-08 02:24:37'),
(38, 7, 2, '2024-01-08 02:24:39', '2024-01-08 02:24:39'),
(39, 6, 2, '2024-01-08 02:24:41', '2024-01-08 02:24:41'),
(40, 5, 2, '2024-01-08 02:24:43', '2024-01-08 02:24:43'),
(41, 4, 2, '2024-01-08 02:24:46', '2024-01-08 02:24:46'),
(42, 3, 2, '2024-01-08 02:24:48', '2024-01-08 02:24:48'),
(43, 2, 2, '2024-01-08 02:24:49', '2024-01-08 02:24:49'),
(44, 1, 2, '2024-01-08 02:24:51', '2024-01-08 02:24:51'),
(45, 14, 8, '2024-01-08 02:27:12', '2024-01-08 02:27:12'),
(46, 13, 8, '2024-01-08 02:28:28', '2024-01-08 02:28:28'),
(47, 12, 8, '2024-01-08 02:28:30', '2024-01-08 02:28:30'),
(48, 11, 8, '2024-01-08 02:28:32', '2024-01-08 02:28:32'),
(49, 10, 8, '2024-01-08 02:28:34', '2024-01-08 02:28:34'),
(50, 9, 8, '2024-01-08 02:28:36', '2024-01-08 02:28:36'),
(51, 8, 8, '2024-01-08 02:28:38', '2024-01-08 02:28:38'),
(52, 7, 8, '2024-01-08 02:28:40', '2024-01-08 02:28:40'),
(53, 14, 9, '2024-01-08 02:30:59', '2024-01-08 02:30:59'),
(54, 10, 9, '2024-01-08 02:44:43', '2024-01-08 02:44:43'),
(55, 15, 10, '2024-01-08 02:46:29', '2024-01-08 02:46:29'),
(56, 14, 10, '2024-01-08 02:52:28', '2024-01-08 02:52:28'),
(57, 11, 10, '2024-01-08 02:52:55', '2024-01-08 02:52:55'),
(58, 13, 10, '2024-01-08 02:53:15', '2024-01-08 02:53:15'),
(59, 10, 10, '2024-01-08 02:54:00', '2024-01-08 02:54:00'),
(60, 18, 11, '2024-01-08 02:58:21', '2024-01-08 02:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_25_183708_create_pages_table', 1),
(6, '2023_12_25_183825_create_groups_table', 1),
(7, '2023_12_25_183926_create_posts_table', 1),
(8, '2023_12_25_184024_create_comments_table', 1),
(9, '2023_12_25_184104_create_likes_table', 1),
(10, '2023_12_25_184214_create_notifications_table', 1),
(11, '2023_12_25_184257_create_friends_table', 1),
(12, '2023_12_25_184341_create_followers_table', 1),
(13, '2023_12_25_184426_create_post_media_table', 1),
(14, '2023_12_25_184517_create_saved_posts_table', 1),
(15, '2023_12_25_184711_create_stories_table', 1),
(16, '2023_12_25_184743_create_story_comments_table', 1),
(17, '2023_12_25_184824_create_page_likes_table', 1),
(18, '2023_12_25_184901_create_group_members_table', 1),
(19, '2023_12_25_185015_create_settings_table', 1),
(20, '2023_12_25_185137_create_customer_supports_table', 1),
(21, '2023_12_30_032759_add_status_to_friends_table', 1),
(22, '2024_01_01_074558_create_faqs_table', 1),
(23, '2024_01_01_223404_add_status_to_group_members_table', 1),
(24, '2024_01_02_211321_add_name_to_users_table', 1),
(25, '2024_01_02_999999_add_active_status_to_users', 1),
(26, '2024_01_02_999999_add_avatar_to_users', 1),
(27, '2024_01_02_999999_add_dark_mode_to_users', 1),
(28, '2024_01_02_999999_add_messenger_color_to_users', 1),
(29, '2024_01_02_999999_create_chatify_favorites_table', 1),
(30, '2024_01_02_999999_create_chatify_messages_table', 1),
(31, '2024_01_06_232233_add_default_status_to_comments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `user_id`, `message`, `url`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'create_group', 2, 'Stress Management group has been created successfully.', 'http://127.0.0.1:8000/groups/5b1de012-1238-4b3a-bb29-3b7513cb56a0', NULL, '2024-01-08 00:04:07', '2024-01-08 00:04:07'),
(2, 'post_status', 2, 'Your Post has been published', 'http://127.0.0.1:8000/post/6f17cdf4-3ed0-478e-b42b-3d215d025339/24dea9a7-59d4-41b9-acb7-06a9dae8b6df', NULL, '2024-01-08 00:07:03', '2024-01-08 00:07:03'),
(3, 'friend_request', 1, 'xunos send you friend request', '#', NULL, '2024-01-08 00:07:39', '2024-01-08 00:07:39'),
(4, 'page_liked', 2, 'bavag joined your group Stress Management', '#', NULL, '2024-01-08 00:15:04', '2024-01-08 00:15:04'),
(5, 'create_group', 3, 'Mental Health Matters group has been created successfully.', 'http://127.0.0.1:8000/groups/b1375676-aff0-4fba-bf74-0251084d30de', NULL, '2024-01-08 00:16:40', '2024-01-08 00:16:40'),
(6, 'friend_request', 2, 'bavag send you friend request', '#', NULL, '2024-01-08 00:18:23', '2024-01-08 00:18:23'),
(7, 'friend_request', 1, 'bavag send you friend request', '#', NULL, '2024-01-08 00:18:26', '2024-01-08 00:18:26'),
(8, 'post_status', 3, 'Your Post has been published', 'http://127.0.0.1:8000/post/c5213d06-feca-4b3e-be23-1475e38fda7b/9347b28a-99f4-45f4-905c-1a1d0315985e', NULL, '2024-01-08 00:19:04', '2024-01-08 00:19:04'),
(9, 'post_status', 3, 'Your Comment has been published', 'http://127.0.0.1:8000/post/c5213d06-feca-4b3e-be23-1475e38fda7b/24dea9a7-59d4-41b9-acb7-06a9dae8b6df', NULL, '2024-01-08 00:20:02', '2024-01-08 00:20:02'),
(10, 'friend_request', 3, 'mewaxixa send you friend request', '#', NULL, '2024-01-08 00:23:08', '2024-01-08 00:23:08'),
(11, 'friend_request', 2, 'mewaxixa send you friend request', '#', NULL, '2024-01-08 00:23:13', '2024-01-08 00:23:13'),
(12, 'create_group', 4, 'Depression Guidance group has been created successfully.', 'http://127.0.0.1:8000/groups/0ed987d2-4d57-45de-9d56-edafb469c3a1', NULL, '2024-01-08 00:29:48', '2024-01-08 00:29:48'),
(13, 'page_liked', 3, 'mewaxixa joined your group Mental Health Matters', '#', NULL, '2024-01-08 00:32:34', '2024-01-08 00:32:34'),
(14, 'post_status', 4, 'Your Post has been published', 'http://127.0.0.1:8000/post/5c0cd30b-0569-4c49-ae51-1de13ac71e0e/4261d010-8105-48a3-82ae-0ee25c8e8bd0', NULL, '2024-01-08 00:33:02', '2024-01-08 00:33:02'),
(15, 'post_status', 4, 'Your Comment has been published', 'http://127.0.0.1:8000/post/5c0cd30b-0569-4c49-ae51-1de13ac71e0e/9347b28a-99f4-45f4-905c-1a1d0315985e', NULL, '2024-01-08 00:34:03', '2024-01-08 00:34:03'),
(16, 'friend_request', 4, 'vemix send you friend request', '#', NULL, '2024-01-08 00:37:14', '2024-01-08 00:37:14'),
(17, 'friend_request', 3, 'vemix send you friend request', '#', NULL, '2024-01-08 00:37:18', '2024-01-08 00:37:18'),
(18, 'create_group', 5, 'Cognitive Behaviour Therapy group has been created successfully.', 'http://127.0.0.1:8000/groups/0feffd30-555d-48f5-a175-a648918c8188', NULL, '2024-01-08 00:43:00', '2024-01-08 00:43:00'),
(19, 'post_status', 5, 'Your Post has been published', 'http://127.0.0.1:8000/post/6a6df78e-f3ac-4425-85f8-17674c5d0ce6/2eefc69c-f530-4999-a034-0eae99e56f19', NULL, '2024-01-08 00:46:02', '2024-01-08 00:46:02'),
(20, 'page_liked', 4, 'vemix joined your group Depression Guidance', '#', NULL, '2024-01-08 00:46:55', '2024-01-08 00:46:55'),
(21, 'post_status', 5, 'Your Post has been published', 'http://127.0.0.1:8000/post/6a6df78e-f3ac-4425-85f8-17674c5d0ce6/f0c12665-c8f7-42b1-af67-5f0141160392', NULL, '2024-01-08 01:28:01', '2024-01-08 01:28:01'),
(22, 'create_group', 5, 'Suicide Prevention group has been created successfully.', 'http://127.0.0.1:8000/groups/d8784def-bfed-4624-ada6-82e0e4fb9e03', NULL, '2024-01-08 01:36:57', '2024-01-08 01:36:57'),
(23, 'post_status', 5, 'Your Post has been rejected due to community guide lines', '#', NULL, '2024-01-08 01:40:02', '2024-01-08 01:40:02'),
(24, 'post_status', 6, 'Your Comment has been rejected due to community guide lines', '#', NULL, '2024-01-08 01:45:01', '2024-01-08 01:45:01'),
(25, 'post_status', 6, 'Your Post has been rejected due to community guide lines', '#', NULL, '2024-01-08 01:46:01', '2024-01-08 01:46:01'),
(26, 'page_liked', 4, 'vilyqa joined your group Depression Guidance', '#', NULL, '2024-01-08 01:48:02', '2024-01-08 01:48:02'),
(27, 'page_liked', 3, 'vilyqa joined your group Mental Health Matters', '#', NULL, '2024-01-08 01:48:08', '2024-01-08 01:48:08'),
(28, 'post_status', 6, 'Your Post has been published', 'http://127.0.0.1:8000/post/4f1945ad-ddba-4dc3-b8f0-e3b1cd5c6ea1/9551ee6f-ae66-4bea-99a6-9ccdd9080e6a', NULL, '2024-01-08 01:51:01', '2024-01-08 01:51:01'),
(29, 'post_status', 6, 'Your Post has been published', 'http://127.0.0.1:8000/post/4f1945ad-ddba-4dc3-b8f0-e3b1cd5c6ea1/cea43a1f-5d3b-41e2-b187-c203b710fed1', NULL, '2024-01-08 01:52:01', '2024-01-08 01:52:01'),
(30, 'friend_request', 5, 'vilyqa send you friend request', '#', NULL, '2024-01-08 01:55:16', '2024-01-08 01:55:16'),
(31, 'friend_request', 2, 'vilyqa send you friend request', '#', NULL, '2024-01-08 01:55:17', '2024-01-08 01:55:17'),
(32, 'friend_request', 4, 'vilyqa send you friend request', '#', NULL, '2024-01-08 01:55:20', '2024-01-08 01:55:20'),
(33, 'friend_request', 1, 'vilyqa send you friend request', '#', NULL, '2024-01-08 01:57:58', '2024-01-08 01:57:58'),
(34, 'friend_accepted', 6, 'xogotuxox accepted your friend request', '#', NULL, '2024-01-08 01:58:25', '2024-01-08 01:58:25'),
(35, 'friend_accepted', 3, 'xogotuxox accepted your friend request', '#', NULL, '2024-01-08 01:58:27', '2024-01-08 01:58:27'),
(36, 'friend_accepted', 2, 'xogotuxox accepted your friend request', '#', NULL, '2024-01-08 01:58:38', '2024-01-08 01:58:38'),
(37, 'friend_request', 3, 'xogotuxox send you friend request', '#', NULL, '2024-01-08 01:58:54', '2024-01-08 01:58:54'),
(38, 'friend_request', 6, 'xogotuxox send you friend request', '#', NULL, '2024-01-08 01:58:55', '2024-01-08 01:58:55'),
(39, 'friend_request', 5, 'xogotuxox send you friend request', '#', NULL, '2024-01-08 01:59:11', '2024-01-08 01:59:11'),
(40, 'page_liked', 4, 'xogotuxox joined your group Depression Guidance', '#', NULL, '2024-01-08 01:59:31', '2024-01-08 01:59:31'),
(41, 'page_liked', 5, 'xogotuxox joined your group Suicide Prevention', '#', NULL, '2024-01-08 01:59:35', '2024-01-08 01:59:35'),
(42, 'page_liked', 5, 'xogotuxox joined your group Cognitive Behaviour Therapy', '#', NULL, '2024-01-08 01:59:40', '2024-01-08 01:59:40'),
(43, 'post_status', 1, 'Your Post has been published', 'http://127.0.0.1:8000/post/f7ee53ec-1271-4b18-84c1-2ee547ecade6/664c8fbf-0d89-44b7-8f90-746192853242', NULL, '2024-01-08 02:01:02', '2024-01-08 02:01:02'),
(44, 'friend_request', 5, 'qozalari send you friend request', '#', NULL, '2024-01-08 02:05:51', '2024-01-08 02:05:51'),
(45, 'friend_request', 3, 'qozalari send you friend request', '#', NULL, '2024-01-08 02:05:53', '2024-01-08 02:05:53'),
(46, 'friend_request', 6, 'qozalari send you friend request', '#', NULL, '2024-01-08 02:06:06', '2024-01-08 02:06:06'),
(47, 'page_liked', 3, 'qozalari joined your group Mental Health Matters', '#', NULL, '2024-01-08 02:06:23', '2024-01-08 02:06:23'),
(48, 'page_liked', 5, 'qozalari joined your group Cognitive Behaviour Therapy', '#', NULL, '2024-01-08 02:06:26', '2024-01-08 02:06:26'),
(49, 'page_liked', 5, 'qozalari joined your group Suicide Prevention', '#', NULL, '2024-01-08 02:06:32', '2024-01-08 02:06:32'),
(50, 'post_status', 7, 'Your Post has been published', 'http://127.0.0.1:8000/post/95f31478-a125-4f26-b025-39be8277279b/ec19508c-c715-4389-9bc1-7b4468cdebbf', NULL, '2024-01-08 02:08:02', '2024-01-08 02:08:02'),
(51, 'post_status', 7, 'Your Comment has been published', 'http://127.0.0.1:8000/post/95f31478-a125-4f26-b025-39be8277279b/664c8fbf-0d89-44b7-8f90-746192853242', NULL, '2024-01-08 02:10:01', '2024-01-08 02:10:01'),
(52, 'post_status', 7, 'Your Post has been rejected due to community guide lines', '#', NULL, '2024-01-08 02:13:01', '2024-01-08 02:13:01'),
(53, 'post_status', 7, 'Your Post has been published', 'http://127.0.0.1:8000/post/95f31478-a125-4f26-b025-39be8277279b/a1ff09db-3bc7-4d06-a7bd-e44593f15cff', NULL, '2024-01-08 02:18:01', '2024-01-08 02:18:01'),
(54, 'friend_accepted', 6, 'xunos accepted your friend request', '#', NULL, '2024-01-08 02:20:42', '2024-01-08 02:20:42'),
(55, 'friend_accepted', 3, 'xunos accepted your friend request', '#', NULL, '2024-01-08 02:20:44', '2024-01-08 02:20:44'),
(56, 'friend_request', 7, 'xunos send you friend request', '#', NULL, '2024-01-08 02:20:54', '2024-01-08 02:20:54'),
(57, 'post_status', 2, 'Your Post has been published', 'http://127.0.0.1:8000/post/6f17cdf4-3ed0-478e-b42b-3d215d025339/af6a9e71-d4f3-4c50-a8be-899956a85924', NULL, '2024-01-08 02:24:01', '2024-01-08 02:24:01'),
(58, 'friend_request', 5, 'jizodej send you friend request', '#', NULL, '2024-01-08 02:26:41', '2024-01-08 02:26:41'),
(59, 'friend_request', 6, 'jizodej send you friend request', '#', NULL, '2024-01-08 02:26:45', '2024-01-08 02:26:45'),
(60, 'friend_request', 4, 'jizodej send you friend request', '#', NULL, '2024-01-08 02:26:47', '2024-01-08 02:26:47'),
(61, 'page_liked', 2, 'jizodej joined your group Stress Management', '#', NULL, '2024-01-08 02:27:55', '2024-01-08 02:27:55'),
(62, 'page_liked', 5, 'jizodej joined your group Cognitive Behaviour Therapy', '#', NULL, '2024-01-08 02:27:57', '2024-01-08 02:27:57'),
(63, 'page_liked', 5, 'jizodej joined your group Suicide Prevention', '#', NULL, '2024-01-08 02:27:58', '2024-01-08 02:27:58'),
(64, 'post_status', 8, 'Your Comment has been published', 'http://127.0.0.1:8000/post/6276c65f-a01a-4bd8-9712-a859a16e2e33/af6a9e71-d4f3-4c50-a8be-899956a85924', NULL, '2024-01-08 02:28:02', '2024-01-08 02:28:02'),
(65, 'post_status', 8, 'Your Comment has been published', 'http://127.0.0.1:8000/post/6276c65f-a01a-4bd8-9712-a859a16e2e33/fcb448e7-5b4c-469f-8bf2-815fe997abe4', NULL, '2024-01-08 02:29:01', '2024-01-08 02:29:01'),
(66, 'friend_request', 8, 'suxefuzutu send you friend request', '#', NULL, '2024-01-08 02:30:03', '2024-01-08 02:30:03'),
(67, 'friend_request', 7, 'suxefuzutu send you friend request', '#', NULL, '2024-01-08 02:30:05', '2024-01-08 02:30:05'),
(68, 'friend_request', 5, 'suxefuzutu send you friend request', '#', NULL, '2024-01-08 02:30:06', '2024-01-08 02:30:06'),
(69, 'friend_request', 6, 'suxefuzutu send you friend request', '#', NULL, '2024-01-08 02:30:19', '2024-01-08 02:30:19'),
(70, 'page_liked', 2, 'suxefuzutu joined your group Stress Management', '#', NULL, '2024-01-08 02:30:27', '2024-01-08 02:30:27'),
(71, 'page_liked', 3, 'suxefuzutu joined your group Mental Health Matters', '#', NULL, '2024-01-08 02:30:29', '2024-01-08 02:30:29'),
(72, 'page_liked', 5, 'suxefuzutu joined your group Suicide Prevention', '#', NULL, '2024-01-08 02:30:37', '2024-01-08 02:30:37'),
(73, 'post_status', 9, 'Your Post has been published', 'http://127.0.0.1:8000/post/854f6aa5-8174-4736-8263-c7d771a836e9/794bb804-8651-4a02-ad2d-4e5501cb329b', NULL, '2024-01-08 02:44:02', '2024-01-08 02:44:02'),
(74, 'post_status', 9, 'Your Comment has been published', 'http://127.0.0.1:8000/post/854f6aa5-8174-4736-8263-c7d771a836e9/a1ff09db-3bc7-4d06-a7bd-e44593f15cff', NULL, '2024-01-08 02:45:01', '2024-01-08 02:45:01'),
(75, 'friend_request', 8, 'rifedabo send you friend request', '#', NULL, '2024-01-08 02:46:36', '2024-01-08 02:46:36'),
(76, 'friend_request', 4, 'rifedabo send you friend request', '#', NULL, '2024-01-08 02:46:38', '2024-01-08 02:46:38'),
(77, 'friend_request', 9, 'rifedabo send you friend request', '#', NULL, '2024-01-08 02:46:40', '2024-01-08 02:46:40'),
(78, 'page_liked', 5, 'rifedabo joined your group Cognitive Behaviour Therapy', '#', NULL, '2024-01-08 02:46:47', '2024-01-08 02:46:47'),
(79, 'page_liked', 4, 'rifedabo joined your group Depression Guidance', '#', NULL, '2024-01-08 02:46:48', '2024-01-08 02:46:48'),
(80, 'post_status', 10, 'Your Post has been published', 'http://127.0.0.1:8000/post/db91a68f-6bc0-4306-b207-7782c485cbc4/6aedc1c4-b5d1-4a02-b070-c49df30f9a6f', NULL, '2024-01-08 02:50:02', '2024-01-08 02:50:02'),
(81, 'post_status', 10, 'Your Post has been published', 'http://127.0.0.1:8000/post/db91a68f-6bc0-4306-b207-7782c485cbc4/33758647-09f1-4091-a335-f4789f05b5df', NULL, '2024-01-08 02:51:01', '2024-01-08 02:51:01'),
(82, 'post_status', 10, 'Your Comment has been published', 'http://127.0.0.1:8000/post/db91a68f-6bc0-4306-b207-7782c485cbc4/fee3c3ab-8924-42c3-840f-8bbaa09e0fdc', NULL, '2024-01-08 02:53:01', '2024-01-08 02:53:01'),
(83, 'post_status', 11, 'Your Post has been published', 'http://127.0.0.1:8000/post/1203cc8b-20f2-4d29-bf1e-56171d64db02/574f06ca-678d-4396-bc7e-d5c0e1b79b01', NULL, '2024-01-08 02:58:01', '2024-01-08 02:58:01'),
(84, 'friend_request', 6, 'divopanyz send you friend request', '#', NULL, '2024-01-08 02:58:05', '2024-01-08 02:58:05'),
(85, 'friend_request', 10, 'divopanyz send you friend request', '#', NULL, '2024-01-08 02:58:06', '2024-01-08 02:58:06'),
(86, 'friend_request', 4, 'divopanyz send you friend request', '#', NULL, '2024-01-08 02:58:08', '2024-01-08 02:58:08'),
(87, 'page_liked', 2, 'divopanyz joined your group Stress Management', '#', NULL, '2024-01-08 03:00:46', '2024-01-08 03:00:46'),
(88, 'page_liked', 3, 'divopanyz joined your group Mental Health Matters', '#', NULL, '2024-01-08 03:00:47', '2024-01-08 03:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `members` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_likes`
--

CREATE TABLE `page_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `status` enum('published','pending','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `likes` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `comments` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `is_page_post` tinyint(1) NOT NULL DEFAULT 0,
  `page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_group_post` tinyint(1) NOT NULL DEFAULT 0,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uuid`, `user_id`, `content`, `is_public`, `status`, `likes`, `comments`, `is_page_post`, `page_id`, `is_group_post`, `group_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '24dea9a7-59d4-41b9-acb7-06a9dae8b6df', 2, 'Lets Learn How to overcome Stress ', 1, 'published', 7, 1, 0, NULL, 1, 1, NULL, '2024-01-08 00:05:56', '2024-01-08 02:24:51'),
(2, '9347b28a-99f4-45f4-905c-1a1d0315985e', 3, 'Exploring Social Anxiety Together, Let\'s Discuss  !! ', 1, 'published', 6, 1, 0, NULL, 1, 2, NULL, '2024-01-08 00:18:10', '2024-01-08 02:24:49'),
(3, '4261d010-8105-48a3-82ae-0ee25c8e8bd0', 4, '\"Welcome to \'Depression Guidance\', a sanctuary where understanding and support meet. In this group, we share our journeys, lift each other up, and find solace in knowing we\'re not alone. Depression can be a challenging path, but together, we navigate through the fog with empathy and shared wisdom. Whether you\'re seeking advice, a listening ear, or a place to share your story, you\'ll find a community here ready to embrace you. Let\'s walk this path together towards healing and hope.\"\n\n\n\n\n', 1, 'published', 4, 0, 0, NULL, 1, 3, NULL, '2024-01-08 00:32:08', '2024-01-08 02:24:49'),
(4, '2eefc69c-f530-4999-a034-0eae99e56f19', 5, 'Lets Learn What are the good steps we can take to reduce the depression.', 1, 'published', 5, 0, 0, NULL, 1, 3, NULL, '2024-01-08 00:45:47', '2024-01-08 02:24:46'),
(5, 'f0c12665-c8f7-42b1-af67-5f0141160392', 5, 'Discover the transformative power of Cognitive Behavioral Therapy (CBT) through our focused sessions. CBT helps in identifying and challenging negative thought patterns, enabling a shift towards more positive and realistic thinking. This approach is not just about changing thoughts but also about actively altering behaviors to improve mental health. Join us to learn practical techniques for coping with anxiety, depression, and stress, empowering you to take control of your mental wellbeing and embrace a more balanced and fulfilling life.', 1, 'published', 4, 0, 0, NULL, 1, 4, NULL, '2024-01-08 01:27:56', '2024-01-08 02:24:44'),
(6, '8d4603f9-d21c-481b-98d9-af98d01bc143', 5, 'In our journey towards suicide prevention, it\'s vital to remember that hope and help are always within reach. If you\'re feeling overwhelmed, know that your feelings are valid, but they don\'t have to define your future. There\'s strength in seeking support, and it\'s okay to not be okay. You\'re not alone in this struggle; there are many who care and are ready to listen. Let\'s cherish every moment of life and remind each other that even in the darkest times, there\'s a path forward. Reach out, speak up, and let\'s support one another.', 1, 'published', 4, 1, 0, NULL, 1, 5, NULL, '2024-01-08 01:39:09', '2024-01-08 02:24:41'),
(7, 'fcb448e7-5b4c-469f-8bf2-815fe997abe4', 6, 'Spread love within your family and stand united against suicide. A mother\'s support can be a powerful beacon of hope, especially for a daughter. Together, we can make a difference.', 1, 'published', 4, 1, 0, NULL, 0, NULL, NULL, '2024-01-08 01:45:29', '2024-01-08 02:28:47'),
(8, '9551ee6f-ae66-4bea-99a6-9ccdd9080e6a', 6, 'let\'s Identify Depression Symptoms ', 1, 'published', 4, 0, 0, NULL, 1, 3, NULL, '2024-01-08 01:49:17', '2024-01-08 02:28:38'),
(9, 'cea43a1f-5d3b-41e2-b187-c203b710fed1', 6, 'You\'re not alone in this struggle; there are many who care and are ready to listen. ', 1, 'published', 4, 0, 0, NULL, 1, 5, NULL, '2024-01-08 01:51:21', '2024-01-08 02:28:36'),
(10, '664c8fbf-0d89-44b7-8f90-746192853242', 1, 'Physical Symptoms of Depression', 1, 'published', 5, 1, 0, NULL, 1, 3, NULL, '2024-01-08 02:00:33', '2024-01-08 02:54:00'),
(11, 'ec19508c-c715-4389-9bc1-7b4468cdebbf', 7, 'Problem-Solving Therapy (PST) is an effective approach for managing everyday life challenges and mental health issues like depression and anxiety. It equips individuals with practical skills to identify, analyze, and solve problems, leading to reduced stress and improved mental wellbeing. By focusing on actionable solutions rather than on the problems themselves, PST enhances an individual’s coping mechanisms, promotes a sense of control and empowerment, and fosters resilience in facing life’s obstacles. This therapy is beneficial in improving mood, increasing optimism, and boosting overall life satisfaction.', 1, 'published', 3, 0, 0, NULL, 1, 2, NULL, '2024-01-08 02:07:47', '2024-01-08 02:52:55'),
(12, 'fee3c3ab-8924-42c3-840f-8bbaa09e0fdc', 7, 'In our campaign \'Reach Out and Connect\', we emphasize the importance of connection as a key factor in suicide prevention. By reaching out to those around us, offering a listening ear, and sharing our own stories, we create a network of support and understanding. Remember, you\'re not alone in your struggles. Together, we can foster a community that actively listens, supports, and helps those in need, making a significant difference in the lives of many.', 1, 'published', 2, 1, 0, NULL, 1, 5, NULL, '2024-01-08 02:12:24', '2024-01-08 02:52:51'),
(13, 'a1ff09db-3bc7-4d06-a7bd-e44593f15cff', 7, 'Cognitive Behavioral Therapy (CBT) is a form of psychotherapy that focuses on identifying and changing negative and unhelpful thought patterns, beliefs, and attitudes. It helps individuals develop coping strategies to deal with different problems. CBT combines cognitive therapy, which alters unwanted thought patterns, with behavioral therapy, which aims to change unhelpful behaviors. It\'s commonly used to treat anxiety, depression, stress, and other mental health conditions, emphasizing the importance of the present thoughts and beliefs over past experiences.', 1, 'published', 3, 1, 0, NULL, 1, 4, NULL, '2024-01-08 02:17:06', '2024-01-08 02:53:15'),
(14, 'af6a9e71-d4f3-4c50-a8be-899956a85924', 2, 'Surrounded by whispers of judgment, this illustration poignantly captures the essence of social stress. It\'s a stark reminder that the pressures we feel from society can be overwhelming. Managing this stress starts with recognizing these external voices and learning to silence them through self-compassion and resilience-building techniques. Let\'s navigate the noise together and find peace within.', 1, 'published', 3, 1, 0, NULL, 1, 1, NULL, '2024-01-08 02:23:33', '2024-01-08 02:52:28'),
(15, '794bb804-8651-4a02-ad2d-4e5501cb329b', 9, 'This information could be of significant importance to all of you, my friends.', 1, 'published', 1, 0, 0, NULL, 0, NULL, NULL, '2024-01-08 02:43:23', '2024-01-08 02:46:29'),
(18, '574f06ca-678d-4396-bc7e-d5c0e1b79b01', 11, 'we see the crushing weight of societal judgment and self-doubt that can contribute to mental health struggles. Let\'s unite against the stigma and the silent battles many face. It\'s time to offer support, understanding, and kindness to those feeling cornered by the pointing fingers of judgment. Together, we can stand against the tide of mental health stigma and remind everyone that it\'s okay to seek help and to speak out my friends.', 1, 'published', 1, 0, 0, NULL, 0, NULL, NULL, '2024-01-08 02:57:32', '2024-01-08 02:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `post_media`
--

CREATE TABLE `post_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_media`
--

INSERT INTO `post_media` (`id`, `post_id`, `file_type`, `file`, `position`, `created_at`, `updated_at`) VALUES
(1, 1, 'image', '[\"posts\\/images\\/4damSLdjcFZ1qygJJcDoqGd6N1RA4ZVelKXwqkId.jpg\",\"posts\\/images\\/CNVhmTvhz0hoUoQnR39sex4PkGdMMXXYJgkjuCv9.png\",\"posts\\/images\\/ULbmNVnT3zyteNm4FNklb5XTrsUHLrHWSsM4xCKs.jpg\",\"posts\\/images\\/HU8rjPypPQOpFE7AqRRF6zE4O4jcdWhX93iPXVtu.png\"]', 'general', '2024-01-08 00:05:57', '2024-01-08 00:05:57'),
(2, 2, 'image', '[\"posts\\/images\\/lPTjH2RIFrxp5JuW6vkSqyFQ4NdZ74GAEI5eOQXc.jpg\"]', 'general', '2024-01-08 00:18:10', '2024-01-08 00:18:10'),
(3, 3, 'image', '[\"posts\\/images\\/83UfD9t2YWkZeiNTkWfIHjeAk92Q2BoDwzH2wrEh.jpg\"]', 'general', '2024-01-08 00:32:08', '2024-01-08 00:32:08'),
(4, 4, 'image', '[\"posts\\/images\\/FM1esahA7IGpA3IHtvv89zTsd92KcGZrO1fae6OX.jpg\"]', 'general', '2024-01-08 00:45:47', '2024-01-08 00:45:47'),
(5, 5, 'image', '[\"posts\\/images\\/eKusDQjlGpD9wSqTNtX3QSTJsTq4qonSSRQWODG1.gif\"]', 'general', '2024-01-08 01:27:56', '2024-01-08 01:27:56'),
(6, 6, 'image', '[\"posts\\/images\\/WobAgYIi2r1AINkPuotm5fbkIqhj5QTZusM9tJfL.webp\"]', 'general', '2024-01-08 01:39:09', '2024-01-08 01:39:09'),
(7, 7, 'image', '[\"posts\\/images\\/2kqcuk4o2MO8yCWKRaxZ4m4lSyeWO2ddjYaIcu1j.gif\"]', 'general', '2024-01-08 01:45:29', '2024-01-08 01:45:29'),
(8, 8, 'image', '[\"posts\\/images\\/XPCj414gbuUm4jusCJg2gESeGwqhnNHamWcZqSv2.jpg\"]', 'general', '2024-01-08 01:49:17', '2024-01-08 01:49:17'),
(9, 9, 'image', '[\"posts\\/images\\/WswsytvVlNWxXYiZXcvtFRpcCsmP1nvgHjkdFTo6.jpg\"]', 'general', '2024-01-08 01:51:21', '2024-01-08 01:51:21'),
(10, 10, 'image', '[\"posts\\/images\\/PkxvemuDXthu38AnafKuU3jzTuOGyLjV8CO8bP69.gif\"]', 'general', '2024-01-08 02:00:33', '2024-01-08 02:00:33'),
(11, 11, 'image', '[\"posts\\/images\\/jr7JPo0297TMoEuvl8H3EKTfz89SxLpPgVjzAXeQ.gif\"]', 'general', '2024-01-08 02:07:47', '2024-01-08 02:07:47'),
(12, 12, 'image', '[\"posts\\/images\\/w9tBFUEVKXy5YQ19XDr4ZWwBTPr0i6Cs8kKtckdi.png\"]', 'general', '2024-01-08 02:12:24', '2024-01-08 02:12:24'),
(13, 13, 'image', '[\"posts\\/images\\/woUiMCEhiiSjrjtVJ34AdBQiALIpw0gROHYlMfY5.webp\"]', 'general', '2024-01-08 02:17:06', '2024-01-08 02:17:06'),
(14, 14, 'image', '[\"posts\\/images\\/4xVaoXlQ5rQ7t5TC3NyzWqNj1ggfni3KUKfDPVAm.jpg\"]', 'general', '2024-01-08 02:23:34', '2024-01-08 02:23:34'),
(15, 15, 'image', '[\"posts\\/images\\/1mZoKFnoexzox2PfBR00OY42vyeSOqfIKJN6sHIu.webp\"]', 'general', '2024-01-08 02:43:23', '2024-01-08 02:43:23'),
(19, 18, 'image', '[\"posts\\/images\\/UiT5FBMYCMkzo5yS3Uscq1Cj1wBaSXzjvjJyMRWX.jpg\"]', 'general', '2024-01-08 02:57:32', '2024-01-08 02:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `saved_posts`
--

CREATE TABLE `saved_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `story` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('published','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `likes` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `comment` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `user_id`, `story`, `status`, `likes`, `comment`, `created_at`, `updated_at`) VALUES
(2, 2, '[\"stories\\/hP9oRDlODJC0n8Gc0k7IQ0fl9eusWKFhFRWOt2TG.jpg\"]', 'published', 0, 0, '2024-01-08 00:11:43', '2024-01-08 00:11:43'),
(3, 3, '[\"stories\\/2WLpRmGwvQB9AHFtJ08O9klC6BPukOF6YJzPvUge.jpg\"]', 'published', 0, 0, '2024-01-08 00:20:51', '2024-01-08 00:20:51'),
(5, 4, '[\"stories\\/hRr4wWdir5dLItqxYA8CLHZ0hlzI2tewPfqWRRhd.jpg\"]', 'published', 0, 0, '2024-01-08 00:24:47', '2024-01-08 00:24:47'),
(6, 5, '[\"stories\\/bNE8F1dUHyRqPhskOv5vHXCSZvIGgBZuj25Zp0dv.jpg\"]', 'published', 0, 0, '2024-01-08 00:37:54', '2024-01-08 00:37:54'),
(8, 7, '[\"stories\\/a8zvQbSpWu7y3IgMeNUOFj86kiqEvQXAPIwDpcHQ.jpg\"]', 'published', 0, 0, '2024-01-08 02:05:11', '2024-01-08 02:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `story_comments`
--

CREATE TABLE `story_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `story_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `profile_type` enum('generalUser','healthProfessioner') COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile_verified_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `relationship` enum('single','married','engaged') COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `is_banned` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `messenger_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `first_name`, `last_name`, `dob`, `profile_type`, `profession`, `username`, `email`, `mobile`, `mobile_verification_code`, `email_verified_at`, `mobile_verified_at`, `description`, `thumbnail`, `profile`, `gender`, `relationship`, `location`, `address`, `is_private`, `is_banned`, `password`, `remember_token`, `created_at`, `updated_at`, `name`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(1, 'f7ee53ec-1271-4b18-84c1-2ee547ecade6', 'Beck', 'Dejesus', NULL, 'healthProfessioner', 'Nulla voluptatibus n', 'xogotuxox', 'guhax@mailinator.com', NULL, NULL, '2024-01-07 23:22:57', NULL, NULL, NULL, 'profiles/9tHVQDL12HsHAVtwAMGIXyh9PxutjtAO5qDWEJKs.png', 'female', 'single', NULL, NULL, 0, 0, '$2y$12$RIn3lbvi5M9om0sp98x.Ve7C.SuAYq2OjZwvgdXffKXsqUBsnLe0S', NULL, '2024-01-07 23:22:40', '2024-01-07 23:22:57', 'Beck Dejesus', 0, 'avatar.png', 0, NULL),
(2, '6f17cdf4-3ed0-478e-b42b-3d215d025339', 'Rana', 'Stout', NULL, 'healthProfessioner', 'Aut consequuntur nes', 'xunos', 'vykaroro@mailinator.com', NULL, NULL, '2024-01-08 00:00:38', NULL, NULL, NULL, 'profiles/cwVBXnClbpyNyFfJ5KM685YVqQ7BNLa23ckjUkdU.png', 'male', 'single', NULL, NULL, 0, 0, '$2y$12$DqRKhQ6EehxJnFgBpryu3OBtJd0jypxLIRGZKwLo6HSJUmxJMft3a', NULL, '2024-01-08 00:00:24', '2024-01-08 00:00:38', 'Rana Stout', 0, 'avatar.png', 0, NULL),
(3, 'c5213d06-feca-4b3e-be23-1475e38fda7b', 'Germane', 'Bird', NULL, 'healthProfessioner', 'In voluptatum sequi', 'bavag', 'zyqufahe@mailinator.com', NULL, NULL, '2024-01-08 00:14:45', NULL, NULL, NULL, 'profiles/6mb2kHG1o1zHBRljaMzwlNz1R94cKM1Gr4amo7xd.png', 'female', 'single', NULL, NULL, 0, 0, '$2y$12$GZRno84b3HwM/FamiB1XsuvnqWm8.EahGK4vUZ616QloICEv6l14W', NULL, '2024-01-08 00:14:34', '2024-01-08 00:14:45', 'Germane Bird', 0, 'avatar.png', 0, NULL),
(4, '5c0cd30b-0569-4c49-ae51-1de13ac71e0e', 'Cruz', 'Mayer', NULL, 'healthProfessioner', 'Quidem enim dolores', 'mewaxixa', 'cywage@mailinator.com', NULL, NULL, '2024-01-08 00:22:56', NULL, NULL, NULL, 'profiles/wULWvKL2pVOe0mjeVipJlJYtEj4uJlXaUqY2juGD.png', 'male', 'single', NULL, NULL, 0, 0, '$2y$12$VgZWCUKSCZrWP8ukKmX9wOQIdbGRoBFqy8FAfCGBiY9v4.nFGS/Ae', NULL, '2024-01-08 00:22:43', '2024-01-08 00:22:56', 'Cruz Mayer', 0, 'avatar.png', 0, NULL),
(5, '6a6df78e-f3ac-4425-85f8-17674c5d0ce6', 'Quin', 'Nieves', NULL, 'healthProfessioner', 'Corporis ut repudian', 'vemix', 'wagyqufo@mailinator.com', NULL, NULL, '2024-01-08 00:36:34', NULL, NULL, NULL, 'profiles/d1lntnVQXUIheVVXE5iz0dDdZolyYgZt7TMXhtRM.png', 'female', 'single', NULL, NULL, 0, 0, '$2y$12$R1faS7u4oMz/6Z5X8jPcT.aAZZg6/OZft1bEKClq2yeTRU80xhLUG', NULL, '2024-01-08 00:36:23', '2024-01-08 00:36:34', 'Quin Nieves', 0, 'avatar.png', 0, NULL),
(6, '4f1945ad-ddba-4dc3-b8f0-e3b1cd5c6ea1', 'Clarke', 'Blackwell', NULL, 'healthProfessioner', 'In sit ut odit illu', 'vilyqa', 'kaqyjehe@mailinator.com', NULL, NULL, '2024-01-08 01:42:40', NULL, NULL, NULL, 'profiles/RuuCz3XSmBU5r5zkOCQm7j4ZzTxLc3azkTGXhF8M.png', 'male', 'single', NULL, NULL, 0, 0, '$2y$12$RIn3lbvi5M9om0sp98x.Ve7C.SuAYq2OjZwvgdXffKXsqUBsnLe0S', NULL, '2024-01-08 01:42:29', '2024-01-08 01:42:40', 'Clarke Blackwell', 0, 'avatar.png', 0, NULL),
(7, '95f31478-a125-4f26-b025-39be8277279b', 'Linus', 'Newman', NULL, 'healthProfessioner', 'Eum corporis incidid', 'qozalari', 'coxeqapy@mailinator.com', NULL, NULL, '2024-01-08 02:04:03', NULL, NULL, NULL, 'profiles/vzdfOgRHOLVRHBhbR5wP2mXhx8U2aMdBnDXJcMrl.png', 'female', 'single', NULL, NULL, 0, 0, '$2y$12$lWitNRhV/4dVYRvK.zUt5.YRjjwF/pEpQsphinJ0rdUpo1Df6gcW6', NULL, '2024-01-08 02:03:52', '2024-01-08 02:04:03', 'Linus Newman', 0, 'avatar.png', 0, NULL),
(8, '6276c65f-a01a-4bd8-9712-a859a16e2e33', 'Rina', 'England', NULL, 'generalUser', 'Voluptas officia eum', 'jizodej', 'bazu@mailinator.com', NULL, NULL, '2024-01-08 02:26:21', NULL, NULL, NULL, 'profiles/jN2CeSmQuFpidMLFlmKxAMxy4ckKPWKWjG0U1jsL.png', 'female', 'single', NULL, NULL, 0, 0, '$2y$12$41MbtkHcOAD83ZGm9GXvf.dKreSfINhPysto/dAYqrz3fkqorLHQ2', NULL, '2024-01-08 02:26:14', '2024-01-08 02:26:21', 'Rina England', 0, 'avatar.png', 0, NULL),
(9, '854f6aa5-8174-4736-8263-c7d771a836e9', 'Marshall', 'Holmes', NULL, 'healthProfessioner', 'Non eiusmod amet am', 'suxefuzutu', 'buwaginiz@mailinator.com', NULL, NULL, '2024-01-08 02:29:50', NULL, NULL, NULL, 'profiles/SGSqQP8Ox1J4OfY1mDaaFFNocDtd5NgYNgmNpJxz.png', 'female', 'single', NULL, NULL, 0, 0, '$2y$12$UluPNw02c5LcqE4GLEGhLOt2m9DnXpUEV0bfiCJAxjQWDD1ri2DkK', NULL, '2024-01-08 02:29:43', '2024-01-08 02:29:50', 'Marshall Holmes', 0, 'avatar.png', 0, NULL),
(10, 'db91a68f-6bc0-4306-b207-7782c485cbc4', 'Ora', 'Garcia', NULL, 'healthProfessioner', 'Facilis eius incidid', 'rifedabo', 'fidabele@mailinator.com', NULL, NULL, '2024-01-08 02:46:19', NULL, NULL, NULL, 'profiles/E8A4GuTDioW7arjhMeLaMEJCyz1xSXze5TWjEjuA.png', 'male', 'single', NULL, NULL, 0, 0, '$2y$12$PuClBX023S.FH/we7SRbdubw2nUM2h/Jpfe.qyCXhBBAh7vBCf5gS', NULL, '2024-01-08 02:46:13', '2024-01-08 02:46:19', 'Ora Garcia', 0, 'avatar.png', 0, NULL),
(11, '1203cc8b-20f2-4d29-bf1e-56171d64db02', 'Stella', 'Macias', NULL, 'healthProfessioner', 'Est reiciendis qui', 'divopanyz', 'niwawe@mailinator.com', NULL, NULL, '2024-01-08 02:55:27', NULL, NULL, NULL, 'profiles/uJb4nc6gwRpr41E7EjA2EhJEIF2GeGjh3sSQVxQu.png', 'male', 'single', NULL, NULL, 0, 0, '$2y$12$94y7h0b8qpyoLNWDp3ZFseUva9gGymJ45NQEmHPC5nh/61k5LQJFa', NULL, '2024-01-08 02:55:18', '2024-01-08 02:55:27', 'Stella Macias', 0, 'avatar.png', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `customer_supports`
--
ALTER TABLE `customer_supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `followers_follower_id_foreign` (`follower_id`),
  ADD KEY `followers_following_id_foreign` (`following_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friends_user_id_foreign` (`user_id`),
  ADD KEY `friends_friend_id_foreign` (`friend_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_user_id_foreign` (`user_id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_members_user_id_foreign` (`user_id`),
  ADD KEY `group_members_group_id_foreign` (`group_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_post_id_foreign` (`post_id`),
  ADD KEY `likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_user_id_foreign` (`user_id`);

--
-- Indexes for table `page_likes`
--
ALTER TABLE `page_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_likes_user_id_foreign` (`user_id`),
  ADD KEY `page_likes_page_id_foreign` (`page_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_page_id_foreign` (`page_id`),
  ADD KEY `posts_group_id_foreign` (`group_id`);

--
-- Indexes for table `post_media`
--
ALTER TABLE `post_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_media_post_id_foreign` (`post_id`);

--
-- Indexes for table `saved_posts`
--
ALTER TABLE `saved_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_posts_user_id_foreign` (`user_id`),
  ADD KEY `saved_posts_post_id_foreign` (`post_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stories_user_id_foreign` (`user_id`);

--
-- Indexes for table `story_comments`
--
ALTER TABLE `story_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `story_comments_story_id_foreign` (`story_id`),
  ADD KEY `story_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_supports`
--
ALTER TABLE `customer_supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page_likes`
--
ALTER TABLE `page_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `post_media`
--
ALTER TABLE `post_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `saved_posts`
--
ALTER TABLE `saved_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `story_comments`
--
ALTER TABLE `story_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `followers_following_id_foreign` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friends_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_likes`
--
ALTER TABLE `page_likes`
  ADD CONSTRAINT `page_likes_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `page_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_media`
--
ALTER TABLE `post_media`
  ADD CONSTRAINT `post_media_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `saved_posts`
--
ALTER TABLE `saved_posts`
  ADD CONSTRAINT `saved_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saved_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `story_comments`
--
ALTER TABLE `story_comments`
  ADD CONSTRAINT `story_comments_story_id_foreign` FOREIGN KEY (`story_id`) REFERENCES `stories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `story_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
