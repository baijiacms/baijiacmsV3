<?php
 $award = mysqld_select("select * FROM " . table('addon7_award') . " where id=:id and beid=:beid",array(":id"=>intval($_GP['id']),'beid'=>$_CMS['beid']));

  if (checksubmit("submit")) {
  	
  		 $update=array(
  	 	'title' => $_GP['title'],
  	 		'amount' => intval($_GP['amount']),
  	 		'endtime' =>  strtotime($_GP['endtime']),
  	 'price' => $_GP['price'],
  	  'gold'=> $_GP['gold'],
  	 'awardtype'=> intval($_GP['awardtype']),
  	  'credit_cost' => intval($_GP['credit_cost']),
  	   'content' => htmlspecialchars_decode($_GP['content'])
  	 );
  	 
  	   	if (!empty($_FILES['logo']['tmp_name'])) {
                    $upload = file_upload($_FILES['logo']);
                    if (is_error($upload)) {
                        message($upload['message'], '', 'error');
                    }
                    $logo = $upload['path'];
                }
                if(!empty($logo))
                {
                	$update['logo']=$logo;
                }
  	 
			  mysqld_update('addon7_award', $update,array("id"=>intval($_GP['id']),'beid'=>$_CMS['beid']));	
			          message('保存成功', 'refresh', 'success');
	}
 include addons_page('award');