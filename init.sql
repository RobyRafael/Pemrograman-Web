-- Dumping database structure for content_management_system
CREATE DATABASE IF NOT EXISTS `content_management_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `content_management_system`;

-- Dumping structure for table content_management_system.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `slug` varchar(100) NOT NULL,
  `parent_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`categories_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_categories_parent` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;

-- Inserting data into categories
INSERT INTO `categories` (`categories_id`, `name`, `description`, `slug`, `parent_id`, `created_at`, `updated_at`) VALUES
  (10, 'Teknologi', '', 'teknologi', NULL, '2024-06-10 14:24:58', '2024-06-10 14:25:17'),
	(11, 'Komputer', '', 'komputer', 10, '2024-06-10 14:25:07', '2024-06-10 14:25:22'),
	(12, 'Gadget', '', 'gadget', 10, '2024-06-10 14:25:35', '2024-06-10 14:25:35'),
	(13, 'Perangkat Lunak', '', 'perangkat-lunak', 10, '2024-06-10 14:25:47', '2024-06-10 14:25:47'),
	(14, 'Jaringan', '', 'jaringan', 10, '2024-06-10 14:25:55', '2024-06-10 14:25:55'),
	(15, 'Fashion', '', 'fashion', NULL, '2024-06-10 14:26:06', '2024-06-10 14:26:30'),
	(16, 'Pakaian Pria', '', 'pakaian-pria', 15, '2024-06-10 14:26:16', '2024-06-10 14:26:33'),
	(17, 'Pakaian Wanita', '', 'pakaian-wanita', 15, '2024-06-10 14:26:45', '2024-06-10 14:26:45'),
	(18, 'Aksesoris', '', 'aksesoris', 15, '2024-06-10 14:26:53', '2024-06-10 14:26:53'),
	(19, 'Kesehatan dan Kecantikan', '', 'kesehatan-dan-kecantikan', NULL, '2024-06-10 14:27:04', '2024-06-10 14:28:16'),
	(20, 'Perawatan Kulit', '', 'perawatan-kulit', 19, '2024-06-10 14:27:22', '2024-06-10 14:28:19'),
	(21, 'Perawatan Rambut', '', 'perawatan-rambut', 19, '2024-06-10 14:28:40', '2024-06-10 14:28:40'),
	(22, 'Suplemen Kesehatan', '', 'suplemen-kesehatan', 19, '2024-06-10 14:28:49', '2024-06-10 14:28:53'),
	(23, 'Makanan dan Minuman', '', 'makanan-dan-minuman', NULL, '2024-06-10 14:29:04', '2024-06-10 14:29:06'),
	(24, 'Makanan', '', 'makanan', 23, '2024-06-10 14:29:13', '2024-06-10 14:29:13'),
	(25, 'Minuman', '', 'minuman', 23, '2024-06-10 14:29:25', '2024-06-10 14:29:25'),
	(26, 'Bahan Masakan', '', 'bahan-masakan', 23, '2024-06-10 14:29:34', '2024-06-10 14:29:34'),
	(27, 'Hobi dan Olahraga', '', 'hobi-dan-olahraga', NULL, '2024-06-10 14:29:50', '2024-06-10 14:29:52'),
	(28, 'Olahraga', '', 'olahraga', 27, '2024-06-10 14:29:59', '2024-06-10 14:29:59'),
	(29, 'Alat Musik', '', 'alat-musik', 27, '2024-06-10 14:30:09', '2024-06-10 14:30:09'),
	(30, 'Kegiatan Luar Ruangan', '', 'kegiatan-luar-ruangan', 27, '2024-06-10 14:30:21', '2024-06-10 14:30:21'),
	(31, 'Otomotif', '', 'otomotif', NULL, '2024-06-10 14:30:42', '2024-06-10 14:30:45'),
	(32, 'Mobil', '', 'mobil', 31, '2024-06-10 14:30:50', '2024-06-10 14:30:50'),
	(33, 'Motor', '', 'motor', 31, '2024-06-10 14:30:57', '2024-06-10 14:30:57'),
	(34, 'Perawatan Kendaraan', '', 'perawatan-kendaraan', 31, '2024-06-10 14:31:13', '2024-06-10 14:31:13'),
	(35, 'Rumah dan Taman', '', 'rumah-dan-taman', NULL, '2024-06-10 14:31:22', '2024-06-10 14:31:24'),
	(36, 'Perabotan', '', 'perabotan', 35, '2024-06-10 14:31:31', '2024-06-10 14:31:31'),
	(37, 'Dekorasi Rumah', '', 'dekorasi-rumah', 35, '2024-06-10 14:31:40', '2024-06-10 14:31:40'),
	(38, 'Peralatan Taman', '', 'peralatan-taman', 35, '2024-06-10 14:31:54', '2024-06-10 14:31:54'),
	(39, 'Pendidikan dan Buku', '', 'pendidikan-dan-buku', NULL, '2024-06-10 14:32:14', '2024-06-10 14:32:29'),
	(40, 'Buku Pendidikan', '', 'buku-pendidikan', 39, '2024-06-10 14:32:37', '2024-06-10 14:32:37'),
	(41, 'Buku Fiksi', '', 'buku-fiksi', 39, '2024-06-10 14:32:43', '2024-06-10 14:32:43'),
	(42, 'Buku Non-Fiksi', '', 'buku-non-fiksi', 39, '2024-06-10 14:32:53', '2024-06-10 14:32:53'),
	(43, 'Perjalanan dan Wisata', '', 'perjalanan-dan-wisata', NULL, '2024-06-10 14:33:04', '2024-06-10 14:33:07'),
	(44, 'Destinasi', '', 'destinasi', 43, '2024-06-10 14:33:17', '2024-06-10 14:33:17'),
	(45, 'Akomodasi', '', 'akomodasi', 43, '2024-06-10 14:33:24', '2024-06-10 14:33:24'),
	(46, 'Peralatan Perjalanan', '', 'peralatan-perjalanan', 43, '2024-06-10 14:33:33', '2024-06-10 14:33:33'),
	(47, 'Anak-Anak', '', 'anak-anak', NULL, '2024-06-10 14:33:50', '2024-06-10 14:33:52'),
	(48, 'Pakaian Anak', '', 'pakaian-anak', 47, '2024-06-10 14:34:02', '2024-06-10 14:34:02'),
	(49, 'Mainan', '', 'mainan', 47, '2024-06-10 14:34:10', '2024-06-10 14:34:10'),
	(50, 'Perlengkapan Sekolah', '', 'perlengkapan-sekolah', 47, '2024-06-10 14:34:19', '2024-06-10 14:34:19');

-- Dumping structure for table content_management_system.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `posts_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(100) NOT NULL,
  `user_id` int NOT NULL,
  `status` enum('Draft','Published','Archived') NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`posts_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_posts_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Inserting data into posts
INSERT INTO `posts` (`posts_id`, `title`, `content`, `slug`, `user_id`, `status`, `featured_image`, `created_at`, `updated_at`) VALUES
  (11, 'First Post', 'This is the content of the first post.', 'first-post', 1, 'Published', 'image1.jpg', '2024-05-19 08:59:49', '2024-06-10 07:41:56'),
	(12, 'Second Post', 'This is the content of the second post.', 'second-post', 2, 'Published', 'image2.jpg', '2024-05-19 08:59:49', '2024-05-19 08:59:49'),
	(14, 'Fourth Post', 'This is the content of the fourth post.', 'fourth-post', 1, 'Published', 'image4.jpg', '2024-05-19 08:59:49', '2024-05-19 08:59:49'),
	(15, 'Fifth Post', 'This is the content of the fifth post.', 'fifth-post', 2, 'Published', 'image5.jpg', '2024-05-19 08:59:49', '2024-05-19 08:59:49'),
	(18, 'test halo sadf', '<p>asdfasdf</p>\r\n', 'test-halo-sadf', 6, 'Published', '66664b59cad04.jpg', '2024-06-09 02:28:45', '2024-06-13 02:00:54');

-- Dumping structure for table content_management_system.post_categories
CREATE TABLE IF NOT EXISTS `post_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_post_categories_posts` (`post_id`),
  KEY `FK_post_categories_categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- Inserting data into post_categories
INSERT INTO `post_categories` (`id`, `post_id`, `category_id`, `created_at`) VALUES
  (32, 18, 10, '2024-06-13 02:00:54');

-- Dumping structure for table content_management_system.users
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','author','user') NOT NULL,
  `name` varchar(100) NOT NULL,
  `bio` text,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`users_id`) USING BTREE,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Inserting data into users
INSERT INTO `users` (`users_id`, `username`, `email`, `password`, `role`, `name`, `bio`, `avatar`, `created_at`, `updated_at`) VALUES
  (1, 'admin', 'admin@example.com', 'admin_password', 'admin', 'Admin User', 'I am the administrator.', 'avatar1.jpg', '2024-05-19 08:59:49', '2024-05-19 08:59:49'),
	(2, 'editor', 'editor@example.com', 'editor_password', 'author', 'Editor User', 'I am the editor.', 'avatar2.jpg', '2024-05-19 08:59:49', '2024-05-26 14:02:41'),
	(3, 'author', 'author@example.com', 'author_password', 'author', 'Author User', 'I am the author.', 'avatar3.jpg', '2024-05-19 08:59:49', '2024-05-19 08:59:49'),
	(5, 'user2', 'user2@example.com', 'user2_password', 'user', 'Regular User 2', 'I am also a regular user.', 'avatar5.jpg', '2024-05-19 08:59:49', '2024-05-19 08:59:49'),
	(6, 'admin1', 'admin@gmail.com', '$2y$10$SLC8oovUB8DAyfkG6j5Nb.6FqZytliZvvUxxT1h9KUv4p9s8Cazv2', 'admin', 'admin', '<p>test<strong>tesatas</strong><a href="https://discord.com/channels/@me/756017868763693136/1247589060743004253"><img alt="" src="https://asset-2.tstatic.net/pontianak/foto/bank/images/Contoh-gambar-gunung-anak-sd.jpg" style="height:325px; width:319px" /></a></p>\r\n', '66664e4f82f97.jpg', '2024-06-07 03:36:19', '2024-06-13 01:11:20'),
	(7, 'halo', 'halo@gmail.com', '$2y$10$RFsYGQ9E2QXeBY1pL.n/hOwrvg4gRVjLbi5LCjwcwPheptoWErKqa', 'admin', 'halo', NULL, NULL, '2024-06-08 15:26:28', '2024-06-09 01:20:13'),
	(8, 'admin2', 'admin2@example.com', '$2y$10$98FuFkA8lYNHIlJori4G9u7Q802GKqsWgWoQvtwzx2/87CIv1K9vu', 'admin', 'admin2', NULL, NULL, '2024-06-09 04:28:58', '2024-06-09 04:28:58');
