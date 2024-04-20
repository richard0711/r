-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.13-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;


--
-- Create schema rcms_szentgyorgy
--

CREATE DATABASE IF NOT EXISTS rcms_szentgyorgy;
USE rcms_szentgyorgy;

--
-- Definition of table `banner_items`
--

DROP TABLE IF EXISTS `banner_items`;
CREATE TABLE `banner_items` (
  `idbanner_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idbanner` int(10) unsigned NOT NULL DEFAULT 1,
  `idcontent` int(10) unsigned NOT NULL DEFAULT 1,
  `idimage` int(10) unsigned NOT NULL DEFAULT 1,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `status` tinyint(4) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`idbanner_item`),
  KEY `fk_banner_item_image_idx` (`idimage`),
  KEY `fk_banner_item_banner_idx` (`idbanner`),
  KEY `fk_banner_item_content_idx` (`idcontent`),
  CONSTRAINT `fk_banner_item_banner` FOREIGN KEY (`idbanner`) REFERENCES `banners` (`idbanner`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_banner_item_content` FOREIGN KEY (`idcontent`) REFERENCES `contents` (`idcontent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_banner_item_image` FOREIGN KEY (`idimage`) REFERENCES `images` (`idimage`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner_items`
--

/*!40000 ALTER TABLE `banner_items` DISABLE KEYS */;
INSERT INTO `banner_items` (`idbanner_item`,`idbanner`,`idcontent`,`idimage`,`name`,`url`,`text`,`status`) VALUES 
 (1,1,1,1,'-','-','-',0);
/*!40000 ALTER TABLE `banner_items` ENABLE KEYS */;


--
-- Definition of table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `idbanner` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idposition` int(10) unsigned NOT NULL DEFAULT 1,
  `type` varchar(45) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `status` tinyint(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`idbanner`),
  KEY `fk_banner_position_idx` (`idposition`),
  CONSTRAINT `fk_banner_position` FOREIGN KEY (`idposition`) REFERENCES `positions` (`idposition`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banners`
--

/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` (`idbanner`,`idposition`,`type`,`name`,`code`,`status`) VALUES 
 (1,1,'slideshow','Főoldali slideshow',NULL,0);
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;


--
-- Definition of table `content_items`
--

DROP TABLE IF EXISTS `content_items`;
CREATE TABLE `content_items` (
  `idcontent_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcontent` int(10) unsigned NOT NULL DEFAULT 1,
  `title` varchar(255) DEFAULT NULL,
  `type` set('image') DEFAULT NULL,
  `item_id` int(10) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `creator` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idcontent_item`),
  KEY `fk_content_item_content_idx` (`idcontent`),
  KEY `fk_content_item_creator_idx` (`creator`),
  KEY `fk_content_item_editor_idx` (`editor`),
  CONSTRAINT `fk_content_item_content` FOREIGN KEY (`idcontent`) REFERENCES `contents` (`idcontent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_content_item_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_content_item_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='items of content, eg.: image';

--
-- Dumping data for table `content_items`
--

/*!40000 ALTER TABLE `content_items` DISABLE KEYS */;
INSERT INTO `content_items` (`idcontent_item`,`idcontent`,`title`,`type`,`item_id`,`status`,`creator`,`created`,`editor`,`edited`) VALUES 
 (1,1,'-','image',1,0,1,'2020-01-01 00:00:00',1,NULL);
/*!40000 ALTER TABLE `content_items` ENABLE KEYS */;


--
-- Definition of table `content_params`
--

DROP TABLE IF EXISTS `content_params`;
CREATE TABLE `content_params` (
  `idcontent_param` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcontent` int(10) unsigned NOT NULL DEFAULT 1,
  `type` varchar(45) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `creator` int(10) unsigned NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `editor` int(10) unsigned NOT NULL,
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idcontent_param`),
  KEY `fk_content_param_creator_idx` (`creator`),
  KEY `fk_content_param_editor_idx` (`editor`),
  KEY `fk_content_param_content_idx` (`idcontent`),
  CONSTRAINT `fk_content_param_content` FOREIGN KEY (`idcontent`) REFERENCES `contents` (`idcontent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_content_param_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_content_param_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='parameters of content. defined developer paramteres';

--
-- Dumping data for table `content_params`
--

/*!40000 ALTER TABLE `content_params` DISABLE KEYS */;
INSERT INTO `content_params` (`idcontent_param`,`idcontent`,`type`,`value`,`creator`,`created`,`editor`,`edited`) VALUES 
 (1,1,'-','-',1,'2020-01-01 00:00:00',1,NULL);
/*!40000 ALTER TABLE `content_params` ENABLE KEYS */;


--
-- Definition of table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `idcontent` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idposition` int(10) unsigned NOT NULL DEFAULT 1,
  `idgallery` int(10) unsigned NOT NULL DEFAULT 1,
  `title` varchar(500) DEFAULT NULL COMMENT 'title of content',
  `short_desc` varchar(500) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `published_to` datetime DEFAULT NULL,
  `contactform` tinyint(4) unsigned NOT NULL DEFAULT 0,
  `status` tinyint(4) DEFAULT NULL,
  `creator` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idcontent`),
  KEY `fk_content_creator_idx` (`creator`),
  KEY `fk_content_editor_idx` (`editor`),
  KEY `fk_content_position_idx` (`idposition`),
  KEY `fk_content_gallery_idx` (`idgallery`),
  CONSTRAINT `fk_content_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_content_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_content_gallery` FOREIGN KEY (`idgallery`) REFERENCES `gallery` (`idgallery`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_content_position` FOREIGN KEY (`idposition`) REFERENCES `positions` (`idposition`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='page contents';

--
-- Dumping data for table `contents`
--

/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` (`idcontent`,`idposition`,`idgallery`,`title`,`short_desc`,`content`,`published`,`published_to`,`contactform`,`status`,`creator`,`created`,`editor`,`edited`) VALUES 
 (1,1,1,'-',NULL,'-','2020-01-01 00:00:00','2020-01-01 00:00:00',0,0,1,'2020-01-01 00:00:00',1,NULL);
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;


--
-- Definition of table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `idgallery` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idposition` int(10) unsigned NOT NULL DEFAULT 1,
  `name` varchar(500) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `published_from` date DEFAULT NULL,
  `published_to` date DEFAULT NULL,
  `text` text DEFAULT NULL,
  `status` tinyint(4) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`idgallery`),
  KEY `fk_gallery_position_idx` (`idposition`),
  CONSTRAINT `fk_gallery_position` FOREIGN KEY (`idposition`) REFERENCES `positions` (`idposition`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` (`idgallery`,`idposition`,`name`,`code`,`created`,`published_from`,`published_to`,`text`,`status`) VALUES 
 (1,1,'-','-',NULL,NULL,NULL,'-',0);
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;


--
-- Definition of table `gallery_items`
--

DROP TABLE IF EXISTS `gallery_items`;
CREATE TABLE `gallery_items` (
  `idgallery_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idgallery` int(10) unsigned NOT NULL DEFAULT 1,
  `idimage` int(10) unsigned NOT NULL DEFAULT 1,
  `name` varchar(500) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `status` tinyint(4) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`idgallery_item`),
  KEY `fk_gallery_item_image_idx` (`idimage`),
  KEY `fk_gallery_item_gallery_idx` (`idgallery`),
  CONSTRAINT `fk_gallery_item_gallery` FOREIGN KEY (`idgallery`) REFERENCES `gallery` (`idgallery`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gallery_item_image` FOREIGN KEY (`idimage`) REFERENCES `images` (`idimage`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery_items`
--

/*!40000 ALTER TABLE `gallery_items` DISABLE KEYS */;
INSERT INTO `gallery_items` (`idgallery_item`,`idgallery`,`idimage`,`name`,`text`,`status`) VALUES 
 (1,1,1,'-','-',0);
/*!40000 ALTER TABLE `gallery_items` ENABLE KEYS */;


--
-- Definition of table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `idimage` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(1000) DEFAULT NULL,
  `extension` varchar(45) DEFAULT NULL,
  `size` decimal(14,4) DEFAULT NULL COMMENT 'BYTE',
  `title` varchar(255) DEFAULT NULL,
  `x` decimal(14,4) DEFAULT NULL,
  `y` decimal(14,4) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `creator` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idimage`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`idimage`,`path`,`extension`,`size`,`title`,`x`,`y`,`status`,`creator`,`created`,`editor`,`edited`) VALUES 
 (1,'-','-','0.0000','-','0.0000','0.0000',0,1,'2020-01-01 00:00:00',1,NULL);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;


--
-- Definition of table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `idmenu` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idposition` int(10) unsigned NOT NULL DEFAULT 1,
  `idimage` int(10) unsigned NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idmenu`),
  KEY `fk_menu_image_idx` (`idimage`),
  CONSTRAINT `fk_menu_image` FOREIGN KEY (`idimage`) REFERENCES `images` (`idimage`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`idmenu`,`idposition`,`idimage`,`title`,`sub_title`,`code`,`status`) VALUES 
 (1,1,1,'-','-','-',0),
 (2,2,1,'Felső menüsor','Elérhető menüpontok',NULL,1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


--
-- Definition of table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE `menu_items` (
  `idmenu_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idmenu` int(10) unsigned NOT NULL,
  `idimage` int(10) unsigned NOT NULL DEFAULT 1,
  `idcontent` int(10) unsigned NOT NULL DEFAULT 1,
  `idgallery` int(10) unsigned NOT NULL DEFAULT 1,
  `idnews` int(10) unsigned NOT NULL DEFAULT 1,
  `parent_menu_item_id` int(10) unsigned NOT NULL DEFAULT 1,
  `is_gallery_list` tinyint(4) unsigned NOT NULL DEFAULT 0,
  `is_news_list` tinyint(4) unsigned NOT NULL DEFAULT 0,
  `title` varchar(150) NOT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `order` int(10) DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `published_to` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `creator` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idmenu_item`),
  KEY `fk_menu_item_menu_idx` (`idmenu`),
  KEY `fk_menu_item_image_idx` (`idimage`),
  KEY `fk_menu_item_creator_idx` (`creator`),
  KEY `fk_menu_item_editor_idx` (`editor`),
  KEY `fk_menu_item_content_idx` (`idcontent`),
  KEY `fk_menu_item_gallery_idx` (`idgallery`),
  CONSTRAINT `fk_menu_item_content` FOREIGN KEY (`idcontent`) REFERENCES `contents` (`idcontent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_menu_item_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_menu_item_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_menu_item_gallery` FOREIGN KEY (`idgallery`) REFERENCES `gallery` (`idgallery`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_menu_item_image` FOREIGN KEY (`idimage`) REFERENCES `images` (`idimage`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_menu_item_menu` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_items`
--

/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` (`idmenu_item`,`idmenu`,`idimage`,`idcontent`,`idgallery`,`idnews`,`parent_menu_item_id`,`is_gallery_list`,`is_news_list`,`title`,`sub_title`,`url`,`code`,`active`,`order`,`published`,`published_to`,`status`,`creator`,`created`,`editor`,`edited`) VALUES 
 (1,1,1,1,1,1,1,0,0,'-','-',NULL,'-',0,NULL,'2020-01-01 00:00:00','2020-01-01 00:00:00',0,1,'2020-01-01 00:00:00',1,NULL);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;


--
-- Definition of table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `idmodule` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'modul neve',
  `code` varchar(45) NOT NULL COMMENT 'modul egyedi kódja',
  `status` tinyint(4) unsigned NOT NULL DEFAULT 1 COMMENT 'modul státusza 1 élő 0 nem élő',
  `active` tinyint(4) unsigned NOT NULL DEFAULT 0 COMMENT '1 bekapcsolt  0 kikapcsolt',
  PRIMARY KEY (`idmodule`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='available cms modules';

--
-- Dumping data for table `modules`
--

/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` (`idmodule`,`name`,`code`,`status`,`active`) VALUES 
 (1,'-','-',0,0);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;


--
-- Definition of table `new_items`
--

DROP TABLE IF EXISTS `new_items`;
CREATE TABLE `new_items` (
  `idnew_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idnew` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `item_id` int(10) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `creator` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idnew_item`),
  KEY `fk_new_item_new_idx` (`idnew`),
  KEY `fk_new_item_creator_idx` (`creator`),
  KEY `fk_new_item_editor_idx` (`editor`),
  CONSTRAINT `fk_new_item_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_new_item_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_new_item_new` FOREIGN KEY (`idnew`) REFERENCES `news` (`idnew`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `new_items`
--

/*!40000 ALTER TABLE `new_items` DISABLE KEYS */;
INSERT INTO `new_items` (`idnew_item`,`idnew`,`title`,`type`,`item_id`,`status`,`creator`,`created`,`editor`,`edited`) VALUES 
 (1,1,'-','-',1,'0',1,'2020-01-01 00:00:00',1,NULL);
/*!40000 ALTER TABLE `new_items` ENABLE KEYS */;


--
-- Definition of table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `idnew` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(500) DEFAULT NULL,
  `short_desc` varchar(500) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `published_to` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `creator` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idnew`),
  KEY `fk_new_creator_idx` (`creator`),
  KEY `fk_new_editor_idx` (`editor`),
  CONSTRAINT `fk_new_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_new_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`idnew`,`title`,`short_desc`,`content`,`published`,`published_to`,`status`,`creator`,`created`,`editor`,`edited`) VALUES 
 (1,'-',NULL,'-','2020-01-01 00:00:00','2020-01-01 00:00:00',0,1,'2020-01-01 00:00:00',1,NULL);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


--
-- Definition of table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `idposition` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `code` varchar(45) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idposition`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `positions`
--

/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` (`idposition`,`type`,`code`,`name`,`status`) VALUES 
 (1,'-','-','-',0),
 (2,'menu','top_menu','Felső menü',1);
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;


--
-- Definition of table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `idtag` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcontent` int(10) unsigned NOT NULL,
  `idnew` int(10) unsigned NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `creator` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  `edited` datetime DEFAULT NULL,
  PRIMARY KEY (`idtag`),
  KEY `fk_tag_content_idx` (`idcontent`),
  KEY `fk_tag_new_idx` (`idnew`),
  KEY `fk_tag_creator_idx` (`creator`),
  KEY `fk_tag_editor_idx` (`editor`),
  CONSTRAINT `fk_tag_content` FOREIGN KEY (`idcontent`) REFERENCES `contents` (`idcontent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tag_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tag_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tag_new` FOREIGN KEY (`idnew`) REFERENCES `news` (`idnew`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` (`idtag`,`idcontent`,`idnew`,`tag`,`status`,`creator`,`created`,`editor`,`edited`) VALUES 
 (1,1,1,'-',0,1,'2020-01-01 00:00:00',1,NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `iduser` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `auth_id` varchar(60) DEFAULT NULL COMMENT 'rauth azon.',
  `ext_id` varchar(60) DEFAULT NULL COMMENT 'külső azonosító számára',
  `name` varchar(255) DEFAULT NULL COMMENT 'felhasználó neve',
  `email` varchar(120) DEFAULT NULL COMMENT 'felh email',
  `role` varchar(45) DEFAULT NULL COMMENT 'fő szerepkör',
  `hash` text DEFAULT NULL COMMENT 'egyedi hash',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`iduser`,`auth_id`,`ext_id`,`name`,`email`,`role`,`hash`,`status`) VALUES 
 (1,'1','1','-','-','-','-',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;



/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
