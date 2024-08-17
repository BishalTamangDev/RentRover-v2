-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 05:20 AM
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
(1, 'bishal', 'tamang', 'male', '2000-06-06', 'bishal@gmail.com', '$2y$10$DARVHw3.dKz94UCUvkZh8ew/TgGio/hzAWEpQBDkpe3./pl8VJLCK', '9823645014', 'bagmati', 'Sindhupalchok', 'melamchi', 3, 'bobrang', '66be48a0c09ae1.93825833.jpg', '', '', '2024-08-16 00:11:27', 'verified');

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
(7, 2, 0, 'Air Conditioning'),
(8, 2, 0, 'Balcony'),
(9, 2, 0, 'Fireplace'),
(10, 3, 0, 'Air Conditioning'),
(11, 3, 0, 'Balcony'),
(12, 3, 0, 'Fireplace'),
(13, 3, 0, 'Gardening'),
(14, 3, 0, 'Internet'),
(15, 3, 0, 'Laundry'),
(16, 3, 0, 'Parking'),
(17, 3, 0, 'Pets Allowed'),
(18, 3, 0, 'Prompt Repair Service'),
(19, 3, 0, 'Security'),
(20, 3, 0, 'Swimming Pool'),
(21, 4, 0, 'Air Conditioning'),
(22, 4, 0, 'Balcony'),
(23, 4, 0, 'Fireplace'),
(24, 4, 0, 'Gardening'),
(25, 4, 0, 'Internet'),
(26, 4, 0, 'Pets Allowed'),
(27, 4, 0, 'Solar Heating'),
(28, 4, 0, 'Swimming Pool'),
(29, 5, 0, 'Air Conditioning'),
(30, 5, 0, 'Fireplace'),
(31, 5, 0, 'Prompt Repair Service'),
(32, 5, 0, 'Security'),
(33, 5, 0, 'Solar Heating'),
(34, 5, 0, 'Swimming Pool'),
(35, 6, 0, 'Air Conditioning'),
(36, 6, 0, 'Parking'),
(37, 6, 0, 'Prompt Repair Service'),
(38, 6, 0, 'Security'),
(39, 6, 0, 'Swimming Pool'),
(40, 7, 0, 'Air Conditioning'),
(41, 7, 0, 'Balcony'),
(42, 7, 0, 'Internet'),
(43, 7, 0, 'Pets Allowed'),
(44, 7, 0, 'Prompt Repair Service'),
(45, 7, 0, 'Security'),
(66, 3, 2, 'Air Conditioning'),
(67, 3, 2, 'Balcony'),
(68, 3, 2, 'Fireplace'),
(69, 3, 2, 'Gardening'),
(70, 3, 2, 'Swimming Pool'),
(71, 3, 1, 'Air Conditioning'),
(72, 3, 1, 'Balcony'),
(73, 3, 1, 'Fireplace'),
(74, 3, 1, 'Gardening'),
(75, 3, 1, 'Internet'),
(76, 3, 1, 'Laundry'),
(77, 3, 1, 'Parking'),
(78, 3, 1, 'Pets Allowed'),
(79, 3, 1, 'Prompt Repair Service'),
(80, 3, 1, 'Security'),
(81, 3, 1, 'Swimming Pool'),
(82, 8, 0, 'Air Conditioning'),
(83, 8, 0, 'Parking'),
(84, 8, 0, 'Pets Allowed'),
(85, 8, 0, 'Swimming Pool'),
(86, 4, 3, 'Air Conditioning'),
(87, 4, 3, 'Balcony'),
(88, 4, 3, 'Fireplace'),
(89, 4, 3, 'Gardening'),
(90, 4, 3, 'Internet'),
(91, 4, 3, 'Pets Allowed'),
(92, 4, 3, 'Solar Heating'),
(93, 4, 3, 'Swimming Pool'),
(94, 5, 4, 'Air Conditioning'),
(95, 5, 4, 'Fireplace'),
(96, 5, 4, 'Prompt Repair Service'),
(97, 5, 4, 'Security'),
(98, 5, 4, 'Solar Heating'),
(99, 5, 4, 'Swimming Pool'),
(100, 7, 5, 'Air Conditioning'),
(101, 7, 5, 'Balcony'),
(102, 7, 5, 'Internet'),
(103, 7, 5, 'Pets Allowed'),
(104, 7, 5, 'Prompt Repair Service'),
(105, 7, 5, 'Security'),
(106, 6, 6, 'Air Conditioning'),
(107, 6, 6, 'Parking'),
(108, 6, 6, 'Prompt Repair Service'),
(109, 6, 6, 'Security'),
(110, 6, 6, 'Swimming Pool'),
(111, 8, 7, 'Air Conditioning'),
(112, 8, 7, 'Parking'),
(113, 8, 7, 'Pets Allowed'),
(114, 8, 7, 'Swimming Pool'),
(115, 4, 8, 'Air Conditioning'),
(116, 4, 8, 'Balcony'),
(117, 4, 8, 'Fireplace'),
(118, 4, 8, 'Gardening'),
(119, 4, 8, 'Internet'),
(120, 4, 8, 'Pets Allowed'),
(121, 4, 8, 'Solar Heating'),
(122, 4, 8, 'Swimming Pool'),
(123, 5, 9, 'Air Conditioning'),
(124, 5, 9, 'Fireplace'),
(125, 5, 9, 'Prompt Repair Service'),
(126, 5, 9, 'Security'),
(127, 5, 9, 'Solar Heating'),
(128, 5, 9, 'Swimming Pool');

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

--
-- Dumping data for table `feedback_tb`
--

INSERT INTO `feedback_tb` (`feedback_id`, `user_id`, `feedback`, `rating`, `feedback_date`) VALUES
(1, 4, 'Great experience with this rental service! The user interface is clean and intuitive, making it easy to find and book properties. The customer support team was responsive and helpful when I had questions about my reservation. Only minor issue was occasion', 3, '2024-08-16 00:42:41'),
(2, 1, 'I had a smooth experience using this app. The search filters are robust, allowing me to find exactly what I was looking for. Booking and payment were straightforward. However, I’d like to see more detailed property descriptions and updated photos.', 5, '2024-08-16 00:43:52'),
(3, 5, 'Overall, the app is user-friendly and efficient. I appreciated the real-time availability updates and the variety of options. The only downside was some glitches when trying to view reviews on certain listings. It’s a solid service, but a few tweaks would', 4, '2024-08-16 00:44:45');

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
(1, 1, '66be50a3e34c24.94026512.jpg'),
(2, 2, '66be50f96925f0.02260501.jpg'),
(3, 3, '66be51851f0f43.43141727.png'),
(4, 4, '66be5207920408.53147802.jpg'),
(5, 5, '66be52479a2b89.03514611.jpg'),
(6, 6, '66be52a42ef627.57563977.png'),
(7, 7, '66be52cf2e73c6.92175414.jpg'),
(8, 8, '66be53298fde46.32919467.jpg');

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
(1, 2, 'Kathmandu', 'maharajgung', 'pipalboat', 4, 'pipalboat', 0, 0, 'Overall, the app is user-friendly and efficient. I appreciated the real-time availability updates and the variety of options. The only downside was some glitches when trying to view reviews on certain listings. It’s a solid service, but a few tweaks would', 'verified', '2024-08-16 00:46:55'),
(2, 2, 'Kavrepalanchok', 'dolalghat', 'magar basti', 6, 'dolalghat temple', 0, 0, 'A charming 2-bedroom cottage offering a cozy atmosphere with rustic decor. The house includes a fully functional kitchen, a comfortable living room with a fireplace, and a small garden with outdoor seating. Located in a tranquil area, it provides a perfec', 'verified', '2024-08-16 00:48:21'),
(3, 1, 'Bhaktapur', 'sallaghari', 'siddhapokhari', 8, 'siddhapokhari', 0, 0, 'This 1-bedroom apartment is in a vibrant city location, close to restaurants, shops, and public transport. It features modern furnishings, a compact kitchen, and a small balcony with city views. The apartment is ideal for travelers seeking convenience and', 'verified', '2024-08-16 00:50:41'),
(4, 1, 'Kathmandu', 'kathmandu', 'bagbazar', 2, 'chiyaghar', 0, 0, 'Enjoy stunning ocean views from this luxurious 5-bedroom villa. The property boasts a private pool, direct beach access, and an expansive deck for outdoor dining. Inside, you\'ll find a modern kitchen, spacious living areas, and elegant decor. Perfect for.', 'verified', '2024-08-16 00:52:51'),
(5, 1, 'Lalitpur', 'lubhu municipality', 'imadol', 9, 'gwarkho flyover', 0, 0, 'This 3-bedroom log cabin offers a cozy, rustic charm with wooden interiors and a stone fireplace. It includes a fully equipped kitchen, a spacious porch, and a hot tub. Located in a wooded area, it’s ideal for those looking to enjoy nature and tranquility', 'verified', '2024-08-16 00:53:55'),
(6, 1, 'Kathmandu', 'tokha', 'ghalebasti', 9, 'tokha swimming pool', 0, 0, 'Step into charm with this beautifully restored 4-bedroom townhouse. Featuring vintage decor, high ceilings, and original hardwood floors, it combines classic elegance with modern amenities. The property includes a garden and is situated in a historic dist', 'verified', '2024-08-16 00:55:28'),
(7, 1, 'Taplejung', 'pathivara', 'phungling', 6, 'pathivara temple', 0, 0, 'This stylish 2-bedroom loft is located in a trendy urban area. It features an open floor plan with high ceilings, large windows, and modern furnishings. The fully equipped kitchen, comfortable living space, and proximity to nightlife make it a great choic', 'verified', '2024-08-16 00:56:11'),
(8, 1, 'Bhojpur', 'sundar basti', 'jhyaupokhari', 2, 'bigyan coldstore', 0, 0, 'This 3-bedroom cabin offers seclusion and panoramic mountain views. It includes a spacious living area with a stone fireplace, a fully equipped kitchen, and a large deck with a hot tub. Ideal for a peaceful escape surrounded by nature.', 'verified', '2024-08-16 00:57:41');

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

--
-- Dumping data for table `room_photo_tb`
--

INSERT INTO `room_photo_tb` (`room_photo_id`, `room_id`, `photo`) VALUES
(1, 1, '66be53ac564f02.25490289.jpg'),
(2, 1, '66be53ac5663d7.15305735.jpg'),
(3, 1, '66be53ac567354.79223875.jpeg'),
(4, 1, '66be53ac568605.79850224.jpg'),
(5, 2, '66be54f6c29a39.43501292.jpg'),
(6, 2, '66be54f6c2b244.45165526.jpg'),
(7, 2, '66be54f6c2d2f9.51433301.jpg'),
(8, 2, '66be54f6c2e5f4.09015598.jpeg'),
(9, 3, '66be57b6e4b145.68157595.jpg'),
(10, 3, '66be57b6e4c625.55383390.jpg'),
(11, 3, '66be57b6e4d5f3.27974273.jpg'),
(12, 3, '66be57b6e4e517.86525483.jpg'),
(13, 4, '66be57fc11b7c4.88882928.jpg'),
(14, 4, '66be57fc11d669.68489183.jpg'),
(15, 4, '66be57fc11e6a4.18036683.jpg'),
(16, 4, '66be57fc11f638.49033790.jpg'),
(17, 5, '66be586fd09ca0.32819912.jpg'),
(18, 5, '66be586fd0b950.88014349.jpeg'),
(19, 5, '66be586fd0cbb1.38408323.jpg'),
(20, 5, '66be586fd0e038.76996294.jpg'),
(21, 6, '66be59588ea113.10820780.jpg'),
(22, 6, '66be59588eb6c3.42353669.jpg'),
(23, 6, '66be59588ec643.74222258.jpg'),
(24, 6, '66be59588ed7c2.66539776.jpg'),
(25, 7, '66be59907523d1.96968352.jpg'),
(26, 7, '66be5990754031.02970447.jpg'),
(27, 7, '66be59907552b9.42109237.jpg'),
(28, 7, '66be5990756529.79973058.jpg'),
(29, 8, '66be59c00537e9.26149477.jpg'),
(30, 8, '66be59c0054e91.38658932.jpg'),
(31, 8, '66be59c0056367.62241582.jpg'),
(32, 8, '66be59c0057383.38278241.jpg'),
(33, 9, '66be5a5b546be9.51900531.jpg'),
(34, 9, '66be5a5b548412.01687581.jpg'),
(35, 9, '66be5a5b583427.74674890.jpg'),
(36, 9, '66be5a5b585401.52238400.jpg');

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
(1, 3, 'bhk', 1, 0, 101, 'unfurnished', 1, 11000, 'Spacious master bedroom featuring a king-sized bed with premium linens, a large walk-in closet, and an en-suite bathroom with a soaking tub, walk-in shower, and dual sinks. Expansive windows offer abundant natural light and picturesque views of the surrou', 'verified', 0, '2024-08-16 00:59:52'),
(2, 3, 'bhk', 2, 0, 202, 'semi-furnished', 2, 22000, 'Comfortable guest room equipped with a queen-sized bed, fresh linens, and a built-in wardrobe for ample storage. Includes a small desk and chair, perfect for catching up on work or reading. Neutral decor and soft lighting create a cozy, inviting atmospher', 'verified', 0, '2024-08-16 01:05:22'),
(3, 4, 'bhk', 3, 0, 301, 'fully-furnished', 3, 50000, 'Contemporary kitchen outfitted with high-end stainless steel appliances, including a refrigerator, oven, and dishwasher. Granite countertops provide ample prep space, and the breakfast bar with stools adds casual dining options. Ideal for cooking and ente', 'verified', 0, '2024-08-16 01:17:06'),
(4, 5, 'non-bhk', 0, 3, 502, 'unfurnished', 2, 27000, 'Stylish bathroom with a walk-in shower featuring glass doors, dual sinks with modern fixtures, and a large mirror. The tile backsplash adds a touch of elegance, while ample storage and a clean, contemporary design ensure functionality and aesthetic appeal', 'verified', 0, '2024-08-16 01:18:16'),
(5, 7, 'non-bhk', 0, 2, 103, 'unfurnished', 1, 7000, 'Functional home office space with a spacious desk, ergonomic chair, and built-in shelves for organization. The room is well-lit by natural light from a large window, making it an ideal spot for productivity, study, or creative work.', 'verified', 0, '2024-08-16 01:20:11'),
(6, 6, 'bhk', 4, 0, 404, 'fully-furnished', 4, 65000, 'Elegant dining room with a classic wooden table seating six, complemented by a stylish chandelier overhead. The room also features a sideboard for extra storage and easy access to the adjacent kitchen, making it perfect for formal and casual meals.', 'verified', 0, '2024-08-16 01:24:04'),
(7, 8, 'non-bhk', 0, 2, 203, 'semi-furnished', 2, 9000, 'Inviting sunroom with floor-to-ceiling windows allowing abundant natural light to fill the space. Furnished with comfortable seating and lush indoor plants, it serves as a serene retreat for relaxation, reading, or enjoying a morning coffee.', 'verified', 0, '2024-08-16 01:25:00'),
(8, 4, 'non-bhk', 0, 1, 702, 'unfurnished', 7, 4000, 'Spacious basement recreation room designed for entertainment with a pool table, sectional sofa, and a large TV. The area is perfect for family gatherings, movie nights, or socializing with friends, featuring ample space for various activities', 'verified', 0, '2024-08-16 01:25:48'),
(9, 5, 'bhk', 2, 0, 403, 'unfurnished', 4, 18000, 'Functional home office space with a spacious desk, ergonomic chair, and built-in shelves for organization. The room is well-lit by natural light from a large window, making it an ideal spot for productivity, study, or creative work.', 'verified', 0, '2024-08-16 01:28:23');

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

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `first_name`, `last_name`, `gender`, `dob`, `email`, `password`, `phone_number`, `province`, `district`, `municipality_rural`, `ward`, `tole_village`, `role`, `profile_photo`, `kyc_front`, `kyc_back`, `registration_date`, `flag`) VALUES
(1, 'rupak', 'dangi', 'male', '2001-11-11', 'rupak@gmail.com', '$2y$10$f8JArwiHuMuiqv/Wmxa48OUpiCgoZARVFbxtPzQblU23RUhvjr8e.', '9861354639', 'koshi', 'Taplejung', 'pathivara', 6, 'phungling', 'landlord', '66be494b222ff5.29955906.png', '66be495f8f2638.15557154.jpg', '66be495f8f5221.80258335.jpg', '2024-08-16 00:13:28', 'verified'),
(2, 'dipen', 'magar', 'male', '2003-12-05', 'dipen@gmail.com', '$2y$10$jezW.nhCllZ7vX1lLI3/GuHkYbaLPwCdQrrGsA/e.vD9WaF8L/.Dq', '9874514521', 'bagmati', 'Kathmandu', 'maharajgunj', 4, 'pipalboat', 'landlord', '66be4b31733a82.12035134.jpg', '66be4b3e962f81.48362101.jpg', '66be4b3e964e59.83326870.jpg', '2024-08-16 00:21:42', 'verified'),
(4, 'Shristi', 'Pradhan', 'female', '2000-03-15', 'shristi@gmail.com', '$2y$10$IR6nH4Zu/t/bfUNhLWYXgeDnIpbB09YDWPw2zyOK5FhFPPSJKsMma', '9856325689', 'koshi', 'Bhojpur', 'Icchukhola Nagarpalika', 7, 'Dholbaje', 'tenant', '66be4ec3555ae8.66480237.jpg', '66be4eb78e1047.98554643.jpg', '66be4eb78e33e8.20444717.jpg', '2024-08-16 00:32:04', 'verified'),
(5, 'rusbina', 'gurung', 'female', '2001-02-24', 'rusbina@gmail.com', '$2y$10$.ZFiUhdOvjWcH1q.9EdplOOlKtRC9QcZAb4l4tRZl5WA9FRWzmXAu', '9856451748', 'gandaki', 'Lamjung', 'besisahar', 8, 'besisahar bazar', 'tenant', '66be4d903e1cc1.06191578.jpg', '66be4da5ae0417.64081630.jpg', '66be4da5ae1a91.65549284.jpg', '2024-08-16 00:32:26', 'verified'),
(6, 'Luniva', 'Sheestha', 'female', '1998-10-24', 'luniva@gmail.com', '$2y$10$oLcD0ksm3ZylI1squFNDOOGH87FCHXqeq9ogiL3.aKudwOW663POO', '9856425185', 'bagmati', 'Kathmandu', 'Manohara', 9, 'Sankhu', 'tenant', '66be60f273d944.13512409.jpeg', '66be610678baa7.98116137.jpg', '66be610678d654.42457215.jpg', '2024-08-16 01:52:37', 'verified');

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `amenity_tb`
--
ALTER TABLE `amenity_tb`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `application_tb`
--
ALTER TABLE `application_tb`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_tb`
--
ALTER TABLE `feedback_tb`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `house_photo_tb`
--
ALTER TABLE `house_photo_tb`
  MODIFY `house_photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `house_tb`
--
ALTER TABLE `house_tb`
  MODIFY `house_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `room_photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `room_tb`
--
ALTER TABLE `room_tb`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tenancy_tb`
--
ALTER TABLE `tenancy_tb`
  MODIFY `tenancy_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist_tb`
--
ALTER TABLE `wishlist_tb`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
