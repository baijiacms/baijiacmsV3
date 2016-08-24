<?php
defined('SYSTEM_IN') or exit('Access Denied');
		
        $operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
        $ruletype = $_GP['ruletype'];
        if($operation=='detail')
        {
        	
        	if(!empty($_GP['id']))
        	{
        	$rule = mysqld_select('SELECT * FROM '.table('weixin_rule')." WHERE  id = :id and beid=:beid" , array(':id' =>intval($_GP['id']),':beid'=>$_CMS['beid']));
       	  $ruletype=$rule['ruletype'];
        
        	}
       
        	
        	
        	   $ruletype = !empty($ruletype) ? intval($ruletype) : 1;
         
    		
    		
    		  if($ruletype==1)
          {  //图文回复
          
	    			if(checksubmit())
	    			{
	    	
	    				if(empty($_GP['id']))
	    				{
	    								$count = mysqld_selectcolumn('SELECT count(id) FROM '.table('weixin_rule')." WHERE  keywords = :keywords and beid=:beid" , array(':keywords' =>$_GP['keywords'],':beid'=>$_CMS['beid']));
										if($count>0)
										{
											message('触发关键字'.$_GP['keywords']."已存在！");
										}
										
	    				
	    				  if(!empty($_GP['ruletypekeywords']))
	                {
	                	 if($_GP['ruletypekeywords']==1)
	                {
	                	 $_GP['keywords']=	default_key;
	                }
	                 	 if($_GP['ruletypekeywords']==2)
	                {
	                $_GP['keywords']=	subscribe_key;
	                }
	                }
	    					$data=array('beid'=>$_CMS['beid'],'title'=>$_GP['title'],'ruletype'=>$ruletype,'keywords'=>$_GP['keywords']);
	          	 mysqld_insert('weixin_rule', $data);
	    					message('保存成功！', 'refresh', 'success');
	    				}else
	    				{
	    					if($rule['keywords']!=$_GP['keywords'])
	    					{
	    									$count = mysqld_selectcolumn('SELECT count(id) FROM '.table('weixin_rule')." WHERE  keywords = :keywords and beid=:beid" , array(':keywords' =>$_GP['keywords'],':beid'=>$_CMS['beid']));
						if($count>0)
						{
							message('触发关键字'.$_GP['keywords']."已存在！");
						}
	    						
	    					}
	    					
	    					
	                
	                if(!empty($_GP['ruletypekeywords']))
	                {
	                	 if($_GP['ruletypekeywords']==1)
	                {
	                	 $_GP['keywords']=	default_key;
	                }
	                 	 if($_GP['ruletypekeywords']==2)
	                {
	                $_GP['keywords']=	subscribe_key;
	                }
	                }
	                
	    						$data=array('title'=>$_GP['title'],'ruletype'=>$_GP['ruletype'],'keywords'=>$_GP['keywords']);
	          	
	          
	          	 mysqld_update('weixin_rule', $data, array('id' => $_GP['id'],'beid'=>$_CMS['beid']));
	    					
	    					message('修改成功！', 'refresh', 'success');
	    				}
	    			}
    			
    					include page('rule_detail_text');
    								exit;
    		}
    		
    		
    		     if($ruletype==2)
              {  //图文回复
    			if(checksubmit())
    			{
    	
    				if(empty($_GP['id']))
    				{
    								$count = mysqld_selectcolumn('SELECT count(id) FROM '.table('weixin_rule')." WHERE  keywords = :keywords and beid=:beid" , array(':keywords' =>$_GP['keywords'],':beid'=>$_CMS['beid']));
					if($count>0)
					{
						message('触发关键字'.$_GP['keywords']."已存在！");
					}
    			
    				  if(!empty($_GP['ruletypekeywords']))
                {
                	 if($_GP['ruletypekeywords']==1)
                {
                	 $_GP['keywords']=	default_key;
                }
                 	 if($_GP['ruletypekeywords']==2)
                {
                $_GP['keywords']=	subscribe_key;
                }
                }
    					$data=array('beid'=>$_CMS['beid'],'title'=>$_GP['title'],'ruletype'=>$ruletype,'keywords'=>$_GP['keywords'],'thumb'=>$thumb,'description'=>$_GP['description'],'url'=>$_GP['url']);
          	 mysqld_insert('weixin_rule', $data);
    					message('保存成功！', 'refresh', 'success');
    				}else
    				{
    					if($rule['keywords']!=$_GP['keywords'])
    					{
    									$count = mysqld_selectcolumn('SELECT count(id) FROM '.table('weixin_rule')." WHERE  keywords = :keywords and beid=:beid" , array(':keywords' =>$_GP['keywords'],':beid'=>$_CMS['beid']));
					if($count>0)
					{
						message('触发关键字'.$_GP['keywords']."已存在！");
					}
    						
    					}
    					
    					 	if (!empty($_FILES['thumb']['tmp_name'])) {
                    file_delete($_GP['thumb_old']);
                    $upload = file_upload($_FILES['thumb']);
                    if (is_error($upload)) {
                        message($upload['message'], '', 'error');
                    }
                    $thumb = $upload['path'];
                }
                
                if(!empty($_GP['ruletypekeywords']))
                {
                	 if($_GP['ruletypekeywords']==1)
                {
                	 $_GP['keywords']=	default_key;
                }
                 	 if($_GP['ruletypekeywords']==2)
                {
                $_GP['keywords']=	subscribe_key;
                }
                }
                
    						$data=array('title'=>$_GP['title'],'ruletype'=>$_GP['ruletype'],'keywords'=>$_GP['keywords'],'description'=>$_GP['description'],'url'=>$_GP['url']);
          	
          	if(!empty($thumb))
          	{
          		$data['thumb']=$thumb;
          		
          	}
          	 mysqld_update('weixin_rule', $data, array('id' => $_GP['id'],'beid'=>$_CMS['beid']));
    					
    					message('修改成功！', 'refresh', 'success');
    				}
    			}
    			
    					include page('rule_detail_news');
    								exit;
    		}
    		
    	
        }
        if($operation=='delete'&&!empty($_GP['id']))
        {
        		
        	 mysqld_delete('weixin_rule', array('id'=>$_GP['id'],'beid'=>$_CMS['beid']));
        	 message('删除成功！', 'refresh', 'success');
        }
       
				 
        $list=mysqld_selectall('SELECT * FROM '.table('weixin_rule')." where beid=:beid and addonsrule=0",array(':beid'=>$_CMS['beid']));
			include page('rule');