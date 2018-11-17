-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: SASMA_test
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
INSERT INTO `College` VALUES ('UofR','University of Regina','3737 Wascana Parkway','2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
/*!40000 ALTER TABLE `College` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Student`
--

DROP TABLE IF EXISTS `Student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Student` (
  `student_id` varchar(20) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Student`
--

LOCK TABLES `Student` WRITE;
/*!40000 ALTER TABLE `Student` DISABLE KEYS */;
INSERT INTO `Student` VALUES ('200361084','','Jonah','Wrubleski','jjwrubleski21@gmail.com','Ma house','3062318046','2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
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
INSERT INTO `StudentTermData` VALUES ('student_id_200361084','UofR','','Enrolled','Fall/2018','2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
/*!40000 ALTER TABLE `StudentTermData` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TestTable`
--

DROP TABLE IF EXISTS `TestTable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TestTable` (
  `int_field` int(11) DEFAULT NULL,
  `string_field` varchar(255) DEFAULT NULL,
  `date_field` date DEFAULT NULL,
  `test_name` varchar(511) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TestTable`
--

LOCK TABLES `TestTable` WRITE;
/*!40000 ALTER TABLE `TestTable` DISABLE KEYS */;
INSERT INTO `TestTable` VALUES (1,'t1','2017-01-01','CanIterateOverMultiRowResponse');
INSERT INTO `TestTable` VALUES (2,'t2','2017-02-01','CanIterateOverMultiRowResponse');
INSERT INTO `TestTable` VALUES (3,'t4','2017-03-01','CanIterateOverMultiRowResponse');
INSERT INTO `TestTable` VALUES (55,'turnaroundbrighteyes','2018-03-01','CanUseListsForQueryParams');
/*!40000 ALTER TABLE `TestTable` ENABLE KEYS */;
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
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES ('5bef72f43156f','$2y$10$A5pjWkM0Ervtrpn4uScDZ.mMENOym60In/jKVp1dYN1j1ySMJy1uO','seconds@hotmeal.com',0,'2018-11-17 07:46:28','2018-11-17 07:46:28',NULL);
INSERT INTO `User` VALUES ('5bef735848aeb','$2y$10$EV72ghljHPCJSikpj9fGyuy/5/GmaSlzv7pYShgV71sMxOcq66506','seconds@hotmeal.com',0,'2018-11-17 07:48:08','2018-11-17 07:48:08',NULL);
INSERT INTO `User` VALUES ('5bef73db50b1e','$2y$10$dt9t/JZmQ4c5I7fuYYfXqeERU.g8oJ8UckatQpQGB7L0/gf4NtVy6','seconds@hotmeal.com',0,'2018-11-17 07:50:19','2018-11-17 07:50:19',NULL);
INSERT INTO `User` VALUES ('5bef73f54206c','$2y$10$xOpzrmzwgiaMjgn7i3fM.epMmGZbSIdP3d8piI5uyri0vYUEOzPtW','seconds@hotmeal.com',0,'2018-11-17 07:50:45','2018-11-17 07:50:45',NULL);
INSERT INTO `User` VALUES ('5bef74265ca9c','$2y$10$kvj997XbodNEhx.ECiehneQv0N3axmL3am.ymVLRm8fsQuNzkU5JO','seconds@hotmeal.com',0,'2018-11-17 07:51:34','2018-11-17 07:51:34',NULL);
INSERT INTO `User` VALUES ('5bef7472e046a','$2y$10$8llg6mFzRyo8h9Pd0rC72uqVR8hPSsEfdHv6Ff9fbAB5q5X/BHiOW','seconds@hotmeal.com',0,'2018-11-17 07:52:50','2018-11-17 07:52:50',NULL);
INSERT INTO `User` VALUES ('5bef74c815b01','$2y$10$wzy6bryJq469vHZkr6y.au6uZ1NKhdIlCc8GYPBdBeqaxNLfZfr6e','seconds@hotmeal.com',0,'2018-11-17 07:54:16','2018-11-17 07:54:16',NULL);
INSERT INTO `User` VALUES ('5bef74e81436d','$2y$10$qRk33lKBT.APC6JsIVe5luyI14urQCHB0uMVkYKKynnuCZ5w4ippW','seconds@hotmeal.com',0,'2018-11-17 07:54:48','2018-11-17 07:54:48',NULL);
INSERT INTO `User` VALUES ('5bef7501b9491','$2y$10$xONSRTwnTmx2K6L5H7OlF.wHAIaq/vYWYZ9Q5ynZY1uL4oWp6hEum','seconds@hotmeal.com',0,'2018-11-17 07:55:13','2018-11-17 07:55:13',NULL);
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

-- Dump completed on 2018-11-16 19:58:04
