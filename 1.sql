-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.5.42-log - Source distribution
-- 服务器操作系统:                      Linux
-- HeidiSQL 版本:                  9.3.0.5009
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出 lg01.com 的数据库结构
CREATE DATABASE IF NOT EXISTS `lg01.com` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `lg01.com`;


-- 导出  表 lg01.com.one_message 结构
CREATE TABLE IF NOT EXISTS `one_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_toid` int(11) NOT NULL DEFAULT '0' COMMENT '标识（复制时候会记录原ID）',
  `user_id` int(11) NOT NULL COMMENT '所属用户ID',
  `title` varchar(50) NOT NULL COMMENT '留言主题',
  `name` varchar(10) NOT NULL COMMENT '联系人',
  `tel` char(15) NOT NULL COMMENT '联系电话',
  `address` varchar(255) DEFAULT NULL COMMENT '联系地址',
  `content` text NOT NULL COMMENT '留言内容',
  `add_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '添加IP',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='留言记录表';

-- 正在导出表  lg01.com.one_message 的数据：~2 rows (大约)
DELETE FROM `one_message`;
/*!40000 ALTER TABLE `one_message` DISABLE KEYS */;
INSERT INTO `one_message` (`message_id`, `message_toid`, `user_id`, `title`, `name`, `tel`, `address`, `content`, `add_ip`, `add_time`, `update_time`, `status`) VALUES
	(1, 0, 1, '我要咨询', '申龙彪', '13718038477', '', '对你们项目感兴趣，请和我联系', 3232236033, 1468595473, 1468595473, 0),
	(2, 0, 1, '我要咨询222', '申龙彪', '13718038477', '水水水水水水水水水水水', '对你们杀杀杀项目感兴趣，请和我联系', 3232236033, 1468595526, 1468595526, 0);
/*!40000 ALTER TABLE `one_message` ENABLE KEYS */;


-- 导出  表 lg01.com.one_user 结构
CREATE TABLE IF NOT EXISTS `one_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `nickname` varchar(50) NOT NULL COMMENT '昵称',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户分类 1.企业用户 2. 超级管理员',
  `mobile` char(15) NOT NULL DEFAULT '' COMMENT '用户手机',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `login` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- 正在导出表  lg01.com.one_user 的数据：1 rows
DELETE FROM `one_user`;
/*!40000 ALTER TABLE `one_user` DISABLE KEYS */;
INSERT INTO `one_user` (`id`, `username`, `password`, `email`, `nickname`, `type`, `mobile`, `reg_time`, `reg_ip`, `login`, `last_login_time`, `last_login_ip`, `update_time`, `status`) VALUES
	(1, 'admin', 'e4fca1d27be55fe5f8b6ea9959b3bcb2', '335028959@qq.com', '管理员', 2, '', 1468419608, 3232236033, 33, 1468594799, 3232236033, 1468419608, 1);
/*!40000 ALTER TABLE `one_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
