<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');
defined('SYSTEM_INSTALL_IN') or exit('Access Denied');
$sql = "
CREATE TABLE IF NOT EXISTS `baijiacms_bj_tbk_fans` (
  `beid` int(10) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fans_from_user` varchar(50) NOT NULL,
  `share_from_user` varchar(50) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_bj_tbk_fans
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_bj_tbk_good_commission
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_bj_tbk_good_commission` (
  `beid` int(10) NOT NULL,
  `customCommission` int(1) NOT NULL,
  `customCommissionType` int(1) NOT NULL,
  `commission3` int(3) NOT NULL,
  `commission2` int(3) NOT NULL,
  `commission1` int(3) NOT NULL DEFAULT '0',
  `goodid` int(10) NOT NULL,
  PRIMARY KEY (`beid`,`goodid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_bj_tbk_good_commission
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_bj_tbk_member_relect
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_bj_tbk_member_relect` (
  `isdisabled` int(1) NOT NULL DEFAULT '0',
  `beid` int(10) NOT NULL,
  `dzdtitle` varchar(100) NOT NULL,
  `dzdpic` varchar(1000) NOT NULL,
  `isdzd` int(1) NOT NULL DEFAULT '0',
  `dzdsendtext` varchar(100) NOT NULL,
  `updatetime` int(10) NOT NULL DEFAULT '0',
  `commissioned` decimal(10,2) NOT NULL COMMENT '已结佣金',
  `parentid` varchar(50) NOT NULL,
  `alipay_openid` varchar(50) NOT NULL,
  `weixin_openid` varchar(50) NOT NULL,
  `share_action` int(1) NOT NULL DEFAULT '0' COMMENT '何如成为粉丝的0点击关注 1扫码关注',
  `agentlevel` int(2) NOT NULL DEFAULT '0',
  `agenttime` int(10) NOT NULL,
  `isagent` int(2) NOT NULL DEFAULT '0' COMMENT '0非代理1代理',
  `openid` varchar(50) NOT NULL,
  PRIMARY KEY (`beid`,`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_bj_tbk_member_relect
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_bj_tbk_msg_template
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_bj_tbk_msg_template` (
  `beid` int(10) NOT NULL,
  `template` varchar(5000) NOT NULL,
  `tkey` varchar(10) NOT NULL,
  `tenable` tinyint(4) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_bj_tbk_msg_template
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_bj_tbk_order
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_bj_tbk_order` (
 	`is_system` int(1) NOT NULL DEFAULT '0' COMMENT '0为普通商品，1为总部商品',
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `clevel` int(2) NOT NULL DEFAULT '0' COMMENT '订单等级',
  `updatetime` int(10) NOT NULL DEFAULT '0',
  `fhstatus` int(2) NOT NULL DEFAULT '0' COMMENT '0否，1可分佣',
  `gstatus` int(2) NOT NULL DEFAULT '0' COMMENT '0未结算，1开始结算，-1退款中，-2已退款，-2退货中，-3已退货，-4换货中',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '申请状态，-2为标志删除，-1为审核无效，0为未申请，1为正在申请，2为审核通过',
  `checktime` int(10) NOT NULL DEFAULT '0',
  `applytime` int(10) NOT NULL DEFAULT '0',
  `commission` decimal(10,2) NOT NULL DEFAULT '0.00',
  `recommission` decimal(10,2) NOT NULL DEFAULT '0.00',
  `shareid` varchar(50) NOT NULL,
  `orderid` int(10) NOT NULL,
  `ogid` int(10) NOT NULL DEFAULT '0',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL,
  `outgoldinfo` varchar(1000) DEFAULT '0' COMMENT '佣金提款信息1 序列化',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_bj_tbk_order
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_bj_tbk_phb_medal
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_bj_tbk_phb_medal` (
  `beid` int(10) NOT NULL,
  `fans_count` int(11) DEFAULT NULL,
  `medal_name` varchar(50) DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_bj_tbk_phb_medal
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_bj_tbk_qrcode
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_bj_tbk_qrcode` (
  `beid` int(10) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weixinkey` varchar(50) NOT NULL,
  `active` int(10) unsigned NOT NULL DEFAULT '0',
  `qrmessage` varchar(5000) NOT NULL,
  `noallowmsg` varchar(5000) NOT NULL,
  `allowqrcode` int(10) unsigned NOT NULL DEFAULT '0',
  `qrmessageenable` tinyint(4) NOT NULL DEFAULT '0',
  `bg` varchar(1024) NOT NULL,
  `title` varchar(1024) NOT NULL,
  `bgparam` text NOT NULL,
  `notice` varchar(1024) NOT NULL,
  `click_credit` int(10) NOT NULL COMMENT '未关注的用户关注,送分享者积分',
  `sub_click_credit` int(10) NOT NULL COMMENT '未关注的用户关注,送上线积分',
  `newbie_credit` int(10) NOT NULL COMMENT '通过本渠道关注微信号，送新用户大礼包积分',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `msgtype` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_bj_tbk_qrcode
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_bj_tbk_qrcode_cache
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_bj_tbk_qrcode_cache` (
  `beid` int(10) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `qr_url` varchar(1024) NOT NULL,
  `createtime` int(11) NOT NULL,
  `expiretime` int(11) NOT NULL,
  `media_id` varchar(1024) NOT NULL,
  `qrcodeid` int(10) NOT NULL DEFAULT '0' COMMENT '渠道唯一标示符',
  `from_user` varchar(100) NOT NULL,
  `openid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_bj_tbk_qrcode_cache
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_bj_tbk_share
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_bj_tbk_share` (
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alipay_openid` varchar(50) DEFAULT NULL,
  `weixin_openid` varchar(50) DEFAULT NULL,
  `temp_openid` varchar(50) DEFAULT NULL,
  `share_action` int(1) DEFAULT '0' COMMENT '何如成为粉丝的0点击关注 1扫码关注',
  `parentid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `baijiacms_alipay_alifans` (
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL DEFAULT '0',
  `openid` varchar(50) DEFAULT NULL,
  `alipay_openid` varchar(50) NOT NULL,
  `follow` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否订阅',
  `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(200) NOT NULL DEFAULT '',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别(0:保密 1:男 2:女)',
  PRIMARY KEY (`beid`,`alipay_openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_alipay_alifans
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_alipay_rule
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_alipay_rule` (
  `beid` int(10) NOT NULL,
  `url` varchar(500) NOT NULL,
  `thumb` varchar(60) NOT NULL,
  `keywords` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text,
  `ruletype` int(11) NOT NULL COMMENT '1文本回复 2图文回复',
  `content` text,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_alipay_rule
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_attachment
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_attachment` (
  `beid` int(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL COMMENT '1为图片',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_attachment
-- ----------------------------


-- ----------------------------
-- Table structure for baijiacms_config
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_config` (
  `beid` int(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(100) NOT NULL COMMENT '配置名称',
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_config
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_dispatch
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_dispatch` (
  `is_system` int(1) NOT NULL DEFAULT '0' COMMENT '0店铺1总部',
  `beid` int(10) NOT NULL,
  `id` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(120) NOT NULL DEFAULT '',
  `sendtype` int(5) NOT NULL DEFAULT '1' COMMENT '0为快递，1为自提',
  `desc` text NOT NULL,
  `configs` text NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_dispatch
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_gold_order
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_gold_order` (
	`weixin_transaction_openid` varchar(50) DEFAULT '',
		`weixin_transaction_id` varchar(100) DEFAULT '',
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `paytime` int(10) DEFAULT '0' COMMENT '支付时间',
  `price` decimal(10,2) NOT NULL,
  `openid` varchar(40) NOT NULL,
  `ordersn` varchar(20) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_gold_order
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_gold_teller
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_gold_teller` (
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '0未审核-1拒绝1审核功成',
  `fee` decimal(10,2) NOT NULL,
  `openid` varchar(40) NOT NULL,
  `ordersn` varchar(20) DEFAULT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_gold_teller
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_member
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_member` (
  `beid` int(10) NOT NULL,
  `weixinhao` varchar(50) DEFAULT '',
  `email` varchar(20) NOT NULL,
  `credit` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `gold` double NOT NULL DEFAULT '0' COMMENT '余额',
  `openid` varchar(50) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `createtime` int(10) NOT NULL,
  `istemplate` tinyint(1) DEFAULT '0' COMMENT '是否为临时账户 1是，0为否',
  `status` tinyint(1) DEFAULT '1' COMMENT '0为禁用，1为可用',
  `experience` int(11) DEFAULT '0' COMMENT '账户经验值',
  `avatar` varchar(200) DEFAULT '' COMMENT '用户头像',
  `outgold` double NOT NULL DEFAULT '0' COMMENT '已提取余额',
  `outgoldinfo` varchar(1000) DEFAULT '0' COMMENT '提款信息 序列化',
  PRIMARY KEY (`openid`),
  KEY `idx_member_from_user` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_member
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_member_paylog
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_member_paylog` (
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `openid` varchar(40) NOT NULL,
  `type` varchar(30) NOT NULL COMMENT 'usegold使用金额 addgold充值金额 usecredit使用积分 addcredit充值积分',
  `pid` bigint(20) NOT NULL AUTO_INCREMENT,
  `account_fee` decimal(10,2) NOT NULL COMMENT '账户剩余积分或余额',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_member_paylog
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_modules
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_modules` (
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(30) NOT NULL,
  `group` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `version` decimal(5,2) NOT NULL,
  `name` varchar(30) NOT NULL,
  `isdisable` int(1) DEFAULT '0' COMMENT '模块是否禁用',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_modules
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_modules_menu
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_modules_menu` (
  `href` varchar(200) NOT NULL,
  `title` varchar(50) NOT NULL,
  `module` varchar(30) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_modules_menu
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_paylog
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_paylog` (
  `beid` int(10) NOT NULL,
  `paytype` varchar(30) NOT NULL,
  `pdate` text NOT NULL,
  `ptype` varchar(10) NOT NULL,
  `typename` varchar(30) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_paylog
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_paylog_alipay
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_paylog_alipay` (
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `alipay_safepid` varchar(50) DEFAULT NULL,
  `buyer_email` varchar(50) DEFAULT NULL,
  `buyer_id` varchar(50) DEFAULT NULL,
  `out_trade_no` varchar(50) DEFAULT NULL,
  `seller_email` varchar(50) DEFAULT NULL,
  `seller_id` varchar(50) DEFAULT NULL,
  `total_fee` decimal(10,2) DEFAULT NULL COMMENT '交易金额',
  `trade_no` varchar(50) DEFAULT NULL,
  `body` varchar(200) DEFAULT NULL,
  `orderid` int(10) DEFAULT NULL,
  `ordersn` varchar(50) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `presult` varchar(50) DEFAULT NULL COMMENT 'success 或error',
  `order_table` varchar(50) DEFAULT NULL COMMENT '订单类型 shop_order gold_order',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_paylog_alipay
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_paylog_unionpay
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_paylog_unionpay` (
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `txnTime` int(10) DEFAULT NULL,
  `txnAmt` decimal(10,2) DEFAULT NULL COMMENT '交易金额',
  `queryid` varchar(50) DEFAULT NULL COMMENT '交易查询流水号',
  `currencyCode` varchar(10) DEFAULT NULL COMMENT '交易币种',
  `reqReserved` varchar(100) DEFAULT NULL COMMENT '请求保留域',
  `settleAmt` decimal(10,2) DEFAULT NULL COMMENT '清算金额',
  `settleCurrencyCode` varchar(10) DEFAULT NULL COMMENT '清算币种',
  `traceTime` int(10) DEFAULT NULL COMMENT '交易传输时间',
  `traceNo` varchar(50) DEFAULT NULL COMMENT '系统跟踪号',
  `merId` varchar(50) DEFAULT NULL COMMENT '商户代码',
  `orderid` int(10) DEFAULT NULL,
  `ordersn` varchar(50) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `presult` varchar(50) DEFAULT NULL COMMENT 'success 或error',
  `order_table` varchar(50) DEFAULT NULL COMMENT '订单类型 shop_order gold_order',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_paylog_unionpay
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_paylog_weixin
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_paylog_weixin` (
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `timeend` int(10) DEFAULT NULL,
  `total_fee` decimal(10,2) DEFAULT NULL COMMENT '交易金额',
  `mchId` varchar(50) DEFAULT NULL COMMENT '商户id',
  `openid` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `out_trade_no` varchar(50) DEFAULT NULL,
  `orderid` int(10) DEFAULT NULL,
  `ordersn` varchar(50) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `presult` varchar(50) DEFAULT NULL COMMENT 'success 或error',
  `order_table` varchar(50) DEFAULT NULL COMMENT '订单类型 shop_order gold_order',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_paylog_weixin
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_payment
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_payment` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(120) NOT NULL DEFAULT '',
  `desc` text NOT NULL,
  `order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `configs` text NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `iscod` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `online` tinyint(1) unsigned NOT NULL DEFAULT '0',
    `beid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_payment
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_qq_qqfans
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_qq_qqfans` (
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL DEFAULT '0',
  `openid` varchar(50) DEFAULT NULL,
  `qq_openid` varchar(50) NOT NULL,
  `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(200) NOT NULL DEFAULT '',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别(0:保密 1:男 2:女)',
  PRIMARY KEY (`beid`,`qq_openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_qq_qqfans
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_rank_model
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_rank_model` (
  `beid` int(10) NOT NULL,
  `experience` int(11) DEFAULT '0',
  `rank_level` int(3) NOT NULL DEFAULT '0' COMMENT '等级',
  `rank_name` varchar(50) DEFAULT NULL COMMENT '等级名称',
  PRIMARY KEY (`rank_level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_rank_model
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_rank_phb
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_rank_phb` (
  `beid` int(10) NOT NULL,
  `rank_level` int(11) DEFAULT '0',
  `rank_name` varchar(50) DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `rank_top` int(2) NOT NULL DEFAULT '0' COMMENT '名次',
  PRIMARY KEY (`rank_top`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_rank_phb
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_address
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_address` (
  `beid` int(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `province` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `area` varchar(30) NOT NULL,
  `address` varchar(300) NOT NULL,
  `isdefault` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_address
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_adv
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_adv` (
  `beid` int(10) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_enabled` (`enabled`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_adv
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_cart
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_cart` (
  `beid` int(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goodsid` int(11) NOT NULL,
  `goodstype` tinyint(1) NOT NULL DEFAULT '1',
  `session_id` varchar(50) NOT NULL,
  `total` int(10) unsigned NOT NULL,
  `optionid` int(10) DEFAULT '0',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_openid` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_cart
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_category
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_category` (
  `is_system` int(1) NOT NULL DEFAULT '0' COMMENT '0为普通商品，1为总部商品',
  `beid` int(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commission` int(10) unsigned DEFAULT '0' COMMENT '推荐该类商品所能获得的佣金',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `thumb` varchar(255) NOT NULL COMMENT '分类图片',
  `thumbadv` varchar(255) NOT NULL COMMENT '分类广告图片',
  `thumbadvurl` varchar(255) NOT NULL COMMENT '分类广告url',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `isrecommand` int(10) DEFAULT '0',
  `description` varchar(500) NOT NULL COMMENT '分类介绍',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_category
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_dispatch
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_dispatch` (
  `is_system` int(1) NOT NULL DEFAULT '0' COMMENT '0店铺1总部',
  `beid` int(10) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dispatchname` varchar(50) NOT NULL,
  `sendtype` int(5) NOT NULL DEFAULT '1' COMMENT '0为快递，1为自提',
  `firstprice` decimal(10,2) NOT NULL,
  `secondprice` decimal(10,2) NOT NULL,
  `provance` varchar(30) DEFAULT '',
  `city` varchar(30) DEFAULT '',
  `area` varchar(30) DEFAULT '',
  `firstweight` int(10) NOT NULL,
  `secondweight` int(10) NOT NULL,
  `express` varchar(50) NOT NULL,
  `deleted` int(10) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_dispatch
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_dispatch_area
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_dispatch_area` (
  `is_system` int(1) NOT NULL DEFAULT '0',
  `beid` int(10) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dispatchid` int(11) NOT NULL,
  `country` varchar(30) NOT NULL,
  `provance` varchar(30) DEFAULT '',
  `city` varchar(30) DEFAULT '',
  `area` varchar(30) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_dispatch_area
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_diymenu
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_diymenu` (
  `beid` int(10) NOT NULL,
  `menu_type` varchar(10) NOT NULL,
  `torder` int(2) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `url` varchar(350) NOT NULL,
  `tname` varchar(100) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_diymenu
-- ----------------------------

-- ----------------------------
-- Records of baijiacms_shop_fh_order
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_goods
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_goods` (
  `goodsFHprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `goodsFHtype` int(1) NOT NULL DEFAULT '0',
  `beid` int(10) NOT NULL,
  `is_system` int(1) NOT NULL DEFAULT '0' COMMENT '0为普通商品，1为总部商品',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pcate` int(10) unsigned NOT NULL DEFAULT '0',
  `ccate` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0为实体，1为虚拟',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `description` varchar(1000) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `goodssn` varchar(50) NOT NULL DEFAULT '',
  `weight` decimal(10,2) NOT NULL DEFAULT '0.00',
  `productsn` varchar(50) NOT NULL DEFAULT '',
  `marketprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `productprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` int(10) NOT NULL DEFAULT '0',
  `totalcnf` int(11) DEFAULT '0' COMMENT '0 拍下减库存 1 付款减库存 2 永久不减',
  `sales` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL,
  `credit` int(11) DEFAULT '0',
  `hasoption` int(11) DEFAULT '0',
  `isnew` int(11) DEFAULT '0',
  `issendfree` int(11) DEFAULT NULL,
  `ishot` int(11) DEFAULT '0',
  `isdiscount` int(11) DEFAULT '0',
  `isrecommand` int(11) DEFAULT '0',
  `istime` int(11) DEFAULT '0',
  `timestart` int(11) DEFAULT '0',
  `timeend` int(11) DEFAULT '0',
  `viewcount` int(11) DEFAULT '0',
  `remark` text,
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `isfirst` int(1) DEFAULT '0' COMMENT '首发',
  `isjingping` int(1) DEFAULT '0' COMMENT '精品',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_goods
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_goods_comment
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_goods_comment` (
  `beid` int(10) NOT NULL,
  `is_system` int(1) NOT NULL DEFAULT '0' COMMENT '0为普通商品，1为总部商品',
  `createtime` int(10) NOT NULL,
  `optionname` varchar(100) DEFAULT NULL,
  `orderid` int(10) DEFAULT NULL,
  `ordersn` varchar(20) DEFAULT NULL,
   `comment_nickname` varchar(100) DEFAULT NULL,
   `isenable` int(1) DEFAULT '0' COMMENT '0未审核,1审核通过',
  `openid` varchar(50) DEFAULT NULL,
  `comment` text,
  `rate` int(1) DEFAULT '0' COMMENT '0差评 1中评 2好评',
  `goodsid` int(10) DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_goods_comment
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_goods_goodsstore
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_goods_goodsstore` (
  `ccate` int(10) NOT NULL,
  `pcate` int(10) NOT NULL,
  `good_id` int(10) NOT NULL,
  `beid` int(10) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_goods_goodsstore
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_goods_option
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_goods_option` (
  `beid` int(10) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `thumb` varchar(60) DEFAULT '',
  `productprice` decimal(10,2) DEFAULT '0.00',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `costprice` decimal(10,2) DEFAULT '0.00',
  `stock` int(11) DEFAULT '0',
  `weight` decimal(10,2) DEFAULT '0.00',
  `displayorder` int(11) DEFAULT '0',
  `specs` text,
  PRIMARY KEY (`id`),
  KEY `indx_goodsid` (`goodsid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_goods_option
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_goods_piclist
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_goods_piclist` (
  `beid` int(10) NOT NULL,
  `picurl` varchar(255) NOT NULL,
  `goodid` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_goods_piclist
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_goods_spec
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_goods_spec` (
  `beid` int(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `displaytype` tinyint(3) unsigned NOT NULL,
  `content` text NOT NULL,
  `goodsid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_goods_spec
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_goods_spec_item
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_goods_spec_item` (
  `beid` int(10) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `show` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_specid` (`specid`),
  KEY `indx_show` (`show`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_goods_spec_item
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_order
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_order` (
	`weixin_transaction_openid` varchar(50) DEFAULT '',
		`weixin_transaction_id` varchar(100) DEFAULT '',
	`zong_hasrest` int(1) NOT NULL  COMMENT '0正常  1部分商品退换货',
	 `be_hasrest` int(1) NOT NULL  COMMENT '0正常 1部分商品退换货',
	`zong_updatetime` int(10) DEFAULT '0' COMMENT '订单更新时间',
	`be_updatetime` int(10) DEFAULT '0' COMMENT '订单更新时间',
	`zong_ordersn` varchar(20) DEFAULT '',
	`be_ordersn` varchar(20) DEFAULT '',
  `be_returnmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `be_returnmoneytype` int(1) NOT NULL,
  `zong_returnmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `zong_returnmoneytype` int(1) NOT NULL,
  `is_system_fh` int(1) NOT NULL,
  `compid` int(10) NOT NULL,
  `saleid` int(10) NOT NULL,
  `beid` int(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL,
  `ordersn` varchar(20) NOT NULL,
  `oldordersn` varchar(20) NOT NULL,
  `credit` int(10) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '-6已退款 -5已退货 -4退货中， -3换货中， -2退款中，-1取消状态，0普通状态，1为已付款，2为已发货，3为成功',
  `be_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '分部发货状态 -6已退款 -5已退货 -4退货中， -3换货中， -2退款中，-1取消状态，0普通状态，1为已付款，2为已发货，3为成功',
  `zong_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '总部发货状态 -6已退款 -5已退货 -4退货中， -3换货中， -2退款中，-1取消状态，0普通状态，1为已付款，2为已发货，3为成功',
 	`be_has_gfinish` int(1) NOT NULL DEFAULT '0' COMMENT '是否已成功收货过0否1是',
  `zong_has_gfinish` int(1) NOT NULL DEFAULT '0' COMMENT '是否已成功收货过0否1是',
  `sendtype` tinyint(1) unsigned NOT NULL COMMENT '0为快递，1为自提',
  `paytype` tinyint(1) NOT NULL COMMENT '1为余额，2为在线，3为到付',
  `paytypecode` varchar(30) NOT NULL COMMENT '0货到付款，1微支付，2支付宝付款，3余额支付，4积分支付',
  `paytypename` varchar(50) NOT NULL,
  `transid` varchar(50) NOT NULL DEFAULT '0' COMMENT '外部单号(微支付单号等)',
  `remark` varchar(1000) DEFAULT '',
  `zong_remark` varchar(1000)  DEFAULT '',
  `be_remark` varchar(1000) DEFAULT '',
  `expresscom` varchar(30) NOT NULL,
  `expresssn` varchar(50) NOT NULL,
  `express` varchar(30) NOT NULL,
   `be_expresscom` varchar(30) NOT NULL,
  `be_expresssn` varchar(50) NOT NULL,
  `be_express` varchar(30) NOT NULL,
  `addressid` int(10) unsigned NOT NULL,
  `be_goodsprice` decimal(10,2) DEFAULT '0.00',
  `zong_goodsprice` decimal(10,2) DEFAULT '0.00',
  `dispatchprice` decimal(10,2) DEFAULT '0.00',
  `zong_dispatchprice` decimal(10,2) DEFAULT '0.00',
  `dispatchexpress` varchar(50) DEFAULT '',
  `dispatch` int(10) DEFAULT '0',
  `dispatch_name` varchar(50) DEFAULT '',
  `be_dispatchprice` decimal(10,2) DEFAULT '0.00',
  `be_dispatchexpress` varchar(50) DEFAULT '',
  `be_dispatch_name` varchar(50) DEFAULT '',
  `be_dispatch` int(10) DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL,
  `address_address` varchar(100) NOT NULL,
  `address_area` varchar(10) NOT NULL,
  `address_city` varchar(10) NOT NULL,
  `address_province` varchar(10) NOT NULL,
  `address_realname` varchar(10) NOT NULL,
  `address_mobile` varchar(20) NOT NULL,
  `rsreson` varchar(500) DEFAULT '' COMMENT '退货款退原因',
  `be_rsreson` varchar(500) DEFAULT '' COMMENT '退货款退原因',
  `isrest` int(1) NOT NULL DEFAULT '0',
  `paytime` int(10) DEFAULT '0' COMMENT '订单支付时间',
  `updatetime` int(10) DEFAULT '0' COMMENT '订单更新时间',
  `is_system` int(1) NOT NULL DEFAULT '0' COMMENT '含总部商品1为总部',
  `is_be` int(1) NOT NULL DEFAULT '0' COMMENT '含分部订单',
  `area` varchar(30) DEFAULT '' COMMENT '区',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_order
-- ----------------------------


-- ----------------------------
-- Table structure for baijiacms_shop_order_goods
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_order_goods` (
  `goodssn` varchar(50) NOT NULL DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `beid` int(10) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` int(10) unsigned NOT NULL,
  `goodsid` int(10) unsigned NOT NULL,
  `status` tinyint(3) DEFAULT '0' COMMENT '0为无状态,1已收货,-3换货中,-7换货后已发货, -4退货中, -5已退货, -6已退款',
  `restatus` tinyint(3) DEFAULT '0' COMMENT '0未换货，1换货',
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `rsreson` text,
  `return_expresscom` varchar(30) NOT NULL,
  `return_expresssn` varchar(50) NOT NULL,
  `return_express` varchar(30) NOT NULL,
   `returnmoney` decimal(10,2) DEFAULT '0.00',
  `returnmoneytype` int(1) NOT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `total` int(10) unsigned NOT NULL DEFAULT '1',
  `optionid` int(10) DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL,
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `optionname` text,
    `be_return_money` int(1) DEFAULT '0' COMMENT '0否1是 分店是否退款',
  `iscomment` int(1) DEFAULT '0' COMMENT '是否已评论0否1是',
  `is_system` int(1) NOT NULL DEFAULT '0' COMMENT '1为总部商品',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_order_goods
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_shop_order_paylog
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_shop_order_paylog` (
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `orderid` int(10) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `openid` varchar(40) NOT NULL,
  `pid` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_shop_order_paylog
-- ----------------------------


-- ----------------------------
-- Table structure for baijiacms_sms_cache
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_sms_cache` (
  `beid` int(10) NOT NULL,
   `cachetime` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `checkcount` int(3) NOT NULL,
  `smstype` varchar(50) DEFAULT NULL,
  `tell` varchar(50) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL,
  `vcode` varchar(50) DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_sms_cache
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_system_config
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_system_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(100) NOT NULL COMMENT '配置名称',
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_system_config
-- ----------------------------


-- ----------------------------
-- Table structure for baijiacms_system_store
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_system_store` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `compid` int(11) NOT NULL,
  `saleid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `logo` varchar(1000) DEFAULT NULL,
  `sname` varchar(100) NOT NULL,
  `is_system` int(1) NOT NULL DEFAULT '0',
  `isclose` int(1) NOT NULL,
  `website` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_system_store
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_thirdlogin
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_thirdlogin` (
  `beid` int(10) NOT NULL,
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(120) NOT NULL DEFAULT '',
  `desc` text NOT NULL,
  `configs` text NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_thirdlogin
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_user
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_user` (
  `loginkey` varchar(20) NOT NULL,
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_admin` int(1) NOT NULL DEFAULT '0' COMMENT '1管理员0普用户',
  `username` varchar(50) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_user
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_weixin_rule
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_weixin_rule` (
  `beid` int(10) NOT NULL,
  `url` varchar(500) NOT NULL,
  `thumb` varchar(60) NOT NULL,
  `keywords` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text,
  `ruletype` int(11) NOT NULL COMMENT '1文本回复 2图文回复',
  `addonsrule` int(1) NOT NULL DEFAULT '0' COMMENT '0常规，1模块规则',
  `addonsModule` varchar(50) DEFAULT '' COMMENT '所属模块',
  `content` text,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of baijiacms_weixin_rule
-- ----------------------------

-- ----------------------------
-- Table structure for baijiacms_weixin_wxfans
-- ----------------------------
CREATE TABLE IF NOT EXISTS `baijiacms_weixin_wxfans` (
  `beid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL DEFAULT '0',
  `openid` varchar(50) DEFAULT NULL,
  `weixin_openid` varchar(100) NOT NULL,
  `follow` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否订阅',
  `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(200) NOT NULL DEFAULT '',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别(0:保密 1:男 2:女)',
  `longitude` decimal(10,2) DEFAULT '0.00' COMMENT '地理位置经度',
  `latitude` decimal(10,2) DEFAULT '0.00' COMMENT '地理位置纬度',
  `precision` decimal(10,2) DEFAULT '0.00' COMMENT '地理位置精度',
  PRIMARY KEY (`beid`,`weixin_openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


";

mysqld_batch($sql);
define('LOCK_TO_UPDATE', true);
require WEB_ROOT.'/system/modules/updatesql.php';
define('LOCK_TO_ADDONS_INSTALL', true);