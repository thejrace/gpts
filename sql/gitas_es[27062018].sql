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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_admin_session_tokens`
--

LOCK TABLES `gp_admin_session_tokens` WRITE;
/*!40000 ALTER TABLE `gp_admin_session_tokens` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_api_triggers`
--

LOCK TABLES `gp_api_triggers` WRITE;
/*!40000 ALTER TABLE `gp_api_triggers` DISABLE KEYS */;
INSERT INTO `gp_api_triggers` VALUES (1,2,1,'5','name','2018-06-26 23:43:39'),(2,2,1,'6','name','2018-06-26 23:47:30'),(3,2,1,'7','name','2018-06-26 23:48:02'),(4,2,1,'8','name','2018-06-26 23:48:31'),(5,2,1,'9','name','2018-06-27 00:04:53'),(6,2,1,'10','name','2018-06-27 00:05:08'),(7,2,1,'11','name','2018-06-27 00:09:14'),(8,2,1,'12','name','2018-06-27 00:11:35');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_api_triggers_not_checked`
--

LOCK TABLES `gp_api_triggers_not_checked` WRITE;
/*!40000 ALTER TABLE `gp_api_triggers_not_checked` DISABLE KEYS */;
INSERT INTO `gp_api_triggers_not_checked` VALUES (1,8,1),(2,8,2);
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
INSERT INTO `gp_api_user_devices` VALUES (1,1,1,'test device name','test hash','::1','Windows','2018-06-17 19:51:05','2018-06-27 00:05:20',1,0),(2,1,1,'test device name 2','test hash 2','::1','Windows','2018-06-27 00:07:00','2018-06-27 00:07:00',0,0),(3,1,1,'test device name 2','test hash 3','::1','Windows','2018-06-27 00:08:30','2018-06-27 00:11:35',1,0);
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
  `date_added` datetime NOT NULL,
  `status` int(1) DEFAULT '1',
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_api_users`
--

LOCK TABLES `gp_api_users` WRITE;
/*!40000 ALTER TABLE `gp_api_users` DISABLE KEYS */;
INSERT INTO `gp_api_users` VALUES (1,'ahmet@obarey.com','$2y$12$IWxHkt2xqm8jpOsXkfHc9.Tc9cx5qpRNxrUGh3I.hBgF09Yhu5.IS',1,'2018-06-17 18:08:05',1,0),(2,'test@obarey.com','$2y$12$bHwsCAcj85T5D7XIZCHhcuTSrEEiRBnE8lTSMT8hpJYbTswcZ5HSe',2,'2018-06-17 18:09:18',1,0);
/*!40000 ALTER TABLE `gp_api_users` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_daily_plan_schemas`
--

LOCK TABLES `gp_employee_daily_plan_schemas` WRITE;
/*!40000 ALTER TABLE `gp_employee_daily_plan_schemas` DISABLE KEYS */;
INSERT INTO `gp_employee_daily_plan_schemas` VALUES (1,'Standart 9 - 17','09:00','17:00',60),(2,'Gece Vardiya','22:00','08:30',60),(3,'Gece Vardiya 2','18:00','04:00',75),(4,'Öğlenci','13:00','19:30',60),(5,'Test Obarey','08:00','13:00',55),(6,'Test Obarey 2','08:00','13:00',55),(7,'Test Obarey 3','08:00','13:00',55),(8,'Test Obarey 4','08:00','13:00',55),(9,'Test Obarey 5','08:00','13:00',55),(10,'Test Obarey 53','08:00','13:00',55),(11,'Test Obarey 6','08:00','13:00',55),(12,'Test Obarey 7','08:00','13:00',55);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_groups`
--

LOCK TABLES `gp_employee_groups` WRITE;
/*!40000 ALTER TABLE `gp_employee_groups` DISABLE KEYS */;
INSERT INTO `gp_employee_groups` VALUES (1,'Test grup2');
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
  `task_interval` double NOT NULL,
  `time_length` double NOT NULL,
  `end` datetime NOT NULL,
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
  `phone_1` text,
  `phone_2` int(11) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `tasks` text,
  `has_task` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employees`
--

LOCK TABLES `gp_employees` WRITE;
/*!40000 ALTER TABLE `gp_employees` DISABLE KEYS */;
INSERT INTO `gp_employees` VALUES (1,'Obarey Inc. edited','@obarey_edited','testt@testt.com',NULL,NULL,2,NULL,0),(2,'Obarey Inc.','@obarey','test@test.com',NULL,NULL,2,NULL,0),(3,'Veli Konstantin','@velikonstantin','veli@test.com',NULL,NULL,2,NULL,0),(4,'Fatih Sultan Mehmet','@fsm','fsm@test.com',NULL,NULL,2,NULL,0),(5,'Yavuz Çimen','@yavuzçimen','yavuz@test.com',NULL,NULL,2,NULL,0),(6,'Serpil Boyacıoğlu','@serpilboyacioglu','serpil@test.com',NULL,NULL,2,NULL,0),(7,'Metin Türkmen','@metinturkmen','metin@test.com',NULL,NULL,2,NULL,0),(8,'Emre Mehmet Özbek','@emremozbek','emre@test.com',NULL,NULL,2,NULL,0),(9,'Eyüp Bey','@eyup','eyup@test.com',NULL,NULL,2,NULL,0);
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
INSERT INTO `gp_tasks` VALUES (1,3,'Test iş tanımı',1,NULL,0),(3,3,'Paket iş',2,'test defs',0),(7,3,'Paket iş 2 test',2,'test defs',0),(8,3,'sub task test',1,'test def',0),(9,3,'sub task test2',1,'test def2',0);
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

-- Dump completed on 2018-06-27  1:32:05
