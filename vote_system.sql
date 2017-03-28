/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : vote_system

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-03-20 22:44:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for option
-- ----------------------------
DROP TABLE IF EXISTS `option`;
CREATE TABLE `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_id` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `number` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of option
-- ----------------------------
INSERT INTO `option` VALUES ('1', '1', 'Go语言', 'null', '1');
INSERT INTO `option` VALUES ('2', '1', 'Linux', '20170226\\cc95a43b36e351ef26a05a9e688e4165.jpg', '1');
INSERT INTO `option` VALUES ('3', '1', 'null0_', '20170226\\dd16d448b7c54287cb81ca4a73b987af.png', '0');
INSERT INTO `option` VALUES ('4', '2', 'Go语言', 'null', '0');
INSERT INTO `option` VALUES ('5', '2', 'Linux', '20170226\\719fdd5c832c5fb23181c388e32cbad8.jpg', '0');
INSERT INTO `option` VALUES ('6', '2', 'null0_', '20170226\\ab32d3857a06ba036bb7453d1dd4e0fb.png', '0');

-- ----------------------------
-- Table structure for option_log
-- ----------------------------
DROP TABLE IF EXISTS `option_log`;
CREATE TABLE `option_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log` varchar(255) DEFAULT NULL,
  `op_time` datetime DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of option_log
-- ----------------------------
INSERT INTO `option_log` VALUES ('1', '1', '2017-02-26 14:44:41', 'admin');
INSERT INTO `option_log` VALUES ('2', '2', '2017-02-26 14:44:41', 'admin');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `grade` int(2) DEFAULT NULL,
  `admin` int(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'admin', '4', '1');

-- ----------------------------
-- Table structure for vote
-- ----------------------------
DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `introduction` varchar(255) DEFAULT NULL,
  `grade` int(2) DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `anonymity` int(2) DEFAULT NULL,
  `vote_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vote
-- ----------------------------
INSERT INTO `vote` VALUES ('1', 'admin', '2017/2/26', '投票介绍', '2', '2017-02-26 14:50:00', '2017-02-26 14:43:42', '0', '2');
INSERT INTO `vote` VALUES ('2', 'admin', '2017/2/26_2', '投票介绍', '1', '2017-02-26 16:00:00', '2017-02-26 14:46:25', '1', '1');

-- ----------------------------
-- Table structure for vote_log
-- ----------------------------
DROP TABLE IF EXISTS `vote_log`;
CREATE TABLE `vote_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_time` datetime DEFAULT NULL,
  `log` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vote_log
-- ----------------------------
INSERT INTO `vote_log` VALUES ('1', '2017-02-26 14:44:41', '1', 'admin');
