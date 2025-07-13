-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2025 at 03:47 PM
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
-- Database: `vaccination_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin User', 'admin@example.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `child_id` int(11) DEFAULT NULL,
  `vaccine_id` int(11) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `child_id`, `vaccine_id`, `hospital_id`, `booking_date`, `status`) VALUES
(41, 20, 73, 4, '2025-08-02', 'Completed'),
(42, 20, 73, 4, '2025-08-02', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `name`, `age`, `contact`, `parent_id`) VALUES
(20, 'salman', 18, '1212121212', 5);

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `location`, `email`, `password`) VALUES
(4, 'aga khan', 'karachi', 'hospital@gmail.com', '12345'),
(5, 'liaquate', 'idk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `name`, `email`, `password`) VALUES
(1, 'Test Parent', 'parent@example.com', 'parent123'),
(2, 'Muzammil', 'mirmuzammil7861@gmail.com', '123456'),
(5, 'Muzammil', 'lolfarig@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `available` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`id`, `name`, `description`, `available`, `created_at`, `image`) VALUES
(69, 'COVID-19 Vaccine', 'Protects against coronavirus. Widely available and recommended for all age groups.', 1, '2025-07-13 13:29:41', 'uploads/vaccine_images/6873b4c5b4436_card-1.jpg'),
(71, 'Hepatitis B', '\\r\\nPrevents Hepatitis B, a serious liver infection. Often given at birth or in early childhood.', 1, '2025-07-13 13:31:06', 'uploads/vaccine_images/6873b51ac6efc_card-2.jpg'),
(72, 'Polio Vaccine', 'Vital for eradicating poliovirus. Administered in drops or injections for children.', 1, '2025-07-13 13:31:22', 'uploads/vaccine_images/6873b52a990ff_card3.jpg'),
(73, 'Influenza (Flu)', '\\r\\nRecommended annually to protect against seasonal flu viruses and reduce severity', 1, '2025-07-13 13:31:38', 'uploads/vaccine_images/6873b53ae4792_card4.jpg'),
(74, 'MMR Vaccine', '\\r\\nProtects against measles, mumps, and rubella — essential for childhood immunization.', 1, '2025-07-13 13:31:55', 'uploads/vaccine_images/6873b54b59431_card5.jpg'),
(75, 'DTP Vaccine', '\\r\\nGuards against diphtheria, tetanus, and pertussis — part of early immunization schedule.', 1, '2025-07-13 13:32:27', 'uploads/vaccine_images/6873b56bcd36a_card67.jpg'),
(76, 'HPV Vaccine', '\\r\\nProtects against the human papillomavirus, reducing risk of cervical and throat cancers.', 1, '2025-07-13 13:32:45', 'uploads/vaccine_images/6873b57da917e_card7.jpg'),
(77, 'Typhoid Vaccine', '\\r\\nPrevents typhoid fever, especially important when traveling or in high-risk areas.', 1, '2025-07-13 13:33:02', 'uploads/vaccine_images/6873b58eea0b3_card8.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_id` (`child_id`),
  ADD KEY `vaccine_id` (`vaccine_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
