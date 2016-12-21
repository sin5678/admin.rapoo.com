/*
SQLyog Ultimate v11.27 (64 bit)
MySQL - 5.6.21 : Database - xirodrone.com
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`xirodrone.com` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `xirodrone.com`;

/*Table structure for table `co_admins` */

DROP TABLE IF EXISTS `co_admins`;

CREATE TABLE `co_admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `real_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `client_ip` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_account_unique` (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `co_admins` */

/*Table structure for table `co_categories` */

DROP TABLE IF EXISTS `co_categories`;

CREATE TABLE `co_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类上级id',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类等级',
  `title` varchar(255) NOT NULL COMMENT '分类名字',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '别名',
  `note` varchar(255) NOT NULL DEFAULT '' COMMENT '注释内容',
  `description` mediumtext NOT NULL COMMENT '分类的描述',
  `published` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1发布 0未发布',
  `params` text NOT NULL COMMENT '序列化其他参数',
  `meta_keywords` varchar(255) NOT NULL COMMENT '页面关键字',
  `meta_desc` varchar(255) NOT NULL COMMENT '页面描述',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建人id',
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改人id',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `lang` char(7) NOT NULL COMMENT '语言缩写',
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`published`),
  KEY `idx_alias` (`alias`),
  KEY `idx_language` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `co_categories` */

/*Table structure for table `co_content` */

DROP TABLE IF EXISTS `co_content`;

CREATE TABLE `co_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '题目',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '别名',
  `contents` mediumtext NOT NULL COMMENT '内容',
  `state` tinyint(3) NOT NULL DEFAULT '0' COMMENT '文章状态',
  `cat_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建人id',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改人id',
  `publish` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1发布 0未发布',
  `img` varchar(255) NOT NULL COMMENT '图片名字',
  `url` varchar(255) NOT NULL COMMENT '文章连接url',
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `meta_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '页面关键字',
  `meta_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '页面描述',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `lang` char(2) NOT NULL COMMENT '语言的缩写',
  PRIMARY KEY (`id`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`cat_id`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`cat_id`),
  KEY `idx_language` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `co_content` */

/*Table structure for table `co_feedback` */

DROP TABLE IF EXISTS `co_feedback`;

CREATE TABLE `co_feedback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `real_name` char(60) DEFAULT NULL COMMENT '名字',
  `tel` char(30) DEFAULT NULL COMMENT '电话',
  `qq` char(30) DEFAULT NULL COMMENT 'qq',
  `message` char(255) DEFAULT NULL COMMENT '反馈信息',
  `created_date` datetime DEFAULT NULL COMMENT '创建时间',
  `reply_date` datetime DEFAULT NULL COMMENT '回复时间',
  `reply_contents` char(255) DEFAULT NULL COMMENT '回复内容',
  `notes` char(255) DEFAULT NULL COMMENT '注释',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `co_feedback` */

/*Table structure for table `co_form_activity` */

DROP TABLE IF EXISTS `co_form_activity`;

CREATE TABLE `co_form_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ordering` int(11) NOT NULL COMMENT '排序',
  `state` tinyint(1) NOT NULL COMMENT '状态',
  `created_by` int(11) NOT NULL COMMENT '创建人id',
  `person_team_name` char(255) NOT NULL COMMENT '个人/团队名字',
  `order_id` int(33) NOT NULL COMMENT '订单号',
  `telphone` char(255) NOT NULL COMMENT '电话',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `email` char(255) NOT NULL COMMENT 'E-Mail',
  `post_url` char(255) NOT NULL COMMENT '发帖url',
  `video_url` char(255) NOT NULL COMMENT '视频url',
  `work_explain` varchar(1000) NOT NULL COMMENT '作品描述',
  `ctime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

/*Data for the table `co_form_activity` */

/*Table structure for table `co_lang` */

DROP TABLE IF EXISTS `co_lang`;

CREATE TABLE `co_lang` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `lang` char(2) NOT NULL COMMENT '语言',
  `state` enum('1','0') NOT NULL DEFAULT '0' COMMENT '语言状态',
  `img` char(100) DEFAULT NULL COMMENT '语言img名字或路径',
  `level` int(7) DEFAULT NULL COMMENT '等级排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `co_lang` */

/*Table structure for table `co_migrations` */

DROP TABLE IF EXISTS `co_migrations`;

CREATE TABLE `co_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `co_migrations` */

insert  into `co_migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_07_20_070634_create_admins_table',2),('2015_07_20_030903_entrust_setup_tables',3);

/*Table structure for table `co_password_resets` */

DROP TABLE IF EXISTS `co_password_resets`;

CREATE TABLE `co_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `co_password_resets` */

/*Table structure for table `co_permission_role` */

DROP TABLE IF EXISTS `co_permission_role`;

CREATE TABLE `co_permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `co_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `co_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `co_permission_role` */

/*Table structure for table `co_permissions` */

DROP TABLE IF EXISTS `co_permissions`;

CREATE TABLE `co_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `co_permissions` */

/*Table structure for table `co_role_admin` */

DROP TABLE IF EXISTS `co_role_admin`;

CREATE TABLE `co_role_admin` (
  `admin_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`admin_id`,`role_id`),
  KEY `role_admin_role_id_foreign` (`role_id`),
  CONSTRAINT `role_admin_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `co_admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_admin_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `co_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `co_role_admin` */

/*Table structure for table `co_roles` */

DROP TABLE IF EXISTS `co_roles`;

CREATE TABLE `co_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `co_roles` */

/*Table structure for table `co_subscribe` */

DROP TABLE IF EXISTS `co_subscribe`;

CREATE TABLE `co_subscribe` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` char(60) NOT NULL COMMENT 'E-Mail',
  `created_date` datetime NOT NULL COMMENT '创建时间',
  `notes` char(100) DEFAULT NULL COMMENT '注释',
  `lang` char(10) DEFAULT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `co_subscribe` */

/*Table structure for table `co_users` */

DROP TABLE IF EXISTS `co_users`;

CREATE TABLE `co_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(150) NOT NULL DEFAULT '' COMMENT '昵称',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT 'E-Mail',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT '密码',
  `real_name` varchar(100) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `block` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1解锁 0锁定',
  `send_email` tinyint(4) NOT NULL DEFAULT '0' COMMENT '发送email给用户',
  `register_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  `lastest_visit_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '上次登录时间',
  `activation_code` varchar(100) NOT NULL DEFAULT '' COMMENT '激活码',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '电话',
  `gender` enum('male','famale','unspecified') NOT NULL DEFAULT 'unspecified' COMMENT '性别',
  `avatar` varchar(200) NOT NULL DEFAULT '' COMMENT '头像',
  `client_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '客户ip',
  `remember_token` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL COMMENT '备用参数',
  PRIMARY KEY (`id`),
  KEY `idx_block` (`block`),
  KEY `username` (`account`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `co_users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
