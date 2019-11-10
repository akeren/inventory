-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.42-community


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema inventorysystem
--

CREATE DATABASE IF NOT EXISTS inventorysystem;
USE inventorysystem;

--
-- Definition of table `balance`
--

DROP TABLE IF EXISTS `balance`;
CREATE TABLE `balance` (
  `balanceid` varchar(45) NOT NULL DEFAULT '',
  `staffid` varchar(45) NOT NULL DEFAULT '',
  `sales` varchar(45) NOT NULL DEFAULT '',
  `amountsubmited` varchar(45) NOT NULL DEFAULT '',
  `balance` varchar(45) NOT NULL DEFAULT '',
  `date` varchar(45) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`balanceid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balance`
--

/*!40000 ALTER TABLE `balance` DISABLE KEYS */;
INSERT INTO `balance` (`balanceid`,`staffid`,`sales`,`amountsubmited`,`balance`,`date`,`status`) VALUES 
 ('athans4sure@yahoo.com2016-8-23','athans4sure@yahoo.com','30340','30000','340','2016-8-23',0),
 ('princealoy@ovi.com2016-8-23','princealoy@ovi.com','9320','8500','820','2016-8-23',0);
/*!40000 ALTER TABLE `balance` ENABLE KEYS */;


--
-- Definition of table `days`
--

DROP TABLE IF EXISTS `days`;
CREATE TABLE `days` (
  `daydate` varchar(45) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`daydate`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

/*!40000 ALTER TABLE `days` DISABLE KEYS */;
INSERT INTO `days` (`daydate`,`status`) VALUES 
 ('2016-8-23',1);
/*!40000 ALTER TABLE `days` ENABLE KEYS */;


--
-- Definition of table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `itemid` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `price` varchar(45) NOT NULL,
  `quantity` varchar(45) NOT NULL,
  `unit` varchar(45) DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`itemid`,`description`,`price`,`quantity`,`unit`,`status`) VALUES 
 ('Cok2','Coke','60','1',NULL,1),
 ('Yal1','Yale Biscuits','10','180',NULL,1),
 ('Fan3','Fanta','70','44',NULL,1),
 ('shi4','shirts','100','30',NULL,1);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;


--
-- Definition of table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role` varchar(45) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `initial` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`username`,`password`,`role`,`status`,`initial`) VALUES 
 ('katerakeren@yahoo.com','admin','admin',1,0);
/*!40000 ALTER TABLE `login` ENABLE KEYS */;


--
-- Definition of table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `purchaseid` varchar(45) NOT NULL,
  `item` varchar(45) NOT NULL,
  `quantity` varchar(45) NOT NULL,
  `date` varchar(45) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`purchaseid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

/*!40000 ALTER TABLE `purchase` DISABLE KEYS */;
INSERT INTO `purchase` (`purchaseid`,`item`,`quantity`,`date`,`status`) VALUES 
 ('Cok21','Cok2','56','2015-2-09',1),
 ('Yal11','Yal1','15','2015-2-09',1);
/*!40000 ALTER TABLE `purchase` ENABLE KEYS */;


--
-- Definition of table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `salesid` varchar(90) NOT NULL DEFAULT '',
  `soldby` varchar(45) NOT NULL DEFAULT '',
  `datesold` varchar(45) NOT NULL DEFAULT '',
  `qty` varchar(45) NOT NULL DEFAULT '',
  `amount` varchar(45) NOT NULL DEFAULT '',
  `itemid` varchar(45) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`salesid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` (`salesid`,`soldby`,`datesold`,`qty`,`amount`,`itemid`,`status`) VALUES 
 ('Cok220160823105157','athans4sure@yahoo.com','2016-8-23','6','60','Cok2',1),
 ('Fan320160823105157','athans4sure@yahoo.com','2016-8-23','9','70','Fan3',1),
 ('Yal120160823105157','athans4sure@yahoo.com','2016-8-23','90','10','Yal1',1),
 ('Cok220160823105441','athans4sure@yahoo.com','2016-8-23','5','60','Cok2',1),
 ('Fan320160823105441','athans4sure@yahoo.com','2016-8-23','400','70','Fan3',1),
 ('Yal120160823105441','athans4sure@yahoo.com','2016-8-23','15','10','Yal1',1),
 ('Cok220160823115219','princealoy@ovi.com','2016-8-23','70','60','Cok2',1),
 ('Fan320160823115219','princealoy@ovi.com','2016-8-23','56','70','Fan3',1),
 ('Yal120160823115219','princealoy@ovi.com','2016-8-23','120','10','Yal1',1),
 ('Cok220160824090248','katerakeren@yahoo.com','2016-8-24','1','60','Cok2',1),
 ('Fan320160824090248','katerakeren@yahoo.com','2016-8-24','','70','Fan3',1),
 ('shi420160824090248','katerakeren@yahoo.com','2016-8-24','','100','shi4',1),
 ('Yal120160824090248','katerakeren@yahoo.com','2016-8-24','','10','Yal1',1);
INSERT INTO `sales` (`salesid`,`soldby`,`datesold`,`qty`,`amount`,`itemid`,`status`) VALUES 
 ('Cok220170905063505','katerakeren@yahoo.com','2017-9-05','','60','Cok2',1),
 ('Fan320170905063505','katerakeren@yahoo.com','2017-9-05','','70','Fan3',1),
 ('shi420170905063505','katerakeren@yahoo.com','2017-9-05','','100','shi4',1),
 ('Yal120170905063505','katerakeren@yahoo.com','2017-9-05','','10','Yal1',1),
 ('Cok220170908010912','katerakeren@yahoo.com','2017-9-08','3','60','Cok2',1),
 ('Fan320170908010912','katerakeren@yahoo.com','2017-9-08','','70','Fan3',1),
 ('shi420170908010912','katerakeren@yahoo.com','2017-9-08','','100','shi4',1),
 ('Yal120170908010912','katerakeren@yahoo.com','2017-9-08','','10','Yal1',1);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;


--
-- Definition of table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `staffid` varchar(45) NOT NULL,
  `sname` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `mname` varchar(45) NOT NULL,
  `sex` varchar(45) NOT NULL,
  `dob` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `dod` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `referee` varchar(45) NOT NULL,
  `nkin` varchar(45) NOT NULL,
  `nkaddress` text,
  `qualification` varchar(45) NOT NULL,
  `question` text,
  `answer` varchar(45) DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`staffid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`staffid`,`sname`,`fname`,`mname`,`sex`,`dob`,`phone`,`email`,`dod`,`address`,`referee`,`nkin`,`nkaddress`,`qualification`,`question`,`answer`,`status`) VALUES 
 ('katerakeren@yahoo.com','Lawrence','Ameh','Athanasius','M','1990-08-03','08141703706','katerakeren@yahoo.com','2015-2-01','Anambra.','M. Patrick Obilikwu','Lawrence Augustine',NULL,'Degree','Which course did you perform best in your degree  program?','CMP 315',1);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
