<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');

function bj_tbk_get_parentmember()
	{
    return array();
	}
		function bj_tbk_get_sharememner($openid,$level=1)
	{
		$shareid=bj_tbk_get_shareid($openid);
		$member =member_get($shareid);	
		return $member;

	}
		function bj_tbk_get_unameORmobile($openid)
	{
		$member =member_get($openid);	
		if(!empty($member['nickname']))
		{
			return $member['nickname'];	
		}else
		{
			return $member['mobile'];	
		}
	}
	
	function bj_tbk_get_shareid($openid,$level=1,$opencheck=true)
	{
		return "";
	}

	
 
	function bj_tbk_weixin_share($mobile_url,$mobilearray,$sharetitle,$shareimg,$sharedesc,$settings)
	{
					global $_CMS;
			$shareimg=$shareimg;
			 
			 
			      //分享信息
        $sharelink = WEBSITE_ROOT . create_url($mobile_url, $mobilearray);
 
        
			  
    
			  $sharedata = array(
      "title"       => $sharetitle,
      "imgUrl"       => $shareimg,
      "link"      => $sharelink,
      "description" => $sharedesc
    );
    
      $signPackage = weixin_js_signPackage($sharedata);
		return $signPackage;
	}
	
	function bj_tbk_qrcode_updateagent($openid,$shareinfo,$weixin_openid,$allowupdate=false)
{
}
		 function allowsetparent($openid,$parentid)
	{
		
  	return false;	
	}
function bj_tbk_base_shareinfo($openid,$shareinfo,$weixin_openid='',	$alipay_openid='',$share_action=0)
{
}
function bj_tbk_shareinfo($openid=false)
{

}

	 function bj_tbk_reg_member($regopenid,$tempopenid='-1')
	{
	}

	
	 function bj_tbk_checkexist_member_relect($openid)
	{
	}
	

	