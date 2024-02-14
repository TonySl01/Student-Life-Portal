-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 10:08 PM
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
-- Database: `student_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `advisor`
--

CREATE TABLE `advisor` (
  `advisor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`advisor_id`, `user_id`) VALUES
(1, 14),
(2, 15),
(3, 16);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_ID` int(11) NOT NULL,
  `book_title` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_ID`, `book_title`) VALUES
(1, 'Lord of the rings'),
(2, 'Cindrella'),
(3, 'Alchemist');

-- --------------------------------------------------------

--
-- Table structure for table `book_borrowing`
--

CREATE TABLE `book_borrowing` (
  `student_ID` int(11) NOT NULL,
  `book_ID` int(11) NOT NULL,
  `book_borrowing_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_borrowing`
--

INSERT INTO `book_borrowing` (`student_ID`, `book_ID`, `book_borrowing_id`) VALUES
(3, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `club_ID` int(11) NOT NULL,
  `club_name` varchar(60) NOT NULL,
  `capacity` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`club_ID`, `club_name`, `capacity`, `description`) VALUES
(1, 'Computer Science Club', 50, '\r\nThe Computer Science Club is a dynamic community for students who share a passion for technology and coding. It provides a collaborative environment for members to explore various areas of computing, from software development to artificial intelligence. Activities often include coding workshops, hackathons, tech talks from industry professionals, and networking events. The club aims to empower students with practical skills and knowledge, encouraging innovation and fostering a spirit of collective learning. Whether for career development or personal interest, the Computer Science Club is a hub for like-minded individuals to connect, create, and contribute to the ever-evolving field of computer science.'),
(2, 'IEE', 1, 'Very nice club');

-- --------------------------------------------------------

--
-- Table structure for table `club_enrollments`
--

CREATE TABLE `club_enrollments` (
  `club_enrollment_ID` int(11) NOT NULL,
  `club_ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club_enrollments`
--

INSERT INTO `club_enrollments` (`club_enrollment_ID`, `club_ID`, `student_ID`, `semester_id`) VALUES
(2, 1, 1, 1),
(3, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dorm_rental`
--

CREATE TABLE `dorm_rental` (
  `dorm_rental_ID` int(11) NOT NULL,
  `dorm_ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dorm_rental`
--

INSERT INTO `dorm_rental` (`dorm_rental_ID`, `dorm_ID`, `student_ID`, `semester_id`) VALUES
(4, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gym_booking`
--

CREATE TABLE `gym_booking` (
  `gym_booking_ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `session_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_booking`
--

INSERT INTO `gym_booking` (`gym_booking_ID`, `student_ID`, `session_ID`) VALUES
(9, 1, 4),
(10, 1, 2),
(11, 1, 1),
(12, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `gym_sessions`
--

CREATE TABLE `gym_sessions` (
  `session_ID` int(11) NOT NULL,
  `session_type` varchar(60) NOT NULL,
  `capacity` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gym_sessions`
--

INSERT INTO `gym_sessions` (`session_ID`, `session_type`, `capacity`, `start_time`, `end_time`) VALUES
(1, 'Cardio', 10, '2023-12-09 10:00:00', '2023-12-09 11:00:00'),
(2, 'Powerlifting', 15, '2023-12-09 09:00:00', '2023-12-09 10:00:00'),
(4, 'Yoga', 10, '2023-12-09 11:00:00', '2023-12-09 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `housing`
--

CREATE TABLE `housing` (
  `dorm_ID` int(11) NOT NULL,
  `dorm_name` varchar(50) NOT NULL,
  `dorm_type` varchar(60) NOT NULL,
  `capacity` int(11) NOT NULL,
  `rent` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `housing`
--

INSERT INTO `housing` (`dorm_ID`, `dorm_name`, `dorm_type`, `capacity`, `rent`) VALUES
(0, 'Red Valley', 'Single', 1, 500),
(1, 'La casa', '2 bedroom', 2, 400);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `major_id` int(11) NOT NULL,
  `major_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`major_id`, `major_name`) VALUES
(1, 'Computer Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `meeting_ID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `student_ID` int(11) NOT NULL,
  `advisor_ID` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`meeting_ID`, `date`, `status`, `student_ID`, `advisor_ID`, `description`) VALUES
(17, '2023-12-06 13:26:00', 1, 1, 1, '	 qwe'),
(19, '2023-12-12 14:07:00', 1, 1, 1, '123'),
(22, '2023-12-14 21:03:26', 1, 3, 2, 'adffasd');

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE `parking` (
  `parking_ID` int(11) NOT NULL,
  `parking_zone` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`parking_ID`, `parking_zone`) VALUES
(1, 'A0'),
(2, 'A1');

-- --------------------------------------------------------

--
-- Table structure for table `parking_rental`
--

CREATE TABLE `parking_rental` (
  `parking_rental_id` int(11) NOT NULL,
  `parking_ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking_rental`
--

INSERT INTO `parking_rental` (`parking_rental_id`, `parking_ID`, `student_ID`, `semester_id`) VALUES
(5, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE `ride` (
  `ride_ID` int(11) NOT NULL,
  `ride_type` varchar(30) NOT NULL,
  `ride_name` varchar(50) NOT NULL,
  `student_count` int(11) NOT NULL,
  `src` varchar(60) NOT NULL,
  `dest` varchar(60) NOT NULL,
  `departure` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ride`
--

INSERT INTO `ride` (`ride_ID`, `ride_type`, `ride_name`, `student_count`, `src`, `dest`, `departure`) VALUES
(1, 'BUS', 'LAU BUS', 50, 'Byblos', 'Beirut', '1:00 PM'),
(2, 'Van', 'LAU VAN', 20, 'Byblos', 'Beirut', '8:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `ride_request`
--

CREATE TABLE `ride_request` (
  `ride_ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `ride_request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ride_request`
--

INSERT INTO `ride_request` (`ride_ID`, `student_ID`, `ride_request_id`) VALUES
(2, 1, 4),
(1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semester_id`, `semester_name`) VALUES
(1, 'Fall 2023');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `major_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `user_id`, `major_id`, `semester_id`) VALUES
(1, 13, 1, 1),
(2, 17, 1, 1),
(3, 18, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `study_room`
--

CREATE TABLE `study_room` (
  `room_ID` int(11) NOT NULL,
  `room_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `study_room`
--

INSERT INTO `study_room` (`room_ID`, `room_number`) VALUES
(1, 103),
(3, 104);

-- --------------------------------------------------------

--
-- Table structure for table `study_room_reservation`
--

CREATE TABLE `study_room_reservation` (
  `room_ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `study_room_reservation`
--

INSERT INTO `study_room_reservation` (`room_ID`, `student_ID`, `id`, `date`) VALUES
(1, 1, 1, '2023-12-05 15:10:00'),
(1, 1, 2, '2023-12-04 15:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `token` varchar(50) DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `token`, `activated`) VALUES
(13, 'Hasan', 'Dhainy', 'hasan.dhainy@lau.edu', '$2y$10$ZSX5f9.rVJ7RtXBlEQHV/eBM8jS/h7mRdr5ejuzdMZH7d0pbAGF8q', 0, NULL, 1),
(14, 'Joe', 'Tekli', 'Joe.Tekli@lau.edu.lb', '$2y$10$ZSX5f9.rVJ7RtXBlEQHV/eBM8jS/h7mRdr5ejuzdMZH7d0pbAGF8q', 1, '123123123', 1),
(15, 'Chadi', 'Abu Rjeily', 'chadi.aburjeily@lau.edu.lb', '$2y$10$ZSX5f9.rVJ7RtXBlEQHV/eBM8jS/h7mRdr5ejuzdMZH7d0pbAGF8q', 1, NULL, 1),
(16, 'Zahi', 'Nakad', 'zahi.nakad@lau.edu.lb', '$2y$10$ZSX5f9.rVJ7RtXBlEQHV/eBM8jS/h7mRdr5ejuzdMZH7d0pbAGF8q', 1, NULL, 1),
(17, 'Tony', 'Sleiman', 'tony.sleiman@lau.edu', '$$2y$10$ZSX5f9.rVJ7RtXBlEQHV/eBM8jS/h7mRdr5ejuzdMZH7d0pbAGF8q', 0, NULL, 0),
(18, 'Tracy', 'Rizk', 'tracy.rizk@lau.edu', '$2y$10$1c0ipFgk7zoYZlamRwI5Ru4UaLONLhNzHuf7wXW5lQdfAvxKKSEIK', 0, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advisor`
--
ALTER TABLE `advisor`
  ADD PRIMARY KEY (`advisor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_ID`);

--
-- Indexes for table `book_borrowing`
--
ALTER TABLE `book_borrowing`
  ADD PRIMARY KEY (`book_borrowing_id`),
  ADD KEY `student_ID` (`student_ID`),
  ADD KEY `book_ID` (`book_ID`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`club_ID`);

--
-- Indexes for table `club_enrollments`
--
ALTER TABLE `club_enrollments`
  ADD PRIMARY KEY (`club_enrollment_ID`),
  ADD KEY `student_ID` (`student_ID`),
  ADD KEY `club_ID` (`club_ID`),
  ADD KEY `club_enrollments_ibfk_3` (`semester_id`);

--
-- Indexes for table `dorm_rental`
--
ALTER TABLE `dorm_rental`
  ADD PRIMARY KEY (`dorm_rental_ID`),
  ADD KEY `dorm_rental_ibfk_1` (`student_ID`),
  ADD KEY `dorm_ID` (`dorm_ID`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `gym_booking`
--
ALTER TABLE `gym_booking`
  ADD PRIMARY KEY (`gym_booking_ID`),
  ADD KEY `student_ID` (`student_ID`),
  ADD KEY `session_ID` (`session_ID`);

--
-- Indexes for table `gym_sessions`
--
ALTER TABLE `gym_sessions`
  ADD PRIMARY KEY (`session_ID`);

--
-- Indexes for table `housing`
--
ALTER TABLE `housing`
  ADD PRIMARY KEY (`dorm_ID`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`meeting_ID`),
  ADD KEY `student_ID` (`student_ID`),
  ADD KEY `advisor_ID` (`advisor_ID`);

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`parking_ID`);

--
-- Indexes for table `parking_rental`
--
ALTER TABLE `parking_rental`
  ADD PRIMARY KEY (`parking_rental_id`),
  ADD KEY `student_ID` (`student_ID`),
  ADD KEY `parking_ID` (`parking_ID`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `ride`
--
ALTER TABLE `ride`
  ADD PRIMARY KEY (`ride_ID`);

--
-- Indexes for table `ride_request`
--
ALTER TABLE `ride_request`
  ADD PRIMARY KEY (`ride_request_id`),
  ADD KEY `ride_ID` (`ride_ID`),
  ADD KEY `student_ID` (`student_ID`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Indexes for table `study_room`
--
ALTER TABLE `study_room`
  ADD PRIMARY KEY (`room_ID`);

--
-- Indexes for table `study_room_reservation`
--
ALTER TABLE `study_room_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_ID` (`room_ID`),
  ADD KEY `student_ID` (`student_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advisor`
--
ALTER TABLE `advisor`
  MODIFY `advisor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `book_borrowing`
--
ALTER TABLE `book_borrowing`
  MODIFY `book_borrowing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `club_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `club_enrollments`
--
ALTER TABLE `club_enrollments`
  MODIFY `club_enrollment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dorm_rental`
--
ALTER TABLE `dorm_rental`
  MODIFY `dorm_rental_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gym_booking`
--
ALTER TABLE `gym_booking`
  MODIFY `gym_booking_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gym_sessions`
--
ALTER TABLE `gym_sessions`
  MODIFY `session_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `meeting_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `parking`
--
ALTER TABLE `parking`
  MODIFY `parking_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parking_rental`
--
ALTER TABLE `parking_rental`
  MODIFY `parking_rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `ride_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ride_request`
--
ALTER TABLE `ride_request`
  MODIFY `ride_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `study_room`
--
ALTER TABLE `study_room`
  MODIFY `room_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `study_room_reservation`
--
ALTER TABLE `study_room_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advisor`
--
ALTER TABLE `advisor`
  ADD CONSTRAINT `advisor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `book_borrowing`
--
ALTER TABLE `book_borrowing`
  ADD CONSTRAINT `book_borrowing_ibfk_3` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_borrowing_ibfk_4` FOREIGN KEY (`book_ID`) REFERENCES `book` (`book_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `club_enrollments`
--
ALTER TABLE `club_enrollments`
  ADD CONSTRAINT `club_enrollments_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`semester_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `club_enrollments_ibfk_4` FOREIGN KEY (`club_ID`) REFERENCES `club` (`club_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `club_enrollments_ibfk_5` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dorm_rental`
--
ALTER TABLE `dorm_rental`
  ADD CONSTRAINT `dorm_rental_ibfk_2` FOREIGN KEY (`dorm_ID`) REFERENCES `housing` (`dorm_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dorm_rental_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`semester_id`) ON UPDATE CASCADE;

--
-- Constraints for table `gym_booking`
--
ALTER TABLE `gym_booking`
  ADD CONSTRAINT `gym_booking_ibfk_1` FOREIGN KEY (`session_ID`) REFERENCES `gym_sessions` (`session_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gym_booking_ibfk_2` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `meeting_ibfk_1` FOREIGN KEY (`advisor_ID`) REFERENCES `advisor` (`advisor_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_ibfk_2` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_id`) ON UPDATE CASCADE;

--
-- Constraints for table `parking_rental`
--
ALTER TABLE `parking_rental`
  ADD CONSTRAINT `parking_rental_ibfk_2` FOREIGN KEY (`parking_ID`) REFERENCES `parking` (`parking_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `parking_rental_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`semester_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `parking_rental_ibfk_4` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_id`) ON UPDATE CASCADE;

--
-- Constraints for table `ride_request`
--
ALTER TABLE `ride_request`
  ADD CONSTRAINT `ride_request_ibfk_1` FOREIGN KEY (`ride_ID`) REFERENCES `ride` (`ride_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ride_request_ibfk_2` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`semester_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`major_id`) REFERENCES `majors` (`major_id`);

--
-- Constraints for table `study_room_reservation`
--
ALTER TABLE `study_room_reservation`
  ADD CONSTRAINT `study_room_reservation_ibfk_1` FOREIGN KEY (`student_ID`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `study_room_reservation_ibfk_2` FOREIGN KEY (`room_ID`) REFERENCES `study_room` (`room_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
