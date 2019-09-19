-- MySQL dump 10.13  Distrib 8.0.17, for osx10.14 (x86_64)
--
-- Host: localhost    Database: lib_mgmt
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Book`
--

DROP TABLE IF EXISTS `Book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Book` (
  `book_no` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `book_name` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `author` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`book_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Book`
--

LOCK TABLES `Book` WRITE;
/*!40000 ALTER TABLE `Book` DISABLE KEYS */;
INSERT INTO `Book` VALUES ('B000001','Assembly Language Programming and Organization of the IBM PC','Ytha Yu, Charles Marut'),('B000002','Probability & Statistical Inference','Hogg, Tannis, Zimmerman'),('B000003','Software Engineering','Ian Somerville'),('B000004','Data Communication and Networking','Behrouz A. Forouzan'),('B000005','Software Engineering - A Practitioners Approach','Roger S. Pressman'),('B000006','Introduction to Graph Theory','Robin J. Wilson'),('B000007','Introduction to Algorithms','Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, Clifford Stein'),('B000008','Programming with C','Byron Gottfried'),('B000009','The C++ Programming Language','Bjarne Stroustrup'),('B000010','Computer Networks','Andrew S. Tanenbaum'),('B000011','The Art and Craft of Problem Solving','Paul Zeitz');
/*!40000 ALTER TABLE `Book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Iss_rec`
--

DROP TABLE IF EXISTS `Iss_rec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Iss_rec` (
  `iss_no` int(11) NOT NULL,
  `iss_date` date DEFAULT (curdate()),
  `mem_no` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `book_no` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`iss_no`),
  KEY `mem_no` (`mem_no`),
  KEY `book_no` (`book_no`),
  CONSTRAINT `iss_rec_ibfk_1` FOREIGN KEY (`mem_no`) REFERENCES `membership` (`mem_no`),
  CONSTRAINT `iss_rec_ibfk_2` FOREIGN KEY (`book_no`) REFERENCES `book` (`book_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Iss_rec`
--

LOCK TABLES `Iss_rec` WRITE;
/*!40000 ALTER TABLE `Iss_rec` DISABLE KEYS */;
INSERT INTO `Iss_rec` VALUES (1,'2019-07-30','190003','B000009'),(2,'2019-07-30','190002','B000001'),(3,'2019-07-30','190003','B000004'),(4,'2019-07-30','190004','B000005'),(5,'2019-07-31','190001','B000010'),(6,'2019-07-31','190002','B000002'),(7,'2019-08-06','190003','B000004'),(8,'2019-08-06','190006','B000009'),(9,'2019-08-06','190009','B000010'),(10,'2019-08-06','190010','B000011'),(11,'2019-08-01','190002','B000007');
/*!40000 ALTER TABLE `Iss_rec` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `iss_rec_book_limit` BEFORE INSERT ON `iss_rec` FOR EACH ROW BEGIN
	IF (SELECT COUNT(*) FROM Iss_rec WHERE Iss_rec.mem_no = NEW.mem_no) = 3 THEN
		SIGNAL SQLSTATE "40000" SET MESSAGE_TEXT='Student cannot borrow more than 3 books.';
	END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Membership`
--

DROP TABLE IF EXISTS `Membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Membership` (
  `mem_no` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `stud_no` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`mem_no`),
  KEY `stud_no` (`stud_no`),
  CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`stud_no`) REFERENCES `student` (`stud_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Membership`
--

LOCK TABLES `Membership` WRITE;
/*!40000 ALTER TABLE `Membership` DISABLE KEYS */;
INSERT INTO `Membership` VALUES ('190001','C033001'),('190002','C033002'),('190003','C033003'),('190004','C033004'),('190005','C033005'),('190006','C033006'),('190007','C033007'),('190008','C033008'),('190009','C033009'),('190010','C033010'),('190011','C033011');
/*!40000 ALTER TABLE `Membership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Student` (
  `stud_no` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `stud_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`stud_no`),
  CONSTRAINT `student_chk_1` CHECK ((`stud_no` like _utf8mb4'C%'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Student`
--

LOCK TABLES `Student` WRITE;
/*!40000 ALTER TABLE `Student` DISABLE KEYS */;
INSERT INTO `Student` VALUES ('C033001','MD. ABTAHI ISLAM'),('C033002','MD. MOSADDEK HOSSAIN'),('C033003','TANZIM PARVEJ'),('C033004','TANZILA HAQUE'),('C033005','ABDULLA AL AZAD'),('C033006','AJMAIN SAMI'),('C033007','NAZIFA TASNIM'),('C033008','MESBAHUL HAQUE'),('C033009','YOUSUF IQBAL'),('C033010','ARTI GOSH'),('C033011','AMINUL ISLAM'),('C033012','ANOTHER STUDENT');
/*!40000 ALTER TABLE `Student` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-18  8:24:30
