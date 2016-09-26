<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: baijiacms <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');
defined('LOCK_TO_ADDONS_INSTALL') or exit('Access Denied');
$sql = "
-- ----------------------------
-- Table structure for baijiacms_addon7_award
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_addon7_award` (
  `beid` int(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `endtime` int(10) NOT NULL,
  `awardtype` int(1) NOT NULL DEFAULT '0',
  `gold` decimal(10,2) NOT NULL DEFAULT '0.00',
  `credit_cost` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '100',
  `content` text NOT NULL,
  `createtime` int(10) NOT NULL,
  `deleted` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_addon7_award
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_addon7_config
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_addon7_config` (
  `beid` int(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_addon7_config
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_addon7_request
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_addon7_request` (
  `beid` int(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `award_id` int(10) unsigned NOT NULL,
  `status` int(5) NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

delete from `baijiacms_modules` where `name`='addon7';
delete from `baijiacms_modules_menu` where `module`='addon7';
INSERT INTO `baijiacms_modules` (`icon`,`group`,`title`,`version`,`name`) VALUES ('icon-money', 'addons', '积分兑换', '1.0', 'addon7');
INSERT INTO `baijiacms_modules_menu`(`href`,`title`,`module`) VALUES ('index.php?mod=site&name=addon7&do=setting', '参数设置', 'addon7');
INSERT INTO `baijiacms_modules_menu`(`href`,`title`,`module`) VALUES ('index.php?mod=site&name=addon7&do=addaward', '添加积分商品', 'addon7');
INSERT INTO `baijiacms_modules_menu`(`href`,`title`,`module`) VALUES ('index.php?mod=site&name=addon7&do=awardlist', '积分商品列表', 'addon7');
INSERT INTO `baijiacms_modules_menu`(`href`,`title`,`module`) VALUES ('index.php?mod=site&name=addon7&do=applyed', '兑换申请列表', 'addon7');
";

mysqld_batch($sql);