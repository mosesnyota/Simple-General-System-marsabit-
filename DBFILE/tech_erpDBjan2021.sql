/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.7.21-log : Database - tech_epr
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tech_epr` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `tech_epr`;

/*Table structure for table `activities` */

CREATE TABLE `activities` (
  `activity_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activityname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `deadline_date` date NOT NULL,
  `completion_date` date DEFAULT NULL,
  `cur_status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ongoing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `activities` */

insert  into `activities`(`activity_id`,`activityname`,`project_id`,`start_date`,`deadline_date`,`completion_date`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (9,'Completion of the Foundation',11,'2020-09-23','2020-10-10','2020-08-17','Completed','2020-09-23 15:55:47','2020-09-29 08:22:39',NULL);
insert  into `activities`(`activity_id`,`activityname`,`project_id`,`start_date`,`deadline_date`,`completion_date`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (10,'Start of the project',11,'2020-01-01','2020-02-29',NULL,'ongoing','2020-09-23 15:56:36','2020-09-23 15:56:36',NULL);
insert  into `activities`(`activity_id`,`activityname`,`project_id`,`start_date`,`deadline_date`,`completion_date`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (11,'Completion of roofing',11,'2020-05-01','2020-06-30',NULL,'ongoing','2020-09-23 15:57:04','2020-09-29 08:29:34','2020-09-29 08:29:34');

/*Table structure for table `asset_categories` */

CREATE TABLE `asset_categories` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `asset_category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `asset_categories` */

insert  into `asset_categories`(`category_id`,`asset_category`,`created_at`,`updated_at`,`deleted_at`) values (1,'Wooden Students Seats','2020-12-11 07:50:41','2020-12-11 07:50:44',NULL);
insert  into `asset_categories`(`category_id`,`asset_category`,`created_at`,`updated_at`,`deleted_at`) values (2,'Wooden School Tables','2020-12-11 07:50:59','2020-12-11 07:51:01',NULL);
insert  into `asset_categories`(`category_id`,`asset_category`,`created_at`,`updated_at`,`deleted_at`) values (3,'Metallic Seats','2020-12-11 09:35:39','2020-12-11 09:52:20','2020-12-11 09:52:20');
insert  into `asset_categories`(`category_id`,`asset_category`,`created_at`,`updated_at`,`deleted_at`) values (4,'Metallic D','2020-12-11 09:52:32','2020-12-11 09:52:32',NULL);
insert  into `asset_categories`(`category_id`,`asset_category`,`created_at`,`updated_at`,`deleted_at`) values (5,'Makita Drills','2020-12-23 08:36:43','2020-12-23 08:36:43',NULL);
insert  into `asset_categories`(`category_id`,`asset_category`,`created_at`,`updated_at`,`deleted_at`) values (6,'Wood Hammer','2020-12-23 09:14:12','2020-12-23 09:14:12',NULL);

/*Table structure for table `asset_copy` */

CREATE TABLE `asset_copy` (
  `asset_copy_id` int(10) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) DEFAULT NULL,
  `manufacture_date` date DEFAULT NULL,
  `location_id` int(10) DEFAULT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`asset_copy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `asset_copy` */

insert  into `asset_copy`(`asset_copy_id`,`asset_id`,`manufacture_date`,`location_id`,`serial_no`,`created_at`,`updated_at`,`deleted_at`) values (1,2,'2020-12-23',1,'PYKDSYZ','2020-12-22 22:24:12','2020-12-22 22:24:12',NULL);
insert  into `asset_copy`(`asset_copy_id`,`asset_id`,`manufacture_date`,`location_id`,`serial_no`,`created_at`,`updated_at`,`deleted_at`) values (2,2,'2020-12-01',3,'PKD','2020-12-22 22:37:45','2020-12-22 22:37:45',NULL);
insert  into `asset_copy`(`asset_copy_id`,`asset_id`,`manufacture_date`,`location_id`,`serial_no`,`created_at`,`updated_at`,`deleted_at`) values (3,1,'2020-12-23',3,'SR002','2020-12-23 09:02:42',NULL,NULL);
insert  into `asset_copy`(`asset_copy_id`,`asset_id`,`manufacture_date`,`location_id`,`serial_no`,`created_at`,`updated_at`,`deleted_at`) values (4,1,'2020-12-23',1,'CHK004','2020-12-23 06:16:56','2020-12-23 06:16:56',NULL);
insert  into `asset_copy`(`asset_copy_id`,`asset_id`,`manufacture_date`,`location_id`,`serial_no`,`created_at`,`updated_at`,`deleted_at`) values (5,1,'2020-12-23',3,'CH045','2020-12-23 06:17:25','2020-12-23 06:17:25',NULL);
insert  into `asset_copy`(`asset_copy_id`,`asset_id`,`manufacture_date`,`location_id`,`serial_no`,`created_at`,`updated_at`,`deleted_at`) values (6,5,'2020-12-23',1,'DB/MKTDRILL/01','2020-12-23 08:39:20','2020-12-23 08:39:20',NULL);
insert  into `asset_copy`(`asset_copy_id`,`asset_id`,`manufacture_date`,`location_id`,`serial_no`,`created_at`,`updated_at`,`deleted_at`) values (7,6,'2020-12-23',1,'HM01','2020-12-23 09:16:37','2020-12-23 09:16:37',NULL);
insert  into `asset_copy`(`asset_copy_id`,`asset_id`,`manufacture_date`,`location_id`,`serial_no`,`created_at`,`updated_at`,`deleted_at`) values (8,6,'2020-12-15',3,'HM02','2020-12-23 09:16:58','2020-12-23 09:16:58',NULL);

/*Table structure for table `catalogue` */

CREATE TABLE `catalogue` (
  `asset_id` int(10) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(20) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `asset_name` varchar(70) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`asset_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `catalogue` */

insert  into `catalogue`(`asset_id`,`barcode`,`category_id`,`asset_name`,`price`,`created_at`,`updated_at`,`deleted_at`) values (1,'112324534',1,'Chair',3000,'2020-12-11 07:53:36','2020-12-11 06:30:12',NULL);
insert  into `catalogue`(`asset_id`,`barcode`,`category_id`,`asset_name`,`price`,`created_at`,`updated_at`,`deleted_at`) values (2,'342323',2,'Office Table',5000,'2020-12-11 05:40:46','2020-12-11 06:29:14',NULL);
insert  into `catalogue`(`asset_id`,`barcode`,`category_id`,`asset_name`,`price`,`created_at`,`updated_at`,`deleted_at`) values (3,NULL,NULL,'sdsd',NULL,'2020-12-22 21:24:53','2020-12-22 21:24:59','2020-12-22 21:24:59');
insert  into `catalogue`(`asset_id`,`barcode`,`category_id`,`asset_name`,`price`,`created_at`,`updated_at`,`deleted_at`) values (4,NULL,1,'sds',3434,'2020-12-22 21:26:34','2020-12-22 21:27:53','2020-12-22 21:27:53');
insert  into `catalogue`(`asset_id`,`barcode`,`category_id`,`asset_name`,`price`,`created_at`,`updated_at`,`deleted_at`) values (5,'MKT0001',5,'Makita Drill',5000,'2020-12-23 08:37:55','2020-12-23 08:37:55',NULL);
insert  into `catalogue`(`asset_id`,`barcode`,`category_id`,`asset_name`,`price`,`created_at`,`updated_at`,`deleted_at`) values (6,'-',6,'Hammer for Wood',250,'2020-12-23 09:15:12','2020-12-23 09:15:12',NULL);

/*Table structure for table `courses` */

CREATE TABLE `courses` (
  `course_id` int(10) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) DEFAULT NULL,
  `duration` varchar(40) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `courses` */

insert  into `courses`(`course_id`,`course_name`,`duration`,`description`,`created_at`,`updated_at`,`deleted_at`) values (1,'Electrical','1 year','Course','2020-12-17 00:21:30','2020-12-17 00:21:32',NULL);
insert  into `courses`(`course_id`,`course_name`,`duration`,`description`,`created_at`,`updated_at`,`deleted_at`) values (2,'Carpentry','2','Carpentry','2020-12-18 15:22:11','2020-12-17 02:44:27',NULL);
insert  into `courses`(`course_id`,`course_name`,`duration`,`description`,`created_at`,`updated_at`,`deleted_at`) values (3,'Manufacturing',NULL,NULL,'2020-12-17 09:28:19','2020-12-17 09:34:56',NULL);

/*Table structure for table `customers` */

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_names` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `customers` */

insert  into `customers`(`customer_id`,`customer_names`,`address`,`phone`,`email`,`created_at`,`updated_at`,`deleted_at`) values (1,'Kenya School of Law','145 Karen','0722','KSL@GMAIL.COM','2020-12-12 13:48:29','2020-12-12 13:55:09',NULL);
insert  into `customers`(`customer_id`,`customer_names`,`address`,`phone`,`email`,`created_at`,`updated_at`,`deleted_at`) values (2,'ProperNet Solutions LTD','152 Nairobi','0727909290','mosesnyota@gmail.com','2020-12-12 13:46:05','2020-12-12 13:46:05',NULL);
insert  into `customers`(`customer_id`,`customer_names`,`address`,`phone`,`email`,`created_at`,`updated_at`,`deleted_at`) values (3,'ProperNet Solutions LTD','152 Nairobi','0727909290','mosesnyota@gmail.com','2021-01-17 09:08:57','2021-01-17 09:08:57',NULL);
insert  into `customers`(`customer_id`,`customer_names`,`address`,`phone`,`email`,`created_at`,`updated_at`,`deleted_at`) values (4,'ProperNet Solutions LTD3','152 Nairobi','0727909290','mosesnyota@gmail.com','2021-01-17 09:09:20','2021-01-17 09:09:20',NULL);

/*Table structure for table `disbursment_news` */

CREATE TABLE `disbursment_news` (
  `disbursment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `votehead_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `voucherno` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voucherdate` date DEFAULT NULL,
  `chequeno` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_to` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit` double DEFAULT '0',
  `credit` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`disbursment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=320 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `disbursment_news` */

insert  into `disbursment_news`(`disbursment_id`,`votehead_id`,`project_id`,`voucherno`,`voucherdate`,`chequeno`,`narration`,`paid_to`,`debit`,`credit`,`created_at`,`updated_at`,`deleted_at`) values (318,17,11,'TTY01','2020-09-22',NULL,'Tithe Payment','Moses Nyota2',345,0,'2020-10-13 22:39:11','2020-10-13 22:40:02',NULL);
insert  into `disbursment_news`(`disbursment_id`,`votehead_id`,`project_id`,`voucherno`,`voucherdate`,`chequeno`,`narration`,`paid_to`,`debit`,`credit`,`created_at`,`updated_at`,`deleted_at`) values (319,17,11,NULL,'2020-09-22',NULL,'Payment for Tutoring community','Moses Maina',1000,0,'2020-10-13 22:41:22','2020-10-26 09:10:19',NULL);

/*Table structure for table `expense_categories` */

CREATE TABLE `expense_categories` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `expense_categories` */

insert  into `expense_categories`(`category_id`,`categoryname`,`deleted_at`,`created_at`,`updated_at`) values (1,'Electricity Bill',NULL,NULL,NULL);
insert  into `expense_categories`(`category_id`,`categoryname`,`deleted_at`,`created_at`,`updated_at`) values (2,'Water Bill',NULL,NULL,NULL);
insert  into `expense_categories`(`category_id`,`categoryname`,`deleted_at`,`created_at`,`updated_at`) values (3,'Employee Wages',NULL,NULL,NULL);

/*Table structure for table `expenses` */

CREATE TABLE `expenses` (
  `expense_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expense_date` date NOT NULL,
  `expense_amount` double NOT NULL,
  `narration` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dbamcode` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trasnref` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paidto` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `expenses` */

insert  into `expenses`(`expense_id`,`expense_date`,`expense_amount`,`narration`,`dbamcode`,`trasnref`,`paidto`,`category_id`,`created_at`,`updated_at`,`deleted_at`) values (9,'2021-01-05',3000,'Expanses on water',NULL,NULL,'2',2,'2021-01-05 12:56:12','2021-01-05 12:56:12',NULL);
insert  into `expenses`(`expense_id`,`expense_date`,`expense_amount`,`narration`,`dbamcode`,`trasnref`,`paidto`,`category_id`,`created_at`,`updated_at`,`deleted_at`) values (8,'2018-01-05',2000,'Electric Bill',NULL,'CHKCS','2',1,'2021-01-05 09:38:07','2021-01-05 09:38:07',NULL);

/*Table structure for table `failed_jobs` */

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `fee_payments` */

CREATE TABLE `fee_payments` (
  `payment_id` int(10) NOT NULL AUTO_INCREMENT,
  `payment_date` date DEFAULT NULL,
  `student_id` int(10) DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `reference` varchar(20) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `fee_payments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `fee_payments` */

insert  into `fee_payments`(`payment_id`,`payment_date`,`student_id`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (1,'2021-12-18',1,1200.00,'Ukdd','Bank Deposit','2020-12-18 04:22:54','2021-01-16 18:00:01',NULL);
insert  into `fee_payments`(`payment_id`,`payment_date`,`student_id`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (2,'2020-12-20',1,500.00,'Cash','Cash','2020-12-20 09:36:05','2020-12-20 09:36:05',NULL);
insert  into `fee_payments`(`payment_id`,`payment_date`,`student_id`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (3,'2020-12-20',3,500.00,'-','Cash','2020-12-20 09:36:26','2020-12-20 09:36:26',NULL);
insert  into `fee_payments`(`payment_id`,`payment_date`,`student_id`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (4,'2020-12-20',1,500.00,'MPDSEDSDDS','Mpesa','2020-12-20 13:10:27','2020-12-20 13:10:27',NULL);
insert  into `fee_payments`(`payment_id`,`payment_date`,`student_id`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (5,'2020-12-20',1,500.00,'MPDSEDSDDS','Mpesa','2020-12-20 13:48:15','2020-12-20 13:48:15',NULL);
insert  into `fee_payments`(`payment_id`,`payment_date`,`student_id`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (6,'2020-12-21',3,1200.00,'MPESA','Mpesa','2020-12-20 13:52:06','2020-12-21 07:01:43',NULL);

/*Table structure for table `fees_invoice` */

CREATE TABLE `fees_invoice` (
  `fee_invoice_id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(10) DEFAULT NULL,
  `votehead_id` int(10) DEFAULT NULL,
  `term` varchar(10) DEFAULT NULL,
  `course_id` int(10) DEFAULT NULL,
  `inv_year` int(10) DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`fee_invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `fees_invoice` */

insert  into `fees_invoice`(`fee_invoice_id`,`student_id`,`votehead_id`,`term`,`course_id`,`inv_year`,`amount`,`created_at`,`updated_at`,`deleted_at`) values (1,1,1,'Term 2',1,2020,3000.00,'2020-12-18 00:32:26','2020-12-18 00:32:26',NULL);
insert  into `fees_invoice`(`fee_invoice_id`,`student_id`,`votehead_id`,`term`,`course_id`,`inv_year`,`amount`,`created_at`,`updated_at`,`deleted_at`) values (2,1,3,'Term 2',1,2020,2000.00,'2020-12-18 00:32:26','2020-12-18 00:32:26',NULL);
insert  into `fees_invoice`(`fee_invoice_id`,`student_id`,`votehead_id`,`term`,`course_id`,`inv_year`,`amount`,`created_at`,`updated_at`,`deleted_at`) values (3,1,1,'Term 3',1,2020,1000.00,'2020-12-18 12:19:59','2020-12-18 12:19:59',NULL);
insert  into `fees_invoice`(`fee_invoice_id`,`student_id`,`votehead_id`,`term`,`course_id`,`inv_year`,`amount`,`created_at`,`updated_at`,`deleted_at`) values (4,3,1,'Term 2',2,2020,1000.00,'2020-12-18 12:20:17','2020-12-18 12:20:17',NULL);
insert  into `fees_invoice`(`fee_invoice_id`,`student_id`,`votehead_id`,`term`,`course_id`,`inv_year`,`amount`,`created_at`,`updated_at`,`deleted_at`) values (5,3,1,'Term 2',2,2020,1000.00,'2020-12-18 12:21:11','2020-12-18 12:21:11',NULL);
insert  into `fees_invoice`(`fee_invoice_id`,`student_id`,`votehead_id`,`term`,`course_id`,`inv_year`,`amount`,`created_at`,`updated_at`,`deleted_at`) values (6,3,3,'Term 2',2,2020,2000.00,'2020-12-18 12:21:11','2020-12-18 12:21:11',NULL);

/*Table structure for table `fees_voteheads` */

CREATE TABLE `fees_voteheads` (
  `votehead_id` int(10) NOT NULL AUTO_INCREMENT,
  `votehead` varchar(100) NOT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`votehead_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `fees_voteheads` */

insert  into `fees_voteheads`(`votehead_id`,`votehead`,`amount`,`created_at`,`updated_at`,`deleted_at`) values (1,'Practical Charges',3001,'2020-12-17 21:00:17','2020-12-17 22:07:58',NULL);
insert  into `fees_voteheads`(`votehead_id`,`votehead`,`amount`,`created_at`,`updated_at`,`deleted_at`) values (3,'Engineering Works',5666,'2020-12-18 02:17:12',NULL,NULL);

/*Table structure for table `fundings` */

CREATE TABLE `fundings` (
  `funding_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sponsor_id` int(11) NOT NULL,
  `funding_date` date NOT NULL,
  `currency` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_amount` double NOT NULL,
  `exchangerate` double NOT NULL DEFAULT '1',
  `final_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`funding_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `fundings` */

insert  into `fundings`(`funding_id`,`sponsor_id`,`funding_date`,`currency`,`original_amount`,`exchangerate`,`final_amount`,`created_at`,`updated_at`,`deleted_at`) values (1,2,'2020-09-22','USD',1000,102,102000,'2020-09-20 11:03:26','2020-09-21 07:20:44',NULL);
insert  into `fundings`(`funding_id`,`sponsor_id`,`funding_date`,`currency`,`original_amount`,`exchangerate`,`final_amount`,`created_at`,`updated_at`,`deleted_at`) values (2,2,'2020-09-22','USD',100,102,10200,'2020-09-21 06:17:45','2020-09-21 07:23:02','2020-09-21 07:23:02');
insert  into `fundings`(`funding_id`,`sponsor_id`,`funding_date`,`currency`,`original_amount`,`exchangerate`,`final_amount`,`created_at`,`updated_at`,`deleted_at`) values (3,2,'2020-09-29','USD',1000,102,102000,'2020-09-29 08:53:25','2020-09-29 08:53:25',NULL);

/*Table structure for table `invoice_details` */

CREATE TABLE `invoice_details` (
  `detail_id` int(10) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `unit_cost` double(10,2) DEFAULT NULL,
  `quantity` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `invoice_details` */

insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (11,20,'Table',455.00,34.00,'2020-12-28 10:47:09','2020-12-28 10:47:09',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (12,20,'School Desk',4000.00,10.00,'2020-12-28 10:47:09','2020-12-28 10:47:09',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (13,20,'School Stool',1000.00,5.00,'2020-12-28 10:51:19','2020-12-28 10:51:19',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (14,20,'Desk and Chair',3000.00,3.00,'2020-12-28 10:51:19','2020-12-28 10:51:19',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (15,21,'CNC Lathe machine',300.00,5.00,'2020-12-29 00:08:55','2020-12-29 00:08:55',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (16,21,'Mechanical Lift',400.00,4.00,'2020-12-29 00:08:55','2020-12-29 00:08:55',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (17,22,'Oil Filter',200.00,1.00,'2020-12-30 11:53:55','2020-12-30 11:53:55',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (18,22,'Repair Service',2000.00,1.00,'2020-12-30 11:53:55','2020-12-30 11:53:55',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (19,22,'Diagnosis',2000.00,1.00,'2020-12-30 11:53:55','2020-12-30 11:53:55',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (20,22,'Welding of part',1500.00,1.00,'2020-12-30 11:53:55','2020-12-30 11:53:55',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (21,29,'Church Seats',5000.00,4.00,'2021-01-22 08:09:15','2021-01-22 08:09:15',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (22,30,'Table',455.00,3.00,'2021-01-22 09:02:13','2021-01-22 09:02:13',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (23,31,'Post',33.00,2.00,'2021-01-22 09:02:57','2021-01-22 09:02:57',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`description`,`unit_cost`,`quantity`,`created_at`,`updated_at`,`deleted_at`) values (24,31,'Seat1',4000.00,4.00,'2021-01-22 10:08:13','2021-01-22 10:08:13',NULL);

/*Table structure for table `invoice_payment` */

CREATE TABLE `invoice_payment` (
  `payment_id` int(10) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `reference` varchar(30) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `invoice_payment` */

insert  into `invoice_payment`(`payment_id`,`invoice_id`,`payment_date`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (1,20,'2020-12-29',69470.00,'-','Mpesa Paybill','2020-12-29 10:41:10','2020-12-29 10:41:10',NULL);
insert  into `invoice_payment`(`payment_id`,`invoice_id`,`payment_date`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (2,21,'2020-12-29',1000.00,'-','Cash','2020-12-29 11:06:33','2020-12-29 11:06:33',NULL);
insert  into `invoice_payment`(`payment_id`,`invoice_id`,`payment_date`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (3,21,'2020-12-29',1000.00,'-','Cash','2020-12-29 11:32:57','2020-12-29 11:32:57',NULL);
insert  into `invoice_payment`(`payment_id`,`invoice_id`,`payment_date`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (4,21,'2020-12-29',200.00,'-','Cash','2020-12-29 19:50:47','2020-12-29 19:50:47',NULL);
insert  into `invoice_payment`(`payment_id`,`invoice_id`,`payment_date`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (5,21,'2020-12-29',900.00,'-','Cash','2020-12-29 23:03:34','2020-12-29 23:03:34',NULL);
insert  into `invoice_payment`(`payment_id`,`invoice_id`,`payment_date`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (7,22,'2020-12-30',1700.00,'OLO4WVAVL4','Bank Deposit','2020-12-30 12:00:22','2020-12-30 12:00:22',NULL);
insert  into `invoice_payment`(`payment_id`,`invoice_id`,`payment_date`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (8,22,'2021-01-22',4000.00,'-','Cash','2021-01-22 08:34:56','2021-01-22 08:34:56',NULL);

/*Table structure for table `invoice_payments` */

CREATE TABLE `invoice_payments` (
  `payment_id` int(10) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `narration` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `invoice_payments` */

insert  into `invoice_payments`(`payment_id`,`invoice_id`,`payment_date`,`amount`,`payment_method`,`narration`,`created_at`,`updated_at`,`deleted_at`) values (1,1,'2020-12-22',3000.00,'Mpesa','Partial Payment ','2020-12-22 21:11:06','2020-12-22 21:11:09',NULL);
insert  into `invoice_payments`(`payment_id`,`invoice_id`,`payment_date`,`amount`,`payment_method`,`narration`,`created_at`,`updated_at`,`deleted_at`) values (2,2,'2021-01-01',2000.00,'Mpesa',NULL,'2020-12-22 21:35:43',NULL,NULL);

/*Table structure for table `invoices` */

CREATE TABLE `invoices` (
  `invoice_id` int(10) NOT NULL AUTO_INCREMENT,
  `invoice_date` date DEFAULT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `narration` varchar(240) DEFAULT NULL,
  `cur_status` varchar(30) DEFAULT 'Unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `invoices` */

insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (20,'2020-12-29',2,'2021-01-05','Manufacture of items related to the job','Paid','2020-12-28 10:50:32','2020-12-28 10:50:32',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (21,'2020-12-29',1,'2021-01-06','Renovation & upgrading of Electrical and refrigeration departments in Boys\' Town','Paid','2020-12-29 00:07:59','2020-12-29 23:04:09',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (22,'2020-12-30',1,'2021-01-27','Car repair','Paid','2020-12-30 11:52:00','2021-01-22 08:34:56',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (23,'2020-12-30',1,'2020-12-30','Purchase of materials 1','Unpaid','2020-12-30 12:08:02','2020-12-30 12:08:02',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (24,'2020-12-30',1,'2020-12-30','Purchase of materials 2','Unpaid','2020-12-30 14:28:49','2020-12-30 14:28:49',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (25,'2020-12-30',1,'2020-12-30','Purchase of materials 3','Unpaid','2020-12-30 14:31:16','2020-12-30 14:31:16',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (26,'2020-12-23',1,'2020-12-30','Purchase of materials 4','Unpaid','2020-12-30 15:44:13','2020-12-30 15:44:13',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (27,'2021-01-03',1,'2021-01-03','Purchase of materials 5','Unpaid','2021-01-03 20:48:13','2021-01-03 20:48:13',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (28,'2021-01-21',1,'2021-01-28','Renovation Works in Utume','Unpaid','2021-01-21 10:09:02','2021-01-21 10:09:02',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (29,'2021-01-22',1,'2021-01-28','Placement of works on Job','Unpaid','2021-01-22 08:07:11','2021-01-22 08:07:11',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (30,'2021-01-15',3,'2021-01-29','Manufacture of items related to the job','Unpaid','2021-01-22 08:35:41','2021-01-22 08:35:41',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (31,'2021-01-22',1,'2021-01-29','Purchase of materials','Unpaid','2021-01-22 09:02:46','2021-01-22 09:02:46',NULL);

/*Table structure for table `issue_reasons` */

CREATE TABLE `issue_reasons` (
  `reason_id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`reason_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `issue_reasons` */

insert  into `issue_reasons`(`reason_id`,`description`,`created_at`,`updated_at`,`deleted_at`) values (1,'For use in Training',NULL,NULL,NULL);
insert  into `issue_reasons`(`reason_id`,`description`,`created_at`,`updated_at`,`deleted_at`) values (2,'Food for Students',NULL,NULL,NULL);
insert  into `issue_reasons`(`reason_id`,`description`,`created_at`,`updated_at`,`deleted_at`) values (3,'Food for Staff',NULL,NULL,NULL);
insert  into `issue_reasons`(`reason_id`,`description`,`created_at`,`updated_at`,`deleted_at`) values (4,'Salesians Use',NULL,NULL,NULL);
insert  into `issue_reasons`(`reason_id`,`description`,`created_at`,`updated_at`,`deleted_at`) values (5,'Production',NULL,NULL,NULL);
insert  into `issue_reasons`(`reason_id`,`description`,`created_at`,`updated_at`,`deleted_at`) values (6,'For Special Events',NULL,NULL,NULL);
insert  into `issue_reasons`(`reason_id`,`description`,`created_at`,`updated_at`,`deleted_at`) values (7,'Donated Out',NULL,NULL,NULL);
insert  into `issue_reasons`(`reason_id`,`description`,`created_at`,`updated_at`,`deleted_at`) values (8,'Breakage/Spoilage',NULL,NULL,NULL);

/*Table structure for table `issued_assets` */

CREATE TABLE `issued_assets` (
  `issued_id` int(10) NOT NULL AUTO_INCREMENT,
  `staffid` int(10) DEFAULT NULL,
  `asset_copy_id` int(10) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `cur_status` varchar(50) DEFAULT 'issued',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`issued_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `issued_assets` */

insert  into `issued_assets`(`issued_id`,`staffid`,`asset_copy_id`,`issue_date`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (1,10,4,'2020-12-23','issued',NULL,NULL,NULL);
insert  into `issued_assets`(`issued_id`,`staffid`,`asset_copy_id`,`issue_date`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (2,10,5,'2020-12-23','issued',NULL,NULL,NULL);
insert  into `issued_assets`(`issued_id`,`staffid`,`asset_copy_id`,`issue_date`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (3,10,1,'2020-12-23','issued',NULL,NULL,NULL);

/*Table structure for table `locations` */

CREATE TABLE `locations` (
  `store_id` int(10) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `isastore` varchar(30) DEFAULT 'NO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `locations` */

insert  into `locations`(`store_id`,`store_name`,`description`,`isastore`,`created_at`,`updated_at`,`deleted_at`) values (1,'Salesian Store 12','Salesian store for foods','NO',NULL,'2020-10-23 17:58:25',NULL);
insert  into `locations`(`store_id`,`store_name`,`description`,`isastore`,`created_at`,`updated_at`,`deleted_at`) values (2,'Fanta',NULL,'NO','2020-10-23 17:26:06','2020-10-23 17:49:37','2020-10-23 17:49:37');
insert  into `locations`(`store_id`,`store_name`,`description`,`isastore`,`created_at`,`updated_at`,`deleted_at`) values (3,'Official School Store','Located in the school','NO','2020-12-09 16:42:49','2020-12-09 16:42:49',NULL);
insert  into `locations`(`store_id`,`store_name`,`description`,`isastore`,`created_at`,`updated_at`,`deleted_at`) values (4,'Container Store',NULL,'NO','2020-12-24 14:16:41','2020-12-24 14:16:41',NULL);

/*Table structure for table `marks` */

CREATE TABLE `marks` (
  `marks_id` int(10) NOT NULL AUTO_INCREMENT,
  `subject_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `course_id` int(10) DEFAULT NULL,
  `staff_id` varchar(100) NOT NULL,
  `term` varchar(40) NOT NULL,
  `exam_type` varchar(40) DEFAULT NULL,
  `examyear` int(10) NOT NULL,
  `marks` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`marks_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `marks` */

insert  into `marks`(`marks_id`,`subject_id`,`student_id`,`course_id`,`staff_id`,`term`,`exam_type`,`examyear`,`marks`,`created_at`,`updated_at`,`deleted_at`) values (6,1,4,3,'Moses Nyota','Term 1 2021','Mid Term',1,99.00,'2021-01-20 14:15:52','2021-01-20 15:31:39',NULL);
insert  into `marks`(`marks_id`,`subject_id`,`student_id`,`course_id`,`staff_id`,`term`,`exam_type`,`examyear`,`marks`,`created_at`,`updated_at`,`deleted_at`) values (7,5,4,3,'Moses Nyota','Term 1 2021','Mid Term',1,99.00,'2021-01-20 15:34:14','2021-01-21 08:03:13',NULL);
insert  into `marks`(`marks_id`,`subject_id`,`student_id`,`course_id`,`staff_id`,`term`,`exam_type`,`examyear`,`marks`,`created_at`,`updated_at`,`deleted_at`) values (8,1,3,3,'Moses Nyota','Term 1 2021','Mid Term',1,99.00,'2021-01-21 00:29:16','2021-01-21 08:03:40',NULL);

/*Table structure for table `migrations` */

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (2,'2014_10_12_100000_create_password_resets_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (3,'2019_08_19_000000_create_failed_jobs_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (4,'2020_06_22_001933_create_staff_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (5,'2020_06_22_185509_create_staff_categories_table',2);
insert  into `migrations`(`id`,`migration`,`batch`) values (10,'2020_06_28_002053_create_petty_cashes_table',5);
insert  into `migrations`(`id`,`migration`,`batch`) values (15,'2020_06_28_152607_create_sponsors_table',8);
insert  into `migrations`(`id`,`migration`,`batch`) values (14,'2020_06_28_212750_create_projects_table',7);
insert  into `migrations`(`id`,`migration`,`batch`) values (16,'2020_07_06_091815_create_voteheads_table',9);
insert  into `migrations`(`id`,`migration`,`batch`) values (17,'2020_07_06_115302_create_disbursments_table',10);
insert  into `migrations`(`id`,`migration`,`batch`) values (18,'2020_07_29_165811_create_petties_table',11);
insert  into `migrations`(`id`,`migration`,`batch`) values (21,'2020_08_10_090735_create_activities_table',12);
insert  into `migrations`(`id`,`migration`,`batch`) values (23,'2020_09_06_172700_create_disbursment_news_table',13);
insert  into `migrations`(`id`,`migration`,`batch`) values (25,'2020_09_19_080610_add_deletedat',14);
insert  into `migrations`(`id`,`migration`,`batch`) values (26,'2020_09_19_184341_create_fundings_table',15);
insert  into `migrations`(`id`,`migration`,`batch`) values (27,'2020_09_22_121050_create_expenses_table',16);
insert  into `migrations`(`id`,`migration`,`batch`) values (28,'2020_09_22_134116_create_expense_categories_table',17);
insert  into `migrations`(`id`,`migration`,`batch`) values (29,'2020_09_27_065616_create_suppliers_table',18);
insert  into `migrations`(`id`,`migration`,`batch`) values (30,'2020_09_27_094957_create_bills_table',19);
insert  into `migrations`(`id`,`migration`,`batch`) values (31,'2020_09_29_211539_create_permission_tables',20);

/*Table structure for table `model_has_permissions` */

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values (1,'App\\User',2);
insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values (1,'App\\User',3);
insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values (1,'App\\User',4);
insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values (2,'App\\User',2);
insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values (2,'App\\User',10);
insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values (3,'App\\User',2);
insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values (4,'App\\User',2);
insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values (4,'App\\User',9);

/*Table structure for table `password_resets` */

CREATE TABLE `password_resets` (
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values ('admin@admin.com','$2y$10$20DrUAnAKuszYXCO3JPXaO7SvMfoOEnxvhcWxfRoEPHXeOHG8lHg.','2020-06-24 16:58:49');

/*Table structure for table `permissions` */

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (1,'VIEW_SCHOOL','web','2020-09-30 06:14:02','2020-09-30 06:14:02');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (2,'VIEW_SCHOOL_FEES','web','2020-09-30 11:56:24','2020-09-30 11:55:01');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (3,'CAN_EDIT','web','2020-09-30 21:45:16','2020-09-30 21:45:16');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (4,'VIEW_EXPENSES','web','2020-09-30 21:45:29','2020-09-30 21:45:29');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (5,'VIEW_STAFF','web','2020-09-30 21:45:43','2020-09-30 21:45:43');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (6,'VIEW_SUPPLIERS','web','2020-09-30 21:45:59','2020-09-30 21:45:59');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (7,'VIEW PETTY CASH','web','2020-09-30 21:46:36','2020-09-30 21:46:36');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (8,'CAN_DELETE','web','2020-09-30 21:46:48','2020-09-30 21:46:48');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (9,'VIEW_INVENTORY','web','2020-09-30 21:47:02','2020-09-30 21:47:02');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (10,'IS ADMINISTRATOR','web','2020-09-30 21:47:36','2020-09-30 21:47:36');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (11,'VIEW_PRODUCTION','web','2021-01-23 22:50:48','2021-01-23 22:50:51');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (12,'VIEW_ASSETS','web','2021-01-23 22:51:26',NULL);
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (13,'VIEW CUSTOMERS','web','2021-01-23 23:34:10',NULL);

/*Table structure for table `petties` */

CREATE TABLE `petties` (
  `pettycash_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `balance` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pettycash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `petties` */

insert  into `petties`(`pettycash_id`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (1,32700,'2020-07-29 20:15:32',NULL,NULL);

/*Table structure for table `petty_cashes` */

CREATE TABLE `petty_cashes` (
  `transactionid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_date` date NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issuedto` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactiontype` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `balance` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `cur_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'Complete',
  PRIMARY KEY (`transactionid`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `petty_cashes` */

insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (1,'2021-06-02','Fuel for motorbikew','Non Employee','Withdraw',300,NULL,'2020-07-01 20:56:59','2020-09-21 22:55:42','2020-09-21 22:55:42','Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (2,'2020-07-08','Bank','-','Deposit',7300,NULL,'2020-07-01 21:41:34','2020-09-23 07:12:38',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (3,'2020-07-02','Testing withdraw','Non Employee','Withdraw',300,NULL,'2020-07-04 11:46:00','2020-09-21 22:55:54','2020-09-21 22:55:54','Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (4,'2020-07-07','Fuel for motorbikew','Non Employee','Withdraw',300,39700.00,'2020-07-29 18:35:42','2020-07-29 18:35:42',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (5,'2020-07-29','Bank','Non Employee','Withdraw',700,39000.00,'2020-07-29 18:36:06','2020-07-29 18:36:06',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (6,'2020-07-29','Deposit','-','Deposit',300,39300.00,'2020-07-29 18:41:12','2020-09-21 22:56:10','2020-09-21 22:56:10','Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (7,'2020-07-30','Bank','-','Deposit',1000,40300.00,'2020-07-30 05:27:19','2020-07-30 05:27:19',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (8,'2020-07-30','Fuel for motorbike','Non Employee','Withdraw',300,40000.00,'2020-07-30 05:27:41','2020-07-30 05:27:41',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (9,'2020-07-30','Fuel for motorbikew','-','Deposit',7500,47500.00,'2020-07-30 06:27:20','2020-07-30 06:27:20',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (10,'2020-07-30','Bank','-','Deposit',300,47800.00,'2020-07-30 06:27:31','2020-07-30 06:27:31',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (11,'2020-07-10','Fuel for motorbikew','Non Employee','Withdraw',300,47500.00,'2020-07-30 06:27:41','2020-07-30 06:27:41',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (12,'2021-07-31','Issued as part of the government demonstration to its people that it cares about the ongoing business hubs','Non Employee','Withdraw',8555,38945.00,'2020-07-31 20:10:43','2020-07-31 20:10:43',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (13,'2020-08-08','Cash Addition','-','Deposit',1000,39945.00,'2020-08-07 23:50:50','2020-08-07 23:50:50',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (14,'2020-09-22','Tithe Payment','Moses Nyota2','Withdraw',345,39900.00,'2020-09-22 07:46:53','2020-09-23 07:58:04',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (15,'2020-09-22','Deposit Money','-','Deposit',345,40245.00,'2020-09-22 07:47:50','2020-09-22 07:47:50',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (16,'2018-09-22','Payment for casual Work','Arap Ngoti','Withdraw',245,40000.00,'2020-09-22 07:55:01','2020-09-22 07:55:01',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (17,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,39000.00,'2020-09-22 08:12:06','2020-09-22 08:12:06',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (18,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,38000.00,'2020-09-22 08:12:46','2020-09-22 08:12:46',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (19,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,37000.00,'2020-09-22 08:13:58','2020-09-22 08:13:58',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (20,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,36000.00,'2020-09-22 08:14:52','2020-09-22 08:14:52',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (21,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,35000.00,'2020-09-22 08:15:10','2020-09-22 08:15:10',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (22,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,34000.00,'2020-09-22 08:15:22','2020-09-22 08:15:22',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (23,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,33000.00,'2020-09-22 08:17:08','2020-09-22 08:17:08',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (24,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,32000.00,'2020-09-22 08:26:25','2020-09-22 08:26:25',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (25,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,31000.00,'2020-09-22 08:27:37','2020-09-22 08:27:37',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (26,'2021-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,30000.00,'2020-09-22 08:27:57','2020-09-22 08:27:57',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (27,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,29000.00,'2020-09-22 08:28:06','2020-09-22 08:28:06',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (28,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,28000.00,'2020-09-22 08:28:18','2020-09-22 08:28:18',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (29,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,27000.00,'2020-09-22 08:28:37','2020-09-22 08:28:37',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (30,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,26000.00,'2020-09-22 08:28:50','2020-09-22 08:28:50',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (31,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,25000.00,'2020-09-22 08:29:04','2020-09-22 08:29:04',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (32,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,24000.00,'2020-09-22 08:30:15','2020-09-22 08:30:15',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (33,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,23000.00,'2020-09-22 08:30:36','2020-09-22 08:30:36',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (34,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,22000.00,'2020-09-22 08:30:48','2020-09-22 08:30:48',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (35,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,21000.00,'2020-09-22 08:31:11','2020-09-22 08:31:11',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (36,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,20000.00,'2020-09-22 08:31:22','2020-09-22 08:31:22',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (37,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,19000.00,'2020-09-22 08:31:33','2020-09-22 08:31:33',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (38,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,18000.00,'2020-09-22 08:33:45','2020-09-22 08:33:45',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (39,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,17000.00,'2020-09-22 08:34:33','2020-09-22 08:34:33',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (40,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,16000.00,'2020-09-22 08:35:48','2020-09-22 08:35:48',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (41,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,15000.00,'2020-09-22 08:36:27','2020-09-22 08:36:27',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (42,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,14000.00,'2020-09-22 08:36:37','2020-09-22 08:36:37',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (43,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,13000.00,'2020-09-22 08:40:21','2020-09-22 08:40:21',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (44,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,12000.00,'2020-09-22 08:40:46','2020-09-22 08:40:46',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (45,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,11000.00,'2020-09-22 08:41:06','2020-09-22 08:41:06',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (46,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,10000.00,'2020-09-22 08:41:26','2020-09-22 08:41:26',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (47,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,9000.00,'2020-09-22 08:41:40','2020-09-22 08:41:40',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (48,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,8000.00,'2020-09-22 08:42:15','2020-09-22 08:42:15',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (49,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,7000.00,'2020-09-22 08:42:25','2020-09-22 08:42:25',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (50,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,6000.00,'2020-09-22 08:42:37','2020-09-22 08:42:37',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (51,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,5000.00,'2020-09-22 08:43:39','2020-09-22 08:43:39',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (52,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,4000.00,'2020-09-22 08:44:02','2020-09-22 08:44:02',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (53,'2019-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,3000.00,'2020-09-22 08:44:25','2020-09-22 08:44:25',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (54,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,2000.00,'2020-09-22 08:45:10','2020-09-22 08:45:10',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (55,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,1000.00,'2020-09-22 08:45:36','2020-09-22 08:45:36',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (56,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,0.00,'2020-09-22 08:45:46','2020-09-22 08:45:46',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (57,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-1000.00,'2020-09-22 08:46:16','2020-09-22 08:46:16',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (58,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-2000.00,'2020-09-22 08:47:12','2020-09-22 08:47:12',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (59,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-3000.00,'2020-09-22 08:47:32','2020-09-22 08:47:32',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (60,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-4000.00,'2020-09-22 08:47:44','2020-09-22 08:47:44',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (61,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-5000.00,'2020-09-22 08:47:57','2020-09-22 08:47:57',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (62,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-6000.00,'2020-09-22 08:51:21','2020-09-22 08:51:21',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (63,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-7000.00,'2020-09-22 08:52:29','2020-09-22 08:52:29',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (64,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-8000.00,'2020-09-22 08:53:06','2020-09-22 08:53:06',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (65,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-9000.00,'2020-09-22 08:53:56','2020-09-22 08:53:56',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (66,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-10000.00,'2020-09-22 08:56:16','2020-09-22 08:56:16',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (67,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-11000.00,'2020-09-22 08:56:35','2020-09-22 08:56:35',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (68,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-12000.00,'2020-09-22 08:56:58','2020-09-22 08:56:58',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (69,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-13000.00,'2020-09-22 08:57:44','2020-09-22 08:57:44',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (70,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-14000.00,'2020-09-22 08:58:01','2020-09-22 08:58:01',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (71,'2018-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-15000.00,'2020-09-22 08:58:15','2020-09-22 08:58:15',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (72,'2021-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-16000.00,'2020-09-22 08:58:31','2020-09-22 08:58:31',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (73,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-17000.00,'2020-09-22 08:58:46','2020-09-22 08:58:46',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (74,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-18000.00,'2020-09-22 08:58:57','2020-09-22 08:58:57',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (75,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-19000.00,'2020-09-22 08:59:31','2020-09-22 08:59:31',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (76,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-20000.00,'2020-09-22 08:59:51','2020-09-22 08:59:51',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (77,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-21000.00,'2020-09-22 09:00:29','2020-09-22 09:00:29',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (78,'2020-09-22','The amount was issued to cover damages caused by our goats','Paul Edstrom','Withdraw',2500,-23500.00,'2020-09-22 09:03:06','2020-09-22 09:03:06',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (94,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-63500.00,'2020-09-22 09:11:45','2020-09-22 09:11:45',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (79,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-26000.00,'2020-09-22 09:04:21','2020-09-22 09:04:21',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (80,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-28500.00,'2020-09-22 09:04:40','2020-09-22 09:04:40',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (81,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-31000.00,'2020-09-22 09:05:27','2020-09-22 09:05:27',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (82,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-33500.00,'2020-09-22 09:05:41','2020-09-22 09:05:41',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (83,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-36000.00,'2020-09-22 09:06:03','2020-09-22 09:06:03',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (84,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-38500.00,'2020-09-22 09:06:42','2020-09-22 09:06:42',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (85,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-41000.00,'2020-09-22 09:06:54','2020-09-22 09:06:54',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (86,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-43500.00,'2020-09-22 09:07:15','2020-09-22 09:07:15',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (87,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-46000.00,'2020-09-22 09:07:42','2020-09-22 09:07:42',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (88,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-48500.00,'2020-09-22 09:08:10','2020-09-22 09:08:10',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (89,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-51000.00,'2020-09-22 09:08:51','2020-09-22 09:08:51',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (90,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-53500.00,'2020-09-22 09:09:20','2020-09-22 09:09:20',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (91,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-56000.00,'2020-09-22 09:10:19','2020-09-22 09:10:19',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (92,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-58500.00,'2020-09-22 09:10:43','2020-09-22 09:10:43',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (93,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-61000.00,'2020-09-22 09:10:56','2020-09-22 09:10:56',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (95,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-66000.00,'2020-09-22 09:11:59','2020-09-22 09:11:59',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (96,'2020-09-22','Testing Printing','Lois Gitere','Withdraw',125,-66125.00,'2020-09-22 09:33:12','2020-09-22 09:33:12',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (97,'2020-09-22','Testing Printing','Lois Gitere','Withdraw',125,-66250.00,'2020-09-22 09:34:06','2020-09-22 09:34:06',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (98,'2020-09-22','Testing Printing','Lois Gitere','Withdraw',125,-66375.00,'2020-09-22 09:39:26','2020-09-22 09:39:26',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (99,'2020-09-22','Testing Printing','Lois Gitere','Withdraw',125,-66500.00,'2020-09-22 09:40:07','2020-09-22 09:40:07',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (100,'2020-09-22','Funds Additions','-','Deposit',100000,33500.00,'2020-09-22 09:41:46','2020-09-22 09:41:46',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (101,'2020-12-24','Addition to Petty Cash','-','Deposit',500,34000.00,'2020-12-24 12:08:53','2020-12-24 12:08:53',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (102,'2020-12-17','For transport','Staff 1','Withdraw',500,33500.00,'2020-12-24 12:09:11','2020-12-24 12:09:11',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (103,'2020-12-24','Addition to Petty Cash','-','Deposit',1000,34500.00,'2020-12-24 14:52:49','2020-12-24 14:52:49',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (104,'2020-12-24','Wages for Slashing grass','Jeremy','Withdraw',500,34000.00,'2020-12-24 14:53:36','2020-12-24 14:53:36',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (105,'2020-12-30','Workshop Management','Fr. Oswin','Withdraw',300,34000.00,'2020-12-30 10:31:12','2020-12-30 11:29:13',NULL,'Complete');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`,`cur_status`) values (106,'2020-12-30','Workshop','Fr. Nico','Withdraw',1000,33700.00,'2020-12-30 11:30:13','2020-12-30 11:30:51',NULL,'Complete');

/*Table structure for table `product_category` */

CREATE TABLE `product_category` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `product_category` */

insert  into `product_category`(`category_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values (1,'Food Stuffs',NULL,NULL,NULL);
insert  into `product_category`(`category_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values (2,'New category 2','2020-10-23 19:23:45','2020-10-23 19:25:01','2020-10-23 19:25:01');
insert  into `product_category`(`category_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values (3,'Metalic Seats','2020-12-11 09:30:22','2020-12-11 09:30:22',NULL);
insert  into `product_category`(`category_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values (4,'Metallic Seats','2020-12-11 09:33:46','2020-12-11 09:33:46',NULL);
insert  into `product_category`(`category_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values (5,'Timber','2020-12-24 14:17:28','2020-12-24 14:17:28',NULL);
insert  into `product_category`(`category_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values (6,'Welding Metals','2020-12-24 14:17:56','2020-12-24 14:17:56',NULL);

/*Table structure for table `product_transactions` */

CREATE TABLE `product_transactions` (
  `transaction_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) DEFAULT NULL,
  `trans_type` varchar(50) DEFAULT NULL,
  `transacted_by` varchar(100) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `qnty_before` double DEFAULT NULL,
  `qnty_after` double DEFAULT NULL,
  `issued_to` varchar(70) DEFAULT NULL,
  `narration` varchar(200) DEFAULT NULL,
  `reason_id` int(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `product_transactions` */

insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (5,1,'Received Stock','Moses Nyota',5,35,40,NULL,NULL,0,NULL,'2020-12-09 23:40:21','2020-12-09 23:40:21');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (6,1,'Issued Items','Moses Nyota',5,35,30,'Moses','Cooking tea for students',1,NULL,'2020-12-10 11:45:19','2020-12-10 11:45:19');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (7,3,'Issued Items','Moses Nyota',65,169,104,'Moses','Wheat for use by students',1,NULL,'2020-12-10 14:31:52','2020-12-10 14:31:52');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (8,3,'Issued Items','Moses Nyota',65,104,39,'Moses','Wheat for use by students',1,NULL,'2020-12-10 14:31:52','2020-12-10 14:31:52');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (9,3,'Issued Items','Moses Nyota',9,39,30,'Arap Sungoi','Description of the user',1,NULL,'2020-12-10 14:32:57','2020-12-10 14:32:57');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (10,3,'Issued Items','Moses Nyota',43,30,-13,'34','34',1,NULL,'2020-12-10 14:49:15','2020-12-10 14:49:15');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (11,3,'Received Stock','Moses Nyota',13,-13,0,'---','Issued Items',0,NULL,'2020-12-10 14:50:04','2020-12-10 14:50:04');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (12,3,'Issued Items','Moses Nyota',10,0,-10,'Mwangi Maingi','Rice for supper',1,NULL,'2020-12-21 15:30:38','2020-12-21 15:30:38');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (13,1,'Issued Items','Moses Nyota',10,30,20,'James Mwangi','Breakfast',1,NULL,'2020-12-21 15:31:46','2020-12-21 15:31:46');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (14,3,'Received Stock','Moses Nyota',20,-10,10,'---','Issued Items',0,NULL,'2020-12-21 15:32:54','2020-12-21 15:32:54');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (15,3,'Issued Items','Moses Nyota',10,10,0,'Moses','Cooking package.',1,NULL,'2020-12-23 20:18:36','2020-12-23 20:18:36');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (16,3,'Received Stock','Moses Nyota',12,0,12,'---','Issued Items',0,NULL,'2020-12-23 20:19:26','2020-12-23 20:19:26');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (17,3,'Received Stock','Moses Nyota',2,12,14,'---','Issued Items',0,NULL,'2020-12-23 21:59:27','2020-12-23 21:59:27');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (18,5,'Received Stock','Moses Nyota',10,30,40,'---','Issued Items',NULL,NULL,'2020-12-24 14:25:54','2020-12-24 14:25:54');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (19,5,'Issued Items','Moses Nyota',10,40,30,'Mr. Omondi','Project Bishop Caverela',NULL,NULL,'2020-12-24 14:28:33','2020-12-24 14:28:33');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`narration`,`reason_id`,`deleted_at`,`created_at`,`updated_at`) values (20,3,'Issued Items','Moses Nyota',10,14,4,'Cook1','Food for staff during training',NULL,NULL,'2020-12-24 14:46:47','2020-12-24 14:46:47');

/*Table structure for table `products` */

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(200) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `details` varchar(200) DEFAULT NULL,
  `units_of_measure` varchar(10) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `buying_price` double(10,2) DEFAULT NULL,
  `selling_price` double(10,2) DEFAULT NULL,
  `reoder_level` int(10) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `store_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `store_id` (`store_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `locations` (`store_id`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`product_id`,`barcode`,`product_name`,`details`,`units_of_measure`,`quantity`,`buying_price`,`selling_price`,`reoder_level`,`category_id`,`store_id`,`created_at`,`updated_at`,`deleted_at`) values (1,'12545411','Sugar','Bags of sugar','KG',20,100.00,100.00,20,1,1,'2020-10-23 19:23:03','2020-12-21 15:31:46',NULL);
insert  into `products`(`product_id`,`barcode`,`product_name`,`details`,`units_of_measure`,`quantity`,`buying_price`,`selling_price`,`reoder_level`,`category_id`,`store_id`,`created_at`,`updated_at`,`deleted_at`) values (3,'447','Wheat',NULL,'KG',4,120.00,NULL,20,1,1,'2020-10-23 23:53:18','2020-12-24 14:46:47',NULL);
insert  into `products`(`product_id`,`barcode`,`product_name`,`details`,`units_of_measure`,`quantity`,`buying_price`,`selling_price`,`reoder_level`,`category_id`,`store_id`,`created_at`,`updated_at`,`deleted_at`) values (4,'12345678','Cooking Oil',NULL,'Pieces',40,300.00,NULL,12,1,1,'2020-12-09 19:03:39','2020-12-09 19:03:39',NULL);
insert  into `products`(`product_id`,`barcode`,`product_name`,`details`,`units_of_measure`,`quantity`,`buying_price`,`selling_price`,`reoder_level`,`category_id`,`store_id`,`created_at`,`updated_at`,`deleted_at`) values (5,'101010','Metal Y10',NULL,'Foots',30,22.00,NULL,10,6,4,'2020-12-24 14:23:12','2020-12-24 14:28:33',NULL);
insert  into `products`(`product_id`,`barcode`,`product_name`,`details`,`units_of_measure`,`quantity`,`buying_price`,`selling_price`,`reoder_level`,`category_id`,`store_id`,`created_at`,`updated_at`,`deleted_at`) values (6,'505','Mahogany Wood',NULL,'Feet',4000,110.00,NULL,1000,5,3,'2020-12-30 14:36:26','2020-12-30 14:36:26',NULL);

/*Table structure for table `projects` */

CREATE TABLE `projects` (
  `project_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `deadline` date NOT NULL,
  `completed_on` date DEFAULT NULL,
  `sponsor_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `budget` double NOT NULL,
  `cur_status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `projects` */

insert  into `projects`(`project_id`,`project_name`,`location`,`start_date`,`deadline`,`completed_on`,`sponsor_id`,`staff_id`,`budget`,`cur_status`,`details`,`created_at`,`updated_at`,`deleted_at`) values (11,'Savio Boy\'s Town Project','Don Bosco Boy\'s Town','2020-01-01','2020-12-31',NULL,2,4,21051385,'Active','<p>Updated Project Information</p>','2020-09-15 09:51:46','2020-10-26 09:11:48',NULL);

/*Table structure for table `role_has_permissions` */

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values (1,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (1,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (3,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (3,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (4,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (4,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (5,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (5,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (6,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (6,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (7,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (7,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (8,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (8,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (9,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (9,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (10,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (10,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (11,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (11,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (12,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (12,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (13,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (13,4);

/*Table structure for table `roles` */

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (1,'Teacher','web','2020-09-29 21:46:13','2020-09-29 21:46:13');
insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (2,'Accounts','web','2020-09-29 22:19:39','2020-09-29 22:19:39');
insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (3,'Administrator','web','2020-09-29 22:20:23','2020-09-29 22:20:23');
insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (4,'Salesian','web','2020-09-30 21:48:12','2020-09-30 21:48:12');
insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (5,'Secretary','web','2021-01-23 23:00:10',NULL);

/*Table structure for table `sponsors` */

CREATE TABLE `sponsors` (
  `sponsor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sponsornames` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startdate` date NOT NULL,
  `contactperson` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sponsor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sponsors` */

insert  into `sponsors`(`sponsor_id`,`sponsornames`,`startdate`,`contactperson`,`phone`,`address`,`email`,`created_at`,`updated_at`,`deleted_at`) values (1,'Terres Des Homes','2020-07-15','John Wrights 2','08787','152 Nairobi','terresdeshomes@gmail.com','2020-07-02 18:02:16','2020-09-19 15:19:37','2020-09-19 15:19:37');
insert  into `sponsors`(`sponsor_id`,`sponsornames`,`startdate`,`contactperson`,`phone`,`address`,`email`,`created_at`,`updated_at`,`deleted_at`) values (2,'Via Don Bosco','2020-07-07','Mr Wachira','0722000020','58474','admin@viadonbosco.com','2020-07-04 13:30:25','2020-07-04 13:30:25',NULL);
insert  into `sponsors`(`sponsor_id`,`sponsornames`,`startdate`,`contactperson`,`phone`,`address`,`email`,`created_at`,`updated_at`,`deleted_at`) values (3,'Savio','2011-06-14','-','077','Viena','admin@savio.co.uk',NULL,'2020-09-19 09:33:13',NULL);

/*Table structure for table `staff` */

CREATE TABLE `staff` (
  `staffid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `othernames` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staffcategory_id` int(11) NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`staffid`),
  UNIQUE KEY `staff_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `staff` */

insert  into `staff`(`staffid`,`firstname`,`othernames`,`phone`,`email`,`staffcategory_id`,`password`,`created_at`,`updated_at`,`deleted_at`) values (4,'Irene','Waweru','0722000000','irene@gmail.com',1,'$2y$10$0Q/YQCJmwo1vuvq2kAGPHOWDpg7gAtK5jSd8wzDXQKSS91qej8JaK','2020-06-25 01:58:10','2020-09-21 20:07:41',NULL);
insert  into `staff`(`staffid`,`firstname`,`othernames`,`phone`,`email`,`staffcategory_id`,`password`,`created_at`,`updated_at`,`deleted_at`) values (5,'Lucy','Mombo','0722000001','lucy@gmail.com',1,'$2y$10$ZD5ygL0twJwb4Zn4oUsayef5KgxsXu22YWctUzXuIcxq.t1mrWKim','2020-06-25 02:12:36','2020-09-21 20:07:51',NULL);
insert  into `staff`(`staffid`,`firstname`,`othernames`,`phone`,`email`,`staffcategory_id`,`password`,`created_at`,`updated_at`,`deleted_at`) values (10,'Moses','Nyota','0727909290','admin@admin.com',4,'$2y$10$9VJ6TKjx1cEjbHxGAqMKd.T3WG7Ond9iW8BAzKDQzx9AYBxUrm4Ee','2020-09-30 11:45:53','2020-09-30 21:51:09',NULL);
insert  into `staff`(`staffid`,`firstname`,`othernames`,`phone`,`email`,`staffcategory_id`,`password`,`created_at`,`updated_at`,`deleted_at`) values (11,'Bakhita','-','0722','admin@gmail.com',2,'$2y$10$0vMfjTaJOMXalIyH8CD3EOD9ku6ouHChw3B2nbOcvUPFwwfNCDdoq','2020-09-30 22:00:49','2020-09-30 22:00:49',NULL);

/*Table structure for table `staff_categories` */

CREATE TABLE `staff_categories` (
  `staffcategory_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`staffcategory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `staff_categories` */

insert  into `staff_categories`(`staffcategory_id`,`categoryname`,`created_at`,`updated_at`,`deleted_at`) values (1,'Project Officer',NULL,NULL,NULL);
insert  into `staff_categories`(`staffcategory_id`,`categoryname`,`created_at`,`updated_at`,`deleted_at`) values (2,'Administrator',NULL,NULL,NULL);
insert  into `staff_categories`(`staffcategory_id`,`categoryname`,`created_at`,`updated_at`,`deleted_at`) values (3,'Accounts',NULL,NULL,NULL);
insert  into `staff_categories`(`staffcategory_id`,`categoryname`,`created_at`,`updated_at`,`deleted_at`) values (4,'IT',NULL,NULL,NULL);
insert  into `staff_categories`(`staffcategory_id`,`categoryname`,`created_at`,`updated_at`,`deleted_at`) values (5,'Job Placement',NULL,NULL,NULL);
insert  into `staff_categories`(`staffcategory_id`,`categoryname`,`created_at`,`updated_at`,`deleted_at`) values (6,'Others',NULL,NULL,NULL);

/*Table structure for table `student_course` */

CREATE TABLE `student_course` (
  `course_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`course_id`,`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `student_course` */

insert  into `student_course`(`course_id`,`student_id`,`created_at`,`updated_at`,`deleted_at`) values (1,1,'2020-12-16 23:43:53','2020-12-16 23:43:53',NULL);
insert  into `student_course`(`course_id`,`student_id`,`created_at`,`updated_at`,`deleted_at`) values (1,3,'2021-01-18 09:14:45','2021-01-18 09:14:45',NULL);
insert  into `student_course`(`course_id`,`student_id`,`created_at`,`updated_at`,`deleted_at`) values (3,3,'2021-01-20 23:57:55',NULL,NULL);
insert  into `student_course`(`course_id`,`student_id`,`created_at`,`updated_at`,`deleted_at`) values (3,4,'2021-01-20 09:19:24','2021-01-20 09:19:24',NULL);

/*Table structure for table `students` */

CREATE TABLE `students` (
  `student_id` int(10) NOT NULL AUTO_INCREMENT,
  `student_no` varchar(10) DEFAULT NULL,
  `idno` varchar(20) DEFAULT NULL,
  `first_name` varchar(70) DEFAULT NULL,
  `middle_name` varchar(70) DEFAULT NULL,
  `surname` varchar(70) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `residence` varchar(100) DEFAULT NULL,
  `date_joined` date DEFAULT NULL,
  `parent_names` varchar(100) DEFAULT NULL,
  `parents_phone` varchar(30) DEFAULT NULL,
  `cur_status` varchar(20) DEFAULT 'active',
  `cur_year` int(10) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `date_left` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `students` */

insert  into `students`(`student_id`,`student_no`,`idno`,`first_name`,`middle_name`,`surname`,`dob`,`phone`,`residence`,`date_joined`,`parent_names`,`parents_phone`,`cur_status`,`cur_year`,`gender`,`date_left`,`created_at`,`updated_at`,`deleted_at`) values (1,'5476','25030737','Moses','Nyota','Maina','1986-04-05','0727909290','Ruiru','2020-01-01','Lilian','0714562935','active',1,'Male',NULL,NULL,'2020-12-21 06:50:21',NULL);
insert  into `students`(`student_id`,`student_no`,`idno`,`first_name`,`middle_name`,`surname`,`dob`,`phone`,`residence`,`date_joined`,`parent_names`,`parents_phone`,`cur_status`,`cur_year`,`gender`,`date_left`,`created_at`,`updated_at`,`deleted_at`) values (3,'3434',NULL,'James','Mwangi','Waiganjo','1970-01-01','0727909290',NULL,'1970-01-01',NULL,NULL,'active',1,'Male',NULL,'2020-12-16 21:45:41','2021-01-18 09:14:45',NULL);
insert  into `students`(`student_id`,`student_no`,`idno`,`first_name`,`middle_name`,`surname`,`dob`,`phone`,`residence`,`date_joined`,`parent_names`,`parents_phone`,`cur_status`,`cur_year`,`gender`,`date_left`,`created_at`,`updated_at`,`deleted_at`) values (4,'9090','345456','Loise','Wangari','Gitere','2021-01-20','0727909290','Nakururq','2021-01-20','Lilian','0714','active',1,'Female',NULL,'2021-01-20 09:19:24','2021-01-20 09:19:24',NULL);

/*Table structure for table `subjects` */

CREATE TABLE `subjects` (
  `subject_id` int(10) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `subjects` */

insert  into `subjects`(`subject_id`,`subject_name`,`created_at`,`updated_at`,`deleted_at`) values (1,'Math',NULL,'2021-01-20 09:12:32',NULL);
insert  into `subjects`(`subject_id`,`subject_name`,`created_at`,`updated_at`,`deleted_at`) values (4,'English','2021-01-17 22:50:30','2021-01-20 09:12:20',NULL);
insert  into `subjects`(`subject_id`,`subject_name`,`created_at`,`updated_at`,`deleted_at`) values (5,'Physics','2021-01-17 22:50:47','2021-01-17 22:50:47',NULL);

/*Table structure for table `suppliers` */

CREATE TABLE `suppliers` (
  `supplier_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `suppliers` */

insert  into `suppliers`(`supplier_id`,`supplier_name`,`address`,`phone`,`email`,`services`,`deleted_at`,`created_at`,`updated_at`) values (1,'Kigoini Enterprises','152 Albania','0722000000','alba@gmail.com','Supply of perfumes',NULL,NULL,'2020-09-27 09:42:36');
insert  into `suppliers`(`supplier_id`,`supplier_name`,`address`,`phone`,`email`,`services`,`deleted_at`,`created_at`,`updated_at`) values (2,'ProperNet Solutions LTD','152 Nairobi','0727909290','mosesnyota@gmail.com','Computer Services',NULL,'2020-09-28 08:13:13','2020-09-28 08:13:13');

/*Table structure for table `system_settings` */

CREATE TABLE `system_settings` (
  `setting_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `system_settings` */

insert  into `system_settings`(`setting_id`,`name`,`address`,`email`,`phone`,`created_at`,`updated_at`,`deleted_at`) values (1,'DON BOSCO TECHNICAL INSTITUTE EMBU','P.O.BOX, 158 - 001, EMBU','info@donbosco.org','0733456687','2020-12-18 14:28:03','2020-12-18 14:28:07',NULL);

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values (2,'Moses Nyota','admin@admin.com',NULL,'$2y$10$0vMfjTaJOMXalIyH8CD3EOD9ku6ouHChw3B2nbOcvUPFwwfNCDdoq',NULL,'2020-06-24 16:59:50','2020-06-24 16:59:50',NULL);
insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values (3,'Irene Waweru','irene@gmail.com',NULL,'$2y$10$eY8dCpS6tT8qZB3hsUrmPOC8.iEx5KTHqIF0jnuNUETGiAHAZrop2',NULL,'2020-06-25 02:12:36','2020-06-25 02:12:36',NULL);
insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values (4,'Lucy Mombo','lucy@gmail.com',NULL,'$2y$10$eY8dCpS6tT8qZB3hsUrmPOC8.iEx5KTHqIF0jnuNUETGiAHAZrop2',NULL,'2020-06-27 22:37:47','2020-06-27 22:37:47',NULL);
insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values (10,'Bakhita -','admin@gmail.com',NULL,'$2y$10$0vMfjTaJOMXalIyH8CD3EOD9ku6ouHChw3B2nbOcvUPFwwfNCDdoq',NULL,'2020-09-30 22:00:49','2020-09-30 22:00:49',NULL);

/*Table structure for table `voteheads` */

CREATE TABLE `voteheads` (
  `votehead_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `votehead_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_allocated` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`votehead_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `voteheads` */

insert  into `voteheads`(`votehead_id`,`project_id`,`votehead_name`,`amount_allocated`,`created_at`,`updated_at`,`deleted_at`) values (18,11,'Renovation & Upgrading',0,'2020-09-16 20:08:37','2020-09-29 21:51:45','2020-09-29 21:51:45');
insert  into `voteheads`(`votehead_id`,`project_id`,`votehead_name`,`amount_allocated`,`created_at`,`updated_at`,`deleted_at`) values (16,11,'Salaries & Administrative Costs',0,'2020-09-16 20:00:16','2020-09-29 21:51:34','2020-09-29 21:51:34');
insert  into `voteheads`(`votehead_id`,`project_id`,`votehead_name`,`amount_allocated`,`created_at`,`updated_at`,`deleted_at`) values (17,11,'Training and Training Materials',0,'2020-09-16 20:03:28','2020-09-16 20:13:03',NULL);
insert  into `voteheads`(`votehead_id`,`project_id`,`votehead_name`,`amount_allocated`,`created_at`,`updated_at`,`deleted_at`) values (19,11,'Communication',50000,'2020-09-29 08:20:30','2020-09-29 08:20:30',NULL);
insert  into `voteheads`(`votehead_id`,`project_id`,`votehead_name`,`amount_allocated`,`created_at`,`updated_at`,`deleted_at`) values (20,11,'Communication',15000,'2020-09-29 20:11:36','2020-09-29 20:11:36',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
