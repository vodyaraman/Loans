CREATE DATABASE  IF NOT EXISTS `loans` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `loans`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: loans
-- ------------------------------------------------------
-- Server version	8.4.0

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
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `term` int NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
INSERT INTO `loans` VALUES (4,2000.00,24,5.50,'2023-01-01','2024-12-31','2024-05-06 18:22:57','2024-05-06 18:22:57'),(5,1500.00,18,6.00,'2023-02-01','2024-07-31','2024-05-06 18:22:57','2024-05-06 18:22:57'),(6,2500.00,36,4.50,'2023-03-01','2026-02-28','2024-05-06 18:22:57','2024-05-06 18:22:57'),(7,1800.00,12,7.00,'2023-04-01','2024-03-31','2024-05-06 18:22:57','2024-05-06 18:22:57'),(8,1600.00,24,4.00,'2023-05-01','2025-04-30','2024-05-06 18:22:57','2024-05-06 18:22:57'),(9,1400.00,12,5.00,'2023-06-01','2024-05-31','2024-05-06 18:22:57','2024-05-06 18:22:57'),(10,2200.00,48,3.50,'2023-07-01','2027-06-30','2024-05-06 18:22:57','2024-05-06 18:22:57'),(11,2000.00,36,6.50,'2023-08-01','2026-07-31','2024-05-06 18:22:57','2024-05-06 18:22:57'),(12,1000.00,12,5.00,'2023-09-01','2024-08-31','2024-05-06 18:22:57','2024-05-06 18:22:57'),(13,1000.00,12,5.00,'2023-01-01','2023-12-31','2024-05-07 16:08:59','2024-05-07 16:08:59'),(14,1000.00,12,5.00,'2023-01-01','2023-12-31','2024-05-07 16:15:58','2024-05-07 16:15:58'),(15,1000.00,12,5.00,'2023-01-01','2023-12-31','2024-05-07 16:16:30','2024-05-07 16:16:30'),(16,1000.00,12,5.00,'2023-01-01','2023-12-31','2024-05-07 16:23:01','2024-05-07 16:23:01');
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `займы`
--

DROP TABLE IF EXISTS `займы`;
/*!50001 DROP VIEW IF EXISTS `займы`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `займы` AS SELECT 
 1 AS `Идентификатор`,
 1 AS `Сумма`,
 1 AS `Срок (мес)`,
 1 AS `Процентная ставка`,
 1 AS `Дата начала`,
 1 AS `Дата окончания`,
 1 AS `Дата создания`,
 1 AS `Дата обновления`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `займы`
--

/*!50001 DROP VIEW IF EXISTS `займы`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `займы` AS select `loans`.`id` AS `Идентификатор`,`loans`.`amount` AS `Сумма`,`loans`.`term` AS `Срок (мес)`,`loans`.`interest_rate` AS `Процентная ставка`,`loans`.`start_date` AS `Дата начала`,`loans`.`end_date` AS `Дата окончания`,`loans`.`created_at` AS `Дата создания`,`loans`.`updated_at` AS `Дата обновления` from `loans` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-08 12:21:05
