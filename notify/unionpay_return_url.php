<?php
define('SYSTEM_ACT', 'mobile');
$_SERVER['PHP_SELF']= str_replace('notify/',"",$_SERVER['PHP_SELF']);
$mname='modules';
$do='unionpay_return_url';
ob_start();
$CLASS_LOADER="driver";
require '../includes/baijiacms.inc.php';
ob_end_flush();
exit;