-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2023 at 01:49 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3eguwangapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `user` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `city` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `user`, `title`, `message`, `type`, `city`, `brgy`, `created_at`) VALUES
(12, 'dswd', 'This is sample Announcement by DSWD. ', 'Sample text shit ', 'Announcement', '', '', '2022-12-27 01:31:15'),
(13, 'dswd', 'Another sample announcement haha', 'Sample text from dswd \r\n', 'Announcement', '', '', '2022-12-27 01:33:17'),
(18, 'dswd', 'Take a nap', '\r\nWe are pleased to announce that a remittance of 1,000 pesos has been successfully made. We would like to thank everyone for their patience and understanding. If you have any questions, please feel free to contact us. Thank you!', 'Remittance', 'Davao City', 'Dalio', '2023-01-05 01:22:07'),
(19, 'dswd', 'Sample', 'Sample', 'Announcement', 'Davao City', 'Bato', '2023-01-06 06:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_responses`
--

CREATE TABLE `announcement_responses` (
  `id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_username` varchar(250) NOT NULL,
  `response` varchar(250) NOT NULL,
  `iscancelled` int(2) NOT NULL DEFAULT 0,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement_responses`
--

INSERT INTO `announcement_responses` (`id`, `announcement_id`, `user_id`, `user_username`, `response`, `iscancelled`, `date_time`) VALUES
(120, 18, 102, 'welgen', 'responded', 0, '2023-01-12 13:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `transid` varchar(255) NOT NULL,
  `count` int(2) NOT NULL,
  `date_added` int(11) NOT NULL DEFAULT current_timestamp(),
  `isdeleted` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `customer_name`, `store_id`, `product_id`, `product_name`, `price`, `qty`, `total_price`, `status`, `transid`, `count`, `date_added`, `isdeleted`) VALUES
(49, 98, 'johncesar', 11, 53, 'Pancit canton ', 25, 1, 0, '', '', 0, 2147483647, ''),
(50, 98, 'johncesar', 11, 53, 'Pancit canton ', 25, 1, 0, 'order', '50996345782120', 0, 2147483647, ''),
(51, 98, 'johncesar', 11, 53, 'Pancit canton ', 25, 1, 0, 'order', '35962470942418', 0, 2147483647, ''),
(52, 98, 'johncesar', 11, 53, 'Pancit canton ', 25, 1, 0, '', '', 1, 2147483647, 'yes'),
(53, 98, 'johncesar', 11, 53, 'Pancit canton ', 25, 1, 0, '', '', 1, 2147483647, 'yes'),
(54, 98, 'johncesar', 11, 53, 'Pancit canton ', 25, 1, 0, 'order', '38041595912710', 0, 2147483647, ''),
(55, 98, 'johncesar', 11, 53, 'Pancit canton ', 25, 1, 0, 'order', '46076365785320', 0, 2147483647, ''),
(56, 98, 'johncesar', 9, 52, 'Bugas', 1500, 1, 0, '', '', 0, 2147483647, '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `delivery_method` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `total_price` int(11) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `date_ordered` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `gcashinfo` varchar(255) NOT NULL,
  `bankifo` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `store_status` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `isdeleted` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cart_id`, `user_id`, `customer_name`, `product_id`, `store_id`, `qty`, `delivery_method`, `payment`, `total_price`, `delivery_address`, `transaction_id`, `date_ordered`, `gcashinfo`, `bankifo`, `status`, `store_status`, `contact_number`, `isdeleted`) VALUES
(30, 53, 98, 'John Cesar  Suaybaguio', 53, 11, 1, 'Delivery', 'Cash On Delivery', 24, '32323', '8653649663712', '2023-01-09 19:27:15', '', '', 'order', 'Pending', '32323', ''),
(31, 52, 98, 'John Cesar  Suaybaguio', 53, 11, 1, 'Delivery', 'Cash On Delivery', 24, 'dasdsa', '85031947554515', '2023-01-09 20:56:57', '', '', 'order', 'Pending', '3443434', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `storeid` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `min_stocks` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `storeid`, `product_name`, `product_type`, `min_stocks`, `description`, `image`, `date`) VALUES
(52, 9, 'Bugas', 'Food', 100, 'Rich in Carbohydrate, pang pa taas ug blood pressure', '94579-ab4c577edddf2aa4b7363363a05bc88d.png', '2022-12-26'),
(53, 11, 'Pancit canton ', 'Food', 100, 'Pancit canton, pang pa aslum sa imong burp ', '589434-download-(4).jfif', '2022-12-26'),
(54, 9, 'Odong nga lami', 'Food', 100, 'Odong nga lame na maka higugma', '413227-download-(5).jfif', '2022-12-27'),
(56, 11, 'Boost Optimum', 'Food', 300, 'Drinking milk is beneficial for health regardless of your age. Milk is an excellent vitamin D and calcium source to keep up muscle strength, maintain healthy bones, and prevent osteoporosis.', '786262-download-(6).jfif', '2023-01-13'),
(57, 11, 'Eggs', 'Food', 10, 'Eggs are a good source of protein (both whites/yolk). They also contain heart-healthy unsaturated fats and are a great source of important nutrients, such as vitamin B6, B12 and vitamin D,', '403980-fpg_06-eggscarton_featuredimage.jpg', '2023-01-13');

-- --------------------------------------------------------

--
-- Table structure for table `product_items`
--

CREATE TABLE `product_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_items`
--

INSERT INTO `product_items` (`id`, `product_id`, `store_id`, `price`, `qty`, `status`, `added_at`) VALUES
(1, 52, 9, 1500, 162, 'ok', '2022-12-27 09:23:16'),
(2, 53, 11, 25, 1998, 'ok', '2022-12-27 19:19:01'),
(3, 54, 9, 20, 9974, 'ok', '2022-12-27 19:29:19'),
(5, 56, 11, 1000, 0, 'ok', '2023-01-13 06:45:33'),
(6, 57, 11, 18, 2000, 'ok', '2023-01-13 06:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `remittances`
--

CREATE TABLE `remittances` (
  `id` int(11) NOT NULL,
  `user` varchar(250) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(250) NOT NULL,
  `cluster` varchar(250) NOT NULL,
  `age` int(11) NOT NULL,
  `amount` varchar(250) NOT NULL DEFAULT 'empty',
  `comment` varchar(250) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `isdeleted` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remittances`
--

INSERT INTO `remittances` (`id`, `user`, `city`, `barangay`, `cluster`, `age`, `amount`, `comment`, `status`, `created_at`, `isdeleted`) VALUES
(38, 'dswd', 'Davao City', 'Dalio', '5', 70, '2000', 'fsdfsdf', 1, '2023-01-13', ''),
(39, 'dswd', 'Davao City', 'Dalio', '1', 70, '21313', 'sfdfdsfasd', 1, '2023-01-13', ''),
(40, 'dswd', 'Davao City', 'Dalio', 'all', 0, '1000', 'dasdsad', 1, '2023-01-13', '');

-- --------------------------------------------------------

--
-- Table structure for table `remittance_responses`
--

CREATE TABLE `remittance_responses` (
  `id` int(11) NOT NULL,
  `remittance_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `remittance_info` varchar(255) NOT NULL,
  `account_info` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remittance_responses`
--

INSERT INTO `remittance_responses` (`id`, `remittance_id`, `user_id`, `status`, `remittance_info`, `account_info`, `created_at`) VALUES
(25, 38, 102, 1, 'Physical Claiming', '', '2023-01-13'),
(26, 39, 102, 1, 'Physical Claiming', '', '2023-01-13'),
(27, 40, 101, 1, 'Gcash', '0923124551', '2023-01-13'),
(28, 39, 101, 1, 'Gcash', '0923124551', '2023-01-13'),
(29, 38, 101, 1, 'Gcash', '0923124551', '2023-01-13');

-- --------------------------------------------------------

--
-- Table structure for table `rosters`
--

CREATE TABLE `rosters` (
  `id` int(11) NOT NULL,
  `seniors_id` varchar(250) NOT NULL,
  `seniorcitizen_id` varchar(250) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `middle_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `birth_date` date NOT NULL,
  `city` varchar(250) NOT NULL,
  `barangay` varchar(250) NOT NULL,
  `cluster` varchar(250) NOT NULL,
  `contact_number` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rosters`
--

INSERT INTO `rosters` (`id`, `seniors_id`, `seniorcitizen_id`, `first_name`, `middle_name`, `last_name`, `gender`, `birth_date`, `city`, `barangay`, `cluster`, `contact_number`, `created_at`) VALUES
(1, '1087', '790040969080-16', 'John Cesar ', 'Cesar', 'Suaybaguio', 'Male', '2023-01-26', 'Davao City', 'Toril', '1', '09475535660', '2023-01-12 10:58:28'),
(2, '1097', '124011259511-13', 'jerechio ', 'dasd', 'bahogtae', 'Male', '2023-01-16', 'Davao City', 'Toril', '10', '34343', '2023-01-12 10:59:17'),
(3, '1099', '171733560543-10', 'Jonathan', 'Inson', 'Suaybaguio', 'Male', '2023-01-19', 'Davao City', 'Dalio', '10', '09090902932', '2023-01-12 11:01:22');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seniors`
--

CREATE TABLE `seniors` (
  `id` int(11) NOT NULL,
  `seniorcitizen_id` varchar(250) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `middle_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `contact_number` varchar(250) NOT NULL,
  `birth_date` date NOT NULL,
  `city` varchar(250) NOT NULL,
  `barangay` varchar(250) NOT NULL,
  `cluster` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `remittance_mode` varchar(250) DEFAULT NULL,
  `gcashinfo` varchar(255) NOT NULL,
  `bankinfo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seniors`
--

INSERT INTO `seniors` (`id`, `seniorcitizen_id`, `first_name`, `middle_name`, `last_name`, `gender`, `contact_number`, `birth_date`, `city`, `barangay`, `cluster`, `image`, `remittance_mode`, `gcashinfo`, `bankinfo`, `created_at`) VALUES
(1087, '790040969080-16', 'John Cesar ', 'Cesar', 'Suaybaguio', 'Male', '09475535660', '2023-01-26', 'Davao City', 'Toril', '1', '316109-dsc_1003.jpg', 'Gcash', '09475535660', '', '2023-01-09 01:40:40'),
(1088, '379485952308-18', 'Loki', 'Lok', 'Lok', 'Male', 'Ywiowoow', '2023-01-13', 'Davao City', 'Bato', '6', '521032-screenshot_20230108_063034.jpg', 'Gcash', '31642468574', '', '2023-01-09 02:26:41'),
(1097, '124011259511-13', 'jerechio ', 'dasd', 'bahogtae', 'Male', '34343', '2023-01-16', 'Davao City', 'Toril', '10', '280716-e-guwang-poster.png', '', '', '', '2023-01-09 05:29:06'),
(1098, '844963893178', 'lhuvlh', 'khv ;', 'khvouc', 'Male', '0979870976', '2023-01-21', 'Davao City', 'Toril', '1', '998709-qr-code-(1).png', '', '', '', '2023-01-09 06:57:32'),
(1099, '171733560543-10', 'Jonathan', 'Inson', 'Suaybaguio', 'Male', '09090902932', '2023-01-19', 'Davao City', 'Dalio', '10', '134065-qr-code-(1).png', 'Gcash', '0923124551', '', '2023-01-12 11:00:55'),
(1100, '567303354081', 'Welgen', 'Well', 'Salvani', 'Male', '0999909032', '2023-01-20', 'Davao City', 'Dalio', '10', '240296-illustration-(2).png', 'Land Bank', '', '', '2023-01-12 12:27:27'),
(1101, '797662041849', 'Welgen', 'Well', 'Salvani', 'Male', '0999909032', '2023-01-20', 'Davao City', 'Dalio', '10', '982720-illustration-(2).png', 'Physical', '', '1212123432', '2023-01-12 12:28:22'),
(1102, '566310536627', 'lok', 'lok', 'lok', 'Male', 'lok', '2023-01-20', 'Davao City', 'Toril', '10', '73237-illustration-(2).png', NULL, '', '', '2023-01-12 12:35:45'),
(1103, '595501838491', 'Welgen ', 'Wll', 'Salvani', 'Male', '212133', '2023-01-20', 'Davao City', 'Bato', '9', '744404-illustration-(2).png', NULL, '', '', '2023-01-12 12:50:12'),
(1106, '1', 'Fidelia', 'Verny', 'Olyfat', 'Female', '11', '0000-00-00', 'Kvissleby', 'Avenue', '1', '', NULL, '', '', '2023-01-12 13:24:20'),
(1107, '2', 'Wolfie', 'Milne', 'Witherby', 'Male', '11', '0000-00-00', 'Chakaray', 'Hill', '6', '', NULL, '', '', '2023-01-12 13:24:20'),
(1108, '3', 'Reeba', 'Reddyhoff', 'Rutigliano', 'Female', '11', '0000-00-00', 'Xinsheng', 'Pass', '9', '', NULL, '', '', '2023-01-12 13:24:20'),
(1109, '4', 'Ulla', 'Tearny', 'MacCaughey', 'Genderqueer', '11', '0000-00-00', 'Gislaved', 'Avenue', '3', '', NULL, '', '', '2023-01-12 13:24:20'),
(1110, '5', 'Emmit', 'Ferriday', 'Poizer', 'Male', '11', '0000-00-00', 'Lamarosa', 'Point', '5', '', NULL, '', '', '2023-01-12 13:24:20'),
(1111, '6', 'Sacha', 'Benedikt', 'Petrak', 'Female', '11', '0000-00-00', 'Carepa', 'Hill', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1112, '7', 'Abbot', 'Phil', 'Satchel', 'Male', '11', '0000-00-00', 'Comallo', 'Circle', '5', '', NULL, '', '', '2023-01-12 13:24:20'),
(1113, '8', 'Jodie', 'Smaling', 'Hannay', 'Male', '11', '0000-00-00', 'Tomaszów Mazowiecki', 'Way', '8', '', NULL, '', '', '2023-01-12 13:24:20'),
(1114, '9', 'Tilda', 'Yashanov', 'Brandenburg', 'Female', '11', '0000-00-00', 'Buracan', 'Center', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1115, '10', 'Laraine', 'Jersh', 'Rablin', 'Female', '11', '0000-00-00', 'Lille', 'Road', '10', '', NULL, '', '', '2023-01-12 13:24:20'),
(1116, '11', 'Fionnula', 'Gartenfeld', 'Wolton', 'Female', '11', '0000-00-00', 'Eišiškės', 'Lane', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1117, '12', 'Thorpe', 'Margeram', 'Darridon', 'Male', '11', '0000-00-00', 'Locminé', 'Circle', '6', '', NULL, '', '', '2023-01-12 13:24:20'),
(1118, '13', 'Jacki', 'Meach', 'Shermore', 'Female', '11', '0000-00-00', 'Noen Maprang', 'Road', '6', '', NULL, '', '', '2023-01-12 13:24:20'),
(1119, '14', 'Barron', 'Walewski', 'Bowes', 'Male', '11', '0000-00-00', 'Gudang', 'Avenue', '1', '', NULL, '', '', '2023-01-12 13:24:20'),
(1120, '15', 'Ardenia', 'Fawdrie', 'Burde', 'Female', '11', '0000-00-00', 'Sapeken', 'Park', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1121, '16', 'Ferguson', 'Girk', 'Rodrigues', 'Male', '11', '0000-00-00', 'Gradačac', 'Alley', '1', '', NULL, '', '', '2023-01-12 13:24:20'),
(1122, '17', 'Zolly', 'Ibbison', 'Brain', 'Male', '11', '0000-00-00', 'Lopar', 'Junction', '7', '', NULL, '', '', '2023-01-12 13:24:20'),
(1123, '18', 'Elisha', 'Jupp', 'Rudyard', 'Female', '11', '0000-00-00', 'Sawahan', 'Way', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1124, '19', 'Darla', 'Mirrlees', 'Gleadhall', 'Female', '11', '0000-00-00', 'Rāmsar', 'Trail', '1', '', NULL, '', '', '2023-01-12 13:24:20'),
(1125, '20', 'Kelby', 'Hebner', 'Von Helmholtz', 'Male', '11', '0000-00-00', 'Oncativo', 'Park', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1126, '21', 'Dimitry', 'Light', 'Bonds', 'Agender', '11', '0000-00-00', 'Yarīm', 'Point', '3', '', NULL, '', '', '2023-01-12 13:24:20'),
(1127, '22', 'Emanuel', 'Befroy', 'McGreary', 'Male', '11', '0000-00-00', 'Berlin', 'Road', '7', '', NULL, '', '', '2023-01-12 13:24:20'),
(1128, '23', 'Elroy', 'Gaucher', 'McKerley', 'Male', '11', '0000-00-00', 'Bocaiúva', 'Plaza', '4', '', NULL, '', '', '2023-01-12 13:24:20'),
(1129, '24', 'Barnaby', 'Davidsson', 'MacCrossan', 'Male', '11', '0000-00-00', 'Zhongxiang', 'Center', '5', '', NULL, '', '', '2023-01-12 13:24:20'),
(1130, '25', 'Lynnette', 'Dallan', 'Kenton', 'Female', '11', '0000-00-00', 'Štítina', 'Terrace', '6', '', NULL, '', '', '2023-01-12 13:24:20'),
(1131, '26', 'Dani', 'Currall', 'Paolucci', 'Female', '11', '0000-00-00', 'Hancheng', 'Pass', '9', '', NULL, '', '', '2023-01-12 13:24:20'),
(1132, '27', 'Pail', 'Harling', 'Durtnal', 'Male', '11', '0000-00-00', 'Tyazhinskiy', 'Pass', '8', '', NULL, '', '', '2023-01-12 13:24:20'),
(1133, '28', 'Yorke', 'Binding', 'Tuffield', 'Male', '11', '0000-00-00', 'Sumisip', 'Road', '3', '', NULL, '', '', '2023-01-12 13:24:20'),
(1134, '29', 'Rosalynd', 'Maylin', 'Lamberth', 'Female', '11', '0000-00-00', 'Pedrulheira', 'Pass', '9', '', NULL, '', '', '2023-01-12 13:24:20'),
(1135, '30', 'Lexie', 'Emmison', 'Marcome', 'Female', '11', '0000-00-00', 'Ábrego', 'Parkway', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1136, '31', 'Fina', 'Cottem', 'Gardner', 'Female', '11', '0000-00-00', 'Kafr Miṣr', 'Junction', '6', '', NULL, '', '', '2023-01-12 13:24:20'),
(1137, '32', 'Claudius', 'Gueny', 'O\'Reilly', 'Male', '11', '0000-00-00', 'El Cerrito', 'Alley', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1138, '33', 'Cherilynn', 'Kinnie', 'Brickstock', 'Female', '11', '0000-00-00', 'Tame', 'Parkway', '3', '', NULL, '', '', '2023-01-12 13:24:20'),
(1139, '34', 'Tremain', 'Jikovsky', 'Slemming', 'Male', '11', '0000-00-00', 'Vidin', 'Alley', '10', '', NULL, '', '', '2023-01-12 13:24:20'),
(1140, '35', 'Nicky', 'Quipp', 'Bellino', 'Male', '11', '0000-00-00', 'Sintung Timur', 'Terrace', '5', '', NULL, '', '', '2023-01-12 13:24:20'),
(1141, '36', 'Andrea', 'Sadd', 'Loveridge', 'Female', '11', '0000-00-00', 'Verkhniy Yasenov', 'Plaza', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1142, '37', 'Ulysses', 'Zavattero', 'Readwing', 'Male', '11', '0000-00-00', 'Las Vegas', 'Trail', '1', '', NULL, '', '', '2023-01-12 13:24:20'),
(1143, '38', 'Charlton', 'Montacute', 'Collough', 'Male', '11', '0000-00-00', 'Tanumshede', 'Trail', '9', '', NULL, '', '', '2023-01-12 13:24:20'),
(1144, '39', 'Adrienne', 'Gorrick', 'Medgwick', 'Non-binary', '11', '0000-00-00', 'Świeradów-Zdrój', 'Hill', '1', '', NULL, '', '', '2023-01-12 13:24:20'),
(1145, '40', 'Constanta', 'Colley', 'Ghirardi', 'Female', '11', '0000-00-00', 'Infonavit', 'Plaza', '10', '', NULL, '', '', '2023-01-12 13:24:20'),
(1146, '41', 'Taite', 'Skokoe', 'Bevir', 'Male', '11', '0000-00-00', 'Mesyagutovo', 'Drive', '8', '', NULL, '', '', '2023-01-12 13:24:20'),
(1147, '42', 'Willard', 'Vinton', 'Vasilkov', 'Male', '11', '0000-00-00', 'Bordeaux', 'Plaza', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1148, '43', 'Corby', 'Wightman', 'Smidmoor', 'Male', '11', '0000-00-00', 'Katoúna', 'Circle', '3', '', NULL, '', '', '2023-01-12 13:24:20'),
(1149, '44', 'Thomas', 'Brimson', 'Forcade', 'Male', '11', '0000-00-00', 'Evansville', 'Circle', '6', '', NULL, '', '', '2023-01-12 13:24:20'),
(1150, '45', 'Mirabel', 'Shevelin', 'Samwaye', 'Female', '11', '0000-00-00', 'Trabulheira', 'Hill', '9', '', NULL, '', '', '2023-01-12 13:24:20'),
(1151, '46', 'Virginia', 'D\'Enrico', 'Arington', 'Female', '11', '0000-00-00', 'Dongning', 'Lane', '1', '', NULL, '', '', '2023-01-12 13:24:20'),
(1152, '47', 'Guinevere', 'Beynon', 'Purtell', 'Female', '11', '0000-00-00', 'Myitkyina', 'Trail', '1', '', NULL, '', '', '2023-01-12 13:24:20'),
(1153, '48', 'Petronilla', 'Thirlwall', 'Kaplan', 'Bigender', '11', '0000-00-00', 'Aki', 'Place', '6', '', NULL, '', '', '2023-01-12 13:24:20'),
(1154, '49', 'Jodi', 'Bouldstridge', 'Duxbury', 'Male', '11', '0000-00-00', 'Kaiyuan', 'Trail', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1155, '50', 'Calypso', 'Tythe', 'Biss', 'Female', '11', '0000-00-00', 'Brodnica', 'Court', '5', '', NULL, '', '', '2023-01-12 13:24:20'),
(1156, '51', 'Melosa', 'Beauvais', 'Vanlint', 'Female', '11', '0000-00-00', 'Vryburg', 'Center', '9', '', NULL, '', '', '2023-01-12 13:24:20'),
(1157, '52', 'Dion', 'Pelman', 'Otter', 'Female', '11', '0000-00-00', 'Jaraguá', 'Place', '4', '', NULL, '', '', '2023-01-12 13:24:20'),
(1158, '53', 'Ardis', 'Aird', 'Seagood', 'Female', '11', '0000-00-00', 'Jayyūs', 'Lane', '7', '', NULL, '', '', '2023-01-12 13:24:20'),
(1159, '54', 'Win', 'Beynke', 'Costan', 'Male', '11', '0000-00-00', 'Sakhipur', 'Alley', '6', '', NULL, '', '', '2023-01-12 13:24:20'),
(1160, '55', 'Homerus', 'Streather', 'Mendoza', 'Male', '11', '0000-00-00', 'Dortmund', 'Street', '3', '', NULL, '', '', '2023-01-12 13:24:20'),
(1161, '56', 'Lucila', 'Utting', 'Swadling', 'Female', '11', '0000-00-00', 'Astghadzor', 'Road', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1162, '57', 'Megan', 'Bhar', 'Klemencic', 'Female', '11', '0000-00-00', 'Gąsocin', 'Hill', '9', '', NULL, '', '', '2023-01-12 13:24:20'),
(1163, '58', 'Shem', 'Launder', 'Steketee', 'Male', '11', '0000-00-00', 'Lanuza', 'Road', '5', '', NULL, '', '', '2023-01-12 13:24:20'),
(1164, '59', 'Tracie', 'Morling', 'Mc Coughan', 'Male', '11', '0000-00-00', 'Saint-Rémy-de-Provence', 'Street', '10', '', NULL, '', '', '2023-01-12 13:24:20'),
(1165, '60', 'Cal', 'Yglesia', 'Climo', 'Male', '11', '0000-00-00', 'Šenčur', 'Trail', '2', '', NULL, '', '', '2023-01-12 13:24:20'),
(1166, '61', 'Guss', 'Morley', 'Bardey', 'Male', '11', '0000-00-00', 'San Francisco', 'Pass', '3', '', NULL, '', '', '2023-01-12 13:24:20'),
(1167, '62', 'Gus', 'Sabban', 'McGown', 'Male', '11', '0000-00-00', 'Cilampuyang', 'Terrace', '9', '', NULL, '', '', '2023-01-12 13:24:20'),
(1168, '63', 'Marcelo', 'Rispen', 'Buncombe', 'Male', '11', '0000-00-00', 'Choma', 'Parkway', '1', '', NULL, '', '', '2023-01-12 13:24:20'),
(1169, '64', 'Odessa', 'Gillcrist', 'Sadry', 'Female', '11', '0000-00-00', 'Columbus', 'Street', '5', '', NULL, '', '', '2023-01-12 13:24:20'),
(1170, '65', 'Val', 'Nortcliffe', 'Sinclair', 'Female', '11', '0000-00-00', 'Zuitou', 'Place', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1171, '66', 'Benton', 'Burnsides', 'Largan', 'Male', '11', '0000-00-00', 'Uyuni', 'Way', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1172, '67', 'Olenolin', 'McNiven', 'Jachimak', 'Male', '11', '0000-00-00', 'Sovetskaya', 'Crossing', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1173, '68', 'Lois', 'Aupol', 'Sebyer', 'Female', '11', '0000-00-00', 'Espírito Santo do Pinhal', 'Plaza', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1174, '69', 'Kerry', 'Mixworthy', 'Caccavari', 'Female', '11', '0000-00-00', 'Nevesinje', 'Drive', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1175, '70', 'Belvia', 'Lilie', 'Brownlee', 'Female', '11', '0000-00-00', 'Rybno', 'Junction', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1176, '71', 'Quint', 'Meffen', 'Chiplen', 'Male', '11', '0000-00-00', 'Chengmen', 'Park', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1177, '72', 'Clyve', 'Breffitt', 'Lande', 'Genderfluid', '11', '0000-00-00', 'Marataizes', 'Place', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1178, '73', 'Hetti', 'Winnister', 'Cleeves', 'Female', '11', '0000-00-00', 'Las Matas de Farfán', 'Alley', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1179, '74', 'Skelly', 'Ackery', 'Heape', 'Male', '11', '0000-00-00', 'Guidong Chengguanzhen', 'Lane', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1180, '75', 'Anett', 'Raffin', 'Guwer', 'Female', '11', '0000-00-00', 'Ketapang', 'Parkway', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1181, '76', 'Giacobo', 'Girod', 'Vlahos', 'Male', '11', '0000-00-00', 'Rozhdestveno', 'Circle', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1182, '77', 'Mohandas', 'Websdale', 'Jaukovic', 'Male', '11', '0000-00-00', 'Santa Cruz del Norte', 'Center', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1183, '78', 'Cicely', 'Farleigh', 'Younge', 'Female', '11', '0000-00-00', 'Verdizela', 'Center', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1184, '79', 'Jehu', 'Chasier', 'Cicchillo', 'Male', '11', '0000-00-00', 'Guanghai', 'Plaza', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1185, '80', 'Ulrica', 'Harley', 'McCerery', 'Female', '11', '0000-00-00', 'Fengshuling', 'Alley', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1186, '81', 'Devonna', 'Janicek', 'Pigford', 'Female', '11', '0000-00-00', 'Brumado', 'Crossing', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1187, '82', 'Pall', 'Burl', 'Gergus', 'Male', '11', '0000-00-00', 'Shikhazany', 'Terrace', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1188, '83', 'Norbie', 'Pavie', 'Phlippi', 'Male', '11', '0000-00-00', 'Hpa-an', 'Street', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1189, '84', 'Johnette', 'Jansik', 'Berzons', 'Female', '11', '0000-00-00', 'Molde', 'Court', '6', '', NULL, '', '', '2023-01-12 13:24:21'),
(1190, '85', 'Brent', 'O\'Day', 'Sirman', 'Male', '11', '0000-00-00', 'Lương Bằng', 'Circle', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1191, '86', 'Lura', 'Jecock', 'Digginson', 'Female', '11', '0000-00-00', 'Zhuravka', 'Court', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1192, '87', 'Patrizius', 'McMarquis', 'Hanmer', 'Male', '11', '0000-00-00', 'Uzunovo', 'Park', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1193, '88', 'Paige', 'Genery', 'Santacrole', 'Male', '11', '0000-00-00', 'Pashkovskiy', 'Court', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1194, '89', 'Donnell', 'Chugg', 'Jennings', 'Male', '11', '0000-00-00', 'Jintan', 'Terrace', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1195, '90', 'Elly', 'Horney', 'Gerbl', 'Female', '11', '0000-00-00', 'Palaiópyrgos', 'Pass', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1196, '91', 'Delmore', 'Rubin', 'Broinlich', 'Male', '11', '0000-00-00', 'Villa Ascasubi', 'Hill', '6', '', NULL, '', '', '2023-01-12 13:24:21'),
(1197, '92', 'Verine', 'Currom', 'MacIan', 'Female', '11', '0000-00-00', 'Kovilj', 'Way', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1198, '93', 'D\'arcy', 'Pardey', 'O\'Heneghan', 'Male', '11', '0000-00-00', 'Sagopshi', 'Crossing', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1199, '94', 'Connie', 'Rossant', 'Smooth', 'Male', '11', '0000-00-00', 'Huliao', 'Road', '7', '', NULL, '', '', '2023-01-12 13:24:21'),
(1200, '95', 'Rickert', 'Mityushin', 'Heavy', 'Male', '11', '0000-00-00', 'Bielawa', 'Plaza', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1201, '96', 'Hermie', 'Gligorijevic', 'Dozdill', 'Male', '11', '0000-00-00', 'Santa Marcela', 'Pass', '7', '', NULL, '', '', '2023-01-12 13:24:21'),
(1202, '97', 'Molli', 'Clilverd', 'Restill', 'Non-binary', '11', '0000-00-00', 'Peranap', 'Crossing', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1203, '98', 'Constantin', 'Spradbery', 'Etteridge', 'Male', '11', '0000-00-00', 'Dulles', 'Alley', '6', '', NULL, '', '', '2023-01-12 13:24:21'),
(1204, '99', 'Dewey', 'Betz', 'Marciek', 'Male', '11', '0000-00-00', 'Sindangbarang', 'Plaza', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1205, '100', 'Tito', 'Melluish', 'Varndall', 'Male', '11', '0000-00-00', 'Skien', 'Hill', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1206, '101', 'Zorana', 'Danson', 'Toft', 'Bigender', '11', '0000-00-00', 'Itsukaichi', 'Alley', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1207, '102', 'Colan', 'O\'Griffin', 'Dicker', 'Male', '11', '0000-00-00', 'Shahrisabz Shahri', 'Point', '10', '', NULL, '', '', '2023-01-12 13:24:21'),
(1208, '103', 'Joyce', 'Le Maitre', 'MacIlhagga', 'Female', '11', '0000-00-00', 'Orlando', 'Circle', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1209, '104', 'Danya', 'Eicke', 'Goullee', 'Male', '11', '0000-00-00', 'Tremembé', 'Street', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1210, '105', 'Cleon', 'Heindle', 'Paszak', 'Male', '11', '0000-00-00', 'Luo’ao', 'Center', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1211, '106', 'Dwain', 'Lidster', 'Bolingbroke', 'Agender', '11', '0000-00-00', 'Sankt Lorenzen im Mürztal', 'Hill', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1212, '107', 'Auberon', 'Wedderburn', 'De Fraine', 'Male', '11', '0000-00-00', 'Västerås', 'Avenue', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1213, '108', 'Maynord', 'Shambrook', 'Pickworth', 'Male', '11', '0000-00-00', 'Orikhiv', 'Court', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1214, '109', 'Ronnie', 'Commander', 'Brammall', 'Polygender', '11', '0000-00-00', 'Yingshouyingzi', 'Lane', '7', '', NULL, '', '', '2023-01-12 13:24:21'),
(1215, '110', 'Lanie', 'Musto', 'Curr', 'Female', '11', '0000-00-00', 'Purwodadi', 'Way', '6', '', NULL, '', '', '2023-01-12 13:24:21'),
(1216, '111', 'Townsend', 'De Santos', 'Freed', 'Male', '11', '0000-00-00', 'Kayasula', 'Pass', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1217, '112', 'Wit', 'O\'Donegan', 'Hovenden', 'Male', '11', '0000-00-00', 'Proástion', 'Hill', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1218, '113', 'Drusi', 'Ledwitch', 'Duxbarry', 'Female', '11', '0000-00-00', 'Stockholm', 'Pass', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1219, '114', 'Adamo', 'Muskett', 'Chappelle', 'Male', '11', '0000-00-00', 'Shatura', 'Circle', '6', '', NULL, '', '', '2023-01-12 13:24:21'),
(1220, '115', 'Clevie', 'Godbolt', 'Quenell', 'Male', '11', '0000-00-00', 'Independencia', 'Road', '7', '', NULL, '', '', '2023-01-12 13:24:21'),
(1221, '116', 'Marten', 'Lakes', 'Wozencraft', 'Male', '11', '0000-00-00', 'Qutqashen', 'Junction', '6', '', NULL, '', '', '2023-01-12 13:24:21'),
(1222, '117', 'Hoebart', 'Braybrookes', 'Haye', 'Male', '11', '0000-00-00', 'Saint-Avertin', 'Way', '6', '', NULL, '', '', '2023-01-12 13:24:21'),
(1223, '118', 'Floyd', 'De La Coste', 'Lubeck', 'Male', '11', '0000-00-00', 'Ciechanów', 'Avenue', '6', '', NULL, '', '', '2023-01-12 13:24:21'),
(1224, '119', 'Vonny', 'Killik', 'Bausor', 'Female', '11', '0000-00-00', 'Sopo', 'Street', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1225, '120', 'Burke', 'Coathup', 'Klagge', 'Agender', '11', '0000-00-00', 'Gunungbatu', 'Point', '7', '', NULL, '', '', '2023-01-12 13:24:21'),
(1226, '121', 'Lucina', 'Vallantine', 'Quiddington', 'Female', '11', '0000-00-00', 'Petaling Jaya', 'Hill', '6', '', NULL, '', '', '2023-01-12 13:24:21'),
(1227, '122', 'Diego', 'Albion', 'Gullifant', 'Male', '11', '0000-00-00', 'Kubangkondang', 'Avenue', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1228, '123', 'Mata', 'Windybank', 'Margach', 'Male', '11', '0000-00-00', 'Burujul', 'Center', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1229, '124', 'Stanislaw', 'Urquhart', 'Hannan', 'Male', '11', '0000-00-00', 'Fuling', 'Lane', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1230, '125', 'Daphene', 'Lines', 'Ivkovic', 'Female', '11', '0000-00-00', 'Żurowa', 'Place', '10', '', NULL, '', '', '2023-01-12 13:24:21'),
(1231, '126', 'Sydney', 'Soughton', 'Shirtcliffe', 'Female', '11', '0000-00-00', 'Argelia', 'Point', '10', '', NULL, '', '', '2023-01-12 13:24:21'),
(1232, '127', 'Finlay', 'Murdy', 'Malling', 'Male', '11', '0000-00-00', 'Tungoo', 'Street', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1233, '128', 'Carling', 'Hulbert', 'Zarb', 'Male', '11', '0000-00-00', 'Caobi', 'Drive', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1234, '129', 'Derward', 'Gutherson', 'Godlonton', 'Male', '11', '0000-00-00', 'Gelan', 'Court', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1235, '130', 'Scottie', 'Pescott', 'Rome', 'Male', '11', '0000-00-00', 'Aija', 'Parkway', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1236, '131', 'Alain', 'Swettenham', 'O\'Kenny', 'Male', '11', '0000-00-00', 'Agoo', 'Plaza', '7', '', NULL, '', '', '2023-01-12 13:24:21'),
(1237, '132', 'Wally', 'Demcik', 'Espinos', 'Male', '11', '0000-00-00', 'Wangcun', 'Drive', '6', '', NULL, '', '', '2023-01-12 13:24:21'),
(1238, '133', 'Adela', 'Kirimaa', 'Atton', 'Female', '11', '0000-00-00', 'Beixin', 'Pass', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1239, '134', 'Kori', 'Ell', 'Scruby', 'Female', '11', '0000-00-00', 'Dmytrivka', 'Place', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1240, '135', 'Amelia', 'Jaime', 'Kilcullen', 'Female', '11', '0000-00-00', 'Lille', 'Park', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1241, '136', 'Valenka', 'De Coursey', 'Ledster', 'Female', '11', '0000-00-00', 'Sukmoilang', 'Junction', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1242, '137', 'Petey', 'Ickovic', 'Priddis', 'Male', '11', '0000-00-00', 'Tutut', 'Court', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1243, '138', 'Obediah', 'Hawson', 'Sangwine', 'Male', '11', '0000-00-00', 'Amsterdam', 'Plaza', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1244, '139', 'Tomaso', 'Konzelmann', 'Peiro', 'Non-binary', '11', '0000-00-00', 'Hörby', 'Alley', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1245, '140', 'Kendricks', 'Vassano', 'Haysey', 'Male', '11', '0000-00-00', 'Vale', 'Center', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1246, '141', 'Neda', 'Curry', 'Hutfield', 'Female', '11', '0000-00-00', 'Dugcal', 'Road', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1247, '142', 'Ethelred', 'Bernette', 'Luxmoore', 'Male', '11', '0000-00-00', 'Eha Amufu', 'Terrace', '7', '', NULL, '', '', '2023-01-12 13:24:21'),
(1248, '143', 'Jozef', 'Berthot', 'Letertre', 'Genderfluid', '11', '0000-00-00', 'Sandouping', 'Alley', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1249, '144', 'Drona', 'Randal', 'Cordeiro', 'Female', '11', '0000-00-00', 'Nakhon Si Thammarat', 'Crossing', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1250, '145', 'Sherie', 'Corrao', 'Sharer', 'Female', '11', '0000-00-00', 'Muang Xay', 'Hill', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1251, '146', 'Ewart', 'Stears', 'Friedank', 'Male', '11', '0000-00-00', 'Āwash', 'Park', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1252, '147', 'Eric', 'Heliar', 'Storks', 'Male', '11', '0000-00-00', 'Vranje', 'Parkway', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1253, '148', 'Dorothee', 'Beades', 'Pinn', 'Female', '11', '0000-00-00', 'Xiaolukou', 'Street', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1254, '149', 'Ivan', 'Vaan', 'Hryniewicki', 'Male', '11', '0000-00-00', 'Cherga', 'Parkway', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1255, '150', 'Cherey', 'Fattore', 'Cureton', 'Female', '11', '0000-00-00', 'Issy-les-Moulineaux', 'Center', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1256, '151', 'Shalom', 'Rainbow', 'De Laci', 'Male', '11', '0000-00-00', 'Tiantai', 'Avenue', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1257, '152', 'Kele', 'Offener', 'Prinnett', 'Male', '11', '0000-00-00', 'Singaparna', 'Alley', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1258, '153', 'Bill', 'Hatrey', 'Ferrino', 'Female', '11', '0000-00-00', 'Kallinge', 'Alley', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1259, '154', 'Paquito', 'Caney', 'Darnborough', 'Male', '11', '0000-00-00', 'Lipnica', 'Pass', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1260, '155', 'Drucie', 'Levensky', 'Gadman', 'Female', '11', '0000-00-00', 'Newbiggin', 'Plaza', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1261, '156', 'Gwynne', 'Flecknoe', 'Linneman', 'Female', '11', '0000-00-00', 'Suban Jeriji', 'Center', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1262, '157', 'Pammy', 'Ventam', 'Greatrakes', 'Female', '11', '0000-00-00', 'Bizana', 'Trail', '7', '', NULL, '', '', '2023-01-12 13:24:21'),
(1263, '158', 'Lidia', 'Seiffert', 'Chatters', 'Female', '11', '0000-00-00', 'Quintã', 'Avenue', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1264, '159', 'Felita', 'Pulfer', 'Oleszczak', 'Female', '11', '0000-00-00', 'Kuala Lumpur', 'Way', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1265, '160', 'Shelley', 'Rosen', 'Ausello', 'Female', '11', '0000-00-00', 'L\'Aigle', 'Road', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1266, '161', 'Gunar', 'Rhucroft', 'Gostyke', 'Male', '11', '0000-00-00', 'Palmeiros', 'Park', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1267, '162', 'Reinwald', 'Melendez', 'Moukes', 'Male', '11', '0000-00-00', 'San Pedro Carchá', 'Trail', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1268, '163', 'Gage', 'Meadway', 'Olligan', 'Male', '11', '0000-00-00', 'Biała', 'Circle', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1269, '164', 'Emanuel', 'Goffe', 'Roughsedge', 'Male', '11', '0000-00-00', 'Charenton-le-Pont', 'Park', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1270, '165', 'Turner', 'Meatcher', 'Walley', 'Male', '11', '0000-00-00', 'Preko', 'Trail', '7', '', NULL, '', '', '2023-01-12 13:24:21'),
(1271, '166', 'Carroll', 'Baggarley', 'O\'Riordan', 'Genderqueer', '11', '0000-00-00', 'Ganja', 'Point', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1272, '167', 'Viva', 'Ghidelli', 'Crame', 'Female', '11', '0000-00-00', 'Urshel’skiy', 'Plaza', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1273, '168', 'Lina', 'McElmurray', 'Richmond', 'Female', '11', '0000-00-00', 'Kafr az Zayyāt', 'Court', '10', '', NULL, '', '', '2023-01-12 13:24:21'),
(1274, '169', 'Darren', 'Ritchard', 'Bubear', 'Male', '11', '0000-00-00', 'Plataran', 'Pass', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1275, '170', 'Gordan', 'Gossling', 'Teaser', 'Male', '11', '0000-00-00', 'Tongjing', 'Trail', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1276, '171', 'Rebekah', 'Szimoni', 'Eyles', 'Female', '11', '0000-00-00', 'Yuwang', 'Junction', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1277, '172', 'Clareta', 'Renad', 'Gligori', 'Female', '11', '0000-00-00', 'Solna', 'Center', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1278, '173', 'Ardis', 'Underwood', 'Stoving', 'Female', '11', '0000-00-00', 'Donghai', 'Trail', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1279, '174', 'Sayer', 'Peacey', 'Benfield', 'Male', '11', '0000-00-00', 'Skibbereen', 'Point', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1280, '175', 'Junette', 'Dredge', 'Cushe', 'Female', '11', '0000-00-00', 'Nakhabino', 'Circle', '7', '', NULL, '', '', '2023-01-12 13:24:21'),
(1281, '176', 'Carmen', 'Huckerbe', 'Mityashin', 'Female', '11', '0000-00-00', 'Bodø', 'Center', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1282, '177', 'Mitchel', 'Pfeffle', 'Maycey', 'Male', '11', '0000-00-00', 'San Pedro Zacapa', 'Crossing', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1283, '178', 'Brittany', 'Holbury', 'Albutt', 'Female', '11', '0000-00-00', 'Jatirejo', 'Circle', '6', '', NULL, '', '', '2023-01-12 13:24:21'),
(1284, '179', 'Gerri', 'Kluss', 'Gytesham', 'Male', '11', '0000-00-00', 'Dakoro', 'Court', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1285, '180', 'Gael', 'Whorlow', 'Gritton', 'Male', '11', '0000-00-00', 'Descalvado', 'Trail', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1286, '181', 'Leonid', 'Cherry Holme', 'Copner', 'Male', '11', '0000-00-00', 'Biaoxi', 'Center', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1287, '182', 'Mady', 'Andrysek', 'Whatford', 'Female', '11', '0000-00-00', 'Mapusagafou', 'Park', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1288, '183', 'Pierrette', 'Scougall', 'Inge', 'Female', '11', '0000-00-00', 'Yaroslavskaya', 'Road', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1289, '184', 'Creigh', 'Gawler', 'Cave', 'Genderqueer', '11', '0000-00-00', 'Barra do Bugres', 'Hill', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1290, '185', 'Barty', 'Gregg', 'Shevill', 'Male', '11', '0000-00-00', 'Yagoua', 'Circle', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1291, '186', 'Elianora', 'Coaster', 'Schubuser', 'Female', '11', '0000-00-00', 'Bauang', 'Way', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1292, '187', 'Rad', 'Beardsworth', 'Thomkins', 'Male', '11', '0000-00-00', 'Sibulan', 'Avenue', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1293, '188', 'Joan', 'Caiger', 'Jakov', 'Female', '11', '0000-00-00', 'Zaraza', 'Way', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1294, '189', 'Konstanze', 'Sapwell', 'Sclater', 'Polygender', '11', '0000-00-00', 'Girón', 'Alley', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1295, '190', 'Betty', 'Mathwin', 'Dax', 'Female', '11', '0000-00-00', 'Bradford', 'Way', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1296, '191', 'Haskel', 'Morhall', 'Fear', 'Male', '11', '0000-00-00', 'Kesheng', 'Point', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1297, '192', 'Florella', 'Giovanitti', 'Northcote', 'Female', '11', '0000-00-00', 'Zwedru', 'Trail', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1298, '193', 'Rene', 'Swainger', 'Coslett', 'Female', '11', '0000-00-00', 'Moscow', 'Road', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1299, '194', 'Maurita', 'Jezard', 'Spohrmann', 'Female', '11', '0000-00-00', 'Aston', 'Trail', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1300, '195', 'Gillian', 'Jakoubek', 'MacLoughlin', 'Female', '11', '0000-00-00', 'Wąsosz', 'Junction', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1301, '196', 'Theresina', 'Nystrom', 'MacLaren', 'Genderfluid', '11', '0000-00-00', 'Várzea da Serra', 'Lane', '10', '', NULL, '', '', '2023-01-12 13:24:21'),
(1302, '197', 'Darin', 'Martinet', 'Balthasar', 'Male', '11', '0000-00-00', 'Dalarik', 'Lane', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1303, '198', 'Pace', 'Garriock', 'Boays', 'Male', '11', '0000-00-00', 'Cartagena', 'Alley', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1304, '199', 'Alvis', 'Jozwik', 'Eddowis', 'Male', '11', '0000-00-00', 'Neochóri', 'Court', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1305, '200', 'Joeann', 'Barnaby', 'Dumper', 'Female', '11', '0000-00-00', 'Biankouma', 'Plaza', '6', '', NULL, '', '', '2023-01-12 13:24:21'),
(1306, '201', 'Perry', 'Novic', 'Szymanski', 'Female', '11', '0000-00-00', 'Xin’e', 'Plaza', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1307, '202', 'Max', 'Carlton', 'Atherley', 'Female', '11', '0000-00-00', 'Salmi', 'Trail', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1308, '203', 'Afton', 'Stollman', 'Siemandl', 'Genderqueer', '11', '0000-00-00', 'Qiaolin', 'Place', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1309, '204', 'Alissa', 'Whitter', 'Litel', 'Female', '11', '0000-00-00', 'Mulleriyawa', 'Way', '3', '', NULL, '', '', '2023-01-12 13:24:21'),
(1310, '205', 'Cleopatra', 'Broker', 'Devine', 'Female', '11', '0000-00-00', 'Veliki Preslav', 'Lane', '1', '', NULL, '', '', '2023-01-12 13:24:21'),
(1311, '206', 'Carlie', 'Rosendale', 'Overal', 'Male', '11', '0000-00-00', 'Aracruz', 'Junction', '8', '', NULL, '', '', '2023-01-12 13:24:21'),
(1312, '207', 'Eden', 'Bower', 'Lancett', 'Female', '11', '0000-00-00', 'Kuanchuan', 'Place', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1313, '208', 'Reese', 'Coghlin', 'Leatherland', 'Bigender', '11', '0000-00-00', 'Huambo', 'Trail', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1314, '209', 'Nessy', 'Sanson', 'Portlock', 'Bigender', '11', '0000-00-00', 'Binjiang', 'Lane', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1315, '210', 'Carol', 'Gunter', 'Kener', 'Female', '11', '0000-00-00', 'Hyrynsalmi', 'Hill', '9', '', NULL, '', '', '2023-01-12 13:24:21'),
(1316, '211', 'Larina', 'Moniker', 'Becerra', 'Female', '11', '0000-00-00', 'Šmarje pri Jelšah', 'Way', '7', '', NULL, '', '', '2023-01-12 13:24:21'),
(1317, '212', 'Rand', 'Renoden', 'Flintoft', 'Male', '11', '0000-00-00', 'Petrolera', 'Street', '4', '', NULL, '', '', '2023-01-12 13:24:21'),
(1318, '213', 'Tally', 'Elsworth', 'O\'Connolly', 'Male', '11', '0000-00-00', 'Sarband', 'Way', '5', '', NULL, '', '', '2023-01-12 13:24:21'),
(1319, '214', 'Duane', 'Bernardini', 'Gibbe', 'Male', '11', '0000-00-00', 'São Sebastião do Passé', 'Park', '2', '', NULL, '', '', '2023-01-12 13:24:21'),
(1320, '215', 'Kellia', 'Lammas', 'Croisdall', 'Female', '11', '0000-00-00', 'Usa River', 'Alley', '8', '', NULL, '', '', '2023-01-12 13:24:22'),
(1321, '216', 'Alexandrina', 'Bresson', 'Clarage', 'Female', '11', '0000-00-00', 'Trongsa', 'Drive', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1322, '217', 'Ottilie', 'Esley', 'Gaddie', 'Bigender', '11', '0000-00-00', 'Karangkeng', 'Point', '3', '', NULL, '', '', '2023-01-12 13:24:22'),
(1323, '218', 'Jemmy', 'Terney', 'Ekell', 'Female', '11', '0000-00-00', 'Kanáli', 'Plaza', '7', '', NULL, '', '', '2023-01-12 13:24:22'),
(1324, '219', 'Karlik', 'Bartels-Ellis', 'McIsaac', 'Male', '11', '0000-00-00', 'Ejigbo', 'Pass', '1', '', NULL, '', '', '2023-01-12 13:24:22'),
(1325, '220', 'Jasmina', 'Simm', 'Ottey', 'Female', '11', '0000-00-00', 'Turiys’k', 'Center', '1', '', NULL, '', '', '2023-01-12 13:24:22'),
(1326, '221', 'Ferdie', 'Flounders', 'Bindin', 'Male', '11', '0000-00-00', 'Tanahwurung', 'Terrace', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1327, '222', 'Siward', 'Pilsbury', 'Harmston', 'Male', '11', '0000-00-00', 'Göteborg', 'Lane', '8', '', NULL, '', '', '2023-01-12 13:24:22'),
(1328, '223', 'Malachi', 'Forman', 'Bogie', 'Male', '11', '0000-00-00', 'Manhiça', 'Circle', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1329, '224', 'Cordie', 'Klemps', 'Audsley', 'Female', '11', '0000-00-00', 'Kopang Satu', 'Hill', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1330, '225', 'Regina', 'Catlin', 'Dunaway', 'Female', '11', '0000-00-00', 'Kohtla-Järve', 'Way', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1331, '226', 'Arron', 'Garlicke', 'Shotter', 'Male', '11', '0000-00-00', 'Kedrovyy', 'Court', '1', '', NULL, '', '', '2023-01-12 13:24:22'),
(1332, '227', 'Amabelle', 'De Vries', 'McCuish', 'Female', '11', '0000-00-00', 'Carreira', 'Pass', '7', '', NULL, '', '', '2023-01-12 13:24:22'),
(1333, '228', 'Van', 'Cradduck', 'Slade', 'Female', '11', '0000-00-00', 'Sukamanah', 'Terrace', '3', '', NULL, '', '', '2023-01-12 13:24:22'),
(1334, '229', 'Markus', 'Weymont', 'Zammett', 'Male', '11', '0000-00-00', 'Taibai', 'Road', '3', '', NULL, '', '', '2023-01-12 13:24:22'),
(1335, '230', 'Godiva', 'Paunton', 'Meiklem', 'Female', '11', '0000-00-00', 'Melong', 'Plaza', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1336, '231', 'Katey', 'Blint', 'Elsy', 'Bigender', '11', '0000-00-00', 'Sabang', 'Place', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1337, '232', 'Addie', 'Brickett', 'Dalgarnocht', 'Male', '11', '0000-00-00', 'Zaragoza', 'Place', '5', '', NULL, '', '', '2023-01-12 13:24:22'),
(1338, '233', 'Corbet', 'Crennan', 'Karlicek', 'Male', '11', '0000-00-00', 'Zhuqi', 'Court', '8', '', NULL, '', '', '2023-01-12 13:24:22'),
(1339, '234', 'Renado', 'O\'Kinedy', 'Paterson', 'Male', '11', '0000-00-00', 'Pu’er', 'Terrace', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1340, '235', 'Timotheus', 'Dunderdale', 'Dwelley', 'Male', '11', '0000-00-00', 'Shantou', 'Pass', '4', '', NULL, '', '', '2023-01-12 13:24:22'),
(1341, '236', 'Dulcy', 'Brooks', 'Osment', 'Female', '11', '0000-00-00', 'Shuangyang', 'Court', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1342, '237', 'Franz', 'Twinborough', 'Hainning', 'Male', '11', '0000-00-00', 'Paris 03', 'Park', '1', '', NULL, '', '', '2023-01-12 13:24:22'),
(1343, '238', 'Timi', 'Curton', 'Theobald', 'Female', '11', '0000-00-00', 'Novolugovoye', 'Junction', '4', '', NULL, '', '', '2023-01-12 13:24:22'),
(1344, '239', 'Ertha', 'Brodeur', 'Spiller', 'Female', '11', '0000-00-00', 'Itaboraí', 'Alley', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1345, '240', 'Denny', 'Bache', 'Smithen', 'Male', '11', '0000-00-00', 'Kitale', 'Circle', '4', '', NULL, '', '', '2023-01-12 13:24:22'),
(1346, '241', 'Alley', 'Polino', 'Fleming', 'Male', '11', '0000-00-00', 'San Luis', 'Trail', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1347, '242', 'Christina', 'Valentinuzzi', 'Kropp', 'Non-binary', '11', '0000-00-00', 'Hufeng', 'Way', '1', '', NULL, '', '', '2023-01-12 13:24:22'),
(1348, '243', 'Shelden', 'Foston', 'Pickthall', 'Male', '11', '0000-00-00', 'Seattle', 'Way', '1', '', NULL, '', '', '2023-01-12 13:24:22'),
(1349, '244', 'Vincent', 'Mozzi', 'Richardes', 'Male', '11', '0000-00-00', 'Canoas', 'Alley', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1350, '245', 'Gallard', 'Gouldbourn', 'Chidlow', 'Male', '11', '0000-00-00', 'Mabamba', 'Plaza', '4', '', NULL, '', '', '2023-01-12 13:24:22'),
(1351, '246', 'Garret', 'Kilmartin', 'Kamenar', 'Male', '11', '0000-00-00', 'Hekou', 'Crossing', '8', '', NULL, '', '', '2023-01-12 13:24:22'),
(1352, '247', 'Lynnea', 'Tunder', 'Sanzio', 'Female', '11', '0000-00-00', 'Gandapura', 'Road', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1353, '248', 'Stearne', 'Westwell', 'McGeady', 'Non-binary', '11', '0000-00-00', 'Moriki', 'Court', '3', '', NULL, '', '', '2023-01-12 13:24:22'),
(1354, '249', 'Massimiliano', 'Duckels', 'Bellison', 'Male', '11', '0000-00-00', 'Ubinskoye', 'Circle', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1355, '250', 'Gillian', 'Paschke', 'Akred', 'Female', '11', '0000-00-00', 'Nsanje', 'Crossing', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1356, '251', 'Yvor', 'Ridsdole', 'Loadwick', 'Male', '11', '0000-00-00', 'Bagusan', 'Drive', '4', '', NULL, '', '', '2023-01-12 13:24:22'),
(1357, '252', 'Loydie', 'Ellis', 'Dicks', 'Male', '11', '0000-00-00', 'Chenchang', 'Trail', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1358, '253', 'Minerva', 'Mears', 'Houlton', 'Female', '11', '0000-00-00', 'New Iloilo', 'Way', '3', '', NULL, '', '', '2023-01-12 13:24:22'),
(1359, '254', 'Henderson', 'Swannack', 'Verling', 'Male', '11', '0000-00-00', 'Bertioga', 'Park', '3', '', NULL, '', '', '2023-01-12 13:24:22'),
(1360, '255', 'Ahmed', 'Girodier', 'Ames', 'Male', '11', '0000-00-00', 'Agidel’', 'Trail', '7', '', NULL, '', '', '2023-01-12 13:24:22'),
(1361, '256', 'Zonnya', 'Oldred', 'Hexum', 'Female', '11', '0000-00-00', 'Nerópolis', 'Plaza', '7', '', NULL, '', '', '2023-01-12 13:24:22'),
(1362, '257', 'Nev', 'Lofts', 'Hattam', 'Male', '11', '0000-00-00', 'Mengjia', 'Point', '10', '', NULL, '', '', '2023-01-12 13:24:22'),
(1363, '258', 'Madonna', 'Prayer', 'Humble', 'Female', '11', '0000-00-00', 'Malaga', 'Alley', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1364, '259', 'Neilla', 'Rappoport', 'Glisane', 'Female', '11', '0000-00-00', 'Söderhamn', 'Way', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1365, '260', 'Sigrid', 'Knyvett', 'Kemer', 'Female', '11', '0000-00-00', 'Kembang', 'Junction', '1', '', NULL, '', '', '2023-01-12 13:24:22'),
(1366, '261', 'Lamont', 'Rawlingson', 'Stemson', 'Male', '11', '0000-00-00', 'Chenhu', 'Trail', '3', '', NULL, '', '', '2023-01-12 13:24:22'),
(1367, '262', 'Erin', 'Nyssens', 'O\'Reilly', 'Female', '11', '0000-00-00', 'Asino', 'Parkway', '8', '', NULL, '', '', '2023-01-12 13:24:22'),
(1368, '263', 'Ned', 'Merriday', 'Stailey', 'Genderqueer', '11', '0000-00-00', 'Töreboda', 'Place', '8', '', NULL, '', '', '2023-01-12 13:24:22'),
(1369, '264', 'Ketty', 'Rubinek', 'Denisevich', 'Female', '11', '0000-00-00', 'Vacenovice', 'Street', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1370, '265', 'Brittni', 'Flitcroft', 'Ailward', 'Female', '11', '0000-00-00', 'Jivia', 'Terrace', '3', '', NULL, '', '', '2023-01-12 13:24:22'),
(1371, '266', 'Loni', 'Akester', 'Wedmore', 'Female', '11', '0000-00-00', 'Tuamese', 'Center', '1', '', NULL, '', '', '2023-01-12 13:24:22'),
(1372, '267', 'Carver', 'Heasley', 'Albery', 'Male', '11', '0000-00-00', 'Kalangan', 'Junction', '3', '', NULL, '', '', '2023-01-12 13:24:22'),
(1373, '268', 'Deeyn', 'Dmytryk', 'Bolam', 'Female', '11', '0000-00-00', 'Curry', 'Court', '3', '', NULL, '', '', '2023-01-12 13:24:22'),
(1374, '269', 'Latrena', 'Brigginshaw', 'Milkeham', 'Female', '11', '0000-00-00', 'Muang Pakxan', 'Crossing', '1', '', NULL, '', '', '2023-01-12 13:24:22'),
(1375, '270', 'Hephzibah', 'Ambrose', 'Van Daalen', 'Female', '11', '0000-00-00', 'Dabbūrīya', 'Way', '10', '', NULL, '', '', '2023-01-12 13:24:22'),
(1376, '271', 'Benji', 'Lawrey', 'Mockford', 'Male', '11', '0000-00-00', 'Proletarskiy', 'Street', '7', '', NULL, '', '', '2023-01-12 13:24:22'),
(1377, '272', 'Linnet', 'Berks', 'Pilsbury', 'Female', '11', '0000-00-00', 'Čajetina', 'Crossing', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1378, '273', 'Maddie', 'Jeayes', 'Wimpeney', 'Male', '11', '0000-00-00', 'Magdug', 'Road', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1379, '274', 'Trent', 'Erskin', 'Maciaszczyk', 'Male', '11', '0000-00-00', 'Barcelona', 'Park', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1380, '275', 'Delaney', 'Fabbro', 'McGorman', 'Male', '11', '0000-00-00', 'Barbudo', 'Road', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1381, '276', 'Norma', 'Towson', 'Dymidowski', 'Female', '11', '0000-00-00', 'Al Khānkah', 'Parkway', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1382, '277', 'Hildagard', 'Janicki', 'Riteley', 'Female', '11', '0000-00-00', 'Busan', 'Center', '10', '', NULL, '', '', '2023-01-12 13:24:22'),
(1383, '278', 'Arlan', 'Cornelis', 'Klimuk', 'Male', '11', '0000-00-00', 'Livramento', 'Hill', '2', '', NULL, '', '', '2023-01-12 13:24:22'),
(1384, '279', 'Em', 'Galego', 'Beccles', 'Female', '11', '0000-00-00', 'Dugu', 'Way', '4', '', NULL, '', '', '2023-01-12 13:24:22'),
(1385, '280', 'Leonerd', 'Windress', 'Kubecka', 'Male', '11', '0000-00-00', 'Kawaguchi', 'Pass', '2', '', NULL, '', '', '2023-01-12 13:24:22'),
(1386, '281', 'Selene', 'Widdocks', 'Jeary', 'Female', '11', '0000-00-00', 'Curuzú Cuatiá', 'Place', '10', '', NULL, '', '', '2023-01-12 13:24:22'),
(1387, '282', 'Meade', 'Steddall', 'Kitchiner', 'Genderqueer', '11', '0000-00-00', 'Uozu', 'Drive', '10', '', NULL, '', '', '2023-01-12 13:24:22'),
(1388, '283', 'Sisile', 'Witterick', 'Gooly', 'Agender', '11', '0000-00-00', 'Nonsan', 'Court', '8', '', NULL, '', '', '2023-01-12 13:24:22'),
(1389, '284', 'Skelly', 'Yetts', 'Boyn', 'Male', '11', '0000-00-00', 'Tarbes', 'Junction', '4', '', NULL, '', '', '2023-01-12 13:24:22'),
(1390, '285', 'Audry', 'Clendinning', 'Ilson', 'Female', '11', '0000-00-00', 'Ejido', 'Circle', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1391, '286', 'Lurette', 'Polon', 'Beardwell', 'Female', '11', '0000-00-00', 'Okpoma', 'Point', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1392, '287', 'Izak', 'Matyashev', 'Tender', 'Male', '11', '0000-00-00', 'Albany', 'Avenue', '10', '', NULL, '', '', '2023-01-12 13:24:22'),
(1393, '288', 'Tallou', 'Bown', 'Kinnard', 'Female', '11', '0000-00-00', 'Bhokadoke', 'Court', '3', '', NULL, '', '', '2023-01-12 13:24:22'),
(1394, '289', 'Silvan', 'Lello', 'Knipe', 'Male', '11', '0000-00-00', 'Pubal', 'Plaza', '5', '', NULL, '', '', '2023-01-12 13:24:22'),
(1395, '290', 'Abigael', 'Prettjohn', 'Pelman', 'Female', '11', '0000-00-00', 'Nefta', 'Center', '1', '', NULL, '', '', '2023-01-12 13:24:22'),
(1396, '291', 'Nadia', 'Marvin', 'Audiss', 'Female', '11', '0000-00-00', 'Jieznas', 'Point', '2', '', NULL, '', '', '2023-01-12 13:24:22'),
(1397, '292', 'Vitoria', 'Heisman', 'Davidesco', 'Female', '11', '0000-00-00', 'Épinal', 'Trail', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1398, '293', 'Dex', 'Catterall', 'Cowper', 'Male', '11', '0000-00-00', 'Um Jar Al Gharbiyya', 'Drive', '5', '', NULL, '', '', '2023-01-12 13:24:22'),
(1399, '294', 'Brunhilda', 'Jameson', 'Candie', 'Non-binary', '11', '0000-00-00', 'San Pedro de Atacama', 'Place', '5', '', NULL, '', '', '2023-01-12 13:24:22'),
(1400, '295', 'Sunshine', 'Rawstorne', 'D\'Elias', 'Female', '11', '0000-00-00', 'Porto de Mós', 'Place', '10', '', NULL, '', '', '2023-01-12 13:24:22'),
(1401, '296', 'Jenna', 'Moorwood', 'Cline', 'Female', '11', '0000-00-00', 'Feyẕābād', 'Plaza', '7', '', NULL, '', '', '2023-01-12 13:24:22'),
(1402, '297', 'Si', 'Benallack', 'Pleming', 'Male', '11', '0000-00-00', 'Hekou', 'Lane', '6', '', NULL, '', '', '2023-01-12 13:24:22'),
(1403, '298', 'Leroi', 'Hagley', 'Farry', 'Male', '11', '0000-00-00', 'Kislovodsk', 'Way', '9', '', NULL, '', '', '2023-01-12 13:24:22'),
(1404, '299', 'Jackie', 'Cowing', 'Gainseford', 'Agender', '11', '0000-00-00', 'Sebasang', 'Circle', '2', '', NULL, '', '', '2023-01-12 13:24:22'),
(1405, '300', 'Cass', 'Maciejak', 'Holbie', 'Non-binary', '11', '0000-00-00', 'Longtang', 'Street', '4', '', NULL, '', '', '2023-01-12 13:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `senior_req`
--

CREATE TABLE `senior_req` (
  `id` int(11) NOT NULL,
  `senior_id` int(11) NOT NULL,
  `birth_cert` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `brgy_cert` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `store_name` varchar(250) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_number` int(20) NOT NULL,
  `address` varchar(250) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `username`, `password`, `mobile_number`, `address`, `image`, `created_at`) VALUES
(9, 'Gaisano Grand Mall Store ', 'gaisano', 'default', 987654332, 'Toril, Davao City', '409378-gaisano-logo-no-shadow-1.png', '2022-11-29 17:18:51'),
(11, 'Grocerama Store', 'grocerama', 'default', 2147483647, 'Toril, Davao City', '892759-download-(3).jfif', '2022-11-29 18:29:05'),
(15, 'Gmall Groceries ', 'gmall', 'default', 937466653, 'Toril, Davao City, Davao Del Sur', '834618-download-(1).png', '2023-01-12 22:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `seniorcitizen_id` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `active` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `seniorcitizen_id`, `username`, `password`, `role`, `status`, `active`, `created_at`) VALUES
(1, '', 'osca', 'pass1234', 'osca', '', 'Active', '2022-10-13 12:19:36'),
(2, '', 'user', 'pass1234', 'user', '', 'Active', '2022-10-13 12:19:36'),
(4, '', 'leader ', 'pass1234', 'leader', '', 'Active', '2022-10-15 12:58:47'),
(11, '', 'dswd', 'pass1234', 'dswd', '', 'Active', '2022-10-16 10:24:32'),
(62, '', 'barangay', 'pass1234', 'barangay', '', 'Active', '2022-10-25 17:08:56'),
(76, '', 'admin', 'admin', 'admin', '', 'Active', '2022-12-27 11:46:53'),
(98, '790040969080-16', 'johncesar', 'pass1234', 'user', 'registered', 'Active', '2023-01-09 01:41:10'),
(100, '124011259511-13', 'jerecho', 'pass1234', 'user', 'registered', 'Active', '2023-01-09 05:29:20'),
(101, '171733560543-10', 'Jonathan', '171733560543-10', 'user', 'registered', 'Active', '2023-01-12 11:01:59'),
(102, '797662041849', 'welgen', '1234', 'user', 'registered', 'Active', '2023-01-12 12:34:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement_responses`
--
ALTER TABLE `announcement_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcement_responses_ibfk_1` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_id` (`storeid`);

--
-- Indexes for table `product_items`
--
ALTER TABLE `product_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `remittances`
--
ALTER TABLE `remittances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remittance_responses`
--
ALTER TABLE `remittance_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `remittance_id` (`remittance_id`);

--
-- Indexes for table `rosters`
--
ALTER TABLE `rosters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seniorcitizen_id` (`seniorcitizen_id`);

--
-- Indexes for table `seniors`
--
ALTER TABLE `seniors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seniorcitizen_id` (`seniorcitizen_id`);

--
-- Indexes for table `senior_req`
--
ALTER TABLE `senior_req`
  ADD PRIMARY KEY (`id`),
  ADD KEY `senior_id` (`senior_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `announcement_responses`
--
ALTER TABLE `announcement_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product_items`
--
ALTER TABLE `product_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `remittances`
--
ALTER TABLE `remittances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `remittance_responses`
--
ALTER TABLE `remittance_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rosters`
--
ALTER TABLE `rosters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seniors`
--
ALTER TABLE `seniors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1457;

--
-- AUTO_INCREMENT for table `senior_req`
--
ALTER TABLE `senior_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement_responses`
--
ALTER TABLE `announcement_responses`
  ADD CONSTRAINT `announcement_responses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`storeid`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_items`
--
ALTER TABLE `product_items`
  ADD CONSTRAINT `product_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_items_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `remittance_responses`
--
ALTER TABLE `remittance_responses`
  ADD CONSTRAINT `remittance_responses_ibfk_1` FOREIGN KEY (`remittance_id`) REFERENCES `remittances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rosters`
--
ALTER TABLE `rosters`
  ADD CONSTRAINT `rosters_ibfk_1` FOREIGN KEY (`seniorcitizen_id`) REFERENCES `seniors` (`seniorcitizen_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `senior_req`
--
ALTER TABLE `senior_req`
  ADD CONSTRAINT `senior_req_ibfk_1` FOREIGN KEY (`senior_id`) REFERENCES `seniors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
