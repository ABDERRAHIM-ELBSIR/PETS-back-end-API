-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 11 mars 2023 à 10:28
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pets_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `animals_breeds`
--

CREATE TABLE `animals_breeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `animals_breeds`
--

INSERT INTO `animals_breeds` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'cat', NULL, NULL),
(2, 'doge', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `has_reply` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comments_replies`
--

CREATE TABLE `comments_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `files`
--

INSERT INTO `files` (`id`, `type`, `size`, `name`, `file`, `created_at`, `updated_at`) VALUES
(54, 'jpg', 20025, 'default', 'images/posts/B3IgGeF8SRV3ZvuQzqsfXvLKw20MMR0P5rDPYlW7.jpg', '2023-03-11 08:22:06', '2023-03-11 08:22:06'),
(55, 'jpg', 20025, 'default', 'images/posts/RGkkDAo5Trs0bGEK0ILXjYrasPei1B8be1vpn01X.jpg', '2023-03-11 08:26:18', '2023-03-11 08:26:18');

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_from` bigint(20) UNSIGNED NOT NULL,
  `request_to` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `friends`
--

INSERT INTO `friends` (`id`, `request_from`, `request_to`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 0, NULL, NULL),
(2, 3, 5, 1, NULL, NULL),
(3, 3, 6, 0, NULL, NULL),
(4, 3, 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile_img` bigint(20) UNSIGNED DEFAULT NULL,
  `cover_img` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`id`, `name`, `profile_img`, `cover_img`, `description`, `created_at`, `updated_at`) VALUES
(1, 'abderahim_laravel', NULL, NULL, 'learn laravel', '2023-02-22 14:41:50', '2023-02-22 14:41:50'),
(2, 'abderahim_laravel', NULL, NULL, 'have smal pick', '2023-02-22 14:43:10', '2023-02-22 14:43:10'),
(3, 'abderahim_laravel', NULL, NULL, 'have smal pick', '2023-02-22 14:45:50', '2023-02-22 14:45:50'),
(5, 'abderahim_laravel', NULL, NULL, 'have smal pick', '2023-02-22 15:00:24', '2023-02-22 15:00:24');

-- --------------------------------------------------------

--
-- Structure de la table `groups_members`
--

CREATE TABLE `groups_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groups_members`
--

INSERT INTO `groups_members` (`id`, `user_id`, `group_id`, `role`, `accepted`, `created_at`, `updated_at`) VALUES
(3, 3, 1, 'admin', 1, NULL, NULL),
(4, 4, 1, 'user', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groups_posts`
--

CREATE TABLE `groups_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groups_posts`
--

INSERT INTO `groups_posts` (`id`, `post_id`, `group_id`, `accepted`, `created_at`, `updated_at`) VALUES
(1, 89, 1, 0, '2023-03-09 19:41:25', '2023-03-09 19:41:25'),
(2, 90, 1, 0, '2023-03-09 19:54:06', '2023-03-09 19:54:06'),
(3, 91, 1, 0, '2023-03-09 19:54:49', '2023-03-09 19:54:49'),
(4, 92, 1, 0, '2023-03-10 21:19:59', '2023-03-10 21:19:59');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reciever_id` bigint(20) UNSIGNED NOT NULL,
  `file_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `content`, `status`, `user_id`, `reciever_id`, `file_id`, `type`, `created_at`, `updated_at`) VALUES
(4, 'hi', 1, 3, 4, NULL, '4', '2023-03-01 10:11:32', '2023-03-01 10:11:32'),
(5, 'hi', 1, 3, 4, NULL, '4', '2023-03-01 10:12:31', '2023-03-01 10:12:31'),
(6, 'hi', 0, 3, 4, NULL, 'C:\\xampp\\tmp\\php86AA.tmp', '2023-03-01 13:02:31', '2023-03-01 13:02:31'),
(8, 'hi', 1, 3, 4, NULL, 'vidio', '2023-03-01 13:13:55', '2023-03-01 13:13:55'),
(10, 'hi', 1, 3, 4, NULL, 'vidio', '2023-03-08 07:01:55', '2023-03-08 07:01:55');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2013_07_06_111146_creat_animals_breeds_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2023_02_06_111226_create_friends_table', 1),
(8, '2023_02_06_111250_create_posts_table', 1),
(9, '2023_02_06_111325_create_likes_table', 1),
(10, '2023_02_06_111346_create_comments_table', 1),
(11, '2023_02_06_111414_create_comments_replies_table', 1),
(13, '2023_02_06_111459_create_messages_table', 1),
(14, '2023_02_06_111523_create_groups_table', 1),
(15, '2023_02_06_111555_create_groups_members_table', 1),
(16, '2023_02_06_111626_create_groups_posts_table', 1),
(17, '2023_02_24_103128_create_notifications_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('00771692-695f-4f42-9f2b-c9ed2eac4b55', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:44:47', '2023-03-07 07:44:47'),
('013a5d7a-f3cc-4204-9bc7-e96f1f2cb4ec', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:23:02', '2023-03-07 08:23:02'),
('031fc36f-68a9-4719-9900-564be5ca394d', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 06:56:34', '2023-03-07 06:56:34'),
('06d13521-f3af-4f24-9207-bc8ed2caa044', 'App\\Notifications\\GroupNotification', 'App\\Models\\User', 3, '{\"user\":{\"name\":\"abde\",\"profile\":null},\"post_description\":\"testTrait\",\"group_name\":\"abderahim_laravel\"}', NULL, '2023-03-10 21:19:59', '2023-03-10 21:19:59'),
('0aaba0a8-4b4f-410c-bb3d-a975ff0f9173', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:49:05', '2023-03-07 07:49:05'),
('0c37fd16-d2e5-442b-a717-facf76d55d70', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:44:47', '2023-03-07 07:44:47'),
('0fb90798-e22b-4bdf-9eee-8b62f4d6315e', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:22:09', '2023-03-07 08:22:09'),
('1062de9f-8876-4c6b-a3ba-4703309ca7d7', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:39:23', '2023-03-06 19:39:23'),
('11f6855b-c504-4eef-b834-c1b3eb908129', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:32:23', '2023-03-07 08:32:23'),
('13f81718-0248-4daa-b6d2-4c7bb235c06c', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:59:19', '2023-03-07 07:59:19'),
('1683e14b-1571-4677-ad2c-1df2fd78ca01', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:31:57', '2023-03-07 08:31:57'),
('1777fc63-9f3b-4c0f-b3ba-a50170b6e192', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:37:34', '2023-03-06 19:37:34'),
('17d6f929-79d4-410e-832a-1d5250ef0b2f', 'App\\Notifications\\CommentNotification', 'App\\Models\\User', 6, '{\"user_create_comment\":\"abde\",\"user_comment_img\":null,\"comment_post_id\":\"2\",\"message\":\"commented in your post\"}', NULL, '2023-03-01 13:58:56', '2023-03-01 13:58:56'),
('1a857ece-3f76-4921-8bf7-bf3a382c0b5c', 'App\\Notifications\\GroupNotification', 'App\\Models\\User', 4, '{\"user\":{\"name\":\"abde\",\"profile\":null},\"post_description\":\"testTrait\",\"group_name\":\"abderahim_laravel\"}', NULL, '2023-03-10 21:19:59', '2023-03-10 21:19:59'),
('1b5ef227-81d6-4cbf-b914-d42c8f0c7ee7', 'App\\Notifications\\MessageNotification', 'App\\Models\\User', 3, '{\"user_name\":\"abde\",\"user_img\":null,\"message\":\"send message\"}', NULL, '2023-03-08 08:03:28', '2023-03-08 08:03:28'),
('1d556e04-2ea1-421c-935f-57cfdb89a4e8', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:22:02', '2023-03-07 08:22:02'),
('1f3bc599-1e3a-4d59-8325-65045b045412', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:08:56', '2023-03-07 07:08:56'),
('1f416d6f-3207-49cf-8245-d31c3b12cd50', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:23:02', '2023-03-07 08:23:02'),
('1fecec64-0750-42ef-9286-97b382ef8054', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:22:58', '2023-03-07 08:22:58'),
('220c29f0-20e5-48bf-8ef1-557cf95a65f6', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:31:57', '2023-03-07 08:31:57'),
('2260def0-45f1-4ea0-8881-69d9b787fabd', 'App\\Notifications\\MessageNotification', 'App\\Models\\User', 3, '{\"user_name\":\"abde\",\"user_img\":null,\"message\":\"send message\"}', NULL, '2023-03-08 07:40:10', '2023-03-08 07:40:10'),
('22c52a9d-bcf8-40b2-8c20-b90dcae9c967', 'App\\Notifications\\MessageNotification', 'App\\Models\\User', 3, '{\"user_name\":\"abde\",\"user_img\":null,\"message\":\"send message\"}', NULL, '2023-03-08 07:15:25', '2023-03-08 07:15:25'),
('22db026b-9dc3-4018-b94c-0868be93b714', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-11 08:22:06', '2023-03-11 08:22:06'),
('23db83a9-c3f7-469f-bbef-d58b2d98f74b', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:05:09', '2023-03-07 08:05:09'),
('2fb8b09b-c984-4ac6-aece-004b3d9e4b4a', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:49:05', '2023-03-07 07:49:05'),
('3082a844-b4cb-4690-834c-f2f756a89e43', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:22:02', '2023-03-07 08:22:02'),
('334963e5-557f-4606-89ec-dff98ef4d9ad', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":\"img not found\",\"message\":\"create a new post\"}', NULL, '2023-03-06 19:10:57', '2023-03-06 19:10:57'),
('36809e5c-d273-47e8-8069-3177f587f3cb', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:49:05', '2023-03-07 07:49:05'),
('38e8e45b-46df-42e9-bd12-8b569cf020a1', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:22:09', '2023-03-07 08:22:09'),
('3ab9b34f-1a60-490d-a40d-e8a97881d3f3', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:39:23', '2023-03-06 19:39:23'),
('3b76e7b6-bee9-44fe-b3d5-91c6fa25867b', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:20:51', '2023-03-06 19:20:51'),
('3c7903b6-28f7-4c4e-ba86-8f0241356261', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:59:19', '2023-03-07 07:59:19'),
('41e8372b-517e-40ff-aef7-d2ea01d04523', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:20:51', '2023-03-06 19:20:51'),
('43d5a0a5-8255-47c1-99d9-0d2980b77f47', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:21:48', '2023-03-06 19:21:48'),
('4648deb8-7d1d-4806-8612-d2002cece4fc', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 06:58:19', '2023-03-07 06:58:19'),
('46ca0bdc-d29a-4c3f-90ee-261b6d4a717d', 'App\\Notifications\\MessageNotification', 'App\\Models\\User', 3, '{\"user_name\":\"abde\",\"user_img\":null,\"message\":\"send message\",\"message_create_at\":null}', NULL, '2023-03-08 07:55:42', '2023-03-08 07:55:42'),
('482b3060-faa1-4ddc-b293-cbedfa3c4f86', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:27:11', '2023-03-07 07:27:11'),
('483b6be4-908b-4c98-957c-57ba1dbc38fc', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:08:56', '2023-03-07 07:08:56'),
('48a71568-2fdf-4d22-ab26-5b172b6e05c5', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:21:48', '2023-03-06 19:21:48'),
('4a361800-831f-4b4b-a2e3-df3aed014aca', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:24:04', '2023-03-07 07:24:04'),
('4bbceb43-f6b5-4c24-a934-b038553c5c2f', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:39:23', '2023-03-06 19:39:23'),
('4c048a1a-8e76-4e85-9004-38a8deb6153c', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:08:55', '2023-03-07 07:08:55'),
('4eb8d7bb-f8fe-4595-9a06-40272bb8f853', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:22:09', '2023-03-07 08:22:09'),
('50cb8ec4-df0d-4665-9dff-b58f748db98f', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:49:05', '2023-03-07 07:49:05'),
('51031a8f-26f7-4911-852b-8ebcab07ff49', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:23:02', '2023-03-07 08:23:02'),
('517a3916-ee37-41aa-af34-f48fe3f01b6c', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:08:55', '2023-03-07 07:08:55'),
('51999e90-c9da-4386-9184-93a365a67739', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:39:50', '2023-03-06 19:39:50'),
('52099fb1-7645-4fdb-bc8f-c86152738867', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":\"img not found\",\"message\":\"create a new post\"}', NULL, '2023-03-06 19:10:57', '2023-03-06 19:10:57'),
('5881d899-dcb3-4145-a945-37dcee1f89c0', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":\"img not found\",\"message\":\"create a new post\"}', NULL, '2023-03-06 19:11:50', '2023-03-06 19:11:50'),
('5d416dbf-fd28-4193-934f-745535c09f3f', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:31:57', '2023-03-07 08:31:57'),
('645ce411-b219-4025-acbd-20fce3bc34cd', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:27:11', '2023-03-07 07:27:11'),
('678fc91d-a5ad-435c-b17e-1d5225121fd4', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:37:34', '2023-03-06 19:37:34'),
('6b37d900-3e99-4aef-b45a-508e12ee677d', 'App\\Notifications\\MessageNotification', 'App\\Models\\User', 3, '{\"user_name\":\"abde\",\"user_img\":null,\"message\":\"send message\",\"message_create_at\":null}', NULL, '2023-03-08 08:04:39', '2023-03-08 08:04:39'),
('745560fc-8c69-4fa7-b07b-abb43b8fb526', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:21:48', '2023-03-06 19:21:48'),
('7df2560d-7b98-497b-94ec-c3654839f926', 'App\\Notifications\\MessageNotification', 'App\\Models\\User', 3, '{\"user_name\":\"abde\",\"user_img\":null,\"message\":\"send message\"}', NULL, '2023-03-08 08:05:57', '2023-03-08 08:05:57'),
('7f99092a-5e74-43f4-b94d-cf39ee2bbf3e', 'App\\Notifications\\MessageNotification', 'App\\Models\\User', 3, '{\"user_name\":\"abde\",\"user_img\":null,\"message\":\"send message\",\"message_create_at\":null}', NULL, '2023-03-08 07:44:39', '2023-03-08 07:44:39'),
('8146ef01-53b0-41b4-ac80-8717baae628e', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:39:23', '2023-03-06 19:39:23'),
('8383c358-3c32-43bb-8476-cce3a774fb55', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:44:47', '2023-03-07 07:44:47'),
('83e90839-30c7-43dd-8bb5-7565e4c4aa58', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:22:02', '2023-03-07 08:22:02'),
('8461acf3-430a-458e-929d-19a6f3e65399', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:20:10', '2023-03-06 19:20:10'),
('857bfbd3-6f92-44cd-a8ad-9b980f4313ab', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 06:58:19', '2023-03-07 06:58:19'),
('86beb46c-c3af-46d5-994b-f13b6e38811b', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:01:44', '2023-03-07 08:01:44'),
('87435777-1fd2-4e28-a7bb-94b8cf29cfa6', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:32:27', '2023-03-07 08:32:27'),
('880be4fa-ffa7-4723-8845-414e5031e434', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:24:04', '2023-03-07 07:24:04'),
('8a53094c-f8f8-45d6-9c47-2c33b243ce90', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:32:27', '2023-03-07 08:32:27'),
('8b859f70-2adc-4dda-8381-c81c806ddd73', 'App\\Notifications\\MessageNotification', 'App\\Models\\User', 3, '{\"user_name\":\"abde\",\"user_img\":null,\"message\":\"send message\"}', NULL, '2023-03-08 08:06:42', '2023-03-08 08:06:42'),
('8ba87924-663c-44e8-9b51-596ec5361d78', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:32:27', '2023-03-07 08:32:27'),
('91e55112-ba40-4a57-a780-5c627fabb4e7', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:59:19', '2023-03-07 07:59:19'),
('93893a21-d783-4470-a03f-3f765a339514', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-11 08:19:24', '2023-03-11 08:19:24'),
('9433c69a-34a2-4faa-af02-e4d22c0629f8', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:44:47', '2023-03-07 07:44:47'),
('955e29aa-5980-47b2-9eed-7b64dd2a9d25', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:32:23', '2023-03-07 08:32:23'),
('96de0b0b-7938-455f-9ed5-9e7e4e61545d', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":\"img not found\",\"message\":\"create a new post\"}', NULL, '2023-03-06 19:11:50', '2023-03-06 19:11:50'),
('982c8492-b3da-4eb3-bf86-fffb5f479e40', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":\"img not found\",\"message\":\"create a new post\"}', NULL, '2023-03-06 19:10:57', '2023-03-06 19:10:57'),
('98d151f1-f6f2-4a0b-827c-c9edf697bef4', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":\"img not found\",\"message\":\"create a new post\"}', NULL, '2023-03-06 19:11:50', '2023-03-06 19:11:50'),
('9abd85c5-02e0-419f-9c67-89b486c34d27', 'App\\Notifications\\MessageNotification', 'App\\Models\\User', 3, '{\"user_name\":\"abde\",\"user_img\":null,\"message\":\"send message\"}', NULL, '2023-03-08 07:13:15', '2023-03-08 07:13:15'),
('9b8abf7a-e489-4aa5-b611-9879a61e4a09', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:31:57', '2023-03-07 08:31:57'),
('9dbacfaa-ff0f-4d14-baa5-304ac16942f5', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:05:09', '2023-03-07 08:05:09'),
('9dcc3bcc-ec23-4c0f-bfa0-b7759a189ed1', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-11 08:22:06', '2023-03-11 08:22:06'),
('a14d6bfb-4134-48e3-9875-eb0b8f2c51fd', 'App\\Notifications\\MessageNotification', 'App\\Models\\User', 3, '{\"user_name\":\"abde\",\"user_img\":null,\"message\":\"send message\"}', NULL, '2023-03-08 07:37:44', '2023-03-08 07:37:44'),
('a1e4873a-c345-40e9-a08d-dd424628f151', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 06:58:19', '2023-03-07 06:58:19'),
('a2727694-1aa9-4436-90ac-d2587b75c5a7', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 06:56:34', '2023-03-07 06:56:34'),
('a38adb6b-4605-410b-b095-1c1f2b7d5a3e', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-11 08:26:18', '2023-03-11 08:26:18'),
('a3c60a30-52cc-4a63-ba49-e055136fa631', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-11 08:19:24', '2023-03-11 08:19:24'),
('a5275874-1a37-4bd4-8f37-5fabfa77e7c9', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:05:09', '2023-03-07 08:05:09'),
('a5e0865d-a739-474c-b415-46658b5c13dc', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-11 08:19:24', '2023-03-11 08:19:24'),
('a5f85e4d-4005-4670-8894-70612bd07386', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:24:04', '2023-03-07 07:24:04'),
('a6693ffc-e076-47a4-a7ed-480728a51216', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post\":3,\"post_description\":\"post crete with notification 11\"}', NULL, '2023-02-27 19:36:08', '2023-02-27 19:36:08'),
('a6a54f92-3b14-4c8d-8b5e-975ebf7e7b5d', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-11 08:19:24', '2023-03-11 08:19:24'),
('a6bc20e9-8a6a-4a19-9ba9-1ff057b92075', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 06:58:19', '2023-03-07 06:58:19'),
('abc900e1-0883-4424-b1d8-877a9b4f82ea', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-11 08:26:18', '2023-03-11 08:26:18'),
('adee14d9-4b3e-4092-8cea-9eaa06468a95', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:39:50', '2023-03-06 19:39:50'),
('b32a4769-12fd-40d3-afa8-a811e91f111d', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:32:23', '2023-03-07 08:32:23'),
('b4535042-e0b9-414b-b1bc-7a9604910773', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:32:23', '2023-03-07 08:32:23'),
('b8c1a222-c67a-41e5-91a3-7ac0e560bed7', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:24:04', '2023-03-07 07:24:04'),
('c422c2af-458b-4155-8059-70609cecb348', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post\":3,\"post_description\":\"post crete with notification 11\"}', NULL, '2023-02-27 19:36:08', '2023-02-27 19:36:08'),
('c677b191-5560-4b22-97ba-7b3b3089ca51', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 06:56:34', '2023-03-07 06:56:34'),
('c7ad72f4-5317-4355-b0b7-f3c30b7f4845', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-11 08:26:18', '2023-03-11 08:26:18'),
('c815b610-89a3-4c9f-bf95-858f9de4f8e2', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 06:56:34', '2023-03-07 06:56:34'),
('cbd0cd75-0d11-46a1-87af-8ca44d529dc7', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:37:34', '2023-03-06 19:37:34'),
('d2466324-2b2e-4953-a706-6185fa664f94', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:20:10', '2023-03-06 19:20:10'),
('d3ac4eba-dd8d-4bc6-9dbc-807af0d72caa', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:59:19', '2023-03-07 07:59:19'),
('d516787e-0b4b-438f-8a79-84002e4e754e', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":\"img not found\",\"message\":\"create a new post\"}', NULL, '2023-03-06 19:10:57', '2023-03-06 19:10:57'),
('d5f49165-7c6d-4995-9d95-e0dd6ac739d7', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:01:44', '2023-03-07 08:01:44'),
('d7a69c2e-afc2-413b-b629-5aec5c00221c', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:20:51', '2023-03-06 19:20:51'),
('d7f7190b-f803-4e0a-b7d6-3ebe24b26780', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:01:44', '2023-03-07 08:01:44'),
('d8966d51-30f0-413a-9d3b-bac6df070d50', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:27:11', '2023-03-07 07:27:11'),
('d8cbe4c7-1222-43f8-83af-f5c2b7253f3f', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:05:09', '2023-03-07 08:05:09'),
('dad7eb6c-c351-4cdb-8d7b-423121530bd9', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:22:09', '2023-03-07 08:22:09'),
('db49d2de-83ef-48b3-87ea-df1eceedf855', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-11 08:22:06', '2023-03-11 08:22:06'),
('dd87d97c-a509-4e9d-82db-715c58c0229c', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:37:34', '2023-03-06 19:37:34'),
('de3e13a1-1534-4977-8e67-156011dc5d1e', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:22:58', '2023-03-07 08:22:58'),
('e1d424e9-eb8e-476b-abe4-61023204d392', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:22:02', '2023-03-07 08:22:02'),
('e391443f-9fce-4795-ae93-2767339df0a4', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-11 08:26:18', '2023-03-11 08:26:18'),
('e46c4a20-401f-4e96-8add-8ba46627cab8', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:22:58', '2023-03-07 08:22:58'),
('e4a65b1c-006d-46ee-b18a-aae18b6e0884', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":\"img not found\",\"message\":\"create a new post\"}', NULL, '2023-03-06 19:11:50', '2023-03-06 19:11:50'),
('e7ffea2d-e801-4573-98b8-0a049c80c1e1', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:01:44', '2023-03-07 08:01:44'),
('f1b2c736-f58f-47f6-80d1-47093cd509d0', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-11 08:22:06', '2023-03-11 08:22:06'),
('f329fc8f-3d94-45b6-ba01-1f6ad609073c', 'App\\Notifications\\MessageNotification', 'App\\Models\\User', 3, '{\"user_name\":\"abde\",\"user_img\":null,\"message\":\"send message\",\"message_create_at\":null}', NULL, '2023-03-08 07:59:31', '2023-03-08 07:59:31'),
('f348ec98-976f-4788-9f71-e25fa4779647', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:20:10', '2023-03-06 19:20:10'),
('f3d52b23-c685-4bcb-96de-8bfc5d7b3406', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:39:50', '2023-03-06 19:39:50'),
('f3e95cc2-3489-49b9-ba26-3f579078a953', 'App\\Notifications\\likesNotification', 'App\\Models\\User', 6, '{\"name_of_user_liked\":\"abde\",\"profile_img\":null,\"user_id\":6,\"message\":\"liked your post\"}', NULL, '2023-02-28 22:54:30', '2023-02-28 22:54:30'),
('f419659d-b93c-499a-9a15-18fcc76473d4', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 4, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:21:48', '2023-03-06 19:21:48'),
('f8f53e95-62c1-46c3-9aae-8b5dda958c74', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:20:51', '2023-03-06 19:20:51'),
('fb663507-1938-432c-a6fc-4bf05911b30b', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:39:50', '2023-03-06 19:39:50'),
('fbc8b832-47ad-42af-a264-17b2b82610b3', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-06 19:20:10', '2023-03-06 19:20:10'),
('fbd4631e-7abc-4ef3-a950-6c010f0e9894', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 07:27:11', '2023-03-07 07:27:11'),
('fdc9aa1b-8812-47d8-a2a5-38e56291c142', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:22:58', '2023-03-07 08:22:58'),
('fe19f519-c346-4059-8044-4e2ba269afb9', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 3, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:23:02', '2023-03-07 08:23:02'),
('ff67d94a-10ec-4495-a225-d45ab7e5f5f7', 'App\\Notifications\\PostNotification', 'App\\Models\\User', 5, '{\"user_create_post_name\":\"abde\",\"user_create_post_img\":null,\"message\":\"create a new post\"}', NULL, '2023-03-07 08:32:27', '2023-03-07 08:32:27');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_group_post` tinyint(1) NOT NULL,
  `type` varchar(255) NOT NULL,
  `file_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `description`, `user_id`, `is_group_post`, `type`, `file_id`, `created_at`, `updated_at`) VALUES
(77, 'testTrait', 3, 0, 'text', NULL, '2023-03-07 08:01:44', '2023-03-07 08:01:44'),
(79, 'testTrait', 3, 0, 'text', NULL, '2023-03-07 08:22:02', '2023-03-07 08:22:02'),
(85, 'testTrait', 3, 0, 'text', NULL, '2023-03-07 08:32:27', '2023-03-07 08:32:27'),
(86, 'testTrait', 3, 1, 'text', NULL, '2023-03-09 19:36:07', '2023-03-09 19:36:07'),
(87, 'testTrait', 3, 1, 'text', NULL, '2023-03-09 19:38:37', '2023-03-09 19:38:37'),
(88, 'testTrait', 3, 1, 'text', NULL, '2023-03-09 19:39:01', '2023-03-09 19:39:01'),
(89, 'testTrait', 3, 1, 'text', NULL, '2023-03-09 19:41:25', '2023-03-09 19:41:25'),
(90, 'testTrait', 3, 1, 'text', NULL, '2023-03-09 19:54:06', '2023-03-09 19:54:06'),
(91, 'testTrait', 3, 0, 'text', NULL, '2023-03-09 19:54:49', '2023-03-09 19:54:49'),
(92, 'testTrait', 3, 0, 'text', NULL, '2023-03-10 21:19:59', '2023-03-10 21:19:59'),
(94, 'testTrait', 3, 0, 'image', 54, '2023-03-11 08:22:06', '2023-03-11 08:22:06'),
(95, 'testTrait', 3, 0, 'image', 55, '2023-03-11 08:26:18', '2023-03-11 08:26:18');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `profile_img` bigint(20) UNSIGNED DEFAULT NULL,
  `cover_img` bigint(20) UNSIGNED DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `breed_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `profile_img`, `cover_img`, `birthday`, `address`, `gender`, `breed_id`, `created_at`, `updated_at`, `remember_token`) VALUES
(3, 'abde', 'abderahim@gmail.comsdf', '$2y$10$ncEcbTvWfv9Zpji0gAgit.Vk3Jfhxoo/lBsxa.EPlTsoc48L0Co56', '12345678565', NULL, NULL, '2000-07-09', 'hdsfbehjbdcshjdcbshd', 'male', 2, '2023-02-21 07:20:22', '2023-02-21 07:20:22', NULL),
(4, 'abde', 'abderahimlbssir@gmail.comsdf', '$2y$10$fONLV/.7h6hwp2pcRd8BdO3ucn6Gu3W4yXtNWu9uL7ogdQoBx.gNu', '12345678565', NULL, NULL, '2000-07-09', 'hdsfbehjbdcshjdcbshd', 'male', 2, '2023-02-21 07:20:37', '2023-02-21 07:20:37', NULL),
(5, 'abde', 'abderahimlbssir1234@gmail.comsdf', '$2y$10$rbnXF8ltMimHvjuU0fKcj.7MFmiJBjr4FM/9iRCcdbOGIT.kvfc7u', '12345678565', NULL, NULL, '2000-07-09', 'hdsfbehjbdcshjdcbshd', 'male', 2, '2023-02-21 07:20:49', '2023-02-21 07:20:49', NULL),
(6, 'abde', 'abderahimlbssir1234@gmail.com', '$2y$10$1ZijkY/fDBua7Z3Z8WaYjeg/.miRKKSLiuD8NtLUfOLEtKcMx8qd6', '12345678565', NULL, NULL, '2000-07-09', 'hdsfbehjbdcshjdcbshd', 'male', 2, '2023-02-21 07:24:42', '2023-02-21 07:24:42', NULL),
(7, 'abde', 'abderahimàààà@gmail.com', '$2y$10$sL11Ytuxv8.sidwFNDV2X.Lco9UwDOF9Y.oL23qq4w/Aq.rv5PDRG', '12345678998', NULL, NULL, '2000-01-09', 'TAMADANT', 'femal', 1, '2023-02-24 04:49:52', '2023-02-24 04:49:52', NULL),
(8, 'abde', 'abderoikotu@gmail.com', '$2y$10$W8f0Knu6gtzbZsFAi2l9POK4fpTerxUoet/lrdo44wyvTRo/09nrW', '12345678998', NULL, NULL, '2000-01-09', 'TAMADANT', 'femal', 1, '2023-02-25 07:21:48', '2023-02-25 07:21:48', NULL),
(9, 'abde', 'abderoikryry@gmail.com', '$2y$10$pcHHp0h91jGIkZLpkf0P6el4KpR76l0ccgcqONsDT12Duot/dBQQu', '12345678998', NULL, NULL, '2000-01-09', 'TAMADANT', 'femal', 1, '2023-02-25 07:23:09', '2023-02-25 07:23:09', NULL),
(10, 'abde', 'abderoikryjjjjjjry@gmail.com', '$2y$10$Hng.gOBOV5KdSSbfbQ8UDeclL5hS/KwD16/MXH.cKnG4vjN7sA/NG', '12345678998', NULL, NULL, '2000-01-09', 'TAMADANT', 'femal', 1, '2023-02-25 08:49:26', '2023-02-25 08:49:26', NULL),
(11, 'abde', 'abder@gmail.com', '$2y$10$tIRT7oVyDlLVKAYLVjKmHe7rUgpytVjRcv0ResZWAbGNX32ICPvv.', '12345678998', NULL, NULL, '2000-01-09', 'TAMADANT', 'femal', 1, '2023-02-28 11:14:56', '2023-02-28 11:14:56', NULL),
(1677586539, 'abde', 'abder545245@gmail.com', '$2y$10$YpWdU0sI/7Yodg1r/8FG2.jcG9Y0H0vYlELSd3NUg9CpdLgx/FbBy', '12345678998', NULL, NULL, '2000-01-09', 'TAMADANT', 'femal', 1, '2023-02-28 11:15:39', '2023-02-28 11:15:39', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animals_breeds`
--
ALTER TABLE `animals_breeds`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Index pour la table `comments_replies`
--
ALTER TABLE `comments_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_replies_comment_id_foreign` (`comment_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friends_request_from_foreign` (`request_from`),
  ADD KEY `friends_request_to_foreign` (`request_to`);

--
-- Index pour la table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_profile_img_foreign` (`profile_img`),
  ADD KEY `groups_cover_img_foreign` (`cover_img`);

--
-- Index pour la table `groups_members`
--
ALTER TABLE `groups_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_members_user_id_foreign` (`user_id`),
  ADD KEY `groups_members_group_id_foreign` (`group_id`);

--
-- Index pour la table `groups_posts`
--
ALTER TABLE `groups_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_posts_post_id_foreign` (`post_id`),
  ADD KEY `groups_posts_group_id_foreign` (`group_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_reciever_id_foreign` (`reciever_id`),
  ADD KEY `messages_file_id_foreign` (`file_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_file_id_foreign` (`file_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_cover_img_foreign` (`cover_img`),
  ADD KEY `users_breed_id_foreign` (`breed_id`),
  ADD KEY `users_profile_img_index` (`profile_img`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animals_breeds`
--
ALTER TABLE `animals_breeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `comments_replies`
--
ALTER TABLE `comments_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `groups_members`
--
ALTER TABLE `groups_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `groups_posts`
--
ALTER TABLE `groups_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1677662014;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comments_replies`
--
ALTER TABLE `comments_replies`
  ADD CONSTRAINT `comments_replies_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_request_from_foreign` FOREIGN KEY (`request_from`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friends_request_to_foreign` FOREIGN KEY (`request_to`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_cover_img_foreign` FOREIGN KEY (`cover_img`) REFERENCES `files` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `groups_profile_img_foreign` FOREIGN KEY (`profile_img`) REFERENCES `files` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `groups_members`
--
ALTER TABLE `groups_members`
  ADD CONSTRAINT `groups_members_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `groups_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `groups_posts`
--
ALTER TABLE `groups_posts`
  ADD CONSTRAINT `groups_posts_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `groups_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_reciever_id_foreign` FOREIGN KEY (`reciever_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_breed_id_foreign` FOREIGN KEY (`breed_id`) REFERENCES `animals_breeds` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_cover_img_foreign` FOREIGN KEY (`cover_img`) REFERENCES `files` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_profile_img_foreign` FOREIGN KEY (`profile_img`) REFERENCES `files` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
