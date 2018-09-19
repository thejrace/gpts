-- MySQL dump 10.16  Distrib 10.1.31-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: gitas_es
-- ------------------------------------------------------
-- Server version	10.1.31-MariaDB

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
-- Table structure for table `gp_admin_session_tokens`
--

DROP TABLE IF EXISTS `gp_admin_session_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_admin_session_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `date_last_connected` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_admin_session_tokens`
--

LOCK TABLES `gp_admin_session_tokens` WRITE;
/*!40000 ALTER TABLE `gp_admin_session_tokens` DISABLE KEYS */;
INSERT INTO `gp_admin_session_tokens` VALUES (1,1,'8Pa8Swbi5uan8XHeG1m1Zul3S57Wc5','2018-07-30 13:20:29'),(2,1,'zrWAH0tDi2QjeQ1JCHHE178ceI5RIo','2018-07-30 15:14:13'),(3,1,'Ffyt65IEpwdhuUTdKnSTqkdt6DhaNB','2018-07-30 15:17:03'),(4,1,'4djzY93421crXT68QvTLI7fkC5hHWn','2018-07-30 15:17:40'),(5,1,'6M6p95NnsMhMNGOUxyX2kU7wvnqctw','2018-07-30 15:18:43'),(6,1,'JGfqQqIgOfJpX4bcH2MQIOhj7o105j','2018-07-30 15:19:57'),(7,1,'zEzqEQCnFUZmU3Xd73ehYIoj9AYnga','2018-07-30 15:21:37'),(8,1,'xsgIXjezLLWsS6VR7WZFNykZ46COUY','2018-07-30 15:21:48'),(9,1,'1iQ5BEUYDao30PyUditjHYPuZIRW4Q','2018-07-30 15:34:15'),(10,1,'54DhDKZHhdm9UvS8kg4qhLRPqdNprN','2018-07-30 15:50:09'),(11,1,'n1fNbAsu187rEE3JVXOYyQWAKO8T2O','2018-07-30 15:50:11'),(12,1,'0fy6AWLJ3Jrq8WrXasTgbP8RMohuGe','2018-07-30 15:51:10'),(13,1,'oJSz26aRY9F7bMmTK7pkrTyupMnLBu','2018-07-30 15:51:57'),(14,1,'Y0ykvOr0cC5vghSRhXRxedBbzr1pLl','2018-07-30 15:51:58'),(15,1,'VcF5A53PJX1ZFvIZHI4Sov4jXTr65P','2018-07-30 15:52:06'),(16,1,'SETsL2iRqK9ed5SNNdJQR6X2bWel8U','2018-07-30 16:35:42'),(17,1,'JwraoUbUuuNhj6vc5skPXUbsLvfJht','2018-07-30 16:35:43'),(18,1,'MYpsCWkN9eH9UnxPQYw0oXPgkfzdCw','2018-07-30 16:35:58'),(19,1,'0SEzj9M4QZTorMrtd9qoNvoei4zaKL','2018-07-30 16:36:12'),(20,1,'kJyaAE2Y59SIjCFxhi0UKeDkrHZXDW','2018-07-30 16:36:16'),(21,1,'5fuJv9pwBL1ksmKqIdZG59N8DdMy5W','2018-07-30 16:36:25'),(22,1,'1Hn1RIikl0KG8ycegx9LUI1stZYSTL','2018-07-30 16:36:42'),(23,1,'INxvr7j5T4DMYnKRVMLm46FFk7wk9R','2018-07-30 19:54:52'),(24,1,'zTQ49dDrT0pMj6pmTRaz4clBaNSWLp','2018-07-30 19:54:58'),(25,1,'F05G2HMp1ZfHzurU8q3v1xcTWegD9r','2018-07-30 19:55:13'),(26,1,'1JyZfd57bAVSenfcL41ujv1YfmuAAx','2018-07-30 19:55:39'),(27,1,'HCjXqFa91zoMWLqjGqSDJUn8QaMM9d','2018-07-30 19:55:42'),(28,1,'t8nSFblMRfQctYekAer6u2YQJq9nnl','2018-07-31 13:59:25'),(29,1,'Rj8NqaXW19xL2rmDwHdmynnyBEQOha','2018-07-31 14:00:03'),(30,1,'AfQLyWyKFdJmkA1y9wbHfKx4CMKlxc','2018-07-31 14:00:06'),(31,1,'TW79JX0SyNwFXblWr5Znne2LfXEh81','2018-07-31 14:00:09'),(32,1,'RQOuis29pzEH6NKhS6jZOTSSIA34t8','2018-08-05 11:29:24'),(33,1,'Fbc29Vb4dvy4t04jzvR1oX9TxdzllM','2018-08-05 11:29:25'),(34,1,'0vYZJ3vMvuGlgO1mD6EIqzNVRHjhAl','2018-08-05 11:29:30'),(35,1,'KSzjxXeVHZUnqJ6EifK231zAe44ecU','2018-08-05 11:36:39'),(36,1,'DIK7ZIVn5LyEz6FNpzCnDoGUTobsDs','2018-08-05 11:36:41'),(37,1,'psuVy35vYfyPIwgPqs4lIKW5nAX1sV','2018-08-05 11:36:48'),(38,1,'iNFkbXXT9ZiGBZu25JKy4jFhYSmq6s','2018-08-05 11:36:49'),(39,1,'K2IkhKm29QmJHdGjcU2ReknE1aw7Ph','2018-08-05 11:42:10'),(40,1,'U7YpZtLXgvpBjUG32AHxlXMHPE7mrH','2018-08-05 11:42:15'),(41,1,'dVKHD3bpJGQ9mO7MNLOTZKAya9ui35','2018-08-05 11:42:17'),(42,1,'q2TU3pGyAEAe6DiNJJJeXa05PTs3HV','2018-08-05 11:42:19'),(43,1,'KN0HvA3ZXj89wjFPaCScjkcBq7HrrP','2018-08-05 11:42:21'),(44,1,'ncjpbvGCEGDOBmy1vwnJFytldBwWwF','2018-08-19 17:51:46'),(45,1,'gouNB9FJBC3vFTPh4tUealZP1TprlB','2018-08-19 17:51:48'),(46,1,'4fOw1w9PdsCMjFP2LDPmY4ZyDT7Wcs','2018-08-19 18:39:08'),(47,1,'H9Ut0TRVSzcafC9g2UCNqW8rzsHEpq','2018-08-19 18:39:19'),(48,1,'3S3S26Kc7RobfPJIZ2GLJcA4GlqxhK','2018-08-21 00:20:22'),(49,1,'pGkMGy49oPBMr2zcC0ViY9YcGLuR9E','2018-08-21 00:20:25'),(50,1,'xKs10XosPpQ7W3Mg0ifOT3J6eHPMKk','2018-08-21 00:21:35'),(51,1,'VQR6EEJfl0iGQ9hZ0PYBCBEPLNRIBJ','2018-08-21 00:21:36'),(52,1,'QukZYuBKfrQLDZNoNdG4HsK5xnlFmP','2018-08-21 00:23:04'),(53,1,'9yz7wW2GvJE3ZoP7U4IL9SpydSrq3v','2018-08-21 00:23:18'),(54,1,'Zza67Bdb7Q3Tc6m5l0VmOq7TqqTvDW','2018-08-21 00:23:27'),(55,1,'3XVx6VjcwSot5sNr8s36y62G9qlrHj','2018-08-21 00:23:28'),(56,1,'NE1woMnkhAhErGmvbYIIhTnDM97NFI','2018-08-21 00:24:33'),(57,1,'WreHmcVVd3IiV2wq2HZoIpY3GkuhMN','2018-08-21 00:24:35'),(58,1,'6ml2Unr93ed4Q5xaJGo3arhvuJUo0o','2018-08-21 00:29:18'),(59,1,'QgCUGF3d7zOcgk3jtazW8MM8QJA2N7','2018-08-21 00:29:19'),(60,1,'nVTisbT5KdS1o3BXpQI6FTgtwovWXY','2018-08-21 00:29:21'),(61,1,'gcwOTgk1wMy12qKvRbpvsfJujnL9N8','2018-08-21 00:30:18'),(62,1,'ITMdojy2ilt31EwuuOSFZE7SDGr8X8','2018-08-21 00:30:20'),(63,1,'9NIEJY9A9HAnfrGRSe0YUCOIFvy6up','2018-08-21 00:30:21'),(64,1,'cKkS2ThLKscQFW3FMtLUI0FrXk6nNd','2018-08-21 00:30:24');
/*!40000 ALTER TABLE `gp_admin_session_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_api_triggers`
--

DROP TABLE IF EXISTS `gp_api_triggers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_api_triggers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_type` int(2) NOT NULL,
  `item_action_type` int(2) DEFAULT NULL,
  `item_id` text,
  `item_key` text,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_api_triggers`
--

LOCK TABLES `gp_api_triggers` WRITE;
/*!40000 ALTER TABLE `gp_api_triggers` DISABLE KEYS */;
INSERT INTO `gp_api_triggers` VALUES (1,2,1,'5','name','2018-06-26 23:43:39'),(2,2,1,'6','name','2018-06-26 23:47:30'),(3,2,1,'7','name','2018-06-26 23:48:02'),(4,2,1,'8','name','2018-06-26 23:48:31'),(5,2,1,'9','name','2018-06-27 00:04:53'),(6,2,1,'10','name','2018-06-27 00:05:08'),(7,2,1,'11','name','2018-06-27 00:09:14'),(8,2,1,'12','name','2018-06-27 00:11:35'),(9,2,1,'13','name','2018-06-28 19:02:31'),(10,2,1,'14','name','2018-06-29 13:53:51'),(11,2,1,'15','name','2018-06-29 15:53:11'),(12,1,1,'10','nick','2018-07-01 12:53:48'),(13,1,1,'11','nick','2018-07-01 15:04:23'),(14,1,1,'12','nick','2018-07-01 15:06:21'),(15,1,1,'13','nick','2018-07-01 15:09:18'),(16,1,1,'14','nick','2018-07-01 15:13:09'),(17,1,1,'15','nick','2018-07-01 15:19:24'),(18,1,1,'16','nick','2018-07-01 15:23:20'),(19,1,1,'17','nick','2018-07-01 15:36:38'),(20,2,1,'16','name','2018-07-01 15:46:05'),(21,3,1,'4','name','2018-07-01 21:46:53'),(22,3,1,'5','name','2018-07-01 21:48:27'),(23,3,1,'6','name','2018-07-30 13:01:11'),(24,1,1,'18','nick','2018-07-30 13:13:50'),(25,1,1,'19','nick','2018-07-30 13:16:26'),(26,1,1,'20','nick','2018-07-30 15:14:13'),(27,1,1,'21','nick','2018-07-30 15:17:40'),(28,1,1,'22','nick','2018-07-30 15:21:48'),(29,1,1,'23','nick','2018-07-30 15:34:15');
/*!40000 ALTER TABLE `gp_api_triggers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_api_triggers_not_checked`
--

DROP TABLE IF EXISTS `gp_api_triggers_not_checked`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_api_triggers_not_checked` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trigger_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_api_triggers_not_checked`
--

LOCK TABLES `gp_api_triggers_not_checked` WRITE;
/*!40000 ALTER TABLE `gp_api_triggers_not_checked` DISABLE KEYS */;
INSERT INTO `gp_api_triggers_not_checked` VALUES (1,8,1),(2,8,2),(3,8,3),(4,10,1),(5,10,2),(6,11,1),(7,11,2),(8,12,1),(9,12,2),(10,13,1),(11,13,2),(12,14,1),(13,14,2),(14,15,1),(15,15,2),(16,16,1),(17,16,2),(18,17,1),(19,17,2),(20,18,1),(21,18,2),(22,19,1),(23,19,2),(24,20,1),(25,20,2),(26,21,1),(27,21,2),(28,22,1),(29,22,2),(30,23,1),(31,23,2),(32,24,1),(33,24,2),(34,25,1),(35,25,2),(36,28,1),(37,28,2),(38,29,1),(39,29,2);
/*!40000 ALTER TABLE `gp_api_triggers_not_checked` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_api_user_devices`
--

DROP TABLE IF EXISTS `gp_api_user_devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_api_user_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `name` text NOT NULL,
  `hash` text NOT NULL,
  `ip` varchar(100) NOT NULL,
  `os` text NOT NULL,
  `date_added` datetime NOT NULL,
  `date_last_connected` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `deleted` int(1) DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_api_user_devices`
--

LOCK TABLES `gp_api_user_devices` WRITE;
/*!40000 ALTER TABLE `gp_api_user_devices` DISABLE KEYS */;
INSERT INTO `gp_api_user_devices` VALUES (1,1,1,'test device name','test hash','::1','Windows','2018-06-17 19:51:05','2018-06-27 00:05:20',1,0),(2,1,1,'test device name 2','test hash 2','::1','Windows','2018-06-27 00:07:00','2018-06-27 00:07:00',0,0),(3,1,1,'test device name 2','test hash 3','::1','Windows','2018-06-27 00:08:30','2018-09-19 14:57:18',1,0);
/*!40000 ALTER TABLE `gp_api_user_devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_api_users`
--

DROP TABLE IF EXISTS `gp_api_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_api_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `user_group` int(2) NOT NULL,
  `permissions` text,
  `date_added` datetime NOT NULL,
  `status` int(1) DEFAULT '1',
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_api_users`
--

LOCK TABLES `gp_api_users` WRITE;
/*!40000 ALTER TABLE `gp_api_users` DISABLE KEYS */;
INSERT INTO `gp_api_users` VALUES (1,'ahmet@obarey.com','$2y$12$IWxHkt2xqm8jpOsXkfHc9.Tc9cx5qpRNxrUGh3I.hBgF09Yhu5.IS',0,NULL,'2018-06-17 18:08:05',1,0),(2,'test@obarey.com','$2y$12$bHwsCAcj85T5D7XIZCHhcuTSrEEiRBnE8lTSMT8hpJYbTswcZ5HSe',2,NULL,'2018-06-17 18:09:18',1,0),(3,'cold@test.com','$2y$12$fyMNn0kdD/jk2DKYOcUrfOZWuamVcBSu3cW5yrRNTKgTruLh6kwfC',2,'1000100000000000000000','2018-07-30 15:34:15',1,0);
/*!40000 ALTER TABLE `gp_api_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_cached_data_flags`
--

DROP TABLE IF EXISTS `gp_cached_data_flags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_cached_data_flags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_cached_data_flags`
--

LOCK TABLES `gp_cached_data_flags` WRITE;
/*!40000 ALTER TABLE `gp_cached_data_flags` DISABLE KEYS */;
INSERT INTO `gp_cached_data_flags` VALUES (1,'plan_schemas.cache','2018-06-29 15:53:11'),(2,'plan_schemas.cache','2018-07-01 15:46:05'),(3,'user_groups.cache','2018-07-01 21:46:53'),(4,'user_groups.cache','2018-07-01 21:48:27'),(5,'user_groups.cache','2018-07-30 13:01:11');
/*!40000 ALTER TABLE `gp_cached_data_flags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_daily_plan_definitions`
--

DROP TABLE IF EXISTS `gp_employee_daily_plan_definitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_daily_plan_definitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `daily_plan_schema_id` int(11) NOT NULL,
  `date_added` date DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_daily_plan_definitions`
--

LOCK TABLES `gp_employee_daily_plan_definitions` WRITE;
/*!40000 ALTER TABLE `gp_employee_daily_plan_definitions` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_employee_daily_plan_definitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_daily_plan_schemas`
--

DROP TABLE IF EXISTS `gp_employee_daily_plan_schemas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_daily_plan_schemas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `start` varchar(100) NOT NULL,
  `end` varchar(100) NOT NULL,
  `plan_interval` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_daily_plan_schemas`
--

LOCK TABLES `gp_employee_daily_plan_schemas` WRITE;
/*!40000 ALTER TABLE `gp_employee_daily_plan_schemas` DISABLE KEYS */;
INSERT INTO `gp_employee_daily_plan_schemas` VALUES (1,'Standart 9 - 17','09:00','17:00',60),(2,'Gece Vardiya','22:00','08:30',60),(3,'Gece Vardiya 2','18:00','04:00',75),(4,'Öğlenci','13:00','19:30',60),(5,'Test Obarey','08:00','13:00',55),(6,'Test Obarey 2','08:00','13:00',55),(7,'Test Obarey 3','08:00','13:00',55),(8,'Test Obarey 4','08:00','13:00',55),(9,'Test Obarey 5','08:00','13:00',55),(10,'Test Obarey 53','08:00','13:00',55),(11,'Test Obarey 6','08:00','13:00',55),(12,'Test Obarey 7','08:00','13:00',55),(13,'Test 124','12:00','19:00',60),(14,'Samamel','12:00','00:00',30),(15,'Test Obarey 9','08:00','13:00',55),(16,'Kıro','12:00','15:00',30);
/*!40000 ALTER TABLE `gp_employee_daily_plan_schemas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_daily_plans`
--

DROP TABLE IF EXISTS `gp_employee_daily_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_daily_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `plan_order` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `status_code` varchar(5) DEFAULT NULL,
  `edited` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_daily_plans`
--

LOCK TABLES `gp_employee_daily_plans` WRITE;
/*!40000 ALTER TABLE `gp_employee_daily_plans` DISABLE KEYS */;
INSERT INTO `gp_employee_daily_plans` VALUES (1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,0),(2,1,2,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,0),(3,1,3,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,0);
/*!40000 ALTER TABLE `gp_employee_daily_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_daily_plans_archive`
--

DROP TABLE IF EXISTS `gp_employee_daily_plans_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_daily_plans_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prev_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `plan_order` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `status` varchar(2) DEFAULT NULL,
  `status_code` varchar(5) DEFAULT NULL,
  `edited` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_daily_plans_archive`
--

LOCK TABLES `gp_employee_daily_plans_archive` WRITE;
/*!40000 ALTER TABLE `gp_employee_daily_plans_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_employee_daily_plans_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_groups`
--

DROP TABLE IF EXISTS `gp_employee_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `parent` int(11) DEFAULT '0',
  `permissions` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_groups`
--

LOCK TABLES `gp_employee_groups` WRITE;
/*!40000 ALTER TABLE `gp_employee_groups` DISABLE KEYS */;
INSERT INTO `gp_employee_groups` VALUES (1,'Filo Yönetim',0,'1000100000000000000000'),(2,'Muhasebe',0,'1000100000000000000000'),(3,'Kademe',0,'1000100000000000000000'),(4,'Mühendis',0,'1000100000000000000000'),(5,'Teknisyen',0,'1000100000000000000000'),(6,'Ahti',0,'1000100000000000000000');
/*!40000 ALTER TABLE `gp_employee_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_periodic_task_definitions`
--

DROP TABLE IF EXISTS `gp_employee_periodic_task_definitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_periodic_task_definitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `employee_group_id` int(11) DEFAULT NULL,
  `time_length` double DEFAULT '0',
  `task_interval` double NOT NULL,
  `date_last_defined` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_periodic_task_definitions`
--

LOCK TABLES `gp_employee_periodic_task_definitions` WRITE;
/*!40000 ALTER TABLE `gp_employee_periodic_task_definitions` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_employee_periodic_task_definitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_periodic_work_definitions`
--

DROP TABLE IF EXISTS `gp_employee_periodic_work_definitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_periodic_work_definitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work_template_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `employee_group_id` int(11) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `time_length` double DEFAULT '0',
  `define_interval` double NOT NULL,
  `date_last_defined` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_periodic_work_definitions`
--

LOCK TABLES `gp_employee_periodic_work_definitions` WRITE;
/*!40000 ALTER TABLE `gp_employee_periodic_work_definitions` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_employee_periodic_work_definitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_relations`
--

DROP TABLE IF EXISTS `gp_employee_relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_relations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_employee` int(11) NOT NULL,
  `child_employee` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_relations`
--

LOCK TABLES `gp_employee_relations` WRITE;
/*!40000 ALTER TABLE `gp_employee_relations` DISABLE KEYS */;
INSERT INTO `gp_employee_relations` VALUES (1,1,2);
/*!40000 ALTER TABLE `gp_employee_relations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_task_definitions`
--

DROP TABLE IF EXISTS `gp_employee_task_definitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_task_definitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `parent_definition_id` int(11) DEFAULT '0',
  `start` datetime NOT NULL,
  `time_length` double DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `comments` text,
  `date_added` datetime DEFAULT NULL,
  `date_last_update` datetime DEFAULT NULL,
  `added_employee` int(11) NOT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_task_definitions`
--

LOCK TABLES `gp_employee_task_definitions` WRITE;
/*!40000 ALTER TABLE `gp_employee_task_definitions` DISABLE KEYS */;
INSERT INTO `gp_employee_task_definitions` VALUES (2,1,1,0,'2018-06-06 23:03:47',10,NULL,1,NULL,'2018-06-06 23:03:47','2018-06-06 23:03:47',1,0);
/*!40000 ALTER TABLE `gp_employee_task_definitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_task_definitions_archive`
--

DROP TABLE IF EXISTS `gp_employee_task_definitions_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_task_definitions_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prev_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `parent_definition_id` int(11) DEFAULT '0',
  `start` datetime NOT NULL,
  `time_length` double DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `comments` text,
  `date_added` datetime DEFAULT NULL,
  `date_last_update` datetime DEFAULT NULL,
  `added_employee` int(11) NOT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_task_definitions_archive`
--

LOCK TABLES `gp_employee_task_definitions_archive` WRITE;
/*!40000 ALTER TABLE `gp_employee_task_definitions_archive` DISABLE KEYS */;
INSERT INTO `gp_employee_task_definitions_archive` VALUES (1,15,1,1,0,'2018-06-06 23:03:47',10,NULL,1,NULL,'2018-06-06 23:03:47','2018-06-06 23:03:47',1,0),(3,17,1,1,0,'2018-06-06 23:03:47',10,NULL,1,NULL,'2018-06-06 23:03:47','2018-06-06 23:03:47',1,0),(4,18,1,1,0,'2018-06-06 23:03:47',10,NULL,1,'obarey','2018-06-06 23:03:47','2018-06-06 23:03:47',1,0);
/*!40000 ALTER TABLE `gp_employee_task_definitions_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_task_definitions_status_updates`
--

DROP TABLE IF EXISTS `gp_employee_task_definitions_status_updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_task_definitions_status_updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work_task_definition_id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `comments` text,
  `date_added` datetime DEFAULT NULL,
  `added_employee` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_task_definitions_status_updates`
--

LOCK TABLES `gp_employee_task_definitions_status_updates` WRITE;
/*!40000 ALTER TABLE `gp_employee_task_definitions_status_updates` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_employee_task_definitions_status_updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_task_definitions_status_updates_archive`
--

DROP TABLE IF EXISTS `gp_employee_task_definitions_status_updates_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_task_definitions_status_updates_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prev_id` int(11) NOT NULL,
  `work_task_definition_id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `comments` text,
  `date_added` datetime DEFAULT NULL,
  `added_employee` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_task_definitions_status_updates_archive`
--

LOCK TABLES `gp_employee_task_definitions_status_updates_archive` WRITE;
/*!40000 ALTER TABLE `gp_employee_task_definitions_status_updates_archive` DISABLE KEYS */;
INSERT INTO `gp_employee_task_definitions_status_updates_archive` VALUES (1,1,18,1,'test','2018-06-13 00:00:00',3),(2,2,18,1,'test','2018-06-13 00:00:00',3);
/*!40000 ALTER TABLE `gp_employee_task_definitions_status_updates_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_work_definitions`
--

DROP TABLE IF EXISTS `gp_employee_work_definitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_work_definitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `work_template_id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `time_length` double DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `date_added` datetime DEFAULT NULL,
  `date_last_update` datetime DEFAULT NULL,
  `added_employee` int(11) NOT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_work_definitions`
--

LOCK TABLES `gp_employee_work_definitions` WRITE;
/*!40000 ALTER TABLE `gp_employee_work_definitions` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_employee_work_definitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_work_definitions_archive`
--

DROP TABLE IF EXISTS `gp_employee_work_definitions_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_work_definitions_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prev_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `work_template_id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `time_length` double DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `date_added` datetime DEFAULT NULL,
  `date_last_update` datetime DEFAULT NULL,
  `added_employee` int(11) NOT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_work_definitions_archive`
--

LOCK TABLES `gp_employee_work_definitions_archive` WRITE;
/*!40000 ALTER TABLE `gp_employee_work_definitions_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_employee_work_definitions_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_works`
--

DROP TABLE IF EXISTS `gp_employee_works`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `details` text,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `added_employee` int(11) NOT NULL,
  `date_last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_works`
--

LOCK TABLES `gp_employee_works` WRITE;
/*!40000 ALTER TABLE `gp_employee_works` DISABLE KEYS */;
INSERT INTO `gp_employee_works` VALUES (7,1,'Şablolo','',0,'2018-09-17 21:38:51',NULL,1,'2018-09-17 22:06:38'),(8,1,'Tuvalet kağıdı','obarey beybe',0,'2018-09-17 22:06:58',NULL,1,'2018-09-17 22:07:04');
/*!40000 ALTER TABLE `gp_employee_works` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_works_archive`
--

DROP TABLE IF EXISTS `gp_employee_works_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_works_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prev_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `details` text NOT NULL,
  `sub_items` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `added_employee` int(11) NOT NULL,
  `date_last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_works_archive`
--

LOCK TABLES `gp_employee_works_archive` WRITE;
/*!40000 ALTER TABLE `gp_employee_works_archive` DISABLE KEYS */;
INSERT INTO `gp_employee_works_archive` VALUES (1,1,1,'Yağ Kontrol/Değişim','','[{\"id\":\"1\",\"parent_work_id\":\"1\",\"name\":\"Ya\\u011f Kontrol\",\"details\":\"Arac\\u0131n ya\\u011f miktar\\u0131 kontrol edildi.\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:02:09\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"2\",\"parent_work_id\":\"1\",\"name\":\"Ya\\u011f Tamamlama\",\"details\":\"Eksik miktar kadar ya\\u011f araca eklendi.\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:02:09\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:02:09',1,'2018-09-16 01:02:09'),(2,2,1,'Tamir Test','','[{\"id\":\"3\",\"parent_work_id\":\"2\",\"name\":\"Tamir ad\\u0131m 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"3\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:02:49\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"4\",\"parent_work_id\":\"2\",\"name\":\"Tamir ad\\u0131m 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"3\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:02:49\",\"added_employee\":\"1\",\"date_last_modified\":null}]',3,NULL,'2018-09-16 01:02:49',1,'2018-09-16 01:02:49'),(3,3,1,'Test iş','','[{\"id\":\"7\",\"parent_work_id\":\"3\",\"name\":\"test ad\\u0131m 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"0\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:03:26\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"8\",\"parent_work_id\":\"3\",\"name\":\"test ad\\u0131m 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"0\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:03:26\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:03:19',1,'2018-09-16 01:03:26'),(4,4,1,'Test Ahmet','','[{\"id\":\"11\",\"parent_work_id\":\"4\",\"name\":\"test\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"1\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:04:48\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"12\",\"parent_work_id\":\"4\",\"name\":\"teje\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"0\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:04:48\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:04:44',1,'2018-09-16 01:04:48'),(5,6,1,'Nevriye','','[{\"id\":\"16\",\"parent_work_id\":\"6\",\"name\":\"nev 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:05:21\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"17\",\"parent_work_id\":\"6\",\"name\":\"neb 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:05:21\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"18\",\"parent_work_id\":\"6\",\"name\":\"neb 3\",\"details\":\"\",\"step_order\":\"3\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:05:21\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:05:21',1,'2018-09-16 01:05:21'),(6,5,1,'Add tamam','','[{\"id\":\"13\",\"parent_work_id\":\"5\",\"name\":\"test\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:05:06\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"14\",\"parent_work_id\":\"5\",\"name\":\"test 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:05:06\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"15\",\"parent_work_id\":\"5\",\"name\":\"test 3\",\"details\":\"\",\"step_order\":\"3\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:05:06\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:05:06',1,'2018-09-16 01:05:46'),(7,7,1,'Cengzi Budak','','[{\"id\":\"22\",\"parent_work_id\":\"7\",\"name\":\"test 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"0\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:06:22\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"23\",\"parent_work_id\":\"7\",\"name\":\"test 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"0\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:06:22\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"24\",\"parent_work_id\":\"7\",\"name\":\"est 4\",\"details\":\"\",\"step_order\":\"3\",\"status\":\"0\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:06:22\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:06:17',1,'2018-09-16 01:06:22'),(8,8,1,'Kaset','','[{\"id\":\"25\",\"parent_work_id\":\"8\",\"name\":\"Kaset 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:06:55\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"26\",\"parent_work_id\":\"8\",\"name\":\"kaset 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:06:55\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:06:55',1,'2018-09-16 01:06:55'),(9,9,1,'Kaka 2','','[{\"id\":\"27\",\"parent_work_id\":\"9\",\"name\":\"at\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"3\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:07:13\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"28\",\"parent_work_id\":\"9\",\"name\":\"at 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"3\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:07:13\",\"added_employee\":\"1\",\"date_last_modified\":null}]',3,NULL,'2018-09-16 01:07:13',1,'2018-09-16 01:07:13'),(10,10,1,'Enmcejare','','[{\"id\":\"31\",\"parent_work_id\":\"10\",\"name\":\"test\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:13:21\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:13:15',1,'2018-09-16 01:13:36'),(11,11,1,'Nedenabi aoluyo','','[{\"id\":\"34\",\"parent_work_id\":\"11\",\"name\":\"ekkere\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"0\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:14:08\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"35\",\"parent_work_id\":\"11\",\"name\":\"tabbere\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"0\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:14:08\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:14:04',1,'2018-09-16 01:14:08'),(12,13,1,'Kek 123','','[{\"id\":\"40\",\"parent_work_id\":\"13\",\"name\":\"at\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:25:15\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"41\",\"parent_work_id\":\"13\",\"name\":\"at 2\",\"details\":\"ke\\u00e7i\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:25:15\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:25:06',1,'2018-09-16 01:26:09'),(13,12,1,'Test akaka','','[{\"id\":\"36\",\"parent_work_id\":\"12\",\"name\":\"test\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"3\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:24:30\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"37\",\"parent_work_id\":\"12\",\"name\":\"test 123\",\"details\":\"\\u015fteroy\",\"step_order\":\"2\",\"status\":\"3\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:24:30\",\"added_employee\":\"1\",\"date_last_modified\":null}]',3,NULL,'2018-09-16 01:24:30',1,'2018-09-16 01:26:31'),(14,14,1,'cengo','','[{\"id\":\"42\",\"parent_work_id\":\"14\",\"name\":\"at\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:26:57\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"43\",\"parent_work_id\":\"14\",\"name\":\"at 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:26:57\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:26:57',1,'2018-09-16 01:27:07'),(15,15,1,'Haydar','','[{\"id\":\"46\",\"parent_work_id\":\"15\",\"name\":\"at\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"0\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:27:33\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"47\",\"parent_work_id\":\"15\",\"name\":\"at 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"0\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:27:33\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:27:26',1,'2018-09-16 01:27:33'),(16,16,1,'Datmin','','[{\"id\":\"48\",\"parent_work_id\":\"16\",\"name\":\"etst\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:38:20\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"49\",\"parent_work_id\":\"16\",\"name\":\"ekeke\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:38:20\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:38:20',1,'2018-09-16 01:38:38'),(17,18,1,'Lelele','','[{\"id\":\"52\",\"parent_work_id\":\"18\",\"name\":\"33 cocuk\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:42:46\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"53\",\"parent_work_id\":\"18\",\"name\":\"etetet\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:42:46\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 01:42:46',1,'2018-09-16 01:42:56'),(18,17,1,'Vajinismus','','[{\"id\":\"50\",\"parent_work_id\":\"17\",\"name\":\"test\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"3\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:39:39\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"51\",\"parent_work_id\":\"17\",\"name\":\"2222\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:39:39\",\"added_employee\":\"1\",\"date_last_modified\":null}]',3,NULL,'2018-09-16 01:39:39',1,'2018-09-16 01:43:10'),(19,1,1,'Mercedes','mercedes','[{\"id\":\"1\",\"parent_work_id\":\"1\",\"name\":\"Ad\\u0131m 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"5\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 15:35:55\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"2\",\"parent_work_id\":\"1\",\"name\":\"Ad\\u0131m 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"5\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 15:35:55\",\"added_employee\":\"1\",\"date_last_modified\":null}]',2,NULL,'2018-09-16 15:35:55',1,'2018-09-16 15:36:01'),(20,2,1,'Overdrive 3','test details','[{\"id\":\"3\",\"parent_work_id\":\"2\",\"name\":\"Testobo1\",\"details\":\"testers\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 23:01:51\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"4\",\"parent_work_id\":\"2\",\"name\":\"Keke 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 23:01:51\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"5\",\"parent_work_id\":\"2\",\"name\":\"Bbebe 1234\",\"details\":\"\",\"step_order\":\"3\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 23:01:51\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 23:01:51',1,'2018-09-16 23:01:51'),(21,3,1,'Overdrive 3 keke','test details','[{\"id\":\"6\",\"parent_work_id\":\"3\",\"name\":\"Testobo1\",\"details\":\"testers\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 23:02:13\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"7\",\"parent_work_id\":\"3\",\"name\":\"Keke 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 23:02:13\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"8\",\"parent_work_id\":\"3\",\"name\":\"Bbebe 1234\",\"details\":\"dont let it burn baby\",\"step_order\":\"3\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 23:02:13\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-16 23:02:13',1,'2018-09-17 18:02:21'),(22,4,1,'Yağ Kontrol/Değişim','','[{\"id\":\"9\",\"parent_work_id\":\"4\",\"name\":\"Ya\\u011f Kontrol\",\"details\":\"Arac\\u0131n ya\\u011f miktar\\u0131 kontrol edildi.\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-17 17:50:02\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"10\",\"parent_work_id\":\"4\",\"name\":\"Ya\\u011f Tamamlama\",\"details\":\"Eksik miktar kadar ya\\u011f araca eklendi.\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-17 17:50:02\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-17 17:50:02',1,'2018-09-17 18:05:03'),(23,5,1,'Olala','','[{\"id\":\"11\",\"parent_work_id\":\"5\",\"name\":\"test lala 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-17 18:05:33\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"12\",\"parent_work_id\":\"5\",\"name\":\"test lala 2\",\"details\":\"atorey\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-17 18:05:33\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-17 18:05:33',1,'2018-09-17 18:05:33'),(24,6,1,'Legend','','[{\"id\":\"13\",\"parent_work_id\":\"6\",\"name\":\"test 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-17 18:08:24\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"14\",\"parent_work_id\":\"6\",\"name\":\"test 3\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-17 18:08:24\",\"added_employee\":\"1\",\"date_last_modified\":null}]',1,NULL,'2018-09-17 18:08:24',1,'2018-09-17 18:08:24');
/*!40000 ALTER TABLE `gp_employee_works_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_works_sub_items`
--

DROP TABLE IF EXISTS `gp_employee_works_sub_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_works_sub_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_work_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `details` text,
  `step_order` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `needs_validation` tinyint(1) DEFAULT '0',
  `date_added` datetime NOT NULL,
  `added_employee` int(11) NOT NULL,
  `date_last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_works_sub_items`
--

LOCK TABLES `gp_employee_works_sub_items` WRITE;
/*!40000 ALTER TABLE `gp_employee_works_sub_items` DISABLE KEYS */;
INSERT INTO `gp_employee_works_sub_items` VALUES (15,7,'kevro 1','',1,0,0,'2018-09-17 21:38:51',1,NULL),(16,7,'kevro 2','',2,4,0,'2018-09-17 21:38:51',1,NULL),(17,8,'Adım 1','',1,0,0,'2018-09-17 22:06:58',1,NULL),(18,8,'Adım 2','',2,3,0,'2018-09-17 22:06:58',1,NULL);
/*!40000 ALTER TABLE `gp_employee_works_sub_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_works_templates`
--

DROP TABLE IF EXISTS `gp_employee_works_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_works_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `details` text,
  `sub_items` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_works_templates`
--

LOCK TABLES `gp_employee_works_templates` WRITE;
/*!40000 ALTER TABLE `gp_employee_works_templates` DISABLE KEYS */;
INSERT INTO `gp_employee_works_templates` VALUES (1,'Yağ Kontrol/Değişim','','[{\"id\":0,\"parent_work_id\":\"1\",\"name\":\"Ya\\u011f Kontrol\",\"details\":\"Arac\\u0131n ya\\u011f miktar\\u0131 kontrol edildi.\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:02:09\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"1\",\"name\":\"Ya\\u011f Tamamlama\",\"details\":\"Eksik miktar kadar ya\\u011f araca eklendi.\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:02:09\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(2,'Tamir Test','','[{\"id\":0,\"parent_work_id\":\"2\",\"name\":\"Tamir ad\\u0131m 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:02:49\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"2\",\"name\":\"Tamir ad\\u0131m 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:02:49\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(3,'Test iş','','[{\"id\":0,\"parent_work_id\":\"3\",\"name\":\"test ad\\u0131m 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:03:26\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"3\",\"name\":\"test ad\\u0131m 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:03:26\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(4,'Test Ahmet','','[{\"id\":0,\"parent_work_id\":\"4\",\"name\":\"test\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:04:48\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"4\",\"name\":\"teje\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:04:48\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(5,'Nevriye','','[{\"id\":0,\"parent_work_id\":\"6\",\"name\":\"nev 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:05:21\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"6\",\"name\":\"neb 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:05:21\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"6\",\"name\":\"neb 3\",\"details\":\"\",\"step_order\":\"3\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:05:21\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(6,'Add tamam','','[]'),(7,'Cengzi Budak','','[{\"id\":0,\"parent_work_id\":\"7\",\"name\":\"test 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:06:22\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"7\",\"name\":\"test 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:06:22\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"7\",\"name\":\"est 4\",\"details\":\"\",\"step_order\":\"3\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:06:22\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(8,'Kaset','','[{\"id\":0,\"parent_work_id\":\"8\",\"name\":\"Kaset 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:06:55\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"8\",\"name\":\"kaset 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:06:55\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(9,'Kaka 2','','[{\"id\":0,\"parent_work_id\":\"9\",\"name\":\"at\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:07:13\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"9\",\"name\":\"at 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:07:13\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(10,'Enmcejare','','[{\"id\":0,\"parent_work_id\":\"10\",\"name\":\"test\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:13:21\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(11,'Nedenabi aoluyo','','[{\"id\":0,\"parent_work_id\":\"11\",\"name\":\"ekkere\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:14:08\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"11\",\"name\":\"tabbere\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:14:08\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(12,'Kek 123','','[{\"id\":0,\"parent_work_id\":\"13\",\"name\":\"at\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:25:15\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"13\",\"name\":\"at 2\",\"details\":\"ke\\u00e7i\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:25:15\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(13,'Test akaka','','[{\"id\":0,\"parent_work_id\":\"12\",\"name\":\"test\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:24:30\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"12\",\"name\":\"test 123\",\"details\":\"\\u015fteroy\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:24:30\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(14,'Cengo','','[{\"id\":\"0\",\"name\":\"at\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"-1\"},{\"id\":\"0\",\"name\":\"at 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"-1\"}]'),(15,'Haydar','','[{\"\":null}]'),(16,'Datmin','','[{\"id\":0,\"parent_work_id\":\"16\",\"name\":\"etst\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:38:20\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"16\",\"name\":\"ekeke\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:38:20\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(17,'Lelele','','[{\"id\":0,\"parent_work_id\":\"18\",\"name\":\"33 cocuk\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:42:46\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"18\",\"name\":\"etetet\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:42:46\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(18,'Vajinismus','','[{\"id\":0,\"parent_work_id\":\"17\",\"name\":\"test\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:39:39\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"17\",\"name\":\"2222\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 01:39:39\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(19,'Mercedes','mercedes','[{\"id\":0,\"parent_work_id\":\"1\",\"name\":\"Ad\\u0131m 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 15:35:55\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"1\",\"name\":\"Ad\\u0131m 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 15:35:55\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(20,'Overdrive 3','test details','[{\"id\":0,\"parent_work_id\":\"2\",\"name\":\"Testobo1\",\"details\":\"testers\",\"step_order\":\"1\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 23:01:51\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"2\",\"name\":\"Keke 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 23:01:51\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":0,\"parent_work_id\":\"2\",\"name\":\"Bbebe 1234\",\"details\":\"\",\"step_order\":\"3\",\"status\":1,\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 23:01:51\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(21,'Test work template şşşşttt','test work template details beybe kekekeke','[{\"id\":\"0\",\"name\":\"Obarey ad\\u0131m 13\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"0\"},{\"id\":\"0\",\"name\":\"Obarey ad\\u0131m 333332\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"0\"}]'),(22,'Overdrive 3 keke','test details','[{\"id\":\"6\",\"parent_work_id\":\"3\",\"name\":\"Testobo1\",\"details\":\"testers\",\"step_order\":\"1\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 23:02:13\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"7\",\"parent_work_id\":\"3\",\"name\":\"Keke 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 23:02:13\",\"added_employee\":\"1\",\"date_last_modified\":null},{\"id\":\"8\",\"parent_work_id\":\"3\",\"name\":\"Bbebe 1234\",\"details\":\"dont let it burn baby\",\"step_order\":\"3\",\"status\":\"4\",\"needs_validation\":\"0\",\"date_added\":\"2018-09-16 23:02:13\",\"added_employee\":\"1\",\"date_last_modified\":null}]'),(23,'Olala','','[{\"name\":\"test lala 1\",\"details\":\"\",\"step_order\":\"1\"},{\"name\":\"test lala 2\",\"details\":\"atorey\",\"step_order\":\"2\"}]'),(24,'Legend','','[{\"name\":\"test 1\",\"details\":\"\",\"step_order\":\"1\"},{\"name\":\"test 3\",\"details\":\"\",\"step_order\":\"2\"}]'),(25,'Nevriye Budak','acikooo','[{\"id\":\"0\",\"name\":\"Test ad\\u0131m 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"0\"},{\"id\":\"0\",\"name\":\"Test ad\\u0131m 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"0\"}]'),(26,'Kezzap Kutlu','test obarey beybe','[{\"id\":\"0\",\"name\":\"ad\\u0131m 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"0\"},{\"id\":\"0\",\"name\":\"ad\\u0131m 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"0\"}]'),(27,'Şablolo','','[{\"id\":\"0\",\"name\":\"kevro 1\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"0\"},{\"id\":\"0\",\"name\":\"kevro 2\",\"details\":\"\",\"step_order\":\"2\",\"status\":\"0\"}]'),(28,'Nezih hoca','','[{\"id\":\"0\",\"name\":\"ileri,\",\"details\":\"teknikler\",\"step_order\":\"1\",\"status\":\"0\"}]'),(29,'Sinan bey','','[{\"id\":\"0\",\"name\":\"testere\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"0\"}]'),(30,'Zayıf yaradılış 444','','[{\"id\":\"0\",\"name\":\"test\",\"details\":\"\",\"step_order\":\"1\",\"status\":\"-1\"}]'),(31,'Adımısız bebe','','[]'),(32,'Vampiria define','Vampiria define details','[{\"name\":\"Obarey ad\\u0131m 13\",\"details\":\"\",\"step_order\":\"1\"},{\"name\":\"Obarey ad\\u0131m 333332\",\"details\":\"\",\"step_order\":\"2\"}]');
/*!40000 ALTER TABLE `gp_employee_works_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employee_works_validation_requests`
--

DROP TABLE IF EXISTS `gp_employee_works_validation_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employee_works_validation_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work_id` int(11) NOT NULL,
  `employee_requested_from` int(11) NOT NULL,
  `employee_requested_to` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_works_validation_requests`
--

LOCK TABLES `gp_employee_works_validation_requests` WRITE;
/*!40000 ALTER TABLE `gp_employee_works_validation_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_employee_works_validation_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_employees`
--

DROP TABLE IF EXISTS `gp_employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `nick` text NOT NULL,
  `email` text NOT NULL,
  `phone_1` varchar(100) DEFAULT NULL,
  `phone_2` varchar(100) DEFAULT NULL,
  `employee_group` int(11) NOT NULL,
  `tasks` text,
  `has_task` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employees`
--

LOCK TABLES `gp_employees` WRITE;
/*!40000 ALTER TABLE `gp_employees` DISABLE KEYS */;
INSERT INTO `gp_employees` VALUES (1,'Obarey Inc. edited','@obarey_edited','ahmet@obarey.com',NULL,NULL,2,NULL,0),(2,'Obarey Inc.','@obarey','test@test.com',NULL,NULL,2,NULL,0),(3,'Veli Konstantin','@velikonstantin','veli@test.com',NULL,NULL,2,NULL,0),(4,'Fatih Sultan Mehmet','@fsm','fsm@test.com',NULL,NULL,2,NULL,0),(5,'Yavuz Çimen','@yavuzçimen','yavuz@test.com',NULL,NULL,2,NULL,0),(6,'Serpil Boyacıoğlu','@serpilboyacioglu','serpil@test.com',NULL,NULL,2,NULL,0),(7,'Metin Türkmen','@metinturkmen','metin@test.com',NULL,NULL,2,NULL,0),(8,'Emre Mehmet Özbek','@emremozbek','emre@test.com',NULL,NULL,2,NULL,0),(9,'Eyüp Bey','@eyup','eyup@test.com',NULL,NULL,2,NULL,0),(10,'Eyüp Bey 2','@eyupp','eyup2@test.com','0533','',0,NULL,0),(11,'Yusuf Ust','@yusufo','yusuf@usta.com','','',0,NULL,0),(12,'Hederoy','@hede','hede@hede.com','','',0,NULL,0),(13,'Kero','@abo','abo@abo.com','','',0,NULL,0),(14,'Selami','@selo','selami@selami.com','','',0,NULL,0),(15,'Keke','@tat','123@ata.com','','',0,NULL,0),(16,'Denire','@dene','den@den.com','','',0,NULL,0),(17,'jeen','jeen','jeen@jeen.com','','',0,NULL,0),(23,'Coldplay','@coldplay','cold@test.com','0533','',1,NULL,0);
/*!40000 ALTER TABLE `gp_employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_sub_task_definitions`
--

DROP TABLE IF EXISTS `gp_sub_task_definitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_sub_task_definitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_task_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `task_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_sub_task_definitions`
--

LOCK TABLES `gp_sub_task_definitions` WRITE;
/*!40000 ALTER TABLE `gp_sub_task_definitions` DISABLE KEYS */;
INSERT INTO `gp_sub_task_definitions` VALUES (4,7,1,1),(5,7,8,2),(6,7,9,3);
/*!40000 ALTER TABLE `gp_sub_task_definitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_task_groups`
--

DROP TABLE IF EXISTS `gp_task_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_task_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_task_groups`
--

LOCK TABLES `gp_task_groups` WRITE;
/*!40000 ALTER TABLE `gp_task_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_task_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_tasks`
--

DROP TABLE IF EXISTS `gp_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `type` int(11) NOT NULL,
  `definition` text,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_tasks`
--

LOCK TABLES `gp_tasks` WRITE;
/*!40000 ALTER TABLE `gp_tasks` DISABLE KEYS */;
INSERT INTO `gp_tasks` VALUES (1,3,'Test iş tanımı',1,'hede',0),(3,3,'Paket iş',2,'test defs',0),(7,3,'Paket iş 2 test',2,'test defs',0),(8,3,'sub task test',1,'test def',0),(9,3,'sub task test2',1,'test def2',0);
/*!40000 ALTER TABLE `gp_tasks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-19 20:15:05
