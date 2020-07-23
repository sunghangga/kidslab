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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `classroom` */

insert  into `classroom`(`id`,`name`,`quota`,`class_type_id`,`create_at`,`update_at`) values (4,'Tuesday 07:00',16,1,'2020-07-24 06:12:43','2020-07-24 06:07:06'),(5,'Saturday 15:00',17,2,'2020-07-24 06:30:26','2020-07-24 06:07:31');

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

insert  into `company`(`id`,`name`,`logo`,`tlp`,`create_at`,`update_at`) values (1,'PT. Horison Nusa Jaya Transport','logo-200722-2e4250bf34.jpg','085253703814','2020-04-09 08:44:20','2020-07-22 21:36:32');

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

insert  into `participants`(`id`,`code`,`child_name`,`parent_name`,`phone`,`email`,`address`,`birth_date`,`create_at`,`update_at`) values (6,'KL11.00000001','Chistina Puth','Justin','085123456789','test@gmail.com','test','2020-07-24','2020-07-24 07:04:27','2020-07-24 07:04:27');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `register` */

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
  KEY `group_id` (`group_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`username`,`password`,`group_id`,`status`,`create_at`,`update_at`) values (1,'admin','admin','$2a$08$A7YBcoS1XFXsM3toL6xFjuAaPzvfKta6XB3hCIJ5yjdpRtwlasq5O',1,1,'2020-07-24 05:47:37','2020-07-24 05:07:37'),(13,'angga','angga','$2a$08$A4B6KNg3LKVubsE7mYsGtufH9R76f.3RA074h8gNv0184yP1W/SCu',2,1,'2020-07-23 12:07:12','2020-07-23 00:24:12');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
