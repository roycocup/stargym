/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50144
 Source Host           : localhost
 Source Database       : stargym

 Target Server Type    : MySQL
 Target Server Version : 50144
 File Encoding         : utf-8

 Date: 02/10/2012 19:22:35 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `images`
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_path` varchar(250) NOT NULL,
  `image_name` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `members`
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(250) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `next_payment_date` date DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `members`
-- ----------------------------
BEGIN;
INSERT INTO `members` VALUES ('2', 'Rodrigo-Dias-trepeiro', 'Rodrigo', 'Dias', 'trepeiro', 'rodrigo.pitta@gmail.com', '1976-09-01', null, '2012-03-02', '2012-02-01 17:05:35', '2012-02-02 16:35:25'), ('3', 'Douglas-Pitbull-Pitbull', 'Douglas', 'Pitbull', 'Pitbull', '', '1973-12-13', null, null, '2012-02-01 17:59:37', '2012-02-02 16:43:44'), ('4', 'Ozy-Adam-Professor', 'Ozy', 'Adam', 'Professor', '', '1970-01-01', null, '2012-02-01', '2012-02-03 11:20:07', '2012-02-03 11:20:19');
COMMIT;

-- ----------------------------
--  Table structure for `payments`
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `value` int(11) NOT NULL,
  `extras` varchar(255) DEFAULT NULL,
  `extras_value` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `payments`
-- ----------------------------
BEGIN;
INSERT INTO `payments` VALUES ('1', '0', '55', '', null, '2012-02-01 17:26:09', '2012-02-01 17:26:09'), ('3', '2', '50', '', null, '2012-02-02 16:32:33', '2012-02-02 16:32:33'), ('4', '2', '56', '', null, '2012-02-02 16:35:18', '2012-02-02 16:35:18'), ('5', '2', '50', '', null, '2012-02-02 16:35:25', '2012-02-02 16:35:25'), ('6', '4', '70', '', null, '2012-02-03 11:20:19', '2012-02-03 11:20:19');
COMMIT;

-- ----------------------------
--  Table structure for `teachers`
-- ----------------------------
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `facebook` varchar(250) DEFAULT NULL,
  `next_wage_date` date DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `teachers`
-- ----------------------------
BEGIN;
INSERT INTO `teachers` VALUES ('4', 'Marco', 'Canha', null, null, null, null, '2012-02-01 18:28:38', '2012-02-01 18:28:41');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(10) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `wages`
-- ----------------------------
DROP TABLE IF EXISTS `wages`;
CREATE TABLE `wages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` int(10) unsigned NOT NULL,
  `amount` int(20) DEFAULT NULL,
  `payed` int(1) NOT NULL,
  `set_date` date DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  CONSTRAINT `wages_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `wages`
-- ----------------------------
BEGIN;
INSERT INTO `wages` VALUES ('1', '4', '50', '1', '2012-02-01', '2012-02-01 18:41:35', '2012-02-01 18:41:35'), ('2', '4', '56', '1', '2012-02-02', '2012-02-01 18:42:29', '2012-02-01 18:42:29'), ('3', '4', '70', '0', '2012-02-02', '2012-02-01 18:42:44', '2012-02-01 18:42:44');
COMMIT;

