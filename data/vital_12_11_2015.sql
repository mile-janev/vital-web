-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2015 at 12:27 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.28-1+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vital`
--

-- --------------------------------------------------------

--
-- Table structure for table `alarm`
--

CREATE TABLE IF NOT EXISTS `alarm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `patient_id` int(10) unsigned NOT NULL,
  `from_id` int(10) unsigned NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `from_id` (`from_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `alarm`
--

INSERT INTO `alarm` (`id`, `title`, `time`, `created_at`, `updated_at`, `patient_id`, `from_id`, `seen`) VALUES
(10, 'Take your pill', '2015-10-22 18:50:00', '2015-10-18 19:39:11', '2015-10-18 19:39:11', 3, 8, 0),
(11, 'Take your pill Andol', '2015-10-30 23:55:00', '2015-10-18 19:39:40', '2015-10-18 19:39:40', 3, 3, 0),
(12, 'Take syrup', '2015-10-05 17:45:00', '2015-10-18 19:40:07', '2015-10-18 19:40:25', 3, 2, 0),
(13, 'Some alarm', '2015-10-12 22:50:00', '2015-10-18 19:41:03', '2015-10-18 19:41:03', 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `call`
--

CREATE TABLE IF NOT EXISTS `call` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `caller` int(10) unsigned NOT NULL,
  `called` int(10) unsigned NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0-missed, 1-answered, 2-dismiss',
  PRIMARY KEY (`id`),
  KEY `caller` (`caller`),
  KEY `called` (`called`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `call`
--

INSERT INTO `call` (`id`, `caller`, `called`, `start`, `end`, `status`) VALUES
(27, 3, 2, '2015-11-11 23:29:29', '2015-11-11 23:29:35', 1),
(28, 3, 2, '2015-11-11 23:29:36', '2015-11-11 23:29:36', 1),
(29, 3, 2, '2015-11-11 23:29:46', '2015-11-11 23:31:28', 1),
(30, 3, 2, '2015-11-11 23:31:16', '2015-11-11 23:31:27', 1),
(31, 3, 2, '2015-11-11 23:32:00', '2015-11-11 23:32:01', 1),
(32, 3, 2, '2015-11-11 23:32:18', '2015-11-11 23:32:19', 1),
(33, 3, 2, '2015-11-11 23:32:39', '2015-11-12 00:26:48', 2),
(34, 3, 2, '2015-11-11 23:32:51', '2015-11-12 00:24:45', 1),
(35, 3, 2, '2015-11-11 23:33:44', '2015-11-11 23:33:45', 1),
(36, 3, 2, '2015-11-11 23:33:57', '2015-11-12 00:24:23', 2),
(37, 3, 2, '2015-11-11 23:34:06', '2015-11-12 00:21:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `connection`
--

CREATE TABLE IF NOT EXISTS `connection` (
  `user_id` int(10) unsigned NOT NULL,
  `patient_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`patient_id`),
  KEY `user_id` (`user_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `connection`
--

INSERT INTO `connection` (`user_id`, `patient_id`) VALUES
(1, 3),
(2, 3),
(2, 12),
(4, 3),
(5, 3),
(7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sign` varchar(128) NOT NULL,
  `value` float NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `sign`, `value`, `description`, `created_at`, `updated_at`, `user_id`) VALUES
(5, 'calories', 5, '', '2015-04-27 09:04:25', '2015-04-27 09:04:25', 2),
(6, 'heart_rate', 9, 'Lorem ipsum dolor sit amet', '2015-04-27 09:04:28', '2015-04-27 09:04:28', 3),
(7, 'blod_pressure', 10, '', '2015-04-27 09:04:31', '2015-04-27 09:04:31', 3),
(8, 'calories', 8, '', '2015-04-27 09:04:39', '2015-04-27 09:04:39', 2),
(9, 'heart_rate', 15, 'lele male bla', '2015-04-27 09:04:42', '2015-04-27 09:04:42', 3),
(10, 'calories', 75, '', '2015-04-27 09:04:44', '2015-04-27 09:04:44', 2),
(32, 'temperature', 25, 'sabajle', '2015-05-04 11:33:00', '2015-05-04 13:34:03', 3),
(33, 'calories', 53, '', '2015-05-04 11:33:00', '2015-05-04 13:34:03', 1),
(34, 'weight', 65, '', '2015-05-04 13:34:25', '2015-05-04 13:34:25', 3),
(35, 'heart_rate', 60, 'Some description', '2015-08-05 23:44:40', '2015-08-05 23:44:40', 3),
(37, 'heart_rate', 10, '', '2015-08-06 00:01:41', '2015-10-11 03:06:57', 3),
(38, 'heart_rate', 4, '', '2015-07-28 06:25:00', '2015-08-06 00:05:06', 3),
(40, 'heart_rate', 65, 'asdsad', '2015-08-05 07:50:00', '2015-08-06 02:07:30', 2),
(41, 'heart_rate', 63, 'sddsf', '2015-07-29 00:25:00', '2015-08-06 03:21:23', 2),
(42, 'heart_rate', 13, 'sdf', '2015-07-27 01:00:00', '2015-08-06 02:18:01', 2),
(43, 'heart_rate', 12, 'sdf', '2015-07-27 00:00:00', '2015-08-06 02:22:04', 3),
(44, 'heart_rate', 12, 'sdfdsf', '2015-07-29 06:30:00', '2015-08-06 02:22:35', 2),
(47, 'heart_rate', 13, '1331', '2015-08-06 03:15:12', '2015-08-06 03:15:12', 2),
(48, 'heart_rate', 55, '55', '2015-08-26 18:50:00', '2015-08-31 21:24:28', 1),
(50, 'blod_pressure', 15, 'Some description', '2015-10-11 01:11:26', '2015-10-12 10:26:00', 3),
(51, 'temperature', 342, '', '2015-10-11 01:14:40', '2015-10-11 01:14:40', 3),
(52, 'heart_rate', 52, '', '2015-10-11 03:08:31', '2015-10-18 19:45:12', 3),
(53, 'heart_rate', 65, 'Some desc', '2015-10-13 09:45:00', '2015-10-12 10:13:29', 3),
(54, 'weight', 63, '', '2015-10-22 20:50:00', '2015-10-18 20:17:23', 3);

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE IF NOT EXISTS `medication` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rx_number` varchar(128) NOT NULL,
  `name` varchar(255) NOT NULL,
  `strength` int(10) unsigned DEFAULT NULL,
  `strength_measure` varchar(4) DEFAULT NULL,
  `schedule` text,
  `note` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `patient_id` int(10) unsigned NOT NULL,
  `prescribed_by_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `prescribed_by_id` (`prescribed_by_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `medication`
--

INSERT INTO `medication` (`id`, `rx_number`, `name`, `strength`, `strength_measure`, `schedule`, `note`, `created_at`, `updated_at`, `patient_id`, `prescribed_by_id`) VALUES
(2, '555', 'Recept name', 345345, 'mcg', '<p>3*1 before eat</p>', '<p>High temperature</p>', '2015-07-20 22:01:20', '2015-08-04 23:18:08', 3, 2),
(4, '1111', '111', 324, 'df', '', '', '2015-08-04 14:17:11', '2015-08-04 14:17:11', 3, 2),
(5, '11', 'Ime', 33, 'dfs', '', '', '2015-08-04 14:46:04', '2015-08-04 14:46:04', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'administrator', 'Administrator'),
(2, 'visitor', 'Visitor'),
(3, 'patient', 'Patient'),
(4, 'family', 'Family'),
(5, 'doctor', 'Doctor'),
(6, 'nurse', 'Nurse');

-- --------------------------------------------------------

--
-- Table structure for table `sign`
--

CREATE TABLE IF NOT EXISTS `sign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `measure` varchar(32) NOT NULL,
  `alias` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sign`
--

INSERT INTO `sign` (`id`, `name`, `measure`, `alias`) VALUES
(1, 'Heart Rate', 'beats/min', 'heart_rate'),
(2, 'Blood Pressure', 'mmHg', 'blod_pressure'),
(3, 'Temperature', 'C', 'temperature'),
(4, 'Weight', 'kg', 'weight');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `reset_token` varchar(32) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role_id`, `created_at`, `updated_at`, `last_login`, `auth_key`, `reset_token`, `active`, `image`) VALUES
(1, 'Administrator', 'admin@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2015-04-27 09:00:06', '2015-06-28 21:49:36', '2015-11-09 22:27:02', '3tOF3aAsNX7KppENnpRoAHvWbz-LVADq', 'NjnRRR7EXuZnxpvdXT37sNfBTbPIEcYm', 1, '/user/1.jpg'),
(2, 'Doctor', 'doctor@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 5, '2015-04-27 09:04:22', '2015-07-02 21:10:28', '2015-11-11 21:47:59', 'cc1zGkTk97U9jHmA_6hqcKRTnx0H_bnU', 'Fi9NMLvJrwM4i8tgzlwfgsdaNgV2_m2R', 1, '/user/2.jpg'),
(3, 'Patient', 'patient@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, '2015-06-24 22:47:55', '2015-06-24 22:49:43', '2015-10-10 17:11:25', 'CrVTmuRXRI-qF6ZDOv-GdKJXocdeskzF', NULL, 1, '/user/2.jpg'),
(4, 'Family', 'family@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 4, '2015-06-24 22:47:33', '2015-06-24 22:49:54', NULL, 'l537aokK89xys-jlRBLT-TgeZmfjZ8gw', NULL, 1, NULL),
(5, 'Nurse', 'nurse@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 6, '2015-06-18 22:07:44', '2015-06-24 22:50:06', NULL, 'TdP1vUqZhUS0JSTayYdE8kpnK7YDJnHZ', NULL, 1, NULL),
(6, 'Visitor', 'visitor@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, '2015-06-18 22:32:05', '2015-06-24 22:50:17', NULL, 'WZhTFcKNqxKIO_MCt8tgBEL7jgntr7IA', NULL, 1, NULL),
(7, 'Administrator 2', 'admin2@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2015-06-24 22:49:02', '2015-06-24 22:49:02', NULL, 'PqeGzfQa52EHdRP3JU84494uOkDKgDIG', NULL, 1, NULL),
(8, 'Doctor 2', 'doctor2@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 5, '2015-06-24 22:50:38', '2015-06-24 22:50:38', NULL, 'apSHVahOZ3IMdqZGxSeno73Fz45Ci09a', NULL, 1, NULL),
(9, 'Nurse 2', 'nurse2@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 6, '2015-06-24 22:50:59', '2015-06-28 21:47:05', NULL, '9KyRc7LEUQT2vEQw9Ckrgr81sWtboFka', NULL, 1, '/user/9.jpg'),
(10, 'Visitor 2', 'visitor2@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, '2015-06-24 22:51:27', '2015-06-24 22:51:27', NULL, 'tkn_6x8Do5vRgbPcGHh-QYTGN8S3uv-j', NULL, 1, NULL),
(11, 'Family 2', 'family2@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 4, '2015-06-24 22:51:46', '2015-06-28 21:38:14', NULL, 'hO7oStXG1uNR438YqRUBdgtZAlQklJQ_', NULL, 1, '/user/11.jpg'),
(12, 'Patient 2', 'patient2@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, '2015-06-24 22:52:24', '2015-06-24 22:52:24', NULL, 'uPbL46T8qODLno_c39fWlBWkx-AQWfoZ', NULL, 1, NULL),
(13, 'Mile', 'test@email.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, '2015-08-07 20:39:17', '2015-08-07 20:50:13', NULL, 'ORCQm3-xObh_hkEauGZUSyImCocuQFrB', NULL, 1, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alarm`
--
ALTER TABLE `alarm`
  ADD CONSTRAINT `alarm_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alarm_ibfk_2` FOREIGN KEY (`from_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `call`
--
ALTER TABLE `call`
  ADD CONSTRAINT `call_ibfk_1` FOREIGN KEY (`caller`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `call_ibfk_2` FOREIGN KEY (`called`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `connection`
--
ALTER TABLE `connection`
  ADD CONSTRAINT `connection_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `connection_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medication`
--
ALTER TABLE `medication`
  ADD CONSTRAINT `medication_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medication_ibfk_2` FOREIGN KEY (`prescribed_by_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
