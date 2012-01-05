-- MySQL dump 10.13  Distrib 5.1.55, for redhat-linux-gnu (i386)
--
-- Host: localhost    Database: mediawiki1_16
-- ------------------------------------------------------
-- Server version	5.1.55

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
-- Table structure for table `mw_cc_page`
--

DROP TABLE IF EXISTS `mw_cc_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mw_cc_page` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `page_name` varbinary(255) NOT NULL,
  `keyword` varbinary(255) NOT NULL,
  `template` varbinary(255) DEFAULT NULL,
  `creator_name` varbinary(50) DEFAULT NULL,
  `creator_photo` varbinary(100) DEFAULT NULL,
  `creator_email` varbinary(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mw_cc_page`
--

LOCK TABLES `mw_cc_page` WRITE;
/*!40000 ALTER TABLE `mw_cc_page` DISABLE KEYS */;
INSERT INTO `mw_cc_page` VALUES (1,'云南','','0','yyzh','123','yuan@163.com'),(2,'yuan yuzhang','','0','yyzh','123','yuan@163.com'),(3,'杭  州','','0','yyzh','123','yuan@163.com'),(4,'CCNT Lab Zhejiang University','','0','yyzh','123','yuan@163.com'),(5,'Ffffffffffff','CCCCC','RestaurantGB','Chen Jiaoyan','ffdsfs',''),(6,'Ffffffffffffaaa','fsdfds','RestaurantGB','fsd','/wew/s.jsp',''),(7,'Ffffffffffffffffffff','fsd','RestaurantGB','Chen Jiaoyan','',''),(8,'Test','自助','RestaurantGB','Tom','',''),(9,'Cccccccccccccc','fds','RestaurantGB','cccccccccc','1325733328_pageen.jpg','');
/*!40000 ALTER TABLE `mw_cc_page` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-01-05 13:37:08
