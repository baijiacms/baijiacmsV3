<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<!DOCTYPE html>
<html>
	<head>
    <meta http-equiv="X-UA-Compatible" content="IE=10" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo RESOURCE_ROOT;?>addons/common/bootstrap3/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo RESOURCE_ROOT;?>addons/index/css/ace/ace.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>addons/index/css/ace/ace-rtl.min.css" />
    <link rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>addons/index/css/ace/ace-skins.min.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>addons/index/css/ace/ace-ie.min.css" />
    <![endif]-->
<link href="<?php echo RESOURCE_ROOT;?>addons/common/css/common.css?x=1" rel="stylesheet" />
<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>addons/common/fontawesome3/css/font-awesome.min.css" />
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/js/common.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/bootstrap3/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/kindeditor/kindeditor-min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>addons/common/kindeditor/themes/default/default.css" />
<script type="text/javascript">
window.UEDITOR_HOME_URL = '<?php echo RESOURCE_ROOT;?>/addons/common/';
window.UEDITOR_RES_URL = '<?php echo RESOURCE_ROOT;?>/addons/common/';
window.UEDITOR_ATTACH_URL = '<?php echo ATTACHMENT_WEBROOT;?>';
window.UEDITOR_UEUPLOAD='<?php echo WEBSITE_ROOT.mobile_url('keupload',array('name'=>'shop'));?>';
</script>
   <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>addons/common/fontawesome3/css/font-awesome-ie7.min.css">
    <![endif]-->
	<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>addons/common/css/datetimepicker.css" />
		<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/js/datetimepicker.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>addons/common/css/uploadify_t.css" />

<style>
html {overflow-x:hidden; }
body {
background-color: #FFFFFF;
}
table{border-top: 0px;}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th
{
	border-top: 0px;
	}
</style>
</head>
<body  class="no-skin">