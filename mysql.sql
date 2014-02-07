-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014-01-31 02:49:12
-- 服务器版本: 5.5.35-0ubuntu0.13.10.1
-- PHP 版本: 5.5.3-1ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `qsc_music`;
USE qsc_music;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `qsc_music`
--

-- --------------------------------------------------------

--
-- 表的结构 `music`
--

CREATE TABLE IF NOT EXISTS `music` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `clientName` char(20) NOT NULL,
  `uploadDate` date DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `votes` int(11) DEFAULT '0',
  `userName` varchar(30) NOT NULL,
  `nickName` varchar(30) NOT NULL,
  `styleId` int(2) NOT NULL,
  `musicName` varchar(30) NOT NULL,
  `ifPerformance` int(1) NOT NULL,
  `description` varchar(600) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


--
-- 表的结构 `style`
--

CREATE TABLE IF NOT EXISTS `style` (
  `styleId` int(11) NOT NULL AUTO_INCREMENT,
  `styleName` varchar(20) NOT NULL,
  `styleNameEn` varchar(20) NOT NULL,
  PRIMARY KEY (`styleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `style`
--

INSERT INTO `style` (`styleId`, `styleName`, `styleNameEn`) VALUES
(1, '流行', 'Pop'),
(2, '摇滚', 'Rock'),
(3, '民谣', 'Folk'),
(4, '电子', 'Electronic'),
(5, '节奏布鲁斯', 'R&B'),
(6, '爵士', 'Jazz'),
(7, '说唱', 'Hip Hop'),
(8, '金属', 'Metal'),
(9, '古典', 'Classical Music'),
(10, '轻音乐', 'Easy Listening'),
(11, '雷鬼', 'Reggae'),
(12, '拉丁', 'Latin'),
(13, '乡村', 'Country');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `userName` char(20) NOT NULL,
  `uploadTimes` int(11) DEFAULT '0',
  `nickName` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(23) NOT NULL,
  `selfIntro` varchar(200) NOT NULL,
  `tel1` int(30) NOT NULL,
  `tel2` int(30) NOT NULL,
  `qq` int(20) NOT NULL,
  `schoolId` int(2) NOT NULL,
  `emailAddress` varchar(30) NOT NULL,
  `wechat` varchar(20) NOT NULL,
  `ifOpen` int(2) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;


-- --------------------------------------------------------

--
-- 表的结构 `votelist`
--

CREATE TABLE IF NOT EXISTS `votelist` (
  `uid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  PRIMARY KEY (`uid`,`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

