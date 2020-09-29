CREATE DATABASE  IF NOT EXISTS `rcms` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `rcms`;
-- MySQL dump 10.13  Distrib 8.0.20, for macos10.15 (x86_64)
--
-- Host: 127.0.0.1    Database: rcms
-- ------------------------------------------------------
-- Server version	8.0.21

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
-- Table structure for table `banner_items`
--

DROP TABLE IF EXISTS `banner_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banner_items` (
  `idbanner_item` int unsigned NOT NULL AUTO_INCREMENT,
  `idbanner` int unsigned NOT NULL DEFAULT '1',
  `idcontent` int unsigned NOT NULL DEFAULT '1',
  `idimage` int unsigned NOT NULL DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `text` text,
  `status` tinyint unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`idbanner_item`),
  KEY `fk_banner_item_image_idx` (`idimage`),
  KEY `fk_banner_item_banner_idx` (`idbanner`),
  KEY `fk_banner_item_content_idx` (`idcontent`),
  CONSTRAINT `fk_banner_item_banner` FOREIGN KEY (`idbanner`) REFERENCES `banners` (`idbanner`),
  CONSTRAINT `fk_banner_item_content` FOREIGN KEY (`idcontent`) REFERENCES `contents` (`idcontent`),
  CONSTRAINT `fk_banner_item_image` FOREIGN KEY (`idimage`) REFERENCES `images` (`idimage`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner_items`
--

LOCK TABLES `banner_items` WRITE;
/*!40000 ALTER TABLE `banner_items` DISABLE KEYS */;
INSERT INTO `banner_items` VALUES (1,1,1,1,'-','-','-',0),(2,2,1,6,'','','',0),(3,2,1,18,'','','',0),(4,2,7,8,'APOSTORE','','APOSTORE',1);
/*!40000 ALTER TABLE `banner_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `idbanner` int unsigned NOT NULL AUTO_INCREMENT,
  `idposition` int unsigned NOT NULL DEFAULT '1',
  `type` varchar(45) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `status` tinyint unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`idbanner`),
  KEY `fk_banner_position_idx` (`idposition`),
  CONSTRAINT `fk_banner_position` FOREIGN KEY (`idposition`) REFERENCES `positions` (`idposition`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,1,'slideshow','Főoldali slideshow',NULL,0),(2,5,'slideshow','Főoldali slideshow',NULL,1);
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_items`
--

DROP TABLE IF EXISTS `content_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `content_items` (
  `idcontent_item` int unsigned NOT NULL AUTO_INCREMENT,
  `idcontent` int unsigned NOT NULL DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `type` set('image') DEFAULT NULL,
  `item_id` int DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `creator` int unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int unsigned NOT NULL DEFAULT '1',
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idcontent_item`),
  KEY `fk_content_item_content_idx` (`idcontent`),
  KEY `fk_content_item_creator_idx` (`creator`),
  KEY `fk_content_item_editor_idx` (`editor`),
  CONSTRAINT `fk_content_item_content` FOREIGN KEY (`idcontent`) REFERENCES `contents` (`idcontent`),
  CONSTRAINT `fk_content_item_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`),
  CONSTRAINT `fk_content_item_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='items of content, eg.: image';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_items`
--

LOCK TABLES `content_items` WRITE;
/*!40000 ALTER TABLE `content_items` DISABLE KEYS */;
INSERT INTO `content_items` VALUES (1,1,'-','image',1,0,1,'2020-01-01 00:00:00',1,NULL),(2,2,'kk','image',5,1,1,'2020-08-25 07:44:48',1,'2020-09-21 20:16:27'),(3,3,'','image',19,1,1,'2020-08-26 19:32:08',1,'2020-09-13 16:49:17'),(4,4,'','image',20,1,1,'2020-08-26 19:34:51',1,'2020-08-26 19:35:11'),(5,5,'','image',21,1,1,'2020-08-26 19:37:21',1,NULL),(6,8,'','image',0,1,1,'2020-09-28 19:06:24',1,NULL),(7,8,'','image',23,1,1,'2020-09-28 19:09:19',1,NULL);
/*!40000 ALTER TABLE `content_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_params`
--

DROP TABLE IF EXISTS `content_params`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `content_params` (
  `idcontent_param` int unsigned NOT NULL AUTO_INCREMENT,
  `idcontent` int unsigned NOT NULL DEFAULT '1',
  `type` varchar(45) DEFAULT NULL,
  `value` text,
  `creator` int unsigned NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `editor` int unsigned NOT NULL,
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idcontent_param`),
  KEY `fk_content_param_creator_idx` (`creator`),
  KEY `fk_content_param_editor_idx` (`editor`),
  KEY `fk_content_param_content_idx` (`idcontent`),
  CONSTRAINT `fk_content_param_content` FOREIGN KEY (`idcontent`) REFERENCES `contents` (`idcontent`),
  CONSTRAINT `fk_content_param_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`),
  CONSTRAINT `fk_content_param_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='parameters of content. defined developer paramteres';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_params`
--

LOCK TABLES `content_params` WRITE;
/*!40000 ALTER TABLE `content_params` DISABLE KEYS */;
INSERT INTO `content_params` VALUES (1,1,'-','-',1,'2020-01-01 00:00:00',1,NULL);
/*!40000 ALTER TABLE `content_params` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contents` (
  `idcontent` int unsigned NOT NULL AUTO_INCREMENT,
  `idposition` int unsigned NOT NULL DEFAULT '1',
  `title` varchar(500) DEFAULT NULL COMMENT 'title of content',
  `short_desc` varchar(500) DEFAULT NULL,
  `content` text,
  `published` datetime DEFAULT NULL,
  `published_to` datetime DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `creator` int unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int unsigned NOT NULL DEFAULT '1',
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idcontent`),
  KEY `fk_content_creator_idx` (`creator`),
  KEY `fk_content_editor_idx` (`editor`),
  KEY `fk_content_position_idx` (`idposition`),
  CONSTRAINT `fk_content_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`),
  CONSTRAINT `fk_content_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`),
  CONSTRAINT `fk_content_position` FOREIGN KEY (`idposition`) REFERENCES `positions` (`idposition`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='page contents';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents`
--

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` VALUES (1,1,'-',NULL,'-','2020-01-01 00:00:00','2020-01-01 00:00:00',0,1,'2020-01-01 00:00:00',1,NULL),(2,4,'Üdvözöljük','Üdvözöljük a Nagykőrösi Oroszlán Gyógyszertár weboldalán!','<h3>Ide kerülhet egy hosszabb leírás a patikáról</h3>','2020-08-24 00:00:00',NULL,1,1,'2020-08-24 21:22:40',1,'2020-09-21 20:16:26'),(3,3,'Dr. Oroszi Magdolna','Gyermekorvosi rendelő','<figure class=\"image\"><img src=\"/ckfinder/userfiles/files/oroszlan_logo.jpg\"></figure><p>&nbsp;</p><p>&nbsp;</p><p>GYERMEKORVOSI RENDELŐ:&nbsp;</p><p>Dr. Oroszi Magdolna (csecsemő- és gyermekgyógyász címzetes főorvos)&nbsp;</p><p>Hétfő: 8:00-10:30, 14:30 - 16:00&nbsp;</p><p>Kedd: 8:00- 10:30</p><p>Szerda: 8:00-10:30&nbsp;</p><p>Csütörtök: 8:00 - 10:30, 14:30-16:00&nbsp;</p><p>Péntek: 8:00- 10:30</p>','2020-08-25 00:00:00',NULL,0,1,'2020-08-26 19:31:19',1,'2020-09-21 19:52:46'),(4,3,'Dr. Kovács Zsolt','csecsemő- és gyermekgyógyász','<p>Dr. Kovács Zsolt (csecsemő- és gyermekgyógyász, gyermek tüdőgyógyász, allergológus)&nbsp;</p><p>Hétfő: 8:00 - 10:30&nbsp;</p><p>Kedd: 13:00-16:00&nbsp;</p><p>Szerda: 8:00-10:30&nbsp;</p><p>Csütörtök:8:00-10:30&nbsp;</p><p>Péntek: 13:00 -16:00</p>','2020-08-25 00:00:00',NULL,0,1,'2020-08-26 19:34:24',1,'2020-09-21 19:52:50'),(5,3,'Dr. Oroszi Sándor főorvos','belgyógyászat,kardiológia','<p>Dr. Oroszi Sándor főorvos (belgyógyászat,kardiológia)&nbsp;</p><p>Hétfő: 17:00-20:00&nbsp;</p><p>Csütörtök: 17:00-19:00&nbsp;</p><p>Előjegyzés: 06-20-388-9814</p>','2020-08-25 00:00:00',NULL,0,1,'2020-08-26 19:37:10',1,'2020-09-21 19:52:54'),(6,1,'Doktoraink','','<p><strong>GYERMEKORVOSI RENDELŐ</strong></p><p>Dr. Oroszi Magdolna (csecsemő- és gyermekgyógyász címzetes főorvos)&nbsp;</p><p>Hétfő: 8:00-10:30 14:30 - 16:00&nbsp;</p><p>Kedd: 8:00- 10:30 Szerda: 8:00-10:30&nbsp;</p><p>Csütörtök: 8:00 - 10:30 14:30-16:00&nbsp;</p><p>Péntek: 8:00- 10:30&nbsp;</p><p>&nbsp;</p><p>Dr. Kovács Zsolt (csecsemő- és gyermekgyógyász, gyermek tüdőgyógyász, allergológus)&nbsp;</p><p>Hétfő: 8:00 - 10:30&nbsp;</p><p>Kedd: 13:00-16:00&nbsp;</p><p>Szerda: 8:00-10:30&nbsp;</p><p>Csütörtök:8:00-10:30&nbsp;</p><p>Péntek: 13:00 -16:00&nbsp;</p><p>&nbsp;</p><p>Dr. Fekete-Herman Emese betegeit&nbsp;</p><p>Dr .Oroszi Magdolna látja el a saját rendelési idejében.&nbsp;</p><p>&nbsp;</p><p><strong>MAGÁNRENDELÉSEK:&nbsp;</strong></p><p>Dr. Oroszi Sándor főorvos (belgyógyászat,kardiológia)&nbsp;</p><p>Hétfő: 17:00-20:00&nbsp;</p><p>Csütörtök: 17:00-19:00&nbsp;</p><p>Előjegyzés: 06-20-388-9814&nbsp;</p><p>&nbsp;</p><p>Dr. Valco Emese (rheumatológus szakorvos)&nbsp;</p><p>Csütörök: 13:00 - 15:00&nbsp;</p><p>Bejelentkezés este 18 és 19 óra között a 06-70-219-3706 - os telefonszámon.&nbsp;</p><p>&nbsp;</p><p>Dr. Vincze Rita (neurológus szakorvos)&nbsp;</p><p>Csütörtök: 16:00-19:00&nbsp;</p><p>Bejelentkezés hétfő, kedd, szerdai munkanapokon 15:30 - 17:00 között.&nbsp;</p><p>06-70-36-55-777&nbsp;</p><p>&nbsp;</p><p>Dr. Tóth-Baranyi Zsuzsanna (belgyógyász, gasztroenterológus szakorvos)&nbsp;</p><p>Szerda: 15:00-17:00&nbsp;</p><p>Péntek: 15:00-17:00&nbsp;</p><p>Bejelentkezés: 06 70 328 3669&nbsp;</p><p>&nbsp;</p><p>Dr. Paluska Márta (bőr- és nemigyógyász, kozmetológus szakorvos)&nbsp;</p><p>Kedd: 14:00 - 16:00&nbsp;</p><p>&nbsp;</p><p>Baky Ildikó (pszichológus)&nbsp;</p><p>Bejelentkezés 06-30-287-4843&nbsp;</p><p>&nbsp;</p><p>Térítésmentes ortopéd szakrendelés, egyeztetett időpontban, beutaló nélkül: Dr. Bartis Tamás (ortopéd szakorvos)&nbsp;</p><p>Bejelentkezés: Balogh Veronika: 06-20-922-0989</p>','2020-08-26 00:00:00',NULL,1,1,'2020-08-26 20:45:34',1,'2020-09-22 19:16:57'),(7,1,'APOSTORE','','','2020-09-21 00:00:00',NULL,1,1,'2020-09-21 20:06:04',1,'2020-09-21 20:06:17'),(8,3,'Házhozszállítás','30 perc ingyenes','<p>30 perc ingyenes</p>','2020-09-21 00:00:00',NULL,1,1,'2020-09-21 20:08:22',1,'2020-09-28 19:09:19'),(9,1,'Vércukorszint mérés','Változó időtartam · 150 Ft','<p style=\"margin-left:0px;\">Törzsvásárlói és gondozási programunkban részt vevők számára ingyenes!</p>','2020-09-21 00:00:00',NULL,1,1,'2020-09-21 20:09:22',1,'2020-09-21 20:09:29'),(10,3,'Koleszterinszint mérés','Változó időtartam · 450 Ft','<p>Törzsvásárlói és gondozási programunkban részt vevők számára ingyenes!</p>','2020-09-21 00:00:00',NULL,1,1,'2020-09-21 20:10:34',1,'2020-09-21 20:10:48'),(11,3,'Babamérleg kölcsönzés','Változó időtartam · 3810 Ft/ hó','<p>A tapasztalat azt mutatja, hogy csecsemőmérlegre csak a gyermek születését követő 3-4 hónapban van szükség. Ebben szeretnénk Önnek segítséget nyújtani!</p>','2020-09-21 00:00:00',NULL,1,1,'2020-09-21 20:11:25',1,'2020-09-21 20:11:30'),(12,3,'Légzésfigyelő kölcsönzés','Változó időtartam · 7620 Ft','<p>A légzésfigyelő készülék segítséget nyújt abban, hogy minden percben figyelemmel kísérhessük kisbabánk megfelelő légzését az éjszaka folyamán is.</p>','2020-09-21 00:00:00',NULL,1,1,'2020-09-21 20:12:07',1,'2020-09-21 20:12:14'),(13,3,'Gyógyszerészi gondozás','Változó időtartam · ingyenes','<p>Egyénre szabottan, előre megbeszélt időpontban tanácsadó helyiségünkben segítünk választ adni kérdéseire (gyógyszeres terápia, emésztő-, légzőszervi-, bőrproblémák, várandósság, gyermekápolás stb.)</p>','2020-09-21 00:00:00',NULL,1,1,'2020-09-21 20:13:03',1,'2020-09-21 20:13:19'),(14,1,'Partner patika','Partner patika','','2020-09-28 00:00:00',NULL,1,1,'2020-09-28 19:01:58',1,'2020-09-28 19:02:02');
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery` (
  `idgallery` int unsigned NOT NULL AUTO_INCREMENT,
  `idposition` int unsigned NOT NULL DEFAULT '1',
  `name` varchar(500) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `text` text,
  `status` tinyint unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`idgallery`),
  KEY `fk_gallery_position_idx` (`idposition`),
  CONSTRAINT `fk_gallery_position` FOREIGN KEY (`idposition`) REFERENCES `positions` (`idposition`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` VALUES (1,1,'-','-','-',0),(2,1,'Születésnap',NULL,'',1);
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_items`
--

DROP TABLE IF EXISTS `gallery_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_items` (
  `idgallery_item` int unsigned NOT NULL AUTO_INCREMENT,
  `idgallery` int unsigned NOT NULL DEFAULT '1',
  `idimage` int unsigned NOT NULL DEFAULT '1',
  `name` varchar(500) DEFAULT NULL,
  `text` text,
  `status` tinyint unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`idgallery_item`),
  KEY `fk_gallery_item_image_idx` (`idimage`),
  KEY `fk_gallery_item_gallery_idx` (`idgallery`),
  CONSTRAINT `fk_gallery_item_gallery` FOREIGN KEY (`idgallery`) REFERENCES `gallery` (`idgallery`),
  CONSTRAINT `fk_gallery_item_image` FOREIGN KEY (`idimage`) REFERENCES `images` (`idimage`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_items`
--

LOCK TABLES `gallery_items` WRITE;
/*!40000 ALTER TABLE `gallery_items` DISABLE KEYS */;
INSERT INTO `gallery_items` VALUES (1,1,1,'-','-',0),(2,2,22,'slider1','',1);
/*!40000 ALTER TABLE `gallery_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `idimage` int unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(1000) DEFAULT NULL,
  `extension` varchar(45) DEFAULT NULL,
  `size` decimal(14,4) DEFAULT NULL COMMENT 'BYTE',
  `title` varchar(255) DEFAULT NULL,
  `x` decimal(14,4) DEFAULT NULL,
  `y` decimal(14,4) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `creator` int unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int unsigned NOT NULL DEFAULT '1',
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idimage`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'-','-',0.0000,'-',0.0000,0.0000,0,1,'2020-01-01 00:00:00',1,NULL),(2,'uploaded_files/photoderm.jpg','jpg',192146.0000,'photoderm',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(3,'uploaded_files/glamur.jpg','jpg',266981.0000,'glamur',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(4,'uploaded_files/aqua.png','png',246176.0000,'aqua',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(5,'uploaded_files/116370127_3132631923525093_5448893611153776918_n.jpg','jpg',151473.0000,'116370127_3132631923525093_5448893611153776918_n',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(6,'uploaded_files/22eve.jpg','jpg',366644.0000,'22eve',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(7,'uploaded_files/999.jpg','jpg',254186.0000,'999',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(8,'uploaded_files/apos.jpg','jpg',66704.0000,'apos',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(9,'uploaded_files/apos.jpg','jpg',66704.0000,'apos',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(10,'uploaded_files/oroszlan_logo.jpg','jpg',7983.0000,'oroszlan_logo',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(11,'uploaded_files/patikaelol.jpg','jpg',341824.0000,'patikaelol',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(12,'uploaded_files/apo.jpg','jpg',97806.0000,'apo',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(13,'uploaded_files/photoderm.jpg','jpg',192146.0000,'photoderm',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(14,'uploaded_files/photoderm másolat.jpg','jpg',90410.0000,'photoderm másolat',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(15,'uploaded_files/apostore_cube-1024x682.jpg','jpg',132456.0000,'apostore_cube-1024x682',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(16,'uploaded_files/robot-farmacia-Apostore-Cube.jpg','jpg',388912.0000,'robot-farmacia-Apostore-Cube',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(17,'uploaded_files/patikaelol.jpg','jpg',341824.0000,'patikaelol',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(18,'uploaded_files/szgy.jpg','jpg',152581.0000,'szgy',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(19,'uploaded_files/team-image3.jpg','jpg',39419.0000,'team-image3',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(20,'uploaded_files/team-image2.jpg','jpg',39904.0000,'team-image2',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(21,'uploaded_files/team-image1.jpg','jpg',44974.0000,'team-image1',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(22,'uploaded_files/slider1.jpg','jpg',83969.0000,'slider1',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL),(23,'uploaded_files/hazhozszallitas.jpg','jpg',189538.0000,'hazhozszallitas',0.0000,0.0000,1,0,'0000-00-00 00:00:00',1,NULL);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `idmenu` int unsigned NOT NULL AUTO_INCREMENT,
  `idposition` int unsigned NOT NULL DEFAULT '1',
  `idimage` int unsigned NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmenu`),
  KEY `fk_menu_image_idx` (`idimage`),
  CONSTRAINT `fk_menu_image` FOREIGN KEY (`idimage`) REFERENCES `images` (`idimage`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,1,1,'-','-','-',0),(2,2,1,'Felső menüsor','Elérhető menüpontok',NULL,1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `idmenu_item` int unsigned NOT NULL AUTO_INCREMENT,
  `idmenu` int unsigned NOT NULL,
  `idimage` int unsigned NOT NULL DEFAULT '1',
  `idcontent` int unsigned NOT NULL DEFAULT '1',
  `idgallery` int unsigned NOT NULL DEFAULT '1',
  `title` varchar(150) NOT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `published` datetime DEFAULT NULL,
  `published_to` datetime DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `creator` int unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int unsigned NOT NULL DEFAULT '1',
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idmenu_item`),
  KEY `fk_menu_item_menu_idx` (`idmenu`),
  KEY `fk_menu_item_image_idx` (`idimage`),
  KEY `fk_menu_item_creator_idx` (`creator`),
  KEY `fk_menu_item_editor_idx` (`editor`),
  KEY `fk_menu_item_content_idx` (`idcontent`),
  KEY `fk_menu_item_gallery_idx` (`idgallery`),
  CONSTRAINT `fk_menu_item_content` FOREIGN KEY (`idcontent`) REFERENCES `contents` (`idcontent`),
  CONSTRAINT `fk_menu_item_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`),
  CONSTRAINT `fk_menu_item_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`),
  CONSTRAINT `fk_menu_item_gallery` FOREIGN KEY (`idgallery`) REFERENCES `gallery` (`idgallery`),
  CONSTRAINT `fk_menu_item_image` FOREIGN KEY (`idimage`) REFERENCES `images` (`idimage`),
  CONSTRAINT `fk_menu_item_menu` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,1,1,1,'-','-',NULL,'-',0,'2020-01-01 00:00:00','2020-01-01 00:00:00',0,1,'2020-01-01 00:00:00',1,NULL),(2,2,1,1,1,'Főoldal','Főoldal','http://localhost/oroszlan_rcms/index.php','home',1,NULL,NULL,1,1,'2020-08-20 19:09:58',1,'2020-09-28 19:03:05'),(3,2,1,1,1,'Rólunk','Rólunk','#about','',1,NULL,NULL,1,1,'2020-08-20 19:09:58',1,'2020-09-28 19:03:05'),(4,2,1,1,1,'Szolgáltatásaink','','#services','',1,NULL,NULL,1,1,'2020-08-20 19:09:58',1,'2020-09-28 19:03:05'),(5,2,1,1,1,'Aktualitások','','#news','',1,NULL,NULL,1,1,'2020-08-20 19:09:58',1,'2020-09-28 19:03:05'),(6,2,1,6,1,'Doktoraink','','','',1,NULL,NULL,1,1,'2020-08-20 19:09:58',1,'2020-09-28 19:03:05'),(7,2,1,6,1,'Szolgáltatásaink','','',NULL,1,NULL,NULL,0,1,'2020-08-26 20:44:56',1,'2020-08-27 17:18:22'),(8,2,1,1,2,'Galéria','','',NULL,1,NULL,NULL,1,1,'2020-09-21 20:04:00',1,'2020-09-28 19:03:05'),(9,2,1,14,1,'Partner patika','','',NULL,1,NULL,NULL,1,1,'2020-09-28 19:02:28',1,'2020-09-28 19:03:05');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modules` (
  `idmodule` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'modul neve',
  `code` varchar(45) NOT NULL COMMENT 'modul egyedi kódja',
  `status` tinyint unsigned NOT NULL DEFAULT '1' COMMENT 'modul státusza 1 élő 0 nem élő',
  `active` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '1 bekapcsolt  0 kikapcsolt',
  PRIMARY KEY (`idmodule`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='available cms modules';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,'-','-',0,0);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `new_items`
--

DROP TABLE IF EXISTS `new_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `new_items` (
  `idnew_item` int unsigned NOT NULL AUTO_INCREMENT,
  `idnew` int unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `item_id` int NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `creator` int unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int unsigned NOT NULL DEFAULT '1',
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idnew_item`),
  KEY `fk_new_item_new_idx` (`idnew`),
  KEY `fk_new_item_creator_idx` (`creator`),
  KEY `fk_new_item_editor_idx` (`editor`),
  CONSTRAINT `fk_new_item_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`),
  CONSTRAINT `fk_new_item_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`),
  CONSTRAINT `fk_new_item_new` FOREIGN KEY (`idnew`) REFERENCES `news` (`idnew`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `new_items`
--

LOCK TABLES `new_items` WRITE;
/*!40000 ALTER TABLE `new_items` DISABLE KEYS */;
INSERT INTO `new_items` VALUES (1,1,'-','-',1,'0',1,'2020-01-01 00:00:00',1,NULL),(2,2,'','image',17,'1',1,'2020-08-26 19:07:27',1,'2020-08-26 19:23:24'),(3,3,'','image',11,'1',1,'2020-08-26 19:10:03',1,'2020-08-26 19:10:41'),(4,4,'','image',14,'1',1,'2020-08-26 19:14:26',1,'2020-08-26 19:24:14');
/*!40000 ALTER TABLE `new_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `idnew` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(500) DEFAULT NULL,
  `short_desc` varchar(500) DEFAULT NULL,
  `content` text,
  `published` datetime DEFAULT NULL,
  `published_to` datetime DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `creator` int unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int unsigned NOT NULL DEFAULT '1',
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idnew`),
  KEY `fk_new_creator_idx` (`creator`),
  KEY `fk_new_editor_idx` (`editor`),
  CONSTRAINT `fk_new_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`),
  CONSTRAINT `fk_new_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'-',NULL,'-','2020-01-01 00:00:00','2020-01-01 00:00:00',0,1,'2020-01-01 00:00:00',1,NULL),(2,'Korszerűsítés','Apostore, az új munkatárs\n','<h2>Korszerűsítés</h2><p>Új munkatársunk egy robot</p>','2020-08-24 00:00:00','2020-08-31 00:00:00',1,1,'2020-08-24 21:25:00',1,'2020-08-26 19:23:23'),(3,'Új weboldal','Hamarosan elkészül új weboldalunk','<p>Hamarosan elkészül új weboldalunk&nbsp;</p>','2020-08-25 00:00:00',NULL,1,1,'2020-08-26 19:09:09',1,'2020-08-26 19:10:41'),(4,'Photoderm','Gyógyszertárban kapható márka','','2020-08-14 00:00:00',NULL,0,1,'2020-08-26 19:13:58',1,'2020-09-28 19:10:21');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `positions` (
  `idposition` int unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `code` varchar(45) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`idposition`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` VALUES (1,'-','-','-',0),(2,'menu','top_menu','Felső menü',1),(3,'content','home_page_doctors','Főoldal szolgáltatások',1),(4,'content','home_page_welcome','Főoldal üdvözlő szöveg',1),(5,'banner','home_page_top_banners','Főoldal slideshow',1);
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `idtag` int unsigned NOT NULL AUTO_INCREMENT,
  `idcontent` int unsigned NOT NULL,
  `idnew` int unsigned NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `creator` int unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int unsigned NOT NULL DEFAULT '1',
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idtag`),
  KEY `fk_tag_content_idx` (`idcontent`),
  KEY `fk_tag_new_idx` (`idnew`),
  KEY `fk_tag_creator_idx` (`creator`),
  KEY `fk_tag_editor_idx` (`editor`),
  CONSTRAINT `fk_tag_content` FOREIGN KEY (`idcontent`) REFERENCES `contents` (`idcontent`),
  CONSTRAINT `fk_tag_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`),
  CONSTRAINT `fk_tag_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`),
  CONSTRAINT `fk_tag_new` FOREIGN KEY (`idnew`) REFERENCES `news` (`idnew`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,1,1,'-',0,1,'2020-01-01 00:00:00',1,NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `iduser` int unsigned NOT NULL AUTO_INCREMENT,
  `auth_id` varchar(60) DEFAULT NULL COMMENT 'rauth azon.',
  `ext_id` varchar(60) DEFAULT NULL COMMENT 'külső azonosító számára',
  `name` varchar(255) DEFAULT NULL COMMENT 'felhasználó neve',
  `email` varchar(120) DEFAULT NULL COMMENT 'felh email',
  `role` varchar(45) DEFAULT NULL COMMENT 'fő szerepkör',
  `hash` text COMMENT 'egyedi hash',
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'1','1','-','-','-','-',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'rcms'
--

--
-- Dumping routines for database 'rcms'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-28 19:19:24
