
/* Create table in target */
CREATE TABLE `leave_days`(
	`leaveday_id` INT(10) NOT NULL  AUTO_INCREMENT , 
	`year` INT(10) NULL  , 
	`no_of_days` INT(10) NULL  , 
	`staff_id` INT(10) NULL  , 
	`created_at` TIMESTAMP NULL  , 
	`updated_at` TIMESTAMP NULL  , 
	`deleted_at` TIMESTAMP NULL  , 
	PRIMARY KEY (`leaveday_id`) 
) ENGINE=INNODB DEFAULT CHARSET='latin1';


/* Create table in target */
CREATE TABLE `sentsmslogs`(
	`msg_id` INT(10) NOT NULL  AUTO_INCREMENT , 
	`statuscode` VARCHAR(20) COLLATE latin1_swedish_ci NULL  , 
	`statusdesc` VARCHAR(250) COLLATE latin1_swedish_ci NULL  , 
	`phone` VARCHAR(20) COLLATE latin1_swedish_ci NULL  , 
	`messages` TEXT COLLATE latin1_swedish_ci NULL  , 
	`name` VARCHAR(150) COLLATE latin1_swedish_ci NULL  , 
	`targetgroup` VARCHAR(100) COLLATE latin1_swedish_ci NULL  , 
	`timestampss` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP , 
	`created_at` TIMESTAMP NULL  , 
	`updated_at` TIMESTAMP NULL  , 
	`deleted_at` TIMESTAMP NULL  , 
	PRIMARY KEY (`msg_id`) 
) ENGINE=INNODB DEFAULT CHARSET='latin1';


/* Create table in target */
CREATE TABLE `staff_leave`(
	`leave_id` INT(11) NOT NULL  AUTO_INCREMENT , 
	`staff_id` INT(10) NULL  , 
	`start_date` DATE NULL  , 
	`end_date` DATE NULL  , 
	`created_at` TIMESTAMP NULL  , 
	`updated_at` TIMESTAMP NULL  , 
	`deleted_at` TIMESTAMP NULL  , 
	PRIMARY KEY (`leave_id`) 
) ENGINE=INNODB DEFAULT CHARSET='latin1';