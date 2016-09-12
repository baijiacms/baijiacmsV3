<?php
$operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
	$settings=globaSetting();
$showtype = 1;
	
	
	if($operation=='changestyle')
{
	
        
             $cfg = array(
                'shopwap_diyshop_diyshopindex' => intval($_GP['shopwap_diyshop_diyshopindex'])
            );
                       
          	refreshSetting($cfg);
        
          	if(!empty($_GP['shopwap_diyshop_diyshopindex']))
          	{
          		
          	message('开启DIY商城首页成功！', web_url('diyshop', array('op' => 'display')), 'success');
          	}else
          	{
          	
          	message('关闭DIY商城首页成功！', web_url('diyshop', array('op' => 'display')), 'success');	
          	}
          	
}
if($operation=='display')
{
	 $diyshoplist = mysqld_selectall("SELECT * FROM " . table('bj_tbk_diyshopindex')." where beid=:beid",array(':beid'=> $_CMS['beid']) );
           
		include page('diyshoplist');
	exit;
}
if($operation=='edit')
{
	 $id = intval($_GP['id']);
	        $diyshop = mysqld_select("SELECT * FROM " . table('bj_tbk_diyshopindex')." where id=:id and beid=:beid",array(":id"=> $id,':beid'=> $_CMS['beid'] ) );
  if(!empty($diyshop['id']))
  {
  	$showtype=intval($diyshop['showtype']);
  }
	if(!empty($showtype))
	{
			  if(!empty($diyshop['id']))
			  {
						 $diyshop['pageinfo']=unserialize($diyshop['pageinfo']);
						$diyshop['datas']=str_replace('__ATTACHMENT__',ATTACHMENT_WEBROOT,$diyshop['datas']);
					}
			 	if (checksubmit('submit')) {
			 		 $diyshop['pageinfo']=array('name'=>$_GP['page_name'],'pagetype'=>intval($_GP['pagetype']),'title'=>$_GP['page_title'],'diymenu'=>intval($_GP['page_diymenu']));
			 			 $data  = $_GP['htmlcode'];
		$newdata=str_replace(ATTACHMENT_WEBROOT,'__ATTACHMENT__',$data);
		
$newdata=htmlspecialchars_decode($newdata);
			   $insert=array(
               'pagename'=>$diyshop['pageinfo']['name'],    'pagetype'=>intval($diyshop['pageinfo']['pagetype']),    'pageinfo'=>serialize($diyshop['pageinfo']),    'datas'=>	$newdata,
            'active'=>0,'beid'=> $_CMS['beid'],'showtype'=>1);
        	if(empty($diyshop['id']))
        	{
        			$insert['createtime']=time();
        			$insert['updatetime']=time();
          	  mysqld_insert('bj_tbk_diyshopindex', $insert);
       			}else
       			{
       				
        			$insert['updatetime']=time();
       				     mysqld_update('bj_tbk_diyshopindex', $insert,array('id'=>$diyshop['id']));
       				
       			}
	
           
        	 message("操作成功！",create_url('site', array('name' => 'shop','do' => 'diyshop','op'=>'display')),"success");
        	}
			include page('diyshop_html');
	exit;
	}

}

if($operation=='delete')
{
	 $id = intval($_GP['id']);
	  mysqld_delete('bj_tbk_diyshopindex',array('id' => $id,'beid'=> $_CMS['beid']));
          
		 message("操作成功！",'refresh',"success");
        
}

if($operation=='setdefault')
{
 $id = intval($_GP['id']);
	    
  
	  mysqld_update('bj_tbk_diyshopindex',array('active'=>0),array('beid'=> $_CMS['beid'],'pagetype'=>0));
   
	  mysqld_update('bj_tbk_diyshopindex',array('active'=>1),array('id' => $id,'beid'=> $_CMS['beid'],'pagetype'=>0));
       
		 message("操作成功！",'refresh',"success");

}