-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2017 at 08:24 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cs4400`
--

-- --------------------------------------------------------

--
-- Table structure for table `city_official`
--

CREATE TABLE IF NOT EXISTS `city_official` (
  `Username` varchar(320) NOT NULL,
  `Title` varchar(20) NOT NULL,
  `Approved` tinyint(4) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  PRIMARY KEY (`Username`),
  KEY `City` (`City`,`State`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_official`
--

INSERT INTO `city_official` (`Username`, `Title`, `Approved`, `City`, `State`) VALUES
('ABHISHEK', 'Chief Constable', 1, 'Atlanta', 'GA'),
('ADRIANNA', 'Dog Catcher', 1, 'Atlanta', 'GA'),
('AIDAN', 'Posse Member 1', 2, 'Atlanta', 'GA'),
('ANUNOY', 'Posse Member 2', 2, 'Atlanta', 'GA'),
('EMILY', 'Posse Member 4', 0, 'Atlanta', 'GA'),
('GABRIELLE ', 'Posse Member 5', 0, 'Atlanta', 'GA'),
('HANNAH', 'Deputy Mayor', 1, 'Atlanta', 'GA'),
('JACQUELYN', 'Sheriff', 1, 'Atlanta', 'GA'),
('KEVIN', 'Mayor', 1, 'Atlanta', 'GA'),
('PRIT', 'Posse Member 3', 2, 'Atlanta', 'GA');

-- --------------------------------------------------------

--
-- Table structure for table `city_state`
--

CREATE TABLE IF NOT EXISTS `city_state` (
  `City` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  PRIMARY KEY (`City`,`State`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_state`
--

INSERT INTO `city_state` (`City`, `State`) VALUES
('Atlanta', 'GA'),
('Austin', 'TX'),
('Charlotte', 'NC'),
('Chicago', 'IL'),
('Columbus', 'OH'),
('Dallas', 'TX'),
('Denver', 'CO'),
('El Paso', 'TX'),
('Fort Worth', 'TX'),
('Houston', 'TX'),
('Indianapolis', 'IN'),
('Jacksonville', 'FL'),
('Los Angeles', 'CA'),
('New York', 'NY'),
('Philadelphia', 'PA'),
('Phoenix', 'AZ'),
('San Antonio', 'TX'),
('San Diego', 'CA'),
('San Francisco', 'CA'),
('San Jose', 'CA'),
('Seattle', 'WA');

-- --------------------------------------------------------

--
-- Table structure for table `data_point`
--

CREATE TABLE IF NOT EXISTS `data_point` (
  `Name` varchar(20) NOT NULL,
  `Date_Recorded` datetime NOT NULL,
  `Data_Value` int(11) NOT NULL,
  `Data_Type` varchar(11) NOT NULL,
  `Accepted` tinyint(4) NOT NULL,
  PRIMARY KEY (`Name`,`Date_Recorded`),
  KEY `Name` (`Name`),
  KEY `Data_Type` (`Data_Type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_point`
--

INSERT INTO `data_point` (`Name`, `Date_Recorded`, `Data_Value`, `Data_Type`, `Accepted`) VALUES
('Connors School', '2017-01-29 00:00:00', 100, 'Air Quality', 1),
('Connors School', '2017-01-31 00:00:00', 7, 'Air Quality', 1),
('Connors School', '2017-02-01 00:00:00', 8, 'Air Quality', 1),
('Connors School', '2017-02-02 00:00:00', 9, 'Air Quality', 1),
('Connors School', '2017-02-03 00:00:00', 10, 'Air Quality', 1),
('Emory', '2017-01-29 15:32:00', 12, 'Air Quality', 1),
('Emory', '2017-02-04 00:00:00', 11, 'Air Quality', 1),
('Emory', '2017-02-05 00:00:00', 12, 'Air Quality', 1),
('Emory', '2017-02-06 00:00:00', 13, 'Mold', 1),
('Emory', '2017-02-07 00:00:00', 14, 'Air Quality', 1),
('Georgia Tech', '2017-02-26 00:00:00', 33, 'Mold', 1),
('Georgia Tech', '2017-02-27 00:00:00', 34, 'Mold', 1),
('Georgia Tech', '2017-02-28 00:00:00', 35, 'Air Quality', 1),
('Georgia Tech', '2017-03-01 00:00:00', 36, 'Air Quality', 1),
('GSU', '2017-01-30 00:00:00', 6, 'Air Quality', 1),
('GSU', '2017-02-08 00:00:00', 15, 'Mold', 1),
('GSU', '2017-02-09 00:00:00', 16, 'Air Quality', 1),
('GSU', '2017-02-10 00:00:00', 17, 'Mold', 1),
('GSU', '2017-02-11 00:00:00', 18, 'Mold', 1),
('Roberas House', '2017-01-30 03:57:00', 34, 'Air Quality', 1),
('Roberas House', '2017-02-12 00:00:00', 19, 'Mold', 1),
('Roberas House', '2017-02-13 00:00:00', 20, 'Mold', 1),
('Roberas House', '2017-02-13 16:12:00', 42, 'Mold', 1),
('Roberas House', '2017-02-14 00:00:00', 21, 'Mold', 1),
('Robs Old Home', '2017-02-15 00:00:00', 22, 'Mold', 1),
('Robs Old Home', '2017-02-16 00:00:00', 23, 'Mold', 1),
('Robs Old Home', '2017-02-17 00:00:00', 24, 'Mold', 1),
('Robs Old Home', '2017-02-18 00:00:00', 25, 'Mold', 1),
('Sandeeps House', '2017-02-19 00:00:00', 26, 'Mold', 1),
('Sandeeps House', '2017-02-20 00:00:00', 27, 'Mold', 1),
('Sandeeps House', '2017-02-21 00:00:00', 28, 'Mold', 1),
('Sandeeps House', '2017-02-22 00:00:00', 29, 'Mold', 1),
('Uchicago', '2017-01-28 00:00:00', 4, 'Mold', 1),
('Uchicago', '2017-02-22 04:29:00', 4, 'Air Quality', 1),
('Uchicago', '2017-02-23 00:00:00', 30, 'Mold', 1),
('Uchicago', '2017-02-24 00:00:00', 31, 'Mold', 1),
('UGA', '2017-01-25 00:00:00', 1, 'Mold', 1),
('UGA', '2017-01-26 00:00:00', 2, 'Mold', 1),
('UGA', '2017-01-27 00:00:00', 3, 'Mold', 1),
('UGA', '2017-02-25 00:00:00', 32, 'Mold', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_type`
--

CREATE TABLE IF NOT EXISTS `data_type` (
  `Data_Type` varchar(11) NOT NULL,
  PRIMARY KEY (`Data_Type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_type`
--

INSERT INTO `data_type` (`Data_Type`) VALUES
('Air Quality'),
('Mold');

-- --------------------------------------------------------

--
-- Table structure for table `poi`
--

CREATE TABLE IF NOT EXISTS `poi` (
  `Name` varchar(255) NOT NULL,
  `Flag` tinyint(4) NOT NULL,
  `Date_Flagged` date NOT NULL,
  `Zip_Code` int(11) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  PRIMARY KEY (`Name`),
  KEY `City` (`City`,`State`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poi`
--

INSERT INTO `poi` (`Name`, `Flag`, `Date_Flagged`, `Zip_Code`, `City`, `State`) VALUES
('Connors House', 0, '0000-00-00', 30548, 'Atlanta', 'GA'),
('Connors School', 0, '0000-00-00', 30019, 'Atlanta', 'GA'),
('Emory', 0, '0000-00-00', 30322, 'Atlanta', 'GA'),
('Georgia Tech', 1, '0000-00-00', 30332, 'Atlanta', 'GA'),
('GSU', 0, '0000-00-00', 30303, 'Atlanta', 'GA'),
('Roberas House', 0, '0000-00-00', 31324, 'Atlanta', 'GA'),
('Robs Old Home', 0, '0000-00-00', 93436, 'Los Angeles', 'CA'),
('Sandeeps House', 0, '0000-00-00', 31407, 'Atlanta', 'GA'),
('Uchicago', 1, '0000-00-00', 60637, 'Chicago', 'IL'),
('UGA', 1, '0000-00-00', 30602, 'Atlanta', 'GA');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Username` varchar(15) NOT NULL,
  `Email_Address` varchar(320) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `User_Type` enum('Admin','City_Official','City_Scientist') NOT NULL,
  PRIMARY KEY (`Username`),
  UNIQUE KEY `EmailAddress` (`Email_Address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Username`, `Email_Address`, `Password`, `User_Type`) VALUES
('ABHISHEK', 'jcheek32@gatech.edu', 'abcdefg', 'City_Official'),
('admin', 'admin@gatech.edu', 'admin', 'Admin'),
('ADRIANNA', 'acho34@gatech.edu', 'abcdefg', 'City_Official'),
('ADYA', 'aklassen3@gatech.edu', 'abcdefg', 'City_Scientist'),
('AIDAN', 'schua8@gatech.edu', 'abcdefg', 'City_Official'),
('ANUNOY', 'ndeshpande36@gatech.edu', 'abcdefg', 'City_Official'),
('CLAYTON', 'smehta83@gatech.edu', 'abcdefg', 'City_Scientist'),
('Connor', 'cshiver6@gatech.edu', 'abcdefg', 'Admin'),
('EMILY', 'jgeorge74@gatech.edu', 'abcdefg', 'City_Official'),
('GABRIELLE ', 'ggusmerotti3@gatech.edu', 'abcdefg', 'City_Official'),
('HANNAH', 'abrady30@gatech.edu', 'abcdefg', 'City_Official'),
('JACOB', 'akhandal3@gatech.edu', 'abcdefg', 'City_Scientist'),
('JACQUELYN', 'icampbell37@gatech.edu', 'abcdefg', 'City_Official'),
('JOHN', 'mmay39@gatech.edu', 'abcdefg', 'City_Scientist'),
('JOSH', 'akent6@gatech.edu', 'abcdefg', 'City_Scientist'),
('KEVIN', 'abernardo6@gatech.edu', 'abcdefg', 'City_Official'),
('Marcellus', 'mpleasant3@gatech.edu', 'abcdefg', 'Admin'),
('MASON ', 'amodi35@gatech.edu', 'abcdefg', 'City_Scientist'),
('PRIT', 'adussa3@gatech.edu', 'abcdefg', 'City_Official'),
('Robera', 'rdjalleta3@gatech.edu', 'abcdefg', 'Admin'),
('SAHAS', 'ohan6@gatech.edu', 'abcdefg', 'City_Scientist'),
('Sandeep', 'sbethapudi6@gatech.edu', 'abcdefg', 'Admin'),
('SEAN', 'mheim6@gatech.edu', 'abcdefg', 'City_Scientist'),
('SETH', 'jtlv3@gatech.edu', 'abcdefg', 'City_Scientist'),
('SHASHVAT', 'jkuwabara3@gatech.edu', 'abcdefg', 'City_Scientist');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city_official`
--
ALTER TABLE `city_official`
  ADD CONSTRAINT `city_official_ibfk_1` FOREIGN KEY (`City`, `State`) REFERENCES `city_state` (`City`, `State`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `city_off_must_be_user` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_point`
--
ALTER TABLE `data_point`
  ADD CONSTRAINT `data_type` FOREIGN KEY (`Data_Type`) REFERENCES `data_type` (`Data_Type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `name` FOREIGN KEY (`Name`) REFERENCES `poi` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poi`
--
ALTER TABLE `poi`
  ADD CONSTRAINT `poi_ibfk_1` FOREIGN KEY (`City`, `State`) REFERENCES `city_state` (`City`, `State`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
