-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 02, 2014 at 12:19 PM
-- Server version: 5.5.38-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rmsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `retailer`
--

CREATE TABLE IF NOT EXISTS `retailer` (
  `retailer_id` int(11) NOT NULL AUTO_INCREMENT,
  `private_key` varchar(256) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`retailer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tier_transaction`
--

CREATE TABLE IF NOT EXISTS `tier_transaction` (
  `tier_transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `tier_user_id` int(11) NOT NULL,
  `new_reward_tier` varchar(45) NOT NULL,
  `tier_transaction_dt` datetime NOT NULL,
  PRIMARY KEY (`tier_transaction_id`),
  KEY `user_id_idx` (`tier_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `retailer_id` int(11) NOT NULL,
  `amount_spent` varchar(45) NOT NULL DEFAULT '0.00',
  `transaction_dt` datetime NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `retailer_id_idx` (`retailer_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address_line_1` varchar(45) DEFAULT NULL,
  `address_line_2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip_code` varchar(45) DEFAULT NULL,
  `birth_date` varchar(45) DEFAULT NULL,
  `role` varchar(45) NOT NULL DEFAULT 'member',
  `reward_points` varchar(45) NOT NULL DEFAULT '0',
  `reward_tier` varchar(45) DEFAULT 'value',
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `cc_number` varchar(45) DEFAULT NULL,
  `cc_expire` varchar(45) DEFAULT NULL,
  `cc_cvv` varchar(45) DEFAULT NULL,
  `activation` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `address_line_1`, `address_line_2`, `city`, `state`, `zip_code`, `birth_date`, `role`, `reward_points`, `reward_tier`, `email`, `password`, `cc_number`, `cc_expire`, `cc_cvv`, `activation`) VALUES
(1, 'Nathan', 'Feeser', '123 here street', '', 'port orange', 'fl', NULL, '10/26/1988', 'member', '0', 'extreme', 'feesern@erau.edu', 'e5a691f52123a146c5454434c255d2bf5a6745e9', 'c3d3529b3702a01246bfddd7dc39305b0cb83738', '10/17', '888', NULL),
(2, 'booga', 'booga', '748 this st', '', 'port orange', 'fl', NULL, '10/26/1988', 'member', '0', 'pro', 'test@test.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '8e8062409c1877e0309b75d68eabda2644406262', '10/16', '555', NULL),
(3, 'booga', 'Feeser', '122 there st', '', 'daytona', 'fl', NULL, '10/26/1988', 'member', '0', 'pro', 'testing@test.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '8e8062409c1877e0309b75d68eabda2644406262', '10/16', '999', NULL),
(4, 'booga', 'Feeser', '123 this street', '', 'daytona', 'fl', NULL, '10/26/1988', 'member', '0', 'beginner', 'testl@test.com', '4a0a19218e082a343a1b17e5333409af9d98f0f5', '8e8062409c1877e0309b75d68eabda2644406262', '10/16', '555', NULL),
(5, 'Nathan', 'Feeser', '123 This Street', '', 'Port', 'FL', NULL, '10/26/1988', 'member', '0', 'pro', 't', '8efd86fb78a56a5145ed7739dcb00c78581c5375', 'c3d3529b3702a01246bfddd7dc39305b0cb83738', '10/2014', '888', NULL),
(6, 'Nathan', 'Feeser', '748 this st', '', 'port orange', 'fl', NULL, '10/26/1988', 'member', '0', 'beginner', 't@t.com', 'a0f1490a20d0211c997b44bc357e1972deab8ae3', '8e8062409c1877e0309b75d68eabda2644406262', '10/16', '888', NULL),
(7, 'Nathan', 'Feeser', '748 this st', '', 'port orange', 'fl', NULL, '10/26/1988', 'member', '0', 'basic', 'too@t.com', '3c363836cf4e16666669a25da280a1865c2d2874', '8e8062409c1877e0309b75d68eabda2644406262', '10/16', '555', NULL),
(8, 'Nathan', 'Feeser', 't', 't', 't', 't', NULL, 't', 'member', '0', 'basic', 'too@too.com', 'e9d71f5ee7c92d6dc9e92ffdad17b8bd49418f98', '8efd86fb78a56a5145ed7739dcb00c78581c5375', 't', 't', NULL),
(9, 'booga', 'Feeser', '123 this street', '', 'port orange', 'IN', NULL, '10/26/1988', 'member', '0', 'pro', 'oo@oop.com', '3f76207183ce12fe9f1cd1b98a97d18db6b43942', '8e8062409c1877e0309b75d68eabda2644406262', '10/16', '555', NULL),
(10, 'booga', 'Feeser', '122 there st', '', 'daytona', 'AL', NULL, '09/22/2014', 'member', '0', 'beginner', 'hi@hi.com', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', '8e8062409c1877e0309b75d68eabda2644406262', '10/16', '555', NULL),
(11, 'booga', 'Feeser', '122 there st', '', 'port orange', 'AL', NULL, '09/24/2014', 'member', '0', 'basic', 'hey@hey.com', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', '8e8062409c1877e0309b75d68eabda2644406262', '10/12', '888', NULL),
(12, 'Nathan', 'booga', '122 there st', '', 'port orange', 'AL', NULL, '09/21/2014', 'member', '0', 'basic', 'wo@wo.com', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', '8e8062409c1877e0309b75d68eabda2644406262', '10/2016', '888', NULL),
(13, 'Last', 'Test', '123 last test road', '', 'Last Test', 'KS', NULL, '09/05/1988', 'member', '0', 'pro', 'last@test.com', 'c0c7a87fe928489872b5617af16211b7a44273b3', '833745cc8bf995fe884e7e7711f189683fac7120', '10/16', '862', NULL),
(14, 'Rashmi', 'Raskar', '790 Fentress Blvd TEST1', 'APT 1000', 'Daytona Beach', 'FL', '32114', '09/04/2014', 'member', '0', 'basic', 'abc@abc.com', '6367c48dd193d56ea7b0baad25b19455e529f5ee', '4ae1ea0c9cddc8bb820fa66088d00df698ab941c', '10/15', '234', NULL),
(15, 'Nathan', 'Feeser', '1506 Deer Springs Road', '', 'Port Orange', 'FL', NULL, '10/26/1988', 'member', '0', 'pro', 'test@woo.com', 'e2e3f1f24cbc439f8c1ba9b08f9954237d64be64', '8e8062409c1877e0309b75d68eabda2644406262', '10/2015', '531', NULL),
(16, 'David', 'Gluch', '123 This Street', '', 'Daytona', 'SC', NULL, '11/09/1966', 'member', '0', 'beginner', 'fnkjdnflkj@erau.edu', 'ebe234643d414d7b905cb57e3601d8951455be69', '8e8062409c1877e0309b75d68eabda2644406262', '10/2014', '888', NULL),
(17, 'Nathan', 'Feeser', '123 Here Street', '', 'Port Orange', 'FL', NULL, '09/15/1910', 'member', '0', 'extreme', 'hello@hey.com', 'dca7fce5d6f4a92446e222bb4fe26225986aafa4', '8e8062409c1877e0309b75d68eabda2644406262', '10/17', '888', NULL),
(18, 'Nathan', 'Feeser', '123 here st', '', 'Port Orange', 'AR', '32116', '10/14/2014', 'member', '0', 'pro', 'f@f.com', '2b472568deac272fcd9112b5c51880f0ac443d1c', '020c4877362530fccadf006a858f56ee9637177d', '10/2015', '888', NULL),
(19, 'Nathan', 'Feeser', '123 This Street', '', 'Port Orange', 'AR', '32129', '10/06/2014', 'member', '0', 'extreme', 'nath@nathan.com', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', 'bcdcab37d4c01c6f4b5ee2a637237e9bd0aba422', '10/2016', '888', NULL),
(20, 'Nathan', 'Feeser', '123 This Street', '', 'Port Orange', 'CO', '32129', '10/28/2014', 'member', '0', 'platinum', 'nathanfeeser@gmail.com', 'dca7fce5d6f4a92446e222bb4fe26225986aafa4', '6a9a2a97836dac565211b67883ec2327b07e9058', '10/2017', '888', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tier_transaction`
--
ALTER TABLE `tier_transaction`
  ADD CONSTRAINT `tier_user_id` FOREIGN KEY (`tier_user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `retailer_id` FOREIGN KEY (`retailer_id`) REFERENCES `retailer` (`retailer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
