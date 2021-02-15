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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `asset_categories` */

insert  into `asset_categories`(`category_id`,`asset_category`,`created_at`,`updated_at`,`deleted_at`) values (1,'Wooden Students Seats','2020-12-11 07:50:41','2020-12-11 07:50:44',NULL);
insert  into `asset_categories`(`category_id`,`asset_category`,`created_at`,`updated_at`,`deleted_at`) values (2,'Wooden School Tables','2020-12-11 07:50:59','2020-12-11 07:51:01',NULL);
insert  into `asset_categories`(`category_id`,`asset_category`,`created_at`,`updated_at`,`deleted_at`) values (3,'Metallic Seats','2020-12-11 09:35:39','2020-12-11 09:52:20','2020-12-11 09:52:20');
insert  into `asset_categories`(`category_id`,`asset_category`,`created_at`,`updated_at`,`deleted_at`) values (4,'Metallic D','2020-12-11 09:52:32','2020-12-11 09:52:32',NULL);

/*Table structure for table `bills` */

CREATE TABLE `bills` (
  `bill_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expense_date` date NOT NULL,
  `bill_total` double NOT NULL,
  `narration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dbamcode` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'unpaid',
  `supplier_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `bills` */

insert  into `bills`(`bill_id`,`expense_date`,`bill_total`,`narration`,`dbamcode`,`cur_status`,`supplier_id`,`created_at`,`updated_at`,`deleted_at`) values (1,'2020-09-28',5975789,'Supply of computers and computer accessories','','unpaid',1,NULL,NULL,NULL);

/*Table structure for table `catalogue` */

CREATE TABLE `catalogue` (
  `asset_id` int(10) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(20) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `asset_name` varchar(70) DEFAULT NULL,
  `serial_no` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `manufacture_date` date DEFAULT NULL,
  `location_id` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`asset_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `catalogue` */

insert  into `catalogue`(`asset_id`,`barcode`,`category_id`,`asset_name`,`serial_no`,`price`,`manufacture_date`,`location_id`,`created_at`,`updated_at`,`deleted_at`) values (1,'112324534',1,'Chair','TTY1',3000,'2020-06-01',1,'2020-12-11 07:53:36','2020-12-11 06:30:12','2020-12-11 06:30:12');
insert  into `catalogue`(`asset_id`,`barcode`,`category_id`,`asset_name`,`serial_no`,`price`,`manufacture_date`,`location_id`,`created_at`,`updated_at`,`deleted_at`) values (2,'342323',2,'Office Table','TTY2',5000,'2020-09-09',3,'2020-12-11 05:40:46','2020-12-11 06:29:14',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `customers` */

insert  into `customers`(`customer_id`,`customer_names`,`address`,`phone`,`email`,`created_at`,`updated_at`,`deleted_at`) values (1,'Kenya School of Law2','145 Karen','0722','KSL@GMAIL.COM','2020-12-12 13:48:29','2020-12-12 13:55:09','2020-12-12 13:55:09');
insert  into `customers`(`customer_id`,`customer_names`,`address`,`phone`,`email`,`created_at`,`updated_at`,`deleted_at`) values (2,'ProperNet Solutions LTD','152 Nairobi','0727909290','mosesnyota@gmail.com','2020-12-12 13:46:05','2020-12-12 13:46:05',NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `expenses` */

insert  into `expenses`(`expense_id`,`expense_date`,`expense_amount`,`narration`,`dbamcode`,`trasnref`,`paidto`,`category_id`,`created_at`,`updated_at`,`deleted_at`) values (1,'2020-09-22',500,'Payment for Electricity',NULL,'-','KPLC',1,'2020-09-22 14:27:44','2020-09-22 16:45:00',NULL);
insert  into `expenses`(`expense_id`,`expense_date`,`expense_amount`,`narration`,`dbamcode`,`trasnref`,`paidto`,`category_id`,`created_at`,`updated_at`,`deleted_at`) values (2,'2020-09-22',350,'Wages',NULL,NULL,'Employees',3,'2020-09-22 14:28:12','2020-09-22 16:55:21','2020-09-22 16:55:21');
insert  into `expenses`(`expense_id`,`expense_date`,`expense_amount`,`narration`,`dbamcode`,`trasnref`,`paidto`,`category_id`,`created_at`,`updated_at`,`deleted_at`) values (3,'2020-09-22',452,'Water Payment',NULL,NULL,'Water Department',2,'2020-09-22 14:28:50','2020-09-22 16:45:46',NULL);
insert  into `expenses`(`expense_id`,`expense_date`,`expense_amount`,`narration`,`dbamcode`,`trasnref`,`paidto`,`category_id`,`created_at`,`updated_at`,`deleted_at`) values (4,'2020-07-31',200,'Water Bill',NULL,NULL,NULL,2,'2020-09-22 16:46:21','2020-09-22 16:49:40','2020-09-22 16:49:40');
insert  into `expenses`(`expense_id`,`expense_date`,`expense_amount`,`narration`,`dbamcode`,`trasnref`,`paidto`,`category_id`,`created_at`,`updated_at`,`deleted_at`) values (5,'2019-11-06',50000,'Electic Bills for Nov 2019',NULL,NULL,'KPLC',1,'2020-12-16 09:31:27','2020-12-16 09:31:27',NULL);
insert  into `expenses`(`expense_id`,`expense_date`,`expense_amount`,`narration`,`dbamcode`,`trasnref`,`paidto`,`category_id`,`created_at`,`updated_at`,`deleted_at`) values (6,'2020-12-16',5000,'Water Bill',NULL,NULL,'Water Services',2,'2020-12-16 09:31:49','2020-12-16 09:32:07',NULL);

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

insert  into `fee_payments`(`payment_id`,`payment_date`,`student_id`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (1,'2020-12-18',1,1500.00,'Ukdd','Bank Deposit','2020-12-18 04:22:54','2020-12-21 06:55:49','2020-12-21 06:55:49');
insert  into `fee_payments`(`payment_id`,`payment_date`,`student_id`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (2,'2020-12-20',1,500.00,'Cash','Cash','2020-12-20 09:36:05','2020-12-20 09:36:05',NULL);
insert  into `fee_payments`(`payment_id`,`payment_date`,`student_id`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (3,'2020-12-20',3,500.00,'-','Cash','2020-12-20 09:36:26','2020-12-20 09:36:26',NULL);
insert  into `fee_payments`(`payment_id`,`payment_date`,`student_id`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (4,'2020-12-20',1,500.00,'MPDSEDSDDS','Mpesa','2020-12-20 13:10:27','2020-12-20 13:10:27',NULL);
insert  into `fee_payments`(`payment_id`,`payment_date`,`student_id`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (5,'2020-12-20',1,500.00,'MPDSEDSDDS','Mpesa','2020-12-20 13:48:15','2020-12-20 13:48:15',NULL);
insert  into `fee_payments`(`payment_id`,`payment_date`,`student_id`,`amount`,`reference`,`payment_method`,`created_at`,`updated_at`,`deleted_at`) values (6,'2020-12-21',3,1200.00,'MPESA','Mpesa','2020-12-20 13:52:06','2020-12-21 07:01:43','2020-12-21 07:01:43');

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
  `item_category_id` int(10) DEFAULT NULL,
  `quantity` double(10,2) DEFAULT NULL,
  `unit_cost` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `invoice_details` */

insert  into `invoice_details`(`detail_id`,`invoice_id`,`item_category_id`,`quantity`,`unit_cost`,`created_at`,`updated_at`,`deleted_at`) values (1,1,1,1.00,200.00,'2020-12-13 00:20:44','2020-12-13 00:20:46',NULL);
insert  into `invoice_details`(`detail_id`,`invoice_id`,`item_category_id`,`quantity`,`unit_cost`,`created_at`,`updated_at`,`deleted_at`) values (2,2,1,1.00,300.00,'2020-12-15 00:52:44','2020-12-15 00:52:46',NULL);

/*Table structure for table `invoices` */

CREATE TABLE `invoices` (
  `invoice_id` int(10) NOT NULL AUTO_INCREMENT,
  `invoice_date` date DEFAULT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `totalamount` double(10,2) DEFAULT NULL,
  `narration` varchar(240) DEFAULT NULL,
  `cur_status` varchar(30) DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `invoices` */

insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`totalamount`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (1,'2020-12-13',2,'2020-12-15',200.00,'Making of items','partial','2020-12-13 00:19:40','2020-12-13 00:19:42',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`totalamount`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (2,'2019-12-15',1,'2020-12-15',300.00,'Furnitures Manufacture','unpaid','2020-12-15 00:52:23','2020-12-15 00:52:25',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`totalamount`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (3,'2020-12-16',2,'2020-12-30',345.00,'Purchase of materials','unpaid','2020-12-16 08:16:38','2020-12-16 08:16:38',NULL);
insert  into `invoices`(`invoice_id`,`invoice_date`,`customer_id`,`due_date`,`totalamount`,`narration`,`cur_status`,`created_at`,`updated_at`,`deleted_at`) values (4,'2020-12-22',2,'2020-12-31',5888.00,'Purchase of materials','unpaid','2020-12-21 21:50:25','2020-12-21 21:50:25',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `locations` */

insert  into `locations`(`store_id`,`store_name`,`description`,`isastore`,`created_at`,`updated_at`,`deleted_at`) values (1,'Salesian Store 12','Salesian store for foods','NO',NULL,'2020-10-23 17:58:25',NULL);
insert  into `locations`(`store_id`,`store_name`,`description`,`isastore`,`created_at`,`updated_at`,`deleted_at`) values (2,'Fanta',NULL,'NO','2020-10-23 17:26:06','2020-10-23 17:49:37','2020-10-23 17:49:37');
insert  into `locations`(`store_id`,`store_name`,`description`,`isastore`,`created_at`,`updated_at`,`deleted_at`) values (3,'Official School Store','Located in the school','NO','2020-12-09 16:42:49','2020-12-09 16:42:49',NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (1,'VIEW PROJECTS','web','2020-09-30 06:14:02','2020-09-30 06:14:02');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (2,'VIEW DONORS','web','2020-09-30 11:56:24','2020-09-30 11:55:01');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (3,'VIEW INCOME','web','2020-09-30 21:45:16','2020-09-30 21:45:16');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (4,'VIEW EXPENSES','web','2020-09-30 21:45:29','2020-09-30 21:45:29');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (5,'VIEW STAFF','web','2020-09-30 21:45:43','2020-09-30 21:45:43');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (6,'VIEW SUPPLIERS','web','2020-09-30 21:45:59','2020-09-30 21:45:59');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (7,'VIEW PETTY CASH','web','2020-09-30 21:46:36','2020-09-30 21:46:36');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (8,'VIEW ANALYTICS','web','2020-09-30 21:46:48','2020-09-30 21:46:48');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (9,'VIEW FINANCE','web','2020-09-30 21:47:02','2020-09-30 21:47:02');
insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (10,'IS ADMINISTRATOR','web','2020-09-30 21:47:36','2020-09-30 21:47:36');

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

insert  into `petties`(`pettycash_id`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (1,33500,'2020-07-29 20:15:32',NULL,NULL);

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
  PRIMARY KEY (`transactionid`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `petty_cashes` */

insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (1,'2020-06-02','Fuel for motorbikew','Non Employee','Withdraw',300,NULL,'2020-07-01 20:56:59','2020-09-21 22:55:42','2020-09-21 22:55:42');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (2,'2020-07-08','Bank','-','Deposit',7300,NULL,'2020-07-01 21:41:34','2020-09-23 07:12:38',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (3,'2020-07-02','Testing withdraw','Non Employee','Withdraw',300,NULL,'2020-07-04 11:46:00','2020-09-21 22:55:54','2020-09-21 22:55:54');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (4,'2020-07-07','Fuel for motorbikew','Non Employee','Withdraw',300,39700.00,'2020-07-29 18:35:42','2020-07-29 18:35:42',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (5,'2020-07-29','Bank','Non Employee','Withdraw',700,39000.00,'2020-07-29 18:36:06','2020-07-29 18:36:06',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (6,'2020-07-29','Deposit','-','Deposit',300,39300.00,'2020-07-29 18:41:12','2020-09-21 22:56:10','2020-09-21 22:56:10');
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (7,'2020-07-30','Bank','-','Deposit',1000,40300.00,'2020-07-30 05:27:19','2020-07-30 05:27:19',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (8,'2020-07-30','Fuel for motorbike','Non Employee','Withdraw',300,40000.00,'2020-07-30 05:27:41','2020-07-30 05:27:41',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (9,'2020-07-30','Fuel for motorbikew','-','Deposit',7500,47500.00,'2020-07-30 06:27:20','2020-07-30 06:27:20',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (10,'2020-07-30','Bank','-','Deposit',300,47800.00,'2020-07-30 06:27:31','2020-07-30 06:27:31',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (11,'2020-07-10','Fuel for motorbikew','Non Employee','Withdraw',300,47500.00,'2020-07-30 06:27:41','2020-07-30 06:27:41',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (12,'2020-07-31','Issued as part of the government demonstration to its people that it cares about the ongoing business hubs','Non Employee','Withdraw',8555,38945.00,'2020-07-31 20:10:43','2020-07-31 20:10:43',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (13,'2020-08-08','Cash Addition','-','Deposit',1000,39945.00,'2020-08-07 23:50:50','2020-08-07 23:50:50',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (14,'2020-09-22','Tithe Payment','Moses Nyota2','Withdraw',345,39900.00,'2020-09-22 07:46:53','2020-09-23 07:58:04',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (15,'2020-09-22','Deposit Money','-','Deposit',345,40245.00,'2020-09-22 07:47:50','2020-09-22 07:47:50',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (16,'2020-09-22','Payment for casual Work','Arap Ngoti','Withdraw',245,40000.00,'2020-09-22 07:55:01','2020-09-22 07:55:01',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (17,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,39000.00,'2020-09-22 08:12:06','2020-09-22 08:12:06',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (18,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,38000.00,'2020-09-22 08:12:46','2020-09-22 08:12:46',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (19,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,37000.00,'2020-09-22 08:13:58','2020-09-22 08:13:58',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (20,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,36000.00,'2020-09-22 08:14:52','2020-09-22 08:14:52',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (21,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,35000.00,'2020-09-22 08:15:10','2020-09-22 08:15:10',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (22,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,34000.00,'2020-09-22 08:15:22','2020-09-22 08:15:22',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (23,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,33000.00,'2020-09-22 08:17:08','2020-09-22 08:17:08',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (24,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,32000.00,'2020-09-22 08:26:25','2020-09-22 08:26:25',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (25,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,31000.00,'2020-09-22 08:27:37','2020-09-22 08:27:37',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (26,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,30000.00,'2020-09-22 08:27:57','2020-09-22 08:27:57',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (27,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,29000.00,'2020-09-22 08:28:06','2020-09-22 08:28:06',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (28,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,28000.00,'2020-09-22 08:28:18','2020-09-22 08:28:18',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (29,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,27000.00,'2020-09-22 08:28:37','2020-09-22 08:28:37',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (30,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,26000.00,'2020-09-22 08:28:50','2020-09-22 08:28:50',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (31,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,25000.00,'2020-09-22 08:29:04','2020-09-22 08:29:04',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (32,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,24000.00,'2020-09-22 08:30:15','2020-09-22 08:30:15',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (33,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,23000.00,'2020-09-22 08:30:36','2020-09-22 08:30:36',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (34,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,22000.00,'2020-09-22 08:30:48','2020-09-22 08:30:48',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (35,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,21000.00,'2020-09-22 08:31:11','2020-09-22 08:31:11',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (36,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,20000.00,'2020-09-22 08:31:22','2020-09-22 08:31:22',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (37,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,19000.00,'2020-09-22 08:31:33','2020-09-22 08:31:33',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (38,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,18000.00,'2020-09-22 08:33:45','2020-09-22 08:33:45',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (39,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,17000.00,'2020-09-22 08:34:33','2020-09-22 08:34:33',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (40,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,16000.00,'2020-09-22 08:35:48','2020-09-22 08:35:48',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (41,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,15000.00,'2020-09-22 08:36:27','2020-09-22 08:36:27',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (42,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,14000.00,'2020-09-22 08:36:37','2020-09-22 08:36:37',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (43,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,13000.00,'2020-09-22 08:40:21','2020-09-22 08:40:21',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (44,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,12000.00,'2020-09-22 08:40:46','2020-09-22 08:40:46',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (45,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,11000.00,'2020-09-22 08:41:06','2020-09-22 08:41:06',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (46,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,10000.00,'2020-09-22 08:41:26','2020-09-22 08:41:26',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (47,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,9000.00,'2020-09-22 08:41:40','2020-09-22 08:41:40',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (48,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,8000.00,'2020-09-22 08:42:15','2020-09-22 08:42:15',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (49,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,7000.00,'2020-09-22 08:42:25','2020-09-22 08:42:25',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (50,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,6000.00,'2020-09-22 08:42:37','2020-09-22 08:42:37',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (51,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,5000.00,'2020-09-22 08:43:39','2020-09-22 08:43:39',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (52,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,4000.00,'2020-09-22 08:44:02','2020-09-22 08:44:02',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (53,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,3000.00,'2020-09-22 08:44:25','2020-09-22 08:44:25',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (54,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,2000.00,'2020-09-22 08:45:10','2020-09-22 08:45:10',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (55,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,1000.00,'2020-09-22 08:45:36','2020-09-22 08:45:36',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (56,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,0.00,'2020-09-22 08:45:46','2020-09-22 08:45:46',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (57,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-1000.00,'2020-09-22 08:46:16','2020-09-22 08:46:16',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (58,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-2000.00,'2020-09-22 08:47:12','2020-09-22 08:47:12',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (59,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-3000.00,'2020-09-22 08:47:32','2020-09-22 08:47:32',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (60,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-4000.00,'2020-09-22 08:47:44','2020-09-22 08:47:44',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (61,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-5000.00,'2020-09-22 08:47:57','2020-09-22 08:47:57',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (62,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-6000.00,'2020-09-22 08:51:21','2020-09-22 08:51:21',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (63,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-7000.00,'2020-09-22 08:52:29','2020-09-22 08:52:29',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (64,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-8000.00,'2020-09-22 08:53:06','2020-09-22 08:53:06',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (65,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-9000.00,'2020-09-22 08:53:56','2020-09-22 08:53:56',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (66,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-10000.00,'2020-09-22 08:56:16','2020-09-22 08:56:16',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (67,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-11000.00,'2020-09-22 08:56:35','2020-09-22 08:56:35',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (68,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-12000.00,'2020-09-22 08:56:58','2020-09-22 08:56:58',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (69,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-13000.00,'2020-09-22 08:57:44','2020-09-22 08:57:44',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (70,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-14000.00,'2020-09-22 08:58:01','2020-09-22 08:58:01',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (71,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-15000.00,'2020-09-22 08:58:15','2020-09-22 08:58:15',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (72,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-16000.00,'2020-09-22 08:58:31','2020-09-22 08:58:31',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (73,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-17000.00,'2020-09-22 08:58:46','2020-09-22 08:58:46',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (74,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-18000.00,'2020-09-22 08:58:57','2020-09-22 08:58:57',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (75,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-19000.00,'2020-09-22 08:59:31','2020-09-22 08:59:31',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (76,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-20000.00,'2020-09-22 08:59:51','2020-09-22 08:59:51',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (77,'2020-09-22','Payment for Tutoring community','Moses Maina','Withdraw',1000,-21000.00,'2020-09-22 09:00:29','2020-09-22 09:00:29',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (78,'2020-09-22','The amount was issued to cover damages caused by our goats','Paul Edstrom','Withdraw',2500,-23500.00,'2020-09-22 09:03:06','2020-09-22 09:03:06',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (94,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-63500.00,'2020-09-22 09:11:45','2020-09-22 09:11:45',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (79,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-26000.00,'2020-09-22 09:04:21','2020-09-22 09:04:21',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (80,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-28500.00,'2020-09-22 09:04:40','2020-09-22 09:04:40',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (81,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-31000.00,'2020-09-22 09:05:27','2020-09-22 09:05:27',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (82,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-33500.00,'2020-09-22 09:05:41','2020-09-22 09:05:41',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (83,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-36000.00,'2020-09-22 09:06:03','2020-09-22 09:06:03',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (84,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-38500.00,'2020-09-22 09:06:42','2020-09-22 09:06:42',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (85,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-41000.00,'2020-09-22 09:06:54','2020-09-22 09:06:54',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (86,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-43500.00,'2020-09-22 09:07:15','2020-09-22 09:07:15',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (87,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-46000.00,'2020-09-22 09:07:42','2020-09-22 09:07:42',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (88,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-48500.00,'2020-09-22 09:08:10','2020-09-22 09:08:10',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (89,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-51000.00,'2020-09-22 09:08:51','2020-09-22 09:08:51',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (90,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-53500.00,'2020-09-22 09:09:20','2020-09-22 09:09:20',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (91,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-56000.00,'2020-09-22 09:10:19','2020-09-22 09:10:19',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (92,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-58500.00,'2020-09-22 09:10:43','2020-09-22 09:10:43',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (93,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-61000.00,'2020-09-22 09:10:56','2020-09-22 09:10:56',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (95,'2020-09-22','The amount was issued to cover damages caused by our goats on his farm when they went grazing alone in the fields','Paul Edstrom','Withdraw',2500,-66000.00,'2020-09-22 09:11:59','2020-09-22 09:11:59',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (96,'2020-09-22','Testing Printing','Lois Gitere','Withdraw',125,-66125.00,'2020-09-22 09:33:12','2020-09-22 09:33:12',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (97,'2020-09-22','Testing Printing','Lois Gitere','Withdraw',125,-66250.00,'2020-09-22 09:34:06','2020-09-22 09:34:06',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (98,'2020-09-22','Testing Printing','Lois Gitere','Withdraw',125,-66375.00,'2020-09-22 09:39:26','2020-09-22 09:39:26',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (99,'2020-09-22','Testing Printing','Lois Gitere','Withdraw',125,-66500.00,'2020-09-22 09:40:07','2020-09-22 09:40:07',NULL);
insert  into `petty_cashes`(`transactionid`,`transaction_date`,`description`,`issuedto`,`transactiontype`,`amount`,`balance`,`created_at`,`updated_at`,`deleted_at`) values (100,'2020-09-22','Funds Additions','-','Deposit',100000,33500.00,'2020-09-22 09:41:46','2020-09-22 09:41:46',NULL);

/*Table structure for table `product_category` */

CREATE TABLE `product_category` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `product_category` */

insert  into `product_category`(`category_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values (1,'Food Stuffs',NULL,NULL,NULL);
insert  into `product_category`(`category_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values (2,'New category 2','2020-10-23 19:23:45','2020-10-23 19:25:01','2020-10-23 19:25:01');
insert  into `product_category`(`category_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values (3,'Metalic Seats','2020-12-11 09:30:22','2020-12-11 09:30:22',NULL);
insert  into `product_category`(`category_id`,`category_name`,`created_at`,`updated_at`,`deleted_at`) values (4,'Metallic Seats','2020-12-11 09:33:46','2020-12-11 09:33:46',NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `narration` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `product_transactions` */

insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (1,3,'Received Stock','Moses',80,NULL,NULL,NULL,'2020-12-09 21:35:29',NULL,NULL,'2020-12-09 21:35:29');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (2,1,'Received Stock','Moses Nyota',10,NULL,NULL,NULL,'2020-12-09 22:30:46',NULL,NULL,'2020-12-09 22:30:46');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (3,3,'Received Stock','Moses Nyota',34,NULL,NULL,NULL,'2020-12-09 23:36:36',NULL,NULL,'2020-12-09 23:36:36');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (4,1,'Received Stock','Moses Nyota',5,NULL,NULL,NULL,'2020-12-09 23:36:48',NULL,NULL,'2020-12-09 23:36:48');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (5,1,'Received Stock','Moses Nyota',5,35,40,NULL,'2020-12-09 23:40:21',NULL,NULL,'2020-12-09 23:40:21');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (6,1,'Issued Items','Moses Nyota',5,35,30,'Moses','2020-12-10 11:45:19',NULL,'Cooking tea for students','2020-12-10 11:45:19');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (7,3,'Issued Items','Moses Nyota',65,169,104,'Moses','2020-12-10 14:31:52',NULL,'Wheat for use by students','2020-12-10 14:31:52');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (8,3,'Issued Items','Moses Nyota',65,104,39,'Moses','2020-12-10 14:31:52',NULL,'Wheat for use by students','2020-12-10 14:31:52');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (9,3,'Issued Items','Moses Nyota',9,39,30,'Arap Sungoi','2020-12-10 14:32:57',NULL,'Description of the user','2020-12-10 14:32:57');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (10,3,'Issued Items','Moses Nyota',43,30,-13,'34','2020-12-10 14:49:15',NULL,'34','2020-12-10 14:49:15');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (11,3,'Received Stock','Moses Nyota',13,-13,0,'---','2020-12-10 14:50:04',NULL,'Issued Items','2020-12-10 14:50:04');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (12,3,'Issued Items','Moses Nyota',10,0,-10,'Mwangi Maingi','2020-12-21 15:30:38',NULL,'Rice for supper','2020-12-21 15:30:38');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (13,1,'Issued Items','Moses Nyota',10,30,20,'James Mwangi','2020-12-21 15:31:46',NULL,'Breakfast','2020-12-21 15:31:46');
insert  into `product_transactions`(`transaction_id`,`product_id`,`trans_type`,`transacted_by`,`quantity`,`qnty_before`,`qnty_after`,`issued_to`,`updated_at`,`deleted_at`,`narration`,`created_at`) values (14,3,'Received Stock','Moses Nyota',20,-10,10,'---','2020-12-21 15:32:54',NULL,'Issued Items','2020-12-21 15:32:54');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`product_id`,`barcode`,`product_name`,`details`,`units_of_measure`,`quantity`,`buying_price`,`selling_price`,`reoder_level`,`category_id`,`store_id`,`created_at`,`updated_at`,`deleted_at`) values (1,'12545411','Sugar','Bags of sugar','KG',20,100.00,100.00,20,1,1,'2020-10-23 19:23:03','2020-12-21 15:31:46',NULL);
insert  into `products`(`product_id`,`barcode`,`product_name`,`details`,`units_of_measure`,`quantity`,`buying_price`,`selling_price`,`reoder_level`,`category_id`,`store_id`,`created_at`,`updated_at`,`deleted_at`) values (3,'447','Wheat',NULL,'KG',10,452.00,NULL,20,1,1,'2020-10-23 23:53:18','2020-12-21 15:32:54',NULL);
insert  into `products`(`product_id`,`barcode`,`product_name`,`details`,`units_of_measure`,`quantity`,`buying_price`,`selling_price`,`reoder_level`,`category_id`,`store_id`,`created_at`,`updated_at`,`deleted_at`) values (4,'12345678','Cooking Oil',NULL,'Pieces',40,39444.00,NULL,12,1,1,'2020-12-09 19:03:39','2020-12-09 19:03:39',NULL);

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

insert  into `role_has_permissions`(`permission_id`,`role_id`) values (1,1);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (1,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (1,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (2,2);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (2,3);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (2,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (3,2);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (3,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (4,1);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (4,2);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (4,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (5,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (6,1);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (6,2);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (6,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (7,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (8,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (9,4);
insert  into `role_has_permissions`(`permission_id`,`role_id`) values (10,4);

/*Table structure for table `roles` */

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (1,'Project Officer','web','2020-09-29 21:46:13','2020-09-29 21:46:13');
insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (2,'Accounting','web','2020-09-29 22:19:39','2020-09-29 22:19:39');
insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (3,'IT','web','2020-09-29 22:20:23','2020-09-29 22:20:23');
insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (4,'Administrator','web','2020-09-30 21:48:12','2020-09-30 21:48:12');

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
insert  into `student_course`(`course_id`,`student_id`,`created_at`,`updated_at`,`deleted_at`) values (2,3,'2020-12-20 13:50:43','2020-12-20 13:50:43',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `students` */

insert  into `students`(`student_id`,`student_no`,`idno`,`first_name`,`middle_name`,`surname`,`dob`,`phone`,`residence`,`date_joined`,`parent_names`,`parents_phone`,`cur_status`,`cur_year`,`gender`,`date_left`,`created_at`,`updated_at`,`deleted_at`) values (1,'5476','25030737','Moses','Nyota','Maina','1986-04-05','0727909290','Ruiru','2020-01-01','Lilian','0714562935','active',1,'Male',NULL,NULL,'2020-12-21 06:50:21',NULL);
insert  into `students`(`student_id`,`student_no`,`idno`,`first_name`,`middle_name`,`surname`,`dob`,`phone`,`residence`,`date_joined`,`parent_names`,`parents_phone`,`cur_status`,`cur_year`,`gender`,`date_left`,`created_at`,`updated_at`,`deleted_at`) values (3,'3434',NULL,'James','Mwangi','Waiganjo','1970-01-01','0727909290',NULL,'1970-01-01',NULL,NULL,'active',1,'Female',NULL,'2020-12-16 21:45:41','2020-12-20 13:50:43',NULL);

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

insert  into `system_settings`(`setting_id`,`name`,`address`,`email`,`phone`,`created_at`,`updated_at`,`deleted_at`) values (1,'DON BOSCO TECHNICAL MARSABIT','P.O.BOX, 158 - 001, MARSABIL','info@donbosco.org','0733456687','2020-12-18 14:28:03','2020-12-18 14:28:07',NULL);

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
