-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2026 at 09:12 AM
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
-- Database: `lgu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(3, 'admin', '$2y$10$MMeioZ8E9QRdHWRg.hSr4.z5461BqfQOI5qrW3ECogqN8LVTP/v6i', 'admin@unisan.gov.ph', '2026-01-05 01:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` int(11) NOT NULL,
  `barangay_name` varchar(100) NOT NULL,
  `population` int(11) DEFAULT 0,
  `type` varchar(50) DEFAULT 'rural',
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `captain_name` varchar(100) DEFAULT NULL,
  `barangay_captain` varchar(100) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `barangay_name`, `population`, `type`, `description`, `image`, `captain_name`, `barangay_captain`, `contact_number`, `created_at`) VALUES
(3, 'Almacen', 853, 'Urban', NULL, NULL, NULL, 'Elmer R. Dequito', '09307175979', '2026-01-08 13:53:46'),
(4, 'Balagtas', 703, 'Rural', NULL, NULL, NULL, 'Marlon L. Mondidu', '09924209747', '2026-01-08 13:53:46'),
(5, 'Balanacan', 574, 'Rural', NULL, NULL, NULL, 'Reynaldo L. Anday', '09099042280', '2026-01-08 13:53:46'),
(6, 'Bonifacio', 446, 'Rural', NULL, NULL, NULL, 'Salustiano I. Molato', '09085926892', '2026-01-08 13:53:46'),
(79, 'Bulo Ibaba', 683, 'Rural', NULL, NULL, NULL, 'Arvin M. Cabutihan', '09209131728', '2026-01-09 03:22:24'),
(80, 'Bulo Ilaya', 703, 'Rural', NULL, NULL, NULL, 'Bienvenido D. Lat Jr.', '09193348554', '2026-01-09 03:22:24'),
(81, 'Burgos', 218, 'Rural', NULL, NULL, NULL, 'Danilo D. Ortiz', '09124244717', '2026-01-09 03:22:24'),
(82, 'Caigdal', 682, 'Rural', NULL, NULL, NULL, 'Cherlito G. Bongalos', '09920682865', '2026-01-09 03:22:24'),
(83, 'F. de Jesus', 2566, 'Urban', NULL, NULL, NULL, 'Ronaldo M. Caper', '09647677060', '2026-01-09 03:22:24'),
(84, 'General Luna', 244, 'Rural', NULL, NULL, NULL, 'Narciso M. Maleon', '09108092283', '2026-01-09 03:22:24'),
(85, 'Cabulihan Ibaba', 460, 'Rural', NULL, NULL, NULL, 'Ronilo R. Macatangay', '09504649528', '2026-01-09 03:22:24'),
(86, 'Cabulihan Ilaya', 719, 'Rural', NULL, NULL, NULL, 'Rosana S. Presas', '09918231834', '2026-01-09 03:22:24'),
(87, 'Kalilayan Ibaba', 2727, 'Urban', NULL, NULL, NULL, 'Ninio D. Engco', '09096644155', '2026-01-09 03:22:24'),
(88, 'Kalilayan Ilaya', 1005, 'Rural', NULL, NULL, NULL, 'Maria Florence D. Vera Cruz', '09208005849', '2026-01-09 03:22:24'),
(89, 'Mabini', 497, 'Rural', NULL, NULL, NULL, 'Reynaldo B. Valles', '09297030627', '2026-01-09 03:22:24'),
(90, 'Mairok Ibaba', 311, 'Rural', NULL, NULL, NULL, 'Augusto A. Gutierrez', '09387507084', '2026-01-09 03:22:24'),
(91, 'Mairok Ilaya', 193, 'Rural', NULL, NULL, NULL, 'Joseph V. Estrada', '09380667930', '2026-01-09 03:22:24'),
(92, 'Malvar', 688, 'Rural', NULL, NULL, NULL, 'Alfonso H. Padilla Sr.', '09097774523', '2026-01-09 03:22:24'),
(93, 'Maputat', 695, 'Rural', NULL, NULL, NULL, 'Roberto L. Villapando', '09923604033', '2026-01-09 03:22:24'),
(94, 'Muliguin', 1383, 'Rural', NULL, NULL, NULL, 'Roberto G. Del Rosario', '09100727948', '2026-01-09 03:22:24'),
(95, 'Pagaguasan', 543, 'Rural', NULL, NULL, NULL, 'Allan I. Clet', '09701590806', '2026-01-09 03:22:24'),
(96, 'Panaon Ibaba', 814, 'Rural', NULL, NULL, NULL, 'Marvin J. De Leon', '09203119064', '2026-01-09 03:22:24'),
(97, 'Panaon Ilaya', 977, 'Rural', NULL, NULL, NULL, 'Roberto P. Ortiz', '09810781981', '2026-01-09 03:22:24'),
(98, 'Plaridel', 327, 'Rural', NULL, NULL, NULL, 'Edgardo R. Palmero', '09608519514', '2026-01-09 03:22:24'),
(99, 'Poctol', 1503, 'Rural', NULL, NULL, NULL, 'Cristeta V. Manalo', '09460398074', '2026-01-09 03:22:24'),
(100, 'Punta', 569, 'Rural', NULL, NULL, NULL, 'Joel G. Lagan', '09984570568', '2026-01-09 03:22:24'),
(101, 'R. Lapu-lapu', 349, 'Rural', NULL, NULL, NULL, 'Adelfa A. Ablaza', '09107353997', '2026-01-09 03:22:24'),
(102, 'R. Magsaysay', 753, 'Rural', NULL, NULL, NULL, 'Edson P. Verder', '09203103119', '2026-01-09 03:22:24'),
(103, 'Raja Soliman', 540, 'Rural', NULL, NULL, NULL, 'Jesusa D. Deveza', '09399393448', '2026-01-09 03:22:24'),
(104, 'Rizal Ibaba', 289, 'Rural', NULL, NULL, NULL, 'Castor V. Laurena', '09507277761', '2026-01-09 03:22:24'),
(105, 'Rizal Ilaya', 321, 'Rural', NULL, NULL, NULL, 'Mildred R. Estrada', '09368978904', '2026-01-09 03:22:24'),
(106, 'San Roque', 214, 'Rural', NULL, NULL, NULL, 'Lilian U. Marquez', '09307476135', '2026-01-09 03:22:24'),
(107, 'Socorro', 379, 'Rural', NULL, NULL, NULL, 'Mylyn M. Remontigue', '09396422997', '2026-01-09 03:22:24'),
(108, 'Tagumpay', 300, 'Rural', NULL, NULL, NULL, 'Romeo P. Iglesia', '09918185073', '2026-01-09 03:22:24'),
(109, 'Tubas', 549, 'Rural', NULL, NULL, NULL, 'Celestino F. Castillo', '09169959311', '2026-01-09 03:22:24'),
(110, 'Tubigan', 671, 'Rural', NULL, NULL, NULL, 'Dulce Rina C. Lancion', '09709483408', '2026-01-09 03:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `carousel_images`
--

CREATE TABLE `carousel_images` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(200) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `message` text NOT NULL,
  `submitted_at` datetime NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `date_read` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `message`, `submitted_at`, `status`, `date_read`) VALUES
(19, 'kaycee', 'kaycee@gmail.com', '0909090909', 'hello', '2026-01-10 11:36:18', 'read', '2026-01-10 11:52:39'),
(20, 'kaycee', 'kaycee@gmail.com', '0909090909', 'hello', '2026-01-10 11:45:39', 'read', '2026-01-10 11:52:38'),
(21, 'danila', 'arabella@gmail.com', '090909', 'hello', '2026-01-10 15:52:20', 'read', '2026-01-10 15:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_title` varchar(200) NOT NULL,
  `event_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_date`, `event_title`, `event_description`, `created_at`, `updated_at`) VALUES
(1, '2025-06-29', 'Unisan Town Fiestas', 'A celebration of culture and community with parades, food stalls, and local performances..', '2026-01-05 01:22:23', '2026-01-10 02:04:24'),
(2, '2025-07-15', 'Coastal Clean-Up Day', 'Join us in keeping our beaches clean and beautiful. Supplies will be provided.', '2026-01-05 01:22:23', '2026-01-05 01:22:23'),
(3, '2025-08-10', 'Unisan Sports Festival', 'A day of friendly competition featuring various sports and games for all ages.', '2026-01-05 01:22:23', '2026-01-05 01:22:23'),
(4, '2025-09-05', 'Cultural Heritage Day', 'Experience the rich history of Unisan through exhibits, workshops, and traditional performances.', '2026-01-05 01:22:23', '2026-01-05 01:22:23'),
(16, '0200-12-12', 'fiesta', 'aaaa', '2026-01-10 07:53:26', '2026-01-10 07:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `form_submissions`
--

CREATE TABLE `form_submissions` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `government_officials`
--

CREATE TABLE `government_officials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `position_order` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order_number` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `government_officials`
--

INSERT INTO `government_officials` (`id`, `name`, `position`, `position_order`, `image`, `description`, `order_number`, `created_at`) VALUES
(1, 'Omar Veluz', 'Mayor', 1, NULL, NULL, 0, '2026-01-08 08:43:37'),
(9, 'Cristy Caper  ', 'sangguniang bayan member', 4, NULL, NULL, 0, '2026-01-08 09:05:41'),
(11, 'Jobert Galang', 'sangguniang bayan member', 3, NULL, NULL, 0, '2026-01-09 02:53:09'),
(12, 'Keboy Magnaye', 'sangguniang bayan member', 5, NULL, NULL, 0, '2026-01-09 02:53:30'),
(13, 'Amotonoy Villapando', 'sangguniang bayan member', 6, NULL, NULL, 0, '2026-01-09 02:53:54'),
(14, 'Uwa Manalo', 'sangguniang bayan member', 7, NULL, NULL, 0, '2026-01-09 02:54:20'),
(15, 'Dodie Talavera', 'sangguniang bayan member', 8, NULL, NULL, 0, '2026-01-09 02:54:35'),
(16, 'Jezz Vera Cruz', 'sangguniang bayan member', 9, NULL, NULL, 0, '2026-01-09 02:54:48'),
(17, 'Anre Mimay', 'sangguniang bayan member', 10, NULL, NULL, 0, '2026-01-09 02:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `history_events`
--

CREATE TABLE `history_events` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `position` varchar(10) NOT NULL DEFAULT 'left',
  `image` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_events`
--

INSERT INTO `history_events` (`id`, `title`, `year`, `description`, `display_order`, `position`, `image`, `image_path`, `created_at`) VALUES
(16, 'Etymology', 1876, 'The municipality of Unisan, originally known as Kalilayan, adopted its current name upon separation from the adjacent town of Pitogo in February 1876, becoming an independent pueblo under Spanish administration in the province of Tayabas (now Quezon). Local accounts attribute the original name Kalilayan to the Tagalog term \"lilay,\" referring to a palm tree similar to buri that grew abundantly in the area, reflecting early settlement patterns tied to natural resources and holding significance in local heritage as a symbol of environmental abundance and communal identity.', 1, 'right', NULL, NULL, '2026-01-08 14:06:13'),
(17, 'Pre-Colonial Origins ', 1591, 'Before Spanish colonization, Unisan was inhabited by Austronesian (Tagalog) communities organized into small, independent barangays led by datus. These settlements depended on farming, fishing, and local trade, adapting to both coastal and inland environments. Archaeological remains in Quezon Province indicate long-term human activity tied to marine resources.\r\n\r\nKalilayan emerged as the principal settlement and regional center before European contact. Its importance was later confirmed when it became the first capital of Tayabas Province in 1591, reflecting its role as a hub of early governance and interaction. The area followed a decentralized barangay system rather than a centralized kingdom, with communities shaped largely by their natural environment.', 2, 'right', NULL, NULL, '2026-01-08 14:12:10'),
(18, 'Spanish Colonial Period of Unisan', 1578, 'Unisan, formerly known as Kalilayan, was established as a Spanish pueblo in 1578 by Franciscan missionaries, marking the beginning of formal colonial administration and Christianization in the area. Its importance grew when it became the first capital of the province of Kalilayan in 1591, serving as a center for governance, evangelization, and community organization under Spanish rule. Although the provincial capital was transferred to Tayabas in 1749, Unisan remained significant for its early administrative role and strong Franciscan influence during the Spanish colonial era.', 3, 'left', NULL, NULL, '2026-01-08 14:16:01'),
(19, 'American Period and Independence', 1898, 'After the 1898 Treaty of Paris, Unisan came under American rule as part of Tayabas Province, with civil government formally established in 1902, introducing elected local leadership and greater municipal autonomy. Political development continued under U.S. policies leading to self-governance, especially during the Commonwealth period created by the 1934 Tydings–McDuffie Act. Full Philippine independence was achieved on July 4, 1946, integrating Unisan into the new republic, followed later that year by the renaming of Tayabas Province to Quezon Province.', 4, 'right', NULL, NULL, '2026-01-08 14:17:54'),
(20, 'Post-Independence Developments in Unisan', 1946, 'After 1946 independence, Unisan focused on post-war reconstruction, repairing war-damaged infrastructure and recovering its population, which grew from 9,290 in 1948 to 13,609 by 1960. Despite national challenges like martial law (1972–1986) and economic crises, the municipality maintained steady population growth and gradual infrastructure improvements, including road and market connectivity. In recent decades, modernization efforts under regional development plans, such as the CALABARZON 2023–2028 plan, aim to enhance trade through projects like Punta Port, supporting continued growth to a population of 25,442 by 2020.', 5, 'left', NULL, NULL, '2026-01-08 14:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `history_main_image`
--

CREATE TABLE `history_main_image` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_main_image`
--

INSERT INTO `history_main_image` (`id`, `image_path`, `title`, `description`, `alt_text`, `created_at`, `updated_at`) VALUES
(1, 'images/unisan_main_1767858599.jpg', NULL, NULL, '', '2026-01-08 07:49:59', '2026-01-08 07:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `submit_request`
--

CREATE TABLE `submit_request` (
  `id` int(11) NOT NULL,
  `citizen_name` varchar(255) NOT NULL,
  `request_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_submitted` datetime NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `status` varchar(10) NOT NULL DEFAULT 'unread',
  `date_read` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submit_request`
--

INSERT INTO `submit_request` (`id`, `citizen_name`, `request_type`, `description`, `date_submitted`, `is_read`, `status`, `date_read`) VALUES
(19, 'arabella', 'Concern', 'hello', '2026-01-10 11:36:44', 0, 'read', '2026-01-10 11:52:36'),
(20, 'John Rick C. Manalo', 'Concern', 'hahahaha', '2026-01-10 12:22:30', 0, 'read', '2026-01-10 12:23:35'),
(21, 'daniela', 'Recommendation', 'aaaaaa', '2026-01-10 15:52:47', 0, 'read', '2026-01-10 15:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `tourism_attractions`
--

CREATE TABLE `tourism_attractions` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `location` varchar(255) NOT NULL,
  `category` enum('Restaurant','Beach & Resort') NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourism_attractions`
--

INSERT INTO `tourism_attractions` (`id`, `title`, `location`, `category`, `description`, `image_path`, `is_featured`, `created_at`) VALUES
(2, 'TULAY RESTO BARsss', 'Brgy. Ibabang Kalilayan, Unisan, Quezon', 'Restaurant', '', 'uploads/tourism/695f5c9f045a2.jpg', 1, '2026-01-05 02:29:14'),
(4, 'CASA ESMERALDA', 'Brgy. Magsaysay, Unisan, Quezon', 'Restaurant', '', 'uploads/tourism/695f5c48f3edd.jpg', 1, '2026-01-05 02:29:14'),
(6, 'ROBERTO', 'Brgy. Ibabang Kalilayan, Unisan, Quezon', 'Restaurant', '', 'uploads/tourism/695f5c7b3bfe4.jpg', 1, '2026-01-05 02:29:35'),
(8, 'JINGGAY', 'Brgy. F. De Jesus, Unisan, Quezon', 'Restaurant', '', 'uploads/tourism/695f5cb39aa78.jpg', 1, '2026-01-05 02:29:35'),
(12, 'AREDAN', 'Brgy. Ibabang Kalilayan, Unisan, Quezon', 'Beach & Resort', '', 'uploads/tourism/695c6f3d2a2ec.png', 0, '2026-01-05 02:29:58'),
(13, 'CALILAYAN COVE', 'Brgy. Ilayang Kalilayan, Unisan, Quezon', 'Beach & Resort', '', 'images/calilayancove.jpg', 1, '2026-01-05 02:29:58'),
(14, 'PUNTA SANCTUARY', 'Brgy. Punta, Unisan, Quezon', 'Beach & Resort', '', 'images/punta S.jpg', 0, '2026-01-05 02:29:58'),
(15, 'UNISAN SANDS', 'Brgy. Maputat, Unisan, Quezon', 'Beach & Resort', '', 'images/unisansands.jpg', 0, '2026-01-05 02:29:58'),
(23, 'BALAY BISTRO', 'Brgy. Ibabang Kalilayan, Unisan, Quezon', 'Restaurant', '', 'uploads/tourism/695f5cce919f8.jpg', 0, '2026-01-05 03:43:30'),
(24, 'CUCINA MANGANTANA', 'Brgy. Malvar, Unisan, Quezon', 'Restaurant', '', 'images/cm.jpg', 0, '2026-01-05 03:43:30'),
(25, 'SO-JUU', 'Brgy. F. De Jesus, Unisan, Quezon', 'Restaurant', '', 'images/so-juu.jpg', 0, '2026-01-05 03:43:30'),
(26, 'KUSINA NI ATE CYNTHIA', 'Brgy. Muliguin, Unisan, Quezon', 'Restaurant', '', 'images/KNAC.jpg', 0, '2026-01-05 03:43:30'),
(27, 'ELVIS GRILL', 'Brgy. Ibabang Kalilayan, Unisan, Quezon', 'Restaurant', '', 'images/elvisgrill.jpg', 0, '2026-01-05 03:43:30'),
(28, 'ADELAS BEACH RESORT', 'Brgy. Ibabang Kalilayan, Unisan, Quezon', 'Beach & Resort', '', 'uploads/tourism/695f5c8c63d72.jpg', 0, '2026-01-05 03:43:30'),
(29, 'DANPRISE', 'Brgy. Maputat, Unisan, Quezon', 'Beach & Resort', '', 'images/danprise.jpg', 0, '2026-01-05 03:43:30'),
(30, 'EL NICO', 'Brgy. Malvar, Unisan, Quezon', 'Beach & Resort', '', 'images/el nico.jpg', 0, '2026-01-05 03:43:30'),
(31, 'LACALA', 'Brgy. Ibabang Kalilayan, Unisan, Quezon', 'Beach & Resort', '', 'images/lacala.jpg', 0, '2026-01-05 03:43:30'),
(32, 'MONCELLA', 'Brgy. Maputat, Unisan, Quezon', 'Beach & Resort', '', 'images/mbr.jpg', 0, '2026-01-05 03:43:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel_images`
--
ALTER TABLE `carousel_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_submissions`
--
ALTER TABLE `form_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `government_officials`
--
ALTER TABLE `government_officials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_events`
--
ALTER TABLE `history_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_main_image`
--
ALTER TABLE `history_main_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submit_request`
--
ALTER TABLE `submit_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourism_attractions`
--
ALTER TABLE `tourism_attractions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `carousel_images`
--
ALTER TABLE `carousel_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `form_submissions`
--
ALTER TABLE `form_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `government_officials`
--
ALTER TABLE `government_officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `history_events`
--
ALTER TABLE `history_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `history_main_image`
--
ALTER TABLE `history_main_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submit_request`
--
ALTER TABLE `submit_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tourism_attractions`
--
ALTER TABLE `tourism_attractions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
