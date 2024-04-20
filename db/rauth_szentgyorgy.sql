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
-- Create schema rauth
--

CREATE DATABASE IF NOT EXISTS rauth;
USE rauth;

--
-- Definition of table `access_log`
--

DROP TABLE IF EXISTS `access_log`;
CREATE TABLE `access_log` (
  `idaccess_log` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL COMMENT 'when',
  `iduser` int(10) unsigned NOT NULL DEFAULT 1 COMMENT 'who',
  `ip_address` varchar(20) DEFAULT NULL COMMENT 'client ip address',
  `location` varchar(100) DEFAULT NULL COMMENT 'from',
  `user_agent` varchar(255) DEFAULT NULL COMMENT 'client browser',
  `url` varchar(2000) DEFAULT NULL COMMENT 'requested url',
  `notice` text DEFAULT NULL COMMENT 'other info',
  `status` tinyint(4) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`idaccess_log`),
  KEY `fk_access_log_users_idx` (`iduser`),
  CONSTRAINT `fk_access_log_users` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='access log';

--
-- Dumping data for table `access_log`
--

/*!40000 ALTER TABLE `access_log` DISABLE KEYS */;
INSERT INTO `access_log` (`idaccess_log`,`time`,`iduser`,`ip_address`,`location`,`user_agent`,`url`,`notice`,`status`) VALUES 
 (1,'2020-01-01 00:00:00',1,'127.0.0.1','Hungary','Chrome','rauth.hu','-',0);
/*!40000 ALTER TABLE `access_log` ENABLE KEYS */;


--
-- Definition of table `address_type`
--

DROP TABLE IF EXISTS `address_type`;
CREATE TABLE `address_type` (
  `idaddress_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'name of address type',
  `code` varchar(20) DEFAULT NULL COMMENT 'code of address type',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idaddress_type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='available address types (post address, billing address, etc...)';

--
-- Dumping data for table `address_type`
--

/*!40000 ALTER TABLE `address_type` DISABLE KEYS */;
INSERT INTO `address_type` (`idaddress_type`,`name`,`code`,`status`) VALUES 
 (1,'-','-',0);
/*!40000 ALTER TABLE `address_type` ENABLE KEYS */;


--
-- Definition of table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `idaddress` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idaddress_type` int(10) unsigned NOT NULL DEFAULT 1 COMMENT 'type of address (rel to address_type)',
  `iduser` int(10) unsigned NOT NULL,
  `idcontact` int(10) unsigned NOT NULL,
  `idstreet_type` int(10) unsigned NOT NULL DEFAULT 1 COMMENT 'type of street (rel to street_type)',
  `country` varchar(150) DEFAULT NULL,
  `county` varchar(150) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `house_no` varchar(10) DEFAULT NULL,
  `building` varchar(50) DEFAULT NULL,
  `floor` varchar(20) DEFAULT NULL,
  `door` varchar(10) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'record status (1-live or 2-dead)',
  `created` datetime NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`idaddress`),
  KEY `fk_addresses_address_type_idx` (`idaddress_type`),
  KEY `fk_addresses_street_type_idx` (`idstreet_type`),
  KEY `fk_addresses_creator_idx` (`creator`),
  KEY `fk_addresses_editor_idx` (`editor`),
  KEY `fk_addresses_user_idx` (`iduser`),
  KEY `fk_addresses_contact_idx` (`idcontact`),
  CONSTRAINT `fk_addresses_address_type` FOREIGN KEY (`idaddress_type`) REFERENCES `address_type` (`idaddress_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_addresses_contact` FOREIGN KEY (`idcontact`) REFERENCES `contacts` (`idcontact`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_addresses_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_addresses_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_addresses_street_type` FOREIGN KEY (`idstreet_type`) REFERENCES `street_type` (`idstreet_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_addresses_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='addresses of users and contacts';

--
-- Dumping data for table `addresses`
--

/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
INSERT INTO `addresses` (`idaddress`,`idaddress_type`,`iduser`,`idcontact`,`idstreet_type`,`country`,`county`,`zip`,`city`,`street`,`house_no`,`building`,`floor`,`door`,`address`,`status`,`created`,`creator`,`edited`,`editor`) VALUES 
 (1,1,1,1,1,'-','-','-','-','-','-','-','-','-','-',0,'2020-01-01 00:00:00',1,NULL,1);
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;


--
-- Definition of table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `idcontact` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcontact`),
  KEY `fk_contact_creator_idx` (`creator`),
  KEY `fk_contact_editor_idx` (`editor`),
  CONSTRAINT `fk_contact_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contact_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='contacts';

--
-- Dumping data for table `contacts`
--

/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`idcontact`,`name`,`email`,`phone`,`fax`,`status`,`created`,`creator`,`edited`,`editor`) VALUES 
 (1,'-','-','-','-',0,'2020-01-01 00:00:00',1,NULL,1);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;


--
-- Definition of table `email_message_addresses`
--

DROP TABLE IF EXISTS `email_message_addresses`;
CREATE TABLE `email_message_addresses` (
  `idemail_message_address` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idemail_message` int(10) unsigned NOT NULL,
  `iduser` int(10) unsigned NOT NULL DEFAULT 1,
  `idregistration` int(10) unsigned NOT NULL DEFAULT 1,
  `type` enum('from','to','cc','bcc') NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`idemail_message_address`),
  KEY `fk_email_message_address_email_message_idx` (`idemail_message`),
  KEY `fk_email_message_address_registration_idx` (`idregistration`),
  KEY `fk_email_message_address_user_idx` (`iduser`),
  CONSTRAINT `fk_email_message_address_email_message` FOREIGN KEY (`idemail_message`) REFERENCES `email_messages` (`idemail_message`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_email_message_address_registration` FOREIGN KEY (`idregistration`) REFERENCES `registrations` (`idregistration`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_email_message_address_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_message_addresses`
--

/*!40000 ALTER TABLE `email_message_addresses` DISABLE KEYS */;
INSERT INTO `email_message_addresses` (`idemail_message_address`,`idemail_message`,`iduser`,`idregistration`,`type`,`name`,`email`,`status`) VALUES 
 (1,1,1,1,'cc','-','-',0);
/*!40000 ALTER TABLE `email_message_addresses` ENABLE KEYS */;


--
-- Definition of table `email_messages`
--

DROP TABLE IF EXISTS `email_messages`;
CREATE TABLE `email_messages` (
  `idemail_message` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idtemplate` int(10) unsigned NOT NULL DEFAULT 1,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sent` datetime DEFAULT NULL,
  `message_status` enum('draft','sending','sent') DEFAULT 'draft',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`idemail_message`),
  KEY `fk_email_message_editor_idx` (`editor`),
  KEY `fk_email_message_creator_idx` (`creator`),
  KEY `fk_email_message_template_idx` (`idtemplate`),
  CONSTRAINT `fk_email_message_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_email_message_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_email_message_template` FOREIGN KEY (`idtemplate`) REFERENCES `templates` (`idtemplate`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='sent emails from system';

--
-- Dumping data for table `email_messages`
--

/*!40000 ALTER TABLE `email_messages` DISABLE KEYS */;
INSERT INTO `email_messages` (`idemail_message`,`idtemplate`,`subject`,`message`,`sent`,`message_status`,`status`,`created`,`creator`,`edited`,`editor`) VALUES 
 (1,1,'-','-','2019-01-01 00:00:00','draft',0,'2019-01-01 00:00:00',1,NULL,1);
/*!40000 ALTER TABLE `email_messages` ENABLE KEYS */;


--
-- Definition of table `error_log`
--

DROP TABLE IF EXISTS `error_log`;
CREATE TABLE `error_log` (
  `iderror_log` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` enum('warning','error') NOT NULL,
  `message` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `creator` int(11) NOT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`iderror_log`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='error log';

--
-- Dumping data for table `error_log`
--

/*!40000 ALTER TABLE `error_log` DISABLE KEYS */;
INSERT INTO `error_log` (`iderror_log`,`level`,`message`,`status`,`created`,`creator`,`edited`,`editor`) VALUES 
 (1,'warning','-',0,'0000-00-00 00:00:00',0,NULL,1);
/*!40000 ALTER TABLE `error_log` ENABLE KEYS */;


--
-- Definition of table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `idimage` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`idimage`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`idimage`,`name`,`path`,`status`) VALUES 
 (1,'-','-',0);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;


--
-- Definition of table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `idpermission` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idpermission`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`idpermission`,`name`,`code`,`status`) VALUES 
 (1,'-',NULL,0);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


--
-- Definition of table `registrations`
--

DROP TABLE IF EXISTS `registrations`;
CREATE TABLE `registrations` (
  `idregistration` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idsystem` int(10) unsigned NOT NULL,
  `iduser` int(10) unsigned NOT NULL DEFAULT 1,
  `idemail_message` int(10) unsigned NOT NULL DEFAULT 1,
  `code` varchar(50) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`idregistration`),
  KEY `fk_registration_email_message_idx` (`idemail_message`),
  KEY `fk_registration_creator_idx` (`creator`),
  KEY `fk_registration_editor_idx` (`editor`),
  KEY `fk_registration_user_idx` (`iduser`),
  KEY `fk_registration_system_idx` (`idsystem`),
  CONSTRAINT `fk_registration_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_registration_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_registration_email_message` FOREIGN KEY (`idemail_message`) REFERENCES `email_messages` (`idemail_message`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_registration_system` FOREIGN KEY (`idsystem`) REFERENCES `systems` (`idsystem`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_registration_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registrations`
--

/*!40000 ALTER TABLE `registrations` DISABLE KEYS */;
INSERT INTO `registrations` (`idregistration`,`idsystem`,`iduser`,`idemail_message`,`code`,`email`,`expire`,`name`,`status`,`created`,`creator`,`edited`,`editor`) VALUES 
 (1,1,1,1,'-','-','2018-01-01 00:00:00','-',0,'2018-01-01 00:00:00',1,NULL,1);
/*!40000 ALTER TABLE `registrations` ENABLE KEYS */;


--
-- Definition of table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `idrole` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idrole`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='roles of users';

--
-- Dumping data for table `roles`
--

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`idrole`,`name`,`code`,`status`) VALUES 
 (1,'-',NULL,0);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


--
-- Definition of table `street_type`
--

DROP TABLE IF EXISTS `street_type`;
CREATE TABLE `street_type` (
  `idstreet_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idstreet_type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='types of streets';

--
-- Dumping data for table `street_type`
--

/*!40000 ALTER TABLE `street_type` DISABLE KEYS */;
INSERT INTO `street_type` (`idstreet_type`,`name`,`code`,`status`) VALUES 
 (1,'-','-',0);
/*!40000 ALTER TABLE `street_type` ENABLE KEYS */;


--
-- Definition of table `systems`
--

DROP TABLE IF EXISTS `systems`;
CREATE TABLE `systems` (
  `idsystem` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idsystem`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `systems`
--

/*!40000 ALTER TABLE `systems` DISABLE KEYS */;
INSERT INTO `systems` (`idsystem`,`code`,`name`,`status`) VALUES 
 (1,'-','-',0),
 (2,'oroszlangy','Oroszlán Gyógyszertár Nagykőrös',1);
/*!40000 ALTER TABLE `systems` ENABLE KEYS */;


--
-- Definition of table `templates`
--

DROP TABLE IF EXISTS `templates`;
CREATE TABLE `templates` (
  `idtemplate` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `content` text DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idtemplate`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `templates`
--

/*!40000 ALTER TABLE `templates` DISABLE KEYS */;
INSERT INTO `templates` (`idtemplate`,`code`,`content`,`name`,`status`) VALUES 
 (1,'-','-','-',0);
/*!40000 ALTER TABLE `templates` ENABLE KEYS */;


--
-- Definition of table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE `tokens` (
  `idtoken` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iduser_system` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `status` tinyint(4) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`idtoken`),
  KEY `fk_token_user_system_idx` (`iduser_system`),
  CONSTRAINT `fk_token_user_system` FOREIGN KEY (`iduser_system`) REFERENCES `user_system` (`iduser_system`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tokens`
--

/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
INSERT INTO `tokens` (`idtoken`,`iduser_system`,`created`,`token`,`status`) VALUES 
 (1,1,'2020-01-01 08:00:00','-',0);
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;


--
-- Definition of table `user_contact`
--

DROP TABLE IF EXISTS `user_contact`;
CREATE TABLE `user_contact` (
  `iduser_contact` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcontact` int(10) unsigned NOT NULL,
  `iduser` int(10) unsigned NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created` datetime NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`iduser_contact`),
  KEY `fk_user_contact_user_idx` (`iduser`),
  KEY `fk_user_contact_contact_idx` (`idcontact`),
  KEY `fk_user_contact_creator_idx` (`creator`),
  KEY `fk_user_contact_editor_idx` (`editor`),
  CONSTRAINT `fk_user_contact_contact` FOREIGN KEY (`idcontact`) REFERENCES `contacts` (`idcontact`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_contact_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_contact_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_contact_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_contact`
--

/*!40000 ALTER TABLE `user_contact` DISABLE KEYS */;
INSERT INTO `user_contact` (`iduser_contact`,`idcontact`,`iduser`,`status`,`created`,`creator`,`edited`,`editor`) VALUES 
 (1,1,1,'0','2018-01-01 00:00:00',1,NULL,1);
/*!40000 ALTER TABLE `user_contact` ENABLE KEYS */;


--
-- Definition of table `user_password`
--

DROP TABLE IF EXISTS `user_password`;
CREATE TABLE `user_password` (
  `iduser_password` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iduser_system` int(10) unsigned NOT NULL,
  `iduser` int(10) unsigned NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `valid` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`iduser_password`),
  KEY `fk_user_password_user_system_idx` (`iduser_system`),
  KEY `fk_user_password_user_idx` (`iduser`),
  KEY `fk_user_password_creator_idx` (`creator`),
  KEY `fk_user_password_editor_idx` (`editor`),
  CONSTRAINT `fk_user_password_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_password_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_password_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_password_user_system` FOREIGN KEY (`iduser_system`) REFERENCES `user_system` (`iduser_system`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_password`
--

/*!40000 ALTER TABLE `user_password` DISABLE KEYS */;
INSERT INTO `user_password` (`iduser_password`,`iduser_system`,`iduser`,`pwd`,`valid`,`status`,`created`,`creator`,`edited`,`editor`) VALUES 
 (1,1,1,'-','2018-01-01 00:00:00',0,'2018-01-01 00:00:00',1,'2018-01-01 00:00:00',1),
 (4,2,3,'d09f1ca21edfdd569e183b4705caf38b575317ccb73444651490a774f4695eac','2050-01-01 00:00:00',1,'2018-01-01 00:00:00',1,'2018-01-01 00:00:00',1),
 (5,2,4,'cdf3e9321987f77cb4ee6d29a88e00ca7f1d238d2659c9c456fe0419f970b260','2050-01-01 00:00:00',1,'2018-01-01 00:00:00',1,'2018-01-01 00:00:00',1);
/*!40000 ALTER TABLE `user_password` ENABLE KEYS */;


--
-- Definition of table `user_permission`
--

DROP TABLE IF EXISTS `user_permission`;
CREATE TABLE `user_permission` (
  `iduser_permission` int(10) unsigned NOT NULL,
  `idpermission` int(10) unsigned NOT NULL,
  `iduser` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`iduser_permission`),
  KEY `fk_user_permission_user_idx` (`iduser`),
  KEY `fk_user_permission_permission_idx` (`idpermission`),
  KEY `fk_user_permission_creator_idx` (`creator`),
  KEY `fk_user_permission_editor_idx` (`editor`),
  CONSTRAINT `fk_user_permission_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_permission_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_permission_permission` FOREIGN KEY (`idpermission`) REFERENCES `permissions` (`idpermission`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_permission_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_permission`
--

/*!40000 ALTER TABLE `user_permission` DISABLE KEYS */;
INSERT INTO `user_permission` (`iduser_permission`,`idpermission`,`iduser`,`status`,`created`,`creator`,`edited`,`editor`) VALUES 
 (1,1,1,0,'2018-01-01 00:00:00',1,'2018-01-01 00:00:00',1);
/*!40000 ALTER TABLE `user_permission` ENABLE KEYS */;


--
-- Definition of table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `iduser_role` int(10) unsigned NOT NULL,
  `iduser` int(10) unsigned NOT NULL,
  `idrole` int(10) unsigned NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`iduser_role`),
  KEY `fk_user_role_role_idx` (`idrole`),
  KEY `fk_user_role_user_idx` (`iduser`),
  KEY `fk_user_role_creator_idx` (`creator`),
  KEY `fk_user_role_editor_idx` (`editor`),
  CONSTRAINT `fk_user_role_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_role_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_role_role` FOREIGN KEY (`idrole`) REFERENCES `roles` (`idrole`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_role_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='roles of users (eorg: admin)';

--
-- Dumping data for table `user_role`
--

/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`iduser_role`,`iduser`,`idrole`,`status`,`created`,`creator`,`edited`,`editor`) VALUES 
 (1,1,1,0,'2018-01-01 00:00:00',1,'2018-01-01 00:00:00',1);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;


--
-- Definition of table `user_system`
--

DROP TABLE IF EXISTS `user_system`;
CREATE TABLE `user_system` (
  `iduser_system` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idsystem` int(10) unsigned NOT NULL,
  `iduser` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`iduser_system`),
  KEY `fk_user_system_user_idx` (`iduser`),
  KEY `fk_user_system_system_idx` (`idsystem`),
  KEY `fk_user_system_creator_idx` (`creator`),
  KEY `fk_user_system_editor_idx` (`editor`),
  CONSTRAINT `fk_user_system_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_system_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_system_system` FOREIGN KEY (`idsystem`) REFERENCES `systems` (`idsystem`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_system_user` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='user-system rel.';

--
-- Dumping data for table `user_system`
--

/*!40000 ALTER TABLE `user_system` DISABLE KEYS */;
INSERT INTO `user_system` (`iduser_system`,`idsystem`,`iduser`,`status`,`created`,`creator`,`edited`,`editor`) VALUES 
 (1,1,1,0,'2018-01-01 00:00:00',1,'2018-01-01 00:00:00',1),
 (2,2,3,1,'2018-01-01 00:00:00',1,'2018-01-01 00:00:00',1),
 (3,2,4,1,'2018-01-01 00:00:00',1,'2018-01-01 00:00:00',1);
/*!40000 ALTER TABLE `user_system` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `iduser` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idimage` int(10) unsigned NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `email` varchar(120) NOT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `salt` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` datetime NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `edited` datetime DEFAULT NULL,
  `editor` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`iduser`),
  KEY `fk_users_image_idx` (`idimage`),
  KEY `fk_users_creator_idx` (`creator`),
  KEY `fk_users_editor_idx` (`editor`),
  CONSTRAINT `fk_users_creator` FOREIGN KEY (`creator`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_editor` FOREIGN KEY (`editor`) REFERENCES `users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_image` FOREIGN KEY (`idimage`) REFERENCES `images` (`idimage`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`iduser`,`idimage`,`name`,`email`,`active`,`salt`,`status`,`created`,`creator`,`edited`,`editor`) VALUES 
 (1,1,'-','-',0,'-',0,'2018-01-01 00:00:00',1,'2018-01-01 00:00:00',1),
 (3,1,'Benedek Richárd','richard.benedek@gmail.com',1,'ecec490ef711fb52e13443e0a4b51551',1,'2018-01-01 00:00:00',1,NULL,1),
 (4,1,'Szent György Gyógyszertár','gyorgypatika@gmail.com',1,'5a63ec205b5e23f481a8ae62e1e52244',1,'2018-01-01 00:00:00',1,NULL,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;



/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
