<?php
defined('SYSTEM_IN') or exit('Access Denied');
 $operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
 if($operation=='setting')
 {
$settings=globaSetting();
				   		  if($_GP['regsiter_usesms']==1)
				   		  {
				   		  	  if(empty($_GP['sms_key']))
				   		  {
				   		  	message("短信key不能空");
				   		  }
				   		  	  	  if(empty($_GP['sms_secret']))
				   		  {
				   		  	message("短信Secret不能空");
				   		  }
				   
				   		    	  if(empty($_GP['sms_secret_resec']))
				   		  {
				   		  	message("验证码重发时间不能空");
				   		  }
				   		   	  if(empty($_GP['sms_secret_count']))
				   		  {
				   		  	message("一天同一个业务最多发送多少条短信不能空");
				   		  }
				   		  }
	   		 if (checksubmit("submit")) {
            $cfg = array(
            'regsiter_usesms' => intval( $_GP['regsiter_usesms']),
               'sms_key' => $_GP['sms_key'],
                'sms_secret' => $_GP['sms_secret'],
                'sms_secret_resec' => $_GP['sms_secret_resec'],
                'sms_secret_count' => $_GP['sms_secret_count'],
                'sms_secret_resec' => $_GP['sms_secret_resec'],
                'sms_register_user' => $_GP['sms_register_user'],
                'sms_change_pwd1' => $_GP['sms_change_pwd1'],
                'sms_change_pwd2' => $_GP['sms_change_pwd2'],
                'sms_change_mobile' => $_GP['sms_change_mobile'],
                'sms_mobile_test' => $_GP['sms_mobile_test'],
                'sms_register_user_signname' => $_GP['sms_register_user_signname'],
                'sms_change_pwd1_signname' => $_GP['sms_change_pwd1_signname'],
                'sms_change_pwd2_signname' => $_GP['sms_change_pwd2_signname'],
                'sms_change_mobile_signname' => $_GP['sms_change_mobile_signname'],
                'sms_mobile_test_signname' => $_GP['sms_mobile_test_signname']
            );
        
         
          refreshSetting($cfg);
         
				   		  
				   		  
				   		  
            message('保存成功', 'refresh', 'success');
        }
 if (checksubmit("smstest")) {
 	if(empty($_GP['sms_test_tell']))
 	{
 		message("测试手机号不能空");
 		
 	}
				system_sms_test($_GP['sms_test_tell'],$_GP['sms_mobile_test'],$_GP['sms_mobile_test_signname']);
				   		  
				   		  
            message('已发送测试短信', 'refresh', 'success');
        }
    

					include page('sms_setting');
				}