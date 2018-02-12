-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: tips
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
INSERT INTO `airport_lists` VALUES (1,'Husein Sastranegara International Airport','BDO',1,1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(2,'Blimbingsari Airport','BWX',1,3,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(3,'Penggung Airport','CBN',1,3,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(4,'Tunggul Wulung Airport','CXP',1,3,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(5,'Pondok Cabe Airport','PCB',1,3,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(6,'Halim Perdanakusuma International Airport','HLP',1,2,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(7,'Soekarno–Hatta International Airport','CGK',1,2,'2018-02-12 09:35:16','2018-02-12 09:35:16');
/*!40000 ALTER TABLE `airport_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `airportcity_lists`
--

DROP TABLE IF EXISTS `airportcity_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `airportcity_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `airportcity_lists`
--

LOCK TABLES `airportcity_lists` WRITE;
/*!40000 ALTER TABLE `airportcity_lists` DISABLE KEYS */;
INSERT INTO `airportcity_lists` VALUES (1,'Bandung',NULL,NULL),(2,'Jakarta',NULL,NULL),(3,'Surabaya',NULL,NULL),(4,'Medan',NULL,NULL);
/*!40000 ALTER TABLE `airportcity_lists` ENABLE KEYS */;
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
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_province` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
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
  `id_province` int(10) unsigned NOT NULL,
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
INSERT INTO `city_lists` VALUES (1,1,'Jakarta Utara','2018-02-12 09:35:16','2018-02-12 09:35:16'),(2,1,'Jakarta Barat','2018-02-12 09:35:16','2018-02-12 09:35:16'),(3,1,'Jakarta Selatan','2018-02-12 09:35:16','2018-02-12 09:35:16'),(4,1,'Jakarta Pusat','2018-02-12 09:35:16','2018-02-12 09:35:16');
/*!40000 ALTER TABLE `city_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_zs`
--

DROP TABLE IF EXISTS `config_zs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config_zs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_zs`
--

LOCK TABLES `config_zs` WRITE;
/*!40000 ALTER TABLE `config_zs` DISABLE KEYS */;
INSERT INTO `config_zs` VALUES (1,'CRON_MINUTES_ROUTINE','0',NULL,'2018-02-12 09:36:01','2018-02-12 09:36:01');
/*!40000 ALTER TABLE `config_zs` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daftar_barang_golds`
--

LOCK TABLES `daftar_barang_golds` WRITE;
/*!40000 ALTER TABLE `daftar_barang_golds` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daftar_barang_regulars`
--

LOCK TABLES `daftar_barang_regulars` WRITE;
/*!40000 ALTER TABLE `daftar_barang_regulars` DISABLE KEYS */;
/*!40000 ALTER TABLE `daftar_barang_regulars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_departures`
--

DROP TABLE IF EXISTS `delivery_departures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_departures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `delivery_time` time NOT NULL DEFAULT '00:00:01',
  `created_by` int(10) unsigned NOT NULL,
  `is_posted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_departures`
--

LOCK TABLES `delivery_departures` WRITE;
/*!40000 ALTER TABLE `delivery_departures` DISABLE KEYS */;
INSERT INTO `delivery_departures` VALUES (1,'PD1802120001','2018-02-12','23:02:00',1,1,'2018-02-12 09:57:56','2018-02-12 09:58:04');
/*!40000 ALTER TABLE `delivery_departures` ENABLE KEYS */;
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
INSERT INTO `delivery_statuses` VALUES (1,1,'Menunggu Barang Hantaran.','2018-02-12 09:35:16','2018-02-12 09:35:16'),(2,2,'Barang hantaran tersedia. Konfirmasi ketersediaan mengantar.','2018-02-12 09:35:16','2018-02-12 09:35:16'),(3,3,'Ambil paket hantaran.','2018-02-12 09:35:16','2018-02-12 09:35:16'),(4,4,'Cek in/Drop bagasi & foto tag.','2018-02-12 09:35:16','2018-02-12 09:35:16'),(5,5,'Serahkan tag bagasi.','2018-02-12 09:35:16','2018-02-12 09:35:16'),(6,6,'Tag telah diterima dan bagasi sedang diverifikasi.','2018-02-12 09:35:16','2018-02-12 09:35:16'),(7,7,'Bagasi Anda telah diverifikasi. Selesai.','2018-02-12 09:35:16','2018-02-12 09:35:16');
/*!40000 ALTER TABLE `delivery_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_to_arrival_processing_center`
--

DROP TABLE IF EXISTS `delivery_to_arrival_processing_center`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_to_arrival_processing_center` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `delivery_time` time NOT NULL,
  `id_kantor_asal` int(10) unsigned DEFAULT NULL,
  `id_kantor_tujuan` int(10) unsigned DEFAULT NULL,
  `is_submit` int(10) unsigned DEFAULT NULL,
  `is_posted` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_to_arrival_processing_center`
--

LOCK TABLES `delivery_to_arrival_processing_center` WRITE;
/*!40000 ALTER TABLE `delivery_to_arrival_processing_center` DISABLE KEYS */;
INSERT INTO `delivery_to_arrival_processing_center` VALUES (1,'CD1802120001','2018-02-12',1,'23:02:00',NULL,NULL,NULL,1,'2018-02-12 10:15:06','2018-02-12 10:15:24');
/*!40000 ALTER TABLE `delivery_to_arrival_processing_center` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_to_arrival_processing_center_detil`
--

DROP TABLE IF EXISTS `delivery_to_arrival_processing_center_detil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery_to_arrival_processing_center_detil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `arrival_shipment_id` int(10) unsigned NOT NULL,
  `packaging_lists_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_to_arrival_processing_center_detil`
--

LOCK TABLES `delivery_to_arrival_processing_center_detil` WRITE;
/*!40000 ALTER TABLE `delivery_to_arrival_processing_center_detil` DISABLE KEYS */;
INSERT INTO `delivery_to_arrival_processing_center_detil` VALUES (3,1,1,'2018-02-12 10:15:24','2018-02-12 10:15:24');
/*!40000 ALTER TABLE `delivery_to_arrival_processing_center_detil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `districts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_city` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `districts`
--

LOCK TABLES `districts` WRITE;
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `espay_notifications`
--

DROP TABLE IF EXISTS `espay_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `espay_notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rq_uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rq_datetime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comm_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_cust_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `member_cust_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ccy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(13,2) unsigned NOT NULL,
  `debit_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit_from_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_to_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_datetime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_ref` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit_from_bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_to_bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approval_code_full_bca` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_code_installment_bca` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `espay_notifications`
--

LOCK TABLES `espay_notifications` WRITE;
/*!40000 ALTER TABLE `espay_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `espay_notifications` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flight_booking_lists`
--

LOCK TABLES `flight_booking_lists` WRITE;
/*!40000 ALTER TABLE `flight_booking_lists` DISABLE KEYS */;
INSERT INTO `flight_booking_lists` VALUES (1,'A7UA32',1,6,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','8BZ50',NULL,NULL),(2,'2B5WWZ',1,5,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','OTDBB',NULL,NULL),(3,'DI2ZX1',1,4,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','6RMWL',NULL,NULL),(4,'Q9AIEF',1,3,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','F1HMZ',NULL,NULL),(5,'9TMP11',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','OUV5G',NULL,NULL),(6,'AO2WP9',1,1,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','0H61N',NULL,NULL),(7,'TSPAT9',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','1PM2G',NULL,NULL),(8,'WLCFO0',1,7,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','GF7VG',NULL,NULL),(9,'UGQRIR',1,7,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','WIIWO',NULL,NULL),(10,'WN874U',1,5,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','X8VLS',NULL,NULL),(11,'2BX8G8',1,7,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','LUSHM',NULL,NULL),(12,'BSOMGA',1,7,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','P9LG2',NULL,NULL),(13,'7F6DVS',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','RM3VO',NULL,NULL),(14,'HV18SQ',1,6,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','ZMST7',NULL,NULL),(15,'HORVPU',1,4,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','WR5S2',NULL,NULL),(16,'SXGIY2',1,3,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','1M3YM',NULL,NULL),(17,'ORU28L',1,2,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','UC081',NULL,NULL),(18,'NK4FLZ',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','SG0YG',NULL,NULL),(19,'2FQO9O',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','UTVAA',NULL,NULL),(20,'8GTCXE',1,2,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','YU7IM',NULL,NULL),(21,'ILH2U2',1,6,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','CH25J',NULL,NULL),(22,'IL06Y1',1,5,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','FV1H1',NULL,NULL),(23,'B31KU0',1,5,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','FMLKD',NULL,NULL),(24,'CDKA7Y',1,5,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','YF2XR',NULL,NULL),(25,'WQ1XMI',1,5,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','N2CX3',NULL,NULL),(26,'A1W1LQ',1,2,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','IWLM8',NULL,NULL),(27,'N7KC5N',1,7,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','08JEY',NULL,NULL),(28,'UNUHIK',1,6,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','HL2WJ',NULL,NULL),(29,'WAUZC3',1,2,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','3LH1H',NULL,NULL),(30,'HXWG1S',1,5,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','Y4577',NULL,NULL),(31,'GIZI9Q',1,1,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','7JBZY',NULL,NULL),(32,'LA0T3L',1,5,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','36MII',NULL,NULL),(33,'OGB1VH',1,5,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','CT6NA',NULL,NULL),(34,'QV98R0',1,7,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','JS1FN',NULL,NULL),(35,'4OBF1T',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','SXRO5',NULL,NULL),(36,'53HHSU',1,6,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','PCHMC',NULL,NULL),(37,'RP3G1X',1,7,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','60LSO',NULL,NULL),(38,'DQ4GPU',1,1,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','GQ01D',NULL,NULL),(39,'RVQ55A',1,1,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','PNAEB',NULL,NULL),(40,'IR3NFV',1,4,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','0JPFD',NULL,NULL),(41,'T95GUS',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','DWR07',NULL,NULL),(42,'A5HTL5',1,1,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','H2ZT1',NULL,NULL),(43,'K5YWSZ',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','LDRKX',NULL,NULL),(44,'IUS63F',1,5,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','OPVQU',NULL,NULL),(45,'LCJJMH',1,5,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','63TFV',NULL,NULL),(46,'LN64LB',1,1,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','WQM2Y',NULL,NULL),(47,'8Y8291',1,2,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','DWQ4V',NULL,NULL),(48,'P6AO64',1,1,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','LCL7E',NULL,NULL),(49,'CFR8WR',1,3,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','2R9O7',NULL,NULL),(50,'2VLCEI',1,7,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','5GBTC',NULL,NULL),(51,'ZTEI0P',1,1,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','75DVP',NULL,NULL),(52,'YGUCFM',1,7,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','IY4C8',NULL,NULL),(53,'LDX9DK',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','14FFV',NULL,NULL),(54,'HRBJWV',1,4,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','DC4FL',NULL,NULL),(55,'7J5XK7',1,4,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','8DMKT',NULL,NULL),(56,'0LQXR9',1,7,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','QAAIH',NULL,NULL),(57,'B8PJCZ',1,7,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','L0XBZ',NULL,NULL),(58,'TQSOOD',1,2,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','HO0LP',NULL,NULL),(59,'T230OB',1,7,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','7MEJX',NULL,NULL),(60,'754YHP',1,4,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','3DP0L',NULL,NULL),(61,'4SRT7F',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','M3U9T',NULL,NULL),(62,'A0Y5FN',1,6,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','UJ34R',NULL,NULL),(63,'THKOWW',1,4,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','LDTSZ',NULL,NULL),(64,'73HJV8',1,6,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','QKKP5',NULL,NULL),(65,'Y9IINY',1,5,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','KS7FR',NULL,NULL),(66,'9BLUJ5',1,6,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','117E5',NULL,NULL),(67,'E2DSVI',1,7,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','EV4XY',NULL,NULL),(68,'EIAJUY',1,1,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','9E1G6',NULL,NULL),(69,'CTW1NR',1,7,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','9388G',NULL,NULL),(70,'XXVP32',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','OOB5C',NULL,NULL),(71,'AVZ9WF',1,2,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','5DI7T',NULL,NULL),(72,'MG2FB6',1,7,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','S770R',NULL,NULL),(73,'NYSUFK',1,1,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','4HOR1',NULL,NULL),(74,'HCABHS',1,5,7,'2017-12-29 12:20:00','2017-12-29 13:20:00','AVPKW',NULL,NULL),(75,'2DT6A5',1,5,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','WC24H',NULL,NULL),(76,'E2VISJ',1,7,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','6WS7U',NULL,NULL),(77,'BSW2IK',1,4,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','G0KWN',NULL,NULL),(78,'1N6YNT',1,2,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','HETVQ',NULL,NULL),(79,'ZLKIQF',1,7,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','7378J',NULL,NULL),(80,'LN4AAL',1,1,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','0ZNT9',NULL,NULL),(81,'5V8Q2T',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','XM01J',NULL,NULL),(82,'YDWKY8',1,7,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','J53I4',NULL,NULL),(83,'C93HQO',1,7,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','Z7D32',NULL,NULL),(84,'RSHQKG',1,7,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','NDWTX',NULL,NULL),(85,'RQ0CRD',1,7,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','I3X9W',NULL,NULL),(86,'65MU1J',1,4,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','Z5C8N',NULL,NULL),(87,'LJCADS',1,2,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','MP5ZA',NULL,NULL),(88,'4369SU',1,5,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','5761Y',NULL,NULL),(89,'0P7UIX',1,6,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','KMW55',NULL,NULL),(90,'E8TBC1',1,1,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','ME1DY',NULL,NULL),(91,'USJD6Q',1,5,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','EDU0O',NULL,NULL),(92,'6QS8QE',1,2,3,'2017-12-29 12:20:00','2017-12-29 13:20:00','83VNZ',NULL,NULL),(93,'4ANJLB',1,1,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','5B1JZ',NULL,NULL),(94,'CVRT83',1,2,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','KGGNJ',NULL,NULL),(95,'BKURC5',1,2,4,'2017-12-29 12:20:00','2017-12-29 13:20:00','YD9E7',NULL,NULL),(96,'V1PGIT',1,6,1,'2017-12-29 12:20:00','2017-12-29 13:20:00','7Q0CK',NULL,NULL),(97,'KXMGO6',1,4,6,'2017-12-29 12:20:00','2017-12-29 13:20:00','WV6YK',NULL,NULL),(98,'1T4JKV',1,5,2,'2017-12-29 12:20:00','2017-12-29 13:20:00','4I421',NULL,NULL),(99,'AOCK8R',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','0XVJI',NULL,NULL),(100,'WFYOGH',1,3,5,'2017-12-29 12:20:00','2017-12-29 13:20:00','7Z97V',NULL,NULL),(101,'GAKHGV',1,7,3,'2018-02-12 08:00:00','2018-02-12 10:00:00','ga175','2018-02-12 09:47:02','2018-02-12 09:47:02');
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
-- Table structure for table `help_tipsters`
--

DROP TABLE IF EXISTS `help_tipsters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `help_tipsters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `help_tipsters`
--

LOCK TABLES `help_tipsters` WRITE;
/*!40000 ALTER TABLE `help_tipsters` DISABLE KEYS */;
INSERT INTO `help_tipsters` VALUES (1,'Lacak Pengiriman','Pengirim barang melalui TIPS dapat menelusuri status kirimannya dengan memasukan kode lacak (yang didapatkan setelah menyerahkan barang kiriman di drop point TIPS) pada aplikasi TIPS atau situs TIPS.',NULL,NULL),(2,'Pengiriman','Untuk mengirim barang, unduh aplikasi TIPS di Apps Store atau Play Store. Daftarkan pengiriman Anda, kemudian antar barang tersebut ke Drop Point TIPS di\nkota Anda. Di Drop Point TIPS akan dilakukan pemeriksaan apakah barang yang akan dikirim memenuhi syarat yang berlaku untuk pengiriman barang di TIPS. Barang-barang yang tidak bisa diterima TIPS bisa dilihat pada menu Larangan di sebelah kiri. Setelah dilakukan penimbangan, pengirim dapat melakukan pembayaran dan mendapatkan Kode Lacak untuk menelusuri status pengiriman barang tersebut. Pengirim dan penerima akan mendapatkan notifikasi melalui email pada setiap tahapan proses pengiriman barang, termasuk saat barang yang dikirimkan telah Eba dan tersedia di kantor TIPS di kota tujuan. Pengiriman barang melalui TIPS menggunakan fasilitas bagasi penumpang pesawat. Dengan demikian, jenis-jenis barang yang dapat dikirimkan dengan TIPS harus memenuhi persyaratan sesuai yang berlaku untuk bagasi pesawat',NULL,NULL),(3,'Larangan','TIPS tidak melayani pengiriman barang-barang sebagai berikut:\\n1. Material korosif : Merkuri (terdapat dalam thermometer), asam sulfat, alkali  dan aki kendaraan.\\n2. Bahan Peledak: Semua tipe granat, detonator, sumbu, alat peledak;\\n3. Gas bertekanan (tidak dan yang mudah terbakar, atau yang beracun): Propana, butana, aerosol iritan kimiawi.\\n4. Cairan mudah terbakar: Bahan bakar, cat, thinner, perekat (lem), cairan pemantik api, methanol.\\n5. Benda padat mudah terbakar: kembang api, petasan, suar;\\n6. Zat oksidasi: bubuk pemutih, peroksida.\\n7. Material radioaktif.\\n8. Bahan kimia/zat beracun: arsenik, sianida, pembasmi hama/serangga, produk biologis yang berbahaya.\\n9. Koper dengan instalasi perangkat alarm, atau dilengkapi baterai lithium dan/atau material piroteknik.\\n10. Kendaraan kecil yang menggunakan baterai litium seperti airwheel, solowheel, hoverboard, mini-segway, balance wheel.\\n11. Alat pelumpuh: Pistol pengejut, alat kejut listrik, tongkat pukul listrik, termasuk alat pelumpuh untuk hewan.\\n12. Semprotan bela diri: Gas airmata dan semprotan asam fosfor\\n13. Senjata api dan amunisi\\n14. Rokok elektronik\\n15. Pemantik dan korek api',NULL,NULL),(4,'Mengambil Barang','Penerima barang akan mendapatkan notifikasi setelah barang tersedia di kantor TIPS di kota tujuan.\\nPenerima barang bisa mengambil barang di kantor TIPS dengan menunjukkan email notifikasi pengambilan barang dari TIPS.',NULL,NULL),(5,'TIPSTER','TIPSTER adalah Anda yang ingin memanfaatkan bagasi tidak terpakai dalam penerbangan Anda.\\n1. Daftarkan penerbangan Anda melalui aplikasi TIPS yang bisa diunduh di Apps Store dan Play Store. Masukan info jadwal penerbangan dan berapa kg ruang bagasi yang ingin Anda manfaatkan untuk TIPS.\\n2. Setelah mendapatkan notifikasi dari TIPS mengenai ketersediaan barang, lakukan konfirmasi kesediaan membawa barang.\\n3. Datang lebih awal, 3 jam sebelum jadwal penerbangan Anda, kunjungi counter TIPS di terminal keberangkatan, tunjukkan notifikasi TIPS dalam aplikasi Anda untuk mengambil barang.\\n4. Bawa barang TIPS ke counter check in penerbangan Anda. Foto luggage tag barang TIPS melalui aplikasi TIPS.\\n5. Terbang menuju kota tujuan.\\n6. Setelah tiba di kota tujuan, kunjungi counter TIPS di terminal kedatangan. Serahkan luggage tag kepada petugas TIPS.\\n7. Anda bisa meninggalkan bandara dan silakan menunggu konfirmasi masuknya insentif TIPS ke dalam TIPS Money Anda.',NULL,NULL),(6,'Insentif TIPSTER','Besaran insentif TIPS tergantung kepada rute penerbangan.\\nPerhitungan insentif berdasarkan satuan berat barang dengan pembulatan ke atas tiap kilogram. Berat minimal barang TIPS adalah 1 kg.\\nInsentif akan masuk secara otomatis ke dalam TIPS Money TIPSTER setelah barang yang dititipkan diterima di kantor TIPS di kota tujuan.',NULL,NULL),(7,'Akun','Untuk menjadi TIPSTER dan/atau pengirim barang melalui TIPS diwajibkan memiliki akun TIPS.\\nRegistrasi akun TIPS wajib menggunakan nama sesuai dengan identitas diri (KTP), untuk dicocokan dengan data penumpang pesawat.',NULL,NULL),(8,'Voucher & Promosi','Program promosi dan voucher dapat diselenggarakan oleh pihak TIPS dari waktu ke  waktu. Untuk informasi mengenai program promosi yang sedang berlaku, harap  selalu mengacu kepada media informasi resmi TIPS, seperti pada situs ini atau aplikasi TIPS.',NULL,NULL),(9,'Hubungi Kami','Apabila Anda menemui kendala atau permasalahan dalam menggunakan jasa TIPS, segera informasikan kepada petugas TIPS di bandara atau di kantor TIPS. Atau bisa  juga menghubungi email: bantuan@di.tips',NULL,NULL);
/*!40000 ALTER TABLE `help_tipsters` ENABLE KEYS */;
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
INSERT INTO `insurances` VALUES (1,0.00,0,'2018-02-12 09:35:16','2018-02-12 09:35:16');
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
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_phone_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registered_date` date NOT NULL,
  `profil_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `id_city` int(10) unsigned DEFAULT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_token` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_code` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_token` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uniq_social_id` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_lists`
--

LOCK TABLES `member_lists` WRITE;
/*!40000 ALTER TABLE `member_lists` DISABLE KEYS */;
INSERT INTO `member_lists` VALUES (1,'test','test','test@test.com','$2y$10$ECc1tWdTNAmXMomHDF04VOWd7/YHKs9oUttrPr2SCpLOsjenfHuBm','+62123456789','2018-02-12',NULL,'1990-01-01','Test Address',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'akhmad','benny','akhmad.benny@yahoo.com','$2y$10$NfvzS0jYZa8Z0WkL2.HtB.yme2QUCsqOPrej/hZrkdmrP72DGSFaC','081519487516','2018-02-12',NULL,NULL,NULL,1,NULL,'fChxTBWXtZs:APA91bEom2ZYlplEHrINSjrmqDWUKlBC3K6VhU3lvmCQMWX5PI2jRzxXOC6IpE_rc98tjHtZmZfCB66BN9JN03Ng41ds_r2Y2yv289jX3DxpgjG0G5wGYWm8_hYpM-EfEuESSK2VOAfd',NULL,'-1',NULL,NULL,'2018-02-12 09:37:15','2018-02-12 09:37:47'),(3,'n','n','n@a.a','$2y$10$6jr8QF317e.bxxtXebX6q.OmlJLo4FS3yyN.oGHra56gq4Hr78YkG','1','2018-02-12',NULL,NULL,NULL,1,NULL,'flhReyhhIyE:APA91bHowrMNGkF2U2WgtYCKl7rPVedJqZHdJx-TV47kWwia7jkJZ09DR7tLwmn52UJ41Cg4U6ovwHFMW-Tmuv1ladT3DpuVkEQ5HUG7XnMRKeGtmYj4Qz2x2FIyQaZBleGmlYnfjqvp',NULL,'610972',NULL,NULL,'2018-02-12 09:45:17','2018-02-12 09:45:17');
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
  `class_name` longtext COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',
  `menu_parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_lists`
--

LOCK TABLES `menu_lists` WRITE;
/*!40000 ALTER TABLE `menu_lists` DISABLE KEYS */;
INSERT INTO `menu_lists` VALUES (1,'Master File','*','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',NULL,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(2,'Region List','*','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(3,'Province List','provincelists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',2,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(4,'City List','citylists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',2,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(5,'Subdistrict List','subdistrictlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',2,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(6,'Airline List','airlineslists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(7,'Airport List','airportlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(8,'Airportcity List','airportcitylists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(9,'Office List','*','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(10,'Office Type','officetypes.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',9,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(11,'Office List','officelists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',9,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(12,'Bank List','banklists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(13,'Payment Type','paymenttypes.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(14,'Price List','pricelists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(15,'Member List','memberlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(16,'Insurance','insurances.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(17,'Weight List','weightlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(18,'Transaction','*','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',NULL,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(19,'Slot List','slotlists.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(20,'Packaging Slot','packagingslots.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(21,'Delivery to Processing Center','deliveries.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(22,'Received by Processing Center','receiveds.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(23,'Shipment Tracking','shipmenttrackings.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(24,'Packaging Rest Shipment','packagingrestshipments.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(25,'Shipment Drop Off List','shipmentdropoffs.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(26,'Shipment Pick Up List','shipmentpickups.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(27,'Shipment Matching Monitor','shipmentmatchingmonitors.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(28,'Delivery Package to Departure Counter','deliverydeparturecounters.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(29,'Pending Package at Departure Counter','pendingdeparturecounters.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(30,'Pending Package at Arrival Counter','pendingarrivalcounters.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(31,'Delivery Packaging to Arrival Processing Center','deliveryprocessingcenters.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(32,'Receive Packaging from Processing Center','receiveprocessingcenters.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',18,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(33,'Setting','*','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',NULL,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(34,'Term and Agreement','terms.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',33,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(35,'Shipment Status','shipmentstatuses.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',33,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(36,'Tipster Milestone','tipstermilestones.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',33,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(37,'User Application','*','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',33,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(38,'Role List','roles.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',37,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(39,'User List','users.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',37,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(40,'Utility','backups.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',NULL,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(41,'Backup Database','backups.','https://cdn3.iconfinder.com/data/icons/brain-games/1042/Brain-Games.png',40,'2018-02-12 09:35:16','2018-02-12 09:35:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=666 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (605,'2013_07_25_145943_create_languages_table',1),(606,'2013_07_25_145958_create_translations_table',1),(607,'2014_10_12_000000_create_users_table',1),(608,'2014_10_12_100000_create_password_resets_table',1),(609,'2016_06_02_124154_increase_locale_length',1),(610,'2017_10_26_232918_create_airlines_lists_table',1),(611,'2017_10_26_232936_create_airport_lists_table',1),(612,'2017_10_26_232951_create_bank_card_lists_table',1),(613,'2017_10_26_232958_create_bank_lists_table',1),(614,'2017_10_26_233005_create_city_lists_table',1),(615,'2017_10_26_233030_create_customer_lists_table',1),(616,'2017_10_26_233044_create_delivery_statuses_table',1),(617,'2017_10_26_233101_create_goods_categories_table',1),(618,'2017_10_26_233114_create_menu_lists_table',1),(619,'2017_10_26_233128_create_office_lists_table',1),(620,'2017_10_26_233136_create_office_types_table',1),(621,'2017_10_26_233157_create_packaging_deliveries_table',1),(622,'2017_10_26_233208_create_payment_types_table',1),(623,'2017_10_26_233224_create_price_lists_table',1),(624,'2017_10_26_233232_create_price_list_details_table',1),(625,'2017_10_26_233331_create_shipments_table',1),(626,'2017_10_26_233356_create_shipment_distributions_table',1),(627,'2017_10_26_233407_create_shipment_distribution_details_table',1),(628,'2017_10_26_233429_create_shipment_packagings_table',1),(629,'2017_10_26_233438_create_slot_lists_table',1),(630,'2017_10_26_233447_create_user_groups_table',1),(631,'2017_10_26_233454_create_user_group_menus_table',1),(632,'2017_10_26_233501_create_user_lists_table',1),(633,'2017_10_30_204150_create_permission_tables',1),(634,'2017_11_06_194153_create_daftar_barang_regulars_table',1),(635,'2017_11_06_194158_create_daftar_barang_golds_table',1),(636,'2017_11_08_020920_create_member_lists_table',1),(637,'2017_11_08_163650_create_airport_city_scope_tables',1),(638,'2017_11_09_161551_create_office_drop_point_table',1),(639,'2017_11_09_175034_create_insurances_table',1),(640,'2017_11_09_175044_create_weight_lists_table',1),(641,'2017_11_10_150654_create_shipment_statuses_table',1),(642,'2017_11_11_165021_add_show_name_to_permissions_table',1),(643,'2017_11_12_162035_create_price_goods_estimates_table',1),(644,'2017_11_16_041408_create_flight_booking_lists_table',1),(645,'2017_11_17_200151_create_delivery_shipments_table',1),(646,'2017_11_17_200218_create_delivery_shipment_details_table',1),(647,'2017_11_19_170148_create_city_list_airport_list',1),(648,'2017_11_22_124433_create_shipment_histories_table',1),(649,'2017_12_02_054830_create_packaging_lists_table',1),(650,'2017_12_10_044548_create_terms_table',1),(651,'2017_12_18_175417_create_tipster_milestones_table',1),(652,'2017_12_23_200158_create_office_airports_table',1),(653,'2017_12_30_074223_create_province_lists_table',1),(654,'2017_12_30_074231_create_subdistrict_lists_table',1),(655,'2017_12_30_102746_create_help_tipsters_table',1),(656,'2017_12_30_110113_create_airportcity_lists_table',1),(657,'2017_12_30_143245_create_districts_table',1),(658,'2017_12_30_143355_create_provinces_table',1),(659,'2017_12_30_143437_create_cities_table',1),(660,'2018_01_04_031140_create_transactions_table',1),(661,'2018_01_04_081104_create_espay_notifications_table',1),(662,'2018_01_22_183851_create_delivery_departures_table',1),(663,'2018_01_23_150110_create_config_zs_table',1),(664,'2018_02_11_075232_create_delivery_to_arrival_processing_center_table',1),(665,'2018_02_11_075932_create_delivery_to_arrival_processing_center_detil_table',1);
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
-- Table structure for table `office_airports`
--

DROP TABLE IF EXISTS `office_airports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `office_airports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_office` int(10) unsigned NOT NULL,
  `id_airport` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office_airports`
--

LOCK TABLES `office_airports` WRITE;
/*!40000 ALTER TABLE `office_airports` DISABLE KEYS */;
/*!40000 ALTER TABLE `office_airports` ENABLE KEYS */;
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
  `id_province` int(10) unsigned NOT NULL,
  `id_subdistrict` int(10) unsigned NOT NULL,
  `id_office_counter` int(10) unsigned DEFAULT NULL,
  `id_office_pc` int(10) unsigned DEFAULT NULL,
  `id_airport` int(10) unsigned DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office_types`
--

LOCK TABLES `office_types` WRITE;
/*!40000 ALTER TABLE `office_types` DISABLE KEYS */;
INSERT INTO `office_types` VALUES (1,'Head Office','2018-02-12 09:35:16','2018-02-12 09:35:16'),(2,'Pick Up Drop Point','2018-02-12 09:35:16','2018-02-12 09:35:16'),(3,'Drop Point','2018-02-12 09:35:16','2018-02-12 09:35:16'),(4,'Airport Counter','2018-02-12 09:35:16','2018-02-12 09:35:16'),(5,'Processing Center','2018-02-12 09:35:16','2018-02-12 09:35:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packaging_deliveries`
--

LOCK TABLES `packaging_deliveries` WRITE;
/*!40000 ALTER TABLE `packaging_deliveries` DISABLE KEYS */;
INSERT INTO `packaging_deliveries` VALUES (2,'1','1','2018-02-12 09:58:04','2018-02-12 09:58:04');
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
  `is_receive` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packaging_lists`
--

LOCK TABLES `packaging_lists` WRITE;
/*!40000 ALTER TABLE `packaging_lists` DISABLE KEYS */;
INSERT INTO `packaging_lists` VALUES (1,'PS1802120001','1',2,'2018-02-12 09:54:41','2018-02-12 10:09:27');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_types`
--

LOCK TABLES `payment_types` WRITE;
/*!40000 ALTER TABLE `payment_types` DISABLE KEYS */;
INSERT INTO `payment_types` VALUES (1,'Cash','2018-02-12 09:35:16','2018-02-12 09:35:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'citylists.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','City List'),(2,'provincelists.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Province List'),(3,'subdistrictlists.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Subdistrict List'),(4,'airlineslists.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Airline List'),(5,'airportlists.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Airport List'),(6,'airportcitylists.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Airportcity List'),(7,'officelists.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Office List'),(8,'officetypes.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Office Type'),(9,'banklists.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Bank List'),(10,'paymenttypes.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Payment Type'),(11,'pricelists.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Price List'),(12,'insurances.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Insurance'),(13,'memberlists.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Member List'),(14,'weightlists.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Weight List'),(15,'shipments.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Shipment List'),(16,'slotlists.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Slot List'),(17,'packagingslots.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Packaging Slot'),(18,'deliveries.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Shipment Delivery to Processing Center'),(19,'receiveds.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Shipment Received by Processing Center'),(20,'shipmenttrackings.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Shipment Tracking'),(21,'packagingprocessingcenters.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Processing Center Package List'),(22,'packagingrestshipments.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Packaging Rest Shipment'),(23,'shipmentpickups.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Shipment Pick Up'),(24,'shipmentdropoffs.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Shipment Drop Off'),(25,'shipmentmatchingmonitors.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Shipment Matching Monitor'),(26,'pendingarrivalcounters.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Pending Package at Arrival Counter'),(27,'pendingdeparturecounters.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Pending Package at Departure Counter'),(28,'deliverydeparturecounters.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Delivery Package to Departure Counter'),(29,'deliveryprocessingcenters.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Delivery Packaging to Arrival Processing Center'),(30,'receiveprocessingcenters.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Receive Packaging from Processing Center'),(31,'shipmentstatuses.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Shipment Status'),(32,'terms.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Term and Agreement'),(33,'tipstermilestones.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Tipster Milestone'),(34,'roles.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Role List'),(35,'users.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','User List'),(36,'permissions.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Permission Management'),(37,'backups.','web','2018-02-12 09:35:16','2018-02-12 09:35:16','Backup Database');
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
INSERT INTO `price_lists` VALUES (1,1,2,20000.00,22000.00,5000.00,NULL,NULL),(2,1,3,19000.00,21000.00,5000.00,NULL,NULL),(3,1,4,16000.00,18000.00,3000.00,NULL,NULL),(4,2,1,13000.00,15000.00,3000.00,NULL,NULL),(5,2,3,20000.00,22000.00,4000.00,NULL,NULL),(6,2,4,19000.00,21000.00,5000.00,NULL,NULL),(7,3,1,15000.00,17000.00,5000.00,NULL,NULL),(8,3,2,11000.00,13000.00,4000.00,NULL,NULL),(9,3,4,20000.00,22000.00,5000.00,NULL,NULL),(10,4,1,17000.00,19000.00,4000.00,NULL,NULL),(11,4,2,16000.00,18000.00,4000.00,NULL,NULL),(12,4,3,13000.00,15000.00,5000.00,NULL,NULL);
/*!40000 ALTER TABLE `price_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province_lists`
--

DROP TABLE IF EXISTS `province_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `province_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province_lists`
--

LOCK TABLES `province_lists` WRITE;
/*!40000 ALTER TABLE `province_lists` DISABLE KEYS */;
INSERT INTO `province_lists` VALUES (1,'DKI Jakarta','2018-02-12 09:35:16','2018-02-12 09:35:16');
/*!40000 ALTER TABLE `province_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provinces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provinces`
--

LOCK TABLES `provinces` WRITE;
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;
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
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1);
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
INSERT INTO `roles` VALUES (1,'admin','web','2018-02-12 09:35:16','2018-02-12 09:35:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment_histories`
--

LOCK TABLES `shipment_histories` WRITE;
/*!40000 ALTER TABLE `shipment_histories` DISABLE KEYS */;
INSERT INTO `shipment_histories` VALUES (1,1,4,'2018-02-12 09:53:28','2018-02-12 09:53:28');
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
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment_statuses`
--

LOCK TABLES `shipment_statuses` WRITE;
/*!40000 ALTER TABLE `shipment_statuses` DISABLE KEYS */;
INSERT INTO `shipment_statuses` VALUES (1,1,'Menunggu pengambilan barang oleh Petugas TIPS.',0,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(2,2,'Barang telah diterima oleh Petugas TIPS.',0,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(3,0,'Barang dikirm ke Processing center.',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(4,0,'Barang diterima Processing center.',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(5,0,'Barang sudah dipacking.',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(6,0,'Barang dikirim ke konter.',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(7,3,'Menunggu diambil TIPSter.',0,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(8,4,'Barang diambil TIPSter.',0,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(9,5,'Barang masuk bagasi pesawat.',0,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(10,6,'Barang telah tiba di konter TIPS.',0,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(11,0,'Barang dikirim ke Processing center.',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(12,0,'Barang diterima Processing.',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(13,0,'Barang siap diantar.',1,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(14,7,'Barang dalam proses pengantaran.',0,'2018-02-12 09:35:16','2018-02-12 09:35:16'),(15,8,'Barang diterima oleh penerima.',0,'2018-02-12 09:35:16','2018-02-12 09:35:16');
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
  `id_shipper` int(10) unsigned DEFAULT NULL,
  `id_device` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipper_first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipper_last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_shipper_districts` int(10) unsigned DEFAULT NULL,
  `shipper_districts` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_shipper_city` int(10) unsigned DEFAULT NULL,
  `shipper_city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_shipper_province` int(10) unsigned DEFAULT NULL,
  `shipper_province` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipper_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipper_mobile_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipper_latitude` decimal(8,2) DEFAULT NULL,
  `shipper_longitude` decimal(8,2) DEFAULT NULL,
  `consignee_first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consignee_last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignee_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consignee_mobile_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_dispatch` enum('Pending','Process','Complete','Canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `dispatch_type` enum('Dispatch to consignee','Taken by consignee') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dispatch to consignee',
  `goods_status` enum('Pending','Received') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `registration_type` enum('Offline','Online','Pickup') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pickup',
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
  `received_time` datetime DEFAULT NULL,
  `received_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_posted` tinyint(1) NOT NULL DEFAULT '0',
  `is_matched` tinyint(1) NOT NULL DEFAULT '0',
  `detail_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delivery` tinyint(1) NOT NULL DEFAULT '0',
  `is_take` tinyint(1) NOT NULL DEFAULT '0',
  `pickup_status` enum('Pending','Done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `pickup_date` date DEFAULT NULL,
  `pickup_by` int(10) unsigned DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `payment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipper_address_detail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignee_address_detail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_ktp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipments`
--

LOCK TABLES `shipments` WRITE;
/*!40000 ALTER TABLE `shipments` DISABLE KEYS */;
INSERT INTO `shipments` VALUES (1,'HQ7VT5J',1,'2018-02-12',NULL,1,2,3,0,2,'864880032260655','akhmad','benny',2,'Koja',1,'Jakarta Utara',1,'DKI Jakarta','alamat benny','081519487516',NULL,NULL,'nama penerima',NULL,'alamat penerima','081946235','Process','Dispatch to consignee','Pending','Pickup',NULL,1,'baju',15000,1,22000,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,14,'2018-02-12 09:39:22',NULL,NULL,NULL,NULL,NULL,NULL,1,1,NULL,1,1,'Pending','2018-02-12',1,'17:00:00','TIPS5A8160CA42943','detil benny','detil penerima',NULL,NULL,'2018-02-12 09:39:22','2018-02-12 10:15:24');
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
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_dispatch` enum('Pending','Process','Complete','Canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `id_airline` int(10) unsigned NOT NULL,
  `id_origin_airport` int(10) unsigned NOT NULL,
  `id_destination_airport` int(10) unsigned NOT NULL,
  `id_origin_city` int(10) unsigned NOT NULL,
  `id_destination_city` int(10) unsigned NOT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slot_lists`
--

LOCK TABLES `slot_lists` WRITE;
/*!40000 ALTER TABLE `slot_lists` DISABLE KEYS */;
INSERT INTO `slot_lists` VALUES (1,'19BB6KL',2,'GAKHGV','gregorius','Jonny','Process',1,7,3,2,3,'Jakarta','Surabaya','2018-02-12 08:00:00','2018-02-12 10:00:00','ga175',1,1,20000,7,'20180212101021939659_863_img_item.',NULL,'2018-02-12 09:47:15','2018-02-12 10:15:24');
/*!40000 ALTER TABLE `slot_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subdistrict_lists`
--

DROP TABLE IF EXISTS `subdistrict_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subdistrict_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_province` int(10) unsigned NOT NULL,
  `id_city` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subdistrict_lists`
--

LOCK TABLES `subdistrict_lists` WRITE;
/*!40000 ALTER TABLE `subdistrict_lists` DISABLE KEYS */;
INSERT INTO `subdistrict_lists` VALUES (1,1,1,'kecamatan','2018-02-12 09:35:16','2018-02-12 09:35:16'),(2,1,1,'Koja',NULL,NULL);
/*!40000 ALTER TABLE `subdistrict_lists` ENABLE KEYS */;
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
INSERT INTO `terms` VALUES (1,'test content','2018-02-12 09:35:16','2018-02-12 09:35:16');
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipster_milestones`
--

DROP TABLE IF EXISTS `tipster_milestones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipster_milestones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `step` int(10) unsigned NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipster_milestones_step_unique` (`step`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipster_milestones`
--

LOCK TABLES `tipster_milestones` WRITE;
/*!40000 ALTER TABLE `tipster_milestones` DISABLE KEYS */;
INSERT INTO `tipster_milestones` VALUES (1,1,'Menunggu Petugas TIPS.','2018-02-12 09:35:16','2018-02-12 09:35:16'),(2,2,'Bagasi diproses TIPS.','2018-02-12 09:35:16','2018-02-12 09:35:16'),(3,3,'Menunggu diambil TIPSter.','2018-02-12 09:35:16','2018-02-12 09:35:16'),(4,4,'Barang diambil TIPSter.','2018-02-12 09:35:16','2018-02-12 09:35:16'),(5,5,'Barang masuk bagasi pesawat.','2018-02-12 09:35:16','2018-02-12 09:35:16'),(6,6,'Sampai di konter TIPS kota tujuan.','2018-02-12 09:35:16','2018-02-12 09:35:16'),(7,7,'Barang telah sampai.','2018-02-12 09:35:16','2018-02-12 09:35:16');
/*!40000 ALTER TABLE `tipster_milestones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint(20) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translator_languages`
--

DROP TABLE IF EXISTS `translator_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translator_languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locale` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translator_languages_locale_unique` (`locale`),
  UNIQUE KEY `translator_languages_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translator_languages`
--

LOCK TABLES `translator_languages` WRITE;
/*!40000 ALTER TABLE `translator_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `translator_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translator_translations`
--

DROP TABLE IF EXISTS `translator_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translator_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locale` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namespace` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '*',
  `group` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `unstable` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translator_translations_locale_namespace_group_item_unique` (`locale`,`namespace`,`group`,`item`),
  CONSTRAINT `translator_translations_locale_foreign` FOREIGN KEY (`locale`) REFERENCES `translator_languages` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translator_translations`
--

LOCK TABLES `translator_translations` WRITE;
/*!40000 ALTER TABLE `translator_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translator_translations` ENABLE KEYS */;
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
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_office` int(10) unsigned DEFAULT NULL,
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
INSERT INTO `users` VALUES (1,'admin','admin','admin','$2y$10$dJjxiCn3E4q3hHaKPWPcteIZFCmtXozOeoVhg3TMKRUMtNOKSboyG',NULL,NULL,'2018-02-12 09:35:16','2018-02-12 09:35:16');
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

-- Dump completed on 2018-02-12 10:19:34
