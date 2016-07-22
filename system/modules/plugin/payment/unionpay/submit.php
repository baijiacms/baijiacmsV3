<?php 
$pay_submit_data=array('bank_pwd'=>
htmlspecialchars_decode($_GP['bank_pwd']),'merId'=>
$_GP['merId'],'qtjyqqdz'=>
$_GP['qtjyqqdz']);
		$payment = mysqld_select("SELECT * FROM " . table('payment') . " WHERE  enabled=1 and code='unionpay' and beid=:beid limit 1",array(":beid"=>$_CMS['beid']));
     $configs=unserialize($payment['configs']);
    if(empty($_GP['qtjyqqdz']))
    {
    	$pay_submit_data['qtjyqqdz']="https://gateway.95516.com/gateway/api/frontTransReq.do";
    } 
 if (!empty($_FILES['shsy']['tmp_name'])) {
                    $upload = system_config_file_upload($_FILES['shsy'],'shsy.pfx','bank_key');
                    if (is_error($upload)) {
                        message($upload['message'], '', 'error');
                    }
                    $pay_submit_data['shsy'] = $upload['path'];
                }else
                {
                	    $pay_submit_data['shsy'] = $configs['shsy'];
                	}
                
                 if (!empty($_FILES['ylgy']['tmp_name'])) {
                    $upload = system_config_file_upload($_FILES['ylgy'],'ylgy.cer','bank_key');
                    if (is_error($upload)) {
                        message($upload['message'], '', 'error');
                    }
                    $pay_submit_data['ylgy'] = $upload['path'];
                }else
                {
                	    $pay_submit_data['ylgy'] = $configs['ylgy'];
                	}

mysqld_update('payment',array('order' => $_GP['pay_order'],'configs'=> serialize($pay_submit_data)) , array('code' => 'unionpay',"beid"=>$_CMS['beid']));
	mysqld_update('payment', array('enabled' => '1') , array('code' => 'unionpay',"beid"=>$_CMS['beid']));
?>