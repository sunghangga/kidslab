/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.4.11-MariaDB : Database - db_kl
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_kl` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_kl`;

/*Table structure for table `class_type` */

DROP TABLE IF EXISTS `class_type`;

CREATE TABLE `class_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `class_type` */

insert  into `class_type`(`id`,`name`,`create_at`,`update_at`) values (1,'BETA','2020-07-22 23:45:47','2020-07-23 00:07:20'),(2,'ALPHA','2020-07-22 23:48:16','2020-07-22 23:48:16');

/*Table structure for table `classroom` */

DROP TABLE IF EXISTS `classroom`;

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `quota` int(200) NOT NULL,
  `class_type_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `class_type_id` (`class_type_id`),
  CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`class_type_id`) REFERENCES `class_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `classroom` */

insert  into `classroom`(`id`,`name`,`quota`,`class_type_id`,`create_at`,`update_at`) values (4,'Tuesday 07:00',10,1,'2020-07-24 06:12:43','2020-07-26 01:50:45'),(5,'Saturday 15:00',17,2,'2020-07-24 06:30:26','2020-07-24 06:07:31'),(6,'Monday 08:00',0,2,'2020-07-26 01:52:00','2020-07-26 01:52:00');

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) CHARACTER SET latin1 NOT NULL,
  `logo` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT 'logo.png',
  `tlp` varchar(15) CHARACTER SET latin1 NOT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `company` */

insert  into `company`(`id`,`name`,`logo`,`tlp`,`create_at`,`update_at`) values (1,'Kids Lab','logo-200724-5ff09d475a.png','081808450014','2020-04-09 08:44:20','2020-07-24 20:07:21');

/*Table structure for table `group` */

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) CHARACTER SET latin1 NOT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `group` */

insert  into `group`(`id`,`name`,`create_at`,`update_at`) values (1,'Admin','2020-07-22 21:01:42','2020-07-22 21:07:07'),(2,'Karyawan','2020-07-22 21:04:23','2020-07-22 21:07:10'),(6,'Member','2020-07-22 22:38:01','2020-07-22 22:38:12');

/*Table structure for table `participants` */

DROP TABLE IF EXISTS `participants`;

CREATE TABLE `participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `child_name` varchar(125) NOT NULL,
  `parent_name` varchar(125) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `birth_date` date NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `participants` */

insert  into `participants`(`id`,`code`,`child_name`,`parent_name`,`phone`,`email`,`address`,`birth_date`,`create_at`,`update_at`) values (6,'KL11.00000001','Chistina Puth','Justin Timber','085123456789','test@gmail.com','test','2020-07-24','2020-07-24 07:04:27','2020-07-24 20:39:43');

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_status` int(2) NOT NULL DEFAULT 0,
  `register_id` int(11) NOT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `register_id` (`register_id`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`register_id`) REFERENCES `register` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `payment` */

insert  into `payment`(`id`,`pay_status`,`register_id`,`create_at`,`update_at`) values (5,0,6,'2020-07-26 01:51:05','2020-07-26 13:26:30'),(6,0,7,'2020-07-26 01:55:05','2020-07-26 13:20:09'),(7,0,8,'2020-07-26 14:02:51','2020-07-26 14:02:51'),(8,1,9,'2020-07-26 14:03:19','2020-07-27 00:52:40');

/*Table structure for table `register` */

DROP TABLE IF EXISTS `register`;

CREATE TABLE `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_code` varchar(30) NOT NULL,
  `child_name` varchar(125) NOT NULL,
  `parent_name` varchar(125) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `birth_date` date NOT NULL,
  `period` date NOT NULL,
  `class_type_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `classroom_id` (`classroom_id`),
  KEY `register_ibfk_1` (`class_type_id`),
  CONSTRAINT `register_ibfk_1` FOREIGN KEY (`class_type_id`) REFERENCES `class_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `register_ibfk_2` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `register` */

insert  into `register`(`id`,`reg_code`,`child_name`,`parent_name`,`phone`,`email`,`address`,`birth_date`,`period`,`class_type_id`,`classroom_id`,`note`,`create_at`,`update_at`) values (6,'KL21.00000003','Chistina Puth','Justin Timber','085123456789','test@gmail.com','testing','2020-07-24','2020-08-01',1,4,'','2020-07-26 01:51:05','2020-07-26 01:54:13'),(7,'KL21.00000004','Chistina Puth','Justin Timber','085123456789','test@gmail.com','test','2020-07-24','2020-07-01',1,4,'','2020-07-26 01:55:05','2020-07-26 01:55:05'),(8,'KL21.00000005','Chistina Puth','Justin Timber','085123456789','test@gmail.com','test','2020-07-24','2020-07-01',2,5,'','2020-07-26 14:02:51','2020-07-26 14:02:51'),(9,'KL21.00000006','Chistina Puth','Justin Timber','085123456789','test@gmail.com','test','2020-07-24','2020-07-01',2,5,'','2020-07-26 14:03:19','2020-07-26 14:03:19');

/*Table structure for table `shipment` */

DROP TABLE IF EXISTS `shipment`;

CREATE TABLE `shipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_status` int(2) DEFAULT 0,
  `ship_status` int(2) DEFAULT 0,
  `register_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `register_id` (`register_id`),
  CONSTRAINT `shipment_ibfk_1` FOREIGN KEY (`register_id`) REFERENCES `register` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `shipment` */

insert  into `shipment`(`id`,`pay_status`,`ship_status`,`register_id`,`create_at`,`update_at`) values (1,1,1,9,'2020-07-26 14:03:19','2020-07-27 00:55:50');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) CHARACTER SET latin1 NOT NULL,
  `username` varchar(55) CHARACTER SET latin1 NOT NULL,
  `password` text CHARACTER SET latin1 NOT NULL,
  `group_id` int(3) NOT NULL,
  `status` int(3) NOT NULL DEFAULT 1,
  `create_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_ibfk_1` (`group_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`username`,`password`,`group_id`,`status`,`create_at`,`update_at`) values (1,'admin','admin','$2a$08$A7YBcoS1XFXsM3toL6xFjuAaPzvfKta6XB3hCIJ5yjdpRtwlasq5O',1,1,'2020-07-24 05:47:37','2020-07-24 05:07:37'),(14,'angga','angga','$2a$08$fycOizjZCPh9Om1FThdX/uAVVlKJ4NMDwyvh2znJi7BhdgLRNGG86',2,1,'2020-07-25 23:04:00','2020-07-25 23:04:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
