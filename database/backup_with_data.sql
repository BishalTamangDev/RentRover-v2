-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2024 at 07:52 AM
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
(1, 'bishal', 'tamang', 'male', '2000-06-06', 'bishal@gmai.com', '$2y$10$wrLuIind53TjiMrN6RojweQfwitgBXlo/VNIfeB8Zqwhws14ba2UW', '9823645014', 'bagmati', 'Sindhupalchok', 'melamchi', 3, 'bobrang', '66bd9081ca5ab5.78605160.jpg', '', '', '2024-08-15 11:06:05', 'verified');

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
(1, 1, 0, 'Air Conditioning'),
(2, 1, 0, 'Balcony'),
(3, 1, 0, 'Fireplace'),
(4, 1, 0, 'Gardening'),
(5, 1, 0, 'Internet'),
(6, 1, 0, 'Laundry'),
(7, 1, 0, 'Parking'),
(8, 1, 0, 'Pets Allowed'),
(9, 1, 0, 'Prompt Repair Service'),
(10, 1, 0, 'Security'),
(11, 1, 0, 'Solar Heating'),
(12, 1, 0, 'Swimming Pool'),
(13, 2, 0, 'Air Conditioning'),
(14, 2, 0, 'Balcony'),
(15, 2, 0, 'Fireplace'),
(16, 2, 0, 'Gardening'),
(17, 2, 0, 'Internet'),
(18, 2, 0, 'Laundry'),
(19, 3, 0, 'Air Conditioning'),
(20, 3, 0, 'Balcony'),
(21, 3, 0, 'Fireplace'),
(22, 3, 1, 'Air Conditioning'),
(23, 3, 1, 'Balcony'),
(24, 3, 1, 'Fireplace'),
(25, 3, 2, 'Air Conditioning'),
(26, 3, 2, 'Balcony'),
(27, 1, 3, 'Air Conditioning'),
(28, 1, 3, 'Balcony'),
(29, 1, 3, 'Fireplace'),
(30, 1, 3, 'Gardening'),
(31, 1, 3, 'Internet'),
(32, 1, 3, 'Laundry'),
(33, 1, 3, 'Parking'),
(34, 1, 3, 'Pets Allowed'),
(35, 1, 3, 'Prompt Repair Service'),
(36, 1, 3, 'Security'),
(37, 1, 3, 'Solar Heating'),
(38, 1, 3, 'Swimming Pool');

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
(1, 2, 3, 'not-fixed', '2024-08-18', '0000-00-00', 'I want to move in coming saturday', 'accepted', '2024-08-15 11:31:05');

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
(1, 1, 'I’ve been using this system for a few months to manage my rental properties, and it has made everything so much easier. The dashboard is intuitive, allowing me to quickly check the status of all my listings and manage tenant inquiries. I especially apprec', 5, '2024-08-15 11:22:47'),
(2, 2, 'The room management fearure is fantastic! It helps me to keep track of each room\'s availability and maintainence requests effortlessly.', 5, '2024-08-15 11:30:17');

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
(1, 1, '66bd91c633fee3.47265039.jpg'),
(2, 2, '66bd9280783365.93103741.jpg'),
(3, 3, '66bd92e4a055a3.33069451.jpg');

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
(1, 1, 'Bhaktapur', 'sallaghari municipality', 'siddhapokhari gaun', 4, 'siddhapokhari', 0, 0, 'This charming two-story cottage features a classic brick exterior with ivy climbing up the walls, giving it a timeless, storybook feel. The front yard is lush with colorful flower beds, and a white picket fence frames the property. Inside, the house boast', 'verified', '2024-08-15 11:12:34'),
(2, 1, 'Taplejung', 'pathivara', 'phungling', 3, 'pathivara temple', 0, 0, 'A sleek, modern home with a minimalist design, this single-story house is a showcase of contemporary architecture. The exterior is a combination of glass and steel, with large windows that offer panoramic views of the surrounding landscape. The open-conce', 'verified', '2024-08-15 11:15:40'),
(3, 1, 'Kathmandu', 'bagbazar', 'putalisadak', 8, 'chiyaghar', 0, 0, 'The house includes two spacious bedrooms and a master suite with a walk-in closet and en-suite bathroom. Outside, a wooden deck extends into a small pool, creating a seamless indoor-outdoor living experience.', 'verified', '2024-08-15 11:17:20');

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

--
-- Dumping data for table `issue_tb`
--

INSERT INTO `issue_tb` (`issue_id`, `room_id`, `tenant_id`, `issue`, `issued_date`, `solved_date`, `flag`) VALUES
(1, 3, 2, 'Internet is not working', '2024-08-15 11:33:29', '0000-00-00 00:00:00', 'unsolved'),
(2, 3, 2, 'Kitchecn door lick broken', '2024-08-15 11:33:48', '2024-08-15 11:34:26', 'solved');

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

--
-- Dumping data for table `notice_tb`
--

INSERT INTO `notice_tb` (`notice_id`, `house_id`, `room_id`, `tenant_id`, `title`, `description`, `notice_date`) VALUES
(1, 1, 3, 2, 'rent revision', 'your rent will be increased by 1500 from the month bhadra.', '2024-08-15 11:35:30');

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
(1, 'admin', 'account-verification-apply', '2024-08-15 11:11:03', 'seen', 1, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 'user', 'account-verified', '2024-08-15 11:11:14', 'seen', 1, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'admin', 'feedback-submit', '2024-08-15 11:22:47', 'unseen', 1, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'admin', 'account-verification-apply', '2024-08-15 11:29:00', 'seen', 2, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 'user', 'account-verified', '2024-08-15 11:29:11', 'seen', 2, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'admin', 'feedback-submit', '2024-08-15 11:30:17', 'seen', 2, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 'user', 'room-application-apply', '2024-08-15 11:31:05', 'seen', 1, 2, 3, 0, 0, 0, 0, 0, 0),
(8, 'user', 'room-application-accept', '2024-08-15 11:31:18', 'seen', 2, 0, 3, 0, 0, 0, 0, 0, 0),
(9, 'user', 'accept-as-tenant', '2024-08-15 11:31:34', 'seen', 2, 0, 3, 0, 0, 0, 0, 0, 0),
(10, 'user', 'issue-submit', '2024-08-15 11:33:29', 'seen', 1, 2, 3, 0, 0, 0, 0, 0, 0),
(11, 'user', 'issue-submit', '2024-08-15 11:33:48', 'seen', 1, 2, 3, 0, 0, 0, 0, 0, 0),
(12, 'user', 'issue-solved', '2024-08-15 11:34:26', 'seen', 2, 2, 3, 0, 0, 0, 0, 0, 0),
(13, 'user', 'room-notice', '2024-08-15 11:35:30', 'seen', 2, 0, 3, 0, 0, 0, 0, 0, 0);

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

--
-- Dumping data for table `review_tb`
--

INSERT INTO `review_tb` (`review_id`, `user_id`, `room_id`, `review`, `rating`, `review_date`) VALUES
(1, 2, 3, 'The rooms are amazing. Well maintained.', 5, '2024-08-15 11:32:16'),
(2, 2, 3, 'Worst internet', 2, '2024-08-15 11:32:55');

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
(1, 1, '66bd93859b1c69.46022692.jpg'),
(2, 1, '66bd93859b40e4.67355398.jpg'),
(3, 1, '66bd93859b5cd4.30877439.jpg'),
(4, 1, '66bd93859b75f6.82579725.jpg'),
(5, 2, '66bd93c9779599.40426779.jpg'),
(6, 2, '66bd93c977bce4.62733129.jpg'),
(7, 2, '66bd93c977dc51.30499060.jpg'),
(8, 2, '66bd93c977fd73.76430715.jpg'),
(9, 3, '66bd93ff377f31.18799940.jpg'),
(10, 3, '66bd93ff37a515.06008530.jpg'),
(11, 3, '66bd93ff37d178.02381143.jpg'),
(12, 3, '66bd93ff3c23a6.04598635.jpg');

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
(1, 3, 'bhk', 3, 0, 202, 'fully-furnished', 2, 35000, 'A spacious and airy living room with large windows that flood the space with natural light. The room features a neutral color palette, with a plush sectional sofa, a glass coffee table, and a modern fireplace as the focal point. Hardwood floors add warmth', 'verified', 0, '2024-08-15 11:20:01'),
(2, 3, 'bhk', 2, 0, 301, 'semi-furnished', 0, 29000, 'A serene master bedroom designed for relaxation, featuring a king-sized bed with a tufted headboard, soft linens, and a cozy reading nook by the window. The room is decorated in calming shades of blue and gray, with a large wardrobe and a stylish dresser ', 'verified', 0, '2024-08-15 11:21:09'),
(3, 1, 'non-bhk', 0, 3, 305, 'semi-furnished', 3, 19000, 'A sleek, modern kitchen with glossy white cabinetry, stainless steel appliances, and a central island with bar seating. The countertops are made of polished granite, and the backsplash features subway tiles in a herringbone pattern. Pendant lights hang ab', 'on-hold', 2, '2024-08-15 11:22:03');

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
(1, 2, 3, '2024-08-15 11:31:34', '0000-00-00 00:00:00');

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
(1, 'rupak', 'dangi', 'male', '2001-05-11', 'rupak@gmail.com', '$2y$10$FzqTO0Q/KksQU7LiM/mtaODbeRHqMts/8a3jadRYNO022ZYapFBmq', '9856452147', 'koshi', 'Taplejung', 'pathivara', 6, 'phungling', 'landlord', '66bd90db201e72.72504038.png', '66bd90e7339e64.20268798.jpg', '66bd90e733c531.96595303.jpg', '2024-08-15 11:07:26', 'verified'),
(2, 'Shristi', 'Pradhan', 'female', '2000-04-01', 'shristi@gmail.com', '$2y$10$m/KdILEtdgG.rOh9R3WgLuXi6ULCgECBd64GKx3Ref9rpR1aCk89C', '9878675438', 'koshi', 'Bhojpur', 'Icchukhola', 1, 'Bhadgaun', 'tenant', '66bd957344b942.39340619.jpg', '66bd9589250d15.47598732.jpg', '66bd9589253289.84037510.jpg', '2024-08-15 11:24:33', 'verified');

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
(3, 2, 3);

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
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `application_tb`
--
ALTER TABLE `application_tb`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback_tb`
--
ALTER TABLE `feedback_tb`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `house_photo_tb`
--
ALTER TABLE `house_photo_tb`
  MODIFY `house_photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `house_tb`
--
ALTER TABLE `house_tb`
  MODIFY `house_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `issue_tb`
--
ALTER TABLE `issue_tb`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_application_tb`
--
ALTER TABLE `leave_application_tb`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice_tb`
--
ALTER TABLE `notice_tb`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification_tb`
--
ALTER TABLE `notification_tb`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `review_tb`
--
ALTER TABLE `review_tb`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `room_photo_tb`
--
ALTER TABLE `room_photo_tb`
  MODIFY `room_photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `room_tb`
--
ALTER TABLE `room_tb`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tenancy_tb`
--
ALTER TABLE `tenancy_tb`
  MODIFY `tenancy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist_tb`
--
ALTER TABLE `wishlist_tb`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
