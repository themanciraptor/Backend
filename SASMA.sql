
-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: SASMA
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `College`
--

DROP TABLE IF EXISTS `College`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `College` (
  `college_id` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`college_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `College`
--

LOCK TABLES `College` WRITE;
/*!40000 ALTER TABLE `College` DISABLE KEYS */;
INSERT INTO `College` VALUES ('MacU','MacEwan University','10700 - 104 104 Avenue, Edmonton, AB','2018-11-17 22:34:16','2018-11-17 22:34:16',NULL);
INSERT INTO `College` VALUES ('McGillU','McGill University','845 Sherbrooke Street West, Montreal, Quebec','2018-11-17 22:35:43','2018-11-17 22:35:43',NULL);
INSERT INTO `College` VALUES ('UofR','University of Regina','3737 Wascana Parkway, Regina, SK','2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
INSERT INTO `College` VALUES ('UofS','University of Saskatchewan','105 Administration Place, Saskatoon, SK','2018-11-17 22:31:43','2018-11-17 22:31:43',NULL);
/*!40000 ALTER TABLE `College` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Student` (
  `student_id` varchar(45) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `Student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Student`
--

LOCK TABLES `Student` WRITE;
/*!40000 ALTER TABLE `Student` DISABLE KEYS */;
INSERT INTO `Student` VALUES ('200303299','st-000001','Carl','Marks','redsocs@rus.com','Brückengasse 664','2018-11-17 17:29:26','2018-11-17 17:29:26',NULL);
INSERT INTO `Student` VALUES ('200361084','jw200','Jonah','Wrubleski','jjwrubleski21@gmail.com','Ma house','2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
/*!40000 ALTER TABLE `Student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StudentTermData`
--

DROP TABLE IF EXISTS `StudentTermData`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `StudentTermData` (
  `student_term_data_id` varchar(45) NOT NULL,
  `college_id` varchar(45) NOT NULL,
  `student_id` varchar(45) NOT NULL,
  `enrollment_status` varchar(45) NOT NULL,
  `term` varchar(45) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`student_term_data_id`),
  KEY `college_id2_idx` (`college_id`),
  KEY `id_idx` (`student_id`),
  CONSTRAINT `id` FOREIGN KEY (`college_id`) REFERENCES `College` (`college_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StudentTermData`
--

LOCK TABLES `StudentTermData` WRITE;
/*!40000 ALTER TABLE `StudentTermData` DISABLE KEYS */;
INSERT INTO `StudentTermData` VALUES ('randomid','UofS','200361084','Pending','Winter/2018','2018-11-17 17:24:32','2018-11-17 17:24:32',NULL);
INSERT INTO `StudentTermData` VALUES ('randomid2','MacU','200303299','Enrolled','Fall/2018','2018-11-17 17:30:33','2018-11-17 17:30:33',NULL);
INSERT INTO `StudentTermData` VALUES ('student_id_200361084','UofR','','Enrolled','Fall/2018','2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
/*!40000 ALTER TABLE `StudentTermData` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `user_id` varchar(30) NOT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `is_admin` tinyint(4) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES ('jw200','$2y$10$zPkDVvo0pdpfWXySkJGGXedX6Emr0.eMWdI6mAjDJDYGGV6I1j2EO','jjwrubleski21@gmail.com',0,'2018-11-18 12:19:53','2018-11-18 12:19:53',NULL);
INSERT INTO `User` VALUES ('st-000001',NULL,'redsocs@rus.com',NULL,'2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-18 13:56:24
=======
-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: SASMA
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `College`
--

DROP TABLE IF EXISTS `College`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `College` (
  `college_id` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`college_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `College`
--

LOCK TABLES `College` WRITE;
/*!40000 ALTER TABLE `College` DISABLE KEYS */;
INSERT INTO `College` VALUES ('MacU','MacEwan University','10700 - 104 104 Avenue, Edmonton, AB','2018-11-17 22:34:16','2018-11-17 22:34:16',NULL);
INSERT INTO `College` VALUES ('McGillU','McGill University','845 Sherbrooke Street West, Montreal, Quebec','2018-11-17 22:35:43','2018-11-17 22:35:43',NULL);
INSERT INTO `College` VALUES ('UofR','University of Regina','3737 Wascana Parkway, Regina, SK','2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
INSERT INTO `College` VALUES ('UofS','University of Saskatchewan','105 Administration Place, Saskatoon, SK','2018-11-17 22:31:43','2018-11-17 22:31:43',NULL);
/*!40000 ALTER TABLE `College` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Student` (
  `student_id` varchar(45) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `Student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Student`
--

LOCK TABLES `Student` WRITE;
/*!40000 ALTER TABLE `Student` DISABLE KEYS */;
INSERT INTO `Student` VALUES ('200303299','st-000001','Carl','Marks','redsocs@rus.com','Brückengasse 664','2018-11-17 17:29:26','2018-11-17 17:29:26',NULL);
INSERT INTO `Student` VALUES ('200361084','jw200','Jonah','Wrubleski','jjwrubleski21@gmail.com','Ma house','2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
/*!40000 ALTER TABLE `Student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `StudentTermData`
--

DROP TABLE IF EXISTS `StudentTermData`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `StudentTermData` (
  `student_term_data_id` varchar(45) NOT NULL,
  `college_id` varchar(45) NOT NULL,
  `student_id` varchar(45) NOT NULL,
  `enrollment_status` varchar(45) NOT NULL,
  `term` varchar(45) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`student_term_data_id`),
  KEY `college_id2_idx` (`college_id`),
  KEY `id_idx` (`student_id`),
  CONSTRAINT `id` FOREIGN KEY (`college_id`) REFERENCES `College` (`college_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `StudentTermData`
--

LOCK TABLES `StudentTermData` WRITE;
/*!40000 ALTER TABLE `StudentTermData` DISABLE KEYS */;
INSERT INTO `StudentTermData` VALUES ('randomid','UofS','200361084','Pending','Winter/2018','2018-11-17 17:24:32','2018-11-17 17:24:32',NULL);
INSERT INTO `StudentTermData` VALUES ('randomid2','MacU','200303299','Enrolled','Fall/2018','2018-11-17 17:30:33','2018-11-17 17:30:33',NULL);
INSERT INTO `StudentTermData` VALUES ('student_id_200361084','UofR','','Enrolled','Fall/2018','2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
/*!40000 ALTER TABLE `StudentTermData` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `user_id` varchar(30) NOT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `is_admin` tinyint(4) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES ('jw200','$2y$10$zPkDVvo0pdpfWXySkJGGXedX6Emr0.eMWdI6mAjDJDYGGV6I1j2EO','jjwrubleski21@gmail.com',0,'2018-11-18 12:19:53','2018-11-18 12:19:53',NULL);
INSERT INTO `User` VALUES ('st-000001',NULL,'redsocs@rus.com',NULL,'2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-18 13:56:24
