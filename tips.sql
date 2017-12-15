-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: tips
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.17.10.1

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
-- Table structure for table `airlines_lists`
--

DROP TABLE IF EXISTS `airlines_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `airlines_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airlines_lists`
--

LOCK TABLES `airlines_lists` WRITE;
/*!40000 ALTER TABLE `airlines_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `airlines_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `airport_city_scopes`
--

DROP TABLE IF EXISTS `airport_city_scopes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `airport_city_scopes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_airport` int(10) unsigned NOT NULL,
  `id_city` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airport_city_scopes`
--

LOCK TABLES `airport_city_scopes` WRITE;
/*!40000 ALTER TABLE `airport_city_scopes` DISABLE KEYS */;
/*!40000 ALTER TABLE `airport_city_scopes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `airport_lists`
--

DROP TABLE IF EXISTS `airport_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `airport_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_city` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airport_lists`
--

LOCK TABLES `airport_lists` WRITE;
/*!40000 ALTER TABLE `airport_lists` DISABLE KEYS */;
INSERT INTO `airport_lists` VALUES (1,'Husein Sastranegara International Airport','BDO',1,1,'2017-12-06 08:53:09','2017-12-06 08:53:09'),(2,'Blimbingsari Airport','BWX',1,3,'2017-12-06 08:53:09','2017-12-06 08:53:09'),(3,'Penggung Airport','CBN',1,3,'2017-12-06 08:53:09','2017-12-06 08:53:09'),(4,'Tunggul Wulung Airport','CXP',1,3,'2017-12-06 08:53:10','2017-12-06 08:53:10'),(5,'Pondok Cabe Airport','PCB',1,3,'2017-12-06 08:53:10','2017-12-06 08:53:10'),(6,'Halim Perdanakusuma International Airport','HLP',1,2,'2017-12-06 08:53:10','2017-12-06 08:53:10'),(7,'Soekarno–Hatta International Airport','CGK',1,2,'2017-12-06 08:53:10','2017-12-06 08:53:10');
/*!40000 ALTER TABLE `airport_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_card_lists`
--

DROP TABLE IF EXISTS `bank_card_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_card_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_bank` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_card_lists`
--

LOCK TABLES `bank_card_lists` WRITE;
/*!40000 ALTER TABLE `bank_card_lists` DISABLE KEYS */;
INSERT INTO `bank_card_lists` VALUES (1,1,'Aprilia',1,NULL,NULL),(2,1,'Liem',1,NULL,NULL),(3,2,'Sintia',1,NULL,NULL);
/*!40000 ALTER TABLE `bank_card_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_lists`
--

DROP TABLE IF EXISTS `bank_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_lists`
--

LOCK TABLES `bank_lists` WRITE;
/*!40000 ALTER TABLE `bank_lists` DISABLE KEYS */;
INSERT INTO `bank_lists` VALUES (1,'BRI',1,NULL,NULL),(2,'BCA',1,NULL,NULL);
/*!40000 ALTER TABLE `bank_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city_list_airport_list`
--

DROP TABLE IF EXISTS `city_list_airport_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city_list_airport_list` (
  `city_id` int(10) unsigned DEFAULT NULL,
  `airport_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `city_list_airport_list_city_id_foreign` (`city_id`),
  KEY `city_list_airport_list_airport_id_foreign` (`airport_id`),
  CONSTRAINT `city_list_airport_list_airport_id_foreign` FOREIGN KEY (`airport_id`) REFERENCES `airport_lists` (`id`) ON DELETE CASCADE,
  CONSTRAINT `city_list_airport_list_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `city_lists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city_list_airport_list`
--

LOCK TABLES `city_list_airport_list` WRITE;
/*!40000 ALTER TABLE `city_list_airport_list` DISABLE KEYS */;
INSERT INTO `city_list_airport_list` VALUES (1,1,NULL,NULL),(2,6,NULL,NULL),(2,7,NULL,NULL),(3,2,NULL,NULL),(3,3,NULL,NULL),(3,4,NULL,NULL),(3,5,NULL,NULL);
/*!40000 ALTER TABLE `city_list_airport_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city_lists`
--

DROP TABLE IF EXISTS `city_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city_lists`
--

LOCK TABLES `city_lists` WRITE;
/*!40000 ALTER TABLE `city_lists` DISABLE KEYS */;
INSERT INTO `city_lists` VALUES (1,'Bandung','2017-12-06 08:53:09','2017-12-06 08:53:09'),(2,'Jakarta','2017-12-06 08:53:09','2017-12-06 08:53:09'),(3,'Medan','2017-12-06 08:53:09','2017-12-06 08:53:09'),(4,'Surabaya','2017-12-06 08:53:09','2017-12-06 08:53:09');
/*!40000 ALTER TABLE `city_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_lists`
--

DROP TABLE IF EXISTS `customer_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` int(10) unsigned NOT NULL,
  `province_code` int(10) unsigned NOT NULL,
  `city_code` int(10) unsigned NOT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_country` int(10) unsigned NOT NULL,
  `id_province` int(10) unsigned NOT NULL,
  `id_city` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_lists`
--

LOCK TABLES `customer_lists` WRITE;
/*!40000 ALTER TABLE `customer_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daftar_barang_golds`
--

DROP TABLE IF EXISTS `daftar_barang_golds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daftar_barang_golds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_barang` int(10) unsigned NOT NULL,
  `is_assigned` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `daftar_barang_golds_id_barang_foreign` (`id_barang`),
  CONSTRAINT `daftar_barang_golds_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `shipments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daftar_barang_golds`
--

LOCK TABLES `daftar_barang_golds` WRITE;
/*!40000 ALTER TABLE `daftar_barang_golds` DISABLE KEYS */;
INSERT INTO `daftar_barang_golds` VALUES (1,1,0,'2017-12-06 08:53:11','2017-12-06 08:53:11'),(2,2,0,'2017-12-06 08:53:11','2017-12-06 08:53:11');
/*!40000 ALTER TABLE `daftar_barang_golds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daftar_barang_regulars`
--

DROP TABLE IF EXISTS `daftar_barang_regulars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daftar_barang_regulars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_barang` int(10) unsigned NOT NULL,
  `is_assigned` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `daftar_barang_regulars_id_barang_foreign` (`id_barang`),
  CONSTRAINT `daftar_barang_regulars_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `shipments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daftar_barang_regulars`
--

LOCK TABLES `daftar_barang_regulars` WRITE;
/*!40000 ALTER TABLE `daftar_barang_regulars` DISABLE KEYS */;
/*!40000 ALTER TABLE `daftar_barang_regulars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_shipment_details`
--

DROP TABLE IF EXISTS `delivery_shipment_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_shipment_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_shipment` int(10) unsigned NOT NULL,
  `id_delivery` int(10) unsigned NOT NULL,
  `processing_center_received_date` date DEFAULT NULL,
  `processing_center_received_time` time DEFAULT NULL,
  `processing_center_received_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_shipment_details`
--

LOCK TABLES `delivery_shipment_details` WRITE;
/*!40000 ALTER TABLE `delivery_shipment_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_shipment_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_shipments`
--

DROP TABLE IF EXISTS `delivery_shipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_shipments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `delivery_time` time NOT NULL DEFAULT '00:00:01',
  `id_origin_office` int(10) unsigned DEFAULT NULL,
  `id_destination_office` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `is_posted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_shipments`
--

LOCK TABLES `delivery_shipments` WRITE;
/*!40000 ALTER TABLE `delivery_shipments` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery_shipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_statuses`
--

DROP TABLE IF EXISTS `delivery_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `step` int(10) unsigned NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `delivery_statuses_step_unique` (`step`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_statuses`
--

LOCK TABLES `delivery_statuses` WRITE;
/*!40000 ALTER TABLE `delivery_statuses` DISABLE KEYS */;
INSERT INTO `delivery_statuses` VALUES (1,1,'Menunggu Barang Hantaran.','2017-12-06 08:53:20','2017-12-06 08:53:20'),(2,2,'Barang hantaran tersedia. Konfirmasi ketersediaan mengantar.','2017-12-06 08:53:20','2017-12-06 08:53:20'),(3,3,'Ambil paket hantaran.','2017-12-06 08:53:20','2017-12-06 08:53:20'),(4,4,'Cek in/Drop bagasi & foto tag.','2017-12-06 08:53:20','2017-12-06 08:53:20'),(5,5,'Serahkan tag bagasi.','2017-12-06 08:53:20','2017-12-06 08:53:20'),(6,6,'Tag telah diterima dan bagasi sedang diverifikasi.','2017-12-06 08:53:20','2017-12-06 08:53:20'),(7,7,'Bagasi Anda telah diverifikasi. Selesai.','2017-12-06 08:53:20','2017-12-06 08:53:20');
/*!40000 ALTER TABLE `delivery_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flight_booking_lists`
--

DROP TABLE IF EXISTS `flight_booking_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flight_booking_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `booking_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_airline` int(10) unsigned NOT NULL,
  `id_origin_airport` int(10) unsigned NOT NULL,
  `id_destination_airport` int(10) unsigned NOT NULL,
  `depature` datetime NOT NULL,
  `arrival` datetime NOT NULL,
  `flight_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `flight_booking_lists_booking_code_unique` (`booking_code`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flight_booking_lists`
--

LOCK TABLES `flight_booking_lists` WRITE;
/*!40000 ALTER TABLE `flight_booking_lists` DISABLE KEYS */;
INSERT INTO `flight_booking_lists` VALUES (1,'GEJ8LK',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','4B6U3',NULL,NULL),(2,'6FIT2Z',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','9YG3P',NULL,NULL),(3,'1KWXMO',1,1,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','FET9U',NULL,NULL),(4,'HMGQSJ',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','M5C3J',NULL,NULL),(5,'BOJS51',1,7,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','W0F0R',NULL,NULL),(6,'VZNTKS',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','MFKA6',NULL,NULL),(7,'VEWO6X',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','9OBRI',NULL,NULL),(8,'4IO1XB',1,3,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','4O82U',NULL,NULL),(9,'L8X74D',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','KZ8RO',NULL,NULL),(10,'YQACUO',1,5,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','2W35A',NULL,NULL),(11,'8AW9Z6',1,3,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','27KDR',NULL,NULL),(12,'IMKW88',1,1,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','BJH9Y',NULL,NULL),(13,'XJ5HA1',1,2,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','WM4P9',NULL,NULL),(14,'D5L8LE',1,6,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','QAQJM',NULL,NULL),(15,'KV98AN',1,4,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','A4YCJ',NULL,NULL),(16,'QDPD2V',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','BI8J6',NULL,NULL),(17,'J4RFSU',1,1,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','D7PEZ',NULL,NULL),(18,'AOC78M',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','KX7RK',NULL,NULL),(19,'RTT7DI',1,1,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','YOD9O',NULL,NULL),(20,'CUFHO7',1,5,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','BSETZ',NULL,NULL),(21,'0FA786',1,1,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','VD8LP',NULL,NULL),(22,'B8SE56',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','CO8FV',NULL,NULL),(23,'3G3WAW',1,7,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','ERKHX',NULL,NULL),(24,'4FOMII',1,2,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','74LYF',NULL,NULL),(25,'MVZVFL',1,2,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','RDHPD',NULL,NULL),(26,'IPJK28',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','UHHWJ',NULL,NULL),(27,'C357D8',1,1,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','7T2UR',NULL,NULL),(28,'9NT5GZ',1,2,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','U0ALE',NULL,NULL),(29,'EPXMXQ',1,7,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','O1Z1T',NULL,NULL),(30,'JRXDVD',1,1,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','7RBEO',NULL,NULL),(31,'HD5JD2',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','KZLA7',NULL,NULL),(32,'ASOF0M',1,1,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','3NYDY',NULL,NULL),(33,'0KMLR4',1,5,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','N5R6T',NULL,NULL),(34,'NN0XCI',1,1,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','LI5YG',NULL,NULL),(35,'IPJ6WY',1,4,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','0WESZ',NULL,NULL),(36,'H0OIDD',1,2,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','MEUXH',NULL,NULL),(37,'GPERR4',1,2,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','GYQ93',NULL,NULL),(38,'135HW5',1,4,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','LY93F',NULL,NULL),(39,'YO242D',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','JGZPG',NULL,NULL),(40,'3FFBTE',1,1,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','GSMGN',NULL,NULL),(41,'IDHLJO',1,5,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','ZM0UQ',NULL,NULL),(42,'QOEG1W',1,4,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','D4EMQ',NULL,NULL),(43,'KJ36WI',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','QWBM5',NULL,NULL),(44,'BD8C16',1,2,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','5Q89U',NULL,NULL),(45,'4ZZT71',1,1,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','JVIUH',NULL,NULL),(46,'2JWEN9',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','WS743',NULL,NULL),(47,'GVZYEO',1,6,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','GXS4S',NULL,NULL),(48,'3SLX8J',1,4,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','NJ7QY',NULL,NULL),(49,'XJU40F',1,1,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','U9KGF',NULL,NULL),(50,'VBCCWX',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','SVYZ1',NULL,NULL),(51,'UVAVE8',1,2,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','ZE7WO',NULL,NULL),(52,'V8HJW1',1,7,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','680KC',NULL,NULL),(53,'JAXGCX',1,7,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','QIM0H',NULL,NULL),(54,'3ZJCPE',1,6,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','K46HM',NULL,NULL),(55,'DBDH1P',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','W8UTO',NULL,NULL),(56,'B9KGWU',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','QHNKY',NULL,NULL),(57,'AQMBYS',1,5,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','CMIK6',NULL,NULL),(58,'HDQ2TQ',1,3,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','1RBB3',NULL,NULL),(59,'QD63BF',1,1,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','LTK2M',NULL,NULL),(60,'7H3COE',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','294YC',NULL,NULL),(61,'PW2N81',1,2,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','SWKRQ',NULL,NULL),(62,'4S4HCP',1,3,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','NT79V',NULL,NULL),(63,'O1K0PN',1,5,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','JEIOC',NULL,NULL),(64,'YMQ1B6',1,1,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','4MBOL',NULL,NULL),(65,'F63C21',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','MRZCJ',NULL,NULL),(66,'RUKXAG',1,7,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','I6EYI',NULL,NULL),(67,'1VYRW8',1,7,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','N83JO',NULL,NULL),(68,'DRB3XA',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','CLB3V',NULL,NULL),(69,'MIL2KX',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','GWR9V',NULL,NULL),(70,'4GHUXX',1,6,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','M6FEO',NULL,NULL),(71,'HC4ZWV',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','JGY8H',NULL,NULL),(72,'BE8MY6',1,6,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','4RK0B',NULL,NULL),(73,'HLY7QN',1,5,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','NYWJT',NULL,NULL),(74,'9KAO5T',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','U82B9',NULL,NULL),(75,'TMXFIH',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','3CGW1',NULL,NULL),(76,'YA2J3W',1,5,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','3A95Y',NULL,NULL),(77,'P416EL',1,7,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','Z7VQ1',NULL,NULL),(78,'HF7IUL',1,4,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','ES5G3',NULL,NULL),(79,'HEFNS4',1,5,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','J744S',NULL,NULL),(80,'NVHNU5',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','OPUJR',NULL,NULL),(81,'8KZRBD',1,2,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','D92N4',NULL,NULL),(82,'5MWOIS',1,7,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','Q9LS5',NULL,NULL),(83,'UDQOT1',1,2,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','5GVBN',NULL,NULL),(84,'FOZWRZ',1,4,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','WEYPS',NULL,NULL),(85,'80N1GD',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','9GOU1',NULL,NULL),(86,'YAOHY0',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','ZS8HU',NULL,NULL),(87,'L7JWG1',1,3,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','8X3XS',NULL,NULL),(88,'ROCHGL',1,7,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','8003E',NULL,NULL),(89,'CEHT4R',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','5WKYI',NULL,NULL),(90,'KJZSWO',1,4,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','36IOG',NULL,NULL),(91,'VG5EXA',1,6,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','8XBZ6',NULL,NULL),(92,'SKX82H',1,4,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','EI34Y',NULL,NULL),(93,'HGGPRX',1,7,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','RBDQI',NULL,NULL),(94,'OUYTSY',1,1,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','S562N',NULL,NULL),(95,'T9Q2GN',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','7YW30',NULL,NULL),(96,'I7BEY2',1,5,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','BDAWS',NULL,NULL),(97,'ELJHVF',1,3,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','372QT',NULL,NULL),(98,'6S6IPD',1,1,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','EQ8IG',NULL,NULL),(99,'4VI8E1',1,2,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','IC9U4',NULL,NULL),(100,'2JS9J7',1,5,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','KHXP1',NULL,NULL);
/*!40000 ALTER TABLE `flight_booking_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods_categories`
--

DROP TABLE IF EXISTS `goods_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods_categories`
--

LOCK TABLES `goods_categories` WRITE;
/*!40000 ALTER TABLE `goods_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insurances`
--

DROP TABLE IF EXISTS `insurances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insurances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `default_insurance` decimal(8,2) NOT NULL,
  `additional_insurance` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insurances`
--

LOCK TABLES `insurances` WRITE;
/*!40000 ALTER TABLE `insurances` DISABLE KEYS */;
INSERT INTO `insurances` VALUES (1,0.00,0,'2017-12-06 08:53:18','2017-12-06 08:53:18');
/*!40000 ALTER TABLE `insurances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_lists`
--

DROP TABLE IF EXISTS `member_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_phone_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registered_date` date NOT NULL,
  `birth_date` date DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `id_city` int(10) unsigned DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_lists`
--

LOCK TABLES `member_lists` WRITE;
/*!40000 ALTER TABLE `member_lists` DISABLE KEYS */;
INSERT INTO `member_lists` VALUES (1,'testHAha','test@test.com','$2y$10$TphUNct9OFbIdWEf5hZW0OyMJ6iwuC1xn3tG26hUvnJOy0Tw7IISq','+62123456789','2017-12-06','1990-01-01','Test Address',1,1,NULL,'2017-12-06 08:53:11','2017-12-06 08:53:11'),(2,'test','test@test.com','$2y$10$bunsMGXLCXY/SLlAzbDOquWQBP3CpOpUKCDtQVqCq8goqn0ftI.KK','+62123456789','2017-12-06','1990-01-01','Test Address',1,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `member_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_lists`
--

DROP TABLE IF EXISTS `menu_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',
  `menu_parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_lists`
--

LOCK TABLES `menu_lists` WRITE;
/*!40000 ALTER TABLE `menu_lists` DISABLE KEYS */;
INSERT INTO `menu_lists` VALUES (1,'Master File','officetypes.|officelists.|citylists.|airlineslists.|airportlists.|banklists.|paymenttypes.|pricelists.|insurances.|weightlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',NULL,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(2,'City List','citylists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(3,'Airline List','airlineslists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(4,'Airport List','airportlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(5,'Office List','officetypes.|officelists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(6,'Office Type','officetypes.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',5,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(7,'Office List','officelists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',5,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(8,'Bank List','banklists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(9,'Payment Type','paymenttypes.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(10,'Price List','pricelists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(11,'Member List','memberlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(12,'Insurance','insurances.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(13,'Weight List','weightlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(14,'Transaction','shipments.|slotlists.|deliveries.|receiveds.|shipmenttrackings.|packagingslots.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',NULL,'2017-12-06 08:53:14','2017-12-06 08:53:14'),(15,'Shipment List','shipments.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-06 08:53:15','2017-12-06 08:53:15'),(16,'Slot List','slotlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-06 08:53:15','2017-12-06 08:53:15'),(17,'Packaging Slot','packagingslots.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-06 08:53:15','2017-12-06 08:53:15'),(18,'Delivery to Processing Center','deliveries.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-06 08:53:15','2017-12-06 08:53:15'),(19,'Received by Processing Center','receiveds.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-06 08:53:15','2017-12-06 08:53:15'),(20,'Shipment Tracking','shipmenttrackings.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-06 08:53:15','2017-12-06 08:53:15'),(21,'Setting','roles.|users.|shipmentstatuses.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',NULL,'2017-12-06 08:53:15','2017-12-06 08:53:15'),(22,'Shipment Status','shipmentstatuses.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',21,'2017-12-06 08:53:15','2017-12-06 08:53:15'),(23,'User Application','roles.|users.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',21,'2017-12-06 08:53:15','2017-12-06 08:53:15'),(24,'Role List','roles.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',23,'2017-12-06 08:53:15','2017-12-06 08:53:15'),(25,'User List','users.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',23,'2017-12-06 08:53:15','2017-12-06 08:53:15');
/*!40000 ALTER TABLE `menu_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_10_26_232918_create_airlines_lists_table',1),(4,'2017_10_26_232936_create_airport_lists_table',1),(5,'2017_10_26_232951_create_bank_card_lists_table',1),(6,'2017_10_26_232958_create_bank_lists_table',1),(7,'2017_10_26_233005_create_city_lists_table',1),(8,'2017_10_26_233030_create_customer_lists_table',1),(9,'2017_10_26_233044_create_delivery_statuses_table',1),(10,'2017_10_26_233101_create_goods_categories_table',1),(11,'2017_10_26_233114_create_menu_lists_table',1),(12,'2017_10_26_233128_create_office_lists_table',1),(13,'2017_10_26_233136_create_office_types_table',1),(14,'2017_10_26_233157_create_packaging_deliveries_table',1),(15,'2017_10_26_233208_create_payment_types_table',1),(16,'2017_10_26_233224_create_price_lists_table',1),(17,'2017_10_26_233232_create_price_list_details_table',1),(18,'2017_10_26_233331_create_shipments_table',1),(19,'2017_10_26_233356_create_shipment_distributions_table',1),(20,'2017_10_26_233407_create_shipment_distribution_details_table',1),(21,'2017_10_26_233429_create_shipment_packagings_table',1),(22,'2017_10_26_233438_create_slot_lists_table',1),(23,'2017_10_26_233447_create_user_groups_table',1),(24,'2017_10_26_233454_create_user_group_menus_table',1),(25,'2017_10_26_233501_create_user_lists_table',1),(26,'2017_10_30_204150_create_permission_tables',1),(27,'2017_11_06_194153_create_daftar_barang_regulars_table',1),(28,'2017_11_06_194158_create_daftar_barang_golds_table',1),(29,'2017_11_08_020920_create_member_lists_table',1),(30,'2017_11_08_163650_create_airport_city_scope_tables',1),(31,'2017_11_09_161551_create_office_drop_point_table',1),(32,'2017_11_09_175034_create_insurances_table',1),(33,'2017_11_09_175044_create_weight_lists_table',1),(34,'2017_11_10_150654_create_shipment_statuses_table',1),(35,'2017_11_11_165021_add_show_name_to_permissions_table',1),(36,'2017_11_12_162035_create_price_goods_estimates_table',1),(37,'2017_11_16_041408_create_flight_booking_lists_table',1),(38,'2017_11_17_200151_create_delivery_shipments_table',1),(39,'2017_11_17_200218_create_delivery_shipment_details_table',1),(40,'2017_11_19_170148_create_city_list_airport_list',1),(41,'2017_11_22_124433_create_shipment_histories_table',1),(42,'2017_12_02_054830_create_packaging_lists_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,1,'App\\User');
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `office_drop_points`
--

DROP TABLE IF EXISTS `office_drop_points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `office_drop_points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_office` int(10) unsigned NOT NULL,
  `id_drop_point` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office_drop_points`
--

LOCK TABLES `office_drop_points` WRITE;
/*!40000 ALTER TABLE `office_drop_points` DISABLE KEYS */;
/*!40000 ALTER TABLE `office_drop_points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `office_lists`
--

DROP TABLE IF EXISTS `office_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `office_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_office_type` int(10) unsigned NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_city` int(10) unsigned NOT NULL,
  `id_office_counter` int(10) unsigned DEFAULT NULL,
  `id_airport` int(10) unsigned NOT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(12,7) NOT NULL,
  `longitude` decimal(12,7) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office_lists`
--

LOCK TABLES `office_lists` WRITE;
/*!40000 ALTER TABLE `office_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `office_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `office_types`
--

DROP TABLE IF EXISTS `office_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `office_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office_types`
--

LOCK TABLES `office_types` WRITE;
/*!40000 ALTER TABLE `office_types` DISABLE KEYS */;
INSERT INTO `office_types` VALUES (1,'Counter','2017-12-06 08:53:18','2017-12-06 08:53:18'),(2,'Processing Center','2017-12-06 08:53:18','2017-12-06 08:53:18');
/*!40000 ALTER TABLE `office_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packaging_deliveries`
--

DROP TABLE IF EXISTS `packaging_deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packaging_deliveries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `packaging_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deliveries_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packaging_deliveries`
--

LOCK TABLES `packaging_deliveries` WRITE;
/*!40000 ALTER TABLE `packaging_deliveries` DISABLE KEYS */;
/*!40000 ALTER TABLE `packaging_deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packaging_lists`
--

DROP TABLE IF EXISTS `packaging_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packaging_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `packaging_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_slot` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packaging_lists`
--

LOCK TABLES `packaging_lists` WRITE;
/*!40000 ALTER TABLE `packaging_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `packaging_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `s` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_s_index` (`s`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_types`
--

DROP TABLE IF EXISTS `payment_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_types`
--

LOCK TABLES `payment_types` WRITE;
/*!40000 ALTER TABLE `payment_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `show_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'citylists.','web','2017-12-06 08:53:15','2017-12-06 08:53:15','City List'),(2,'airlineslists.','web','2017-12-06 08:53:15','2017-12-06 08:53:15','Airline List'),(3,'airportlists.','web','2017-12-06 08:53:15','2017-12-06 08:53:15','Airport List'),(4,'officelists.','web','2017-12-06 08:53:15','2017-12-06 08:53:15','Office List'),(5,'officetypes.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Office Type'),(6,'banklists.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Bank List'),(7,'paymenttypes.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Payment Type'),(8,'pricelists.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Price List'),(9,'insurances.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Insurance'),(10,'memberlists.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Member List'),(11,'weightlists.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Weight List'),(12,'shipments.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Shipment List'),(13,'slotlists.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Slot List'),(14,'packagingslots.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Packaging Slot'),(15,'deliveries.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Shipment Delivery to Processing Center'),(16,'receiveds.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Shipment Received by Processing Center'),(17,'shipmenttrackings.','web','2017-12-06 08:53:16','2017-12-06 08:53:16','Shipment Tracking'),(18,'shipmentstatuses.','web','2017-12-06 08:53:17','2017-12-06 08:53:17','Shipment Status'),(19,'roles.','web','2017-12-06 08:53:17','2017-12-06 08:53:17','Role List'),(20,'users.','web','2017-12-06 08:53:17','2017-12-06 08:53:17','User List'),(21,'permissions.','web','2017-12-06 08:53:17','2017-12-06 08:53:17','Permission Management');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_goods_estimates`
--

DROP TABLE IF EXISTS `price_goods_estimates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_goods_estimates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price_estimate` decimal(18,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_goods_estimates`
--

LOCK TABLES `price_goods_estimates` WRITE;
/*!40000 ALTER TABLE `price_goods_estimates` DISABLE KEYS */;
INSERT INTO `price_goods_estimates` VALUES (1,250000.00,NULL,NULL),(2,500000.00,NULL,NULL),(3,1000000.00,NULL,NULL),(4,2000000.00,NULL,NULL),(5,5000000.00,NULL,NULL),(6,10000000.00,NULL,NULL),(7,20000000.00,NULL,NULL),(8,300000000.00,NULL,NULL),(9,500000000.00,NULL,NULL);
/*!40000 ALTER TABLE `price_goods_estimates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_list_details`
--

DROP TABLE IF EXISTS `price_list_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_list_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_airline` int(10) unsigned NOT NULL,
  `id_airport_origin` int(10) unsigned NOT NULL,
  `id_airport_destination` int(10) unsigned NOT NULL,
  `id_goods_category` int(10) unsigned NOT NULL,
  `tipster_price_per_kg` decimal(18,2) NOT NULL,
  `freigh_price_per_kg` decimal(18,2) NOT NULL,
  `packaging_price_per_kg` decimal(18,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_list_details`
--

LOCK TABLES `price_list_details` WRITE;
/*!40000 ALTER TABLE `price_list_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `price_list_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_lists`
--

DROP TABLE IF EXISTS `price_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_origin_city` int(10) unsigned NOT NULL,
  `id_destination_city` int(10) unsigned NOT NULL,
  `tipster_price` decimal(18,2) NOT NULL,
  `freight_cost` decimal(18,2) NOT NULL,
  `add_first_class` decimal(18,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_lists`
--

LOCK TABLES `price_lists` WRITE;
/*!40000 ALTER TABLE `price_lists` DISABLE KEYS */;
INSERT INTO `price_lists` VALUES (1,1,2,11000.00,13000.00,4000.00,NULL,NULL),(2,1,3,13000.00,15000.00,5000.00,NULL,NULL),(3,1,4,18000.00,20000.00,4000.00,NULL,NULL),(4,2,1,18000.00,20000.00,4000.00,NULL,NULL),(5,2,3,14000.00,16000.00,5000.00,NULL,NULL),(6,2,4,14000.00,16000.00,4000.00,NULL,NULL),(7,3,1,10000.00,12000.00,5000.00,NULL,NULL),(8,3,2,10000.00,12000.00,4000.00,NULL,NULL),(9,3,4,13000.00,15000.00,3000.00,NULL,NULL),(10,4,1,13000.00,15000.00,5000.00,NULL,NULL),(11,4,2,19000.00,21000.00,5000.00,NULL,NULL),(12,4,3,11000.00,13000.00,4000.00,NULL,NULL);
/*!40000 ALTER TABLE `price_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2017-12-06 08:53:13','2017-12-06 08:53:13');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipment_distribution_details`
--

DROP TABLE IF EXISTS `shipment_distribution_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipment_distribution_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment_distribution_details`
--

LOCK TABLES `shipment_distribution_details` WRITE;
/*!40000 ALTER TABLE `shipment_distribution_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipment_distribution_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipment_distributions`
--

DROP TABLE IF EXISTS `shipment_distributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipment_distributions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment_distributions`
--

LOCK TABLES `shipment_distributions` WRITE;
/*!40000 ALTER TABLE `shipment_distributions` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipment_distributions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipment_histories`
--

DROP TABLE IF EXISTS `shipment_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipment_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_shipment` int(10) unsigned NOT NULL,
  `id_shipment_status` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment_histories`
--

LOCK TABLES `shipment_histories` WRITE;
/*!40000 ALTER TABLE `shipment_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipment_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipment_packagings`
--

DROP TABLE IF EXISTS `shipment_packagings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipment_packagings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment_packagings`
--

LOCK TABLES `shipment_packagings` WRITE;
/*!40000 ALTER TABLE `shipment_packagings` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipment_packagings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipment_statuses`
--

DROP TABLE IF EXISTS `shipment_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipment_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `step` int(10) unsigned NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shipment_statuses_step_unique` (`step`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment_statuses`
--

LOCK TABLES `shipment_statuses` WRITE;
/*!40000 ALTER TABLE `shipment_statuses` DISABLE KEYS */;
INSERT INTO `shipment_statuses` VALUES (1,1,'Menunggu Petugas TIPS.','2017-12-06 08:53:19','2017-12-06 08:53:19'),(2,2,'Bagasi diproses TIPS.','2017-12-06 08:53:19','2017-12-06 08:53:19'),(3,3,'Menunggu diambil TIPSter.','2017-12-06 08:53:19','2017-12-06 08:53:19'),(4,4,'Barang diambil TIPSter.','2017-12-06 08:53:19','2017-12-06 08:53:19'),(5,5,'Barang masuk bagasi pesawat.','2017-12-06 08:53:20','2017-12-06 08:53:20'),(6,6,'Sampai di konter TIPS kota tujuan.','2017-12-06 08:53:20','2017-12-06 08:53:20'),(7,7,'Barang telah sampai.','2017-12-06 08:53:20','2017-12-06 08:53:20');
/*!40000 ALTER TABLE `shipment_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipments`
--

DROP TABLE IF EXISTS `shipments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shipment_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT '1',
  `transaction_date` date NOT NULL,
  `id_office` int(10) unsigned DEFAULT NULL,
  `id_slot` int(10) unsigned DEFAULT NULL,
  `id_origin_city` int(10) unsigned NOT NULL,
  `id_destination_city` int(10) unsigned NOT NULL,
  `is_first_class` tinyint(1) NOT NULL,
  `id_shipper` int(10) unsigned NOT NULL,
  `shipper_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipper_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipper_mobile_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipper_latitude` decimal(8,2) NOT NULL,
  `shipper_longitude` decimal(8,2) NOT NULL,
  `consignee_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consignee_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consignee_mobile_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispatch_type` enum('Pending','Process','Complete','Canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `is_online_payment` tinyint(1) DEFAULT NULL,
  `id_payment_type` int(10) unsigned NOT NULL,
  `shipment_contents` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estimate_goods_value` int(10) unsigned NOT NULL,
  `estimate_weight` int(10) unsigned NOT NULL,
  `flight_cost` int(10) unsigned DEFAULT NULL,
  `insurance_cost` int(10) unsigned NOT NULL,
  `is_add_insurance` tinyint(1) NOT NULL,
  `add_insurance_cost` int(10) unsigned NOT NULL,
  `add_notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_bank` int(10) unsigned DEFAULT NULL,
  `bank_card_type` int(10) unsigned DEFAULT NULL,
  `card_no` int(10) unsigned DEFAULT NULL,
  `card_expired_date` date DEFAULT NULL,
  `card_security_code` int(10) unsigned DEFAULT NULL,
  `id_shipment_status` int(10) unsigned NOT NULL DEFAULT '1',
  `shipment_status_update_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_packaging` int(10) unsigned DEFAULT NULL,
  `packaging_date` date DEFAULT NULL,
  `packaging_time` time DEFAULT NULL,
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_time` timestamp NULL DEFAULT NULL,
  `received_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_posted` tinyint(1) NOT NULL DEFAULT '0',
  `detail_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipments`
--

LOCK TABLES `shipments` WRITE;
/*!40000 ALTER TABLE `shipments` DISABLE KEYS */;
INSERT INTO `shipments` VALUES (1,'ASB999',1,'2017-11-07',NULL,NULL,1,2,1,1,'DIKA','Jalan','112',12.22,99.11,'PAPA','Jalan2','911','Pending',NULL,0,'BUKU',5000,6,NULL,1000,1,102,NULL,NULL,NULL,NULL,NULL,NULL,1,'2017-12-06 15:53:11',NULL,NULL,NULL,NULL,'2017-11-06 19:00:00',NULL,0,NULL,'2017-12-06 08:53:11','2017-12-06 08:53:11'),(2,'ASB1000',1,'2017-11-07',NULL,NULL,1,2,1,1,'DIKA','Jalan','112',12.22,99.11,'PAPA','Jalan2','911','Pending',NULL,0,'BUKU',5000,6,NULL,1000,1,102,NULL,NULL,NULL,NULL,NULL,NULL,1,'2017-12-06 15:53:11',NULL,NULL,NULL,NULL,'2017-11-07 05:00:00',NULL,0,NULL,'2017-12-06 08:53:11','2017-12-06 08:53:11');
/*!40000 ALTER TABLE `shipments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slot_lists`
--

DROP TABLE IF EXISTS `slot_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slot_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slot_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_member` int(10) unsigned NOT NULL,
  `booking_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispatch_type` enum('Pending','Process','Complete','Canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `id_airline` int(10) unsigned NOT NULL,
  `id_origin_airport` int(10) unsigned NOT NULL,
  `id_destination_airport` int(10) unsigned NOT NULL,
  `origin_city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depature` datetime NOT NULL,
  `arrival` datetime NOT NULL,
  `flight_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `baggage_space` int(10) unsigned NOT NULL,
  `sold_baggage_space` int(10) unsigned NOT NULL DEFAULT '0',
  `slot_price_kg` int(10) unsigned NOT NULL,
  `id_slot_status` int(10) unsigned NOT NULL DEFAULT '1',
  `photo_tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slot_lists_booking_code_unique` (`booking_code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slot_lists`
--

LOCK TABLES `slot_lists` WRITE;
/*!40000 ALTER TABLE `slot_lists` DISABLE KEYS */;
INSERT INTO `slot_lists` VALUES (1,'AAAB',1,'AV12453','Pending',0,1,4,'ZZZ1','UUU1','2017-11-07 07:00:00','2017-11-07 09:00:00','AWWWW',30,0,12542,1,NULL,NULL,'2017-12-06 08:53:11','2017-12-06 08:53:11'),(2,'AAAB',1,'AW12454','Pending',0,1,6,'ZZZ2','UUU2','2017-11-07 11:00:00','2017-11-07 12:00:00','AWWWW',30,0,12542,1,NULL,NULL,'2017-12-06 08:53:11','2017-12-06 08:53:11'),(3,'AAAB',1,'AX12455','Pending',0,7,2,'ZZZ3','UUU3','2017-11-07 08:00:00','2017-11-07 10:00:00','AWWWW',30,0,12542,1,NULL,NULL,'2017-12-06 08:53:11','2017-12-06 08:53:11');
/*!40000 ALTER TABLE `slot_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group_menus`
--

DROP TABLE IF EXISTS `user_group_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group_menus`
--

LOCK TABLES `user_group_menus` WRITE;
/*!40000 ALTER TABLE `user_group_menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_group_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_lists`
--

DROP TABLE IF EXISTS `user_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_lists`
--

LOCK TABLES `user_lists` WRITE;
/*!40000 ALTER TABLE `user_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin','$2y$10$K3vRsUOzg5YFuVYwp.HECuboXaXgarmlgpbAa6hPf/0h8FF6LH5NK',NULL,'2017-12-06 08:53:14','2017-12-06 08:53:14');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weight_lists`
--

DROP TABLE IF EXISTS `weight_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weight_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weight_kg` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weight_lists`
--

LOCK TABLES `weight_lists` WRITE;
/*!40000 ALTER TABLE `weight_lists` DISABLE KEYS */;
INSERT INTO `weight_lists` VALUES (1,1,1,NULL,NULL),(2,2,1,NULL,NULL),(3,3,1,NULL,NULL),(4,4,1,NULL,NULL),(5,5,1,NULL,NULL),(6,6,1,NULL,NULL),(7,7,1,NULL,NULL),(8,8,1,NULL,NULL),(9,9,1,NULL,NULL),(10,10,1,NULL,NULL),(11,11,1,NULL,NULL),(12,12,1,NULL,NULL),(13,13,1,NULL,NULL),(14,14,1,NULL,NULL),(15,15,1,NULL,NULL),(16,16,1,NULL,NULL),(17,17,1,NULL,NULL),(18,18,1,NULL,NULL),(19,19,1,NULL,NULL);
/*!40000 ALTER TABLE `weight_lists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-06 22:53:32
