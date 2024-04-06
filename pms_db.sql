-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2024 at 06:29 AM
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
-- Database: `pms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocated_groups`
--

CREATE TABLE `allocated_groups` (
  `id` int(11) NOT NULL,
  `group_number` varchar(255) NOT NULL,
  `student_name1` varchar(255) NOT NULL,
  `student_id1` varchar(255) NOT NULL,
  `student_name2` varchar(255) NOT NULL,
  `student_id2` varchar(255) NOT NULL,
  `student_name3` varchar(255) NOT NULL,
  `student_id3` varchar(255) NOT NULL,
  `student_name4` varchar(255) NOT NULL,
  `student_id4` varchar(255) NOT NULL,
  `professor_name` varchar(255) NOT NULL,
  `professor_email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `project_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allocated_groups`
--

INSERT INTO `allocated_groups` (`id`, `group_number`, `student_name1`, `student_id1`, `student_name2`, `student_id2`, `student_name3`, `student_id3`, `student_name4`, `student_id4`, `professor_name`, `professor_email`, `phone_number`, `project_id`, `created_at`) VALUES
(1, 'G20272', 'Syed', '222010328017', 'Karthikeya', '222010328006', 'Rajesh', '222010328011', 'Rahul', '222010329010', 'Pradeep Kumar', 'pradeep@gmail.com', '543245432454412', 'P2026', '2024-02-29 14:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `panels_list`
--

CREATE TABLE `panels_list` (
  `id` int(11) NOT NULL,
  `professor_id` varchar(255) NOT NULL,
  `professor_name` varchar(255) NOT NULL,
  `panel_id` varchar(255) NOT NULL,
  `professor_email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `spoc` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panels_list`
--

INSERT INTO `panels_list` (`id`, `professor_id`, `professor_name`, `panel_id`, `professor_email`, `phone_number`, `spoc`) VALUES
(18, 'GITAM01', 'Pradeep Kumar', 'panel1', 'pradeep@gmail.com', '543245432454412', 'Yes'),
(19, 'GITAM02', 'Archana', 'panel1', 'Archi@gmail', '986567876', 'No'),
(20, 'GITAM03', 'Preetam', 'panel1', 'ini@gmail', '42343243', 'No'),
(21, 'GITAM04', 'Ravi Kumar', 'panel7', 'ravi@gmail', '0679656789', 'Yes'),
(22, 'GITAM05', 'HEROO', 'panel2', 'hero@123', '423423423', 'No'),
(23, 'GITAM06', 'ZEROO', 'panel1', 'Ezioro@123', '423423423', 'No'),
(24, 'GITAM07', 'OZO', 'panel2', 'ro@123', '423423423', 'Yes'),
(25, 'GITAM08', 'Ragnarok', 'panel2', 'df@3', '423423423', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_description` text DEFAULT NULL,
  `hardware_requirement` text DEFAULT NULL,
  `project_status` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_description`, `hardware_requirement`, `project_status`) VALUES
('P2024', 'IOT', 'asdfsdfsdfsdf', 'sdfsdfsdfsdfsdf', '0'),
('P2026', 'ML', 'sdfdscsrfcvrcvwecv', 'weerweasdfwefqwqwe', '1'),
('P2028', 'TRR', 'dfgsdfgsg', 'TTTTTTTTT', '0'),
('P2029', 'asfdgasdfghg', 'dfsfsfsdfsdfsdfsdfsdf', 'sfdsdfsdfsfd', 'Av');

-- --------------------------------------------------------

--
-- Table structure for table `student_groups`
--

CREATE TABLE `student_groups` (
  `group_id` varchar(10) NOT NULL,
  `group_number` int(11) NOT NULL,
  `student1_name` varchar(255) NOT NULL,
  `student1_id` varchar(255) NOT NULL,
  `student2_name` varchar(255) NOT NULL,
  `student2_id` varchar(255) NOT NULL,
  `student3_name` varchar(255) NOT NULL,
  `student3_id` varchar(255) NOT NULL,
  `student4_name` varchar(255) NOT NULL,
  `student4_id` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_groups`
--

INSERT INTO `student_groups` (`group_id`, `group_number`, `student1_name`, `student1_id`, `student2_name`, `student2_id`, `student3_name`, `student3_id`, `student4_name`, `student4_id`, `created_by`) VALUES
('G20271', 17, 'Aaaaaaaaaa', '001', 'Bbbbbbbbbbb', '002', 'sCCC', '003', 'TCT', '004', '001'),
('G20272', 18, 'Syed', '222010328017', 'Karthikeya', '222010328006', 'Rajesh', '222010328011', 'Rahul', '222010329010', '222010328017');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `reg_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `record_status` tinyint(4) DEFAULT 1,
  `user_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`reg_id`, `password`, `role`, `record_status`, `user_name`, `first_name`, `last_name`, `email`, `phone_number`) VALUES
('001', '112233', 'student', 1, 'Ch. Rajesh', 'Ch', 'Rajesh', 'rchandal@gitam.in', '+91979687669'),
('002', '456', 'student', 1, 'k Murali', 'k', 'Murali', 'murli@gmail.com', '+917986969696'),
('003', '789', 'student', 1, 'Karthik', 'k', 'larthik', 'mhsdf@gmail', '+9894277347'),
('004', '101112', 'student', 1, 'R harsha', 'R', 'harsha', 'harsha@gmail', '+91863659365'),
('010', '9999', 'student', 1, 'Jungoni Rahul', 'JN', 'Rahul', 'jrusdh@gmail', '+918648268462'),
('222010328006', 'karthikeya10', 'student', 1, 'KUKO', 'KU', 'KO', 'kjjkkjk@gmail', '+918698568'),
('222010328011', 'rajesh10', 'student', 1, 'OKIcokkie', 'ko', 'pond', 'fish@gmail', '+91856875687'),
('222010328017', 'syed10', 'student', 1, 'NIO', 'fish', 'fish10', 'disho@gmail', '+91856845632'),
('222010328022', 'murali10', 'student', 1, 'Lailaaa', 'la', 'laila', 'hui@gmail', '+91965678987567'),
('222010328023', 'harsha10', 'student', 1, 'harsha hari', 'hars', 'ara', 'har@gmail.com', '+9185684578'),
('222010328027', 'pranav10', 'student', 1, 'Drawerrajesh', 'der', 'reh', 'redh@gmail', '+91987656789'),
('222010328028', 'suchit10', 'student', 1, 'Cario', 'cai', 'ro', 'cai@gmail', '+91076567887'),
('222010329010', 'rahul10', 'student', 1, 'Bhusitha', 'buch', 'rahi', 'buchi@gm', '+919655678'),
('admin', 'admin', 'admin', 1, NULL, NULL, NULL, NULL, NULL),
('GITAM01', '12345', 'professor', 1, 'Pradeep', 'Pradeep', 'Kumar', 'pradeep@gmail.com', '543245432454412'),
('GITAM02', '222', 'professor', 1, 'Archana', 'archi', 'a a', 'Archi@gmail', '986567876'),
('GITAM03', '789', 'professor', 1, 'Preetam', 'pret', 'am', 'ini@gmail', '42343243'),
('GITAM04', '101112', 'professor', 1, 'Ravi Kumar', 'ravi', 'kumar', 'ravi@gmail', '0679656789'),
('GITAM05', '12345', 'professor', 1, 'HEROO', 'firo', 'piro', 'hero@123', '423423423'),
('GITAM06', '12345', 'professor', 1, 'ZEROO', 'ziro', 'kiro', 'Ezioro@123', '423423423'),
('GITAM07', '12345', 'professor', 1, 'OZO', 'IOo', 'PCDiro', 'ro@123', '423423423'),
('GITAM08', '12345', 'professor', 1, 'Ragnarok', 'ohio', 'iro', 'df@3', '423423423'),
('GITAM09', '12345', 'professor', 1, 'Thor', 'PIKO', 'TRIKO', 'triko@3', '423423423'),
('GITAM10', '12345', 'professor', 1, 'Sekiro', 'KO', 'PKO', 'ko@3', '423423423');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocated_groups`
--
ALTER TABLE `allocated_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panels_list`
--
ALTER TABLE `panels_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `student_groups`
--
ALTER TABLE `student_groups`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`),
  ADD UNIQUE KEY `group_number` (`group_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`reg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocated_groups`
--
ALTER TABLE `allocated_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `panels_list`
--
ALTER TABLE `panels_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `student_groups`
--
ALTER TABLE `student_groups`
  MODIFY `group_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
