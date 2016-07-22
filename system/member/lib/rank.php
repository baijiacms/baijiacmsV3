<?php
defined('SYSTEM_IN') or exit('Access Denied');

function member_rank_model($experience)
{
		global $_CMS;
			$rank = mysqld_select("SELECT * FROM " . table('rank_model')." where experience<='".intval($experience)."' and beid=:beid order by rank_level desc limit 1 ",array(":beid"=>$_CMS['beid']) );
			if(empty($rank))
			{
				return array('rank_name'=>'普通会员','rank_level'=>'','experience'=>'');
			}else
			{
				return $rank;
			}
			  
}


