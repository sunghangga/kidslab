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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `classroom` */

insert  into `classroom`(`id`,`name`,`quota`,`class_type_id`,`create_at`,`update_at`) values (4,'Tuesday 07.00',10,1,'2020-07-24 06:12:43','2020-07-30 05:43:13'),(5,'Saturday 15.00',17,2,'2020-07-24 06:30:26','2020-07-30 05:43:05'),(6,'Monday 08.00',0,2,'2020-07-26 01:52:00','2020-07-30 05:42:59'),(8,'Sunday 10.00',0,1,'2020-07-30 05:46:08','2020-07-30 05:47:16');

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

insert  into `company`(`id`,`name`,`logo`,`tlp`,`create_at`,`update_at`) values (1,'Kids Lab','logo-200724-5ff09d475a.jpg','081808450014','2020-04-09 08:44:20','2020-07-24 20:07:21');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `participants` */

insert  into `participants`(`id`,`code`,`child_name`,`parent_name`,`phone`,`email`,`address`,`birth_date`,`create_at`,`update_at`) values (16,'KL11.000001','Made Suastini','Angga Pramana','085123456789','default@email.com','Jl. Angsoka Barat Denpasar','0000-00-00','2020-07-30 23:17:21','2020-07-30 23:17:21'),(17,'KL11.000002','Kadek Eka','Agus Gita','084654321654','default@email.com','Jl. Kebayoran Jakarta','0000-00-00','2020-07-30 23:17:21','2020-07-30 23:17:21'),(18,'KL11.000003','Kadek Suputra','Wayan Suyasa','03214567987','default@email.com','Jl. Ahmad Yani','0000-00-00','2020-07-30 23:17:22','2020-07-30 23:17:22'),(19,'KL11.000004','Putu Laksmana','Made Krida','098654132467','default@email.com','Jl. Kuta Utara Bali','0000-00-00','2020-07-30 23:17:22','2020-07-30 23:17:22'),(20,'KL11.000005','Kadek Eka S','Agus Gita','084654321654','default@email.com','Jl. Kebayoran Jakarta','2020-07-30','2020-07-31 06:14:29','2020-07-31 06:14:29');

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

/*Data for the table `payment` */

insert  into `payment`(`id`,`pay_status`,`register_id`,`create_at`,`update_at`) values (22,0,23,'2020-07-30 23:17:21','2020-07-30 23:17:21'),(23,0,24,'2020-07-30 23:17:21','2020-07-30 23:17:21'),(24,0,25,'2020-07-30 23:17:22','2020-07-30 23:17:22'),(26,0,27,'2020-07-30 23:17:22','2020-07-30 23:17:22'),(27,0,28,'2020-07-30 23:17:22','2020-07-30 23:17:22'),(28,0,29,'2020-07-31 05:47:38','2020-07-31 05:47:38'),(29,0,30,'2020-07-31 05:47:38','2020-07-31 05:47:38'),(30,0,31,'2020-07-31 05:47:38','2020-07-31 05:47:38'),(31,0,32,'2020-07-31 05:47:38','2020-07-31 05:47:38'),(32,0,33,'2020-07-31 05:47:38','2020-07-31 05:47:38'),(33,0,34,'2020-07-31 05:47:38','2020-07-31 05:47:38'),(34,1,35,'2020-07-31 06:14:29','2020-07-31 07:09:57');

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
  `class_type_id` int(11) DEFAULT NULL,
  `classroom_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `classroom_id` (`classroom_id`),
  KEY `register_ibfk_1` (`class_type_id`),
  CONSTRAINT `register_ibfk_1` FOREIGN KEY (`class_type_id`) REFERENCES `class_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `register_ibfk_2` FOREIGN KEY (`classroom_id`) REFERENCES `classroom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

/*Data for the table `register` */

insert  into `register`(`id`,`reg_code`,`child_name`,`parent_name`,`phone`,`email`,`address`,`birth_date`,`period`,`class_type_id`,`classroom_id`,`note`,`create_at`,`update_at`) values (23,'KL21.00000001','Made Suastini','Angga Pramana','085123456789','default@email.com','Jl. Angsoka Barat Denpasar','0000-00-00','2020-07-01',2,NULL,'Monday 08.00 (Class Full)','2020-07-30 23:17:21','2020-07-30 23:17:21'),(24,'KL21.00000002','Kadek Eka','Agus Gita','084654321654','default@email.com','Jl. Kebayoran Jakarta','0000-00-00','2020-07-01',2,NULL,'Custom ke hari Friday 17.00 (Request)','2020-07-30 23:17:21','2020-07-30 23:17:21'),(25,'KL21.00000003','Made Suastini','Angga Pramana','085123456789','default@email.com','Jl. Angkasa Ria','0000-00-00','2020-07-01',2,5,'Custom ke hari Friday 17.00 (Request)','2020-07-30 23:17:22','2020-07-30 23:17:22'),(27,'KL21.00000005','Putu Laksmana','Made Krida','098654132467','default@email.com','Jl. Kuta Utara Bali','2020-07-31','2020-07-01',1,4,'Custom day sunday 10.00 (Request)','2020-07-30 23:17:22','2020-07-31 05:44:35'),(28,'KL21.00000006','Kadek Suputra','Kadek Dito','03214567987','default@email.com','Jl. Mekar Abadi','0000-00-00','2020-07-01',1,4,'Custom day sunday 10.00 (Request)','2020-07-30 23:17:22','2020-07-30 23:17:22'),(29,'KL21.00000007','Made Suastini','Angga Pramana','085123456789','default@email.com','Jl. Angsoka Barat Denpasar','2020-07-30','2020-07-01',2,NULL,'Monday 08.00 (Class Full)','2020-07-31 05:47:38','2020-07-31 05:47:38'),(30,'KL21.00000008','Kadek Eka','Agus Gita','084654321654','default@email.com','Jl. Kebayoran Jakarta','2020-07-30','2020-07-01',2,NULL,'Custom ke hari Friday 17.00 (Request)','2020-07-31 05:47:38','2020-07-31 05:47:38'),(31,'KL21.00000009','Made Suastini','Angga Pramana','085123456789','default@email.com','Jl. Angkasa Ria','2020-07-30','2020-07-01',2,5,'Custom ke hari Friday 17.00 (Request)','2020-07-31 05:47:38','2020-07-31 05:47:38'),(32,'KL21.00000010','Kadek Suputra','Wayan Suyasa','03214567987','default@email.com','Jl. Ahmad Yani','2020-07-30','2020-07-01',1,NULL,'Sunday 10.00 (Class Full)','2020-07-31 05:47:38','2020-07-31 05:47:38'),(33,'KL21.00000011','Putu Laksmana','Made Krida','098654132467','default@email.com','Jl. Kuta Utara Bali','2020-07-30','2020-07-01',1,NULL,'Custom day sunday 10.00 (Request)','2020-07-31 05:47:38','2020-07-31 05:47:38'),(34,'KL21.00000012','Kadek Suputra','Kadek Dito','03214567987','default@email.com','Jl. Mekar Abadi','2020-07-29','2020-07-01',1,4,'Custom day sunday 10.00 (Request)','2020-07-31 05:47:38','2020-07-31 05:47:38'),(35,'KL21.00000013','Kadek Eka S','Agus Gita','084654321654','default@email.com','Jl. Kebayoran Jakarta','2020-07-30','2020-07-01',2,5,'','2020-07-31 06:14:28','2020-07-31 06:14:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `shipment` */

insert  into `shipment`(`id`,`pay_status`,`ship_status`,`register_id`,`create_at`,`update_at`) values (15,0,0,23,'2020-07-30 23:17:21','2020-07-30 23:17:21'),(16,0,0,24,'2020-07-30 23:17:21','2020-07-30 23:17:21'),(17,0,0,25,'2020-07-30 23:17:22','2020-07-30 23:17:22'),(19,0,0,27,'2020-07-30 23:17:22','2020-07-30 23:17:22'),(20,0,0,28,'2020-07-30 23:17:22','2020-07-30 23:17:22'),(21,0,0,29,'2020-07-31 05:47:38','2020-07-31 05:47:38'),(22,0,0,30,'2020-07-31 05:47:38','2020-07-31 05:47:38'),(23,0,0,31,'2020-07-31 05:47:38','2020-07-31 05:47:38'),(24,0,0,32,'2020-07-31 05:47:38','2020-07-31 05:47:38'),(25,0,0,33,'2020-07-31 05:47:38','2020-07-31 05:47:38'),(26,0,0,34,'2020-07-31 05:47:38','2020-07-31 05:47:38'),(27,1,1,35,'2020-07-31 06:14:29','2020-07-31 07:10:23');

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
