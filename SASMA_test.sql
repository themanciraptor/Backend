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
INSERT INTO `College` VALUES ('MacU','MacEwan University','10700 - 104 104 Avenue, Edmonton, AB','2018-11-17 16:34:16','2018-11-17 16:34:16',NULL);
INSERT INTO `College` VALUES ('McGillU','McGill University','845 Sherbrooke Street West, Montreal, Quebec','2018-11-17 16:35:43','2018-11-17 16:35:43',NULL);
INSERT INTO `College` VALUES ('UofR','University of Regina','3737 Wascana Parkway, Regina, SK','2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
INSERT INTO `College` VALUES ('UofS','University of Saskatchewan','105 Administration Place, Saskatoon, SK','2018-11-17 16:31:43','2018-11-17 16:31:43',NULL);
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
INSERT INTO `Student` VALUES ('200303299','st-000001','Carl','Marks','redsocs@rus.com','Brückengasse 664','2018-11-17 23:29:26','2018-11-17 23:29:26',NULL);
INSERT INTO `Student` VALUES ('200361084','testid','Jonah','Wrubleski','jjwrubleski21@gmail.com','Ma house','2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
INSERT INTO `Student` VALUES ('500XXX','','Evening','Star','Elendil@mirk.ru','1 dead balrog','2018-11-17 17:52:58','2018-11-17 17:52:58',NULL);
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
INSERT INTO `StudentTermData` VALUES ('randomid','UofS','200361084','Pending','Winter/2018','2018-11-17 23:24:32','2018-11-17 23:24:32',NULL);
INSERT INTO `StudentTermData` VALUES ('randomid2','MacU','200303299','Enrolled','Fall/2018','2018-11-17 23:30:33','2018-11-17 23:30:33',NULL);
INSERT INTO `StudentTermData` VALUES ('student_id_200361084','UofR','200361084','Enrolled','Fall/2018','2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
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
INSERT INTO `User` VALUES ('5bf0c38268fa0','$2y$10$OKYbIIWOT/EErkCF4Qe4..5fKgJ7YLiZd4m57MSF0n7LyIHRja/l6','seconds@hotmeal.com',0,'2018-11-18 07:42:26','2018-11-18 07:42:26',NULL);
INSERT INTO `User` VALUES ('5bf0c4a427ed8','$2y$10$GgFNk/k3rKRJ4J0pbBm2beJKRGBZO/YTjsc2LLQ2U7ev8N8d4YBGW','seconds@hotmeal.com',0,'2018-11-18 07:47:16','2018-11-18 07:47:16',NULL);
INSERT INTO `User` VALUES ('5bf0c4beac8b7','$2y$10$C7Qf.xSDDRBia7S/Ke2pteoHXbwBSHjKLfpH4dsUreia15G4h7t3i','seconds@hotmeal.com',0,'2018-11-18 07:47:42','2018-11-18 07:47:42',NULL);
INSERT INTO `User` VALUES ('5bf0c66001e81','$2y$10$Lpw67mkezmmytImeyjx/DOSoj49sYRbrBl0fIjIfjTu6pkYwUa6GW','seconds@hotmeal.com',0,'2018-11-18 07:54:40','2018-11-18 07:54:40',NULL);
INSERT INTO `User` VALUES ('5bf0c686c93d6','$2y$10$UAlcyAga13GnT/mDQSpom.xHrCe3Wp09QMgmRqBUqmidDOf5G87Li','seconds@hotmeal.com',0,'2018-11-18 07:55:18','2018-11-18 07:55:18',NULL);
INSERT INTO `User` VALUES ('5bf0c69331287','$2y$10$PUKbd0zXXeOdcawerhsXZu899RqbFW5nvVGAtaLldKtGud4kNxj7m','seconds@hotmeal.com',0,'2018-11-18 07:55:31','2018-11-18 07:55:31',NULL);
INSERT INTO `User` VALUES ('5bf0c69fa1706','$2y$10$.zMnj2tPiFyYwFcALA2jX.eFOCJYOUYJULSQBjrBT5SN906Burkiy','seconds@hotmeal.com',0,'2018-11-18 07:55:43','2018-11-18 07:55:43',NULL);
INSERT INTO `User` VALUES ('5bf0c6bd87ac9','$2y$10$XeS8BaHI.yhqovsTG2nloeKDhuqLFh9pc63cKFd3/a2TkfcKnKfYi','seconds@hotmeal.com',0,'2018-11-18 07:56:13','2018-11-18 07:56:13',NULL);
INSERT INTO `User` VALUES ('5bf0c90eb6690','$2y$10$q1ldbq8K/qMW5XS5xwayJu9.5uDa1dOjnwdkx/HeuPZ.aFIfCpavK','seconds@hotmeal.com',0,'2018-11-18 08:06:06','2018-11-18 08:06:06',NULL);
INSERT INTO `User` VALUES ('5bf0c9370d9ba','$2y$10$0TdFWJKuD1mBT/mXD7ZQAe05o2xn19zqhJ5L2Zr8AnXrx418c0Ry6','seconds@hotmeal.com',0,'2018-11-18 08:06:47','2018-11-18 08:06:47',NULL);
INSERT INTO `User` VALUES ('5bf0c99306bd6','$2y$10$D8JBdo/SweNshSn1qSFp7Oab1568vA2ro23ouK4Zmo.CpDlCXxhi.','seconds@hotmeal.com',0,'2018-11-18 08:08:19','2018-11-18 08:08:19',NULL);
INSERT INTO `User` VALUES ('5bf0c9c534bb5','$2y$10$4TIEg37rkpUUSau05ArXQO8Ko2m2U1aWrVfOJY098hM1EGnHTo7QC','seconds@hotmeal.com',0,'2018-11-18 08:09:09','2018-11-18 08:09:09',NULL);
INSERT INTO `User` VALUES ('5bf0cb3f9fc56','$2y$10$3q.wymdQmfcQGWTHLxIp2e8i7z7fyiTYiq3qeZkLwDnQc/GUoGSnC','seconds@hotmeal.com',0,'2018-11-18 08:15:27','2018-11-18 08:15:27',NULL);
INSERT INTO `User` VALUES ('5bf0cb5556d5d','$2y$10$tcVyLqWS0SOfJVuxsbBDoeuNT2F8YW7XsKzxHzhKRnneBR3WAkKPm','seconds@hotmeal.com',0,'2018-11-18 08:15:49','2018-11-18 08:15:49',NULL);
INSERT INTO `User` VALUES ('5bf0cb94a7b2d','$2y$10$RrT6PX0gQimX23D2FzjGw.rBUGnNny66fYr.KGXARHU160YILXn.K','seconds@hotmeal.com',0,'2018-11-18 08:16:52','2018-11-18 08:16:52',NULL);
INSERT INTO `User` VALUES ('5bf0cc439b6c3','$2y$10$NqY1Z3n16H6wkrdlOcJJL..CisdKicBT3uvsWSKHcjv6uuHpwB/iC','seconds@hotmeal.com',0,'2018-11-18 08:19:47','2018-11-18 08:19:47',NULL);
INSERT INTO `User` VALUES ('5bf0ccc558e41','$2y$10$8Cs38y2btuqgMk1zhZCXp.68UqAcJPqON4Y7.GY2JK/KsL/c/HFt.','seconds@hotmeal.com',0,'2018-11-18 08:21:57','2018-11-18 08:21:57',NULL);
INSERT INTO `User` VALUES ('5bf0cd26bce1b','$2y$10$vITqQa3S53Waiku0bZMs.u9rb2NDTC4fC5cQN6I1V5tu2voXtrBsC','seconds@hotmeal.com',0,'2018-11-18 08:23:34','2018-11-18 08:23:34',NULL);
INSERT INTO `User` VALUES ('5bf0cd3bd1dc5','$2y$10$apSiit3orui.Vsn67Nmw5Ofb/QTMsIFWUuOqdUFZH2qcCd.qJxfWG','seconds@hotmeal.com',0,'2018-11-18 08:23:55','2018-11-18 08:23:55',NULL);
INSERT INTO `User` VALUES ('5bf0cd720394b','$2y$10$IaZvAyJWjQRTrAvboSA2meA3LkmQZ1x2XHVzsrp.po7TLr9AxjHB2','seconds@hotmeal.com',0,'2018-11-18 08:24:50','2018-11-18 08:24:50',NULL);
INSERT INTO `User` VALUES ('5bf0cde9bcb0c','$2y$10$y2SMrktlPgK0OVsvWw6hOu4g3OLsKTP8mmL/zjViekh3ejrfVmNme','firsts@hotmeal.com',0,'2018-11-18 08:26:49','2018-11-18 08:26:49',NULL);
INSERT INTO `User` VALUES ('5bf0ce4ba3fab','$2y$10$L3/SXeQCyIKr5LvdxCoQW.oYZ4yaDQtDy/aPOaG8epfcySJwuPqKO','firsts@hotmeal.com',0,'2018-11-18 08:28:27','2018-11-18 08:28:27',NULL);
INSERT INTO `User` VALUES ('5bf0cede96b76','$2y$10$qE/cwYY3t020kaVszjqVfOILIoCpwj1/UgqPz9/uWUOEnPiitVgtK','firsts@hotmeal.com',0,'2018-11-18 08:30:54','2018-11-18 08:30:54',NULL);
INSERT INTO `User` VALUES ('5bf0ceef5ddc5','$2y$10$5WklZ1u4fh9XtrsnK5b3Vup/5F0EEa1bgvy7AxWb52LNdD5iW0wtu','firsts@hotmeal.com',0,'2018-11-18 08:31:11','2018-11-18 08:31:11',NULL);
INSERT INTO `User` VALUES ('5bf0cefa3f532','$2y$10$6aqdDwPjYZAbIzIXdbWE1O6quzfP6McH/eJ/9BV6rXowx7BovaPDK','firsts@hotmeal.com',0,'2018-11-18 08:31:22','2018-11-18 08:31:22',NULL);
INSERT INTO `User` VALUES ('5bf0d0431e96d','$2y$10$wtTDVoEfmmKwl0bSnRpa.Obpu68NIjdcieMieThqHYx4cNYlVYBPu','seconds@hotmeal.com',0,'2018-11-18 08:36:51','2018-11-18 08:36:54',NULL);
INSERT INTO `User` VALUES ('5bf0d05d42c6f','$2y$10$WMx6BOsx1a1RozAXFdYG2efJcI84hM.fF0p5MWJH7epv/V5V58k2W','seconds@hotmeal.com',0,'2018-11-18 08:37:17','2018-11-18 08:37:20',NULL);
INSERT INTO `User` VALUES ('5bf0d074ca3cc','$2y$10$eJQwX30dv9qVxAr/BFlH2u4uUfXT1yoVl0WSAZjb28XRV4mMBolJC','seconds@hotmeal.com',0,'2018-11-18 08:37:40','2018-11-18 08:37:43',NULL);
INSERT INTO `User` VALUES ('5bf0d10b22ec8','$2y$10$sDEK3cfUb0b4TlUkt6h.9e9QGnBBrNWpiQEJXQPFByLGSHmJjWbRu','seconds@hotmeal.com',0,'2018-11-18 08:40:11','2018-11-18 08:40:14',NULL);
INSERT INTO `User` VALUES ('5bf0d13a783a9','$2y$10$fFDCF4Unkp3YWqcltiWPfO5M9zXTOl8cz.YZ.BmSk8pTuyiD7qBEW','seconds@hotmeal.com',0,'2018-11-18 08:40:58','2018-11-18 08:41:01',NULL);
INSERT INTO `User` VALUES ('5bf0d1e931969','$2y$10$ptbXHVDEIsZB2QMXUFbmO.Plh71VT9AiT/UMH1S/xyBkVsQ2z0fke','seconds@hotmeal.com',0,'2018-11-18 08:43:53','2018-11-18 08:43:56',NULL);
INSERT INTO `User` VALUES ('5bf0d23033be3','$2y$10$AhlVIwfTlL5ryodq5SfpEuQyAzXuc7e8Otv0sp5XLcGav.WQ4aKY.','seconds@hotmeal.com',0,'2018-11-18 08:45:04','2018-11-18 08:45:07',NULL);
INSERT INTO `User` VALUES ('5bf0d237ad3d9','$2y$10$4dPNdwM12WLNSSCWYuh5NuutT7tTVxbAGhp.AL3R/NdQM5RvV3.h6','seconds@hotmeal.com',0,'2018-11-18 08:45:11','2018-11-18 08:45:14',NULL);
INSERT INTO `User` VALUES ('5bf0d2dbe8a37','$2y$10$Hhmhjv2m4ePzsf6q5UMlNub69yelVKmSNDqf2mgmhHFpilIguW.42','seconds@hotmeal.com',0,'2018-11-18 08:47:55','2018-11-18 08:47:55',NULL);
INSERT INTO `User` VALUES ('5bf0d3104564a','$2y$10$Yo4Irc0cI/EtmJlE2RJKfOZRBtCn6TOcFa1MyJrtvqvhqCwE2bQ9K','seconds@hotmeal.com',0,'2018-11-18 08:48:48','2018-11-18 08:48:51',NULL);
INSERT INTO `User` VALUES ('5bf0d32bb934a','$2y$10$2N6c.IXf28SDbrS.uXvw5elwPQn/FNsWPcSuTSbBG0lfyV7qgJfri','seconds@hotmeal.com',0,'2018-11-18 08:49:15','2018-11-18 08:49:18',NULL);
INSERT INTO `User` VALUES ('5bf0d36739a4e','$2y$10$JrUdYGlX8Os647aTstp6gewuIUHt5y.OMnhvmn9QRMyTRyVLsQ71a','seconds@hotmeal.com',0,'2018-11-18 08:50:15','2018-11-18 08:50:18',NULL);
INSERT INTO `User` VALUES ('5bf0d3968e6ce','$2y$10$ma5z6pv4HnY91ujAHRPOd.VUVOM6qzvGuK/dJ6o1GAy7o0uGha1du','seconds@hotmeal.com',0,'2018-11-18 08:51:02','2018-11-18 08:51:05',NULL);
INSERT INTO `User` VALUES ('5bf0d4515d9a2','$2y$10$TDjUAwSh4c7KeIt/suZoou2qesERJBVI18.Ub2YCTGAOEi7mYF18W','seconds@hotmeal.com',0,'2018-11-18 08:54:09','2018-11-18 08:54:12',NULL);
INSERT INTO `User` VALUES ('5bf0d465832f0','$2y$10$G/3w4P6fK7U8xsVuoVCGHewVMUOHfpUTnAj3q2/TUa7dpOO8TQX5K','seconds@hotmeal.com',0,'2018-11-18 08:54:29','2018-11-18 08:54:32',NULL);
INSERT INTO `User` VALUES ('5bf0d4d4c22d5','$2y$10$oTt604RZ3fMlQTXX6udKGOWe0rExvYaURJNUuKcfWH1KGeOL4OPAy','seconds@hotmeal.com',0,'2018-11-18 08:56:20','2018-11-18 08:56:23',NULL);
INSERT INTO `User` VALUES ('5bf0d75f3ba26','newpassword','seconds@hotmeal.com',0,'2018-11-18 09:07:11','2018-11-18 09:07:14',NULL);
INSERT INTO `User` VALUES ('5bf0d7996fa7c','newpassword','seconds@hotmeal.com',0,'2018-11-18 09:08:09','2018-11-18 09:08:12',NULL);
INSERT INTO `User` VALUES ('5bf0d7a70a791','newpassword','seconds@hotmeal.com',0,'2018-11-18 09:08:23','2018-11-18 09:08:26',NULL);
INSERT INTO `User` VALUES ('5bf0d7c48b1c3','newpassword','seconds@hotmeal.com',0,'2018-11-18 09:08:52','2018-11-18 09:08:55',NULL);
INSERT INTO `User` VALUES ('5bf0d8224ed2c','$2y$10$0fnRcT0LM43VIuxRWA1ba.XPPyoXJDcT7MQsk0UHJGnLWlEmYj/92','seconds@hotmeal.com',0,'2018-11-18 09:10:26','2018-11-18 09:10:26',NULL);
INSERT INTO `User` VALUES ('st-000001',NULL,'redsocs@rus.com',NULL,'2018-10-18 10:05:58','2018-10-18 10:05:58',NULL);
INSERT INTO `User` VALUES ('testid','$2y$10$35z4eRm2Mamv.NGKRF7Eq.ETp1GsF78DbIiZiXDh6S0j4v.Yi1G9a','jjwrubleski21@gmail.com',0,'2018-11-17 09:18:27','2018-11-17 09:18:27',NULL);
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

-- Dump completed on 2018-11-17 21:13:53
