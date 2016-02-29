-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 29, 2016 at 08:26 AM
-- Server version: 5.5.45-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vital_mile`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `name`) VALUES
(1, 'Normal walking'),
(2, 'Slow walking'),
(3, 'Fast walking'),
(4, 'Running'),
(5, 'Easy aerobic exercise'),
(6, 'Strenuous aerobic exercise'),
(7, 'Driving a bicycle');

-- --------------------------------------------------------

--
-- Table structure for table `alarm`
--

CREATE TABLE IF NOT EXISTS `alarm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `is_sos` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `for_id` int(10) unsigned NOT NULL,
  `from_id` int(10) unsigned NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `patient_id` (`for_id`),
  KEY `from_id` (`from_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `alarm`
--

INSERT INTO `alarm` (`id`, `title`, `time`, `is_sos`, `created_at`, `updated_at`, `for_id`, `from_id`, `seen`) VALUES
(10, 'Take your pill', '2015-10-22 18:50:00', 0, '2015-10-18 19:39:11', '2015-11-24 22:20:39', 3, 8, 1),
(11, 'Take your pill Andol', '2015-10-30 23:55:00', 0, '2015-10-18 19:39:40', '2015-12-05 21:49:48', 3, 3, 1),
(12, 'Take syrup', '2015-10-05 17:45:00', 0, '2015-10-18 19:40:07', '2015-11-23 23:13:54', 2, 2, 1),
(13, 'Some alarm ed', '2015-10-12 22:50:00', 0, '2015-10-18 19:41:03', '2015-11-29 17:41:44', 3, 3, 1),
(33, 'SOS from Patient', '2015-11-23 22:18:12', 1, '2015-11-23 23:18:12', '2015-11-24 21:31:33', 2, 3, 1),
(34, 'SOS from Patient', '2015-11-23 22:18:12', 1, '2015-11-23 23:18:12', '2015-11-24 21:31:33', 5, 3, 1),
(35, 'SOS from Patient', '2015-11-24 19:55:09', 1, '2015-11-24 20:55:09', '2015-11-24 21:36:04', 2, 12, 1),
(36, 'SOS from Patient', '2015-11-24 19:55:10', 1, '2015-11-24 20:55:10', '2015-11-24 21:36:04', 5, 12, 1),
(37, 'SOS from Patient', '2015-11-24 20:08:37', 1, '2015-11-24 21:08:37', '2015-11-24 21:35:59', 2, 3, 1),
(38, 'SOS from Patient', '2015-11-24 20:08:37', 1, '2015-11-24 21:08:37', '2015-11-24 21:35:59', 5, 3, 1),
(40, 'My reminder 1', '2015-11-26 22:55:00', 0, '2015-11-24 21:40:34', '2015-12-05 21:47:10', 2, 2, 1),
(41, 'SOS from Patient', '2015-11-29 13:54:44', 1, '2015-11-29 14:54:44', '2015-11-29 14:55:05', 2, 3, 1),
(42, 'SOS from Patient', '2015-11-29 13:54:44', 1, '2015-11-29 14:54:44', '2015-11-29 14:55:05', 5, 3, 1),
(43, 'SOS from Patient', '2015-11-29 13:57:25', 1, '2015-11-29 14:57:25', '2015-11-29 15:01:11', 2, 3, 1),
(44, 'SOS from Patient', '2015-11-29 13:57:25', 1, '2015-11-29 14:57:25', '2015-11-29 15:01:11', 5, 3, 1),
(46, 'Test alarm edited', '2015-12-04 23:50:00', 0, '2015-11-29 17:33:03', '2015-12-08 16:24:13', 3, 2, 1),
(47, 'Test alarm 2', '2015-12-03 23:45:00', 0, '2015-11-29 17:33:45', '2015-12-06 14:22:48', 3, 2, 1),
(48, 'New reminder', '2015-12-04 23:50:00', 0, '2015-11-29 17:42:00', '2015-12-08 17:58:14', 3, 2, 1),
(49, 'SOS from Patient', '2015-12-22 11:34:11', 1, '2015-12-22 12:34:11', '2015-12-22 12:39:08', 2, 3, 1),
(50, 'SOS from Patient', '2015-12-22 11:34:11', 1, '2015-12-22 12:34:11', '2015-12-22 12:39:08', 5, 3, 1),
(51, 'ca', '2015-12-26 14:05:00', 0, '2015-12-26 11:09:28', '2015-12-26 11:09:28', 2, 2, 0),
(52, 'eeee', '2015-12-26 10:50:00', 0, '2015-12-26 11:09:41', '2015-12-26 11:09:41', 2, 2, 0),
(53, 'SOS from Patient', '2015-12-26 10:15:44', 1, '2015-12-26 11:15:44', '2015-12-26 11:16:10', 2, 3, 1),
(54, 'SOS from Patient', '2015-12-26 10:15:44', 1, '2015-12-26 11:15:44', '2015-12-26 11:16:10', 5, 3, 1),
(55, 'Test reminder', '2015-12-25 18:30:00', 0, '2015-12-26 16:37:19', '2016-01-06 00:28:16', 3, 3, 0),
(56, 'SOS from Patient', '2015-12-26 15:50:10', 1, '2015-12-26 16:50:10', '2015-12-26 16:54:19', 2, 3, 1),
(57, 'SOS from Patient', '2015-12-26 15:50:10', 1, '2015-12-26 16:50:10', '2015-12-26 16:54:19', 5, 3, 0);

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
  `status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0-calling, 1-answered, 2-dismiss, 3-missed',
  PRIMARY KEY (`id`),
  KEY `caller` (`caller`),
  KEY `called` (`called`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `call`
--

INSERT INTO `call` (`id`, `caller`, `called`, `start`, `end`, `status`) VALUES
(1, 3, 2, '2015-12-08 18:43:13', '2015-12-08 18:43:25', 3),
(2, 3, 2, '2015-12-08 18:43:44', '2015-12-08 18:43:47', 3),
(3, 3, 2, '2015-12-08 18:43:50', '2015-12-08 18:43:55', 1),
(4, 3, 2, '2015-12-08 18:46:26', '2015-12-08 18:46:27', 3),
(5, 3, 2, '2015-12-08 18:46:35', '2015-12-08 18:46:39', 3),
(6, 3, 2, '2015-12-08 18:47:34', '2015-12-08 18:47:37', 3),
(7, 3, 2, '2015-12-08 18:57:04', '2015-12-08 18:57:12', 3),
(8, 3, 2, '2015-12-08 18:57:17', '2015-12-08 18:57:20', 2),
(9, 3, 2, '2015-12-08 19:42:10', '2015-12-08 19:42:14', 2),
(10, 3, 2, '2015-12-08 19:42:24', '2015-12-08 19:42:32', 1),
(11, 2, 3, '2015-12-08 19:42:45', '2015-12-08 19:42:49', 2),
(12, 2, 3, '2015-12-08 19:42:58', '2015-12-08 19:43:05', 1),
(13, 3, 2, '2015-12-08 19:44:21', '2015-12-08 19:44:27', 1),
(14, 3, 2, '2015-12-08 19:44:37', '2015-12-08 19:44:43', 2),
(15, 3, 2, '2015-12-08 19:44:52', '2015-12-08 19:44:59', 1),
(16, 3, 2, '2016-01-06 13:31:26', '2016-01-06 14:53:45', 2);

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
(1, 2),
(1, 3),
(2, 3),
(2, 12),
(3, 2),
(3, 4),
(4, 3),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sign` varchar(128) NOT NULL,
  `value` varchar(64) NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `sign`, `value`, `description`, `created_at`, `updated_at`, `user_id`) VALUES
(5, 'calories', '5', '', '2015-04-27 09:04:25', '2015-04-27 09:04:25', 2),
(6, 'heart_rate', '65', 'Lorem ipsum dolor sit amet', '2015-04-27 09:04:28', '2015-04-27 09:04:28', 3),
(7, 'blood_pressure', '135/88', '', '2015-04-27 09:04:31', '2015-04-27 09:04:31', 3),
(8, 'calories', '8', '', '2015-04-27 09:04:39', '2015-04-27 09:04:39', 2),
(9, 'heart_rate', '80', 'lele male bla', '2015-04-27 09:04:42', '2015-04-27 09:04:42', 3),
(10, 'calories', '75', '', '2015-04-27 09:04:44', '2015-04-27 09:04:44', 2),
(32, 'temperature', '38', 'sabajle', '2015-05-04 11:33:00', '2015-05-04 13:34:03', 3),
(33, 'calories', '53', '', '2015-05-04 11:33:00', '2015-05-04 13:34:03', 1),
(34, 'weight', '65', '', '2015-05-04 13:34:25', '2015-05-04 13:34:25', 3),
(35, 'heart_rate', '60', 'Some description', '2015-08-05 23:44:40', '2015-08-05 23:44:40', 3),
(37, 'heart_rate', '95', '', '2015-08-06 00:01:41', '2015-11-30 00:18:05', 3),
(38, 'heart_rate', '90', '', '2015-07-28 06:25:00', '2015-08-06 00:05:06', 3),
(40, 'heart_rate', '82', 'asdsad', '2015-08-05 07:50:00', '2015-08-06 02:07:30', 2),
(41, 'heart_rate', '63', 'sddsf', '2015-07-29 00:25:00', '2015-08-06 03:21:23', 2),
(42, 'heart_rate', '48', 'sdf', '2015-07-27 01:00:00', '2015-08-06 02:18:01', 2),
(43, 'heart_rate', '78', 'sdf', '2015-07-27 00:00:00', '2015-08-06 02:22:04', 3),
(44, 'heart_rate', '74', 'sdfdsf', '2015-07-29 06:30:00', '2015-08-06 02:22:35', 2),
(47, 'heart_rate', '69', '1331', '2015-08-06 03:15:12', '2015-08-06 03:15:12', 2),
(48, 'heart_rate', '79', '55', '2015-08-26 18:50:00', '2015-08-31 21:24:28', 1),
(73, 'blood_pressure', '120/80', '', '2015-12-05 16:08:12', '2015-12-05 16:08:12', 3),
(74, 'heart_rate', '60', '', '2015-12-05 16:08:12', '2015-12-05 16:08:12', 3),
(75, 'respiratory_rate', '15', '', '2015-12-05 16:08:12', '2015-12-05 16:08:12', 3),
(76, 'temperature', '36', '', '2015-12-05 16:08:12', '2015-12-05 16:08:12', 3),
(77, 'avpu', '0', '', '2015-12-05 16:08:12', '2015-12-05 16:08:12', 3),
(78, 'temperature', '37.6', '', '2015-12-20 12:25:06', '2015-12-20 12:25:06', 3),
(79, 'temperature', '38.8', '', '2015-12-20 12:25:27', '2015-12-20 12:25:27', 3),
(80, 'temperature', '37', '', '2015-12-20 12:25:39', '2015-12-20 12:25:39', 3),
(81, 'respiratory_rate', '17', '', '2015-12-20 12:26:06', '2015-12-20 12:26:06', 3),
(82, 'respiratory_rate', '14', '', '2015-12-20 12:26:11', '2015-12-20 12:26:11', 3),
(83, 'weight', '62', '', '2015-12-20 12:26:30', '2015-12-20 12:26:30', 3),
(84, 'weight', '60', '', '2015-12-20 12:26:36', '2015-12-20 12:26:36', 3),
(85, 'weight', '61', '', '2015-12-20 12:26:40', '2015-12-20 12:26:40', 3),
(86, 'blood_pressure', '125/82', '', '2015-12-20 12:27:26', '2015-12-20 12:27:26', 3),
(87, 'heart_rate', '60', 'Measured before lunch.', '2016-01-07 13:30:00', '2016-01-06 11:18:43', 3),
(88, 'heart_rate', '65', '', '2016-01-09 01:37:28', '2016-01-09 01:37:28', 3),
(89, 'blood_pressure', '120/0', '', '2016-01-10 13:15:04', '2016-01-10 13:15:04', 3),
(90, 'heart_rate', '60', '', '2016-01-10 13:15:04', '2016-01-10 13:15:04', 3),
(91, 'respiratory_rate', '15', '', '2016-01-10 13:15:04', '2016-01-10 13:15:04', 3),
(92, 'temperature', '37', '', '2016-01-10 13:15:04', '2016-01-10 13:15:04', 3),
(93, 'avpu', '0', '', '2016-01-10 13:15:04', '2016-01-10 13:15:04', 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `medication`
--

INSERT INTO `medication` (`id`, `rx_number`, `name`, `strength`, `strength_measure`, `schedule`, `note`, `created_at`, `updated_at`, `patient_id`, `prescribed_by_id`) VALUES
(9, '123456', 'Andol', 500, 'mg', '2 pati na den', 'Zabeleska editirana', '2015-11-29 18:09:10', '2015-11-29 18:11:30', 3, 2),
(10, '158254', 'Lanzul', 30, 'mg', '2x1, before eat.', 'Some note.', '2015-11-29 19:31:44', '2016-01-10 11:25:13', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `nutrition`
--

CREATE TABLE IF NOT EXISTS `nutrition` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `description` text NOT NULL,
  `time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `nutrition`
--

INSERT INTO `nutrition` (`id`, `user_id`, `description`, `time`, `created_at`, `updated_at`) VALUES
(1, 3, 'First Meal description edited', '2016-02-16 13:30:00', '2016-02-17 22:38:35', '2016-02-17 22:39:12'),
(2, 3, 'Second meal description here', '2016-02-15 21:50:00', '2016-02-17 22:39:02', '2016-02-17 22:39:02'),
(3, 3, 'Dinner.\r\nEggs, cheese, orange juice.', '2016-02-20 18:00:00', '2016-02-20 22:05:58', '2016-02-20 22:06:43');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sign`
--

INSERT INTO `sign` (`id`, `name`, `measure`, `alias`) VALUES
(1, 'Heart Rate', 'beats/min', 'heart_rate'),
(2, 'Blood Pressure', 'mmHg', 'blood_pressure'),
(3, 'Temperature', 'C', 'temperature'),
(4, 'Weight', 'kg', 'weight'),
(5, 'Respiratory rate', 'breaths/min', 'respiratory_rate'),
(6, 'AVPU', '', 'avpu'),
(7, 'MEWS', '', 'mews');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role_id`, `created_at`, `updated_at`, `last_login`, `auth_key`, `reset_token`, `active`, `image`) VALUES
(1, 'Administrator', 'admin@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2015-04-27 09:00:06', '2015-06-28 21:49:36', '2016-02-27 14:43:28', '3tOF3aAsNX7KppENnpRoAHvWbz-LVADq', 'NjnRRR7EXuZnxpvdXT37sNfBTbPIEcYm', 1, '/user/1.jpg'),
(2, 'Doctor', 'doctor@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 5, '2015-04-27 09:04:22', '2015-07-02 21:10:28', '2016-02-27 14:43:39', 'cc1zGkTk97U9jHmA_6hqcKRTnx0H_bnU', 'Fi9NMLvJrwM4i8tgzlwfgsdaNgV2_m2R', 1, '/user/2.jpg'),
(3, 'Patient', 'patient@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, '2015-06-24 22:47:55', '2015-11-17 23:14:48', '2016-02-26 01:43:45', 'CrVTmuRXRI-qF6ZDOv-GdKJXocdeskzF', 'CcujQ34UW1orMZRQYLVVV2CugO9mXAJv', 1, '/user/2.jpg'),
(4, 'Family', 'family@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 4, '2015-06-24 22:47:33', '2015-11-17 23:23:23', '2015-12-06 14:23:11', 'l537aokK89xys-jlRBLT-TgeZmfjZ8gw', 'XA6N3m2aw01GnMwSJMlwyJi24j5Z3oG9', 1, NULL),
(5, 'Nurse', 'nurse@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 6, '2015-06-18 22:07:44', '2015-06-24 22:50:06', NULL, 'TdP1vUqZhUS0JSTayYdE8kpnK7YDJnHZ', NULL, 1, NULL),
(6, 'Visitor', 'visitor@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, '2015-06-18 22:32:05', '2015-06-24 22:50:17', '2015-12-22 11:51:46', 'WZhTFcKNqxKIO_MCt8tgBEL7jgntr7IA', NULL, 1, NULL),
(7, 'Administrator 2', 'admin2@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2015-06-24 22:49:02', '2015-06-24 22:49:02', NULL, 'PqeGzfQa52EHdRP3JU84494uOkDKgDIG', NULL, 1, NULL),
(8, 'Doctor 2', 'doctor2@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 5, '2015-06-24 22:50:38', '2015-06-24 22:50:38', NULL, 'apSHVahOZ3IMdqZGxSeno73Fz45Ci09a', NULL, 1, NULL),
(9, 'Nurse 2', 'nurse2@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 6, '2015-06-24 22:50:59', '2015-06-28 21:47:05', NULL, '9KyRc7LEUQT2vEQw9Ckrgr81sWtboFka', NULL, 1, '/user/9.jpg'),
(10, 'Visitor 2', 'visitor2@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, '2015-06-24 22:51:27', '2015-06-24 22:51:27', NULL, 'tkn_6x8Do5vRgbPcGHh-QYTGN8S3uv-j', NULL, 1, NULL),
(11, 'Family 2', 'family2@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 4, '2015-06-24 22:51:46', '2015-06-28 21:38:14', NULL, 'hO7oStXG1uNR438YqRUBdgtZAlQklJQ_', NULL, 1, '/user/11.jpg'),
(12, 'Patient 2', 'patient2@simyan.info', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, '2015-06-24 22:52:24', '2015-06-24 22:52:24', NULL, 'uPbL46T8qODLno_c39fWlBWkx-AQWfoZ', NULL, 1, NULL),
(13, 'Mile', 'test@email.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, '2015-08-07 20:39:17', '2015-08-07 20:50:13', NULL, 'ORCQm3-xObh_hkEauGZUSyImCocuQFrB', NULL, 1, ''),
(14, 'daada', 'dada@yahoo.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, '2015-12-22 10:37:46', '2015-12-22 10:37:46', NULL, 'lBnNEzWK0OPqvc_fcg4xBSqYImAHjJcl', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE IF NOT EXISTS `user_activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `activity_id` int(10) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `activity_id` (`activity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `user_id`, `activity_id`, `date`, `start`, `end`, `created_at`, `updated_at`) VALUES
(16, 3, 5, '2016-02-19', '12:15:00', '13:45:00', '2016-02-17 00:18:23', '2016-02-17 22:40:35'),
(17, 3, 7, '2016-02-15', '22:30:00', '22:30:00', '2016-02-17 22:40:27', '2016-02-17 22:40:27'),
(18, 3, 4, '2016-02-20', '10:00:00', '23:00:00', '2016-02-20 22:06:18', '2016-02-20 22:06:18');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alarm`
--
ALTER TABLE `alarm`
  ADD CONSTRAINT `alarm_ibfk_1` FOREIGN KEY (`for_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
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
-- Constraints for table `nutrition`
--
ALTER TABLE `nutrition`
  ADD CONSTRAINT `nutrition_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `user_activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_activity_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
