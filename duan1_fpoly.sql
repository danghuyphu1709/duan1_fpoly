-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2024 at 09:34 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duan1_fpoly`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int NOT NULL,
  `role_id` int NOT NULL,
  `code` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `role_id`, `code`, `name`, `username`, `password`, `phone`, `email`, `avatar`, `create_at`, `update_at`) VALUES
(2, 2, 3264221, 'Đặng Huy Phú', 'admin', '$2y$10$u6JqOgpZcvajWUYlGQxs5enywXmXVZ0PC./yt5jqRDfvtBeKXSbH2', 963392869, 'phudhph30417@fpt.edu.vn', NULL, '2023-12-01 10:39:40', NULL),
(3, 3, 3994048, 'Đặng Huy Phú 2', 'nhism', '$2y$10$BMC6/GR.xNzluKTtMFH9YewOaTQ7tV26JufAxU5TNjQ2CNFsXsUn2', 963392868, 'contact.danghuyphu@gmail.com', NULL, '2023-12-01 17:20:38', NULL),
(4, 1, 7785603, 'Đặng Huy Phú', 'danghuyphu1709', '$2y$10$gClp4KDsVsXZHCR7i160Y.OH07755ix/Cd1Fxw8cHWwiR2cZtVq/.', 963392867, 'nhism@gmail.com', NULL, '2023-12-04 10:28:31', '2024-01-02 16:34:49'),
(5, 1, 9307324, 'Đặng Huy Phú', 'danghuyphu1709', '$2y$10$qu6WFp/kXI1bPYCktBJFa.5OWy5IOJh53vdewNCzHOT4GKhHAhxh6', 963392861, 'phudhph30417@fpt.edu.txt', NULL, '2023-12-20 15:50:11', '2024-01-02 16:43:00'),
(6, 1, 7688314, ' anh ba miền tây', 'tienbip2110', '$2y$10$Q1E6RWWXIfzbX7LQ/zG7BuXdW80gllqR3uRIldaLQbWtLvNA1DYaS', 963392866, 'phudhph30417@fpt.edu.cz', '355055904_791334352588745_7826040991901313656_n - Copy.jpg', '2024-03-16 17:57:58', '2024-03-27 16:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int NOT NULL,
  `account_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `adress_id` int NOT NULL,
  `voucher_id` int DEFAULT NULL,
  `code` int NOT NULL,
  `total_mony_after_reduction` decimal(10,2) NOT NULL,
  `total_mony_before_reduction` decimal(10,0) DEFAULT NULL,
  `total_mony` decimal(10,2) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL,
  `create_by` varchar(30) NOT NULL,
  `deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `account_id`, `payment_id`, `adress_id`, `voucher_id`, `code`, `total_mony_after_reduction`, `total_mony_before_reduction`, `total_mony`, `status`, `create_at`, `create_by`, `deleted`) VALUES
(12, 6, 1, 1, 1, 1208289, '1000000.00', '850000', '850000.00', 0, '2024-03-26 17:07:57', 'tienbip2110', 0),
(13, 6, 2, 2, NULL, 2787822, '100000.00', NULL, '100000.00', 4, '2024-03-26 17:11:29', 'tienbip2110', 0),
(14, 6, 1, 1, NULL, 5127978, '20000.00', NULL, '20000.00', 1, '2024-03-27 13:41:05', 'tienbip2110', 0),
(15, 6, 1, 1, 2, 6511366, '200000.00', '180000', '180000.00', 1, '2024-03-27 13:41:49', 'tienbip2110', 0),
(16, 6, 1, 1, NULL, 5676492, '20000.00', NULL, '20000.00', 1, '2024-03-27 13:42:07', 'tienbip2110', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `account_id` int NOT NULL,
  `products_id` int NOT NULL,
  `product_detail_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `create_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` varchar(30) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL,
  `deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `code`, `name`, `create_at`, `create_by`, `update_at`, `update_by`, `deleted`) VALUES
(1, 1094449, 'Bánh Mì', '2023-12-04 19:53:00', 'admin', '2023-12-27 18:44:11', 'admin', 0),
(2, 2887720, 'Bánh Ngọt', '2023-12-04 19:58:55', 'admin', '2023-12-27 18:44:07', 'admin', 0),
(3, 6123693, 'Bánh Kem', '2023-12-06 16:47:29', 'admin', '2024-01-01 19:06:22', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `account_id` int NOT NULL,
  `product_id` int NOT NULL,
  `code` int NOT NULL,
  `content` varchar(500) NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` varchar(30) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `account_id`, `product_id`, `code`, `content`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 2, 28, 2405068, 'test comment\n', '2024-03-16 15:51:53', 'admin', NULL, NULL),
(15, 6, 28, 2797413, 'check', '2024-03-16 18:11:22', 'tienbip2110', NULL, NULL),
(16, 6, 28, 8679121, 'hehee', '2024-03-16 23:11:06', 'tienbip2110', NULL, NULL),
(17, 6, 28, 8061956, 'xin chào mọi người', '2024-03-16 23:11:16', 'tienbip2110', NULL, NULL),
(18, 6, 28, 3063400, 'chúng tôi là 11111', '2024-03-16 23:11:26', 'tienbip2110', NULL, NULL),
(19, 6, 28, 8409891, 'check', '2024-03-17 21:53:36', 'tienbip2110', NULL, NULL),
(20, 6, 28, 4977097, 'aaaa', '2024-03-17 22:13:32', 'tienbip2110', NULL, NULL),
(21, 6, 28, 8554196, 'check', '2024-03-17 22:22:39', 'tienbip2110', NULL, NULL),
(22, 6, 28, 9394441, 'đây là bình luận mới nhất\n', '2024-03-17 22:30:11', 'tienbip2110', NULL, NULL),
(23, 6, 28, 4242655, 'đây laa hehehehe', '2024-03-17 22:34:25', 'tienbip2110', NULL, NULL),
(24, 6, 28, 2496545, 'check now\n', '2024-03-17 22:34:32', 'tienbip2110', NULL, NULL),
(25, 6, 28, 5671109, 'hehehehe', '2024-03-17 22:34:37', 'tienbip2110', NULL, NULL),
(26, 6, 28, 1368599, 'cccnanan', '2024-03-17 22:34:41', 'tienbip2110', NULL, NULL),
(27, 6, 28, 4013567, 'xin chào ạ', '2024-03-17 22:52:14', 'tienbip2110', NULL, NULL),
(28, 2, 28, 2017407, 'check hàng', '2024-03-17 22:52:53', 'admin', NULL, NULL),
(29, 6, 30, 8896812, 'raats tot', '2024-03-25 11:52:20', 'tienbip2110', NULL, NULL),
(30, 6, 30, 4153520, 'hehe', '2024-03-27 15:48:51', 'tienbip2110', NULL, NULL),
(31, 6, 30, 3154081, 'ádasd', '2024-03-27 15:57:26', 'tienbip2110', NULL, NULL),
(32, 6, 30, 1094816, 'aa', '2024-03-27 15:58:06', 'tienbip2110', NULL, NULL),
(33, 6, 30, 2294413, 'ấdm', '2024-03-27 16:04:15', 'tienbip2110', NULL, NULL),
(34, 6, 30, 6379491, 'check\n', '2024-03-27 16:04:56', 'tienbip2110', NULL, NULL),
(35, 6, 30, 6308305, 'hehee', '2024-03-27 16:06:56', 'tienbip2110', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int NOT NULL,
  `account_id` int NOT NULL,
  `village_id` int NOT NULL,
  `ward_id` int NOT NULL,
  `district_id` int NOT NULL,
  `city_province_id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address_detail` varchar(255) NOT NULL,
  `deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `delivery_address`
--

INSERT INTO `delivery_address` (`id`, `account_id`, `village_id`, `ward_id`, `district_id`, `city_province_id`, `name`, `phone`, `address_detail`, `deleted`) VALUES
(1, 6, 4, 5, 2, 1, 'Đặng Huy Phú', '0963392869', 'Số nhà 32 ngõ 74 Cầu Diễn,Cầu Diễn,Bắc Từ Liêm,Hà Nội', 0),
(2, 6, 7, 3, 4, 3, 'Đặng Huy Phú 2', '0963392869', 'Số nhà 32 Xóm 1,Thái Hòa,Hàm Yên,Tuyên Quang', 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_bill`
--

CREATE TABLE `detail_bill` (
  `id` int NOT NULL,
  `bill_id` int NOT NULL,
  `product_detail_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `promotion_price` decimal(10,2) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `create_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_bill`
--

INSERT INTO `detail_bill` (`id`, `bill_id`, `product_detail_id`, `quantity`, `price`, `promotion_price`, `create_at`, `create_by`) VALUES
(18, 12, 41, 5, '200000.00', '0.00', '2024-03-26 17:07:57', 'tienbip2110'),
(19, 13, 39, 5, '20000.00', '0.00', '2024-03-26 17:11:29', 'tienbip2110'),
(20, 14, 39, 1, '20000.00', '0.00', '2024-03-27 13:41:05', 'tienbip2110'),
(21, 15, 39, 10, '20000.00', '0.00', '2024-03-27 13:41:49', 'tienbip2110'),
(22, 16, 29, 1, '20000.00', '0.00', '2024-03-27 13:42:07', 'tienbip2110');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int NOT NULL,
  `province_city_id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `province_city_id`, `name`, `status`) VALUES
(2, 1, 'Bắc Từ Liêm', 0),
(3, 1, 'Nam Từ Liêm', 0),
(4, 3, 'Hàm Yên', 0),
(5, 3, 'Chiêm Hóa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `code` int NOT NULL,
  `source` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` varchar(30) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL,
  `deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `product_id`, `code`, `source`, `create_at`, `create_by`, `update_at`, `update_by`, `deleted`) VALUES
(27, 27, 5244615, 'banhkem1.webp', '2024-03-18 16:08:29', 'tienbip2110', NULL, NULL, 0),
(28, 27, 7787155, 'banhkem2.webp', '2024-03-18 16:08:57', 'tienbip2110', NULL, NULL, 0),
(29, 27, 2648167, 'banhkem3.webp', '2024-03-18 16:09:33', 'tienbip2110', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `name`, `default`, `deleted`) VALUES
(1, 'Thẻ tín dụng', 0, 0),
(2, 'Chuyển Khoản', 0, 0),
(3, 'Nhận hàng thanh toán', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `code` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `avata` varchar(255) DEFAULT NULL,
  `price_max` decimal(10,2) DEFAULT NULL,
  `price_min` decimal(10,2) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `create_by` varchar(30) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `code`, `name`, `description`, `avata`, `price_max`, `price_min`, `create_at`, `create_by`, `update_at`, `update_by`, `deleted`) VALUES
(20, 1, 6360454, 'bánh mì ngọt ', 'sant pham new chinh hãng', 'sandwich-banh-mi.jpg', '12000.00', '12000.00', '2024-01-07 13:01:50', 'admin', '2024-03-07 14:49:48', 'admin', 0),
(21, 1, 9762679, 'bánh kem quế', 'san pham new chinh hang ', 'banh-kem-tiramisu-5-vi.jpg', '30000.00', '20000.00', '2024-01-07 13:03:15', 'admin', '2024-03-07 14:49:39', 'admin', 0),
(22, 1, 8686363, 'bánh cooki', 'san pham new chinh hang gia re', 'banh-cookies-thom-ngon-hap-dan-khong-can-lo-nuong-2f52.jpg', '19000.00', '13000.00', '2024-01-07 13:04:04', 'admin', '2024-03-07 14:49:31', 'admin', 0),
(23, 1, 1526187, 'bánh trứng', 'banh trung ngon bat ngo', 'banh-trung-ga-nuong-ngon-nhu-kfc-pajn.jpg', '18000.00', '15000.00', '2024-01-07 13:06:00', 'admin', '2024-03-07 14:49:19', 'admin', 0),
(24, 1, 8439556, 'bánh kem ốc quế 2', 'news chính hãng rẻ bất ngờ oow', 'bnews.pnj - Copy.webp', '1800.00', '1800.00', '2024-01-07 13:06:43', 'admin', '2024-03-07 14:49:08', 'admin', 1),
(25, 1, 2059273, 'bánh mì kẹp trả', 'san pham new', 'banh_mi_kep_tra.webp', '30000.00', '20000.00', '2024-03-03 15:42:23', 'admin', '2024-03-07 14:48:59', 'admin', 0),
(26, 1, 5423648, 'bánh sanwich', 'san pham new', 'banh_sanwich.webp', '30000.00', '20000.00', '2024-03-03 15:43:05', 'admin', '2024-03-07 14:50:07', 'admin', 0),
(27, 3, 1820676, 'Bánh Kem', 'san pham new\r\n', 'banh_kem.webp', '300000.00', '100000.00', '2024-03-03 15:43:52', 'admin', '2024-03-10 15:26:57', 'admin', 0),
(28, 3, 9784709, 'bánh sukem phô mai', 'san pham new', 'banhsukem_phomai.webp', '5000.00', '3000.00', '2024-03-03 15:45:14', 'admin', '2024-03-25 18:43:19', 'admin', 0),
(29, 3, 3373893, 'bánh sukem socola ', 'san pham new', 'banhsukem_socola.jpg', '30000.00', '20000.00', '2024-03-03 15:46:10', 'admin', '2024-03-25 18:37:18', 'admin', 0),
(30, 3, 8686884, 'banh kem prince', 'Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam\r\n                        vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Vestibulum ac diam sit amet\r\n                        quam vehicula elementum sed sit amet dui. Proin eget tortor risus', 'banh_kem_price_webp.webp', '200000.00', '200000.00', '2024-03-03 15:46:49', 'admin', '2024-03-25 18:36:57', 'admin', 0),
(31, 1, 1973223, 'san pham 3', 'nânnnanannanannan', 'athena - Copy.jpg', '16000.00', '12000.00', '2024-03-07 14:36:02', 'admin', '2024-03-07 14:40:46', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `size_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`id`, `product_id`, `size_id`, `quantity`, `price`, `status`) VALUES
(20, 20, 1, 0, '12000.00', 1),
(21, 21, 1, 99, '20000.00', 0),
(22, 21, 2, 100, '30000.00', 0),
(23, 22, 1, 50, '19000.00', 0),
(24, 22, 2, 40, '15000.00', 1),
(25, 22, 3, 30, '13000.00', 0),
(26, 23, 1, 89, '15000.00', 0),
(27, 23, 3, 95, '18000.00', 0),
(28, 24, 3, 99, '1800.00', 0),
(29, 25, 1, 49, '20000.00', 1),
(30, 25, 2, 38, '30000.00', 0),
(31, 26, 1, 50, '20000.00', 0),
(32, 26, 2, 50, '30000.00', 0),
(33, 27, 1, 100, '100000.00', 0),
(34, 27, 2, 100, '200000.00', 0),
(35, 27, 3, 100, '300000.00', 0),
(36, 28, 1, 50, '3000.00', 0),
(37, 28, 2, 50, '4000.00', 0),
(38, 28, 3, 50, '5000.00', 0),
(39, 29, 1, 34, '20000.00', 0),
(40, 29, 2, 50, '30000.00', 0),
(41, 30, 1, 44, '200000.00', 0),
(42, 31, 1, 50, '12000.00', 0),
(43, 31, 2, 50, '14000.00', 0),
(44, 31, 3, 50, '16000.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `value` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `create_by` varchar(30) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL,
  `deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id`, `code`, `name`, `description`, `value`, `status`, `start_time`, `end_time`, `create_at`, `create_by`, `update_at`, `update_by`, `deleted`) VALUES
(1, 8392590, 'Giảm giá cho tất cả sản phẩm', 'Khuyến mãi tất cả các sản phẩm nằm trong hệ thống vô thời hạn \r\n', 10, 0, NULL, NULL, '2024-01-05 19:40:26', 'admin', '2024-01-23 14:02:42', 'admin', 0),
(2, 3264847, 'TEST giảm giá sản phẩm', 'Giảm giá cho tất cả san phẩm ', 50, 0, NULL, NULL, '2024-01-14 18:39:23', 'admin', '2024-01-23 14:03:25', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `promotion_detail`
--

CREATE TABLE `promotion_detail` (
  `id` int NOT NULL,
  `product_detail_id` int NOT NULL,
  `promotion_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price_after_reduction` decimal(10,2) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL,
  `create_by` varchar(30) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `promotion_detail`
--

INSERT INTO `promotion_detail` (`id`, `product_detail_id`, `promotion_id`, `quantity`, `price_after_reduction`, `status`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(22, 33, 1, 50, '90000.00', 0, '2024-03-25 19:05:34', 'admin', NULL, NULL),
(23, 34, 1, 100, '180000.00', 0, '2024-03-25 19:05:47', 'admin', NULL, NULL),
(24, 35, 1, 100, '270000.00', 0, '2024-03-25 19:05:59', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `province_city`
--

CREATE TABLE `province_city` (
  `id` int NOT NULL,
  `name` varchar(25) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `province_city`
--

INSERT INTO `province_city` (`id`, `name`, `status`) VALUES
(1, 'Hà Nội', 0),
(2, 'TP.Hồ Chí Minh', 0),
(3, 'Tuyên Quang', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `code` varchar(7) NOT NULL,
  `name_role` varchar(25) DEFAULT NULL,
  `role` tinyint NOT NULL DEFAULT '0',
  `status` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `code`, `name_role`, `role`, `status`) VALUES
(1, '9999999', 'Khách Hàng', 0, 0),
(2, '8888888', 'manage', 2, 0),
(3, '7777777', 'staff', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `create_at` datetime NOT NULL,
  `create_by` varchar(30) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL,
  `deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `code`, `name`, `create_at`, `create_by`, `update_at`, `update_by`, `deleted`) VALUES
(1, 7604697, 'size 1 (17cm)', '2023-12-05 19:03:29', 'admin', '2023-12-29 18:19:23', 'admin', 0),
(2, 3586944, 'size 2(25cm)', '2023-12-05 19:04:11', 'admin', '2023-12-29 18:19:29', 'admin', 0),
(3, 7391290, 'size 3 (30cm)', '2023-12-05 19:05:10', 'admin', '2023-12-29 18:19:33', 'admin', 0),
(6, 1415840, 'size 4', '2023-12-29 17:48:02', 'admin', NULL, NULL, 1),
(7, 2573334, 'size 5', '2023-12-29 17:48:45', 'admin', '2023-12-29 18:19:53', 'admin', 1),
(8, 1693240, 'size 6', '2023-12-29 17:49:15', 'admin', '2023-12-29 18:19:58', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `village`
--

CREATE TABLE `village` (
  `id` int NOT NULL,
  `ward_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `village`
--

INSERT INTO `village` (`id`, `ward_id`, `name`, `status`) VALUES
(4, 5, 'Ngõ 74 Cầu Diễn', 0),
(5, 5, 'Ngõ 69 Cầu Diễn', 0),
(6, 3, 'Soi Long', 0),
(7, 3, 'Xóm 1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int NOT NULL,
  `code` int NOT NULL,
  `discount_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `minimum_amount` decimal(10,2) DEFAULT NULL,
  `value` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `create_by` varchar(30) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` varchar(30) DEFAULT NULL,
  `deleted` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id`, `code`, `discount_code`, `name`, `minimum_amount`, `value`, `quantity`, `start_time`, `end_time`, `create_at`, `create_by`, `update_at`, `update_by`, `deleted`) VALUES
(1, 6847493, 'km15', 'Giảm 15% cho đơn hàng tối thiểu 500.000đ', '500000.00', 15, 10, NULL, NULL, '2024-01-28 15:08:49', 'admin', '2024-03-22 16:21:28', 'admin', 0),
(2, 8913255, 'km20', 'Giảm 10% cho đơn hàng tối thiểu 200.00đ', '200000.00', 10, 4, NULL, NULL, '2024-03-21 18:32:38', 'admin', '2024-03-22 16:20:40', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE `ward` (
  `id` int NOT NULL,
  `district_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`id`, `district_id`, `name`, `status`) VALUES
(3, 4, 'Thái Hòa', 0),
(4, 4, 'Đức Ninh', 0),
(5, 2, 'Cầu Diễn', 0),
(6, 2, 'Phúc Diễn', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `adress_id` (`adress_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `voucher_id` (`voucher_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `products_id` (`products_id`),
  ADD KEY `product_detail_id` (`product_detail_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `village_id` (`village_id`),
  ADD KEY `ward_id` (`ward_id`),
  ADD KEY `district_id` (`district_id`),
  ADD KEY `city_province_id` (`city_province_id`);

--
-- Indexes for table `detail_bill`
--
ALTER TABLE `detail_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `product_detail_id` (`product_detail_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`),
  ADD KEY `province_city_id` (`province_city_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `size_id` (`size_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion_detail`
--
ALTER TABLE `promotion_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product _detail_id` (`product_detail_id`),
  ADD KEY `promotion_id` (`promotion_id`);

--
-- Indexes for table `province_city`
--
ALTER TABLE `province_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ward_id` (`ward_id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ward`
--
ALTER TABLE `ward`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_bill`
--
ALTER TABLE `detail_bill`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `promotion_detail`
--
ALTER TABLE `promotion_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `province_city`
--
ALTER TABLE `province_city`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `village`
--
ALTER TABLE `village`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ward`
--
ALTER TABLE `ward`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`adress_id`) REFERENCES `delivery_address` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `bill_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `bill_ibfk_4` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`product_detail_id`) REFERENCES `product_detail` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD CONSTRAINT `delivery_address_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `delivery_address_ibfk_2` FOREIGN KEY (`village_id`) REFERENCES `village` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `delivery_address_ibfk_3` FOREIGN KEY (`ward_id`) REFERENCES `ward` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `delivery_address_ibfk_4` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `delivery_address_ibfk_5` FOREIGN KEY (`city_province_id`) REFERENCES `province_city` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `detail_bill`
--
ALTER TABLE `detail_bill`
  ADD CONSTRAINT `detail_bill_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `detail_bill_ibfk_2` FOREIGN KEY (`product_detail_id`) REFERENCES `product_detail` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `district_ibfk_1` FOREIGN KEY (`province_city_id`) REFERENCES `province_city` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD CONSTRAINT `product_detail_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_detail_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `promotion_detail`
--
ALTER TABLE `promotion_detail`
  ADD CONSTRAINT `promotion_detail_ibfk_1` FOREIGN KEY (`product_detail_id`) REFERENCES `product_detail` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `promotion_detail_ibfk_2` FOREIGN KEY (`promotion_id`) REFERENCES `promotion` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `village`
--
ALTER TABLE `village`
  ADD CONSTRAINT `village_ibfk_1` FOREIGN KEY (`ward_id`) REFERENCES `ward` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `ward`
--
ALTER TABLE `ward`
  ADD CONSTRAINT `ward_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
