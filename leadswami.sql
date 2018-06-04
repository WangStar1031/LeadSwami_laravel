# Host: localhost  (Version 5.5.5-10.1.26-MariaDB)
# Date: 2018-06-04 17:32:00
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "billhistory"
#

DROP TABLE IF EXISTS `billhistory`;
CREATE TABLE `billhistory` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) DEFAULT NULL,
  `BillDate` date DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Amount` double DEFAULT NULL,
  `ExpDate` date DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for table "billing"
#

DROP TABLE IF EXISTS `billing`;
CREATE TABLE `billing` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) DEFAULT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `TaxVatId` varchar(255) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `ZipCode` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `State` varchar(255) DEFAULT NULL,
  `StripeCardNumber` varchar(255) DEFAULT NULL,
  `ExpirationDate` date DEFAULT NULL,
  `PromoCode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for table "coupons"
#

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) DEFAULT NULL,
  `LastPendingDate` date DEFAULT NULL,
  `RemainingCount` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for table "profiles"
#

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Headline` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Url` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `ImgUrl` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(255) DEFAULT NULL,
  `LastJob` varchar(255) DEFAULT NULL,
  `Twitter` varchar(255) DEFAULT NULL,
  `Site` varchar(255) DEFAULT NULL,
  `Tag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `SurName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `RndPass` varchar(255) DEFAULT NULL,
  `Industry` varchar(255) DEFAULT NULL,
  `Headline` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `ProfilePicUrl` varchar(255) DEFAULT NULL,
  `PublicUrl` varchar(255) DEFAULT NULL,
  `ConnectionCount` int(10) DEFAULT NULL,
  `Position` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
