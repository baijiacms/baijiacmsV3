<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
	$nowyear=intval(date('Y',time()));
			  	$nowmonth=intval(date('m',time()));
			  	$nowdate=intval(date('d',time()));
			  	$lastmonthday=date('t',strtotime($nowyear."-".$nowmonth."-1"));
			  	$lastyearday=date('t',strtotime($nowyear."-12-1"));
			  	
			  	
			  	$needoutchargegold = mysqld_selectcolumn("SELECT count(id) FROM " . table('gold_teller') . " WHERE status=0 and beid=:beid",array(":beid"=>$_CMS['beid']));
        		$begoodscomment = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_goods_comment') . " WHERE is_system=0 and isenable=0 and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	
        	$monthgoodscomment = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_goods_comment') . " WHERE createtime >=".strtotime($nowyear."-".$nowmonth."-01 00:00:01")." and createtime <=".strtotime($nowyear."-".$nowmonth."-".$lastmonthday." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	$monthmember = mysqld_selectcolumn("SELECT count(openid) FROM " . table('member') . " WHERE istemplate=0 and createtime >=".strtotime($nowyear."-".$nowmonth."-01 00:00:01")." and createtime <=".strtotime($nowyear."-".$nowmonth."-".$lastmonthday." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	
			  	
			  	$todayordercount = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_order') . " WHERE status>=1 and createtime >=".strtotime($nowyear."-".$nowmonth."-".$nowdate." 00:00:01")." and createtime <=".strtotime($nowyear."-".$nowmonth."-".$nowdate." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	$todayorderprice = mysqld_selectcolumn("SELECT sum(price) FROM " . table('shop_order') . " WHERE status>=1 and createtime >=".strtotime($nowyear."-".$nowmonth."-".$nowdate." 00:00:01")." and createtime <=".strtotime($nowyear."-".$nowmonth."-".$nowdate." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
      		$monthordercount = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_order') . " WHERE status>=1 and createtime >=".strtotime($nowyear."-".$nowmonth."-01 00:00:01")." and createtime <=".strtotime($nowyear."-".$nowmonth."-".$lastmonthday." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	$monthorderprice = mysqld_selectcolumn("SELECT sum(price) FROM " . table('shop_order') . " WHERE status>=1 and createtime >=".strtotime($nowyear."-".$nowmonth."-01 00:00:01")." and createtime <=".strtotime($nowyear."-".$nowmonth."-".$lastmonthday." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
      		$yearordercount = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_order') . " WHERE status>=1 and createtime >=".strtotime($nowyear."-01-01 00:00:01")." and createtime <=".strtotime($nowyear."-12-".$lastyearday." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	$yearorderprice = mysqld_selectcolumn("SELECT sum(price) FROM " . table('shop_order') . " WHERE status>=1 and createtime >=".strtotime($nowyear."-01-01 00:00:01")." and createtime <=".strtotime($nowyear."-12-".$lastyearday." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
      	
      		$todayordercount_re = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_order') . " WHERE status<-1 and status=-6 and createtime >=".strtotime($nowyear."-".$nowmonth."-".$nowdate." 00:00:01")." and createtime <=".strtotime($nowyear."-".$nowmonth."-".$nowdate." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	$todayorderprice_re = mysqld_selectcolumn("SELECT sum(price) FROM " . table('shop_order') . " WHERE status<-1 and status=-6  and createtime >=".strtotime($nowyear."-".$nowmonth."-".$nowdate." 00:00:01")." and createtime <=".strtotime($nowyear."-".$nowmonth."-".$nowdate." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
      		$monthordercount_re = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_order') . " WHERE status<-1 and status=-6  and createtime >=".strtotime($nowyear."-".$nowmonth."-01 00:00:01")." and createtime <=".strtotime($nowyear."-".$nowmonth."-".$lastmonthday." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	$monthorderprice_re = mysqld_selectcolumn("SELECT sum(price) FROM " . table('shop_order') . " WHERE status<-1 and status=-6  and createtime >=".strtotime($nowyear."-".$nowmonth."-01 00:00:01")." and createtime <=".strtotime($nowyear."-".$nowmonth."-".$lastmonthday." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
      		$yearordercount_re = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_order') . " WHERE status<-1 and status=-6 and createtime >=".strtotime($nowyear."-01-01 00:00:01")." and createtime <=".strtotime($nowyear."-12-".$lastyearday." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	$yearorderprice_re = mysqld_selectcolumn("SELECT sum(price) FROM " . table('shop_order') . " WHERE status<-1 and status=-6   and createtime >=".strtotime($nowyear."-01-01 00:00:01")." and createtime <=".strtotime($nowyear."-12-".$lastyearday." 23:59:59")."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
      	
      	
      		$needsend_count = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_order') . " WHERE is_be=1 and status=1 "."  and beid=:beid and be_status=0 ",array(":beid"=>$_CMS['beid']));
        	$needsend__price = mysqld_selectcolumn("SELECT sum(be_goodsprice+be_dispatchprice) FROM " . table('shop_order') . " WHERE is_be=1 and status=1  and be_status=0 "." and beid=:beid ",array(":beid"=>$_CMS['beid']));
      		$needget_count = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_order') . " WHERE is_be=1 and status=2 "."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	$needget__price = mysqld_selectcolumn("SELECT sum(be_goodsprice+be_dispatchprice) FROM " . table('shop_order') . " WHERE is_be=1 and status=2 "."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
      	
      	
      		$returnofgoods_count = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_order') . " WHERE  status= -3 "."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	$returnofgoods_price = mysqld_selectcolumn("SELECT sum(price) FROM " . table('shop_order') . " WHERE status= -3 "."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        
        	$noneedgoods_count = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_order') . " WHERE status=-4"."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	$noneedgoods_price = mysqld_selectcolumn("SELECT sum(price) FROM " . table('shop_order') . " WHERE status=-4"."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        
        
        		$returnofmoney_count = mysqld_selectcolumn("SELECT count(id) FROM " . table('shop_order') . " WHERE is_be=1 and status=-2 "."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
        	$returnofmoney_price = mysqld_selectcolumn("SELECT sum(be_goodsprice+be_dispatchprice) FROM " . table('shop_order') . " WHERE is_be=1 and  status=-2 "."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
      
      	if(empty($noneedgoods_price))
      	{
      		$noneedgoods_price="0.00";
      	}else
      	{
      	$noneedgoods_price=round($noneedgoods_price,2);	
      	}
      
      
      	 	if(empty($returnofmoney_price))
      	{
      		$returnofmoney_price="0.00";
      	}else
      	{
      	$returnofmoney_price=round($returnofmoney_price,2);	
      	}
      	 	if(empty($needsend__price))
      	{
      		$needsend__price="0.00";
      	}else
      	{
      	$needsend__price=round($needsend__price,2);	
      	}
      	
      		if(empty($needget__price))
      	{
      		$needget__price="0.00";
      	}else
      	{
      	$needget__price=round($needget__price,2);	
      	}
      	
      	 	if(empty($returnofgoods_price))
      	{
      		$returnofgoods_price="0.00";
      	}else
      	{
      	$returnofgoods_price=round($returnofgoods_price,2);	
      	}
      	
      	if(empty($todayorderprice))
      	{
      		$todayorderprice="0.00";
      	}else
      	{
      	$todayorderprice=round($todayorderprice,2);	
      	}
      		if(empty($monthorderprice))
      	{
      		$monthorderprice="0.00";
      	}else
      	{
      	$monthorderprice=round($monthorderprice,2);	
      	}
      		if(empty($yearorderprice))
      	{
      		$yearorderprice="0.00";
      	}else
      	{
      	$yearorderprice=round($yearorderprice,2);	
      	}
      	    	if(empty($todayorderprice_re))
      	{
      		$todayorderprice_re="0.00";
      	}else
      	{
      	$todayorderprice_re=round($todayorderprice_re,2);	
      	}
      		if(empty($monthorderprice_re))
      	{
      		$monthorderprice_re="0.00";
      	}else
      	{
      	$monthorderprice_re=round($monthorderprice_re,2);	
      	}
      		if(empty($yearorderprice_re))
      	{
      		$yearorderprice_re="0.00";
      	}else
      	{
      	$yearorderprice_re=round($yearorderprice_re,2);	
      	}
      	
      		$chartdata1=array();
      		$index=0;
			    		for($dateindex=1;$dateindex<=7;$dateindex++)
			  		{
			  			$time=$nowyear."-".$nowmonth."-".$dateindex;
			  			$datastr=date("Y-m-d",mktime(0, 0 , 0,date("m"),date("d")-date("w")+$dateindex,date("Y"))); 
			  			$start_time=date("Y-m-d 00:00:01",mktime(0, 0 , 0,date("m"),date("d")-date("w")+$dateindex,date("Y"))); 
			  			
							$end_time=date("Y-m-d 23:59:59",mktime(23,59,59,date("m"),date("d")-date("w")+$dateindex,date("Y"))); 
	        		$chart1data = mysqld_selectcolumn("SELECT sum(price) FROM " . table('shop_order') . " WHERE status>=1 and createtime >=".strtotime($start_time)." and createtime <=".strtotime($end_time)."  and beid=:beid ",array(":beid"=>$_CMS['beid']));
			      		if(empty($chart1data))
			      	{
			      		$chart1data="0.00";
			      	}else
			      	{
			      	$chart1data=round($chart1data,2);	
			      	}
	   					$tchartdata=array();
				  		$tchartdata['counts']=$chart1data;
				  		$tchartdata['dates']=$datastr;
				  		$tchartdata['index']=$index;
	   					$chartdata1[]=$tchartdata;
				  		$index=$index+1;
			  		}
      
		include page('center');