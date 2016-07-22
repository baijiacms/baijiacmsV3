<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<?php if($_SESSION['from_pc']==1&&$_CMS['shopwap_member_isagent']==true){ ?>
<script>
	if(parent.document.getElementById("father_url")!=null&&parent.document.getElementById("father_url").value==1)
	{
		parent.history.pushState({}, "PC…Ã≥«", "<?php echo WEBSITE_ROOT.mobile_url('shopindex');?>");
		parent.document.getElementById("father_url").value=0;
	}
	</script>
<?php }?>
</body></html>