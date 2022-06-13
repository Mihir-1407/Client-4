-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: ta
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `lecture_entry`
--

-- DROP TABLE IF EXISTS `lecture_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lecture_entry` (
  `lec_id` int NOT NULL AUTO_INCREMENT,
  `tutor_id` int NOT NULL,
  `stu_id` int NOT NULL,
  `subject` varchar(30) NOT NULL,
  `sdate` date NOT NULL,
  `stime` time NOT NULL,
  `duration` int NOT NULL,
  `conducted` tinyint(1) NOT NULL DEFAULT '0',
  `payment` tinyint NOT NULL DEFAULT '0',
  `etime` time NOT NULL DEFAULT '07:27:00',
  PRIMARY KEY (`lec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecture_entry`
--

LOCK TABLES `lecture_entry` WRITE;
/*!40000 ALTER TABLE `lecture_entry` DISABLE KEYS */;
INSERT INTO `lecture_entry` VALUES (1,1,1,'PT','2022-06-12','08:30:00',2,1,0,'07:27:00'),(2,1,2,'PT','2022-06-12','10:30:00',3,1,0,'07:27:00'),(3,2,3,'Welding','2022-06-15','18:31:00',1,1,0,'07:27:00'),(4,3,4,'Singing','2022-06-13','11:37:00',3,1,0,'07:27:00'),(5,4,5,'Dancing','2022-06-17','14:34:00',2,1,0,'07:27:00'),(6,2,1,'welding','2022-06-20','09:35:00',3,1,0,'07:27:00'),(7,1,1,'PT','2022-06-06','18:47:00',2,0,0,'07:27:00'),(8,2,2,'Wedding','2022-06-07','11:47:00',2,0,0,'07:27:00'),(9,3,4,'Singing','2022-06-08','09:48:00',4,0,0,'07:27:00'),(10,3,6,'Singing','2022-06-09','13:59:00',2,1,0,'07:27:00'),(11,4,3,'Dancing','2022-06-01','14:00:00',3,1,0,'07:27:00'),(12,2,5,'Welding','2022-05-30','10:06:00',1,1,0,'07:27:00'),(13,2,2,'Welding','2022-06-12','09:20:00',2,1,0,'07:27:00');
/*!40000 ALTER TABLE `lecture_entry` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-11 20:56:33
