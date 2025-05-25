-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2025 at 02:51 AM
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
-- Database: `enrollmentdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_classroom`
--

CREATE TABLE `tbl_classroom` (
  `classroom_id` int(10) NOT NULL,
  `room_number` varchar(20) NOT NULL,
  `capacity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_classroom`
--

INSERT INTO `tbl_classroom` (`classroom_id`, `room_number`, `capacity`) VALUES
(1, 'SC201', 45),
(2, 'SC202', 40),
(3, 'SC203', 35),
(4, 'SC204', 50),
(5, 'SC205', 30),
(6, 'BA201', 35),
(7, 'BA202', 30),
(8, 'BA203', 40),
(9, 'BA204', 45),
(10, 'BA205', 50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `course_id` int(10) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `credits` int(5) NOT NULL,
  `department_id` int(10) DEFAULT NULL,
  `course_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `course_name`, `credits`, `department_id`, `course_description`) VALUES
(201, 'Introduction to Programming', 3, 1, 'Basic programming concepts using Python.'),
(202, 'Data Structures', 4, 1, 'In-depth study of arrays, linked lists, trees, and algorithms.'),
(203, 'Database Systems', 3, 1, 'Relational databases, SQL, and data modeling.'),
(204, 'Operating Systems', 4, 1, 'Processes, memory management, and system design.'),
(205, 'Web Development', 3, 1, 'Frontend and backend web technologies.'),
(206, 'Principles of Management', 3, 2, 'Foundational concepts in managing organizations.'),
(207, 'Financial Accounting', 4, 2, 'Basic accounting principles and financial reporting.'),
(208, 'Marketing Fundamentals', 3, 2, 'Introduction to marketing concepts and strategies.'),
(209, 'Business Analytics', 3, 2, 'Data-driven decision making for business.'),
(210, 'Calculus I', 4, 3, 'Limits, derivatives, and applications.'),
(211, 'Linear Algebra', 3, 3, 'Matrix theory, vector spaces, and linear systems.'),
(212, 'Statistics I', 3, 3, 'Probability, distributions, and statistical inference.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `department_id` int(10) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `dean` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department_name`, `dean`) VALUES
(1, 'Computer Science', 'Dr. Alice Johnson'),
(2, 'Mathematics', 'Dr. Bob Smith'),
(3, 'Physics', 'Dr. Carol Martinez'),
(4, 'Chemistry', 'Dr. David Lee'),
(5, 'Biology', 'Dr. Eva Green'),
(6, 'English', 'Dr. Frank Adams'),
(7, 'History', 'Dr. Grace Kim'),
(8, 'Economics', 'Dr. Henry Zhao'),
(9, 'Psychology', 'Dr. Isla Baker'),
(10, 'Engineering', 'Dr. Jack Wilson');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enrollment`
--

CREATE TABLE `tbl_enrollment` (
  `enrollment_id` int(10) NOT NULL,
  `grade` int(2) NOT NULL,
  `course_id` int(10) DEFAULT NULL,
  `student_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_enrollment`
--

INSERT INTO `tbl_enrollment` (`enrollment_id`, `grade`, `course_id`, `student_id`) VALUES
(1, 92, 201, 1),
(2, 85, 202, 2),
(3, 90, 203, 3),
(4, 78, 204, 4),
(5, 83, 205, 5),
(6, 95, 206, 6),
(7, 70, 207, 7),
(8, 88, 208, 8),
(9, 91, 209, 9),
(10, 94, 210, 10),
(11, 76, 211, 11),
(12, 82, 212, 12),
(13, 85, 210, 13),
(14, 89, 209, 14),
(15, 75, 203, 15),
(16, 91, 204, 16),
(17, 87, 202, 17),
(18, 75, 205, 18),
(19, 93, 201, 19),
(20, 88, 212, 20),
(22, 82, 203, 25),
(23, 90, 206, 26),
(24, 99, 203, 27),
(25, 65, 210, 28),
(26, 50, 203, 29);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instructor`
--

CREATE TABLE `tbl_instructor` (
  `instructor_id` int(10) NOT NULL,
  `instructor_fullname` varchar(50) NOT NULL,
  `instructor_email` varchar(50) NOT NULL,
  `instructor_DOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_instructor`
--

INSERT INTO `tbl_instructor` (`instructor_id`, `instructor_fullname`, `instructor_email`, `instructor_DOB`) VALUES
(1, 'Alice Johnson', 'alice.johnson@example.edu', '1980-05-12'),
(2, 'Bob Smith', 'bob.smith@example.edu', '1975-09-23'),
(3, 'Carol Martinez', 'carol.martinez@example.edu', '1982-11-30'),
(4, 'David Lee', 'david.lee@example.edu', '1978-02-17'),
(5, 'Eva Green', 'eva.green@example.edu', '1985-07-04'),
(6, 'Frank Adams', 'frank.adams@example.edu', '1976-01-25'),
(7, 'Grace Kim', 'grace.kim@example.edu', '1983-08-14'),
(8, 'Henry Zhao', 'henry.zhao@example.edu', '1979-12-05'),
(9, 'Isla Baker', 'isla.baker@example.edu', '1986-06-20'),
(10, 'Jack Wilson', 'jack.wilson@example.edu', '1981-10-09'),
(11, 'Karen Young', 'karen.young@example.edu', '1977-03-03'),
(12, 'Liam Carter', 'liam.carter@example.edu', '1984-04-27'),
(13, 'Mia Turner', 'mia.turner@example.edu', '1980-09-18'),
(14, 'Noah Phillips', 'noah.phillips@example.edu', '1974-11-01'),
(15, 'Olivia Scott', 'olivia.scott@example.edu', '1987-02-13'),
(16, 'Paul Walker', 'paul.walker@example.edu', '1983-07-19'),
(17, 'Quinn Rivera', 'quinn.rivera@example.edu', '1982-01-07'),
(18, 'Rachel Flores', 'rachel.flores@example.edu', '1979-05-30'),
(19, 'Sam Bennett', 'sam.bennett@example.edu', '1985-10-22'),
(20, 'Tina Hughes', 'tina.hughes@example.edu', '1986-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `schedule_id` int(10) NOT NULL,
  `day` date NOT NULL,
  `classroom_id` int(10) DEFAULT NULL,
  `teach_assign_id` int(10) DEFAULT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`schedule_id`, `day`, `classroom_id`, `teach_assign_id`, `time_start`, `time_end`) VALUES
(1, '2025-05-20', 3, 1, '08:00:00', '09:30:00'),
(2, '2025-05-20', 1, 2, '09:45:00', '11:15:00'),
(3, '2025-05-21', 8, 3, '10:00:00', '11:30:00'),
(4, '2025-05-22', 8, 4, '13:00:00', '14:30:00'),
(5, '2025-05-23', 3, 5, '14:45:00', '16:15:00'),
(6, '2025-05-24', 5, 6, '08:00:00', '09:30:00'),
(7, '2025-05-24', 9, 7, '09:45:00', '11:15:00'),
(8, '2025-05-25', 4, 8, '11:30:00', '13:00:00'),
(9, '2025-05-26', 7, 9, '13:15:00', '14:45:00'),
(10, '2025-05-27', 2, 10, '15:00:00', '16:30:00'),
(16, '2025-05-20', 4, 11, '11:30:00', '13:00:00'),
(17, '2025-05-20', 2, 12, '13:15:00', '14:45:00'),
(18, '2025-05-21', 5, 13, '14:45:00', '16:15:00'),
(19, '2025-05-21', 6, 14, '16:30:00', '18:00:00'),
(20, '2025-05-22', 1, 15, '08:00:00', '09:30:00'),
(21, '2025-05-22', 3, 16, '10:00:00', '11:30:00'),
(22, '2025-05-23', 4, 17, '08:00:00', '09:30:00'),
(23, '2025-05-23', 6, 18, '10:00:00', '11:30:00'),
(24, '2025-05-24', 2, 19, '11:30:00', '13:00:00'),
(25, '2025-05-24', 8, 20, '13:15:00', '14:45:00'),
(26, '2025-05-25', 9, 1, '14:45:00', '16:15:00'),
(27, '2025-05-26', 1, 2, '08:00:00', '09:30:00'),
(28, '2025-05-26', 4, 3, '09:45:00', '11:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `student_id` int(10) NOT NULL,
  `student_first_name` varchar(50) NOT NULL,
  `student_last_name` varchar(50) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `student_DOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `student_first_name`, `student_last_name`, `student_email`, `student_DOB`) VALUES
(1, 'Lia', 'Anderson', 'liam.anderson@student.edu', '2002-04-15'),
(2, 'Emma', 'Brown', 'emma.brown@student.edu', '2001-07-22'),
(3, 'Noah', 'Clark', 'noah.clark@student.edu', '2003-01-10'),
(4, 'Olivia', 'Davis', 'olivia.davis@student.edu', '2002-11-03'),
(5, 'William', 'Evans', 'william.evans@student.edu', '2001-09-29'),
(6, 'Ava', 'Garcia', 'ava.garcia@student.edu', '2002-03-19'),
(7, 'James', 'Hall', 'james.hall@student.edu', '2003-06-08'),
(8, 'Sophia', 'Hernandez', 'sophia.hernandez@student.edu', '2001-05-25'),
(9, 'Benjamin', 'Johnson', 'benjamin.johnson@student.edu', '2002-12-13'),
(10, 'Isabella', 'King', 'isabella.king@student.edu', '2003-07-31'),
(11, 'Lucas', 'Lee', 'lucas.lee@student.edu', '2001-10-04'),
(12, 'Mia', 'Martinez', 'mia.martinez@student.edu', '2002-08-17'),
(13, 'Henry', 'Moore', 'henry.moore@student.edu', '2003-02-12'),
(14, 'Charlotte', 'Nelson', 'charlotte.nelson@student.edu', '2001-06-06'),
(15, 'Alexander', 'Parker', 'alexander.parker@student.edu', '2002-01-29'),
(16, 'Amelia', 'Perez', 'amelia.perez@student.edu', '2003-04-21'),
(17, 'Daniel', 'Roberts', 'daniel.roberts@student.edu', '2001-12-09'),
(18, 'Harper', 'Scott', 'harper.scott@student.edu', '2002-09-01'),
(19, 'Matthew', 'Taylor', 'matthew.taylor@student.edu', '2003-03-16'),
(20, 'Evelyn', 'White', 'evelyn.white@student.edu', '2002-10-27'),
(25, 'JRald', 'baco', 'raldy31@gmail', '2025-02-12'),
(26, 'rynier', 'achas', 'Rynier@gmail', '2025-05-23'),
(27, 'Do diether', 'labis', 'labis@gmail.com', '2025-05-22'),
(28, 'giov', 'barsobia', 'barsobia@fg6', '2025-05-01'),
(29, 'tstudent', 'student', 'Rynier@gmail', '2025-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teaching_assignment`
--

CREATE TABLE `tbl_teaching_assignment` (
  `teach_assign_id` int(10) NOT NULL,
  `instructor_id` int(10) DEFAULT NULL,
  `course_id` int(10) DEFAULT NULL,
  `semester` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_teaching_assignment`
--

INSERT INTO `tbl_teaching_assignment` (`teach_assign_id`, `instructor_id`, `course_id`, `semester`) VALUES
(1, 1, 201, 1),
(2, 2, 202, 1),
(3, 3, 203, 1),
(4, 4, 204, 1),
(5, 5, 205, 1),
(6, 6, 206, 1),
(7, 7, 207, 1),
(8, 8, 208, 1),
(9, 9, 209, 1),
(10, 10, 210, 1),
(11, 11, 211, 1),
(12, 12, 212, 1),
(13, 13, 201, 1),
(14, 14, 202, 1),
(15, 15, 203, 1),
(16, 16, 204, 1),
(17, 17, 205, 1),
(18, 18, 206, 1),
(19, 19, 207, 1),
(20, 20, 208, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_classroom`
--
ALTER TABLE `tbl_classroom`
  ADD PRIMARY KEY (`classroom_id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `tbl_course_fk1` (`department_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_enrollment`
--
ALTER TABLE `tbl_enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `tbl_enrollment_fk1` (`student_id`),
  ADD KEY `tbl_enrollment_fk2` (`course_id`);

--
-- Indexes for table `tbl_instructor`
--
ALTER TABLE `tbl_instructor`
  ADD PRIMARY KEY (`instructor_id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `tbl_schedule_fk1` (`teach_assign_id`),
  ADD KEY `tbl_schedule_fk2` (`classroom_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_teaching_assignment`
--
ALTER TABLE `tbl_teaching_assignment`
  ADD PRIMARY KEY (`teach_assign_id`),
  ADD KEY `tbl_teaching_assignment_fk1` (`course_id`),
  ADD KEY `tbl_teaching_assignment_fk2` (`instructor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_classroom`
--
ALTER TABLE `tbl_classroom`
  MODIFY `classroom_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `department_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_enrollment`
--
ALTER TABLE `tbl_enrollment`
  MODIFY `enrollment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_instructor`
--
ALTER TABLE `tbl_instructor`
  MODIFY `instructor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `schedule_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_teaching_assignment`
--
ALTER TABLE `tbl_teaching_assignment`
  MODIFY `teach_assign_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD CONSTRAINT `tbl_course_fk1` FOREIGN KEY (`department_id`) REFERENCES `tbl_department` (`department_id`);

--
-- Constraints for table `tbl_enrollment`
--
ALTER TABLE `tbl_enrollment`
  ADD CONSTRAINT `tbl_enrollment_fk1` FOREIGN KEY (`student_id`) REFERENCES `tbl_student` (`student_id`),
  ADD CONSTRAINT `tbl_enrollment_fk2` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`course_id`);

--
-- Constraints for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD CONSTRAINT `tbl_schedule_fk1` FOREIGN KEY (`teach_assign_id`) REFERENCES `tbl_teaching_assignment` (`teach_assign_id`),
  ADD CONSTRAINT `tbl_schedule_fk2` FOREIGN KEY (`classroom_id`) REFERENCES `tbl_classroom` (`classroom_id`);

--
-- Constraints for table `tbl_teaching_assignment`
--
ALTER TABLE `tbl_teaching_assignment`
  ADD CONSTRAINT `tbl_teaching_assignment_fk1` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`course_id`),
  ADD CONSTRAINT `tbl_teaching_assignment_fk2` FOREIGN KEY (`instructor_id`) REFERENCES `tbl_instructor` (`instructor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
