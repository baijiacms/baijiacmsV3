<?php defined('SYSTEM_IN') or exit('Access Denied');defined('LOCK_TO_UPDATE') or exit('Access Denied');
$sql ="
CREATE TABLE IF NOT EXISTS `baijiacms_bj_tbk_diyshopindex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `beid` int(10) NOT NULL,
  `pagename` varchar(255) NOT NULL DEFAULT '' COMMENT '页面名称',
  `pagetype` tinyint(3) NOT NULL DEFAULT '0' COMMENT '页面类型 1首页，0其他',
  `pageinfo` text NOT NULL,
  `createtime` varchar(255) NOT NULL DEFAULT '' COMMENT '页面创建时间',
  `updatetime` varchar(255) NOT NULL DEFAULT '' COMMENT '页面最后保存时间',
  `datas` text NOT NULL COMMENT '数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";


if(!mysqld_fieldexists('shop_order', 'visual_pay')) {
	$sql=$sql."ALTER TABLE ".table('shop_order')." ADD COLUMN `visual_pay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否是虚拟付款0否1是，虚拟付款即后台付款';";
}
if(!mysqld_fieldexists('system_store', 'fullwebsite')) {
	$sql=$sql."ALTER TABLE ".table('system_store')." ADD COLUMN `fullwebsite` varchar(200) NOT NULL DEFAULT '' COMMENT '完整域名';";
}
if(!mysqld_fieldexists('system_store', 'website2')) {
	$sql=$sql."ALTER TABLE ".table('system_store')." ADD COLUMN `website2` varchar(100) NOT NULL DEFAULT '' COMMENT '子绑定域名1';";
}
if(!mysqld_fieldexists('system_store', 'website3')) {
	$sql=$sql."ALTER TABLE ".table('system_store')." ADD COLUMN `website3` varchar(100) NOT NULL DEFAULT '' COMMENT '子绑定域名2';";
}
if(!mysqld_fieldexists('bj_tbk_diyshopindex', 'showtype')) {
	$sql=$sql."ALTER TABLE ".table('bj_tbk_diyshopindex')." ADD COLUMN `showtype` tinyint(2) NOT NULL DEFAULT '0' COMMENT '页面类型0DIY页面1html代码页面';";
}
mysqld_batch($sql); 


clear_theme_cache();
