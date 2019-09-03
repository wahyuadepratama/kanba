-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2019 at 01:51 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kanba`
--

-- --------------------------------------------------------

--
-- Table structure for table `coach_trainees`
--

CREATE TABLE `coach_trainees` (
  `id` int(11) NOT NULL,
  `coach_nik` varchar(20) NOT NULL,
  `trainee_nik` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coach_trainees`
--

INSERT INTO `coach_trainees` (`id`, `coach_nik`, `trainee_nik`, `created_at`, `updated_at`) VALUES
(74, '100', '0115024', '2019-09-01 01:42:02', '2019-09-01 01:42:02'),
(75, '100', '10014215', '2019-09-01 01:42:02', '2019-09-01 01:42:02'),
(85, '100', '16721381', '2019-09-01 01:54:27', '2019-09-01 01:54:27'),
(88, '08912398', '1199213', '2019-09-01 14:50:50', '2019-09-01 14:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Coach'),
(3, 'Trainee');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `datetime` date DEFAULT NULL,
  `actual` date DEFAULT NULL,
  `relationship_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `photo` varchar(190) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `datetime`, `actual`, `relationship_id`, `status`, `photo`) VALUES
(33, '2019-09-13', '2019-09-13', 74, 'past', '1567358383.jpg'),
(36, '2019-09-13', '2019-09-02', 75, 'past', '1567362291.jpg'),
(37, '2019-09-19', NULL, 85, 'ongoing', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` varchar(190) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `photo`) VALUES
(1, 'Login Page', 'login.jpg'),
(2, 'Slider 1', 'slider1.jpg'),
(3, 'Slider 2', 'slider2.jpg'),
(4, 'Slider 3', 'slider3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `nik` varchar(20) NOT NULL,
  `password` varchar(190) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(190) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`nik`, `password`, `role_id`, `name`, `phone`, `created_at`, `updated_at`) VALUES
('0102131', '$2y$10$ygpvJ6k5hloXR3uoblU8P.dsTPmt2auuFiS9JQ/sR2N5r7depl9aS', 3, 'Roy', '081267866712', '2019-08-31 06:04:56', '2019-08-31 06:04:56'),
('0115024', '$2y$10$gRzrccR3fDpjE/M.h0n.Tus5wrOAncFW15iVSB9pan483oCFrSlJi', 3, 'First User', '8137132188971', '2019-08-31 05:57:45', '2019-08-31 05:57:45'),
('08912398', '$2y$10$iiTOVL.rSV8lvY8E8WiCDepzZ0K02gy32OELHXsziw4mGz3vx2xq6', 2, 'Jhoni', '0891231', '2019-08-31 04:52:12', '2019-08-31 04:52:12'),
('100', '$2y$12$Rt7cwx0EO5UPu0BZ0UqobuBpjvvt1medOhL46Lx8GxuhOFgOYwozG', 2, 'Coach 1', '12313123', '2019-08-06 17:00:00', '2019-08-31 02:31:31'),
('10014215', '$2y$10$xZbZYlRxgpPGOtgx9bjGJ.dNXzZA4k38jcMr5RLNX1DYJzlNSqyze', 3, 'Wahyu Ade Pratama', '81371321971', '2019-08-31 05:58:28', '2019-08-31 05:58:28'),
('1199213', '$2y$10$2i0hsLrShd6APz3yW3DNHevdLYv0e/xXyj97yK/Mg.JHgtydb5eRK', 3, 'Rani', '0899123912', '2019-08-31 06:04:05', '2019-08-31 06:04:05'),
('123123123', '$2y$10$gOq46rx3mckNfUgMGPJJ9uXwtkdPN5RplPpdG69qXyA3ifRKpAgdK', 3, 'testes', NULL, '2019-09-01 14:47:27', '2019-09-01 14:47:27'),
('12321131', '$2y$10$o5k7/DHEChNDrpcUjuPJqu.Fd1bmwcze2824Iasg.443S/OogD3Hy', 3, 'Ridho', '089121931', '2019-08-31 06:04:36', '2019-08-31 06:04:36'),
('132123122', '$2y$10$6s7e5EE6EG69DD0b6/7R4.R62ZDwGPnD8dx212uWe8Wdq2kMv6J0.', 3, 'Steve', '081232131', '2019-08-31 06:03:34', '2019-08-31 06:03:34'),
('141278127', '$2y$10$Xg9EdVpZ5h..OFmfu8vfSuPRlkf3iE9GFQFuAyCrvCLvxOS7P66o2', 3, 'Badu', '09102930', '2019-08-31 06:02:35', '2019-08-31 06:02:35'),
('149182398', '$2y$10$QBx4BEDWkB03hEohA1LBouiuO07xtO4SybQYZ9K/PXaKThDuQY8Tu', 3, 'Budi', '08912389', '2019-08-31 06:02:51', '2019-08-31 06:02:51'),
('15', '$2y$12$Rt7cwx0EO5UPu0BZ0UqobuBpjvvt1medOhL46Lx8GxuhOFgOYwozG', 2, 'Wahyu ade pratama', '081371321971', '2019-07-31 17:00:00', '2019-08-30 10:31:18'),
('151152009', '$2y$10$qUIbHprh0mjfLO5.aOKYT.mOrvdP1tQAixxl64OVUGGsrWyOUhZdi', 3, 'Upiak', '08912391239', '2019-08-31 06:03:15', '2019-08-31 06:03:15'),
('1511521024', '$2y$10$A2dBCO/rIauXIxV5khUoBuuIfyh4J4k3fmwYXlcXgGH0m9WjGFvHG', 3, 'Jhoni', '08989123898', '2019-08-31 06:02:05', '2019-08-31 06:02:05'),
('15671231', '$2y$10$2MhqEprLiKHymx4TbfPMteVm7rA5z.2Oj2M3XIOz..jjh5B5C2qKy', 3, 'Blue', '081112310', '2019-08-31 06:04:22', '2019-08-31 06:04:22'),
('16', '$2y$12$Rt7cwx0EO5UPu0BZ0UqobuBpjvvt1medOhL46Lx8GxuhOFgOYwozG', 1, 'Administrator', '081267866712', NULL, '2019-08-30 10:31:54'),
('16721381', '$2y$10$QHcQLPYxoRVmgX2g.pB6Qe0IJqDtnC759n.vUcQ4SrMQEmZ/utore', 3, 'Toni', '08912391', '2019-08-31 06:03:49', '2019-08-31 06:03:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coach_trainees`
--
ALTER TABLE `coach_trainees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coach_nik` (`coach_nik`),
  ADD KEY `trainee_nik` (`trainee_nik`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coach_id` (`relationship_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coach_trainees`
--
ALTER TABLE `coach_trainees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coach_trainees`
--
ALTER TABLE `coach_trainees`
  ADD CONSTRAINT `coach_trainees_ibfk_1` FOREIGN KEY (`coach_nik`) REFERENCES `users` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coach_trainees_ibfk_2` FOREIGN KEY (`trainee_nik`) REFERENCES `users` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`relationship_id`) REFERENCES `coach_trainees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
