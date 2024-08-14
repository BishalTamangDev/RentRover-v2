-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2024 at 10:26 AM
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

--
-- Dumping data for table `admin_tb`
--

INSERT INTO `admin_tb` (`admin_id`, `first_name`, `last_name`, `gender`, `dob`, `email`, `password`, `phone_number`, `province`, `district`, `municipality_rural`, `ward`, `tole_village`, `profile_photo`, `kyc_front`, `kyc_back`, `registration_date`, `flag`) VALUES
(1, 'bishal', 'tamang', 'male', '2000-06-06', 'bishal@gmail.com', '$2y$10$cIt1GgG5OJwPG33mn.67kedF5KxHly7JOfVN5sYkqVGeM0HrmQpeq', '9823645014', 'bagmati', 'Sindhupalchok', 'Melamchi', 3, 'Bobrang', '66b7a67b401403.32949162.jpg', '', '', '2024-08-10 23:25:48', 'verified');

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

--
-- Dumping data for table `amenity_tb`
--

INSERT INTO `amenity_tb` (`amenity_id`, `house_id`, `room_id`, `amenity`) VALUES
(10, 2, 0, 'Air Conditioning'),
(11, 2, 0, 'Balcony'),
(12, 2, 0, 'Fireplace'),
(13, 2, 0, 'Gardening'),
(14, 2, 0, 'Internet'),
(15, 1, 0, 'Air Conditioning'),
(16, 1, 0, 'Balcony'),
(17, 1, 0, 'Fireplace'),
(18, 1, 0, 'Gardening'),
(19, 1, 0, 'Internet'),
(20, 1, 0, 'Laundry'),
(21, 1, 0, 'Pets Allowed'),
(22, 1, 0, 'Prompt Repair Service'),
(23, 1, 0, 'Security'),
(24, 3, 0, 'Air Conditioning'),
(25, 3, 0, 'Balcony'),
(26, 3, 0, 'Fireplace'),
(27, 3, 0, 'Gardening'),
(28, 3, 0, 'Solar Heating'),
(29, 3, 0, 'Swimming Pool'),
(30, 4, 0, 'Air Conditioning'),
(31, 4, 0, 'Balcony'),
(32, 4, 0, 'Fireplace'),
(33, 4, 0, 'Gardening'),
(34, 4, 0, 'Internet'),
(35, 4, 0, 'Laundry'),
(36, 4, 0, 'Parking'),
(37, 4, 0, 'Pets Allowed'),
(38, 4, 0, 'Prompt Repair Service'),
(39, 4, 0, 'Security'),
(40, 4, 0, 'Solar Heating'),
(41, 4, 0, 'Swimming Pool'),
(42, 4, 1, 'Air Conditioning'),
(43, 4, 1, 'Balcony'),
(44, 4, 1, 'Fireplace'),
(45, 4, 1, 'Gardening'),
(46, 4, 1, 'Internet'),
(47, 4, 1, 'Laundry'),
(48, 4, 1, 'Parking'),
(49, 4, 1, 'Pets Allowed'),
(50, 4, 1, 'Prompt Repair Service'),
(51, 4, 1, 'Security'),
(52, 4, 1, 'Solar Heating'),
(53, 4, 1, 'Swimming Pool'),
(54, 1, 2, 'Air Conditioning'),
(55, 1, 2, 'Balcony'),
(56, 1, 2, 'Fireplace'),
(57, 1, 2, 'Pets Allowed'),
(58, 1, 3, 'Air Conditioning'),
(59, 1, 3, 'Balcony'),
(60, 1, 3, 'Fireplace'),
(61, 2, 4, 'Air Conditioning'),
(62, 2, 4, 'Balcony'),
(63, 2, 4, 'Fireplace'),
(64, 2, 4, 'Gardening'),
(65, 2, 4, 'Internet');

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

--
-- Dumping data for table `application_tb`
--

INSERT INTO `application_tb` (`application_id`, `applicant_id`, `room_id`, `renting_type`, `move_in_date`, `move_out_date`, `note`, `flag`, `application_date`) VALUES
(5, 7, 2, 'not-fixed', '2024-08-15', '0000-00-00', 'This is the first room application form melina', 'accepted-expired', '2024-08-14 13:57:05');

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

--
-- Dumping data for table `feedback_tb`
--

INSERT INTO `feedback_tb` (`feedback_id`, `user_id`, `feedback`, `rating`, `feedback_date`) VALUES
(1, 2, 'first feedback', 1, '2024-08-12 08:46:03'),
(2, 2, 'second feedback', 2, '2024-08-12 08:46:35'),
(3, 2, 'third feedback', 3, '2024-08-12 08:46:43'),
(4, 2, 'fouth feedback', 4, '2024-08-12 08:46:52'),
(5, 2, 'fifth feedback', 5, '2024-08-12 08:47:00'),
(6, 1, 'first feedback from rupak', 3, '2024-08-12 09:39:10'),
(7, 11, 'Easy to find suitable rooms', 3, '2024-08-13 13:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `house_photo_tb`
--

CREATE TABLE `house_photo_tb` (
  `house_photo_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `house_photo_tb`
--

INSERT INTO `house_photo_tb` (`house_photo_id`, `house_id`, `photo`) VALUES
(1, 1, '66b82f898452d3.76278430.jpg'),
(2, 2, '66b830a942c009.01300800.jpg'),
(3, 3, '66b83a3497b197.97019290.jpg'),
(4, 4, '66b83a729da0a4.72776925.jpg');

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

--
-- Dumping data for table `house_tb`
--

INSERT INTO `house_tb` (`house_id`, `landlord_id`, `district`, `municipality_rural`, `tole_village`, `ward`, `nearest_landmark`, `longitude`, `latitude`, `info`, `flag`, `registration_date`) VALUES
(1, 1, 'Bhaktapur', 'sallaghari municipality', 'sallaghari', 3, 'bhaktapur durbar', 0, 0, 'This charming two-story colonial home offers a blend of classic elegance and modern comfort. It features four spacious bedrooms, including a master suite with a walk-in closet and en-suite bathroom. The main floor boasts a cozy living room with a fireplac', 'verified', '2024-08-11 09:12:05');

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

--
-- Dumping data for table `notification_tb`
--

INSERT INTO `notification_tb` (`notification_id`, `whose`, `type`, `date`, `status`, `user_id`, `tenant_id`, `room_id`, `house_id`, `application_id`, `leave_application_id`, `issue_id`, `notice_id`, `feedback_id`) VALUES
(2, 'admin', 'account-verification-apply', '2024-08-14 10:11:09', 'unseen', 10, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'user', 'account-unverified', '2024-08-14 10:13:50', 'unseen', 10, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'user', 'account-verified', '2024-08-14 10:15:51', 'unseen', 10, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'admin', 'account-verification-apply', '2024-08-14 10:26:11', 'unseen', 6, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'user', 'account-unverified', '2024-08-14 10:26:39', 'unseen', 6, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'admin', 'account-verification-apply', '2024-08-14 10:26:50', 'unseen', 6, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 'user', 'account-verified', '2024-08-14 10:26:57', 'unseen', 6, 0, 0, 0, 0, 0, 0, 0, 0),
(33, 'user', 'room-application-apply', '2024-08-14 13:57:05', 'unseen', 1, 7, 2, 0, 0, 0, 0, 0, 0),
(34, 'user', 'room-application-accept', '2024-08-14 13:57:16', 'unseen', 7, 0, 2, 0, 0, 0, 0, 0, 0),
(35, 'user', 'accept-as-tenant', '2024-08-14 13:57:30', 'unseen', 7, 0, 2, 0, 0, 0, 0, 0, 0),
(36, 'user', 'remove-tenant', '2024-08-14 14:00:08', 'unseen', 7, 0, 2, 0, 0, 0, 0, 0, 0);

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

--
-- Dumping data for table `room_photo_tb`
--

INSERT INTO `room_photo_tb` (`room_photo_id`, `room_id`, `photo`) VALUES
(1, 1, '66b83af20d6b79.62748724.jpg'),
(2, 1, '66b83af20d8b71.25566918.jpg'),
(3, 1, '66b83af20da403.05045946.jpg'),
(4, 1, '66b83af20dc1d6.57709401.jpg'),
(5, 2, '66b83b557c0624.48245657.jpg'),
(6, 2, '66b83b557c2446.57908275.jpg'),
(7, 2, '66b83b557c3e00.48561924.jpg'),
(8, 2, '66b83b557c56e6.22312947.jpg'),
(9, 3, '66b83b9f2b3499.42187407.jpg'),
(10, 3, '66b83b9f2b5235.36441089.jpg'),
(11, 3, '66b83b9f2b7232.44153127.jpg'),
(12, 3, '66b83b9f2b9262.90202484.jpg'),
(13, 4, '66b83bce925d57.60472910.jpg'),
(14, 4, '66b83bce927c28.39770937.jpg'),
(15, 4, '66b83bce929458.42062208.jpg'),
(16, 4, '66b83bce97a062.87626577.jpg');

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

--
-- Dumping data for table `room_tb`
--

INSERT INTO `room_tb` (`room_id`, `house_id`, `type`, `bhk`, `number_of_room`, `number`, `furnishing`, `floor`, `rent`, `info`, `flag`, `tenant_id`, `registration_date`) VALUES
(2, 1, 'bhk', 1, 0, 501, 'semi-furnished', 5, 17000, 'The living room is designed for both relaxation and entertaining, with an open layout that flows into the dining area. It features a comfortable sectional sofa, a sleek coffee table, and a fireplace that serves as a focal point. Large windows provide plen', 'verified', 0, '2024-08-11 10:02:25');

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

--
-- Dumping data for table `tenancy_tb`
--

INSERT INTO `tenancy_tb` (`tenancy_id`, `tenant_id`, `room_id`, `move_in_date`, `move_out_date`) VALUES
(5, 7, 2, '2024-08-14 13:57:30', '2024-08-14 14:00:08');

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

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `first_name`, `last_name`, `gender`, `dob`, `email`, `password`, `phone_number`, `province`, `district`, `municipality_rural`, `ward`, `tole_village`, `role`, `profile_photo`, `kyc_front`, `kyc_back`, `registration_date`, `flag`) VALUES
(1, 'rupak', 'dangi', 'male', '2001-05-11', 'rupak@gmail.com', '$2y$10$jDZfWZ.acf9z1rOJyHIyA.A4fB20xXNNUsEkkntQy5kzlKWbfCKdi', '9861354639', 'koshi', 'Taplejung', 'Pathivara', 6, 'Phungling', 'landlord', '66b7a9ab79bb74.05978729.png', '66b7c7c06412b0.81487432.jpg', '66b7c7c0644d98.73665297.jpg', '2024-08-10 23:28:57', 'verified'),
(2, 'shristi', 'pradhan', 'female', '1999-03-15', 'shristi@gmail.com', '$2y$10$ekSIYnmXYiFh53HODpsO5uFZTXkFn.4vZI1NEtGB86Jwst2rqSblO', '9813515133', 'koshi', 'Bhojpur', 'Icchukhola', 2, 'Myanglung', 'tenant', '66b7b6705893a9.00625091.jpg', '66b7b9b39ba960.22936826.jpg', '66b7b9b39be814.99396873.jpg', '2024-08-10 23:48:52', 'verified'),
(3, 'bigyan', 'shrestha', 'male', '2003-10-10', 'bigyan@gmail.com', '$2y$10$1zHqDNSvHzwd0JXvYWn7tOs3KJWrCUSOmzcE.e9RVfGOpS2GJ99b2', '9819088646', 'koshi', 'Bhojpur', 'Mainapokhari', 4, 'Shretha Bazar', 'landlord', '66b834d5a5dc36.70507049.jpg', '66b834c3cdb4c2.76359065.jpg', '66b834c3cde2a1.27849899.jpg', '2024-08-11 09:26:46', 'verified'),
(4, 'dipen', 'magar', 'male', '2002-02-18', 'dipen@gmail.com', '$2y$10$hEpHgRgaHRbMe17iEuwHRO9p.OvZzVnt2POfCvSKQcdjs4m6z6x4C', '9861335990', 'bagmati', 'Kathmandu', 'maharajgung', 3, 'pipalboat', 'landlord', '66b8355e1cae59.08876031.jpg', '66b8356d541ad0.35712343.jpg', '66b8356d544412.77448280.jpg', '2024-08-11 09:28:40', 'verified'),
(5, 'sujan', 'budathoki', 'male', '1999-07-07', 'sujan@gmail.com', '$2y$10$/Mbn7kGWlNf3ILBqSLsT8uKtG9F8Tgu89CfSvZqxxq1fJwPqwLEa6', '9827388196', 'koshi', 'Morang', 'kakani', 1, 'sisneri', 'landlord', '66b835f372c7a3.63681455.jpg', '66b8362a591ce3.94451046.jpg', '66b8362a594661.18699095.jpg', '2024-08-11 09:29:03', 'verified'),
(6, 'yogesh', 'rajbanshi', 'male', '2000-01-08', 'yogesh@gmail.com', '$2y$10$gwaveYr2ztoWs0TGHGMrRuA4fZ963ntU7kas8iOVFlkgwsLeo7z4y', '9824964103', 'koshi', 'Jhapa', 'prithivichowk', 8, 'salleri', 'landlord', '66b836a7d0e7e7.16155395.jpg', '66b836c082b692.05753488.jpg', '66b836c082db28.68305327.jpg', '2024-08-11 09:29:15', 'verified'),
(7, 'melina', 'rayamajhi', 'female', '2003-10-05', 'melina@gmail.com', '$2y$10$eAe1.FzOgzW122MY0GxAj.1YEro0H4HDVkb4JNkl2PIbbVfqDNZI6', '9816372908', 'bagmati', 'Bhojpur', 'icchyakamana', 3, 'roshikhola', 'tenant', '66b8375d437032.92776389.jpeg', '66b8376dc7ae70.05322827.jpg', '66b8376dc7d241.07832272.jpg', '2024-08-11 09:31:36', 'verified'),
(8, 'rusbina', 'gurung', 'female', '2003-03-03', 'rusbina@gmail.com', '$2y$10$Ob474Y6eI3wJIlSeQtCWc.DTEv25MmYZ/jlG2UeZftfBRyk3uE3SO', '9860866729', 'bagmati', 'Lamjung', 'besisahar', 9, 'ghalegaun', 'tenant', '66b837d8e013f9.68217391.jpg', '66b837e5ec1fb5.07982441.jpg', '66b837e5ec4787.68501883.jpg', '2024-08-11 09:31:52', 'verified'),
(9, 'prajita', 'bhattarai', 'female', '2004-01-09', 'prajita@gmail.com', '$2y$10$xGKBA7b6jhUvFxpgPvaMLO.sPCCQymwrngBiO4dXIqamFhM9BrTye', '9843844741', 'koshi', 'Sunsari', 'itahari', 1, 'indrenichowk', 'tenant', '66b839b3aa6963.07167825.jpg', '66bb8825c064d5.89510150.jpg', '66bb8825c12cd8.51084816.jpg', '2024-08-11 09:32:26', 'pending'),
(10, 'samiksha', 'khadka', 'female', '2003-07-07', 'samiksha@gmail.com', '$2y$10$9jd0A.dub4zl.Eoa/QviMOv9tnTAX3jsLd1Dg0pbxhDCbv5a2DpAG', '9840744366', 'koshi', 'Jhapa', 'badegaun nagarpalika', 8, 'halesichowk', 'tenant', '66b8391028ea00.72814111.png', '66bba11cea4395.88806782.jpg', '66bba11cea75d9.79766153.jpg', '2024-08-11 09:32:40', 'verified'),
(11, 'Sita', 'Shrestha', 'female', '1880-06-09', 'sita@gmail.com', '$2y$10$/VYRhjw6pO2bXx3LR0Op5.IvZsWO997YACy2fK4dOEKI.NSfxg8ry', '9584859450', 'koshi', 'Sankhuwasabha', 'khadbari', 4, 'Dholbajay', 'tenant', '66bb102724de63.50795217.jpg', '66bb1082a6cd20.21642622.jpg', '66bb1082a7b315.25809065.jpg', '2024-08-13 13:31:52', 'verified'),
(12, 'Nikola', 'Shrestha', 'female', '1990-12-12', 'nikola@gmail.com', '$2y$10$O/c818J4HPtM/mf4C/PkMeuf3DFPwGp7SdJHq.X8NxJnGAwds/yWG', '9876980786', 'koshi', 'Sankhuwasabha', 'khadbari', 3, 'pokhari', 'tenant', '66bb1787b23e56.17687725.jpg', '66bb17a209e690.58997234.jpg', '66bb17a20a35e6.28787374.jpg', '2024-08-13 14:04:39', 'verified');

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
-- Dumping data for table `wishlist_tb`
--

INSERT INTO `wishlist_tb` (`wishlist_id`, `user_id`, `room_id`) VALUES
(48, 12, 2),
(54, 2, 3),
(57, 7, 2);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `amenity_tb`
--
ALTER TABLE `amenity_tb`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `application_tb`
--
ALTER TABLE `application_tb`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback_tb`
--
ALTER TABLE `feedback_tb`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `house_photo_tb`
--
ALTER TABLE `house_photo_tb`
  MODIFY `house_photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `house_tb`
--
ALTER TABLE `house_tb`
  MODIFY `house_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `review_tb`
--
ALTER TABLE `review_tb`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_photo_tb`
--
ALTER TABLE `room_photo_tb`
  MODIFY `room_photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room_tb`
--
ALTER TABLE `room_tb`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tenancy_tb`
--
ALTER TABLE `tenancy_tb`
  MODIFY `tenancy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wishlist_tb`
--
ALTER TABLE `wishlist_tb`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
