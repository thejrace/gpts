-- MySQL dump 10.16  Distrib 10.1.25-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: gitas_es
-- ------------------------------------------------------
-- Server version	10.1.25-MariaDB

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_daily_plan_schemas`
--

LOCK TABLES `gp_employee_daily_plan_schemas` WRITE;
/*!40000 ALTER TABLE `gp_employee_daily_plan_schemas` DISABLE KEYS */;
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
  `active_date` date NOT NULL,
  `task_order` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_daily_plans`
--

LOCK TABLES `gp_employee_daily_plans` WRITE;
/*!40000 ALTER TABLE `gp_employee_daily_plans` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_employee_daily_plans` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_groups`
--

LOCK TABLES `gp_employee_groups` WRITE;
/*!40000 ALTER TABLE `gp_employee_groups` DISABLE KEYS */;
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
  `parent_task_id` int(11) NOT NULL DEFAULT '0',
  `start` datetime NOT NULL,
  `time_length` double DEFAULT NULL,
  `end` datetime NOT NULL,
  `status` int(1) DEFAULT '1',
  `date_added` datetime DEFAULT NULL,
  `date_last_update` datetime DEFAULT NULL,
  `added_employee` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employee_task_definitions`
--

LOCK TABLES `gp_employee_task_definitions` WRITE;
/*!40000 ALTER TABLE `gp_employee_task_definitions` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_employee_task_definitions` ENABLE KEYS */;
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
  `added_employee` datetime DEFAULT NULL,
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
  `group_id` int(11) NOT NULL,
  `password` text NOT NULL,
  `daily_plan_schema` int(11) DEFAULT NULL,
  `tasks` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_employees`
--

LOCK TABLES `gp_employees` WRITE;
/*!40000 ALTER TABLE `gp_employees` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gp_task_bundles`
--

DROP TABLE IF EXISTS `gp_task_bundles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gp_task_bundles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_task_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_task_bundles`
--

LOCK TABLES `gp_task_bundles` WRITE;
/*!40000 ALTER TABLE `gp_task_bundles` DISABLE KEYS */;
/*!40000 ALTER TABLE `gp_task_bundles` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gp_tasks`
--

LOCK TABLES `gp_tasks` WRITE;
/*!40000 ALTER TABLE `gp_tasks` DISABLE KEYS */;
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

-- Dump completed on 2018-06-06 21:29:20
