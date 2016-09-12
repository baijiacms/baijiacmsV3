<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');
function filter_weixinname_emoji($string)
{   
	 return trim(json_decode( preg_replace("#(\\\ud[0-9a-f]{3})|(\\\ue[0-9a-f]{3})#ie", "", json_encode($string))));
}
function save_member_login($openid)
{
		global $_CMS;

		$member = mysqld_select("SELECT * FROM ".table('member')." where openid=:openid  and beid=:beid  limit 1", array(':openid' => $openid,':beid'=>$_CMS['beid']));
		if(!empty($member['openid']))
		{
			unset($member['pwd']);
			$_SESSION[MOBILE_ACCOUNT]=$member;
			return $member['openid'];
		}
		return '';
}
function refresh_account($openid)
{
$member =member_get($openid);	
		if(!empty($member['openid']))
		{
			$_SESSION[MOBILE_ACCOUNT]=$member;
		}
}

function member_login_weixin($weixin_openid)
{

	global $_CMS;
	if(!empty($weixin_openid))
	{

		$weixin_wxfans = mysqld_select("SELECT * FROM " . table('weixin_wxfans') . " WHERE weixin_openid=:weixin_openid and beid=:beid  ", array(':weixin_openid' =>$weixin_openid,':beid'=>$_CMS['beid']));

		if(!empty($weixin_wxfans['weixin_openid']))
			{
					$member = mysqld_select("SELECT * FROM ".table('member')." where openid=:openid and beid=:beid  limit 1", array(':openid' => $weixin_wxfans['openid'],':beid'=>$_CMS['beid']));
					if(!empty($member['openid']))
					{
						$_SESSION[MOBILE_ACCOUNT]=$member;
										save_member_login($member['openid']);
					}else
					{
								$openid=member_create_new("","",$weixin_wxfans['nickname']);
								
								mysqld_update('weixin_wxfans',array('openid'=>$openid),array('weixin_openid'=>$weixin_openid,'beid'=>$_CMS['beid']));	
				
								save_member_login($openid);
							
						
					}
			}else
			{
				unset($_COOKIE[WEIXIN_COOKIE_ID]);
				unset($_SESSION[MOBILE_WEIXIN_OPENID]);
				unset($_SESSION[MOBILE_SESSION_ACCOUNT]);
				get_weixin_openid();
			 $redirect = WEBSITE_ROOT . '/index.php?' . $_SERVER['QUERY_STRING'];
				
					header('Location: '.$redirect);
				exit;
			}
	}
	
}
function member_login_qq($qq_openid)
{

	global $_CMS;
	if(!empty($qq_openid))
	{

		$qq_fans = mysqld_select("SELECT * FROM " . table('qq_qqfans') . " WHERE qq_openid=:qq_openid and beid=:beid  ", array(':qq_openid' =>$qq_openid,':beid'=>$_CMS['beid']));
		
		if(!empty($qq_fans['qq_openid']))
			{
					$member = mysqld_select("SELECT * FROM ".table('member')." where openid=:openid and beid=:beid  limit 1", array(':openid' => $qq_fans['openid'],':beid'=>$_CMS['beid']));
					if(!empty($member['openid']))
					{
						$_SESSION[MOBILE_ACCOUNT]=$member;
					}else
					{
								$settings=globaSetting();
								$openid=member_create_new("","",$qq_fans['nickname']);
								
								mysqld_update('qq_qqfans',array('openid'=>$openid),array('qq_openid'=>$qq_openid,'beid'=>$_CMS['beid']));	
				
								save_member_login($openid);
						
					}
			}else
			{
				
				message("QQ注册失败");	
			}
	}
	
}

function member_login_alipay($alipay_openid)
{

	global $_CMS;
	if(!empty($alipay_openid))
	{

		$alipay_alifans = mysqld_select("SELECT * FROM " . table('alipay_alifans') . " WHERE alipay_openid=:alipay_openid and beid=:beid  ", array(':alipay_openid' =>$alipay_openid,':beid'=>$_CMS['beid']));
		
		if(!empty($alipay_alifans['alipay_openid']))
			{
					$member = mysqld_select("SELECT * FROM ".table('member')." where openid=:openid and beid=:beid  limit 1", array(':openid' => $alipay_alifans['openid'],':beid'=>$_CMS['beid']));
					if(!empty($member['openid']))
					{
						$_SESSION[MOBILE_ACCOUNT]=$member;
					}else
					{
								$settings=globaSetting();
								$openid=member_create_new("","",$alipay_alifans['nickname']);
								
								mysqld_update('alipay_alifans',array('openid'=>$openid),array('alipay_openid'=>$alipay_openid,'beid'=>$_CMS['beid']));	
				
								save_member_login($openid);
						
					}
			}else
			{
				
				message("支付宝服务窗注册失败");	
			}
	}
	
}

function member_create_check($mobile)
{
			global $_CMS;
		$member = mysqld_select("SELECT * FROM ".table('member')." where mobile=:mobile  and beid=:beid", array(':mobile' => $mobile,'beid'=>$_CMS['beid']));
			if(!empty($member['openid']))
			{
					message($mobile."已被注册。");	
			}
			return true;
}
function member_create_new($mobile,$pwd,$nickname="")
{
			$member=get_session_account();
			$oldsessionid=$member['openid'];
		unset($_SESSION[MOBILE_ACCOUNT]);
				unset($_SESSION[MOBILE_SESSION_ACCOUNT]);
		global $_CMS;
			$openid=date("YmdH",time()).rand(100,999).rand(100,999).rand(100,999).rand(0,9);
		  $hasmember = mysqld_select("SELECT * FROM " . table('member') . " WHERE openid = :openid  ", array(':openid' => $openid));
			while(!empty($hasmember['openid']))
			{
							$openid=date("YmdH",time()).rand(100,999).rand(100,999).rand(100,999).rand(0,9);
							 $hasmember = mysqld_select("SELECT * FROM " . table('member') . " WHERE openid = :openid  ", array(':openid' => $openid));
			}
			if(!empty($pwd))
			{
			$pwd=	md5($pwd);
			}
	
			$data = array(
							'nickname'=>$nickname,
							'realname'=>$nickname,
					    'mobile' => $mobile,
                    'pwd' =>$pwd,
                    'createtime' => time(),
                    'status' => 1,
                    'istemplate'=>0,
                    'experience'=> 0 ,
                    'openid' =>$openid,'beid'=>$_CMS['beid']);
				mysqld_insert('member', $data);
				return $openid;
}
function member_create_new_sample($nickname)
{
		global $_CMS;
			$openid=date("YmdH",time()).rand(100,999).rand(100,999).rand(100,999).rand(0,9);
		  $hasmember = mysqld_select("SELECT * FROM " . table('member') . " WHERE openid = :openid  ", array(':openid' => $openid));
			while(!empty($hasmember['openid']))
			{
							$openid=date("YmdH",time()).rand(100,999).rand(100,999).rand(100,999).rand(0,9);
							 $hasmember = mysqld_select("SELECT * FROM " . table('member') . " WHERE openid = :openid  ", array(':openid' => $openid));
			}
		
			$data = array(
							'nickname'=>$nickname,
							'realname'=>$nickname,
					    'mobile' => '',
                    'pwd' =>'',
                    'createtime' => time(),
                    'status' => 1,
                    'istemplate'=>0,
                    'experience'=> 0 ,
                    'openid' =>$openid,'beid'=>$_CMS['beid']);
				mysqld_insert('member', $data);
				return $openid;
}
function member_login($mobile,$pwd)
{
				global $_CMS;
	$member = mysqld_select("SELECT * FROM ".table('member')." where mobile=:mobile and beid=:beid limit 1", array(':mobile' => $mobile,':beid'=>$_CMS['beid']));
	
		if(!empty($member['openid']))
		{
			if($member['status']!=1)
			{
			return -1;	
			}
			if($member['pwd']==md5($pwd))
			{
				save_member_login($member['openid']);
				return $member['openid'];
			}
			
		}
		return '';
}
function member_logout()
{
		global $_CMS;
		unset($_SESSION["mobile_login_fromurl"]);
		if(!empty($_SESSION[MOBILE_ACCOUNT]))
		{
			$openid=$_SESSION[MOBILE_ACCOUNT]['openid'];
			$weixin_openid=$_SESSION[MOBILE_WEIXIN_OPENID];
				$alipay_openid=$_SESSION[MOBILE_ALIPAY_OPENID];
					$qq_openid=$_SESSION[MOBILE_QQ_OPENID];
			$member = mysqld_select("SELECT * FROM ".table('member')." where openid=:openid and beid=:beid limit 1", array(':openid' => $openid,':beid'=>$_CMS['beid']));
	
			if(!empty($openid)&&!empty($weixin_openid)&&!empty($member['mobile']))
			{
		  mysqld_update('weixin_wxfans', array('openid' =>''), array('openid' =>$openid,'weixin_openid' =>$weixin_openid,'beid'=>$_CMS['beid']));
			
		 	}
		 		if(!empty($openid)&&!empty($alipay_openid)&&!empty($member['mobile']))
			{
	  mysqld_update('alipay_alifans', array('openid' =>''), array('openid' =>$openid,'alipay_openid' =>$alipay_openid,'beid'=>$_CMS['beid']));
			
		 	}
		 	
				if(!empty($openid)&&!empty($qq_openid)&&!empty($member['mobile']))
			{
	  mysqld_update('alipay_alifans', array('openid' =>''), array('openid' =>$openid,'qq_openid' =>$qq_openid,'beid'=>$_CMS['beid']));
			
		 	}
			
	
		 	
		}
		

		unset($_SESSION[MOBILE_WEIXIN_OPENID]);
		unset($_SESSION[MOBILE_ALIPAY_OPENID]);
		unset($_SESSION[MOBILE_QQ_OPENID]);
		unset($_SESSION[MOBILE_ACCOUNT]);
		unset($_SESSION[MOBILE_SESSION_ACCOUNT]);
		header("location:".create_url('mobile',array('name' => 'shopwap','do' => 'index')));	
		exit;
}
function create_sessionid()
{
	
return '_t'.date("mdHis").rand(10000000,99999999);	
}
function integration_session_account($loginid,$oldsessionid)
{
		global $_CMS;
	  $member = mysqld_select("SELECT * FROM " . table('member') . " WHERE openid = :openid and beid=:beid ", array(':openid' => $loginid,':beid'=>$_CMS['beid']));
	$sessionmember = mysqld_select("SELECT * FROM " . table('member') . " WHERE openid = :openid and beid=:beid", array(':openid' => $oldsessionid,':beid'=>$_CMS['beid']));
	 


		 if(empty($member['openid'])||(!empty($member['openid'])&&$sessionmember['istemplate']!=1))
		 {
		 	return;
		 }
		 $cartall = mysqld_selectall("SELECT * FROM " . table('shop_cart') . " WHERE session_id = :session_id and beid=:beid  ", array(':session_id' => $oldsessionid,':beid'=>$_CMS['beid']));
           
            foreach($cartall as $cartitem) {
             $row = mysqld_select("SELECT * FROM " . table('shop_cart') . " WHERE session_id = :loginid  AND goodsid = :goodsid  and optionid=:optionid and beid=:beid  limit 1", array(':beid'=>$_CMS['beid'],':loginid' => $loginid, ':goodsid' => $cartitem['goodsid'],':optionid'=>$cartitem['optionid']));
	            if (empty($row['id'])) {
	            
	                mysqld_update('shop_cart', array('session_id'=>$loginid), array('id'=>$cartitem['id'],'beid'=>$_CMS['beid']));
	            } else {
	                $t = $cartitem['total'] + $row['total'];
	              
	                $data = array(
	                    'marketprice' => $cartitem['marketprice'],
	                    'total' => $t,
	                    'optionid' => $optionid
	                );
	                mysqld_update('shop_cart', $data, array('id' => $row['id'],'beid'=>$_CMS['beid']));
	                mysqld_delete('shop_cart', array('id'=>$cartitem['id'],'beid'=>$_CMS['beid']));
	            }
          }
   mysqld_update('shop_address', array('openid'=>$loginid), array('openid'=>$oldsessionid,'beid'=>$_CMS['beid']));
	 mysqld_update('shop_order', array('openid'=>$loginid), array('openid'=>$oldsessionid,'beid'=>$_CMS['beid']));
	 mysqld_update('shop_address', array('openid'=>$loginid), array('openid'=>$oldsessionid,'beid'=>$_CMS['beid']));
	 mysqld_update('shop_order_paylog', array('openid'=>$loginid), array('openid'=>$oldsessionid,'beid'=>$_CMS['beid']));
	 mysqld_update('member_paylog', array('openid'=>$loginid), array('openid'=>$oldsessionid,'beid'=>$_CMS['beid']));

	
	//unset($_SESSION[MOBILE_SESSION_ACCOUNT]);
}
function is_login_account()
{
		if(!empty($_SESSION[MOBILE_ACCOUNT]))
		{
				return true;
		}
		return false;
}
function tosaveloginfrom()
{
$_SESSION["mobile_login_fromurl"]="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";	

}
function clearloginfrom()
{
$_SESSION["mobile_login_fromurl"]="";	
}
function getloginfrom($param="")
{
return $_SESSION["mobile_login_fromurl"].$param;
}
function get_member_account($useAccount=true,$mustlogin=false)
{
	if(empty($_SESSION[MOBILE_ACCOUNT])&&$mustlogin)
	{
		tosaveloginfrom();
		header("location:".create_url('mobile',array('name' => 'shopwap','do' => 'login')));	
		exit;
	}
	if($mustlogin==true)
	{
	return $_SESSION[MOBILE_ACCOUNT];
	}
		
		if(!empty($_SESSION[MOBILE_ACCOUNT]))
		{
				return $_SESSION[MOBILE_ACCOUNT];
		}
		
		return get_session_account($useAccount);
}
function get_session_account($useAccount=true)
{
		global $_CMS;
		$sessionAccount="";
		if(!empty($_SESSION[MOBILE_SESSION_ACCOUNT])&&!empty($_SESSION[MOBILE_SESSION_ACCOUNT]['openid']))
		{
				$sessionAccount=$_SESSION[MOBILE_SESSION_ACCOUNT];
		}else
		{
			$sessionAccount=array('openid'=>create_sessionid());
				$_SESSION[MOBILE_SESSION_ACCOUNT]=$sessionAccount;
		}
		
		if($useAccount&&!empty($sessionAccount))
		{
			/*	$member = mysqld_select("SELECT * FROM ".table('member')." where openid=:openid and istemplate=1 and beid=:beid ", array(':openid' => $sessionAccount['openid'],':beid'=>$_CMS['beid']));
					if(empty($member['openid']))
						{
								$data = array('mobile' => "",
                    'pwd' => md5(rand(10000,99999)),
                    'createtime' => time(),
                    'status' => 1,
                    'istemplate'=> 1 ,
                    'experience'=> 0 ,
                    'openid' =>$sessionAccount['openid'],'beid'=>$_CMS['beid']);
							mysqld_insert('member', $data);	
						}*/
			
		}
		return $sessionAccount;
	
}

function to_member_loginfromurl()
{
		if(empty($_SESSION["mobile_login_fromurl"]))
		{
					return create_url('mobile',array('name' => 'shopwap','do' => 'fansindex'));
		}else
		{
			$fromurl=$_SESSION["mobile_login_fromurl"];
			unset($_SESSION["mobile_login_fromurl"]);
			return $fromurl;
		}
	
}

function member_get($openid)
{
		global $_CMS;
		$member = mysqld_select("SELECT * FROM ".table('member')." where openid=:openid ", array(':openid' => $openid));
			
	return $member;
}
function member_credit($openid,$fee,$type,$remark)
{
		global $_CMS;
	$member=member_get($openid);
		if(!empty($member['openid']))
		{
			if(!is_numeric($fee)||$fee<0)
					{
						message("输入数字非法，请重新输入");
					}
			if($type=='addcredit')
			{
				 $data= array('remark'=> $remark,'type'=>$type,'fee'=> intval($fee),'account_fee'=>$member['credit']+$fee,'createtime' => TIMESTAMP,'openid'=>$openid);
				 mysqld_insert('member_paylog', $data);
		     mysqld_update('member', array('credit' => $member['credit']+$fee,'experience'=> $member['experience']+$fee ), array('openid' => $openid));
		     return true;
			}
			if($type=='usecredit')
			{
				if($member['credit']>=$fee)
				{
				 $data= array('remark'=> $remark,'type'=>$type,'fee'=> intval($fee),'account_fee'=>$member['credit']-$fee,'createtime' => TIMESTAMP,'openid'=>$openid);
				 mysqld_insert('member_paylog', $data);
		     mysqld_update('member', array('credit' => $member['credit']-$fee), array('openid' => $openid));
		      return true;
		    }
			}
		}
		return false;
}
function member_gold($openid,$fee,$type,$remark)
{
		global $_CMS;
			$member=member_get($openid);
	 if(!empty($member['openid']))
		{
			if(!is_numeric($fee)||$fee<0)
					{
					
				return false;
					}	
			if($type=='addgold')
			{
				 $data= array('remark'=> $remark,'type'=>$type,'fee'=> $fee,'account_fee' => $member['gold']+$fee,'createtime' => TIMESTAMP,'openid'=>$openid,'beid'=>$_CMS['beid']);
				 mysqld_insert('member_paylog', $data);
		     mysqld_update('member', array('gold' => $member['gold']+$fee), array('openid' => $openid));
		       return true;
			}
			if($type=='usegold')
			{
				if($member['gold']>=$fee)
				{
				 $data= array('remark'=> $remark,'type'=>$type,'fee'=> $fee,'account_fee' => $member['gold']-$fee,'createtime' => TIMESTAMP,'openid'=>$openid,'beid'=>$_CMS['beid']);
				 mysqld_insert('member_paylog', $data);
		     mysqld_update('member', array('gold' => $member['gold']-$fee), array('openid' => $openid));
		       return true;
		    }
			}
		}
		return false;
}
function get_html($str)
{
if (!function_exists('file_get_html')) {
        require_once(WEB_ROOT . '/includes/lib/simple_html_dom.php');
    }	
	$html = str_get_html($content);
    $ret = $html->find('a');
    foreach ($ret as $a) {
        if (is_outer($a->href)) {
            $a->outertext = $a->innertext;
        }
    }
    $content = $html->save();
    $html->clear();
    return $content;
}
