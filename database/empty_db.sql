-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2024 at 07:19 AM
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
-- Database: `rentrover_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tb`
--

CREATE TABLE `admin_tb` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(12) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `province` varchar(20) NOT NULL,
  `district` varchar(20) NOT NULL,
  `municipality_rural` varchar(40) NOT NULL,
  `ward` int(11) NOT NULL,
  `tole_village` varchar(30) NOT NULL,
  `profile_photo` varchar(250) NOT NULL,
  `kyc_front` varchar(250) NOT NULL,
  `kyc_back` varchar(250) NOT NULL,
  `registration_date` datetime NOT NULL,
  `flag` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `amenity_tb`
--

CREATE TABLE `amenity_tb` (
  `amenity_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL DEFAULT 0,
  `room_id` int(11) NOT NULL DEFAULT 0,
  `amenity` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_tb`
--

CREATE TABLE `application_tb` (
  `application_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `renting_type` varchar(10) NOT NULL,
  `move_in_date` date NOT NULL,
  `move_out_date` date NOT NULL,
  `note` varchar(255) NOT NULL,
  `flag` varchar(20) NOT NULL,
  `application_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_tb`
--

CREATE TABLE `feedback_tb` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `feedback_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `house_photo_tb`
--

CREATE TABLE `house_photo_tb` (
  `house_photo_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `house_tb`
--

CREATE TABLE `house_tb` (
  `house_id` int(11) NOT NULL,
  `landlord_id` int(11) NOT NULL,
  `district` varchar(20) NOT NULL,
  `municipality_rural` varchar(40) NOT NULL,
  `tole_village` varchar(30) NOT NULL,
  `ward` int(11) NOT NULL,
  `nearest_landmark` varchar(50) NOT NULL,
  `longitude` int(11) NOT NULL DEFAULT 0,
  `latitude` int(11) NOT NULL DEFAULT 0,
  `info` varchar(255) NOT NULL,
  `flag` varchar(10) NOT NULL DEFAULT 'pending',
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_tb`
--

CREATE TABLE `issue_tb` (
  `issue_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `issue` varchar(255) NOT NULL,
  `issued_date` datetime NOT NULL,
  `solved_date` datetime NOT NULL,
  `flag` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_application_tb`
--

CREATE TABLE `leave_application_tb` (
  `leave_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `move_out_date` date NOT NULL,
  `submitted_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notice_tb`
--

CREATE TABLE `notice_tb` (
  `notice_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `notice_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_tb`
--

CREATE TABLE `notification_tb` (
  `notification_id` int(11) NOT NULL,
  `whose` varchar(7) NOT NULL,
  `type` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(7) NOT NULL DEFAULT 'unseen',
  `user_id` int(11) NOT NULL DEFAULT 0,
  `tenant_id` int(11) NOT NULL DEFAULT 0,
  `room_id` int(11) NOT NULL DEFAULT 0,
  `house_id` int(11) NOT NULL DEFAULT 0,
  `application_id` int(11) NOT NULL DEFAULT 0,
  `leave_application_id` int(11) NOT NULL DEFAULT 0,
  `issue_id` int(11) NOT NULL DEFAULT 0,
  `notice_id` int(11) NOT NULL DEFAULT 0,
  `feedback_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_tb`
--

CREATE TABLE `review_tb` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `review_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_photo_tb`
--

CREATE TABLE `room_photo_tb` (
  `room_photo_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_tb`
--

CREATE TABLE `room_tb` (
  `room_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `type` varchar(7) NOT NULL,
  `bhk` int(11) NOT NULL DEFAULT 0,
  `number_of_room` int(11) NOT NULL DEFAULT 0,
  `number` int(11) NOT NULL,
  `furnishing` varchar(16) NOT NULL,
  `floor` int(11) NOT NULL,
  `rent` float NOT NULL,
  `info` varchar(255) NOT NULL,
  `flag` varchar(10) NOT NULL,
  `tenant_id` int(11) NOT NULL DEFAULT 0,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenancy_tb`
--

CREATE TABLE `tenancy_tb` (
  `tenancy_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `move_in_date` datetime NOT NULL,
  `move_out_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(12) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `province` varchar(20) NOT NULL,
  `district` varchar(20) NOT NULL,
  `municipality_rural` varchar(40) NOT NULL,
  `ward` int(11) NOT NULL,
  `tole_village` varchar(30) NOT NULL,
  `role` varchar(9) NOT NULL,
  `profile_photo` varchar(250) NOT NULL,
  `kyc_front` varchar(250) NOT NULL,
  `kyc_back` varchar(250) NOT NULL,
  `registration_date` datetime NOT NULL,
  `flag` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_tb`
--

CREATE TABLE `wishlist_tb` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tb`
--
ALTER TABLE `admin_tb`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `amenity_tb`
--
ALTER TABLE `amenity_tb`
  ADD PRIMARY KEY (`amenity_id`);

--
-- Indexes for table `application_tb`
--
ALTER TABLE `application_tb`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `feedback_tb`
--
ALTER TABLE `feedback_tb`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `house_photo_tb`
--
ALTER TABLE `house_photo_tb`
  ADD PRIMARY KEY (`house_photo_id`);

--
-- Indexes for table `house_tb`
--
ALTER TABLE `house_tb`
  ADD PRIMARY KEY (`house_id`);

--
-- Indexes for table `issue_tb`
--
ALTER TABLE `issue_tb`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `leave_application_tb`
--
ALTER TABLE `leave_application_tb`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `notice_tb`
--
ALTER TABLE `notice_tb`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `notification_tb`
--
ALTER TABLE `notification_tb`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `review_tb`
--
ALTER TABLE `review_tb`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `room_photo_tb`
--
ALTER TABLE `room_photo_tb`
  ADD PRIMARY KEY (`room_photo_id`);

--
-- Indexes for table `room_tb`
--
ALTER TABLE `room_tb`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `tenancy_tb`
--
ALTER TABLE `tenancy_tb`
  ADD PRIMARY KEY (`tenancy_id`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist_tb`
--
ALTER TABLE `wishlist_tb`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tb`
--
ALTER TABLE `admin_tb`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `amenity_tb`
--
ALTER TABLE `amenity_tb`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `application_tb`
--
ALTER TABLE `application_tb`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_tb`
--
ALTER TABLE `feedback_tb`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `house_photo_tb`
--
ALTER TABLE `house_photo_tb`
  MODIFY `house_photo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `house_tb`
--
ALTER TABLE `house_tb`
  MODIFY `house_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_tb`
--
ALTER TABLE `issue_tb`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_application_tb`
--
ALTER TABLE `leave_application_tb`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice_tb`
--
ALTER TABLE `notice_tb`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_tb`
--
ALTER TABLE `notification_tb`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_tb`
--
ALTER TABLE `review_tb`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_photo_tb`
--
ALTER TABLE `room_photo_tb`
  MODIFY `room_photo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_tb`
--
ALTER TABLE `room_tb`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenancy_tb`
--
ALTER TABLE `tenancy_tb`
  MODIFY `tenancy_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist_tb`
--
ALTER TABLE `wishlist_tb`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
