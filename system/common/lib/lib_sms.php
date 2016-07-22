<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');

function system_sms_validate($tell,$smstype,$vcode) {
		global $_CMS;
	
			if(empty($smstype)||empty($tell)||empty($vcode))
	{
	return  false;	
	}
	$sms_cache = mysqld_select("SELECT * FROM " . table('sms_cache').'where tell=:tell and smstype=:smstype and beid=:beid',array(":tell"=>$tell,":smstype"=>$smstype,':beid'=>$_CMS['beid']) );

  	$settings=globaSetting();
  if(!empty($sms_cache['vcode']))
  {
//  	if(!empty($sms_cache['cachetime']))
 // {
  //	if(($sms_cache['cachetime']+$settings['sms_secret_sec'])<=time())
  //	{
  //	return false;	
  //	}
  //}
  	if($vcode==$sms_cache['vcode'])
  	{
  		
  	return true;	
  	}
  	
  }
  return false;
	
	
}
function system_sms_curlsend($tell,$smstype,$sms_template_code,$sms_free_sign_name,$vcode) 
{
		global $_CMS;
	if(empty($sms_template_code)||empty($tell)||empty($sms_free_sign_name)||empty($vcode))
	{
	return;	
	}
	 $settings=globaSetting();
	 $header = array(
		            'X-Ca-Key: '.	$settings['sms_key'],
		            'X-Ca-Secret: '.	$settings['sms_secret'],
		        );
		        
		        $productname=$settings['system_sitename'];
		        if(!empty($_CMS['beid']))
		        {
		        	$besettings=globaSetting();
		        	$productname=$besettings['shop_title'];
		        }
		        $sms_param_date=array('code'=>$vcode,'product'=>$productname);
		        
		    $url="https://ca.aliyuncs.com/gw/alidayu/sendSms?rec_num=".$tell."&sms_template_code=".$sms_template_code."&sms_free_sign_name=".$sms_free_sign_name."&sms_type=normal&extend=".$tell."&sms_param=".json_encode($sms_param_date);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				//curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1');
				$data = curl_exec($ch);
				curl_close($ch);
				$return=@json_decode($data,true);
			if(empty($return['success']))
			{
			message("出现错误：".$data);	
			}

}
//$sms_template_code 短信模板
//$sms_free_sign_name 短信前面
//$smstype 区分用
function system_sms_send($tell,$smstype,$sms_template_code,$sms_free_sign_name) {
		global $_CMS;
	
			if(empty($sms_template_code))
	{
	return;	
	}
	$sms_cache = mysqld_select("SELECT * FROM " . table('sms_cache').'where tell=:tell and smstype=:smstype and beid=:beid',array(":tell"=>$tell,":smstype"=>$smstype,':beid'=>$_CMS['beid']) );
 	$settings=globaSetting();
 	
  if(empty($sms_cache['id'])||($sms_cache['cachetime']+intval($settings['sms_secret_resec']))<=time())
  {
  	$sms_secret_count=5;
	if(!empty($settings['sms_secret_count']))
	{
		 	$sms_secret_count=intval($settings['sms_secret_count']);
	}
	if((($sms_cache['createtime']+(60*60*20))<time()))
	{
		
							$insertdate['checkcount']=0;
								$insertdate['createtime']=time();
				mysqld_update('sms_cache',$insertdate,array('id'=>$sms_cache['id'],'beid'=>$_CMS['beid']));
				$sms_cache = mysqld_select("SELECT * FROM " . table('sms_cache').'where id=:id and beid=:beid',array(":id"=>$sms_cache['id'],':beid'=>$_CMS['beid']) );
 	
	}
	
	
		if($sms_cache['checkcount']>=$sms_secret_count&&(($sms_cache['createtime']+(60*60*20))>=time()))
		{
			message("手机号：".$tell."的该短信业务已超过今天最大使用次数,请明天再试。");
		}else
		{
			$member=get_member_account(false);
			$vcode=rand(10000,99999);
			$insertdate=array('cachetime'=>time(),'smstype'=>$smstype,'vcode'=>$vcode,'tell'=>$tell);
			if(empty($sms_cache['id']))
			{
				$insertdate['createtime']=time();
				$insertdate['checkcount']=1;
				$insertdate['beid']=$_CMS['beid'];
				mysqld_insert('sms_cache',$insertdate);
			}else
			{
					
						$insertdate['checkcount']=$sms_cache['checkcount']+1;
				mysqld_update('sms_cache',$insertdate,array('id'=>$sms_cache['id'],'beid'=>$_CMS['beid']));
			}
		
			system_sms_curlsend($tell,$smstype,$sms_template_code,$sms_free_sign_name,$vcode);
		}
  }
}
function system_sms_test($tell,$sms_mobile_test,$sms_mobile_test_signname) 
{
	$vcode=rand(10000,99999);
	system_sms_curlsend($tell,'sms_test',$sms_mobile_test,$sms_mobile_test_signname,$vcode);
}