-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: senior_system
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_tbl`
--

DROP TABLE IF EXISTS `admin_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_tbl` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `admin_status` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `extension` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `barangay_tbl`
--

DROP TABLE IF EXISTS `barangay_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `barangay_tbl` (
  `barangay_id` int NOT NULL AUTO_INCREMENT,
  `barangay_name` varchar(100) NOT NULL,
  PRIMARY KEY (`barangay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `emp_tbl`
--

DROP TABLE IF EXISTS `emp_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emp_tbl` (
  `emp_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `birth_place` varchar(100) NOT NULL,
  `age` varchar(45) DEFAULT NULL,
  `sex` varchar(100) NOT NULL,
  `civil_status` varchar(100) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `cell_no` bigint NOT NULL,
  `purok_id` int NOT NULL,
  `barangay_id` int NOT NULL,
  `municipality_id` int NOT NULL,
  `province_id` int NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_password` varchar(255) NOT NULL,
  `id_pic` varchar(255) NOT NULL,
  `account_time` time NOT NULL,
  `account_date` date NOT NULL,
  PRIMARY KEY (`emp_id`),
  KEY `purok_id_idx` (`purok_id`),
  KEY `barangay_id_idx` (`barangay_id`),
  KEY `municipality_id_idx` (`municipality_id`),
  KEY `province_id_idx` (`province_id`),
  CONSTRAINT `barangay_id` FOREIGN KEY (`barangay_id`) REFERENCES `barangay_tbl` (`barangay_id`),
  CONSTRAINT `municipality_id` FOREIGN KEY (`municipality_id`) REFERENCES `municipality_tbl` (`municipality_id`),
  CONSTRAINT `province_id` FOREIGN KEY (`province_id`) REFERENCES `province_tbl` (`province_id`),
  CONSTRAINT `purok_id` FOREIGN KEY (`purok_id`) REFERENCES `purok_tbl` (`purok_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log_tbl`
--

DROP TABLE IF EXISTS `log_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_tbl` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) NOT NULL,
  `log_position` varchar(125) NOT NULL,
  `log_action` varchar(255) NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `municipality_tbl`
--

DROP TABLE IF EXISTS `municipality_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `municipality_tbl` (
  `municipality_id` int NOT NULL AUTO_INCREMENT,
  `municipality_name` varchar(100) NOT NULL,
  PRIMARY KEY (`municipality_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `province_tbl`
--

DROP TABLE IF EXISTS `province_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `province_tbl` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(100) NOT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `purok_tbl`
--

DROP TABLE IF EXISTS `purok_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purok_tbl` (
  `purok_id` int NOT NULL AUTO_INCREMENT,
  `purok_no` varchar(10) NOT NULL,
  PRIMARY KEY (`purok_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `request_tbl`
--

DROP TABLE IF EXISTS `request_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_tbl` (
  `request_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `place_birth` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `civil_status` varchar(100) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `purok_id` int NOT NULL,
  `barangay_id` int NOT NULL,
  `municipality_id` int NOT NULL,
  `province_id` int NOT NULL,
  `birth_certificate` varchar(255) NOT NULL,
  `id_pic` varchar(255) NOT NULL,
  `cell_no` bigint NOT NULL,
  `senior_email` varchar(100) NOT NULL,
  `age` int NOT NULL,
  `request_date` date NOT NULL,
  `request_time` time NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `purok_id_idx` (`purok_id`),
  KEY `barangay_id_idx` (`barangay_id`),
  KEY `municipality_id_idx` (`municipality_id`),
  KEY `province_id_idx` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `senior_log`
--

DROP TABLE IF EXISTS `senior_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `senior_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `login_name` varchar(255) NOT NULL,
  `login_date` date NOT NULL,
  `login_time` varchar(100) NOT NULL,
  `out_date` date DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `senior_id` int NOT NULL,
  `session_no` varchar(100) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `senior_tbl`
--

DROP TABLE IF EXISTS `senior_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `senior_tbl` (
  `senior_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `mid_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `date_birth` date NOT NULL,
  `birth_place` varchar(100) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `civil_status` varchar(100) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `cell_no` bigint NOT NULL,
  `purok_id` int NOT NULL,
  `barangay_id` int NOT NULL,
  `municipality_id` int NOT NULL,
  `province_id` int NOT NULL,
  `senior_email` varchar(255) NOT NULL,
  `senior_password` varchar(255) NOT NULL,
  `qr_image` varchar(255) NOT NULL,
  `id_pic` varchar(255) NOT NULL,
  `birth_certificate` varchar(255) NOT NULL,
  `account_time` time NOT NULL,
  `account_date` date NOT NULL,
  `qr_contents` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`senior_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-12  8:47:44
