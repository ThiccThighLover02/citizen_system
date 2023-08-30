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
-- Table structure for table `action_tbl`
--

DROP TABLE IF EXISTS `action_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `action_tbl` (
  `action_id` int NOT NULL AUTO_INCREMENT,
  `action_done` varchar(255) NOT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action_tbl`
--

LOCK TABLES `action_tbl` WRITE;
/*!40000 ALTER TABLE `action_tbl` DISABLE KEYS */;
INSERT INTO `action_tbl` VALUES (1,'Accept Senior'),(2,'Add Senior'),(3,'Remove Senior'),(4,'Add User'),(5,'Remove User'),(6,'Create Post'),(7,'Printed ID');
/*!40000 ALTER TABLE `action_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_tbl`
--

DROP TABLE IF EXISTS `activity_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_tbl` (
  `activity_id` int NOT NULL AUTO_INCREMENT,
  `act_emp_id` int DEFAULT NULL,
  `act_senior_id` int DEFAULT NULL,
  `action_id` int DEFAULT NULL,
  `act_date` date DEFAULT NULL,
  `act_time` time DEFAULT NULL,
  PRIMARY KEY (`activity_id`),
  KEY `emp_id_idx` (`act_emp_id`),
  KEY `senior_id_idx` (`act_senior_id`),
  KEY `action_id_idx` (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_tbl`
--

LOCK TABLES `activity_tbl` WRITE;
/*!40000 ALTER TABLE `activity_tbl` DISABLE KEYS */;
INSERT INTO `activity_tbl` VALUES (1,NULL,1,7,'2023-08-26','01:45:00'),(2,1,NULL,1,'2023-08-26','01:45:00');
/*!40000 ALTER TABLE `activity_tbl` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `admin_tbl`
--

LOCK TABLES `admin_tbl` WRITE;
/*!40000 ALTER TABLE `admin_tbl` DISABLE KEYS */;
INSERT INTO `admin_tbl` VALUES (1,'Active','admin','admin','admin','is','the','admin');
/*!40000 ALTER TABLE `admin_tbl` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `barangay_tbl`
--

LOCK TABLES `barangay_tbl` WRITE;
/*!40000 ALTER TABLE `barangay_tbl` DISABLE KEYS */;
INSERT INTO `barangay_tbl` VALUES (1,'Alua'),(2,'Calaba'),(3,'Malapit'),(4,'Mangga'),(5,'Poblacion'),(6,'Pulo'),(7,'San Roque'),(8,'Santo Cristo'),(9,'Tabon');
/*!40000 ALTER TABLE `barangay_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_log`
--

DROP TABLE IF EXISTS `emp_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emp_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `emp_id` int NOT NULL,
  `login_date` date DEFAULT NULL,
  `login_time` time DEFAULT NULL,
  `out_date` date DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `session_no` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_log`
--

LOCK TABLES `emp_log` WRITE;
/*!40000 ALTER TABLE `emp_log` DISABLE KEYS */;
INSERT INTO `emp_log` VALUES (1,1,'2023-08-22','14:25:09',NULL,NULL,'750415'),(2,1,'2023-08-22','17:18:56',NULL,NULL,'671420'),(3,1,'2023-08-22','17:24:02',NULL,NULL,'467477'),(4,1,'2023-08-22','17:25:03',NULL,NULL,'272485'),(5,1,'2023-08-22','17:27:22',NULL,NULL,'979654'),(6,1,'2023-08-22','17:33:46',NULL,NULL,'360929'),(7,1,'2023-08-22','17:40:49',NULL,NULL,'372992'),(8,1,'2023-08-22','18:05:34',NULL,NULL,'580415'),(9,1,'2023-08-22','18:16:05',NULL,NULL,'878809'),(10,2,'2023-08-22','18:20:25',NULL,NULL,'581954'),(11,1,'2023-08-22','18:35:00',NULL,NULL,'713496'),(12,1,'2023-08-23','07:04:47',NULL,NULL,'275421');
/*!40000 ALTER TABLE `emp_log` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_tbl`
--

LOCK TABLES `emp_tbl` WRITE;
/*!40000 ALTER TABLE `emp_tbl` DISABLE KEYS */;
INSERT INTO `emp_tbl` VALUES (1,'Active','Magtalas','','Carlson','','Magtalas  Carlson','2002-04-02','New York','21','Male','Single','Dual Citizen',9814573889,7,6,1,1,'magtalascarlson@gmail.com','2023-5448','Magtalas__Carlsonid_pic.jpg','17:20:25','2023-08-11'),(2,'Active','Robbie','San Nicolas','Magtalas','','Robbie San Nicolas Magtalas','2002-04-27','New York','21','Male','Single','Dual Citizen',9163432459,7,6,1,1,'robbiemagtalas@gmail.com','2023-4757','Robbie_San Nicolas_Magtalasid_pic.jpg','17:55:54','2023-08-11'),(3,'Inactive','Magtalas','San Nicolas','Magtalas','','Magtalas San Nicolas Magtalas','1950-02-04','New York','73','Male','Single','Dual Citizen',9814573889,2,1,1,1,'magtalascarlson@gmail.com','2023-8757','Magtalas_San Nicolas_Magtalasid_pic.jpg','09:37:37','2023-08-12');
/*!40000 ALTER TABLE `emp_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_tbl`
--

DROP TABLE IF EXISTS `event_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_tbl` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `type_id` int NOT NULL,
  `event_date` varchar(155) DEFAULT NULL,
  `event_time` varchar(155) DEFAULT NULL,
  `senior_id` int NOT NULL,
  `attend_event` varchar(155) DEFAULT NULL,
  `claim_event` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  KEY `type_id_idx` (`type_id`),
  KEY `senior_id_idx` (`senior_id`),
  CONSTRAINT `senior_id` FOREIGN KEY (`senior_id`) REFERENCES `senior_tbl` (`senior_id`),
  CONSTRAINT `type_id` FOREIGN KEY (`type_id`) REFERENCES `type_tbl` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_tbl`
--

LOCK TABLES `event_tbl` WRITE;
/*!40000 ALTER TABLE `event_tbl` DISABLE KEYS */;
INSERT INTO `event_tbl` VALUES (1,2,'2023-08-20','09:51',1,'Has not attended',NULL),(2,2,'2023-08-20','09:51',2,'Has not attended',NULL),(3,2,'2023-08-20','10:00',1,'Has not attended','Has not been claimed'),(4,2,'2023-08-20','10:00',2,'Has not attended','Has not been claimed'),(5,2,'2023-08-20','11:20',1,'Has not attended','Has not been claimed'),(6,2,'2023-08-20','11:20',2,'Has not attended','Has not been claimed');
/*!40000 ALTER TABLE `event_tbl` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `municipality_tbl`
--

LOCK TABLES `municipality_tbl` WRITE;
/*!40000 ALTER TABLE `municipality_tbl` DISABLE KEYS */;
INSERT INTO `municipality_tbl` VALUES (1,'San Isidro');
/*!40000 ALTER TABLE `municipality_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tbl`
--

DROP TABLE IF EXISTS `post_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tbl` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `emp_id` int DEFAULT NULL,
  `admin_id` int DEFAULT NULL,
  `event_type_id` int NOT NULL,
  `post_description` varchar(500) DEFAULT NULL,
  `post_pic` varchar(255) DEFAULT NULL,
  `post_date` date NOT NULL,
  `post_time` time NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `post_loc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `emp_id_idx` (`emp_id`),
  KEY `admin_id_idx` (`admin_id`),
  KEY `type_id_idx` (`event_type_id`),
  CONSTRAINT `admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin_tbl` (`admin_id`),
  CONSTRAINT `emp_id` FOREIGN KEY (`emp_id`) REFERENCES `emp_tbl` (`emp_id`),
  CONSTRAINT `event_type_id` FOREIGN KEY (`event_type_id`) REFERENCES `type_tbl` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tbl`
--

LOCK TABLES `post_tbl` WRITE;
/*!40000 ALTER TABLE `post_tbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_tbl` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `province_tbl`
--

LOCK TABLES `province_tbl` WRITE;
/*!40000 ALTER TABLE `province_tbl` DISABLE KEYS */;
INSERT INTO `province_tbl` VALUES (1,'Nueva Ecija');
/*!40000 ALTER TABLE `province_tbl` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `purok_tbl`
--

LOCK TABLES `purok_tbl` WRITE;
/*!40000 ALTER TABLE `purok_tbl` DISABLE KEYS */;
INSERT INTO `purok_tbl` VALUES (1,'#1'),(2,'#2'),(3,'#3'),(4,'#4'),(5,'#5'),(6,'#6'),(7,'#7'),(8,'#8'),(9,'#9'),(10,'#10');
/*!40000 ALTER TABLE `purok_tbl` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_tbl`
--

LOCK TABLES `request_tbl` WRITE;
/*!40000 ALTER TABLE `request_tbl` DISABLE KEYS */;
INSERT INTO `request_tbl` VALUES (1,'Carlson','San Nicolas','Magtalas',NULL,'1950-04-02','New York','Male','Single','Dual Citizen',1,1,1,1,'asdfadf','asdfsafds',9163432459,'magtalas@gmail.com',75,'2023-04-02','13:00:00');
/*!40000 ALTER TABLE `request_tbl` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `senior_log`
--

LOCK TABLES `senior_log` WRITE;
/*!40000 ALTER TABLE `senior_log` DISABLE KEYS */;
INSERT INTO `senior_log` VALUES (1,'Carlson San Nicolas Magtalas','2023-08-10','07:37:33',NULL,NULL,1,'775845'),(2,'Carlson San Nicolas Magtalas','2023-08-13','21:06:43','2023-08-13','21:38:45',1,'115133'),(3,'Carlson San Nicolas Magtalas','2023-08-13','21:39:18','2023-08-13','21:39:32',1,'108592'),(4,'Carlson San Nicolas Magtalas','2023-08-13','21:40:12','2023-08-13','21:41:44',1,'873686'),(5,'Carlson San Nicolas Magtalas','2023-08-13','21:42:17','2023-08-13','21:42:39',1,'374813'),(6,'Carlson San Nicolas Magtalas','2023-08-22','14:35:22','2023-08-22','14:36:07',1,'325276'),(7,'Carlson San Nicolas Magtalas','2023-08-22','14:37:39','2023-08-22','17:18:42',1,'696462'),(8,'Carlson San Nicolas Magtalas','2023-08-22','19:58:43','2023-08-22','21:57:26',1,'391758'),(9,'Carlson San Nicolas Magtalas','2023-08-23','15:49:33','2023-08-23','15:49:41',1,'206739');
/*!40000 ALTER TABLE `senior_log` ENABLE KEYS */;
UNLOCK TABLES;

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
  `age` varchar(100) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `civil_status` varchar(100) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `cell_no` bigint NOT NULL,
  `senior_purok_id` int NOT NULL,
  `senior_barangay_id` int NOT NULL,
  `senior_municipality_id` int NOT NULL,
  `senior_province_id` int NOT NULL,
  `senior_email` varchar(255) NOT NULL,
  `senior_password` varchar(255) NOT NULL,
  `qr_image` varchar(255) NOT NULL,
  `id_pic` varchar(255) NOT NULL,
  `birth_certificate` varchar(255) NOT NULL,
  `account_time` time NOT NULL,
  `account_date` date NOT NULL,
  `qr_contents` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`senior_id`),
  KEY `purok_id_idx` (`senior_purok_id`),
  KEY `senior_barangay_id_idx` (`senior_barangay_id`),
  KEY `senior_municipality_id_idx` (`senior_municipality_id`),
  KEY `senior_province_id_idx` (`senior_province_id`),
  CONSTRAINT `senior_barangay_id` FOREIGN KEY (`senior_barangay_id`) REFERENCES `barangay_tbl` (`barangay_id`),
  CONSTRAINT `senior_municipality_id` FOREIGN KEY (`senior_municipality_id`) REFERENCES `municipality_tbl` (`municipality_id`),
  CONSTRAINT `senior_province_id` FOREIGN KEY (`senior_province_id`) REFERENCES `province_tbl` (`province_id`),
  CONSTRAINT `senior_purok_id` FOREIGN KEY (`senior_purok_id`) REFERENCES `purok_tbl` (`purok_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `senior_tbl`
--

LOCK TABLES `senior_tbl` WRITE;
/*!40000 ALTER TABLE `senior_tbl` DISABLE KEYS */;
INSERT INTO `senior_tbl` VALUES (1,'Inactive','Carlson San Nicolas Magtalas','Carlson','San Nicolas','Magtalas','','1960-02-04','New York','65','Male','Single','Dual Citizen',9163432459,7,6,1,1,'carlsonmagtalas@gmail.com','2023-2662','64d8d209c899a20230813.png','Carlson_San Nicolas_Magtalasid_pic.jpg','Carlson_San Nicolas_Magtalasbirth_cert.jpg','20:52:25','2023-08-13','senior64d8d209c89739.42890703'),(2,'Inactive','Robbie San Nicolas Magtalas','Robbie','San Nicolas','Magtalas',NULL,'1960-04-04','New York','65','Male','Single','Dual Citizen ',9184573889,7,6,1,1,'robbie@gmail.com','2023-2663','64d8d209c899a20230813.png','Carlson_San Nicolas_Magtalasid_pic.jpg','Carlson_San Nicolas_Magtalasbirth_cert.jpg','20:52:25','2023-08-13','senior64d8d209c89739.42890703'),(3,'Inactive','Daniel Binuya Taberna','Daniel','Binuya','Taberna','','1960-09-16','Philippines','62','Male','Single','Filipino',9122343456,1,1,1,1,'taberna@gmail.com','2023-9774','64e406eed4a1f20230822.png','Daniel_Binuya_Tabernaid_pic.jpg','Daniel_Binuya_Tabernabirth_cert.jpg','08:53:02','2023-08-22','senior64e406eed4a122.10385643'),(11,'Inactive','Another  Cat','Another','','Cat','','1950-02-04','Philippines','73','Rather not say','Single','Dual Citizen',9873451234,9,3,1,1,'emwail@gmail.com','2023-2293','64e549376690220230823.png','Another__Catid_pic.jpg','Another__Catbirth_cert.jpg','07:48:07','2023-08-23','senior64e54937668f75.16531810'),(12,'Inactive','Raymond The Spaymond','Raymond','The','Spaymond','Jr.','1950-04-02','City of Meow','73','Rather not say','Married','Meowtizen',9163432459,2,2,1,1,'RaymondSpaymond@gmail.com','2023-4741','64e54a94d17b620230823.png','Raymond_The_Spaymondid_pic.jpg','Raymond_The_Spaymondbirth_cert.jpg','07:53:56','2023-08-23','senior64e54a94d17ad4.32971401'),(13,'Inactive','Spraymond The Cat','Spraymond','The','Cat','Extension','1950-02-04','Philippines','73','Male','Single','Filipino',9711231234,2,3,1,1,'fasdfs@gmail.com','2023-5409','64e959b340d5520230826.png','Spraymond_The_Catid_pic.jpg','Spraymond_The_Catbirth_cert.jpg','09:47:30','2023-08-26','senior64e959b340d441.75937595');
/*!40000 ALTER TABLE `senior_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_tbl`
--

DROP TABLE IF EXISTS `type_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_tbl` (
  `type_id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_tbl`
--

LOCK TABLES `type_tbl` WRITE;
/*!40000 ALTER TABLE `type_tbl` DISABLE KEYS */;
INSERT INTO `type_tbl` VALUES (1,'Recreational Event'),(2,'Claim Pensions'),(3,'Health Related Event'),(4,'Announcement');
/*!40000 ALTER TABLE `type_tbl` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-30 17:39:07
