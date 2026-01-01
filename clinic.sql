-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: Jun 06, 2011, 03:51 PM
-- 伺服器版本: 6.0.4
-- PHP 版本: 6.0.0-dev

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `clinic`
-- 
CREATE DATABASE `clinic` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `clinic`;

-- --------------------------------------------------------

-- 
-- 資料表格式： `grade`
-- 

CREATE TABLE `registration` (
  `timestamp` DATETIME NOT NULL,
  `student_id` VARCHAR(10) NOT NULL,
  `student_name` VARCHAR(20) NOT NULL,
  `temperature` DECIMAL(4,1),
  `fever` VARCHAR(5),
  PRIMARY KEY (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 
-- 列出以下資料庫的數據： `grade`
-- 
INSERT INTO `registration` VALUES ('2025-12-28 14:00:00','A8608001','JP',37.5,'');
INSERT INTO `registration` VALUES ('2025-12-28 14:05:00','A8608002','Horng',38.2,'');
INSERT INTO `registration` VALUES ('2025-12-28 14:10:00','A8608003','POLK',36.7,'');
INSERT INTO `registration` VALUES ('2025-12-28 14:15:00','A8608004','Horng',37.0,'');
INSERT INTO `registration` VALUES ('2025-12-28 14:20:00','A8608005','JP',36.9,'');