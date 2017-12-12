-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: tips
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
INSERT INTO `airport_lists` VALUES (1,'Husein Sastranegara International Airport','BDO',1,1,'2017-12-12 09:18:03','2017-12-12 09:18:03'),(2,'Blimbingsari Airport','BWX',1,3,'2017-12-12 09:18:03','2017-12-12 09:18:03'),(3,'Penggung Airport','CBN',1,3,'2017-12-12 09:18:03','2017-12-12 09:18:03'),(4,'Tunggul Wulung Airport','CXP',1,3,'2017-12-12 09:18:03','2017-12-12 09:18:03'),(5,'Pondok Cabe Airport','PCB',1,3,'2017-12-12 09:18:03','2017-12-12 09:18:03'),(6,'Halim Perdanakusuma International Airport','HLP',1,2,'2017-12-12 09:18:03','2017-12-12 09:18:03'),(7,'Soekarno–Hatta International Airport','CGK',1,2,'2017-12-12 09:18:04','2017-12-12 09:18:04');
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
INSERT INTO `city_lists` VALUES (1,'Bandung','2017-12-12 09:18:03','2017-12-12 09:18:03'),(2,'Jakarta','2017-12-12 09:18:03','2017-12-12 09:18:03'),(3,'Medan','2017-12-12 09:18:03','2017-12-12 09:18:03'),(4,'Surabaya','2017-12-12 09:18:03','2017-12-12 09:18:03');
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
INSERT INTO `daftar_barang_golds` VALUES (1,1,0,'2017-12-12 09:18:05','2017-12-12 09:18:05'),(2,2,0,'2017-12-12 09:18:05','2017-12-12 09:18:05');
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
INSERT INTO `delivery_statuses` VALUES (1,1,'Menunggu Barang Hantaran.','2017-12-12 09:18:14','2017-12-12 09:18:14'),(2,2,'Barang hantaran tersedia. Konfirmasi ketersediaan mengantar.','2017-12-12 09:18:14','2017-12-12 09:18:14'),(3,3,'Ambil paket hantaran.','2017-12-12 09:18:14','2017-12-12 09:18:14'),(4,4,'Cek in/Drop bagasi & foto tag.','2017-12-12 09:18:14','2017-12-12 09:18:14'),(5,5,'Serahkan tag bagasi.','2017-12-12 09:18:14','2017-12-12 09:18:14'),(6,6,'Tag telah diterima dan bagasi sedang diverifikasi.','2017-12-12 09:18:14','2017-12-12 09:18:14'),(7,7,'Bagasi Anda telah diverifikasi. Selesai.','2017-12-12 09:18:15','2017-12-12 09:18:15');
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
INSERT INTO `flight_booking_lists` VALUES (1,'KZ2T78',1,7,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','MUOHH',NULL,NULL),(2,'B08PGM',1,3,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','FIBD1',NULL,NULL),(3,'U3SLIC',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','2UBBK',NULL,NULL),(4,'HI8LPC',1,2,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','NR7XY',NULL,NULL),(5,'ZXHP0U',1,7,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','XAJ4M',NULL,NULL),(6,'6ZBX98',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','APIGS',NULL,NULL),(7,'6DGIMQ',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','3RT11',NULL,NULL),(8,'YYVDDG',1,2,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','L7ZOT',NULL,NULL),(9,'KSVSEY',1,7,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','RFGAU',NULL,NULL),(10,'K5DU9M',1,7,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','PDA8Y',NULL,NULL),(11,'53ZNA5',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','58VYG',NULL,NULL),(12,'SDXF3W',1,3,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','L082I',NULL,NULL),(13,'PH0UGN',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','UW088',NULL,NULL),(14,'KERDZ6',1,1,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','864VO',NULL,NULL),(15,'T8I6HS',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','KLWNT',NULL,NULL),(16,'07LEJH',1,1,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','N2UB9',NULL,NULL),(17,'3TEIB0',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','8KLJS',NULL,NULL),(18,'MZ7SRN',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','QRZGW',NULL,NULL),(19,'V02PII',1,6,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','YF163',NULL,NULL),(20,'6W0QQ9',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','0G7U7',NULL,NULL),(21,'EXUDK7',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','T3BJY',NULL,NULL),(22,'GWW7BQ',1,6,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','SIIT6',NULL,NULL),(23,'ATOJQ6',1,1,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','GA80P',NULL,NULL),(24,'T8Q7U4',1,5,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','T195X',NULL,NULL),(25,'NXHG4K',1,6,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','KQEQG',NULL,NULL),(26,'QEUSRA',1,4,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','0U79H',NULL,NULL),(27,'0ELVSE',1,3,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','CYB6F',NULL,NULL),(28,'PPZ3ZZ',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','1UHC0',NULL,NULL),(29,'JVJBEE',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','TTXV3',NULL,NULL),(30,'5PRG9Z',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','M009B',NULL,NULL),(31,'PPA4WC',1,7,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','CDZC0',NULL,NULL),(32,'1QKPDF',1,2,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','O4UCW',NULL,NULL),(33,'LNLQ06',1,2,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','FYPZ7',NULL,NULL),(34,'EI73VQ',1,2,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','2YD3F',NULL,NULL),(35,'Q05XUZ',1,5,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','JHL1R',NULL,NULL),(36,'TBNXCW',1,5,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','OOKPD',NULL,NULL),(37,'AE5Y1E',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','1JZVH',NULL,NULL),(38,'0WGKOP',1,2,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','2HCGN',NULL,NULL),(39,'C46202',1,2,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','ZWV2C',NULL,NULL),(40,'5GXSZT',1,6,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','LY5K2',NULL,NULL),(41,'5BZZM3',1,4,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','WOBSY',NULL,NULL),(42,'1ZQYHX',1,4,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','KRG4X',NULL,NULL),(43,'EAE5Q8',1,6,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','PKLBA',NULL,NULL),(44,'W1PO50',1,7,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','GIKAR',NULL,NULL),(45,'P5J7OO',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','6ZTCE',NULL,NULL),(46,'DE4C4K',1,2,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','0JYIF',NULL,NULL),(47,'YLQR0I',1,1,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','OIJ5R',NULL,NULL),(48,'PCR809',1,6,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','V50VB',NULL,NULL),(49,'796WVG',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','JWB6N',NULL,NULL),(50,'MZ68HO',1,4,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','BFWNJ',NULL,NULL),(51,'ADLDHG',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','LVFDN',NULL,NULL),(52,'XHDRV7',1,1,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','X9ONT',NULL,NULL),(53,'JAAZDX',1,1,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','2NL7F',NULL,NULL),(54,'4XPGT6',1,3,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','W82DY',NULL,NULL),(55,'05A4L4',1,1,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','331X4',NULL,NULL),(56,'ESUU3B',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','4694X',NULL,NULL),(57,'1O0OAH',1,6,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','GLEUC',NULL,NULL),(58,'PZME91',1,2,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','DJDAU',NULL,NULL),(59,'X4KJ8P',1,3,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','WMKXD',NULL,NULL),(60,'GEAZQF',1,6,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','C1RD6',NULL,NULL),(61,'MZ48S0',1,3,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','UXZWS',NULL,NULL),(62,'0TIIIF',1,3,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','TPHQE',NULL,NULL),(63,'HSU7IJ',1,6,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','4MZBF',NULL,NULL),(64,'ITCQYG',1,6,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','LTSZU',NULL,NULL),(65,'DVCH96',1,1,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','AI9BO',NULL,NULL),(66,'OPMBML',1,1,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','TO19O',NULL,NULL),(67,'0VL8P2',1,7,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','L8YNO',NULL,NULL),(68,'1TAWCL',1,1,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','2NX35',NULL,NULL),(69,'6R99EM',1,4,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','XCVOZ',NULL,NULL),(70,'NAY5YY',1,2,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','P0E8W',NULL,NULL),(71,'W61T0Y',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','VG4LR',NULL,NULL),(72,'FZG48O',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','USBHY',NULL,NULL),(73,'V1SNUA',1,1,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','CFSFJ',NULL,NULL),(74,'GPOIAK',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','OIXE0',NULL,NULL),(75,'9G62D7',1,1,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','YQIBM',NULL,NULL),(76,'TJV8AL',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','JJC33',NULL,NULL),(77,'XCHV96',1,1,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','07V98',NULL,NULL),(78,'ENCMY2',1,7,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','YHEP5',NULL,NULL),(79,'Q78DQ8',1,3,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','BU4XY',NULL,NULL),(80,'H6TA4I',1,2,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','AMEVV',NULL,NULL),(81,'I5FL8K',1,1,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','2DFD1',NULL,NULL),(82,'ZO1BEZ',1,1,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','CNNDG',NULL,NULL),(83,'M34J8S',1,5,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','2QSXU',NULL,NULL),(84,'FAH7QX',1,7,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','3NDBS',NULL,NULL),(85,'JU44VZ',1,4,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','OAQIK',NULL,NULL),(86,'BNKO4M',1,2,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','S9CTK',NULL,NULL),(87,'T5Y6HO',1,7,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','RWNTH',NULL,NULL),(88,'W6FJ91',1,2,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','TBPK3',NULL,NULL),(89,'QRFPG8',1,2,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','JSXIL',NULL,NULL),(90,'F1MM13',1,6,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','XNEQ4',NULL,NULL),(91,'TWABBD',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','4J2UB',NULL,NULL),(92,'3JHXHA',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','BFW1E',NULL,NULL),(93,'JRK0W7',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','HXPIU',NULL,NULL),(94,'UK6755',1,2,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','ECMJO',NULL,NULL),(95,'G1EG38',1,7,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','QPZEV',NULL,NULL),(96,'GXW8VJ',1,4,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','A1R2Y',NULL,NULL),(97,'6TQLVW',1,3,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','FDHCN',NULL,NULL),(98,'LG43EY',1,3,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','L2L8H',NULL,NULL),(99,'D1AOH2',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','PW8AJ',NULL,NULL),(100,'B3J1YY',1,7,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','6Z08F',NULL,NULL);
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
INSERT INTO `insurances` VALUES (1,0.00,0,'2017-12-12 09:18:12','2017-12-12 09:18:12');
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
  `profil_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
INSERT INTO `member_lists` VALUES (1,'testHAha','test@test.com','$2y$10$C8xHDCdmjxt/xhnhn5qLOe2vCM3HT.OAdSaDG45V9FwZC/zsQB7Gq','+62123456789','2017-12-12',NULL,'1990-01-01','Test Address',1,1,NULL,'2017-12-12 09:18:04','2017-12-12 09:18:04'),(2,'test','test@test.com','$2y$10$iVLHyDLU1iXNyhPJzplan.FDIItA9zweKHpVX.K1ux13MHIcrS7hi','+62123456789','2017-12-12',NULL,'1990-01-01','Test Address',1,1,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_lists`
--

LOCK TABLES `menu_lists` WRITE;
/*!40000 ALTER TABLE `menu_lists` DISABLE KEYS */;
INSERT INTO `menu_lists` VALUES (1,'Master File','officetypes.|officelists.|citylists.|airlineslists.|airportlists.|banklists.|paymenttypes.|pricelists.|insurances.|weightlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',NULL,'2017-12-12 09:18:07','2017-12-12 09:18:07'),(2,'City List','citylists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-12 09:18:07','2017-12-12 09:18:07'),(3,'Airline List','airlineslists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-12 09:18:07','2017-12-12 09:18:07'),(4,'Airport List','airportlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(5,'Office List','officetypes.|officelists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(6,'Office Type','officetypes.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',5,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(7,'Office List','officelists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',5,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(8,'Bank List','banklists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(9,'Payment Type','paymenttypes.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(10,'Price List','pricelists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(11,'Member List','memberlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(12,'Insurance','insurances.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(13,'Weight List','weightlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(14,'Transaction','shipments.|slotlists.|deliveries.|receiveds.|shipmenttrackings.|packagingslots.|packagingprocessingcenters.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',NULL,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(15,'Shipment List','shipments.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(16,'Slot List','slotlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(17,'Packaging Slot','packagingslots.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(18,'Delivery to Processing Center','deliveries.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(19,'Processing Center Package List','packagingprocessingcenters.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(20,'Received by Processing Center','receiveds.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(21,'Shipment Tracking','shipmenttrackings.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',14,'2017-12-12 09:18:08','2017-12-12 09:18:08'),(22,'Setting','roles.|users.|shipmentstatuses.|terms.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',NULL,'2017-12-12 09:18:09','2017-12-12 09:18:09'),(23,'Term and Agreement','terms.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',22,'2017-12-12 09:18:09','2017-12-12 09:18:09'),(24,'Shipment Status','shipmentstatuses.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',22,'2017-12-12 09:18:09','2017-12-12 09:18:09'),(25,'Backup Database','backups.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',22,'2017-12-12 09:18:09','2017-12-12 09:18:09'),(26,'User Application','roles.|users.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',22,'2017-12-12 09:18:09','2017-12-12 09:18:09'),(27,'Role List','roles.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',26,'2017-12-12 09:18:09','2017-12-12 09:18:09'),(28,'User List','users.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',26,'2017-12-12 09:18:09','2017-12-12 09:18:09');
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_10_26_232918_create_airlines_lists_table',1),(4,'2017_10_26_232936_create_airport_lists_table',1),(5,'2017_10_26_232951_create_bank_card_lists_table',1),(6,'2017_10_26_232958_create_bank_lists_table',1),(7,'2017_10_26_233005_create_city_lists_table',1),(8,'2017_10_26_233030_create_customer_lists_table',1),(9,'2017_10_26_233044_create_delivery_statuses_table',1),(10,'2017_10_26_233101_create_goods_categories_table',1),(11,'2017_10_26_233114_create_menu_lists_table',1),(12,'2017_10_26_233128_create_office_lists_table',1),(13,'2017_10_26_233136_create_office_types_table',1),(14,'2017_10_26_233157_create_packaging_deliveries_table',1),(15,'2017_10_26_233208_create_payment_types_table',1),(16,'2017_10_26_233224_create_price_lists_table',1),(17,'2017_10_26_233232_create_price_list_details_table',1),(18,'2017_10_26_233331_create_shipments_table',1),(19,'2017_10_26_233356_create_shipment_distributions_table',1),(20,'2017_10_26_233407_create_shipment_distribution_details_table',1),(21,'2017_10_26_233429_create_shipment_packagings_table',1),(22,'2017_10_26_233438_create_slot_lists_table',1),(23,'2017_10_26_233447_create_user_groups_table',1),(24,'2017_10_26_233454_create_user_group_menus_table',1),(25,'2017_10_26_233501_create_user_lists_table',1),(26,'2017_10_30_204150_create_permission_tables',1),(27,'2017_11_06_194153_create_daftar_barang_regulars_table',1),(28,'2017_11_06_194158_create_daftar_barang_golds_table',1),(29,'2017_11_08_020920_create_member_lists_table',1),(30,'2017_11_08_163650_create_airport_city_scope_tables',1),(31,'2017_11_09_161551_create_office_drop_point_table',1),(32,'2017_11_09_175034_create_insurances_table',1),(33,'2017_11_09_175044_create_weight_lists_table',1),(34,'2017_11_10_150654_create_shipment_statuses_table',1),(35,'2017_11_11_165021_add_show_name_to_permissions_table',1),(36,'2017_11_12_162035_create_price_goods_estimates_table',1),(37,'2017_11_16_041408_create_flight_booking_lists_table',1),(38,'2017_11_17_200151_create_delivery_shipments_table',1),(39,'2017_11_17_200218_create_delivery_shipment_details_table',1),(40,'2017_11_19_170148_create_city_list_airport_list',1),(41,'2017_11_22_124433_create_shipment_histories_table',1),(42,'2017_12_02_054830_create_packaging_lists_table',1),(43,'2017_12_10_044548_create_terms_table',1);
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
INSERT INTO `office_types` VALUES (1,'Counter','2017-12-12 09:18:12','2017-12-12 09:18:12'),(2,'Processing Center','2017-12-12 09:18:12','2017-12-12 09:18:12');
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'citylists.','web','2017-12-12 09:18:09','2017-12-12 09:18:09','City List'),(2,'airlineslists.','web','2017-12-12 09:18:09','2017-12-12 09:18:09','Airline List'),(3,'airportlists.','web','2017-12-12 09:18:09','2017-12-12 09:18:09','Airport List'),(4,'officelists.','web','2017-12-12 09:18:09','2017-12-12 09:18:09','Office List'),(5,'officetypes.','web','2017-12-12 09:18:09','2017-12-12 09:18:09','Office Type'),(6,'banklists.','web','2017-12-12 09:18:09','2017-12-12 09:18:09','Bank List'),(7,'paymenttypes.','web','2017-12-12 09:18:09','2017-12-12 09:18:09','Payment Type'),(8,'pricelists.','web','2017-12-12 09:18:09','2017-12-12 09:18:09','Price List'),(9,'insurances.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Insurance'),(10,'memberlists.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Member List'),(11,'weightlists.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Weight List'),(12,'shipments.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Shipment List'),(13,'slotlists.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Slot List'),(14,'packagingslots.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Packaging Slot'),(15,'deliveries.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Shipment Delivery to Processing Center'),(16,'receiveds.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Shipment Received by Processing Center'),(17,'shipmenttrackings.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Shipment Tracking'),(18,'packagingprocessingcenters.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Processing Center Package List'),(19,'shipmentstatuses.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Shipment Status'),(20,'terms.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Term and Agreement'),(21,'backups.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Backup Database'),(22,'roles.','web','2017-12-12 09:18:10','2017-12-12 09:18:10','Role List'),(23,'users.','web','2017-12-12 09:18:11','2017-12-12 09:18:11','User List'),(24,'permissions.','web','2017-12-12 09:18:11','2017-12-12 09:18:11','Permission Management');
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
INSERT INTO `price_lists` VALUES (1,1,2,14000.00,16000.00,3000.00,NULL,NULL),(2,1,3,20000.00,22000.00,3000.00,NULL,NULL),(3,1,4,20000.00,22000.00,5000.00,NULL,NULL),(4,2,1,15000.00,17000.00,4000.00,NULL,NULL),(5,2,3,11000.00,13000.00,3000.00,NULL,NULL),(6,2,4,13000.00,15000.00,4000.00,NULL,NULL),(7,3,1,19000.00,21000.00,5000.00,NULL,NULL),(8,3,2,14000.00,16000.00,3000.00,NULL,NULL),(9,3,4,18000.00,20000.00,5000.00,NULL,NULL),(10,4,1,11000.00,13000.00,4000.00,NULL,NULL),(11,4,2,20000.00,22000.00,4000.00,NULL,NULL),(12,4,3,13000.00,15000.00,5000.00,NULL,NULL);
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
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1);
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
INSERT INTO `roles` VALUES (1,'admin','web','2017-12-12 09:18:07','2017-12-12 09:18:07');
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
INSERT INTO `shipment_statuses` VALUES (1,1,'Menunggu Petugas TIPS.','2017-12-12 09:18:14','2017-12-12 09:18:14'),(2,2,'Bagasi diproses TIPS.','2017-12-12 09:18:14','2017-12-12 09:18:14'),(3,3,'Menunggu diambil TIPSter.','2017-12-12 09:18:14','2017-12-12 09:18:14'),(4,4,'Barang diambil TIPSter.','2017-12-12 09:18:14','2017-12-12 09:18:14'),(5,5,'Barang masuk bagasi pesawat.','2017-12-12 09:18:14','2017-12-12 09:18:14'),(6,6,'Sampai di konter TIPS kota tujuan.','2017-12-12 09:18:14','2017-12-12 09:18:14'),(7,7,'Barang telah sampai.','2017-12-12 09:18:14','2017-12-12 09:18:14');
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
INSERT INTO `shipments` VALUES (1,'ASB999',1,'2017-11-07',NULL,NULL,1,2,1,1,'DIKA','Jalan','112',12.22,99.11,'PAPA','Jalan2','911','Pending',NULL,0,'BUKU',5000,6,NULL,1000,1,102,NULL,NULL,NULL,NULL,NULL,NULL,1,'2017-12-12 16:18:05',NULL,NULL,NULL,NULL,'2017-11-06 19:00:00',NULL,0,NULL,'2017-12-12 09:18:05','2017-12-12 09:18:05'),(2,'ASB1000',1,'2017-11-07',NULL,NULL,1,2,1,1,'DIKA','Jalan','112',12.22,99.11,'PAPA','Jalan2','911','Pending',NULL,0,'BUKU',5000,6,NULL,1000,1,102,NULL,NULL,NULL,NULL,NULL,NULL,1,'2017-12-12 16:18:05',NULL,NULL,NULL,NULL,'2017-11-07 05:00:00',NULL,0,NULL,'2017-12-12 09:18:05','2017-12-12 09:18:05');
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
INSERT INTO `slot_lists` VALUES (1,'AAAB',1,'AV12453','Pending',0,1,4,'ZZZ1','UUU1','2017-11-07 07:00:00','2017-11-07 09:00:00','AWWWW',30,0,12542,1,NULL,NULL,'2017-12-12 09:18:04','2017-12-12 09:18:04'),(2,'AAAB',1,'AW12454','Pending',0,1,6,'ZZZ2','UUU2','2017-11-07 11:00:00','2017-11-07 12:00:00','AWWWW',30,0,12542,1,NULL,NULL,'2017-12-12 09:18:04','2017-12-12 09:18:04'),(3,'AAAB',1,'AX12455','Pending',0,7,2,'ZZZ3','UUU3','2017-11-07 08:00:00','2017-11-07 10:00:00','AWWWW',30,0,12542,1,NULL,NULL,'2017-12-12 09:18:04','2017-12-12 09:18:04');
/*!40000 ALTER TABLE `slot_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terms`
--

DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terms`
--

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
INSERT INTO `terms` VALUES (1,'test content','2017-12-12 09:18:05','2017-12-12 09:18:05');
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
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
INSERT INTO `users` VALUES (1,'admin','admin','$2y$10$guTS2mV.d6C.vBy6UvOHfu9l4ylorWp01p0tilK2trEcDk8M3xoza',NULL,'2017-12-12 09:18:07','2017-12-12 09:18:07');
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

-- Dump completed on 2017-12-13  0:31:46
