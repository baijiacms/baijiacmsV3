<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: baijiacms <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');
function extends_mail($mailtype=0,$debug,$smtpserver,$smtpauthmode,$smtpserverport,$smtpusermail,$smtpemailto,$smtpuser,$smtppass,$mailtitle,$mailcontent)
{
	
		 require_once WEB_ROOT.'/includes/lib/phpmailer/PHPMailerAutoload.php';   
				$mailer = new PHPMailer();
					$mailer->isSMTP();
					$mailer->CharSet = 'utf-8';
					$mailer->Host = $smtpserver ;
					$mailer->Port = $smtpserverport;
					$mailer->SMTPAuth = true;
					$mailer->Username = $smtpuser;
					$mailer->Password = $smtppass;
					$mailer->do_socket = $mailtype;
					if($debug==1)
					{
						$mailer->SMTPDebug = 1;
					}
					if($smtpauthmode==1)
					{
					$mailer->SMTPSecure = 'ssl';
					}
					$mailer->From = $smtpusermail ;
					$mailer->FromName = $smtpusermail;
					$mailer->isHTML(true);
					
						$mailer->Subject = $mailtitle;
				$mailer->Body = $mailcontent;
				$mailer->addAddress($smtpemailto);
			$retuenrs=$mailer->send();
			if($retuenrs==1)
			{
				return $retuenrs;
			}else
			{
		return array("errorinfo"=>$mailer->ErrorInfo,"returnrs"=>$retuenrs);
		}

	
}

