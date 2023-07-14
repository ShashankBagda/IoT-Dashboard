-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 05, 2023 at 07:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `IoT_Framework`
--

-- --------------------------------------------------------

--
-- Table structure for table `Actuators`
--

CREATE TABLE `Actuators` (
  `actuator_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `actuator_type` varchar(50) DEFAULT NULL,
  `min_value` decimal(10,2) DEFAULT NULL,
  `max_value` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Actuators`
--

INSERT INTO `Actuators` (`actuator_id`, `device_id`, `user_id`, `actuator_type`, `min_value`, `max_value`) VALUES
(1, 3, 2, 'motor', '0.00', '100.00'),
(2, 3, 2, 'valve', '0.00', '1.00'),
(3, 4, 2, 'light', '0.00', '1.00'),
(4, 5, 3, 'temperature controller', '0.00', '100.00'),
(5, 5, 3, 'fan', '0.00', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `Commands`
--

CREATE TABLE `Commands` (
  `command_id` int(11) NOT NULL,
  `actuator_id` int(11) NOT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Devices`
--

CREATE TABLE `Devices` (
  `device_id` int(11) NOT NULL,
  `device_type` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Devices`
--

INSERT INTO `Devices` (`device_id`, `device_type`, `location`, `user_id`, `status`) VALUES
(1, 'sensor', 'room1', 1, 'online'),
(2, 'sensor', 'room2', 1, 'offline'),
(3, 'actuator', 'kitchen', 2, 'online'),
(4, 'gateway', 'living room', 2, 'offline'),
(5, 'sensor', 'garage', 3, 'malfunctioning');

-- --------------------------------------------------------

--
-- Table structure for table `device_user`
--

CREATE TABLE `device_user` (
  `device_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE `Events` (
  `event_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `event_type` varchar(50) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Events`
--

INSERT INTO `Events` (`event_id`, `device_id`, `event_type`, `message`, `timestamp`) VALUES
(1, 1, 'threshold exceeded', 'temperature too high', '2022-05-01 06:45:00'),
(2, 2, 'device failure', 'sensor not responding', '2022-05-01 07:00:00'),
(3, 3, 'alarm', 'valve malfunctioning', '2022-05-01 07:15:00'),
(4, 4, 'threshold exceeded', 'temperature too low', '2022-05-01 07:30:00'),
(5, 5, 'device failure', 'sensor not providing accurate readings', '2022-05-01 07:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `Humidity`
--

CREATE TABLE `Humidity` (
  `humidity_id` int(11) NOT NULL,
  `device_id` int(11) DEFAULT NULL,
  `sensor_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Humidity`
--

INSERT INTO `Humidity` (`humidity_id`, `device_id`, `sensor_id`, `user_id`, `value`, `timestamp`) VALUES
(1, 1, 1, 1, '50.50', '2023-05-05 07:00:00'),
(2, 2, 2, 1, '48.20', '2023-05-05 07:01:00'),
(3, 3, 3, 2, '51.30', '2023-05-05 07:02:00'),
(4, 4, 1, 2, '49.60', '2023-05-05 07:03:00'),
(5, 5, 2, 3, '47.80', '2023-05-05 07:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `Measurements`
--

CREATE TABLE `Measurements` (
  `measurement_id` int(11) NOT NULL,
  `sensor_id` int(11) NOT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Measurements`
--

INSERT INTO `Measurements` (`measurement_id`, `sensor_id`, `value`, `timestamp`) VALUES
(1, 1, '25.00', '2022-05-01 06:30:00'),
(2, 2, '50.00', '2022-05-01 06:30:00'),
(3, 3, '24.50', '2022-05-01 06:30:00'),
(4, 4, '-10.00', '2022-05-01 06:30:00'),
(5, 5, '100.00', '2022-05-01 06:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `Sensors`
--

CREATE TABLE `Sensors` (
  `sensor_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sensor_type` varchar(50) DEFAULT NULL,
  `min_value` decimal(10,2) DEFAULT NULL,
  `max_value` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Sensors`
--

INSERT INTO `Sensors` (`sensor_id`, `device_id`, `user_id`, `sensor_type`, `min_value`, `max_value`) VALUES
(1, 1, 1, 'temperature', '-10.00', '40.00'),
(2, 1, 1, 'humidity', '0.00', '100.00'),
(3, 2, 1, 'temperature', '-10.00', '40.00'),
(4, 3, 2, 'temperature', '-20.00', '80.00'),
(5, 4, 2, 'humidity', '0.00', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `Temperature`
--

CREATE TABLE `Temperature` (
  `temperature_id` int(11) NOT NULL,
  `sensor_id` int(11) DEFAULT NULL,
  `device_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `temperature` decimal(10,2) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Temperature`
--

INSERT INTO `Temperature` (`temperature_id`, `sensor_id`, `device_id`, `user_id`, `temperature`, `timestamp`) VALUES
(1, 1, 1, 1, '25.40', '2023-05-05 07:00:00'),
(2, 2, 2, 1, '24.80', '2023-05-05 07:01:00'),
(3, 3, 3, 2, '26.50', '2023-05-05 07:02:00'),
(4, 4, 1, 2, '25.10', '2023-05-05 07:03:00'),
(5, 5, 2, 3, '23.70', '2023-05-05 07:04:00'),
(6, 1, 1, 1, '30.40', '2023-05-05 08:00:00'),
(7, 1, 1, 1, '20.40', '2023-05-05 08:30:00'),
(8, 1, 2, 1, '22.40', '2023-05-05 07:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `name`, `email`, `password`) VALUES
(1, 'John Doe', 'johndoe@example.com', 'password123'),
(2, 'Jane Smith', 'janesmith@example.com', 'password456'),
(3, 'Bob Johnson', 'bobjohnson@example.com', 'password789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Actuators`
--
ALTER TABLE `Actuators`
  ADD PRIMARY KEY (`actuator_id`),
  ADD KEY `device_id` (`device_id`);

--
-- Indexes for table `Commands`
--
ALTER TABLE `Commands`
  ADD PRIMARY KEY (`command_id`),
  ADD KEY `actuator_id` (`actuator_id`);

--
-- Indexes for table `Devices`
--
ALTER TABLE `Devices`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `device_user`
--
ALTER TABLE `device_user`
  ADD PRIMARY KEY (`device_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `device_id` (`device_id`);

--
-- Indexes for table `Humidity`
--
ALTER TABLE `Humidity`
  ADD PRIMARY KEY (`humidity_id`),
  ADD KEY `device_id` (`device_id`);

--
-- Indexes for table `Measurements`
--
ALTER TABLE `Measurements`
  ADD PRIMARY KEY (`measurement_id`),
  ADD KEY `sensor_id` (`sensor_id`);

--
-- Indexes for table `Sensors`
--
ALTER TABLE `Sensors`
  ADD PRIMARY KEY (`sensor_id`),
  ADD KEY `device_id` (`device_id`);

--
-- Indexes for table `Temperature`
--
ALTER TABLE `Temperature`
  ADD PRIMARY KEY (`temperature_id`),
  ADD KEY `device_id` (`device_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Actuators`
--
ALTER TABLE `Actuators`
  MODIFY `actuator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Commands`
--
ALTER TABLE `Commands`
  MODIFY `command_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Devices`
--
ALTER TABLE `Devices`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Events`
--
ALTER TABLE `Events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Humidity`
--
ALTER TABLE `Humidity`
  MODIFY `humidity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Measurements`
--
ALTER TABLE `Measurements`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Sensors`
--
ALTER TABLE `Sensors`
  MODIFY `sensor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Temperature`
--
ALTER TABLE `Temperature`
  MODIFY `temperature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Actuators`
--
ALTER TABLE `Actuators`
  ADD CONSTRAINT `Actuators_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `Devices` (`device_id`);

--
-- Constraints for table `Commands`
--
ALTER TABLE `Commands`
  ADD CONSTRAINT `Commands_ibfk_1` FOREIGN KEY (`actuator_id`) REFERENCES `Actuators` (`actuator_id`);

--
-- Constraints for table `device_user`
--
ALTER TABLE `device_user`
  ADD CONSTRAINT `device_user_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `Devices` (`device_id`),
  ADD CONSTRAINT `device_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `Events`
--
ALTER TABLE `Events`
  ADD CONSTRAINT `Events_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `Devices` (`device_id`);

--
-- Constraints for table `Humidity`
--
ALTER TABLE `Humidity`
  ADD CONSTRAINT `Humidity_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `Devices` (`device_id`);

--
-- Constraints for table `Measurements`
--
ALTER TABLE `Measurements`
  ADD CONSTRAINT `Measurements_ibfk_1` FOREIGN KEY (`sensor_id`) REFERENCES `Sensors` (`sensor_id`);

--
-- Constraints for table `Sensors`
--
ALTER TABLE `Sensors`
  ADD CONSTRAINT `Sensors_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `Devices` (`device_id`);

--
-- Constraints for table `Temperature`
--
ALTER TABLE `Temperature`
  ADD CONSTRAINT `Temperature_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `Devices` (`device_id`),
  ADD CONSTRAINT `Temperature_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
