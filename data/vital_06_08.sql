-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 06, 2015 at 01:31 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.27-1+deb.sury.org~precise+1

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
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `alarm`
--

INSERT INTO `alarm` (`id`, `title`, `time`, `created_at`, `updated_at`, `patient_id`) VALUES
(1, 'Lorem ipsum dolor sit amet', '2015-08-10 13:10:00', '2015-08-05 01:52:48', '2015-08-05 02:54:30', 3),
(2, 'da', '2015-08-15 03:29:48', '2015-08-05 02:23:37', '2015-08-05 02:23:37', 3),
(3, 'www', '2015-08-07 10:05:00', '2015-08-05 02:46:40', '2015-08-05 02:55:04', 3);

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
(2, 3),
(2, 12),
(4, 3),
(5, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

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
(36, 'heart_rate', 23, '213123', '2015-08-06 00:00:42', '2015-08-06 00:00:42', 3),
(37, 'heart_rate', 1, '', '2015-08-06 00:01:41', '2015-08-06 00:01:41', 3),
(38, 'heart_rate', 4, '', '2015-07-28 06:25:00', '2015-08-06 00:05:06', 3),
(39, 'heart_rate', 55, 'sadghjkl;''\r\n', '2015-07-31 07:25:00', '2015-08-06 00:05:24', 3);

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
(4, '1111', '111', NULL, '', '', '', '2015-08-04 14:17:11', '2015-08-04 14:17:11', 3, 2),
(5, '11', '11', NULL, '', '', '', '2015-08-04 14:46:04', '2015-08-04 14:46:04', 3, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role_id`, `created_at`, `updated_at`, `last_login`, `auth_key`, `reset_token`, `active`, `image`) VALUES
(1, 'Administrator', 'admin@simyan.info', '$2y$13$ozdcAKKjQcnKjLB86P/5bOWpuIQ4JL03ysGk4DhCLxw7azthhI4rm', 1, '2015-04-27 09:00:06', '2015-06-28 21:49:36', NULL, '3tOF3aAsNX7KppENnpRoAHvWbz-LVADq', 'NjnRRR7EXuZnxpvdXT37sNfBTbPIEcYm', 1, '/user/1.jpg'),
(2, 'Doctor', 'doctor@simyan.info', '$2y$13$RaU7c2hrTx/VVFpDuHhQpeKYEdbGjIPg0QMlEvMfnt6jakgIDRLA6', 5, '2015-04-27 09:04:22', '2015-07-02 21:10:28', NULL, 'cc1zGkTk97U9jHmA_6hqcKRTnx0H_bnU', 'Fi9NMLvJrwM4i8tgzlwfgsdaNgV2_m2R', 1, '/user/2.jpg'),
(3, 'Patient', 'patient@simyan.info', '$2y$13$Q2Na0zy7FoBpTDGt/qSaZeUlXIajFaSCrv/iJUcWVkn2MEVfoj2gi', 3, '2015-06-24 22:47:55', '2015-06-24 22:49:43', NULL, 'CrVTmuRXRI-qF6ZDOv-GdKJXocdeskzF', NULL, 1, NULL),
(4, 'Family', 'family@simyan.info', '$2y$13$i5y8hhYJbzmtYib6JH/sH.JVUORD.7ht1upVK3/yAz/NrvvoK2lEi', 4, '2015-06-24 22:47:33', '2015-06-24 22:49:54', NULL, 'l537aokK89xys-jlRBLT-TgeZmfjZ8gw', NULL, 1, NULL),
(5, 'Nurse', 'nurse@simyan.info', '$2y$13$vsLcZuBDqhOuA6UxEistHeAkpSWA5Vj96prEn/4WPqBd794XlNnHi', 6, '2015-06-18 22:07:44', '2015-06-24 22:50:06', NULL, 'TdP1vUqZhUS0JSTayYdE8kpnK7YDJnHZ', NULL, 1, NULL),
(6, 'Visitor', 'visitor@simyan.info', '$2y$13$CDlEQrzI7XI5j.JjHxSZzek2FLc3E0d.sSc64JMlNYjVXCb9cVcNi', 2, '2015-06-18 22:32:05', '2015-06-24 22:50:17', NULL, 'WZhTFcKNqxKIO_MCt8tgBEL7jgntr7IA', NULL, 1, NULL),
(7, 'Administrator 2', 'admin2@simyan.info', '$2y$13$YfWobVKgH/sa1/vlhAsCguuBvI9pDXhPhr4QSo5IgDgqyyiu98pg.', 1, '2015-06-24 22:49:02', '2015-06-24 22:49:02', NULL, 'PqeGzfQa52EHdRP3JU84494uOkDKgDIG', NULL, 1, NULL),
(8, 'Doctor 2', 'doctor2@simyan.info', '$2y$13$sW3quqAKi6LmbVy/jXxLqu1yUVtWUEDZuXpzJ6xo9vHOZrgYej/JS', 5, '2015-06-24 22:50:38', '2015-06-24 22:50:38', NULL, 'apSHVahOZ3IMdqZGxSeno73Fz45Ci09a', NULL, 1, NULL),
(9, 'Nurse 2', 'nurse2@simyan.info', '$2y$13$h0pWNf/Pcx54bucpXgeWGORvcYrQVySR.2B8laHi7q9U6z4OtuTAe', 6, '2015-06-24 22:50:59', '2015-06-28 21:47:05', NULL, '9KyRc7LEUQT2vEQw9Ckrgr81sWtboFka', NULL, 1, '/user/9.jpg'),
(10, 'Visitor 2', 'visitor2@simyan.info', '$2y$13$fU4bFeKU04JW14AaC2Z1IefCfuBOz08mxvY.rYagVOBAIh9/QjPnS', 2, '2015-06-24 22:51:27', '2015-06-24 22:51:27', NULL, 'tkn_6x8Do5vRgbPcGHh-QYTGN8S3uv-j', NULL, 1, NULL),
(11, 'Family 2', 'family2@simyan.info', '$2y$13$Qc4JWYN3H6jEqRWKRWD3qOS8reSj0ggum1wdfCIOEGAAu04xTclN6', 4, '2015-06-24 22:51:46', '2015-06-28 21:38:14', NULL, 'hO7oStXG1uNR438YqRUBdgtZAlQklJQ_', NULL, 1, '/user/11.jpg'),
(12, 'Patient 2', 'patient2@simyan.info', '$2y$13$zGsA8YTVWcsz9R7Te3CHu.BolI6m2tOzLxOgE4fU/WSkPkGRpz02q', 3, '2015-06-24 22:52:24', '2015-06-24 22:52:24', NULL, 'uPbL46T8qODLno_c39fWlBWkx-AQWfoZ', NULL, 1, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alarm`
--
ALTER TABLE `alarm`
  ADD CONSTRAINT `alarm_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

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
