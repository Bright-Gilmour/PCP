-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 07:02 PM
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
-- Database: `market`
--
CREATE DATABASE IF NOT EXISTS `market` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `market`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
-- Creation: May 07, 2025 at 04:43 AM
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `admin`:
--

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `name`, `profile_picture`) VALUES
(1, 'sanddrack@gmail.com', '#Sandokan12', 'Salifu', '681ae8771bcf7_batman-arkham-3840x2160-16093.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
-- Creation: May 07, 2025 at 04:05 AM
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `vendor_id` int(11) DEFAULT NULL,
  `telephone` varchar(15) NOT NULL,
  `location` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vendor` (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `products`:
--   `vendor_id`
--       `vendors` -> `vendor_id`
--

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `vendor_name`, `product_name`, `description`, `price`, `image_path`, `created_at`, `vendor_id`, `telephone`, `location`) VALUES
(12, 'SCH-TEAM ENTERPRICE', 'head sert', 'its rely good', 1555.00, '1746499501_headsss.png', '2025-05-06 02:45:01', 4, '55260396', 'Ashanti'),
(16, 'SCH-TEAM ENTERPRICE', 'shoes', 'A Gucci bag is a luxury accessory known for its iconic design, high-quality materials, and craftsmanship. It combines timeless elegance with modern style, making it a fashionable statement piece.\r\n', 1555.00, '1747464564_shoe.png', '2025-05-17 06:49:24', 4, '233552460396', 'Greater Accra'),
(17, 'SCH-TEAM ENTERPRICE', 'GUCCHI WATCH', 'A watch is a timekeeping accessory that combines functionality with style. It can serve as both a practical tool and a fashion statement, suitable for any occasion.', 1555.00, '1747464776_image6.jpg', '2025-05-17 06:52:56', 4, '233552460396', 'Volta'),
(18, 'SCH-TEAM ENTERPRICE', 'APPLE LAPTOP', 'An Apple laptop is a sleek, high-performance device known for its intuitive interface and powerful features. It blends premium design with advanced technology for both personal and professional use.', 1555.00, '1747464929_image3.jpg', '2025-05-17 06:55:29', 4, '233552460396', 'Western'),
(19, 'K&amp;K  electronic shop', 'headset', ' Premium sound quality, noise cancellation, the headset is a combination of headphones and a microphone, designed for communication, gaming, calls, or multimedia use. They come in wired or wireless (Bluetooth/RF) options, with features like noise cancellation, surround sound, and ergonomic designs for comfort.', 200.00, '1749690870_headset.png', '2025-06-12 01:14:30', 6, '233551394957', 'Ashanti'),
(24, 'K&amp;K  electronic shop', 'IPHONE 15', 'Apple\'s 2023 flagship with: 6.1\" Super Retina XDR OLED (Dynamic Island)\r\nA16 Bionic chip + 48MP main camera USB-C (faster charging/data) & iOS 17\r\nVariants: 15 (6.1\"), 15 Plus (6.7\")  15 Pro (titanium/A17 Pro), Pro Max (5x zoom', 9500.00, '1749692740_i15p.png', '2025-06-12 01:45:40', 6, '233551394957', 'Ashanti'),
(25, 'K&amp;K  electronic shop', 'Apple Watch Series 9 (Latest, 2023)', 'Display: Always-On Retina LTPO OLED Chip: S9 SiP (Faster performance, new gestures like \"Double Tap\") Health Features: ECG, Blood Oxygen, Heart Rate, Sleep Tracking Battery: 18+ hours, Fast Charging Best For: Everyday use, fitness, and premium features.', 5000.00, '1749692900_iwatch.png', '2025-06-12 01:48:20', 6, '233551394957', 'Ashanti'),
(26, 'K&amp;K  electronic shop', 'iPhone 11 ', '6.1\" LCD (No OLED) | A13 Bionic (Still fast) Dual 12MP Cameras (Ultra-wide + Night Mode) All-day battery | IP68 Water Resistance iOS 17 Supported (May not get iOS 18).', 3000.00, '1749693036_iippp11.png', '2025-06-12 01:50:36', 6, '233551394957', 'Ashanti'),
(27, 'K&amp;K  electronic shop', 'Flat 4K TV Samsung 55 inches', 'Immersive viewing (wraps around you)\r\nDeeper contrast (feels more cinematic)\r\nReduces edge distortion (for center viewers)', 6800.00, '1749693214_Untitled-1tvv1.jpg', '2025-06-12 01:53:34', 6, '233551394957', 'Ashanti'),
(28, 'ATLIS  VENTURES', 'IPHONE 15  ', 'Apple\'s 2023 flagship with: 6.1\" Super Retina XDR OLED (Dynamic Island)\r\nA16 Bionic chip + 48MP main camera USB-C (faster charging/data) & iOS 17\r\nVariants: 15 (6.1\"), 15 Plus (6.7\"), 15 Pro (titanium/A17 Pro), Pro Max (5x zoom).', 9500.00, '1749693617_iipp22.png', '2025-06-12 02:00:17', 7, '233593904603', 'Bono'),
(29, 'ATLIS  VENTURES', 'Apple Watch SE (2nd Gen, 2023) (Budget-friendly)', 'Display: Retina OLED (No Always-On) Chip: S8 SiP (Good speed, but older than Series 9) Health Features: Heart Rate, Fall Detection, Sleep Tracking (No ECG/Blood Oxygen) Battery: 18+ hours\r\nBest For: First-time users or those needing core features at a lower cost.', 4200.00, '1749693859_iwatch.png', '2025-06-12 02:04:19', 7, '233593904603', 'Bono'),
(30, 'ATLIS  VENTURES', 'iPhone 11', '6.1\" LCD (No OLED) | A13 Bionic (Still fast)\r\n\r\nDual 12MP Cameras (Ultra-wide + Night Mode)\r\n\r\nAll-day battery | IP68 Water Resistance\r\n\r\niOS 17 Supported (May not get iOS 18)', 3500.00, '1749694001_phone11.png', '2025-06-12 02:06:41', 7, '233593904603', 'Bono'),
(31, 'ATLIS  VENTURES', 'Flat 4K TV (LG) 55 inches', 'Immersive viewing (wraps around you)\r\n\r\nDeeper contrast (feels more cinematic)\r\n\r\nReduces edge distortion (for center viewers)', 7000.00, '1749694167_Untitled-1tvv1.jpg', '2025-06-12 02:09:27', 7, '233593904603', 'Bono'),
(32, 'ATLIS  VENTURES', 'MacBook Air (Ultra-Portable)', 'Lightweight (1.24 kg) & slim\r\n\r\nM1/M2 chip (fast for daily tasks)\r\n\r\nFanless (silent operation)\r\n\r\n13.6\" or 15.3\" Retina display\r\nBest For: Students, office work, travel.\r\n18-hour battery\r\nM2 (2022, 256GB)', 10000.00, '1749694433_1747464929_image3.jpg', '2025-06-12 02:13:53', 7, '233593904603', 'Bono'),
(33, 'POKU GEE VENTURES', 'IPHONE 15', 'Apple\'s 2023 flagship with:\r\n\r\n6.1\" Super Retina XDR OLED (Dynamic Island)\r\n\r\nA16 Bionic chip + 48MP main camera\r\n\r\nUSB-C (faster charging/data) & iOS 17\r\n\r\nVariants: 15 (6.1\"), 15 Plus (6.7\"), 15 Pro (titanium/A17 Pro), Pro Max (5x zoom).', 11000.00, '1749695115_ipphone.png', '2025-06-12 02:25:15', 8, '23353842026', 'Greater Accra'),
(34, 'POKU GEE VENTURES', ' Apple Watch Ultra 2 (Rugged & Premium)', 'Display: Largest Always-On Retina (2000+ nits brightness)\r\n\r\nChip: S9 SiP (Optimized for extreme conditions)\r\n\r\nDurability: Titanium case, Dive-ready (WR100, EN13319)\r\n\r\nBattery: 36+ hours (Up to 72 in Low Power Mode)\r\n\r\nBest For: Athletes, adventurers, and deep divers.', 1150.00, '1749695302_iwatch.png', '2025-06-12 02:28:22', 8, '233538420262', 'Greater Accra'),
(35, 'POKU GEE VENTURES', 'IPHONE 11', '6.1\" LCD (No OLED) | A13 Bionic (Still fast)\r\n\r\nDual 12MP Cameras (Ultra-wide + Night Mode)\r\n\r\nAll-day battery | IP68 Water Resistance\r\n\r\niOS 17 Supported (May not get iOS 18)', 4500.00, '1749695410_phone11.png', '2025-06-12 02:30:10', 8, '233538420262', 'Greater Accra'),
(36, 'POKU GEE VENTURES', 'Curved 4K TV LG 55 inches ', 'Immersive viewing (wraps around you)\r\n\r\nDeeper contrast (feels more cinematic)\r\n\r\nReduces edge distortion (for center viewers)', 12000.00, '1749695640_Untitled-1tvv2.jpg', '2025-06-12 02:34:00', 8, '23353842026', 'Greater Accra'),
(37, 'POKU GEE VENTURES', 'MacBook Pro (Power User Pick)', 'M3 Pro/Max chips (for heavy tasks)\r\n\r\n14\" or 16\" Mini-LED display (120Hz)\r\n\r\nLonger battery life (22 hours)\r\n\r\nMore ports (HDMI, SD card)', 17000.00, '1749695805_1747464929_image3.jpg', '2025-06-12 02:36:45', 8, '233538420262', 'Greater Accra'),
(38, 'JESUS IS KING', 'IPHONE 15', 'Apple\'s 2023 flagship with:\r\n\r\n6.1\" Super Retina XDR OLED (Dynamic Island)\r\n\r\nA16 Bionic chip + 48MP main camera\r\n\r\nUSB-C (faster charging/data) & iOS 17\r\n\r\nVariants: 15 (6.1\"), 15 Plus (6.7\"), 15 Pro (titanium/A17 Pro), Pro Max (5x zoom).', 10200.00, '1749712388_i15p.png', '2025-06-12 07:13:08', 9, '233547121877', 'Upper East'),
(39, 'JESUS IS KING', 'Apple Watch Series 9 (Latest, 2023)', 'Display: Always-On Retina LTPO OLED\r\n\r\nChip: S9 SiP (Faster performance, new gestures like \"Double Tap\")\r\n\r\nHealth Features: ECG, Blood Oxygen, Heart Rate, Sleep Tracking\r\n\r\nBattery: 18+ hours, Fast Charging\r\n\r\nBest For: Everyday use, fitness, and premium features.', 6000.00, '1749712622_iwatch.png', '2025-06-12 07:17:02', 9, '233547121877', 'Upper West'),
(40, 'JESUS IS KING', 'IPHONE 11', 'Display: Always-On Retina LTPO OLED\r\n\r\nChip: S9 SiP (Faster performance, new gestures like \"Double Tap\")\r\n\r\nHealth Features: ECG, Blood Oxygen, Heart Rate, Sleep Tracking\r\n\r\nBattery: 18+ hours, Fast Charging\r\n\r\nBest For: Everyday use, fitness, and premium features.', 4300.00, '1749712795_phone11.png', '2025-06-12 07:19:55', 9, '233547121877', 'Upper West'),
(41, 'JESUS IS KING', 'Curved 4K TV LG 55 inches ', 'Immersive viewing (wraps around you)\r\n\r\nDeeper contrast (feels more cinematic)\r\n\r\nReduces edge distortion (for center viewers)', 11505.00, '1749713056_Untitled-1tvv.jpg', '2025-06-12 07:24:16', 9, '233547121877', 'Upper West'),
(42, 'JESUS IS KING', 'MacBook Pro (Power User Pick)', 'M3 Pro/Max chips (for heavy tasks)\r\n\r\n14\" or 16\" Mini-LED display (120Hz)\r\n\r\nLonger battery life (22 hours)\r\n\r\nMore ports (HDMI, SD card)', 20000.00, '1749713215_1747464929_image3.jpg', '2025-06-12 07:26:55', 9, '233547121877', 'Upper West'),
(43, 'OMOZAY COMPANY LIMITED', 'MacBook Air (Ultra-Portable)', 'Lightweight (1.24 kg) & slim\r\n\r\nM1/M2 chip (fast for daily tasks)\r\n\r\nFanless (silent operation)\r\n\r\n13.6\" or 15.3\" Retina display\r\n\r\n18-hour battery\r\n\r\n✔ Best For: Students, office work, travel.', 7.00, '1749713669_1747464929_image3.jpg', '2025-06-12 07:34:29', 10, '233530544919', 'Oti'),
(44, 'OMOZAY COMPANY LIMITED', 'IPHONE 15', 'Apple\'s 2023 flagship with:\r\n\r\n6.1\" Super Retina XDR OLED (Dynamic Island)\r\n\r\nA16 Bionic chip + 48MP main camera\r\n\r\nUSB-C (faster charging/data) & iOS 17\r\n\r\nVariants: 15 (6.1\"), 15 Plus (6.7\"), 15 Pro (titanium/A17 Pro), Pro Max (5x zoom).', 10500.00, '1749714046_ipphone.png', '2025-06-12 07:40:46', 10, '233530544919', 'Oti'),
(46, 'OMOZAY COMPANY LIMITED', 'IPHONE 11', '6.1\" LCD (No OLED) | A13 Bionic (Still fast)\r\n\r\nDual 12MP Cameras (Ultra-wide + Night Mode)\r\n\r\nAll-day battery | IP68 Water Resistance\r\n\r\niOS 17 Supported (May not get iOS 18)', 3470.00, '1749714718_phone11.png', '2025-06-12 07:51:58', 10, '233530544919', 'Oti'),
(47, 'OMOZAY COMPANY LIMITED', 'Sony headset', 'The headset is a combination of headphones and a microphone, designed for communication, gaming, calls, or multimedia use. They come in wired or wireless (Bluetooth/RF) options, with features like noise cancellation, surround sound, and ergonomic designs for comfort.', 170.00, '1749714905_headsss.png', '2025-06-12 07:55:05', 10, '233530544919', 'Oti'),
(48, 'OMOZAY COMPANY LIMITED', 'Apple Watch SE (2nd Gen, 2023) (Budget-friendly)', 'Display: Largest Always-On Retina (2000+ nits brightness)\r\n\r\nChip: S9 SiP (Optimized for extreme conditions)\r\n\r\nDurability: Titanium case, Dive-ready (WR100, EN13319)\r\n\r\nBattery: 36+ hours (Up to 72 in Low Power Mode)\r\n\r\nBest For: Athletes, adventurers, and deep divers.', 11700.00, '1749715133_iwatch.png', '2025-06-12 07:58:53', 10, '233530544919', 'Oti'),
(49, 'BLACKO VENTURES', 'Asus,', 'Intel Core i5/Ryzen 5\r\n\r\n8GB-16GB RAM\r\n\r\n512GB SSD\r\n\r\nFull HD/IPS display\r\n\r\nBest For: Students, office work, light gaming', 6500.00, '1749782442_Untitled-1lpp1.jpg', '2025-06-13 02:40:42', 11, '233534626338', 'Volta'),
(50, 'BLACKO VENTURES', 'iPhone 11 ', '6.1\" LCD (No OLED) | A13 Bionic (Still fast)\r\n\r\nDual 12MP Cameras (Ultra-wide + Night Mode)\r\n\r\nAll-day battery | IP68 Water Resistance\r\n\r\niOS 17 Supported (May not get iOS 18)', 3600.00, '1749782601_phone11.png', '2025-06-13 02:43:21', 11, '233534626338', 'Volta'),
(51, 'BLACKO VENTURES', ' Curved TV  Samsung 55 inches', 'Immersive viewing (wraps around you)\r\n\r\nDeeper contrast (feels more cinematic)\r\n\r\nReduces edge distortion (for center viewers)', 7200.00, '1749782812_Untitled-1tvv1.jpg', '2025-06-13 02:46:52', 11, '233534626338', 'Volta'),
(52, 'BLACKO VENTURES', 'Apple Watch SE (2nd Gen, 2023) (Budget-friendly)', 'Display: Retina OLED (No Always-On)\r\n\r\nChip: S8 SiP (Good speed, but older than Series 9)\r\n\r\nHealth Features: Heart Rate, Fall Detection, Sleep Tracking (No ECG/Blood Oxygen)\r\n\r\nBattery: 18+ hours\r\n\r\nBest For: First-time users or those needing core features at a lower cost.', 4500.00, '1749782958_iwatch.png', '2025-06-13 02:49:18', 11, '233534626338', 'Volta'),
(53, 'BLACKO VENTURES', 'IPHONE 15', 'Apple\'s 2023 flagship with:\r\n\r\n6.1\" Super Retina XDR OLED (Dynamic Island)\r\n\r\nA16 Bionic chip + 48MP main camera\r\n\r\nUSB-C (faster charging/data) & iOS 17\r\n\r\nVariants: 15 (6.1\"), 15 Plus (6.7\"), 15 Pro (titanium/A17 Pro), Pro Max (5x zoom).', 10500.00, '1749783077_iipp22.png', '2025-06-13 02:51:17', 11, '233534626338', 'Volta'),
(54, 'EZURAH VENTURES', 'Alienware', ' Specs:\r\n\r\nIntel Core i7/i9 or Ryzen 7/9\r\n\r\n16GB-32GB RAM\r\n\r\n1TB SSD + HDD\r\n\r\nNVIDIA RTX 3050-4090 GPU\r\n\r\n144Hz+ display\r\n\r\n✔ Best For: AAA gaming, 3D rendering, video editing', 23000.00, '1749786323_laptop.png', '2025-06-13 03:45:23', 12, '233246935535', 'Western'),
(55, 'EZURAH VENTURES', 'IPHONE 15', 'Apple\'s 2023 flagship with:\r\n\r\n6.1\" Super Retina XDR OLED (Dynamic Island)\r\n\r\nA16 Bionic chip + 48MP main camera\r\n\r\nUSB-C (faster charging/data) & iOS 17\r\n\r\nVariants: 15 (6.1\"), 15 Plus (6.7\"), 15 Pro (titanium/A17 Pro), Pro Max (5x zoom)', 14500.00, '1749786484_i15p.png', '2025-06-13 03:48:04', 12, '233246935535', 'Western'),
(56, 'EZURAH VENTURES', 'Apple Watch Ultra 2 (Rugged, premium)', 'Display: Largest Always-On Retina (2000+ nits brightness)\r\n\r\nChip: S9 SiP (Optimized for extreme conditions)\r\n\r\nDurability: Titanium case, Dive-ready (WR100, EN13319)\r\n\r\nBattery: 36+ hours (Up to 72 in Low Power Mode)\r\n\r\nBest For: Athletes, adventurers, and deep divers.', 11500.00, '1749786656_iwatch.png', '2025-06-13 03:50:56', 12, '233246935535', 'Western'),
(57, 'EZURAH VENTURES', 'HyperX (HP) hedset', 'the headset is a combination of headphones and a microphone, designed for communication, gaming, calls, or multimedia use. They come in wired or wireless (Bluetooth/RF) options, with features like noise cancellation, surround sound, and ergonomic designs for comfort', 700.00, '1749786826_headsss.png', '2025-06-13 03:53:46', 12, '233246935535', 'Western'),
(58, 'EZURAH VENTURES', 'Flat-Screen TV LG 55 inches', 'No glare (better for bright rooms)\r\n\r\nWall-mounts flush (sleek look)\r\n\r\nCheaper than curved TVs\r\n\r\nWider viewing angles (good for groups)\r\n\r\nBest For: Living rooms, bedrooms, and general use.', 10200.00, '1749786990_Untitled-1tvvv.jpg', '2025-06-13 03:56:30', 12, '233246935535', 'Western'),
(59, 'JHOEEBEE IPONE SHOP', 'IPHONE 15 (256 gb)', '6.1\" Super Retina XDR OLED (Dynamic Island)\r\n\r\nA16 Bionic chip + 48MP main camera\r\n\r\nUSB-C (faster charging/data) & iOS 17\r\n\r\nVariants: 15 (6.1\"), 15 Plus (6.7\"), 15 Pro (titanium/A17 Pro), Pro Max (5x zoom).', 14700.00, '1749787455_iipp22.png', '2025-06-13 04:04:15', 13, '233594058024', 'Central'),
(60, 'JHOEEBEE IPONE SHOP', 'IPHONE 11 (256 GB)', '6.1\" LCD (No OLED) | A13 Bionic (Still fast)\r\n\r\nDual 12MP Cameras (Ultra-wide + Night Mode)\r\n\r\nAll-day battery | IP68 Water Resistance\r\n\r\niOS 17 Supported (May not get iOS 18)', 4500.00, '1749787682_Untitled-1pp2.jpg', '2025-06-13 04:08:02', 13, '233594058024', 'Central'),
(61, 'JHOEEBEE IPONE SHOP', 'Apple Watch Series 9 (Latest & Most Advanced)', 'Display: Always-On Retina LTPO OLED\r\n\r\nChip: S9 SiP (Faster performance, new gestures like \"Double Tap\")\r\n\r\nHealth Features: ECG, Blood Oxygen, Heart Rate, Sleep Tracking\r\n\r\nBattery: 18+ hours, Fast Charging\r\n\r\nBest For: Everyday use, fitness, and premium features.', 8000.00, '1749787793_iwatch.png', '2025-06-13 04:09:53', 13, '233594058024', 'Central'),
(62, 'JHOEEBEE IPONE SHOP', ' MacBook Air (Ultra-Portable)', 'Lightweight (1.24 kg) & slim\r\n\r\nM1/M2 chip (fast for daily tasks)\r\n\r\nFanless (silent operation)\r\n\r\n13.6\" or 15.3\" Retina display\r\n\r\n18-hour battery', 12300.00, '1749787919_1749695805_1747464929_image3.jpg', '2025-06-13 04:11:59', 13, '233594058024', 'Central'),
(63, 'JHOEEBEE IPONE SHOP', 'ASUS ROG', 'Intel Core i7/i9 or Ryzen 7/9\r\n\r\n16GB-32GB RAM\r\n\r\n1TB SSD + HDD\r\n\r\nNVIDIA RTX 3050-4090 GPU\r\n\r\n144Hz+ display\r\n\r\n✔ Best For: AAA gaming, 3D rendering, video editing', 25000.00, '1749788075_Untitled-1lpp1.jpg', '2025-06-13 04:14:35', 13, '233594058024', 'Central'),
(64, 'SCH-TEAM ENTERPRICE', 'ASUS 2-in-1 Laptop/Tablet', ' A sleek and portable device that combines the power of a laptop with the flexibility of a tablet. Perfect for students and professionals on the go. Runs Windows 10 and features a detachable keyboard.', 4200.00, '1749950003_lapp1.png', '2025-06-15 01:13:23', 4, '233552460396', 'Ashanti'),
(65, 'SCH-TEAM ENTERPRICE', 'OnePlus Smartphone (OnePlus 6T)', 'A high-performance smartphone with a stunning AMOLED display and powerful specs. Comes with the \"Never Settle\" motto, great for multitasking and photography.', 3000.00, '1749950087_phone.png', '2025-06-15 01:14:47', 4, '233552460396', 'Ashanti'),
(66, 'SCH-TEAM ENTERPRICE', ' Xiaomi Mi Notebook Laptop', ' A lightweight and durable laptop with a stylish aluminum body. Ideal for productivity, school, or business. Offers fast performance at an affordable price', 7500.00, '1749950205_laptop.png', '2025-06-15 01:16:45', 4, '233552460396', 'Ashanti'),
(67, 'SCH-TEAM ENTERPRICE', 'Samsung Galaxy S24 Ultra (256GB)', ' 6.8\" Flat AMOLED (120Hz, 2600 nits)\r\n Snapdragon 8 Gen 3 + 12GB RAM\r\n200MP+50MP+12MP+10MP Cameras (10x zoom)\r\n5,000mAh battery, 45W charging\r\n Titanium frame + IP68\r\n 7 years of updates', 13500.00, '1749950511_samsung s24 ultra.jpg', '2025-06-15 01:21:51', 4, '233552460396', 'Ashanti'),
(68, 'SCH-TEAM ENTERPRICE', 'Samsung Galaxy S21 (128)', ' 6.2\" Dynamic AMOLED (120Hz, HDR10+)\r\n Exynos 2100/Snapdragon 888 + 8GB RAM\r\n Triple Cameras: 12MP (main) + 12MP (ultra-wide) + 64MP (zoom)\r\n 4,000mAh battery, 25W fast charging\r\n Gorilla Glass Victus + IP68\r\n Android 13 (Upgradable to Android 14)', 6000.00, '1749950782_galaxy s21.jpg', '2025-06-15 01:26:22', 4, '233552460396', 'Ashanti'),
(69, 'SCH-TEAM ENTERPRICE', 'Infinix Note 40s', '6.78\" AMOLED (120Hz, 1300 nits)\r\nHelio G99 Ultimate + 8GB+8GB RAM\r\n108MP Triple Cam + 32MP Selfie\r\n5,000mAh + 70W Charging (10W Wireless!)\r\nJBL Stereo Speakers + Android 14', 2800.00, '1749951012_68bc410bb8bb925c289f8323686926a6.jpg', '2025-06-15 01:30:12', 4, '233552460396', 'Ashanti'),
(70, 'coachito company limited', 'ASUS 2-in-1 Laptop/Tablet', 'A sleek and portable device that combines the power of a laptop with the flexibility of a tablet. Perfect for students and professionals on the go. Runs Windows 10 and features a detachable keyboard.', 4300.00, '1749951301_lapp1.png', '2025-06-15 01:35:01', 5, '233543524176', 'Bono East'),
(71, 'coachito company limited', 'IPHONE 15  (256GB) ', 'Apple\'s 2023 flagship with:\r\n\r\n6.1\" Super Retina XDR OLED (Dynamic Island)\r\n\r\nA16 Bionic chip + 48MP main camera\r\n\r\nUSB-C (faster charging/data) & iOS 17\r\n\r\nVariants: 15 (6.1\"), 15 Plus (6.7\"), 15 Pro (titanium/A17 Pro), Pro Max (5x zoom).', 16200.00, '1749951424_iippp11.png', '2025-06-15 01:37:04', 5, '233543524176', 'Bono East'),
(72, 'coachito company limited', 'Apple Watch Series 9 (Latest, 2023)', 'Display: Always-On Retina LTPO OLED\r\n\r\nChip: S9 SiP (Faster performance, new gestures like \"Double Tap\")\r\n\r\nHealth Features: ECG, Blood Oxygen, Heart Rate, Sleep Tracking\r\n\r\nBattery: 18+ hours, Fast Charging\r\n\r\nBest For: Everyday use, fitness, and premium features.', 7500.00, '1749951552_iwatch.png', '2025-06-15 01:39:12', 5, '233543524176', 'Bono East'),
(73, 'coachito company limited', 'IPHONE 11', '6.1\" LCD (No OLED) | A13 Bionic (Still fast)\r\n\r\nDual 12MP Cameras (Ultra-wide + Night Mode)\r\n\r\nAll-day battery | IP68 Water Resistance\r\n\r\niOS 17 Supported (May not get iOS 18)', 3900.00, '1749951645_phone11.png', '2025-06-15 01:40:45', 5, '233543524176', 'Bono East'),
(74, 'coachito company limited', 'Flat 4K TV ( Samsung 55 inches)', 'No glare (better for bright rooms)\r\n\r\nWall-mounts flush (sleek look)\r\n\r\nCheaper than curved TVs\r\n\r\nWider viewing angles (good for groups)', 7452.00, '1749951827_Untitled-1tvv.jpg', '2025-06-15 01:43:47', 5, '233543524176', 'Bono East'),
(75, 'coachito company limited', ' HP ', ' Specs:  Intel Core i3/Ryzen 3  4GB-8GB RAM  256GB-512GB SSD  HD/Full HD display   Best For: Basic tasks (web, documents, Zoom)', 3762.00, '1749951983_Untitled-1tv3.jpg', '2025-06-15 01:46:23', 5, '233543524176', 'Bono East'),
(76, 'coachito company limited', 'OnePlus Smartphone (OnePlus 6T)', ' A high-performance smartphone with a stunning AMOLED display and powerful specs. Comes with the \"Never Settle\" motto, great for multitasking and photography.', 2990.00, '1749952094_phone.png', '2025-06-15 01:48:14', 5, '233543524176', 'Bono East'),
(77, 'coachito company limited', 'Xiaomi Mi Notebook Laptop', 'A lightweight and durable laptop with a stylish aluminum body. Ideal for productivity, school, or business. Offers fast performance at an affordable price.', 17659.00, '1749952203_laptop.png', '2025-06-15 01:50:03', 5, '233543524176', 'Bono East'),
(78, 'coachito company limited', 'Samsung Galaxy S24 Ultra (256GB)', ' Key Features:\r\n✔ 6.8\" Flat AMOLED (120Hz, 2600 nits)\r\n✔ Snapdragon 8 Gen 3 + 12GB RAM\r\n✔ 200MP+50MP+12MP+10MP Cameras (10x zoom)\r\n✔ 5,000mAh battery, 45W charging\r\n✔ Titanium frame + IP68\r\n✔ 7 years of updates', 16678.00, '1749952435_samsung s24 ultra.jpg', '2025-06-15 01:53:55', 5, '233543524176', 'Bono East'),
(79, 'coachito company limited', 'Samsung Galaxy S21 (128)', '6.2\" Dynamic AMOLED (120Hz, HDR10+)\r\n✔ Exynos 2100/Snapdragon 888 + 8GB RAM\r\n✔ Triple Cameras: 12MP (main) + 12MP (ultra-wide) + 64MP (zoom)\r\n✔ 4,000mAh battery, 25W fast charging\r\n✔ Gorilla Glass Victus + IP68\r\n✔ Android 13 (Upgradable to Android 14)', 6250.00, '1749952582_galaxy s21.jpg', '2025-06-15 01:56:22', 5, '233543524176', 'Bono East'),
(80, 'coachito company limited', ' Mercedes-Benz CLS63 AMG (Luxury Performance Sedan)', 'The CLS63 AMG is a powerful luxury sedan with a V8 Biturbo engine, delivering thrilling performance and a premium interior. It’s known for its sleek coupe-like design, aggressive stance, and top-tier technology and comfort features. Ideal for executives or car enthusiasts who want both luxury and speed.', 650000.00, '1750294269_cars11.png', '2025-06-19 00:51:09', 5, '233543524176', 'Bono East'),
(81, 'coachito company limited', ' Toyota Corolla 2011–2013 Model (Compact Sedan)', '\r\nA highly reliable and fuel-efficient compact car. The 2011–2013 Corolla is simple and affordable, great for first-time drivers, students, or daily commuting. Low maintenance cost and widely available spare parts make it a popular choice in Ghana.', 95000.00, '1750294444_Untitled-12.jpg', '2025-06-19 00:54:04', 5, '233543524176', 'Bono East'),
(82, 'coachito company limited', ' Toyota Hilux (Red)', 'A popular double-cab pickup known for its rugged durability and off-road capabilities.\r\nIdeal for both work and leisure, with ample space and comfort.', 170000.00, '1750294805_Untitled-13.jpg', '2025-06-19 01:00:05', 5, '233543524176', 'Bono East'),
(83, 'coachito company limited', ' Toyota Hiace', '\r\nA spacious van designed for passenger transportation and cargo.\r\nKnown for its reliability and good handling; popular for commercial use.', 180000.00, '1750295006_Untitled-16.jpg', '2025-06-19 01:03:26', 5, '233543524176', 'Bono East'),
(84, 'SCH-TEAM ENTERPRICE', ' Mercedes-Benz CLS63 AMG ', 'The CLS63 AMG is a powerful luxury sedan with a V8 Biturbo engine, delivering thrilling performance and a premium interior. It’s known for its sleek coupe-like design, aggressive stance, and top-tier technology and comfort features. Ideal for executives or car enthusiasts who want both luxury and speed.', 900000.00, '1750295293_cars11.png', '2025-06-19 01:08:13', 4, '233552460396', 'Ashanti'),
(85, 'SCH-TEAM ENTERPRICE', 'Toyota Corolla 2011–2013 Model (Compact Sedan)', 'A highly reliable and fuel-efficient compact car. The 2011–2013 Corolla is simple and affordable, great for first-time drivers, students, or daily commuting. Low maintenance cost and widely available spare parts make it a popular choice in Ghana.', 75000.00, '1750295403_toyota1.jpg', '2025-06-19 01:10:03', 4, '233552460396', 'Ashanti'),
(86, 'SCH-TEAM ENTERPRICE', 'Toyota Hilux (White)', 'Similar to the red variant, offering versatility and reliability.\r\nFeatures a spacious interior and advanced safety features.', 175000.00, '1750295557_Untitled-14.jpg', '2025-06-19 01:12:37', 4, '233552460396', 'Ashanti'),
(88, 'SCH-TEAM ENTERPRICE', 'Toyota Hiace', 'A spacious van designed for passenger transportation and cargo.\r\nKnown for its reliability and good handling; popular for commercial use.\r\n', 180000.00, '1750295823_Untitled-16.jpg', '2025-06-19 01:17:03', 4, '233552460396', 'Ashanti'),
(89, 'OMOZAY COMPANY LIMITED', 'Toyota Hiace', 'A spacious van designed for passenger transportation and cargo.\r\nKnown for its reliability and good handling; popular for commercial use.\r\n', 155000.00, '1750296132_Untitled-16.jpg', '2025-06-19 01:22:13', 10, '233530544919', 'Oti'),
(90, 'OMOZAY COMPANY LIMITED', 'Toyota Corolla (Red)', 'A compact sedan that is known for its fuel efficiency and comfortable ride.\r\nOffers modern technology and safety features, making it suitable for daily commuting.', 120000.00, '1750296236_Untitled-15.jpg', '2025-06-19 01:23:56', 10, '233530544919', 'Oti'),
(91, 'OMOZAY COMPANY LIMITED', 'Mercedes-Benz CLS63 AMG (Luxury Performance Sedan)', 'The CLS63 AMG is a powerful luxury sedan with a V8 Biturbo engine, delivering thrilling performance and a premium interior. It’s known for its sleek coupe-like design, aggressive stance, and top-tier technology and comfort features. Ideal for executives or car enthusiasts who want both luxury and speed.', 850000.00, '1750296321_cars11.png', '2025-06-19 01:25:21', 10, '233530544919', 'Oti'),
(92, 'OMOZAY COMPANY LIMITED', ' Toyota Corolla 2011–2013 Model (Compact Sedan)', 'A highly reliable and fuel-efficient compact car. The 2011–2013 Corolla is simple and affordable, great for first-time drivers, students, or daily commuting. Low maintenance cost and widely available spare parts make it a popular choice in Ghana.', 89.00, '1750296410_toyota1.jpg', '2025-06-19 01:26:50', 10, '233530544919', 'Oti'),
(94, 'OMOZAY COMPANY LIMITED', 'Toyota Hilux ', 'A popular double-cab pickup known for its rugged durability and off-road capabilities.\r\nIdeal for both work and leisure, with ample space and comfort.\r\n\r\n', 195000.00, '1750296715_Untitled-13.jpg', '2025-06-19 01:31:55', 10, '233530544919', 'Oti');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: May 04, 2025 at 07:15 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `created_at`, `profile_image`) VALUES
(2, 'sadique', 'salifu', 'rita1@gmail.com', '12345', '2025-04-26 21:00:43', '684ba664724be_sports-car-futuristic-mountain-sunset-scenery-digital-art-4k-wallpaper-uhdpaper.com-537@0@i.jpg'),
(3, 'Moses', 'seidu', 'salifu2@gmail.com', ' salifu', '2025-05-04 12:29:25', '681971a0c8888_blades-of-chaos-3840x2160-10645.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--
-- Creation: May 06, 2025 at 03:00 AM
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`vendor_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `vendors`:
--

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `email`, `profile_picture`, `password`, `created_at`) VALUES
(4, 'SCH-TEAM ENTERPRICE', 'salifu1@gmail.com', '68197e08a17f1_done.jpg', '1234567', '2025-05-06 02:27:09'),
(5, 'coachito company limited', 'coachito1@gmail.com', '681c16a6db59b_the-witcher-3-wild-3840x2160-14090.jpg', '1111111', '2025-05-08 02:27:13'),
(6, 'K&amp;K  electronic shop', 'ksampson12@gmail.com', '684a27b6a7a36_pic10.png', 'ksampson12', '2025-06-12 00:47:37'),
(7, 'ATLIS  VENTURES', 'atlisventures11@gmail.com', '684a33a7baab8_pic8.png', 'atlisventures11', '2025-06-12 00:49:36'),
(8, 'POKU GEE VENTURES', 'pkugeeventures2@gmail.com', '684a39c2827ec_pic6.jfif', 'pkugeeventures2', '2025-06-12 00:51:05'),
(9, 'JESUS IS KING', 'franksarfo222@gmail.com', '684a7c8a3d491_pic3.jfif', 'franksarfo222', '2025-06-12 00:52:38'),
(10, 'OMOZAY COMPANY LIMITED', 'omozaycompanylimited1@gmail.com', '684a81c661f31_pic2.jfif', 'companylimited1@', '2025-06-12 00:54:20'),
(11, 'BLACKO VENTURES', 'blackomangee123@gmail.com', '684b8e9955433_pic7.png', 'blackomangee123@', '2025-06-12 00:55:56'),
(12, 'EZURAH VENTURES', 'ezurahventuresman@gmail.com', '684b9db0be94c_pic9.jfif', 'ezurahventuresman@', '2025-06-12 00:57:22'),
(13, 'JHOEEBEE APPLE SHOP', 'jhoeebeemandem99@gmail.com', '684ba20ea658f_pic11.jfif', 'jhoeebeemandem99', '2025-06-12 00:59:40');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
