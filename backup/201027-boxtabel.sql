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

insert  into `classroom`(`id`,`name`,`quota`,`class_type_id`,`create_at`,`update_at`) values (4,'Tuesday 07.00',10,1,'2020-07-24 06:12:43','2020-07-30 05:43:13'),(5,'Saturday 15.00',3,2,'2020-07-24 06:30:26','2020-08-03 17:50:22'),(6,'Monday 08.00',1,2,'2020-07-26 01:52:00','2020-08-24 06:00:50'),(8,'Sunday 10.00',1,1,'2020-07-30 05:46:08','2020-08-20 23:28:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

/*Data for the table `participants` */

insert  into `participants`(`id`,`code`,`child_name`,`parent_name`,`phone`,`email`,`address`,`birth_date`,`create_at`,`update_at`) values (16,'KL11.000001','Made Suastini','Angga Pramana','085123456789','default@email.com','Jl. Angsoka Barat Denpasar','0000-00-00','2020-07-30 23:17:21','2020-07-30 23:17:21'),(17,'KL11.000002','Kadek Eka','Agus Gita','084654321654','default@email.com','Jl. Kebayoran Jakarta','0000-00-00','2020-07-30 23:17:21','2020-07-30 23:17:21'),(18,'KL11.000003','Kadek Suputra','Wayan Suyasa','03214567987','default@email.com','Jl. Ahmad Yani','0000-00-00','2020-07-30 23:17:22','2020-07-30 23:17:22'),(19,'KL11.000004','Putu Laksmana','Made Krida','098654132467','default@email.com','Jl. Kuta Utara Bali','0000-00-00','2020-07-30 23:17:22','2020-07-30 23:17:22'),(20,'KL11.000005','Kadek Eka S','Agus Gita','084654321654','default@email.com','Jl. Kebayoran Jakarta','2020-07-30','2020-07-31 06:14:29','2020-07-31 06:14:29'),(21,'KL11.000006','Jessie Joy','yassica','82132888977','default@email.com','apartemen greenbay tower borneo unit 9bc\njl pluit karang ayu\njakarta utara \n14450\nkec penjaringan','2012-05-04','2020-08-04 17:57:58','2020-08-04 17:57:58'),(22,'KL11.000007','bennett','Imelda','82225554546','default@email.com','Pakubuwono Signature 22D, Jl. Pakubuwono VI No. 72, Kebayoran Baru, Jakarta Selatan 12120','2012-05-04','2020-08-04 17:57:59','2020-08-04 17:57:59'),(23,'KL11.000008','Emily Joanna Harsa','Vina Cahyadi','818917090','default@email.com','Gading Viera 1 No 10E, Jl Pori Raya\nPisangan Timur, Pulo Gadung\nJakarta 13230','2012-12-26','2020-08-04 18:27:29','2020-08-04 18:27:29'),(24,'KL11.000009','delicia','deasy','81573007587','default@email.com','Bengkel Otosolusi Jalan Gerilya Timur 1111 Purwokerto RT 03 RW 10 Kelurahan Purwokerto Kidul Kecamatan Purwokerto Selatan Banyumas','2015-02-17','2020-08-04 18:27:29','2020-08-04 18:27:29'),(25,'KL11.000010','Kina','Restu\n','8159503910','default@email.com','Jl H Goden 2 no 11\nPondok Pinang Jaksel 12310','2013-12-01','2020-08-04 18:27:29','2020-08-04 18:27:29'),(26,'KL11.000011','xxx','xxxx','2222229545','default@email.com','xxx','2013-12-01','2020-08-04 18:27:30','2020-08-04 18:27:30'),(27,'KL11.000012','Zhavira salwa firdaus','Ratna malikah','81383895566','default@email.com','Ratna /Toko Dhadossahe kimia , jl alternatif cibubur - cileungsi no 8 cileungsi bogor .dari cibubur sesudah polsek cileungsi .','2015-07-07','2020-08-04 18:27:30','2020-08-04 18:27:30'),(28,'KL11.000013','Miley Carissa Bastianto','Widya Dewi Pangestu','81905030016','default@email.com','Jl. WR Supratman gang 12 no 3, panjang wetan, pekalongan Utara 51141','2011-10-26','2020-08-04 18:27:30','2020-08-04 18:27:30'),(29,'KL11.000014','Reynand Debakey AlRasyid','Hevina Septika','82123157625','default@email.com','timo residence (no 9H pager hitam) duren tiga, pancoran jakarta selatan','2015-10-04','2020-08-04 18:27:30','2020-08-04 18:27:30'),(30,'KL11.000015','Jillian Gwen Witanto','Felix Witanto','82123284580','default@email.com','Jl. Pulau Bira IX Blok C16 No 19 Taman Permata Buana, Jakarta Barat 11610','2013-05-07','2020-08-04 18:27:30','2020-08-04 18:27:30'),(31,'KL11.000016','Jocelyn','Kumala Sari','8111000084','default@email.com','Green Lake City, Rukan Columbus A20. jakbar 11750','2014-07-14','2020-08-04 18:27:30','2020-08-04 18:27:30'),(32,'KL11.000017','Nicoline','Stella','8118602085','default@email.com','Jl lele 1 no 8 kel jati kec pulogadung jakarta','2014-06-02','2020-08-04 18:27:30','2020-08-04 18:27:30'),(33,'KL11.000018','edward','rebecca','8123024388','default@email.com','dian istana park avenue c-22','2016-03-05','2020-08-04 18:27:30','2020-08-04 18:27:30'),(34,'KL11.000019','Celli','Ayu','82283907780','default@email.com','Jl. Nipah no. 39 C. Padang - Sumbar 25118','2016-01-28','2020-08-04 18:27:31','2020-08-04 18:27:31'),(35,'KL11.000020','Verla Atiqa Aditian','Dian Asri Pratiwi','81295304053','default@email.com','Taman bona indah blok B5/40 lebak bulus jakarta selatan 12440','2014-09-15','2020-08-04 18:27:31','2020-08-04 18:27:31'),(36,'KL11.000021','Kimi','Famelya','87888843832','default@email.com','Apartemen taman rasuna tower 8 lantai 15 unit 8.15D kec setiabudi kel menteng atas. Jakarta selatan. 12940','2014-12-05','2020-08-04 18:27:31','2020-08-04 18:27:31');

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
) ENGINE=InnoDB AUTO_INCREMENT=619 DEFAULT CHARSET=utf8mb4;

/*Data for the table `payment` */

insert  into `payment`(`id`,`pay_status`,`register_id`,`create_at`,`update_at`) values (578,1,579,'2020-08-24 06:01:40','2020-08-24 06:03:47'),(608,1,609,'2020-08-24 06:39:24','2020-08-24 06:43:54'),(609,0,610,'2020-08-24 06:39:24','2020-08-24 06:39:24'),(610,0,611,'2020-08-24 06:47:08','2020-08-24 06:47:08'),(611,1,612,'2020-08-24 06:47:20','2020-08-24 06:47:31'),(617,1,618,'2020-10-27 06:48:53','2020-10-27 06:56:49'),(618,0,619,'2020-10-27 06:57:02','2020-10-27 06:57:02');

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
) ENGINE=InnoDB AUTO_INCREMENT=620 DEFAULT CHARSET=utf8mb4;

/*Data for the table `register` */

insert  into `register`(`id`,`reg_code`,`child_name`,`parent_name`,`phone`,`email`,`address`,`birth_date`,`period`,`class_type_id`,`classroom_id`,`note`,`create_at`,`update_at`) values (579,'KL21.00000002','delicia','deasy','81573007587','default@email.com','Bengkel Otosolusi Jalan Gerilya Timur 1111 Purwokerto RT 03 RW 10 Kelurahan Purwokerto Kidul Kecamatan Purwokerto Selatan Banyumas','2015-02-17','2020-08-01',2,6,'','2020-08-24 06:01:40','2020-08-24 06:01:40'),(609,'KL21.00000003','Jessie Joy','yassica','82132888977','default@email.com','apartemen greenbay tower borneo unit 9bc\njl pluit karang ayu\njakarta utara \n14450\nkec penjaringan','2012-05-04','2020-08-01',1,8,'','2020-08-24 06:39:24','2020-08-24 06:39:24'),(610,'KL21.00000004','bennett','Imelda','82225554546','default@email.com','Pakubuwono Signature 22D, Jl. Pakubuwono VI No. 72, Kebayoran Baru, Jakarta Selatan 12120','2012-05-04','2020-08-01',2,6,'','2020-08-24 06:39:24','2020-08-24 06:39:24'),(611,'KL21.00000005','delicia','deasy','81573007587','default@email.com','Bengkel Otosolusi Jalan Gerilya Timur 1111 Purwokerto RT 03 RW 10 Kelurahan Purwokerto Kidul Kecamatan Purwokerto Selatan Banyumas','2015-02-17','2020-08-01',2,6,'','2020-08-24 06:47:08','2020-08-24 06:47:08'),(612,'KL21.00000006','delicia','deasy','81573007587','default@email.com','Bengkel Otosolusi Jalan Gerilya Timur 1111 Purwokerto RT 03 RW 10 Kelurahan Purwokerto Kidul Kecamatan Purwokerto Selatan Banyumas','2015-02-17','2020-09-01',2,6,'','2020-08-24 06:47:20','2020-08-24 06:47:20'),(618,'KL21.00000007','Emily Joanna Harsa','Vina Cahyadi','818917090','default@email.com','Gading Viera 1 No 10E, Jl Pori Raya\r\nPisangan Timur, Pulo Gadung\r\nJakarta 13230','2012-12-26','2020-10-01',2,5,'','2020-10-27 06:48:53','2020-10-27 06:49:14'),(619,'KL21.00000008','Emily Joanna Harsa','Vina Cahyadi','818917090','default@email.com','Gading Viera 1 No 10E, Jl Pori Raya\r\nPisangan Timur, Pulo Gadung\r\nJakarta 13230','2012-12-26','2020-11-01',2,5,'','2020-10-27 06:57:02','2020-10-27 06:57:02');

/*Table structure for table `register_detail` */

DROP TABLE IF EXISTS `register_detail`;

CREATE TABLE `register_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `register_id` int(11) NOT NULL,
  `num_box` int(11) DEFAULT 0,
  `box_name` varchar(50) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `register_id` (`register_id`),
  CONSTRAINT `register_detail_ibfk_1` FOREIGN KEY (`register_id`) REFERENCES `register` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `register_detail` */

insert  into `register_detail`(`id`,`register_id`,`num_box`,`box_name`,`create_at`,`update_at`) values (12,618,2,'ALPHA','2020-10-27 06:48:53','2020-10-27 06:48:53'),(13,618,2,'BETA','2020-10-27 06:48:53','2020-10-27 06:48:53'),(14,619,2,'ALPHA','2020-10-27 06:57:02','2020-10-27 06:57:02'),(15,619,2,'BETA','2020-10-27 06:57:02','2020-10-27 06:57:02');

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
) ENGINE=InnoDB AUTO_INCREMENT=612 DEFAULT CHARSET=utf8mb4;

/*Data for the table `shipment` */

insert  into `shipment`(`id`,`pay_status`,`ship_status`,`register_id`,`create_at`,`update_at`) values (571,1,0,579,'2020-08-24 06:01:40','2020-08-24 06:03:47'),(601,1,0,609,'2020-08-24 06:39:24','2020-08-24 06:43:54'),(602,0,0,610,'2020-08-24 06:39:24','2020-08-24 06:39:24'),(603,0,0,611,'2020-08-24 06:47:08','2020-08-24 06:47:08'),(604,1,0,612,'2020-08-24 06:47:20','2020-08-24 06:47:31'),(610,1,0,618,'2020-10-27 06:48:53','2020-10-27 06:56:49'),(611,0,0,619,'2020-10-27 06:57:02','2020-10-27 06:57:02');

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
